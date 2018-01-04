<?php
// D.J. Anderson
// dra2zp
// HW 4
// GradesModel.php

// model class for interacting with the hw4 database

class GradesModel {

      // MySQL parameters for connecting
      private static $host = 'localhost';
      private static $user = 'dbuser'; // want to use a MySQL user with restricted access

      // This is very bad
      private static $password = 'cs4640'; // Don't do this!

      private static $database = 'hw4';
      
	     
      // PHP MySQL Object
      private $connection;

      // function __construct(): create the model and connect to MySQL
      function __construct() {
      	       //connect
	       $this->connection = new mysqli(
	       		self::$host,
			self::$user,
			self::$password,
			self::$database
	       );

	       // if we couldn't connect to the MySQL server, throw an exception
	       if ($this->connection->connect_errno != 0) {
	       	  	throw new Exception("Could not connect!");
	       }
      }

      
		// function for getting the first view
      function view_student_info() {
      	       $query1 = "SELECT first AS 'First Name', last AS 'Last Name', email AS 'Email', reg_date AS 'Registration Date' FROM students";
	       // execute the query
	       $result = $this->connection->query($query1);
	       // check if the query had any errors
	       if ($this->connection->errno != 0) {
	       	  //throw new Exception("Query Failed");
	       }
	       // the query succeeded!
	       if ($result->num_rows < 1) {
	       	  // check if we have at least one row being returned
	       	  //throw new Exception("0 Results Returned");
	       }
	       $assoc_array = array();
	       while ($row = $result->fetch_assoc()) {
	       	     array_push($assoc_array, $row);
	       }
	       return $assoc_array;
      }

		// function for getting the second view
      function view_course_info() {
      	       $query2 = "SELECT dept AS 'Department', number AS 'Number', title AS 'Title' FROM courses";
	       // execute the query
	       $result = $this->connection->query($query2);
	       // check if the query had any errors
	       if ($this->connection->errno != 0) {
	       	  //throw new Exception("Query Failed");
	       }
	       // the query succeeded!
	       if ($result->num_rows < 1) {
	          // check if we have at least one row being returned
	       	  //throw new Exception("0 Results Returned");
	       }
	       $assoc_array = array();
	       while ($row = $result->fetch_assoc()) {
	          array_push($assoc_array, $row);
	       }
	       return $assoc_array;
      }

		// function for getting the third view
      function view_student_course_info_by_student() {
      	       $query3 = "SELECT first AS 'First Name', last AS 'Last Name', grades.dept AS 'Department', course AS 'Number', semester AS 'Semester', year AS 'Year', grade AS 'Grade' FROM students, courses, grades WHERE grades.dept = courses.dept AND students.email = grades.email AND courses.number = grades.course";
	       // execute the query
	       $result = $this->connection->query($query3);
	       // check if the query had any errors
	       if ($this->connection->errno != 0) {
	          //throw new Exception("Query Failed");
	       }
	       // the query succeeded!
	       if ($result->num_rows < 1) {
	          // check if we have at least one row being returned
	          //throw new Exception("0 Results Returned");
	       }
	       $assoc_array = array();
	       while ($row = $result->fetch_assoc()) {
	          array_push($assoc_array, $row);
	       }
	       return $assoc_array;
      }

		// function for getting the fourth view
      function view_student_course_info_by_department_course() {
      	       $query4 = "SELECT first AS 'First Name', last AS 'Last Name', grades.dept AS 'Department', course AS 'Number', semester AS 'Semester', year AS 'Year', grade AS 'Grade' FROM students, courses, grades WHERE grades.dept = courses.dept AND students.email = grades.email AND courses.number = grades.course ORDER BY grades.dept, grades.course";
	       // execute the query
	       $result = $this->connection->query($query4);
	       // check if the query had any errors
               if ($this->connection->errno != 0) {
                  //throw new Exception("Query Failed");
               }
               // the query succeeded!
	       if ($result->num_rows < 1) {
	          // check if we have at least one row being returned
	          //throw new Exception("0 Results Returned");
	       }
	       $assoc_array = array();
	       while ($row = $result->fetch_assoc()) {
	          array_push($assoc_array, $row);
	       }
	       return $assoc_array;
      }
}
?>
