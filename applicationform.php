<?php

//
// create an instance of the control class to handle various repetitive form controls
//
require_once("controls.inc");
$control = new controls;

?>
<br />
<form name="applicationform" method="post" enctype="multipart/form-data" action="application.php" onsubmit="return chkApplicationForm();">
<input type="hidden" name="go" value="go" />
<input type="hidden" name="action" value="apply" />
<table width="600" cellpadding="2" cellspacing="3" border="0" style="border: 1px solid silver;">
<tr>
	<td colspan="2" class="cell-label"><span class="app_question">What position are you applying for?</span><br />
	<input type="radio" name="position" value="T" class="therapist_input" />Therapist&nbsp;
	<input type="radio" name="position" value="O" class="therapist_input" />Other&nbsp;
	<span class="small-bold-text">if other please explain: </span>
	<input type="text" name="other_position" class="therapist_input" /></td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label">First Name</td>
	<td><input type="text" name="firstname" value="" size="25" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">Last Name</td>
	<td><input type="text" name="lastname" value="" size="25" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">Address</td>
	<td><input type="text" name="street_address" value="" size="25" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">City</td>
	<td><input type="text" name="city" value="" size="25" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">State</td>
	<td><?php $control->ctrlStateSelect("state",""); ?></td>
</tr>
<tr>
	<td class="cell-label">ZIP</td>
	<td><input type="text" name="zip" value="" size="6" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">Email</td>
	<td><input type="text" name="email" value="" size="25" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">Phone</td>
	<td><input type="text" name="phone" value="" size="13" class="therapist_input input_mask mask_phone" onfocus="Xaprb.InputMask.setupElementMasks()" />&nbsp;(___) ___-___</td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label" colspan="2">Do you have a mobile phone with GPS capability?<br />
	<input type="radio" name="gps" value="Y" class="therapist_input" />Yes&nbsp;
	<input type="radio" name="gps" value="N" class="therapist_input" />No</td>
</tr>
<tr>
	<td class="cell-label" colspan="2">Do you have a mobile phone with Text Message or SMS capability?<br />
	<input type="radio" name="sms" value="Y" class="therapist_input" />Yes&nbsp;
	<input type="radio" name="sms" value="N" class="therapist_input" />No</td>
</tr>
<tr>
	<td class="cell-label">What is your date of birth?</td>
	<td><?php $control->ctrlMonthSelect("dob_month","") ?>&nbsp;<?php $control->ctrlDateSelect("dob_day","foo") ?>&nbsp;<?php $control->ctrlYearsSelect("dob_year","baz") ?></td>
</tr>
<tr>
	<td class="cell-label" colspan="2">Are you legally authorized to work in the U.S.?
	<input type="radio" name="legal_worker" value="Y" class="therapist_input" />Yes&nbsp;
	<input type="radio" name="legal_worker" value="N" class="therapist_input" />No</td>
</tr>
<tr>
	<td class="cell-label" colspan="2">Have you ever been convicted of a felony?
	<input type="radio" name="felony" value="Y" class="therapist_input" />Yes&nbsp;
	<input type="radio" name="felony" value="N" class="therapist_input" />No<br />
	<span class="small-bold-text">if yes, please explain:</span>
	<input type="text" name="felony_explain" value="" size="45" class="therapist_input" /></td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label">When can you start work?</td>
	<td><?php $control->ctrlMonthSelect("start_date_month","") ?>&nbsp;<?php $control->ctrlDateSelect("start_date_day","foo") ?>&nbsp;<?php $control->ctrlStartDateYearsSelect("start_date_year","baz") ?></td>
</tr>
<tr>
	<td class="cell-label" colspan="2">Do you have any special skills?<br />
	<input type="text" name="special_skills" value="" size="45" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label" colspan="2">Are you a licensed massage therapist?
	<input type="radio" name="license" value="Y" class="therapist_input" />Yes&nbsp;
	<input type="radio" name="license" value="N" class="therapist_input" />No<br />
	<span class="small-bold-text">In which State?</span><?php $control->ctrlStateSelect("license_state","") ?>
	&nbsp;<span class="small-bold-text">License Number:</span><input type="text" name="license_num" value="" size="15" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label">Years experience</td>
	<td><input type="text" name="years_experience" value="" size="4" class="therapist_input" /></td>
</tr>
<tr>
	<td class="cell-label" colspan="2">Do you own a massage table?
	<input type="radio" name="own_table" value="Y" class="therapist_input" />Yes&nbsp;
	<input type="radio" name="own_table" value="N" class="therapist_input" />No
</td>
</tr>
<tr>
	<td class="cell-label" colspan="2">Do you own a massage chair?
	<input type="radio" name="own_chair" value="Y" class="therapist_input" />Yes&nbsp;
	<input type="radio" name="own_chair" value="N" class="therapist_input" />No
	</td>
</tr>
<tr>
	<td class="cell-label" colspan="2">Do you have liability insurance in the state of Texas?
	<input type="radio" name="tx_liability" value="Y" class="therapist_input" />Yes&nbsp;
	<input type="radio" name="tx_liability" value="N" class="therapist_input" />No
	</td>
