<?
function set_billing_info($controller) {
  Shop_CheckoutData::set_billing_info(null);
}

function set_shipping_info($controller) {
  Shop_CheckoutData::set_shipping_info(null);
}

function copy_billing_info($controller) {
  $billing_info = Shop_CheckoutData::get_billing_info();

  $shipping_info = Shop_CheckoutData::get_shipping_info();
  $shipping_info->copy_from($billing_info);

  Shop_CheckoutData::set_shipping_info($shipping_info);
}
?>