<?php
/**
 * Plugin Name: Core Functionality
 * Plugin URI: http://www.billerickson.net
 * Description: This contains all your site's core functionality so that it is theme independent.
 * Version: 1.0 (mu)
 * Author: Bill Erickson
 * Author URI: http://www.billerickson.net
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package BE_Genesis_Child
 * @version 1.0-MU
 * @author Bill Erickson <bill@billerickson.net>
 * @copyright Copyright (c) 2011, Bill Erickson
 * @link http://www.billerickson.net/shortcode-to-display-posts/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * 
 * @category   MU-PLUGINS
 * @author Greg Kerstin <hello@graphicagenda.com>
 * 
 */

// Plugin Directory 
define( 'BE_MU_DIR', dirname( __FILE__ ));
define( 'BE_DIR', BE_MU_DIR.'/Core-Functionality' );

// PLUGIN ROOT
define( 'BE_IMAGES_DIR', BE_DIR.'/images');
define( 'BE_LIB_DIR', BE_DIR.'/lib');

// LIB CONTENT
define( 'BE_ADMIN_DIR', BE_LIB_DIR.'/admin');
define( 'BE_COLUMNS_DIR', BE_LIB_DIR.'/columns');
define( 'BE_FUNCTIONS_DIR', BE_LIB_DIR.'/functions');
define( 'BE_METABOX_DIR', BE_LIB_DIR.'/metabox');
define( 'BE_SHORTCODES_DIR', BE_LIB_DIR.'/shortcodes');
define( 'BE_TAXONOMY_DIR', BE_LIB_DIR.'/taxonomy');
define( 'BE_WIDGETS_DIR', BE_LIB_DIR.'/widgets');

// ADMIN 
// if (is_login_page())
//	include_once( BE_ADMIN_DIR . '/login.php' );
 
// Post Types
//include_once( BE_FUNCTIONS_DIR . '/post-types.php' );

// Metaboxes
//include_once( BE_METABOX_DIR . '/metaboxes.php' );
 
// Shortcodes
include_once( BE_SHORTCODES_DIR . '/shortcodes.php' );

// Taxonomies 
//include_once( BE_TAXONOMY_DIR . '/taxonomies.php' );

// Widgets
//include_once( BE_WIDGETS_DIR . '/widget-social.php' );

// General

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
function cws_hidden_plugin_12345( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) )
		return $r; // Not a plugin update request. Bail immediately.
	$plugins = unserialize( $r['body']['plugins'] );
	unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
	unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
	$r['body']['plugins'] = serialize( $plugins );
	return $r;
}
add_filter( 'http_request_args', 'cws_hidden_plugin_12345', 5, 2 );


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
add_action('admin_menu', 'be_remove_menus');


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
add_filter( 'custom_menu_order', 'be_custom_menu_order' );
add_filter( 'menu_order', 'be_custom_menu_order' );


 /**
 * Is Login Page
 *
 * @return 	$is_login - boolean
 * @author 	Franz Josef Kaiser
 * @link	http://unserkaiser.com
  * 
 */

 function is_login_page() {
	$url_parts 	= parse_url( $_SERVER['REQUEST_URI'] );
	$path_parts = pathinfo( $url_parts['path'] );
	$dir_parts 	= explode( '/', $path_parts['dirname'] );
	$dirname 	= end( $dir_parts );
	$filename 	= $path_parts['basename'];
	if ( 'wp-login.php' == $filename ) {
		$is_login = true; 
	} 
	else {
		$is_login = false;
	}
	return $is_login;
 }
