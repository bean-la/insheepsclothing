<?php
$location = get_post_meta($post->ID, '_igv_event_location', true);
$datetime = get_post_meta($post->ID, '_igv_event_datetime', true);
?>
<article <?php post_class('grid-item item-s-12 item-m-4 margin-bottom-basic'); ?> id="post-<?php the_ID(); ?>">
  <div class="margin-bottom-tiny">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-item-small'); ?></a>
  </div>
  <div>
    <h2 class="font-size-large font-cond margin-bottom-tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </div>
  <div class="grid-row">
    <?php if (!empty($location)) { ?>
      <div class="item-s-6"><span><?php echo $location; ?></span></div>
    <?php } if (!empty($datetime)) { ?>
      <div class="item-s-6"><time datetime="<?php echo date('Y-m-d', $datetime); ?>"><?php echo date("F j, Y", $datetime); ?></time></div>
    <?php } ?>
  </div>
</article>
