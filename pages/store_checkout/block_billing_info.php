<?
  $next_step = Shop_CheckoutData::shipping_required() ? 'shipping_info' : 'payment_method';
  
  if($next_step === 'payment_method') {
    if($shipping_method = Shop_ShippingOption::find_by_api_code('no_shipping_required'))
      Shop_CheckoutData::set_shipping_method($shipping_method->id);
  }
?>
<div class="col-8">
<?= open_form(array('id' => 'billing_info')) ?>
  <h3 class="style-2">Billing Information</h3>
  
  <ul class="form clearfix">
    <li class="field text left">
      <label for="first_name">First Name</label>
      <div class="text-box"><input id="first_name" name="first_name" value="<?= h($billing_info->first_name) ?>" type="text" /></div>
    </li>
    <li class="field text right">
      <label for="last_name">Last Name</label>
      <div class="text-box"><input id="last_name" name="last_name" value="<?= h($billing_info->last_name) ?>" type="text" /></div>
    </li>
    
    <li class="field text left">
      <label for="email">Email Address</label>
      <div class="text-box"><input id="email" name="email" value="<?= h($billing_info->email) ?>" type="text" /></div>
    </li>
    <li class="field text right">
      <label for="phone">Phone</label>
      <div class="text-box"><input id="phone" type="text" value="<?= h($billing_info->phone) ?>" name="phone" /></div>
    </li>
  
    <li class="field text">
      <label for="street_address">Address</label>
      <div class="text-area"><textarea id="street_address" rows="2" name="street_address"><?= h($billing_info->street_address) ?></textarea></div>
    </li>
  
    <li class="field text left">
      <label for="city">City</label>
      <div class="text-box"><input id="city" type="text" name="city" value="<?= h($billing_info->city) ?>"/></div>
    </li>
    <li class="field text right">
      <label for="zip">Zip/Postal Code</label>
      <div class="text-box"><input id="zip" type="text" name="zip" value="<?= h($billing_info->zip) ?>"/></div>
    </li>
  
    <li class="field select left">
      <label for="country">Country</label>
      <select id="country" name="country" onchange="return $(this).getForm().sendRequest('shop:on_updateStateList', {
        extraFields: {
          'country': $('#country').val(), 
          'current_state': '<?= $billing_info->state ?>'
        },
        update: {'states': 'shop:states'}
      })">
      <? foreach($countries as $country): ?>
        <option <?= option_state($billing_info->country, $country->id) ?> value="<?= h($country->id) ?>"><?= h($country->name) ?></option>
      <? endforeach ?>
      </select>
    </li>
  
    <li class="field select right">
      <label for="state">State</label>
      <div>
        <select id="states" name="state">
        <?= $this->render_partial('shop:states', array('states' => $states, 'current_state' => $billing_info->state)) ?>
        </select>
      </div>
    </li>
    <? if(!$this->customer): ?>
    <li class="field text">
      <input name="register_customer" value="1" type="hidden" />
      <br />
      <h3 class="style-2">Register your account with us</h3>
    </li>
    
    <li class="field text left">
      <label for="customer_password">Password</label>
      <div class="text-box"><input autocomplete="off" id="customer_password" name="customer_password"  type="password"/></div>
    </li>
    <li class="field text right">
      <label for="customer_password_confirm">Password confirmation</label>
      <div class="text-box"><input autocomplete="off" id="customer_password_confirm" name="customer_password_confirm"  type="password"/></div>
    </li>
    <? endif ?>
  </ul>
  <? if($next_step == 'payment_method'): ?>
  <input class="button-1 right wide" type="submit" value="Next &#x2192;" onclick="return $('#billing_info').sendRequest('on_updateBilling', {
      update: {'widget-cart': 'site:widget:cart'},
      onSuccess: function() {
        LS.sendRequest('<?= root_url(Phpr::$request->getCurrentUri()) ?>', 'on_copyBillingToShipping', {
          update: {'shipping_info': 'ls_cms_page'},
          extraFields: {
            'move_to': 'shipping_info',
            'partial_step': true
          },
          onSuccess: function() {
            LS.sendRequest('<?= root_url(Phpr::$request->getCurrentUri()) ?>', 'on_action', {
              update: {'payment_method': 'ls_cms_page'},
              extraFields: {
                'skip_to': 'payment_method',
                'partial_step': true
              }
            });
          }
        });
      }
    })" />
  <? elseif($next_step == 'shipping_info'): ?>
  <script>
    LS.sendRequest('<?= root_url(Phpr::$request->getCurrentUri()) ?>', 'on_action', {
        update: {'shipping_info': 'ls_cms_page'},
        extraFields: {
          'move_to': 'shipping_info',
          'partial_step': true
        }
    });
  </script>
  <? endif ?>
<?= close_form() ?>
</div>

<div class="col-8">
<?= open_form(array('id' => $next_step)) ?>
<?= close_form() ?>
</div>