<?
extract(array_merge(array(
  'partial_step' => post('partial_step', false)
), $params));
?>

<? if($partial_step) { $this->render_block($checkout_step); return; } ?>

<div class="wrap-16 box-1">
<? if(Shop_Cart::get_item_total_num() != 0): ?>
  <div class="col-16">
    <? $this->render_partial('shop:checkout:progress') ?>
  </div>
  
  <div id="checkout_step">
    <? $this->render_block($checkout_step) ?>
  </div>
<? else: ?>
  <div class="col-16">
    <p>Your shopping cart is empty.</p>
    <p><a class="button-1" href="<?= root_url('/') ?>" title="Back to home">Continue Shopping</a></p>
  </div>
<? endif ?>
</div>