<?php
get_header();
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
        <header id="post-header" class="item-s-12 grid-row margin-bottom-tiny justify-between">
          <div class="grid-item item-s-12 item-l-auto margin-bottom-small">
            <h1 class="font-size-extra font-cond"><?php the_title(); ?></h1>
          </div>
          <div class="item-s-12 item-l-auto margin-bottom-small font-size-small">
            <?php get_template_part('partials/post-share'); ?>
          </div>
        </header>
        <div class="grid-item item-s-12 margin-bottom-mid text-align-center">
          <figure>
            <?php the_post_thumbnail('full', array('id' => 'post-featured-image')); ?>
            <figcaption class="margin-top-micro font-size-small">
              <?php the_post_thumbnail_caption(); ?>
            </figcaption>
          </figure>
        </div>
        <div class="grid-item item-s-12 grid-row justify-center">
          <div id="post-content">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php get_template_part('partials/related-partner-posts'); ?>

  <?php get_template_part('partials/partner-featured-projects'); ?>

<?php
  }
}
?>
</main>

<?php
get_footer();
?>
