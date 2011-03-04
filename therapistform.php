<?php
//
// first register all variables incase of PHP security settings
//
require("register_globals.inc");

//
// create an instance of the control class to handle various repetative form controls
//
require_once("controls.inc");
$control = new controls;

//
// create an instance of the db class for access later if needed
//
require_once("gen_db.inc");
$db= new db;

//
// instantiate the function class for use
// mostly this will be important if this form is used for editing
require_once("functions.inc");
$func = new functions;

$action="Add";

if((isset($id)) && ($id!="")) {
	$action="Update";
	$table="therapist";
	$cols="firstname|||lastname|||street_address|||city|||state|||zip|||email|||phone|||phone_type|||alt_phone|||alt_phone_type|||mobile_network|||year_licensed|||license_num|||therapist_image|||bio|||modalities|||last_updated|||google_voice|||gv_object|||gv_number|||id";
	$key="id";
	$keyval=$id;
	$therapist=$db->readOne($table,$cols,$key,$keyval);
	$therapist_image=$func->dispImageNewRatio("therapist_images/".$therapist->therapist_image,100);
} // end if isset id

?>
<script type="text/javascript" src="prototype.js"></script>
<script type="text/javascript" src="html-form-input-mask.js"></script>
<form name="therapistform" method="post" enctype="multipart/form-data" action="therapist-admin.php">
<input type="hidden" name="go" value="true" />
<input type="hidden" name="loc" value="<?php echo $loc ?>" />
<input type="hidden" name="id" value="<?php echo $therapist->id ?>" />
<div style="width:750px; margin:auto; font-size:8pt; font-weight:normal; text-align:right;">Last updated: <?php echo $func->formatDate($therapist->last_updated,"short_date_time"); ?></div>
<div style="clear:both; display:none;" id="checkzip"></div>
<table width="750" cellpadding="2" cellspacing="0" border="0" style="border: 1px solid silver;">
<tr>
	<td class="cell-label">Firstname: </td>
	<td><input type="text" name="firstname" value="<?php echo $therapist->firstname ?>" size="25" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">Lastname: </td>
	<td><input type="text" name="lastname" value="<?php echo $therapist->lastname ?>" size="25" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">Address: </td>
	<td><input type="text" name="street_address" value="<?php echo $therapist->street_address ?>" size="25" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">City: </td>
	<td><input type="text" name="city" value="<?php echo $therapist->city ?>" size="25" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">State: </td>
	<td><?php $control->ctrlStateSelect("state",$therapist->state); ?></td>
</tr>
<tr>
	<td class="cell-label">ZIP: </td>
	<td><input type="text" name="zip" value="<?php echo $therapist->zip ?>" size="6" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">Email: </td>
	<td><input type="text" name="email" value="<?php echo $therapist->email ?>" size="25" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">Phone:</td>
	<td><input type="text" name="phone" value="<?php echo $therapist->phone==""?"":$func->formatPhone($therapist->phone,"out") ?>" size="13" class="therapist_input input_mask mask_phone" onfocus="Xaprb.InputMask.setupElementMasks();" /></td>
</tr>
<tr>
	<td class="cell-label">Phone Type:</td>
	<td><select name="phone_type" class="therapist-select">
	<option value="">--select one--</option>
	<option value="mobile"<?php echo $func->chkSelect($therapist->phone_type,"mobile") ?>>mobile</option>
	<option value="landline"<?php echo $func->chkSelect($therapist->phone_type,"landline") ?>>land line</option>
	<option value="home"<?php echo $func->chkSelect($therapist->phone_type,"home") ?>>home</option>
	<option value="office"<?php echo $func->chkSelect($therapist->phone_type,"office") ?>>office</option>
	</select></td>
</tr>
<tr>
	<td class="cell-label" nowrap="nowrap">Alternate Phone:</td>
	<td><input type="text" name="alt_phone" value="<?php echo $therapist->alt_phone==""?"":$func->formatPhone($therapist->phone,"out") ?>" size="13" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">Alt. Phone Type:</td>
	<td><select name="alt_phone_type" class="therapist-select">
	<option value="">--select one--</option>
	<option value="mobile"<?php echo $func->chkSelect($therapist->alt_phone_type,"mobile") ?>>mobile</option>
	<option value="landline"<?php echo $func->chkSelect($therapist->alt_phone_type,"landline") ?>>land line</option>
	<option value="home"<?php echo $func->chkSelect($therapist->alt_phone_type,"home") ?>>home</option>
	<option value="office"<?php echo $func->chkSelect($therapist->alt_phone_type,"office") ?>>office</option>
	</select></td>
</tr>
<tr>
	<td class="cell-label">Year Licensed: </td>
	<td>
	<?php $control->ctrlYearsSelect("year_licensed",$therapist->year_licensed); ?>
	</td>
</tr>
<tr>
	<td class="cell-label">License Number: </td>
	<td><input type="text" name="license_num" size="25" value="<?php echo $therapist->license_num ?>" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">Photo: </td>
	<td><img src="therapist_images/<?php echo $therapist->therapist_image ?>" height="100" width="<?php echo $therapist_image['width']!=""?$therapist_image['width']:'80'; ?>" border="0" /><br />
	<input type="hidden" name="current_image" value="<?php echo $therapist->therapist_image ?>" /><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
	<input type="file" name="therapist_image" /></td>
</tr>
<tr>
	<td class="cell-label">Therapist Bio:</td>
	<td><textarea name="bio" rows="7" cols="25" class="therapist_input"><?php echo $therapist->bio ?></textarea></td>
</tr>
<tr>
	<td class="cell-label" valign="top">Modalities</td>
	<td><?php $control->ctrlModalitiesChkBox("modalities","disp",explode(" ",$therapist->modalities)); ?></td>
</tr>
<tr>
	<td class="cell-label" valign="top">Google Voice:<br />
		<span style="font-weight:normal; font-size:8pt;">
		<input type="radio" name="google_voice" value="1"<?php echo $therapist->google_voice==1?" checked=\"checked\"":"" ?> />Enabled<br />
		<input type="radio" name="google_voice" value="0"<?php echo $therapist->google_voice!=1?" checked=\"checked\"":"" ?> />Disabled
		</span>
	</td>
	<td style="padding-top:4px;">
	<label for="gv_object">Google Voice Widget Code</label>
	<textarea id="gv_object" name="gv_object"><?php echo $therapist->gv_object ?></textarea>
	<label for="gv_number">Google Voice Number</label>
	<input type="text" size="13" id="gv_number" name="gv_number" value="<?php echo $therapist->gv_number==""?"":$func->formatPhone($therapist->gv_number,"out"); ?>" />
	</td>
</tr>
<tr>
	<td class="cell-label"></td>
	<td></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="<?php echo $action ?> Therapist" /></td>
</tr>
</table></form>