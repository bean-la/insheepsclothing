<?php
add_action( 'cmb2_admin_init', 'igv_register_theme_options_metabox' );

function igv_register_theme_options_metabox() {
  $prefix = '_igv_';

  $player_options = new_cmb2_box( array(
    'id'           => $prefix . 'player_options_page',
    'title'        => esc_html__( 'Audio Player', 'cmb2' ),
    'object_types' => array( 'options-page' ),
    'option_key'      => $prefix . 'player_options', // The option key and admin menu page slug.
    'icon_url'        => 'dashicons-format-audio', // Menu icon. Only applicable if 'parent_slug' is left empty.
    // 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
    // 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
    'capability'      => 'manage_options', // Cap required to view options-page.
    // 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
    // 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
    // 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
    'save_button'     => esc_html__( 'Save', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
  ) );

  $player_options->add_field( array(
    'name'    => esc_html__( 'Audio Player', 'cmb2' ),
    'id'      => $prefix . 'player_title',
    'type'    => 'title',
  ) );

  $player_options->add_field( array(
    'name'    => 'Show Player',
    'id'      => 'player_show',
    'type'    => 'checkbox'
  ) );

  $player_options->add_field( array(
    'name'    => 'Shuffle Playlist',
    'id'      => 'player_shuffle',
    'type'    => 'checkbox'
  ) );

  $player_options->add_field( array(
    'name'    => esc_html__( 'Soundcloud Client ID', 'cmb2' ),
    'id'      => 'player_client_id',
    'type'    => 'text',
    'default' => '0a48e71510bb97b2148c3802bddc8802',
  ) );

  $player_options->add_field( array(
		'name'    => __( 'Playlist', 'cmb2' ),
		'desc'    => __( 'Drag tracks from the left column to the right column to add them to the playlist.<br />You may rearrange the order of the posts in the right column by dragging and dropping.', 'cmb2' ),
		'id'      => 'player_playlist',
		'type'    => 'custom_attached_posts',
		'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
		'options' => array(
			'show_thumbnails' => true, // Show thumbnails on the left
			'filter_boxes'    => true, // Show a text box for filtering the results
			'query_args'      => array(
				'posts_per_page' => 10,
				'post_type'      => 'track',
			), // override the get_posts args
		),
	) );
/*
  $player_options->add_field( array(
    'name'    => esc_html__( 'Soundcloud Playlist URL', 'cmb2' ),
    'id'      => 'player_playlist_url',
    'type'    => 'text',
  ) );
*/
/*
  $player_options->add_field( array(
    'name'      	=> __( 'Playlist', 'cmb2' ),
    'id'        	=> 'player_tracks',
    'type'      	=> 'post_search_ajax',
    // Optional :
    'limit' => 100,
    'sortable' 	 	=> true,
    'query_args'	=> array(
      'post_type'			=> array( 'track' ),
      'post_status'		=> array( 'publish' ),
      'posts_per_page'	=> -1
    )
  ) );
*/
  // Site options for general data

  $site_options = new_cmb2_box( array(
    'id'           => $prefix . 'site_options_page',
    'title'        => esc_html__( 'Site Options', 'cmb2' ),
    'object_types' => array( 'options-page' ),
    /*
     * The following parameters are specific to the options-page box
     * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
     */
    'option_key'      => $prefix . 'site_options', // The option key and admin menu page slug.
    // 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
    // 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
    'capability'      => 'manage_options', // Cap required to view options-page.
    // 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
    // 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
    // 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
    // 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Show Events', 'cmb2' ),
    'id'      => 'show_events',
    'type'    => 'checkbox',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Welcome', 'cmb2' ),
    'id'      => 'welcome_text',
    'type'    => 'textarea_small',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Footer', 'cmb2' ),
    'id'      => $prefix . 'footer_title',
    'type'    => 'title',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Mailchimp Action', 'cmb2' ),
    'id'      => 'mailchimp_action',
    'type'    => 'text',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Address', 'cmb2' ),
    'id'      => 'contact_address',
    'type'    => 'textarea_small',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Footer Text', 'cmb2' ),
    'id'      => 'footer_text',
    'type'    => 'textarea_small',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Hours', 'cmb2' ),
    'id'      => 'hours',
    'type'    => 'textarea_small',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Facebook Page URL', 'cmb2' ),
    'id'      => 'socialmedia_facebook_url',
    'type'    => 'text',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Twitter Account Handle', 'cmb2' ),
    'id'      => 'socialmedia_twitter',
    'type'    => 'text',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Instagram Account Handle', 'cmb2' ),
    'id'      => 'socialmedia_instagram',
    'type'    => 'text',
  ) );

  // Metadata options

  $site_options->add_field( array(
    'name'    => esc_html__( 'Metadata options', 'cmb2' ),
    'desc'    => esc_html__( 'Settings relating to open graph, facebook and twitter sharing, and other social media metadata', 'cmb2' ),
    'id'      => $prefix . 'og_title',
    'type'    => 'title',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Open Graph default image', 'cmb2' ),
    'desc'    => esc_html__( 'primarily displayed on Facebook, but other locations as well', 'cmb2' ),
    'id'      => 'og_image',
    'type'    => 'file',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Logo for SEO results', 'cmb2' ),
    'desc'    => esc_html__( 'presentation logo for this site (optional)', 'cmb2' ),
    'id'      => 'metadata_logo',
    'type'    => 'file',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Facebook App ID', 'cmb2' ),
    'desc'    => esc_html__( '(optional)', 'cmb2' ),
    'id'      => 'og_fb_app_id',
    'type'    => 'text',
  ) );

  // Analytics

  $site_options->add_field( array(
    'name'    => esc_html__( 'Analytics', 'cmb2' ),
    'desc'    => esc_html__( 'Settings for analytics', 'cmb2' ),
    'id'      => $prefix . 'analytics_title',
    'type'    => 'title',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Google Analytics Tracking ID', 'cmb2' ),
    'desc'    => esc_html__( '(optional)', 'cmb2' ),
    'id'      => 'google_analytics_id',
    'type'    => 'text',
  ) );

  // Store options
  $site_options->add_field( array(
    'name'    => esc_html__( 'Store options', 'cmb2' ),
    'id'      => $prefix . 'store_title',
    'type'    => 'title',
  ) );

  $site_options->add_field( array(
    'name'    => esc_html__( 'Show "Join The Record Club" Button', 'cmb2' ),
    'id'      => 'show_join_record_club_btn',
    'type'    => 'checkbox',
  ) );

}