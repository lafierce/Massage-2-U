<?php // Simple Sitemap 1.01 (BETA)
      // sitemap.php - install in the web server's root directory.
      // Creates a Google XML Sitemap and a HTML site map from a 
      // pipe delimited text file.
      // Terminates on any error w/o error message.

      // COPYRIGHT (C) 2005 BY SMART-IT-CONSULTING.COM
      // * Do not remove this header
      // * This program is provided AS IS 
      // * Use this program at your own risk
      // * Don't publish this code, link to http://www.smart-it-consulting.com/ instead
      // * Information: http://www.smart-it-consulting.com/article.htm?node=154



// Set variables:
require("sitemap.cfg");


$isoLastModifiedSite = "";
$newLine = "\n";
$indent = " ";
if (!$rootUrl) exit;

/* ********************************************************************
   ************************* Google XML Sitemap ***********************
   ******************************************************************** */


$xmlHeader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>$newLine";


$urlsetOpen = "<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\" 
xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" 
xsi:schemaLocation=\"http://www.google.com/schemas/sitemap/0.84 
http://www.google.com/schemas/sitemap/0.84/sitemap.xsd\">$newLine";
$urlsetValue = "";
$urlsetClose = "</urlset>$newLine";

function makeUrlString ($urlString) {
    return htmlentities($urlString, ENT_QUOTES, 'UTF-8'); 
}

function makeIso8601TimeStamp ($dateTime) {
    if (!$dateTime) {
        $dateTime = date('Y-m-d H:i:s');
    }
    if (is_numeric(substr($dateTime, 11, 1))) {
        $isoTS = substr($dateTime, 0, 10) ."T" 
                 .substr($dateTime, 11, 8) ."+00:00";
    }
    else {
        $isoTS = substr($dateTime, 0, 10);
    }
    return $isoTS;
}

function makeUrlTag ($url, $modifiedDateTime, $changeFrequency, $priority) {
    GLOBAL $newLine;
    GLOBAL $indent;
    GLOBAL $isoLastModifiedSite;
    $urlOpen = "$indent<url>$newLine";
    $urlValue = "";
    $urlClose = "$indent</url>$newLine";
    $locOpen = "$indent$indent<loc>";
    $locValue = "";
    $locClose = "</loc>$newLine";
    $lastmodOpen = "$indent$indent<lastmod>";
    $lastmodValue = "";
    $lastmodClose = "</lastmod>$newLine";
    $changefreqOpen = "$indent$indent<changefreq>";
    $changefreqValue = "";
    $changefreqClose = "</changefreq>$newLine";
    $priorityOpen = "$indent$indent<priority>";
    $priorityValue = "";
    $priorityClose = "</priority>$newLine";

    $urlTag = $urlOpen;
    $urlValue     = $locOpen .makeUrlString("$url") .$locClose;
    if ($modifiedDateTime) {
     $urlValue .= $lastmodOpen .makeIso8601TimeStamp($modifiedDateTime) .$lastmodClose; 
     if (!$isoLastModifiedSite) { // last modification of web site
         $isoLastModifiedSite = makeIso8601TimeStamp($modifiedDateTime); 
     } 
    }
    if ($changeFrequency) {
     $urlValue .= $changefreqOpen .$changeFrequency .$changefreqClose; 
    }
    if ($priority) {
     $urlValue .= $priorityOpen .$priority .$priorityClose; 
    }
    $urlTag .= $urlValue;
    $urlTag .= $urlClose;
    return $urlTag;
}

// Process input file

$fp = fopen("$sitemapTxtFile", "r");
if ($fp) {
   $i = 0;
   while (!feof($fp)) {
      $bufferLine = fgets($fp, 8192);
      if ($bufferLine) {
         $processLine = TRUE;
         $bufferLine = trim($bufferLine);
         if (empty($bufferLine))         {$processLine = FALSE;} 
         // comments and invalid anchor links:
         if (stristr($bufferLine, "#"))  {$processLine = FALSE;} 
         // missing delimiter
         if (!stristr($bufferLine, "|")) {$processLine = FALSE;} 
         if ($processLine) {
            $i = $i + 1;
            $pageList[$i] = $bufferLine;
         }
      }
   }
   fclose($fp);
}
else exit;
if ($i == 0) exit;

