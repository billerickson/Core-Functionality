<?php

/**
 * Shortcodes
 *
 * This file creates all the shortcodes used throughout the site.
 *
 * @package      BE_Genesis_Child
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
 
 
// Use shortcodes in widgets
add_filter('widget_text', 'do_shortcode');


add_shortcode('url','be_url_shortcode');
/**
 * URL Shortcode
 *
 * @param	null
 * @return	string	Site URL
 */
function be_url_shortcode($atts) {
	return get_bloginfo('url');
}

add_shortcode('wpurl','be_wpurl_shortcode');
/**
 * WP URL Shortcode
 *
 * @param	null
 * @return	string	WordPress URL
 */
function be_wpurl_shortcode($atts) {
	return get_bloginfo('wpurl');
}

add_shortcode('child', 'be_child_shortcode');
/**
 * Child Shortcode
 *
 * @param	null
 * @return	string	Child Theme URL
 */
function be_child_shortcode($atts) {
	return get_bloginfo('stylesheet_directory');
}