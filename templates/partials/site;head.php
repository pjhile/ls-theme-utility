<!doctype html>
<html lang="en">
<?
$charset = $site_settings->charset;
$meta_description = ($meta_description = h($this->page->description)) ? $meta_description : $site_settings->meta->default_description;
$meta_keywords = ($meta_keywords = h($this->page->keywords)) ? $meta_keywords : $site_settings->meta->default_keywords;
?>
  <head>
    <title><?= h($this->page->title) ?> - <?= $site_settings->company->title ?></title>
    <meta charset="<?= $charset ?>" />
    <meta name="description" content="<?= $meta_description ?>" />
    <meta name="keywords" content="<?= $meta_keywords ?>" />

    <!--[if lt IE 8]><script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js"></script><![endif]--> 
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <?= $this->css_combine(array(
      'ls_styles',
      '/resources/3rd/grid-960-16.css',
      '/resources/3rd/form.css',
      '/resources/css/main.css',
      '/resources/css/plugins.css',
      '/resources/css/colors/' . $site_settings->theme->color . '.css'
    )) ?>

    <?= $this->js_combine(array(
      'jquery', 
      '/resources/3rd/jquery-ui-1.8.5.custom.min.js', 
      'ls_core_jquery',
      '/resources/3rd/sprintf-0.7-beta1.js',
      '/resources/3rd/jquery.livequery.min.js',
      '/resources/3rd/jquery.carouFredSel-2.5.6.js',
      '/resources/3rd/cloud-zoom.1.0.2.js',
      '/resources/3rd/jquery.bar.js',
      '/resources/3rd/jquery.inputify.js',
      '/resources/js/main.js'
    ),
    array(
      'src_mode' => true,
      'reset_cache' => true
    )) ?>

    <?= $this->render_head() ?>

    <script>
    <?
    foreach(Phpr::$session->flash as $type => $message):
      if($type == 'system')
        continue;
    ?>
    site.message.custom("<?= $message ?>");
    <? endforeach ?>
    </script>