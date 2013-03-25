		<?php
				// $pp_slider_items = get_option('pp_slider_items');
				
				// if(empty($pp_slider_items))
				// {
				// 	$pp_slider_items = 5;
				// }

				// $pp_slider_sort = get_option('pp_slider_sort'); 
				// if(empty($pp_slider_sort))
				// {
				// 	$pp_slider_sort = 'ASC';
				// }
			
				// $slider_arr = get_posts('numberposts='.$pp_slider_items.'&order='.$pp_slider_sort.'&orderby=date&post_type=slides');

				// if(!empty($slider_arr))
				// {
		?>
		
				<div id="anything_slider">
					<div class="wrapper">
						<?php echo do_shortcode('[nv_slider]'); ?>
					</div>
				</div>
		
		<?php 
				// }
		?>
		
<?php
	$pp_homepage_slider_nav = true;
	
	$pp_slider_auto_play = get_option('pp_slider_auto_play');
	if(!empty($pp_slider_auto_play))
	{
		$pp_slider_auto_play = 'true';
	}
	else
	{
		$pp_slider_auto_play = 'false';
	}
	
	$pp_slider_animation_time = get_option('pp_slider_animation_time');
	if(empty($pp_slider_animation_time))
	{
		$pp_slider_animation_time = 600;
	}
?>
		
