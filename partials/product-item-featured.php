<?php
$product_handle = get_post_meta($post->ID, '_gws_product_handle', true);
$product_title = get_post_meta($post->ID, '_igv_product_title', true);
$product_artist = get_post_meta($post->ID, '_igv_product_artist', true);
?>
<article
  <?php post_class('gws-product item-s-12 item-m-6 grid-column margin-bottom-basic'); ?>
  id="post-<?php the_ID(); ?>"
  data-gws-product-handle="<?php echo $product_handle; ?>"
  data-gws-available="true"
  data-gws-price="false"
>
  <div class="grid-item item-s-12 margin-bottom-tiny">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-item'); ?></a>
  </div>
  <div class="grid-item item-s-12">
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <div class="product-price"><span>$</span><span class="gws-product-price"></span></div>
    <div class="product-sold-out"><span>Out of Stock</span></div>
  </div>
</article>
