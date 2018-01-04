<?php
session_start();

// D.J. Anderson
// dra2zp
// Project
// ProjectController.php

// requires the view class
require_once('ProjectView.php');

// instantiate the view class
$view = new ProjectView();
// get the name of the request
$request = $_GET['request'];
if (!isset($_SESSION['username']) && $request != 'getName' && $request != 'newUser' && $request != 'make') {
	// if the session variable username is not sent and the request requires the use of this session variable
	// redirect the user to the login page
	header('Location:ProjectLogin.php');
}
else if ($request == 'make') {
	// creates the database
	$view->make();
}
else if (isset($_SESSION['username']) && $request == 'getName') {
	// calls the function to set the user's name
	$view->setName($_SESSION['username']);
	// redirect the user to the login success page
	header('Location:LoginSuccess.php');
}
else if (isset($_POST['cmd']) && $_POST['cmd'] == 'createAccount' && $request == 'newUser') {
	// call the function to store the new user's information into the database
	$first = $_POST['first'];
	$last = $_POST['last'];
	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	$view->newUser($first, $last, $username, $password);
}
else if ($request == 'showClasses') {
	// call the function to show the user's classes
	$username = $_SESSION['username'];
	$view->showClasses($username);
}
else if (isset($_POST['cmd']) && $_POST['cmd'] == 'createClass' && $request == 'newClass') {
	// call the function to create a new class in the database for the user
	$username = $_SESSION['username'];
	$title = $_POST['title'];
	$credits = $_POST['credits'];
	$a_plus = $_POST['a_plus'];
	$a = $_POST['a'];
	$a_minus = $_POST['a_minus'];
	$b_plus = $_POST['b_plus'];
	$b = $_POST['b'];
	$b_minus = $_POST['b_minus'];
	$c_plus = $_POST['c_plus'];
	$c = $_POST['c'];
	$c_minus = $_POST['c_minus'];
	$d_plus = $_POST['d_plus'];
	$d = $_POST['d'];
	$d_minus = $_POST['d_minus'];
	$f = $_POST['f'];
	$system = $_POST['system'];
	$category1 = $_POST['category1'];
	$weight1 = $_POST['weight1'];
	$category2 = $_POST['category2'];
	$weight2 = $_POST['weight2'];
	$category3 = $_POST['category3'];
	$weight3 = $_POST['weight3'];
	$category4 = $_POST['category4'];
	$weight4 = $_POST['weight4'];
	$category5 = $_POST['category5'];
	$weight5 = $_POST['weight5'];
	$category6 = $_POST['category6'];
	$weight6 = $_POST['weight6'];
	$category7 = $_POST['category7'];
	$weight7 = $_POST['weight7'];
	$category8 = $_POST['category8'];
	$weight8 = $_POST['weight8'];
	$category9 = $_POST['category9'];
	$weight9 = $_POST['weight9'];
	$category10 = $_POST['category10'];
	$weight10 = $_POST['weight10'];
	if ($_POST['system'] == 'P') {
		$category1 = NULL;
		$weight1 = NULL;
		$category2 = NULL;
		$weight2 = NULL;
		$category3 = NULL;
		$weight3 = NULL;
		$category4 = NULL;
		$weight4 = NULL;
		$category5 = NULL;
		$weight5 = NULL;
		$category6 = NULL;
		$weight6 = NULL;
		$category7 = NULL;
		$weight7 = NULL;
		$category8 = NULL;
		$weight8 = NULL;
		$category9 = NULL;
		$weight9 = NULL;
		$category10 = NULL;
		$weight10 = NULL;
	}
	if ($_POST['category1'] == "") {
		$category1 = NULL;
	}
	if ($_POST['weight1'] == "") {
		$weight1 = NULL;
	}
	if ($_POST['category2'] == "") {
		$category2 = NULL;
	}
	if ($_POST['weight2'] == "") {
		$weight2 = NULL;
	}
	if ($_POST['category3'] == "") {
		$category3 = NULL;
	}
	if ($_POST['weight3'] == "") {
		$weight3 = NULL;
	}
	if ($_POST['category4'] == "") {
		$category4 = NULL;
	}
	if ($_POST['weight4'] == "") {
		$weight4 = NULL;
	}
	if ($_POST['category5'] == "") {
		$category5 = NULL;
	}
	if ($_POST['weight5'] == "") {
		$weight5 = NULL;
	}
	if ($_POST['category6'] == "") {
		$category6 = NULL;
	}
	if ($_POST['weight6'] == "") {
		$weight6 = NULL;
	}
	if ($_POST['category7'] == "") {
		$category7 = NULL;
	}
	if ($_POST['weight7'] == "") {
		$weight7 = NULL;
	}
	if ($_POST['category8'] == "") {
		$category8 = NULL;
	}
	if ($_POST['weight8'] == "") {
		$weight8 = NULL;
	}
	if ($_POST['category9'] == "") {
		$category9 = NULL;
	}
	if ($_POST['weight9'] == "") {
		$weight9 = NULL;
	}
	if ($_POST['category10'] == "") {
		$category10 = NULL;
	}
	if ($_POST['weight10'] == "") {
		$weight10 = NULL;
	}
	$view->newClass($username, $title, $credits, $a_plus, $a, $a_minus, $b_plus, $b, $b_minus, $c_plus, $c, $c_minus, $d_plus, $d, $d_minus, $f,
		$system, $category1, $weight1, $category2, $weight2, $category3, $weight3, $category4, $weight4, $category5, $weight5,
		$category6, $weight6, $category7, $weight7, $category8, $weight8, $category9, $weight9, $category10, $weight10);
	// redirect the user to the main page
	header('Location:ProjectMain.php');
}
else if (isset($_POST['cmd']) && $_POST['cmd'] == 'removeClass' && $request == 'deleteClass') {
	// call the function to delete a class from the database
	$username = $_SESSION['username'];
	$title = $_POST['title'];
	$view->deleteClass($username, $title);
	// redirect the user to the main page
	header('Location:ProjectMain.php');
}
else if ($request == 'showGrades') {
	// call the function to show the user's grades for a particular class
	$username = $_SESSION['username'];
	$title = $_SESSION['title'];
	$view->showGrades($username, $title);
}
else if ($request == 'newGrade') {
	// call the function to create a new assignment/grade for a particular class
	$username = $_SESSION['username'];
	$title = $_SESSION['title'];
	$category = $_POST['category'];
	$weight = $_POST['weight'];
	$assignment = $_POST['assignment'];
	$points_earned = $_POST['points_earned'];
	$points_possible = $_POST['points_possible'];
	if (!isset($_POST['category']) || !isset($_POST['weight']) || $category = "" || $weight = "" || $category = "NULL" || $weight = "NULL") {
		$category = NULL;
		$weight = NULL;
	}
	$view->newGrade($username, $title, $category, $weight, $assignment, $points_earned, $points_possible);
}
else if ($request == 'deleteGrade') {
	// call the function to delete a grade from the database for a particular class
	$username = $_SESSION['username'];
	$title = $_SESSION['title'];
	$assignment = $_POST['assignment'];
	$view->deleteGrade($username, $title, $assignment);
}
else if ($request == 'killSession') {
	// kill the current session
	session_destroy();
	// redirect the user to the login page
	header('Location:ProjectLogin.php');
}
else if ($request == 'pointsEarned') {
	// call the function to retrieve the points earned for a particular class
	$username = $_SESSION['username'];
	$title = $_SESSION['title'];
	$view->showPointsEarned($username, $title);
}
else if ($request == 'pointsPossible') {
	// call the function to retrieve the points possible for a particular class
	$username = $_SESSION['username'];
	$title = $_SESSION['title'];
	$view->showPointsPossible($username, $title);
}
else if ($request == 'gradingScale') {
	// call the function to retrieve the grading scale for a particular class
	$username = $_SESSION['username'];
	$title = $_SESSION['title'];
	$view->showGradingScale($username, $title);
}
else if ($request == 'final_grade') {
	// call the function to retrieve the final grade for a class
	$username = $_SESSION['username'];
	$title = $_SESSION['title'];
	$letter = $_POST['final_grade'];
	$view->sendFinalGrade($username, $title, $letter);
}
else if ($request == 'gpa') {
	// call the function to retrieve the credits and final letter grade of all the user's classes in order to calculate the grade point average
	$username = $_SESSION['username'];
	$view->showGPA($username);
}
else if ($request == 'getFrequency') {
	// call the function to retrieve all the letter grades along with how many of the user's classes have that letter grade
	$username = $_SESSION['username'];
	$view->showGradeFrequency($username);
}
?>