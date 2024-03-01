<?php

// Custom filters (like pre_get_posts etc)

// Page Slug Body Class
function add_slug_body_class( $classes ) {
  global $post;
  if (isset($post) && !is_home() && !is_archive()) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// Custom img attributes to be compatible with lazysize
function add_lazysize_on_srcset($attr, $attachment, $size) {

  if (!is_admin()) {

    // if image has data-no-lazysizes attribute dont add lazysizes classes
    if (isset($attr['data-no-lazysizes'])) {
      unset($attr['data-no-lazysizes']);
      return $attr;
    }

    $image = wp_get_attachment_image_src($attachment->ID, $size);

    // Add lazysize class
    $attr['class'] .= ' lazyload';

    if (isset($attr['srcset'])) {
      // Add lazysize data-srcset
      $attr['data-srcset'] = $attr['srcset'];
      // Remove default srcset
      unset($attr['srcset']);
    } else {
      // Add lazysize data-src
      $attr['data-src'] = $attr['src'];
    }

    $svg_color = 'rgb(200, 200, 200)';

    // Set default to white blank
    $attr['src'] = 'data:image/svg+xml,%3Csvg style="background-color:' . $svg_color . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $image[1] . ' ' . $image[2] . '"%3E%3C/svg%3E';

  }

  return $attr;

}
add_filter('wp_get_attachment_image_attributes', 'add_lazysize_on_srcset', 10, 3);

function igv_query_vars( $qvars ) {
    $qvars[] = 'sort';
    return $qvars;
}
add_filter( 'query_vars', 'igv_query_vars' );

function igv_set_playlist_query_args($query){
  $paged = $query->query_vars[ 'paged' ];

  if (!is_admin() &&
  $query->is_main_query() &&
  $query->is_category('playlist')) {
    $query->set( 'paged', $paged );

    $cat = get_category_by_slug('playlist');
    $latest_playlist = get_posts(array('category'=>$cat->term_id,'numberposts'=>1));

    $query->set('post__not_in', array($latest_playlist[0]->ID)); //exclude queries by post ID
    $query->set( 'posts_per_page', 6 );
  }
}
add_action('pre_get_posts','igv_set_playlist_query_args');

function igv_set_community_query_args($query){
  $paged = $query->query_vars[ 'paged' ];

  if (!is_admin() &&
  $query->is_main_query() &&
  $query->is_category('community')) {
    $query->set( 'paged', $paged );

    $cat = get_category_by_slug('community');
    $latest_community = get_posts(array('category'=>$cat->term_id,'numberposts'=>1));

    $query->set('post__not_in', array($latest_community[0]->ID)); //exclude queries by post ID
    $query->set( 'posts_per_page', 6 );
  }
}
add_action('pre_get_posts','igv_set_community_query_args');

function igv_set_event_query_args($query){
  $paged = $query->query_vars[ 'paged' ];

  if (!is_admin() &&
  $query->is_main_query() &&
  is_post_type_archive('event')) {
    $query->set( 'paged', $paged );

    $time = time();
    $upcoming_events = get_posts(array(
      'post_type' => 'event',
      'numberposts' => -1,
      'meta_query' => array(
        array(
          'key' => '_igv_event_datetime',
          'compare' => '>',
          'value' => $time - 86400
        )
      )
    ));

    function igv_return_post_id($p) {
      return $p->ID;
    }
    $upcoming_ids = array_map('igv_return_post_id', $upcoming_events);

    $query->set('post__not_in', $upcoming_ids); //exclude queries by post ID
    $query->set('meta_key', '_igv_event_datetime');
    $query->set('orderby', 'meta_value');
    $query->set('order', 'DESC');
    $query->set('posts_per_page', 6);
  }
}
add_action('pre_get_posts','igv_set_event_query_args');

function igv_set_album_query_args($query){
  if(!is_admin() && $query->is_main_query() && is_post_type_archive('album')){
    $query->set('posts_per_page', 24);

    $sort = $query->get('sort');

    switch ($sort) {
      case 'added_newest':
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
        $query->set('meta_key', null);
        break;
      case 'added_oldest':
        $query->set('orderby', 'date');
        $query->set('order', 'ASC');
        $query->set('meta_key', null);
        break;
      case 'artist_a_z':
        $query->set('orderby', 'meta_value');
        $query->set('order', 'ASC');
        $query->set('meta_key', '_igv_album_artist');
        break;
      case 'artist_z_a':
        $query->set('orderby', 'meta_value');
        $query->set('order', 'DESC');
        $query->set('meta_key', '_igv_album_artist');
        break;
      case 'release_newest':
        $query->set('orderby', 'meta_value');
        $query->set('order', 'DESC');
        $query->set('meta_key', '_igv_album_release_date');
        break;
      case 'release_oldest':
        $query->set('orderby', 'meta_value');
        $query->set('order', 'ASC');
        $query->set('meta_key', '_igv_album_release_date');
        break;
      default:
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
        $query->set('meta_key', null);
    }
  }
}
add_action('pre_get_posts','igv_set_album_query_args');

function igv_set_search_query_args($query) {
  if (!is_admin() && $query->is_search) {
    $query->set('post_type',array('post','album','product'));
    $query->set('posts_per_page', 10);
  }
  return $query;
}
add_filter('pre_get_posts','igv_set_search_query_args');

/*function igv_set_tag_archive_query_args($query) {
  if (!is_admin() && $query->is_tag()) {
    $query->set('post_type',array('post','album','product'));
    $query->set('posts_per_page', 10);
  }
  return $query;
}
add_filter('pre_get_posts','igv_set_tag_archive_query_args');*/

function igv_set_product_archive_query_args($query) {
  if(!is_admin() && $query->is_main_query() && is_post_type_archive('product')){
    $query->set('posts_per_page', 48);
  }
  return $query;
}
add_filter('pre_get_posts','igv_set_product_archive_query_args');

add_filter( 'pre_get_posts', 'product_lists' );
function product_lists( $query ) {
  if (is_post_type_archive('product')) {
    if ( !is_admin() && $query->is_main_query() ) {
      if ( $_GET['list'] ) {
        $args = array(
          'name' => $_GET['list'],
          'post_type' => 'product_list',
          'numberposts' => 1,
        );
        $product_list = get_posts($args);
        $products_from_list = get_post_meta($product_list[0]->ID, 'products');
        $query->set('post__in', $products_from_list[0]);
      }
    }
  }
  return $query;
}

add_filter( 'pre_get_posts', 'product_sort' );
function product_sort( $query ) {
  if (is_post_type_archive('product')) {
    if ( !is_admin() && $query->is_main_query() ) {
      // Filter for store homepage sort functionality
      if ( $_GET['sort'] ) {
        switch ($_GET['sort']) {
          case 'featured':
            $query->set( 'meta_query', array(
              'relation' => 'OR',
              array(
                  'key' => '_igv_product_featured', 
                  'compare' => 'NOT EXISTS'
              ),
              array(
                  'key' => '_igv_product_featured', 
                  'compare' => 'EXISTS'
              ),
            ) );
            $query->set( 'orderby', '_igv_product_featured date' ); 
            $query->set( 'order', 'DESC' ); 
            break;
          case 'newest': 
            $query->set('orderby', 'post_date');
            $query->set('order', 'DESC');
            break;
          case 'oldest':
            $query->set('orderby', 'post_date');
            $query->set('order', 'ASC');
            break;
          }
        }

        // Filter for genre filter
        if ( $_GET['genre'] ) {
          $genres = explode ("," , $_GET['genre'] );
          $query->set('tax_query', array(
            array (
              'taxonomy' => 'style',
              'field' => 'slug',
              'terms' => $genres
            )
          ));
        }

        // Filter for format filter
        if ( $_GET['format'] ) {
          $formats  = explode(',', $_GET['format']);
          $genres   = explode(',', $_GET['genre']);
  
          $query->set('tax_query', array(
            array (
              'taxonomy' => 'format',
              'field' => 'slug',
              'terms' => $formats,
            )
          ));

          if ($_GET['genre']) {
            $query->set('tax_query', array(
              'relation' => 'AND',
                array (
                  'taxonomy' => 'format',
                  'field' => 'slug',
                  'terms' => $formats,
                ),
                array (
                  'taxonomy' => 'style',
                  'field' => 'slug',
                  'terms' => $genres,
                )
            ));
          }
          
          if ($_GET['label']) {
            $query->set('tax_query', array(
              'relation' => 'AND',
                array (
                  'taxonomy' => 'label',
                  'field' => 'slug',
                  'terms' => $_GET['label'],
                )
            ));
          }
        }
      }
    }
  return $query;
}