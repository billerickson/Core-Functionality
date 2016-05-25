<?php
/**
 * Plugin Name: Core Functionality
 * Plugin URI: https://github.com/billerickson/Core-Functionality
 * Description: This contains all your site's core functionality so that it is theme independent.
 * Version: 2.0
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
 */

// Plugin Directory 
define( 'BE_DIR', dirname( __FILE__ ) );
 
// Post Types
//include_once( BE_DIR . '/lib/functions/post-types.php' );

// Taxonomies 
//include_once( BE_DIR . '/lib/functions/taxonomies.php' );

// Widgets
//include_once( BE_DIR . '/lib/widgets/widget-social.php' );

// Editor Style Refresh
include_once( BE_DIR . '/lib/functions/editor-style-refresh.php' );

// General
include_once( BE_DIR . '/lib/functions/general.php' );