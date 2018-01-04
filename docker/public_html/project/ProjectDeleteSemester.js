// D.J. Anderson
// dra2zp
// Project
// ProjectDeleteSemester.js
// 07-15-2017-25

// JavaScript for manipulating the delete semester page

$(function() {
	// wait until the DOM is fully loaded
	var request = $.ajax({
		// send an AJAX request to retrieve all the semesters for the user
		type: "GET",
		url: "ProjectController.php?request=showSemesters",
		dataType: "json"
	});
	request.done(function(data) {
		// display all the user's classes as radio buttons so that the user can select which class they want to remove
		for (var i = 0; i < data.length; i++) {
			$("#semesters").append(
				'<input id="semester" name="semester" type="radio" value="' + data[i]["semester"] + '">' + data[i]["semester"] +'</input><br>'
			);
		}
	});
});