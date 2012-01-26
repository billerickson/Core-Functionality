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

add_filter( 'cmb_meta_boxes' , 'be_metaboxes' );
/**
 * Create Metaboxes
 *
 * @link http://www.billerickson.net/wordpress-metaboxes/
 *
 */

function be_metaboxes( $meta_boxes ) {
	$meta_boxes[] = array(
    	'id' => 'page-options',
	    'title' => 'Page Options',
	    'pages' => array('page'), 
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, 
		'fields' => array(
			array(
		        'name' => 'Subtitle',
		        'desc' => '',
	    	    'id' => 'be_page_subtitle',
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
