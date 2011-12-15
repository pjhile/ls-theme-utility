<? $this->render_partial('site:head') ?>

  </head>
  <body>
    <div id="wrapper" class="wrap-16 margin-center clearfix">
      <div id="header">
        <? $this->render_partial('site:header') ?>
      </div><!-- /#header -->
      <div id="content" class="clearfix">
        <a id="cycle-previous" href="javascript:;"></a>
        <a id="cycle-next" href="javascript:;"></a>
        <div id="page" class="wrap-16">
			    <script src="<?= theme_resource_url('3rd/galleria.js') ?>"></script>
			    <script>Galleria.loadTheme('<?= theme_resource_url('3rd/galleria_classic/galleria.classic.js') ?>');</script>
          <? $this->render_page() ?>
        </div><!-- /#page -->
      </div><!-- /#content -->
    </div><!-- /#wrapper -->
    <div id="footer-wrapper" class="wrap-16 margin-center clearfix">
      <div id="footer" class="col-16 clearfix">
        <? $this->render_partial('site:footer') ?>
      </div><!-- /#footer -->
    </div><!-- /#footer-wrapper -->
    <? $this->render_partial('site:foot') ?>