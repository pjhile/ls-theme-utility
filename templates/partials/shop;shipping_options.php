<?
extract(array_merge(array(
  'shipping_options' => array(),
  'sales_email' => $site_settings->company->sales_email
), $params, $this->data));
?>

<? if(!count($shipping_options)): ?>
  <p>There are no shipping options available for your location. Please contact our sales department: <a href="mailto:<?= $sales_email ?>"><?= $sales_email ?></a>.</p>
<? return ?>
<? endif ?>

<ul>
<? foreach($shipping_options as $option): ?>
<? if($option->multi_option): ?>
  <li>
    <h4><?= h($option->name) ?></h4>
    
    <? if($option->description): ?>
      <p><?= h($option->description) ?></p>
    <? endif ?>
    <ul>
    <? foreach($option->sub_options as $sub_option): ?>
      <li>
        <?= h($sub_option->name) ?> - <strong><?= !$sub_option->is_free ? format_currency($sub_option->quote) : 'free' ?></strong>
      </li>
    <? endforeach ?>
    </ul>
  </li>
<? else: ?>
  <li>
    <?= h($option->name) ?> - <strong><?= !$option->is_free ? format_currency($option->quote) : 'free' ?></strong>
    
  <? if($option->description): ?>
    <p><?= h($option->description) ?></p>
  <? endif ?>
  </li>
<? endif ?>
<? endforeach ?>
</ul>