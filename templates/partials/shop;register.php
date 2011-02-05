<?
$email = post('email') ? h(post('email')) : $site_settings->customer->default_email;
$redirect = root_url('/') . 'login';
?>

<?= open_form(array('onsubmit' => "return $(this).sendRequest('shop:on_signup')")) ?>
  <input type="hidden" name="redirect" value="<?= $redirect ?>" />
  <input type="hidden" name="flash" value="Thank you! We just sent you am email message with your account information." />
  
  <ul class="form">
    <li class="field text left clearfix">
      <label for="first_name">First Name</label>
      <div class="text-box"><input id="first_name" class="inputify" name="first_name" type="text" value="First Name" /></div>
    </li>
    
    <li class="field text right clearfix">
      <label for="last_name">Last Name</label>
      <div class="text-box"><input id="last_name" class="inputify" name="last_name" type="text" value="Last Name" /></div>
    </li>
    
    <li class="field text clearfix">
      <label for="signup_email">Email</label>
      <div class="text-box"><input id="signup_email" class="inputify" type="text" name="email" value="<?= $email ?>" /></div>
    </li>
  </ul>
  
  <div class="submit-box clearfix">
    <input type="submit" value="Sign Up" />
  </div>
<?= close_form() ?>