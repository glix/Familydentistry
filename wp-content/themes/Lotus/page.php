<?php
/**
 * The main template file for display page.
 *
 * @package WordPress
*/


/**
*	Get Current page object
**/
$page = get_page($post->ID);
if(is_front_page()) { include(TEMPLATEPATH . '/index.php'); }
/**
*	Get current page id
**/
if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}
else
{
	global $query_string;
	query_posts($query_string . "&page_id=".$current_page_id);
}

$page_style = get_post_meta($current_page_id, 'page_style', true);
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);
$page_button_title = get_post_meta($current_page_id, 'page_button_title', true);
$page_button_href = get_post_meta($current_page_id, 'page_button_href', true);

if(empty($page_sidebar))
{
	$page_sidebar = 'Page Sidebar';
}

if(empty($page_style))
{
	$page_style = 'Fullwidth';
}

$add_sidebar = FALSE;
$sidebar_class = '';

if($page_style == 'Right Sidebar')
{
	$add_sidebar = TRUE;
	$page_class = 'sidebar_content';
}
elseif($page_style == 'Left Sidebar')
{
	$add_sidebar = TRUE;
	$page_class = 'sidebar_content';
	$sidebar_class = 'left_sidebar';
}
else
{
	$page_class = 'inner_wrapper';
}

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

if(!isset($hide_header) OR !$hide_header)
{
?>
<!-- this is for not show titlte-->
		<!--<div class="page_caption">
			<div class="caption_inner">
				<div class="caption_header">
					<h1 class="cufon"><?php //echo the_title(); ?></h1>
				</div>
				
				<?php 
					//if(!empty($page_button_title))
					//{
				?>
						<div style="float:right;margin:20px 20px 0 0">
							<a class="button" href="<?php //echo $page_button_href; ?>"><?php //echo $page_button_title; ?></a>
						</div>
				<?php
					//}
				?>
			</div>
		</div>-->
		
		<div id="header_pattern"></div>
		
		</div>

		<!-- Begin content -->
		<div id="content_wrapper">
			
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">
				
<?php
}
?>
				
					<?php
						if($add_sidebar && $page_style == 'Left Sidebar')
						{
					?>
						<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
						
							<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
						
							<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
							
								<div class="content">
							
									<ul class="sidebar_widget">
									<?php dynamic_sidebar($page_sidebar); ?>
									</ul>
								
								</div>
						
							</div>
							<br class="clear"/>
					
							<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
						</div>
					<?php
						}
					?>
					
					<?php if($add_sidebar) { ?>
						<div class="sidebar_content <?php echo $sidebar_class; ?>">
					<?php } ?>
					
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
						<h3 class="cufon"><?php echo the_title(); ?></h3>
                        <br class="clear" />
                        <div>
						<?php do_shortcode(the_content()); break; 
						// the_content(); ?>
					</div>
					<?php endwhile; ?>
					
					<?php if($add_sidebar) { ?>
						</div>
					<?php } ?>
					
					<?php
						if($add_sidebar && $page_style == 'Right Sidebar')
						{
					?>
					
						<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
						
							<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
						
							<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
							
								<div class="content">
							
									<ul class="sidebar_widget">
									<?php dynamic_sidebar($page_sidebar); ?>
									</ul>
								
								</div>
						
							</div>
							<br class="clear"/>
					
							<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
						</div>
					<?php
						}
					?>
				
				</div>
				<!-- End main content -->
				
				<br class="clear"/>
			</div>
			
<?php 
if(!isset($hide_header) OR !$hide_header OR is_null($hide_header))
{
?>
		</div>
		<!-- End content -->
			

<?php get_footer(); ?>

<?php
}
?>