<?php 
header('Content-type: application/xml; charset="ISO-8859-1"',true); 
print "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
<rss version=\"2.0\">
<channel>
   <title>Simple RSS 2.0 Site Feed</title>
   <link>http://www.smart-it-consulting.com/</link>
   <description>You will enjoy this incredible RSS feed ;)</description>
   <language>en-us</language>
   <copyright>Copyright (C) 2005 by smart-it-consulting.com</copyright>
   <pubDate>Mon, 25 Jul 2005 00:00:00 -0700</pubDate>
   <lastBuildDate>Wed, 28 Jul 2010 10:47:25 -0700</lastBuildDate>
   <item>
      <title>Home page</title>
      <description>Site description</description>
      <link>http://www.smart-it-consulting.com/</link>
      <guid>http://www.smart-it-consulting.com/</guid>
      <pubDate>Mon, 25 Jul 2005 00:00:00 -0700</pubDate>
      <category>category1</category>
      <category>cat2</category>
      <category>cat3</category>
      <category>cat4</category>
      <category>cat5</category>
   </item>
   <item>
      <title>Powered by Simple Sitemaps</title>
      <description>This RSS 2.0 site feed was created by Simple Sitemaps from Smart-IT-Consulting.com</description>
      <link>http://www.smart-it-consulting.com/article.htm?node=154</link>
      <guid>http://www.smart-it-consulting.com/article.htm?node=154</guid>
      <pubDate>Sat, 01 Jan 2005 00:00:00 -0800</pubDate>
      <category>RSS</category>
      <category>XML</category>
      <category>Site Maps</category>
      <category>Site Feeds</category>
      <category>IT Consulting</category>
   </item>
</channel>
</rss>
";
?>