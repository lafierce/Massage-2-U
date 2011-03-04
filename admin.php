<?php
// set up error reporting levels for troubleshooting purposes
ini_set('display_errors',1); 
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set("America/Chicago");

// in case php server is running in safe mode 
require_once("register_globals.inc");
require_once("functions.inc");

$func = new functions;

require_once("gen_db.inc");
$db = new db;

// this handles the security via a session
session_start();

/**
* check to see if we're logged in
* if not, display the login in form
* 
* 
**/

if ($_SESSION['logged_in']!=true) {
	include("header-admin.inc");
	include("loginform.php");
	include("footer-admin.inc");
	exit("not logged in.<br />".$uri);
} // end if logged in

if (!isset($action)) {
	include("header-admin.inc");
} // end if no action set or trying to login

if ($action=="logout") {
	$func->logout();
	include("header-admin.inc");
	$msg="You have been successfully logged out.<br /><br />\n";
	$msg.="To log in again <a href=\"admin.php?action=login\">click here</a>";
	include("successmsg.php");
	include("footer-admin.inc");
} // end if action==logout

if ($action=="login") {
	header("Location: therapist-admin.php");
} // end if action=login

if ($loc=="drawings") {
	if ($action=="new") {
		if ($go=="go") {
			// it inserts the drawing into the table or it gets the hose again
			$table="drawings";
			$drawing_end_date=$func->formatDate($drawing_end_date,"convertin");
			$drawing_start_date=$func->formatDate($drawing_start_date,"convertin");
			$cols="drawing_name|||drawing_end_date|||drawing_start_date|||prizes|||comments|||date_entered|||id";
			$vals=$drawing_name."|||".$drawing_end_date."|||".$drawing_start_date."|||".$prizes."|||".$comments."|||".date("Y-m-d")."|||null";
			if ($db->insert($table,$cols,$vals)) {
				include("header-admin.inc");
				$msg="New drawing successfully set up.";
				include("successmsg.php");
				include("footer-admin.inc");
			} // end if insert success
		} else {
			// show us the form .. 
			include("header-admin.inc");
			include("drawingform.php");
			include("footer-admin.inc");
		} // end if go==go
	} // end action=
	if ($action=="edit") {
		if ($go=="go") {
			$drawing_end_date=$func->formatDate($drawing_end_date,"convertin");
			$drawing_start_date=$func->formatDate($drawing_start_date,"convertin");
			$table="drawings";
			$cols="drawing_name|||drawing_end_date|||drawing_start_date|||prizes|||comments";
			$vals=$drawing_name."|||".$drawing_end_date."|||".$drawing_start_date."|||".$prizes."|||".$comments;
			$key="id";
			$keyval=$id;
			include("header-admin.inc");
			if ($db->update($table,$cols,$vals,$key,$keyval)) {
				$msg="Drawing successfully updated.";
				include("successmsg.php");
			} // end if edit successful
			include("footer-admin.inc");
		} else {
			$table="drawings";
			$cols="drawing_name|||drawing_end_date|||drawing_start_date|||prizes|||comments|||date_entered|||id";
			$key="id";
			$keyval=$id;
			include("header-admin.inc");
			if ($draw=$db->readOne($table,$cols,$key,$keyval)) {
				include("drawingform.php");
			} // end if there's a drawing with that id
			include("footer-admin.inc");
		} // end if go==go
	} // end action=
	if ($action=="view") {
		$table="drawings";
		$cols="drawing_name|||drawing_end_date|||drawing_start_date|||prizes|||comments|||date_entered|||id";
		$sort="drawing_start_date";
		include("header-admin.inc");
		if ($drawings=$db->readAll($table,$cols,$sort)) {
			include("drawings-view.php");
		} else {
			$msg="No drawings to view at this time.";
			include("errormsg.php");
		}// end if no drawings
		include("footer-admin.inc");
	} // end action=
	if ($action=="delete") {
		include("header-admin.inc");
		$table="drawings";
		$key="id";
		$keyval=$id;
		if ($db->delete($table,$key,$keyval)) {
			$msg="Drawing successfully deleted.";
			include("successmsg.php");
		} // end if delete was successful
		include("footer-admin.inc");
	} // end action=
} // end if loc=drawings

include_once("footer-admin.inc"); 

?>
