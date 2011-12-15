<?
extract(array_merge(array(
  'bill_to_str' => $billing_info->as_string(),
  'ship_to_str' => $shipping_info->as_string(),
  'items' => Shop_Cart::list_active_items(),
  'subtotal' => 0,
  'product_taxes' => array(),
  'discount' => 0,
  'shipping_quote' => 0,
  'shipping_taxes' => array(),
  'total' => 0,
  'checkout_step' => 'review',
  'order_hash' => post('order_hash', null)
), $this->data, $params));
?>

<div class="col-16">
<? if(!$order_hash): ?>
  <h3 class="style-2">Order Review</h3>
  
  <table class="style-1">
    <thead>
      <tr>
        <th class="first">Items</th>
        <th class="text-right">Quantity</th>
        <th class="text-right">Price</th>
        <th class="text-right">Discount</th>
        <th class="last text-right">Total</th>
      </tr>
    </thead>
    <tbody>
    <? 
    foreach($items as $item): 
      $options_str = $item->options_str();
    ?>
      <tr>
        <td class="first">
          <p>
            <strong><?= h($item->product->name) ?></strong>
            <? if(strlen($options_str)): ?>
              <br /><?= h($options_str) ?>.
            <? endif ?>
            <? if($item->extra_options): ?>
              <? foreach($item->extra_options as $option): ?>
                <br />
                + <?= h($option->description) ?>:
                <?= format_currency($option->get_price($item->product)) ?>
              <? endforeach ?>
            <? endif ?>
          </p>
        </td>
        <td class="text-right"><?= $item->quantity ?></td>
        <td class="text-right"><?= format_currency($item->single_price()) ?></td>
        <td class="text-right"><?= format_currency($item->total_discount()) ?></td>
        <td class="last text-right"><?= format_currency($item->total_price()) ?></td>
      </tr>
    <? endforeach ?>
    </tbody>
  </table>
  
  <table class="col-4 style-2 right">
    <tr>
      <td>Subtotal:</td>
      <td class="last"><?= format_currency($subtotal) ?></td>
    </tr>
    <tr>
      <td>Discount:</td>
      <td><?= format_currency($discount) ?></td>
    </tr>
    <? foreach($product_taxes as $tax): ?>
      <tr>
        <td>Sales tax (<?= $tax->name ?>):</td>
        <td><?= format_currency($tax->total) ?></td>
      </tr>
    <? endforeach ?>
    <tr>
      <td>Shipping:</td>
      <td><?= format_currency($shipping_quote) ?></td>
    </tr>
    <? foreach($shipping_taxes as $tax): ?>
      <tr>
        <td>Shipping tax (<?= $tax->name ?>):</td>
        <td><?= format_currency($tax->rate) ?></td>
      </tr>
    <? endforeach ?>
  </table>
  
  <ul class="right text-right clear">
    <li class="last">
      <p class="color-4">
        Total<br />
        <span class="price block"><?= format_currency($total) ?></span>
      </p>
    </li>
  </ul>

  <?
  $_POST['customer_auto_login'] = true;
  $_POST['register_customer'] = true;
  
  $order = Shop_CheckoutData::place_order($this->customer, post('register_customer', false), post('cart_name', 'main'), post('empty_cart', false));
  
  $payment_method = $order->payment_method;
  
  if(!$payment_method)
    throw new Cms_Exception('The selected payment method is not found');
  
  $payment_method->define_form_fields();
  $payment_method_obj = $payment_method->get_paymenttype_object();

  $this->data['payment_method'] = $payment_method;
  $this->data['payment_method_obj'] = $payment_method_obj;
  $this->data['order'] = $order;
  ?>
  
  <h3 class="style-2 clear clearfix left">Payment</h3>
  
  <div class="wrap-12 box-1 clear">
    <div class="col-12">
    <? if(!$order): ?>
      <p>Order not found.</p>
    <? else: ?>
      <? if($order->payment_processed()): ?>
        <p>This order is already paid. Thank you!</p>
      <? else: ?>
        <p>
          <strong>Order:</strong> 
          # <?= $order->id ?><br />
          <strong>Payment method:</strong> 
          <?= h($payment_method->name) ?>
        </p>
        
        <input type="hidden" name="checkout_step" value="pay" />
        <input type="hidden" name="cms_update_elements[page]" value="ls_cms_page" />
        <input type="hidden" name="order_hash" value="<?= $order->order_hash ?>" />
        <input type="hidden" name="submit_payment" value="yes" />
      
        <? if($payment_method->has_payment_form()): ?>
          <div class="payment-form">
            <?
              $_SERVER['REQUEST_URI'] = root_url($site_settings->store->pay_path . '/' . $order->order_hash); // braintree hack
              $payment_method->render_payment_form($this);
            ?>
          </div>
        <? else: ?>
          <? if($message = $payment_method->pay_offline_message()): ?>
            <p><?= h($message) ?></p>    
          <? else: ?>
            <p>Payment method "<?= h($payment_method->name) ?>" has no payment form. Please pay and notify us.</p>    
          <? endif ?>
          <p class="no-print"><a href="<?= root_url('/') ?>/" class="button-3">Continue shopping...</a></p>
        <? endif ?> 
      <? endif ?>
    <? endif ?>
    </div>
  </div>
<? else: ?>
  <?
  $order = Shop_Order::create()->find_by_order_hash($order_hash);
  
  if(!$order || !$order->payment_method)
    return;
  
  $order->payment_method->define_form_fields();
  
  $payment_method_obj = $order->payment_method->get_paymenttype_object();
  $payment_method_obj->process_payment_form($_POST, $order->payment_method, $order);
  
  $return_page = $order->payment_method->receipt_page;
  ?>
<? endif ?>
</div>