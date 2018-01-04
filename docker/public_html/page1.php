<?php
session_start();
/*
	if(!isset($_COOKIE['loggedIn'])) {
		header('Location:login.php');
	}
*/
if (!isset($_SESSION['loggedIn'])) {
   header('Location:login.php');
}
?>

<!DOCTYPE html>
<html>
	<body>
		This is a cool web page that I should only be able to see if I'm logged in.
	</body>
</html>