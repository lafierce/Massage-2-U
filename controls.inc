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
// $Id: controls.inc v 1.0 2010/02/15 03:41:18 jlf Exp $

/**
*
*
* @file controls.inc
* @note these are the controls for various form display and manipulation
**/

require_once("functions.inc");

// set the default time zone
date_default_timezone_set('America/Chicago');

/*********************************
* The function object is for various global functions.
* It also contains various methods.
*
*********************************/

class controls extends functions {

	function ctrlDateSelect($select_name,$val="bar") {
		// creates a select object for showing 31 days
		echo "<select name=\"".$select_name."\">\n";
		echo "<option value=\"\">---</option>\n";
		
		for ($i=1;$i<32;$i++) {
			if($val==$i) { $selected=" selected=\"selected\""; } else { $selected=""; }
			echo "\t<option value=\"".$i."\"".$selected.">".$i."</option>\n";
		} //end for loop
		
		echo "</select>\n";		
	} // end function ctrlDateSelect()

	function ctrlMonthSelect($select_name,$val) {
		// creates a select field for showing all 12 months
		echo "<select name=\"".$select_name."\">\n";
		echo "<option value=\"\">--select one--</option>\n";
		$date_txt="January|||February|||March|||April|||May|||June|||July|||August|||September|||October|||November|||December";
		$date_txt=explode("|||",$date_txt);
		$date_num="01|||02|||03|||04|||05|||06|||07|||08|||09|||10|||11|||12";
		$date_num=explode("|||",$date_num);

		for ($i=0;$i<count($date_txt);$i++) {
			if($val==$date_num[$i]) { $selected=" selected=\"selected\""; } else { $selected=""; }
			echo "\t<option value=\"".$date_num[$i]."\"".$selected.">".$date_txt[$i]."</option>\n";
		} // end for loop
		echo "</select>\n";
	} // end function ctrlMonthSelect()

	function ctrlYearsSelect($select_name,$val) {
		// creates select field for previous 90 years
		// first find out what year it is and subtract 13
		$foo=date("Y");

		echo "<select name=\"".$select_name."\">\n";
		echo "<option value=\"\">--select one--</option>\n";
		for($i=$foo;$i>1920;$i--) {
			if($val==$i) { $selected=" selected=\"selected\""; } else { $selected=""; }
			echo "\t<option value=\"".$i."\"".$selected.">".$i."</option>\n";
		}
		echo "</select>\n";
	} // end function ctrlYearsSelect()

	function ctrlStartDateYearsSelect($select_name,$val) {
		// creates select field for previous 90 years
		// first find out what year it is and subtract 13
		$foo=date("Y");

		echo "<select name=\"".$select_name."\">\n";
		echo "<option value=\"\">--select one--</option>\n";
		for($i=$foo;$i<($foo+5);$i++) {
			if($val==$i) { $selected=" selected=\"selected\""; } else { $selected=""; }
			echo "\t<option value=\"".$i."\"".$selected.">".$i."</option>\n";
		}
		echo "</select>\n";
	} // end function ctrlYearsSelect()

