window.onresize = resized;
function resized() {
	//alert("has resized");
	placeMenu();
}
// placeMenu() determines if browser window width is less than watermark image width
// if less than width a default placement of menu element is in place
// if equal to or greater than watermark image width then place menu accordingly
function placeMenu() {
	// set up the logo image
	logoImage=new Image();
	var imgWidth=815;
	var imgHeight=710;

	var adminLogoWidth=140;
	document.m2u_admin_logo.src="images/m2u-admin-logo.gif";
	document.m2u_admin_logo.height=100;
	document.m2u_admin_logo.width=140;
	//newAdminLogoWidth=(document.body.clientWidth - adminLogoWidth) / 2;
	newAdminLogoWidth=(document.body.clientWidth - imgWidth) / 2;
	document.getElementById("admin_logo_home").style.left=newAdminLogoWidth;
	
	if (document.body.clientWidth<=imgWidth) {
		newWidth=35;
		leftAlignWidth=45;
		newFooterAlign=45;
	} // end if doc.bod.cWdth<708
	if (document.body.clientWidth>imgWidth) {
		newWidth=(document.body.clientWidth - imgWidth)/2;
		newWidth+=45;
		leftAlignWidth=((document.body.clientWidth - imgWidth) / 2) + (imgWidth-300);
		newFooterAlign=(document.body.clientWidth - imgWidth ) / 2;
	}

	var contentHeight = document.getElementById("content_div").clientHeight;
	var logoHeight = document.getElementById("admin_logo_home").clientHeight;
	var menuHeight = document.getElementById("adminmenu").clientHeight;

	newMenuWidth = (document.body.clientWidth - imgWidth) / 2;
	newMenuHeight = logoHeight + 20;
	newContentPos = logoHeight + document.getElementById("adminmenu").clientHeight;
	totalHeight = contentHeight + logoHeight + newMenuHeight;

	if (totalHeight>imgHeight) {
		document.getElementById("footer_image").style.top=totalHeight+35;
		document.getElementById("footer_copy").style.top=totalHeight+20;
	} else {
		document.getElementById("footer_image").style.top=imgHeight;
		document.getElementById("footer_copy").style.top=imgHeight-15;
	}
		
	//document.getElementById("common_btn_menu").style.left=newWidth;
	document.getElementById("admin_logo_home").style.top=10;
	document.getElementById("adminmenu").style.top=newMenuHeight;
	document.getElementById("adminmenu").style.left=newMenuWidth;
	document.getElementById("content_div").style.left=newWidth;
	document.getElementById("content_div").style.top=newContentPos;
	document.getElementById("footer_copy").style.left=leftAlignWidth;
	document.getElementById("footer_image").style.left=newFooterAlign;
}

function testBtn() {
	alert(document.getElementById("content_div").style.top);
}
