<h1>My Orders</h1>

<div class="col-12 box-1">
<? if(!$orders->count): ?>
  <p>You have not made any orders yet.</p>
<? return ?>
<? endif ?>

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
          <td><?= $order->id ?></td>
          <td><a href="<?= $url ?>"><?= $order->order_datetime->format('%x') ?></a></td>
          <td><a href="<?= $url ?>"><strong><?= h($order->status->name) ?></strong> since <?= $order->status_update_datetime->format('%x') ?></a></td>
          <td class="text-right last"><?= format_currency($order->total) ?></th>
        </tr>
      <? endforeach ?>
    </tbody>
  </table>
</div>