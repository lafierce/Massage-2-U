<?php
// handle error reporting for debugging purposes
ini_set('display_errors',1); 
error_reporting(E_ALL ^ E_NOTICE);

// in case php server is running in safe mode 
//require_once("register_globals.inc");

// this handles the security via a session
//require_once("secure-session.inc");
//$sess = new secure_session;
session_start();

if (isset($sess)) {
	if ($sess->auth) {
		echo "logged in";
	} // if sess-auth
	$action="login";
	include("loginform.php");
} // end if sess=auth

$count=9;
$rc=$count/4;
$cc=1;
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<title>Foo.php</title>
	</head>
	<body>

<form action="foo.php" method="post">
<table cellpadding="2" cellspacing="1" border="1" align="center" width="500">
<tr>
<?php

for($i=1;$i<=$count;$i++) {
	echo "\t<td>box ".$i."</td>\n";
	if ($cc>=4) {
		$cc=0;
		echo "</tr>\n<tr>";
	} // end if
	$cc++;
} // end if 

?>
</tr>
</table>
<select name="test_select" onchange="alert(this.type);">
<option>1</option>
<option>2</option>
<option>3</option>
</select>
</form>

<pre>
<?php echo print_r($upload_file); ?>
</pre>
<pre>
<?php echo print_r($sess); ?>
</pre>
	</body>
</html>

