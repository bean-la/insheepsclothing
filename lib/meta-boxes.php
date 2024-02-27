<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
  $args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
  ) );
  $posts = get_posts( $args );
  $post_options = array();
  if ( $posts ) {
    foreach ( $posts as $post ) {
      $post_options [ $post->ID ] = $post->post_title;
    }
  }
  return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_igv_';

  /**
   * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
   */

  // POST

  $post_metabox = new_cmb2_box( array(
    'title'         => __( 'Options', 'cmb2' ),
    'id'            => 'post_metabox',
    'object_types'  => array( 'post', ), // Post type
  ) );

  $post_metabox->add_field( array(
		'name'       => __( 'Selection Name', 'cmb2' ),
		'id'         => $prefix . 'post_selection_name',
		'type'       => 'text',
	) );

  $post_metabox->add_field( array(
		'name'    => __( 'Selection', 'cmb2' ),
		'desc'    => __( 'Drag tracks from the left column to the right column to add them to the playlist.<br />You may rearrange the order of the posts in the right column by dragging and dropping.', 'cmb2' ),
		'id'      => $prefix . 'post_selection',
		'type'    => 'custom_attached_posts',
		'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
		'options' => array(
			'show_thumbnails' => true, // Show thumbnails on the left
			'filter_boxes'    => true, // Show a text box for filtering the results
			'query_args'      => array(
				'posts_per_page' => 10,
				'post_type'      => 'album',
			), // override the get_posts args
		),
	) );

  // ALBUM

  $album_metabox = new_cmb2_box( array(
    'title'         => __( 'Settings', 'cmb2' ),
    'id'            => 'album_metabox',
    'object_types'  => array( 'album', ), // Post type
  ) );

  $album_metabox->add_field( array(
		'name'       => __( 'Images', 'cmb2' ),
		'id'         => $prefix . 'album_images',
		'type'       => 'file_list',
	) );

	$album_metabox->add_field( array(
		'name'       => __( 'Artist', 'cmb2' ),
		'id'         => $prefix . 'album_artist',
		'type'       => 'text',
	) );

	$album_metabox->add_field( array(
		'name'       => __( 'Title', 'cmb2' ),
		'id'         => $prefix . 'album_title',
		'type'       => 'text',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'Catalog Number', 'cmb2' ),
		'id'         => $prefix . 'album_catalog_num',
		'type'       => 'text',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'Release Date', 'cmb2' ),
		'id'         => $prefix . 'album_release_date',
		'type'       => 'text',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'Tracklist', 'cmb2' ),
		'id'         => $prefix . 'album_tracklist',
		'type'       => 'textarea',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'Credits', 'cmb2' ),
		'id'         => $prefix . 'album_credits',
		'type'       => 'textarea',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'Qobuz URL', 'cmb2' ),
		'id'         => $prefix . 'album_qobuz_url',
		'type'       => 'text_url',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'Tidal URL', 'cmb2' ),
		'id'         => $prefix . 'album_tidal_url',
		'type'       => 'text_url',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'Amazon Music URL', 'cmb2' ),
		'id'         => $prefix . 'album_amazon_url',
		'type'       => 'text_url',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'Apple Music URL', 'cmb2' ),
		'id'         => $prefix . 'album_apple_url',
		'type'       => 'text_url',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'Spotify URL', 'cmb2' ),
		'id'         => $prefix . 'album_spotify_url',
		'type'       => 'text_url',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'YouTube URL', 'cmb2' ),
		'id'         => $prefix . 'album_youtube_url',
		'type'       => 'text_url',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'Bandcamp URL', 'cmb2' ),
		'id'         => $prefix . 'album_bandcamp_url',
		'type'       => 'text_url',
	) );

  $album_metabox->add_field( array(
		'name'       => __( 'Soundcloud URL', 'cmb2' ),
		'id'         => $prefix . 'album_soundcloud_url',
		'type'       => 'text_url',
	) );

  // PRODUCT

  $product_metabox = new_cmb2_box( array(
    'title'         => __( 'Settings', 'cmb2' ),
    'id'            => 'product_metabox',
    'object_types'  => array( 'product', ), // Post type
  ) );

  $product_metabox->add_field( array(
		'name'       => __( 'Pre-order', 'cmb2' ),
		'id'         => $prefix . 'product_preorder',
		'type'       => 'checkbox',
	) );

  $product_metabox->add_field( array(
		'name'       => __( 'Featured', 'cmb2' ),
		'id'         => $prefix . 'product_featured',
		'type'       => 'checkbox',
	) );

  $product_metabox->add_field( array(
		'name'       => __( 'Sold Out', 'cmb2' ),
		'id'         => $prefix . 'product_soldout',
		'type'       => 'checkbox',
	) );

  $product_metabox->add_field( array(
		'name'       => __( 'Images', 'cmb2' ),
		'id'         => $prefix . 'product_images',
		'type'       => 'file_list',
	) );

	$product_metabox->add_field( array(
		'name'       => __( 'Artist', 'cmb2' ),
		'id'         => $prefix . 'product_artist',
		'type'       => 'text',
	) );

	$product_metabox->add_field( array(
		'name'       => __( 'Title', 'cmb2' ),
		'id'         => $prefix . 'product_title',
		'type'       => 'text',
	) );

  $product_metabox->add_field( array(
		'name'       => __( 'Catalog Number', 'cmb2' ),
		'id'         => $prefix . 'product_catalog_num',
		'type'       => 'text',
	) );

  $product_metabox->add_field( array(
		'name'       => __( 'Release Date', 'cmb2' ),
		'id'         => $prefix . 'product_release_date',
		'type'       => 'text',
	) );

  $product_metabox->add_field( array(
		'name'       => __( 'Format', 'cmb2' ),
		'id'         => $prefix . 'product_format',
		'type'       => 'text',
	) );

  $product_metabox->add_field( array(
		'name'       => __( 'Tracklist', 'cmb2' ),
		'id'         => $prefix . 'product_tracklist',
		'type'       => 'textarea',
	) );

  $product_metabox->add_field( array(
		'name'       => __( 'Credits', 'cmb2' ),
		'id'         => $prefix . 'product_credits',
		'type'       => 'textarea',
	) );

  $product_metabox->add_field( array(
		'name'       => __( 'Sample Embed', 'cmb2' ),
		'id'         => $prefix . 'product_sample_embed',
		'type'       => 'wysiwyg',
    'sanitization_cb' => false
	) );

  // TRACK

  $track_metabox = new_cmb2_box( array(
    'title'         => __( 'Settings', 'cmb2' ),
    'id'            => 'track_metabox',
    'object_types'  => array( 'track', ), // Post type
  ) );

  $track_metabox->add_field( array(
		'name'       => __( 'Soundcloud URL', 'cmb2' ),
		'id'         => $prefix . 'track_soundcloud',
		'type'       => 'text_url',
	) );

  $track_metabox->add_field( array(
    'name'       => __( 'Cloudinary URL', 'cmb2' ),
    'id'         => $prefix . 'track_cloudinary',
    'type'       => 'text_url',
  ) );

  $track_metabox->add_field( array(
    'name'       => __( 'Wordpress Media', 'cmb2' ),
    'id'         => $prefix . 'track_wordpress',
    'type'       => 'file',
  ) );

  $track_metabox->add_field( array(
    'name'      	=> __( 'Related Album', 'cmb2' ),
    'id'        	=> $prefix . 'track_album',
    'type'      	=> 'post_search_ajax',
    // Optional :
    'limit'      	=> 1,
    'query_args'	=> array(
      'post_type'			=> array( 'album' ),
      'post_status'		=> array( 'publish' ),
      'posts_per_page'	=> -1
    )
  ) );

  // HOME

  $home_page = get_page_by_path('home');

  if (!empty($home_page)) {
    $home_metabox = new_cmb2_box( array(
  		'id'            => 'home_metabox',
  		'title'         => __( 'Settings', 'cmb2' ),
  		'object_types'  => array( 'page', ), // Post type
      'show_on'      => array(
        'key' => 'id',
        'value' => array( $home_page->ID )
      ),
  	) );

    $home_metabox->add_field( array(
  		'name'      	=> __( 'Featured Albums', 'cmb2' ),
  		'id'        	=> $prefix . 'featured_albums',
  		'type'    => 'custom_attached_posts',
  		'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
  		'options' => array(
  			'show_thumbnails' => true, // Show thumbnails on the left
  			'filter_boxes'    => true, // Show a text box for filtering the results
  			'query_args'      => array(
  				'posts_per_page' => 10,
  				'post_type'      => 'album',
  			), // override the get_posts args
  		),
  	) );
  }

  // PARTNERS

  $partner_metabox = new_cmb2_box( array(
    'title'         => __( 'Options', 'cmb2' ),
    'id'            => 'partner_metabox',
    'object_types'  => array( 'partner', ), // Post type
  ) );

  $partner_metabox->add_field( array(
  	'name'     => 'Select Partner Tag',
  	'id'       => $prefix . 'partner_tag',
  	'desc'     => 'Type the name of the term and select from the options',
  	'type'     => 'term_ajax_search',
    'multiple-item' => true,
		'limit'      	=> 1,
		'query_args'	=> array(
			'taxonomy'			=> 'post_tag',
			'hide_empty'		=> false
		)
  ) );

  $partner_projects_id = $partner_metabox->add_field( array(
  	'id'          => $prefix . 'partner_projects',
  	'type'        => 'group',
  	'description' => __( 'Featured projects', 'cmb2' ),
  	// 'repeatable'  => false, // use false if you want non-repeatable group
  	'options'     => array(
  		'group_title'       => __( 'Project {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
  		'add_button'        => __( 'Add Another Project', 'cmb2' ),
  		'remove_button'     => __( 'Remove Project', 'cmb2' ),
  		'sortable'          => true,
  		// 'closed'         => true, // true to have the groups closed by default
  		// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
  	),
  ) );

  $partner_metabox->add_group_field( $partner_projects_id, array(
  	'name' => 'Title',
  	'id'   => 'title',
  	'type' => 'text',
  ) );

  $partner_metabox->add_group_field( $partner_projects_id, array(
  	'name' => 'Link',
  	'id'   => 'url',
  	'type' => 'text_url',
  ) );

  $partner_metabox->add_group_field( $partner_projects_id, array(
  	'name' => 'Image',
  	'id'   => 'image',
  	'type' => 'file',
  ) );

  $partner_metabox->add_field( array(
		'name'       => __( 'Logo', 'cmb2' ),
		'id'         => $prefix . 'partner_logo',
		'type'       => 'file',
	) );

  // EVENTS

  $event_metabox = new_cmb2_box( array(
    'title'         => __( 'Options', 'cmb2' ),
    'id'            => 'event_metabox',
    'object_types'  => array( 'event', ), // Post type
  ) );

  $event_metabox->add_field( array(
		'name'       => __( 'Featured', 'cmb2' ),
		'id'         => $prefix . 'event_featured',
		'type'       => 'checkbox',
	) );

  $event_metabox->add_field( array(
		'name'       => __( 'Location', 'cmb2' ),
		'id'         => $prefix . 'event_location',
		'type'       => 'text',
	) );

  $event_metabox->add_field( array(
		'name'       => __( 'Date', 'cmb2' ),
		'id'         => $prefix . 'event_datetime',
		'type'       => 'text_date_timestamp',
	) );

  $event_metabox->add_field( array(
		'name'       => __( 'Start Time', 'cmb2' ),
		'id'         => $prefix . 'event_start',
		'type'       => 'text_time',
    'time_format' => 'g:iA',
	) );

  $event_metabox->add_field( array(
		'name'       => __( 'End Time', 'cmb2' ),
		'id'         => $prefix . 'event_end',
		'type'       => 'text_time',
    'time_format' => 'g:iA',
	) );

  $event_metabox->add_field( array(
		'name'       => __( 'Summary', 'cmb2' ),
		'id'         => $prefix . 'event_summary',
		'type'       => 'textarea',
	) );

  $event_metabox->add_field( array(
		'name'       => __( 'Eventbrite Embed', 'cmb2' ),
		'id'         => $prefix . 'event_eventbrite_embed',
		'type'       => 'textarea_code',
	) );

}
?>
