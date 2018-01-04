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
<!-- ProjectCreateClass.php -->
<!-- 06-28-2017-252 -->

<!-- create class page -->

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Create a Class</title>
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
				width: 100%;
				opacity: 0.5;
				font-size: 24px;
				margin-top: 20px;
				font-family: Garamond;
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
			input[type=text] {
				width: 25%;
				padding: 6px 12px;
				margin: 6px;
				border 1px solid rgb(204, 204, 204);
				opacity: 0.8;
			}
			.container {
				padding: 6px;
				margin-left: 200px;
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
			<li role="presentation"><a href="ProjectTranscript.php" id="transcript"><span class="glyphicon glyphicon-education" aria-hidden="true"></span>   View Transcript</a></li>
			<?php
			echo "<li role='presentation'><a href='ProjectClasses.php?semester=" . $_SESSION['semester'] . "' id='class'><span class='glyphicon glyphicon-arrow-left' aria-hidden='true'></span>   My Classes</a></li>";
			?>
			<li role="presentation" class="active"><a href="ProjectCreateClass.php" id="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>   Create a Class</a></li>
			<li role="presentation"><a href="ProjectRemoveClass.php" id="remove"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>   Remove a Class</a></li>
			<li role="presentation"><a href="ProjectController.php?request=killSession" id="logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>   Sign Out</a></li>
		</ul>
	</nav>
	<p>&nbsp</p>
	<body>
		<h1><strong>Create a Class</strong></h1>
		<form action="ProjectController.php?request=newClass" method="POST">
			<div class="container">
				<h3><strong>Class Information</strong></h3>
				<label for="title"><strong>Title</strong></label>
				<input id="title" name="title" type="text" placeholder="Enter Class Title" required maxlength="40"></input>
				<label for="credits"><strong>Credits</strong></label>
				<input id="credits" name="credits" type="text" placeholder="Enter Number of Credits" required max="127"></input>
				<br>
				<h3><strong>Grading Scale</strong></h3>
				<p>Please enter the percentages as decimals.</p>
				<label for="a_plus"><strong>A+</strong></label>
				<input id="a_plus" name="a_plus" type="text" value="0.9700" required></input>
				<label for="a"><strong>A</strong></label>
				<input id="a" name="a" type="text" value="0.9300" required></input>
				<label for="a_minus"><strong>A-</strong></label>
				<input id="a_minus" name="a_minus" type="text" value="0.9000" required></input>
				<br>
				<label for="b_plus"><strong>B+</strong></label>
				<input id="b_plus" name="b_plus" type="text" value="0.8700" required></input>
				<label for="b"><strong>B</strong></label>
				<input id="b" name="b" type="text" value="0.8300" required></input>
				<label for="b_minus"><strong>B-</strong></label>
				<input id="b_minus" name="b_minus" type="text" value="0.8000" required></input>
				<br>
				<label for="c_plus"><strong>C+</strong></label>
				<input id="c_plus" name="c_plus" type="text" value="0.7700" required></input>
				<label for="c"><strong>C</strong></label>
				<input id="c" name="c" type="text" value="0.7300" required></input>
				<label for="c_minus"><strong>C-</strong></label>
				<input id="c_minus" name="c_minus" type="text" value="0.7000" required></input>
				<br>
				<label for="d_plus"><strong>D+</strong></label>
				<input id="d_plus" name="d_plus" type="text" value="0.6700" required></input>
				<label for="d"><strong>D</strong></label>
				<input id="d" name="d" type="text" value="0.6300" required></input>
				<label for="d_minus"><strong>D-</strong></label>
				<input id="d_minus" name="d_minus" type="text" value="0.6000" required></input>
				<br>
				<label for="f"><strong>F</strong></label>
				<input id="f" name="f" type="text" value="0.0000" required></input>
				<br>
				<h3><strong>Points or Weighted Grades?</strong></h3>
				<label for="system"><strong>Points / Weighted</strong></label>
				<br>
				<input id="system" name="system" type="radio" value="P">   Points</input>
				<br>
				<input id="system" name="system" type="radio" value="W">   Weighted</input>
				<br>
				<h3><strong>Categories and Weights</strong></h3>
				<p>For weighted grades, please enter the assignment categories as well as their respective weights as a decimal.</p>
				<p>Note: If there are more categories and weight entries than you need, just leave them blank.</p>
				<label for="category1"><strong>Category 1</strong></label>
				<input id="category1" name="category1" type="text" placeholder="Tests" maxlength="40"></input>
				<label for="weight1"><strong>Weight 1</strong></label>
				<input id="weight1" name="weight1" type="text" placeholder="0.4"></input>
				<br>
				<label for="category2"><strong>Category 2</strong></label>
				<input id="category2" name="category2" type="text" placeholder="Homework" maxlength="40"></input>
				<label for="weight2"><strong>Weight 2</strong></label>
				<input id="weight2" name="weight2" type="text" placeholder="0.3"></input>
				<br>
				<label for="category3"><strong>Category 3</strong></label>
				<input id="category3" name="category3" type="text" placeholder="Quizzes" maxlength="40"></input>
				<label for="weight3"><strong>Weight 3</strong></label>
				<input id="weight3" name="weight3" type="text" placeholder="0.2"></input>
				<br>
				<label for="category4"><strong>Category 4</strong></label>
				<input id="category4" name="category4" type="text" placeholder="Attendance" maxlength="40"></input>
				<label for="weight4"><strong>Weight 4</strong></label>
				<input id="weight4" name="weight4" type="text" placeholder="0.1"></input>
				<br>
				<label for="category5"><strong>Category 5</strong></label>
				<input id="category5" name="category5" type="text" placeholder="" maxlength="40"></input>
				<label for="weight5"><strong>Weight 5</strong></label>
				<input id="weight5" name="weight5" type="text" placeholder=""></input>
				<br>
				<label for="category6"><strong>Category 6</strong></label>
				<input id="category6" name="category6" type="text" placeholder="" maxlength="40"></input>
				<label for="weight6"><strong>Weight 6</strong></label>
				<input id="weight6" name="weight6" type="text" placeholder=""></input>
				<br>
				<label for="category7"><strong>Category 7</strong></label>
				<input id="category7" name="category7" type="text" placeholder="" maxlength="40"></input>
				<label for="weight7"><strong>Weight 7</strong></label>
				<input id="weight7" name="weight7" type="text" placeholder=""></input>
				<br>
				<label for="category8"><strong>Category 8</strong></label>
				<input id="category8" name="category8" type="text" placeholder="" maxlength="40"></input>
				<label for="weight8"><strong>Weight 8</strong></label>
				<input id="weight8" name="weight8" type="text" placeholder=""></input>
				<br>
				<label for="category9"><strong>Category 9</strong></label>
				<input id="category9" name="category9" type="text" placeholder="" maxlength="40"></input>
				<label for="weight9"><strong>Weight 9</strong></label>
				<input id="weight9" name="weight9" type="text" placeholder=""></input>
				<br>
				<label for="category10"><strong>Category 10</strong></label>
				<input id="category10" name="category10" type="text" placeholder="" maxlength="40"></input>
				<label for="weight10"><strong>Weight 10</strong></label>
				<input id="weight10" name="weight10" type="text" placeholder=""></input>
				<br>
				<button type="submit" name="cmd" value="createClass">Create Class</button>
			</div>
		</form>
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
	</body>
</html>