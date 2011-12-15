<?

class Profile_Actions extends Cms_ActionScope {
	public function on_updatePassword($ajax_mode = true) {
		if($ajax_mode)
			$this->action();
		
		$validation = new Phpr_Validation();
		$validation->add('old_password', 'Old Password')->fn('trim')->required("Please specify the old password");
		$validation->add('password', 'Password')->fn('trim')->required("Please specify new password");
		$validation->add('password_confirm', 'Password Confirmation')->fn('trim')->matches('password', "Password and confirmation password do not match.");
		
		if(!$validation->validate($_POST))
			$validation->throwException();
			
		if(Phpr_SecurityFramework::create()->salted_hash($validation->fieldValues['old_password']) != $this->customer->password)
			$validation->setError('Invalid old password.', 'old_password', true);
	
		try {
			$this->customer = Shop_Customer::create()->where('id=?', $this->customer->id)->find(null, array(), 'front_end');
			$this->customer->password = $validation->fieldValues['password'];
			$this->customer->password_confirm = $validation->fieldValues['password_confirm'];
			$this->customer->save();
			
			if(!post('no_flash', false))
				Phpr::$session->flash['success'] = "Password updated successfully!";
			
			$redirect = post('redirect');
			
			if($redirect)
				Phpr::$response->redirect($redirect);
		}
		catch(Exception $ex) {
			throw new Cms_Exception($ex->getMessage());
		}
	}
	
	public function on_updateAccount($ajax_mode = true) {
		if($ajax_mode)
			$this->action();
	
		$this->customer->disable_column_cache('front_end', false);
		$this->customer->init_columns_info('front_end');
		$this->customer->validation->focusPrefix = null;
	
		if(!post('first_name'))
			throw new Phpr_ApplicationException('Please enter a first name.');
		else if(!post('last_name'))
			throw new Phpr_ApplicationException('Please enter a last name.');
		
		try {
			$_POST['password'] = null;
			
			$this->customer->validation->getRule('email')->focusId('email');
			$this->customer->save($_POST);
			
			if(!post('no_flash', false))
				Phpr::$session->flash['success'] = "Account updated successfully!";
			
			$redirect = post('redirect');
			
			if($redirect)
				Phpr::$response->redirect($redirect);
		}
		catch(Exception $ex) {
			throw new Cms_Exception($ex->getMessage());
		}
	}
	
	public function on_updateBilling($ajax_mode = true) {
		if($ajax_mode)
			$this->action();
	
		try {
			$_POST['password'] = null;
			
			$original_post = $_POST;
			
			$_POST = array_merge($_POST, $original_post['billing']);
			$_POST['email'] = $this->customer->email;
			
			Shop_CheckoutData::set_billing_info(null);
			
			$billing_info = Shop_CheckoutData::get_billing_info();
			
			$this->customer->billing_country_id = $billing_info->country;
			$this->customer->billing_state_id = $billing_info->state;
			$this->customer->billing_street_addr = $billing_info->street_address;
			$this->customer->billing_city = $billing_info->city;
			$this->customer->billing_zip = $billing_info->zip;
			$this->customer->password = null;
			$this->customer->save();
	
			if(!post('no_flash', false))
				Phpr::$session->flash['success'] = "Billing information updated successfully!";
			
			$redirect = post('redirect');
			
			if($redirect)
				Phpr::$response->redirect($redirect);
		}
		catch(Exception $ex) {
			throw new Cms_Exception($ex->getMessage());
		}
	}
	
	public function on_updateShipping($ajax_mode = true) {
		if($ajax_mode)
			$this->action();
	
		try {
			$original_post = $_POST;
			
			$_POST = array_merge($_POST, $original_post['shipping']);
			
			Shop_CheckoutData::set_shipping_info();
			Shop_CheckoutData::get_shipping_info()->save_to_customer($this->customer);
			$this->customer->password = null;
			$this->customer->save();
			
			if(!post('no_flash', false))
				Phpr::$session->flash['success'] = "Shipping information updated successfully!";
			
			$redirect = post('redirect');
			
			if($redirect)
				Phpr::$response->redirect($redirect);
		}
		catch(Exception $ex) {
			throw new Cms_Exception($ex->getMessage());
		}
	}
	
	public function on_copyBillingToShipping($ajax_mode = true) {
		if($ajax_mode)
			$this->action();
		
		$billing_info = Shop_CheckoutData::get_billing_info();
	
		$shipping_info = Shop_CheckoutData::get_shipping_info();
		$shipping_info->copy_from($billing_info);
	
		Shop_CheckoutData::set_shipping_info($shipping_info);
	}
}
