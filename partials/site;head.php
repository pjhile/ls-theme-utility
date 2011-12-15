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
      '@3rd/grid-960-16.css',
      '@3rd/form.css',
      '@css/main.css',
      '@css/plugins.css',
      '@css/colors/' . $site_settings->theme->color . '.css'
    ),
    array(
      'src_mode' => true,
      'reset_cache' => true
    )) ?>

    <?= $this->js_combine(array(
      'jquery', 
      '@3rd/jquery-ui-1.8.5.custom.min.js', 
      'ls_core_jquery',
      '@3rd/sprintf-0.7-beta1.js',
      '@3rd/jquery.livequery.min.js',
      '@3rd/jquery.carouFredSel-2.5.6.js',
      '@3rd/cloud-zoom.1.0.2.js',
      '@3rd/jquery.bar.js',
      '@3rd/jquery.inputify.js',
      '@js/main.js'
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