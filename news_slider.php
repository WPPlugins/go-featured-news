<?php
$news_slider_path =  network_site_url()."/wp-content/plugins/go-featured-news/";
if($bubbletype=="numeric"){
	$bubble_img = 'none';
	$bubble_img_active = 'none';
	$bubble_img_opts="";
}
elseif($bubbletype=="bubbles"){
	$bubble_img = 'url('.$news_slider_path.'images/selector.png)';
	$bubble_img_active = 'url('.$news_slider_path.'images/selector_active.png)';
	$bubble_img_opts=" no-repeat center";
}
if($linkalign=="left"){$activealign="right:0"; } 
elseif($linkalign=="right"){$activealign="left:0"; } 
?>
<script type="text/javascript">
/*-----------GO FEATURED NEWS SLIDER-----------*/
var j = jQuery.noConflict();
j(document).ready(function() {
	var mainDiv="#go-featured-news<?php echo $ID; ?>";
	var activeNews = 1; //The ID of the active post div
	var numElements = j(mainDiv+' .go-feat-box').children().length; // Number of displayed posts
	var nextItem;
	var aspeed = <?php echo $aspeed; ?>; //fade speed
	var rspeed = <?php echo $rspeed; ?>; //rotation speed
	// Set the first link element to active
	j(mainDiv+' #go-feat-element-'+activeNews).addClass('active');
	j(mainDiv+' .go-feat-box #go-feat-item-'+activeNews).fadeIn();
	
	// Set the first bubble to active
	j(mainDiv+' #go-feat-bubbles-'+activeNews).addClass('active-bubble');
	
	var contentHeight = j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content').height();
	var titleHeight = j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content .go-feat-item-title').outerHeight(true);
	var titlePos = <?php echo $imgheight; ?>-titleHeight;
	j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content').css('top', titlePos);
	var contentPos=<?php echo $imgheight; ?>-contentHeight;
	
	/*---Click function---*/
	function clicked() {
		var id = j(this).attr('id');
		var arr = id.split('-');
		var currid;
		if(arr[3]){ currid = arr[3]; }
		else { currid=arr[2]; }
		j(mainDiv+' #go-feat-item-'+activeNews).fadeIn(aspeed);
		if(activeNews != currid){
		j(mainDiv+' #go-feat-element-'+activeNews).removeClass('active');
		j(mainDiv+' #go-feat-bubbles-'+activeNews).removeClass('active-bubble');
		j(mainDiv+' #go-feat-item-'+activeNews).fadeOut(aspeed);
		
		if(arr[3]){ activeNews = arr[3]; }
		else { activeNews=arr[2]; }
		j(mainDiv+' #go-feat-item-'+activeNews).fadeIn(aspeed);
		
		contentHeight = j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content').outerHeight(true);
		titleHeight = j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content .go-feat-item-title').outerHeight(true);
		titlePos = <?php echo $imgheight; ?>-titleHeight;
		j(mainDiv+'  #go-feat-item-'+activeNews+' .go-feat-content').css('top', titlePos);
		contentPos=<?php echo $imgheight; ?>-contentHeight;
		j(mainDiv+' #go-feat-element-'+activeNews).addClass('active');
		j(mainDiv+' #go-feat-bubbles-'+activeNews).addClass('active-bubble');
		}
	}	
	<?php if($rotation==1){ ?> 
	//AutoRotator
	function autoClick() {
		if(activeNews == numElements ){
			activeNews = 1;
			prev = numElements;
		}
		else {
			activeNews++;
			prev=activeNews-1;
		}
		j(mainDiv+' #go-feat-bubbles-'+prev).removeClass('active-bubble');
		j(mainDiv+' #go-feat-bubbles-'+activeNews).addClass('active-bubble');
		j(mainDiv+' #go-feat-element-'+prev).removeClass('active');
		j(mainDiv+' #go-feat-element-'+activeNews).addClass('active');
		j(mainDiv+' #go-feat-item-'+prev).fadeOut(aspeed);
		j(mainDiv+' #go-feat-item-'+activeNews).fadeIn(aspeed);
		
		contentHeight = j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content').outerHeight(true);
		titleHeight = j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content .go-feat-item-title').outerHeight(true);
		titlePos = <?php echo $imgheight; ?>-titleHeight;
		j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content').css('top', titlePos);
		contentPos=<?php echo $imgheight; ?>-contentHeight;
	}
	//call the autoFade function in every certain ms.
	var intervalId2 = window.setInterval(autoClick, rspeed);
	
	//On mouse over deactivate auto-fade
	j(mainDiv+'').mouseenter(function(){
		window.clearInterval(intervalId2);
	}
	).mouseleave(function(){
		intervalId2 = window.setInterval(autoClick, rspeed);
	});
	<?php } else{} ?>
	<?php if ($animate_details==1){?>
	// Animate details of the current post
	j(mainDiv+' .go-feat-box').mouseenter(function(){ 
		j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content').stop().animate({top:contentPos}, 'fast');
	});
	j(mainDiv+' .go-feat-box > div').mouseleave(function(){ 
		j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content').stop().animate({top:titlePos}, 'fast');
	});
	<?php } ?>
	//Clicking on a bubble
	j(mainDiv+' .bubbles li').click(clicked);
	/*---Function if clicking on an element---*/
	j(mainDiv+' .go-feat-element').click(clicked);
	
	//Clicking on navigation button
	j(mainDiv+' .bnav').click(function(){

		//alert(activeNews);
		j(mainDiv+' #go-feat-element-'+activeNews).removeClass('active');
		j(mainDiv+' #go-feat-bubbles-'+activeNews).removeClass('active-bubble');
		j(mainDiv+' #go-feat-item-'+activeNews).fadeOut(aspeed);
		
		if(j(this).attr("id")=="b_next") {
			if(activeNews == numElements ){
				activeNews = 1;
			}
			else {
				activeNews++;
				prev=activeNews-1;
			}
		}
		else if(j(this).attr("id")=="b_prev") {
			if(activeNews == 1 ){
				activeNews = numElements;
			}
			else {
				activeNews--;
			}
		}
		j(mainDiv+' #go-feat-item-'+activeNews).fadeIn(aspeed);
		
		contentHeight = j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content').outerHeight(true);
		titleHeight = j(mainDiv+' #go-feat-item-'+activeNews+' .go-feat-content .go-feat-item-title').outerHeight(true);
		titlePos = <?php echo $imgheight; ?>-titleHeight;
		j(mainDiv+'  #go-feat-item-'+activeNews+' .go-feat-content').css('top', titlePos);
		contentPos=<?php echo $imgheight; ?>-contentHeight;
		j(mainDiv+' #go-feat-element-'+activeNews).addClass('active');
		j(mainDiv+' #go-feat-bubbles-'+activeNews).addClass('active-bubble');
	});
});
/*-----------------------------*/
</script>
<?php
$args = array( //Args for get the contents
	'numberposts' => $numposts,
	'category' => $categories,
);
$goFeatCount=1;
$query = get_posts($args);
$goOnWidth=$width-$imgwidth-10; //Width of the links box
if($linkalign=='left'){ $imgalign='right'; } elseif($linkalign=='right'){ $imgalign='left'; } //alignment of the links
?>
<!-- Main DIV -->
<div id="go-featured-news<?php echo $ID; ?>" class="gof-news">
<?php if($showtitle=='1' && !is_widget()){ ?><span id="go-feat-title"><?php echo $title; ?></span><?php }
	$bubbleoutput='<ul class="bubbles" >';
	$i=1;
	$bposexp = explode(":0; ", $bubblepos);
	$bpos_v = $bposexp[0];
	$bpos_h = $bposexp[1];
	$bgpos = $bpos_h;
	$bgpos = str_replace(':0;', '', $bgpos);
	$bpos_h = str_replace(":0;", "", $bpos_h);
	if($bpos_h == "center"){
		$bpos_h = "none";
		$bgpos = "left";
	}
	//echo $bubblepos;
	if($bpos_v == 'top' && $bpos_h == 'left'){
		$thumbnailPos='top:100%; left:8px;';
		$arrowImg='tl';
	}
	if($bpos_v == 'top' && $bpos_h == 'none'){
		$thumbnailPos='top:100%; left:8px;';
		$arrowImg='tl';
	}
	elseif($bpos_v == 'top' && $bpos_h == 'right'){
		$thumbnailPos='top:100%; right:8px;';
		$arrowImg='tr';
	}
	elseif($bpos_v == 'bottom' && $bpos_h == 'right'){
		$thumbnailPos='bottom:100%; right:8px;';
		$arrowImg='br';
	}
	elseif($bpos_v == 'bottom' && $bpos_h == 'left'){
		$thumbnailPos='bottom:100%; left:8px;';
		$arrowImg='bl';
	}
	elseif($bpos_v == 'bottom' && $bpos_h == 'none'){
		$thumbnailPos='bottom:100%; left:8px;';
		$arrowImg='bl';
	}
	foreach($query as $bubble) : setup_postdata($bubble);
	$getThumbnailType=get_post_meta($bubble->ID, '_go_feat_mediatype', true); //Get Media Type
	 //Get the Media Value
		//$thumbnail[$i]=get_post_meta($bubble->ID, '_go_feat_mediapath', true);
		$thumbnail[$i]=get_post_meta($bubble->ID, '_go_feat_mediapath',true);
		if($getThumbnailType=="video"){
			if(strstr($thumbnail[$i], 'youtube')==true){
				preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $thumbnail[$i], $match);
				$thumbnail[$i] = $match[1];
				$thumbnail[$i] = "http://img.youtube.com/vi/".$thumbnail[$i]."/1.jpg";
			}
			else { $thumbnail[$i] = ""; }
		}
		if(empty($thumbnail[$i])){
			$bubble_tn_id = get_post_thumbnail_id($bubble->ID);
			$thumbnail[$i] = wp_get_attachment_url( $bubble_tn_id );
		}
	$thumbnailOptions = "";
	if(!empty($bubbletnwidth)){ $thumbnailOptions = "&w=".$bubbletnwidth; }
	if(!empty($bubbletnheight)){ $thumbnailOptions .="&h=".$bubbletnheight; }
	$checkPosTop = strstr($bubblepos, 'top');
	$checkPosBottom = strstr($bubblepos, 'bottom');
		$bubbleoutput.='<li id="go-feat-bubbles-'.$i.'">';
			if($bubbletype=="numeric"){ $bubbleoutput.= $i; }
			if($showbubblestn==1){ 
			//if(!empty($thumbnail[$i])){ list($widthtn, $heighttn) = getimagesize($news_slider_path.'js/timthumb.php?src='.$thumbnail[$i].$thumbnailOptions); }
				$heighttn=$bubbletnheight+62; $widthtn=$bubbletnwidth+12;
			$bubbleoutput.='<div class="tn-box" id="thumbnail-'.$i.'" style="'.$thumbnailPos.'">';
				 if($checkPosTop==true){ 
					$bubbleoutput.='<div class="tn-top"></div>';
				 } 
				$bubbleoutput.='<div class="tn-details">';
					 if(!empty($thumbnail[$i])){ 
					$bubbleoutput.='<img src="'.$news_slider_path.'js/timthumb.php?src='.$thumbnail[$i].$thumbnailOptions.'" />';
					}
					$bubbleoutput.='<p style="';
					 if(empty($thumbnail[$i])){ $bubbleoutput.='width:'.$bubbletnwidth.'px;'; } 
					$bubbleoutput.='">'.$bubble->post_title.'</p>';
				$bubbleoutput.='</div>';
				 if($checkPosBottom==true){
				$bubbleoutput.='<div class="tn-bottom"></div>';
				} 
			$bubbleoutput.='</div>';
			 } 
		$bubbleoutput.='</li>';
	$i++;
	endforeach;