// ******************* VALIDATION (sloppy) ***********************
function validateEntry ($pageLine) {
   $page = explode("|", $pageLine);
   $url = trim($page[0]);
   // Sloppy validation
   $processLine = TRUE;
   if (substr($url, 0, 1) != "/") {$processLine = FALSE;}

   return $processLine;
}

// START LOOP

foreach($pageList as $pageLine) {
   $processLine = validateEntry ($pageLine);
   $page = explode("|", $pageLine);
   $url = trim($page[0]);
   
   if ($processLine) {
      $urlsetValue .= makeUrlTag ($rootUrl .$url, trim($page[1]),   trim($page[2]), trim($page[3]));
   }
}

// END LOOP

/* Example, add pages not found in the text file:
if (!$isoLastModifiedSite) { // last modification of web site
    $isoLastModifiedSite = makeIso8601TimeStamp(date('Y-m-d H:i:s')); 
} 
$urlsetValue .= makeUrlTag ("$rootUrl/what-is-new.htm", $isoLastModifiedSite, "daily", "1.0");
*/

header('Content-type: application/xml; charset="utf-8"',true);
print "$xmlHeader
$urlsetOpen
$urlsetValue
$urlsetClose
";


/* ********************************************************************
   *************************** HTML Sitemap ***************************
   ******************************************************************** */


if ($createHtmlSitemap) {
flush();

// write the HTML sitemap persistent on disk ($sitemapHtmlFile needs chmod 666)
$fp = fopen("$sitemapTmplFile", "r");
if ($fp) {
   $i = 0;
   while (!feof($fp)) {
      $bufferLine = fgets($fp, 8192);
      if ($bufferLine) {
         $processLine = TRUE;
         $bufferLine = trim($bufferLine);
         if (empty($bufferLine))         {$processLine = FALSE;}           
         if ($processLine) {
            $i = $i + 1;
            $htmlFile .= $bufferLine ."\n";
         }
      }
   }
   fclose($fp);
}
else exit;
if ($i == 0) exit;

$find = "%TITLE%";
$replace = $sitemapHtmlTitle;
$htmlFile = eregi_replace($find, $replace, $htmlFile);

$find = "%RSSIMAGELINK%";
if ($createRss20Feed) {
   $replace = "<A HREF=\"$sitemapFeedFile\"><IMG SRC=\"$sitemapFeedImageFile\" BORDER=\"0\" ALT=\"Syndicate our content!\"/></A>";
}
else {
   $replace = "";
}
$htmlFile = eregi_replace($find, $replace, $htmlFile);

$find = "%SCRIPTLINK%";
$replace = "<P STYLE=\"font-size: 8pt\"><A HREF=\"http://www.smart-it-consulting.com/article.htm?node=154\" TITLE=\"This page was created with Simple Sitemap 1.0 from Smart-IT-Consulting.com\" STYLE=\"text-decoration:none;\">Simple Site Map 1.0</A>&nbsp;<A HREF=\"http://www.smart-it-consulting.com/\" STYLE=\"text-decoration:none;\">&copy; 2005 by Smart-IT-Consulting.com</A></P>";
$htmlFile = eregi_replace($find, $replace, $htmlFile);

foreach($pageList as $pageLine) {
   $processLine   = validateEntry ($pageLine);
   $page          = explode("|", $pageLine);
   $url 	  = $rootUrl .trim($page[0]);
   $level 	  = trim($page[4]);
   $anchorText    = trim($page[5]);
   $tooltip       = trim($page[6]); 
   $leftPx        = $level * 10;
   if ($leftPx < 1) {
      $leftPx     = 2; 
   }
   if ($processLine) { 
      $pageItems    .= "<P STYLE=\"margin-left:$leftPx" ."px;\">&middot;&nbsp;<A HREF=\"$url\" TITLE=\"$tooltip\">$anchorText</A></P>\n";
   }
}


$find = "%PAGELIST%";
$replace = $pageItems;
$htmlFile = eregi_replace($find, $replace, $htmlFile);

$fp = @fopen("$sitemapHtmlFile", "w");
if ($fp) {
   @fputs($fp, $htmlFile, strlen($htmlFile)); 
   @fclose($fp);
}
else {
   exit;
}
} // if ($createHtmlSitemap) 

