<table width="700" align="center" cellpadding="2" cellspacing="0" border="1" style="border-collapse: collapse;">
<tr>
	<td class="cell-header-small" width="250">Drawing</td>
	<td class="cell-header-small">Start</td>
	<td class="cell-header-small">Drawing</td>
	<td class="cell-header-small">edit/delete</td>
</tr>
<tr>
<?php
while ($drawing=mysql_fetch_object($drawings)) {
?>
<tr>
	<td style="font-size: 8pt; font-weight: bold;" width="250"><?php echo $drawing->drawing_name ?></td>
	<td style="font-size: 8pt;"><?php echo $func->formatDate($drawing->drawing_start_date,"out") ?></td>	
	<td style="font-size: 8pt;"><?php echo $func->formatDate($drawing->drawing_end_date,"out") ?></td>
	<td style="font-size: 8pt; text-align: center;"><a href="admin.php?loc=drawings&action=edit&id=<?php echo $drawing->id ?>">edit</a>&nbsp;/&nbsp;<a href="admin.php?loc=drawings&action=delete&id=<?php echo $drawing->id ?>" onclick="return confirm('Are you sure you want to delete this drawing?');">delete</a></td>
</tr>
<?php
} // end while
?>
</tr>
</table>