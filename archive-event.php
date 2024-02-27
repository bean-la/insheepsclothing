<?php
get_header();

global $wp_query;
$max_pages = $wp_query->max_num_pages;
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$current_query = $wp_query->query_vars;
$queried_object = get_queried_object();
$is_first_page = $current_page === 1;
?>

<main id="main-content">

<?php
if ($is_first_page) {
  $time = time();
  $featured_id = null;

  $args = array(
    'post_type' => 'event',
    'posts_per_page' => 1,
    'meta_key'   => '_igv_event_featured',
    'meta_value' => 'on',
    'meta_key' => '_igv_event_datetime',
    'orderby' => 'meta_value',
    'order' => 'DESC'
  );

  $query = new WP_Query($args);

  if (!$query->have_posts()) {
    $args = array(
      'post_type' => 'event',
      'posts_per_page' => 1,
      'meta_key' => '_igv_event_datetime',
      'orderby' => 'meta_value',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => '_igv_event_datetime',
          'compare' => '>',
          'value' => $time - 86400
        )
      )
    );

    $query = new WP_Query($args);
  }

  if ($query->have_posts()) {
?>
  <section id="recent-post" class="padding-top-mid mobile-margin-top">
    <div class="container">
      <div class="grid-row">
      <?php
        while ($query->have_posts()) {
          $query->the_post();
          $featured_id = $post->ID;
          get_template_part('partials/event-item-first');
        }
      ?>
      </div>
    </div>
  </section>
<?php
  }

  wp_reset_postdata();

  $args = array(
    'post_type' => 'event',
    'posts_per_page' => -1,
    'meta_key' => '_igv_event_datetime',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'post__not_in' => array($featured_id),
    'meta_query' => array(
      array(
        'key' => '_igv_event_datetime',
        'compare' => '>',
        'value' => $time - 86400
      )
    )
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) {
?>
  <section class="border-box background-almond padding-bottom-basic padding-top-basic">
    <div class="container">

      <div class="grid-row margin-bottom-basic">
        <div class="grid-item">
          <h2 class="font-size-mid font-uppercase">Upcoming Events</h2>
        </div>
      </div>

      <div class="grid-row">
        <?php
        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post();

            get_template_part('partials/event-item');
          }
        }
        ?>
      </div>

    </div>
  </section>
<?php
  }

  wp_reset_postdata();
}

if (have_posts()) {
?>

  <section class="border-box background-almond padding-bottom-basic padding-top-basic<?php echo $is_first_page ? '' : ' margin-top-mid mobile-margin-top'; ?>">

    <div class="container">

      <div class="grid-row margin-bottom-basic">
        <div class="grid-item">
          <h2 class="font-size-mid font-uppercase">Past Events</h2>
        </div>
      </div>

      <div id="posts" class="grid-row" data-maxpages="<?php echo $max_pages; ?>">
        <?php
          while (have_posts()) {
            the_post();

            get_template_part('partials/event-item');
          }
        ?>
      </div>

      <?php
        if ($max_pages > $current_page) {
          $post_type_archive = get_post_type_archive_link('event');

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
}
?>
</main>

<?php
get_footer();
?>
