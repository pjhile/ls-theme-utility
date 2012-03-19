<?

	class Tweak_Module extends Core_ModuleBase {
		private $cms_update_element;
		private $is_rendering_started;
		
		protected function create_module_info() {
			$info = new Core_ModuleInfo(
				"Tweak",
				"Provides assistance developing themes for your store.",
				"Limewheel Creative Inc."
			);
			
			$this->is_rendering_started = false;

			$cms_update_elements = post('cms_update_elements');
	
			if(!$cms_update_elements) // let's get out of here!
				return $info;
	
			foreach($cms_update_elements as $element => $partial) {
				if($partial == 'ls_cms_page') {
					unset($_POST['cms_update_elements'][$element]);
					
					if($element)
						$this->cms_update_element = $element;
				}
			}
		
			return $info;
		}
		
		public function subscribe_events() {
			// cms ajax display
			Backend::$events->add_event('cms:onBeforeHandleAjax', $this, 'before_handle_ajax');
			Backend::$events->add_event('cms:onAfterHandleAjax', $this, 'after_handle_ajax');
			
			// cms page display
			Backend::$events->add_event('cms:onBeforeDisplay', $this, 'before_page_display');
			
			// cms page content
			Backend::$events->add_event('cms:onGetPageContent', $this, 'get_cms_page_content');
			Backend::$events->add_event('cms:onGetPageBlockContent', $this, 'get_cms_page_block_content');
			
			// cms partial content
			Backend::$events->add_event('cms:onGetPartialContent', $this, 'get_cms_partial_content');
			
			// cms layout content
			Backend::$events->add_event('cms:onGetTemplateContent', $this, 'get_cms_template_content');
		}
		
		public function does_site_settings_exist() {
			$active_theme = Cms_Theme::get_active_theme();
			
			if($active_theme)
				return Db_DbHelper::scalar('select id from partials where name = ? and theme_id = ?', array('site:settings', $active_theme->id));
			else
				return Db_DbHelper::scalar('select id from partials where name = ?', array('site:settings'));
		}
		
		public function before_page_display() {
			if($this->is_rendering_started) // have we started rendering? avoid looping
				return;
			
			if(!$this->does_site_settings_exist())
				return;
			
			$this->is_rendering_started = true; // we've started rendering
		
			// we want $site_settings for non-ajax
			$controller = Cms_Controller::get_instance();
			$controller->data['site_settings'] = $controller->render_partial('site:settings');
		}
	
		public function before_handle_ajax() {
			if(!$this->does_site_settings_exist())
				return;
				
			// we want $site_settings for ajax
			$controller = Cms_Controller::get_instance();
			$controller->data['site_settings'] = $controller->render_partial('site:settings');
		}
		
		public function after_handle_ajax($page) {
			if(!$this->cms_update_element)
				return;
				
			if($this->is_rendering_started) // have we started rendering? avoid looping
				return;
			
			if(!$this->does_site_settings_exist())
				return;
			
			$this->is_rendering_started = true; // we've started rendering
			
			$controller = Cms_Controller::get_instance();
			
			ob_start();
			$controller->open($page, $controller->request_params);
			ob_end_clean();
		
			echo ">>" . $this->cms_update_element . "<<";
			
			$controller->render_page();
		}
		
		// content replacement
		
		public function get_aliases() {
			$cms = Cms_Controller::get_instance();
		
			$aliases = array(
				'root_url' => root_url('/'),
				'site_url' => site_url('/'),
				'customer.first_name' => $cms && $cms->customer ? $cms->customer->first_name : null,
				'customer.last_name' => $cms && $cms->customer ? $cms->customer->last_name : null,
			);
			
			$results = Backend::$events->fire_event('tweak:onGetAliases', $aliases);
			
			foreach($results as $result) {
				if(!is_array($result))
					continue;
				
				$aliases = array_merge($result);
			}
			
			return $aliases;
		}
		
		public function wrap_alias_name($alias_name) {
			return '[' . $alias_name . ']';
		}
		
		public function replace_aliases($content) {
			$aliases = $this->get_aliases();
			
			$alias_names = array_keys($aliases);
			$alias_values = array_values($aliases);
			
			$alias_names = array_map(array($this, 'wrap_alias_name'), $alias_names);
			
			$content = str_replace($alias_names, $alias_values, $content);
		
			return $content;
		}
		
		public function get_cms_page_content($data) {
			extract($data);
			
			$data['content'] = $this->replace_aliases($content);
			
			return $data;
		}
		
		public function get_cms_page_block_content($data) {
			extract($data);
			
			$data['content'] = $this->replace_aliases($content);
			
			return $data;
		}
				
		public function get_cms_template_content($data) {
			extract($data);
			
			$data['content'] = $this->replace_aliases($content);
			
			return $data;
		}
		
		public function get_cms_partial_content($data) {
			extract($data);
			
			$data['content'] = $this->replace_aliases($content);
			
			return $data;
		}
		
		/**
		 * Awaiting deprecation
		 */
		
		protected function createModuleInfo() {
			return $this->create_module_info();
		}
		
		public function subscribeEvents() {
			return $this->subscribe_events();
		}
	}