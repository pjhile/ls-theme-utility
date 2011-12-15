<?
$email = post('email') ? h(post('email')) : $site_settings->customer->default_email;
?>

<?= open_form(array('onsubmit' => "return $(this).sendRequest('shop:on_login')")) ?>
  <input type="hidden" name="redirect" value="<?= $redirect ?>" />
  
  <ul class="form">
    <li class="field text clearfix">
      <label for="login_email">E-mail</label>
      <div class="text-box"><input id="login_email" class="inputify" type="text" name="email" value="<?= $email ?>" /></div>
    </li>
    <li class="field text clearfix">
      <label for="login_password">Password</label>
      <div class="text-box"><input id="login_password" type="password" name="password" /></div>
    </li>
  </ul>
  <input class="button-1" type="submit" value="Sign In" />
  <p><a href="<?= root_url('/') ?>password-restore/"><em>&raquo; Forgot Your Password</em></a></p>
<?= close_form() ?>

<script>jQuery(function($) { $('#login_email').focus(); })</script>