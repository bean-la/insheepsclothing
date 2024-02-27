<?php
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_album_taxonomies', 0 );

// create two taxonomies, types and themes for the post type "book"
function create_album_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Artists', 'taxonomy general name', 'igv' ),
		'singular_name'     => _x( 'Artist', 'taxonomy singular name', 'igv' ),
		'search_items'      => __( 'Search Artists', 'igv' ),
		'all_items'         => __( 'All Artists', 'igv' ),
		'parent_item'       => __( 'Parent Artist', 'igv' ),
		'parent_item_colon' => __( 'Parent Artist:', 'igv' ),
		'edit_item'         => __( 'Edit Artist', 'igv' ),
		'update_item'       => __( 'Update Artist', 'igv' ),
		'add_new_item'      => __( 'Add New Artist', 'igv' ),
		'new_item_name'     => __( 'New Artist Name', 'igv' ),
		'menu_name'         => __( 'Artists', 'igv' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'artist' ),
    'show_in_rest'      => true,
	);

	register_taxonomy( 'artist', array( 'album', 'product' ), $args );

  // Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Styles', 'taxonomy general name', 'igv' ),
		'singular_name'     => _x( 'Style', 'taxonomy singular name', 'igv' ),
		'search_items'      => __( 'Search Styles', 'igv' ),
		'all_items'         => __( 'All Styles', 'igv' ),
		'parent_item'       => __( 'Parent Style', 'igv' ),
		'parent_item_colon' => __( 'Parent Style:', 'igv' ),
		'edit_item'         => __( 'Edit Style', 'igv' ),
		'update_item'       => __( 'Update Style', 'igv' ),
		'add_new_item'      => __( 'Add New Style', 'igv' ),
		'new_item_name'     => __( 'New Style Name', 'igv' ),
		'menu_name'         => __( 'Styles', 'igv' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'style' ),
    'show_in_rest'      => true,
	);

	register_taxonomy( 'style', array( 'album', 'product' ), $args );

  // Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Years', 'taxonomy general name', 'igv' ),
		'singular_name'     => _x( 'Year', 'taxonomy singular name', 'igv' ),
		'search_items'      => __( 'Search Years', 'igv' ),
		'all_items'         => __( 'All Years', 'igv' ),
		'parent_item'       => __( 'Parent Year', 'igv' ),
		'parent_item_colon' => __( 'Parent Year:', 'igv' ),
		'edit_item'         => __( 'Edit Year', 'igv' ),
		'update_item'       => __( 'Update Year', 'igv' ),
		'add_new_item'      => __( 'Add New Year', 'igv' ),
		'new_item_name'     => __( 'New Year Name', 'igv' ),
		'menu_name'         => __( 'Years', 'igv' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'album_year' ),
    'show_in_rest'      => true,
	);

	register_taxonomy( 'album_year', array( 'album', 'product' ), $args );

  // Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Labels', 'taxonomy general name', 'igv' ),
		'singular_name'     => _x( 'Label', 'taxonomy singular name', 'igv' ),
		'search_items'      => __( 'Search Labels', 'igv' ),
		'all_items'         => __( 'All Labels', 'igv' ),
		'parent_item'       => __( 'Parent Label', 'igv' ),
		'parent_item_colon' => __( 'Parent Label:', 'igv' ),
		'edit_item'         => __( 'Edit Label', 'igv' ),
		'update_item'       => __( 'Update Label', 'igv' ),
		'add_new_item'      => __( 'Add New Label', 'igv' ),
		'new_item_name'     => __( 'New Label Name', 'igv' ),
		'menu_name'         => __( 'Labels', 'igv' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'label' ),
    'show_in_rest'      => true,
	);

	register_taxonomy( 'label', array( 'album', 'product' ), $args );

  // Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Countries', 'taxonomy general name', 'igv' ),
		'singular_name'     => _x( 'Country', 'taxonomy singular name', 'igv' ),
		'search_items'      => __( 'Search Countries', 'igv' ),
		'all_items'         => __( 'All Countries', 'igv' ),
		'parent_item'       => __( 'Parent Country', 'igv' ),
		'parent_item_colon' => __( 'Parent Country:', 'igv' ),
		'edit_item'         => __( 'Edit Country', 'igv' ),
		'update_item'       => __( 'Update Country', 'igv' ),
		'add_new_item'      => __( 'Add New Country', 'igv' ),
		'new_item_name'     => __( 'New Country Name', 'igv' ),
		'menu_name'         => __( 'Countries', 'igv' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'country' ),
    'show_in_rest'      => true,
	);

	register_taxonomy( 'country', array( 'album', 'product' ), $args );

  // Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Authors', 'taxonomy general name', 'igv' ),
		'singular_name'     => _x( 'Author', 'taxonomy singular name', 'igv' ),
		'search_items'      => __( 'Search Authors', 'igv' ),
		'all_items'         => __( 'All Authors', 'igv' ),
		'parent_item'       => __( 'Parent Author', 'igv' ),
		'parent_item_colon' => __( 'Parent Author:', 'igv' ),
		'edit_item'         => __( 'Edit Author', 'igv' ),
		'update_item'       => __( 'Update Author', 'igv' ),
		'add_new_item'      => __( 'Add New Author', 'igv' ),
		'new_item_name'     => __( 'New Author Name', 'igv' ),
		'menu_name'         => __( 'Authors', 'igv' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'feature-author' ),
    'show_in_rest'      => true,
	);

	register_taxonomy( 'guest_author', array( 'post' ), $args );
}
?>
