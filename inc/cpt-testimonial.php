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
 * Testimonials
 *
 * This file registers the testimonials custom post type
 * and setups the various functions and items it uses.
 *
 * @since 2.0.0
 */
class BE_Testimonials {

	/**
	 * Initialize all the things
	 *
	 * @since 2.0.0
	 */
	function __construct() {
		
		// Actions
		add_action( 'init',              array( $this, 'register_tax'      )    );
		add_action( 'init',              array( $this, 'register_cpt'      )    );
		add_action( 'gettext',           array( $this, 'title_placeholder' )    );
		add_action( 'pre_get_posts',     array( $this, 'testimonial_query' )    );
		add_action( 'template_redirect', array( $this, 'redirect_single'   )    );

		// Column Filters
		add_filter( 'manage_edit-testimonial_columns',        array( $this, 'testimonial_columns' )        );

		// Column Actions
		add_action( 'manage_testimonial_pages_custom_column', array( $this, 'custom_columns'      ), 10, 2 );
		add_action( 'manage_testimonial_posts_custom_column', array( $this, 'custom_columns'      ), 10, 2 );
	}

	/**
	 * Register the taxonomies
	 *
	 * @since 2.0.0
	 */
	function register_tax() {

		$labels = array( 
			'name'                       => 'FOO',
			'singular_name'              => 'FOO',
			'search_items'               => 'Search FOOs',
			'popular_items'              => 'Popular FOOs',
			'all_items'                  => 'All FOOs',
			'parent_item'                => 'Parent FOO',
			'parent_item_colon'          => 'Parent FOO:',
			'edit_item'                  => 'Edit FOO',
			'update_item'                => 'Update FOO',
			'add_new_item'               => 'Add New FOO',
			'new_item_name'              => 'New FOO',
			'separate_items_with_commas' => 'Separate FOOs with commas',
			'add_or_remove_items'        => 'Add or remove FOOs',
			'choose_from_most_used'      => 'Choose from most used FOOs',
			'menu_name'                  => 'FOOs',
		);

		$args = array( 
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => false,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'cpt-slug/foo', 'with_front' => false ),
			'query_var'         => true,
			'show_admin_column' => false,
			// 'meta_box_cb'    => false,
		);

		register_taxonomy( 'foo', array( 'testimonials' ), $args );
	}

	/**
	 * Register the custom post type
	 *
	 * @since 2.0.0
	 */
	function register_cpt() {

		$labels = array( 
			'name'               => 'Testimonials',
			'singular_name'      => 'Testimonial',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Testimonial',
			'edit_item'          => 'Edit Testimonial',
			'new_item'           => 'New Testimonial',
			'view_item'          => 'View Testimonial',
			'search_items'       => 'Search Testimonials',
			'not_found'          => 'No Testimonials found',
			'not_found_in_trash' => 'No Testimonials found in Trash',
			'parent_item_colon'  => 'Parent Testimonial:',
			'menu_name'          => 'Testimonials',
		);

		$args = array( 
			'labels'              => $labels,
			'hierarchical'        => false,
			'supports'            => array( 'title', 'editor', 'thumbnail' ),   
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => array( 'slug' => 'testimonials', 'with_front' => false ),
			'menu_icon'           => 'dashicons-groups', // https://developer.wordpress.org/resource/dashicons/
		);

		register_post_type( 'testimonial', $args );

	}

	/**
	 * Change the default title placeholder text
	 *
	 * @since 2.0.0
	 * @global array $post
	 * @param string $translation
	 * @return string Customized translation for title
	 */
	function title_placeholder( $translation ) {

		global $post;
		if ( isset( $post ) && 'testimonial' == $post->post_type && 'Enter title here' == $translation ) {
			$translation = 'Enter Name Here';
		}
		return $translation;

	}
	
	/**
	 * Customize the Testimonials Query
	 *
	 * @since 2.0.0
	 * @param object $query
	 */
	function testimonial_query( $query ) {
		if( $query->is_main_query() && !is_admin() && $query->is_post_type_archive( 'testimonial' ) ) {
			$query->set( 'posts_per_page', 20 );
		}
	}
	
	/**
	 * Redirect Single Testimonials
	 *
	 * @since 2.0.0
	 */
	function redirect_single() {
		if( is_singular( 'testimonial' ) ) {
			wp_redirect( get_post_type_archive_link( 'testimonial' ) );
			exit;
		}
	}

	/**
	 * Testimonials custom columns
	 *
	 * @since 2.0.0
	 * @param array $columns
	 */
	function testimonial_columns( $columns ) {

		$columns = array(
			'cb'                  => '<input type="checkbox" />',
			'thumbnail'           => 'Thumbnail',
			'title'               => 'Name',
			'date'                => 'Date',
		);

		return $columns;
	}

	/**
	 * Cases for the custom columns
	 *
	 * @since 1.2.0
	 * @param array $column
	 * @param int $post_id
	 * @global array $post
	 */
	function custom_columns( $column, $post_id ) {

		global $post;

		switch ( $column ) {
			case 'thumbnail':
				the_post_thumbnail( 'thumbnail' );
				break;
		}
	}
	
}
new BE_Testimonials();