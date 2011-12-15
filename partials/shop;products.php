<?
extract(array_merge(array(
  'list' => array(),
  'use_list_classes' => true,
  'list_default_class' => '',
  'list_parent_class' => '',
  'list_parent_id' => '',
  'list_child_class' => '',
  'show_list_markup' => true,
  'force_discounted' => false
), $params));
?>

<ul class="style-2 clearfix">
<?
$items = $products instanceof Db_ActiveRecord ? $products->find_all() : $products;

foreach($items as $product): 
  $title_max_length = $site_settings->product_frontpage_item->max_title_length;
  $title = strlen(h($product->name)) > $title_max_length ? trim(substr(h($product->name), 0, $title_max_length)) . '...' : h($product->name);
  $description_max_length = $site_settings->product_frontpage_item->max_description_length;
  $description = strlen(h($product->short_description)) > $description_max_length ? trim(substr(h($product->short_description), 0, $description_max_length)) . '...' : h($product->short_description);
  $is_discounted = $product->is_discounted();
  $price = format_currency($is_discounted ? $product->get_discounted_price(1) : $product->price());
  $format = substr($price, 0, 1);
  $price = substr($price, 1);
  $is_special = false;
  $url = $product->page_url($site_settings->store->product_path);

  foreach($product->properties as $attribute)
    if($attribute->name == 'special')
      $is_special = true;
?>
  <li>
  <? if($style == 1): ?>
    <? 
    $width = $site_settings->product_category_item->image->width;
    $height = $site_settings->product_category_item->image->height;
    $image_url = $product->image_url(0, $width, $height, true);
    $title_max_length = $site_settings->product_category_item->max_title_length;
    $title = strlen(h($product->name)) > $title_max_length ? trim(substr(h($product->name), 0, $title_max_length)) . '...' : h($product->name);
      
    if(!$image_url)
      $image_url = theme_resource_url($site_settings->product_category_item->default_thumb_path);
    ?>
    <a class="product-frontpage-item" href="<?= $url ?>" title="<?= h($product->name) ?>">
      <img src="<?= $image_url ?>" width="<?= $width ?>" height="<?= $height ?>" />
      <span class="title"><?= $title ?></span>
      <span class="price <? if($is_discounted || $force_discounted): ?>discounted<? endif ?>"><?= $format ?><?= $price ?></span>
    </a>
  <? elseif($style == 2): ?>
    <? 
    $title_max_length = $site_settings->product_category_item->max_title_length;
    $title = strlen(h($product->name)) > $title_max_length ? trim(substr(h($product->name), 0, $title_max_length)) . '...' : h($product->name);
    $width = $site_settings->product_category_item->image->width;
    $height = $site_settings->product_category_item->image->height;
    $image_url = $product->image_url(0, $width, $height, true);
    
    if(!$image_url)
      $image_url = theme_resource_url($site_settings->product_category_item->default_thumb_path);
    ?>
    <div class="product-category-item col-4">
      <?= open_form() ?>
        <input type="hidden" name="product_id" value="<?= $product->id ?>" />
        <input type="hidden" name="product_cart_quantity" value="1" />
        
        <a href="<?= $url ?>" title="<?= $title ?>" class="clearfix">
          <img src="<?= $image_url ?>" alt="<?= $title ?>" width="<?= $width ?>" height="<?= $height ?>" />
        </a>
        <ul class="style-8 clearfix">
          <li>
            <p><?= h($product->category_list[0]->name) ?></p>
            <h4><a href="<?= $url ?>" title="<?= h($product->name) ?>"><?= $title ?></a></h4>
            <span class="price"><span class="format"><?= $format ?></span><? if($is_discounted): ?><img class="discount" src="<?= root_url($site_settings->product_frontpage_item->discount_path) ?>" /><? endif ?><?= $price ?></span>
          </li>
          
          <? foreach($product->properties as $attribute): ?>
            <? if($attribute->name == 'special') continue ?>
            <li>
              <strong><?= h($attribute->name) ?>:</strong>
              <?= h($attribute->value) ?>
            </li>
          <? endforeach ?>
          
          <li class="last text-center clearfix">
            <a class="button-1" href="javascript:;" onclick="$(this).getForm().sendRequest('shop:on_addToCart', {
              update: {'widget-cart': 'site:widget:cart'}, 
              extraFields: {'no_flash': true},
              onAfterUpdate: function() { 
                site.message.addToCart();
              }
            })">ADD TO CART</a>
          </li>
        </ul>
      <?= close_form() ?>
    </div>
  <? elseif($style == 3): ?>
    <? 
    $width = $site_settings->product_related_item->image->width;
    $height = $site_settings->product_related_item->image->height;
    $image_url = $product->image_url(0, $width, $height, true);
    
    if(!$image_url)
      $image_url = theme_resource_url($site_settings->product_related_item->default_thumb_path);
    ?>
    <a class="product-related-item" href="<?= $url ?>" title="<?= h($product->name) ?>" class="clearfix"><? if($is_special): ?><span class="special"></span><? endif ?><img src="<?= $image_url ?>" width="<?= $width ?>" height="<?= $height ?>" /></a>
  <? elseif($style == 5): ?>
    <? 
    $width = $site_settings->product_compared_item->image->width;
    $height = $site_settings->product_compared_item->image->height;
    $image_url = $product->image_url(0, $width, $height, true);
    $title_max_length = $site_settings->product_compared_item->max_title_length;
    $title = strlen(h($product->name)) > $title_max_length ? trim(substr(h($product->name), 0, $title_max_length)) . '...' : h($product->name);
    
    if(!$image_url)
      $image_url = theme_resource_url($site_settings->product_compared_item->default_thumb_path);
    ?>
    <div class="product-compared-item">
    <?
    $attributes = $item->attributes;
    ?>
      <a href="<?= $url ?>" title="<?= h($product->name) ?>">
        <img src="<?= $image_url ?>" alt="<?= $title ?>" width="<?= $width ?>" height="<?= $height ?>" />
      </a>
    
      <h2><a href="<?= $url ?>" title="<?= h($product->name) ?>"><?= $title ?></a></h2>
      
      <? foreach($attributes as $attribute): ?>
         <?= h($attribute) ?>
      <? endforeach ?>
      
      <p><?= $product->description ?></p>
      
      <a href="javascript:;" onclick="return $(this).getForm().sendRequest('shop:on_addToCart', {
        update: {'widget-cart': 'site:widget:cart'},
        extraFields: {'product_id': '<?= $product->id ?>', 'no_flash': true}, 
        onSuccess: function() { 
          site.message.addToCart();
        }
      })">Add To Cart</a>
    </div>
  <? endif?>
  </li>
<? endforeach ?>
</ul>