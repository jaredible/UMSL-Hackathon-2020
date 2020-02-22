$(document).ready(function() {
	$("[id^=like]").each(function(x) {
		$("#like" + x).click(function() {
			y = $("#l-val" + x).html();
			y++;
			$("#l-val" + x).html(y);
		});
	});

	$("[id^=dislike]").each(function(x) {
		$("#dislike" + x).click(function() {
			y = $("#d-val" + x).html();
			y++;
			$("#d-val" + x).html(y);
		});
	});
});

/*
document.addEventListener("DOMContentLoaded", function() {
	// For Likes
	document.getElementById("like0").addEventListener("click", function() {
		document.getElementById("l-val0").innerHTML++;
	});
	document.getElementById("like1").addEventListener("click", function() {
		document.getElementById("l-val1").innerHTML++;
	});
	document.getElementById("like2").addEventListener("click", function() {
		document.getElementById("l-val2").innerHTML++;
	});

	// For Dislikes
	document.getElementById("dislike0").addEventListener("click", function() {
		document.getElementById("d-val0").innerHTML++;
	});
	document.getElementById("dislike1").addEventListener("click", function() {
		document.getElementById("d-val1").innerHTML++;
	});
	document.getElementById("dislike2").addEventListener("click", function() {
		document.getElementById("d-val2").innerHTML++;
	});
});
*/
