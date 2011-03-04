// Check ZIP Code on Service Area page
function zip_checker(datastr,zip) {
	$.ajax({
		type: "POST",
		url: "checkzip.php",
		data: datastr,
		cache: false,
		success: function(html) {			
			if (html.search(/http/) >= 0) { recordLink('GenBook',zip);window.location.href=html; } else {
				$("#response").html(html);
				$("#response").fadeIn("fast");
			}
		}
	});
}

function fetchZips(datastr) {
	datastr = datastr+"&a=zip";
	$.ajax({
		type: "POST",
		url: "fetch_zips.php",
		data: datastr,
		cache: false,
		success: function(html) {
			$("#zips").html(html);
		}
	});
}

function fetchURL(datastr) {
	datastr = datastr+"&a=url";
	$.ajax({
		type: "POST",
		url: "fetch_zips.php",
		data: datastr,
		cache: false,
		success: function(html) {
			$("#url").val(html);
			var newhtml = "<a href=\""+html+"\" target=\"_blank\">"+html+"</a>";
			$("#click_url").html(newhtml);
		}
	});
}

// record outbound clicks from the service area page
function recordLink(category, action) {
	 try {
    //var myTracker=_gaq._getTrackerByName();
    _gaq.push(['_trackEvent', category, action]);
  }catch(err){}
}

// When the check zip button is clicked
$(document).ready(function(){
if($("#checkzip")) {
	$("#checkzip").click(function(){
		var zip = $("#testzip").val();
		var datastr="zip="+zip;
		$("#response").html('Checking ZIP Code...');
		$("#response").fadeIn();
		setTimeout("zip_checker('"+datastr+"','"+zip+"')",300);
	});
}


// Service area select change
if($("#service_area")) {
	if ($("#service_area").is('select')) {
		$("#service_area").change(function(){
			var sa = $("#service_area").val();
			var datastr = "id="+sa;
			document.getElementById("id").value=sa;
			document.getElementById("action").value="edit";
			setTimeout("fetchZips('"+datastr+"')",100);
			setTimeout("fetchURL('"+datastr+"')",100);
		});
	}
}
	
});


// do not allow the Enter key to submit forms or do anything useful
document.onkeypress = stopRKey;
function stopRKey() {
	var evt = (evt) ? evt : ((event) ? event : null);
	var node = (evt.target) ? evt.target : ((evt.srcElement) ? eve.srcElement : null);
	if ((evt.keyCode==13) && (node.type=="text")) {return false;}
} // end function stopRKey()

function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && ((node.type=="text") || (node.type=="select-one")))  {return false;} 
} 


function testBtn() {
	//alert("content height: "+document.getElementById("content_div").clientHeight+"\nbody height: "+document.body.clientHeight);
	//alert("total height: "+totalHeight+"\nbody height: "+document.body.clientHeight);
	//alert(window.location);
	//var str =  String(window.location);
	//if (str.match(/template.html/i)) { loc = window.location; } else { loc = "whoops"; }
	//alert(loc);
	alert("window width: "+window.innerWidth);
	alert("window height:"+a);
	//alert("window size height:"+document.getElementById("content_div").clientHeight);
}

function chkRadio(rad) {
	bChk=false;
	//if (!rad.length) { bChk=true; }
	for(i=0;i<rad.length;i++) {
		if(rad[i].checked) {
			bChk=true;
		}
	}
	return bChk;
}

function getRadioValue(rad) {
	ret = false;
	for(i=0;i<rad.length;i++) {
		if(rad[i].checked) {
			ret = rad[i].value;
		} // end if
	}
	return ret;
} // end function getRadioValue

