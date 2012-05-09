<?php
/**
 * Social Widget
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/billerickson/Core-Functionality
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class BE_Social_Widget extends WP_Widget {
	
    /**
     * Constructor
     *
     * @return void
     **/
	function BE_Social_Widget() {
		$widget_ops = array( 'classname' => 'widget_socials', 'description' => 'Social icon widget' );
		$this->WP_Widget( 'social-widget', 'Social Widget', $widget_ops );
	}

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme 
     * @param array  An array of settings for this widget instance 
     * @return void Echoes it's output
     **/
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		echo '<a href="'. $instance['be_facebook'] .'" class="btn-fb"><span class="hidden">Facebook</span></a>';
		echo '<a href="'. $instance['be_twitter'] .'" class="btn-tw"><span class="hidden">Twitter</span></a>';
		echo '<a href="'. $instance['be_youtube'] .'" class="btn-yt"><span class="hidden">Youtube</span></a>';
		echo $after_widget;
	}

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings 
     * @return array The validated and (if necessary) amended settings
     **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	
		$instance['be_facebook'] = esc_url( $new_instance['be_facebook'] );
		$instance['be_twitter'] = esc_url( $new_instance['be_twitter'] );
		$instance['be_youtube'] = esc_url( $new_instance['be_youtube'] );			
		return $instance;
	}

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
	function form( $instance ) {
	
		$defaults = array( 'be_facebook' => '', 'be_twitter' => '', 'be_youtube' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p><label for="<?php echo $this->get_field_id( 'be_facebook' ); ?>">Facebook URL: <input class="widefat" id="<?php echo $this->get_field_id( 'be_facebook' ); ?>" name="<?php echo $this->get_field_name( 'be_facebook' ); ?>" value="<?php echo $instance['be_facebook']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'be_twitter' ); ?>">Twitter URL: <input class="widefat" id="<?php echo $this->get_field_id( 'be_twitter' ); ?>" name="<?php echo $this->get_field_name( 'be_twitter' ); ?>" value="<?php echo $instance['be_twitter']; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'be_youtube' ); ?>">Youtube URL: <input class="widefat" id="<?php echo $this->get_field_id( 'be_youtube' ); ?>" name="<?php echo $this->get_field_name( 'be_youtube' ); ?>" value="<?php echo $instance['be_youtube']; ?>" /></label></p>

		<?php

	}
}

function be_register_social_widget() {
	register_widget('BE_Social_Widget');
}
add_action( 'widgets_init', 'be_register_social_widget' );