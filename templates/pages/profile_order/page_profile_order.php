<? if(!$order): ?>
  <h3>Order not found</h3>
<? return ?>
<? endif ?>

<h1>Order #<?= $order->id ?></h1>

<div class="col-12 box-1 clearfix">
  <ul class="left">
    <li class="first">
      <p>Order Date: <strong><?= h($order->order_datetime->format('%x')) ?></strong></p>
    </li>
    <li class="last">
      <p>Status: <strong><?= h($order->status->name) ?></strong></p>
    </li>
  </ul>

  <table class="style-1">
    <thead>
      <tr>
        <th class="first">Items</th>
        <th class="text-right">Price</th>
        <th class="text-right">Discount</th>
        <th class="text-right">Quantity</th>
        <th class="last text-right">Total</th>
      </tr>
    </thead>
    <tbody>
      <?
      foreach($items as $item):
        $image_url = $item->product->image_url(0, 60, 'auto', true, array('mode' => 'zoom_fit'));
      ?>
      <tr>
        <td class="first">
          <p>
          <a href="<?= $item->product->page_url($site_settings->store->product_path) ?>/"><?= $item->output_product_name() ?></a>
          
          <? if($item->product->product_type->files && $order->is_paid() && $item->product->files->count): ?>
            <p>Download:</p>
            <ul>
            <? foreach ($item->product->files as $file): ?>
              <li><a href="<?= $file->download_url($order) ?>"><?= h($file->name) ?></a> (<?= $file->size_str ?>)</li>
            <? endforeach ?>
            </ul>
          <? endif ?>
        </p>
        </td>
        <td class="text-right"><?= format_currency($item->single_price) ?></td>
        <td class="text-right"><?= format_currency($item->discount) ?></td>
        <td class="text-right"><?= $item->quantity ?></td>
        <td class="last text-right"><?= format_currency(($item->single_price - $item->discount) * $item->quantity) ?></td>
      </tr>
      <? endforeach ?>
    </tbody>
  </table>
  
  <table class="style-2 right">
    <tr>
      <td>Subtotal:</td>
      <td><?= format_currency($order->subtotal) ?></td>
    </tr>
    <tr>
      <td>Discount:</td>
      <td><?= format_currency($order->discount) ?></td>
    </tr>
    <tr>
      <td>Goods tax:</td>
      <td><?= format_currency($order->goods_tax) ?></td>
    </tr>
    <tr>
      <td>Goods tax discount:</td>
      <td><?= format_currency($order->tax_discount) ?></td>
    </tr>
    <tr>
      <td>Shipping:</td>
      <td><?= format_currency($order->shipping_quote) ?></td>
    </tr>
  <? if($order->shipping_tax): ?>
    <tr>
      <td>Shipping tax:</td>
      <td><?= format_currency($order->shipping_tax) ?></td>
    </tr>
  <? endif ?>
  </table>
  
  <ul class="right clear text-right">
    <li class="last">
      <p class="color-4">
        Total<br />
        <span class="price block"><?= format_currency($order->total) ?></span>
      </p>
    </li>
  </ul>
  
  <p class="clear">
    <a href="<?= root_url('/') ?>profile/orders/">&raquo; Return to the order history</a>
  <? if($order->payment_method->has_payment_form() && !$order->payment_processed()): ?>
    <a class="button-1 right clear" href="<?= root_url($site_settings->store->path) ?>/pay/<?= $order->order_hash ?>/">Pay</a>
  <? endif ?>
  </p>
</div>