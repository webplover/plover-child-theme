<?php



/**
 * Enable Gutenberg in woocommerce
 */

function activate_gutenberg_product($can_edit, $post_type)
{

  if ($post_type == 'product') {
    $can_edit = true;
  }
  return $can_edit;
}
add_filter('use_block_editor_for_post_type', 'activate_gutenberg_product', 10, 2);



/**
 * Change add to cart button text for 'variable-subscription' product
 */

add_filter('woocommerce_product_add_to_cart_text', function () {
  global $product;

  if ($product->get_type() === 'variable-subscription') {
    return __('Add to cart', 'woocommerce');
  }
});


/**
 * Empty cart before new item adding
 */

add_filter(
  'woocommerce_add_to_cart_validation',
  function ($passed) {
    // empty cart and new item will replace previous
    wc_empty_cart();
    return $passed;
  }
);


/**
 * Remove 'Continue Shopping' button from notice, when item added to cart
 */
add_filter('wc_add_to_cart_message', function ($string) {

  $start = strpos($string, '<a href=') ?: 0;
  $end = strpos($string, '</a>', $start) ?: 0;

  return substr($string, $end) ?: $string;
});


/**
 * Redirect to checkout page after add to cart success
 */

add_filter('woocommerce_add_to_cart_redirect', 'bbloomer_redirect_checkout_add_cart');

function bbloomer_redirect_checkout_add_cart()
{
  return wc_get_checkout_url();
}



/**
 * Manage checkout fields
 */

add_filter('woocommerce_checkout_fields', function ($fields) {

  /**
   * Unset website field in checkout if there is 'subscription renewal' or
   * 'switch subscription' (Upgrade or Downgrade) in the cart
   * 
   * ** Note : cart will auto empty by adding 'subscription renewal' or
   * 'switch subscription' (Upgrade or Downgrade) to cart
   * but if 'subscription renewal' is already in the cart then it will not add
   * switch subscription to cart.
   * but if 'switch subscription' is already in the cart then it will empty the cart and will add
   * 'subscription renewal' to cart.
   */


  foreach (WC()->cart->get_cart() as $item) {

    $sub_renewal_id = $item['subscription_renewal']['subscription_id'];
    $sub_switch_id = $item['subscription_switch']['subscription_id'];

    if (!empty($sub_renewal_id) || !empty($sub_switch_id))
      unset($fields['billing']['billing_website']);
  }

  return $fields;
}, 999999);


/**
 * Clear website field on checkout page
 */
add_filter('woocommerce_checkout_get_value', function ($null, $input) {

  if ($input == 'billing_website')
    return '';
}, 10, 2);


/**
 * Print the domain name disabled field after checkout form last field, for subscription which is going to renew or switch
 */
add_action('woocommerce_after_checkout_form', function () {

  foreach (WC()->cart->get_cart() as $cart_item) {

    $subscription_renewal = $cart_item['subscription_renewal']['subscription_id'];
    $subscription_switch = $cart_item['subscription_switch']['subscription_id'];

    if (isset($subscription_renewal) || $subscription_switch) {
      $product_id = $subscription_renewal ?? $subscription_switch;
      $get_website = wcs_get_subscription($product_id)->get_meta('_billing_website');
      echo '<div id="wpr_subscription_domain">
      <label style="display:block;line-height:2.4;font-weight:bold;">Website</label>
      <input style="width:100%;" type="text" value="' . $get_website . '" disabled>
      </div>';
    }
  }
});
