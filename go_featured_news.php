<?php
/*
Plugin Name: GetOnline Pro Featured News
Plugin URI: http://www.getonline.ie/
Description: Featured News Rotator for WordPress
Version: 1.1.3.5
Author: getonlinepro

	Copyright 2013  Ivan Bauer  (email : ivan.bauer@getonline.ie)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
Author URI: http://www.getonline.ie
*/
?>
<?php
add_action('admin_menu', 'go_featnews_options_page');
add_action('wp_enqueue_scripts','go_featnews_admin_header');
add_action( 'admin_head', 'go_featnews_admin_header' );

/* Adds our admin options under "Options" */
function go_featnews_options_page() {
	add_options_page('GO Featured News Options', 'GO Featured News', 'manage_options', 'go_featured_news.php', 'call_option_page');
}
function call_option_page(){
	include "go_options.php";
}
function go_featnews_admin_header() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('bubble',get_bloginfo('wpurl').'/wp-content/plugins/go-featured-news/js/jQuery.bubbletip-1.0.6.js');
	$news_slider_path =  get_bloginfo('wpurl')."/wp-content/plugins/go-featured-news/";
	global $pagenow;
	if('post.php' == $pagenow || 'post-new.php' == $pagenow){
	wp_enqueue_script('go-media-upload', WP_CONTENT_URL . '/plugins/' . plugin_basename(dirname(__FILE__)). '/js/go_addmedia.js', array('thickbox','media-upload'), '1.0', true);}
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo $news_slider_path; ?>css/go_featured_news.css" />
	<?php
}
function go_featured_news($goargs=""){
	if(isset($goargs['excerptlength'])){ $excerptlength=$goargs['excerptlength']; } else { $excerptlength=get_option('go_feat_excerptlength');}
	if(empty($excerptlength)){$excerptlength=30;}
	// Basic parameters
	if(isset($goargs['ID'])){ $ID=$goargs['ID']; } else { $ID=get_option('go_feat_ID'); }
	if(isset($ID)){ $ID="-".$ID; }
	if(isset($goargs['title'])){ $title=$goargs['title']; } else { $title=get_option('go_feat_title');}
	if(isset($goargs['showtitle'])){ $showtitle=$goargs['showtitle']; } else { $showtitle=get_option('go_feat_showtitle');}
	if(isset($goargs['numposts'])){ $numposts=$goargs['numposts']; } else { $numposts=get_option('go_feat_numposts');}
	if(isset($goargs['category'])){ $categories=$goargs['category']; } else { $categories=get_option('go_feat_category');}
	if(isset($goargs['postexcerpt'])){ $postexcerpt=$goargs['postexcerpt']; } else { $postexcerpt=get_option('go_feat_postexcerpt');}
	
	if(isset($goargs['activetitle'])){ $activetitle=$goargs['activetile']; } else { $activetitle=get_option('go_feat_activetitle');}
	if(isset($goargs['linkexcerpt'])){ $linkexcerpt=$goargs['linkexcerpt']; } else { $linkexcerpt=get_option('go_feat_linkexcerpt');}
	if(isset($goargs['linkexcerptlength'])){ $linkexcerptlength=$goargs['linkexcerptlength']; } else { $linkexcerptlength=get_option('go_feat_linkexcerptlength');}
	if(empty($linkexcerptlength)){$linkexcerptlength=10;}
	
	//Layout parameters
	if(isset($goargs['width'])){ $width=$goargs['width']; } else { $width=get_option('go_feat_width');}
	if(isset($goargs['height'])){ $height=$goargs['height']; } else { $height=get_option('go_feat_height');}
	if(isset($goargs['imgwidth'])){ $imgwidth=$goargs['imgwidth']; } else { $imgwidth=get_option('go_feat_imgwidth');}
	if(isset($goargs['imgheight'])){ $imgheight=$goargs['height']; } else { $imgheight=get_option('go_feat_imgheight');}
	if(empty($width)){$width=$imgwidth;}
	if(empty($imgwidth)){$imgwidth=$width;}
	if(empty($height)){$height=$imgheight;}
	if(empty($imgheight)){$imgheight=$height;}
	if(empty($width) && empty($imgwidth)){ $width='750'; $imgwidth='750';}
	if(empty($height) && empty($imgheight)){ $height='300'; $imgheight='300';}
	
	if(isset($goargs['linkalign'])){ $linkalign=$goargs['linkalign']; } else { $linkalign=get_option('go_feat_linkalign');}
	//animation
	if(isset($goargs['rspeed'])){ $rspeed=$goargs['rspeed']; } else { $rspeed=get_option('go_feat_rspeed');}
	if(isset($goargs['aspeed'])){ $aspeed=$goargs['aspeed']; } else { $aspeed=get_option('go_feat_aspeed');}
	if(isset($goargs['rotation'])){ $rotation=$goargs['rotation']; } else { $rotation=get_option('go_feat_rot');}
	//link box
	if(isset($goargs['showlinks'])){ $displaylinks=$goargs['links']; } else { $displaylinks=get_option('go_feat_showlinks');}
	//bubbles
	if(isset($goargs['showbubbles'])){ $showbubbles=$goargs['showbubbles']; } else { $showbubbles=get_option('go_feat_showbubbles');}
	if(isset($goargs['showarrows'])){ $showarrow=$goargs['showarrows']; } else { $showarrow=get_option('go_feat_showarrows');}
	if(isset($goargs['showbubblestn'])){ $showbubblestn=$goargs['showbubblestn']; } else { $showbubblestn=get_option('go_feat_showbubblestn');}
	if(isset($goargs['bubbletnwidth'])){ $bubbletnwidth=$goargs['bubbletnwidth']; } else { $bubbletnwidth=get_option('go_feat_bubbletnwidth');}
	if(isset($goargs['bubbletnheight'])){ $bubbletnheight=$goargs['bubbletnheight']; } else{ $bubbletnheight=get_option('go_feat_bubbletnheight');}
	if(isset($goargs['bubbletype'])){ $bubbletype=$goargs['bubbletype']; } else { $bubbletype=get_option('go_feat_bubbletype');}
	if(isset($goargs['bubblepos'])){ $bubblepos=$goargs['bubblepos']; } else { $bubblepos=get_option('go_feat_bubblepos');}
	if(isset($goargs['showlinkthumbnails'])){ $showlinkthumbnails=$goargs['showlinkthumbnails']; } else { $showlinkthumbnails=get_option('go_feat_showlinkthumbnails');}
	if(isset($goargs['linktoimg'])){ $linktoimg=$goargs['linktoimg']; } else { $linktoimg=get_option('go_feat_linktoimg');}
	
	//check if the plugin is called by widget
	function is_widget(){
		if(isset($goargs['is_widget'])){
			return false;
		}
		else { return true; }
	}

	if(isset($goargs['animate_details'])){ $animate_details=$goargs['animate_details']; } else { $animate_details=get_option('go_feat_animate_details');}
	if(isset($goargs['readmorebutton'])){ $readmorebutton=$goargs['readmorebutton']; } else { $readmorebutton=get_option('go_feat_readmorebutton');}
	ob_start();
	include 'news_slider.php';
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// Add shortcode [go-featured-news]
add_shortcode('go-featured-news', 'go_featured_news');
/*--------------------------------------------------*/
//backend options
function add_gofn_meta_box() {
	add_meta_box('go_feat_media', 'GO Featured News Media', 'show_gofn_meta_box', 'post', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_gofn_meta_box');
function show_gofn_meta_box($post) {
echo '<input type="hidden" name="go_feat_media_nonce" value="'. wp_create_nonce('go_feat_median'). '" />';
 ?>
	<table>
		<tr><td>
			Choose image from Media Library or paste embedded video code:<br />
			<textarea name="_go_feat_mediapath" id="_go_feat_mediapath" style="width:360px; height:115px;"><?php echo get_post_meta($post->ID, '_go_feat_mediapath', true); ?></textarea>
		</td>
		<td>Select media type:<br />
		<select name="_go_feat_mediatype" class="_go_feat_mediatype">
			<option <?php if(get_post_meta($post->ID, '_go_feat_mediatype', true)=="image"){ echo " selected"; }?>>image</option>
			<option<?php if(get_post_meta($post->ID, '_go_feat_mediatype', true)=="video"){ echo " selected"; }?>>video</option>
		</select>
		<input id="addimage" type="button" class="button" value="Add Image..."/>
		</td></tr>

	</table>
<?php }
/*---ADD Custom field to post editor---*/
function save_gofn_meta_box($post_id) {
	// check nonce
	if (!isset($_POST['go_feat_media_nonce']) || !wp_verify_nonce($_POST['go_feat_media_nonce'], 'go_feat_median')) {
		return $post_id;
	}
	// check capabilities
	if ('post' == $_POST['post_type']) {
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_page', $post_id)) {
		return $post_id;
	}
	// exit on autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	if(isset($_POST['_go_feat_mediapath'])) {
		update_post_meta($post_id, '_go_feat_mediapath', $_POST['_go_feat_mediapath']);
	} else {
		delete_post_meta($post_id, '_go_feat_mediapath');
	}
	if(isset($_POST['_go_feat_mediatype'])) {
		update_post_meta($post_id, '_go_feat_mediatype', $_POST['_go_feat_mediatype']);
	} else {
		delete_post_meta($post_id, '_go_feat_mediapath');
	}
}
add_action('save_post', 'save_gofn_meta_box');
function wp_gofn_manager_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery');
}
function wp_gofn_manager_admin_styles() {
wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'wp_gofn_manager_admin_scripts');
add_action('admin_print_styles', 'wp_gofn_manager_admin_styles');
/*---Add options---*/
function gofn_save_options(){
	add_option( 'go_feat_activetitle', '1'); 
	add_option( 'go_feat_animate_details', '1'); 
	add_option( 'go_feat_aspeed', '1000'); 
	add_option( 'go_feat_bubblepos', 'top:0; right:0;');
	add_option( 'go_feat_bubbletnheight', '');
	add_option( 'go_feat_bubbletnwidth', '85');
	add_option( 'go_feat_bubbletype', 'bubbles');
	add_option( 'go_feat_category', '');
	add_option( 'go_feat_excerptlength', '');
	add_option( 'go_feat_linkexcerpt', '0');
	add_option( 'go_feat_linkexcerptlength', '10');
	add_option( 'go_feat_linktoimg', '1');
	add_option( 'go_feat_height', '300');
	add_option( 'go_feat_ID', 'gofn');
	add_option( 'go_feat_imgheight', '300');
	add_option( 'go_feat_imgwidth', '400');
	add_option( 'go_feat_linkalign', 'right');
	add_option( 'go_feat_numposts', '7');
	add_option( 'go_feat_postexcerpt', '1');
	add_option( 'go_feat_readmorebutton', '1');
	add_option( 'go_feat_rot', '1');
	add_option( 'go_feat_rspeed', '5000'); 
	add_option( 'go_feat_showarrows', '1');
	add_option( 'go_feat_showbubbles', '1');
	add_option( 'go_feat_showbubblestn', '1');
	add_option( 'go_feat_showlinks', '1');
	add_option( 'go_feat_showlinkthumbnails', '1');
	add_option( 'go_feat_showtitle', '0'); 
	add_option( 'go_feat_title', 'Featured News'); 
	add_option( 'go_feat_width', '640');
}
register_activation_hook( __FILE__, 'gofn_save_options' );
include_once 'functions.php';
include_once 'go_feat_widget.php';