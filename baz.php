<?php
// set up error reporting levels for troubleshooting purposes
ini_set('display_errors',1); 
error_reporting(E_ALL ^ E_NOTICE);

function parseEmploymentHistory($hist,$rsep,$elsep) {
	$label=array("Employer","Address","Phone","Position","Start Date","End Date","Reason for leaving");
	if ($hist=="") { return "no employment history provided"; } // end if $hist is blank
	$hist=explode($rsep,$hist);
	$hist=array_filter($hist);
	$ret="<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\n";
	$ret.="<tr>\n";
	$ret.="\t<td valign=\"top\" width=\"33%\" style=\"border-right: 1px silver solid\">\n";
	foreach ($hist as $h) {
		$c=0;
		$e=explode($elsep,$h);
		foreach($e as $i) { $ret.=$label[$c].": "; if ($c==count($label)-1) { $ret.="<br />\n"; } $ret.="&nbsp;".$i."<br />\n"; $c++; } // end foreach
		$ret.="</td>\n\t<td valign=\"top\" width=\"33%\" style=\"border-right: 1px silver solid\">";
	} // end foreach
	$ret.="</td>\n</tr>\n</table>\n";
	return $ret;
} // end function parseEmploymentHistory


?>
<button onclick="var winLoc = new String(window.location); alert(winLoc.substr(winLoc.lastIndexOf('/'),2));">Test</button>
<br /><br /><br />
<?php
$hist="ComCo|||123 Fake St|||310-555-1212|||Televangelist|||12/1/1998|||4/13/2001|||Church scandals:::";
$hist.="Massage Envy|||321 Ekaf Ts|||409-555-2121|||Receptionist|||3/1/05|||4/4/07|||Franchise closed down when Massage2U stole all our business";
		$emp_hist1 = explode("|-|",$emp_name1."|-|".$emp_addr1."|-|".$emp_phone1."|-|".$emp_position1."|-|".$emp_start1."|-|".$emp_end1."|-|".$emp_reason1);
		$emp_hist2 = explode("|-|",$emp_name2."|-|".$emp_addr2."|-|".$emp_phone2."|-|".$emp_position2."|-|".$emp_start2."|-|".$emp_end2."|-|".$emp_reason2);
		$emp_hist3 = explode("|-|",$emp_name3."|-|".$emp_addr3."|-|".$emp_phone3."|-|".$emp_position3."|-|".$emp_start3."|-|".$emp_end3."|-|".$emp_reason3);
?>
<pre>
$hist
<?php print_r($hist); ?>

emp_hist2
<?php print_r($emp_hist2) ?>

output
</pre>
<?php echo parseEmploymentHistory($hist,":::","|||"); ?>
