<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('#cycle').carouFredSel({
      auto : true,
      scroll : {
        easing: 'easeInOutQuad',
        duration: 1500
      },
      items: {
        visible: 1
      },
      prev : {  
        button  : "#cycle-previous",
        key    : "left"
      },
      next : { 
        button  : "#cycle-next",
        key    : "right"
      },
      pagination  : "#cycle-pagination"
    });
  });
</script>