<?php
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 - 2010 Joshua La Force                            |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Author: Joshua La Force <josh@laforce.com                            |
// +----------------------------------------------------------------------+
//
// $Id: application.php v 1.0 2010/02/15 03:41:18 jlf Exp $

/**
*
*
* @file applicaiton.php
* @note contains the logic and display methods for handing applications
**/
// set up error reporting levels for troubleshooting purposes
ini_set('display_errors',1); 
error_reporting(E_ALL ^ E_NOTICE);

// process variables that may have been submitted via post or get
require_once("register_globals.inc");
require_once("functions.inc");
require_once("gen_db.inc");

$func = new functions;
$db = new db;

include("header.inc");

if ((!isset($action)) || ($action=="")) {
	include("application-text.php");
} // end if $action ! set

if ($action=="showform") {
	if ((!isset($go)) || ($go=="no") || ($go=="")) {
		include("applicationform.php");
	}// end if $go = no
} // end if $action=showform

if ($action=="apply") {
	// time to insert the applicant record into the database
	if ($go=="go") {
		$emp_hist1 = explode("|-|",$emp_name1."|-|".$emp_addr1."|-|".$emp_phone1."|-|".$emp_position1."|-|".$emp_start1."|-|".$emp_end1."|-|".$emp_reason1);
		$emp_hist2 = explode("|-|",$emp_name2."|-|".$emp_addr2."|-|".$emp_phone2."|-|".$emp_position2."|-|".$emp_start2."|-|".$emp_end2."|-|".$emp_reason2);
		$emp_hist3 = explode("|-|",$emp_name3."|-|".$emp_addr3."|-|".$emp_phone3."|-|".$emp_position3."|-|".$emp_start3."|-|".$emp_end3."|-|".$emp_reason3);
		$table="applicant";
		$modified_by="blank";
		$hired="N";
		$date_hired="0000-00-000 00:00:00";
		$start_date=date("Y-m-d",mktime(0,0,0,$start_date_month,$start_date_day,$start_date_year));
		$dob=date("Y-m-d",mktime(0,0,0,$dob_month,$dob_day,$dob_year));
		$emp_history=$func->concatenateEmploymentHistory($emp_hist1,$emp_hist2,$emp_hist3);
		$refs=$func->concatenateReferences($ref_name_01,$ref_email_01,$ref_phone_01,$ref_name_02,$ref_email_02,$ref_phone_02,$ref_name_03,$ref_email_03,$ref_phone_03);
		$phone=$func->formatPhone($phone,"in");
		$datenow=date("Y-m-d");
		$cols="firstname|||lastname|||street_address|||city|||state|||zip|||email|||phone|||gps|||sms|||dob|||position|||position_other|||legal_worker|||felony|||felony_explain|||start_date|||special_skills|||license|||license_state|||license_num|||years_experience|||own_table|||own_chair|||tx_liability|||availability|||education|||education_other|||refs|||emp_history|||id|||hired|||date_hired|||modified_by|||app_date";
		$vals=$firstname."|||".$lastname."|||".$street_address."|||".$city."|||".$state."|||".$zip."|||".$email."|||".$phone."|||".$gps."|||".$sms."|||".$dob."|||".$position."|||".$position_other."|||".$legal_worker."|||".$felony."|||".$felony_explain."|||".$start_date."|||".$special_skills."|||".$license."|||".$license_state."|||".$license_num."|||".$years_experience."|||".$own_table."|||".$own_chair."|||".$tx_liability."|||".$availability."|||".$education."|||".$education_other."|||".$refs."|||".$emp_history."|||NULL|||B|||0000-00-00 00:00:00|||blank|||".$datenow;
		if ($db->insert($table,$cols,$vals)) {
			$msg="Thank you for applying.<br /><br />\n";
			$msg.="You application will be processed shortly \n";
			$msg.="and one of our hiring specialists will be contacting you.<br />\n";
			include("successmsg.php");
		} // end table insert
	} else {
		include("applicationform.php");
	}// end if go=go which means form was submitted with data
} // if $action==apply

include("footer.inc");
/*
firstname
lastname
street_address
city
state
zip
email
phone
gps
sms
over_16
position
other_position
legal_worker
felony
felony_explain
start_date
special_skills
license
license_state
license_num
years_experience
own_table
own_chair
tx_liability
availability
education
education_other
references
id
hired
date_hired
modified_by
*/
?>
