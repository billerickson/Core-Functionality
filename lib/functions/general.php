<?php
/**
 * General
 *
 * This file contains any general functions
 *
 * @package      BE_Genesis_Child
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
 
add_filter( 'http_request_args', 'be_core_functionality_hidden', 5, 2 );
/**
 * Don't Update Plugin
 * This prevents you being prompted to update if there's a public plugin
 * with the same name.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */
function be_core_functionality_hidden( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) )
		return $r; // Not a plugin update request. Bail immediately.
	$plugins = unserialize( $r['body']['plugins'] );
	unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
	unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
	$r['body']['plugins'] = serialize( $plugins );
	return $r;
}


add_action('admin_menu', 'be_remove_menus');
/**
 * Remove Menu Items
 *
 * Remove unused menu items by adding them to the array.
 * See the commented list of menu items for reference.
 *
 */

function be_remove_menus () {
	global $menu;
	$restricted = array(__('Links'));
	// Example:
	//$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}


//add_filter( 'custom_menu_order', 'be_custom_menu_order' );
//add_filter( 'menu_order', 'be_custom_menu_order' );
/**
 * Customize Menu Order
 *
 * @param array $menu_ord. Current order.
 * @return array $menu_ord. New order.
 *
 */

function be_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		'index.php', // this represents the dashboard link
		'edit.php?post_type=page', //the page tab
		'edit.php', //the posts tab
		'edit-comments.php', // the comments tab
		'upload.php', // the media manager
    );
}


//add_filter( 'mfields_open_graph_meta_tags_default_image_id', 'be_default_facebook_image' );
/**
 * Default Facebook Image 
 * See /lib/functions/facebook.php
 * @link https://developers.facebook.com/tools/debug
 *
 * @param int $attachment_id
 * @return int
 *
 * 1. In WordPress, go to Media > Add New and upload an image (150x150)
 * 2. Once uploaded, click Media > Library and select the image
 * 3. In the URL, grab attachment_id=XX
 */
function be_default_facebook_image( $attachment_id ) {
	$attachment_id = 50;
	return $attachment_id;
}