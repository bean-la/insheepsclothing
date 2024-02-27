<?php
get_header();

global $wp_query;
$max_pages = $wp_query->max_num_pages;
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$current_query = $wp_query->query_vars;
$queried_object = get_queried_object();

$is_playlist_archive = $queried_object->slug === 'playlist';
$is_first_playlist_page = $current_page === 1 && $is_playlist_archive;

$is_community_archive = $queried_object->slug === 'community';
$is_first_community_page = $current_page === 1 && $is_community_archive;
?>

<main id="main-content">

<?php
if ($is_first_playlist_page) {
  get_template_part('partials/post-playlist-first');
}

if ($is_first_community_page) {
  get_template_part('partials/post-community-first');
}
?>

  <section class="border-box background-almond padding-bottom-basic padding-top-basic<?php echo ($is_first_playlist_page || $is_first_community_page) ? '' : ' margin-top-mid mobile-margin-top'; ?>">

    <div class="container">

      <div class="grid-row margin-bottom-basic">
        <div class="grid-item">
          <?php if (is_category() || is_tag() || is_tax()) { ?>
            <h2 class="font-size-mid font-uppercase"><?php echo single_term_title(); ?></h2>
          <?php } if (is_home()) { ?>
            <h2 class="font-size-mid font-uppercase">All Posts</h2>
          <?php } ?>
        </div>
      </div>

      <div id="posts" class="grid-row" data-maxpages="<?php echo $max_pages; ?>">

      <?php
      if (have_posts()) {
        while (have_posts()) {
          the_post();

          if ($is_playlist_archive || $is_community_archive) {
            get_template_part('partials/post-item-small');
          } else {
            get_template_part('partials/post-item');
          }
        }
      }
      ?>

      </div>

      <?php
        if ($max_pages > $current_page) {
          $post_type_archive = get_post_type_archive_link('post');

          if (!is_home()) {
            $post_type_archive = get_term_link($queried_object->term_id);
          }

          $load_more_url = add_query_arg( array(
            'paged' => $current_page + 1,
          ), $post_type_archive);
      ?>
      <div class="grid-row justify-end">
        <div class="grid-item">
          <a id="load-more" class="load-more-button" data-context="load-more" data-maxpages="<?php echo $max_pages; ?>" href="<?php echo $load_more_url; ?>">Load More</a>
        </div>
      </div>
      <?php } ?>
    </div>

  </section>

  <?php
    if ($is_community_archive) {
      get_template_part('partials/partners');
    }
  ?>

</main>

<?php
get_footer();
?>
