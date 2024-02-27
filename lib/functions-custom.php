<?php

// Custom functions (like special queries, etc)

function custom_filter($args) {
?>
<div class="font-size-small filter-wrapper">
  <div class="filter <?php echo !empty($args['filter_class']) ? $args['filter_class'] : ''; ?>">
    <div class="filter-trigger text-align-center <?php echo !empty($args['trigger_class']) ? $args['trigger_class'] : ''; ?>">
      <span class="filter-value <?php echo !empty($args['value_class']) ? $args['value_class'] : ''; ?>"><?php $args['initial_value']() ?></span>
    </div>
    <div class="filter-options grid-column text-align-center <?php echo !empty($args['options_class']) ? $args['options_class'] : ''; ?>">
      <?php $args['filter_options'](); ?>
    </div>
  </div>
</div>
<?php
}

function guest_authors($post_id) {
  $authors = get_the_terms($post_id, 'guest_author');
  if ($authors) {
    foreach($authors as $key => $value) {
      echo '<span class="font-size-small"><a href="' . get_post_type_archive_link('post') . '?guest_author=' . $value->slug . '">' . $value->name . '</a></span>';
      echo $key + 1 !== count($authors) ? ', ' : '';
    }
  }
}

add_theme_support( 'editor-font-sizes', array());
