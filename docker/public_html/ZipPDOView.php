<?php
// View for the zip example

require_once('ZipPDOModel.php');

class ZipView {

      private $model;

      function __construct() {
      	       $this->model = new ZipModel();
      }
      
      public function show_city_state_JSON($zip) {
      	     $result = $this->model->get_city_state($zip);

	     // result will hold an associate array of zip code information
	     echo json_encode($result);
      }

}

?>