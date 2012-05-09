<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/billerickson/Core-Functionality
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Create Rotator post type
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

function be_register_rotator_post_type() {
	$labels = array(
		'name' => 'Rotator Items',
		'singular_name' => 'Rotator Item',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Rotator Item',
		'edit_item' => 'Edit Rotator Item',
		'new_item' => 'New Rotator Item',
		'view_item' => 'View Rotator Item',
		'search_items' => 'Search Rotator Items',
		'not_found' =>  'No rotator items found',
		'not_found_in_trash' => 'No rotator items found in trash',
		'parent_item_colon' => '',
		'menu_name' => 'Rotator'
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => false, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail','excerpt')
	); 

	register_post_type( 'rotator', $args );
}
add_action( 'init', 'be_register_rotator_post_type' );	
