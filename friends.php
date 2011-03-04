<?php include_once("header.inc");
require_once("functions.inc");
require_once("gen_db.inc");
error_reporting(0);
$func = new functions;
$db = new db;

?>

<p id="rust_header">Our Friends</p>

<p style="font-size:1.15em; width:675px;">
<a href="http://www.getgrouby.com"<?php if($linkTrack) {echo " onClick=\"recordOutboundLink(this, 'Friends', 'getgrouby.com');return false;\"";} ?> target="_blank"><img src="images/getgroubygreen.jpg" alt="Get Grouby.com! www.getgroupby.com" style="float:left; padding:0 10px 5px 0;" /></a>
<a href="http://www.getgrouby.com"<?php if($linkTrack) {echo " onClick=\"recordOutboundLink(this, 'Friends', 'getgrouby.com');return false;\"";} ?> target="_blank">Get Grouby</a> offers a new daily deal on cool stuff to do, see, eat, and 
buy in Houston. By banding together to fight high prices, we all save money on the best stuff that our city 
has to offer. Power to the people!  Sign up to get 50-90% off massage, salons, spa treatments, restaurants, 
and other luxuries and personal services.  <a href="http://www.getgrouby.com"<?php if($linkTrack) {echo " onClick=\"recordOutboundLink(this, 'Friends', 'getgrouby.com');return false;\"";} ?> target="_blank">Get Grouby</a> is great for 
last minute gifts.  You get your voucher as soon as the deal is tipped.  Make sure to tell all your 
friends by email, facebook, and twitter to be sure your deal is tipped.
</p>

<div style="clear:both;">&nbsp;</div>

<p style="font-size:1.15em; width:625px; margin:auto;">
<a href="http://www.myfitfoods.com"<?php if($linkTrack) {echo " onClick=\"recordOutboundLink(this, 'Friends', 'myfitfoods.com');return false;\"";} ?> target="_blank"><img src="images/myfitfoods.jpg" alt="My Fit Foods" height="236" width="280" style="float:left; padding:0 10px 5px 0;" /></a>
<br /><br /><br /><br /><br />
Losing weight, feeling great and eating high quality nutritious meals with today's time pressed schedules can be overwhelming. 
<a href="http://www.myfitfoods.com"<?php if($linkTrack) {echo " onClick=\"recordOutboundLink(this, 'Friends', 'myfitfoods.com');return false;\"";} ?> target="_blank">MyFitFoods</a> is your solution to healthy meals to go that taste great. Say good-bye to hours of grocery shopping, cooking, 
dishes and frustration about how to eat healthy and say hello to a healthy high-energy lifestyle, made simple. 
<a href="http://www.myfitfoods.com"<?php if($linkTrack) {echo " onClick=\"recordOutboundLink(this, 'Friends', 'myfitfoods.com');return false;\"";} ?> target="_blank">MyFitFoods</a> provides fresh, healthy portioned meals that taste great. 
</p>



<?php include_once("footer.inc"); ?>