</tr>
<tr>
	<td class="cell-label" colspan="2">Availability
	<input type="radio" name="availability" value="P" class="therapist_input" />Part Time&nbsp;
	<input type="radio" name="availability" value="F" class="therapist_input" />Full Time
	</td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label" colspan="2">Education
	<input type="radio" name="education" value="H" class="therapist_input" />High School&nbsp;
	<input type="radio" name="education" value="C" class="therapist_input" />College&nbsp;
	<input type="radio" name="education" value="G" class="therapist_input" />Grad School&nbsp;
	<input type="radio" name="education" value="T" class="therapist_input" />Trade School&nbsp;<br />
	<input type="radio" name="education" value="O" class="therapist_input" />Other&nbsp;
	<input type="text" name="education_other" value="" size="25" class="therapist_input" /></td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label" colspan="2">Previous Employment <span style="font-size: small;">(most recent first)</span><br />
	<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign="top" width="33%" style="border-right: 1px silver solid">
		<table width="100%" cellpadding="2" cellspacing="0" border="0">
		<tr>
		<td style="font-size: 8pt;">Employer:</td>
		<td><input type="text" name="emp_name1" value="" size="15" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Address:</td>
		<td><input type="text" name="emp_addr1" value="" size="20" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Phone:</td>
		<td><input type="text" name="emp_phone1" value="" size="10" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Position:</td>
		<td><input type="text" name="emp_position1" value="" size="15" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Start Date:</td>
		<td><input type="text" name="emp_start1" value="" size="10" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">End Date:</td>
		<td><input type="text" name="emp_end1" value="" size="10" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;" colspan="2">Reason for leaving:<br />
		<input type="text" name="emp_reason1" value="" size="25" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		</table>
		</td>
		<td valign="top" width="33%" style="border-right: 1px silver solid">
		<table width="100%" cellpadding="2" cellspacing="0" border="0">
		<tr>
		<td style="font-size: 8pt;">Employer:</td>
		<td><input type="text" name="emp_name2" value="" size="15" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Address:</td>
		<td><input type="text" name="emp_addr2" value="" size="20" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Phone:</td>
		<td><input type="text" name="emp_phone2" value="" size="10" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Position:</td>
		<td><input type="text" name="emp_position2" value="" size="15" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Start Date:</td>
		<td><input type="text" name="emp_start2" value="" size="10" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">End Date:</td>
		<td><input type="text" name="emp_end2" value="" size="10" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;" colspan="2">Reason for leaving:<br />
		<input type="text" name="emp_reason2" value="" size="25" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		</table>		
		</td>
		<td valign="top" width="33%">
		<table width="100%" cellpadding="2" cellspacing="0" border="0">
		<tr>
		<td style="font-size: 8pt;">Employer:</td>
		<td><input type="text" name="emp_name3" value="" size="15" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Address:</td>
		<td><input type="text" name="emp_addr3" value="" size="20" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Phone:</td>
		<td><input type="text" name="emp_phone3" value="" size="10" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Position:</td>
		<td><input type="text" name="emp_position3" value="" size="15" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">Start Date:</td>
		<td><input type="text" name="emp_start3" value="" size="10" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;">End Date:</td>
		<td><input type="text" name="emp_end3" value="" size="10" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		<tr>
		<td style="font-size: 8pt;" colspan="2">Reason for leaving:<br />
		<input type="text" name="emp_reason3" value="" size="25" class="therapist_input" style="font-size: 8pt;" /></td>
		</tr>
		</table>
		</td>
	</tr>
	</table>
	</td>
</tr>
<tr><td colspan="2"><hr noshade="noshade" size="1" /></td></tr>
<tr>
	<td class="cell-label" colspan="2">References
	<table width="100%" border="0" cellpadding="2" cellspacing="0">
	<tr>
		<td><span class="small-bold-text">Name:</span>
		<input type="text" name="ref_name_01" value="" class="therapist_input" /></td>
		<td><span class="small-bold-text">Phone:</span>
		<input type="text" name="ref_phone_01" value="" size="13" class="therapist_input" /></td>
		<td><span class="small-bold-text">Email:</span>
		<input type="text" name="ref_email_01" value="" class="therapist_input" /></td>
	</tr>
	<tr>
		<td><span class="small-bold-text">Name:</span>
		<input type="text" name="ref_name_02" value="" class="therapist_input" /></td>
		<td><span class="small-bold-text">Phone:</span>
		<input type="text" name="ref_phone_02" value="" size="13" class="therapist_input" /></td>
		<td><span class="small-bold-text">Email:</span>
		<input type="text" name="ref_email_02" value="" class="therapist_input" /></td>
	</tr>
	<tr>
		<td><span class="small-bold-text">Name:</span>
		<input type="text" name="ref_name_03" value="" class="therapist_input" /></td>
		<td><span class="small-bold-text">Phone:</span>
		<input type="text" name="ref_phone_03" value="" size="13" class="therapist_input" /></td>
		<td><span class="small-bold-text">Email:</span>
		<input type="text" name="ref_email_03" value="" class="therapist_input" /></td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="Submit Application" /></td>
</tr>
</table>
</form>
<!-- 

-->