$bubbleoutput.='</ul>';

	?>
	<?php if($bpos_v =='top'){ ?>
	<div class="bubbles_outer">
		<div class="bubbles_inner">
			<?php if($showarrow==1){ ?> <a class="bnav" id="b_prev" title="previous"></a> <?php } ?>
			<?php if($showbubbles==1){ echo $bubbleoutput; } ?>
			<?php if($showarrow==1){ ?> <a class="bnav" id="b_next"title="next"></a> <?php } ?>
		</div>
	</div>
	<?php } ?>
	<!-- Active Post's DIV -->
	<div class="go-feat-box">
		<?php 
		 $j=1; 
		 foreach($query as $mainbox) : setup_postdata($mainbox); ?>
			<?php
			$getMediaType=get_post_meta($mainbox->ID, '_go_feat_mediatype', true); //Get Media Type
			if(get_post_meta($mainbox->ID, '_go_feat_mediapath', true)){
			$media=get_post_meta($mainbox->ID, '_go_feat_mediapath', true); //Get the Media Value
			}
			else{
				$post_thumbnail_id = get_post_thumbnail_id($mainbox->ID);
				$media = wp_get_attachment_url( $post_thumbnail_id );
			}
			$media=stripslashes($media);
			$mainContent = "";
			if($activetitle==1){
				$itemTitle="<h3 class='go-feat-item-title'><a href='".get_permalink($mainbox->ID)."'>".$mainbox->post_title."</a></h3>"; //the details of the active post
			}
			if($postexcerpt == 1){
				if(!empty($mainbox->post_excerpt)){
					$exc = $mainbox->post_excerpt;
				}
				else{
					$exc = strip_shortcodes(strip_tags($mainbox->post_content));
				}
				$exc = strip_shortcodes(gof_shorten_string($exc, $excerptlength));
				$exc="<p>".$exc."</p>";
			}
			else { $exc = ""; }
			$mainContent = $mainContent.$exc;
			$mainContent = strip_tags($mainContent, '<p><a>');
			$mainContent = $itemTitle.$mainContent;
			?>
			<div id="go-feat-item-<?php echo $j; ?>" class="go-feat-item">
				<?php
				if(!empty($media)){
					if($getMediaType!="video"){
						global $blog_id;
						if (isset($blog_id) && $blog_id > 0) {
							$imageParts = explode('/files/', $media);
							if (isset($imageParts[1])) {
								$media = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							}
						}
						?>
						<?php $mediaimage = '<img src="'.$news_slider_path.'js/timthumb.php?src='.$media.'&w='.$imgwidth.'&h='.$imgheight.'&a=c">'; 
					}
					else { $mediaimage = $media; }
				}
				if($linktoimg == 1){
					$mediaimage = '<a href="'.get_permalink($mainbox->ID).'">'.$mediaimage.'</a>';
				}
				echo $mediaimage;
				?>
				<?php if ($getMediaType != 'video'){?>
				<div class="go-feat-content"><?php echo $mainContent; ?></div>
				<?php } ?>
			</div>
			<?php $j++; ?>
		<?php endforeach; ?>
	</div>
	<!-- Other posts' DIV -->
	<?php if($displaylinks==1){ ?>
	<div class="go-feat-other-news">
		<?php
		foreach($query as $post) : setup_postdata($post);
			$getMediaType=get_post_meta($post->ID, '_go_feat_mediatype', true); //Get Media Type
			if(get_post_meta($post->ID, '_go_feat_mediapath', true)){
			$media=get_post_meta($post->ID, '_go_feat_mediapath', true); //Get the Media Value
			}
			else{
				$post_thumbnail_id = get_post_thumbnail_id($post->ID);
				$media = wp_get_attachment_url( $post_thumbnail_id );
			}
			$media=stripslashes($media);
			if(!empty($media)){
					if($getMediaType=="image"){
						global $blog_id;
						if (isset($blog_id) && $blog_id > 0) {
							$imageParts = explode('/files/', $media);
							if (isset($imageParts[1])) {
								$media = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							}
						}
						 $element_thumbnail='<img src="'.$news_slider_path.'js/timthumb.php?src='.$media.'&w='.$bubbletnwidth.'&h='.$bubbletnheight.'">';
					}
				}
			if($linkexcerpt==1){
				if(!empty($post->post_excerpt)){
					$excerpt = strip_shortcodes($post->post_excerpt);
				}
				else{
					$excerpt = strip_shortcodes($post->post_content);
				}
				$linkContent=gof_shorten_string($excerpt, $linkexcerptlength);
			} ?>
			<div class="go-feat-element" id="go-feat-element-<?php echo $goFeatCount; ?>">
				<?php if($showlinkthumbnails==1){
					echo $element_thumbnail;
				} ?><span id="link-title-<?php echo $goFeatCount; ?>" class="link-title"><?php echo $post->post_title; ?></span>
					<p>
					<?php echo $linkContent; ?></p>
			</div>
			<?php
			$goFeatCount ++;
		endforeach;
		?>
	</div>
	<script type='text/javascript'>
		var scroller = jQuery.noConflict();
		scroller(document).ready(function(){
			scroller('div.go-feat-other-news').jScrollPane();
		});
	</script>
	<?php } ?>
	<?php if($bpos_v =='bottom'){ ?>
		<div class="bubbles_outer">
			<div class="bubbles_inner" style="float:<?php echo $bpos_h; ?>">
				<?php if($showarrow==1){ ?> <a class="bnav" id="b_prev" title="previous"></a> <?php } ?>
				<?php if($showbubbles==1){ echo $bubbleoutput; } ?>
				<?php if($showarrow==1){ ?> <a class="bnav" id="b_next"title="next"></a> <?php } ?>
			</div>
		</div>
	<?php } ?>
