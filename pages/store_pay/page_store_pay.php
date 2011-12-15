<h1>Pay</h1>

<div class="col-12 box-1">
<? if(!$order): ?>
  <p>Order not found.</p>
<? return ?>
<? elseif($order->payment_processed()): ?>
  <p>This order is already paid. Thank you!</p>
<? return ?>
<? endif ?>
  
  <ul class="clearfix">
    <li>
      <p>Order Number: <strong><?= $order->id ?></strong></p>
    </li>
    <li>
      <p>Total: <strong><?= format_currency($order->total) ?></strong></p>
    </li>
    <li class="last">
      <p>Payment method: <strong><?= h($payment_method->name) ?></strong></p>
    </li>
  </ul>

<? if($order->payment_method->has_payment_form()): ?>
  <div class="payment-form">
    <? $payment_method->render_payment_form($this) ?>
  </div>
<? else: ?>
  <? if($message = $payment_method->pay_offline_message()): ?>
    <p><?= h($message) ?></p>    
  <? else: ?>
    <p>Payment method "<?= h($payment_method->name) ?>" has no payment form. Please pay and notify us.</p>    
  <? endif ?>
  <p class="no-print"><a href="<?= root_url('/') ?>">&raquo; Continue shopping...</a></p>
<? endif ?> 
</div>