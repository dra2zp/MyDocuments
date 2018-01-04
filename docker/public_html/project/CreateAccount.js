// D.J. Anderson
// dra2zp
// Project
// CreateAccount.js
// 06-28-2017-20

// JavaScript file for manipulating the create account page

$(function() {
	// wait until the DOM is fully loaded
	$("#click").click(function(evt) {
		// if the create account button is clicked
		// show a success message after 1 secondto give time for the error message to appear
		setTimeout(function() {
			$("#success").append(
				'<h2><strong>Account created successfully!</strong></h2>'
			);
		}, 1000);
	});
});