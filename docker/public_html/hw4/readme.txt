D.J. Anderson
dra2zp
HW 4
readme.txt

index.html -> main user interface for student grades
index.js -> used to register clicks in index.html and communicate with PHP to retrieve JSON objects
createdb.php -> used to create the tables inside of the hw4 database
GradesModel.php -> grades model PHP file
GradesView.php -> grades view PHP file
GradesController.php -> grades controller PHP file

Answers to questions:

(1) This assignment took me approximately 14.5 hours. The most challenging part was figuring out how to transfer data from the PHP file to the JavaScript
	file using JSON objects. The most time-consuming part was constructing all the data that went into the tables and trying to figure out what syntax errors
	I had and where they were in the file.
(2) The approach I used for sorting table columns was searching for the function on Google. W3Schools gave great details on how to do this and provided
	functions that performed this feature. I copied the function into my JavaScript file and added appropriate coding to the tags. In each <tr> tag, I made
	it into a hyperlink and added 'onclick=sortTable(n)' into the <tr> tags so that when the user clicks on it, it calls the sortTable(n) function. The 'n'
	in the sortTable(n) function is used to specify the column number that was clicked.
(3) I laid out my MVC architecture slightly different than we did in class. At first, I had all my SQL commands for creating the tables and inserting data
	into the tables inside of the model because I wasn't sure how to separate them. Later, I separated them by creating a class inside of the createdb.php
	file whose only purpose was to contain the SQL commands. For some reason, creating a variable and performing ".=" on every SQL command I wanted to
	perform didn't work for me. So, my solution was to create a separate variable for every single SQL command and then execute all of them using separate
	commands performed in succession. After discussing with a few other students today, I realize that this was terribly inefficient, but my way works too,
	so I wasn't going to change it. But a better solution would've been to create one variable containing a string with every SQL command so that I would've
	only had to query one variable instead of almost fifty. Another solution was to use prepared statements, but that still would've required a ton of
	specifying all the holes and a lot of syntax added with that.
	In my model, I made a class that contains functions for getting all four tables by calling the appropriate SQL command. Something that I struggled with
	was making SQL just return the tables I wanted, not a cross product of the tables and not duplicate information. I did this by adding conditions using
	WHERE. I figured out all the table columns that corresponded with a column from a separate table. For example, the email from the students table was
	the same as the email from the grades table. So, in order to avoid extra rows that I didn't want, I added the condition WHERE students.email =
	grades.email.
	In my view, I made a class that first instantiates both the model class and the createdb class. Then, using those instantiated classes, I created
	functions inside the view class that shows all of the four tables that the model is supposed to retrieve. The purpose of the view is to encode the
	associate array into a JSON object.
	In my controller, I instantiated the view class. The purpose of my controller is to retrieve the data sent in the URL by the GET request. The information
	that I store in the URL is single number zero through 4 that indicates what the user wants to see. A GET request with value zero is only for creating the
	database. Value one is for viewing student info, two is for viewing course info, three is for viewing student/course info by student, and four is for
	viewing student/course info by department/course. Depending on the number of the GET request, it calls a function from the view, so that the view can
	return the JSON object to the JavaScript file.
	The JavaScript file did a sequence of operations each time one of the tabs was clicked. Although the table that gets displayed varies based on which tab
	is clicked, a lot of the commands are the same. The first thing that happens is deleting all the DOM nodes inside the table in order to erase any
	previous table data that the user wished to see. Next, an AJAX request is generated, and a value is sent to the controller indicating what table the user
	wants to see. Then, the table heading is displayed to the webpage. When the AJAX request has completed and the JSON object has been sent by the view to
	the JavaScript file, I used a for-loop to iterate over all the entries in the JSON object to display them in the HTML table. Finally, if the request
	failed, an error message is printed to the screen.