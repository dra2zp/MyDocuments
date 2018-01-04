// D.J. Anderson
// dra2zp
// Project
// ProjectGrades.js

// JavaScript for maniuplating the grades page

// initialize the global variables
// set the total points earned to zero
// set the total points possible to zero
// set the user's goal to zero
// set the number of points for the goal to zero
// initialize the distribution as an array
// create an array letters to store all the letter grades
var points_earned_sum = 0;
var points_possible_sum = 0;
var goal_earned = 0;
var goal_possible = 0;
var distribution = [];
var letters = ["F", "D-", "D", "D+", "C-", "C", "C+", "B-", "B", "B+", "A-", "A", "A+"];

function round(value, decimals) {
	// rounds a value to a certain number of decimal places
	return (Number(Math.round(value + 'e' + decimals) + 'e-' + decimals));
}

function get_grade(value) {
	// gets the letter grade given a value between 0 and 1 (0% and 100%)
	// the distribution array contains a list of grade thresholds in order from F to A+
	// iterates through the distribution and compares the value to the grade thresholds to obtain the appropriate letter grade for the value
	var position = 0;
	if (value >= 1) {
		return "A+";
		position = 14;
	}
	while (position < 14) {
		if (value >= distribution[position]) {
			position++;
		}
		else {
			return letters[position - 1];
			position = 14;
		}
	}
}

function change_color(value) {
	// change the color of the screen depending on the final letter grade according to the class's grading scale
	// green for A
	// blue for B
	// yellow for C
	// orange for D
	// red for F
	if (value >= distribution[10]) {
		$("body").attr('id', 'green');
	}
	else if (value >= distribution[7]) {
		$("body").attr('id', 'blue');
	}
	else if (value >= distribution[4]) {
		$("body").attr('id', 'yellow');
	}
	else if (value >= distribution[1]) {
		$("body").attr('id', 'orange');
	}
	else if (value >= distribution[0]) {
		$("body").attr('id', 'red');
	}
}

function constructor() {
	// constructor
	
	// removes all the previously obtained data
	// deletes the grades table
	var parent_node = document.getElementById("grades-body");
	while (parent_node.firstChild) {
		parent_node.removeChild(parent_node.firstChild);
	}
	
	// deletes the final grade table
	var parent_node = document.getElementById("final-grade-body");
	while (parent_node.firstChild) {
		parent_node.removeChild(parent_node.firstChild);
	}

	var earned = $.ajax({
		// send an AJAX request to obtain all the points earned for every assignment
		type: "GET",
		url: "ProjectController.php?request=pointsEarned",
		dataType: "json"
	});
	earned.done(function(data) {
		// sum up all the points earned
		for (var i = 0; i < data.length; i++) {
			points_earned_sum += (parseFloat(data[i]["points_earned"]));
		}
	});
	
	var possible = $.ajax({
		// send an AJAX request to obtain all the points possible for every assignment
		type: "POST",
		url: "ProjectController.php?request=pointsPossible",
		dataType: "json"
	});
	possible.done(function(data) {
		// sum up all the points possible
		for (var i = 0; i < data.length; i++) {
			points_possible_sum += (parseFloat(data[i]["points_possible"]));
		}
	});
	
	var scale = $.ajax({
		// send an AJAX request to obtain the grading scale for the class
		type: "GET",
		url: "ProjectController.php?request=gradingScale",
		dataType: "json"
	});
	scale.done(function(data) {
		// stores the grade thresholds into the distribution array in order from F to A+
		distribution.push(data[0]["f"]);
		distribution.push(data[0]["d_minus"]);
		distribution.push(data[0]["d"]);
		distribution.push(data[0]["d_plus"]);
		distribution.push(data[0]["c_minus"]);
		distribution.push(data[0]["c"]);
		distribution.push(data[0]["c_plus"]);
		distribution.push(data[0]["b_minus"]);
		distribution.push(data[0]["b"]);
		distribution.push(data[0]["b_plus"]);
		distribution.push(data[0]["a_minus"]);
		distribution.push(data[0]["a"]);
		distribution.push(data[0]["a_plus"]);
	});
	
	var populate = $.ajax({
		// send an AJAX request to obtain all the user's grades to populate the table
		type: "GET",
		url: "ProjectController.php?request=showGrades",
		dataType: "json"
	});
	populate.done(function(data) {
		// populate the table with the user's grades
		for (var i = 0; i < data.length; i++) {
			var assignment = data[i]["assignment"];
			var points_earned = round(parseFloat(data[i]["points_earned"]), 2);
			var points_possible = round(parseFloat(data[i]["points_possible"]), 2);
			var score = round(points_earned, 2) / round(points_possible, 2);
			var decimal = round(score * 100, 2);
			var percentage = decimal +"%";
			var grade = get_grade(score);
			$("#grades-body").append(
				// display the user's grades to the screen by adding the assignments to the table
				'<tr><td class="' + assignment + '">' + assignment + '</td><td class="' + points_earned + '">' + points_earned +
				'</td><td class="' + points_possible + '">' + points_possible + '</td><td>' + percentage +
				'</td><td>' + grade + '</td><td><span class="glyphicon glyphicon-remove grade-remove"></span>' + '</td></tr>'
			);
		}
	});

	if (points_possible_sum == 0) {
		// if the total points possible is zero
		// set the final percentage and final grade to a value of **
		var final_percentage = "**";
		var final_grade = "**";
	}
	else {
		// if grades have been entered
		// calculate the final percentage and final letter grade
		var final_score = round(points_earned_sum, 2) / round(points_possible_sum, 2);
		var final_decimal = round(final_score * 100, 2);
		var final_percentage = final_decimal + "%";
		var final_grade = get_grade(final_score);
		change_color(final_score);
		var import_final = $.ajax({
			// send an AJAX request to set the final letter grade for the class
			type: "POST",
			url: "ProjectController.php?request=final_grade",
			data: {final_grade: final_grade}
		});
	}
	
	$("#final-grade-body").append(
		// display the user's final percentage and final grade to the screen by adding them to the final grades table
		'<tr><td>' + final_percentage + '</td><td>' + final_grade + '</td></tr>'
	);
	
	// reset the variables to zero so they don't interfere with future calls to the construct() function
	points_earned_sum = 0;
	points_possible_sum = 0;
	goal_earned = 0;
	goal_possible = 0;
}

