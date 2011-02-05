<?
function on_contact($controller) {
  if(post('name')) {
    $redirect = post('redirect');
    $flash = post('flash');
    $site_settings = $controller->render_partial('site:settings');
    $template = System_EmailTemplate::create()->find_by_code('site:contact');
  
    $content = $template->fetched['content'];
    $from_name = post('name');
    $from_email = post('email');
    $to_name = $site_settings->company->title;
    $to_email = $site_settings->company->info_email;
    
    $subject = str_replace(array('{name}'), array($to_name), $template->fetched['subject']);
    $message = str_replace(array('{name}', '{comment}', '{phone}', '{email}'), array($from_name, post('comment'), post('phone'), $from_email), $content);
    
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: {$from_name} <{$from_email}>" . "\r\n";
    
    mail($to_email, $subject, $message, $headers);
    
    if($flash)
      Phpr::$session->flash['success'] = $flash;
    
    if($redirect)
      Phpr::$response->redirect($redirect);
  }
}
?>