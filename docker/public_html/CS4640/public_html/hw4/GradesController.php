<?php
// D.J. Anderson
// dra2zp
// HW 4
// GradesController.php

require_once('GradesView.php');

// create a new instance of the view class
$view = new GradesView();

// retrieve the GET data stored in the URL and store it as "type"
$type = $_GET['data'];

// makes the database
if ($type == 0) {
	$view->make();
}

// displays the first table view
if ($type == 1) {
   $view->show1();
}

// displays the second table view
if ($type == 2) {
   $view->show2();
}

// displays the third table view
if ($type == 3) {
   $view->show3();
}

// displays the fourth table view
if ($type == 4) {
   $view->show4();
}

?>