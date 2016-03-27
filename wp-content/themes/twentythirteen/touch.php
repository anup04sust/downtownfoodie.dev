<div class="col-501">
<script type="text/javascript">
function submit_touch(){
	
 	name = document.getElementById("name").value;
    if(name=="") {show_error("name","The following should be filled in order to submit your request"); return false;}
  
   	email = document.getElementById("email").value;
    if(email=="") {show_error("email","The following should be filled in order to submit your request"); return false;}
	
  
  	subject = document.getElementById("subject").value;
    if(subject=="") {show_error("subject","The following should be filled in order to submit your request"); return false;}
 
	msg = document.getElementById("msg").value;
    if(msg=="") {show_error("msg","The following should be filled in order to submit your request"); return false;}
	    
	 
	return true;
	}
	
	
function show_error(id,message){
	alert(message);
	document.getElementById(id).focus();
	}	
</script>
 
 
 <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script>
      function initialize() {
//        var map_canvas = document.getElementById('map_canvas');

        var mapDiv = document.getElementById('map_canvas');
        var latlng = new google.maps.LatLng(24.49063, 54.36563);
 
        var options = {
            zoom: 15,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(mapDiv, options);
 
        var marker = new google.maps.Marker({
            position : latlng,
            map : map
        });

        google.maps.event.addListener(map, 'click', function() {
            
			window.open("map.html","MapWindow","width=900,height=900");
			
            //window.location.href = this.url;
        });
 

      }
      google.maps.event.addDomListener(window, 'load', initialize);

	  
	  (function () {
    window.onload = function () {
    };
})();
	  
/////////////////

	  
	  
    </script>


<table border="0" width="100%"><tbody><tr><td valign="top"><div class="top_left">Find us here</div><br><br> 

								<div style="width:240px; height:165px" id="map_canvas"></div>
								<div class="font_small">
								<br><br>Crowne Plaza Abu Dhabi 
								<br>Hamdan Bin Mohammed Street, P.O. Box 3541
								<br>Abu Dhabi, United Arab Emirates 
                                <br><br>
								<table>
								<tr><td width="120">Stay with us: </td><td>+971 (0)2 6166222<br>reservations.cpauh@ihg.com</td></tr>
								<tr><td>Dine with us: </td><td>+971 (0)2 6166101<br>fandb.cpauh@ihg.com</td></tr>
								<tr><td>General Inquiries:</td><td>+971 (0)2 6166166<br>cpauh@ihg.com</td></tr>
								</table>
								</div>
								</td>
</tr></tbody></table></div>
 <div class="col-502">
					 
                    <?php if($_REQUEST['status']=="sent") { ?> Your message has been sent. Thank you.  <?php } else{ ?>
<div class="top_right_text_left_aligned">Comments? We'd love to hear from you</div>
<span class="font_small_normal"> Please <a href="mailto:fandb.cpauh@ihg.com?Subject=Hello%20Crowne Plaza" target="_top">e-mail</a> us or fill in the form below:</span>
								
<br><br>                             
<form action="contact.php?cmd=touch" method="post" onsubmit="return submit_touch()">                                
<table align="right" class="font_small mytable" width="320"  border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td>Full Name *<br>
	<input class="form-input2" type="text" id="name" name="name" size="50">
	</td>

  </tr>
  <tr>
    <td>E-mail Address *<br>
	<input class="form-input2" type="text"  id="email" name="email" size="50">
	</td>
  </tr>
  <tr>
    <td>Subject *<br>
	<input class="form-input2" type="text"  id="subject" name="subject" size="50">
	</td>
  </tr>
  <tr>
    <td>Message *<br>
	<textarea  class="textarea2" id="msg" name="msg" ></textarea>
<input style="float:right; margin-right:2px " class="button" type="Submit" value="Submit">

	</td>
  </tr>
 
</table>
</form>

<?php }  ?>
 </div>