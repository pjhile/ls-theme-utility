<?

if(!function_exists('site_settings')) {
  function site_settings() {
    return (object) array(
      'date' => date('F, j'),
      'charset' => 'utf-8',
      'company' => (object) array(
        'title' => Shop_CompanyInformation::get()->name,
        'slogan' => '',
        'sales_email' => 'sales@site.com',
        'info_email' => 'info@site.com',
        'twitter_page' => 'http://twitter.com/',
        'facebook_page' => 'http://facebook.com/',
        'youtube_page' => 'http://youtube.com/'
      ),
      'theme' => (object) array(
        'color' => 'blue' // green, blue, or orange
      ),
      'customer' => (object) array(
        'default_email' => 'E-mail address', // display on home, login, register pages
      ),
      'meta' => (object) array(
        'default_description' => "",
        'default_keywords' => "",
      ),
      'search' => (object) array(
        'path' => '/search',
        'products_per_page' => 6
      ),
      'store' => (object) array(
        'path' => '/store',
        'product_path' => '/store/product',
        'category_path' => '/store/category',
        'cart_path' => '/store/cart',
        'checkout_path' => '/store/checkout',
        'pay_path' => '/store/pay',
        'category' => (object) array(
          'products_per_page' => 16,
          'max_title_length' => 18,
          'default_thumb_path' => 'images/category-default-thumb.jpg',
          'image' => (object) array(
            'width' => 160,
            'height' => 110
          )
        ),
      ),
      'news' => (object) array( 
        'path' => '/news',
        'per_page' => 5,
        'preview' => (object) array(
          'trim_length' => 300
        ),
        'rss' => (object) array(
          'per_page' => 20
        )
      ),
      'product_category_item' => (object) array(
        'per_page' => 16,
        'max_title_length' => 18,
        'default_thumb_path' => 'images/product-default-thumb.png',
        'image' => (object) array(
          'width' => 160,
          'height' => 110
        )
      ),
      'product_detailed_item' => (object) array(
        'default_thumb_path' => 'images/product-detail-default-thumb.png',
        'image' => (object) array(
          'small_width' => 100,
          'small_height' => 70,
          'medium_width' => 340,
          'medium_height' => 255,
          'large_width' => 1020,
          'large_height' => 765
        )
      ),
      'product_frontpage_item' => (object) array(
        'per_page' => 15,
        'max_title_length' => 24,
        'max_description_length' => 23,
        'default_thumb_path' => 'images/product-frontpage-default-thumb.png',
        'discount_path' => 'images/price-strike.png',
        'image' => (object) array(
          'width' => 300,
          'height' => 200
        )
      ),
      'product_cart_item' => (object) array(
        'default_thumb_path' => 'images/product-default-thumb.png',
        'image' => (object) array(
          'width' => 55,
          'height' => 45
        )
      )
    );
  }
}

return site_settings();