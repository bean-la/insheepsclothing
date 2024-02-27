<?php
$post_id = get_the_ID();
$post_cats = wp_get_post_categories($post_id);
$post_tags = get_the_tags($post->ID);
$tag_ids = array();

if ($post_tags) {
  foreach( $post_tags as $tag ) {
    $tag_ids[] = $tag->term_id;
  }
}

$args = array(
  'post_type' => 'post',
  'category__in' => $post_cats,
  'post__not_in' => array($post_id),
  'tag__in' => $tag_ids,
  'posts_per_page' => 6,
  'orderby' => 'date',
);

$related_query = new WP_Query($args);

if ($related_query->found_posts < 6) {
  $exclude_ids = array($post_id);
  $tag_query_found = $related_query->found_posts;

  if ($tag_query_found > 0) {
    $tag_query_ids = wp_list_pluck( $related_query->posts, 'ID' );
    $exclude_ids = array_merge(array($post_id), $tag_query_ids);
  }

  $tag_query = $related_query;

  $args = array(
    'post_type' => 'post',
    'category__in' => $post_cats,
    'post__not_in' => $exclude_ids,
    'posts_per_page' => 6 - $tag_query_found,
    'orderby' => 'date',
  );

  $cat_query = new WP_Query($args);

  $related_query = new WP_Query();

  if ($tag_query_found > 0) {
    $related_query->posts = array_merge( $tag_query->posts, $cat_query->posts );
    $related_query->post_count = $tag_query->post_count + $cat_query->post_count;
  } else {
    $related_query = $cat_query;
  }
}

if ($related_query->have_posts()) {
?>

<section class="padding-top-basic padding-bottom-basic border-box background-almond">

  <div class="container">
    <div class="grid-row">
      <div class="grid-item margin-bottom-basic">
        <h2 class="font-size-mid font-uppercase">Related Articles</h2>
      </div>
    </div>
  </div>

  <div class="post-category-swiper swiper-container container grid-row hide">
    <div class="swiper-wrapper">
    <?php
      while ($related_query->have_posts()) {
        $related_query->the_post();
    ?>
      <div class="post-category-slide swiper-slide">
        <?php get_template_part('partials/post-item'); ?>
      </div>
    <?php
      }
    ?>
    </div>
    <div class="swiper-scrollbar"></div>
  </div>

  <div class="container">
    <div class="grid-row justify-end margin-top-basic">
      <div class="grid-item">
        <a class="link-underline" href="<?php echo home_url('features'); ?>">View Features Archive</a>
      </div>
    </div>
  </div>

</section>

<?php
}

wp_reset_postdata();
?>
