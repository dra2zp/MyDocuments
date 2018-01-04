<?php
session_start();
// D.J. Anderson
// dra2zp
// Project
// LoginFirewall.php
// 06-28-2017-46

// view for communicating with the login model

// requires the login model page
require_once('ProjectModelLogin.php');

if(isset($_POST['cmd']) && $_POST['cmd'] == 'login') {
	// if the sumbit button was set to cmd and its value is login
	// store the user's username and password as variables
	$username = $_POST['username'];
	$password = $_POST['password'];
	// instantiate the login class
	// verify that the username and password are correct
	$model = new Login();
	try {
		// verify the user's login and password
		// set the session variable loggedIn to true
		// set the session variable username to the user's username
		// initialize the session variable title
		// redirect to the login success page
		$login = $model->verify($username, $password);
		$_SESSION['loggedIn'] = true;
		$_SESSION['username'] = $username;
		$_SESSION['semester'] = "";
		$_SESSION['title'] = "";
		header('Location:LoginSuccess.php');
	}
	catch (Exception $e) {
		// display an appropriate error message to the user
		echo "Login failed.\n" . $e->getMessage();
		echo ".\nPlease return to the previous page and try logging in again or create an account.";
	}
}
else {
	// if the cmd value is not login
	// redirect the user to the login page
	header('Location:ProjectLogin.php');
}
?>