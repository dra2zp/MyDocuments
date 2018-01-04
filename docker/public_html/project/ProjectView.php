<?php
// D.J. Anderson
// dra2zp
// Project
// ProjectView.php
// 06-28-2017-153

// view class for my project

// requires the PHP pages for creating a database and the project model
require_once('ProjectModel.php');
require_once('CreateDB.php');

// view class
class ProjectView {
	private $model;
	private $create;
	// constructor for the view class
	function __construct() {
		// instantiates the model class and the create database class
		$this->model = new ProjectModel();
		$this->create = new CreateDB();
	}
	public function make() {
		// calls the function to create the database
		// does not return anything
		$result = $this->create->LoadDB();
	}
	public function setName($username) {
		// calls the function to get a user's username and stores it as a session variable
		// does not return anything
		$result = $this->model->getName($username);
		$_SESSION['name'] = $result;
	}
	public function newUser($first, $last, $username, $password) {
		// calls the function to add a new user
		// redirects the user to the login page after 2 seconds
		// does not return anything
		$result = $this->model->createAccount($first, $last, $username, $password);
		sleep(2);
		header('Location:ProjectLogin.php');
	}
	public function showClasses($username, $semester) {
		// calls the function to show the user's classes
		// returns a JSON object of all the user's classes
		$result = $this->model->getClasses($username, $semester);
		echo json_encode($result);
	}
	public function newClass($username, $semester, $title, $credits,
		$a_plus, $a, $a_minus, $b_plus, $b, $b_minus, $c_plus, $c, $c_minus, $d_plus, $d, $d_minus, $f,
		$system,
		$category1, $weight1, $category2, $weight2, $category3, $weight3, $category4, $weight4, $category5, $weight5,
		$category6, $weight6, $category7, $weight7, $category8, $weight8, $category9, $weight9, $category10, $weight10) {
		// calls the function to add a new class
		// does not return anything
		$result = $this->model->createClass($username, $semester, $title, $credits,
		$a_plus, $a, $a_minus, $b_plus, $b, $b_minus, $c_plus, $c, $c_minus, $d_plus, $d, $d_minus, $f,
		$system,
		$category1, $weight1, $category2, $weight2, $category3, $weight3, $category4, $weight4, $category5, $weight5,
		$category6, $weight6, $category7, $weight7, $category8, $weight8, $category9, $weight9, $category10, $weight10);
	}
	public function deleteClass($username, $semester, $title) {
		// calls the function to delete a class
		// does not return anything
		$result = $this->model->removeClass($username, $semester, $title);
	}
	public function showGrades($username, $semester, $title) {
		// calls the function to show the user's grades for a particular class
		// returns a JSON object of all the user's grades
		$result = $this->model->getGrades($username, $semester, $title);
		echo json_encode($result);
	}
	public function newGrade($username, $semester, $title, $category, $assignment, $points_earned, $points_possible) {
		// calls the function to add a new grade
		// does not return anything
		$result = $this->model->createGrade($username, $semester, $title, $category, $assignment, $points_earned, $points_possible);
	}
	public function deleteGrade($username, $semester, $title, $assignment) {
		// calls the function to delete a grade
		// does not return anything
		$result = $this->model->removeGrade($username, $semester, $title, $assignment);
	}
	public function showPointsEarned($username, $semester, $title) {
		// calls the function to get an array of all the points earned for a class
		// returns a JSON object of all the points earned
		$result = $this->model->getPointsEarned($username, $semester, $title);
		echo json_encode($result);
	}
	public function showPointsPossible($username, $semester, $title) {
		// calls the function to get an array of all the points possible for a class
		// returns a JSON object of all the points possible
		$result = $this->model->getPointsPossible($username, $semester, $title);
		echo json_encode($result);
	}
	public function showGradingScale($username, $semester, $title) {
		// calls the function to get an array of the grading scale for a class
		// returns a JSON object of the grading scale
		$result = $this->model->getGradingScale($username, $semester, $title);
		echo json_encode($result);
	}
	public function sendFinalGrade($username, $semester, $title, $letter) {
		// calls the function to input a final letter grade for a class
		// does not return anything
		$result = $this->model->importFinal($username, $semester, $title, $letter);
	}
	public function showGPA($username) {
		// calls the function to get an array of all the credits and letter grades for a particular class
		// returns a JSON object of all the user's credits and letter grades
		$result = $this->model->getGPA($username);
		echo json_encode($result);
	}
	public function showGradeFrequency($username) {
		// calls the function to get an array showing all the user's letter grades and their frequencies
		// returns a JSON object of all the user's grades
		$result = $this->model->getGradeFrequency($username);
		echo json_encode($result);
	}
	public function showSemesters($username) {
		// calls the function to get the user's semesters
		// returns a JSON object of all the user's semesters
		$result = $this->model->getSemesters($username);
		echo json_encode($result);
	}
	public function newSemester($username, $semester) {
		// calls the function to add a new semester
		// does not return anything
		$result = $this->model->addSemester($username, $semester);
	}
	public function deleteSemester($username, $semester) {
		// calls the function to delete a semester
		// does not return anything
		$result = $this->model->removeSemester($username, $semester);
	}
	public function showTranscript($username) {
		// calls the function to show the transcript
		// returns a JSON object of all the user's semesters, classes, credits, and final grades
		$result = $this->model->getTranscript($username);
		echo json_encode($result);
	}
	public function showSystem($username, $semester, $title) {
		// calls the function to show the system
		// returns a JSON object of the type of grading system for the user's class
		$result = $this->model->getSystem($username, $semester, $title);
		echo json_encode($result);
	}
	public function showWeights($username, $semester, $title) {
		// calls the function to show the categories and weights
		// returns a JSON object of all the categories and weights for the user's class
		$result = $this->model->getWeights($username, $semester, $title);
		echo json_encode($result);
	}
}
?>