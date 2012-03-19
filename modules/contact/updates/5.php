<?

	$template = System_EmailTemplate::create()->find_by_code('site:contact');
	
	if($template) {
		$template->is_system = true;
		$template->save();
	}