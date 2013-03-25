<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */

$pp_theme_version = '1.1';
 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html <?php language_attributes(); ?>>
<head>


<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title('&lsaquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>


<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap/bootstrap-responsive.css"  />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	/**
	*	Get favicon URL
	**/
	$pp_favicon = get_option('pp_favicon');
	
	if(!empty($pp_favicon))
	{
?>
		<link rel="shortcut icon" href="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/cache/<?php echo $pp_favicon; ?>" />
<?php
	}
?>

<!-- Template stylesheet -->
<?php

	wp_enqueue_style("jqueryui_css", get_bloginfo( 'stylesheet_directory' )."/css/jqueryui/custom.css", false, $pp_theme_version, "all");
	wp_enqueue_style("screen_css", get_bloginfo( 'stylesheet_directory' )."/css/screen.css", false, $pp_theme_version, "all");
	wp_enqueue_style("fancybox_css", get_bloginfo( 'stylesheet_directory' )."/js/fancybox/jquery.fancybox-1.3.0.css", false, $pp_theme_version, "all");
	wp_enqueue_style("videojs_css", get_bloginfo( 'stylesheet_directory' )."/js/video-js.css", false, $pp_theme_version, "all");
	wp_enqueue_style("vim_css", get_bloginfo( 'stylesheet_directory' )."/js/skins/vim.css", false, $pp_theme_version, "all");
	wp_enqueue_style("ui_css", get_bloginfo( 'stylesheet_directory' )."/css/jquery-ui-1.9.2.custom.min.css", false, $pp_theme_version, "all");
?>

<?php

	/**
	*	Check Google Maps key
	**/
	$pp_gm_key = get_option('pp_gm_key');

	if(!empty($pp_gm_key))
	{
	
?>
<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=<?php echo $pp_gm_key; ?>&amp;hl=en"></script>
<?php
	}
?> 

<?php

	wp_deregister_script('jquery');
	$jqueryVersion = '1.7.2';
	wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/' . $jqueryVersion . '/jquery.min.js', array(), $jqueryVersion);
	wp_enqueue_script("jquery");

	wp_enqueue_script("jQuery_ui", get_bloginfo( 'stylesheet_directory' )."/js/jquery-ui-1.9.2.custom.js", false, $pp_theme_version);
	//wp_enqueue_script("jQuery_UI_js", get_bloginfo( 'stylesheet_directory' )."/js/jquery-ui.js", false, $pp_theme_version);
	wp_enqueue_script("fancybox_js", get_bloginfo( 'stylesheet_directory' )."/js/fancybox/jquery.fancybox-1.3.0.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_easing", get_bloginfo( 'stylesheet_directory' )."/js/jquery.easing.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_nivo", get_bloginfo( 'stylesheet_directory' )."/js/jquery.nivo.slider.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_anything_slider", get_bloginfo( 'stylesheet_directory' )."/js/anythingSlider.js", false, $pp_theme_version);
	
	/*<script src="bootstrap/js/bootstrap.js" type="text/javascript" ></script>*/

	/**
	*	Check Google Maps key
	**/
	$pp_gm_key = get_option('pp_gm_key');

	if(!empty($pp_gm_key))
	{
		wp_enqueue_script("jQuery_gmap", get_bloginfo( 'stylesheet_directory' )."/js/gmap.js", false, $pp_theme_version);
	}
	wp_enqueue_script("hint", get_bloginfo( 'stylesheet_directory' )."/js/hint.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_validate", get_bloginfo( 'stylesheet_directory' )."/js/jquery.validate.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_cufon", get_bloginfo( 'stylesheet_directory' )."/js/cufon.js", false, $pp_theme_version);
	wp_enqueue_script("browser_js", get_bloginfo( 'stylesheet_directory' )."/js/browser.js", false, $pp_theme_version);
	wp_enqueue_script("video_js", get_bloginfo( 'stylesheet_directory' )."/js/video.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.tipsy", get_bloginfo( 'stylesheet_directory' )."/js/jquery.tipsy.js", false, $pp_theme_version);
	wp_enqueue_script("custom_js", get_bloginfo( 'stylesheet_directory' )."/js/custom.js", false, $pp_theme_version);
	wp_enqueue_script("validate_js", "http://jzaefferer.github.com/jquery-validation/jquery.validate.js", false, $pp_theme_version);
?> 

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/ie7.css?v=<?php echo $pp_theme_version; ?>" type="text/css" media="all"/>
<![endif]-->

<!--[if lte IE 8]>
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/ie?v=<?php echo $pp_theme_version; ?>.css" type="text/css" media="all"/>
<![endif]-->

<style>
<?php
	$pp_bg_pattern = get_option('pp_bg_pattern');
	$pp_bg = get_option('pp_bg');
	if(empty($pp_bg))
	{
		$pp_bg = '#212C35';
	}

	if(!empty($pp_bg_pattern))
	{
?>
body #header_wrapper
{
	background: <?php echo $pp_bg; ?> url('<?php bloginfo( 'stylesheet_directory' ); ?>/images/header_bg.png') no-repeat top center;
}

body #header_pattern
{
	background: transparent url('<?php bloginfo( 'stylesheet_directory' ); ?>/images/skins/<?php echo $pp_bg_pattern; ?>_pattern.png') repeat;
}

body.home #header_wrapper
{
	background: <?php echo $pp_bg; ?> url('<?php bloginfo( 'stylesheet_directory' ); ?>/images/header_bg.png') no-repeat top center;
}

body.home #header_pattern
{
	background: transparent url('<?php bloginfo( 'stylesheet_directory' ); ?>/images/skins/<?php echo $pp_bg_pattern; ?>_pattern.png') repeat;
}
<?php
	
	}
	else
	{
?>
body #header_wrapper
{
	background: <?php echo $pp_bg; ?> url('<?php bloginfo( 'stylesheet_directory' ); ?>/images/header_bg.png') no-repeat top center;
}

body #header_pattern
{
	background: none;
}

body.home #header_wrapper
{
	background: <?php echo $pp_bg; ?> url('<?php bloginfo( 'stylesheet_directory' ); ?>/images/header_bg.png') no-repeat top center;
}

body.home #header_pattern
{
	background: none;
}
<?php
	}
?>

<?php
	$pp_menu_color = get_option('pp_menu_color');
	
	if(!empty($pp_menu_color))
	{
?>
#menu_wrapper .nav ul li > a, #menu_wrapper div .nav li > a
{
	color: <?php echo $pp_menu_color; ?>;
}
<?php
	}
?>

<?php
	$pp_h1_font_color = get_option('pp_h1_font_color');
	
	if(!empty($pp_h1_font_color))
	{
?>
h1,h2,h3,h4,h5,h6,h1.tagline_header { color:<?php echo $pp_h1_font_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_header_textcolor = get_option('pp_header_textcolor');
	
	if(!empty($pp_header_textcolor))
	{
?>
.header_title h2 { color:<?php echo $pp_header_textcolor; ?>; }
<?php
	}
	
?>

<?php
	$pp_h1_size = get_option('pp_h1_size');
	
	if(!empty($pp_h1_size))
	{
?>
h1 { font-size:<?php echo $pp_h1_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h2_size = get_option('pp_h2_size');
	
	if(!empty($pp_h2_size))
	{
?>
h2 { font-size:<?php echo $pp_h2_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h3_size = get_option('pp_h3_size');
	
	if(!empty($pp_h3_size))
	{
?>
h3 { font-size:<?php echo $pp_h3_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h4_size = get_option('pp_h4_size');
	
	if(!empty($pp_h4_size))
	{
?>
h4 { font-size:<?php echo $pp_h4_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h5_size = get_option('pp_h5_size');
	
	if(!empty($pp_h5_size))
	{
?>
h5 { font-size:<?php echo $pp_h5_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h6_size = get_option('pp_h6_size');
	
	if(!empty($pp_h6_size))
	{
?>
h6 { font-size:<?php echo $pp_h6_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_font_color = get_option('pp_font_color');
	
	if(!empty($pp_font_color))
	{
?>
body { color:<?php echo $pp_font_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_link_color = get_option('pp_link_color');
	
	if(!empty($pp_link_color))
	{
?>
a { color:<?php echo $pp_link_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_hover_link_color = get_option('pp_hover_link_color');
	
	if(!empty($pp_hover_link_color))
	{
?>
a:hover, a:active { color:<?php echo $pp_hover_link_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
		$pp_button_bg_color_light = '#'.hex_lighter(substr($pp_button_bg_color, 1), 50);
?>

 input[type=button], a.button { 
	background: <?php echo $pp_button_bg_color; ?>;
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $pp_button_bg_color_light; ?>), to(<?php echo $pp_button_bg_color; ?>));
	background: -moz-linear-gradient(top,  <?php echo $pp_button_bg_color_light; ?>,  <?php echo $pp_button_bg_color; ?>);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $pp_button_bg_color_light; ?>', endColorstr='<?php echo $pp_button_bg_color; ?>');
}

 input[type=button]:active, a.button:active
{
	background: <?php echo $pp_button_bg_color; ?>;
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $pp_button_bg_color; ?>), to(<?php echo $pp_button_bg_color_light; ?>));
	background: -moz-linear-gradient(top,  <?php echo $pp_button_bg_color; ?>,  <?php echo $pp_button_bg_color_light; ?>);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $pp_button_bg_color_light; ?>', endColorstr='<?php echo $pp_button_bg_color; ?>');
}
<?php
	}
	
?>

<?php
	$pp_button_font_color = get_option('pp_button_font_color');
	
	if(!empty($pp_button_font_color))
	{
?>
 input[type=button], a.button { 
	color: <?php echo $pp_button_font_color; ?>;
}
 input[type=button]:hover, a.button:hover
{
	color: <?php echo $pp_button_font_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_button_border_color = get_option('pp_button_border_color');
	
	if(!empty($pp_button_border_color))
	{
?>

, input[type=button], a.button { 
	border: 1px solid <?php echo $pp_button_border_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_footer_font_color = get_option('pp_footer_font_color');
	
	if(!empty($pp_footer_font_color))
	{
?>
#footer, #footer ul { color:<?php echo $pp_footer_font_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_footer_link_color = get_option('pp_footer_link_color');
	
	if(!empty($pp_footer_link_color))
	{
?>
#footer a { color:<?php echo $pp_footer_link_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_footer_hover_link_color = get_option('pp_footer_hover_link_color');
	
	if(!empty($pp_footer_hover_link_color))
	{
?>
#footer a:hover, #footer a:active { color:<?php echo $pp_footer_hover_link_color; ?>; }
<?php
	}
	
?>
</style>

<?php
if(is_front_page())
{
?>
<script>
$j(document).ready(function(){
	 
	$j('#menu_wrapper .menu-main-menu-container .nav li a[title=Home]').parent('li').addClass('current-menu-item');
});
</script>
<?php
}
?>

<?php
	/**
	*	Get custom CSS
	**/
	$pp_custom_css = get_option('pp_custom_css');
	
	
	if(!empty($pp_custom_css))
	{
		echo '<style>';
		echo $pp_custom_css;
		echo '</style>';
	}
?>


</head>

<?php

/**
*	Get Current page object
**/
$page = get_page($post->ID);


/**
*	Get current page id
**/
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

?>

<body <?php body_class(); ?>>
	
	<!-- Begin template wrapper -->
	<div id="wrapper">
			
		<!-- Begin header -->
		<div id="header_wrapper">
			<div id="top_bar">
				<div class="logo">
						<!-- Begin logo -->
					
					<?php
							//get custom logo
						$pp_logo = get_option('pp_logo');
						
						if(empty($pp_logo))
						{
							$pp_logo = get_bloginfo( 'stylesheet_directory' ).'/images/logo.png';
						}
						else
						{
							$pp_logo = get_bloginfo( 'stylesheet_directory' ).'/cache/'.$pp_logo;
						}

					?>
					<a id="custom_logo" href="<?php bloginfo( 'url' ); ?>"><img src="<?php echo $pp_logo?>" alt=""/></a>
					<!-- End logo -->
				</div>
				<!-- Begin main nav -->
				<div id="menu_wrapper">
					<?php $val=  get_bloginfo( 'stylesheet_directory' ).'/images/icon/play_16x16.png' ?>  
               		<?php 	
		    			//Get page nav
		    			wp_nav_menu( 
	    					array( 
	    						'menu_id'			=> 'main_menu',
	    						'menu_class'		=> 'nav',
	    						'theme_location' 	=> 'primary-menu',
	    						) 
	    					); 
				    ?>
				</div>
					<!-- End main nav -->
					
			</div>
				
				<br class="clear"/>
		<?php //echo do_shortcode('[nv_slider]'); ?>