<?php
// ZipModel.php

// Model Class for interacting with the class_examples database (the zips table in particular)

class ZipModel {

      // MySQL parameters for connecting
      private static $host = 'localhost';
      private static $user = 'dbuser'; // want to use a MySQL user with restricted access


      // This is very bad
      private static $password = 'cs4640'; // Don't do this!

      private static $database = 'class_examples';

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

      // given a zip code, return the city and state
      function get_city_state($zip) {

      	       // building up a MySQL query

	       // be wise and sanitize
	       $zip = $this->connection->real_escape_string($zip);
      	       $query = "SELECT city,state FROM zips WHERE zipcode=$zip";

	       // execute the query
	       $result = $this->connection->query($query);

	       // check if the query had any errors
	       if ($this->connection->errno != 0) {
	       	  throw new Exception("Query Failed");
	       }

	       // the query succeeded!
	       if ($result->num_rows != 1) {
	       	  // check if we have 1 row being returned
	       	  throw new Exception("Not a zipcode");
	       }
	       // get a row and return
	       return $result->fetch_assoc();
      }
}

?>