	function ctrlStateSelect($select_name,$val) {
		// creates a select opject with the 50 states
		$states="Alaska|||Alabama|||Arkansas|||Arizona|||California|||Colorado|||Connecticut|||Washington DC|||Delaware|||Florida|||Georgia|||Hawai'i|||Iowa|||Idaho|||Illinois|||Indianna|||Kansas|||Kentucky|||Louisiana|||Massechusets|||Maryland|||Maine|||Michigan|||Minnesota|||Mossouri|||Mississippi|||Montana|||North Carolina|||North Dakota|||Nebraska|||New Hampshire|||New Jersey|||New Mexico|||Nevada|||New York|||Ohio|||Oklahoma|||Oregon|||Pennsylvania|||Rhode Island|||South Carolina|||South Dakota|||Tennessee|||Texas|||Utah|||Virginia|||Vermont|||Washington|||West Virginia|||Wyoming";
		$abbrev="AK|||AL|||AR|||AZ|||CA|||CO|||CT|||DC|||DE|||FL|||GA|||HI|||IA|||ID|||IL|||IN|||KS|||KY|||LA|||MA|||MD|||ME|||MI|||MN|||MO|||MS|||MT|||NC|||ND|||NE|||NH|||NJ|||NM|||NV|||NY|||OH|||OK|||OR|||PA|||RI|||SC|||SD|||TN|||TX|||UT|||VA|||VT|||WA|||WI|||WV|||WY";
		$states=explode("|||",$states);
		$abbrev=explode("|||",$abbrev);
		for ($a=0;$a<count($states);$a++) { $s[$abbrev[$a]]=$states[$a]; } // make an array for displaying textual state name from abbrev
		if ($select_name=="") { return $s[$val]; } // end if state translate
		echo "<select name=\"".$select_name."\">\n";
		echo "<option value=\"\">--select one--</option>\n";
		for ($i=0;$i<count($states);$i++) {
			if ($val==$abbrev[$i]) { $selected=" selected=\"selected\""; } else { $selected=""; } // end if state = val
			echo "\t<option value=\"".$abbrev[$i]."\"".$selected.">".$states[$i]."</option>\n";
		}
		echo "</select>\n";		
	} // end function ctrlStateSelect()

	function ctrlModalitiesChkBox($chkbox_name,$typ,$curr_mods) {
		// creates a series of checkboxes
		$mods="Acupressure|||Alexander Technique|||Amma Therapy|||Aromatherapy|||Aston Patterning|||Bioenergetics|||Bowen Technique|||Canadian Deep Muscle|||Chair Massage|||Chi Nei Tsang|||Core Energetics|||Craniosacral Therapy|||Cross Fiber Massage|||Deep Muscle Massage|||Deep Tissue Massage|||Equine Massage|||Esalen Massage|||Haelan|||Hakomi Therapy|||Hellerwork|||Hemme Approach|||Holographic Technique|||Horse Massage|||Hoshino Therapy|||Hot Stone Massage|||Infant Massage|||Integrative Massage|||Jin Shin Jitsu|||Lomilomi Massage|||Looyen Work|||Lymph System|||Myofascial|||Myotherapy|||Naprapathy|||Neuromuscular Therapy|||On-Site Massage|||Ortho-Bionomy Loosely|||Oshiatsu|||Pfrimmer Deep Muscle|||Polarity Therapy|||Postural Integration|||Pregnancy Massage|||Rebalancing|||Reflexology|||Reiki|||Rolfing|||Rosen Method|||Rubenfeld Synergy Method|||Seated Massage|||Shiatsu|||Soma Neuromuscular Integration|||Sport Massage|||Structural Integration|||Swedish Massage|||Tellington Touch|||Thai Massage|||Therapeutic Touch|||Touch For Health|||Trager|||Trauma Erase|||Trauma Touch Therapy|||Tuina Medical Massage from China|||Watsu|||Zero Balancing";
		$mods=explode("|||",$mods);
		$tot=count($mods);
		$curr_mods=implode("|||",$curr_mods);
		
		// if this is just adding a new record none will be checked, display as normal.
		// if this is an update check each array element to see if it matches any elements in $curr_mods
		if ($typ=="disp" && $curr_mods!="") {
			// there's some stuff to display so do it
			$curr_mods=explode("|||",$curr_mods);
		} // end if typ=disp & currmods!=""
		
		echo "<table width=\"100%\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
		echo "<tr>\n\t<td valign=\"top\" nowrap=\"nowrap\">";
		
		for($i=0;$i<count($mods);$i++) {
			if ($this->chkArrayValue($curr_mods,$i)) {
				$checked=" checked=\"checked\"";
			} else {
				$checked="";
			} // end if chkArrayValue
			echo "\t<input type=\"checkbox\" name=\"".$chkbox_name."[]\" value=\"".$i."\"".$checked." /><span class=\"small-txt\">".$mods[$i]."</span><br />\n";
			if (($i % 16 == 0) && ($i!=0)) {
				// to make for even 4 columns check for 16 elements and then start a new column
				echo "</td>\n\t<td valign=\"top\">";
			} // end if $i % 5
		} // end for loop
		
		echo "\t</td>\n</tr>\n</table>\n";
	} // end function ctrlModalitiesChkBox

} // end class controls
?>