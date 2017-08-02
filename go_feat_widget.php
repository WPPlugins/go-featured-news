<?php
/**
 * GO Featured Widget
 * Version: 1.0
 * Author: Ivan Bauer
 * Author URI: http://getonline.ie
 */
 
/* Add Widget */
add_action( 'widgets_init', 'Go_Feat_widget' );


function Go_Feat_widget() {
	register_widget( 'Go_Feat_widget' );
}

class Go_Feat_widget extends WP_Widget {

	function Go_Feat_widget() {
		$widget_ops = array( 'classname' => 'go_feat_news', 'description' => __('Widget for the Go Featured News ', 'go_feat_news') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'go-feat-news' );
		
		$this->WP_Widget( 'go-feat-news', __('Go Featured News', 'go_feat_news'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget.$before_title.$title.$after_title;
		
		$instance['is_widget'] = 1;
		
		
		echo go_featured_news($instance);

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ID'] = strip_tags($new_instance['ID']);
		$instance['numposts'] = strip_tags($new_instance['numposts']);
		$instance['category'] = strip_tags($new_instance['category']);
		if(empty($instance['category'])){
			unset($instance['category']);
		}

		return $instance;
	}

	
	function form( $instance ) {
		$ID = gof_generateRandomString();
		//Set up some default widget settings.
		$defaults = array(	
			'title' => __('Featured News', 'go_feat_news'),
			'ID' => $ID,
			'numposts' => '10',
			'category' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget Title:', 'go_feat_news'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ID' ); ?>"><?php _e('Unique ID:', 'go_feat_news'); ?></label>
			<input id="<?php echo $this->get_field_id( 'ID' ); ?>" name="<?php echo $this->get_field_name( 'ID' ); ?>" value="<?php echo $instance['ID']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'numposts' ); ?>"><?php _e('Number of posts to display:', 'go_feat_news'); ?></label>
			<input id="<?php echo $this->get_field_id( 'numposts' ); ?>" name="<?php echo $this->get_field_name( 'numposts' ); ?>" value="<?php echo $instance['numposts']; ?>" style="width:25px; text-align:center" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e('Categories (separated with comma):', 'go_feat_news'); ?></label>
			<input id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" value="<?php echo $instance['category']; ?>" style="width:50px;" />
		</p>
	<?php
	}
}