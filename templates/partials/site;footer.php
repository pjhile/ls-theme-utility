<div id="navigation-bottom" class="clearfix">
  <ul class="style-9">
  <?
  $pages = array(
    '/', 
    '/about', 
    '/services', 
    '/news', 
    '/shop', 
    '/gallery',
    '/faq',
    '/contact'
  );
  
  foreach($pages as $page):
    if(!$item = Cms_Page::create()->find_by_url($page))
      continue;
    
    if(!$item->navigation_visible) // beware of ninjas
      continue;
    
    $url = root_url($item->url);
    $title = h($item->navigation_label());
  ?>
    <li><a href="<?= $url ?>" title="Go to <?= $title ?>"><?= $title ?></a></li>
  <? endforeach ?>
  </ul>
  <br /><br /><br /><br />
  <p class="left clear">
    We accept: <img src="<?= root_url('/') ?>resources/images/cc.png" />
  </p>

  <p id="policy" class="right text-right">
	  <?
	  $pages = array(
	    '/terms', 
	    '/privacy', 
	    '/refunds'
	  );
	  
	  foreach($pages as $i => $page):
	    if(!$item = Cms_Page::create()->find_by_url($page))
	      continue;
	    
	    if(!$item->navigation_visible) // beware of ninjas
	      continue;
	    
	    $url = root_url($item->url);
	    $title = h($item->navigation_label());
	    $is_last = $i == count($pages) - 1;
	  ?>
    	<a href="<?= $url ?>" title="Go to <?= $title ?>"><?= $title ?></a><? if(!$is_last): ?> &nbsp;|&nbsp; <? endif ?>
	  <? endforeach ?>
  </p>
</div><!-- /#navigation-bottom -->

<div id="copyright" class=" clearfix">
  <p class="left clear-left">
    &copy; Copyright <?= date('Y', time()) ?> - <?= $site_settings->company->title ?>
  </p>
  <p class="right clear-right">
    Site by <a href="http://limewheel.com/">Limewheel</a> Powered by <a href="http://lemonstandapp.com/">LemonStand</a>
  </p>
</div><!-- /#copyright -->