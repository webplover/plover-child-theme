<?php

define('WPR_THEME_VERSION', '1.1.2');

// Enqueue Scripts

require_once(get_stylesheet_directory() . '/wpr-inc/wpr-scripts.php');

// Register Post Types
require_once(get_stylesheet_directory() . '/wpr-inc/custom-post-types.php');

// WPR Recent Posts
require_once(get_stylesheet_directory() . '/wpr-inc/wpr-recent-posts.php');

// ShortCodes
require_once(get_stylesheet_directory() . '/wpr-inc/shortcodes.php');

// WPR Breadcrumbs
require_once(get_stylesheet_directory() . '/wpr-inc/wpr-breadcrumbs.php');

add_action('kadence_single_before_entry_title', function () {
  echo wpr_breadcrumbs();
});


// WooCommerce Custom Functionality
require_once(get_stylesheet_directory() . '/wpr-inc/WooCommerce/custom_functionality.php');
require_once(get_stylesheet_directory() . '/wpr-inc/WooCommerce/product-hosting.php');
require_once(get_stylesheet_directory() . '/wpr-inc/WooCommerce/subscription_checkout_validation.php');



// Cutom code just for test
