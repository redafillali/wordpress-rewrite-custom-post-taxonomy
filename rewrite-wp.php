<?php

function wpg_distributor() {
	$labels = array(
		'name'               => _x( 'distributors', 'post type general name' ),
		'singular_name'      => _x( 'distributor', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Distributor' ),
		'add_new_item'       => __( 'Add New Distributor' ),
		'edit_item'          => __( 'Edit Distributor' ),
		'new_item'           => __( 'New Distributor' ),
		'all_items'          => __( 'All Distributors' ),
		'view_item'          => __( 'View Distributor' ),
		'search_items'       => __( 'Search Distributors' ),
		'not_found'          => __( 'No distributor found' ),
		'not_found_in_trash' => __( 'No distributor found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Distributors'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Distributors',
		'public'        => true,
		'menu_position' => 38,
		'show_ui' => true,
		'show_in_menu'       => true,
		'query_var' => true,
		'capability_type' => 'post',
		'supports'           => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'comments'),
		'has_archive'   => true,
		'taxonomies' => array('distributors'),
		'rewrite'           => array( 'slug' => 'distributor', 'with_front' => false ) // added
	);
	register_post_type( 'distributors', $args );	
}
add_action( 'init', 'wpg_distributor' );
// events cpt ends //

// events custom categories  //
add_action( 'init', 'create_distributor_taxonomies', 0 );

function create_distributor_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Categories' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => '/distributors', 'hierarchical' => true ), // changed
	);
	register_taxonomy( 'distributor_category', array( 'distributors' ), $args );
}

flush_rewrite_rules( false );