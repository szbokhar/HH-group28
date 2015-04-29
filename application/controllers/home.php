<?php
class Home extends Controller {
	
	 function __construct() {
		  parent::__construct();
	}


	/*
	 * This function is for the default home page stuff
	 */
	function index() {
		$TPL['msg'] = "";

		//rendering home_v.php view
		$this->view->render('home_v', $TPL);
	}
	
}	
?>