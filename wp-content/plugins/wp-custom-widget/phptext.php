<?php
/*
Plugin Name: WP Custom Widget
Plugin URI: http://www.jaredritchey.com/
Description: <strong>WP Custom Widget</strong> - Another fine <a href="http://www.jaredritchey.com" target="_blank" title="WordPress Plug-in">WordPress Plugin</a> by Jared Ritchey Design. This plugin was based in part on code from the original Text Widget in WordPress and shares some of the code from the developer of the <a href="http://wordpress.org/extend/plugins/php-code-widget/" target="_blank" title="PHP Code Widget">PHP Code Widget.</a> With this widget you can <strong>assign your elements to pages, posts, categories, tags and has tag</strong> as well as all areas of the site by default.
Author: Damian Danielczyk and Jared Ritchey
Version: 1.0.3
Author URI: http://www.jaredritchey.com
*/

/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2, 
    as published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

function widget_phptext($args, $widget_args = 1) {
	extract( $args, EXTR_SKIP );
	if ( is_numeric($widget_args) )
		$widget_args = array( 'number' => $widget_args );
	$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
	extract( $widget_args, EXTR_SKIP );

	$options = get_option('widget_phptext');
	if ( !isset($options[$number]) )
		return;
	$title = $options[$number]['title'];
	$phptext_display_position = $options[$number]['phptext_display_position'];
	$phptext_elements_id = $options[$number]['phptext_elements_id'];
	$text = apply_filters( 'widget_phptext', $options[$number]['text'] );
	switch($phptext_display_position){
		case 'pages':
		if($phptext_elements_id){
			if(!is_page(explode(",",$phptext_elements_id))) return;
		}else{
			if(!is_page()) return;
		}
		break;
		case 'posts':
		if($phptext_elements_id){
			if(!is_single(explode(",",$phptext_elements_id))) return;
		}else{
			if(!is_single()) return;
		}
		break;
		case 'categories':
		if($phptext_elements_id){
			if(!is_category(explode(",",$phptext_elements_id))) return;
		}else{
			if(!is_category()) return;
		}
		break;
		case 'home':
			if(!is_home() && !is_front_page()) return;
		break;
		case 'istag':
		if($phptext_elements_id){
			if(!is_tag(explode(",",$phptext_elements_id))) return;
		}else{
			if(!is_tag()) return;
		}
		break;
		case 'hastag':
		if($phptext_elements_id){
			if(!has_tag(explode(",",$phptext_elements_id))) return;
		}else{
			if(!has_tag()) return;
		}
		break;
	}
?>
		<?php echo $before_widget; ?>

		
		<div class="phptextwidget">
			<?php 
				 post_type_exists( "appointment" ); 
				$value = get_bloginfo( 'stylesheet_directory' ).'/images/pi.png';
				?>
				<a href="<?php echo get_permalink(333); ?>"><img  src='<?php  echo $value ?>'></a>
		</div>
		<?php echo $after_widget; ?>
<?php
}

