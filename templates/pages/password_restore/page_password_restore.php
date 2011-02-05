<?
$redirect = root_url('/') . 'login';
?>
<div class="col-16">
	<h1>Password Restore</h1>
</div>

<div class="col-4">
  <p>Please specify your email address and click Submit. We will send you a message with new password.</p>

  <?= open_form(array('onsubmit' => "return $(this).sendRequest('shop:on_passwordRestore')")) ?>
    <input type="hidden" name="redirect" value="<?= $redirect ?>" />
    <input type="hidden" name="flash" value="Thank you! We just sent you am email message with your new password." />
  
    <ul class="form">
      <li class="field text clearfix">
        <div class="text-box"><input id="email" type="text" name="email" value="<?= post('email') ? h(post('email')) : 'E-mail' ?>" /></div>
      </li>
    </ul>
  
    <div class="submit-box clearfix">
      <input type="submit" value="Submit" />
    </div>
  <?= close_form() ?>
</div>