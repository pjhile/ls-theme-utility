<h3>My Profile</h3>

<ul class="style-4">
  <li>
    <a href="javascript:;" onclick="return LS.sendRequest('<?= root_url('/') ?>profile', 'on_action', {
      update: {'page': 'ls_cms_page'},
      extraFields: {'section': 'change_information'}
    })">Change Information</a>
  </li>
  
  <li>
    <a href="javascript:;" onclick="return LS.sendRequest('<?= root_url('/') ?>profile', 'on_action', {
      update: {'page': 'ls_cms_page'},
      extraFields: {'section': 'change_account'}
    })">Change Account</a>
  </li>

  <li>
    <a href="javascript:;" onclick="return LS.sendRequest('<?= root_url('/') ?>profile/orders', 'on_action', {
      update: {'page': 'ls_cms_page'}
    })">View Orders</a>
  </li>
</ul>