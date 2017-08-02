=== Plugin Name ===
Contributors: getonlinepro
Tags: GetonlinePro, getonline, featured, news, rotator, latest, widget, shortcode, get online
Requires at least: 3.5.1
Tested up to: 3.6
Stable tag: 1.1.3.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

GetonlinePro Featured News rotator for Wordpress.

== Description ==

GO Featured News is a plugin for displaying the latest news from given categories in a simple, clear view.
 
= Some features for website owners =

* Use unique ID for multiple widgets or php calls to use it multiple time on the website even on one page
* Getting posts from more categories
* Limit posts to display
* Multiple layout options for default
* Unique layout options in widget settings or using $args (for php) to change default options
* There's a custom field called "GO Featured News Media" where you can insert your featured image or video.

= Notice =
The widget works well, but it is currently not supported for uncertain time

== Frequently Asked Questions ==

= Calling the plugin =
= How can I use this plugin on my site? =
**You can call the plugin output in two ways:**
<ol>
<li>By calling the widget into the sidebar</li>
<li>
By inserting the following code into your .php file:
`<?php if(function_exists(go_featured_news)){ echo go_featured_news($goargs); } ?>`
</li>
<li>By inserting shortcode to a post or page: [go-featured-news]</li>
</ol>
supported arguments (with default values):
`<?php
$goargs = array( 
	'ID' => '', //string, gives unique id for the widget
	'title' => '', //string, this is the plugin's title
	'showtitle' => '1', //boolean, show plugin title
	'numposts' => '7', //integer, number of posts to display
	'category' => '', //get posts from these categories separated with comma (1,4,5)
	'width' => '640', //integer, width of the plugin's main div
	'height' => '300', //integer, height of the plugin's main div
	'imgwidth' => '400', //integer, active image's width
	'imgheight' => '300', //integer, active image's height
	'activetitle' => '1' //boolean, show element's title
	'postexcerpt' => '1', //boolean, display post excerpt
	'excerptlength' => '', //integer, set the number of words for the rotating elements
	'animate_details'=> '1', //boolean, enables jQuery animation for showing the details
	'readmore' => '', //boolean, show readmore button 
	'rotation' => '1', //boolean, enable rotation
	'rspeed' => '5000', //integer,	rotation speed (ms)
	'aspeed' => '1000', //integer,	animation speed (ms)
	'showlinks' => '1', //boolean, display links next to the rotator
	'linkexcerpt' => '1', //boolean, display post excerpt under links
	'linkexcerptlength' => '10', //sets the number of words for links excerpt
	'linkalign' => 'right', //set the position of the link box
	'showbubbles' => '1', // boolean, display pagination
	'showarrows' => '', // boolean, display arrows
	'showbubblestn' => '1', //boolean, display pagination thumbnails 
	'bubbletnwidth' => '85', //integer, set pagination thumbnail width
	'bubbletnheight' => '', //integer, set pagination thumbnail height
	'bubbletype' => 'bubbles', //set pagination type ('numeric' or 'bubbles')
	'bubblepos' => 'top:0; right:0', //set pagination position
	('top:0; left:0;','top:0; right:0;', 'bottom:0; left:0;', 'bottom:0; right:0;')
);
?>`
= How can I make an image visible in the featured news box? =
You can do it by selecting a featured image at the post editor or you can use the plugin's custom media field.
If you don't see that custom field, click on the 'Screen Options' at the top right corner of the post editor, and there tick the 'GO Featured News Media' checkbox.

== Changelog ==
= version 1.1.3.5 =
CHANGED: If you disable pagination on the settings page, the arrows can be enabled still.

= version 1.1.3.4 =
NEW: 'Add link over image' added to the plugin's option page.
FIXED: 'Minor bugs'

= version 1.1.3.3 =
* FIXED: php function conflict with other plugins

= version 1.1.3.2 =
* NEW: Removed shortcode tags from text
* NEW: Link box excerpt lenght can be de set in the settings
* CHANGED: .go-feat-element width
* CHANGED: .link-title tag changed from `<h3>` to `<span>`
* FIXED: that you had to update all the posts if you created the posts before installing this plugin
* FIXED: pagination position

= version 1.1.3.1 =
* fixed a bug that not shows the pagination box in bottom position

= version 1.1.3 =
* bug fixes

= version 1.1.2 =
* minor bug fix

= version 1.1 =
The plugin's structure has went through major changes for an easier, simple use. It is strongly recommended to check and change the css settings.<br>

* Removed the div inside the .gof-news div
* The .bubbles_outer div has absolute position
* Plugin title have been put to `<span>` from `<h1>`
* The width of `<h3>` title in the .go-feat-element is removed
* go-feat-element width added
* preview image added in the .go-feat-element divs.
* Display Links' thumbnails option added to Settings page

= version 1.0.4 =
* fixed a bug that didn't set the height of the plugin
* excerpt content position fix
* fixed a bug that picked the images from wrong path in multisites.
* plugin description updated
* the plugin now works with this shortcode too: [go-featured-news]
* the go_featured_news function now has a return value. This means when you call the plugin in php, you have to echo it, not just calling the function.

= version 1.0.3.9 =
* thumbnail background arrow position fix

= version 1.0.3.8 =
* thumbnail background arrow position fix

= version 1.0.3.7 =
* debugging thumbnail height option

= version 1.0.3.6 =
* Option to set pagination alignment to center

= version 1.0.3.5 =
* small bugs fixed

= version 1.0.3.4 =
* Pagination fix
* Jquery enqueue fix

= version 1.0.3.3 =
* Fixed a bug that doesn't get the thumbnail height from the plugin settings page.

= Version 1.0.3.21 =
* Fixed a bug, that not loads the scroller js file

= Version 1.0.3.2 =
* Lots of bugs fixed

= Version 1.0.1 =
* Pagination thumbnail fixes
* Preview thumbnails for youtube videos

= Version 1.0 =
* First release

== Installation ==

1. Upload `go_featured_news` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu item in the WordPress Dashboard.
3. Set plugin_dir/js/cache folder's permission to 777 if necessary

== Screenshots ==

== Upgrade Notice ==

== Arbitrary section ==

`<?php code(); // goes in backticks ?>`
