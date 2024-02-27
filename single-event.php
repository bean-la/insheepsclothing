<?php
get_header();
?>

<main id="main-content">
<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $location = get_post_meta($post->ID, '_igv_event_location', true);
    $datetime = get_post_meta($post->ID, '_igv_event_datetime', true);
    $start_time = get_post_meta($post->ID, '_igv_event_start', true);
    $end_time = get_post_meta($post->ID, '_igv_event_end', true);
    $summary = get_post_meta($post->ID, '_igv_event_summary', true);
    $eventbrite_embed = get_post_meta($post->ID, '_igv_event_eventbrite_embed', true);
?>
  <section class="padding-bottom-large padding-top-mid mobile-margin-top">
    <div class="container">
      <div class="grid-row">
        <header id="post-header" class="item-s-12 grid-row margin-bottom-tiny">
          <div class="grid-item item-s-12 item-l-6 margin-bottom-small">
            <h1 class="font-size-extra font-cond margin-bottom-small"><?php the_title(); ?></h1>
            <div class="grid-row">
              <?php if (!empty($location)) { ?>
                <div class="item-s-6">
                  <span><?php echo $location; ?></span>
                </div>
              <?php } if (!empty($datetime)) { ?>
                <div class="item-s-6">
                  <time datetime="<?php echo date('Y-m-d', $datetime); ?>"><?php
                    echo date("F j, Y", $datetime);
                    echo !empty($start_time) && !empty($end_time) ? ' ' . $start_time . '–' . $end_time : '';
                  ?></time>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="item-s-12 item-l-6 margin-bottom-small font-size-small grid-column justify-between">
            <div class="">
              <?php get_template_part('partials/post-share'); ?>
            </div>
            <?php if (!empty($summary)) { ?>
              <div class="grid-item font-mono font-size-basic margin-top-small">
                <?php echo $summary; ?>
              </div>
            <?php } ?>
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
        <?php if (!empty($eventbrite_embed)) { ?>
          <div class="grid-item item-s-12 grid-row justify-center">
            <div class="margin-top-small">
              <?php echo $eventbrite_embed; ?>
            </div>
          </div>
        <?php } ?>
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
