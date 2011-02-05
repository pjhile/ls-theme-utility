<? $this->render_partial('site:head') ?>
  </head>
  <body>
    <div id="wrapper" class="wrap-16 margin-center clearfix">
      <div id="header">
        <? $this->render_partial('site:header') ?>
      </div><!-- /#header -->
      <div id="content" class="wrap-16 clearfix">
        <div id="profile-menu" class="sidebar col-4 clearfix">
          <? $this->render_partial('site:profile:menu') ?>
        </div><!-- /#profile-menu -->
        <div id="page" class="wrap-12">
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