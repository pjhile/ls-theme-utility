<? $this->render_partial('site:head') ?>
  </head>
  <body>
    <div id="wrapper" class="wrap-12 margin-center clearfix">
      <div id="header">
        <? $this->render_partial('site:header') ?>
      </div><!-- /#header -->
      <div id="content" class="wrap-12 clearfix">
        <div id="page">
          <? $this->render_page() ?>
        </div><!-- /#page -->
      </div><!-- /#content -->
    </div><!-- /#wrapper -->
    <div id="footer-wrapper" class="wrap-12 margin-center">
	    <div id="footer" class="col-12 clearfix">
	        <? $this->render_partial('site:footer') ?>
	    </div><!-- /#footer -->
	  </div><!-- /#footer-wrapper -->
    <? $this->render_partial('site:foot') ?>