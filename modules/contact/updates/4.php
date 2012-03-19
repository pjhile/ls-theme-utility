<?
	
	$template = System_EmailTemplate::create()->find_by_code('site:contact');
	
	if(!$template) {
		$template = new System_EmailTemplate();
		$template->code = 'site:contact';
		$template->subject = 'New Comment on {name}';
		$template->description = 'Used for the site contact form.';
		$template->content = '<p>Name: {name}</p><p>Phone: {phone}</p><p>Email: {email}</p><p>Message: {message}</p>';

		$template->save();
	}