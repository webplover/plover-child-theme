<?php
function typesDropDown() {
  $taxonomies = get_terms('type');
  ob_start();
  ?>

  <div style="margin:1rem auto 3rem;width:max-content">
    <select class="projectTypesDDM" onchange="location = this.value;">
      <?php

      $all_link = home_url("projects");
      echo "<option value='$all_link'>All</option>";

      if (!empty($taxonomies)) :
      foreach ($taxonomies as $category) {
        $link = get_term_link($category);
        echo "<option value='$link'>$category->name</option>";
      }
      endif;
      ?>
    </select>
  </div>
  <?php
  return ob_get_clean();
}
add_shortcode('types_drop_down', 'typesDropDown');