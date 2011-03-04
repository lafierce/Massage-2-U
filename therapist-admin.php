<?php 
ini_set('display_errors',1); 
error_reporting(E_ALL ^ E_NOTICE);
/*************************************
* $Id: therapis-admin.php v 1.0 2010/03/15 03:41:18 jlf Exp $
*
*
*************************************/
require_once("register_globals.inc");
session_start();

/************************************
* here we instantiate the functions class
* which now contains methods and 
* various global functions.
* 
************************************/
require_once("functions.inc");
$func = new functions;

require_once("gen_db.inc");
$db = new db;

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

include("header-admin.inc");

if (!isset($loc) || $loc=="") {
	echo "loc=blank";
	print_r($_POST);
} // if $loc is not set

if ($loc=="add_therapist") {
	if ($go=="true") {
	// the form has been submitted; do something about it
		if ($func->fileUpload("therapist_image","/therapist_images/",$lastname.$firstname)) {
			// file was uploaded successfully  ... please complete insert into database
			$table="therapist";
			$therapist_image=$lastname.$firstname.".".substr($_FILES['therapist_image']['name'], strrpos($_FILES['therapist_image']['name'],'.') +1);
			$last_updated=date("Y-m-d H:i:s");
			$cols="firstname|||lastname|||street_address|||city|||state|||zip|||email|||phone|||phone_type|||alt_phone|||alt_phone_type|||mobile_network|||year_licensed|||license_num|||therapist_image|||bio|||modalities|||last_updated|||google_voice|||gv_object|||gv_number|||id";
			$vals=$firstname."|||".$lastname."|||".$street_address."|||".$city."|||".$state."|||".$zip."|||".$email."|||".$func->formatPhone($phone,"in")."|||".$phone_type."|||".$func->formatPhone($alt_phone,"in")."|||".$alt_phone_type."|||".$mobile_network."|||".$year_licensed."|||".$license_num."|||".$therapist_image."|||".$bio."|||".implode(" ",$modalities)."|||".$last_updated."|||".$google_voice."|||".$gv_object."|||".$func->formatPhone($gv_number,"in")."NULL";
			if($db->insert($table,$cols,$vals)) {
				$qry="SELECT id FROM massage2u.therapist WHERE email=\"".$email."\"";
				$therapist = $db->readOne($table,"id","email",$email);
				$link="therapistdetail.php?id=".$therapist->id;
				$msg="New Therapist successfully added.<br />\n";
				$msg.="To view the new entry <a href=\"".$link."\">click here</a>";
				include("successmsg.php");
			} // end if db insert successful
			
		} // end file upload
		
	} else {
	// no form has been submitted. display it
		include("therapistform.php");
		echo "loc=add_therapist & go!=go";
	} // if go = yes
} // and if $loc is add_therapist

if ($loc=="edit") {
	if ($go=="true") {
		// the form has been submitted; do stuff
		if ((is_array($_FILES)) && ($_FILES["therapist_image"]["name"]!="")) { 
			$func->fileUpload("therapist_image","/therapist_images/",$lastname.$firstname);
			$therapist_image=$lastname.$firstname.".".substr($_FILES['therapist_image']['name'], strrpos($_FILES['therapist_image']['name'],'.') +1);
		} else {
			$therapist_image = $current_image;
		} // end if there is image	
		$last_updated=date("Y-m-d H:i:s");
		$cols="firstname|||lastname|||street_address|||city|||state|||zip|||email|||phone|||phone_type|||alt_phone|||alt_phone_type|||mobile_network|||year_licensed|||license_num|||therapist_image|||bio|||modalities|||last_updated|||google_voice|||gv_object|||gv_number";
		$vals=$firstname."|||".$lastname."|||".$street_address."|||".$city."|||".$state."|||".$zip."|||".$email."|||".$func->formatPhone($phone,"in")."|||".$phone_type."|||".$func->formatPhone($alt_phone,"in")."|||".$alt_phone_type."|||".$mobile_network."|||".$year_licensed."|||".$license_num."|||".$therapist_image."|||".$bio."|||".implode(" ",$modalities)."|||".$last_updated."|||".$google_voice."|||".$gv_object."|||".$func->formatPhone($gv_number,"in");
		$table="therapist";
		$key="id";
		$keyval=$id;
		
		if($db->update($table,$cols,$vals,$key,$keyval)) {
			$msg="Record for ".$firstname." ".$lastname." successfully updated<br />\n";
			$msg.="<br />\n";
			include("successmsg.php");
		} // end if db->udpate
			
	} else {
		// no form has been submitted; fetch the data and display the form
		include("therapistform.php");
	} // end if go=true
} // end if $loc = edit_therapist

