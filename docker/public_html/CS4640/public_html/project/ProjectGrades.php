<?php
session_start();

if ($_SESSION['loggedIn'] != true) {
	// if the user is not logged in
	// redirect to the login page
	header('Location:ProjectLogin.php');
}
if (!$_SESSION['name']) {
	// if the session variable name is not set
	// redirect to the controller page to get the user's name
	header('Location:ProjectController.php?request=getName');
}
// get the class from the URL
$class = $_GET['class'];
// set the session variable title to the class name
$_SESSION['title'] = $class;
?>

<!DOCTYPE html>
<!-- D.J. Anderson -->
<!-- dra2zp -->
<!-- Project -->
<!-- ProjectGrades.php -->

<!-- grades page -->

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Grades</title>
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
				width: 49%;
				opacity: 0.5;
			}
			#calculate, #calc-min {
				background-color: rgb(255, 204, 0);
				color: white;
			}
			button:hover {
				opacity: 0.9;
			}
			body h1 {
				padding-left: 20px;
			}
			body ul a {
				color: black;
			}
			body ul {
				font-size: 24px;
				margin-left: 40px;
			}
			#green {
				background-color: rgb(102, 255, 102);
			}
			#blue {
				background-color: rgb(102, 204, 255);
			}
			#yellow {
				background-color: rgb(255, 255, 102);
			}
			#orange {
				background-color: rgb(255, 153, 51);
			}
			#red {
				background-color: rgb(255, 102, 102);
			}
			#invisible {
				height: 0%;
				width: 0%;
				font-size: 0px;
				background-color: transparent;
				color: transparent;
			}
			#calc-min {
				width: 100%;
				background-color: rgb(204, 0, 204);
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
			<li role="presentation"><a href="ProjectController.php?request=killSession" id="logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>   Sign Out</a></li>
		</ul>
	</nav>
	<p>&nbsp</p>
	<body>
		<?php
		echo "<h1 class='" . $_SESSION['title'] . "'><strong>My Grades for " . $_SESSION['title'] . "</h1>";
		?>
		<button id="invisible"></button>
		<div class="container">
			<form>
				<div class="form-group">
					<label class="control-label" for="assignment-name">Assignment Name</label>
					<input type="text" id="assignment-name" name="assignment" class="form-control"></input>
				</div>
				<div class="form-group">
					<label class="control-label" for="points-earned">Points Earned</label>
					<input type="number" id="points-earned" name="points_earned" class="form-control"></input>
				</div>
				<div class="form-group">
					<label class="control-label" for="points-possible">Points Possible</label>
					<input type="number" id="points-possible" name="points_possible" class="form-control"></input>
				</div>
				<button class="btn bton-submit" id="add" name="createGrade">Add Assignment</button>
				<button class="btn bton-submit" id="calculate">Calculate Minimum Grade</button>
			</form>
			<form id="goal">
				<!-- this is where the form is stored if the user clicks on the button to calculate the minimum grade -->
			</form>
			<div id="output">
				<!-- this is where the output is stored for displaying the minimum grade -->
			</div>
			<p>&nbsp</p>
			<div id="grades" style="border: 2px solid black">
				<table class="table" id="grades-table">
					<thead>
						<tr><th>Assignment Name</th><th>Points Earned</th><th>Points Possible</th><th>Percentage</th><th>Grade</th><th>&nbsp</th></tr>
					</thead>
					<tbody id="grades-body">
						<!-- this is where the grades table is stored -->
					</tbody>
				</table>
				<p>&nbsp</p>
				<table class="table" id="final-grade-table">
					<thead>
						<tr><th>Final Grade</th><th>&nbsp</th></tr>
					</thead>
					<div style="border: 1px solid black">
						<tbody id="final-grade-body">
							<!-- this is where the final grades table is stored -->
						</tbody>
					</div>
				</table>
			</div>
		</div>
	</body>
	<h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1><h1>&nbsp</h1>
	<footer>
		<p>Copyright &copy D.J. Anderson, University of Virginia, 2017</p>
	</footer>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="ProjectGrades.js"></script>
	</body>
</html>