<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

 
get_header(); 

$group = get_group();
$root = "/crownplaza/";

 $glance_link = get_glance_link();	
?> 
<table border="1" width="100%" height="100%">
<tr><td width="100%">
      <div id="sidebar"><!-- InstanceBeginEditable name="sidebar" -->
	    <div class="top"><?php echo  get_heading($group); ?></div>
		<div class="bottom">
        
<ul class="submenu"><?php echo get_sub_menu_items($group); ?></ul>		
			
        </div>	  
	  <!-- InstanceEndEditable --></div>

	  <?php while ( have_posts() ) : the_post(); ?>  
  <div id="content" style=""><!-- InstanceBeginEditable name="content" -->

  
								<?php
								//echo $group;
								if($group == "visit" || $group == "subscribe" || $group == "touch" || $group == "events" || $group == "conference" || $group == "insta"||  $group == "gallery"|| $group == "video"){
								include($group.".php");
								}else{
									include("content.php");
									}
								
								?>
			 
	   
	   
	   
	   
       
                <div id="content-toggler"><img src="wp-content/themes/twentythirteen/images/hide.png" width="74" height="25" alt="Show/Hide content" onclick="toggle_content_e();" /></div>
    </div>

					<?php endwhile; ?>
        <!-- InstanceEndEditable --></div>
</td></tr>
<tr><td width="100%">

<div id="menu">        
        <!--<a href="<?php echo $root; ?>" class="right"><img src="wp-content/themes/twentythirteen/images/logo.png"  alt="Crowne Plaza" /></a>-->
        <a style="padding-left:40px;" href="<?php echo $root; ?>?page_id=30"><img border="2" height="63"  width="63" src="wp-content/themes/twentythirteen/images/res.png"    onmouseover="change_hover(this,'restuarants_on.png','restaurants')"   onmouseout="change(this,'res.png')"   alt="Crown Plaza restaurants" /></a>
        <a href="<?php echo $root; ?>?page_id=12"><img src="wp-content/themes/twentythirteen/images/bar.png"  height="63"  width="63"  onmouseover="change_hover(this,'bars_on.png','bars')"   onmouseout="change(this,'bar.png')"   alt="Crown Plaza Bars" /></a>
        <a href="" <?php echo  $glance_link;?>><img border="2"  height="63"  width="63"  src="wp-content/themes/twentythirteen/images/ofrs.png"   onmouseover="change_hover(this,'promotions_on.png','promotions')"   onmouseout="change(this,'ofrs.png')"   alt="Crown Plaza Bars"  /></a>
        <a href="<?php echo $root; ?>?page_id=39"><img border="2"  height="63"  width="63" src="wp-content/themes/twentythirteen/images/photo.png"  onmouseover="change_hover(this,'meetings_on.png','conference 	and banqueting')"   onmouseout="change(this,'photo.png')"  alt="Menu" /></a>
        <a href="<?php echo $root; ?>?page_id=43"><img border="2"  height="63"  width="63"  src="wp-content/themes/twentythirteen/images/video.png"  onmouseover="change_hover(this,'gallery_on.png','gallery')"   onmouseout="change(this,'video.png')"  alt="Menu" /></a>
		
		 <div id="selected_icon"></div>
		
   </div>
</td></tr>
<tr><td width="100%">
   
  	<div id="quick-menu">
	<ul>
	<li> <a href="<?php echo $root; ?>">Hello</a></li>
	<li> <a href="<?php echo $root; ?>?page_id=6">Get in Touch</a></li>
   	<li> <a href="<?php echo $root; ?>?page_id=24">Visit</a></li>
	<li> <a href="<?php echo $root; ?>?page_id=28">Subscribe</a></li>
	<li style="margin-top:-10px; cursor:pointer"> <a  onclick="window.open('http://www.privilege-club.com/', 'preferedclub', 'width=1000, height=1050');"> <img src="wp-content/themes/twentythirteen/images/pc.png"></a></li>

 	</ul>
	</div>
  	

  	<div id="footer" >
	<div id="copyright">&copy; 2014 Crowne Plaza Abu Dhabi. All Rights Reserved.<br>
      <span style="font-size:10px" >Hamdan Bin Mohammed Street, P.O. Box 3541, Abu Dhabi, United Arab Emirates | 
	  <a href="javascript:void(0);" onclick="window.open('/crownplaza/docs/Privacy-statement.pdf', 'newwindow', 'width=1000, height=950');">Privacy Statement</a> 
	  | <a href="javascript:void(0);" onclick="window.open('/crownplaza/docs/Terms.pdf', 'newwindow', 'width=1000, height=950');">Terms of Use</a> </span>    
	</div>
	
	<div id="share">
     <a onclick="window.open('http://www.facebook.com/CrownePlazaAUH', 'newwindow', 'width=1000, height=1050');"><img src="wp-content/themes/twentythirteen/images/fb.png"  onmouseover="change(this,'fb_on.png')"   onmouseout="change(this,'fb.png')"   ></a>
	<a onclick="window.open('http://www.twitter.com/CrownePlazaAUH', 'newwindow', 'width=1000, height=1050');"><img src="wp-content/themes/twentythirteen/images/twt.png"    onmouseover="change(this,'twt_on.png')"   onmouseout="change(this,'twt.png')" ></a>
	<a onclick="window.open('http://www.instagram.com/crowneplazaabudhabi', 'newwindow', 'width=1000, height=1050');"><img src="wp-content/themes/twentythirteen/images/insta.png"   onmouseover="change(this,'insta_on.png')"   onmouseout="change(this,'insta.png')" ></a>
	<a onclick="window.open('http://www.youtube.com/crowneplazaauh', 'newwindow', 'width=1000, height=1050');"><img src="wp-content/themes/twentythirteen/images/tube.png"  onmouseover="change(this,'tube_on.png')"   onmouseout="change(this,'tube.png')" ></a>
		
	</div>
	
	</div>
	
</td></tr></table>
	
	 