$(function() {
	// wait until the DOM is fully loaded
	
	// call the constructor() function
	constructor();
	
	// register a new click event for when the user enters a new assignment/grade
	$("#add").click(function(evt) {
		
		// prevent the default action
		evt.preventDefault();
		
		// store the values from the form into variables
		// validate form input
		var assignment_name = $("#assignment-name").val();
		var points_earned = $("#points-earned").val();
		var points_possible = $("#points-possible").val();
		if (assignment_name.length == 0 || assignment_name.length > 40) {
			alert("Assignment Name must be between 1 and 40 characters");
			return;
		}
		if (isNaN(parseFloat(points_earned)) || points_earned.length == 0) {
			alert("Points Earned must be a number");
			return;
		}
		if (isNaN(parseFloat(points_possible)) || points_possible.length == 0) {
			alert("Points Possible must be a number");
			return;
		}
		
		var addGrade = $.ajax({
			// send an AJAX request to store the new assignment into the database
			type: "POST",
			url: "ProjectController.php?request=newGrade",
			data: {category: "NULL", weight: "NULL", assignment: assignment_name, points_earned: points_earned, points_possible: points_possible}
		});
		addGrade.done(function(data) {
			// call the constructor() function
			constructor();
		});
		
		// clear the form values
		$("#assignment-name").val("");
		$("#points-earned").val("");
		$("#points-possible").val("");
		
		setTimeout(function() {
			// automatically reload the page one time after 0.5 seconds in order to counter the lag that occurs when entering new assignments/grades
			document.getElementById("invisible").click();
		}, 500);
	});
	
	// register a new click event for when the user clicks the X glyphicon to remove an assignment/grade
	$("#grades").on("click", "table .grade-remove", function(evt) {
		
		// prevent the default action
		evt.preventDefault();
		
		// find out which assignment was removed by adding ids to DOM nodes and retrieving those values
		$(evt.target).parent().parent().attr('id', 'remove');
		$("#remove > :nth-child(1)").attr('id', 'get_assignment');
		$("#remove > :nth-child(2)").attr('id', 'get_points_earned');
		$("#remove > :nth-child(3)").attr('id', 'get_points_possible');
		var removeAssignment = $("#get_assignment").attr('class');
		var removePointsEarned = $("#get_points_earned").attr('class');
		var removePointsPossible = $("#get_points_possible").attr('class');
		// subtract the removed assignment's points earned from the total points earned
		points_earned_sum -= (parseFloat(removePointsEarned));
		// subtract the removed assignment's points possible from the total points possible
		points_possible_sum -= (parseFloat(removePointsPossible));
		
		var removeGrade = $.ajax({
			// send an AJAX request to delete the user's assignment/grade from the database
			type: "POST",
			url: "ProjectController.php?request=deleteGrade",
			data: {assignment: removeAssignment}
		});
		removeGrade.done(function(data) {
			// call the constructor() function
			constructor();
		});
		
		setTimeout(function() {
			// automatically reload the page one time after 0.5 seconds in order to counter the lag that occurs when entering new assignments/grades
			document.getElementById("invisible").click();
		}, 500);
	});
	
	// register a new lick event for when the user clicks on the button to calculate the minimum grade they can receive on a pending assignment
	$("#calculate").click(function(evt) {
	
		// prevent the default action
		evt.preventDefault();
		
		$("#goal").append(
			// display the form to the screen so that the user can enter the information needed to calculate their desired minimum grade
			'<label class="control-label" for="goal-possible">How many points is the assignment worth?</label>' +
			'<input type="number" id="goal-possible" name="goal-possible" class="form-control" required></input>' +
			'<label class="control-label" for="goal-grade">What is your percent goal for the class?</label>' +
			'<input type="text" id="goal-grade" name="goal-grade" class="form-control" required></input>' +
			'<button class="btn bton-submit" id="calc-min" href="#">Calculate!</button>'
		);
		
		// register a new click event for when the user clicks on the button to submit their information for calculating their minimum grade
		$("#calc-min").click(function(evt) {
		
			// prevent the default action
			evt.preventDefault();
			
			var earned = $.ajax({
				// send an AJAX request to obtain the total number of points earned on all of the user's assignments
				type: "GET",
				url: "ProjectController.php?request=pointsEarned",
				dataType: "json",
			});
			earned.done(function(data) {
				// sum up the total number of points earned
				for (var i = 0; i < data.length; i++) {
					goal_earned += (parseFloat(data[i]["points_earned"]));
				}
				var possible = $.ajax({
					// send an AJAX request to obtain the total number of points possible on all of the user's assignments
					type: "GET",
					url: "ProjectController.php?request=pointsPossible",
					dataType: "json",
				});
				possible.done(function(data) {
					// sum up the total number of points possible
					for (var i = 0; i < data.length; i++) {
						goal_possible += (parseFloat(data[i]["points_possible"]));
					}
					
					// retrieve the numbers entered by the user into the form
					// calculate the minimum number of points needed and the corresponding percentage and letter grade for the pending assignment
					var points_possible_goal = parseFloat($("#goal-possible").val());
					var goal = parseFloat($("#goal-grade").val());
					var total_possible = goal_possible + points_possible_goal;
					var min = round((((goal / 100) * total_possible) - goal_earned), 2);
					var letter_goal = get_grade(goal / 100);
					var min_percent = round(((min / points_possible_goal) * 100), 2);
					var min_letter = get_grade(min / points_possible_goal);
				
					$("#output").append(
						// display the information to the user including the calculated minimum number of points needed
						'<h3>You need <strong>' + min + ' / ' + points_possible_goal + ' = ' + min_percent + '% ' + min_letter + '</strong> in order to have ' + goal + '% ' + letter_goal + ' in the class.</h3>'
					);
					
					// call the constructor() function
					constructor();
				});
			});
		});
	});
	
	// register a new click event for when JavaScript automatically clicks this invisible button to render the page correctly to account for lags
	$("#invisible").click(function(evt) {
		
		// prevent the default action
		evt.preventDefault();
		
		// call the constructor() function
		constructor();
	});
	
	setTimeout(function() {
		// re-display the information on the page by registering a click event that calls the constructor() function 100 milliseconds after the first rendering
		document.getElementById("invisible").click();
    }, 100);
});