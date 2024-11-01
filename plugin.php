<?php

/*
Plugin Name: Unofficial Polldaddy Widget
Plugin URI: http://azend.org
Description: Creates a Wordpress compatible widget for use with the Polldaddy plugin
Version: 1.0
Author:	Verdi R-D
Author URI: http://azend.org
*/


class Unofficial_Polldaddy_Widget extends WP_Widget {

	function Unofficial_Polldaddy_Widget () {
		
		$widget_ops = array( 
			'classname' => 'polldaddy-widget', 
			'description' => __('A simple widget to make adding polldaddy polls easier') 
		);

		$control_ops = array(
			'width' => 300, 
			'height' => 350, 
			'id_base' => 'polldaddy-widget'
		);
		$this->WP_Widget('polldaddy-widget', __('Unofficial Polldaddy Widget'), $widget_ops, $control_ops);

	}

	function widget ( $args, $instance ) {
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$poll = $instance['poll'];

		echo $before_widget;
		
		if ($title)
			echo $before_title . $title . $after_title;
		
		
		echo $poll;

		echo $after_widget;		
		
	}

	function update ( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title']);
		$instance['poll'] = $new_instance['poll'];

		return $instance;
	}

	function form ( $instance ) {
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('poll'); ?>"><?php _e('Embed Code:'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('poll'); ?>" name="<?php echo $this->get_field_name('poll'); ?>" value="<?php echo( htmlentities( $instance['poll'] ) ); ?>" />
			<small><?php _e('Paste the Polldaddy embed code here'); ?></small>
		</p>
		<?php
	}
}

add_action('widgets_init', 'load_Unofficial_Polldaddy_Widget');

function load_Unofficial_Polldaddy_Widget () {
	register_widget('Unofficial_Polldaddy_Widget');
}

?>