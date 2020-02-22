$(document).ready(function() {
	/* Deactivate "JavaScript is not enable" error message */
	$("#javascript-warning").ready(function() {
		// $('#javascript-warning').dimmer('toggle');
		$("#javascript-warning").fadeOut(0);
	});

	/* Close alert message when clicked */
	$(".message .close").click(function() {
		$(this)
			.closest(".message")
			.fadeOut();
	});
});
