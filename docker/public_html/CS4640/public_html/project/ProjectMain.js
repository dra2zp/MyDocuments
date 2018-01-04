// D.J. Anderson
// dra2zp
// Project
// ProjectMain.js

// JavaScript for manipulating the main page

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
	var gpa = $.ajax({
		// send an AJAX request to get the credits and final grades for all the user's classes
		type: "GET",
		url: "ProjectController.php?request=gpa",
		dataType: "json"
	});
	gpa.done(function(data) {
		// calculate the user's grade point average
		for (var i = 0; i < data.length; i++) {
			var letter = data[i]["final_grade"];
			if (letter != null) {
				var credits = parseFloat(data[i]["credits"]);
				credit_sum += credits;
				var gradeNum = convertGrade(letter);
				grade_sum += (gradeNum * credits);
			}
		}
		var gpa = round((grade_sum / credit_sum), 3);
		// display the user's gpa to the screen
		$("#gpa").append(
			'<h3><strong>' + gpa +'</strong></h3>'
		);
	});
	var numA_plus = 0;
	var numA = 0;
	var numA_minus = 0;
	var numB_plus = 0;
	var numB = 0;
	var numB_minus = 0;
	var numC_plus = 0;
	var numC = 0;
	var numC_minus = 0;
	var numD_plus = 0;
	var numD = 0;
	var numD_minus = 0;
	var numF = 0;
	var graph = $.ajax({
		// send an AJAX request to get the frequency of all the letter grades
		type: "GET",
		url: "ProjectController.php?request=getFrequency",
		dataType: "json"
	});
	graph.done(function(data) {
		// store all the frequencies as variables
		for (var i = 0; i < data.length; i++) {
			if (data[i]["final_grade"] == "A+") {
				numA_plus += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "A") {
				numA += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "A-") {
				numA_minus += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "B+") {
				numB_plus += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "B") {
				numB += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "B-") {
				numB_minus += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "C+") {
				numC_plus += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "C") {
				numC += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "C-") {
				numC_minus += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "D+") {
				numD_plus += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "D") {
				numD += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "D-") {
				numD_minus += data[i]["COUNT(*)"];
			}
			if (data[i]["final_grade"] == "F") {
				numF += data[i]["COUNT(*)"];
			}
		}
		// the following code is from a third-party library to graph data
		// displays a bar graph with the letter grades on the bottom and the frequency on the side
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			// bar graph
			type: 'bar',
			data: {
				// labels for the x-axis
				labels: ["A+", "A", "A-", "B+", "B", "B-", "C+", "C", "C-", "D+", "D", "D-", "F"],
				datasets: [{
					// label for the y-axis
					label: 'Grade Fequency',
					// data from the AJAX request
					data: [numA_plus, numA, numA_minus, numB_plus, numB, numB_minus, numC_plus, numC, numC_minus, numD_plus, numD, numD_minus, numF],
					backgroundColor: [
						// colors for the bars on the graph
						'rgb(0, 51, 0)',
						'rgb(0, 153, 51)',
						'rgb(51, 204, 51)',
						'rgb(0, 51, 102)',
						'rgb(0, 102, 153)',
						'rgb(51, 204, 204)',
						'rgb(0, 0, 102)',
						'rgb(51, 51, 255)',
						'rgb(51, 102, 255)',
						'rgb(102, 0, 102)',
						'rgb(204, 0, 204)',
						'rgb(255, 0, 255)',
						'rgb(204, 0, 0)'
					],
					borderColor: [
						'rgb(0, 51, 0)',
						'rgb(0, 153, 51)',
						'rgb(51, 204, 51)',
						'rgb(0, 51, 102)',
						'rgb(0, 102, 153)',
						'rgb(51, 204, 204)',
						'rgb(0, 0, 102)',
						'rgb(51, 51, 255)',
						'rgb(51, 102, 255)',
						'rgb(102, 0, 102)',
						'rgb(204, 0, 204)',
						'rgb(255, 0, 255)',
						'rgb(204, 0, 0)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							// begin the y-axis at zero
							beginAtZero:true
						}
					}]
				}
			}
		});
	});
});