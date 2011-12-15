<?
extract(array_merge(array(
  'a_default_class' => '',
  'li_default_class' => '',
  'li_current_class' => 'current',
  'li_first_class' => 'first',
  'li_last_class' => 'last',
  'list_li_children' => true,
  'list_ul_children' => false,
  'li_delimiter' => '|',
  'show_li_delimiter' => false
), $params));
?>

<ul class="<? if(isset($parent_ul_class)) echo $parent_ul_class ?><? if(isset($parent_page) && isset($child_ul_class)) echo $child_ul_class ?>">
<? foreach($page_list as $k => $page): ?>
  <?
  $is_first = $k == 0;
  $is_last = $k == count($page_list) - 1;
  ?>
  <li class="<?= $li_default_class ?><? if($this->page->url == $page->url) echo $li_current_class ?> <? if($is_first) echo $li_first_class ?> <? if($is_last) echo $li_last_class ?>">
    <a class="<?= $a_default_class ?>" href="<?= $page->url ?>" title="View <?= h($page->navigation_label()) ?>"><?= h($page->navigation_label()) ?></a> <? if($show_li_delimiter && !$is_last) echo $li_delimiter ?>
    <? 
    $subpages = $page->navigation_subpages();
    
    if($subpages):
    ?>
      <? unset($params['parent_ul_class']) ?>
      <? if($list_children) $this->render_partial('cms:pages', array_merge($params, array('page_list' => $subpages, 'parent_page' => $page))) ?>
    <? endif ?>  
  </li>  
<? endforeach ?>
</ul>