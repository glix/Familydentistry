<?php

define("THEMENAME", "Lotus");
define("SHORTNAME", "pp");


//If delete sidebar
if(isset($_POST['sidebar_id']) && !empty($_POST['sidebar_id']))
{
	$current_sidebar = get_option('pp_sidebar');
	
	if(isset($current_sidebar[ $_POST['sidebar_id'] ]))
	{
		unset($current_sidebar[ $_POST['sidebar_id'] ]);
		update_option( "pp_sidebar", $current_sidebar );
	}
	
	echo 1;
	exit;
}

//If delete image
if(isset($_POST['field_id']) && !empty($_POST['field_id']))
{
	$current_val = get_option($_POST['field_id']);
	unlink(TEMPLATEPATH.'/cache/'.$current_val);
	delete_option( $_POST['field_id'] );
	
	echo 1;
	exit;
}

/*
 *  Setup main navigation menu
 */
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
}

if ( function_exists( 'add_theme_support' ) ) {
	// Setup thumbnail support
	add_theme_support( 'post-thumbnails' );
}
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'postthumb' );
        set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   
}

if ( function_exists( 'add_image_size' ) ) { 
	
	add_image_size( 'postthumb', 200, 220, true ); //(cropped)
}

/**
*	Setup all theme's library
**/

/**
*	Setup admin setting
**/
include (TEMPLATEPATH . "/lib/admin.lib.php");
include (TEMPLATEPATH . "/lib/twitter.lib.php");

/**
*	Setup Sidebar
**/
include (TEMPLATEPATH . "/lib/sidebar.lib.php");


//Get custom function
include (TEMPLATEPATH . "/lib/custom.lib.php");


//Get custom shortcode
include (TEMPLATEPATH . "/lib/shortcode.lib.php");


// Setup theme custom widgets
include (TEMPLATEPATH . "/lib/widgets.lib.php");


$pp_handle = opendir(TEMPLATEPATH.'/fields');
$pp_font_arr = array();

while (false!==($pp_file = readdir($pp_handle))) {
	if ($pp_file != "." && $pp_file != ".." && $pp_file != ".DS_Store") { 
		include (TEMPLATEPATH . "/fields/".$pp_file);
	}
}
closedir($pp_handle);


function pp_add_admin() {
 
global $themename, $shortname, $options;
 
if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
 
	if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) 
		{
			if($value['type'] != 'image')
			{
				update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			}
		}
 
foreach ($options as $value) {

	if( isset( $_REQUEST[ $value['id'] ] )  && $value['type'] != 'image') { 
		if($value['id'] != $shortname."_sidebar0")
		{
			//if sortable type
			if($value['type'] == 'sortable')
			{
				$sortable_array = serialize($_REQUEST[ $value['id'] ]);
				
				$sortable_data = $_REQUEST[ $value['id'].'_sort_data'];
				$sortable_data_arr = explode(',', $sortable_data);
				$new_sortable_data = array();
				
				foreach($sortable_data_arr as $key => $sortable_data_item)
				{
					$sortable_data_item_arr = explode('_', $sortable_data_item);
					
					if(isset($sortable_data_item_arr[0]))
					{
						$new_sortable_data[] = $sortable_data_item_arr[0];
					}
				}
				
				update_option( $value['id'], $sortable_array );
				update_option( $value['id'].'_sort_data', serialize($new_sortable_data) );
			}
			else
			{
				update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
			}
		}
		elseif(isset($_REQUEST[ $value['id'] ]) && !empty($_REQUEST[ $value['id'] ]))
		{
			//get last sidebar serialize array
			$current_sidebar = get_option($shortname."_sidebar");
			$current_sidebar[ $_REQUEST[ $value['id'] ] ] = $_REQUEST[ $value['id'] ];

			update_option( $shortname."_sidebar", $current_sidebar );
		}
	} 
	else if(isset($_FILES[ $value['id'] ])) {
	
		if(is_writable(TEMPLATEPATH.'/cache') && !empty($_FILES[$value['id']]['name']))
		{
		    $current_time = time();
		    $target = TEMPLATEPATH.'/cache/'.$current_time.'_'.basename( $_FILES[$value['id']]['name']);
		    $current_file = TEMPLATEPATH.'/cache/'.get_option($value['id']);

		    if(move_uploaded_file($_FILES[$value['id']]['tmp_name'], $target)) 
		    {
		    	if(file_exists($current_file))
		    	{
			    	unlink($current_file);
			    }
		     	update_option( $value['id'], $current_time.'_'.basename( $_FILES[$value['id']]['name'])  );
		    }
		}
	}
	else 
	{ 
		delete_option( $value['id'] );
	} 
}

 
	header("Location: admin.php?page=functions.php&saved=true".$_REQUEST['current_tab']);
 
} 
else if( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=functions.php&reset=true");
 
}
}
 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'pp_admin');
}

