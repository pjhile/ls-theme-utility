<?
extract(array_merge(array(
  'sales_email' => $site_settings->company->sales_email,
  'payment_method' => null
), $params, $this->data));
?>

<div class="col-8">
<?= open_form(array('id' => 'shipping_method')) ?>
  <h3 class="style-2">Shipping Method</h3>
  
  <? if(!count($shipping_options)): ?>
    <p>There are no shipping options available for your location. Please contact our sales department: <a href="mailto:<?= $sales_email ?>"><?= $sales_email ?></a>.</p>
    <? return ?>
  <? endif ?>
  
  <ul class="form clearfix">
    <? foreach($shipping_options as $option): ?>
      <? if($option->ls_api_code == 'no_shipping_required') continue ?>
      <? if($option->multi_option): ?>
        <h4><?= h($option->name) ?></h4>
        
        <? if($option->description): ?>
          <p><?= h($option->description) ?></p>
        <? endif ?>
        
        <ul>
        <? foreach($option->sub_options as $sub_option): ?>
          <li class="field checkbox">
            <div>
              <input id="option<?= $sub_option->id ?>" <?= radio_state($option->id == $shipping_method->id && $sub_option->id == $shipping_method->sub_option_id) ?> type="radio" name="shipping_option" value="<?= $sub_option->id ?>" />
            </div>
            <label for="option<?=  $sub_option->id ?>">
              <?= h($sub_option->name) ?> - <strong><?= !$sub_option->is_free ? format_currency($sub_option->quote) : 'free' ?></strong>
            </label>
          </li>
        <? endforeach ?>
        </ul>
      <? else: ?>
        <li class="field checkbox">
          <div><input <?= radio_state($option->id == $shipping_method->id) ?> id="option<?= $option->id ?>" type="radio" name="shipping_option" value="<?= $option->id ?>"/></div>
          <label for="option<?= $option->id ?>">
            <?= h($option->name) ?> - <strong><?= !$option->is_free ? format_currency($option->quote) : 'free' ?></strong>
            <? if($option->description): ?>
              <span class="comment"><?= h($option->description) ?></span>
            <? endif ?>
          </label>
        </li>
      <? endif ?>
    <? endforeach ?>
  </ul>
  <script>
    $('#shipping_method input[type=radio]').click(function() {
      $('#shipping_method').sendRequest('on_action', {
        update: {'payment_method': 'ls_cms_page'},
        extraFields: {
          'checkout_step': 'shipping_method',
          'skip_to': 'payment_method',
          'partial_step': true
        }
      });
    });
  </script>
<?= close_form() ?>
</div>

<div class="col-8">
  <?= open_form(array('id' => 'payment_method')) ?>
  <h3 class="style-2">Payment Method</h3>
  
  <? if($payment_method->name): ?>
    <p>
      <?= h($payment_method->name) ?> 
      (<a href="javascript:;" onclick="return $('#shipping_method').sendRequest('on_action', {
        update: {'payment_method': 'ls_cms_page'},
        extraFields: {
          'checkout_step': 'shipping_method',
          'skip_to': 'payment_method',
          'partial_step': true
        }
      })">change</a>)
    </p>
  
    <input class="button-1 right wide" type="submit" value="Next &#x2192;" onclick="return $('#payment_method').sendRequest('on_action', {
      update: {'page': 'ls_cms_page'},
      extraFields: {
        'skip_to': 'review'
      }
    })" />
  <? else: ?>
    <p>Please choose a shipping method first.</p>
  <? endif ?>
  <?= close_form() ?>
</div>