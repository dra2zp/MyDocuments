<!DOCTYPE html>
<!-- D.J. Anderson -->
<!-- dra2zp -->
<!-- Project -->
<!-- ProjectLogin.php -->

<!-- login page -->

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Welcome!</title>
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
				background-image: url("uva-rotunda.jpg");
				height: 100%;
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
			}
			input[type=text], input[type=password] {
				width: 25%;
				padding: 6px 12px;
				margin: 6px;
				border 1px solid rgb(204, 204, 204);
				opacity: 0.8;
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
			#new {
				background-color: rgb(255, 204, 0);
				color: black;
				margin-left: 550px;
				width: 20%;
				height: 40px;
				font-size: 24px;
				font-family: Garamond;
			}
			button:hover {
				opacity: 0.9;
			}
			.container {
				padding: 6px;
				margin-left: 200px;
			}
			h1 {
				font-family: "Oleo Script";
				margin-left: 300px;
				font-size: 72px;
				color: rgb(0, 0, 153);
			}
			p {
				margin-left: 300px;
				color: rgb(255, 204, 0);
				bottom: 6px;
				position: absolute;
				font-size: 18px;
			}
		</style>
		<link href="http://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet"  type="text/css">
	</head>
	<body>
		<div class="bg">
			<form action="LoginFirewall.php" method="POST">
				<div class="container">
					<label for="username"><strong>Username</strong></label>
					<input id="username" name="username" type="text" placeholder="Enter Username" required maxlength="40"></input>
					<label for="password"><strong>Password</strong></label>
					<input id="password" name="password" type="password" placeholder="Enter Password" required maxlength="40"></input>
					<button type="submit" name="cmd" value="login">Login</button>
					<h1>Grade Calculator</h1>
					<p>Copyright &copy D.J. Anderson, University of Virginia, 2017</p>
				</div>
			</form>
			<form action="CreateAccount.php">
				<button id="new">Create an Account</button>
			</form>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>