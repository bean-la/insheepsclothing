<?php
$player_options = get_site_option('_igv_player_options');
$playlist = $player_options['player_playlist'];

if (!empty($playlist)) {
?>

<div id="playlist" class="padding-bottom-mid">
  <ul id="playlist-items" class="container padding-top-tiny padding-bottom-large grid-row">
  <?php
    foreach($playlist as $track_index => $track_id) {
      $cloudinary_media_url = get_post_meta($track_id, '_igv_track_cloudinary', true);
      $wordpress_media_url = get_post_meta($track_id, '_igv_track_wordpress', true);
      if ($cloudinary_media_url || $wordpress_media_url) {
        $related_album = get_post_meta($track_id, '_igv_track_album', true);
        $thumb_url = get_the_post_thumbnail_url($track_id);

        if (!has_post_thumbnail($track_id) && !empty($related_album)) {
          $thumb_url = get_the_post_thumbnail_url($related_album, 'thumbnail');
        }
  ?>
    <li class="item-s-12 playlist-item player-skip u-pointer grid-row justify-between align-items-center padding-top-micro padding-bottom-micro flex-nowrap" data-id="<?php echo $track_id; ?>">
      <div class="grid-item">
        <div class="player-thumb-holder">
          <img src="<?php echo $thumb_url ? $thumb_url : ''; ?>" class="playlist-item-thumb <?php echo $thumb_url ? '' : 'u-visuallyhidden'; ?>" alt="<?php echo the_title(); ?> album cover" data-no-lazysizes="true" />
        </div>
      </div>
      <div class="grid-item flex-grow">
        <div>
          <span class="playlist-item-title"><?php echo get_the_title($track_id); ?></span>
        </div>
      </div>
    </li>
  <?php 
      }
    } 
  ?>
  </ul>
</div>

<?php
}
?>
