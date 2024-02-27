<?php

if( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}

if( function_exists( 'add_image_size' ) ) {
  add_image_size( 'opengraph', 1200, 630, true );
  add_image_size( 'album-item', 600, 9999, false );
  add_image_size( 'gallery', 1200, 9999, false );
  add_image_size( 'post-item', 1220, 660, true);
  add_image_size( 'post-item-small', 394, 248, true);
  add_image_size( 'post-item-first', 1220, 900, true);
}
