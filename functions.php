<?php

// Enqueue

function scripts_and_styles_method() {
  $templateuri = get_template_directory_uri();
  $javascriptMain = $templateuri . '/dist/js/main.js';

  $is_admin = current_user_can('administrator') ? 1 : 0;
  $options = get_site_option('_igv_site_options');

  $player_options = get_site_option('_igv_player_options');
  $playlist = array();
  if (!empty($player_options['player_playlist'])) {
    $playlist_index = 0;

    foreach($player_options['player_playlist'] as $track_id) {
      $cloudinary_media_url = get_post_meta($track_id, '_igv_track_cloudinary', true);
      $wordpress_media_url = get_post_meta($track_id, '_igv_track_wordpress', true);
      $related_album = get_post_meta($track_id, '_igv_track_album', true);
      $related_album_url = !empty($related_album) ? get_the_permalink($related_album) : false;
      $thumb_url = get_the_post_thumbnail_url($track_id, 'thumbnail');

      if (!empty($cloudinary_media_url) || !empty($wordpress_media_url)) {

        $media_url = null;
        if (!empty($wordpress_media_url)) {
          $media_url = $wordpress_media_url;
        } else if (!empty($cloudinary_media_url)) {
          $media_url = $cloudinary_media_url;
        }

        if (!has_post_thumbnail($track_id) && !empty($related_album)) {
          $thumb_url = get_the_post_thumbnail_url($related_album);
        }

        array_push($playlist, [
          'title' => get_the_title($track_id),
          'thumbUrl' => $thumb_url,
          'mediaUrl' => $media_url,
          'relatedAlbumUrl' => $related_album_url,
          'index' => $playlist_index
        ]);

        $playlist_index++;
      }
    }
  } else {
    $playlist = false;
  }

  $shopify_domain = gws_get_option('_gws_shopify_domain');
  $shopify_token = gws_get_option('_gws_shopify_token');
  $shopify_item_slug = gws_get_option('_gws_shopify_item_slug');
  $shopify_currencies = gws_get_option('_gws_shopify_currencies');

  $javascriptVars = array(
    'siteUrl' => home_url(),
    'themeUrl' => get_template_directory_uri(),
    'isAdmin' => $is_admin,

    'mailchimp' => $options['mailchimp_action'],
    'postsPerPage' => get_query_var('posts_per_page'),

    'playerPlaylist' => json_encode($playlist),
    'playerShuffle' => $player_options['player_shuffle'] ?? false,

    'domain' => !empty($shopify_domain) ? $shopify_domain : null,
    'storefrontAccessToken' => !empty($shopify_token) ? $shopify_token : null,
    'itemSlug' => !empty($shopify_item_slug) ? $shopify_item_slug : null,
    'currencies' => !empty($shopify_currencies) ? $shopify_currencies : null,
  );

  wp_enqueue_script('jquery');

  wp_register_script('javascript-main', $javascriptMain, array(), '2.21', true);
  wp_localize_script('javascript-main', 'WP', $javascriptVars);
  wp_enqueue_script('javascript-main');

  // Enqueue style
  wp_enqueue_style( 'style-site', get_stylesheet_directory_uri() . '/dist/css/site.css', [], '2.1' );

  // dashicons for admin
  if (is_admin()) {
    wp_enqueue_style( 'dashicons' );
  }
}
add_action('wp_enqueue_scripts', 'scripts_and_styles_method');

// Declare thumbnail sizes

get_template_part( 'lib/thumbnail-sizes' );

// Register Nav Menus
/*
register_nav_menus( array(
  'menu_location' => 'Location Name',
) );
 */

// Add third party PHP libs

function cmb_initialize_cmb_meta_boxes() {
  if (!class_exists( 'cmb2_bootstrap_202' ) ) {
    require_once 'vendor/cmb2/cmb2/init.php';
    require_once 'vendor/alexis-magina/cmb2-field-post-search-ajax/cmb-field-post-search-ajax.php';
    //require_once 'vendor/webdevstudios/cmb2-attached-posts/cmb2-attached-posts-field.php';
  }
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 11 );

function composer_autoload() {
  require_once( 'vendor/autoload.php' );
}
add_action( 'init', 'composer_autoload', 10 );

// Add libs

get_template_part( 'lib/custom-gallery' );
get_template_part( 'lib/post-types' );
get_template_part( 'lib/taxonomies' );
get_template_part( 'lib/meta-boxes' );
get_template_part( 'lib/site-options' );
get_template_part( 'lib/shopify' );

// Add custom functions

get_template_part( 'lib/functions-misc' );
get_template_part( 'lib/functions-custom' );
get_template_part( 'lib/functions-filters' );
get_template_part( 'lib/functions-hooks' );
get_template_part( 'lib/functions-utility' );

?>
