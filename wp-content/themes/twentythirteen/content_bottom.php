<div style="width:100%; position:absolute; bottom:30px; border:0px solid #F00">
<?php $trip_advisor_link= get_tripadvisor_link($page_id);
 $menu_link= get_menu_link($page_id);
 

 
 $glance_link = get_glance_link();	
 ?>
	   <div style="float:left">
       <table style="font-size:10px;margin-left:20px" ><tr><td>WRITE A REVIEW</td></tr>
	   <tr><td align="center"><a onclick="window.open('<?php echo $trip_advisor_link; ?>', 'newwindow', 'width=1000, height=1050');"><img  src="wp-content/themes/twentythirteen/images/trip_advisor_logo_s.png"></a></td></tr>
	   <tr><td  align="center">tripadvisor</td></tr>
	   </table>
	   </div>
	   <div style="font-size:10px;margin-left:55px;float:left">
	   <table><tr><td>SEE OUR OFFERS</td></tr>
	   <tr><td align="center"><a <?php echo $glance_link; ?>><img src="/wp-content/themes/twentythirteen/images/ofrs_s.png"></td></tr>
	   </table>
	   </div>
       <div style="font-size:10px;margin-left:55px;float:left">
	   <table><tr><td>DOWNLOAD MENU</td></tr>
	   <tr><td align="center"><a  onclick="window.open('<?php echo $menu_link; ?>', 'newwindow', 'width=1000, height=950');" href=""><img  src="/wp-content/themes/twentythirteen/images/menu_s.png"></a></td></tr>
	   </table>
	   </div> 
</div>