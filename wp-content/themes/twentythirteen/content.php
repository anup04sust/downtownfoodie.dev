<div class="col-1">
<?php $page_id=$_REQUEST['page_id'];

$logo_img = "images/logo_".$page_id.".png";
if (is_file($logo_img)) $logo_src = "<img src='$logo_img'>"; 

$small_icon_img = "images/small_".$page_id.".png";
if (is_file($small_icon_img)) $small_icon_src = "<img src='$small_icon_img'>"; 

$award_img = "images/award_".$page_id.".png";
if (is_file($award_img)) $award_src = "<img src='$award_img'>"; 

$award2_img = "images/award2_".$page_id.".png";
if (is_file($award2_img)) $award2_src = "<img src='$award2_img'>"; 


 ?>
<table border="0"><tr>
<td valign="top" width="645" class="top_left">
<table border="0" style="position:relative;"> <tr><td valign="top" class="about_title">About <?php the_title(); ?></td><td><?php echo $small_icon_src; ?></td></tr></table>
<div class="text_outlet"><?php the_content(); ?></div>


<?php if($group == "touch" or $group=="visit" or $group=="subscribe" or $group=="events" || $group=="conference" || $group == "gallery" || $group == "video" || $group == "insta"){} else { 
	   include("content_bottom.php");
       } ?>





</td> 

<td width="240" valign="top" align="right"> <?php echo $logo_src; ?>  

       <div style="margin-right:4px; position:absolute; bottom:28px; right:35px; float:right">
        <?php echo $award_src; echo "&nbsp;"; echo $award2_src; ?>
       </div>
</td></tr></table>
</div>





