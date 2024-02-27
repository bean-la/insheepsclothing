<?php
$args = array(
  'post_type' => array('product'),
  'posts_per_page' => 4,
  'orderby' => 'rand',
  'post__not_in' => array(get_the_ID()),
  'meta_query' => array(
    'relation' => 'OR',
    array(
      'key' => '_igv_product_soldout',
      'compare' => 'NOT EXISTS'
    ),
    array(
      'key' => '_igv_product_soldout',
      'value'   => 'on',
      'compare' => '!=',
    )
  )
);

$query = new WP_Query($args);

if ($query->have_posts()) {
?>
<section class="padding-top-basic padding-bottom-mid">
  <div class="container">
    <div class="grid-row">
      <div class="grid-item item-s-12 margin-bottom-small">
        <h2>You might also Like</h2>
      </div>
      <?php
        while ($query->have_posts()) {
          $query->the_post();
          get_template_part('partials/product-item');
        }
      ?>
    </div>
  </div>
</section>
<?php
}
wp_reset_postdata();
?>
