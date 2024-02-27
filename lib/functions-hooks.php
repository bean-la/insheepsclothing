<?php

// Custom hooks (like excerpt length etc)

// Programatically create pages
function create_custom_pages() {
  $custom_pages = array(
    'home' => 'Home',
    'about' => 'About',
    'features' => 'Features',
    'cart' => 'Cart',
  );
  foreach($custom_pages as $page_name => $page_title) {
    $page = get_page_by_path($page_name);
    if( empty($page) ) {
      wp_insert_post( array(
        'post_type' => 'page',
        'post_title' => $page_title,
        'post_name' => $page_name,
        'post_status' => 'publish'
      ));
    }
  }
}
add_filter( 'after_setup_theme', 'create_custom_pages' );

function igv_disable_gutenberg_for_post_type( $is_enabled, $post_type ) {
  if ( 'post' !== $post_type ) {  // disable for pages, change 'page' to you CPT slug
    return false;
  }

  return $is_enabled;
}

add_filter( 'use_block_editor_for_post_type', 'igv_disable_gutenberg_for_post_type', 10, 2 );

add_action( 'after_setup_theme', 'igv_setup' );
function igv_setup() {
  add_theme_support( 'align-wide' );
}

function igv_allowed_block_types( $allowed_blocks, $post ) {
  $allowed_blocks = array(
    'core/paragraph',
    'core/heading',
    'core/list',
    //'core/audio',
    'core/image',
    //'core/gallery',
    //'core/quote',
    'core/pullquote',
    'core/separator',
    'core/embed',
    'core-embed/youtube',
    'core-embed/vimeo',
    'core-embed/soundcloud',
    'core-embed/spotify',
    'core/html'
    //'core/video'
  );

	return $allowed_blocks;
}
add_filter( 'allowed_block_types', 'igv_allowed_block_types', 10, 2 );

function igv_custom_excerpt_length( $length ) {
  return 28;
}
add_filter( 'excerpt_length', 'igv_custom_excerpt_length', 999 );
