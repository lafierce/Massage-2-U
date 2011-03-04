<?php include_once("header.inc"); 
require_once("functions.inc");
require_once("gen_db.inc");
error_reporting(0);
$func = new functions;
$db = new db;

?>

	<div class="logo">
	<a href="index.php"><img class="logoIndex" src="images/m2u-logo.png" height="191" width="265" title="Massage 2 U - logo" alt="Massage 2 U - logo" style="padding-top: 5px;" /></a>
	<div style="margin-left:auto; margin-top:40px;">
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin-left:80px;">
  		<input name="cmd" value="_s-xclick" type="hidden" />
  		<input name="hosted_button_id" value="JF6D2B66LJV7L" type="hidden" /> 
 			<input src="http://www.massage2ullc.com/images/btn_giftCC_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" type="image" width="140" />
		</form></div>
	</div>
	
		<p id="welcome_paragraph"><span class="m2uEm">Massage 2 U</span> is an outcall massage business serving Houston, TX and surrounding areas. 
		Our mobile massage therapists provide table massages at your home, hotel or business.  
		We also provide chair massage for corporate events, trade shows, employee wellness and private parties. 
		You choose your massage therapist, date and time. We have men and women therapists to accommodate our male and female clients.</p> 
		
		<div class="video">
		As Seen on Great Day Houston!<br /> 
<?php if (strpos($_SERVER['HTTP_USER_AGENT'],"Safari") || strpos($_SERVER['HTTP_USER_AGENT'],"Chrome")) { ?>
			<video width="320" height="240" src="images/greatdayhouston.m4v" controls="controls">
				<a href="images/greatdayhouston.m4v">Click here if you are unable to view.</a>
			</video>
<?php } else { ?>
			<object width="320" height="240" data="http://www.youtube.com/v/SHvq6s5KfMg?fs=1&amp;hl=en_US&amp;rel=0&amp;hd=1" type="application/x-shockwave-flash">
			<param name="movie" value="http://www.youtube.com/v/SHvq6s5KfMg?fs=1&amp;hl=en_US&amp;rel=0&amp;hd=1" />
			<param name="allowFullScreen" value="true" />
			<param name="allowscriptaccess" value="always" />
			<param name="flashvars" value="guid=mi8XL1TI&amp;javascriptid=video0" />
			<embed src="http://www.youtube.com/v/SHvq6s5KfMg?fs=1&amp;hl=en_US&amp;rel=0&amp;hd=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="320" height="240" />
			</object>
<?php } ?>
		</div>
		<div>
		<span class="st_facebook_button" displayText="Facebook"></span>
		<span class="st_twitter_button" displayText="Tweet"></span>
		<span class="st_email_button" displayText="Email"></span>
		</div>

		<p class="homeContent" style="background-color:#efefef; margin-right:100px;">The therapist of your choice may be in a session. Please allow 2 hours advanced notice. If you need a massage on short notice please call and we may be able to accommodate you. 24 hour advanced noticed will be needed for couples massage, tandem massage, <a href="chairmassage.php">corporate events, 
		and private parties</a>.</p>
		 
		<p class="homeContent" style="background-color:#fefefe; border:1px solid #779eb6; padding:10px; margin-top:5px; position:relative;">To book an appointment click <a href="appointments.php">Book Online</a> and enter your zip code. You can choose your therapist, date and time. You can also view the therapists online profile to learn more about them and the <a href="modalities.php">massage modalities</a> they are trained in.<br />
		<span style="display:block; position:relative;float:right; border:1px solid #9e7833; background-color:#efefef; padding:10px; box-shadow:1px 2px 2px #9e7833; -moz-box-shadow:1px 2px 2px #9e7833;	-webkit-box-shadow:1px 2px 2px #9e7833; font-weight:bold;">
		<a href="http://itunes.apple.com/app/massage2u-mobile-massage/id406830656?mt=8"<?php if($linkTrack) {echo " onClick=\"recordOutboundLink(this, 'iPhoneApp', 'itunes.apple.com');return false;\"";} ?>><img src="images/iphoneicon.png" alt="download our iPhone app" height="29" width="16" style="vertical-align:middle;" /></a>&nbsp;<a href="http://itunes.apple.com/app/massage2u-mobile-massage/id406830656?mt=8"<?php if($linkTrack) {echo " onClick=\"recordOutboundLink(this, 'iPhoneApp', 'itunes.apple.com');return false;\"";} ?>>Download</a> our iPhone App</span>
		<p style="clear:both;"></p>
		
		<p style="position:absolute; margin-top:-120px; margin-left:355px; width:100px;">
		<!-- begin Genbook badge -->
		<a href="appointments.php"><img src="images/bookonlinestar.png" width="100" height="100" alt="Make an Online Appointment" /></a>
		<!-- end Genbook badge -->
		</p>
<div style="clear:both;"></div>
<?php include_once("footer.inc"); ?>