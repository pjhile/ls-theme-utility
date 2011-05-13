Instructions for LemonStand theme: "Utility"
===================================================================================================


Installation
---------------------------------------------------------------------------------------------------

This package contains a CMS export of the theme, with file name `cms.lca`. In order to import this 
theme, please follow these instructions:  
1. Log in to your LemonStand store.  
2. Select the `CMS` section from the menu.  
3. Select `Export or Import` from the sub-menu.  
4. Choose `Import pages, partials and templates`.  
5. Click `Choose file`, locate and select `cms.lca` from your harddrive, and then choose `Import`.  
6. Allow LemonStand to upload and import the CMS templates.  
7. Follow the configuration instructions below.  

Please note the CMS templates (pages, partials, layouts) will be merged with any already existing 
in your store. Alternatively, and for version control, the `templates` directory contains filesystem CMS templates.

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

- Gallery images can be located in the `resources/images/gallery` folder.
- Color related variations can be found in `resources/css` folder, and `resources/images/colors` 
folder.
- Dialog message box text is located in the `resources/js/main.js` file.


Notes
---------------------------------------------------------------------------------------------------

- If you are using newsletter software or a service, do not forget to change the form on the home 
page.
- The `payment:braintree_transpredirect` partial has been included as a style reference for your 
payment form.
- Any PSDs used to create the layout, are in the `design` folder.  


Support
---------------------------------------------------------------------------------------------------

Please visit the LemonStand forums (http://forum.lemonstandapp.com/) for community support.
If you encounter a bug, please check/use the GitHub issues tracker.

