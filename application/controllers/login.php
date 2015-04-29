<?php
class Login extends Controller {

	private $TPL = "";

	/*
	 * Constructor
	 */
	 function __construct() {
		  parent::__construct();

	}

	function index() {
		$this->view->render('login_v', $TPL);
	}


	/*
	 * Login Method
	 */
	function login ()
	{
		//For now these values are hardcoded in, but we will have to significantly alter this code when we create the database,
		//for the login

		$username = $_POST['username'];
		$password =	$_POST['password'];

		//If username and password do not equal to admin, display a message stating the username/password is incorrect
		if($username == 'admin' && $password == 'admin')
		{
			//Sets Session variable that let's user log in. Basically if the user successfully logs in it will set their username
			//as the session variable. In the members page it will check to see if the session variable has been set. If it has
			//Been set the user has been authenticated, and they have access to the member page
			$_SESSION['username'] = $username;
			//Redirects to the Members Page
			header("Location: main.php?c=member");
		}
		else
		{
			$TPL['errMsg'] = "Incorrect username/password!";
			$this->view->render('login_v', $TPL);
		}
	}


	/*
	 * Logout Method
	 */
	function logout()
	{
		session_unset();
		$this->view->render('login_v', $TPL);
		exit;
	}

}	
?>