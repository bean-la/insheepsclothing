<?php
get_header();
?>

<main id="main-content">
<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();

    $product_handle = get_post_meta($post->ID, '_gws_product_handle', true);
    $artist = get_post_meta($post->ID, '_igv_product_artist', true);
    $title = get_post_meta($post->ID, '_igv_product_title', true);
    $catalog_num = get_post_meta($post->ID, '_igv_product_catalog_num', true);
    $tracklist = get_post_meta($post->ID, '_igv_product_tracklist', true);
    $credits = get_post_meta($post->ID, '_igv_product_credits', true);
    $format = get_post_meta($post->ID, '_igv_product_format', true);
    $sample_embed = get_post_meta($post->ID, '_igv_product_sample_embed', true);
    $preorder       = get_post_meta($post->ID, '_igv_product_preorder', true);

    $styles = get_the_terms($post->ID, 'style');
    $labels = get_the_terms($post->ID, 'label');
    $years = get_the_terms($post->ID, 'album_year');
    $countries = get_the_terms($post->ID, 'country');
    $tags = get_the_terms($post->ID, 'post_tag');

    $images = get_post_meta($post->ID, '_igv_product_images', true);

    $the_content = get_the_content();
    $album_id = $post->ID;
?>
  <div id="product-wrapper" class="mobile-padding-top">
    <section id="product-image-holder" class="padding-top-mid">
      <div class="container">
        <div class="grid-row">
          <div class="grid-item item-s-12 item-m-5 margin-bottom-basic">
            <div class="product-cover-holder font-mono <?php echo !empty($images) ? 'toggle-gallery' : ''; echo !empty($preorder) ? 'preorder' : ''; ?>">
              <?php the_post_thumbnail('large', array( 'alt' => get_the_title() . ' product image', 'data-no-lazysizes' => 'true')); ?>
              <?php if (!empty($images)) { ?>
                <div><span class="font-size-small font-sans">View Product Images</span></div>
                <?php get_template_part('assets/gallery-max.svg'); ?>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section
      id="product-content-holder"
      class="gws-product padding-top-mid"
      data-gws-product-handle="<?php echo $product_handle; ?>"
      data-gws-available="true"
      data-gws-price="false"
      data-gws-in-cart="false"
      data-gws-post-id="<?php echo $post->ID; ?>"
    >
      <div class="container">
        <div class="grid-row">
          <div class="item-s-12 item-m-6 offset-m-6 grid-column margin-bottom-small">
            <header class="grid-item margin-bottom-small" id="product-header">
              <h1 class="u-visuallyhidden"><?php the_title(); ?></h1>
              <?php if (!empty($artist)) { ?>
                <div>
                  <span class="font-cond font-size-large"><?php echo $artist; ?></span>
                </div>
              <?php } if (!empty($title)) { ?>
                <div>
                  <span class="font-sans font-size-large"><?php echo $title; ?></span>
                </div>
              <?php } ?>
            </header>
            <div class="grid-item margin-top-small margin-bottom-basic mobile-only" id="product-image-mobile">
              <div class="product-cover-holder font-mono <?php echo !empty($images) ? 'toggle-gallery ' : ''; echo !empty($preorder) ? 'preorder' : ''; ?>">
                <?php the_post_thumbnail('large', array( 'alt' => get_the_title() . ' product image', 'data-no-lazysizes' => 'true')); ?>
                <?php if (!empty($images)) { ?>
                  <div><span class="font-size-tiny font-sans">View Product Images</span></div>
                  <?php get_template_part('assets/gallery-max.svg'); ?>
                <?php } ?>
              </div>
            </div>
            <div class="grid-item margin-bottom-small" id="product-price">
              <span>Price $</span><span class="gws-product-price"><?php echo $title; ?></span><span> USD</span>
            </div>
            <div class="grid-item" id="product-options"></div>
            <div class="grid-item margin-bottom-small grid-row" id="product-button">
              <div class="item-s-12 item-m-6">
                <form class="gws-product-form" method="post" enctype='multipart/form-data'>
                  <input type="hidden" name="variant-id" class="gws-variant-id" value="" />
                  <button type="submit" class="shop-button gws-product-add u-pointer">
                    <span class="shop-button-add-to-cart"><?php echo ($preorder) ? 'Pre-order' : 'Add to Cart'; ?></span>
                    <span class="shop-button-sold-out">Out of Stock</span>
                    <span class="shop-button-in-the-cart">In the Cart</span>
                  </button>
                </form>
              </div>
            </div>
            <div class="grid-item margin-bottom-small" id="product-content">
              <?php the_content(); ?>
            </div>
            <div class="grid-item grid-row margin-bottom-small" id="product-details">
              <div class="item-m-10 offset-m-2">
                <?php if (!empty($styles)) { ?>
                  <div class="margin-bottom-micro">
                    <span class="font-cond margin-right-micro">Style: </span><?php
                      foreach($styles as $key => $value) {
                        echo '<span><a href="' . get_post_type_archive_link('product') . '?genre=' . $value->slug . '">' . $value->name . '</a></span>';
                        echo $key + 1 !== count($styles) ? ', ' : '';
                      }
                    ?>
                  </div>
                <?php } if (!empty($labels)) { ?>
                  <div class="margin-bottom-micro">
                    <span class="font-cond margin-right-micro">Label: </span><?php
                      foreach($labels as $key => $value) {
                        echo '<a href="' . get_post_type_archive_link('product') . '?label=' . $value->slug . '"><span>' . $value->name . '</span></a>';
                        echo $key + 1 !== count($labels) ? ', ' : '';
                      }
                    ?>
                  </div>
                <?php } if (!empty($catalog_num)) { ?>
                  <div class="margin-bottom-micro">
                    <span class="font-cond margin-right-micro">Catalog Number: </span><span><?php echo $catalog_num; ?></span>
                  </div>
                <?php } if (!empty($years)) { ?>
                  <div class="margin-bottom-micro">
                    <span class="font-cond margin-right-micro">Released: </span><?php
                      foreach($years as $key => $value) {
                        echo '<span>' . $value->name . '</span>';
                        echo $key + 1 !== count($years) ? ', ' : '';
                      }
                    ?>
                  </div>
                <?php } if (!empty($format)) { ?>
                  <div class="margin-bottom-micro">
                    <span class="font-cond margin-right-micro">Format: </span><span><?php echo $format; ?></span>
                  </div>
                <?php } ?>
              </div>
            </div>

            <?php if (!empty($tracklist)) { ?>
              <div class="grid-item margin-bottom-small" id="product-tracklist">
                <div class="margin-bottom-tiny">
                  <span>Tracklist:</span>
                </div>
                <div>
                  <?php echo apply_filters('the_content', $tracklist); ?>
                </div>
              </div>
            <?php } if (!empty($credits)) { ?>
              <div class="grid-item margin-bottom-small" id="product-credits">
                <div class="margin-bottom-tiny">
                  <span>Credits:</span>
                </div>
                <div>
                  <?php echo apply_filters('the_content', $credits); ?>
                </div>
              </div>
            <?php } ?>

            <?php if (!empty($sample_embed)) { ?>
              <div class="grid-item margin-bottom-small" id="product-sample">
                <?php echo $sample_embed; ?>
              </div>
            <?php } ?>
            <span class="font-size-small font-sans" style="order: 1000">&nbsp;</span>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php get_template_part('partials/related-products'); ?>
<?php
  }
}
?>
</main>

<?php
get_footer();
?>
