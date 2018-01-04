<?php
// D.J. Anderson
// dra2zp
// Project
// CreateDB.php

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
	private $classes = "CREATE TABLE classes (
		username VARCHAR(40) NOT NULL,
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
		category1 VARCHAR(40),
		weight1 DECIMAL(4, 4),
		category2 VARCHAR(40),
		weight2 DECIMAL(4, 4),
		category3 VARCHAR(40),
		weight3 DECIMAL(4, 4),
		category4 VARCHAR(40),
		weight4 DECIMAL(4, 4),
		category5 VARCHAR(40),
		weight5 DECIMAL(4, 4),
		category6 VARCHAR(40),
		weight6 DECIMAL(4, 4),
		category7 VARCHAR(40),
		weight7 DECIMAL(4, 4),
		category8 VARCHAR(40),
		weight8 DECIMAL(4, 4),
		category9 VARCHAR(40),
		weight9 DECIMAL(4, 4),
		category10 VARCHAR(40),
		weight10 DECIMAL(4, 4),
		removed CHAR(1) NOT NULL,
		final_grade CHAR(2),
		PRIMARY KEY (username, title, removed),
		FOREIGN KEY (username) REFERENCES users (username)
		) Engine = InnoDB;";
	private $grades = "CREATE TABLE grades (
		username VARCHAR(40) NOT NULL,
		title VARCHAR(40) NOT NULL,
		category VARCHAR(40),
		weight DECIMAL(4, 4),
		assignment VARCHAR(40) NOT NULL,
		points_earned DECIMAL(10, 4) NOT NULL,
		points_possible DECIMAL(10, 4) NOT NULL,
		removed CHAR(1) NOT NULL,
		PRIMARY KEY (username, title, assignment, removed),
		FOREIGN KEY (username, title) REFERENCES classes (username, title)
		) Engine = InnoDB;";
	// creates a sample user
	// username: dra2zp
	// password: cs4640
	private $admin = "INSERT INTO users (
		first, last, username, password, date) VALUES (
		'D.J.', 'Anderson', 'dra2zp', sha1('cs4640'), now());
		INSERT INTO classes (
		username, title, credits, a_plus, a, a_minus, b_plus, b, b_minus, c_plus, c, c_minus, d_plus, d, d_minus, f, system,
		category1, weight1, category2, weight2, category3, weight3, category4, weight4, category5, weight5,
		category6, weight6, category7, weight7, category8, weight8, category9, weight9, category10, weight10, removed) VALUES (
		'dra2zp', 'CS 4640', '3', '0.975', '0.925', '0.895', '0.865', '0.825', '0.795', '0.765', '0.725', '0.695', '0.665', '0.625', '0.6', '0', 'P',
		NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,
		NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N');
		INSERT INTO classes (
		username, title, credits, a_plus, a, a_minus, b_plus, b, b_minus, c_plus, c, c_minus, d_plus, d, d_minus, f, system,
		category1, weight1, category2, weight2, category3, weight3, category4, weight4, category5, weight5,
		category6, weight6, category7, weight7, category8, weight8, category9, weight9, category10, weight10, removed) VALUES (
		'dra2zp', 'MATH 1140', '3', '0.97', '0.93', '0.9', '0.87', '0.83', '0.8', '0.77', '0.73', '0.7', '0.67', '0.63', '0.6', '0', 'W',
		'Homework tests', '0.6', 'Attendance/participation', '0.05', 'Final Exam', '0.3', NULL, NULL, NULL, NULL,
		NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Quiz 1', '2', '2', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Quiz 2', '2', '2', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Quiz 3', '2', '2', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Quiz 4', '2', '2', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Homework 1', '26', '30', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Quiz 5', '2', '2', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Quiz 6', '2', '2', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Exam 1', '90', '100', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Quiz 7', '2', '2', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Quiz 8', '2', '2', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Quiz 9', '0', '2', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'CS 4640', NULL, NULL, 'Project Proposal', '50', '50', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 1', '5', '5', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 2', '4', '4', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 3', '5', '5', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 4', '5', '5', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 5', '5', '5', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 6', '3.5', '4', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 7', '6', '6', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 8', '3', '3', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 9', '4', '4', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 10', '4', '4', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 11', '4', '4', 'N');
		INSERT INTO grades (
		username, title, category, weight, assignment, points_earned, points_possible, removed) VALUES (
		'dra2zp', 'MATH 1140', 'Homework tests', '0.6', 'Hw 12', '5', '5', 'N');";
	function LoadDB() {
		// function for executing the database commands
		$this->connection->query($this->users);
		$this->connection->query($this->classes);
		$this->connection->query($this->grades);
		$this->connection->query($this->admin);
	}
}
?>