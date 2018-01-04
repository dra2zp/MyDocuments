// D.J. Anderson
// dra2zp
// Project
// ProjectGrades.js
// 06-30-2017-907

// JavaScript for maniuplating the grades page

// initialize the global variables
// set the total points earned to zero
// set the total points possible to zero
// set the user's goal to zero
// set the number of points for the goal to zero
// initialize the distribution as an array
// create an array letters to store all the letter grades
// initialize the system as a string to contain either P for points or W for weights
// initialize the categories as an array
// initialize the weights as an array
// initialize the grade percentages as an array
// initialize the grade categories as an array
// initialize the grade weights as an array
// initialize the subtotals as an array
// initialize the goal grades as an array
// initialize the goal categories as an array
// initialize the goal subtotals as an array
var points_earned_sum = 0;
var points_possible_sum = 0;
var goal_earned = 0;
var goal_possible = 0;
var distribution = [];
var letters = ["F", "D-", "D", "D+", "C-", "C", "C+", "B-", "B", "B+", "A-", "A", "A+"];
var system = "";
var categories = [];
var weights = [];
var gradesPercents = [];
var gradesCategories = [];
var gradesWeights = [];
var subtotals = [];
var goal_grades = [];
var goal_categories = [];
var goal_subtotals = [];

function round(value, decimals) {
	// rounds a value to a certain number of decimal places
	return (Number(Math.round(value + 'e' + decimals) + 'e-' + decimals));
}

