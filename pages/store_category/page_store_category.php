<? if(!$category): ?>
	<div class="col-12">
  	<h2>Sorry, the specified category was not found.</h2>
	</div>
<? return ?>
<? endif ?>

<div class="col-12">
  <div class="hide">
  <h1 class="left"><?= h($category->name) ?></h1>
  
  <p class="sort left">SORT PRODUCTS BY:</p>
  
  <?
  // save the category product sorting mode if it has been changed.
  if(post('sorting'))
    Cms_VisitorPreferences::set('cat_sorting_' . $category->id, post('sorting'));
  
  // load the product sorting mode. default mode is 'name'.
  $sorting = Cms_VisitorPreferences::get('cat_sorting_' . $category->id, 'name');
  ?>
  <select class="awesome left" onchange="LS.sendRequest('<?= Phpr::$request->getCurrentUrl() ?>', 'on_action', {
    update: {'page': 'ls_cms_page'},
    extraFields: {'sorting': $(this).val()}
  })">
    <option value="name">Default</option>
    <option <?= post('sorting', false) ? option_state('name', $sorting) : null ?> value="name">Name</option>
    <option <?= option_state('price', $sorting) ?> value="price">Price</option>
  </select>
  </div>
  
  <div class="breadcrumb">
    <? $this->render_partial('shop:categories', array(
      'list' => $category->get_parents(true), 
      'show_item_children' => false,
      'list_default_class' => 'style-3',
      'item_first_class' => '',
      'item_delimiter' => '->',
      'show_item_delimiter' => true,
      'list_prepend_html' => '<li class="first"><a href="' . root_url('/') . '">Home</a></li><li><a href="' . root_url('/') . 'store/">Store</a></li>'
    )) ?>
  </div>
  
  <p class="clear"><?= h($category->short_description) ?></p>
  <? if(count($category->list_children()) > 0): ?>
    <ul class="style-2">
    <? $this->render_partial('shop:categories', array(
      'list' => $category->list_children(),
      'show_item_children' => false,
      'show_list_markup' => false,
      'show_anchor_image' => true,
      'anchor_default_class' => 'product-frontpage-item'
    )) ?>
    </ul>
  <? else: ?>
  <?
  // setup products
  $products = $category->list_products(array(
    'sorting' => array($sorting), // requires an array to sort by
    'apply_top_products' => post('sorting', true)
  ));
  
  // setup pagination
  $base_url = $category->page_url($site_settings->store->category_path);
  $index = $this->request_param(1, 0); // grabs the index from the URL, otherwise defaults to zero
  $per_page = $site_settings->store->category->products_per_page;
  $pagination = $products->paginate($index - 1, $per_page);
  
  // show products
  $this->render_partial('shop:products', array(
    'style' => 1,
    'products' => $products
  ));
  
  // show pagination
  if($pagination)
    $this->render_partial('cms:pagination', array('pagination' => $pagination, 'base_url' => $base_url));
  ?>
  <? endif ?>
</div>