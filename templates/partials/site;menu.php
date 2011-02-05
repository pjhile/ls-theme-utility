<ul class="style-1">
<?
$pages = array(
  '/', 
  '/about', 
  '/services', 
  '/news', 
  '/shop', 
  '/gallery',
  '/store'
);

foreach($pages as $i => $page):
  if(!$item = Cms_Page::create()->find_by_url($page))
    continue;
  
  if(!$item->navigation_visible) // beware of ninjas
    continue;
  
  $classes = array();
  $path = explode('/', $this->page->url);
  $is_first = $i == 0;
  $is_last = $i == count($pages) - 1;
  $is_current = $item->url == $this->page->url || $item->url == '/' . $path[1];
  $title = h($item->navigation_label());
  
  if($is_current) $classes[] = 'active';
  if($is_first) $classes[] = 'first';
  if($is_last) $classes[] = 'last';
  //if($page == '/store') $classes[] = 'color-2';
?>
  <li class="<?= implode(' ', $classes) ?>">
    <a class="<?= implode(' ', $classes) ?>" href="<?= root_url($item->url) ?>" title="Go to <?= $title ?>"><?= strtoupper($title) ?></a>
  </li>
<? endforeach ?>
</ul>

<div id="profile" class="right">
<?
$page_url = root_url('/');
$is_current = $page_url == $this->page->url;
$title = 'Home';
?>

<? if($is_current): ?><span><? else: ?><a href="<?= $page_url ?>"><? endif ?><?= $title ?><? if($is_current): ?></span><? else: ?></a><? endif ?>
 &nbsp;|&nbsp; 
<? if($this->customer): ?>
  <?
  $page_url = root_url('/') . 'profile';
  $is_current = $page_url == $this->page->url;
  $title = 'View Profile';
  ?>
  <? if($is_current): ?><span><? else: ?><a href="<?= $page_url ?>/"><? endif ?><?= $title ?><? if($is_current): ?></span><? else: ?></a><? endif ?>
   &nbsp;|&nbsp; 
  <?
  $page_url = root_url('/') . 'logout';
  $is_current = $page_url == $this->page->url;
  $title = 'Logout';
  ?>
  <? if($is_current): ?><span><? else: ?><a href="<?= $page_url ?>/"><? endif ?><?= $title ?><? if($is_current): ?></span><? else: ?></a><? endif ?>
<? else: ?>
  <?
  $page_url = root_url('/') . 'login';
  $is_current = $page_url == $this->page->url;
  ?>
  <? if($is_current): ?><span><? else: ?><a href="<?= $page_url ?>/"><? endif ?>Login<? if($is_current): ?></span><? else: ?></a><? endif ?>
   &nbsp;|&nbsp; 
  <? if($is_current): ?><span><? else: ?><a href="<?= $page_url ?>/"><? endif ?>Register<? if($is_current): ?></span><? else: ?></a><? endif ?>
<? endif ?>
   &nbsp;|&nbsp; 
  <a id="widget-cart" href="<?= root_url($site_settings->store->cart_path) ?>/">
    <? $this->render_partial('site:widget:cart') ?>
  </a><!-- /#widget-cart -->
   &nbsp;|&nbsp; 
  <?
  $page_url = root_url('/') . 'store/checkout';
  $is_current = $page_url == $this->page->url;
  $title = 'Checkout';
  ?>
  <? if($is_current): ?><span class="button-1"><? else: ?><a class="button-1" href="<?= $page_url ?>/"><? endif ?><?= $title ?><? if($is_current): ?></span><? else: ?></a><? endif ?>
</div><!-- /#profile -->