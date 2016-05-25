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
 * Sample widget
 *
 * @since 1.0.0
 */
class BE_Sample_Widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @since 1.0.0
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// widget defaults
		$this->defaults = array(
			'title'          => '',
			'widget_content' => '',
		);
		
		// Widget Slug
		$widget_slug = 'ea-sample-widget';

		// widget basics
		$widget_ops = array(
			'classname'   => $widget_slug,
			'description' => 'Widget description goes here.'
		);

		// widget controls
		$control_ops = array(
			'id_base' => $widget_slug,
			//'width'   => '400',
		);

		// load widget
		parent::__construct( $widget_slug, 'BE_Sample_Widget', $widget_ops, $control_ops );		

	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @since 1.0.0
	 * @param array $args An array of standard parameters for widgets in this theme 
	 * @param array $instance An array of settings for this widget instance 
	 */
	function widget( $args, $instance ) {

		extract( $args );

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;

			// Title
			if ( !empty( $instance['title'] ) ) { 
				echo $before_title . apply_filters( 'widget_title', $instance['title'] ) . $after_title;
			}

			// Text
			if ( !empty( $instance['widget_content'] ) ) {
				echo esc_html( $instance['widget_content'] );
			}

		echo $after_widget;
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 *
	 * @since 1.0.0
	 * @param array $new_instance An array of new settings as submitted by the admin
	 * @param array $old_instance An array of the previous settings 
	 * @return array The validated and (if necessary) amended settings
	 */
	function update( $new_instance, $old_instance ) {

		$new_instance['title']           = strip_tags( $new_instance['title'] );
		$new_instance['widget_content']  = esc_html( $new_instance['widget_content'] );

		return $new_instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 *
	 * @since 1.0.0
	 * @param array $instance An array of the current settings for this widget
	 */
	function form( $instance ) {

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'widget_content' ); ?>">Text:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'widget_content' ); ?>" name="<?php echo $this->get_field_name( 'widget_content' ); ?>" value="<?php echo esc_attr( $instance['widget_content'] ); ?>" class="widefat" />
		</p>
		<?php
	}
}
add_action( 'widgets_init', create_function( '', "register_widget('BE_Sample_Widget');" ) );
