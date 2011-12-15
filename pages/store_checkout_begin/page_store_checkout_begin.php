<h1>Checkout</h1>

<div class="wrap-8">
  <p>Have an account? Login here:</p>
  <? if(Shop_Cart::get_item_total_num() != 0): ?>
    <div class="col-4 left">
      <div>
        <? $this->render_partial('shop:login', array('redirect' => root_url($site_settings->path->checkout))) ?>
        <p>Don't Have an Account?</p>
        <p><a href="<?= root_url('/') ?>register/"><em>&raquo; Register</em></a></p>
      </div>
    </div>
    <div class="col-4 right">
      <p>If you do not have an account and you do not want to register, you may checkout as a guest.</p>
      <p>
        <div class="submit-box">
          <a href="<?= root_url($site_settings->path->checkout) ?>">Checkout as Guest</a>
        </div>
      </p>
      
      <h4 class="clear"><strong><em>Why register?</em></strong></h4>
      <p>Registration allows you to avoid filling in billing and shipping forms every time you checkout on this website.</p>
    </div>
  <? else: ?>
    <p>Your shopping cart is empty.</p>
    <p><a href="<?= root_url('/') ?>">Continue shopping...</a></p>
  <? endif ?>
</div>