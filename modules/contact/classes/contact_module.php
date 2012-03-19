<?

	class Contact_Module extends Core_ModuleBase {
		protected function create_module_info() {
			return new Core_ModuleInfo(
				"Contact",
				"Provides a contact form for your store.",
				"Limewheel Creative Inc."
			);
		}

		public function build_ui_permissions($host) {
			$host->add_field($this, 'manage_settings', 'Manage settings', 'left')->renderAs(frm_checkbox)->comment('View and manage the settings.', 'above');
		}
		
		public function list_tabs($tab_collection) {
			$user = Phpr::$security->getUser();
			
			$tabs = array(
				'settings' => array('settings', 'Settings', 'manage_settings')
			);

			$first_tab = null;
			
			foreach($tabs as $tab_id => $tab_info) {
				if(($tabs[$tab_id][3] = $user->get_permission('contact', $tab_info[2])) && !$first_tab)
					$first_tab = $tab_info[0];
			}

			if($first_tab) {
				$tab = $tab_collection->tab('contact', 'Contact', $first_tab, 30);
				
				foreach($tabs as $tab_id => $tab_info) {
					if($tab_info[3])
						$tab->addSecondLevel($tab_id, $tab_info[1], $tab_info[0]);
				}
			}
		}

		/**
		 * Awaiting deprecation
		 */
		
		protected function createModuleInfo() {
			return $this->create_module_info();
		}
		
		public function buildPermissionsUi($host) {
			return $this->build_ui_permissions($host);
		}
		
		public function listTabs($tab_collection) {
			return $this->list_tabs($tab_collection);
		}
	}