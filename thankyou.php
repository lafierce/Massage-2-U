<?php include_once("header.inc"); 
require_once("functions.inc");
require_once("gen_db.inc");
error_reporting(0);
$func = new functions;
$db = new db;
?>
<p id="rust_header">Thank You</p>
<br /><br />
<?php 
$msg="Thank you for booking an appointment.";
include("successmsg.php");
?>
<br /><br /><br />
<p>Please sign up for our newsletter to always keep in touch and to be eligible for promotions and prize drawings!</p>

<br /><br /><br /><br />
<!-- Google Code for Sale Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1024775777;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "DLDuCJPe2gEQ4azT6AM";
var google_conversion_value = 0;
if (32) {
  google_conversion_value = 32;
}
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1024775777/?value=32&amp;label=DLDuCJPe2gEQ4azT6AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- End Google Code for Sale Conversion Page -->
<?php include_once("footer.inc"); ?>