/* ********************************************************************
   **************************** RSS Sitemap ***************************
   ******************************************************************** */

if ($createRss20Feed) {
flush();

function makeRssText ($description) {
    $descriptionValue = str_replace("&reg;", "", $description);
    $descriptionValue = str_replace("&trade;", "", $descriptionValue);
    $descriptionValue = str_replace("&copy;", "", $descriptionValue);
    $descriptionValue = str_replace("©", "", $descriptionValue);
    $descriptionValue = str_replace("®", "", $descriptionValue);
    $descriptionValue = str_replace("™", "", $descriptionValue);
    $descriptionValue = str_replace("’", "'", $descriptionValue);
    $descriptionValue = str_replace("&", "+", $descriptionValue);
    $descriptionValue = str_replace("&amp;", "+", $descriptionValue);   
    return html_entity_decode(strip_tags($descriptionValue), ENT_NOQUOTES, 'ISO-8859-1');
} // function makeRssText

function isDateEmpty ($dateTime) {
   if ($dateTime == "0000-00-00 00:00:00") return TRUE;
   if (empty($dateTime))                  return TRUE;
   return FALSE;
} // function isDateEmpty


if (!$maxItems) $maxItems = 200; // you can add '?maxItems=100' to the feed's URL
                                 // to limit the output
$numItems = 0;

$lang = $sitemapFeedLanguage;
if (!$language) $language = "en-us";


$isoLastModifiedSite = "";
$newLine = "\n";
$indent = "   ";


$xmlHeader = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>$newLine";
$xmlHeader .= "<rss version=\"2.0\">$newLine";
$xmlFooter = "</rss>$newLine";

$channelOpen = "<channel>$newLine";
$channelValue = "";
$channelClose = "</channel>$newLine";
 
$channelTitleOpen = "$indent<title>";
$channelTitleValue = "";
$channelTitleClose = "</title>$newLine";

$channelLinkOpen = "$indent<link>";
$channelLinkValue = "$rootUrl/";
$channelLinkClose = "</link>$newLine";

$channelDescOpen = "$indent<description>";
$channelDescValue = "";
$channelDescClose = "</description>$newLine";

$channelLangOpen = "$indent<language>";
$channelLangValue = makeRssText($language);
$channelLangClose = "</language>$newLine";

$channelCopyrightOpen = "$indent<copyright>";
$channelCopyrightValue = makeRssText($sitemapFeedCopyright);
$channelCopyrightClose = "</copyright>$newLine";

$channelPubDateOpen = "$indent<pubDate>";
$channelPubDateValue = "";
$channelPubDateClose = "</pubDate>$newLine";

$channelLastBuildDateOpen = "$indent<lastBuildDate>";
$channelLastBuildDateValue = "";
$channelLastBuildDateClose = "</lastBuildDate>$newLine";

$channelTag    = "";
$channelItems  = "";

$channelTitleValue = makeRssText($sitemapFeedTitle);
$channelDescValue  = makeRssText($sitemapFeedDesc);


function makeRfc822Date ($dateTime) {
    if (!$dateTime) {
        $dateTime = date('Y-m-d H:i:s');
    }
    return(date("r", strtotime($dateTime)));
}

function makeItemTag ($title, $link, $description, $pubDate, $categories) {
    GLOBAL $newLine;
    GLOBAL $indent;
    GLOBAL $isoLastModifiedSite;
    $itemOpen 		= "$indent<item>$newLine";
    $itemValue 		= "";
    $itemClose 		= "$indent</item>$newLine";
    $titleOpen 		= "$indent$indent<title>";
    $titleValue 		= "";
    $titleClose 		= "</title>$newLine";
    $linkOpen 		= "$indent$indent<link>";
    $linkValue 		= "";
    $linkClose 		= "</link>$newLine";
    $guidOpen 		= "$indent$indent<guid>";
    $guidValue 		= "";
    $guidClose 		= "</guid>$newLine";
    $descriptionOpen 	= "$indent$indent<description>";
    $descriptionValue 	= "";
    $descriptionClose 	= "</description>$newLine";
    $pubDateOpen 	= "$indent$indent<pubDate>";
    $pubDateValue 	= "";
    $pubDateClose 	= "</pubDate>$newLine";
    $categoryOpen 	= "$indent$indent<category>";
    $categoryValue 	= "";
    $categoryClose 	= "</category>$newLine";

    $descriptionValue = makeRssText($description);
    $title            = makeRssText($title); 

    $itemTag		= $itemOpen;
    $itemValue          = $titleOpen .$title .$titleClose;
    $itemValue          .= $descriptionOpen .$descriptionValue .$descriptionClose; 
    $itemValue          .= $linkOpen .$link .$linkClose;
    $itemValue          .= $guidOpen .$link .$guidClose;


    if ($pubDate) {
       $itemValue .= $pubDateOpen .makeRfc822Date($pubDate) .$pubDateClose; 
       if (!$isoLastModifiedSite) { // last modification of web site
          $isoLastModifiedSite = makeRfc822Date($pubDate); 
       } 
    }
    if ($categories) {
       $cats = explode(",", $categories);
       foreach ($cats as $cat) {  
          if ($cat AND !empty($cat)) {
             $itemValue .= $categoryOpen .makeRssText($cat) .$categoryClose; 
          }
       }
    }

    $itemTag .= $itemValue;
    $itemTag .= $itemClose;

    return $itemTag;
} // function makeItemTag


foreach($pageList as $pageLine) {
   $processPage   = validateEntry ($pageLine);
   $page          = explode("|", $pageLine);
   $rssLink 	  = $rootUrl .trim($page[0]);
   $rssPubDate    = trim($page[1]);
   $rssTitle      = trim($page[5]);
   $rssDesc       = trim($page[6]); 
   $rssCats       = trim($page[7]);  

   if (empty($rssDesc)) {
      $rssDesc = $rssTitle;
   }
   if (empty($rssDesc)) {
      $processPage = FALSE;
   }

   if ($numItems > $maxItems)	      $processPage = FALSE;	

   if ($processPage) { 

      $channelItems .= makeItemTag ($rssTitle, $rssLink, $rssDesc, $rssPubDate, $rssCats);
      $numItems = $numItems + 1;
   }

} 
$channelItems .= makeItemTag ("Powered by Simple Sitemaps", "http://www.smart-it-consulting.com/article.htm?node=154", "This RSS 2.0 site feed was created by Simple Sitemaps from Smart-IT-Consulting.com", "2005-01-01 00:00:00", "RSS,XML,Site Maps,Site Feeds,IT Consulting");


/* populate channel tag */
if (!$isoLastModifiedSite) { // last modification of web site
   $isoLastModifiedSite = makeRfc822Date(""); 
} 

$channelPubDateValue       = $isoLastModifiedSite; 
$channelLastBuildDateValue = makeRfc822Date("");

$channelTag    = $channelOpen;
$channelValue .= $channelTitleOpen .$channelTitleValue .$channelTitleClose;
$channelValue .= $channelLinkOpen .$channelLinkValue .$channelLinkClose;
$channelValue .= $channelDescOpen .$channelDescValue .$channelDescClose;
$channelValue .= $channelLangOpen .$channelLangValue .$channelLangClose;
$channelValue .= $channelCopyrightOpen .$channelCopyrightValue .$channelCopyrightClose;
$channelValue .= $channelPubDateOpen .$channelPubDateValue .$channelPubDateClose;
$channelValue .= $channelLastBuildDateOpen .$channelLastBuildDateValue .$channelLastBuildDateClose;
$channelValue .= $channelItems;
$channelTag   .= $channelValue;
$channelTag   .= $channelClose;



/* write XML script */
$rssFile = "<?php 
header('Content-type: application/xml; charset=\"ISO-8859-1\"',true); 
print \""  
.str_replace("\"", "\\\"", "$xmlHeader$channelTag$xmlFooter")  
."\";
?>";

$fp = @fopen("$sitemapFeedFile", "w");
if ($fp) {
   @fputs($fp, $rssFile, strlen($rssFile)); 
   @fclose($fp);
}
else exit;


} // if ($createRss20Feed)
?>