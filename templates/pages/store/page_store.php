<div class="col-12">
  <? $group = Shop_CustomGroup::create()->find_by_code('featured') ?>
  <h3><?= h($group->name) ?></h3>
  
  <? $this->render_partial('shop:products', array(
    'style' => 1,
    'products' => $group->list_products()->limit(8)->apply_filters()
  )) ?>
  
  <? $group = Shop_CustomGroup::create()->find_by_code('sale') ?>
  <h3><?= h($group->name) ?></h3>
  
  <? $this->render_partial('shop:products', array(
    'style' => 1,
    'force_discounted' => true,
    'products' => $group->list_products()->limit(8)->apply_filters()
  )) ?>
</div>