<?php include_once("header.inc");
require_once("functions.inc");
require_once("gen_db.inc");
error_reporting(0);
$func = new functions;
$db = new db;

?>
<style type="text/css">
#appointmentdiv { visibility: hidden;}
</style>
<script language="Javascript" type="text/javascript">
function checkZIP(z) {
	var loc = "";
	var gloc = "http://www.genbook.com/bookings/slot/reservation/30101496?bookingContactId=147225523&category=146844265";
	var hloc = "http://www.genbook.com/bookings/slot/reservation/30101496?bookingSourceId=1000";
	if (z=="") { alert("Please enter your ZIP code."); document.testzipform.testzip.focus(); return false;} // end if zip field is blank
	var ret=false;
	var zips = new Array("77002","77285","77019","77098","77276","77004","77006","77010","77296","77097",
"77204","77206","77207","77208","77210","77212","77213","77215","77216",
"77217","77218","77219","77220","77221","77222","77223","77224","77225",
"77226","77227","77228","77229","77230","77231","77233","77234","77235",
"77236","77237","77238","77240","77241","77242","77243","77244","77245",
"77248","77249","77251","77252","77253","77254","77255","77256","77257",
"77258","77259","77261","77262","77263","77265","77266","77267","77268",
"77269","77270","77271","77272","77273","77274","77275","77277","77279",
"77280","77282","77284","77287","77288","77289","77290","77291","77292",
"77293","77297","77298","77299","77001","77052","77203","77202","77030",
"77005","77201","77007","77003","77046","77027","77021","77009","77054",
"77008","77023","77286","77011","77056","77402","77025","77020","77401",
"77026","77081","77051","77033","77057","77022","77018","77087","77024",
"77096","77045","77246","77247","77055","77278","77012","77092","77028",
"77029","77063","77035","77076","77047","77093","77091","77061","77017",
"77036","77074","77048","77547","77250","77080","77013","77260","77016",
"77085","77071","77042","77088","77078","77075","77587","77037","77506",
"77031","77501","77508","77053","77489","77502","77294","77043","77072",
"77039","77040","77411","77038","77099","77477","77079","77050","77497",
"77077","77060","77504","77588","77584","77015","77041","77086","77545",
"77034","77089","77503","77581","77082","77315","77067","77032","77496",
"77083","77049","77064","77396","77505","77209","77536","77478","77066",
"77459","77084","77205","77487","77530","77498","77044","77014","77094",
"77413","77073","77065","77578","77059","77090","77549","77069","77062",
"77546","77479","77068","77325","77347","77338","77598","77070","77095");
var gzips = new Array("77591","77563","77592","77590","77539","77510","77517","77554","77518","77551","77553",
"77555","77573","77574","77565","77550","77552","77577","77586","77058","77598","77511","77512","77546","77549",
"77062","77507","77059");
	for (i=0;i<zips.length;i++) {
		if (zips[i]==z) {
			ret=z;
			loc=hloc;
		}
	} // end for each zip in arr
	for (i=0;i<gzips.length;i++) {
		if (gzips[i]==z) {
			ret=z;
			loc=gloc;
		}
	} // end for each gzip in arr
	if (ret==false) {
		alert("Your ZIP code "+z+" is in the extended service area.  Please call 888.308.8965 to make your appointments.  Not all of the therapists will be available in your area.");
	} else {
		//alert("Congratulations!\nYour ZIP code "+z+" is in our service area. Please use the appointment tab to schedule an appointment.");
		window.location=loc;
	} // end if zip was found in array
} // end function checkZIP
</script>
<?php
if ($is_mobile) {
	echo "<div style=\"width:280px; font-weight:bold; font-size:1.15em;\">";
	echo "Is your screen too small to read?  Please call 888.308.8965 so we can better assist you.  We will book your appointment for you.";
	echo "<br /><span style=\"color:#555566;font-size:0.85em;font-weight:normal;text-variant:italic;\">(just tap the number above to dial automatically)</span>";
	echo "</div>";
}
?>
<a name="appointments"></a>
<p id="rust_header">Book Online!</p>

<div name="appointmenttxt" id="appointmenttxt">To Book Online, please begin by entering your zip code:
<form name="testzipform">
<input type="text" name="testzip" size="6" />&nbsp;
<input type="button" value="Book Online" onclick="checkZIP(document.testzipform.testzip.value)" />
</form>
</div>

<div name="appointmentdiv" id="appointmentdiv">
<!-- begin Genbook badge -->
<script src="http://www.genbook.com/bookings/booknowjstag.action?id=30101496&bookingSourceId=1000"></script>
<noscript><a href="http://www.genbook.com/bookings/slot/reservation/30101496?bookingSourceId=1000"><img src="http://www.genbook.com/bookings/images/30101496/booknow.gif" width="100" height="34" alt="Make an Online Appointment" border="0"/></a><br/><a href="http://www.genbook.com" style="font-size:10px;">Online appointment scheduling for Massage Therapists</a></noscript>
<!-- end Genbook badge -->
<br /><br /><br />
<input type="button" value="back" onclick="document.getElementById('appointmentdiv').style.visibility='hidden'; document.getElementById('appointmenttxt').style.visibility='visible'; document.testzipform.testzip.value='';"/>
<br /><br /><br /><br />
<p id="rust_header" style="font-size: 10pt;">***Note***</p>
<p>You will receive an e-bill for your appointment.  Payments can be made by debit, credit card, or PayPal. A PayPal account is not required.  Payments is needed before your therapist can leave for your appointment. You are protected 100% against fraudulent charges and identity theft. The charge will appear on your credit card as "M2U online". You can cancel up to 2 hours before your appointment and receive a full refund. If you have any questions feel free to call 888.308.8965.</p>
</div>
<?php include_once("footer.inc"); ?>