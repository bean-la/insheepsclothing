<?php
$images = get_post_meta($post->ID, '_igv_' . get_post_type() . '_images', true);
?>
<div id="overlay-gallery" class="grid-row align-items-center">
  <div id="overlay-gallery-swiper" class="swiper-container">
    <div id="overlay-gallery-swiper-wrapper" class="swiper-wrapper align-items-center">
    <?php
      if (!empty($images)) {
        foreach ($images as $id => $url) {
    ?>
      <div class="swiper-slide overlay-gallery-slide">
        <?php echo wp_get_attachment_image($id, 'large', false, array('data-no-lazysizes' => 'true')); ?>
      </div>
    <?php
        }
      }
    ?>
    </div>
    <div class="swiper-pagination-holder margin-top-small">
      <div class="container">
        <div class="grid-row justify-center">
          <div class="grid-item u-pointer prev-slide"><?php get_template_part('assets/arrow-left.svg'); ?></div>
          <div class="grid-item u-pointer next-slide"><?php get_template_part('assets/arrow-right.svg'); ?></div>
        </div>
      </div>
    </div>
  </div>
  <div id="close-gallery-holder" class="padding-top-small padding-right-small">
    <div class="toggle-gallery">
      <?php get_template_part('assets/gallery-min.svg'); ?>
    </div>
  </div>
</div>
<?php
?>
