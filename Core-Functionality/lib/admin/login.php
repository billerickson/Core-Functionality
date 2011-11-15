<?php

/*
 * Custom Admin Login Logo
 */

	function be_login_logo() {
		echo '<style type="text/css">
		BODY{padding-top:0px !important;}
		#login{margin:3em auto !important;}
		h1 a { background-image: url('. plugins_url( 'Core-Functionality/images/logo.png' , BE_DIR ) .') !important; height:211px !important; width:365px !important; }
		</style>';
	}
	add_action('login_head', 'be_login_logo');

/*
 * Change Login Logo Hover Title
 */

	add_filter('login_headertitle', create_function(false,"return 'Site Name';"));
	add_filter("login_headerurl", create_function(false,"return 'http://www.site-url.com';"));