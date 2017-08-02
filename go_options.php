<?php
$location = $options_page; // Form Action URI
$news_slider_path =  get_bloginfo('wpurl')."/wp-content/plugins/go_featured_news/";
?>
<div class="wrap">
	<h2>Featured News Options </h2>
	<form method="post" action="options.php">
		<fieldset name="general_options" class="options">
			<?php wp_nonce_field('update-options'); ?>
			<table class="admin-table">
				<!--BASIC OPTIONS-->
				<tr><td colspan="2"><h3>Basic Options</h3><i>(these options can be definded under the widgets page too)</i><hr></td></tr>
				<tr><td>ID (int or string):</td><td><input type="text" name="go_feat_ID" value="<?php echo get_option('go_feat_ID');?>" ></td></tr>
				<tr><td>Title:</td><td><input type="text" name="go_feat_title" value="<?php echo get_option('go_feat_title');?>"> display title: <input type="checkbox" name="go_feat_showtitle" <?php if(get_option('go_feat_showtitle')=='1'){ echo ' checked '; } ?> value="1"> <i>(If you want to call the plugin via php or shortcode)</i></td></tr>
				<tr><td>Number of posts:</td><td><input type="text" name="go_feat_numposts" value="<?php echo get_option('go_feat_numposts');?>" style="width:30px; text-align:center;"></td></tr>
				<tr><td>Categories:</td><td><input type="text" name="go_feat_category" value="<?php echo get_option('go_feat_category');?>"> <i>separated with comma (e.g. 1,15,43)</i></td></tr>
				<tr><td>Random Posts:</td><td>
					<select name="go_feat_shuffle">
						<option value="1" <?php if(get_option('go_feat_shuffle')=='1'){ echo 'selected'; }?> >yes</option>
						<option value="0" <?php if(get_option('go_feat_shuffle')=='0'){ echo 'selected'; }?> >no</option> <i>(very soon)</i>
					</select></td>
				</tr>
				
				<!--LAYOUT OPTIONS-->
				<tr><td colspan="2"><h3>Layout Options<hr></h3></td></tr>		
				<tr><td colspan="2" class="admin-separator"><h4>Plugin size</h4></td></tr>
				<tr><td>Plugin width:</td><td><input name="go_feat_width" value="<?php echo get_option('go_feat_width'); ?>" type="text" style="width:40px"></td></tr>
				<tr><td>Plugin height:</td><td><input name="go_feat_height" value="<?php echo get_option('go_feat_height'); ?>" type="text" style="width:40px"></td></tr>
				
				<tr><td colspan="2" class="admin-separator"><h4>Image size</h4></td></tr>
				<tr><td>Image width:</td><td><input name="go_feat_imgwidth" value="<?php echo get_option('go_feat_imgwidth'); ?>" type="text" style="width:40px"></td></tr>
				<tr><td>Image height:</td><td><input name="go_feat_imgheight" value="<?php echo get_option('go_feat_imgheight'); ?>" type="text" style="width:40px"></td></tr>
				
				<tr><td colspan="2" class="admin-separator"><h4>Thumbnail size (for bubble box and links' images)</h4></td></tr>
				<tr><td>Thumbnail width:</td><td><input type="text" name="go_feat_bubbletnwidth" value="<?php echo get_option('go_feat_bubbletnwidth'); ?>" style="width:30px"></td></tr>
				<tr><td>Thumbnail height:</td><td><input type="text" name="go_feat_bubbletnheight" value="<?php echo get_option('go_feat_bubbletnheight'); ?>" style="width:30px"></td></tr>
				<tr><td colspan="2" class="admin-separator"><h4>Rotating elements</h4></td></tr>
				<tr><td>Display Post Title:</td><td>
					<select name="go_feat_activetitle">
						<option value="1" <?php if(get_option('go_feat_activetitle')=='1'){ echo 'selected'; }?> >yes</option>
						<option value="0" <?php if(get_option('go_feat_activetitle')=='0'){ echo 'selected'; }?> >no</option>
					</select></td>
				</tr>
				<tr><td>Display Post excerpt:</td><td>
					<select name="go_feat_postexcerpt">
						<option value="1" <?php if(get_option('go_feat_postexcerpt')=='1'){ echo 'selected'; }?> >yes</option>
						<option value="0" <?php if(get_option('go_feat_postexcerpt')=='0'){ echo 'selected'; }?> >no</option>
					</select></td>
				</tr>
				<tr>
				<td>Number of words:</td>
				<td>
				<input type="text" name="go_feat_excerptlength" value="<?php echo get_option('go_feat_excerptlength') ?>" style="width:50px; text-align:center"> <i>(Default is 30 words)</i>
				</td>
				</tr>
				<tr><td>Animate Content:</td><td>
					<select name="go_feat_animate_details">
						<option value="1" <?php if(get_option('go_feat_animate_details')=='1'){ echo 'selected'; }?> >yes</option>
						<option value="0" <?php if(get_option('go_feat_animate_details')=='0'){ echo 'selected'; }?> >no</option>
					</select></td>
				</tr>
				<tr><td>Show readmore button:</td><td>
					<select name="go_feat_readmorebutton">
						<option value="1" <?php if(get_option('go_feat_readmorebutton')=='1'){ echo 'selected'; }?> >yes</option>
						<option value="0" <?php if(get_option('go_feat_readmorebutton')=='0'){ echo 'selected'; }?> >no</option>
					</select> <i>(not working yet)</i></td>
				</tr>
				<tr><td>Add link over image:</td><td>
					<select name="go_feat_linktoimg">
						<option value="1" <?php if(get_option('go_feat_linktoimg')=='1'){ echo 'selected'; }?> >yes</option>
						<option value="0" <?php if(get_option('go_feat_linktoimg')=='0'){ echo 'selected'; }?> >no</option>
					</select></td>
				</tr>
				
				<tr><td colspan="2" class="admin-separator"><h4>Rotator options</h4></td></tr>
				<tr><td>Rotating speed(ms):</td><td><input name="go_feat_rspeed" value="<?php echo get_option('go_feat_rspeed'); ?>" type="text" style="width:40px"></td></tr>
				<tr><td>animation speed(ms):</td><td><input name="go_feat_aspeed" value="<?php echo get_option('go_feat_aspeed'); ?>" type="text" style="width:40px"></td></tr>
				<tr class="admin-separator"><td>Enable rotation:</td><td>yes <input type="radio" name="go_feat_rot" value="1" <?php if(get_option('go_feat_rot')==1){echo " checked "; } ?>> no <input type="radio" name="go_feat_rot" value="0" <?php if(get_option('go_feat_rot')==0){echo " checked "; } ?>></td></tr>
				
				<tr><td colspan="2" class="admin-separator"><h4>Links options</h4></td></tr>
				<tr><td>Display Links:</td><td>yes <input type="radio" name="go_feat_showlinks" value="1" <?php if(get_option('go_feat_showlinks')==1){echo " checked "; } ?>> no <input type="radio" name="go_feat_showlinks" value="0" <?php if(get_option('go_feat_showlinks')==0){echo " checked "; } ?>></td></tr>
				<tr><td>Display post excerpt:</td><td>yes <input type="radio" name="go_feat_linkexcerpt" value="1" <?php if(get_option('go_feat_linkexcerpt')==1){echo " checked "; } ?>> no <input type="radio" name="go_feat_linkexcerpt" value="0" <?php if(get_option('go_feat_linkexcerpt')==0){echo " checked "; } ?>></td></tr>
				<tr><td>Number of words:</td><td><input type="text" name="go_feat_linkexcerptlength" value="<?php echo get_option('go_feat_linkexcerptlength') ?>" style="width:50px; text-align:center"> <i>(Default is 10 words)</i></td></tr>
				<tr><td>Display Links' thumbnails:</td><td>yes <input type="radio" name="go_feat_showlinkthumbnails" value="1" <?php if(get_option('go_feat_showlinkthumbnails')==1){echo " checked "; } ?>> no <input type="radio" name="go_feat_showlinkthumbnails" value="0" <?php if(get_option('go_feat_showlinkthumbnails')==0){echo " checked "; } ?>></td></tr>
				
				<tr><td>Links alignment:</td><td>
					<select name="go_feat_linkalign">
						<option <?php if(get_option('go_feat_linkalign')=='left'){ echo 'selected'; }?> >left</option>
						<option <?php if(get_option('go_feat_linkalign')=='right'){ echo 'selected'; }?> >right</option>
					</select>
				</td></tr>
				
				<tr><td colspan="2" class="admin-separator"><h4>Pagination</h4></td></tr>
				<tr><td>Show Pagination:</td><td>yes <input type="radio" name="go_feat_showbubbles" value="1" <?php if(get_option('go_feat_showbubbles')==1){echo " checked "; } ?>> no <input type="radio" name="go_feat_showbubbles" value="0" <?php if(get_option('go_feat_showbubbles')==0){echo " checked "; } ?>></td></tr>
				<tr><td>Show Arrows:</td><td>yes <input type="radio" name="go_feat_showarrows" value="1" <?php if(get_option('go_feat_showarrows')==1){echo " checked "; } ?>> no <input type="radio" name="go_feat_showarrows" value="0" <?php if(get_option('go_feat_showarrows')==0){echo " checked "; } ?>></td></tr>
				<tr><td>Show bubble box:</td><td>yes <input type="radio" name="go_feat_showbubblestn" value="1" <?php if(get_option('go_feat_showbubblestn')==1){echo " checked "; } ?>> no <input type="radio" name="go_feat_showbubblestn" value="0" <?php if(get_option('go_feat_showbubblestn')==0){echo " checked "; } ?>></td></tr>
				<tr><td>Pagination list type:</td><td>
					<select name="go_feat_bubbletype">
						<option <?php if(get_option('go_feat_bubbletype')=='bubbles'){ echo 'selected'; }?>>bubbles</option>
						<option <?php if(get_option('go_feat_bubbletype')=='numeric'){ echo 'selected'; }?>>numeric</option>
					</select>
				</td></tr>
				<tr><td>Pagination position:</td><td>
					<select name="go_feat_bubblepos">
						<option <?php if(get_option('go_feat_bubblepos')=='top:0; left:0;'){ echo 'selected'; }?> value="top:0; left:0;">top-left</option>
						<option <?php if(get_option('go_feat_bubblepos')=='top:0; center:0;'){ echo 'selected'; }?> value="top:0; center:0;">top-center</option>
						<option <?php if(get_option('go_feat_bubblepos')=='top:0; right:0;'){ echo 'selected'; }?> value="top:0; right:0;">top-right</option>
						<option <?php if(get_option('go_feat_bubblepos')=='bottom:0; left:0;'){ echo 'selected'; }?> value="bottom:0; left:0;">bottom-left</option>
						<option <?php if(get_option('go_feat_bubblepos')=='bottom:0; center:0;'){ echo 'selected'; }?> value="bottom:0; center:0;">bottom-center</option>
						<option <?php if(get_option('go_feat_bubblepos')=='bottom:0; right:0;'){ echo 'selected'; }?> value="bottom:0; right:0;">bottom-right</option>
					</select>
				</td></tr>
				
			</table>
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="go_feat_ID,go_feat_title,go_feat_showtitle,go_feat_numposts,go_feat_category,go_feat_postexcerpt,go_feat_excerptlength,go_feat_animate_details,go_feat_readmorebutton,go_feat_linktoimg,go_feat_width,go_feat_height,go_feat_imgwidth,go_feat_imgheight,go_feat_activetitle,go_feat_rspeed,go_feat_aspeed,go_feat_rot,go_feat_linkexcerpt,go_feat_linkexcerptlength,go_feat_showlinkthumbnails,go_feat_showlinks,go_feat_linkalign,go_feat_showbubbles,go_feat_showarrows,go_feat_showbubblestn,go_feat_bubbletnwidth,go_feat_bubbletnheight,go_feat_bubbletype,go_feat_bubblepos" />
		</fieldset>
		<?php submit_button( __( 'Save Changes' ), 'primary', 'update' ); ?>
	</form>
</div>