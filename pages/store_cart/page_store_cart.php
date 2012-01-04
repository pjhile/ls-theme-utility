<?
$shipping_method = Shop_CheckoutData::get_shipping_method();

if(!$shipping_method->id)
  $shipping_method = null;

$active_items = Shop_Cart::list_active_items();
$postponed_items = Shop_Cart::list_postponed_items();
$shipping_cost = $shipping_method ? $shipping_method->quote : 0;

if($shipping_method)
  $estimated_total += $shipping_cost;

$zip = $shipping_info->zip ? h($shipping_info->zip) : 'Zip Code';
?>

<h1>Cart</h1>

<div class="col-12 box-1">
<? if(!$active_items): ?>
  <p>Your cart is empty.</p>
  <p><a class="color-1" href="<?= root_url($site_settings->store->path) ?>">&raquo; Continue shopping...</a></p>
<? return ?>
<? endif ?>
  <?= open_form() ?>
    <input type="hidden" name="redirect" value="<?= root_url($site_settings->store->checkout_path) ?>/" />
    
    <? $this->render_partial('shop:cart:items', array('items' => $active_items)) ?>
    
    <table class="style-2 right clearfix">
      <tr>
        <td class="text-right">Sub Total:</td>
        <td class="text-right"><?= format_currency($cart_total) ?></td>
      </tr>
     <? if($shipping_method): ?>
      <tr>
        <td class="text-right">Shipping:</td>
        <td class="text-right"><?= format_currency($shipping_cost) ?></td>
      </tr>
     <? endif ?>
    </table>
    <br clear="both" /><br />
    <p class="color-4 clearfix clear text-right">
      Estimated Total<br />
      <span class="price block text-right"><?= format_currency($estimated_total) ?></span>
    </p>
    <p class="border-1 clearfix clear text-right">
      <em>* Shipping cost and taxes will be evaluated during the checkout process.</em>
    </p>
    
    <div class="clear border-1">
      <p><a class="color-1 block slidify" href="javascript:;" rel="#shipping-box"><em>&raquo; Estimate Shipping</em></a></p>

      <div id="shipping-box" class="clearfix clear hide">
        <div class="col-6 p-10">
          <select id="country" name="country" onchange="return $(this).getForm().sendRequest('shop:on_updateStateList', {
            update: {'states': 'shop:states'},
            extraFields: {
              'country': $('#country').val(),
              'current_state': <?= $shipping_info->state ? $shipping_info->state : 0 ?>
            }
          })">
          <? foreach($countries as $country): ?>
            <option value="<?= $country->id ?>" <?= option_state($country->id, $shipping_info->country) ?>><?= h($country->name) ?></option>
          <? endforeach ?>
          </select>
          
          <select id="states" name="state">
            <?= $this->render_partial('shop:states', array(
              'states' => $states, 
              'current_state' => $shipping_info->state
            )) ?>
          </select>
          <br clear="both" /><br />
          <div class="text-box left">
            <input type="text" name="zip" value="<?= $zip ?>" size="8" />
          </div>
          
          <a class="button-1 left" href="javascript:;" onclick="return $(this).getForm().sendRequest('shop:on_evalShippingRate', {
            update: {'shipping-options': 'shop:shipping_options'},
            onSuccess: function() {
              site.message.updateShippingEstimated();
            }
          })">Calculate shipping</a>
        </div>
        <div id="shipping-options" class="col-3 left">
        </div>
      </div>
    </div>

    <div class="clear clearfix border-1 p-10">
        <label class="left" for="coupon-code">Do you have a coupon?</label>
        <div class="text-box left">
          <input id="coupon-code" type="text" name="coupon" value="" size="7" onkeyup="event.keyCode == 13 ? $(this).getForm().sendRequest('on_action', {
            update: {
              'page': 'ls_cms_page', 
              'site-widget-cart': 'site:widget:cart'
            },
            onSuccess: function() {
              site.message.setCouponCode();
            }
          })" />
        </div>
    </div>
  <br clear="both" /><br />
    <div class="left submit-box">
        <a href="javascript:;" title="Apply Changes" onclick="return $(this).getForm().sendRequest('on_action', {
          update: {
            'page': 'ls_cms_page', 
            'widget-cart': 'site:widget:cart'
          },
          onSuccess: function() {
            site.message.updateCart();
          }
        })">Apply Changes</a>
    </div>
  
    <div class="right">
      <a class="button-1" href="javascript:;" title="Checkout" onclick="return $(this).getForm().sendRequest('shop:on_setCouponCode')">Checkout</a>
    </div>
  <?= close_form() ?>
</div>