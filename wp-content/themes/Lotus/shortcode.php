<?php

add_shortcode( 'nv_slider', 'nv_slider_shortcode' );
/*
 * @desc	NV Slider shortcode callback function
 * @author	Ryan Sutana
 */
function nv_slider_shortcode( $atts )
{
	global $wpdb;
	
	ob_start();
	
	$image = '';
	$description = '';
	$nv_slider_table = $wpdb->prefix.'nv_slider';
	
	// fetch data from database for update purposes.
	$nv_slider = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $nv_slider_table", NULL) );
		
	// get the input data from the back-end
	$effect = $nv_slider[0]->effect;
	$animSpeed = $nv_slider[0]->animSpeed;
	$pauseTime = $nv_slider[0]->pauseTime;
	$startSlide = $nv_slider[0]->startSlide;
	$directionNav = $nv_slider[0]->directionNav;
	$controlNav = $nv_slider[0]->controlNav;
	$keyboardNav = $nv_slider[0]->keyboardNav;
	$pauseOnHover = $nv_slider[0]->pauseOnHover;
	$width = $nv_slider[0]->width;
	$height = $nv_slider[0]->height;
	?>
	
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#slider").nivoSlider({
				effect: '<?php echo $effect; ?>',
				animSpeed: <?php echo $animSpeed; ?>,
				pauseTime: <?php echo $pauseTime; ?>,
				startSlide: <?php echo $startSlide; ?>,
				directionNav: <?php echo $directionNav; ?>,
				controlNav: <?php echo $controlNav; ?>,
				keyboardNav: <?php echo $keyboardNav; ?>,
				pauseOnHover: <?php echo $pauseOnHover; ?>
			});
		});
	</script>
	
	<style type="text/css">
		.nivo-caption { height: <?php echo $height - 60; ?>px; }
	</style>

	<div id="slider-wrapper">
		<div id="slider" class="nivo-Slider" style="width: <?php echo $width; ?>px;">
			<?php
				$image = '';
				$description = '';
				
				$args = array(
					'post_type'		=> 'nv-slider',
					'post_per_page'	=> -1
				);
				$nv_query = new WP_Query( $args );
				// debug($nv_query);exit;
				$index= 1;
				if( $nv_query->have_posts() ) {
					$x=1; 
					
					while( $nv_query->have_posts() ) : $nv_query->the_post();
					$index++;
						$get_custom_url = get_post_meta( get_the_ID(), 'nv_slider_custom_url', true );
						$custom_url = empty( $get_custom_url ) ? get_permalink() : $get_custom_url;
						 
						$attr = array(
							'alt'	=> trim(strip_tags( get_the_title() )),
							'title'	=> '#slider_caption'.$x,
						);
						
						$image .= get_the_post_thumbnail( get_the_ID(), array($width, $height), $attr );
						$content = get_the_content();
						$description .= '<div id="slider_caption'.$x.'" class="nivo-html-caption">'.
							'<span style="font-size:20px;font-family:Arial,​​Verdana,​​sans-serif"class="slider-title"><a href="'. $custom_url .'" title="'. esc_attr( get_the_title() ) .'">'. get_the_title() .'</a></span>'.'<p style="margin-top:-2px;margin-left:5px;font-family:Arial,​​Verdana,​​sans-serif;font-size:14px">'.substr($content, 0, 140).'</p>'.
						'</div>'."\n";
						
						$x++; // increase value of x by 1
					endwhile; wp_reset_query();
				} else {
					echo 'No slider found!';
				}
				
				// output slider image
				echo $image;
			?>
		</div>
		
		<?php
			// output slider description
			echo $description;
		?>
		
	</div><?php
	// Stop output buffering and capture debug HTML
	$html = ob_get_contents();
	ob_end_clean();
	
	return $html;
}

?>