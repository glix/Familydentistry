<?php
/**
 * Plugin Name:new offer Widget
 * Description: A widget that displays new offer for new patient.
 * Version: 0.1
 * Author: familyy dentistry
 * Author URI:http://familydentistrt
 */


add_action( 'widgets_init', 'offer_widget' );


function offer_widget() {
	register_widget( 'OFFER_Widget' );
}

class OFFER_Widget extends WP_Widget {

	function OFFER_Widget() {
		$widget_ops = array( 'classname' => 'newoffer', 'description' => __('A widget that displays New Offer ', 'example') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'new-offer-widget' );
		
		$this->WP_Widget( 'new-offer-widget', __('New Offer Widget', 'example'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		// $image = $instance['image'];
		$show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;
		wp_reset_query();
		$mypost = array( 
			'post_type' => 'offer',
			'posts_per_page' => 10
		);
   		 $loop = new WP_Query( $mypost ); ?>
   		<!--   // debug($loop);exit(); -->
   		<ul class="posts blog">
   		<?php while ( $loop->have_posts() ) : $loop->the_post();
   			 $val++; ?>
   			 <li>
   			 	<?php
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.?>
				<a>
					 <?Php // echo  the_post_thumbnail();  ?>
				</a>
						
					<?php  } ?>
							<h6 style="font-size:16px;" class="cufon">
							 <?php echo the_title(); ?>
							</h6>

						<?php
						echo  the_content();
					?>

				</li>	
					<?php endwhile;  					
					?>
					</ul> <?php



		if ( $show_info )
			//printf( $name );

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['show_info'] = $new_instance['show_info'];

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Example', 'example'), 'name' => __('Bilal Shaheen', 'example'), 'show_info' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input. -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		
		
		<!-- Checkbox. -->
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_info'], true ); ?> id="<?php echo $this->get_field_id( 'show_info' ); ?>" name="<?php echo $this->get_field_name( 'show_info' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_info' ); ?>"><?php _e('Display info publicly?', 'example'); ?></label>
		</p>

	<?php
	}
}

?>