if ($loc=="delete_therapist") {
	$table="therapist";
	$cols="firstname|||lastname";
	$key="id";
	$keyval=$id;
	$therapist=$db->readOne($table,$cols,$key,$keyval);
	if ($db->delete($table,$key,$keyval)) {
		$msg="Successfully deleted therapist profile for ".$therapist->firstname." ".$therapist->lastname;
		include("successmsg.php");
		$cols="firstname|||lastname|||email|||license_num|||phone|||therapist_image|||id";
		if($therapists = $db->readAll("therapist",$cols,"lastname")) {
			include("therapist-all.php");
		} // end if query successful
	} // end if db->delete successful
} // end if loc=delete_therapist

if ($loc=="view_all") {
	// display all the records in the therapist database
	$cols="firstname|||lastname|||email|||license_num|||phone|||therapist_image|||id";
	$therapists = $db->readAll("therapist",$cols,"lastname");
	include("therapist-all.php");
} // end if loc=view_all

if ($loc=="search") {
	echo "loc=".$loc;
} // end if $loc=search

if ($loc=="send_msg") {
	$msg="This action is not currently available.";
	include("successmsg.php");
} // end if loc=send_msg

if ($loc=="applications") {
	if ($action=="hire") {
		$table="applicant";
		$cols="hired|||modified_by";
		$vals=$hired."|||".$_SESSION['user_id'];
		$key="id";
		$keyval=$id;
		if ($db->update($table,$cols,$vals,$key,$keyval)) {
			$msg="You have successfully update the record.";
			include("successmsg.php");
		} // end if db update successful
	} // end if action=hire
		
 	if ($action=="view") {
		switch ($w) {
			case "new":
				$qry="SELECT firstname,lastname,email,phone,start_date,id,hired,app_date FROM applicant WHERE hired=\"B\" ORDER BY lastname";
				break;
			case "hired":
				$qry="SELECT firstname,lastname,email,phone,start_date,id,hired,app_date FROM applicant WHERE hired=\"Y\" ORDER BY lastname";
				break;	
			case "not_hired":
				$qry="SELECT firstname,lastname,email,phone,start_date,id,hired,app_date FROM applicant WHERE hired=\"N\" ORDER BY lastname";
				break;			
			case "all":
				$qry="SELECT firstname,lastname,email,phone,start_date,id,hired,app_date FROM applicant ORDER BY lastname";
				break;
		} // end switch $w
		
		if($applications=$db->generic($qry)) {
			include("applications-view.php");
		} // end if query successful
	} // end view applications
	
	if($action=="detail") {
		
		include("applicant-detail.php");
	} // end if action=detail (view application details
	
	if ($action=="delete_application") {
		$table="applicant";
		$cols="firstname|||lastname";
		$key="id";
		$keyval=$id;
		$applicant=$db->readOne($table,$cols,$key,$keyval);
		if ($db->delete($table,$key,$keyval)) {
			$msg="Successfully deleted application for ".$applicant->firstname." ".$applicant->lastname;
			include("successmsg.php");
			$qry=$func->getApplicationViewQry($w);
			if($applications=$db->generic($qry)) {
				include("applications-view.php");
			} // end if query successful
		} // end if db->delete successful
	} // end if action==delete
	
	if ($action=="manual") {
		include("applicationform.php");
	} // end if action==manual
	if ($action=="search") {
		$msg="This action is not currently available.";
		include("successmsg.php");
	} // end if action=search
	
} // end if loc =applications

include_once("footer-admin.inc");

?>
