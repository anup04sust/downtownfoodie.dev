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

get_header(); ?>


<div id="container">
      <div id="sidebar"><!-- InstanceBeginEditable name="sidebar" -->
	    <div class="top"><img src="../_images/title_rooms_e.gif" width="180" height="109" alt="Nos salons" /></div>
		<div class="bottom">
            <div class="menuici"><img src="../_images/forfaitasici_e.png" width="101" height="57" alt="Our packages are here!" /></div>
        	<a href="package_drinks.php"><img class="roll" src="../_images/snav_withdrinks_off_e.gif" width="180" height="21" alt="Forfat avec alcool" /></a>
            <a href="package_nodrinks.php"><img class="roll" src="../_images/snav_withoutdrinks_off_e.gif" width="180" height="21" alt="Forfait sans alcool" /></a><br /><br />
        </div>	  
	  <!-- InstanceEndEditable --></div>
      <div id="content"><!-- InstanceBeginEditable name="content" -->
          <div class="col-1" style="width:370px;">
            <img src="../_images/title_content_espace_e.gif" width="231" height="66" alt="Espace & Ambiance" />
            <p>Enjoy the warmth of our rooms on the second floor for your personal or business meetings. A very pleasant space and ambiance for you and your friends for any number of activities: a happy hour, luncheons and cocktails, celebrations, wine tastings, wine and cheese parties. Enjoy our delicious suggestions and our customized packages. </p>
            <p><i>Group reservations only for 12 or more. Available on Thursdays and Fridays, throughout the year, 6:30pm the latest.</i></p>
  </div>
          <img src="../_images/group_reservation_e.gif" width="285" height="178" alt="Profitez de la réservation de groupe - 819.771.0565" class="top aright" />
          <a href="../galery/photos.php"><img src="../_images/salons_thumbs.gif" width="643" height="135" alt=" " class="bottom" style="right: 30px;" /></a>
                <div id="content-toggler"><img src="wp-content/themes/twentythirteen/images/bloc_cacher_e.jpg" width="74" height="25" alt="Show/Hide content" onclick="toggle_content_e();" /></div>
    </div>

        <!-- InstanceEndEditable --></div>
      <div id="content-toggler"><img src="../_images/bloc_cacher_e.jpg" width="74" height="25" alt="Show/Hide content" onclick="toggle_content_e();" /></div>
    </div>

<!--
<tr><td style="padding-top:30px">
			<?php while ( have_posts() ) : the_post(); ?>

						

<div class="side" ><h1 style="float:right" class="entry-title"><?php the_title(); ?></h1>

<div style="float:right; padding-bottom:0px; margin-right:15px; ">
<ul style="text-align:right; list-style:none; font-size:16px; font-weight:bold; width:100%">
<li><a href="?page_id=12">Heroes Sports Bar</a></li>
<li><a href="?page_id=14">Level Lounge Rooftop Bar</a></li>
<li><a href="?page_id=16">Vincent's Cigar Bar</a></li>

</div>

</div>
<div class="my_content" >
						<?php the_content(); ?>
				<?php //comments_template(); ?>
			<?php endwhile; ?>
</div>
-->

<div id="menu">
        
        
        
        
        
        <a href="../restaurants/wine_cellars.php" class="right"><img src="wp-content/themes/twentythirteen/images/logo-trans.png" width="182" height="59" alt="piz'za-za - Restaurant - Bar à Vin" /></a>
        <a href="restaurant_bar_wine.php"><img src="wp-content/themes/twentythirteen/images/bt_menu-trans.png" width="68" height="116" alt="Menu" /><img class="bulle menu" src="wp-content/themes/twentythirteen/imagesmenu_e.png" width="120" height="99" alt="Menu" /></a>
        <a href="../wine-cellars/wine.php"><img src="wp-content/themes/twentythirteen/images/bt_cave-trans.png" width="65" height="116" alt="Wine cellars" /><img class="bulle cave" src="wp-content/themes/twentythirteen/image/scave_e.png" width="135" height="98" alt="Cave à vin" /></a>
        <a href="../our-rooms/space_ambiance.php"><img src="wp-content/themes/twentythirteen/images/bt_salon-trans.png" width="93" height="116" alt="Our rooms" /><img class="bulle salon" src="wp-content/themes/twentythirteen/images/salons_e.png" width="141" height="97" alt="Nos salons" /></a>
        <a href="../tour/wine_tasting.php"><img src="wp-content/themes/twentythirteen/images/bt_raisin-trans.png" width="62" height="116" alt="The wine route" /><img class="bulle raisin" src="wp-content/themes/twentythirteen/images/tournee_e.png" width="168" height="150" alt="Tournée des vignobles" /></a>
        <a href="../galery/photos.php"><img src="wp-content/themes/twentythirteen/images/bt_galeriephotos_trans.png" width="89" height="116" alt="Album photos" /><img class="bulle photos" src="wp-content/themes/twentythirteen/images/albumphotos_e.png" width="123" height="88" alt="Album photos" /></a>
   		<a href="../videos/videos_e.php"><img src="wp-content/themes/twentythirteen/images/bt_videos.png" width="64" height="116" alt="Videos" /><img class="bulle videos" src="wp-content/themes/twentythirteen/images/videos_e.png" width="125" height="89" alt="Videos" /></a>
   </div>
   
  	<div id="quick-menu"><a href="../about-us/pizzaza.php"><img src="wp-content/themes/twentythirteen/images/bt_about-trans_off_e.gif" width="58" height="27" alt="À Propos" class="roll" /></a><a href="../contact-us/contact_pizzaza.php"><img src="wp-content/themes/twentythirteen/images/bt_contact-trans_off_e.gif" width="78" height="27" alt="Contact" class="roll" /></a><a href="../employement/dynamic_team.php"><img src="wp-content/themes/twentythirteen/images/bt_emploi-trans_off_e.gif" width="50" height="27" alt="Emploi" class="roll" /></a><a href="../menu/cocktails.php"><img src="wp-content/themes/twentythirteen/images/bt_francais-trans_off_e.gif" width="77" height="27" alt="English" class="roll" /></a>
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