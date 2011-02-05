<?
$billing_info = Shop_CheckoutData::get_billing_info();
$billing_countries = Shop_Country::get_list($billing_info->country);
$billing_country = $billing_info->country ? $billing_info->country : $billing_countries[0]->id;
$billing_states = Shop_CountryState::create(true)->where('country_id=?', $billing_country)->order('name')->find_all();

$shipping_info = Shop_CheckoutData::get_shipping_info();
$shipping_countries = Shop_Country::get_list($shipping_info->country);
$shipping_country = $shipping_info->country ? $shipping_info->country : $shipping_countries[0]->id;
$shipping_states = Shop_CountryState::create(true)->where('country_id=?', $shipping_country)->order('name')->find_all();
?>

<div class="col-6">
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
    <input type="submit" onclick="return $(this).getForm().sendRequest('shopprofile:on_updateBilling', {
      extraFields: {'no_flash': true},
      onSuccess: function() {
        site.message.updateBilling();
      }
    })" value="Save" />
  </div>
</div>

<div class="col-6">
  <h3 class="block left">Shipping Information</h3>
  <p class="right"><a href="javascript:;" class="color-1 use_billing_address">&raquo; Use Billing Address</a></p>
  
  <ul class="form shipping_info clearfix">
    <li class="field text left">
      <label for="shipping_first_name">First Name</label>
      <div class="text-box"><input id="shipping_first_name" name="shipping[first_name]" type="text" value="<?= h($shipping_info->first_name) ?>" /></div>
    </li>
    <li class="field text right">
      <label for="shipping_last_name">Last Name</label>
      <div class="text-box"><input id="shipping_last_name" name="shipping[last_name]" type="text" value="<?= h($shipping_info->last_name) ?>" /></div>
    </li>
      
    <li class="field text left">
      <label for="shipping_company">Company</label>
      <div class="text-box"><input id="shipping_company" type="text" value="<?= h($shipping_info->company) ?>" name="shipping[company]" /></div>
    </li>
    <li class="field text right">
      <label for="shipping_phone">Phone</label>
      <div class="text-box"><input id="shipping_phone" type="text" value="<?= h($shipping_info->phone) ?>" name="shipping[phone]" /></div>
    </li>

    <li class="field text">
      <label for="shipping_street_address">Street Address</label>
      <div class="text-area"><textarea rows="2" id="shipping_street_address" name="shipping[street_address]" value="<?= h($shipping_info->street_address) ?>"><?= h($shipping_info->street_address) ?></textarea></div>
    </li>

    <li class="field text left">
      <label for="shipping_city">City</label>
      <div class="text-box"><input id="shipping_city" type="text" name="shipping[city]" value="<?= h($shipping_info->city) ?>"/></div>
    </li>
    <li class="field text right">
      <label for="shipping_zip">Zip/Postal Code</label>
      <div class="text-box"><input id="shipping_zip" type="text" name="shipping[zip]" value="<?= h($shipping_info->zip) ?>"/></div>
    </li>

    <li class="field select left">
      <label for="shipping_country">Country</label>
      <select id="shipping_country" name="shipping[country]" onchange="return $(this).getForm().sendRequest('shop:on_updateStateList', {
        update: {'shipping_states': 'shop:states'},
        extraFields: {
          'country': $('#shipping_country').val(), 
          'current_state': '<?= $shipping_info->state ?>'
        }
      })">
        <option value=''>Select Country</option>
      <? foreach($shipping_countries as $country): ?>
        <option <?= option_state($shipping_info->country, $country->id) ?> value="<?= h($country->id) ?>"><?= h($country->name) ?></option>
      <? endforeach ?>
      </select>
    </li>

    <li class="field select right">
      <label for="shipping_states">State</label>
      <div>
        <select id="shipping_states" name="shipping[state]">
        <?= $this->render_partial('shop:states', array('states' => $shipping_states, 'current_state' => $shipping_info->state)) ?>
        </select>
      </div>
    </li>
  </ul>
  
  <div class="submit-box right">
    <input type="submit" onclick="return $(this).getForm().sendRequest('shopprofile:on_updateShipping', {
      extraFields: {'no_flash': true},
      onSuccess: function() {
        site.message.updateShipping();
      }
    })" value="Save" />
  </div>
</div>

<script>
jQuery(function($) {
  $('.use_billing_address').click(function() {
    $('.billing_info [name]').each(function() {
      var re = new RegExp('^billing\\[(.+)\\]$', 'gi');

      var item = re.exec($(this).attr('name'));

      $('.shipping_info [name="shipping[' + item[1] + ']"]').val($(this).val());
    });
    
    site.message.copyBilling();
    
    return false;
  });
});
</script>