<?php
function wpr_recentPosts() {
  $the_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'post__not_in' => array(get_the_ID())
  ));

  if ($the_query->have_posts()) {

    $string = '';

    $string .= '<ul class="wpr-recent-posts">';


    while ($the_query->have_posts()) {


      $the_query->the_post();

      $string .= '<li>';

      $string .= '<a href="' . get_the_permalink() . '">' . get_the_post_thumbnail() . '</a>';

      $cat = get_the_category();


      $string .= '<div class="wpr-recentPost-content">';
      $string .= '<div class="wpr-recentPost-meta"><span class="wpr-recentPosts-date">' . get_the_date('M j • ') . '</span>' . '<a class="wpr-recentPosts-cat" href="' . get_category_link($cat[0]->cat_ID) . '">' . $cat[0]->cat_name . '</a></div>';

      $string .= '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';

      $string .= '<a class="wpr-recentPost-read-more" href="' . get_the_permalink() . '">Read more →</a>';

      $string .= '</div>';

      $string .= '</li>';
    }
  }

  $string .= '</ul>';

  return $string;


  wp_reset_postdata();
}


add_shortcode('wpr_recent_posts', 'wpr_recentPosts');