<?php
class Member extends Controller {

	//private $Auth;
	
	 function __construct() {
		  parent::__construct();

	}

	/*
 	 * Router
 	 */
	function index()
	{
		$this->loggedIn();
	}


	/*
	 * This function checks whether or not a user is logged in.
	 */
	function loggedIn()
	{
		//If the user has been authenticated, then they are able to access this page.
		if(isset($_SESSION['username']))
		{
			$TPL['msg'] = "Welcome to the members area!";
			$this->view-> render('member_v', $TPL);
		}
		//If not logged in
		else
		{
			$TPL['msg'] = "Login required to access this page.";
			$this->view-> render('member_v', $TPL);
		}
	}

}	
?>