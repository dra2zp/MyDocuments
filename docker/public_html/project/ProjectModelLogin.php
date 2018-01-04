<?php
// D.J. Anderson
// dra2zp
// Project
// ProjectModelLogin.php
// 06-28-2017-60

// model class for the login page

// requires the file with the class containing the password for dbuser
require_once('/home/dra2zp/.mysqlpass.inc.php');

// login class
class Login {
	// prepare for the database connection
	private static $host = 'localhost';
	private static $user = 'dbuser';
	private static $database = 'project';
	private $connection;
	public function __construct() {
		// constructor for connecting to the database using PDOs
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
	}
	public function verify($username, $password) {
		// verifies the user's username and password
		$prepared = $this->connection->prepare(
			"SELECT password FROM users WHERE username = :username"
		);
		if (!$prepared->execute([":username" => $username])) {
			// failing to execute the query
			throw new Exception("Fatal Error: Failed to execute the query");
		}
		if ($prepared->rowCount() == 0) {
			// no result
			throw new Exception("User $username not found");
		}
		// get the password from the database
		$row = $prepared->fetch(PDO::FETCH_ASSOC);
		$db_password = $row['password'];
		// hash the user's password to see if it matches the one stored in the database
		if (sha1($password) != $db_password) {
			throw new Exception("Password incorrect");
		}
		return true;
	}
}
?>