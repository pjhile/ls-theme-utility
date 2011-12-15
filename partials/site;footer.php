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
  ?>
    <li><a href="<?= root_url($item->url) ?>" title="Go to <?= h($item->title) ?>"><?= h($item->title) ?></a></li>
  <? endforeach ?>
  </ul>
  <br /><br /><br /><br />
  <p class="left clear">
    We accept: <img src="<?= theme_resource_url('images/cc.png') ?>" />
  </p>

  <p id="policy" class="right text-right">
    <a href="<?= root_url('/') ?>terms/">Terms &amp; Conditions</a> &nbsp;|&nbsp; 
    <a href="<?= root_url('/') ?>privacy/">Privacy Policy</a> &nbsp;|&nbsp; 
    <a href="<?= root_url('/') ?>refunds/">Refund Policy</a>
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