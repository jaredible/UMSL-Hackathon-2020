$(document).ready(function() {
	/* Hide database editor when input is empty and vice versa */
	$("#editor-form").ready(function() {
		isFormEmpty = true;
		$('#editor-form input[type="text"]').each(function() {
			if ($(this).val() !== "") {
				isFormEmpty = false;
				return false;
			}
		});

		if (isFormEmpty) {
			$("#editor").hide(0);
		} else {
			$("#editor-toggler").hide(0);
		}
	});

	/* Show database editor when clicked */
	$("#editor-toggler-button").click(function() {
		$("#editor-toggler").hide(0);
		$("#editor").show(500);
	});
});

/* Sort by name column (descending or ascending) */
function sortCurrentField(n, u, v) {
	if (n < 0) {
		document.location.href = "index.php?mn=" + u + "&cn=" + v + "&desc";
	} else {
		document.location.href = "index.php?mn=" + u + "&cn=" + v;
	}
}
