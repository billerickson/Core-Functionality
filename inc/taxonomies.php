<?php
/**
 * Core Functionality Plugin
 * 
 * @package    CoreFunctionality
 * @since      2.0.0
 * @copyright  Copyright (c) 2016, Bill Erickson
 * @license    GPL-2.0+
 */

/**
 * Create Location Taxonomy
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

function be_register_location_taxonomy() {
	$labels = array(
		'name' => 'Locations',
		'singular_name' => 'Location',
		'search_items' =>  'Search Locations',
		'all_items' => 'All Locations',
		'parent_item' => 'Parent Location',
		'parent_item_colon' => 'Parent Location:',
		'edit_item' => 'Edit Location',
		'update_item' => 'Update Location',
		'add_new_item' => 'Add New Location',
		'new_item_name' => 'New Location Name',
		'menu_name' => 'Location'
	); 	

	register_taxonomy( 'rotator-location', array('rotator'), 
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'rotator-location' ),
		)
	);
}
add_action( 'init', 'be_register_location_taxonomy' );