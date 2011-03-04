var bDebugSession = (typeof(bDebugSession)!='undefined')?bDebugSession:false;

// The minSessionTimeoutThreshold and minSessionWarningThreshold variables are used
// to defined the session timeout limits.
// minSessionTimeoutThreshold = The number of minutes that the user may be logged in without their session timing out.
// minSessionWarningThreshold = The number of minutes before the session timeout when the warning popup will be displayed.
// secSessionTimerHeartbeat = The number of second between session check timer events.
var minSessionTimeoutThreshold = 60;
var minSessionWarningThreshold = 5;
var secSessionTimerHeartbeat = 30;
var secSessionHeartbeartTransition = secSessionTimerHeartbeat;

var msecTimeoutThreshold = minSessionTimeoutThreshold * 1000 * 60;
var msecWarningThreshold = minSessionWarningThreshold * 1000 * 60;
var bAllowSessionRedirect = false;
var sSessionTimeoutRedirectUrl = "/Default.aspx";

var dCurrentDateTime = new Date();
var dLastActivity = new Date(GetLastActivity());
var dStartingLastActivity = new Date(GetLastActivity());

//var msecLocalTimeDifference = dLastActivity.getTime() - dCurrentDateTime.getTime();
//var msecLocalizedTimeoutThreshold = msecTimeoutThreshold - msecLocalTimeDifference;
//var msecLocalizedWarningThreshold = msecWarningThreshold - msecLocalTimeDifference;
var msecLocalTimeDifference = 0;
var msecLocalizedTimeoutThreshold = 0;
var msecLocalizedWarningThreshold = 0;

var bSessionTimerActive = false;
var bWarningActive = false;
var bSessionExpired = false;

var sessionDialog = null;

var iSessionTimerID = null;

function InitSessionTimer(sessionTimeoutThreshold, sessionWarningThreshold, sessionTimerHeartbeat, timeoutRedirectUrl)
{
    minSessionTimeoutThreshold = sessionTimeoutThreshold;
    minSessionWarningThreshold = sessionWarningThreshold;
    secSessionTimerHeartbeat = sessionTimerHeartbeat;
    secSessionHeartbeartTransition = sessionTimerHeartbeat;
    msecTimeoutThreshold = minSessionTimeoutThreshold * 1000 * 60;
    msecWarningThreshold = minSessionWarningThreshold * 1000 * 60;
    sSessionTimeoutRedirectUrl = timeoutRedirectUrl;
    
	if (!bSessionTimerActive)
	{
		SetTimerValues();
		StartSessionTimer();
		bSessionTimerActive = true;
		ShowSessionValues();
	}
}

function RedirectForTimeout()
{
	window.onbeforeunload=RedirectBypass;
	window.top.location.href=sSessionTimeoutRedirectUrl;
}

function RedirectBypass(){}

function SetTimerValues()
{
	dCurrentDateTime = new Date();
	dLastActivity = new Date(GetLastActivity());
	dStartingLastActivity = new Date(GetLastActivity());
	// Localized time does not appear to affect timer calculation as expected
	// Removed localized time as unnecessary.
	//msecLocalTimeDifference = (msecTimeoutThreshold)-((dLastActivity.getTime() - dCurrentDateTime.getTime())%(1000*60*60));
	msecLocalTimeDifference = 0;
	msecLocalizedTimeoutThreshold = msecTimeoutThreshold + msecLocalTimeDifference;
	msecLocalizedWarningThreshold = msecLocalizedTimeoutThreshold - msecWarningThreshold + msecLocalTimeDifference;
	bWarningActive = false;
	ShowSessionValues();
}

function ShowSessionValues()
{
	if (bDebugSession)
	{
		var msg = "dLastActivity = " + dLastActivity + " msec: " + dLastActivity.getTime() +  "\r\n";
		msg += "dCurrentDateTime = " + dCurrentDateTime + " msec: " + dCurrentDateTime.getTime() +  "\r\n";
		msg += "msecTimeoutThreshold = " + msecTimeoutThreshold + "\r\n";
		msg += "msecLocalTimeDifference = " + msecLocalTimeDifference + " min." + (msecLocalTimeDifference/1000/60) + "\r\n";
		msg += "msecLocalizedWarningThreshold = " + msecLocalizedWarningThreshold + "\r\n";
		msg += "msecLocalizedTimeoutThreshold = " + msecLocalizedTimeoutThreshold + "\r\n";
		msg += "secSessionTimerHeartbeat = " + secSessionTimerHeartbeat + "\r\n";
		msg += "secSessionHeartbeartTransition = " + secSessionHeartbeartTransition + "\r\n";
		alert(msg);
	}
}



