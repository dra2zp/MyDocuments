<?php
// D.J. Anderson
// dra2zp
// HW 4
// GradesView.php

// view for the grades model

require_once('GradesModel.php');
require_once('createdb.php');

class GradesView {

      private $model;
	  private $create;

		// view constructor
      function __construct() {
      	       $this->model = new GradesModel();
			   $this->create = new CreateDB();
      }

		// function for making the database
      public function make() {
      	     $result = $this->create->load_db();
      }

		// function for showing the first view
      public function show1() {
      	     $result = $this->model->view_student_info();
	     echo json_encode($result);
      }

		// function for showing the second view
      public function show2() {
      	     $result = $this->model->view_course_info();
	     echo json_encode($result);
      }

		// function for showing the third view
      public function show3() {
      	     $result = $this->model->view_student_course_info_by_student();
	     echo json_encode($result);
      }

		// function for showing the fourth view
      public function show4() {
      	     $result = $this->model->view_student_course_info_by_department_course();
	     echo json_encode($result);
      }
      
}

?>