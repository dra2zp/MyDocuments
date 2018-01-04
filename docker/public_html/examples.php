<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>
		<h1>This is our Example PHP page</h1>

		<?php

			// phpinfo();

			// $my_var = "D.J.";
			$my_var = $_GET["name"];
			print "Your name is $my_var <br/>";
			print 'Your name is $my_var'; // single quotes don't expand variables

			$age = 20;
			print "Your name is $my_var and you are $age years old.";

			if (isset($age)) {
			   print "The age exists!";
			}
			else {
			     print "The age does not exist!";
			}

			print "<br/>";

			$the_message = "Jello, World?";
			print "$the_message";

			$the_message{0} = "H";
			$the_message{strlen($the_message) - 1} = "!";

			print "$the_message";

			print "<ul>";
			for ($i = 0; $i <= 10; $i++) {
			    print "<li>$i</li>";
			}
			print "</ul>";

			// example of arrays
			$course = array("CS1110", "CS2150", "CS4640");
			// don't use this in production code
			print_r($course);

			// print out a list of courses
			// using a for-each loop
			print "<ul>";
			foreach($course as $course_num) {
				$just_the_num = substr($course_num, 2);
				print "<li>$just_the_num</li>";
			}
			print "</ul>";

			// Associative arrays
			// (Dictionaries/Mappings)
			// Key => Value pairs
			$course_title = array(
				      "CS1110" => "Intro to CS",
				      "CS2110" => "Software Engineering",
				      "CS2150" => "Data Structures",
				      "CS4640" => "PL for Web"
			);
			print_r($course_title);

			// iterate through key, value pairs in associative array
			foreach($course_title as $key => $value) {
				// do stuff
			}

			$cs2150 = $course_title['CS2150'];
			print "$cs2150";

			print "<br/>";
			print_r($_GET);

		?>
	</body>
</html>