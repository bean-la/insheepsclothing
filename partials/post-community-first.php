<?php
$args = array(
  'post_type' => 'post',
  'category_name' => 'community',
  'posts_per_page' => 1
);

$query = new WP_Query($args);

if ($query->have_posts()) {
  while ($query->have_posts()) {
    $query->the_post();
?>
<a href="<?php the_permalink(); ?>">
  <section id="recent-community-post" class="padding-top-mid" style="background-image: url('<?php the_post_thumbnail_url(); ?>');">
    <div class="container">
      <div class="grid-row justify-end">
        <div class="grid-item item-s-12 margin-bottom-tiny">
          <h2 class="font-size-extra font-bold"><?php the_title(); ?></h2>
        </div>
        <div class="grid-item item-s-11">
          <span>Written by <br><?php guest_authors($post->ID); ?></span>
        </div>
      </div>
    </div>
  </section>
</a>
<?php
  }
}
wp_reset_postdata();
?>
