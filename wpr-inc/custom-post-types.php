<?php


function reg_post_types() {

  // Register Project Post Type

  register_post_type('project', array(
    'capability_type' => 'project',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'show_in_rest' => true,
    'rewrite' => array(
      'with_front' => false
    ),
    'labels' => array(
      'name' => 'Projects',
      'add_new_item' => 'Add New Project',
      'edit_item' => 'Edit Project',
      'all_items' => 'All Projects',
      'singular_name' => 'Project'
    ),
    'menu_icon' => 'dashicons-media-archive'
  ));

  // Register Career Post Type

  register_post_type('career', array(
    'capability_type' => 'career',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'public' => true,
    'show_in_rest' => true,
    'rewrite' => array(
      'with_front' => false
    ),
    'labels' => array(
      'name' => 'Careers',
      'add_new_item' => 'Add New Career',
      'edit_item' => 'Edit Career',
      'all_items' => 'All Careers',
      'singular_name' => 'Career'
    ),
    'menu_icon' => 'dashicons-universal-access'
  ));

  // Register Service Post Type

  register_post_type('service', array(
    'capability_type' => 'service',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'show_in_rest' => true,
    'rewrite' => array(
      'with_front' => false
    ),
    'labels' => array(
      'name' => 'Services',
      'add_new_item' => 'Add New Service',
      'edit_item' => 'Edit Service',
      'all_items' => 'All Services',
      'singular_name' => 'Service'
    ),
    'menu_icon' => 'dashicons-chart-pie'
  ));

  // Register Amazon Post Type

  register_post_type('amazon', array(
    'capability_type' => 'amazon',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'show_in_rest' => true,
    'rewrite' => array(
      'with_front' => false
    ),
    'labels' => array(
      'name' => 'Amazon',
      'add_new_item' => 'Add New Product',
      'edit_item' => 'Edit Product',
      'all_items' => 'All Products',
      'singular_name' => 'Product'
    ),
    'menu_icon' => 'dashicons-amazon'
  ));

}


add_action('init', 'reg_post_types');

// End

// Register Taxonomies

add_action('init', 'wpr_register_taxonomy');

function wpr_register_taxonomy() {

  // Register Type Taxonomy for Projects CPT

  $projects_type_tax_labels = array(
    'name' => 'Types',
    'singular_name' => 'Type',
    'search_items' => 'Search Types',
    'all_items' => 'All Types',
    'parent_item' => 'Parent Type',
    'parent_item_colon' => 'Parent Type:',
    'edit_item' => 'Edit Type',
    'update_item' => 'Update Type',
    'add_new_item' => 'Add New Type',
    'new_item_name' => 'New Type Name',
    'menu_name' => 'Types',
  );

  register_taxonomy('type', array('project'), array(
    'hierarchical' => true,
    'labels' => $projects_type_tax_labels,
    'show_admin_column' => true,
    'rewrite' => array(
      'slug' => 'project-type',
      'with_front' => false
    ),
  ));

  // Register Category Taxonomy for Amazon CPT

  $products_type_tax_labels = array(
    'name' => 'Categories',
    'singular_name' => 'Category',
    'search_items' => 'Search Categories',
    'all_items' => 'All Categories',
    'parent_item' => 'Parent Category',
    'parent_item_colon' => 'Parent Category:',
    'edit_item' => 'Edit Category',
    'update_item' => 'Update Category',
    'add_new_item' => 'Add New Category',
    'new_item_name' => 'New Category Name',
    'menu_name' => 'Categories',
  );

  register_taxonomy('amazon-products', array('amazon'), array(
    'hierarchical' => true,
    'labels' => $products_type_tax_labels,
    'show_admin_column' => true,
    'rewrite' => array(
      'slug' => 'amazon-products',
      'with_front' => false
    ),
  ));

}

// End

/*
// Exclude projects from search result

add_action('pre_get_posts', 'exclude_projects_from_search');
function exclude_projects_from_search($query) {

  if (is_admin() || !$query->is_main_query())
    return;

  if ($query->is_search()) {

    $in_search_post_types = get_post_types(array('exclude_from_search' => false));
    $post_type_to_remove = 'projects';

    if (is_array($in_search_post_types) && in_array($post_type_to_remove, $in_search_post_types)) {

      unset($in_search_post_types[$post_type_to_remove]);
      $query->set('post_type', $in_search_post_types);
    }
  }
}
*/