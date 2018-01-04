<?php
// D.J. Anderson
// dra2zp
// HW 4
// createdb.php

// this class creates the tables inside the database and populates the tables with data
class CreateDB {

	// MySQL parameters for connecting
      private static $host = 'localhost';
      private static $user = 'dbuser'; // want to use a MySQL user with restricted access

      // This is very bad
      private static $password = 'cs4640'; // Don't do this!

      private static $database = 'hw4';
      
	     
      // PHP MySQL Object
      private $connection;

      // SQL commands stored into variables
	private $create_table_students = "CREATE TABLE students (
      	 email VARCHAR(40),
	 password CHAR(40) NOT NULL,
	 first VARCHAR(40) NOT NULL,
	 last VARCHAR(40) NOT NULL,
	 reg_date DATETIME NOT NULL,
	 PRIMARY KEY (email)
	 ) ENGINE = InnoDB";
	  private $create_table_courses = "CREATE TABLE courses (
      	 dept VARCHAR(4),
	 number CHAR(4),
	 title VARCHAR(255),
	 PRIMARY KEY (dept, number)
	 ) ENGINE = InnoDB";
      private $create_table_grades = "CREATE TABLE grades (
      	 email VARCHAR (40),
	 dept VARCHAR(4),
	 course CHAR(4),
	 year YEAR(4),
	 semester VARCHAR(10),
	 grade VARCHAR(2),
	 PRIMARY KEY (email, dept, course, year, semester),
	 FOREIGN KEY (email) REFERENCES students(email) ON DELETE CASCADE,
	 FOREIGN KEY (dept, course) REFERENCES courses(dept, number) ON DELETE CASCADE
	 ) ENGINE = InnoDB";
      private $insert_students1 = "INSERT INTO students (email, password, first, last, reg_date)
      	 VALUES ('dra2zp', sha1('dra2zp'), 'D.J.', 'Anderson', now())";
      private $insert_students2 = "INSERT INTO students (email, password, first, last, reg_date)
      	 VALUES ('sma4ds', sha1('sma4ds'), 'Susan', 'Aparicio', now())";
      private $insert_students3 = "INSERT INTO students (email, password, first, last, reg_date)
      	 VALUES ('pg3kp', sha1('pg3kp'), 'Peter', 'Gunnarson', now())";
      private $insert_students4 = "INSERT INTO students (email, password, first, last, reg_date)
      	 VALUES ('mai5hh', sha1('mai5hh'), 'Momo', 'Ihsan', now())";
      private $insert_students5 = "INSERT INTO students (email, password, first, last, reg_date)
      	 VALUES ('mea2up', sha1('mea2up'), 'Megan', 'Amrhine', now())";
      private $insert_courses1 = "INSERT INTO courses (dept, number, title)
      	 VALUES ('MATH', '4651', 'Advanced Linear Algebra')";
      private $insert_courses2 = "INSERT INTO courses (dept, number, title)
      	 VALUES ('MATH', '3354', 'Survey of Algebra')";
      private $insert_courses3 = "INSERT INTO courses (dept, number, title)
      	 VALUES ('MATH', '3310', 'Basic Real Analysis')";
      private $insert_courses4 = "INSERT INTO courses (dept, number, title)
      	 VALUES ('CS', '4630', 'Defense Against the Dark Arts')";
      private $insert_courses5 = "INSERT INTO courses (dept, number, title)
      	 VALUES ('CS', '3330', 'Computer Architecture')";
      private $insert_courses6 = "INSERT INTO courses (dept, number, title)
      	 VALUES ('CS', '2150', 'Program and Data Representation')";
      private $insert_courses7 = "INSERT INTO courses (dept, number, title)
      	 VALUES ('PSYC', '2150', 'Introduction to Cognition')";
      private $insert_courses8 = "INSERT INTO courses (dept, number, title)
      	 VALUES ('PSYC', '2200', 'A Survey of the Neural Basis of Behavior')";
      private $insert_courses9 = "INSERT INTO courses (dept, number, title)
      	 VALUES ('PSYC', '2600', 'Introduction to Social Pyschology')";
      private $insert_grades1 = "INSERT INTO grades (email, dept, course, year, semester, grade)
      	 VALUES ('dra2zp', 'CS', '2150', '2016', 'Fall', 'A')";
      private $insert_grades2 = "INSERT INTO grades (email, dept, course, year, semester, grade)
      	 VALUES ('dra2zp', 'CS', '3330', '2017', 'Spring', 'B+')";
      private $insert_grades3 = "INSERT INTO grades (email, dept, course, year, semester, grade)
      	 VALUES ('dra2zp', 'CS', '4630', '2017', 'Spring', 'B')";
      private $insert_grades4 = "INSERT INTO grades (email, dept, course, year, semester, grade)
      	 VALUES ('dra2zp', 'MATH', '3310', '2016', 'Fall', 'B-')";
      private $insert_grades5 = "INSERT INTO grades (email, dept, course, year, semester, grade)
      	 VALUES ('dra2zp', 'MATH', '3354', '2016', 'Fall', 'C+')";
      private $insert_grades6 = "INSERT INTO grades (email, dept, course, year, semester, grade)
      	 VALUES ('dra2zp', 'MATH', '4651', '2016', 'Fall', 'B')";
      private $insert_grades7 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('sma4ds', 'PSYC', '2150', '2014', 'Spring', 'A')";
      private $insert_grades8 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('sma4ds', 'PSYC', '2200', '2016', 'Fall', 'A-')";
      private $insert_grades9 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('sma4ds', 'PSYC', '2600', '2014', 'Fall', 'A+')";
      private $insert_grades10 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('sma4ds', 'CS', '2150', '2015', 'Spring', 'B+')";
      private $insert_grades11 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('sma4ds', 'CS', '4630', '2016', 'Fall', 'B-')";
      private $insert_grades12 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('sma4ds', 'MATH', '3354', '2014', 'Fall', 'C-')";
      private $insert_grades13 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('pg3kp', 'CS', '2150', '2017', 'Spring', 'A-')";
      private $insert_grades14 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('pg3kp', 'CS', '3330', '2017', 'Fall', 'B+')";
      private $insert_grades15 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('pg3kp', 'CS', '4630', '2018', 'Spring', 'C+')";
      private $insert_grades16 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('pg3kp', 'MATH', '3310', '2015', 'Fall', 'A')";
      private $insert_grades17 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('pg3kp', 'MATH', '3354', '2016', 'Spring', 'B+')";
      private $insert_grades18 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('pg3kp', 'MATH', '4651', '2016', 'Fall', 'A-')";
      private $insert_grades19 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mai5hh', 'CS', '2150', '2017', 'Spring', 'C')";
      private $insert_grades20 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mai5hh', 'CS', '3330', '2017', 'Fall', 'C+')";
      private $insert_grades21 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mai5hh', 'PSYC', '2150', '2016', 'Fall', 'B+')";
      private $insert_grades22 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mai5hh', 'MATH', '3310', '2016', 'Spring', 'B+')";
      private $insert_grades23 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mai5hh', 'PSYC', '2600', '2017', 'Spring', 'A')";
      private $insert_grades24 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mai5hh', 'MATH', '4651', '2016', 'Fall', 'A-')";
      private $insert_grades25 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mea2up', 'CS', '2150', '2017', 'Spring', 'B+')";
      private $insert_grades26 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mea2up', 'CS', '3330', '2017', 'Fall', 'B')";
      private $insert_grades27 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mea2up', 'CS', '4630', '2017', 'Fall', 'B+')";
      private $insert_grades28 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mea2up', 'PSYC', '2150', '2016', 'Spring', 'A-')";
      private $insert_grades29 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mea2up', 'PSYC', '2200', '2016', 'Fall', 'B+')";
      private $insert_grades30 = "INSERT INTO grades (email, dept, course, year, semester, grade)
         VALUES ('mea2up', 'PSYC', '2600', '2017', 'Spring', 'A+')";
		 
		 // function for executing SQL commands to load the database
	function load_db() {
      	   mysqli_query($this->connection, $this->create_table_students);
	       mysqli_query($this->connection, $this->create_table_courses);
	       mysqli_query($this->connection, $this->create_table_grades);
	       mysqli_query($this->connection, $this->insert_students1);
	       mysqli_query($this->connection, $this->insert_students2);
	       mysqli_query($this->connection, $this->insert_students3);
	       mysqli_query($this->connection, $this->insert_students4);
	       mysqli_query($this->connection, $this->insert_students5);
	       mysqli_query($this->connection, $this->insert_courses1);
	       mysqli_query($this->connection, $this->insert_courses2);
	       mysqli_query($this->connection, $this->insert_courses3);
	       mysqli_query($this->connection, $this->insert_courses4);
	       mysqli_query($this->connection, $this->insert_courses5);
	       mysqli_query($this->connection, $this->insert_courses6);
	       mysqli_query($this->connection, $this->insert_courses7);
	       mysqli_query($this->connection, $this->insert_courses8);
	       mysqli_query($this->connection, $this->insert_courses9);
	       mysqli_query($this->connection, $this->insert_grades1);
	       mysqli_query($this->connection, $this->insert_grades2);
	       mysqli_query($this->connection, $this->insert_grades3);
	       mysqli_query($this->connection, $this->insert_grades4);
	       mysqli_query($this->connection, $this->insert_grades5);
	       mysqli_query($this->connection, $this->insert_grades6);
	       mysqli_query($this->connection, $this->insert_grades7);
	       mysqli_query($this->connection, $this->insert_grades8);
	       mysqli_query($this->connection, $this->insert_grades9);
	       mysqli_query($this->connection, $this->insert_grades10);
	       mysqli_query($this->connection, $this->insert_grades11);
	       mysqli_query($this->connection, $this->insert_grades12);
	       mysqli_query($this->connection, $this->insert_grades13);
	       mysqli_query($this->connection, $this->insert_grades14);
	       mysqli_query($this->connection, $this->insert_grades15);
	       mysqli_query($this->connection, $this->insert_grades16);
	       mysqli_query($this->connection, $this->insert_grades17);
	       mysqli_query($this->connection, $this->insert_grades18);
	       mysqli_query($this->connection, $this->insert_grades19);
	       mysqli_query($this->connection, $this->insert_grades20);
	       mysqli_query($this->connection, $this->insert_grades21);
	       mysqli_query($this->connection, $this->insert_grades22);
	       mysqli_query($this->connection, $this->insert_grades23);
	       mysqli_query($this->connection, $this->insert_grades24);
	       mysqli_query($this->connection, $this->insert_grades25);
	       mysqli_query($this->connection, $this->insert_grades26);
	       mysqli_query($this->connection, $this->insert_grades27);
	       mysqli_query($this->connection, $this->insert_grades28);
	       mysqli_query($this->connection, $this->insert_grades29);
	       mysqli_query($this->connection, $this->insert_grades30);
	       // check if the query had any errors
	       if ($this->connection->errno != 0) {
	       	  //throw new Exception("Query Failed");
	       }
      }
	  
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
}

?>