<section class="padding-top-basic padding-bottom-basic border-box background-almond">
  <div class="container">
    <div class="grid-row">
      <div class="grid-item item-s-12 margin-bottom-basic">
        <h2 class="font-size-mid font-uppercase">Featured</h2>
      </div>
    </div>
  </div>

<?php
global $featured_posts;
$featured_posts = array();

$args = array(
  'post_type' => 'post',
  'category_name' => 'feature',
  'posts_per_page' => 1,
  'post__in' => get_option( 'sticky_posts' ),
  //'ignore_sticky_posts' => 1
);

$query = new WP_Query($args);

if ($query->have_posts()) {
?>
  <div class="container">
    <div class="grid-row">
<?php
  while ($query->have_posts()) {
    $query->the_post();

    array_push($featured_posts, $post->ID);

    get_template_part('partials/post-item-first');
  }
?>
    </div>
  </div>
<?php
  }
  wp_reset_postdata();

  get_template_part('partials/home-featured-carousel');
?>

</section>
