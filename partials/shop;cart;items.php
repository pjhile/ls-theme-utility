<?
extract(array_merge(array(
  'postponed' => null
), $params));
?>

<? if(!count($items)): ?>
  <p>Your cart is empty.</p>
<? else: ?>
  <table class="style-1">
    <thead>
      <tr>
        <th class="first">Items</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Total</th>
        <th class="last"></th>
      </tr>
    </thead>
    <tbody>
    <? 
    foreach($items as $item): 
      $url = $item->product->page_url($site_settings->store->product_path);
      $title = h($item->product->name);
      $width = $site_settings->product_cart_item->image->width;
      $height = $site_settings->product_cart_item->image->height;
      $image_url = $item->product->image_url(0, $width, $height, true);
      $image_description = count($item->product->images) ? h($item->product->images[0]->description) : $title;
      $options_str = $item->options_str();
      
      if(!$image_description)
        $image_description = $title;
      
      if(!$image_url)
        $image_url = theme_resource_url($site_settings->product_cart_item->default_thumb_path);
    ?>
      <tr>
        <td class="first"><a class="left" href="<?= $url ?>"><img src="<?= $image_url ?>" alt="<?= $image_description ?>" width="<?= $width ?>" height="<?= $height ?>" /></a>

          <p class="description col-3 left">
            
            <a href="<?= $url ?>" title="<?= $title ?>"><?= $title ?></a>
            <? if(strlen($options_str)): ?>
              <br /><?= h($options_str) ?>.
            <? endif ?>
            <? if($item->extra_options): ?>
              <? foreach($item->extra_options as $option): ?>
                <br />
                + <?= h($option->description) ?>:
                <?= format_currency($option->get_price($item->product)) ?>
              <? endforeach ?>
            <? endif ?>
          </p>
        </td>
        <td>
        <? if(!$postponed): ?>
          <div class="text-box">
            <input class="short" type="text" name="item_quantity[<?= $item->key ?>]" value="<?= $item->quantity ?>" size="1" />
          </div>
        <? else: ?>
          <?= $item->quantity ?>
        <? endif ?>
        </td>
        <td><?= format_currency($item->single_price()) ?></td>
        <td><?= format_currency($discount) ?></td>
        <td><?= format_currency($item->total_price()) ?></td>
        <td class="last">
          <a href="javascript:;" onclick="return $(this).getForm().sendRequest('shop:on_deleteCartItem', {
            update: {
              'page': 'ls_cms_page', 
              'widget-cart': 'site:widget:cart'
            },
            extraFields: {
              'key': '<?= $item->key ?>',
              'no_cookies': true
            },
            onSuccess: function() {
              site.message.deleteCartItem();
            }
          })" title="Remove item from cart"><img src="<?= theme_resource_url('images/icon-close.png') ?>" /></a>
        </td>
      </tr>
    <? endforeach ?>
    </tbody>
  </table>
<? endif ?>