function StartSessionTimer()
{
	if (msecLocalizedWarningThreshold<=0 || msecLocalizedTimeoutThreshold<=0)
	{
		window.status = "Session Timeout: Not available";
	}
	else
	{
		SessionHeartBeat();
	}
}

function SessionHeartBeat()
{
	var dCheckLastActivity = new Date(GetLastActivity());
	if (dCheckLastActivity.getTime()!=dStartingLastActivity.getTime())
	{
		SetTimerValues();
	}
	msecLocalizedWarningThreshold=msecLocalizedWarningThreshold-(secSessionHeartbeartTransition*1000);
	msecLocalizedTimeoutThreshold=msecLocalizedTimeoutThreshold-(secSessionHeartbeartTransition*1000);
	var remainder = msecLocalizedWarningThreshold % 60000;
	if (!bSessionExpired && (msecLocalizedTimeoutThreshold<=0 || msecLocalizedTimeoutThreshold<=msecLocalizedWarningThreshold))
	{
		ShowExpired();
	}
	else if (msecLocalizedWarningThreshold <= 0 && msecLocalizedTimeoutThreshold >= 0 && !bWarningActive)
	{
		window.status = "Tempo Session near expiration.";
		try
		{
			if (DialogActive())
			{
				CloseDialog();
			}
		}
		catch(e){}
		ShowWarning();
	}
	else if (!bWarningActive && !bSessionExpired)
	{
		var statusMsg = "Session Timeout: " + ((msecLocalizedTimeoutThreshold - (msecLocalizedTimeoutThreshold % 60000)) /1000/60) + " mins. ";
		if (bDebugSession)
			statusMsg += (((msecLocalizedTimeoutThreshold % 60000) - (msecLocalizedTimeoutThreshold % 1000)) /1000) + " sec.  " + "Session Warning: " + ((msecLocalizedWarningThreshold - (msecLocalizedWarningThreshold % 60000)) /1000/60) + " mins. " + (((msecLocalizedWarningThreshold % 60000) - (msecLocalizedWarningThreshold % 1000)) /1000) + " sec.";
		window.status = statusMsg;
		if (DialogActive())
		{
			CloseDialog();
		}
	}
	else if (bWarningActive)
	{
		window.status = "Tempo Session near expiration.";
	}
	else if (bSessionExpired)
	{
		window.status = "Tempo Session expired.";
	}
	else
	{
		var statusMsg = "Session Timeout: " + ((msecLocalizedTimeoutThreshold - (msecLocalizedTimeoutThreshold % 60000)) /1000/60) + " mins. ";
		if (bDebugSession)
			statusMsg += (((msecLocalizedTimeoutThreshold % 60000) - (msecLocalizedTimeoutThreshold % 1000)) /1000) + " sec.  " + "Session Warning: " + ((msecLocalizedWarningThreshold - (msecLocalizedWarningThreshold % 60000)) /1000/60) + " mins. " + (((msecLocalizedWarningThreshold % 60000) - (msecLocalizedWarningThreshold % 1000)) /1000) + " sec.";
		window.status = statusMsg;
		if (DialogActive())
		{
			CloseDialog();
		}
	}
	if ((bWarningActive || bSessionExpired) && (!DialogActive()))
	{
		if (bWarningActive && !bSessionExpired)
		{
			try
			{
				if (DialogActive())
				{
					CloseDialog();
					ShowWarning();
				}
			}
			catch(e){}
		}
		else if (bSessionExpired)
		{
			try
			{
				if (DialogActive())
				{
					CloseDialog();
					ShowWarning();
					ShowExpired();
				}
			}
			catch(e){}
		}
	}
	if (bWarningActive)
	{
		secSessionHeartbeartTransition = 1;
		iSessionTimerID = self.setTimeout("SessionHeartBeat()",secSessionHeartbeartTransition*1000);
	}
	else 
	{
		secSessionHeartbeartTransition = secSessionTimerHeartbeat;
		iSessionTimerID = self.setTimeout("SessionHeartBeat()",secSessionHeartbeartTransition*1000);
	}
	if (bDebugSession)
	{
		ShowSessionValues();
	}
}

