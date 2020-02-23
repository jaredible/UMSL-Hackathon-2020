$(document).ready(function() {
	$("[id^=like]").each(function(x) {
		$("#like" + x).click(function() {
			y = $("#l-val" + x).html();
			y++;
			$("#l-val" + x).html(y);

			$.post("../view/recipe.php", {
				like_id: x,
				like_value: y
			});
		});
	});

	$("[id^=dislike]").each(function(x) {
		$("#dislike" + x).click(function() {
			y = $("#d-val" + x).html();
			y++;
			$("#d-val" + x).html(y);

			$.post("../view/recipe.php", {
				dislike_id: x,
				dislike_value: y
			});
		});
	});
});
