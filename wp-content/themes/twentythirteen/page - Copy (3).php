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
?>

<div id="container">
      <div id="sidebar"><!-- InstanceBeginEditable name="sidebar" -->
	    <div class="top"><?php echo $page_title; get_heading($group); ?></div>
		<div class="bottom">
        
<ul class="submenu"><?php echo get_sub_menu_items($group); ?></ul>		
			
        </div>	  
	  <!-- InstanceEndEditable --></div>



	  <?php while ( have_posts() ) : the_post(); ?>  
  <div id="content" style=""><!-- InstanceBeginEditable name="content" -->

  <div class="col-1" style="width:590px;">
            <p>
								<?php
								
								if($group == "visit"){
								
								include($group.".php");
								}
								if($group == "touch"){
								
								?>
								 <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script>
      function initialize() {
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          center: new google.maps.LatLng(24.46666, 54.366666),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options)
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
								<table style="font-weight:bold; margin-top:5px" border="0" width="100%"><tr><td valign="top" width="60%">Find us here<br><br>
								<div style="width:210px; height:150px" id="map_canvas"></div>
								<div style="font-size:10px; font-weight:normal">
								<br>Crowne Plaza Abu Dhabi 
								<br>Sheikh Hamdan Street, P.O. Box 3541
								<br>Abu Dhabi, United Arab Emirates 
								<table>
								<tr><td>Stay with us </td><td>+971 (0)2 6166222<br>reservations.cpauh@ihg.com</td></tr>
								<tr><td>Dine with us </td><td>+971 (0)2 6166101<br>fandb.cpauh@ihg.com</td></tr>
								<tr><td>General Inquiries</td><td>+971 (0)2 6166166<br>cpauh@ihg.com</td></tr>
								</table>
								</div>
								</td>
								
					<td align="" valign="top" style="font-size:14px"> Comments? We'd love to hear from you
								<br>
								<span style="font-size:12px"> Please <a href="mailto:fandb.cpauh@ihg.com?Subject=Hello%20Crowne Plaza" target="_top">e-mail</a> us or fill in the form below
								
<table align="right" width="320" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td>Full Name:<br>
	<input type="text" size="40">
	</td>

  </tr>
  <tr>
    <td>E-mail Address:<br>
	<input type="text" size="40">
	</td>
  </tr>
  <tr>
    <td>Subject:<br>
	<input type="text" size="40">
	</td>
  </tr>
  <tr>
    <td>Message:<br>
	<textarea cols="30" rows="5"></textarea>
	</td>
  </tr>
  <tr>
    <td align="right"><input type="Submit" Value="Submit"></td>
  </tr>
</table>

								
								
								</td></tr></table>
								
								<?php
								}
								else{the_content(); 	}
								
								?>
			</p>
       </div>
	   
	   
	   <div style="width:100%;margin-top:280px;">  
	   
	   <?php if($group == "touch" or $group=="visit"){} else { ?>
	   <div style="float:left"><table style="font-size:10px;margin-left:20px" ><tr><td>WRITE A REVIEW</td></tr>
	   <tr><td align="center"><img src="wp-content/themes/twentythirteen/images/trip_advisor_logo.png"></td></tr>
	   <tr><td  align="center">tripadvisor</td></tr>
	   </table>
	   </div>
	   <div style="font-size:10px;margin-left:75px;float:left">
	   <table><tr><td>SEE OUR OFFERS</td></tr>
	   <tr><td align="center"><img height="30" src="wp-content/themes/twentythirteen/images/ofrs.png"></td></tr>
	   </table>
	   </div>
	   
	   <?php } ?>
	   
	   </div>
	   
	   
	   
                <div id="content-toggler"><img src="wp-content/themes/twentythirteen/images/hide.png" width="74" height="25" alt="Show/Hide content" onclick="toggle_content_e();" /></div>
    </div>

					<?php endwhile; ?>
        <!-- InstanceEndEditable --></div>

    </div>


<div id="menu">
        
        <a href="<?php echo $root; ?>" class="right"><img src="wp-content/themes/twentythirteen/images/logo.png"  alt="Crowne Plaza" /></a>
        <a style="padding-left:120px;" href="restaurant_bar_wine.php"><img border="2" src="wp-content/themes/twentythirteen/images/res.png"  alt="Menu" /></a>
        <a href="<?php echo $root; ?>?page_id=12"><img src="wp-content/themes/twentythirteen/images/bar.png"  alt="Wine cellars" /></a>
        <a href="restaurant_bar_wine.php"><img border="2" src="wp-content/themes/twentythirteen/images/ofrs.png"  alt="Menu" /></a>
        <a href="restaurant_bar_wine.php"><img border="2" src="wp-content/themes/twentythirteen/images/photo.png"  alt="Menu" /></a>
        <a href="restaurant_bar_wine.php"><img border="2" src="wp-content/themes/twentythirteen/images/video.png"  alt="Menu" /></a>
   </div>
   
  	<div id="quick-menu">
	<ul>
	<li> <a href="<?php echo $root; ?>">Hello</li>
	<li> <a href="<?php echo $root; ?>?page_id=6">Get in Touch</li>
   	<li> <a href="<?php echo $root; ?>?page_id=24">Visit</li>
	<li> <a href="<?php echo $root; ?>?page_id=28">Subscribe</li>
	</div>
  	

  	<div id="footer" >
	<div id="copyright">&copy; 2014 Crowne Plaza Abu Dhabi. All Rights Reserved<br>
    <span style="font-size:10px" >Sheikh Hamdan Street. P.O Box 3541. Abu Dhabi. United Arab Emirates | Privacy Statement | Terms of Use </span>    
	</div>
	
	<div id="share">
	<a href=""><img src="wp-content/themes/twentythirteen/images/fbs.png"></a>
	<a href=""><img src="wp-content/themes/twentythirteen/images/twts.png"></a>
	<a href=""><img src="wp-content/themes/twentythirteen/images/gls.png"></a>
	<a href=""><img src="wp-content/themes/twentythirteen/images/youtubes.png"></a>
	
	</div>
	
	</div>
	
	
	
	
<script type="text/javascript">
//alert('dfs');

$(document).ready(function(){	
var bg = $('#bg_image');
	alert('sda');	
});


$(window).bind('resize', function () { 

    alert('resize');

});

$(window).resize(function(){
	
	alert('sdfsdf');
	var bg = $('#bg_image');
	
	var ratio = 12/8;
	
	bg.width($(window).width());
	bg.height($(window).width()/ratio);
	
alert(bg.width() + "  :::: " + $(window).width());
	
	if (bg.height().toInt() < $(window).height()) {
		
		bg.height($(window).height());
		bg.width($(window).height()*ratio);
		
	}
	
	});
</script>