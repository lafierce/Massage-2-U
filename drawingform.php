<script language="text/javascript" src="calendar-picker.js" type="text/javascript"></script>
<link rel="stylesheet" href="calendar-style.css" type="text/css" />
<form name="drawings" method="post">
<input type="hidden" name="loc" value="<?php echo $loc ?>" />
<input type="hidden" name="action" value="<?php echo $action ?>" />
<input type="hidden" name="go" value="go" />
<input type="hidden" name="id" value="<?php echo $id ?>" />
<table width="700" border="1" style="border-collapse: collapse; border: 1px solid #1567ac;" cellpadding="4" cellspacing="0">
<tr>
	<td colspan="2" style="text-align: center;">Drawing</td>
</tr>
<tr>
	<td width="150" class="cell-label">Drawing Name</td>
	<td><input type="text" value="<?php echo $draw->drawing_name==""?"":$draw->drawing_name ?>" name="drawing_name" /></td>
</tr>
<tr>
	<td width="150" class="cell-label">Drawing Start Date<br /><span style="font-size: 8pt; color: #999999;">when entries begin</span></td>
	<td><input type="text" value="<?php echo $draw->drawing_start_date==""?"":$func->formatDate($draw->drawing_start_date,"convertout") ?>" name="drawing_start_date" /><input type="button" value="select date" onclick="displayDatePicker('drawing_start_date');"></td>
</tr>
<tr>
	<td width="150" class="cell-label">Drawing End Date<br /><span style="font-size: 8pt; color: #999999;">when drawing is held</span></td>
	<td><input type="text" value="<?php echo $draw->drawing_end_date==""?"":$func->formatDate($draw->drawing_end_date,"convertout") ?>" name="drawing_end_date" /><input type="button" value="select date" onclick="displayDatePicker('drawing_end_date');"></td>
</tr>
<tr>
	<td width="150" class="cell-label">Drawing Prizes</td>
	<td><input type="text" value="<?php echo $draw->prizes==""?"":$draw->prizes ?>" name="prizes" /></td>
</tr>
<tr>
	<td width="150" class="cell-label">Drawing Description</td>
	<td><textarea name="comments" rows="7" cols="25" class="therapist_input"><?php echo $draw->comments==""?"":$draw->comments ?></textarea
	</td>
</tr>
<tr>
	<td colspan="2" style="text-align: center;"><input type="submit" value="<?php echo $id!=""?"edit drawing":"submit drawing"; ?>" /></td>
</tr>
</table>

</form>

