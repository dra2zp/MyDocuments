<?php
// D.J. Anderson
// dra2zp
// Project
// CreateDB.php
// 06-28-2017-234

// this class creates the tables inside the database and populates the tables with data

// create database class
class CreateDB {
	// MySQL parameters for connecting
	// set up the database connection
	private static $host = 'localhost';
	private static $user = 'dbuser';
	private $database = 'project';
	// PHP MySQL Object
	private $connection;
	// function __construct(): create the model and connect to MySQL
	function __construct() {
		// constructor function for setting up the database connection using PDOs
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
		// creates the database
		$makeDB = "CREATE DATABASE " . $this->database;
		if (!$this->connection->query($makeDB)) {
			//throw new Exception("Error creating database: " . $e->getMessage());
		}
		if (!$this->connection->query("USE " . $this->database)) {
			throw new Exception("Could not connect: " . $e->getMessage());
		}
	}
	// SQL commands stored into variables
	// creates the tables for the database
	private $users = "CREATE TABLE users (
		first VARCHAR(20) NOT NULL,
		last VARCHAR(20) NOT NULL,
		username VARCHAR(40) NOT NULL,
		password CHAR(40) NOT NULL,
		date DATETIME,
		PRIMARY KEY (username)
		) Engine = InnoDB;";
	private $semesters = "CREATE TABLE semesters (
		username VARCHAR(40) NOT NULL,
		semester VARCHAR(20) NOT NULL,
		PRIMARY KEY (username, semester),
		FOREIGN KEY (username) REFERENCES users (username)
		) Engine = InnoDB;";
	private $classes = "CREATE TABLE classes (
		username VARCHAR(40) NOT NULL,
		semester VARCHAR(20) NOT NULL,
		title VARCHAR(40) NOT NULL,
		credits TINYINT NOT NULL,
		a_plus DECIMAL(4, 4) NOT NULL,
		a DECIMAL(4, 4) NOT NULL,
		a_minus DECIMAL(4, 4) NOT NULL,
		b_plus DECIMAL(4, 4) NOT NULL,
		b DECIMAL(4, 4) NOT NULL,
		b_minus DECIMAL(4, 4) NOT NULL,
		c_plus DECIMAL(4, 4) NOT NULL,
		c DECIMAL(4, 4) NOT NULL,
		c_minus DECIMAL(4, 4) NOT NULL,
		d_plus DECIMAL(4, 4) NOT NULL,
		d DECIMAL(4, 4) NOT NULL,
		d_minus DECIMAL(4, 4) NOT NULL,
		f DECIMAL(4, 4) NOT NULL,
		system CHAR(1) NOT NULL,
		final_grade CHAR(2),
		PRIMARY KEY (username, semester, title),
		FOREIGN KEY (username, semester) REFERENCES semesters (username, semester)
		) Engine = InnoDB;";
	private $weights = "CREATE TABLE weights (
		username VARCHAR(40) NOT NULL,
		semester VARCHAR(20) NOT NULL,
		title VARCHAR(40) NOT NULL,
		category VARCHAR(40) NOT NULL,
		weight DECIMAL(4, 4) NOT NULL,
		PRIMARY KEY (username, semester, title, category),
		FOREIGN KEY (username, semester, title) REFERENCES classes (username, semester, title)
		) Engine = InnoDB;";
	private $grades = "CREATE TABLE grades (
		username VARCHAR(40) NOT NULL,
		semester VARCHAR(20) NOT NULL,
		title VARCHAR(40) NOT NULL,
		category VARCHAR(40),
		assignment VARCHAR(40) NOT NULL,
		points_earned DECIMAL(10, 4) NOT NULL,
		points_possible DECIMAL(10, 4) NOT NULL,
		PRIMARY KEY (username, semester, title, assignment),
		FOREIGN KEY (username, semester, title) REFERENCES classes (username, semester, title)
		) Engine = InnoDB;";
	// creates a sample user
	// username: dra2zp
	// password: cs4640
	private $admin = "INSERT INTO users (
		first, last, username, password, date) VALUES (
		'D.J.', 'Anderson', 'dra2zp', sha1('cs4640'), now());
		INSERT INTO semesters (
		username, semester) VALUES (
		'dra2zp', 'Fall 2015');
		INSERT INTO semesters (
		username, semester) VALUES (
		'dra2zp', 'Spring 2016');
		INSERT INTO semesters (
		username, semester) VALUES (
		'dra2zp', 'Summer 2016');
		INSERT INTO semesters (
		username, semester) VALUES (
		'dra2zp', 'Fall 2016');
		INSERT INTO semesters (
		username, semester) VALUES (
		'dra2zp', 'January 2017');
		INSERT INTO semesters (
		username, semester) VALUES (
		'dra2zp', 'Spring 2017');
		INSERT INTO semesters (
		username, semester) VALUES (
		'dra2zp', 'Summer 2017');
		INSERT INTO classes (
		username, semester, title, credits,
		a_plus, a, a_minus, b_plus, b, b_minus, c_plus, c, c_minus, d_plus, d, d_minus, f,
		system, final_grade) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', '3',
		'0.975', '0.925', '0.895', '0.865', '0.825', '0.795', '0.765', '0.725', '0.695', '0.665', '0.625', '0.6', '0',
		'P', NULL);
		INSERT INTO classes (
		username, semester, title, credits,
		a_plus, a, a_minus, b_plus, b, b_minus, c_plus, c, c_minus, d_plus, d, d_minus, f,
		system, final_grade) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', '3',
		'0.97', '0.93', '0.9', '0.87', '0.83', '0.8', '0.77', '0.73', '0.7', '0.67', '0.63', '0.6', '0',
		'W', NULL);
		INSERT INTO weights (
		username, semester, title, category, weight) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', '0.6');
		INSERT INTO weights (
		username, semester, title, category, weight) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Attendance/participation', '0.05');
		INSERT INTO weights (
		username, semester, title, category, weight) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Final Exam', '0.35');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Quiz 1', '2', '2');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Quiz 2', '2', '2');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Quiz 3', '2', '2');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Quiz 4', '2', '2');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Homework 1', '26', '30');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Quiz 5', '2', '2');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Quiz 6', '2', '2');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Exam 1', '90', '100',);
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Quiz 7', '2', '2');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Quiz 8', '2', '2');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Quiz 9', '0', '2');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'CS 4640', NULL, 'Project Proposal', '50', '50');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 1', '5', '5');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 2', '4', '4');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 3', '5', '5');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 4', '5', '5');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 5', '5', '5');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 6', '3.5', '4');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 7', '6', '6');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 8', '3', '3');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 9', '4', '4');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 10', '4', '4');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 11', '4', '4');
		INSERT INTO grades (
		username, semester, title, category, assignment, points_earned, points_possible) VALUES (
		'dra2zp', 'Summer 2017', 'MATH 1140', 'Homework tests', 'Hw 12', '5', '5');";
	function LoadDB() {
		// function for executing the database commands
		$this->connection->query($this->users);
		$this->connection->query($this->semesters);
		$this->connection->query($this->classes);
		$this->connection->query($this->weights);
		$this->connection->query($this->grades);
		$this->connection->query($this->admin);
	}
}
?>