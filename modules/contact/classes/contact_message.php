<?
	
	class Contact_Message {
		public static function send() {
			$validation = new Phpr_Validation();
			$validation->add('name')->fn('trim')->required('Please enter your name');
			$validation->add('phone')->fn('trim');
			$validation->add('email')->fn('trim')->required('Please enter your email address')->email(false, 'Invalid email address');
			$validation->add('message')->fn('trim')->required('Please enter a message text');
			
			if(!$validation->validate($_POST))
				$validation->throwException();
		
			$controller = Cms_Controller::get_instance();
			
			$redirect = post('redirect');
			$flash = post('flash');
			$config = Contact_Configuration::create();
		
			$from_name = post('name');
			$from_email = post('email');
			$to_name = $config->company_title;
			$to_email = $config->company_email;
			
			$template = System_EmailTemplate::create()->find_by_code('site:contact');
			$template->subject = str_replace(array('{name}'), array($to_name), $template->subject);
			
			$template->content = str_replace(
				array(
					'{name}', 
					'{message}', 
					'{phone}', 
					'{email}'
				), 
				array(
					$from_name, 
					post('message'), 
					post('phone'), 
					$from_email
				), 
				$template->content
			);
			
			$users = Users_User::list_users_having_permission('cms', 'manage_pages');
			
			$template->send_to_team($users, $template->content, null, null, $from_email, $from_name);
			
			if($flash)
				Phpr::$session->flash['success'] = $flash;
			
			if($redirect)
				Phpr::$response->redirect($redirect);
		}
	}