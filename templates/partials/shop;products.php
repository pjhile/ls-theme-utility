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
    <? 
    $width = $site_settings->product_category_item->image->width;
    $height = $site_settings->product_category_item->image->height;
    $image_url = $product->image_url(0, $width, $height, true);
    $title_max_length = $site_settings->product_category_item->max_title_length;
    $title = strlen(h($product->name)) > $title_max_length ? trim(substr(h($product->name), 0, $title_max_length)) . '...' : h($product->name);
      
    if(!$image_url)
      $image_url = root_url($site_settings->product_category_item->default_thumb_path);
    ?>
    <a class="product-frontpage-item" href="<?= $url ?>" title="<?= h($product->name) ?>">
      <img src="<?= $image_url ?>" width="<?= $width ?>" height="<?= $height ?>" />
      <span class="title"><?= $title ?></span>
      <span class="price <? if($is_discounted || $force_discounted): ?>discounted<? endif ?>"><?= $format ?><?= $price ?></span>
    </a>
  </li>
<? endforeach ?>
</ul>