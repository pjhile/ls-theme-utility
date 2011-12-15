<h1>Thank you for the order!</h1>

<div class="col-12 box-1">
  <ul class="clearfix">
    <li>
      <h3>Order # <?= $order->id ?></h3>
    </li>
    <li class="last">
      <p>Order Date: <strong><?= h($order->order_datetime->format('%x')) ?></strong></p>
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
    <? foreach($items as $item): ?>
      <tr>
        <td class="first text-left"><a href="<?= $item->product->page_url($site_settings->store->product_path) ?>/"><?= $item->output_product_name() ?></a></td>
        <td class="text-right"><?= format_currency($item->single_price) ?></td>
        <td class="text-right">-<?= format_currency($item->discount) ?></td>
        <td class="text-right"><?= $item->quantity ?></td>
        <td class="last text-right"><?= format_currency($item->subtotal) ?></td>
      </tr>
    <? endforeach ?>
    </tbody>
  </table>
  
  <table class="col-4 style-2 right">
    <tr>
      <td>Subtotal:</td>
      <td class="text-right"><?= format_currency($order->subtotal) ?></td>
    </tr>
    <tr>
      <td>Discount:</td>
      <td class="text-right">-<?= format_currency($order->discount) ?></td>
    </tr>
  <? foreach($order->list_item_taxes() as $tax): ?>
    <tr>
      <td>Sales tax (<?= $tax->name ?>):</td>
      <td><?= format_currency($tax->total) ?></td>
    </tr>
  <? endforeach ?>  
    <tr>
      <td>Shipping:</td>
      <td class="text-right"><?= format_currency($order->shipping_quote) ?></td>
    </tr>
  <? foreach($order->list_shipping_taxes() as $tax): ?>
    <tr>
      <td>Shipping tax (<?= $tax->name ?>):</td>
      <td class="text-right"><?= format_currency($tax->total) ?></td>
    </tr>
  <? endforeach ?>  
  </table>
  
  <ul class="right clear">
    <li class="first last">
      <p class="text-right color-4">
        Total<br />
        <span class="price block"><?= format_currency($order->total) ?></span>
      </p>
    </li>
  </ul>
  
  <p class="no-print clear">
    <a class="button-3" href="<?= root_url('/') ?>">&raquo; Continue shopping</a>
  </p>
</div>