<?php

/**
 * Custom validation for domain name,
 * this validation will check, that domain name should not contain
 * on "https", "http", ":", "/", "www.", "www"
 * and also check, that domain should be in lowercase.
 */
add_filter('flexible_checkout_fields_custom_validation', 'custom_validation_for_domain');
function custom_validation_for_domain($custom_validation)
{
  $custom_validation['domain'] = array(
    'label'     => 'Domain',
    'callback'  => 'is_wpr_domain_valid'
  );
  return $custom_validation;
}

function is_wpr_domain_valid($field_label, $value)
{

  if (!empty($value)) {
    // Check if domain not contain on 'www' and 'http'
    if (preg_match("/http|www\./i", $value)) {

      wc_add_notice('Please enter a valid domain like <strong>yourdomain.com</strong>', 'error');

      /**/
    } elseif (strtolower($value) != $value) { // Check if domain name is in lowercase

      wc_add_notice('Please enter your domain in lowercase like <strong>yourdomain.com</strong>', 'error');

      /**/
    } elseif (strpos($value, ".") === false) { // domain should countain atleast one dot

      wc_add_notice('Please enter a valid domain like <strong>yourdomain.com</strong>', 'error');

      /**/
    } elseif (filter_var($value, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) === false) { // Check if domain is contains only alphanumeric characters

      wc_add_notice('Please enter your domain only in alphanumeric characters like <strong>yourdomain.com</strong> or <strong>yourdomain123.com</strong>', 'error');

      /**/
    }
  }
}



/**
 * It will run after domain name validation, it aim is, do not place order if a subscription already
 * exists for submited domain, means with this validation, user could not order subscription for
 * same domain twice.
 */

add_action('woocommerce_after_checkout_validation', 'rei_after_checkout_validation');

function rei_after_checkout_validation($posted)
{
  // Get all domains that has subscription
  $subscriptions = wcs_get_subscriptions(['subscriptions_per_page' => -1]);
  foreach ($subscriptions as $subscription) {
    $data = $subscription->get_meta_data();
    $all_domains_that_has_subscription[] = $data[0]->get_data()['value'];
  }

  $billing_website = $_POST['billing_website'];

  // Validation
  if (in_array($billing_website, $all_domains_that_has_subscription)) {
    wc_add_notice('A subscription for "' . __($billing_website .  '" already exists', 'woocommerce'), 'error');
  }
}
