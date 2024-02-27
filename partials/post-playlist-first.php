<?php
$args = array(
  'post_type' => 'post',
  'category_name' => 'playlist',
  'posts_per_page' => 1
);

$query = new WP_Query($args);

if ($query->have_posts()) {
?>

<section id="recent-post" class="padding-top-mid mobile-margin-top">
  <div class="container">
    <div class="grid-row">
    <?php
      while ($query->have_posts()) {
        $query->the_post();
        get_template_part('partials/post-item-first');
      }
    ?>
    </div>
  </div>
</section>

<?php
}
wp_reset_postdata();
