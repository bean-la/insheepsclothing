<?php
$product_handle = get_post_meta($post->ID, '_gws_product_handle', true);
$product_title = get_post_meta($post->ID, '_igv_product_title', true);
$product_artist = get_post_meta($post->ID, '_igv_product_artist', true);
$product_format = get_post_meta($post->ID, '_igv_product_format', true);
$preorder       = get_post_meta($post->ID, '_igv_product_preorder', true);
$product_labels = get_the_terms($post->ID, 'label');

if ( $product_labels && ! is_wp_error( $product_labels ) ) {

	$labels = array();

	foreach ( $product_labels as $label ) {
		$labels[] = $label->name;
	}
						
	$product_labels = join( ", ", $labels );

}

?>
<article
  <?php post_class('gws-product item-s-4 item-m-4 grid-column margin-bottom-basic'); ?>
  id="post-<?php the_ID(); ?>"
  data-gws-product-handle="<?php echo $product_handle; ?>"
  data-gws-available="true"
  data-gws-price="false"
>
  <div class="grid-item item-s-12 margin-bottom-tiny">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('album-item'); ?></a>
    <?php if ($preorder) { echo '<div class="font-mono label">PRE-ORDER</div>'; } ?>
  </div>
  <div class="grid-item item-s-12">
    <div class="grid-row margin-bottom-micro">
      <div class="item-s-auto flex-grow flex-basis-min-content">
        <h3 class="font-bold"><a href="<?php the_permalink(); ?>"><?php echo $product_artist ?></a></h3>
        <h4 class=""><a href="<?php the_permalink(); ?>"><?php echo $product_title ?></a></h3>
      </div>
      <div class="font-bold product-price padding-left-micro"><span>$</span><span class="gws-product-price"></span></div>
      <div class="font-bold product-sold-out padding-left-micro"><span>Out of Stock</span></div>
    </div>
    <div class="product-format font-mono"><span class="font-bold">Format:</span> <?php echo $product_format; ?></div>
    <div class="product-label font-mono"><span class="font-bold">Label:</span> <?php echo $product_labels; ?></div>
  </div>
</article>