</div>
<?php
//font size of thumbnails
if($showbubblestn==1){
	if(200<=$heighttn){ $fontSize=16; $pheight=40;}
	if($heighttn>=150 && $heighttn<199){ $fontSize=14; $pheight=40;}
	if($heighttn>=130 && $heighttn<149){ $fontSize=12; $pheight=35;}
	if($heighttn>=110 && $heighttn<129){ $fontSize=11; $pheight=30;}
	if($heighttn>=80 && $heighttn<109){ $fontSize=10; $pheight=25;}
}
$arrow=$news_slider_path.'images/arrow-'.$arrowImg.'.png';
?>
<style type="text/css">
	#go-featured-news<?php echo $ID; ?>.gof-news{
	width:<?php echo $width; ?>px;
	}
	#go-featured-news<?php echo $ID; ?> .go-feat-box{
		float:<?php echo $imgalign; ?>;
		width:<?php echo $imgwidth; ?>px;
		height:<?php echo $imgheight; ?>px;
	}
	#go-featured-news<?php echo $ID; ?> .go-feat-item{
		<?php echo $activealign;?>;
		width:<?php echo $imgwidth; ?>px;
		height:<?php echo $imgheight; ?>px;
	}
	#go-featured-news<?php echo $ID; ?> .bubbles_outer{
		width:<?php echo $width-14; ?>px;
		<?php echo $bpos_v; ?>:0;
	}
	#go-featured-news<?php echo $ID; ?> .bubbles_inner{
		float:<?php echo $bpos_h; ?>;
	}
	
	#go-featured-news<?php echo $ID; ?> .bubbles li{
		background:<?php echo $bubble_img; ?> <?php echo $bubble_img_opts; ?> ;
	}
	#go-featured-news<?php echo $ID; ?> .bubbles .active-bubble{
		background:<?php echo $bubble_img_active; ?> <?php echo $bubble_img_opts; ?> ;
		color:black;
	}
	#go-featured-news<?php echo $ID; ?> .bubbles li:hover{
	background:<?php echo $bubble_img_active; ?> <?php echo $bubble_img_opts; ?>;
	}
	#go-featured-news<?php echo $ID; ?> .bubbles li .tn-box{
		font-size:<?php echo $fontSize; ?>px;
	}
	#go-featured-news<?php echo $ID; ?> .tn-top, #go-featured-news<?php echo $ID; ?> .tn-bottom{
		width:<?php echo $widthtn; ?>px;
	}
	#go-featured-news<?php echo $ID; ?> .tn-bottom{
		background:url(<?php echo $arrow; ?>) no-repeat <?php echo $bgpos; ?>;
		top:-1px;
		width:100%;
	}
	#go-featured-news<?php echo $ID; ?> .tn-top{
		background:url(<?php echo $arrow; ?>) no-repeat <?php echo $bgpos; ?>;
		top:1px;
		width:100%;
	}
	#go-featured-news<?php echo $ID; ?> .go-feat-other-news{
		width:<?php echo $width-$imgwidth-1; ?>px;
		height:<?php echo $height; ?>px;
		border-<?php echo $imgalign; ?>:1px solid #DDDDDD;
		float: <?php echo $linkalign; ?>
	}
	#go-featured-news<?php echo $ID; ?> .go-feat-element{
		width:<?php echo $width-$imgwidth-7; ?>px;
	}
	#go-featured-news<?php echo $ID; ?> .go-feat-element.active .link-title{
		color:white;
	}
	#go-featured-news<?php echo $ID; ?> .go-feat-item img{
		width:<?php echo $imgwidth; ?>px;
		height:<?php echo $imgheight; ?>px;
	}
	 #go-featured-news<?php echo $ID; ?> .go-feat-content{
		width:<?php echo $imgwidth-10; ?>px;
	}
	 #go-featured-news<?php echo $ID; ?> .go-feat-item iframe{
		width:<?php echo $imgwidth; ?>px;
		height:<?php echo $imgheight; ?>px;
	}
</style>
<?php if($displaylinks == 1){
	wp_enqueue_script('jscrollpane', WP_CONTENT_URL . '/plugins/' . plugin_basename(dirname(__FILE__)). '/js/jquery.jscrollpane.min.js', 'jquery', '1.0', true);
	wp_enqueue_script('jsmousewheel', WP_CONTENT_URL . '/plugins/' . plugin_basename(dirname(__FILE__)). '/js/jquery.mousewheel.js', 'jquery', '1.0', true);
	wp_enqueue_style('mousewheel_style', $news_slider_path.'css/jquery.jscrollpane.css' );
} ?>