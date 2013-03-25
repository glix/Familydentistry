<?php
/**
 * The main template file for display archive page.
 *
 * @package WordPress
*/

$post_type = get_post_type();

if($post_type == 'portfolios')
{
	$pp_portfolio_style = get_option('pp_portfolio_style');
	
	if(empty($pp_portfolio_style))
	{
		$pp_portfolio_style = 'thumb-detail';
	}
	
	include (TEMPLATEPATH . "/templates/template-portfolio-".$pp_portfolio_style.".php");
	exit;
}
elseif($post_type == 'photos')
{
	include (TEMPLATEPATH . "/gallery.php");
	exit;
}
elseif($post_type == 'videos')
{
	include (TEMPLATEPATH . "/video_gallery.php");
	exit;
}
else
{

get_header(); 

$page_style = 'Right Sidebar';
$page_sidebar = 'Blog Sidebar';
$caption_class = "page_caption";

$add_sidebar = TRUE;
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

$pp_title = get_option('pp_blog_title');

if(empty($pp_title))
{
	$pp_title = 'Blog';
}

if(!isset($hide_header) OR !$hide_header)
{
?>
	<!--<div class="page_caption">
			<div class="caption_inner">
				<div class="caption_header">
					<h1 class="cufon">--><?php // if ( is_day() ) : ?>
				<?php //printf( __( 'Archives | %s', '' ), get_the_date() ); ?>
<?php //elseif ( is_month() ) : ?>
				<?php //printf( __( 'Archives | %s', '' ), get_the_date('F Y') ); ?>
<?php //elseif ( is_year() ) : ?>
				<?php //printf( __( 'Archives | %s', '' ), get_the_date('Y') ); ?>
<?php //else : ?>
				<?php //_e( 'Blog Archives', '' ); ?>
<?php //endif; ?><!--</h1>
				</div>
			</div>
		</div>-->
		
		<div id="header_pattern"></div>
		
		</div>

		<!-- Begin content -->
		<div id="content_wrapper" style="margin-top:-20px">
			
			<div class="inner">

				<!-- Begin main content -->
				<div class="inner_wrapper"><br class="clear"/>
				
<?php
}
?>

					<?php 
						if($add_sidebar && $page_style == 'Left Sidebar')
						{
					?>
						<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
						
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
				
					<div class="sidebar_content">
					
<?php

global $more; $more = false; # some wordpress wtf logic

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	$post_img_align = get_post_meta(get_the_ID(), 'post_img_align', true);
	if(empty($post_img_align))
	{
		$post_img_align = 'Center';
	}
	
	$post_img_align = strtolower($post_img_align);
								
	if(has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	    
	    if($post_img_align == 'center')
	    {
	  		$pp_blog_image_width = 640;
			$pp_blog_image_height = 240;
		}
		else
		{
			$pp_blog_image_width = 240;
			$pp_blog_image_height = 180;
		}
	}
?>
						
						
						<!-- Begin each blog post -->
						<div class="post_wrapper">
						
							<div class="post_header">
								<h3 class="cufon">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>								
									</a>
								</h3>
								<div class="post_detail">
									<?php the_time('d M Y'); ?>&nbsp;|&nbsp;
									Posted by&nbsp;<?php the_author(); ?>&nbsp;|&nbsp; <?php comments_number('0 Comment', '1 Comment', '% Comments'); ?>.
								</div>
							</div>
							<div class="circle_comment">
								<div><?php comments_number('0', '1', '%'); ?></div>
							</div>
							
							<?php
								if(!empty($image_thumb))
								{
									if($post_img_align == 'center')
	   			 					{
							?>
									<br class="clear"/><br/>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_thumb[0]; ?>&amp;h=<?php echo $pp_blog_image_height; ?>&amp;w=<?php echo $pp_blog_image_width; ?>&amp;zc=1" alt="" class="img_nofade frame"/>
									</a>
									<br class="clear"/><br/>
							<?php
									}
									else
									{
							?>
									<br class="clear"/><br/>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/timthumb.php?src=<?php echo $image_thumb[0]; ?>&amp;h=<?php echo $pp_blog_image_height; ?>&amp;w=<?php echo $pp_blog_image_width; ?>&amp;zc=1" alt="" class="img_nofade frame align<?php echo $post_img_align; ?>"/>
									</a>
							<?php
									}
								}
							?>
							
							<?php echo get_the_content_with_formatting(); ?>
							
							<br class="clear"/>
							
							<hr/>
						
							<br class="clear"/>
						</div>
						<!-- End each blog post -->
						



<?php endwhile; endif; ?>

						<div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
						
					</div>
					
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
					
				</div>
				<!-- End main content -->
				
				<br class="clear"/>
				
			</div>
			
<?php
if(!isset($hide_header) OR !$hide_header)
{
?>
			
		</div>
		<!-- End content -->
				

<?php get_footer(); ?>

<?php
}

}
?>