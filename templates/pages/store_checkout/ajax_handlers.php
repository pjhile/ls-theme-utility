<?
function on_updateBilling($controller) {
  Shop_CheckoutData::set_billing_info(null);
}

function on_updateShipping($controller) {
  Shop_CheckoutData::set_shipping_info(null);
}

function on_copyBillingToShipping($controller) {
  $billing_info = Shop_CheckoutData::get_billing_info();

  $shipping_info = Shop_CheckoutData::get_shipping_info();
  $shipping_info->copy_from($billing_info);

  Shop_CheckoutData::set_shipping_info($shipping_info);
}
?>