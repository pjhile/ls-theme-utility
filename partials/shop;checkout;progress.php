<?
  if(Shop_CheckoutData::shipping_required()) {
    $steps = array(
      'billing_info' => '1. Billing & Shipping Info',
      'shipping_method' => '2. Payment & Shipping Method',
      'review' => '3. Review & Pay'
    );
  }
  else {
    $steps = array(
      'billing_info' => '1. Billing Info & Method',
      'review' => '2. Review & Pay'
    );
  }
?>

<ul class="style-10 margin-center">
<?

foreach($steps as $step => $name)
  $steps2[] = array($step, $name);

$is_after_current = false;

foreach($steps2 as $i => $step):
  $key = $step[0]; 
  $name = $step[1];
  $l = count($steps2);
  $is_current = ($checkout_step == $key);
  $is_first = ($i == 0);
  $is_inactive = $i < 
  $is_last = ($i == count($steps2) - 1);
  $is_previous_current = ($i < $l - 1) ? ($checkout_step == $steps2[$i + 1][0]) ? true : false : false;
  $is_after_current = $is_after_current || $is_current;
  
  $classes = array();
  
  if($is_current)
    $classes[] = 'active';
    
  if($is_first)
    $classes[] = 'first';
  
  if($is_last)
    $classes[] = 'last';
  
  if($is_previous_current)
    $classes[] = 'previous-active';
    
  if(!$is_after_current)
    $classes[] = 'inactive';
?>
  <? if($is_current): ?>
    <li class="<?= implode(' ', $classes) ?>">
      <p><?= h($name) ?></p>
    </li>
  <? else: ?>
    <li class="<?= implode(' ', $classes) ?>">
    <? if($is_after_current): ?>
      <p><?= h($name) ?></p>
    <? else: ?>
      <p><a href="javascript:;" onclick="return LS.sendRequest('<?= Phpr::$request->getCurrentUri() ?>', 'on_action', {
        update: {'page': 'ls_cms_page', 'widget-cart': 'site:widget:cart'}, 
        extraFields: {'move_to': '<?= $key ?>'}
      })"><?= h($name) ?></a></p>
    <? endif ?>
    </li>
  <? endif ?>
<?
  if($is_current)
     $is_after_current = true;
?>
<? endforeach ?>
  <li class="estimate">
    <strong>Estimated total</strong>
    <br />
    <?= format_currency($estimated_total) ?>
  </li>
  <li class="billing">
    <? if($billing_info->first_name): ?>
    <span class="color-3">Bill to:</span> 
      <?= $billing_info->first_name ?> <?= $billing_info->last_name ?>,
      <?= $billing_info->street_address ?>,
      <?= $billing_info->city ?>,
      <?= Shop_CountryState::create()->find($billing_info->state)->name ?>,
      <?= $billing_info->zip ?>
    <? endif ?>
    <? if(Shop_CheckoutData::shipping_required() && $shipping_info->first_name): ?>
	    <br />
	    <span class="color-3">Ship to:</span>
      <?= $shipping_info->first_name ?> <?= $shipping_info->last_name ?>,
      <?= $shipping_info->street_address ?>, 
      <?= $shipping_info->city ?>,
      <?= Shop_CountryState::create()->find($shipping_info->state)->name ?>,
      <?= $shipping_info->zip ?>
	  <? endif ?>
  </li>
</ul>