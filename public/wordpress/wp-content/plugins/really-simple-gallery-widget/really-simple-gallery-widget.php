<?php
/*
Plugin Name: Really Simple Gallery Widget
Plugin URI: http://helen.wordpress.com/category/plugins/really-simple-gallery-widget/
Description: Widget to display images attached to a specific page/post or from the entire media library. Includes options for number of images, display order (including true random), any registered image size, caption toggling, type of link, rel attribute, and link title prefix. Can also show images attached to the page/post currently being viewed.
Version: 1.3
Author: Helen Hou-Sandi
Author URI: http://helenhousandi.com
*/

if ( ! class_exists( 'RSGWidget' ) ) {

	class RSGWidget extends WP_Widget {
		function RSGWidget() {
			$widget_ops = array(
				'classname' => 'widget_rsg',
				'description' => __('Grab photos from a specified post/page or the entire media library and display them in a widget area.', 'rsg-widget' )
			);

			$this->WP_Widget( 'RSGWidget', __('Really Simple Gallery Widget', 'rsg-widget' ), $widget_ops );

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}

		function widget( $args, $instance ) {
			$args['title'] = apply_filters( 'widget_title', $instance['title'] );
			$args['from'] = $instance['from'];
			$args['post_id'] = isset( $instance['post_id'] ) ? absint( $instance['post_id'] ) : false;
			$args['att_ids'] = isset( $instance['att_ids'] ) ? $instance['att_ids'] : false;
			$args['current_post_images'] = $instance['current_post_images'] ? true : false;
			$args['num_images'] = $instance['num_images'];
			$args['show_captions'] = $instance['show_captions'] ? true : false;
			$args['image_size'] = $instance['image_size'];
			$args['order'] = $instance['order'];
			$args['orderby'] = $instance['orderby'];
			$args['link_type'] = $instance['link_type'];
			$args['before_link_title'] = esc_attr( strip_tags($instance['before_link_title']) );
			$args['link_rel'] = esc_attr( strip_tags( $instance['link_rel'] ) );

			// back compat for old full_library option
			if ( isset( $instance['full_library'] ) )
				$args['from'] = 'full_library';

			include( 'views/widget.php' );
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = wp_kses_post( $new_instance['title'] );
			$instance['from'] = sanitize_key( $new_instance['from'] );
			$instance['post_id'] = absint( $new_instance['post_id'] );

			// don't want to store a 0
			if ( 0 === $instance['post_id'] )
				$instance['post_id'] = '';

			$instance['att_ids'] = wp_kses( $new_instance['att_ids'] );
			$instance['current_post_images'] = $new_instance['current_post_images'] ? 1 : 0;
			$instance['num_images'] = absint( $new_instance['num_images'] );
			$instance['show_captions'] = $new_instance['show_captions'] ? 1 : 0;
			$instance['image_size'] = $new_instance['image_size'];
			$instance['order'] = sanitize_key( $new_instance['order'] );
			$instance['orderby'] = sanitize_key( $new_instance['orderby'] );
			$instance['link_type'] = sanitize_key( $new_instance['link_type'] );
			$instance['before_link_title'] = esc_html( $new_instance['before_link_title'] );
			$instance['link_rel'] = esc_html( $new_instance['link_rel'] );

			// remove old full_library option, if it exists
			if ( isset( $instance['full_library'] ) )
				unset( $instance['full_library'] );

			return $instance;
		}

		function form( $instance ) {
			include( 'views/form.php' );
		}

		public function admin_enqueue_scripts($hook) {
			if ( ! 'widgets.php' === $hook )
				return;

			wp_enqueue_script( 'rsgwidget', plugins_url( 'js/rsgwidget.js', __FILE__ ), array( 'jquery' ), '1.2', true );
		}
	}

	add_action( 'widgets_init', 'rsgwidget_init' );
	function rsgwidget_init() {
		register_widget( 'RSGWidget' );
	}
}
