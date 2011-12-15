# ls-module-profile
Provides customer profiles for your store.

## Installation
1. Download [Profile](https://github.com/limewheel/ls-module-profile/zipball/master).
1. Create a folder named `profile` in the `modules` directory.
1. Extract all files into the `modules/profile` directory (`modules/profile/readme.md` should exist).
1. Setup your code as described in the `Usage` section. 
1. Done!

## Links

* [Marketplace](https://lemonstandapp.com/marketplace/module/profile/)
* [Discussion](http://forum.lemonstandapp.com/topic/2267-module-profile/)
* [Source](https://github.com/limewheel/ls-module-profile)

## Example

Create an account in the [Utility theme](http://themes.lemonstandapp.com/utility/), and navigate to the top-right My Account area.

## Usage
The usage code is only applicable to the jQuery frontend JavaScript library. You will need to take considerations to convert to MooTools.

Create a `shop:states` partial with this content:

```php
<? foreach($states as $state): ?>
	<option <?= option_state($current_state, $state->id) ?> value="<?= h($state->id) ?>"><?= h($state->name) ?></option>
<? endforeach ?>
```

Create a `Account` page. For your content, use something like this:

```php
<?
extract(array_merge(array(
  'partial_step' => post('partial_step', false),
  'section' => post('section', 'change_information') //defaults to the change_information section
), $params));
?>

<? if($partial_step) { $this->render_block($section); return; } ?>

<? $this->render_block($section) ?>​
```

Go to the `Head & Blocks` tab. Create a block with name `change_account` and code:

```php
<article class="col-9">
<?= open_form() ?>
  <ul class="form">
    <li class="field text left">
      <label for="first_name">First Name <span class="required">*</span></label>
      <div class="text-box"><input id="first_name" name="first_name" type="text" value="<?= $this->customer->first_name ?>" /></div>
    </li>
    <li class="field text right">
      <label for="last_name">Last Name <span class="required">*</span></label>
      <div class="text-box"><input id="last_name" name="last_name" type="text" value="<?= $this->customer->last_name ?>" /></div>
    </li>  
    <li class="field text">
      <label for="email">Email <span class="required">*</span></label>
      <div class="text-box"><input id="email" type="text" name="email" value="<?= $this->customer->email ?>" /></div>
    </li>
  </ul>
  
  <div class="submit-box right clear-both">
    <input type="submit" onclick="return $(this).getForm().sendRequest('profile:on_updateAccount', {
      extraFields: {'no_flash': true},
      onSuccess: function() {
      }
    })" value="Save" />
  </div>
<?= close_form() ?>
</article>

<article class="col-9">
<?= open_form() ?>
  <ul class="form">
    <li class="text">
      <label for="old_password">Old Password <span class="required">*</span></label>
      <div class="text-box"><input id="old_password" type="password" name="old_password" /></div>
    </li>
    <li class="field text left">
      <label for="password">New Password <span class="required">*</span></label>
      <div class="text-box"><input id="password" type="password" name="password" /></div>
    </li>
    <li class="text right">
      <label for="password_confirm">Password Confirmation <span class="required">*</span></label>
      <div class="text-box"><input id="password_confirm" type="password" name="password_confirm" /></div>
    </li>
  </ul>
  
  <div class="submit-box right clear-both">
    <input type="submit" onclick="return $(this).getForm().sendRequest('profile:on_updatePassword', {
      extraFields: {'no_flash': true},
      onSuccess: function() {
      }
    })" value="Save" />
  </div>
<?= close_form() ?>
</article>​
```

Create a block with name `change_information` and code:

```php
<?
	$billing_info = Shop_CheckoutData::get_billing_info();
	$billing_countries = Shop_Country::get_list($billing_info->country);
	$billing_country = $billing_info->country ? $billing_info->country : $billing_countries[0]->id;
	$billing_states = Shop_CountryState::create(true)->where('country_id=?', $billing_country)->order('name')->find_all();
?>

<article class="col-9">
<?= open_form(array('id' => 'billing_info')) ?>
  <h3 class="block">Billing Information</h3>

  <ul class="form billing_info">
    <li class="text left">
      <label for="billing_first_name">First Name</label>
      <div class="text-box"><input id="billing_first_name" name="billing[first_name]" type="text" value="<?= h($billing_info->first_name) ?>" /></div>
    </li>
    <li class="text right">
      <label for="billing_last_name">Last Name</label>
      <div class="text-box"><input id="billing_last_name" name="billing[last_name]" type="text" value="<?= h($billing_info->last_name) ?>" /></div>
    </li>
  
    <li class="text left">
      <label for="billing_company">Company</label>
      <div class="text-box"><input id="billing_company" type="text" value="<?= h($billing_info->company) ?>" name="billing[company]" /></div>
    </li>
    <li class="text right">
      <label for="billing_phone">Phone</label>
      <div class="text-box"><input id="billing_phone" type="text" value="<?= h($billing_info->phone) ?>" name="billing[phone]" /></div>
    </li>

    <li class="text">
      <label for="billing_street_address">Street Address</label>
      <div class="text-area"><textarea id="billing_street_address" rows="2" name="billing[street_address]" value="<?= h($billing_info->street_address) ?>"><?= h($billing_info->street_address) ?></textarea></div>
    </li>

    <li class="text left">
      <label for="billing_city">City</label>
      <div class="text-box"><input id="billing_city" type="text" name="billing[city]" value="<?= h($billing_info->city) ?>" /></div>
    </li>
    <li class="field text right">
      <label for="billing_zip">Zip/Postal Code</label>
      <div class="text-box"><input id="billing_zip" type="text" name="billing[zip]" value="<?= h($billing_info->zip) ?>" /></div>
    </li>

    <li class="select left">
      <label for="billing_country">Country</label>
      <select id="billing_country" name="billing[country]" onchange="return $(this).getForm().sendRequest('shop:on_updateStateList', {
        extraFields: {
          'country': $('#billing_country').val(), 
          'current_state': '<?= $billing_info->state ?>'
        },
        update: {'#billing_states': 'shop:states'}
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

  <div class="submit-box right clear-both">
    <input type="submit" onclick="return $(this).getForm().sendRequest('profile:on_updateBilling', {
      extraFields: {'no_flash': true},
      onSuccess: function() {
      }
    })" value="Save" />
  </div>
<?= close_form() ?>
</article>

<article class="col-9">
<?= open_form(array('id' => 'shipping_info')) ?>
<?= close_form() ?>
</article>

<script>
  LS.sendRequest('<?= Phpr::$request->getCurrentUri() ?>', 'on_action', {
    update: {'#shipping_info': 'ls_cms_page'},
    extraFields: {
      'section': 'change_shipping',
      'partial_step': true
    }
  });
</script>​
```

Create a block with name `change_shipping` and code:

```php
<?
	$shipping_info = Shop_CheckoutData::get_shipping_info();
	$shipping_countries = Shop_Country::get_list($shipping_info->country);
	$shipping_country = $shipping_info->country ? $shipping_info->country : $shipping_countries[0]->id;
	$shipping_states = Shop_CountryState::create(true)->where('country_id=?', $shipping_country)->order('name')->find_all();
?>

  <h3 class="block left">Shipping Information <a href="javascript:;" onclick="return $('#billing_info').sendRequest('profile:on_updateBilling', {
    onSuccess: function() {
      LS.sendRequest('<?= Phpr::$request->getCurrentUri() ?>', 'profile:on_copyBillingToShipping', {
        update: {'#shipping_info': 'ls_cms_page'},
        extraFields: {
          'section': 'change_shipping',
          'partial_step': true
        },
        onSuccess: function() {
        }
      });
    }
  })">copy billing</a></h3>
    
  <ul class="form shipping_info clear-both">
    <li class="text left">
      <label for="shipping_first_name">First Name</label>
      <div class="text-box"><input id="shipping_first_name" name="shipping[first_name]" type="text" value="<?= h($shipping_info->first_name) ?>" /></div>
    </li>
    <li class="text right">
      <label for="shipping_last_name">Last Name</label>
      <div class="text-box"><input id="shipping_last_name" name="shipping[last_name]" type="text" value="<?= h($shipping_info->last_name) ?>" /></div>
    </li>
      
    <li class="text left">
      <label for="shipping_company">Company</label>
      <div class="text-box"><input id="shipping_company" type="text" value="<?= h($shipping_info->company) ?>" name="shipping[company]" /></div>
    </li>
    <li class="text right">
      <label for="shipping_phone">Phone</label>
      <div class="text-box"><input id="shipping_phone" type="text" value="<?= h($shipping_info->phone) ?>" name="shipping[phone]" /></div>
    </li>

    <li class="text">
      <label for="shipping_street_address">Street Address</label>
      <div class="text-area"><textarea rows="2" id="shipping_street_address" name="shipping[street_address]" value="<?= h($shipping_info->street_address) ?>"><?= h($shipping_info->street_address) ?></textarea></div>
    </li>

    <li class="text left">
      <label for="shipping_city">City</label>
      <div class="text-box"><input id="shipping_city" type="text" name="shipping[city]" value="<?= h($shipping_info->city) ?>"/></div>
    </li>
    <li class="text right">
      <label for="shipping_zip">Zip/Postal Code</label>
      <div class="text-box"><input id="shipping_zip" type="text" name="shipping[zip]" value="<?= h($shipping_info->zip) ?>"/></div>
    </li>

    <li class="select left">
      <label for="shipping_country">Country</label>
      <select id="shipping_country" name="shipping[country]" onchange="return $(this).getForm().sendRequest('shop:on_updateStateList', {
        update: {'#shipping_states': 'shop:states'},
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

    <li class="select right">
      <label for="shipping_states">State</label>
      <div>
        <select id="shipping_states" name="shipping[state]">
        <?= $this->render_partial('shop:states', array('states' => $shipping_states, 'current_state' => $shipping_info->state)) ?>
        </select>
      </div>
    </li>
  </ul>
  
  <div class="submit-box right clear-both">
    <input type="submit" onclick="return $(this).getForm().sendRequest('profile:on_updateShipping', {
      extraFields: {'no_flash': true},
      onSuccess: function() {
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
    
    return false;
  });
});
</script>​
```

Create a block with name `view_orders` and code:

```php
<article class="col-9">
<?= open_form() ?>
  <? if(!$orders->count): ?>
    <p>No orders yet.</p>
  <? else: ?>
    <p>Click an order for details.</p>
    
    <table>
      <thead>
        <tr>
          <th class="first"></th>
          <th>#</th>
          <th>Date</th>
          <th>Status</th>
          <th class="text-right last">Total</th>
        </tr>
      </thead>
      <tbody>
        <? foreach($orders as $order): ?>
          <? $url = root_url('/') . 'account/order/' . $order->id ?>
          <tr class="<?= zebra('order') ?>">
            <td>
              <span title="<?= h($order->status->name) ?>" style="background-color: <?= $order->color ?>">&nbsp;</span>
            </td>
            <td><a href="<?= $url ?>"><?= $order->id ?></a></td>
            <td><a href="<?= $url ?>"><?= $order->order_datetime->format('%x') ?></a></td>
            <td><a href="<?= $url ?>"><strong><?= h($order->status->name) ?></strong> since <?= $order->status_update_datetime->format('%x') ?></a></td>
            <td class="text-right last"><a href="<?= $url ?>"><?= format_currency($order->total) ?></a></th>
          </tr>
        <? endforeach ?>
      </tbody>
    </table>
  <? endif ?>
<?= close_form() ?>
</article>​
```

To navigate it all you could use a sidebar partial with this code (note: it uses `/account` for the URL, and `.page .wrap` for the page wrapper element):

```php
<h2>My Account</h2>
<ul class="categories">
  <li>
    <a href="javascript:;" onclick="return LS.sendRequest('/account', 'on_action', {
      update: {'.page .wrap': 'ls_cms_page'},
      extraFields: {'section': 'change_information'}
    })">Change Information</a>
  </li>
  
  <li>
    <a href="javascript:;" onclick="return LS.sendRequest('/account', 'on_action', {
      update: {'.page .wrap': 'ls_cms_page'},
      extraFields: {'section': 'change_account'}
    })">Change Account</a>
  </li>

  <li>
    <a href="javascript:;" onclick="return LS.sendRequest('/account/orders', 'on_action', {
      update: {'.page .wrap': 'ls_cms_page'}
    })">View Orders</a>
  </li>
</ul>​
```
