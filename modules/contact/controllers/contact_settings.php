<?

	class Contact_Settings extends Backend_Controller {
		public $implement = 'Db_FormBehavior';
		
		public $form_edit_title = 'Contact Settings';
		public $form_model_class = 'Contact_Configuration';
		public $form_redirect = null;
		
		public $strings = array(
			'controller_title' => 'Contact'
		);

		protected $required_permissions = array('contact:manage_settings');

		public function __construct() {
			parent::__construct();
			$this->app_tab = 'contact';
			$this->app_page = 'settings';
			$this->app_module_name = 'Contact';
		}

		public function index() {
			try {
				$this->app_page_title = 'Settings';
				
				$config = new Contact_Configuration();
				$this->viewData['form_model'] = $config->load();
			}
			catch(exception $ex) {
				$this->handlePageError($ex);
			}
		}
		
		protected function index_onSave() {
			try {
				$config = new Contact_Configuration();
				$config = $config->load();
			
				$config->save(post($this->form_model_class, array()), $this->formGetEditSessionKey());
			
				echo Backend_Html::flash_message('Configuration have been successfully saved.');
			}
			catch(Exception $ex) {
				Phpr::$response->ajaxReportException($ex, true, true);
			}
		}
	}