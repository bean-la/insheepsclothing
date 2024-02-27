<?php
global $category_slug;
$category = get_category_by_slug($category_slug);

$args = array(
  'post_type' => 'post',
  'posts_per_page' => 6,
  'category__in' => $category->term_id,
);

$query = new WP_Query($args);

if ($query->have_posts()) {
?>

<section class="border-box background-almond padding-top-basic padding-bottom-basic">

  <div class="container">
    <div class="grid-row">
      <div class="grid-item margin-bottom-basic">
        <h2 class="font-size-mid font-uppercase"><?php echo $category->name; ?></h2>
      </div>
    </div>
  </div>

  <div class="post-category-swiper swiper-container container grid-row hide">
    <div class="swiper-wrapper">
    <?php
      while ($query->have_posts()) {
        $query->the_post();
    ?>
      <div class="post-category-slide swiper-slide <?php echo $category_slug === 'news' ? 'post-category-slide-small' : ''; ?>">
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
        <a class="link-underline" href="<?php echo get_category_link($category); ?>">View all <?php echo $category->name; ?></a>
      </div>
    </div>
  </div>

</section>

<?php
}

wp_reset_postdata();
?>
