Instructions for LemonStand theme: "Utility"
===================================================================================================


Installation
---------------------------------------------------------------------------------------------------

This package contains a CMS export of the theme, with file name `utility.lca`. In order to import this 
theme, please follow these instructions:  
1. Log in to your LemonStand store.  
2. Select the `CMS` section from the menu.  
3. Select `Themes` from the sub-menu. If you do not see `Themes`, please make sure your installation is up-to-date.  
4. Choose `Import theme`.  
5. Click `Choose file`, locate and select `utility.lca` from your harddrive, and then choose `Import`.  
6. Allow LemonStand to upload and import the CMS theme.  
7. Follow the configuration instructions below.  

Alternatively, and for version control, the `templates` directory contains filesystem CMS templates. 
The primary purpose of these is to track template changes.

This package contains module dependencies, located in the `modules` directory. Please follow these instructions:  
1. In the `modules` directory, please select all folders, right click, and copy them.  
2. Go to the `modules` directory in your LemonStand installation, right click, and paste them.  
3. Log out of LemonStand, and log back in.

Configuration
---------------------------------------------------------------------------------------------------

These instructions assume that you already have this theme imported into your LemonStand store.

Much of this theme can be customized through the `site:settings` CMS partial. This includes company 
title, social networking links, theme color, meta data, image dimensions, page paths (must match 
existing pages), products per page, product title length, and more.

Site settings can be accessed in the following way, for example: `$site_settings->company->title` or 
`$this->render_partial('site:settings')->company->title`.


Variations:

- This theme contains 3 color variations: green, blue, and orange. You can change the color by 
changing the theme->color word in the `site:settings` partial.


Sections:

- In order to modify products in the cycle area of the home page, please use a Product Group with 
an API code of `frontpage`. Product Groups can be found under the Shop Products section.
- In order to modify products under the `Featured Products` section of the home page, please use a 
Product Group with an API code of `featured`.
- In order to modify products under the `Products on Sale` section of the home page, please use a 
Product Group with an API code of `sale`.


Structure:

- Gallery images can be located in the `themes/utility/resources/images/gallery` folder.
- Color related variations can be found in `themes/utility/resources/css` folder, and `themes/utility/resources/images/colors` 
folder.
- Dialog message box text is located in the `themes/utility/resources/js/main.js` file.


Warning: 
Self-hosted payment methods currently require their payment form partials to be edited to POST to the Pay page, like so:
[http://bit.ly/kQ0oRN](http://bit.ly/kQ0oRN)

	<?= open_form(array('action' => root_url($site_settings->store->pay_path . '/' . $order->order_hash))) ?>

Notes
---------------------------------------------------------------------------------------------------

- If you are using newsletter software or a service, do not forget to change the form on the home 
page.
- The `payment:braintree_transpredirect` partial has been included as a style reference for your 
payment form.
- Any PSDs used to create the layout, are in the `design` folder.  


Support
---------------------------------------------------------------------------------------------------

Please visit the [LemonStand forums](http://forum.lemonstandapp.com/) for community support.
If you encounter a bug, please check/use the **GitHub** issues tracker.
