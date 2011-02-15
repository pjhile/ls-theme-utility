window.site = jQuery.extend(true, window.site ? window.site : {}, {
  message: {
    remove: function() {
      $.removebar();
    },
    custom: function(message, params) {
      if(!message)
        return;
      
      var params = $.extend({
        position: 'top',
        removebutton: false,
        color: '#666',
        message: message,
        time: 5000
      }, params || {});
      
      jQuery(document).ready(function($) {
        $.bar(params);
      });
    },
    addToCart: function(count) {
      site.message.custom(sprintf('%(count)s item%(plural)s been added to your cart!', {count: count, plural: count == 1 ? ' has' : 's have'}), {time: 3000});
    },
    addToCompare: function() {
      site.message.custom('Product has been added to your comparison list!', {time: 3000});
    },
    removeFromCompare: function() {
      site.message.custom('Product has been removed from your comparison list.', {time: 3000});
    },
    clearCompareList: function() {
      site.message.custom('Your compare list has been cleared!', {time: 3000});
    },
    deleteCartItem: function() {
      site.message.custom('Item has been removed from your cart!', {time: 3000});
    },
    updateCart: function() {
      site.message.custom('Your cart has been updated!', {time: 3000});
    },
    setCouponCode: function() {
      site.message.custom('Your coupon code has been set.', {time: 3000});
    },
    copyBilling: function() {
      site.message.custom('Your billing information has been copied to your shipping information!', {time: 3000});
    },
    updatePassword: function() {
      site.message.custom('Your password has been updated!', {time: 3000});
    },
    updateAccount: function() {
      site.message.custom('Your account information has been updated!', {time: 3000});
    },
    updateBilling: function() {
      site.message.custom('Your billing information has been updated!', {time: 3000});
    },
    updateShipping: function() {
      site.message.custom('Your shipping information has been updated!', {time: 3000});
    },
    updateShippingMethod: function() {
      site.message.custom('Your shipping method has been updated!', {time: 3000});
    },
    updateShippingEstimated: function() {
      site.message.custom('Your shipping has been estimated.', {time: 3000});
    },
    addProductReview: function() {
      site.message.custom('Thank you, your review has been successfully posted.', {time: 3000});
    }
  }
});

Phpr.showLoadingIndicator = function() {
  site.message.custom('Processing...', {background_color: '#393536', color: '#fff', time: 999999});
};

Phpr.hideLoadingIndicator = function() {
  site.message.remove();
};

Phpr.response.popupError = function() {
  site.message.custom(this.html.replace('@AJAX-ERROR@', ''), {background_color: '#393536', color: '#cc7c7c', time: 10000});
};

jQuery(document).ready(function($) {
	var sidebar = $('.style-4');
	
	var activate_sidebar_item = function() {
    $(this).parent().toggleClass('active').parent().toggleClass('active').children('ul:first').toggle();

    return false;
  };
	
  $('a.parent span', sidebar).bind('click', activate_sidebar_item);
    
  function activate_menu(menu, timeout) {
    if(!timeout)
      timeout = 0;
    
    setTimeout(function() {
      var current = menu.find('a.active');
    
      if(current.length)
        $('span', current).each(activate_sidebar_item);
      else
        $('a.parent span', menu).each(activate_sidebar_item);
    }, timeout);
  }
  
  activate_menu(sidebar, 1 * 0);
  
  $('.cloud-zoom').livequery(function() {
    $(this).CloudZoom();
  });
  
  $('.slidify').livequery(function() {
    $(this).click(function() {
      $(this).toggleClass('active');
      $($(this).attr('rel')).slideToggle(500);
    });
  });
});
