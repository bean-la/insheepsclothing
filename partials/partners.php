<?php
$args = array(
  'post_type' => 'partner',
  'posts_per_page' => -1,
  'orderby' => 'date',
);

$query = new WP_Query($args);

if ($query->have_posts()) {
?>

<section class="padding-top-basic padding-bottom-basic">

  <div class="container">
    <div class="grid-row">
      <div class="grid-item margin-bottom-basic">
        <h2 class="font-size-mid font-uppercase">Partners</h2>
      </div>
    </div>
  </div>

  <div class="post-category-swiper swiper-container container grid-row hide">
    <div class="swiper-wrapper">
    <?php
      while ($query->have_posts()) {
        $query->the_post();
        $logo = get_post_meta($post->ID, '_igv_partner_logo', true);
    ?>
      <div class="post-category-slide swiper-slide">
        <a href="<?php the_permalink(); ?>">
          <img src="<?php echo $logo; ?>" />
        </a>
      </div>
    <?php
      }
    ?>
    </div>
    <div class="swiper-scrollbar"></div>
  </div>

</section>

<?php
}

wp_reset_postdata();
?>
