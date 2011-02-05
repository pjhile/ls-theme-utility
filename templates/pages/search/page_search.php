<div class="col-12">
  <h1>Search Items</h1>
  
  <div class="col-7 p-10 clear clearfix">
    <form method="get" action="<?= root_url($site_settings->search->path) ?>">
      <input type="hidden" name="records" value="<?= $site_settings->search->products_per_page ?>" />
      
      <div class="text-box left">
        <input name="query" type="text" value="<?= $query ?>" size="30" />
      </div>
       
      <div class="submit-box left">
        <input type="submit" value="Find Products" />
      </div>
    </form>
  </div>
      
  <? if(!strlen($query)): ?>
    <p>Please enter some text in order to search.</p>
  <? return ?>
  <? endif ?>
  
  <? $this->render_partial('shop:products', array(
    'style' => 1, 
    'products' => $products
  )) ?>
  
  <? $this->render_partial('cms:pagination', array(
    'pagination' => $pagination, 
    'base_url' => root_url($site_settings->search->path), 
    'suffix' => '?query=' . urlencode($query) . '&records=' . urlencode($records)
  )) ?>
</div>