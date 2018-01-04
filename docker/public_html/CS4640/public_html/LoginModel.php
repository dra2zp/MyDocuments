<?php
// LoginModel.php

require_once('/home/dra2zp/.mysqlpass.inc.php');

class LoginModel {
      private static $host = 'localhost';
      private static $user = 'dbuser';
      private static $db = 'class_examples';
      private $connection;
      public function __construct() {
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
             if (!$this->connection->query("USE " . self::$db)) {
                 throw new Exception("Could not connect: " . $e->getMessage());
             }
      }

      public function verify_login($user, $pass) {
      	     $prepared = $this->connection->prepare(
	     	       "SELECT password FROM students WHERE email = :email"
             );
	     
	     if (!$prepared->execute([":email" => $user])) {
	        // failing to execute the query
	     	throw new Exception("FATAL ERROR SEND IN BACKUPS!");
	     }

	     if ($prepared->rowCount() == 0) {
	     	// no results
		throw new Exception("User $user not found");
	     }

	     $row = $prepared->fetch(PDO::FETCH_ASSOC);
	     $stored_pass = $row['password'];

	     if (sha1($pass) != $stored_pass) {
	     	throw new Exception("Password wrong!");
	     }

	     return true;
	}
}
?>