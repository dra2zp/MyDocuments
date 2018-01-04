// D.J. Anderson
// dra2zp
// Project
// ProjectClasses.js
// 06-28-2017-77

// JavaScript for manipulating the classes page

// initialize the total credits and the total grades to zero and set them as global variables to be accessed by any function
var credit_sum = 0;
var grade_sum = 0;

function round(value, decimals) {
	// rounds a value to a given number of decimal places
	return (Number(Math.round(value + 'e' + decimals) + 'e-' + decimals));
}

function convertGrade(letter) {
	// converts a letter grade to a grade point average
	if (letter == "A+") {
		return 4.0;
	}
	else if (letter == "A") {
		return 4.0;
	}
	else if (letter == "A-") {
		return 3.7;
	}
	else if (letter == "B+") {
		return 3.3;
	}
	else if (letter == "B") {
		return 3.0;
	}
	else if (letter == "B-") {
		return 2.7;
	}
	else if (letter == "C+") {
		return 2.3;
	}
	else if (letter == "C") {
		return 2.0;
	}
	else if (letter == "C-") {
		return 1.7;
	}
	else if (letter == "D+") {
		return 1.3;
	}
	else if (letter == "D") {
		return 1.0;
	}
	else if (letter == "D-") {
		return 0.7;
	}
	else {
		return 0.0;
	}
}

$(function() {
	// wait until the DOM is fully loaded
	var request = $.ajax({
		// send an AJAX request to show all the user's classes
		type: "GET",
		url: "ProjectController.php?request=showClasses",
		dataType: "json"
	});
	request.done(function(data) {
		// display all the classes to the screen
		for (var i = 0; i < data.length; i++) {
			$("#classes").append(
				'<li role="presentation"><a href="ProjectGrades.php?class=' + data[i]["title"] + '">' + data[i]["title"] + '</a></li>'
			);
		}
	});
});