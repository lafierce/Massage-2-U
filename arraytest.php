<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$mobile_domains = array ( $alltel = array("com"=>"Alltel","dom"=>"message.alltel.com"),
$att = array("com"=>"AT&T","dom"=>"mms.att.net"),
$attold = array("com"=>"AT&T (formerly Cingular)","dom"=>"txt.att.net"),
$cingular = array("com"=>"Cingular","dom"=>"cingularme.com"),
$boostmobile = array("com"=>"Boost Mobile","dom"=>"myboostmobile.com"),
$nextel = array("com"=>"Nextel (now Sprint Nextel)","dom"=>"messaging.nextel.com"),
$sprintpcs = array("com"=>"Sprint PCS (now Sprint Nextel)","dom"=>"messaging.sprintpcs.com"),
$tmobile = array("com"=>"T-Mobile","dom"=>"tmomail.net"),
$uscellular = array("com"=>"US Cellular","dom"=>"email.uscc.net"),
$verizon = array("com"=>"Verizon","dom"=>"vtext.com"),
$virgin = array("com"=>"Virgin Mobile USA","dom"=>"vmobl.com"),
$sevenelevenspeakout = array("com"=>"7-11 Speakout (USA GSM)","dom"=>"cingularme.com"),
$airtel = array("com"=>"Airtel Wireless (Montana, USA)","dom"=>"sms.airtelmontana.com"),
$alaskacom = array("com"=>"Alaska Communications Systems","dom"=>"msg.acsalaska.com"),
$illinoisvalley = array("com"=>"Illinois Valley Cellular","dom"=>"ivctext.com"),
$nextel = array("com"=>"Nextel (United States)","dom"=>"messaging.nextel.com"),
$mobipcs = array("com"=>"MobiPCS (Hawaii only)","dom"=>"mobipcs.net"),
$metropcs = array("com"=>"MetroPCS","dom"=>"mymetropcs.com"),
$qwest = array("com"=>"Qwest","dom"=>"qwestmp.com"),
$cellularone = array("com"=>"Cellular One (Dobson)","dom"=>"mobile.celloneusa.com"),
$attpaging = array("com"=>"AT&T Enterprise Paging","dom"=>"page.att.net"),
$cingularpostpaid = array("com"=>"Cingular (Postpaid)","dom"=>"cingularme.com"),
$helio = array("com"=>"Helio","dom"=>"myhelio.com"),
$centennial = array("com"=>"Centennial (USA)","dom"=>"cwemail.com")
);


?>
<pre>
<?php echo print_r($mobile_domains); ?>
</pre>
<br /><br /><br />

<select name="mobile_network">
<?php
foreach($mobile_domains as $mdom) {
	echo "\t<option value=\"".$mdom[dom]."\">".$mdom[com]."</option>\n";
}
?>
</select>
