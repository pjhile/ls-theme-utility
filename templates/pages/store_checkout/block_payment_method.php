<?
$sales_email = $site_settings->company->sales_email;
?>

<h3 class="style-2">Payment Method</h3>

<? if(!count($payment_methods)): ?>
  <p>There are no payment methods available for your location. Please contact our sales department: <a href="mailto:<?= $sales_email ?>"><?= $sales_email ?></a>.</p>
  <? return ?>
<? endif ?>

<p>Please select payment method.</p>

<ul class="form clearfix">
<? foreach($payment_methods as $method): ?>
  <li class="field checkbox">
    <div><input <?= radio_state($method->id == $payment_method->id) ?> id="method<?= $method->id ?>" type="radio" name="payment_method" value="<?= $method->id ?>" /></div>
    <label for="method<?= $method->id ?>">
    <?= h($method->name) ?>
    <? if($method->description): ?>
      <span class="comment"><?= h($method->description) ?></span>
    <? endif ?>
    </label>
  </li>
<? endforeach ?>
</ul>

<input class="button-1 right wide" type="submit" value="Next &#x2192;" onclick="return $('#payment_method').sendRequest('on_action', {
  update: {'page': 'ls_cms_page'},
  extraFields: {
    'skip_to': 'review'
  }
})" />

<script>
  $('#payment_method input[type=radio]').click(function() {
    return $('#payment_method').sendRequest('on_action', {
      update: {'payment_method': 'ls_cms_page'},
      extraFields: {
        'checkout_step': 'payment_method',
        'skip_to': 'payment_method',
        'partial_step': true
      }
    });
  });
</script>