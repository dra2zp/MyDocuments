<?php
// D.J. Anderson
// dra2zp
// Project
// ProjectModel.php
// 06-28-2017-582

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
	function getClasses($username, $semester) {
		// gets the user's classes
		$prepared = $this->connection->prepare(
			"SELECT title FROM classes WHERE username = :username AND semester = :semester"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":semester", $semester) ||
			!$prepared->execute()) {
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
	function createClass($username, $semester, $title, $credits,
		$a_plus, $a, $a_minus, $b_plus, $b, $b_minus, $c_plus, $c, $c_minus, $d_plus, $d, $d_minus, $f,
		$system,
		$category1, $weight1, $category2, $weight2, $category3, $weight3, $category4, $weight4, $category5, $weight5,
		$category6, $weight6, $category7, $weight7, $category8, $weight8, $category9, $weight9, $category10, $weight10) {
		// creates a class and inserts it into the database
		$prepared1 = $this->connection->prepare(
			"INSERT INTO classes (
			username, semester, title, credits,
			a_plus, a, a_minus, b_plus, b, b_minus, c_plus, c, c_minus, d_plus, d, d_minus, f,
			system) VALUES (
			:username, :semester, :title, :credits,
			:a_plus, :a, :a_minus, :b_plus, :b, :b_minus, :c_plus, :c, :c_minus, :d_plus, :d, :d_minus, :f,
			:system)"
		);
		if (!$prepared1->bindParam(":username", $username) ||
			!$prepared1->bindParam(":semester", $semester) ||
			!$prepared1->bindParam(":title", $title) ||
			!$prepared1->bindParam(":credits", $credits) ||
			!$prepared1->bindParam(":a_plus", $a_plus) ||
			!$prepared1->bindParam(":a", $a) ||
			!$prepared1->bindParam(":a_minus", $a_minus) ||
			!$prepared1->bindParam(":b_plus", $b_plus) ||
			!$prepared1->bindParam(":b", $b) ||
			!$prepared1->bindParam(":b_minus", $b_minus) ||
			!$prepared1->bindParam(":c_plus", $c_plus) ||
			!$prepared1->bindParam(":c", $c) ||
			!$prepared1->bindParam(":c_minus", $c_minus) ||
			!$prepared1->bindParam(":d_plus", $d_plus) ||
			!$prepared1->bindParam(":d", $d) ||
			!$prepared1->bindParam(":d_minus", $d_minus) ||
			!$prepared1->bindParam(":f", $f) ||
			!$prepared1->bindParam(":system", $system) ||
			!$prepared1->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		if ($system = "W") {
			$prepared2 = $this->connection->prepare(
				"INSERT INTO weights (
				username, semester, title, category, weight) VALUES (
				:username, :semester, :title, :category, :weight)"
			);
			if ($category1 != NULL && $weight1 != NULL) {
				if (!$prepared2->bindParam(":username", $username) ||
					!$prepared2->bindParam(":semester", $semester) ||
					!$prepared2->bindParam(":title", $title) ||
					!$prepared2->bindParam(":category", $category1) ||
					!$prepared2->bindParam(":weight", $weight1) ||
					!$prepared2->execute()) {
					// failing to execute the query
					throw new Exception("Fatal Error: Failed to execute the query");
				}
			}
			if ($category2 != NULL && $weight2 != NULL) {
				if (!$prepared2->bindParam(":username", $username) ||
					!$prepared2->bindParam(":semester", $semester) ||
					!$prepared2->bindParam(":title", $title) ||
					!$prepared2->bindParam(":category", $category2) ||
					!$prepared2->bindParam(":weight", $weight2) ||
					!$prepared2->execute()) {
					// failing to execute the query
					throw new Exception("Fatal Error: Failed to execute the query");
				}
			}
			if ($category3 != NULL && $weight3 != NULL) {
				if (!$prepared2->bindParam(":username", $username) ||
					!$prepared2->bindParam(":semester", $semester) ||
					!$prepared2->bindParam(":title", $title) ||
					!$prepared2->bindParam(":category", $category3) ||
					!$prepared2->bindParam(":weight", $weight3) ||
					!$prepared2->execute()) {
					// failing to execute the query
					throw new Exception("Fatal Error: Failed to execute the query");
				}
			}
			if ($category4 != NULL && $weight4 != NULL) {
				if (!$prepared2->bindParam(":username", $username) ||
					!$prepared2->bindParam(":semester", $semester) ||
					!$prepared2->bindParam(":title", $title) ||
					!$prepared2->bindParam(":category", $category4) ||
					!$prepared2->bindParam(":weight", $weight4) ||
					!$prepared2->execute()) {
					// failing to execute the query
					throw new Exception("Fatal Error: Failed to execute the query");
				}
			}
			if ($category5 != NULL && $weight5 != NULL) {
				if (!$prepared2->bindParam(":username", $username) ||
					!$prepared2->bindParam(":semester", $semester) ||
					!$prepared2->bindParam(":title", $title) ||
					!$prepared2->bindParam(":category", $category5) ||
					!$prepared2->bindParam(":weight", $weight5) ||
					!$prepared2->execute()) {
					// failing to execute the query
					throw new Exception("Fatal Error: Failed to execute the query");
				}
			}
			if ($category6 != NULL && $weight6 != NULL) {
				if (!$prepared2->bindParam(":username", $username) ||
					!$prepared2->bindParam(":semester", $semester) ||
					!$prepared2->bindParam(":title", $title) ||
					!$prepared2->bindParam(":category", $category6) ||
					!$prepared2->bindParam(":weight", $weight6) ||
					!$prepared2->execute()) {
					// failing to execute the query
					throw new Exception("Fatal Error: Failed to execute the query");
				}
			}
			if ($category7 != NULL && $weight7 != NULL) {
				if (!$prepared2->bindParam(":username", $username) ||
					!$prepared2->bindParam(":semester", $semester) ||
					!$prepared2->bindParam(":title", $title) ||
					!$prepared2->bindParam(":category", $category7) ||
					!$prepared2->bindParam(":weight", $weight7) ||
					!$prepared2->execute()) {
					// failing to execute the query
					throw new Exception("Fatal Error: Failed to execute the query");
				}
			}
			if ($category8 != NULL && $weight8 != NULL) {
				if (!$prepared2->bindParam(":username", $username) ||
					!$prepared2->bindParam(":semester", $semester) ||
					!$prepared2->bindParam(":title", $title) ||
					!$prepared2->bindParam(":category", $category8) ||
					!$prepared2->bindParam(":weight", $weight8) ||
					!$prepared2->execute()) {
					// failing to execute the query
					throw new Exception("Fatal Error: Failed to execute the query");
				}
			}
			if ($category9 != NULL && $weight9 != NULL) {
				if (!$prepared2->bindParam(":username", $username) ||
					!$prepared2->bindParam(":semester", $semester) ||
					!$prepared2->bindParam(":title", $title) ||
					!$prepared2->bindParam(":category", $category9) ||
					!$prepared2->bindParam(":weight", $weight9) ||
					!$prepared2->execute()) {
					// failing to execute the query
					throw new Exception("Fatal Error: Failed to execute the query");
				}
			}
			if ($category10 != NULL && $weight10 != NULL) {
				if (!$prepared2->bindParam(":username", $username) ||
					!$prepared2->bindParam(":semester", $semester) ||
					!$prepared2->bindParam(":title", $title) ||
					!$prepared2->bindParam(":category", $category10) ||
					!$prepared2->bindParam(":weight", $weight10) ||
					!$prepared2->execute()) {
					// failing to execute the query
					throw new Exception("Fatal Error: Failed to execute the query");
				}
			}
		}
	}
	function removeClass($username, $semester, $title) {
		// removes a class from the database
		// delete all the grades relating to that class to enforce referential integrity so there's no foreign key dependency error
		$prepared1 = $this->connection->prepare(
			"DELETE FROM grades WHERE username = :username AND semester = :semester AND title = :title"
		);
		if (!$prepared1->bindParam(":username", $username) ||
			!$prepared1->bindParam(":semester", $semester) ||
			!$prepared1->bindParam(":title", $title) ||
			!$prepared1->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// delete the categories and weights from the database
		$prepared2 = $this->connection->prepare(
			"DELETE FROM weights WHERE username = :username AND semester = :semester AND title = :title"
		);
		if (!$prepared2->bindParam(":username", $username) ||
			!$prepared2->bindParam(":semester", $semester) ||
			!$prepared2->bindParam(":title", $title) ||
			!$prepared2->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// delete the class from the database
		$prepared3 = $this->connection->prepare(
			"DELETE FROM classes WHERE username = :username AND semester = :semester AND title = :title"
		);
		if (!$prepared3->bindParam(":username", $username) ||
			!$prepared3->bindParam(":semester", $semester) ||
			!$prepared3->bindParam(":title", $title) ||
			!$prepared3->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
	}
	function getGrades($username, $semester, $title) {
		// gets the assignments and grades from the database
		$prepared = $this->connection->prepare(
			"SELECT category, assignment, points_earned, points_possible FROM grades WHERE username = :username AND semester = :semester AND title = :title"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":semester", $semester) ||
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
	function createGrade($username, $semester, $title, $category, $assignment, $points_earned, $points_possible) {
		// creates a new grade and inserts it into the database
		$prepared = $this->connection->prepare(
			"INSERT INTO grades (
			username, semester, title, category, assignment, points_earned, points_possible) VALUES (
			:username, :semester, :title, :category, :assignment, :points_earned, :points_possible)"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":semester", $semester) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->bindParam(":category", $category) ||
			!$prepared->bindParam(":assignment", $assignment) ||
			!$prepared->bindParam(":points_earned", $points_earned) ||
			!$prepared->bindParam(":points_possible", $points_possible) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
	}
	function removeGrade($username, $semester, $title, $assignment) {
		// removes a grade from the database
		$prepared = $this->connection->prepare(
			"DELETE FROM grades WHERE username = :username AND semester = :semester AND title = :title AND assignment = :assignment"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":semester", $semester) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->bindParam(":assignment", $assignment) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
	}
	function getPointsEarned($username, $semester, $title) {
		// gets all the points earned for a class from the database
		$prepared = $this->connection->prepare(
			"SELECT points_earned FROM grades WHERE username = :username AND semester = :semester AND title = :title"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":semester", $semester) ||
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
	function getPointsPossible($username, $semester, $title) {
		// gets all the points possible for a class from the database
		$prepared = $this->connection->prepare(
			"SELECT points_possible FROM grades WHERE username = :username AND semester = :semester AND title = :title"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":semester", $semester) ||
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
	function getGradingScale($username, $semester, $title) {
		// gets the grading scale for a class from the database
		$prepared = $this->connection->prepare(
			"SELECT a_plus, a, a_minus, b_plus, b, b_minus, c_plus, c, c_minus, d_plus, d, d_minus, f FROM classes WHERE username = :username AND semester = :semester AND title = :title"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":semester", $semester) ||
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
	function importFinal($username, $semester, $title, $letter) {
		// insert a final grade for a class into the database
		$prepared = $this->connection->prepare(
			"UPDATE classes SET final_grade = :letter WHERE username = :username AND semester = :semester AND title = :title"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":semester", $semester) ||
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
			"SELECT credits, final_grade FROM classes WHERE username = :username"
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
			"SELECT final_grade, COUNT(*) FROM classes WHERE username = :username GROUP BY final_grade"
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
	function getSemesters($username) {
		// gets all the semesters from the database
		$prepared = $this->connection->prepare(
			"SELECT semester FROM semesters WHERE username = :username"
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
	function addSemester($username, $semester) {
		// creates a semester and inserts it into the database
		$prepared = $this->connection->prepare(
			"INSERT INTO semesters (
			username, semester) VALUES (
			:username, :semester)"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":semester", $semester) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
	}
	function removeSemester($username, $semester) {
		// removes a semester from the database
		// deletes all the classes relating to that semester to enforce referential integrity so there's no foreign key dependency error
		// deletes all the categories and weights relating to that semester to enforce referential integrity so there's no foreign key dependency error
		// delete all the grades relating to that class to enforce referential integrity so there's no foreign key dependency error
		$prepared1 = $this->connection->prepare(
			"DELETE FROM grades WHERE username = :username AND semester = :semester"
		);
		if (!$prepared1->bindParam(":username", $username) ||
			!$prepared1->bindParam(":semester", $semester) ||
			!$prepared1->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// delete the categories and weights from the database
		$prepared2 = $this->connection->prepare(
			"DELETE FROM weights WHERE username = :username AND semester = :semester"
		);
		if (!$prepared2->bindParam(":username", $username) ||
			!$prepared2->bindParam(":semester", $semester) ||
			!$prepared2->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// delete the class from the database
		$prepared3 = $this->connection->prepare(
			"DELETE FROM classes WHERE username = :username AND semester = :semester"
		);
		if (!$prepared3->bindParam(":username", $username) ||
			!$prepared3->bindParam(":semester", $semester) ||
			!$prepared3->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// delete the semester from the database
		$prepared4 = $this->connection->prepare(
			"DELETE FROM semesters WHERE username = :username AND semester = :semester"
		);
		if (!$prepared4->bindParam(":username", $username) ||
			!$prepared4->bindParam(":semester", $semester) ||
			!$prepared4->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
	}
	function getTranscript($username) {
		// gets all the user's semesters, classes, credits, and final grades from the database
		$prepared = $this->connection->prepare(
			"SELECT semester, title, credits, final_grade FROM classes WHERE username = :username"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// returns all the transcript information for a particular user
		$assoc_array = array();
		while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
			array_push($assoc_array, $row);
		}
		return $assoc_array;
	}
	function getSystem($username, $semester, $title) {
		// gets the grading system from the database
		$prepared = $this->connection->prepare(
			"SELECT system FROM classes WHERE username = :username AND semester = :semester AND title = :title"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":semester", $semester) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// returns all the transcript information for a particular user
		$assoc_array = array();
		while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
			array_push($assoc_array, $row);
		}
		return $assoc_array;
	}
	function getWeights($username, $semester, $title) {
		// gets the grading system from the database
		$prepared = $this->connection->prepare(
			"SELECT category, weight FROM weights WHERE username = :username AND semester = :semester AND title = :title"
		);
		if (!$prepared->bindParam(":username", $username) ||
			!$prepared->bindParam(":semester", $semester) ||
			!$prepared->bindParam(":title", $title) ||
			!$prepared->execute()) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		// returns all the transcript information for a particular user
		$assoc_array = array();
		while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
			array_push($assoc_array, $row);
		}
		return $assoc_array;
	}
}
?>