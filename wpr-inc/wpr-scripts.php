<?php

function WebPloverScripts()
{

  // Register Styles
  wp_register_style('wpr-custom', get_theme_file_uri('/wpr-assets/css/custom.css'), [], WPR_THEME_VERSION);
  wp_register_style('hosting-main-product', get_theme_file_uri('/wpr-assets/css/hosting-main-product.css'), [], WPR_THEME_VERSION);
  wp_register_style('hosting-plans-products', get_theme_file_uri('/wpr-assets/css/hosting-plans-products.css'), [], WPR_THEME_VERSION);



  // Register Scripts
  wp_register_script('project-types', get_theme_file_uri() . '/wpr-assets/js/project-types.js', [], WPR_THEME_VERSION, true);
  wp_register_script('hosting-main-product', get_theme_file_uri() . '/wpr-assets/js/WooCommerce/hosting-main-product.js', [], WPR_THEME_VERSION, true);
  wp_register_script('hosting-plans-products', get_theme_file_uri() . '/wpr-assets/js/WooCommerce/hosting-plans-products.js', [], WPR_THEME_VERSION, true);
  wp_register_script('wpr-woo-checkout', get_theme_file_uri() . '/wpr-assets/js/WooCommerce/woo-checkout.js', [], WPR_THEME_VERSION, true);



  // Enqueue 



  // Enqueue Styles & Scripts

  wp_enqueue_style('wpr-custom');
  // -------------------- //


  if (is_tax('type') || is_page('projects')) {
    wp_enqueue_script('project-types');
  }
  // -------------------- //


  if (is_single('cloud-hosting') && get_post_type() == 'product') {
    wp_enqueue_script('hosting-main-product');
    wp_enqueue_style('hosting-main-product');
  }
  // -------------------- //

  $wpr_hosting_plans = [
    'cloud-hosting-starter',
    'cloud-hosting-bronze',
    'cloud-hosting-silver',
    'cloud-hosting-gold',
    'cloud-hosting-platinum',
    'cloud-hosting-diamond'
  ];

  global $post;

  if (get_post_type() == 'product' && in_array($post->post_name, $wpr_hosting_plans)) {
    wp_enqueue_script('hosting-plans-products');
    wp_enqueue_style('hosting-plans-products');
  }

  // -------------------- //

  if (is_page('checkout')) {
    wp_enqueue_script('wpr-woo-checkout');
  }

  // -------------------- //

}

add_action('wp_enqueue_scripts', 'WebPloverScripts');
