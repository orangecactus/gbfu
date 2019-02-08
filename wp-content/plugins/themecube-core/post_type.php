<?php

if ( ! function_exists('speaker') ) {

// Speaker
function speaker() {

	$labels = array(
		'name'                => esc_attr_x( 'Speakers', 'Post Type General Name', 'eventr' ),
		'singular_name'       => esc_attr_x( 'Speaker', 'Post Type Singular Name', 'eventr' ),
		'menu_name'           => __( 'Speakers', 'eventr' ),
		'parent_item_colon'   => __( 'Parent Speaker:', 'eventr' ),
		'all_items'           => __( 'All Speakers', 'eventr' ),
		'view_item'           => __( 'View Speaker', 'eventr' ),
		'add_new_item'        => __( 'Add New Speaker', 'eventr' ),
		'add_new'             => __( 'Add New Speaker', 'eventr' ),
		'edit_item'           => __( 'Edit Speaker', 'eventr' ),
		'update_item'         => __( 'Update Speaker', 'eventr' ),
		'search_items'        => __( 'Search Speaker', 'eventr' ),
		'not_found'           => __( 'Not speakers found', 'eventr' ),
		'not_found_in_trash'  => __( 'Not speakers found in Trash', 'eventr' ),
	);
	$args = array(
		'label'               => __( 'speaker', 'eventr' ),
		'description'         => __( 'Post Type Description', 'eventr' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies'          => array( 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => false,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-microphone',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'speaker', $args );

}

add_action( 'init', 'speaker', 0 );

}

if ( ! function_exists('schedule') ) {

// Program
function schedule() {

	$labels = array(
		'name'                => esc_attr_x( 'Schedule', 'Post Type General Name', 'eventr' ),
		'singular_name'       => esc_attr_x( 'Program', 'Post Type Singular Name', 'eventr' ),
		'menu_name'           => __( 'Schedule', 'eventr' ),
		'parent_item_colon'   => __( 'Parent program:', 'eventr' ),
		'all_items'           => __( 'All Programs', 'eventr' ),
		'view_item'           => __( 'View Program', 'eventr' ),
		'add_new_item'        => __( 'Add New Program', 'eventr' ),
		'add_new'             => __( 'Add New Program', 'eventr' ),
		'edit_item'           => __( 'Edit Program', 'eventr' ),
		'update_item'         => __( 'Update Program', 'eventr' ),
		'search_items'        => __( 'Search Program', 'eventr' ),
		'not_found'           => __( 'Not Program found', 'eventr' ),
		'not_found_in_trash'  => __( 'Not Program found in Trash', 'eventr' ),
	);
	$args = array(
		'label'               => __( 'program', 'eventr' ),
		'description'         => __( 'Post Type Description', 'eventr' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor','excerpt', ),
		'taxonomies'          => array( 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => false,
		'menu_position'       => 21,
		'menu_icon'           => 'dashicons-schedule',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'schedule', $args );

}

add_action( 'init', 'schedule', 0 );

}

add_action( 'init', 'create_schedule_taxonomies', 0 );
// create skin taxonomy
function create_schedule_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => esc_attr_x( 'Date', 'taxonomy general name' , 'eventr'),
        'singular_name'     => esc_attr_x( 'Date', 'taxonomy singular name' , 'eventr'),
        'search_items'      => __( 'Search Dates', 'eventr'),
        'all_items'         => __( 'All Dates', 'eventr' ),
        'parent_item'       => __( 'Parent Date', 'eventr' ),
        'parent_item_colon' => __( 'Parent Date:' , 'eventr'),
        'edit_item'         => __( 'Edit Date' , 'eventr'),
        'update_item'       => __( 'Update Date' , 'eventr'),
        'add_new_item'      => __( 'Add New Date' , 'eventr'),
        'new_item_name'     => __( 'New Date Name' , 'eventr'),
        'menu_name'         => __( 'Date' , 'eventr'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'schedule' ),
    );

    register_taxonomy( 'date', array('schedule'), $args );
}



?>