function get_grade(value) {
	// gets the letter grade given a value between 0 and 1 (0% and 100%)
	// the distribution array contains a list of grade thresholds in order from F to A+
	// iterates through the distribution and compares the value to the grade thresholds to obtain the appropriate letter grade for the value
	var position = 0;
	if (value >= 1 || value >= distribution[12]) {
		return "A+";
	}
	if (value <= 0) {
		return "F";
	}
	while (position < 13) {
		if (parseFloat(round(value, 4)) >= parseFloat(round(distribution[position], 4))) {
			position++;
		}
		else {
			return letters[position - 1];
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
	if (value >= distribution[12]) {
		$("body").attr('id', 'green1');
	}
	else if (value >= distribution[11]) {
		$("body").attr('id', 'green2');
	}
	else if (value >= distribution[10]) {
		$("body").attr('id', 'green3');
	}
	else if (value >= distribution[9]) {
		$("body").attr('id', 'blue1');
	}
	else if (value >= distribution[8]) {
		$("body").attr('id', 'blue2');
	}
	else if (value >= distribution[7]) {
		$("body").attr('id', 'blue3');
	}
	else if (value >= distribution[6]) {
		$("body").attr('id', 'yellow1');
	}
	else if (value >= distribution[5]) {
		$("body").attr('id', 'yellow2');
	}
	else if (value >= distribution[4]) {
		$("body").attr('id', 'yellow3');
	}
	else if (value >= distribution[3]) {
		$("body").attr('id', 'orange1');
	}
	else if (value >= distribution[2]) {
		$("body").attr('id', 'orange2');
	}
	else if (value >= distribution[1]) {
		$("body").attr('id', 'orange3');
	}
	else if (value >= distribution[0]) {
		$("body").attr('id', 'red');
	}
	else if (value <= 0) {
		$("body").attr('id', 'red');
	}
}

function get_weight(value) {
	// output the weight for a given category
	// returns -1 if the category could not be found in the array
	var weight = -1;
	for (var i = 0; i < categories.length; i++) {
		if (categories[i] == value) {
			weight = weights[i];
			break;
		}
	}
	return weight;
}

function constructor() {
	// constructor
	
	// removes all the previously obtained data
	// deletes the form
	var parent_node = document.getElementById("system");
	while (parent_node.firstChild) {
		parent_node.removeChild(parent_node.firstChild);
	}
	
	// deletes the grades table
	var parent_node = document.getElementById("grades-body");
	while (parent_node.firstChild) {
		parent_node.removeChild(parent_node.firstChild);
	}
	
	// deletes the subtotals grade table headings
	var parent_node = document.getElementById("subtotal-head");
	while (parent_node.firstChild) {
		parent_node.removeChild(parent_node.firstChild);
	}
	
	// deletes the subtotals grade table body
	var parent_node = document.getElementById("subtotal-body");
	while (parent_node.firstChild) {
		parent_node.removeChild(parent_node.firstChild);
	}
	
	// deletes the final grade table
	var parent_node = document.getElementById("final-grade-body");
	while (parent_node.firstChild) {
		parent_node.removeChild(parent_node.firstChild);
	}
	
	// reset the variables to zero so they don't interfere with future calls to the construct() function
	points_earned_sum = 0;
	points_possible_sum = 0;
	goal_earned = 0;
	goal_possible = 0;
	distribution = [];
	letters = ["F", "D-", "D", "D+", "C-", "C", "C+", "B-", "B", "B+", "A-", "A", "A+"];
	system = "";
	categories = [];
	weights = [];
	gradesPercents = [];
	gradesCategories = [];
	gradesWeights = [];
	subtotals = []
	goal_grades = [];
	goal_categories = [];
	goal_subtotals = [];

	// sets up the form for the user to input assignments and grades
	// depends on whether the system is points or weighted
	var type = $.ajax({
		// send an AJAX request to obtain the system
		type: "GET",
		url: "ProjectController.php?request=system",
		dataType: "json"
	});
	type.done(function(data) {
		system = data[0]["system"];
		// if the class's grades are based on a points system
		if (system == "P") {
			// deletes the form
			var parent_node = document.getElementById("system");
			while (parent_node.firstChild) {
				parent_node.removeChild(parent_node.firstChild);
			}
			
			// deletes the table headings
			var parent_node = document.getElementById("grades-head");
			while (parent_node.firstChild) {
				parent_node.removeChild(parent_node.firstChild);
			}
			
			// deletes the subtotals grade table headings
			var parent_node = document.getElementById("subtotal-head");
			while (parent_node.firstChild) {
				parent_node.removeChild(parent_node.firstChild);
			}
			
			// deletes the subtotals grade table body
			var parent_node = document.getElementById("subtotal-body");
			while (parent_node.firstChild) {
				parent_node.removeChild(parent_node.firstChild);
			}
			
			points_earned_sum = 0;
			points_possible_sum = 0;
			goal_earned = 0;
			goal_possible = 0;
			distribution = [];
			letters = ["F", "D-", "D", "D+", "C-", "C", "C+", "B-", "B", "B+", "A-", "A", "A+"];
			categories = [];
			weights = [];
			gradesPercents = [];
			gradesCategories = [];
			gradesWeights = [];
			subtotals = [];
			goal_grades = [];
			goal_categories = [];
			goal_subtotals = [];
			
			// output the appropriate form for a points system
			$("#system").append(
				'<div class="form-group">' +
					'<label class="control-label" for="assignment-name">Assignment Name</label>' +
					'<input type="text" id="assignment-name" name="assignment" class="form-control"></input>' +
				'</div>' +
				'<div class="form-group">' +
					'<label class="control-label" for="points-earned">Points Earned</label>' +
					'<input type="number" id="points-earned" name="points_earned" class="form-control"></input>' +
				'</div>' +
				'<div class="form-group">' +
					'<label class="control-label" for="points-possible">Points Possible</label>' +
					'<input type="number" id="points-possible" name="points_possible" class="form-control"></input>' +
				'</div>' +
				'<button class="btn bton-submit" id="add" name="createGrade">Add Assignment</button>' +
				'<button class="btn bton-submit" id="calculate">Calculate Minimum Grade</button>'
			);
			$("#grades-head").append(
				'<tr><th>Assignment Name</th><th>Points Earned</th><th>Points Possible</th><th>Percentage</th><th>Grade</th><th>&nbsp</th></tr>'
			);
							
			// register a new click event for when the user presses the add assignment button
			$("#add").click(function(evt) {
				// prevent the default action
				evt.preventDefault();
				
				// if the class is a points system
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
					data: {category: "NULL", assignment: assignment_name, points_earned: points_earned, points_possible: points_possible}
				});
				addGrade.done(function(data) {
					// call the constructor() function
					constructor();
				});
				
				// clear the form values
				$("#assignment-name").val("");
				$("#points-earned").val("");
				$("#points-possible").val("");
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
				
				var populate = $.ajax({
					// send an AJAX request to obtain all the user's grades to populate the table
					type: "GET",
					url: "ProjectController.php?request=showGrades",
					dataType: "json"
				});
				populate.done(function(data) {
					// deletes the grades table
					var parent_node = document.getElementById("grades-body");
					while (parent_node.firstChild) {
						parent_node.removeChild(parent_node.firstChild);
					}
					
					// deletes the subtotals grade table headings
					var parent_node = document.getElementById("subtotal-head");
					while (parent_node.firstChild) {
						parent_node.removeChild(parent_node.firstChild);
					}
					
					// deletes the subtotals grade table body
					var parent_node = document.getElementById("subtotal-body");
					while (parent_node.firstChild) {
						parent_node.removeChild(parent_node.firstChild);
					}
					
					// deletes the final grade table
					var parent_node = document.getElementById("final-grade-body");
					while (parent_node.firstChild) {
						parent_node.removeChild(parent_node.firstChild);
					}
					
					// populate the table with the user's grades
					for (var i = 0; i < data.length; i++) {
						var assignment = data[i]["assignment"];
						var points_earned = round(parseFloat(data[i]["points_earned"]), 2);
						var points_possible = round(parseFloat(data[i]["points_possible"]), 2);
						var score = round(points_earned, 2) / round(points_possible, 2);
						var decimal = round(score * 100, 2);
						var percentage = decimal +"%";
						var grade = get_grade(score);
						points_earned_sum += points_earned;
						points_possible_sum += points_possible;
						$("#grades-body").append(
							// display the user's grades to the screen by adding the assignments to the table
							'<tr><td class="' + assignment + '">' + assignment + '</td><td class="' + points_earned + '">' + points_earned +
							'</td><td class="' + points_possible + '">' + points_possible + '</td><td>' + percentage +
							'</td><td>' + grade + '</td><td><span class="glyphicon glyphicon-remove grade-remove"></span>' + '</td></tr>'
						);
					}
					
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
					$("#final-grade-body").append(
						// display the user's final percentage and final grade to the screen by adding them to the final grades table
						'<tr><td>' + final_percentage + '</td><td>' + final_grade + '</td></tr>'
					);
				});
			});
			
			// register a new click event for when the user clicks on the button to calculate the minimum grade they can receive on a pending assignment
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
						dataType: "json"
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
							dataType: "json"
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
		}
		// if a class's grades are based on weights and categories
		if (system == "W") {
			var categoriesAndWeights = $.ajax({
				// send an AJAX request to obtain all the user's categories and weights to store into the arrays
				type: "GET",
				url: "ProjectController.php?request=showWeights",
				dataType: "json"
			});
			categoriesAndWeights.done(function(data) {
				categories = [];
				weights = [];
				// store all the categories into the categories array
				// store all the weights into the weights array
				for (var i = 0; i < data.length; i++) {
					categories.push(data[i]["category"]);
					weights.push(data[i]["weight"]);
				}
				
				// deletes the form
				var parent_node = document.getElementById("system");
				while (parent_node.firstChild) {
					parent_node.removeChild(parent_node.firstChild);
				}
				
				// deletes the table headings
				var parent_node = document.getElementById("grades-head");
				while (parent_node.firstChild) {
					parent_node.removeChild(parent_node.firstChild);
				}
				
				points_earned_sum = 0;
				points_possible_sum = 0;
				goal_earned = 0;
				goal_possible = 0;
				distribution = [];
				letters = ["F", "D-", "D", "D+", "C-", "C", "C+", "B-", "B", "B+", "A-", "A", "A+"];
				gradesPercents = [];
				gradesCategories = [];
				gradesWeights = [];
				subtotals = [];
				goal_grades = [];
				goal_categories = [];
				goal_subtotals = [];
				
				// output the appropriate form for a weights system			
				$("#system").append(
					'<div class="form-group">' +
						'<label class="control-label" for="assignment-name">Assignment Name</label>' +
						'<input type="text" id="assignment-name" name="assignment" class="form-control"></input>' +
					'</div>' +
					'<div class="form-group">' +
						'<label class="control-label" for="cat">Category</label><br>' +
						'<select name="cat" id="add-cats" required>' +
						'</select>' +
					'</div>' +
					'<div class="form-group">' +
						'<label class="control-label" for="points-earned">Points Earned</label>' +
						'<input type="number" id="points-earned" name="points_earned" class="form-control"></input>' +
					'</div>' +
					'<div class="form-group">' +
						'<label class="control-label" for="points-possible">Points Possible</label>' +
						'<input type="number" id="points-possible" name="points_possible" class="form-control"></input>' +
					'</div>' +
					'<button class="btn bton-submit" id="add" name="createGrade">Add Assignment</button>' +
					'<button class="btn bton-submit" id="calculate">Calculate Minimum Grade</button>'
				);
				for (var i = 0; i < categories.length; i++) {
					$("#add-cats").append(
						'<option class="' + categories[i] + '" value="' + categories[i] + '">' + categories[i] +'</option>'
					);
				}
				
				$("#grades-head").append(
					'<tr><th>Assignment Name</th><th>Category</th><th>Weight</th><th>Points Earned</th><th>Points Possible</th><th>Percentage</th><th>Grade</th><th>&nbsp</th></tr>'
				);
				
				$("#add").click(function(evt) {
					// prevent the default action
					evt.preventDefault();
					
					// if the class is a weights system
					// store the values from the form into variables
					// validate form input
					var assignment_name = $("#assignment-name").val();
					var cat_name = document.getElementById("add-cats");
					var cat = cat_name.options[cat_name.selectedIndex].value;
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
						data: {assignment: assignment_name, category: cat, points_earned: points_earned, points_possible: points_possible}
					});
					addGrade.done(function(data) {
						// call the constructor() function
						constructor();
					});
					
					// clear the form values
					$("#assignment-name").val("");
					$("#category").val("");
					$("#points-earned").val("");
					$("#points-possible").val("");
				});
				
				// register a new click event for when the user clicks the X glyphicon to remove an assignment/grade
				$("#grades").on("click", "table .grade-remove", function(evt) {
					// prevent the default action
					evt.preventDefault();
					
					// find out which assignment was removed by adding ids to DOM nodes and retrieving those values
					$(evt.target).parent().parent().attr('id', 'remove');
					$("#remove > :nth-child(1)").attr('id', 'get_assignment');
					$("#remove > :nth-child(2)").attr('id', 'get_category');
					$("#remove > :nth-child(3)").attr('id', 'get_points_earned');
					$("#remove > :nth-child(4)").attr('id', 'get_points_possible');
					var removeAssignment = $("#get_assignment").attr('class');
					var removeCategory = $("#get_category").attr('class');
					var removePointsEarned = $("#get_points_earned").attr('class');
					var removePointsPossible = $("#get_points_possible").attr('class');
					
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
					
					var populate = $.ajax({
						// send an AJAX request to obtain all the user's grades to populate the table
						type: "GET",
						url: "ProjectController.php?request=showGrades",
						dataType: "json"
					});
					populate.done(function(data) {
						// deletes the grades table
						var parent_node = document.getElementById("grades-body");
						while (parent_node.firstChild) {
							parent_node.removeChild(parent_node.firstChild);
						}
						
						// deletes the subtotals grade table headings
						var parent_node = document.getElementById("subtotal-head");
						while (parent_node.firstChild) {
							parent_node.removeChild(parent_node.firstChild);
						}
						
						// deletes the subtotals grade table body
						var parent_node = document.getElementById("subtotal-body");
						while (parent_node.firstChild) {
							parent_node.removeChild(parent_node.firstChild);
						}
						
						// deletes the final grade table
						var parent_node = document.getElementById("final-grade-body");
						while (parent_node.firstChild) {
							parent_node.removeChild(parent_node.firstChild);
						}
						
						// populate the table with the user's grades
						for (var i = 0; i < data.length; i++) {
							var assignment = data[i]["assignment"];
							var category = data[i]["category"]
							var weight = parseFloat(get_weight(category));
							var weight100 = round((weight * 100), 2);
							var weightPercent = weight100 + "%";
							var points_earned = round(parseFloat(data[i]["points_earned"]), 2);
							var points_possible = round(parseFloat(data[i]["points_possible"]), 2);
							var score = round(points_earned, 2) / round(points_possible, 2);
							var decimal = round(score * 100, 2);
							var percentage = decimal +"%";
							var grade = get_grade(score);
							gradesPercents.push(decimal);
							gradesCategories.push(category);
							gradesWeights.push(weight);
							$("#grades-body").append(
								// display the user's grades to the screen by adding the assignments to the table
								'<tr><td class="' + assignment + '">' + assignment + '</td><td class="' + category + '">' + category +
								'</td><td>' + weightPercent + '</td><td class="' + points_earned + '">' + points_earned +
								'</td><td class="' + points_possible + '">' + points_possible + '</td><td>' + percentage +
								'</td><td>' + grade + '</td><td><span class="glyphicon glyphicon-remove grade-remove"></span>' + '</td></tr>'
							);
						}
						
						// deletes the subtotals grade table headings
						var parent_node = document.getElementById("subtotal-head");
						while (parent_node.firstChild) {
							parent_node.removeChild(parent_node.firstChild);
						}
						
						// deletes the subtotals grade table body
						var parent_node = document.getElementById("subtotal-body");
						while (parent_node.firstChild) {
							parent_node.removeChild(parent_node.firstChild);
						}
						
						// if the grades have been entered
						// calculate the subtotal grade for each category
						for (var i = 0; i < categories.length; i++) {
							$("#subtotal-head").append(
								'<th>' + categories[i] + '</th>'
							);
						}
						$("#subtotal-head").append(
							'<th>&nbsp</th>'
						);
						
						subtotals = [];
						
						for (var i = 0; i < categories.length; i++) {
							var sub = -1;
							var count = 0;
							for (var j = 0; j < gradesCategories.length; j++) {
								if (categories[i] == gradesCategories[j]) {
									if (count == 0) {
										sub = 0;
									}
									sub += (gradesPercents[j] * gradesWeights[j]);
									count++;
								}
							}
							if (sub != -1) {
								var avg_raw = (sub / count) * 100;
								var avg = round(avg_raw / (weights[i] * 100), 2);
								$("#subtotal-body").append(
									'<td>' + avg + '% ' + get_grade((sub / count) / (weights[i] * 100)) + '</td>'
								);
								subtotals.push(avg_raw);
							}
							else {
								$("#subtotal-body").append(
									'<td>&nbsp</td>'
								);
								subtotals.push("NULL");
							}
						}
						
						// if grade subtotals have been entered
						// calculate the final percentage and final letter grade
						var weightTotal = 0;
						var gradeTotal = 0;
						for (var i = 0; i < subtotals.length; i++) {
							if (subtotals[i] != "NULL") {
								weightTotal += parseFloat(weights[i]);
								gradeTotal += parseFloat(subtotals[i]);
							}
						}
						//if (weightTotal) {
							// deletes the final grade table
							var parent_node = document.getElementById("final-grade-body");
							while (parent_node.firstChild) {
								parent_node.removeChild(parent_node.firstChild);
							}
							
							var final_score = (round(gradeTotal, 2) / round(weightTotal, 2)) / 10000;
							var final_decimal = round((final_score * 100), 2);
							var final_percentage = final_decimal + "%";
							var final_grade = get_grade(final_score);
							change_color(final_score);
							
							var import_final = $.ajax({
								// send an AJAX request to set the final letter grade for the class
								type: "POST",
								url: "ProjectController.php?request=final_grade",
								data: {final_grade: final_grade}
							});
							$("#final-grade-body").append(
								// display the user's final percentage and final grade to the screen by adding them to the final grades table
								'<tr><td>' + final_percentage + '</td><td>' + final_grade + '</td></tr>'
							);
						//}
					});
				});
				
				// register a new click event for when the user clicks on the button to calculate the minimum grade they can receive on a pending assignment
				$("#calculate").click(function(evt) {
					// prevent the default action
					evt.preventDefault();
					
					$("#goal").append(
						// display the form to the screen so that the user can enter the information needed to calculate their desired minimum grade
						'<label class="control-label" for="cat">Category</label><br>' +
						'<select name="cat" id="add-cats-min" required>' +
						'</select><br>' +
						'<label class="control-label" for="goal-grade">What is your percent goal for the class?</label>' +
						'<input type="text" id="goal-grade" name="goal-grade" class="form-control" required></input>' +
						'<button class="btn bton-submit" id="calc-min" href="#">Calculate!</button>'
					);
					
					for (var i = 0; i < categories.length; i++) {
						$("#add-cats-min").append(
							'<option class="' + categories[i] + '" value="' + categories[i] + '">' + categories[i] +'</option>'
						);
					}
					
					// register a new click event for when the user clicks on the button to submit their information for calculating their minimum grade
					$("#calc-min").click(function(evt) {
						// prevent the default action
						evt.preventDefault();
						
						var grades = $.ajax({
							// send an AJAX request to obtain the grades for all of the user's assignments
							type: "GET",
							url: "ProjectController.php?request=showGrades",
							dataType: "json"
						});
						grades.done(function(data) {
							goal_grades = [];
							goal_categories = [];
							goal_subtotals = [];
							for (var i = 0; i < data.length; i++) {
								goal_categories.push(data[i]["category"]);
								goal_grades.push(parseFloat(data[i]["points_earned"]) / parseFloat(data[i]["points_possible"]));
							}
							for (var i = 0; i < categories.length; i++) {
								var sub = -1;
								var count = 0;
								for (var j = 0; j < goal_categories.length; j++) {
									if (categories[i] == goal_categories[j]) {
										if (count == 0) {
											sub = 0;
										}
										sub += (gradesPercents[j] * gradesWeights[j]);
										count++;
									}
								}
								if (sub != -1) {
									var avg_raw = sub / count;
									goal_subtotals.push(avg_raw);
								}
								else {
									goal_subtotals.push("NULL");
								}
							}
							var totalWeights = 0;
							for (var i = 0; i < goal_subtotals.length; i++) {
								if (goal_subtotals[i] != "NULL") {
									totalWeights += parseFloat(weights[i]);
								}
							}
							// retrieve the numbers entered by the user into the form
							// calculate the minimum number of points needed and the corresponding percentage and letter grade for the pending assignment
							var goal = parseFloat($("#goal-grade").val());
							var letter_goal = get_grade(goal / 100);
							var category_goal_name = document.getElementById("add-cats-min");
							var category_goal = category_goal_name.options[category_goal_name.selectedIndex].value;
							var weight_goal = get_weight(category_goal);
							var subtract = 0;
							var theCategory = 0;
							for (var i = 0; i < categories.length; i++) {
								if (categories[i] != category_goal && goal_subtotals[i] != "NULL") {
									subtract += parseFloat(goal_subtotals[i]);
								}
								else if (categories[i] == category_goal) {
									theCategory = i;
								}
							}
							if (goal_subtotals[theCategory] == "NULL") {
								totalWeights += parseFloat(weights[theCategory]);
							}
							var goal_grade = goal * totalWeights;
							var catGoal = goal_grade - subtract;
						        var min_cat_percent = (catGoal / get_weight(categories[theCategory]));
						        var goal_cat_total = 0;
						        var goal_cat_num = 0;
						        for (var i = 0; i < goal_categories.length; i++) {
							    if (goal_categories[i] == category_goal) {
							        goal_cat_total += parseFloat(goal_grades[i]);
							        goal_cat_num++;
							    }
						        }
						        var min_percent = 0;
						        var goal_cat_min_total = 0;
						        var goal_sub = 0;
						        if (goal_cat_num == 0) {
							    min_percent = min_cat_percent;
						        }
						        else {
							    goal_cat_min_total = (min_cat_percent / 100) * (goal_cat_num + 1);
							    goal_sub = goal_cat_min_total - goal_cat_total;
							    min_percent = goal_sub * 100;
						        }
						        min_percent = round(min_percent, 2);
						        var min_letter = get_grade(min_percent / 100);

						        $("#output").append(
								// display the information to the user including the calculated minimum number of points needed
								'<h3>You need <strong>' + min_percent + '% ' + min_letter + '</strong> in order to have ' + goal + '% ' + letter_goal + ' in the class.</h3>'
							);
							
							// call the constructor() function
							constructor();
						});
					});
				});
			});
		}
	});
}

$(function() {
	// wait until the DOM is fully loaded
	
	// call the constructor() function
	constructor();
});
