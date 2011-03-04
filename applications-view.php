<table width="850" align="center" cellpadding="2" cellspacing="0" border="1" style="border-collapse: collapse;">
<tr>
	<td class="cell-header-small">name</td>
	<td class="cell-header-small">email</td>
	<td class="cell-header-small">phone</td>
	<td class="cell-header-small">start date</td>
	<td class="cell-header-small">status</td>
	<td class="cell-header-small">date applied</td>
	<td class="cell-header-small">delete</td>
</tr>
<?php
while($application = mysql_fetch_object($applications)) {
?>
<tr>
	<td><a href="therapist-admin.php?loc=applications&action=detail&id=<?php echo $application->id ?>"><?php echo $application->lastname.", ".$application->firstname ?></a></td>
	<td style="font-size: smaller;"><a href="mailto:<?php echo $application->email ?>"><?php echo $application->email ?></a></td>
	<td style="font-size: smaller;"><?php echo $func->formatPhone($application->phone,"out"); ?></td>
	<td style="font-size: smaller;"><?php echo $func->formatDate($application->start_date,"out") ?></td>
	<td style="font-size: smaller;"><?php echo $func->dispVHR($application->hired,"Y|-|N|-|B|-|","Hired|-|Not Hired|-|New App","|-|") ?></td>
	<td style="font-size: smaller;"><?php echo $func->formatDate($application->app_date,"short") ?></td>
	<td style="font-size: smaller;"><a href="therapist-admin.php?loc=applications&action=detail&id=<?php echo $application->id ?>">view</a>/
	<a href="therapist-admin.php?loc=applications&action=delete_application&id=<?php echo $application->id ?>&w=<?php echo $w ?>" onclick="return confirm('Click Yes to confirm delete of <?php echo $application->firstname." ".$application->lastname ?>');">delete</a></td>
</tr>
<?php
} // end while
?>
</table>