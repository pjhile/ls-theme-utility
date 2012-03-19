# ls-module-contact
Provides a contact form for your store.

## Installation
1. Download [Contact](https://github.com/limewheel/ls-module-contact/zipball/master).
1. Create a folder named `contact` in the `modules` directory.
1. Extract all files into the `modules/contact` directory (`modules/contact/readme.md` should exist).
1. Setup the configuration in the control panel.
1. Setup your code as described in the `Usage` section.
1. Done!

## Links

* [Marketplace](https://lemonstandapp.com/marketplace/module/contact/)
* [Discussion](http://forum.lemonstandapp.com/topic/2235-module-contact/)
* [Source](https://github.com/limewheel/ls-module-contact)

## Usage
Create a `Contact` page with this content:

```php
<?
	$redirect = root_url('/');
	
	$name = post('name', 'Name');
	$email = post('email', 'Email');
	$message = post('message', 'Comment/Question');
	$phone = post('phone', 'Phone');
?>

<h1>Contact</h1>

<?= open_form(array('onsubmit' => "return $(this).sendRequest('contact:on_submit')")) ?>
  <input type="hidden" name="redirect" value="<?= $redirect ?>" />
  <input type="hidden" name="flash" value="Thank you! We will get back to you shortly." />
  
  <ul>
    <li>
      <input type="text" name="name" value="<?= $name ?>" />
    </li>
    <li>
      <input type="text" name="email" value="<?= $email ?>" />
    </li>
    <li>
      <textarea name="message" cols="32" rows="12"><?= $message ?></textarea>
    </li>
    <li>
      <input type="text" name="phone" value="<?= $phone ?>" />
    </li>
  </ul>
  
  <input type="submit" value="Submit" />
<?= close_form() ?>
```