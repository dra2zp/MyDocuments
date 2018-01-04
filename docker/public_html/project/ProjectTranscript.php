<?php
session_start();
if ($_SESSION['loggedIn'] != true) {
	header('Location:ProjectLogin.php');
}
if (!$_SESSION['name']) {
		header('Location:ProjectController.php?request=getName');
}
?>

<!DOCTYPE html>
<!-- D.J. Anderson -->
<!-- dra2zp -->
<!-- Project -->
<!-- ProjectTranscript.php -->
<!-- 06-28-2017-161 -->

<!-- transcript page -->

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>My Transcript</title>
		<!-- Bootstrap -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
			<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			html, body {
				height: 100%;
			}
			.bg {
				background-image: url("home-page.jpg");
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
			}
			header {
				font-family: "Oleo Script";
				text-align: center;
				background-color: rgb(0,0,153);
				color: rgb(255,153,0);
				padding: 25px;
				border-radius: 10px;
				box-shadow: rgb(0,0,0) 4px 2px 6px;
				overflow: hidden;
				width: 100%;
			}
			footer {
				font-size: 18px;
				text-align: center;
				background-color: rgb(0,0,153);
				color: rgb(255,153,0);
				padding: 25px;
				border-radius: 10px;
				box-shadow: rgb(0,0,0) 4px 2px 6px;
				overflow: hidden;
				width: 100%;
				margin-bottom: 0px;
				position: relative;
				bottom: 0px;
			}
			header h1 {
				font-size: 72px;
			}
			button {
				background-color: rgb(51, 204, 51);
				color: white;
				padding: 6px 12px;
				margin: 8px 0;
				border: none;
				width: 10%;
				opacity: 0.5;
			}
			button:hover {
				opacity: 0.9;
			}
			body h1 {
				padding-left: 20px;
			}
			body ul a {
				color: white;
			}
			body ul {
				font-size: 24px;
				margin-left: 40px;
			}
			#grades {
				margin-left: 40px;
				margin-right: 40px;
			}
			#info {
				margin-left: 20px;
				font-family: "Courier New";
			}
			#stats {
				margin-left: 60px;
				width: 600px;
				font-family: "Courier New";
			}
			#stats h1 {
				font-size: 20px;
			}
		</style>
		<link href="http://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet"  type="text/css">
	</head>
	<div class="bg">
	<header>
		<?php
		echo "<h1>Welcome, " . $_SESSION['name'] . "!</h1>";
		?>
	</header>
	<nav>
		<ul class="nav nav-pills" id="options">
			<li role="presentation"><a href="ProjectMain.php" id="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>   Home</a></li>
			<li role="presentation" class="active"><a href="ProjectTranscript.php" id="transcript"><span class="glyphicon glyphicon-education" aria-hidden="true"></span>   View Transcript</a></li>
			<li role="presentation"><a href="ProjectController.php?request=killSession" id="logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>   Sign Out</a></li>
		</ul>
	</nav>
	<p>&nbsp</p>
	<body>
		<div id="info">
			<?php
			echo "<h2>Name: " . $_SESSION['name'] . "</h2>";
			echo "<h3>Student ID: " . $_SESSION['username'] . "</h3>";
			?>
		</div>
		<p>&nbsp</p>
		<div id="grades" style="border: 5px solid black">
			<table class="table" id="grades-table">
				<!-- this is where the user's transcript table goes -->
			</table>
		</div>
		<p>&nbsp</p>
		<div id="stats" style="border: 10px solid black">
			<!-- this is where the user's credit and gpa information go -->
		</div>
	</body>
	<h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1>
	<footer>
		<p>Copyright &copy D.J. Anderson, University of Virginia, 2017</p>
	</footer>
	</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="ProjectTranscript.js"></script>
	</body>
</html>