function ResetWarning()
{
	if (!bSessionExpired)
	{
		bWarningActive = false;
	}
}

function ShowWarning()
{
	bWarningActive = true;
	sessionDialog = openCenteredOnOpenerWindow("", "timeout", 350, 200, "", false, "","opener");
	var dlgDoc = sessionDialog.document;
	var msg =  "<html>";
	msg += "\r\n\t<head>";
	msg += "\r\n\t\t<title>Session Timeout Warning</title>";
	msg += "\r\n\t\t<style>";
	msg += "\r\n\t\t\tbody{font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;font-size: 10px;}";
	msg += "\r\n\t\t\t.okbutton{font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;font-size: 10px;font-weight: bold;width: 100px;}";
	msg += "\r\n\t\t\t.content{font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;font-size: 10px;}";
	msg += "\r\n\t\t</style>";
	msg += "\r\n\t\t<script language=\"javascript\">";
	msg += "\r\n\t\t\twindow.onload = _onload;";
	msg += "\r\n\t\t\tfunction _onload()";
	msg += "\r\n\t\t\t{";
	msg += "\r\n\t\t\t\twindow.focus();";
	msg += "\r\n\t\t\t\tself.setTimeout(\"_onload()\",100);";
	msg += "\r\n\t\t\t\t\ttry{";
	msg += "\r\n\t\t\t\tif ((typeof(window.opener)=='undefined' || !window.opener.bWarningActive) && document.sessionWarning.Expired.value==\"false\")";
	msg += "\r\n\t\t\t\t{";
	msg += "\r\n\t\t\t\t\tdocument.sessionWarning.DoExtend.value=\"true\";";
	msg += "\r\n\t\t\t\t\tself.close();";
	msg += "\r\n\t\t\t\t}";
	msg += "\r\n\t\t\t\t\t}catch(e){}";
	msg += "\r\n\t\t\t}";
	msg += "\r\n\t\t\tfunction Extend()";
	msg += "\r\n\t\t\t{";
	msg += "\r\n\t\t\t\tdocument.sessionWarning.DoExtend.value=\"true\";";
	msg += "\r\n\t\t\t}";
	msg += "\r\n\t\t\tfunction CloseMe()";
	msg += "\r\n\t\t\t{";
	msg += "\r\n\t\t\t\tself.close();";
	msg += "\r\n\t\t\t}";
	msg += "\r\n\t\t\tfunction PromptUser()";
	msg += "\r\n\t\t\t{";
	msg += "\r\n\t\t\t\tif (document.sessionWarning.DoExtend.value==\"false\")";
	msg += "\r\n\t\t\t\t{";
	msg += "\r\n\t\t\t\t\treturn \"Closing the timeout dialog will not extend your Tempo session.\";";
	msg += "\r\n\t\t\t\t}";
	msg += "\r\n\t\t\t}";
	msg += "\r\n\t\t\tfunction SetupOnbeforeunload()";
	msg += "\r\n\t\t\t{";
	msg += "\r\n\t\t\t\twindow.onbeforeunload=PromptUser;";
	msg += "\r\n\t\t\t}";
	msg += "\r\n\t\t\tfunction ResetWarning()";
	msg += "\r\n\t\t\t{";
	msg += "\r\n\t\t\t\t\ttry{";
	msg += "\r\n\t\t\t\tif (typeof(window.opener)=='undefined' || !window.opener.bWarningActive)";
	msg += "\r\n\t\t\t\t{";
	msg += "\r\n\t\t\t\t\t\twindow.opener.ResetWarning();";
	msg += "\r\n\t\t\t\t}";
	msg += "\r\n\t\t\t\t\t}catch(e){}";
	msg += "\r\n\t\t\t}";
	msg += "\r\n\t\t\tfunction SetupOnunload()";
	msg += "\r\n\t\t\t{";
	msg += "\r\n\t\t\t\twindow.onunload=ResetWarning;";
	msg += "\r\n\t\t\t}";
	msg += "\r\n\t\t\tfunction SetupOnunloadBypass(){}";
	msg += "\r\n\t\t\tfunction SetExpired()";
	msg += "\r\n\t\t\t{";
	msg += "\r\n\t\t\t\twindow.onbeforeunload=SetupOnunloadBypass;";
	msg += "\r\n\t\t\t\twindow.onunload=SetupOnunloadBypass;";
	msg += "\r\n\t\t\t\tdocument.sessionWarning.Expired.value=\"true\";";
	msg += "\r\n\t\t\t\tExtend();";
	msg += "\r\n\t\t\t\tdocument.getElementById('message').innerHTML=\"To prevent account misuse, you have been logged out of Tempo.  Click &quot;OK&quot; to login to Tempo.\";";
	msg += "\r\n\t\t\t\tdocument.sessionWarning.okbutton.onclick=CloseMe;";
	msg += "\r\n\t\t\t\twindow.opener.RedirectForTimeout();";
	msg += "\r\n\t\t\t}";
	msg += "\r\n\t\t</script>";
	msg += "\r\n\t\t</head>";
	msg += "\r\n\t<body>";
	msg += "\r\n\t\t<form id=\"sessionWarning\" name=\"sessionWarning\" action=\"/TempoCommon/Authentication/RenewSession.aspx\" method=\"post\">";
	msg += "\r\n\t\t\t<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"350px\">";
	msg += "\r\n\t\t\t\t<tr>";
	msg += "\r\n\t\t\t\t\t<td><img src=\"/TempoCommon/Authentication/Images/sessionTimeout.jpg\" border=\"0\" /></td>";
	msg += "\r\n\t\t\t\t</tr>";
	msg += "\r\n\t\t\t\t<tr>";
	msg += "\r\n\t\t\t\t\t<td class=\"content\"><div id=\"message\" class=\"content\">To prevent account misuse, we automatically log you out of your account after ";
	msg += "\r\n\t\t\t\t\t" + minSessionTimeoutThreshold + " minutes of inactivity. To Avoid being logged off automatically and continue ";
	msg += "\r\n\t\t\t\t\tusing the Tempo system, click the &quot;OK&quot; button below.</div></td>";
	msg += "\r\n\t\t\t\t</tr>";
	msg += "\r\n\t\t\t\t<tr>";
	msg += "\r\n\t\t\t\t\t<td align=\"center\">";
	msg += "\r\n\t\t\t\t\t\t<br\\><input class=\"okbutton\" id=\"okbutton\" name=\"okbutton\" type=\"button\" value=\"OK\" onclick=\"javascript:Extend();document.sessionWarning.submit();\">";
	msg += "\r\n\t\t\t\t\t\t<input type=\"hidden\" id=\"DoExtend\" name=\"DoExtend\" value=\"false\"><input type=\"hidden\" id=\"Expried\" name=\"Expired\" value=\"false\"></td>";
	msg += "\r\n\t\t\t\t</tr>";
	msg += "\r\n\t\t\t</table>";
	msg += "\r\n\t\t</form>";
	msg += "\r\n\t</body>";
	msg += "\r\n</html>";
	dlgDoc.write(msg);
	dlgDoc.close();
	eval("sessionDialog._onload()");
	eval("sessionDialog.SetupOnbeforeunload()");
	eval("sessionDialog.SetupOnunload()");
}

