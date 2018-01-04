<?php
session_start();
require_once('LoginModel.php');
if(isset($_POST['cmd']) && $_POST['cmd'] == 'login') {
	$user = $_POST['username'];
	$pass = $_POST['password'];

	// verify that username and password are correct
	$model = new LoginModel();

	try {
	    $login = $model->verify_login($user, $pass);
	    //setcookie('loggedIn', 'yes');
	    $_SESSION['loggedIn'] = true;
	    echo "Login succeeded";
	}
	catch(Exception $e) {
		// we want to redirect the user
		echo "Login failed" . $e->getMessage();
	}
}
else {
     header('Location:login.php');
}
?>