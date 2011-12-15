<div class="col-6 clearfix">
  <h1>Login</h1>

  <p>Please sign in using your existing account.</p>
  
  <? $this->render_partial('shop:login', array('redirect' => root_url('/'))) ?>
</div>

<div class="col-6 clearfix">
  <h1>Register</h1>

  <p>Register a new account.</p>
  
  <? $this->render_partial('shop:register', array('redirect' => root_url('/'))) ?>
</div>