function ShowExpired()
{
	document.cookie="LastActivity=01/01/2006 00:00:00 AM; path=/";
	bSessionExpired = true;
	if (DialogActive())
	{
		eval("sessionDialog.SetExpired()");
	}
}

function GetLastActivity()
{
	var dc = document.cookie;
	var prefix = 'LastActivity=';
	var begin = dc.indexOf('; ' + prefix);
	if (begin == -1)
	{
		begin = dc.indexOf(prefix);
		if (begin != 0) return null;
	}
	else begin += 2;
	var end = document.cookie.indexOf(';', begin);
	if (end == -1) end = dc.length;
	return unescape(dc.substring(begin + prefix.length, end));
}

function DialogActive()
{
	var isActive = true;
	if (sessionDialog != null)
	{
		if (typeof(sessionDialog.closed)!='undefined')
		{
			isActive = !sessionDialog.closed;
		}
		else
		{
			isActive = false;
		}
	}
	else
	{
		isActive = false;
	}
	return isActive;
}

function CloseDialog()
{
	if (DialogActive())
	{
		try
		{
			if (typeof(sessionDialog.document.sessionExpired)!='undefined')
			{
				sessionDialog.document.sessionExpired.DoExtend.value = "true";
			}
			else if (typeof(sessionDialog.document.sessionWarning)!='undefined')
			{
				sessionDialog.document.sessionWarning.DoExtend.value = "true";
			}
			sessionDialog.CloseMe();
		}
		catch(e)
		{
		}
	}
}

