<?

class Contact_Actions extends Cms_ActionScope {
	function on_submit($ajax_mode = true) {
		if($ajax_mode)
			$this->action();
			
		Contact_Message::send();
	}
}