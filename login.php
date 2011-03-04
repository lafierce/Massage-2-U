<?php
// include required files for MySQL access and functions
require_once("register_globals.inc");
require_once("config.inc");
require_once("functions.inc");

$func = new functions;

// start up the ol' session
session_start();

// maybe they're already logged in ...
if ($_SESSION['logged_in']==true) {
	$func->redir($uri);
	print_r($_SESSION);
} else {
	// make sure the user actually submitted a user/pass combo
	if ( (!isset($_POST['username'])) || (!isset($_POST['password'])) ) {
		include("header.inc");
		include("loginform.php");
		include("footer.inc");
		exit("no form submitted");
	} // end if there was no username or password submitted
	
	// connect to the database
	// i've never used this function; let's see how it do
	$mysqli = @new mysqli(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	// let's just check on that connection
	if(mysqli_connect_errno()) { 
		printf("Unable to connect to database: %s", mysqli_connect_error());
		exit("db connect failure");
	} // end if connection is ok
	
	// remove any unsafe characters before sending to the db
	$username = $mysqli->real_escape_string($_POST['username']);
	$password = $mysqli->real_escape_string($_POST['password']);
	
	// construct appropriate SQL statement and send it on over
	$qry = "SELECT id,firstname,lastname,email,sec_level FROM user WHERE email=\"".$username."\" AND pass=PASSWORD(\"".$password."\")";
	$result = $mysqli->query($qry);
	
	// only one row should result
	if (is_object($result) && $result->num_rows==1) {
		//$func->set_login_session($result);
		$result=mysqli_fetch_object($result);
		$_SESSION['logged_in']=true;
		$_SESSION['disp_name']=$result->firstname." ".$result->lastname;
		$_SESSION['security_level']=$result->sec_level;
		$_SESSION['user_id']=$result->id;
		$func->redir($uri);
	}  else {
		// if more than one row is returned or no rows, send 'em back to login
		include("header.inc");
		include("loginform.php");
		include("footer.inc");
		exit("login failed; back user/pass or something else?");
	} // end if is object and only a single row
	
} // end if already logged in

?>