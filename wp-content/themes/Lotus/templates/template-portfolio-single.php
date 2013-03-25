<?php
/**
 * The main template file for display single portfolio page.
 *
 * @package WordPress
*/


get_header(); 

?>
		
		<div id="header_pattern"></div>
		
		</div>

		<!-- Begin content -->
		<div id="content_wrapper" style="margin-top:-20px">
		
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">
				
					<div class="fullwidth">	
<?php

if (have_posts()) : while (have_posts()) : the_post();

?>
							
					<h2 class="cufon"><?php echo the_title(); ?></h2>
                    <br class="clear" />
				
						<?php echo do_shortcode(the_content()); ?>
						

<?php endwhile; endif; ?>

						</div>
					
				</div>
				<!-- End main content -->
				
			</div>
			
			<br class="clear"/>
			
		</div>
		<!-- End content -->

<?php get_footer(); ?>