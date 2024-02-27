<?php
get_header();

global $wp_query;
$max_pages = $wp_query->max_num_pages;
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>

<main id="main-content">
  <section class="padding-top-mid mobile-margin-top">
    <div class="container">
      <?php get_template_part('partials/collection-filter'); ?>
    </div>
  </section>

  <section class="border-box background-almond padding-top-basic padding-bottom-basic">
    <div class="container">
      <div id="posts" class="grid-row" data-maxpages="<?php echo $max_pages; ?>">
<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    get_template_part('partials/album-item');
  }
} else {
?>
        <div class="grid-item"><span>There's nothing here!</span></div>
<?php
}
?>
      </div>
      <?php
        $post_type_archive = get_post_type_archive_link('album');
        $load_more_url = add_query_arg( array(
          'paged' => $current_page + 1,
        ), $post_type_archive);
      ?>
      <div class="grid-row justify-end">
        <div class="grid-item">
          <a id="load-more" class="load-more-button <?php echo $max_pages > $current_page ? '' : 'hide'; ?>" data-context="load-more" data-maxpages="<?php echo $max_pages; ?>" href="<?php echo $load_more_url; ?>">Load More</a>
        </div>
      </div>
    </div>
  </section>

</main>

<?php
get_footer();
?>
