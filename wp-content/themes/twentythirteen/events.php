	<script>

	window.addEvent('domready', function(){
		myPicker = new Picker.Date($$('time'), {
			pickOnly: 'time',
			timeWheelStep: 5
		});
	});

	</script>


<div class="col-501">
<script type="text/javascript">
function submit_event(){
	restaurant = document.getElementById("select_id").value;
    if(restaurant=="select") {show_error("select_id","The following should be filled in order to submit your request"); return false;}
 
 	date = document.getElementById("date").value;
    if(date=="") {show_error("date","The following should be filled in order to submit your request"); return false;}
  
  	time = document.getElementById("time").value;
    if(time=="") {show_error("time","The following should be filled in order to submit your request"); return false;}

  	people = document.getElementById("people").value;
    if(people=="") {show_error("people","The following should be filled in order to submit your request"); return false;}
	
	
	
  	phone = document.getElementById("phone").value;
    if(phone=="") {show_error("phone","The following should be filled in order to submit your request"); return false;}
 
   	email = document.getElementById("email").value;
    if(email=="") {show_error("email","The following should be filled in order to submit your request"); return false;}

	return true;
	}
function check_event_type(selected_event){
    if(selected_event =="Other")
	document.getElementById("other").style.display = "block";
	else{
		document.getElementById("other").style.display = "none";
		}
	
	}	
	
function show_error(id,message){
	alert(message);
	document.getElementById(id).focus();
	}	
</script>

<form action="contact.php?cmd=events" method="post" onsubmit="return submit_event()">  

<table border="0" width="100%"><tbody><tr><td valign="top" width="45%"><div class="top_left">Looking to organise a meeting or a party?</div><br><br>
<span class="font_small_normal">Please <a href="mailto:events.cpauh@ihg.com?Subject=Event%20Booking%20Crowne Plaza" target="_top">e-mail</a> us or fill in the form below:</span>

<br><br> 							
<table align="left" width="280" class="font_small mytable" border="0" cellpadding="0">
  <tr>
    <td colspan="2">Type of event *<br>
	<select class="form-input_dropdown" onchange="check_event_type(this.value)" name="event_name" id="select_id">
	<option value="select"> * Please select</option>
	<option value="Meeting">Meeting</option>
	<option value="Meeting with lunch">Meeting with lunch</option>
	<option value="Meeting with dinner">Meeting with dinner</option>
	<option value="Dinner">Dinner</option>
	<option value="Wedding">Wedding</option>
	<option value="Anniversary">Anniversary</option>
	<option value="Outdoor catering">Outdoor catering</option>
	<option value="Room hire only">Room hire only</option>
   	<option value="Other">Other</option>    
	
	</select>
    <div id="other" style="display:none" >Please specify<br>
	<input type="text" class="form-input"  id="specify" name="specify" size="38"></div>
	</td>

  </tr>

 

  <tr><td align="left" >Date *<br><input type="text" id="date" class="form-input_half" name="date" size="20"></td><td align="left">&nbsp;Time *<br><input id="time"  class="form-input_2nd_half" name="time" type="text" size="20"></td></tr>
 
 
  <tr>
    <td colspan="2">Number of people *<br>
	<input type="text" class="form-input" id="people"  name="people" size="38">
	</td>
  </tr>

  <tr>
    <td colspan="2">E-mail address *<br>
	<input type="text" class="form-input"  id="email" name="email" size="38">
	</td>
  </tr>
  <tr>
    <td colspan="2">Phone number *<br>
	<input type="text" class="form-input"  id="phone"  name="phone" size="38">
	</td>
  </tr>
  
</table>
</td></tr>
	</tbody></table>					
    </div>
 <div class="col-502">
             <div class="top_right_text">Take Advantage of special offers for private parties, Large groups and special reservations
					</div><br> 	<br> 	<br> 	<br> 	
							<div style="font-size:10px;text-align:left; margin-top:+20px; margin-bottom:0px; border:0px solid #F00">Special Requirements</div>
								
  	<textarea cols="21" class="textarea"  id="msg" name="msg"  rows="10"></textarea>
	
	

	
	<input style="float:right;" class="button"   type="Submit" Value="Submit">
	</form>
   </div>
	 
<div class="contact_text">
7 days prior reservation is required. Your booking will be confirmed by our Events team<br />
If you wish to stay with us call +971 (0)2 6166222 or email <a href="mailto:reservations.cpauh@ihg.com?Subject=Reservation%20Crowne Plaza" target="_top">reservations.cpauh@ihg.com</a>
</div>
