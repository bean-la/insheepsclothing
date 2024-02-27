<?php

$related_track = get_posts(array(
  'numberposts' => 1,
  'post_type' => 'track',
  'meta_key' => '_igv_track_album',
  'meta_value' => $post->ID,
));
?>
<div id="album-streaming" class="grid-item item-s-12 no-gutter">
  <div class="grid-row">
    <div class="grid-item item-s-12 item-m-3 margin-bottom-tiny">
      <span class="font-cond">Hi-Fi Stream:</span>
    </div>
    <div class="flex-grow">
    <?php
    if (!empty($related_track)) {
      $track_id = $related_track[0]->ID;
      $title = get_the_title($track_id);
      $thumb_url = get_the_post_thumbnail_url($track_id);
      $media_url = get_post_meta($track_id, '_igv_track_cloudinary', true);
      if (!empty($media_url)) {
    ?>
      <div class="u-inline-block margin-bottom-tiny">
        <div class="stream-button player-skip album-stream u-pointer"
          data-title="<?php echo $title; ?>"
          data-thumb="<?php echo !empty($thumb_url) ? $thumb_url : get_the_post_thumbnail_url($post->ID); ?>"
          data-media="<?php echo $media_url; ?>"
          data-url="<?php echo get_permalink(); ?>"
          data-id="<?php echo $track_id; ?>">
            <?php get_template_part('assets/streaming-iscroom.svg'); ?>
          </div>
      </div>
    <?php
      }
    }

    $services = array(
      'qobuz',
      'tidal'
    );

    foreach ($services as $service) {
      $meta_key = '_igv_album_' . $service . '_url';
      $url = get_post_meta($post->ID, $meta_key, true);
      $button_asset = 'assets/streaming-' . $service . '.svg';

      if (!empty($url)) {
    ?>
      <div class="u-inline-block margin-bottom-tiny">
        <a class="stream-button u-pointer streaming-service" href="<?php echo $url; ?>" target="_blank">
          <?php get_template_part($button_asset); ?>
        </a>
      </div>
    <?php
      }
    }
    ?>
    </div>
  </div>
  <div class="grid-row">
    <div class="grid-item item-s-12 item-m-3 margin-bottom-tiny">
      <span class="font-cond">Standard Stream:</span>
    </div>
    <div class="flex-grow">
    <?php
    $services = array(
      'amazon',
      'apple',
      'spotify',
      'youtube',
      'bandcamp'
    );

    foreach ($services as $service) {
      $meta_key = '_igv_album_' . $service . '_url';
      $url = get_post_meta($post->ID, $meta_key, true);
      $button_asset = 'assets/streaming-' . $service . '.svg';

      if (!empty($url)) {
    ?>
      <div class="u-inline-block margin-bottom-tiny">
        <a class="stream-button u-pointer streaming-service" href="<?php echo $url; ?>" target="_blank">
          <?php get_template_part($button_asset); ?>
        </a>
      </div>
    <?php
      }
    }
    ?>
    </div>
  </div>
</div>
