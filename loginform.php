<br /><br /><br />
<form action="login.php" method="post" name="login-form">
<input type="hidden" name="action" value="<?php echo $action==""?"login":$action; ?>" />
<input type="hidden" name="go" value="yes" />
<input type="hidden" name="uri" value="<?php echo $_SERVER["SCRIPT_URI"]."?".$_SERVER['QUERY_STRING']; ?>" />
<table width="300" cellpadding="3" cellspacing="0" align="center" border="1" style="border-collapse: collapse;">
<tr>
	<td class="cell-label">User Name:</td>
	<td><input type="text" size="15" style="therapist_input" name="username" /></td>
</tr>
<tr>
	<td class="cell-label">Password:</td>
	<td><input type="password" size="15" style="therapist_input" name="password" /></td>
</tr>
<tr>
	<td colspan="2" align="right"><input type="submit" value="Login" /></td>
</tr>
</table>
</form>
<br /><br /><br />