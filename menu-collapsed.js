$(document).ready(function(){
	$("#menu li").hide();
	$("#menu li a").mouseover(function(){
		$(this).slideToggle("slow");
	});
	$("#menu li a").mouseout(function(){
		$(this).slideToggle("fast");
	});
})
