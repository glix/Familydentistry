<?php
/**
 * The main template file.
 *
 * @package WordPress
 */

session_start();
$pp_homepage_hide_slider = get_option('pp_homepage_hide_slider');
$pp_slider_timer = get_option('pp_slider_timer'); 
				
if(empty($pp_slider_timer))
{
    $pp_slider_timer = 5;
}
				
get_header(); ?>	
	
		<script type="text/javascript"> 
    	$j(function () {
    		$j.fancybox.showActivity;
    	});	
    	</script>		

		<input type="hidden" id="slider_timer" name="slider_timer" value="<?php echo $pp_slider_timer; ?>"/>
	
		<?php
			if(!empty($pp_homepage_hide_slider))
			{
		?>
	
		<br class="clear"/>
		<br class="clear"/>
		<div id="header_pattern"></div>
		
		<div id="slider_wrapper">
			
			<?php
					include (TEMPLATEPATH . "/templates/template-slider-slide.php");
			?>
			
		</div>
		
		</div>	
		<!-- End header -->
		
		<?php
			}
			else{
		?>
		</div>
		<?php 
	}
	?>
		<?php
				$pp_homepage_hide_tagline = get_option('pp_homepage_hide_tagline');
				
				if(!empty($pp_homepage_hide_tagline))
				{
					$pp_homepage_tagline_title = get_option('pp_homepage_tagline_title');
					if(empty($pp_homepage_tagline_title))
					{
						$pp_homepage_tagline_title = 'Lotus Theme for Business. Purchase now only $35';
					}
					
					$pp_tagline_button_title = get_option('pp_tagline_button_title');
					if(empty($pp_tagline_button_title))
					{
						$pp_tagline_button_title = 'Buy Now';
					}
					
					$pp_tagline_button_href = get_option('pp_tagline_button_href');
			?>		
	<!-- 			 <?php //if ( function_exists('show_nivo_slider') ) { show_nivo_slider(); } ?> -->
			<div class="tagline">
				<div class="standard_wrapper small">
					<div style="float:left">
						<h2 class="tagline_header cufon"><?php echo stripcslashes($pp_homepage_tagline_title); ?>
</h2>
					</div>
					<div style="float:right;">
						<a class="btn btn-success" style="font-family:BebasNeue,​​Arial,​​Verdana,​​sans-serif" href="<?php echo $pp_tagline_button_href; ?>"><?php echo $pp_tagline_button_title; ?></a>
					</div>
				</div>
			</div>
			
			<?php
				} //end if hide tagline
			?>
			
		<!-- Begin content -->
		<div id="content_wrapper">
			
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">
					<?php
						$pp_homepage_hide_right_sidebar = get_option('pp_homepage_hide_right_sidebar');
						$pp_homepage = get_option('pp_homepage'); 
				
				  		if(!$pp_homepage_hide_right_sidebar)
							{
					?>
					<div class="standard_wrapper small">
					<?php 
						$pp_homepage_content = unserialize(get_option('pp_homepage_content_sort_data'));
						global $wp_query;
						if(is_array($pp_homepage_content) && !empty($pp_homepage_content))
							{
							
								foreach($pp_homepage_content as $key => $pp_homepage)
								{
									$template_name = get_post_meta( $pp_homepage, '_wp_page_template', true );

									if(empty($template_name) OR $template_name == 'default')
									{
									    $obj_home = get_page($pp_homepage);
									    $pp_home_content = $obj_home->post_content;
									    echo do_shortcode($pp_home_content);
									}
									elseif($template_name == 'blog.php')
									{
									    $hide_header = TRUE;
									    include(TEMPLATEPATH.'/blog_home.php');
									}
									else
									{
									    $hide_header = TRUE;
									    include(TEMPLATEPATH.'/'.$template_name);
									}
									
								if(isset($pp_homepage_content[$key+1]))
								{	
						?>
						
								<br class="clear"/><br/>
						
						<?php	}
									
								}
							}
						?>
				</div>
			
			<?php
				}
				else
				{
			?>
			
				<div class="sidebar_content" style="position:relative;left:10px;width:660px">
					<div>
						<?php 
							$pp_homepage_content = unserialize(get_option('pp_homepage_content_sort_data'));
							
							global $wp_query;

							if(is_array($pp_homepage_content) && !empty($pp_homepage_content))
							{
							
								foreach($pp_homepage_content as $key => $pp_homepage)
								{
									$template_name = get_post_meta( $pp_homepage, '_wp_page_template', true );

									if(empty($template_name) OR $template_name == 'default')
									{
									    $obj_home = get_page($pp_homepage);
									    $pp_home_content = $obj_home->post_content;
									    echo do_shortcode($pp_home_content);
									}
									elseif($template_name == 'blog.php')
									{
									    $hide_header = TRUE;
									    include(TEMPLATEPATH.'/blog_home.php');
									}
									else
									{
									    $hide_header = TRUE;
									    include(TEMPLATEPATH.'/'.$template_name);
									}
						
								if(isset($pp_homepage_content[$key+1]))
								{			
						?>
						
								<br class="clear"/><br/>
						
						<?php	}
									
								}
							}
						?>
					</div>
				</div>
				
				<div class="sidebar_wrapper">
						
					<div class="sidebar">
					
					    <div class="content">
					
					    	<ul class="sidebar_widget">
					    		<?php dynamic_sidebar('Home Right Sidebar'); ?>
					    	</ul>
					    
					    </div>
					
					</div>
				</div>
				
				<br class="clear"/>
			
			<?php
			}
			?>
		
		</div>
	</div>
<?php get_footer(); ?>