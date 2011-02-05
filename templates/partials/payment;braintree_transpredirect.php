<p>Please provide your credit card information.</p>

<form action="<?= $payment_method_obj->get_form_action($payment_method, $order) ?>" method="post">
  <?= flash_message() ?>
  <ul class="form clearfix">
    <li class="field text left">
      <label for="CNAME">Cardholder Name</label>
      <div class="text-box"><input autocomplete="off" name="transaction[credit_card][cardholder_name]" value="<?= $payment_method_obj->get_field_value('transaction[credit_card][cardholder_name]') ?>" id="CNAME" type="text" class="text"/></div>
    </li>    
    
    <li class="field text right">
      <label for="ACCT">Credit Card Number</label>
      <div class="text-box"><input autocomplete="off" name="transaction[credit_card][number]" value="<?= $payment_method_obj->get_field_value('transaction[credit_card][number]') ?>" id="ACCT" type="text" class="text"/></div>
    </li>

    <li class="field text left">
      <label for="EXPDATE">Expiration Date (MM/YY)</label>
      <div class="text-box"><input autocomplete="off" name="transaction[credit_card][expiration_date]" value="<?= $payment_method_obj->get_field_value('transaction[credit_card][expiration_date]') ?>" id="EXPDATE" type="text" class="text" maxchars=4/></div>
    </li>

    <li class="field text right">
      <label for="CVV">
        Card Verification Value (CVV)
      </label>
      
      <div class="text-box"><input autocomplete="off" name="transaction[credit_card][cvv]" value="<?= $payment_method_obj->get_field_value('transaction[credit_card][cvv]') ?>" id="CVV" type="text" class="text"/></div>
    </li>
  </ul>
<?
$hidden_fields = $payment_method_obj->get_hidden_fields($payment_method, $order);
foreach($hidden_fields as $name=>$value):
?>
  <input type="hidden" name="<?= $name ?>" value="<?= h($value) ?>"/>
<? endforeach ?>
  <input class="button-1" type="submit" value="Complete Order &#x2192;"/>
</form>