<?php
// set up error reporting levels for troubleshooting purposes
ini_set('display_errors',1); 
error_reporting(E_ALL ^ E_NOTICE);

require_once("register_globals.inc");
//
// create an instance of the control class to handle various repetitive form controls
//
require_once("controls.inc");
$control = new controls;

require_once("gen_db.inc");
$db = new db;

require_once("functions.inc");
$func = new functions;
$sep = "|-|";

$table = "applicant";
$cols = "firstname|||lastname|||street_address|||city|||state|||zip|||email|||phone|||gps|||sms|||dob|||position|||position_other|||legal_worker|||felony|||felony_explain|||start_date|||special_skills|||license|||license_state|||license_num|||years_experience|||own_table|||own_chair|||tx_liability|||availability|||education|||education_other|||refs|||emp_history|||id|||hired|||date_hired|||modified_by|||app_date";
$key = "id";
$keyval = $id;
$applicant = $db->readOne($table,$cols,$key,$keyval);
?>
<script language="javascript" type="text/javascript" src="prototype.js"></script>
<script language="javascript" type="text/javascript" src="html-form-input-mask.js"></script>
<table width="600" cellpadding="2" cellspacing="3" border="0" style="border: 1px solid silver;">
<tr>
	<td colspan="2" style="text-align: right; font-size: 8pt;">date applied: <?php echo $func->formatDate($applicant->app_date,"out") ?>&nbsp;&nbsp;</td>
</tr>
<tr>
	<td class="cell-label">Position:</td>
	<td><?php echo $func->dispVHR($applicant->position,"T|-|O","Therapist|-|Other",$sep)."&nbsp;&nbsp;".$applicant->position_other ?></td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label">Name</td>
	<td><?php echo $applicant->firstname."&nbsp;".$applicant->lastname ?></td>
</tr>
<tr>
	<td class="cell-label">Address</td>
	<td><?php echo $applicant->street_address ?></td>
</tr>
<tr>
	<td class="cell-label">&nbsp;</td>
	<td><?php echo $applicant->city.", ".$control->ctrlStateSelect("",$applicant->state)."&nbsp;".$applicant->zip ?></td>
</tr>
<tr>
	<td class="cell-label">Email</td>
	<td><a href="mailto:<?php echo $applicant->email ?>"><?php echo $applicant->email ?></a></td>
</tr>
<tr>
	<td class="cell-label">Phone</td>
	<td><?php echo $func->formatPhone($applicant->phone,"out") ?></td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label">GPS capability?</td> 
	<td><?php echo $func->dispVHR($applicant->gps,"Y|-|N","Yes|-|No",$sep) ?></td>
</tr>
<tr>
	<td class="cell-label">SMS capability?</td>
	<td><?php echo $func->dispVHR($applicant->sms,"Y|-|N","Yes|-|No",$sep) ?></td>
</tr>
<tr>
	<td class="cell-label">Date of Birth?</td>
	<td><?php echo $func->formatDate($applicant->dob,"out") ?></td>
</tr>
<tr>
	<td class="cell-label">Legally authorized to work in the U.S.?</td>
	<td><?php echo $func->dispVHR($applicant->legal_worker,"Y|-|N","Yes|-|No",$sep) ?></td>
</tr>
<tr>
	<td class="cell-label">Felon?</td>
	<td><?php echo $func->dispVHR($applicant->felony,"Y|-|N","Yes|-|No",$sep) ?></td>
</tr>
<tr>
	<td colspan="2"><?php echo $applicant->felony_explain ?></td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label">Start Date</td>
	<td><?php echo $func->formatDate($applicant->start_date,"out") ?></td>
</tr>
<tr>
	<td class="cell-label" colspan="2">Special skills:<br />
	<span style="font-weight: normal;"><?php echo $applicant->special_skills ?></span></td>
</tr>
<tr>
	<td class="cell-label" colspan="2"><?php echo $applicant->license=="N"?"Not licensed":"License Info:&nbsp;<span style=\"font-weight: normal;\">".$applicant->license_state."&nbsp;".$applicant->license_num ?></span></td>
</tr>
<tr>
	<td class="cell-label">Years experience</td>
	<td><?php echo $applicant->years_experience ?></td>
</tr>
<tr>
	<td class="cell-label">Own a massage table:</td>
	<td><?php echo $func->dispVHR($applicant->own_table,"Y|-|N","Yes|-|No",$sep) ?></td>
</tr>
<tr>
	<td class="cell-label">Do you own a massage chair:</td>
	<td><?php echo $func->dispVHR($applicant->own_chair,"Y|-|N","Yes|-|No",$sep) ?></td>
</tr>
<tr>
	<td class="cell-label">Texas Liability Insurance:</td>
	<td><?php echo $func->dispVHR($applicant->tx_liability,"Y|-|N","Yes|-|No",$sep) ?></td>
</tr>
<tr>
	<td class="cell-label">Availability:</td>
	<td><?php echo $func->dispVHR($applicant->availability,"P|-|F","Part-time|-|Full-time",$sep) ?></td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label" colspan="2">Education:&nbsp;<?php echo $func->dispVHR($applicant->education,"H|-|C|-|G|-|T|-|O","High School|-|College|-|Graduate School|-|Technical School|-|Other",$sep) ?><br />
	<?php echo $applicant->education_other ?></td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label" colspan="2">Previous Employment<br />
	<?php echo $func->parseEmploymentHistory($applicant->emp_history,":::","|-|") ?>
	</td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label" colspan="2">References:<br />
	<span style="font-weight: normal;"><?php echo $func->parseReferences($applicant->refs,":::","|-|") ?></span></td>
</tr>
<tr>
	<td colspan="2" align="center">
	<form method="post" action="therapist-admin.php">
<input type="hidden" name="loc" value="<?php echo $loc ?>" />
<input type="hidden" name="action" value="hire" />
<input type="hidden" name="hired" value="Y" />
<input type="hidden" name="id" value="<?php echo $applicant->id ?>" />
	<input type="submit" value="Hire Applicant" />
	</form>
		<form method="post" action="therapist-admin.php">
<input type="hidden" name="loc" value="<?php echo $loc ?>" />
<input type="hidden" name="action" value="hire" />
<input type="hidden" name="hired" value="N" />
<input type="hidden" name="id" value="<?php echo $applicant->id ?>" />
	<input type="submit" value="Do NOT Hire Applicant" />
	</form>
	</td>
</tr>

</table>