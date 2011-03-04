<?php include_once("header.inc"); 
include_once("functions.inc");
include_once("gen_db.inc");
$func = new functions;
$db = new db;
?>

<p id="rust_header" style="text-align: center;">Win a Free Massage and Other Prizes!</p>
<?php if ($func->getDrawings($db)) { echo "<h3 style=\"text-align: center;\">only ".$func->getDrawings($db)." days till the next drawing</h3>\n"; } ?>
<p style="text-align: center;"><span class="large_underline"><a href="http://www.massage2ullc.com">www.massage2ullc.com</a></span></p>

<p>Thank you for your interest in <a href="http://www.massage2ullc.com">Massage2U</a>.   <a href="http://visitor.constantcontact.com/manage/optin?v=0015de0J6wWFJ5pG8bP9Ihe9dCcPYJm7LCO">Click here</a> to enter to win a Free Massage and other prizes! The first massage drawing will be on Aug 1st 2010. There will also be monthly 
drawings for $25 Massage Gift Certificates.</p>

<h3>“We Come to You” - Now open for business!</h3>

<ul>
<li>Massage2U offers in ultimate in convenience at an affordable price. </li>
<li>You choose your massage therapist and view their available times.</li>
<li>Book your appointment online.</li>
<li>Make secure online payments with PayPal.  With PayPals buyer protection programs you are protected %100 against fraudulent charges and identity theft.</li>
<li>We can also provide massage therapists for private parties, corporate events, and couples massage</li>
<li>Perfect for bridal showers, bachelorette parties, and baby showers.</li>
<li>You can also give gift certificates in any amount.</li>
</ul>

<br /><br />
<div align="center"><input type="button" value="Enter Now" style="font-size: 16pt; border: solid 2px #3333aa; background-color: #efefef;" onclick="window.location='http://visitor.constantcontact.com/manage/optin?v=0015de0J6wWFJ5pG8bP9Ihe9dCcPYJm7LCO';" /></div>
<br /><br />

<p>You can visit us online at 
<a href="http://www.massage2ullc.com">www.massage2ullc.com</a> or call 888.308.8965</p>

<?php include_once("footer.inc"); ?>