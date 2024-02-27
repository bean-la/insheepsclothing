<?php
$artist = get_post_meta($post->ID, '_igv_album_artist', true);
$title = get_post_meta($post->ID, '_igv_album_title', true);
$styles = get_the_terms($post->ID, 'style');

$style_slugs = array();
foreach ($styles as $key => $value) {
  array_push($style_slugs, $value->slug);
}
$filter = json_encode(array(
  'title' => get_the_title(),
  'styles' => $style_slugs,
  'time' => get_post_time()
));
?>

<article <?php post_class('grid-item item-s-6 item-m-4 item-l-3 margin-bottom-basic'); ?> id="album-<?php the_ID(); ?>" data-filter="<?php echo $filter; ?>">
  <a href="<?php the_permalink() ?>">
    <h3 class="u-visuallyhidden"><?php the_title(); ?></h3>
    <div><?php the_post_thumbnail('album-item'); ?></div>
  </a>
</article>
