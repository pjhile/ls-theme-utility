<h1>COMPARE ITEMS</h1>

<? if(!$products->count): ?>
  <p>Your comparison list is empty.</p>
<? return ?>
<? endif ?>

<? $this->render_partial('shop:products', array(
  'style' => 2,
  'products' => $products
)) ?>