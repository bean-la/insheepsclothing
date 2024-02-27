<?php
global $featured_posts;

$args = array(
  'post_type' => array('post'),
  'posts_per_page' => 3,
  'post__not_in' => $featured_posts,
);

$query = new WP_Query($args);

if ($query->have_posts()) {
?>
<section class="border-box border-top-muck border-sides-orange background-almond padding-top-basic">
  <div class="container">
    <div class="grid-row">
<?php
  while ($query->have_posts()) {
    $query->the_post();
    get_template_part('partials/post-item-recent');
  }
?>
    </div>
  </div>
</section>
<?php
}
wp_reset_postdata();
