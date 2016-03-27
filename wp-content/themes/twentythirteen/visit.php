<div class="col-501">
             		<script type="text/javascript">
function submit_visit(){
	restaurant = document.getElementById("select_id").value;
    if(restaurant=="select") {show_error("select_id","The following should be filled in order to submit your request"); return false;}
 
 	date = document.getElementById("date").value;
    if(date=="") {show_error("date","The following should be filled in order to submit your request"); return false;}
  
  	time = document.getElementById("time").value;
    if(time=="") {show_error("time","The following should be filled in order to submit your request"); return false;}

 	adult = document.getElementById("adult").value;
    if(adult=="") {show_error("adult","The following should be filled in order to submit your request"); return false;}

 	child = document.getElementById("child").value;
    if(child=="") {show_error("child","The following should be filled in order to submit your request"); return false;}
	
  	phone = document.getElementById("phone").value;
    if(phone=="") {show_error("phone","The following should be filled in order to submit your request"); return false;}
 
   	email = document.getElementById("email").value;
    if(email=="") {show_error("email","The following should be filled in order to submit your request"); return false;}

	return true;
	}
	
	
function show_error(id,message){
	
	alert(message);
	document.getElementById(id).focus();
	}	
</script>

 <form action="http://floradubai.com/crownplaza/contact.php?cmd=visit" method="post" onsubmit="return submit_visit()">  

<table border="0" width="100%"><tbody><tr><td valign="top" width="45%"><div class="top_left">Need a place to dine and have fun?</div><br><br>
<span class="font_small_normal">Please <a href="mailto:fandb.cpauh@ihg.com?Subject=Hello%20Crowne%20Plaza" target="_top">e-mail</a> us or fill in the form below:</span>

<br><br>
 							
<table align="left" width="320" class="font_small mytable" border="0" cellpadding="0">
  <tbody><tr>
    <td colspan="2"> Restaurant/Bar *<br>
	<select class="form-input_dropdown" name="restaurant" id="select_id" >
	<option value="select"> * Please select</option>
	<option value="Cho Gao Asian Experience">Cho Gao Asian Experience</option>
	<option value="Spaccanapoli Ristorante Italiano">Spaccanapoli Ristorante Italiano</option>
	<option value="The Garden All Day Dining">The Garden All Day Dining</option>
	<option value="Cappuccino's Café">Cappuccino's Café</option>
	<option value="Heroes Sports BarHeroes Sports Bar">Heroes Sports Bar</option>
	<option value="Level Lounge Rooftop Bar">Level Lounge Rooftop Bar</option>
	<option value="Vincent&#39;s Bar">Vincent's Bar</option>
	
	</select>
	
	</td>

  </tr>

  <tr><td align="left" >Date *<br><input type="text" id="date" class="form-input_half" name="date" size="20"></td><td align="left"><span class="second_small_text">&nbsp;Time *</span><br><input id="time" class="form-input_2nd_half" name="time" type="text" size="20"></td></tr>

  <tr><td align="left">Adults *<br><input type="text" id="adult" name="adult" class="form-input_half" size="20"></td><td align="left"><span class="second_small_text">&nbsp;Children *</span><br><input type="text" id="child"  class="form-input_2nd_half" name="child" size="20"></td></tr>
  <tr>
    <td colspan="2">E-mail Address *<br>
	<input type="text" class="form-input" id="email" name="email" size="38">
	</td>
  </tr>
  <tr>
    <td colspan="2">Phone number *<br>
	<input type="text" class="form-input" id="phone" name="phone" size="38">
	</td>
  </tr>
  
</tbody></table></td></tr>
	</tbody></table>					
    </div>
 <div class="col-502">
    
            <div class="top_right_text">Take Advantage of special offers for private parties, Large groups and special reservations
					</div> <br><br> <br><br>
								<div style="font-size:10px;text-align:left; margin-top:+20px; margin-bottom:0px; border:0px solid #F00">Special Requirements</div>
								
  
	<textarea cols="21" class="textarea" id="msg" name="msg"   rows="10"></textarea>
	
	<input style="float:right; margin-right:2px " class="button" type="Submit" value="Submit">
	</form>
    </div>
	 
<div class="contact_text">
24-Hours prior reservation is required. Your booking will be confirmed by our reservations team.<br>
If you wish to stay with us call +971 (0)2 6166222 or email <a href="mailto:reservations.cpauh@ihg.com?Subject=Reservation%20Crowne%20Plaza" target="_top">reservations.cpauh@ihg.com</a>
</div>