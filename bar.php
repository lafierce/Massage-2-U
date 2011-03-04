<?php
// set up error reporting levels for troubleshooting purposes
ini_set('display_errors',1); 
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set("America/Chicago");
$n1="a";
$e1="";
$p1="c";
$n2="d";
$e2="e";
$p2="";
$n3="";
$e3="";
$p3="";

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

?>
<button onclick="var winLoc = new String(window.location); alert(winLoc.substr(winLoc.lastIndexOf('/'),2));">Test</button>
<br /><br /><br />
<?php
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


?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<title></title>
	</head>
	<body>
<pre>
$refs
<?php print_r($refs); ?>

$ret
<?php print_r($ret); ?>

output


<?php
$d=explode("-",date("Y-m-d"));
$t=explode("-",date("2010-06-014"));
$s=mktime(0,0,0,$d[1],$d[2],$d[0]);
$e=mktime(0,0,0,$t[1],$t[2],$t[0]);
echo "today: ".mktime(0,0,0,$d[1],$d[2],$d[0])."<br />\n";
echo "Aug 1: ".mktime(0,0,0,$t[1],$t[2],$t[0])."<br />\n";
echo "today - 8/1: ".(($e-$s)/86400)."<br />\n";
 ?>
</pre>
	</body>
</html>

