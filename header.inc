<?php
// check for some mobile browsers;
// these users will get help with online booking
$ua = $_SERVER["HTTP_USER_AGENT"];
$mobile = Array("iPhone",
								"iPad",
								"iPod",
								"Blackberry",
								"Nexus",
								"Android",
								"IEMobile",
								"Kindle",
								"Droid",
								"Nokia",
								"Symbian");

$is_mobile = false;
for ($i=0;$i<count($mobile);$i++) {
	if (stristr($ua,$mobile[$i])!==false) {
		$mobile_type .= $mobile[$i];
		$is_mobile=true;
	}
}

// even if they're on a mobile browser we really only care
// if they've landed on appointments.php or servicearea.php
$sob_page = false;
if ((strstr($_SERVER['SCRIPT_NAME'],"servicearea.php")!="") || (strstr($_SERVER['SCRIPT_NAME'],"appointments.php")!="")) {$sob_page=true;}

// only provide the link tracking script
// if we're in the production environment
// this will keep erroneous data out of the
// GA system
$linkTrack = false;
if ((strstr($_SERVER['SCRIPT_NAME'],"/html/")=="") && (strstr($_SERVER['SCRIPT_NAME'],"/testsite/")=="")) {
	$linkTrack = true;
}

// detection for Therapists page to provide
// Facebook insight tags
$t_page=false;
if ((strstr($_SERVER['SCRIPT_NAME'],"therapistdetail.php") != "")) {$t_page=true;}

?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"
	xmlns:og="http://opengraphprotocol.org/schema/"
  xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<title>Outcall Massage | Chair Massage | Home Hotel Events | Houston, TX</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<?php if($is_mobile && $sob_page) {echo "<meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" />";} ?>
<meta name="Keywords" content="outcall massage houston texas,outcall hotel massage houston tx,outcall home massage houston texas,massage finder houston tx,massage at home houston texas,in hotel massage houston texas,in home massage houston texas,hotel massage houston texas,find a massage therapist houston tx,find a massage houston tx,outcall home massage,massage at home houston texas,in home massage houston tx,massage finder houston texas,find a massage therapist houston texas,outcall hotel massage houston tx,in hotel massage houston tx,hotel massage houston texas, mobile massage houston, chair massage houston" />
<meta name="Description" content="Massage2U is a mobile massage business providing outcall and chair massage in Houston, TX. We can come to your home, hotel or place of business. We all of Houston including The Heights, River Oaks, Bush Intercontinental and Hobby airports. You choose your massage therapist, date and time." />
<meta name="rating" content="General" />
<meta name="googlebot" content="index,follow" />
<meta name="google-site-verification" content="vBFY8WFQ2kyejJITv-mHjoyP4FAWYjOnw_xpIJIQG6Y" />
<meta name="ROBOTS" content="index,follow" />
<meta name="REVISIT-AFTER" content="10 days" />
<meta name="programmer" content="Joshua La Force - 832.928.9493 - www.laforce.com" />
<meta name="OWNER" content="Tom Zeppelin" />
<meta name="AUTHOR" content="Jonathan Poucher, Tom Zeppelin, Joshua La Force" />
<?php if($t_page): ?>
<meta property="og:title" content="<?php echo $therapist->firstname." ".$therapist->lastname ?>, LMT" />
<meta property="og:type" content="company" />
<meta property="og:url" content="http://www.massage2ullc.com/therapistdetail.php?id=<?php echo $therapist->id; ?>" />
<meta property="og:image" content="http://www.massage2ullc.com/therapist_images/<?php echo $therapist->therapist_image; ?>" />
<meta property="og:site_name" content="Massage 2 U" />
<meta property="og:locality" content="Houston"/>
<meta property="og:region" content="TX"/>
<meta property="og:country-name" content="USA"/>
<meta property="fb:admins" content="594589047,1170289923,1165994853" />
<meta property="fb:page_id" content="251175902322" />
<?php endif; ?>
<link rel="shortcut icon" href="http://www.massage2ullc.com/favicon.ico" />
<link rel="stylesheet" href="m2u-style-clean.css" />
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher:'49d2f8da-99d3-465b-a90f-da9ddd071fcd',tracking:'google'});</script>
<script src="m2u-script.js" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){$("p.menuList").hide();});
$(document).ready(function(){
	$("div.menuItem").click(function(){
		$("p.menuList").hide(); 
		$(this).find("p").fadeIn();
	});
	//$("p.menuList").mouseleave(function() {
	//	$(this).fadeOut();
	//});
});
$(document).ready(function(){
	$("#sms").hover(function(){$(this).css({"color":"#cccccc","text-decoration":"underline","cursor":"pointer"})},
	function(){$(this).css({"color":"inherit","text-decoration":"none","cursor":"default"})});
	$("#sms").click(function(){
		$("#popup").show().animate({height:343},"fast").animate({width:175},"fast");
	});
	$("#popup").mouseleave(function(){$("#popup").hide();});
});

<?php if ((strstr($_SERVER['SCRIPT_NAME'],"/html/")=="") && (strstr($_SERVER['SCRIPT_NAME'],"/testsite/")=="")) { ?>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-12276182-2']);
_gaq.push(['_trackPageview']);

(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

function recordOutboundLink(link, category, action) {
  try {
    //var myTracker=_gaq._getTrackerByName();
    _gaq.push(['_trackEvent', category, action]);
    setTimeout('document.location = "' + link.href + '"', 100)
  }catch(err){}
}

<?php } // end if server is test site. then don't do the google analytics ?>
</script>
</head>

<body>
<div id="container">
	<div id="header" style="border-bottom:10px solid #3b6e8f; background-color: #ffffff;"><!-- header begin -->
		<div style="float:left;">
			<div class="businessTitle">Massage 2 U</div>
			<div class="businessSubTitle">Outcall &amp; Chair Massage for Home Hotel &amp; Events</div>
		</div>
		<div style="position:relative; float:right; border-top:10px solid #ffffff;">
			<div class="menuItem"><span><a href="index.php">home</a></span></div>
			<div class="menuItem"><span><a href="#">about</a></span>
				<p class="menuList" id="about_us">
					<!--[if gte IE 6]>	<img src="" alt="" height="30" width="1" border="0" /><![endif]-->
					<span><a href="aboutus.php">About Us</a></span><span><a href="reviews.php">Reviews</a></span><span><a href="faq.php">FAQ</a></span><span><a href="friends.php">Our Friends</a></span><span><a href="application.php">Careers</a></span>
				</p>
			</div>
			<div class="menuItem"><span><a href="#">services</a></span>
				<p class="menuList" id="services">
				<!--[if gte IE 6]>	<img src="" alt="" height="30" width="1" border="0" /><![endif]-->
					<span><a href="servicearea.php">service area</a></span><span><a href="rates.php">rates/hours</a></span><span><a href="therapists.php">therapists</a></span><span><a href="chairmassage.php">chair massage</a></span><span><a href="appointments.php">book online</a></span>
				</p>
			</div>
			<div class="menuItem" style="width:118px;"><span><a href="therapists.php">therapists</a></span></div>
			<div class="menuItem bookOnline"><span class="bookOnlineText"><a href="appointments.php">book online</a></span></div>
		</div>
	</div><!-- header end -->
<div id="body"><!-- CONTENT DIV BEGIN -->

