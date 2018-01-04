// D.J. Anderson
// dra2zp
// Project
// ProjectMain.js
// 06-28-2017-25

// JavaScript for manipulating the main page

$(function() {
	// wait until the DOM is fully loaded
	var request = $.ajax({
		// send an AJAX request to show all the user's semesters
		type: "GET",
		url: "ProjectController.php?request=showSemesters",
		dataType: "json"
	});
	request.done(function(data) {
		// display all the semesters to the screen
		for (var i = 0; i < data.length; i++) {
			$("#semesters").append(
				'<li role="presentation"><a href="ProjectClasses.php?semester=' + data[i]["semester"] + '">' + data[i]["semester"] + '</a></li>'
			);
		}
	});
});