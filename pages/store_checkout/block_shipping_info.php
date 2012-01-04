<h3 class="style-2">Shipping Information <img src="<?= theme_resource_url('images/colors/' . $site_settings->theme->color . '/icon-copy.png') ?>" /> 
	<a href="javascript:;" onclick="return $('#billing_info').sendRequest('on_updateBilling', {
    update: {'widget-cart': 'site:widget:cart'},
    onSuccess: function() {
      LS.sendRequest('<?= Phpr::$request->getCurrentUri() ?>', 'on_copyBillingToShipping', {
        update: {'shipping_info': 'ls_cms_page'},
        extraFields: {
          'move_to': 'shipping_info',
          'partial_step': true
        },
        onSuccess: function() {
          site.message.copyBilling();
        }
      });
    }
  })">copy billing</a>
</h3>
  
  <ul class="form clearfix">
    <li class="field text left">
      <label for="first_name">First Name</label>
      <div class="text-box"><input id="first_name" name="first_name" type="text" value="<?= h($shipping_info->first_name) ?>" /></div>
    </li>
    <li class="field text right">
      <label for="last_name">Last Name</label>
      <div class="text-box"><input id="last_name" name="last_name" type="text" value="<?= h($shipping_info->last_name) ?>" /></div>
    </li>
    <li class="field text left">
      <label for="phone">Phone</label>
      <div class="text-box"><input id="phone" type="text" value="<?= h($shipping_info->phone) ?>" name="phone" /></div>
    </li>
  
    <li class="field text">
      <label for="street_address">Address</label>
      <div class="text-area"><textarea id="street_address" rows="2" name="street_address"><?= h($shipping_info->street_address) ?></textarea></div>
    </li>
  
    <li class="field text left">
      <label for="city">City</label>
      <div class="text-box"><input id="city" type="text" name="city" value="<?= h($shipping_info->city) ?>" /></div>
    </li>
    <li class="field text right">
      <label for="zip">Zip/Postal Code</label>
      <div class="text-box"><input id="zip" type="text" name="zip" value="<?= h($shipping_info->zip) ?>" /></div>
    </li>
  
    <li class="field select left">
      <label for="country">Country</label>
      <select id="country" name="country" onchange="return $(this).getForm().sendRequest('shop:on_updateStateList', {
        extraFields: {
          'country': $('#country').val(), 
          'current_state': '<?= $shipping_info->state ?>'
        },
        update: {'states': 'shop:states'}
      })">
       <? foreach($countries as $country): ?>
        <option <?= option_state($shipping_info->country, $country->id) ?> value="<?= h($country->id) ?>"><?= h($country->name) ?></option>
       <? endforeach ?>
      </select>
    </li>
  
    <li class="field select right">
      <label for="state">State</label>
      <div>
        <select id="states" name="state">
        <?= $this->render_partial('shop:states', array('states' => $states, 'current_state' => $shipping_info->state)) ?>
        </select>
      </div>
    </li>
  </ul>
  <br /><br /><br /><br /><br />
  <input class="button-1 right wide" type="submit" value="Next &#x2192;" onclick="return $('#billing_info').sendRequest('on_updateBilling', {
      update: {'widget-cart': 'site:widget:cart'},
      onSuccess: function() {
        $('#shipping_info').sendRequest('on_updateShipping', {
          update: {'page': 'ls_cms_page'},
          extraFields: {
            'checkout_step': '<?= $checkout_step ?>',
            'skip_to': 'shipping_method'
          }
      });
    }
  })" />