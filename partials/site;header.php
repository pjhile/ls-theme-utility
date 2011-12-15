<a id="logo" class="left" href="<?= root_url('/') ?>" title="<?= $site_settings->company->title ?>">
  <img src="<?= theme_resource_url('images/colors/' . $site_settings->theme->color . '/logo.png') ?>" alt="<?= $site_settings->company->title ?>" />
</a><!-- /#logo -->

<div id="navigation-top" class="right">
  <div class="right p-10">
    <a href="<?= $site_settings->company->facebook_page ?>" title="Visit us on Facebook"><img src="<?= theme_resource_url('images/icon-fb.png') ?>" /></a>
    <a href="<?= $site_settings->company->twitter_page ?>" title="Visit us on Twitter"><img src="<?= theme_resource_url('images/icon-tw.png') ?>" /></a>
    <a href="<?= $site_settings->company->youtube_page ?>" title="Visit us on Youtube"><img src="<?= theme_resource_url('images/icon-yt.png') ?>" /></a>
    <a href="<?= root_url('/') ?>news/rss" title="News feed"><img src="<?= theme_resource_url('images/icon-rss.png') ?>" /></a>
  </div>
  <form class="search right clear clearfix" method="get" action="<?= root_url('/') ?>search">
    <input type="hidden" name="records" value="<?= $site_settings->search->products_per_page ?>" />
    <div class="text-box left">
      <input class="inputify" type="text" name="query" size="24" maxlength="1024" value="Product search" />
    </div>
    <div class="submit-box left">
      <input type="submit" name="submit" value="GO" />
    </div>
  </form>
</div><!-- /#navigation-top -->

<div id="menu" class="clearfix">
  <? $this->render_partial('site:menu') ?>
</div>