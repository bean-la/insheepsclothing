<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/
function add_menu_icons_styles(){
?>

<style>
#menu-posts-album .dashicons-admin-post:before {
    content: '\f514';
}
#menu-posts-track .dashicons-admin-post:before {
    content: '\f492';
}
#menu-posts-product .dashicons-admin-post:before {
    content: '\f174';
}
#menu-posts-partner .dashicons-admin-post:before {
    content: '\f307';
}
#menu-posts-event .dashicons-admin-post:before {
    content: '\f508';
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


//Register Custom Post Types
add_action( 'init', 'register_cpt_album' );

function register_cpt_album() {

  $labels = array(
    'name' => _x( 'Collection', 'igv' ),
    'singular_name' => _x( 'Album', 'igv' ),
    'add_new' => _x( 'Add New', 'igv' ),
    'add_new_item' => _x( 'Add New Album', 'igv' ),
    'edit_item' => _x( 'Edit Album', 'igv' ),
    'new_item' => _x( 'New Album', 'igv' ),
    'view_item' => _x( 'View Album', 'igv' ),
    'search_items' => _x( 'Search Collection', 'igv' ),
    'not_found' => _x( 'No albums found', 'igv' ),
    'not_found_in_trash' => _x( 'No albums found in Trash', 'igv' ),
    'parent_item_colon' => _x( 'Parent Album:', 'igv' ),
    'menu_name' => _x( 'Collection', 'igv' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => 'collection',
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post',

    'taxonomies' => array('post_tag'),

    'show_in_rest'        => true,
    /*'template'          => array(
      array( 'core/heading', array(
        'level' => '5', 'content' => 'Some List' ) ),
      array( 'core/list' ),
      array( 'core/heading', array(
        'level' => '5', 'content' => 'Some Text' ) ),
      array( 'core/paragraph' )
    ),*/
		//'template_lock'     => 'all',
  );

  register_post_type( 'album', $args );
}

add_action( 'init', 'register_cpt_track' );

function register_cpt_track() {

  $labels = array(
    'name' => _x( 'Tracks', 'igv' ),
    'singular_name' => _x( 'Track', 'igv' ),
    'add_new' => _x( 'Add New', 'igv' ),
    'add_new_item' => _x( 'Add New Track', 'igv' ),
    'edit_item' => _x( 'Edit Track', 'igv' ),
    'new_item' => _x( 'New Track', 'igv' ),
    'view_item' => _x( 'View Track', 'igv' ),
    'search_items' => _x( 'Search Tracks', 'igv' ),
    'not_found' => _x( 'No tracks found', 'igv' ),
    'not_found_in_trash' => _x( 'No tracks found in Trash', 'igv' ),
    'parent_item_colon' => _x( 'Parent Track:', 'igv' ),
    'menu_name' => _x( 'Tracks', 'igv' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => false,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post',

    'show_in_rest'        => true,
    /*'template'          => array(
      array( 'core/heading', array(
        'level' => '5', 'content' => 'Some List' ) ),
      array( 'core/list' ),
      array( 'core/heading', array(
        'level' => '5', 'content' => 'Some Text' ) ),
      array( 'core/paragraph' )
    ),*/
		//'template_lock'     => 'all',
  );

  register_post_type( 'track', $args );
}

add_action( 'init', 'register_cpt_partner' );

function register_cpt_partner() {

  $labels = array(
    'name' => _x( 'Partners', 'igv' ),
    'singular_name' => _x( 'Partner', 'igv' ),
    'add_new' => _x( 'Add New', 'igv' ),
    'add_new_item' => _x( 'Add New Partner', 'igv' ),
    'edit_item' => _x( 'Edit Partner', 'igv' ),
    'new_item' => _x( 'New Partner', 'igv' ),
    'view_item' => _x( 'View Partner', 'igv' ),
    'search_items' => _x( 'Search Partners', 'igv' ),
    'not_found' => _x( 'No partners found', 'igv' ),
    'not_found_in_trash' => _x( 'No partners found in Trash', 'igv' ),
    'parent_item_colon' => _x( 'Parent Partner:', 'igv' ),
    'menu_name' => _x( 'Partners', 'igv' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => false,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post',

    'taxonomies' => array('post_tag'),

    'show_in_rest'        => true,
    /*'template'          => array(
      array( 'core/heading', array(
        'level' => '5', 'content' => 'Some List' ) ),
      array( 'core/list' ),
      array( 'core/heading', array(
        'level' => '5', 'content' => 'Some Text' ) ),
      array( 'core/paragraph' )
    ),*/
		//'template_lock'     => 'all',
  );

  register_post_type( 'partner', $args );
}

add_action( 'init', 'register_cpt_event' );

function register_cpt_event() {

  $labels = array(
    'name' => _x( 'Events', 'igv' ),
    'singular_name' => _x( 'Event', 'igv' ),
    'add_new' => _x( 'Add New', 'igv' ),
    'add_new_item' => _x( 'Add New Event', 'igv' ),
    'edit_item' => _x( 'Edit Event', 'igv' ),
    'new_item' => _x( 'New Event', 'igv' ),
    'view_item' => _x( 'View Event', 'igv' ),
    'search_items' => _x( 'Search Events', 'igv' ),
    'not_found' => _x( 'No events found', 'igv' ),
    'not_found_in_trash' => _x( 'No events found in Trash', 'igv' ),
    'parent_item_colon' => _x( 'Parent Event:', 'igv' ),
    'menu_name' => _x( 'Events', 'igv' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'editor', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => 'events',
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post',

    'taxonomies' => array('post_tag'),

    'show_in_rest'        => true,
    /*'template'          => array(
      array( 'core/heading', array(
        'level' => '5', 'content' => 'Some List' ) ),
      array( 'core/list' ),
      array( 'core/heading', array(
        'level' => '5', 'content' => 'Some Text' ) ),
      array( 'core/paragraph' )
    ),*/
		//'template_lock'     => 'all',
  );

  register_post_type( 'event', $args );
}

//Register Custom Post Types
add_action( 'init', 'register_cpt_product_list' );

function register_cpt_product_list() {

  $labels = array(
    'name' => _x( 'Product Lists', 'igv' ),
    'singular_name' => _x( 'Product List', 'igv' ),
    'add_new' => _x( 'Add New', 'igv' ),
    'add_new_item' => _x( 'Add New Product List', 'igv' ),
    'edit_item' => _x( 'Edit Product List', 'igv' ),
    'new_item' => _x( 'New Product List', 'igv' ),
    'view_item' => _x( 'View Product List', 'igv' ),
    'search_items' => _x( 'Search Product Lists', 'igv' ),
    'not_found' => _x( 'No product lists found', 'igv' ),
    'not_found_in_trash' => _x( 'No product lists found in Trash', 'igv' ),
    'menu_name' => _x( 'Product Lists', 'igv' ),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => false,

    'supports' => array( 'title', 'thumbnail' ),

    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 19,
    'menu_icon' => 'dashicons-feedback',

    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => 'product_list',
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post',

    'show_in_rest'        => true,
    /*'template'          => array(
      array( 'core/heading', array(
        'level' => '5', 'content' => 'Some List' ) ),
      array( 'core/list' ),
      array( 'core/heading', array(
        'level' => '5', 'content' => 'Some Text' ) ),
      array( 'core/paragraph' )
    ),*/
		//'template_lock'     => 'all',
  );

  register_post_type( 'product_list', $args );
}
