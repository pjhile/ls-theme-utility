<?
$shipping_info = Shop_CheckoutData::get_shipping_info();
$shipping_countries = Shop_Country::get_list($shipping_info->country);
$shipping_country = $shipping_info->country ? $shipping_info->country : $shipping_countries[0]->id;
$shipping_states = Shop_CountryState::create(true)->where('country_id=?', $shipping_country)->order('name')->find_all();
?>

  <h3 class="style-2 block left">Shipping Information <img src="<?= theme_resource_url('images/colors/' . $site_settings->theme->color . '/icon-copy.png') ?>" /> <a href="javascript:;" onclick="return $('#billing_info').sendRequest('profile:on_updateBilling', {
      onSuccess: function() {
        LS.sendRequest('<?= Phpr::$request->getCurrentUri() ?>', 'profile:on_copyBillingToShipping', {
          update: {'shipping_info': 'ls_cms_page'},
          extraFields: {
            'section': 'change_shipping',
            'partial_step': true
          },
          onSuccess: function() {
            site.message.copyBilling();
          }
        });
      }
    })">copy billing</a></h3>
    
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
    <input type="submit" onclick="return $(this).getForm().sendRequest('profile:on_updateShipping', {
      extraFields: {'no_flash': true},
      onSuccess: function() {
        site.message.updateShipping();
      }
    })" value="Save" />
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