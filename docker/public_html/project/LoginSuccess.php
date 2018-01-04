<?php
session_start();

// D.J. Anderson
// dra2zp
// Project
// LoginSuccess.php
// 06-28-2017-26

if ($_SESSION['loggedIn'] = true) {
	// checks to see if the user is logged in
	if (!$_SESSION['name']) {
		// if the session's name attribute is not set
		// redirect to the project controller to get the user's name
		header('Location:ProjectController.php?request=getName');
	}
	// if the session's name attribute is set to the user's first and last name
	// redirect to the main page
	header('Location:ProjectMain.php');
}
else {
	// if the user is not logged in
	// redirect to the login page
	header('Location:ProjectLogin.php');
}
?>