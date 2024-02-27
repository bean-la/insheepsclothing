<?php
get_header();

$selection = get_post_meta($post->ID, '_igv_post_selection', true);
?>

<main id="main-content">
<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
?>
  <section class="padding-bottom-large padding-top-mid mobile-margin-top">
    <div class="container">
      <div class="grid-row">
        <header id="post-header" class="item-s-12 grid-row margin-bottom-tiny">
          <div id="post-title-holder" class="grid-item item-s-12 item-l-6 margin-bottom-small">
            <?php
              $category = get_the_category($post->ID);
              if ($category[0]->slug !== 'uncategorized') {
            ?>
              <div class="margin-bottom-tiny">
                <a href="<?php echo get_category_link($category[0]); ?>" class="font-uppercase font-size-small"><?php echo $category[0]->name; ?></a>
              </div>
            <?php
              }
            ?>

            <h1 class="font-size-extra font-cond"><?php the_title(); ?></h1>
          </div>
          <div id="post-details-holder" class="item-s-12 item-l-6 margin-bottom-small font-size-small">
            <div class="grid-row">
              <div class="grid-item item-s-8 item-l-6 offset-l-2 margin-bottom-tiny">
                <div><span>Written By:&nbsp;</span></div>
                <?php guest_authors($post->ID); ?>
              </div>
              <div class="grid-item item-s-4 margin-bottom-tiny">
                <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time>
              </div>
            </div>
            <?php get_template_part('partials/post-tags'); ?>
            <?php get_template_part('partials/post-share'); ?>
          </div>
        </header>
      <?php if (empty($selection)) { ?>
        <div class="grid-item item-s-12 margin-bottom-mid text-align-center">
          <figure>
            <?php the_post_thumbnail('full', array('id' => 'post-featured-image')); ?>
            <figcaption class="margin-top-micro font-size-small">
              <?php the_post_thumbnail_caption(); ?>
            </figcaption>
          </figure>
        </div>
      <?php } ?>
        <div class="grid-item item-s-12 grid-row justify-center">
          <div id="post-content">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php get_template_part('partials/post-selection'); ?>

  <?php get_template_part('partials/related-posts'); ?>

<?php
  }
}
?>
</main>

<?php
get_footer();
?>
