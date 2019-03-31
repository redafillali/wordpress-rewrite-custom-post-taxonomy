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
		'rewrite'           => array( 'slug' => 'distributor/%distributor_category%', 'with_front' => false )
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
		'rewrite'           => array( 'slug' => '/distributors', 'hierarchical' => true ),
	);
	register_taxonomy( 'distributor_category', array( 'distributors' ), $args );
}


function ats_kliniek_filter_post_type_link($link, $post) // Updated to include Parent and Child taxonomy
{
if ($post->post_type != 'distributors')
    return $link;

if ($cats = get_the_terms($post->ID, 'distributor_category')) :
	$cat = array_shift($cats)->slug."/".array_pop($cats)->slug;
    $link = str_replace('%distributor_category%', $cat, $link);
endif;
	
return $link;
}
add_filter('post_type_link', 'ats_kliniek_filter_post_type_link', 10, 2);


flush_rewrite_rules( false ); // Must be removed in the prod environement 
