<table width="700" cellpadding="3" cellspacing="0" align="center" border="1" style="border-collapse: collapse;">
<tr>
	<td class="cell-header-small">&nbsp;</td>
	<td class="cell-header-small">name</td>
	<td class="cell-header-small">email</td>
	<td class="cell-header-small">phone</td>
	<td class="cell-header-small">license</td>
	<td class="cell-header-small">edit/delete</td>
</tr>
<?php

while ($therapist = mysql_fetch_object($therapists)) {
	$img_dir="therapist_images/";
	$img=$func->dispImageNewRatio($img_dir.$therapist->therapist_image,50);
?>
<tr>
	<td align="center" valign="middle"><img src="therapist_images/<?php echo $therapist->therapist_image ?>" height="50" width="<?php echo $img['width'] ?>" border="0" onClick="" /></td>
	<td><?php echo $therapist->lastname.", ".$therapist->firstname ?></td>
	<td style="font-size: 8pt;"><a href="mailto:<?php echo $therapist->email ?>"><?php echo $therapist->email ?></a></td>
	<td style="font-size: 8pt;"><?php echo $func->formatPhone($therapist->phone,"out") ?></td>
	<td style="font-size: 8pt;"><?php echo $therapist->license_num ?></td>
	<td style="font-size: 8pt;"><a href="therapist-admin.php?loc=edit&id=<?php echo $therapist->id ?>">edit</a>/<a href="therapist-admin.php?loc=delete_therapist&id=<?php echo $therapist->id ?>" onclick="return confirm('Click Yes to confirm delete of <?php echo $therapist->firstname." ".$therapist->lastname?>');">delete</a></td>
</tr>
<?php

} // end while therapist

?>
</table>