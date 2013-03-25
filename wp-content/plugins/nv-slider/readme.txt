=== Plugin Name ===
Contributors: ryansutana
Tags: slider, slideshow, content slider, custom post type, nivo slider, nivo, timthumb
Requires at least: 3.0.0
Tested up to: 3.4.1
Stable tag: 1.5.0

A very simple, light and easy customizable wordpress content slider and comes with unlimeted number of slides and efeects.

== Description ==

This plugin allows you to add content slider in your post, page or even in your theme sidebar it works like charm without much knowledge in programming, using Wordpress shortcode it works smoothly. 

NV Slider use WordPress's thumbnail support, so you have the power to crop or edit image size to suit your site need and if that seems hard for you not a problem this plugin also has a timthumb.php built-in so resizing and croping image is not your job ;)

For more updated details and support please visit plugin site at <a href="http://www.sutanaryan.com/freebies/plugins/wp-nv-slider/">NV Slider</a>.

== Features ==
* Effect
	1. Random
	1. Slide Down
	1. Slide Down Left
	1. Slide Up
	1. Slide Updown
	1. Slide Updown Left
	1. Fold
	1. Fade and many more
* Slider Navigation
	1. Direction Nav
	1. Control Nav
	1. Keyboard Nav
* Editable Animation Speed
* Editable Pause Time
* Editable Start Slide
* Editable Number of Thumbnail to Display
* Editable Width and Height
* Support timthumb

= Important links =
* My portfolio: http://www.sutanaryan.com/portfolio/
* My Blog: http://www.sutanaryan.com/
* Twitter: @ryansutana
* Need a Web Developer [visit http://www.sutanryan.com/services/]

== Installation ==
= Method 1. =
1. Download the "NV Slider" plug-in for your WordPress version.
2. Unzip the downloaded file and extract the code to to your /wp-content/plugins/ folder OR simply choose upload in the upper left corder and in the upload box select the nv-slider.zip file you downloaded.
3. To complete installation you should activate the plugin in the plugins section of your administration panel.

= Method 2. =
1. Go to your WordPress admin account.
2. Open Plugins in the left-side bar menu, choose Add New, and search for NV Slider plugin. Choose the available "NV Slider".
3. Install the plug-in and activate it in your account.

== Frequently Asked Questions ==

= How do I add NV Slider into my site? =
You can add this plugin in two easist way, by

= shortcode =
[nv_slider]

or

echo do_shortcode('[nv_slider]');

For more updated details and support please visit plugin site at <a href="http://www.sutanaryan.com/freebies/plugins/wp-nv-slider/">NV Slider</a>.

= Can I use this plugin into my site sidebar? =
Yes, just use the shortcode [nv_slider], 
if this does not work, then you need to add a little trick into the function.php file of your site.

add_filter('widget_text', 'do_shortcode'); // add this code anywhere in your function.php file

== Screenshots ==
To see the working plugin and screenshots please visit this page <a href="http://www.sutanaryan.com/freebies/plugins/wp-nv-slider/" rel="follow">NV Slider</a>

== Changelog ==
= 1.5.0 =
* Re-code to support latest version of Wordpress
* Add custom url meta
* Fix only loader imag display

= 1.0.0 =
* Initial release version


== Upgrade Notice ==
= 1.0.0 =
This is the initial release, no upgrade notice yet at the moment, all you need to do is download and install the plugin.