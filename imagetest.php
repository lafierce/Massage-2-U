<?php
/*
$filename="images/Nicolas_Cage2.jpg";

$imginf= getImageSize($filename);

$ratio = $imginf[0] / $imginf[1];

$new_width= 100;

$factor = (float)$new_width / (float)$imginf[0];

$new_height = $factor * $imginf[1];
*/
?>

Original Image<br />
<?php echo "<img src=\"".$filename."\" height=\"".$imginf[1]."\" width=\"".$imginf[0]."\" alt=\"".$filename."\" /><br /><br />\n\n"; ?>

New Image Size (heigh=100)<br />
<?php echo "<img src=\"".$filename."\" height=\"".$new_height."\" width=\"".$new_width."\" alt=\"".$filename."\" /><br /><br />"; ?>
<div class="video">As Seen on Great Day Houston!<br />
<?php if (strpos($_SERVER['HTTP_USER_AGENT'],"Safari") || strpos($_SERVER['HTTP_USER_AGENT'],"Chrome")) { ?>
<video width="480" height="360" src="images/greatdayhouston.m4v" controls autobuffer>
<a href="images/greatdayhouston.m4v">Click here if you are unable to view.</a>
</video>
<?php } else { ?>
<object width="480" height="360">
<param name="movie" value="http://www.youtube.com/v/SHvq6s5KfMg?fs=1&amp;hl=en_US&amp;rel=0&amp;hd=1"></param>
<param name="allowFullScreen" value="true"></param>
<param name="allowscriptaccess" value="always"></param>
<embed src="http://www.youtube.com/v/SHvq6s5KfMg?fs=1&amp;hl=en_US&amp;rel=0&amp;hd=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="360"></embed>
</object>
<?php } ?> 
</div>


<pre>
<?php
print_r($img_inf);
print_r($ratio);
?>
</pre>