function pp_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
wp_enqueue_style("jquery-ui", $file_dir."/functions/jquery-ui/css/ui-lightness/jquery-ui-1.8.10.custom.css", false, "1.0", "all");
wp_enqueue_style("colorpicker_css", $file_dir."/functions/colorpicker/css/colorpicker.css", false, "1.0", "all");
wp_enqueue_script("jquery-ui", $file_dir."/functions/jquery-ui/js/jquery-ui-1.8.10.custom.min.js", false, "1.0");
wp_enqueue_script("colorpicker_script", $file_dir."/functions/colorpicker/js/colorpicker.js", false, "1.0");
wp_enqueue_script("eye_script", $file_dir."/functions/colorpicker/js/eye.js", false, "1.0");
wp_enqueue_script("utils_script", $file_dir."/functions/colorpicker/js/utils.js", false, "1.0");
wp_enqueue_script("iphone_checkboxes", $file_dir."/functions/iphone-style-checkboxes.js", false, "1.0");
wp_enqueue_script("jslider_depend", $file_dir."/functions/jquery.dependClass.js", false, "1.0");
wp_enqueue_script("jslider", $file_dir."/functions/jquery.slider-min.js", false, "1.0");
wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");

}
function pp_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
$cache_dir = TEMPLATEPATH.'/cache';
 
