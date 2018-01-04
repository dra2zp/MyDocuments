// D.J. Anderson
// dra2zp
// Project
// ProjectRemoveClass.js
// 06-28-2017-25

// JavaScript for manipulating the remove class page

$(function() {
	// wait until the DOM is fully loaded
	var request = $.ajax({
		// send an AJAX request to retrieve all the classes for the user
		type: "GET",
		url: "ProjectController.php?request=showClasses",
		dataType: "json"
	});
	request.done(function(data) {
		// display all the user's classes as radio buttons so that the user can select which class they want to remove
		for (var i = 0; i < data.length; i++) {
			$("#classes").append(
				'<input id="title" name="title" type="radio" value="' + data[i]["title"] + '">' + data[i]["title"] +'</input><br>'
			);
		}
	});
});