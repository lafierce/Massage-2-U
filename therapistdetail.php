<?php 
session_start();
require_once("register_globals.inc");
require_once("gen_db.inc");
require_once("functions.inc");

$func = new functions;

$db = new db;

// check if there is a key set
if ((isset($id)) && ($id!="")) {
	$cols="firstname|||lastname|||street_address|||city|||state|||zip|||email|||phone|||phone_type|||alt_phone|||alt_phone_type|||mobile_network|||year_licensed|||therapist_image|||bio|||modalities|||last_updated|||google_voice|||gv_object|||gv_number|||id";
	$therapist=$db->readOne("therapist",$cols,"id",$id);
	$img_dir="therapist_images/";
	$img=$func->dispImageNewRatio($img_dir.$therapist->therapist_image,300);
} else {
	$msg="Whoops! Forgot to include the id. Please go back and try again.";
	include("errormsg.php");
	return false;
} // end if isset id

include_once("header.inc"); 

?>
	<div style="width:440px; float:left;">
	<img src="<?php echo $img_dir.$therapist->therapist_image ?>" height="<?php echo $img['height']; ?>" width="<?php echo $img['width']; ?>" alt="<?php echo $therapist->firstname." ".$therapist->lastname ?>, LMT" class="therapist-image" />
	</div>

	<div style="float:right; margin-top:35px; width:230px;">
	<?php echo $therapist->google_voice==1?$therapist->gv_object:"" ?>
	<?php if($is_mobile && ($therapist->gv_number!="")): ?>
	Call me: <a href="tel:<?php echo $func->formatPhone($therapist->gv_number,"out"); ?>"><?php echo $func->formatPhone($therapist->gv_number,"out"); ?></a>
	<?php endif; ?>
	</div>
	
	<div style="float:right; margin-top:75px; width:350px;">
		<form name="requestappointment" method="post" action="appointments.php" style="float:right;"> 
			<input type="submit" value="Check Availability / Schedule an Appointment" id="btn_chk_avail" />
		</form> 
	</div>

	<div style="float:left; margin-top:45px; margin-left:15px; width:50px;">
	<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.massage2ullc.com%2Ftherapistdetail.php%3Fid%3D<?php echo $therapist->id; ?>&amp;layout=button_count&amp;show_faces=true&amp;width=75&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:75px; height:21px;" allowTransparency="true"></iframe>
	</div>

	<div style="clear:both;"></div>
	
<p id="rust_header"><?php echo $therapist->firstname." ".$therapist->lastname ?>, LMT</p>
<p>
<?php echo $therapist->bio ?>
</p>
<br />
Year Licensed: <?php echo $therapist->year_licensed ?>
<br />
<br />
<table width="700" cellpadding="3" cellspacing="0" border="0">
<tr>
	<td valign="top">Modalities:</td>
	<td valign="top"><?php echo $func->dispModalities($therapist->modalities) ?></td>
</tr>
</table>


<?php
// if user is admin and is logged in, display the edit therapist link
if ($_SESSION['logged_in']) {
 ?>
<form action="therapist-admin.php" name="edit_therapist" method="post">
<input type="hidden" name="loc" value="edit" />
<input type="hidden" name="go" value="no" />
<input type="hidden" name="id" value="<?php echo $id ?>" />
<div style="text-align: right;"><input type="submit" value="edit therapist" /></div>
</form>
<?php 
} // end if logged in
include_once("footer.inc");
?>