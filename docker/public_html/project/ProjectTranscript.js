// D.J. Anderson
// dra2zp
// Project
// ProjectTranscript.js
// 06-29-2017-127

// JavaScript for manipulating the transcript page

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
	
	var semesters = $.ajax({
		type: "GET",
		url: "ProjectController.php?request=showSemesters",
		dataType: "json"
	});
	semesters.done(function(data) {
		var sems = [];
		for (var i = 0; i < data.length; i++) {
			sems.push(data[i]["semester"]);
		}
	
		var transcript = $.ajax({
			type: "GET",
			url: "ProjectController.php?request=viewTranscript",
			dataType: "json"
		});
		transcript.done(function(data) {
			for (var i = 0; i < sems.length; i++) {
				$("#grades-table").append(
					'<tr><th>' + sems[i] + '</th></tr>' +
					'<tbody>'
				);
				var count = 0;
				var credits = 0;
				var grades = 0;
				for (var j = 0; j < data.length; j++) {
					if (sems[i] == data[j]["semester"]) {
						if (count == 0) {
							$("#grades-table").append(
								'<tr><th>Class</th><th>Credits</th><th>Final Grade</th></tr>'
							);
						}
						count++;
						if (data[j]["final_grade"]) {
							credits += parseFloat(data[j]["credits"]);
						}
						grades += (convertGrade(data[j]["final_grade"]) * parseFloat(data[j]["credits"]));
						$("#grades-table").append(
							'<tr><td>' + data[j]["title"] + '</td><td>' + data[j]["credits"] + '</td><td>' + data[j]["final_grade"] + '</td></tr>'
						);
					}
					if (j == data.length - 1 && count != 0) {
						credit_sum += credits;
						grade_sum += grades;
						$("#grades-table").append(
							'<tr><td>&nbsp</td><td><strong>Semester Credit Total: ' + credits + '</strong></td><td><strong>Semester GPA: ' + round((grades / credits), 3) + '</strong></td></tr>'
						);
					}
					if (j == data.length - 1) {
						$("#grades-table").append(
							'</tbody>'
						);
					}
				}
			}
			if (credit_sum != 0) {
				$("#stats").append(
					'<h1><strong>Cumulative Credit Total: ' + credit_sum + '</strong></h1>' +
					'<h1><strong>Cumulative GPA: ' + round((grade_sum / credit_sum), 3) + '</strong></h1>'
				);
			}
		});
	});
});