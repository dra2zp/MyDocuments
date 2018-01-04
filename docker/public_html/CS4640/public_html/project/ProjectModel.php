<?php
// D.J. Anderson
// dra2zp
// Project
// ProjectModel.php

// model class for interacting with the project database

// requires the file with the class containing the password for dbuser
require_once('/home/dra2zp/.mysqlpass.inc.php');

// model class
class ProjectModel {
	// prepare for the database connection
	// MySQL parameters for connecting
	private static $host = 'localhost';
	private static $user = 'dbuser';
	private $database = 'project';
	// PHP MySQL Object
	private $connection;
	// function __construct(): create the model and connect to MySQL
	function __construct() {
		// constructor for connecting to the database using PDOs
		// connect
		try {
			$this->connection = new PDO(
				"mysql:host=" . self::$host,
				self::$user,
				MySQLPassword::$password
			);
		}
		catch (PDOException $e) {
			// failure to connect
			throw new Exception("Could not connect: " . $e->getMessage());
		}
		// create the database
		$makeDB = "CREATE DATABASE " . $this->database;
		if (!$this->connection->query($makeDB)) {
			//throw new Exception("Error creating database: " . $e->getMessage());
		}
		// use the created database
		if (!$this->connection->query("USE " . $this->database)) {
			throw new Exception("Could not connect: " . $e->getMessage());
		}
	}
	function getName($username) {
		// gets the user's first and last name
		$prepared = $this->connection->prepare(
			"SELECT first, last FROM users WHERE username = :username"
		);
		if (!$prepared->execute([":username" => $username])) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		if ($prepared->rowCount() == 0) {
			// no result
			throw new Exception("User $username not found");
		}
		// appends the user's first and last name and returns the string
		$row = $prepared->fetch(PDO::FETCH_ASSOC);
		$first = $row['first'];
		$last = $row['last'];
		$space = " ";
		$name = $first . $space . $last;
		return $name;
	}
	function createAccount($first, $last, $username, $password) {
		// creates an account and inserts it into the database
		$prepared = $this->connection->prepare(
			"INSERT INTO users (
				first, last, username, password, date) VALUES (
				:first, :last, :username, :password, now())"
		);
		if (!$prepared->bindParam(":first", $first) ||
			!$prepared->bindParam(":last", $last) ||
			!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":password", $password) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
	}
	function getClasses($username) {
		// gets the user's classes
		$prepared = $this->connection->prepare(
			"SELECT title FROM classes WHERE username = :username AND removed = 'N'"
		);
		if (!$prepared->execute([":username" => $username])) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// returns an array of the user's classes
		$assoc_array = array();
		while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
			array_push($assoc_array, $row);
		}
		return $assoc_array;
	}
	function createClass($username, $title, $credits, $a_plus, $a, $a_minus, $b_plus, $b, $b_minus, $c_plus, $c, $c_minus, $d_plus, $d, $d_minus, $f,
		$system, $category1, $weight1, $category2, $weight2, $category3, $weight3, $category4, $weight4, $category5, $weight5,
		$category6, $weight6, $category7, $weight7, $category8, $weight8, $category9, $weight9, $category10, $weight10) {
		// creates a class and inserts it into the database
		$prepared = $this->connection->prepare(
			"INSERT INTO classes (
			username, title, credits, a_plus, a, a_minus, b_plus, b, b_minus, c_plus, c, c_minus, d_plus, d, d_minus, f, system,
			category1, weight1, category2, weight2, category3, weight3, category4, weight4, category5, weight5,
			category6, weight6, category7, weight7, category8, weight8, category9, weight9, category10, weight10, removed) VALUES (
			:username, :title, :credits, :a_plus, :a, :a_minus, :b_plus, :b, :b_minus, :c_plus, :c, :c_minus, :d_plus, :d, :d_minus, :f, :system,
			:category1, :weight1, :category2, :weight2, :category3, :weight3, :category4, :weight4, :category5, :weight5,
			:category6, :weight6, :category7, :weight7, :category8, :weight8, :category9, :weight9, :category10, :weight10, 'N')"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->bindParam(":credits", $credits) ||
			!$prepared->bindParam(":a_plus", $a_plus) ||
			!$prepared->bindParam(":a", $a) ||
			!$prepared->bindParam(":a_minus", $a_minus) ||
			!$prepared->bindParam(":b_plus", $b_plus) ||
			!$prepared->bindParam(":b", $b) ||
			!$prepared->bindParam(":b_minus", $b_minus) ||
			!$prepared->bindParam(":c_plus", $c_plus) ||
			!$prepared->bindParam(":c", $c) ||
			!$prepared->bindParam(":c_minus", $c_minus) ||
			!$prepared->bindParam(":d_plus", $d_plus) ||
			!$prepared->bindParam(":d", $d) ||
			!$prepared->bindParam(":d_minus", $d_minus) ||
			!$prepared->bindParam(":f", $f) ||
			!$prepared->bindParam(":system", $system) ||
			!$prepared->bindParam(":category1", $category1) ||
			!$prepared->bindParam(":weight1", $weight1) ||
			!$prepared->bindParam(":category2", $category2) ||
			!$prepared->bindParam(":weight2", $weight2) ||
			!$prepared->bindParam(":category3", $category3) ||
			!$prepared->bindParam(":weight3", $weight3) ||
			!$prepared->bindParam(":category4", $category4) ||
			!$prepared->bindParam(":weight4", $weight4) ||
			!$prepared->bindParam(":category5", $category5) ||
			!$prepared->bindParam(":weight5", $weight5) ||
			!$prepared->bindParam(":category6", $category6) ||
			!$prepared->bindParam(":weight6", $weight6) ||
			!$prepared->bindParam(":category7", $category7) ||
			!$prepared->bindParam(":weight7", $weight7) ||
			!$prepared->bindParam(":category8", $category8) ||
			!$prepared->bindParam(":weight8", $weight8) ||
			!$prepared->bindParam(":category9", $category9) ||
			!$prepared->bindParam(":weight9", $weight9) ||
			!$prepared->bindParam(":category10", $category10) ||
			!$prepared->bindParam(":weight10", $weight10) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
	}
	function removeClass($username, $title) {
		// removes a class from the database
		// delete all the grades relating to that class to enforce referential integrity so there's no foreign key dependency error
		$prepared1 = $this->connection->prepare(
			"DELETE FROM grades WHERE username = :username AND title = :title"
		);
		if (!$prepared1->bindParam(":username", $username) ||
			!$prepared1->bindParam(":title", $title) ||
			!$prepared1->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// delete the class from the database
		$prepared2 = $this->connection->prepare(
			"DELETE FROM classes WHERE username = :username AND title = :title"
		);
		if (!$prepared2->bindParam(":username", $username) ||
			!$prepared2->bindParam(":title", $title) ||
			!$prepared2->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
	}
	function getGrades($username, $title) {
		// gets the assignments and grades from the database
		$prepared = $this->connection->prepare(
			"SELECT assignment, category, weight, points_earned, points_possible FROM grades WHERE username = :username AND title = :title AND
			removed = 'N'"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// returns an array of the user's grades
		$assoc_array = array();
		while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
			array_push($assoc_array, $row);
		}
		return $assoc_array;
	}
	function createGrade($username, $title, $category, $weight, $assignment, $points_earned, $points_possible) {
		// creates a new grade and inserts it into the database
		$prepared = $this->connection->prepare(
			"INSERT INTO grades (
			username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
			:username, :title, :category, :weight, :assignment, :points_earned, :points_possible, 'N')"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->bindParam(":category", $category) ||
			!$prepared->bindParam(":weight", $weight) ||
			!$prepared->bindParam(":assignment", $assignment) ||
			!$prepared->bindParam(":points_earned", $points_earned) ||
			!$prepared->bindParam(":points_possible", $points_possible) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
	}
	function removeGrade($username, $title, $assignment) {
		// removes a grade from the database
		$prepared = $this->connection->prepare(
			"DELETE FROM grades WHERE username = :username AND title = :title AND assignment = :assignment"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->bindParam(":assignment", $assignment) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
	}
	function getPointsEarned($username, $title) {
		// gets all the points earned for a class from the database
		$prepared = $this->connection->prepare(
			"SELECT points_earned FROM grades WHERE username = :username AND title = :title AND removed = 'N'"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// returns an array of all the points earned
		$assoc_array = array();
		while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
			array_push($assoc_array, $row);
		}
		return $assoc_array;
	}
	function getPointsPossible($username, $title) {
		// gets all the points possible for a class from the database
		$prepared = $this->connection->prepare(
			"SELECT points_possible FROM grades WHERE username = :username AND title = :title AND removed = 'N'"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// returns an array of all the points possible
		$assoc_array = array();
		while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
			array_push($assoc_array, $row);
		}
		return $assoc_array;
	}
	function getGradingScale($username, $title) {
		// gets the grading scale for a class from the database
		$prepared = $this->connection->prepare(
			"SELECT a_plus, a, a_minus, b_plus, b, b_minus, c_plus, c, c_minus, d_plus, d, d_minus, f FROM classes WHERE username = :username AND title = :title"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// returns an array of the grading scale
		$assoc_array = array();
		while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
			array_push($assoc_array, $row);
		}
		return $assoc_array;
	}
	function importFinal($username, $title, $letter) {
		// insert a final grade for a class into the database
		$prepared = $this->connection->prepare(
			"UPDATE classes SET final_grade = :letter WHERE username = :username AND title = :title"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->bindParam(":letter", $letter) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
	}
	function getGPA($username) {
		// get the credits and final grades from the database
		$prepared = $this->connection->prepare(
			"SELECT credits, final_grade FROM classes WHERE username = :username AND removed = 'N'"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// returns an array of all the credits and final grades for a particular user
		$assoc_array = array();
		while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
			array_push($assoc_array, $row);
		}
		return $assoc_array;
	}
	function getGradeFrequency($username) {
		// gets all the grade frequencies from the database
		$prepared = $this->connection->prepare(
			"SELECT final_grade, COUNT(*) FROM classes WHERE username = :username AND removed = 'N' GROUP BY final_grade"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// returns all the grade frequencies for a particular user
		$assoc_array = array();
		while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
			array_push($assoc_array, $row);
		}
		return $assoc_array;
	}
}
?>