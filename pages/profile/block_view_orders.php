<h1>My Orders</h1>

<div class="box-1 wrap-12">
<?= open_form() ?>
  <div class="col-12">
  <? if(!$orders->count): ?>
    <p>No orders yet.</p>
  <? else: ?>
    <p>Click an order for details.</p>
    
    <table class="style-1">
      <thead>
        <tr>
          <th class="first"></th>
          <th>#</th>
          <th>Date</th>
          <th>Status</th>
          <th class="text-right last">Total</th>
        </tr>
      </thead>
      <tbody>
        <? foreach($orders as $order): ?>
          <?
          $url = root_url('/') . 'profile/order/' . $order->id;
          ?>
          <tr class="<?= zebra('order') ?>">
            <td>
              <span title="<?= h($order->status->name) ?>" style="background-color: <?= $order->color ?>">&nbsp;</span>
            </td>
            <td><a href="<?= $url ?>"><?= $order->id ?></a></td>
            <td><a href="<?= $url ?>"><?= $order->order_datetime->format('%x') ?></a></td>
            <td><a href="<?= $url ?>"><strong><?= h($order->status->name) ?></strong> since <?= $order->status_update_datetime->format('%x') ?></a></td>
            <td class="text-right last"><a href="<?= $url ?>"><?= format_currency($order->total) ?></a></th>
          </tr>
        <? endforeach ?>
      </tbody>
    </table>
  <? endif ?>
  </div>
<?= close_form() ?>
</div>