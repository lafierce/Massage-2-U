<?php include_once("header.inc");
require_once("functions.inc");
require_once("gen_db.inc");
error_reporting(0);
$func = new functions;
$db = new db;

?>
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
var gzips = new Array("77568","77591","77563","77592","77590","77539","77510","77517","77554","77518","77551","77553",
"77555","77573","77574","77565","77550","77552","77577","77586","77058","77598","77511","77512","77507","77059");
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
	echo "Is your screen too small to read?  Please call <a href=\"tel:8883088965\" style=\"text-decoration:underline;\">(888) 308-8965</a> so we can better assist you.  We will book your appointment for you.";
	echo "<br /><span style=\"color:#555566;font-size:0.85em;font-weight:normal;text-variant:italic;\">(just tap the number above to dial automatically)</span>";
	echo "</div>";
}
?>

<p id="rust_header">Service Area</p>
<p>Massage2U's <b>Houston,</b> service area covers about 25 driving miles from the center of Houston's Inner Loop (77006) <br>Now serving <b>Galveston / Clear Lake</b> and surrounding area. The service area is 20mi radius of 77469 <br>
<p>Other cities in our standard service area may include but are not limited to: Sugar Land, Pearland, Pasadena, and Baytown<p/><p></p>
<p>To check if you are in the service area 
enter your ZIP code into the field below.</p>
<form name="testzipform">
<input type="text" name="testzip" size="6" />&nbsp;
<input type="button" value="Check ZIP" onclick="checkZIP(document.testzipform.testzip.value)" />
</form>
<a href="http://maps.google.com/maps/place?hl=en&expIds=17259&sugexp=ldymls&xhr=t&cp=8&um=1&ie=UTF-8&q=massage2u&fb=1&gl=us&hq=massage2u&hnear=Houston,+TX&cid=8653956965096861275"><img src="images/service_area_map.jpg" height="337" width="404" alt="Massage2U LLC Service Area Map Image" border="0" /></a>
<!-- <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=77006&amp;sll=37.0625,-95.677068&amp;sspn=34.259599,62.753906&amp;ie=UTF8&amp;hq=&amp;hnear=Houston,+Harris,+Texas+77006&amp;ll=29.742917,-95.388794&amp;spn=0.41733,0.583649&amp;z=10&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=77006&amp;sll=37.0625,-95.677068&amp;sspn=34.259599,62.753906&amp;ie=UTF8&amp;hq=&amp;hnear=Houston,+Harris,+Texas+77006&amp;ll=29.742917,-95.388794&amp;spn=0.41733,0.583649&amp;z=10&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small> -->

<br /><br /><br /><br />
<p>Our extended service area includes but is not limited to: Parts of Sugar Land, Missouri City, Fresno, Cypress, Humble. If you are in the extended service area please call to make your appointments 888.308.8965</p>
<!-- <img src="images/service_area_map.jpg" height="295" width="297" alt="Massage2U Service Area Map" title="Massage2U Service Area Map" />
<input type="button" value="test" onclick="testBtn();" />  -->
<?php include_once("footer.inc"); ?>