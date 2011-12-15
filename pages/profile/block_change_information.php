<?
$billing_info = Shop_CheckoutData::get_billing_info();
$billing_countries = Shop_Country::get_list($billing_info->country);
$billing_country = $billing_info->country ? $billing_info->country : $billing_countries[0]->id;
$billing_states = Shop_CountryState::create(true)->where('country_id=?', $billing_country)->order('name')->find_all();
?>

<div class="col-6">
<?= open_form(array('id' => 'billing_info')) ?>
  <h3 class="block">Billing Information</h3>

  <ul class="form billing_info clearfix">
    <li class="field text left">
      <label for="billing_first_name">First Name</label>
      <div class="text-box"><input id="billing_first_name" name="billing[first_name]" type="text" value="<?= h($billing_info->first_name) ?>" /></div>
    </li>
    <li class="field text right">
      <label for="billing_last_name">Last Name</label>
      <div class="text-box"><input id="billing_last_name" name="billing[last_name]" type="text" value="<?= h($billing_info->last_name) ?>" /></div>
    </li>
  
    <li class="field text left">
      <label for="billing_company">Company</label>
      <div class="text-box"><input id="billing_company" type="text" value="<?= h($billing_info->company) ?>" name="billing[company]" /></div>
    </li>
    <li class="field text right">
      <label for="billing_phone">Phone</label>
      <div class="text-box"><input id="billing_phone" type="text" value="<?= h($billing_info->phone) ?>" name="billing[phone]" /></div>
    </li>

    <li class="field text">
      <label for="billing_street_address">Street Address</label>
      <div class="text-area"><textarea id="billing_street_address" rows="2" name="billing[street_address]" value="<?= h($billing_info->street_address) ?>"><?= h($billing_info->street_address) ?></textarea></div>
    </li>

    <li class="field text left">
      <label for="billing_city">City</label>
      <div class="text-box"><input id="billing_city" type="text" name="billing[city]" value="<?= h($billing_info->city) ?>" /></div>
    </li>
    <li class="field text right">
      <label for="billing_zip">Zip/Postal Code</label>
      <div class="text-box"><input id="billing_zip" type="text" name="billing[zip]" value="<?= h($billing_info->zip) ?>" /></div>
    </li>

    <li class="field select left">
      <label for="billing_country">Country</label>
      <select id="billing_country" name="billing[country]" onchange="return $(this).getForm().sendRequest('shop:on_updateStateList', {
        extraFields: {
          'country': $('#billing_country').val(), 
          'current_state': '<?= $billing_info->state ?>'
        },
        update: {'billing_states': 'shop:states'}
      })">
        <option value=''>Select Country</option>
      <? foreach($billing_countries as $country): ?>
        <option <?= option_state($billing_info->country, $country->id) ?> value="<?= h($country->id) ?>"><?= h($country->name) ?></option>
      <? endforeach ?>
      </select>
    </li>

    <li class="field select right">
      <label for="billing_states">State</label>
      <div>
        <select id="billing_states" name="billing[state]">
        <?= $this->render_partial('shop:states', array('states' => $billing_states, 'current_state' => $billing_info->state)) ?>
        </select>
      </div>
    </li>
  </ul>

  <div class="submit-box right">
    <input type="submit" onclick="return $(this).getForm().sendRequest('profile:on_updateBilling', {
      extraFields: {'no_flash': true},
      onSuccess: function() {
        site.message.updateBilling();
      }
    })" value="Save" />
  </div>
<?= close_form() ?>
</div>

<div class="col-6">
<?= open_form(array('id' => 'shipping_info')) ?>
<?= close_form() ?>
</div>

<script>
      LS.sendRequest('<?= Phpr::$request->getCurrentUri() ?>', 'on_action', {
          update: {'shipping_info': 'ls_cms_page'},
          extraFields: {
            'section': 'change_shipping',
            'partial_step': true
          }
      });
  </script>