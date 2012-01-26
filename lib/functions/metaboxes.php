<?php
/**
 * Metaboxes
 *
 * This file registers any custom metaboxes
 *
 * @package      BE_Genesis_Child
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

add_filter( 'cmb_meta_boxes' , 'be_rotator_metabox' );
/**
 * Create Rotator Metabox
 *
 * @link http://www.billerickson.net/wordpress-metaboxes/
 *
 */

function be_rotator_metabox( $meta_boxes ) {
	$meta_boxes[] = array(
    	'id' => 'rotator-options',
	    'title' => 'Rotator Options',
	    'pages' => array('rotator'), 
		'context' => 'normal',
		'priority' => 'low',
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'Instructions',
				'desc' => 'In the right column upload a featured image. Make sure this image is at least 900x360px wide. Then fill out the information below.',
				'type' => 'title',
				'id' => 'be_rotator_instructions'
			),
			array(
		        'name' => 'Display Info',
		        'desc' => 'Show Title and Excerpt from above',
	    	    'id' => 'be_rotator_show_info',
	        	'type' => 'checkbox'
			),
			array(
				'name' => 'Clickthrough URL', 
	            'desc' => 'Where the Learn More button goes',
            	'id' => 'be_rotator_url',
            	'type' => 'text'
			),
		),
	);
	
	return $meta_boxes;
 }
 
 
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize Metabox Class
 * see /lib/metabox/example-functions.php for more information
 *
 */
  
function be_initialize_cmb_meta_boxes() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once( BE_DIR . '/lib/metabox/init.php' );
    }
}