if(!is_writable($cache_dir))
{
?>

	<div id="message" class="error fade">
	<p style="line-height:1.5em"><strong>
		The path <?php echo $cache_dir; ?> is not writable, please login with your FTP account and make it writable (chmod 777) otherwise all images won't display.
	</p></strong>
	</div>

<?php
}
?>
	<div class="wrap rm_wrap">
	
	<div class="header_wrap">
		<div style="float:left">
		<h2><?php echo $themename; ?> Settings</h2>
		For future updates follow me <a href="http://themeforest.net/user/peerapong">@themeforest</a> or <a href="http://twitter.com/ipeerapong">@twitter</a>
		</div>
		<div id="icon-options-general" class="icon32" style="float:right;margin:20px 0 0 0"><br></div>
		<br style="clear:both"/><br/><br/>
	</div>
	
	<?php
		if ( isset($_REQUEST['saved']) &&  $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div><br/>';
if ( isset($_REQUEST['reset']) &&  $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div><br/>';
	?>
	
	<?php
		if ( isset($_REQUEST['activate']) &&  $_REQUEST['activate'] ) 
		{
	?>
	
		<div id="message" class="updated fade">
			<p><strong><?php echo THEMENAME; ?> Theme activated</strong></p>
			<p>What's next?<br/><br/>
			<ol>
				<li>The default theme settings are saved but you can navigate to each tab and change them.</li>
				<li>Setup homepage's slider via Slides > Add New Slide</li>
				<li>Go to Pages and add some ex. blog, portfolio, services etc.</li>
				<li>Setup blog posts via Posts > Add New</li>
				<li>Setup portfolio items via Portfolios > Add New Portfolio</li>
			</ol>
		</p><br/>
		<p>
			<strong>*Note: </strong>There is  the theme's manual in /manual/index.html it will help you get through all theme features.
		</p>
		</div>

	<?php
		}
	?>
	
	<div class="wrap">
	<div id="pp_panel" style="border-bottom:1px solid #ccc;padding-left: 10px">
	<?php 
		foreach ($options as $value) {
			/*print '<pre>';
			print_r($value);
			print '</pre>';*/
			
			$active = '';
			
			if($value['type'] == 'section')
			{
				if($value['name'] == 'General')
				{
					$active = 'nav-tab-active';
				}
				echo '<a id="pp_panel_'.strtolower($value['name']).'_a" href="#pp_panel_'.strtolower($value['name']).'" class="nav-tab '.$active.'">'.$value['name'].'</a>';
			}
		}
	?>
	</h2>
	</div>

	<div class="rm_opts">
	<form method="post" enctype="multipart/form-data">
	
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?> <?php break;
 
case "close":
?>
	
	</div>
	</div>


	<?php break;
 
case "title":
?>
	<br />


<?php break;
 
case 'text':
	
	//if sidebar input then not show default value
	if($value['id'] != $shortname."_sidebar0")
	{
		$default_val = get_settings( $value['id'] );
	}
	else
	{
		$default_val = '';	
	}
?>

	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
		value="<?php if ($default_val != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
		<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	<?php
	if($value['id'] == $shortname."_sidebar0")
	{
		$current_sidebar = get_option($shortname."_sidebar");
		
		if(!empty($current_sidebar))
		{
	?>
		<ul id="current_sidebar" class="rm_list">

	<?php
		$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	
		foreach($current_sidebar as $sidebar)
		{
	?> 
			
			<li id="<?=$sidebar?>"><?=$sidebar?> ( <a href="<?php echo $url; ?>" class="sidebar_del" rel="<?=$sidebar?>">Delete</a> )</li>
	
	<?php
		}
	?>
	
		</ul>
	
	<?php
		}
	}
	?>

	</div>
	<?php
break;

case 'password':
?>

	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
		value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>

	</div>
	<?php
break;

break;

case 'image':
?>

	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="file"
		value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	<?php 
		if(is_file($cache_dir.'/'.get_settings( $value['id'] )) && !is_bool(get_settings( $value['id'] )))
		{
			$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	?>
	
	<div id="<?php echo $value['id']; ?>_wrapper" style="margin-left:210px;width:500px;font-size:11px;margin-top:10px">
		Current Image ( <a href="<?php echo $url; ?>" class="image_del" rel="<?php echo $value['id']; ?>">Delete</a> )<br/><br/>
		<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/cache/<?php echo get_settings( $value['id'] ); ?>"/><br/>
	</div>
	<?php
		}
	?>

	</div>
	<?php
break;

case 'jslider':
?>

	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<div style="float:left;width:270px;padding-left:10px">
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="text" class="jslider"
		value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
	</div>
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	<script>jQuery("#<?php echo $value['id']; ?>").slider({ from: <?php echo $value['from']; ?>, to: <?php echo $value['to']; ?>, step: <?php echo $value['step']; ?>, smooth: true });</script>

	</div>
	<?php
break;

case 'colorpicker':
?>
	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<div id="<?php echo $value['id']; ?>_bg" class="colorpicker_bg" onclick="jQuery('#<?php echo $value['id']; ?>').click()" style="background:<?php if (get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>">&nbsp;</div>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="text"
		value="<?php if ( get_settings( $value['id'] ) != "" ) { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?>  class="color_picker"/>
		<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	</div>
	
<?php
break;
 
case 'textarea':
?>

	<div class="rm_input rm_textarea"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<textarea name="<?php echo $value['id']; ?>"
		type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>

	</div>

	<?php
break;
 
case 'select':
?>

	<div class="rm_input rm_select"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

	<select name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>">
		<?php foreach ($value['options'] as $key => $option) { ?>
		<option
		<?php if (get_settings( $value['id'] ) == $key) { echo 'selected="selected"'; } ?>
			value="<?php echo $key; ?>"><?php echo $option; ?></option>
		<?php } ?>
	</select> <small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>
	<?php
break;
 
case 'radio':
?>

	<div class="rm_input rm_select"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

	<div style="float:left;width:350px">
	<?php foreach ($value['options'] as $key => $option) { ?>
	<div style="float:left;margin:0 20px 20px 0">
		<input style="float:left;" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" type="radio"
		<?php if (get_settings( $value['id'] ) == $key) { echo 'checked="checked"'; } ?>
			value="<?php echo $key; ?>"/><?php echo html_entity_decode($option); ?>
	</div>
	<?php } ?>
	</div>
	
		<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>
	<?php
break;

case 'sortable':
?>

	<div class="rm_input rm_select"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

	<div style="float:left;width:570px">
	<?php 
	$sortable_array = unserialize(get_settings( $value['id'] ));
	
	$current = 1;
	
	if(!empty($value['options']))
	{
	foreach ($value['options'] as $key => $option) { 
		if($key > 0)
		{
	?>
	<div class="pp_checkbox" style="float:left;margin:0 20px 20px 0;font-size:11px">
		<div class="pp_checkbox_wrapper">
		<input style="float:left;" id="<?php echo $value['id']; ?>[]" name="<?php echo $value['id']; ?>[]" type="checkbox"
		<?php if (is_array($sortable_array) && in_array($key, $sortable_array)) { echo 'checked="checked"'; } ?>
			value="<?php echo $key; ?>" rel="<?php echo $value['id']; ?>_sort" alt="<?php echo html_entity_decode($option); ?>" />&nbsp;<span style="margin-top:-3px"><?php echo html_entity_decode($option); ?></span>
		</div>
	</div>
	<?php }
	
			if($current>1 && ($current-1)%4 == 0)
			{
	?>
	
			<br style="clear:both"/>
	
	<?php		
			}
			
			$current++;
		}
	}
	?>
	 
	 <br style="clear:both"/>
	 
	 <div class="pp_sortable_header" style="width:420px"><?php echo $value['sort_title']; ?></div>
	 <div class="pp_sortable_wrapper" style="width:420px">
	 Drag each item for sorting.<br/>
	 <ul id="<?php echo $value['id']; ?>_sort" class="pp_sortable" rel="<?php echo $value['id']; ?>_sort_data"> 
	 <?php
	 	$sortable_data_array = unserialize(get_settings( $value['id'].'_sort_data' ));
	 
	 	if(!empty($sortable_data_array))
	 	{
	 	foreach($sortable_data_array as $key => $sortable_data_item)
	 	{
	 		if (is_array($sortable_array) && in_array($sortable_data_item, $sortable_array)) {
	 ?>
	 	<li id="<?php echo $sortable_data_item; ?>_sort" class="ui-state-default"><?php echo $value['options'][$sortable_data_item]; ?></li> 	
	 <?php
	 		}
	 	}
	 	}
	 ?>
	 </ul>
	 
	 </div>
	 
	</div>
	
	<input type="hidden" id="<?php echo $value['id']; ?>_sort_data" name="<?php echo $value['id']; ?>_sort_data" value="" style="width:100%"/>
	<br style="clear:both"/><br/>
	
	<div class="clearfix"></div>
	</div>
	<?php
break;
 
case "checkbox":
?>

	<div class="rm_input rm_checkbox"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
	<input type="checkbox" name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>
<?php break; 

case "iphone_checkboxes":
?>

	<div class="rm_input rm_checkbox"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
	<input type="checkbox" class="iphone_checkboxes" name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>

<?php break; 
	
case "section":

$i++;

?>

	<div id="pp_panel_<?php echo strtolower($value['name']); ?>" class="rm_section">
	<div class="rm_title">
	<h3><img
		src="<?php bloginfo('template_directory')?>/functions/images/trans.png"
		class="inactive" alt="""><?php echo $value['name']; ?></h3>
	<span class="submit"><input class="button-primary" name="save<?php echo $i; ?>" type="submit"
		value="Save changes" /> </span>
	<div class="clearfix"></div>
	</div>
	<div class="rm_options"><?php break;
 
}
}
?>
<br/>
 <input class="button-primary" name="save<?php echo $i; ?>" type="submit"
		value="Save changes" style="margin-left: 25px;"" /><br/><br/>
 <input type="hidden" name="action" value="save" />
 <input type="hidden" name="current_tab" id="current_tab" value="#pp_panel_general" />
	</form>
	<form method="post" enctype="multipart/form-data"><!-- p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p --></form>
	</div>


	<?php
}


add_action('admin_init', 'pp_add_init');
add_action('admin_menu', 'pp_add_admin');


/**
*	Setup all theme's plugins
**/
// Setup shortcode generator plugin
include (TEMPLATEPATH . "/plugins/troubleshooting.php");
include (TEMPLATEPATH . "/plugins/shortcode_generator.php");
include (TEMPLATEPATH . "/plugins/theme_store.php");

// Setup Gallery Plugin
include (TEMPLATEPATH . "/plugins/shiba-media-library/shiba-media-library.php");

// remove_filter ('the_content',  'wpautop');
remove_filter ('comment_text', 'wpautop');


//Make widget support shortcode
add_filter('widget_text', 'do_shortcode');

// if ($_GET['activated']){
// 	global $wpdb;
	
// 	// Run default settings
// 	include_once(TEMPLATEPATH . "/default_settings.php");
//     wp_redirect(admin_url("themes.php?page=functions.php&activate=true"));
// }
?>


<?php

	//submit contact form
	//Get your email address
	
	//Get your email address
	$contact_email = get_option('pp_contact_email');
	
	//Enter your email address, email from contact form will send to this addresss. Please enter inside quotes ('myemail@email.com')
	
	//Enter your email address, email from contact form will send to this addresss. Please enter inside quotes ('myemail@email.com')
	
	//Change email subject to something more meaningful
	define('SUBJECT_EMAIL', 'Email from contact form');
	
	//Thankyou message when message sent
	define('THANKYOU_MESSAGE', 'Thank you! We will get back to you as soon as possible');
	
	//Error message when message can't send
	define('ERROR_MESSAGE', 'Oops! something went wrong, please try to submit la');
	if(isset($_GET['submit'])){
	if(($_GET["apoint"])==1){
		if($isformvalid=true){
		$firstname = $_GET["firstname"];
		$lastname = $_GET["lastname"];
		$age = $_GET["age"];
		$address=$_GET["address"];
		$phone= $_GET["phonenumber"];
		$header=$_GET["emailid"];
		$date= $_GET["date"];
		$firstlastname= $firstname.$lastname;
		ob_start();

		?>
		<div style="border:solid 1px">
		<div style="background-color:#57a6b3"><img src="http://localhost/wp-familydentistry/wp-content/themes/Lotus/cache/1360241653_logo3.png"></div>	
		<p><h2>Appointment Request Patient Detail</h2></p>
		<table cellpadding="10">
			<tr><th style="text-align:left" >Paitent Name :</th><td style="text-align:left"><?php echo $firstname."" .$lastname ?></td></tr>
			<tr><th style="text-align:left">Paitent Age :</th><td style="text-align:left"><?php echo $age ?></td></tr>
			<tr><th style="text-align:left">Paitent Address :</th><td style="text-align:left"><?php echo $address ?></td></tr>
			<tr><th style="text-align:left">Patient Contact No :</th><td style="text-align:left"><?php echo $phone ?></td></tr>
			<tr><th style="text-align:left">Patient Email Id :</th><td style="text-align:left"><?Php echo $header ?></td></tr>
			<tr><th style="text-align:left">Required Appointment of Date : </th><td style="text-align:left"><?php echo $date ?></td></tr>
		</table>
		<p style="margin-left:250px"><a href="<?php echo bloginfo('url ') ?>" >Family Detistry 2000</a></p>
		<p>Thanks </p>
		</div>	
		<?PHP
			$message = ob_get_contents();
			ob_end_clean();


		// $message ="Name : ".$firstname." ".$lastname.PHP_EOL."</td></tr>";
		// $message .="Age : ".$age.PHP_EOL;
		// $message .="Address : ".$address.PHP_EOL;
		// $message .="Phonenumber : ".$phone.PHP_EOL;
		// $message .="Appointment Date: ".PHP_EOL.$date.PHP_EOL;
		$subject="For Appointment";
		$to="testdata987@gmail.com";
		$headers = 'From:'.$header . "\r\n" .
   		'Reply-To: '.$header. "\r\n" .
    	'X-Mailer: PHP/' . phpversion();
    
    	 $insert_args = array(
			'post_title' => $firstname ." ". $lastname,
			'post_status' => 'pending',
			'post_type' => 'appointment',
			'taxonomies' => array('category', 'appointment_tag')  
		);
		$listing_id = wp_insert_post($insert_args);
		update_post_meta($listing_id,'address',$address);
		update_post_meta($listing_id,'age',$age);
		update_post_meta($listing_id,'Phone number',$phone);
		update_post_meta($listing_id,'email id',$header);
		update_post_meta($listing_id,'appointment_date',$date);
		if(!empty($firstname) && !empty($header) && !empty($message))
		{
			add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
			wp_mail($contact_email,$subject, $message,$headers);
			wp_mail($header,$subject,$message,$headers);
		}
	}
}
}


	//submit contact form
	//Get your email address
	
	//Get your email address
	$contact_email = get_option('pp_contact_email');
	
	//Enter your email address, email from contact form will send to this addresss. Please enter inside quotes ('myemail@email.com')
	
	//Enter your email address, email from contact form will send to this addresss. Please enter inside quotes ('myemail@email.com')
	
	//Change email subject to something more meaningful
	// define('SUBJECT_EMAIL', 'Email from contact form');
	
	//Thankyou message when message sent
	// define('THANKYOU_MESSAGE', 'Thank you! We will get back to you as soon as possible');
	
	//Error message when message can't send
	// define('ERROR_MESSAGE', 'Oops! something went wrong, please try to submit la');
	if(isset($_GET['submit'])){
		if($isformvalid=true){
			$firstname = $_GET["firstname"];
			$lastname = $_GET["lastname"];
			$desc = $_GET["desc"];
			$address=$_GET["address"];
			$phone= $_GET["phonenumber"];
			$header=$_GET["emailid"];
			$exper= $_GET["experience"];
			$firstlastname= $firstname.$lastname;
			ob_start();
		?>
		
		<p><h2>Appointment Request Patient Detail</h2></p>
		<table cellpadding="10">
			<tr><th style="text-align:left" >Volunteer Name :</th><td style="text-align:left"><?php echo $firstname."" .$lastname ?></td></tr>
			<tr><th style="text-align:left">Volunteer Address :</th><td style="text-align:left"><?php echo $address ?></td></tr>
			<tr><th style="text-align:left">Volunteer Contact No :</th><td style="text-align:left"><?php echo $phone ?></td></tr>
			<tr><th style="text-align:left">Volunteer Email Id :</th><td style="text-align:left"><?Php echo $header ?></td></tr>
			<tr><th style="text-align:left">Volunteer Experience :</th><td style="text-align:left"><?php echo $exper?></td></tr>
			<tr><th style="text-align:left">Volunteer Description : </th><td style="text-align:left"><?php echo $desc ?></td></tr>
		</table>
		<p style="margin-left:250px"><a href="<?php echo bloginfo('url ') ?>" >Family Detistry 2000</a></p>
		<p>Thanks </p>	
		<?PHP
			$message = ob_get_contents();
			ob_end_clean();
		// $message ="Name : ".$firstname." ".$lastname.PHP_EOL."</td></tr>";
		// $message .="Age : ".$age.PHP_EOL;
		// $message .="Address : ".$address.PHP_EOL;
		// $message .="Phonenumber : ".$phone.PHP_EOL;
		// $message .="Appointment Date: ".PHP_EOL.$date.PHP_EOL;
		$subject="For Volunteer";
		$to="testdata987@gmail.com";
		$headers = 'From:'.$header . "\r\n" .
   		'Reply-To: '.$header. "\r\n" .
    	'X-Mailer: PHP/' . phpversion();
    
    	 $insert_args = array(
			'post_title' => $firstname ." ". $lastname,
			'post_status' => 'Publish',
			
			'post_type' => 'volunteer',
			'taxonomies' => array('category', 'volunteer_tag')  
		);
		$listing_id = wp_insert_post($insert_args);
		update_post_meta($listing_id,'address',$address);
		update_post_meta($listing_id,'description',$desc);
		update_post_meta($listing_id,'Phone number',$phone);
		update_post_meta($listing_id,'email id',$header);
		update_post_meta($listing_id,'experience',$exper);
		if(!empty($firstname) && !empty($header) && !empty($message))
		{
			add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
			wp_mail($contact_email,$subject, $message,$headers);
			wp_mail($header,$subject,$message,$headers);
		}
	}
}

function add_appointment_post_type() {
	$args = array(
		'label' => __('Appointments'),
		'supports' => array('title','custom-fields','editor','excerpt'),
		'singular_label' => __('Appointment'),
		'labels'=>array(
			'name' => __( 'Appointments' ),
			'singular_name' => __( 'Appointment' ),
			'add_new'=>__('Add New Appointment'),
			'add_new_item' =>__('Add New Appointment'),
			'edit_item'=>__('Edit Appointment'),
			'not_found'=>__('No Appointment Found'),
			'all_items'=>__('All Appointments')
		),
		'public' => true,

		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
	);
	register_post_type( 'appointment' , $args);
}
add_action('init', 'add_appointment_post_type');

function add_volunteer_post_type() {
	$args = array(
		'label' => __('Volunteers'),
		'supports' => array('title','custom-fields','excerpt','editor
			'),
		'singular_label' => __('Volunteer'),
		'labels'=>array(
			'name' => __( 'Volunteers' ),
			'singular_name' => __( 'Volunteer' ),
			'add_new'=>__('Add New Volunteer'),
			'add_new_item' =>__('Add New Volunteer'),
			'edit_item'=>__('Edit Volunteer'),
			'not_found'=>__('No Volunteer Found'),
			'all_items'=>__('All Volunteers')
		),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
	);
	register_post_type( 'volunteer' , $args);
}
	add_action('init', 'add_volunteer_post_type');
?>
<?php
	/* Disable the Admin Bar. */
	add_filter( 'show_admin_bar', '__return_false' );
	 function hide_admin_bar_settings() {
?>
	<style type="text/css">
		.show-admin-bar {
			display: none;
		}
	</style>
<?php
	}
	function disable_admin_bar() {
    	add_filter( 'show_admin_bar', '__return_false' );
    	add_action( 'admin_print_scripts-profile.php', 
        	 'hide_admin_bar_settings' );
	}
	add_action( 'init', 'disable_admin_bar' , 9 );


	function add_faq_post_type(){
	$args = array(
		'label' => __('Faqs'),
		'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields','excerpt' ),
		'singular_label' => __('Faq'),
		'labels'=>array(
			'name' => __( 'Faqs' ),
			'singular_name' => __( 'Faq' ),
			'add_new'=>__('Add New Faq'),
			'add_new_item' =>__('Add New Faq'),
			'edit_item'=>__('Edit Faq'),
			'not_found'=>__('No Faq Found'),
			'all_items'=>__('All Faqs')
		),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
	);
	$the_query = new WP_Query($args);
	register_post_type( 'faq' , $args);
}
	add_action('init', 'add_faq_post_type');
?>
<?php
	/* Disable the Admin Bar. */
	add_filter( 'show_admin_bar', '__return_false' );

?>

<?php
	//submit FAq form
	//Get your email address
	
	// define('THANKYOU_MESSAGE', 'Thank you! We will get back to you as soon as possible');
	
	//Error message when message can't send
	// define('ERROR_MESSAGE', 'Oops! something went wrong, please try to submit la');
if(isset($_POST['submit'])){
	if(($_POST["faqvalue"])==1){
		if($isformvalid=true){
			$yname = $_POST["yname"];
			$faqs = $_POST["faqs"];
			$email = $_POST["yemail"];

				ob_start();
		?>
		
		<p><h2>Faq's Question Detail</h2></p>
			<table cellpadding="10">
				<tr><th style="text-align:left" >Usr Name :</th><td style="text-align:left"><?php echo $yname ?></td></tr>
				<tr><th style="text-align:left">User Question :</th><td style="text-align:left"><?php echo $faqs ?></td></tr>

				<p>Thanks for asking question to me .I will Give You answer Sooner </p>
			</table>
			<p style="margin-left:250px"><a href="<?php echo bloginfo('url ') ?>" >Family Detistry 2000</a></p>
			<p>Thanks </p>	
			<?PHP
				$message = ob_get_contents();
				ob_end_clean();
			// $message ="Name : ".$firstname." ".$lastname.PHP_EOL."</td></tr>";
			// $message .="Age : ".$age.PHP_EOL;
			// $message .="Address : ".$address.PHP_EOL;
			// $message .="Phonenumber : ".$phone.PHP_EOL;
			// $message .="Appointment Date: ".PHP_EOL.$date.PHP_EOL;
			$subject="This is a Question";
			//$to="testdata987@gmail.com";
			$headers = 'From:'.$email . "\r\n" .
	   		'Reply-To: '.$email. "\r\n" .
	    	'X-Mailer: PHP/' . phpversion();
	    
			
			$insert_args = array(
				'post_title' => $faqs,
				'post_status' => 'Publish',
				'post_type' => 'faq',
				'taxonomies' => array('category', 'faq_tag')  
			);
			
			$listing_id = wp_insert_post($insert_args);
			update_post_meta($listing_id,'name',$yname);
			update_post_meta($listing_id,'email',$email);
			if(!empty($yname) && !empty($faqs) && !empty($email) && !empty($message))
			{
				add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
				wp_mail($contact_email,$subject, $message,$headers);
				wp_mail($email,$subject,$message,$headers);
			}
			
		}
	}
}
function debug($text){
	echo "<pre>";
	print_r($text);
	echo "</pre>";
}
if(isset($_POST['submit'])){
if(($_POST["faqans"])==1){
		if($isformvalid=true){
			$answer = $_POST["faqreplynanswer"];
			$id=$_POST['faqid'];
			 $my_post =array();
			 $my_post['ID']=$id;
			 $my_post['post_content']=$answer;
			wp_update_post( $my_post );
			
			
		}
	}
}
function add_offer_post_type() {
	$args = array(
		'label' => __('Offers'),
		'supports' => array('title','custom-fields', 'thumbnail', 'excerpt' ,'editor'),
		'description'   => 'Holds our offer and offer specific data',
		'singular_label' => __('Offer'),
		'labels'=>array(
			'name' => __( 'Offers' ),
			'singular_name' => __( 'Offer' ),
			'add_new'=>__('Add New Offer'),
			'add_new_item' =>__('Add New Offer'),
			'edit_item'=>__('Edit Offer'),
			'not_found'=>__('No Offer Found'),
			'all_items'=>__('All Offers')
		),
		'public' => true,
		'show_ui' => true, 
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => true,
	);
	register_post_type( 'offer' , $args);
}
	add_action('init', 'add_offer_post_type');


// function my_updated_messages( $messages ) {
// 	global $post, $post_ID;
// 	$messages['offer'] = array(
// 		0 => '', 
// 		1 => sprintf( __('Product updated. <a href="%s">View product</a>'), esc_url( get_permalink($post_ID) ) ),
// 		2 => __('Custom field updated.'),
// 		3 => __('Custom field deleted.'),
// 		4 => __('Product updated.'),
// 		5 => isset($_GET['revision']) ? sprintf( __('Product restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
// 		6 => sprintf( __('Product published. <a href="%s">View product</a>'), esc_url( get_permalink($post_ID) ) ),
// 		7 => __('Product saved.'),
// 		8 => sprintf( __('Product submitted. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
// 		9 => sprintf( __('Product scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview product</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
// 		10 => sprintf( __('Product draft updated. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
// 	);
// 	return $messages;
// }
// add_filter( 'post_updated_messages', 'my_updated_messages' );

// function my_taxonomies_product() {
// 	$labels = array(
// 		'name'              => _x( 'Product Categories', 'taxonomy general name' ),
// 		'singular_name'     => _x( 'Product Category', 'taxonomy singular name' ),
// 		'search_items'      => __( 'Search Product Categories' ),
// 		'all_items'         => __( 'All Product Categories' ),
// 		'parent_item'       => __( 'Parent Product Category' ),
// 		'parent_item_colon' => __( 'Parent Product Category:' ),
// 		'edit_item'         => __( 'Edit Product Category' ), 
// 		'update_item'       => __( 'Update Product Category' ),
// 		'add_new_item'      => __( 'Add New Product Category' ),
// 		'new_item_name'     => __( 'New Product Category' ),
// 		'menu_name'         => __( 'Product Categories' ),
// 	);
// 	$args = array(
// 		'labels' => $labels,
// 		'hierarchical' => true,
// 	);
// 	register_taxonomy( 'product_category', 'offer', $args );
// }
// add_action( 'init', 'my_taxonomies_product', 0 );

?>	