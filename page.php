<?php
get_header();
?>

<main id="main-content">
<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
?>
  <section class="gws-cart padding-bottom-large padding-top-mid mobile-margin-top">
    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 item-m-8 offset-m-2 item-l-6 offset-l-3">
          <h1 class="margin-bottom-basic"><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </section>
<?php
  }
}
?>
</main>

<?php
get_footer();
?>
