<? if(!$product): ?>
  <h2>We are sorry, that product was not found.</h2>
<? return ?>
<? elseif($product_unavailable): ?>
  <h2>We are sorry, that product is unavailable.</h2>
<? return ?>
<? endif ?>

<?
$title = h($product->name);
$is_discounted = $product->is_discounted();
$is_in_stock = !$product->is_out_of_stock();
$related_products = $product->list_related_products()->find_all()->as_array();
$option_list = $product->options->as_array();
$attribute_list = $product->properties->as_array();
$product_price = $price = format_currency($is_discounted ? $product->get_discounted_price(1) : $product->price(), 0);

extract((array) $site_settings->product_detailed_item->image);
?>

<?= open_form() ?>
  <input type="hidden" name="product_id" value="<?= $product->id ?>" />
  
  <div class="product-detailed-item wrap-12">
    <div class="col-12">
      <div class="breadcrumb">
        <?
        $categories = array();
        
        ?>
        <? $this->render_partial('shop:categories', array(
          'list' => $product->category_list[0]->get_parents(true), 
          'show_item_children' => false,
          'list_default_class' => 'style-3',
          'item_first_class' => '',
          'item_delimiter' => '->',
          'show_item_delimiter' => true,
          'list_prepend_html' => '<li class="first"><a href="' . root_url('/') . '">Home</a></li><li><a href="' . root_url('/') . 'store/">Store</a></li>'
        )) ?>
      </div>
    </div>
    <div class="gallery col-6 left">
    <?
    $medium_url = theme_resource_url($site_settings->product_detailed_item->default_thumb_path);
    $images = $product->images;
    
    if($images instanceof Db_DataCollection)
      $images = $images->as_array();
    
    if(count($images)):
      $image_description = strlen($images[0]->description) ? h($images[0]->description) : $title;
      $medium_url = $images[0]->getThumbnailPath($medium_width, $medium_height, true);
      $large_url = $images[0]->getThumbnailPath($large_width, $large_height, true);
    ?>
      <a id="gallery-viewport" class="cloud-zoom" href="<?= $large_url ?>" rel="position: 'right', showTitle: false, zoomWidth: 360, zoomHeight: 255">
        <img src="<?= $medium_url ?>" alt="<?= $image_description ?>" width="<?= $medium_width ?>" height="<?= $medium_height ?>" />
        <img class="magnify" src="<?= theme_resource_url('images/icon-magnifier.png') ?>" />
      </a>
    <? else: ?>
      <img src="<?= $medium_url ?>" alt="<?= $title ?>" width="<?= $medium_width ?>" height="<?= $medium_height ?>" />
    <? endif ?>
    
      <? if(count($images) > 1): ?>
        <ul class="gallery-thumbs style-6 clearfix">
        <?
        foreach($images as $i => $item):
          $small_url = $item->getThumbnailPath($small_width, $small_height, true);
          $medium_url = $item->getThumbnailPath($medium_width, $medium_height, true);
          $large_url = $item->getThumbnailPath($large_width, $large_height, true);
          $image_description = strlen($item->description) ? h($item->description) : $title;
        ?>
          <li>
            <a href="javascript:;" title="<?= $image_description ?>" onmouseover="
              $('#gallery-viewport > img:first').attr('src', $('img', this).attr('data'));
              $('#gallery-viewport').attr('href', $('img', this).attr('rel')).CloudZoom();
            "><img src="<?= $small_url ?>" alt="<?= $image_description ?>" data="<?= $medium_url ?>" rel="<?= $large_url ?>" /></a>
          </li>
          <? endforeach ?>
        </ul>
      <? endif ?>
    </div>
    
    <div class="col-6">
      <h1><?= h($product->name) ?></h1>
      <?= $product->description ?>
      <? if(!$is_in_stock): ?>
      <p>
        <strong>This product is temporarily unavailable</strong>
        <? if($product->expected_availability_date): ?>  
          <br />
          The expected availability date is <strong><?= $product->displayField('expected_availability_date') ?></strong>
        <? endif ?>
      </p>
      <? endif ?>
      
      <ul class="style-7 form wrap-3 left">
        <? foreach($product->properties as $attribute): ?>
          <li class="left">
            <strong><?= h($attribute->name) ?>:</strong>
          </li>
          <li class="right">
            <?= h($attribute->value) ?>
          </li>
        <? endforeach ?>
        
        <? 
        foreach($product->options as $option):
          $option_name = 'product_options[' . $option->option_key . ']';
          $posted_options = post('product_options', array());
          $posted_value = isset($posted_options[$option->option_key]) ? $posted_options[$option->option_key] : null;
        ?>
          <li class="left">
            <strong><?= h($option->name) ?>:</strong>
          </li>
          
          <li class="right">
            <select name="<?= $option_name ?>">
              <option value=''>Choose</option>
            <? foreach($option->list_values() as $value): ?>
              <option <?= option_state($posted_value, $value) ?> value="<?= h($value) ?>"><?= h($value) ?></option>
            <? endforeach ?>
            </select>
          </li>
        <? endforeach ?>
      </ul>
      
    <? if($product->grouped_products->count): ?>
      <ul class="style-7 form wrap-3 left">
        <li class="left">
          <strong><?= h($product->grouped_menu_label) ?></strong>
        </li>
        
        <li class="right">
          <select name="product_id" onchange="$(this).getForm().sendRequest('on_action', {update: {'page': 'ls_cms_page'}})">
            <? foreach ($product->grouped_products as $grouped_product): ?>
            <option <?= option_state(post('product_id'), $grouped_product->id) ?> value="<?= $grouped_product->id ?>">
              <?= h($grouped_product->grouped_option_desc) ?>
            </option>
            <? endforeach ?>
          </select>
        </li>
      </ul>
    <? endif ?>
 
      <ul class="style-7 form wrap-3 left">
        <? 
        foreach($product->extra_options as $option):
          $option_name = 'product_extra_options[' . $option->option_key. ']';
          $posted_options = post('product_extra_options', array());
          $is_checked = isset($posted_options[$option->option_key]);
          $option_id = 'extra_option_' . $option->id;
          $price = $option->price > 0 ? '+' . format_currency($option->get_price($product)) : 'free';
        ?>
          <li>
            <input id="<?= $option_id ?>" name="<?= $option_name ?>" <?= checkbox_state($is_checked) ?> value="1" type="checkbox" />
            <label for="<?= $option_id ?>"><?= h($option->description) ?>: </label>
            <span><?= $price ?></span>
          </li>
        <? endforeach ?>
      </ul>
                
      <p class="price right clearfix"><?= $product_price ?></p>
      
      <div class="right clear-right">
        <div class="text-box left">
          <input type="text" name="product_cart_quantity" value="1" size="3" />
        </div>
        <a class="button-1 left" href="javascript:;" onclick="$(this).getForm().sendRequest('shop:on_addToCart', {
          update: {'widget-cart': 'site:widget:cart'}, 
          extraFields: {'no_flash': true},
          onSuccess: function() { 
            site.message.addToCart($('[name=product_cart_quantity]').val());
          }
        })">Add To Cart</a>
      </div>
    </div>
  </div>
    
<? if(count($related_products)): ?>
  <div class="wrap-12">
    <h2>Related Products</h2>
    
    <? $this->render_partial('shop:products', array(
      'style' => 1,
      'products' => $related_products,
      'paginate' => false
    )) ?>
  </div>
<? endif ?>
</div>
<?= close_form() ?>