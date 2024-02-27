<?php
$featured_albums = get_post_meta($post->ID, '_igv_featured_albums', true);
?>

<section class="background-woodgrain padding-top-small">

  <?php get_template_part('assets/woodgrain.svg'); ?>

<?php
if (!empty($featured_albums)) {
?>

  <div id="featured-albums-swiper" class="swiper-container grid-row align-items-center hide">
    <div class="swiper-wrapper align-items-center">
    <?php
      foreach ($featured_albums as $album_id) {
    ?>
      <article <?php post_class('swiper-slide album-featured-slide text-align-center padding-top-basic padding-bottom-basic'); ?> id="post-<?php echo $album_id; ?>">
        <a href="<?php echo get_the_permalink($album_id); ?>">
          <?php echo get_the_post_thumbnail($album_id, 'full', array('data-no-lazysizes' => 'true')); ?>
          <div class="slide-info-icon not-desktop"><?php get_template_part('assets/info.svg'); ?></div>
        </a>
      </article>
    <?php
      }
    ?>
    </div>
    <div id="featured-albums-swiper-pagination" class="swiper-pagination-holder">
      <div class="prev-slide"><?php get_template_part('assets/arrow-left.svg'); ?></div>
      <div class="next-slide"><?php get_template_part('assets/arrow-right.svg'); ?></div>
    </div>
  </div>

<?php
}
?>
</section>
