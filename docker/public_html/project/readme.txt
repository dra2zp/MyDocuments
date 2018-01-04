D.J. Anderson
dra2zp
Project
Final
readme.txt

----------

Main:
	ProjectLogin.php -> login page
	User: D.J. Anderson
		Username: dra2zp
		Password: cs4640
	Note:
		Changing the URL to
			.../project/ProjectController.php?request=make
		will create the database. The login page is
			.../project/ProjectLogin.php

----------

Details:
	mysqldump.sql -> dump of the 'project' database
	CreateDB.php -> creates the MySQL database 'project', 06-28-2017-234
	ProjectLogin.php -> login page, 06-28-2017-110
	uva-rotunda.jpg -> background image for login page
	LoginFirewall.php -> credentials are sent here for verification, 06-28-2017-46
	ProjectModelLogin.php -> model for communicating with the database in order to verify user login, 06-28-2017-60
	LoginSuccess.php -> creates $_SESSION to authenticate user, redirects user to main page, 06-28-2017-26
	ProjectMain.php -> main page for the grade calculator where users can view their semesters, 06-28-2017-135
	ProjectMain.js -> JavaScript for manipulating the main page, 06-28-2017-25
	home-page.jpg -> background image for main page
	ProjectModel.php -> model for communicating with the database in order to perform any functions requiring access to the database, 06-28-2017-582
	ProjectView.php -> view for communicating with the model and formatting the return, 06-28-2017-153
	ProjectController.php -> controller for sending incoming requests to the appropriate functions, 06-29-2017-276
	CreateAccount.php -> web page for creating a new user account, 06-28-2017-107
	CreateAccount.js -> JavaScript for manipulating the create account page, 06-28-2017-20
	create-account-bg.jpg -> background image for create account page
	ProjectTranscript.php -> web page where users can view their transcript, 06-28-2017-161
	ProjectTranscript.js -> JavaScript for manipulating the transcript page, 06-29-2017-127
	ProjectAddSemester.php -> web page for adding a new semester, 06-28-2017-154
	ProjectDeleteSemester.php -> web page for deleting a semester, 07-15-2017-159
	ProjectDeleteSemester.js -> JavaScript for manipulating the delete semester page, 06-28-2017-25
	ProjectClasses.php -> web page where users can view their classes for a particular semester, 06-28-2017-141
	ProjectClasses.js -> JavaScript for maniuplating the classes page, 06-28-2017-77
	ProjectCreateClass.php -> web page for creating a new class, 06-28-2017-252
	ProjectRemoveClass.php -> web page for removing an existing class, 06-28-2017-162
	ProjectRemoveClass.js -> JavaScript for manipulating the remove class page, 06-28-2017-25
	ProjectGrades.php -> web page for viewing assignments and grades inside a class, 06-29-2017-230
	ProjectGrades.js -> JavaScript for manipulating the grades page, 06-30-2017-907