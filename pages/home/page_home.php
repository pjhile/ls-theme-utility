<div id="cycle" class="clearfix">
<? 
$group = Shop_CustomGroup::create()->find_by_code('frontpage');

if($group):
  $products = $group->list_products()->limit(9)->apply_filters()->find_all();
?>

<? foreach($products as $i => $product):
    $title_max_length = $site_settings->product_frontpage_item->max_title_length;
    $title = strlen(h($product->name)) > $title_max_length ? trim(substr(h($product->name), 0, $title_max_length)) . '...' : h($product->name);
    $url = $product->page_url($site_settings->store->product_path);
    $width = $site_settings->product_frontpage_item->image->width;
    $height = $site_settings->product_frontpage_item->image->height;
    $image_url = $product->image_url(0, $width, $height, true);
    
    if($image_url)
    	$image_url = root_url($image_url);
    else
      $image_url = theme_resource_url($site_settings->product_frontpage_item->default_thumb_path);
  ?>
  <? if($i % 3 == 0): ?>
    <ul class="style-11 left">
  <? endif ?>
      <li>
        <a href="<?= $url ?>" title="<?= $title ?>">
          <img src="<?= $image_url ?>" width="<?= $width ?>" height="<?= $height ?>" />
          <h3><?= $title ?></h3>
        </a>
      </li>
  <? if($i % 3 == 2): ?>
    </ul>
  <? endif ?>
  <? endforeach ?>
<? endif ?>
</div>
<div id="cycle-pagination"></div>

<div class="col-12">
<? $group = Shop_CustomGroup::create()->find_by_code('featured') ?>
<? if($group): ?>
  <h3><?= h($group->name) ?></h3>
  
  <? $this->render_partial('shop:products', array(
    'style' => 1,
    'products' => $group->list_products()->limit(4)->apply_filters()
  )) ?>
<? endif ?>
  
<? $group = Shop_CustomGroup::create()->find_by_code('sale') ?>
<? if($group): ?>
  <h3><?= h($group->name) ?></h3>
  
  <? $this->render_partial('shop:products', array(
    'style' => 1,
    'products' => $group->list_products()->limit(4)->apply_filters()
  )) ?>
<? endif ?>
</div>

<div class="col-4">
  <a class="box-2 top clearfix" href="<?= root_url('/') ?>gallery/" style="width: 220px; height: 295px;">
    <h3>Visit The Gallery</h3>
    <img src="<?= theme_resource_url('images/frontpage-gallery.png') ?>" width="220" height="295" />
  </a>
  
  <h3>Newsletter Signup</h3>
  <p>For product news, special offers and more signup for our newsletter</p>
  
  <form class="clearfix newsletter-form" method="post" action="">
    <div class="text-box left">
      <input class="inputify" name="email" type="text" size="20" value="<?= $site_settings->customer->default_email ?>" />
    </div>
    <input class="button-2 left" type="submit" name="subscribe" value="SIGN UP" />
  </form>
</div>