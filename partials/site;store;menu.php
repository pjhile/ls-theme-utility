<h3>Categories</h3>

<? $this->render_partial('shop:categories', array(
  'list_default_class' => 'style-4',
  'child' => isset($category) ? $category : null,
  'tree' => isset($product) ? $product->category_list : null,
  'anchor_append_html' => '<span></span>'
)) ?>