function chkApplicationForm() {
	x = document.applicationform;
		
	if(chkRadio(x.position)==false) {
		alert("Please tell us the position for which you are applying.");
		x.position[0].focus();
		return false;
	} // end if position=""
	
	if((getRadioValue(x.position)=="O") && (x.other_position.value=="")) {
		alert("Please tell us for which position your are applying.");
		x.other_position.focus();
		return false;
	} // end if position = other & explain = ""
	
	if(x.firstname.value=="") {
		alert("Please input your first name");
		x.firstname.focus();
		return false;
	} // end if
	
	if(x.lastname.value=="") {
		alert("Please input your last name");
		x.lastname.focus();
		return false;
	} // end if
	
	if(x.street_address.value=="") {
		alert("Please input your street address");
		x.street_address.focus();
		return false;
	} // end if

	if(x.city.value=="") {
		alert("Please input your city");
		x.city.focus();
		return false;
	} // end if
	
	if(x.state.value=="") {
		alert("Please input your state");
		x.state.focus();
		return false;
	} // end if

	if(x.zip.value=="") {
		alert("Please input your zip code");
		x.zip.focus();
		return false;
	} // end if

	if(x.email.value=="") {
		alert("Please input your email");
		x.email.focus();
		return false;
	} // end if

	if (!x.email.value=="") {
		var newstring= new String (x.email.value);
		eml = new RegExp("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$");
		if (!eml.test(newstring.toLowerCase())) {
			alert("You must enter a valid email address. (example: yourname@internet.com)");
			x.email.value="";
			x.email.focus();
			return false;
		}
	} // end if

	if(x.phone.value=="") {
		alert("Please input your phone number");
		x.phone.focus();
		return false;
	} // end if

	if(chkRadio(x.gps)==false) {
		alert("Please tell us if you have a mobile GPS device.");
		x.gps[0].focus();
		return false;
	} // end if position=""

	if(chkRadio(x.sms)==false) {
		alert("Please tell us if you have a mobile device with Text Message or SMS capabilities.");
		x.sms[0].focus();
		return false;
	} // end if position=""

	if((x.dob_month.value=="") || (x.dob_day.value=="") || (x.dob_year.value=="")) {
		alert("Please tell us your birthday.");
		x.dob_month.focus();
		return false;
	}

	if(chkRadio(x.legal_worker)==false) {
		alert("Please tell us if you are authorized to legally work in the US.");
		x.legal_worker[0].focus();
		return false;
	} // end if position=""

	if(chkRadio(x.felony)==false) {
		alert("Please tell us if you have ever been convicted of a felony.");
		x.felony[0].focus();
		return false;
	} // end if position=""

	if((getRadioValue(x.felony)=="Y") && (x.felony_explain.value=="")) {
		alert("Please briefly explain your felony conviction.");
		x.felony_explain.focus();
		return false;
	} // end if position = other & explain = ""

	if(x.start_date_month.value=="" || x.start_date_day.value=="" || x.start_date_year.value=="") {
		alert("Please tell us the date your are available to start work");
		x.start_date_month.focus();
		return false;
	}

	if(x.special_skills.value=="") {
		alert("Please tell us briefly about any special skills you have.");
		x.special_skills.focus();
		return false;
	} // end if

	if(chkRadio(x.license)==false) {
		alert("Please tell us if you are a licensed massage therapist.");
		x.license[0].focus();
		return false;
	} // end if
	
	if((getRadioValue(x.license)=="Y") && (x.license_num.value=="")) {
		alert("Please provide your license number.");
		x.license_num.focus();
		return false;
	} // end if
	
	if(x.years_experience.value=="") {
		alert("Please tell us how many years experience you have.");
		x.years_experience.focus();
		return false;
	} // end if

	if(chkRadio(x.own_table)==false) {
		alert("Please tell us if you own a massage table.");
		x.own_table[0].focus();
		return false;
	} // end if position=""
	
	if(chkRadio(x.own_chair)==false) {
		alert("Please tell us if you own a massage chair.");
		x.own_chair[0].focus();
		return false;
	} // end if position=""

	if(chkRadio(x.tx_liability)==false) {
		alert("Please tell us if you have liability insurance in Texas.");
		x.tx_liability[0].focus();
		return false;
	} // end if position=""

	if(chkRadio(x.availability)==false) {
		alert("Please tell us your availability: part time or full time?");
		x.availability[0].focus();
		return false;
	} // end if position=""

	if(chkRadio(x.education)==false) {
		alert("Please tell us your highest level of education");
		x.eduction[0].focus();
		return false;
	} // end if position=""

	if((getRadioValue(x.education)=="O") && x.education_other.value=="") {
		alert("Please explain what other education you have.");
		x.education_other.focus();
		return false;
	} // end if

	return true;
} // end function chkApplication
