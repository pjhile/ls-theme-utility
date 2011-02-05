<?
$redirect = root_url('/');

$name = post('name', 'Name');
$email = post('email', 'Email');
$message = post('message', 'Comment/Question');
$phone = post('phone', 'Phone');
?>

<div class="col-8">
  <h1>Contact</h1>
  
  <?= open_form(array('class' => 'clearfix', 'onsubmit' => "return $(this).sendRequest('contact:on_submit')")) ?>
    <input type="hidden" name="redirect" value="<?= $redirect ?>" />
    <input type="hidden" name="flash" value="Thank you! We will get back to you shortly." />
    
    <ul class="form clearfix">
      <li class="field text left text-box clearfix">
        <input class="inputify" type="text" maxlength="64" size="32" name="name" value="<?= $name ?>" />
      </li>
    
      <li class="field text left text-box clearfix">
        <input class="inputify" type="text" maxlength="2048" size="32" name="email" value="<?= $email ?>" />
      </li>
      
      <li class="field text text-area clearfix">
        <textarea class="inputify" name="message" cols="32" rows="12"><?= $message ?></textarea>
      </li>
      
      <li class="field text left text-box clearfix">
        <input class="inputify" type="text" maxlength="64" size="32" name="phone" value="<?= $phone ?>" />
      </li>
    </ul>
    
    <div class="submit-box clearfix">
      <input type="submit" value="Submit" />
    </div>
  <?= close_form() ?>
</div>

<div class="col-7 right">
  <? content_block('right_content', 'Right Content') ?>
</div>