function widget_phptext_control($widget_args) {
	global $wp_registered_widgets;
	static $updated = false;

	if ( is_numeric($widget_args) )
		$widget_args = array( 'number' => $widget_args );
	$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
	extract( $widget_args, EXTR_SKIP );

	$options = get_option('widget_phptext');
	if ( !is_array($options) )
		$options = array();

	if ( !$updated && !empty($_POST['sidebar']) ) {
		$sidebar = (string) $_POST['sidebar'];

		$sidebars_widgets = wp_get_sidebars_widgets();
		if ( isset($sidebars_widgets[$sidebar]) )
			$this_sidebar =& $sidebars_widgets[$sidebar];
		else
			$this_sidebar = array();

		foreach ( $this_sidebar as $_widget_id ) {
			if ( 'widget_phptext' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
				$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
				if ( !in_array( "phptext-$widget_number", $_POST['widget-id'] ) ) unset($options[$widget_number]);
			}
		}

		foreach ( (array) $_POST['widget-phptext'] as $widget_number => $widget_text ) {
			$title = strip_tags(stripslashes($widget_text['title']));
			$phptext_display_position = strip_tags(stripslashes($widget_text['phptext_display_position']));
			$phptext_elements_id = strip_tags(stripslashes($widget_text['phptext_elements_id']));
			$text = stripslashes($widget_text['text']);
			$options[$widget_number] = compact( 'title', 'phptext_display_position', 'phptext_elements_id', 'text');
		}
		update_option('widget_phptext', $options);
		$updated = true;
	}

	if ( -1 == $number ) {
		$title = '';
		$phptext_display_position = '';
		$phptext_elements_id = '';
		$text = '';
		$number = '%i%';
	} else {
		$title = attribute_escape($options[$number]['title']);
		$phptext_elements_id = attribute_escape($options[$number]['phptext_elements_id']);
		$phptext_display_position = attribute_escape($options[$number]['phptext_display_position']);
		$text = format_to_edit($options[$number]['text']);
	}
?>
		<p>Enter title<br/>
		<input  id="phptext-title-<?php echo $number; ?>" name="widget-phptext[<?php echo $number; ?>][title]" type="text" value="<?php echo $title; ?>" size="35" /><br/><br/>
			
		Display Position (default is all)<br/>
		<select id="phptext-phptext_display_position-<?php echo $number; ?>" name="widget-phptext[<?php echo $number; ?>][phptext_display_position]">
		<option value="all" <?php if($phptext_display_position == "all") echo "SELECTED"; ?>>All Pages, Posts, Categories</option>
		<option value="pages" <?php if($phptext_display_position == "pages") echo "SELECTED"; ?>>Pages</option>
		<option value="posts" <?php if($phptext_display_position == "posts") echo "SELECTED"; ?>>Posts(single)</option>
		<option value="categories" <?php if($phptext_display_position == "categories") echo "SELECTED"; ?>>Categories</option>
		<option value="home" <?php if($phptext_display_position == "home") echo "SELECTED"; ?>>Home</option>
		<option value="istag" <?php if($phptext_display_position == "istag") echo "SELECTED"; ?>>Is Tag</option>
		<option value="hastag" <?php if($phptext_display_position == "hastag") echo "SELECTED"; ?>>Has Tag</option>
		</select><br/><br/>
		Enter element ID's (comma separated)<br/>
		<input  id="phptext-phptext_elements_id-<?php echo $number; ?>" name="widget-phptext[<?php echo $number; ?>][phptext_elements_id]" type="text" value="<?php echo $phptext_elements_id; ?>" size="35" /><br/><br/>
		Enter the code (MUST be enclosed in &lt;?php and ?&gt; tags!)<br/>
		<textarea id="phptext-text-<?php echo $number; ?>" name="widget-phptext[<?php echo $number; ?>][text]" cols="30" rows="6"><?php echo $text; ?></textarea>
		<input type="hidden" id="phptext-submit-<?php echo $number; ?>" name="phptext-submit-<?php echo $number; ?>" value="1" />
		</p>
<?php
}

function widget_phptext_register() {
	// Check for the required API functions
	if ( !function_exists('wp_register_sidebar_widget') || !function_exists('wp_register_widget_control') )
		return;
	if ( !$options = get_option('widget_phptext') )
		$options = array();
	$widget_ops = array('classname' => 'widget_phptext', 'description' => __('Assign widget to pages, posts, categories, tags and the "has tag" as well as all areas of the site by default'));
	$control_ops = array('width' => 400, 'height' => 300, 'id_base' => 'phptext');
	$name = __('PHP Custom Widget');
	$id = false;
	foreach ( array_keys($options) as $o ) {
		// Old widgets can have null values for some reason
		if ( !isset($options[$o]['title']) || !isset($options[$o]['text']) )
			continue;
		$id = "phptext-$o"; // Never never never translate an id
		wp_register_sidebar_widget($id, $name, 'widget_phptext', $widget_ops, array( 'number' => $o ));
		wp_register_widget_control($id, $name, 'widget_phptext_control', $control_ops, array( 'number' => $o ));
	}
	// If there are none, we register the widget's existance with a generic template
	if ( !$id ) {
		wp_register_sidebar_widget( 'phptext-1', $name, 'widget_phptext', $widget_ops, array( 'number' => -1 ) );
		wp_register_widget_control( 'phptext-1', $name, 'widget_phptext_control', $control_ops, array( 'number' => -1 ) );
	}
}
add_action( 'widgets_init', 'widget_phptext_register' );
?>