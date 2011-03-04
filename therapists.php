<?php
require_once("register_globals.inc");
require_once("gen_db.inc");
require_once("functions.inc");
include_once("header.inc"); 

$db = new db;
$func = new functions;

$table="therapist";
$cols="firstname|||lastname|||therapist_image|||id";
$sort="lastname";
$count = mysql_fetch_object($db->generic("SELECT count(id) AS c FROM therapist"));
$therapists = $db->readAll($table,$cols,$sort);
$rows=$count->c/4;
$cc=1;
?>

<p id="rust_header">Therapists</p>
<p>
Massage2U's selection of therapists vary in experience and modalities.  
Please select a therapist that suits your needs.  
Click the therapist’s image to see their bio, availability, and to book an appointment.  
You can also click the Book Oline tab to view the schedule for all therapists.
<br /><br />
If you are booking an event and need multiple therapists you can call 888.308.8965.
<br /><br />
<?php
if ($count->c<1) {
	echo "This section is currently under constructions. To schedule an appointment please <a href=\"appointments.php\">click here</a>.<br />\n";
	echo "<br /><br /><br /><br /><br />\n";
	echo "<br /><br /><br /><br /><br />\n";
}  else { 

?>
<table width="" cellpadding="2" cellspacing="1" border="0" align="center" width="500">
<tr>
<?php
for($i=1;$i<=$count->c;$i++) {
	$therapist = mysql_fetch_object($therapists);
	$img_dir="therapist_images/";
	$img=$func->dispImageNewRatio($img_dir.$therapist->therapist_image,100);
?>
	<td align="center">
	<a href="therapistdetail.php?id=<?php echo $therapist->id ?>">
	<img src="<?php echo $img_dir.$therapist->therapist_image ?>" height="<?php echo $img['height']; ?>" width="<?php echo $img['width']; ?>" border="0" class="therapist-image" /><br />
	<span class="therapist-name"><?php echo $therapist->firstname ?> <?php echo $therapist->lastname ?>, LMT</span></a>
	</td>
<?php
	if ($cc>=4) {
		$cc=0;
		echo "</tr>\n<tr>";
	} // end if
	$cc++;
} // end if 
}// end if no therapists in table
?>
</tr>
</table>
<br /><br /><br /><br /><br />
<br /><br /><br /><br />
<?php include_once("footer.inc"); ?>