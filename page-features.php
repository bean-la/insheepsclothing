<?php
get_header();
?>

<main id="main-content">

<?php
$args = array(
  'post_type' => 'post',
  'posts_per_page' => 1,
  'category_name' => 'feature',
);

$query = new WP_Query($args);

if ($query->have_posts()) {
?>

  <section class="padding-top-mid mobile-margin-top">
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

$args = array(
  'post_type' => 'post',
  'posts_per_page' => 4,
  'offset' => 1,
  'category_name' => 'feature',
);

$query = new WP_Query($args);

if ($query->have_posts()) {
?>

  <section class="border-box background-almond padding-bottom-basic padding-top-basic">
    <div class="container">
      <div class="grid-row margin-bottom-basic">
        <div class="grid-item">
          <h2 class="font-size-mid font-uppercase">Features</h2>
        </div>
      </div>

      <div class="grid-row">
      <?php
        while ($query->have_posts()) {
          $query->the_post();
          get_template_part('partials/post-item');
        }
      ?>
      </div>

      <div class="grid-row justify-end">
        <div class="grid-item">
          <a class="link-underline" href="<?php echo get_category_link(get_cat_ID( 'feature' )); ?>">View all Features</a>
        </div>
      </div>
    </div>
  </section>

<?php
}

wp_reset_postdata();

$features_cats = [
  'interview',
  'archival',
  'news'
];

foreach ($features_cats as $slug) {
  global $category_slug;
  $category_slug = $slug;
  get_template_part('partials/post-category-carousel');
}

?>

</main>

<?php
get_footer();
?>
