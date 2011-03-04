<div style="width:750px; margin:65px auto 0 auto;">
<div id="adminmenu">
<div id="mytabsmenu" class="tabsmenuclass">
<ul>
<li><a href="therapist-admin.php" rel="gotsubmenu[selected]">Therapists</a></li>
<li><a href="therapist-admin.php?loc=applications" rel="gotsubmenu">Applications</a></li>
<li><a href="admin.php?loc=drawings" rel="gotsubmenu">Manage Drawings</a></li>
<li><a href="admin.php?loc=service_area" rel="gotsubmenu">Service Area</a></li>
<li><a href="index.php">Home</a></li>
<li><a href="admin.php?action=logout">Logout</a></li>
</ul>
</div>

<div id="mysubmenuarea" class="tabsmenucontentclass">

<!--1st link within submenu container should point to the external submenu contents file-->
<a href="submenucontents.htm" style="visibility:hidden">Sub Menu contents</a>

</div>

<script type="text/javascript">
//mouseovertabsmenu.init("tabs_container_id", "submenu_container_id", "bool_hidecontentsmouseout")
mouseovertabsmenu.init("mytabsmenu", "mysubmenuarea", true)

</script>

<br style="clear:left" />
</div>
</div>