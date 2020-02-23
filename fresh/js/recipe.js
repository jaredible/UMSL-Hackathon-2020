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
