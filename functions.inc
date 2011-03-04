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
// $Id: functions.inc v 1.0 2010/02/15 03:41:18 jlf Exp $

//require_once("gen_db.inc");

/*********************************
* The gen_db class contains various database access methods and properties.
* It also contains a central location for vital database access information
* Possibly a security risk to be assessed in a future version
*********************************/

class functions {

//upload a file to a directory and 
function fileUpload($ufile,$dir,$newfilename) {
	$success=false;
	if ((!empty($_FILES[$ufile])) && ($_FILES[$ufile]["error"] == 0)) {
		$filename = $_FILES[$ufile]["name"];
		$ext = substr($filename, strrpos($filename,'.') +1);
		if (($ext=="jpg") || ($ext=="jpeg") || ($ext=="gif") || ($ext=="png")) { $ext=true; } else { $ext=false;} // end if correct file extension
		if (($ext) && ($_FILES[$ufile]["type"] == "image/jpeg") && ($_FILES[$ufile]["size"] < 350000)) {
			// set the path to save the file to
			$newname = dirname(__FILE__).$dir.$newfilename.".".substr($filename, strrpos($filename,'.') +1);
			//check if a file with the same name already exists
		
				 // attempt to move the updated file into place
				 if ((move_uploaded_file($_FILES[$ufile]["tmp_name"],$newname))) {
				 	$success=true;
				 	$msg="File upload complete. File has been saved as ".substr($newname,strrpos($newname,$ufile));
				 	include("successmsg.php");				 	
				 } else {
					$msg="Error: A problem occurred during the file upload";
					include("errormsg.php");
				 } 	// end if move file to new location
			
		} else {
			$msg="Error: Only .jpg,.jpeg,.gif, or .png images under 350kb are accepted for upload";
			include("errormsg.php");
		} // end if file is right size and format
	} else { 
		$msg="Error: No file uploaded";
		include("errormsg.php");
	} // end if $_FILES is empty
	return $success;
} // end function fileUpload

function chkSelect($sel,$val) {
	if($sel==$val) {
		$result=" selected=\"selected\"";
	} else {
		$result="";
	}
	
	return $result;
} // end function chkSelect

function chkArrayValue($arr,$val) {
// check if any element in one array matches a variable value
	// sometimes there is no array or it may arrive blank; check first
	if(!is_array($arr)) { return false; }
	
	for($i=0;$i<count($arr);$i++) {
		if ($arr[$i]==$val) {
			return true;
		} // end if arr==val
	} // end for loop $i
} // end function chkArrayValue

function formatPhone($phone,$type) {
	if ($type=="in") {
	// if we're inserting into a database strip everything but the numbers
		$phone = preg_replace('/(\W*)/', '', $phone);
		$result = $phone;
	} // end if type=in
	
	if ($type=="out") {
	// we're going to display the result; make human-readable
		$result="(".substr($phone,0,3).")";
		$result.="-".substr($phone,3,3);
		$result.="-".substr($phone,-4);
	} // end if type=out
	
	return $result;
} // end function formatPhone

function redir($url) {
	// to redirect to a new page... mostly for login purposes
	header("Location: ".$url);
	exit();
} // end function redir($url)

function check_login() {
	if (isset($_SESSION['logged_in'])) {
		return $_SESSION['logged_in'];
	} else {
		return false;
	} // end if $_SESSION['logged_in']=true
} // end function check login status

function logout() {
	unset($_SESSION['logged_in']);
	unset($_SESSION['security_level']);
	session_destroy();
} // end function logout

function concatenateReferences($n1,$e1,$p1,$n2,$e2,$p2,$n3,$e3,$p3) {
	$refs = array("",$n1,$e1,$p1,$n2,$e2,$p2,$n3,$e3,$p3);
	$c=0;
	foreach($refs as $r) { if($r=="") { $refs[$c]="blank"; } $c++; }
	$ret="";
	for ($i=1;$i<=count($refs);$i++) {
		if ($i<count($refs)) {
			if ($i%3!=0) { $ret.=$refs[$i]."|-|"; }
			if ($i%3==0) { $ret.=$refs[$i]; if ($i<count($refs)-3) { $ret.=":::"; }}
		} // end if
	} // end for	
	return $ret;
} // end function concatenateReferences()

function parseReferences($refs,$rsep,$elsep) {
	if ($refs=="") { return "no references provided"; } // end if $refs is blank or not an array
	$refs=explode($rsep,$refs);
	foreach($refs as $ref) {
		$r=explode($elsep,$ref);
		foreach($r as $s) { if ($s=="blank") { $ret.=""; } else { $ret.=$s."&nbsp;&nbsp;&nbsp;"; } } // end foreach	
		$ret.="<br />\n";	
	} // end foreach
	return $ret;
} // end function parseReferences

function concatenateEmploymentHistory($arr1,$arr2,$arr3) {
	if ($arr1[0]!="") { $ret=implode("|-|",$arr1); }
	if ($arr2[0]!="") { $ret.=":::".implode("|-|",$arr2); }
	if ($arr3[0]!="") { $ret.=":::".implode("|-|",$arr3); }
	return $ret;
} // edn fucntion concatenanteEmploymentHistory()

function parseEmploymentHistory($hist,$rsep,$elsep) {
	$label=array("Employer","Address","Phone","Position","Start Date","End Date","Reason for leaving");
	if ($hist=="") { return "no employment history provided"; } // end if $hist is blank
	$hist=explode($rsep,$hist);
	$hist=array_filter($hist);
	$ret="<table width=\"100%\" align=\"center\" cellpadding=\"2\" cellspacing=\"3\" border=\"0\">\n";
	$ret.="<tr>\n";
	$ret.="\t<td valign=\"top\" width=\"33%\" style=\"border-right: 1px silver solid; font-size: 8pt;\">\n";
	$n=0;
	foreach ($hist as $h) {
		$c=0;
		$e=explode($elsep,$h);
		foreach($e as $i) { $ret.="<span style=\"font-weight: bold;\">".$label[$c]."</span>"; if ($c==count($label)-1) { $ret.="<br />\n"; } $ret.="&nbsp;".$i."<br />\n"; $c++; } // end foreach item in emp history element
		if ($n<count(hist)) { $ret.="</td>\n\t<td valign=\"top\" width=\"33%\" style=\"border-right: 1px silver solid; font-size: 8pt;\">\n"; } else { $ret.="</td>\n\t<td valign=\"top\" width=\"33%\" style=\"font-size: 8pt;\">\n";}
		$n++;
	} // end foreach
	$ret.="</tr></table>\n";
	return $ret;
} // end function parseEmploymentHistory

// displays a human readable version of a varaible based on key and value
// $val = the value from the db table
// $opt = the finite options $val can contain in order
// $hr = the human readable versions of each $opt in order
// $sep = the separater used to convert string to array
function dispVHR($val,$opt,$hr,$sep) {
	$opt=explode($sep,$opt);
	$hr=explode($sep,$hr);
	for ($i=0;$i<count($opt);$i++) {
		$r[$opt[$i]]=$hr[$i];
	} // end for loop
	return $r[$val];
} // end function dispRadHumanReadable

function formatDate($date,$type) {
	if($type=="in") {
		$date=$date;
	}
	if ($type=="out") {
		$d=explode("-",$date);
		$date=date("l M j, Y",mktime(0,0,0,$d[1],$d[2],$d[0]));
	}
	if ($type=="short") {
		$d=explode("-",$date);
		$date=date("m/d/Y",mktime(0,0,0,$d[1],$d[2],$d[0]));
	}
	if ($type=="convertin") {
		$d=explode("/",$date);
		$date=date("Y-m-d",mktime(0,0,0,$d[0],$d[1],$d[2]));
	} // end type=convert
	if ($type=="convertout") {
		$d=explode("-",$date);
		$date=date("m/d/Y",mktime(0,0,0,$d[1],$d[2],$d[0]));
	} // end type=convert
	if ($type=="short_date_time") {
		$d=explode(" ",$date);
		$d=explode("-",$d[0]);
		$t=explode(":",$d[1]);
		$date = date("j M Y",mktime(0,0,0,$d[1],$d[2],$d[0]));
		$time = date("h:ma",mktime($t[0],$t[1],$t[2],0,0,0));
		$date = $date . " " . $time;
	} // end type=convert
	return $date;
} // end function formatDate()

function dispModalities($mods) {
	$mods_txt="Acupressure|||Alexander Technique|||Amma Therapy|||Aromatherapy|||Aston Patterning|||Bioenergetics|||Bowen Technique|||Canadian Deep Muscle|||Chair Massage|||Chi Nei Tsang|||Core Energetics|||Craniosacral Therapy|||Cross Fiber Massage|||Deep Muscle Massage|||Deep Tissue Massage|||Equine Massage|||Esalen Massage|||Haelan|||Hakomi Therapy|||Hellerwork|||Hemme Approach|||Holographic Technique|||Horse Massage|||Hoshino Therapy|||Hot Stone Massage|||Infant Massage|||Integrative Massage|||Jin Shin Jitsu|||Lomilomi Massage|||Looyen Work|||Lymph System|||Myofascial|||Myotherapy|||Naprapathy|||Neuromuscular Therapy|||On-Site Massage|||Ortho-Bionomy Loosely|||Oshiatsu|||Pfrimmer Deep Muscle|||Polarity Therapy|||Postural Integration|||Pregnancy Massage|||Rebalancing|||Reflexology|||Reiki|||Rolfing|||Rosen Method|||Rubenfeld Synergy Method|||Seated Massage|||Shiatsu|||Soma Neuromuscular Integration|||Sport Massage|||Structural Integration|||Swedish Massage|||Tellington Touch|||Thai Massage|||Therapeutic Touch|||Touch For Health|||Trager|||Trauma Erase|||Trauma Touch Therapy|||Tuina Medical Massage from China|||Watsu|||Zero Balancing";
	$mods_txt=explode("|||",$mods_txt);
	$tot=count($mods_txt);
	
	$mods=explode(" ",$mods);
	for($i=0;$i<count($mods);$i++) {
		$ret.=$mods_txt[$mods[$i]];
		if ($i<count($mods)) {$ret.=", ";}
	} // end for
	return $ret;
} // end function dispModalities

function getApplicationViewQry($w) {
	switch ($w) {
		case "new":
			$qry="SELECT firstname,lastname,email,phone,start_date,id,hired FROM applicant WHERE hired=\"B\" ORDER BY lastname";
			break;
		case "hired":
			$qry="SELECT firstname,lastname,email,phone,start_date,id,hired FROM applicant WHERE hired=\"Y\" ORDER BY lastname";
			break;	
		case "not_hired":
			$qry="SELECT firstname,lastname,email,phone,start_date,id,hired FROM applicant WHERE hired=\"N\" ORDER BY lastname";
			break;			
		case "all":
			$qry="SELECT firstname,lastname,email,phone,start_date,id,hired FROM applicant ORDER BY lastname";
			break;
	} // end switch $w
	return $qry;
} // end function getApplicationViewQry

function dispImageNewRatio($img,$max) {
	// function determines if an image is the correct size for disp
	// if not, determines aspect ratio and adjusts display elements accordingly
	// currently only adjust for a max height
	if(isset($img) && $img!="") { 
		$info = getimagesize($img);
		
		if ($info[1]<=$max) { 
			//if current image size is larger than allowable max
			$max=$info[1];
		} // end $info[1]>$max
				
		$factor = (float)$max / $info[1];
		$new_width = $factor * $info[0];
		
		$newImageInfo['filename']=$filename;
		$newImageInfo['width']=floor($new_width);
		$newImageInfo['height']=$max;
		
		return $newImageInfo;
	} else { return false; } // end if isset(img)
		
} // end function dispImageNewRatio

function dispDaysTillDrawing($d) {
	$n = explode("-",date("Y-m-d"));
	$n = mktime(0,0,0,$n[1],$n[2],$n[0]);
	$d = mktime(0,0,0,$d[1],$d[2],$d[0]);
	return (($d-$n)/86400);
} // end function dispDaysTillDrawing

function getDrawings($db) {
	// returns and object equal to the first drawing by date
	// if no drawing is currently active returns blanks
	$table="drawings";
	$cols="drawing_start_date|||drawing_end_date|||id";
	$sort="drawing_end_date";
	$now=date("Ymd");
	if ($drawings=$db->readAll($table,$cols,$sort)) {
		while($drawing=mysql_fetch_object($drawings)) {
			$sdate=implode("",explode("-",$drawing->drawing_start_date));
			$edate=implode("",explode("-",$drawing->drawing_end_date));
			$days=$this->dispDaysTillDrawing(explode("-",$drawing->drawing_end_date));
			//echo "<!--\n $now\n$sdate\n$edate\n$days \n-->\n";
			if (($sdate<=$now) && ($edate>=$now)) {
				return $this->dispDaysTillDrawing(explode("-",$drawing->drawing_end_date));
			} // end if start and end are not before or after today
		} // end while checking the drawings
	} else {
		return false;
	} // 
	
}// end function getDrawings

} // end class functions

?>