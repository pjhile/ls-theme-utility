<div class="col-12">
<?= open_form() ?>
  <ul class="form clearfix">
    <li class="field text clearfix">
      <label for="old_password">Old Password <span class="required">*</span></label>
      <div class="text-box"><input id="old_password" type="password" name="old_password" /></div>
    </li>
    <li class="field text left clearfix">
      <label for="password">New Password <span class="required">*</span></label>
      <div class="text-box"><input id="password" type="password" name="password" /></div>
    </li>
    <li class="field text right clearfix">
      <label for="password_confirm">Password Confirmation <span class="required">*</span></label>
      <div class="text-box"><input id="password_confirm" type="password" name="password_confirm" /></div>
    </li>
  </ul>
  
  <a class="submit right" href="javascript:;" onclick="return $(this).getForm().sendRequest('profile:on_updatePassword', {
    update: {'page': 'page:profile'},
    extraFields: {'section': 'change_password'}
  })">Save</a>
<?= close_form() ?>
</div>