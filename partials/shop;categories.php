<?
extract(array_merge(array(
  'list' => array(),
  
  'show_list_markup' => true,
  'use_list_classes' => true,
  'list_default_class' => '',
  'list_parent_class' => '',
  'list_parent_id' => '',
  'list_child_class' => '',
  'list_prepend_html' => null,
  'list_append_html' => null,
  
  'use_item_classes' => true,
  'show_item_children' => true,
  'item_default_class' => '',
  'item_current_class' => 'active',
  'item_first_class' => 'first',
  'item_last_class' => 'last',
  'item_parent_class' => 'parent',
  'item_delimiter' => '|',
  'show_item_delimiter' => false,
  'show_item_parents' => false,
  
  'use_anchor_classes' => true,
  'anchor_default_class' => '',
  'anchor_current_class' => 'active',
  'anchor_first_class' => 'first',
  'anchor_last_class' => 'last',
  'anchor_parent_class' => 'parent',
  'anchor_prepend_html' => '',
  'anchor_append_html' => '',
  'show_anchor_image' => false,
  
  'render_before' => null,
  'render_after' => null,
  'current_url' => null,
  
  'parent' => null,
  'child' => null,
  'filter' => null,
  'tree' => null,
  
  'manufacturer_url_name' => null
), $params));
?>

<?  
if(!$list)
  $list = $parent ?
    $parent->list_children('front_end_sort_order') :
    Shop_Category::create()->list_root_children('front_end_sort_order');

if($list instanceof Db_DataCollection)
  $list = $list->as_array();
?>

<? if(!count($list)) return ?>

<?
$list_classes = array();

if($use_list_classes) {
  $list_classes[] = $list_default_class;
  
  if($parent) 
    $list_classes[] = $list_child_class;
  else
    $list_classes[] = $list_parent_class;
}
?>

<? if($show_list_markup): ?>
<ul id="<?= !$parent ? $list_parent_id : null ?>" class="<?= implode(' ', $list_classes) ?>">
<? endif ?>
  <?= $list_prepend_html ?>
  
  <? if($render_before) $this->render_partial($render_before[0], $render_before[1]) ?>
  
  <? foreach($list as $i => $item): ?>
  <?
  $is_first = ($i == 0);
  $is_last = ($i == count($list) - 1);
  $is_current = false;
  $is_parent = $item->list_children('front_end_sort_order')->count;
  
  if($child)
    if($item->url_name == $child->url_name)
      $is_current = true;
     
  if($tree)
    foreach($tree as $k => $v)
      if($v->url_name == $item->url_name)
        $is_current = true;
  
  if($current_url == $item->url_name)
    $is_current = true;
    
  if($filter) {
    $show = false;
    
    foreach($filter as $filt) {
      if($filt->id == $item->id) {
        $show = true;
        $is_current = true;
        break;
      }
    }
  }
  else
    $show = true;
    
  $item_classes = array();
  
  if($use_item_classes) {
    $item_classes[] = $item_default_class;
    
    if($is_current) $item_classes[] = $item_current_class;
    if($is_first) $item_classes[] = $item_first_class;
    if($is_last) $item_classes[] = $item_last_class;
    if($is_parent) $item_classes[] = $item_parent_class;
  }
  
  $anchor_classes = array();
  
  if($use_anchor_classes) {
    $anchor_classes[] = $anchor_default_class;
    
    if($is_current) $anchor_classes[] = $anchor_current_class;
    if($is_first) $anchor_classes[] = $anchor_first_class;
    if($is_last) $anchor_classes[] = $anchor_last_class;
    if($is_parent) $anchor_classes[] = $anchor_parent_class;
  }
  ?>

  <li class="<?= implode(' ', $item_classes) ?>">
    <a class="<?= implode(' ', $anchor_classes) ?>" href="<?= $manufacturer_url_name && $is_current ? $item->page_url($site_settings->store->category_path) . '/vendor/' . $manufacturer_url_name : $item->page_url($site_settings->store->category_path) ?>/" title="View all products of <?= h($item->name) ?>">
      <? if($show_anchor_image): ?>
      <? 
      $title_max_length = $site_settings->store->category->max_title_length;
      $title = strlen(h($item->name)) > $title_max_length ? trim(substr(h($item->name), 0, $title_max_length)) . '...' : h($item->name);
      $width = $site_settings->store->category->image->width;
      $height = $site_settings->store->category->image->height;
      $image_url = $item->image_url(0, $width, $height, true);
      
      if(!$image_url)
        $image_url = theme_resource_url($site_settings->store->category->default_thumb_path);
      ?>
      <img src="<?= $image_url ?>" alt="<?= h($item->name) ?>" width="<?= $width ?>" height="<?= $height ?>" />
      <span class="title"><?= $title ?><?= $anchor_append_html ?></span>
      <? else: ?>
      <?= h($item->name) ?><?= $anchor_append_html ?>
      <? endif ?>
    </a>
    
    <? unset($params['list'], $params['render_before'], $params['render_after'], $params['list_prepend_html'], $params['list_default_class']) ?>
    <? if($show_item_children) $this->render_partial('shop:categories', array_merge($params, array('parent' => $item))) ?>
  </li>
  
  <? endforeach ?>
  
  <?= $list_append_html ?>
  
  <? if($render_after) $this->render_partial($render_after[0], $render_after[1]) ?>
<? if($show_list_markup): ?>
</ul>
<? endif ?>