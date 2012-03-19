<?

	class Contact_Configuration extends Core_Configuration_Model {
		public $record_code = 'contact_configuration';
		
		public static function create() {
			$config = new self();
			
			return $config->load();
		}
		
		protected function build_form() {
			$this->add_field('company_email', 'Company E-mail', 'full', db_varchar)->tab('Contact')->comment('Enter an company email which will be used for contact emails.');
			$this->add_field('company_title', 'Company Title', 'full', db_varchar)->tab('Contact')->comment('Enter an company title which will be used for contact emails.');
		}
		
		protected function init_config_data() {
		}
	}