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
	CreateDB.php -> creates the MySQL database 'project'
	ProjectLogin.php -> login page
	uva-rotunda.jpg -> background image for login page
	LoginFirewall.php -> credentials are sent here for verifying
	ProjectModelLogin.php -> model for communicating with the database in order to verify user login
	LoginSuccess.php -> creates $_SESSION to authenticate user, redirects user to main page
	ProjectMain.php -> main page for the grade calculator where users can view their classes
	ProjectMain.js -> JavaScript for manipulating the main page
	home-page.jpg -> background image for main page
	ProjectModel.php -> model for communicating with the database in order to perform any functions requiring access to the database
	ProjectView.php -> view for communicating with the model and formatting the return
	ProjectController.php -> controller for sending incoming requests to the appropriate functions
	CreateAccount.php -> web page for creating a new user account
	create-account-bg.jpg -> background image for create account page
	ProjectCreateClass.php -> web page for creating a new class
	ProjectRemoveClass.php -> web page for removing an existing class
	ProjectRemoveClass.js -> JavaScript for manipulating the remove class page
	ProjectGrades.php -> web page for viewing assignments and grades inside a class
	ProjectGrades.js -> JavaScript for manipulating the grades page