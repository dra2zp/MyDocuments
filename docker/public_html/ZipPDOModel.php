<?php
// ZipModel.php

// Model Class for interacting with the class_examples database (the zips table in particular)

require_once('/home/dra2zp/.mysqlpass.inc.php');

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
	       /*
	       $this->connection = new mysqli(
	       		self::$host,
			self::$user,
			MySQLPassword::$password,
			self::$database
	       );
	       */
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

	       if (!$this->connection->query("USE " . self::$database)) {
	       	  throw new Exception("Could not connect: " . $e->getMessage());
	       }

	       /*

	       // if we couldn't connect to the MySQL server, throw an exception
	       if ($this->connection->connect_errno != 0) {
	       	  	throw new Exception("Could not connect!");
	       }
	       */
      }

      // given a zip code, return the city and state
      function get_city_state($zip) {

      	       // building up a MySQL query
	       $prepared = $this->connection->prepare(
	       		 "SELECT city, state FROM zips WHERE zipcode = :zip"
	       );

	       // execute the prepared statement (issue the query)
	       if (!$prepared->execute([":zip" => $zip])) {
	       	  throw new Exception("Query Failed");
	       }
	       
	       /*
	       // be wise and sanitize
	       $zip = $this->connection->real_escape_string($zip);
      	       $query = "SELECT city,state FROM zips WHERE zipcode=$zip";

	       // execute the query
	       $result = $this->connection->query($query);

	       // check if the query had any errors
	       if ($this->connection->errno != 0) {
	       	  throw new Exception("Query Failed");
	       }
	       */

	       // the query succeeded!
	       if ($prepared->rowCount() != 1) {
	       	  // check if we have 1 row being returned
	       	  throw new Exception("Not a zipcode");
	       }
	       // get a row and return
	       // PDO::FETCH_ASSOC indicates that we only want the associative array returned
	       return $prepared->fetch(PDO::FETCH_ASSOC);
      }
}

?>