function openPositionedWindow(url, name, width, height, x, y, status, scrollbars, moreProperties, openerName) 
{
	var agent = navigator.userAgent.toLowerCase();
	if (agent.indexOf("mac") != -1 && agent.indexOf("msie") != -1 && (agent.indexOf("msie 4") != -1 || agent.indexOf("msie 5.0") != -1) ) 
	{
		height += (status) ? 17 : 2;
	}
	width += (scrollbars != '' && scrollbars != null && agent.indexOf("mac") == -1) ? 16 : 0;
	var properties = 'width=' + width + ',height=' + height + ',screenX=' + x + ',screenY=' + y + ',left=' + x + ',top=' + y + ((status) ? ',status' : '') + ',scrollbars' + ((scrollbars) ? '' : '=no') + ((moreProperties) ? ',' + moreProperties : '');
	var reference = openWindow(url, name, properties, openerName);
	return reference;
}

function openCenteredWindow(url, name, width, height, status, scrollbars, moreProperties, openerName) 
{
	var x, y = 0;
	if (screen) 
	{
		x = (screen.availWidth - width) / 2;
		y = (screen.availHeight - height) / 2;
	}
	if (!status) status = '';
	if (!openerName) openerName = '';
	var reference = openPositionedWindow(url, name, width, height, x, y, status, scrollbars, moreProperties, openerName);
	return reference;
}   

function openCenteredOnOpenerWindow(url, name, width, height, status, scrollbars, moreProperties, openerName) 
{
	var centerX = 0;
	var centerY = 0;
	if (window.top.screenX != null && window.top.outerWidth) 
	{
		centerX = window.top.screenX + (window.top.outerWidth / 2);
		centerY = window.top.screenY + (window.top.outerHeight / 2);
	}
	else if (window.top.screenLeft) 
	{
		if (document.documentElement) 
		{
			centerX = window.top.screenLeft + (window.top.document.documentElement.offsetWidth / 2);
			centerY = window.top.screenTop + (window.top.document.documentElement.offsetHeight / 2);
		}
		else if (window.top.document.body && window.top.document.body.offsetWidth) 
		{
			centerX = window.top.screenLeft + (window.top.document.body.offsetWidth / 2);
			centerY = window.top.screenTop + (window.top.document.body.offsetHeight / 2);
		}
	}
	if (centerX == 0) 
	{
		openCenteredWindow(url, name, width, height, status, scrollbars, moreProperties, openerName);
	}
	var x = parseInt(centerX - (width / 2));
	var y = parseInt(centerY - (height / 2));
	if (!status) status = '';
	if (!openerName) openerName = '';
	var reference = openPositionedWindow(url, name, width, height, x, y, status, scrollbars, moreProperties, openerName);
	return reference;
}

function openWindow(url, name, properties, openerName) 
{
	var agent = navigator.userAgent.toLowerCase();
	if (agent.indexOf("msie") != -1 && parseInt(navigator.appVersion) == 4 && agent.indexOf("msie 5") == -1 && agent.indexOf("msie5") == -1 && agent.indexOf("win") != -1 && url.indexOf('http://') == 0)
	{
		winReference = window.open('about:blank', name, properties);
		setTimeout('if (winReference && !winReference.closed) winReference.location.replace("' + url + '")', 300);
	}
	else
	{
		winReference = window.open(url, name, properties);
	}
	setTimeout('if (winReference && !winReference.closed) winReference.focus()', 200);
	if (openerName) self.name = openerName;
	return winReference;
}
