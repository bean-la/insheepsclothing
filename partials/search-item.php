<?php
$post_type = get_post_type();
?>
<article <?php post_class('grid-item item-s-12 item-m-6 grid-row flex-nowrap search-result margin-bottom-small'); ?> id="post-<?php the_ID(); ?>">
  <div>
    <a href="<?php the_permalink(); ?>">
      <div class="search-thumb-holder margin-right-tiny" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')"></div>
    </a>
  </div>
  <div class="flex-grow">
    <a href="<?php the_permalink(); ?>">
      <div>
        <span class="font-uppercase font-size-small"><?php
          if ($post_type === 'album') {
            echo 'Album';
          } else if ($post_type === 'post') {
            $category = get_the_category($post->ID);
            echo $category[0]->slug === 'uncategorized' ? 'Feature' : $category[0]->name;
          } else {
            echo 'Product';
          }
        ?></span>
      </div>
      <div>
        <span class="font-cond font-size-mid">
          <?php
            if ($post_type === 'album') {
              $artist = get_post_meta($post->ID, '_igv_album_artist', true);
              echo !empty($artist) ? '<span>' . $artist . '</span>' : '';
            } else if ($post_type === 'product') {
              $artist = get_post_meta($post->ID, '_igv_product_artist', true);
              echo !empty($artist) ? '<span>' . $artist . '</span>' : '';
            } else {
              the_title();
            }
          ?>
        </span>
      </div>
      <div>
        <?php
          if ($post_type === 'post') {
            guest_authors($post->ID);
          } else if ($post_type === 'album') {
            $title = get_post_meta($post->ID, '_igv_album_title', true);
            echo !empty($title) ? $title : get_the_title();
          } else if ($post_type === 'product') {
            $title = get_post_meta($post->ID, '_igv_product_title', true);
            echo !empty($title) ? $title : get_the_title();
          }
        ?>
      </div>
    </a>
  </div>
</article>
