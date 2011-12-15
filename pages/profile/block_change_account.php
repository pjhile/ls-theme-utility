<div class="col-6">
<?= open_form() ?>
  <ul class="form clearfix">
    <li class="field text left clearfix">
      <label for="first_name">First Name <span class="required">*</span></label>
      <div class="text-box"><input id="first_name" name="first_name" type="text" value="<?= $this->customer->first_name ?>" /></div>
    </li>
    <li class="field text right clearfix">
      <label for="last_name">Last Name <span class="required">*</span></label>
      <div class="text-box"><input id="last_name" name="last_name" type="text" value="<?= $this->customer->last_name ?>" /></div>
    </li>  
    <li class="field text clearfix">
      <label for="email">Email <span class="required">*</span></label>
      <div class="text-box"><input id="email" type="text" name="email" value="<?= $this->customer->email ?>" /></div>
    </li>
  </ul>
  
  <div class="submit-box right">
    <input type="submit" onclick="return $(this).getForm().sendRequest('profile:on_updateAccount', {
      extraFields: {'no_flash': true},
      onSuccess: function() {
        site.message.updateAccount();
      }
    })" value="Save" />
  </div>
<?= close_form() ?>
</div>

<div class="col-6">
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
  
  <div class="submit-box right">
    <input type="submit" onclick="return $(this).getForm().sendRequest('profile:on_updatePassword', {
      extraFields: {'no_flash': true},
      onSuccess: function() {
        site.message.updatePassword();
      }
    })" value="Save" />
  </div>
<?= close_form() ?>
</div>