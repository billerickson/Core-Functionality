<?php # -*- coding: utf-8 -*-
/**
 * Plugin Name: T5 Fresh Editor Stylesheets
 * Description: Enforces fresh editor stylesheets per version parameter.
 * Version:     2012.07.21
 * Author:      Thomas Scholz
 * Plugin URI:  http://wordpress.stackexchange.com/q/33318/73
 * Author URI:  http://toscho.de
 * License:     MIT
 * License URI: http://www.opensource.org/licenses/mit-license.php
 */

if ( ! function_exists( 't5_fresh_editor_style' ) )
{
    add_filter( 'mce_css', 't5_fresh_editor_style' );

    /**
     * Adds a parameter of the last modified time to all editor stylesheets.
     *
     * @wp-hook mce_css
     * @param  string $css Comma separated stylesheet URIs
     * @return string
     */
    function t5_fresh_editor_style( $css )
    {
        global $editor_styles;

        if ( empty ( $css ) or empty ( $editor_styles ) )
        {
            return $css;
        }

        // Modified copy of _WP_Editors::editor_settings()
        $mce_css   = array();
        $style_uri = get_stylesheet_directory_uri();
        $style_dir = get_stylesheet_directory();

        if ( is_child_theme() )
        {
            $template_uri = get_template_directory_uri();
            $template_dir = get_template_directory();

            foreach ( $editor_styles as $key => $file )
            {
                if ( $file && file_exists( "$template_dir/$file" ) )
                {
                    $mce_css[] = add_query_arg(
                        'version',
                        filemtime( "$template_dir/$file" ),
                        "$template_uri/$file"
                    );
                }
            }
        }

        foreach ( $editor_styles as $file )
        {
            if ( $file && file_exists( "$style_dir/$file" ) )
            {
                $mce_css[] = add_query_arg(
                    'version',
                    filemtime( "$style_dir/$file" ),
                    "$style_uri/$file"
                );
            }
        }

        return implode( ',', $mce_css );
    }
}