<?php
$location = get_post_meta($post->ID, '_igv_event_location', true);
$datetime = get_post_meta($post->ID, '_igv_event_datetime', true);
$start_time = get_post_meta($post->ID, '_igv_event_start', true);
$end_time = get_post_meta($post->ID, '_igv_event_end', true);
$summary = get_post_meta($post->ID, '_igv_event_summary', true);
?>
<article <?php post_class('padding-bottom-basic'); ?> id="post-<?php the_ID(); ?>">
  <div class="mobile-only">
    <div class="grid-row">
      <div class="grid-item no-gutter item-s-12 grid-row">
        <div class="grid-item item-s-auto flex-grow margin-bottom-tiny">
          <?php if (!empty($location)) { ?>
            <span><?php echo $location; ?></span>
          <?php } ?>
        </div>
        <div class="grid-item margin-bottom-tiny">
          <?php if (!empty($datetime)) { ?>
            <time datetime="<?php echo date('Y-m-d', $datetime); ?>"><?php echo date("F j, Y", $datetime); ?></time>
          <?php } ?>
        </div>
      </div>
      <div class="grid-item item-s-12">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-item-first', array('data-no-lazysizes' => 'true')); ?></a>
      </div>
      <div class="grid-item item-s-9 margin-bottom-small">
        <h2 class="font-cond font-size-extra"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </div>
      <div class="grid-item item-s-12 font-mono">
        <?php if (!empty($summary)) {
          echo '<p>' . $summary . '</p>';
        } else {
          the_excerpt();
        } ?>
      </div>
      <div class="grid-item offset-s-9">
        <a href="<?php the_permalink(); ?>"><img class="icon-clickthru" src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/clickthru.png" /></a>
      </div>
    </div>
  </div>
  <div class="not-mobile">
    <div class="grid-row">
      <div class="no-gutter grid-item item-s-6 grid-row align-content-between">
        <div class="grid-item no-gutter item-s-12 grid-row">
          <div class="grid-item item-s-12 margin-bottom-small">
            <h2 class="font-cond font-size-extra"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          </div>
          <div class="grid-item no-gutter item-s-12 grid-row margin-bottom-small flex-nowrap">
            <div class="grid-item item-s-auto flex-grow">
              <?php if (!empty($location)) { ?>
                <span><?php echo $location; ?></span>
              <?php } ?>
            </div>
            <div class="grid-item">
              <?php if (!empty($datetime)) { ?>
                <time datetime="<?php echo date('Y-m-d', $datetime); ?>"><?php
                  echo date("F j, Y", $datetime);
                  echo !empty($start_time) && !empty($end_time) ? ' ' . $start_time . '–' . $end_time : '';
                ?></time>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="grid-item item-s-12 font-mono">
          <?php if (!empty($summary)) {
            echo '<p>' . $summary . '</p>';
          } else {
            the_excerpt();
          } ?>
        </div>
      </div>
      <div class="grid-item item-s-6">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-item-first', array('data-no-lazysizes' => 'true')); ?></a>
      </div>
    </div>
  </div>
</article>
