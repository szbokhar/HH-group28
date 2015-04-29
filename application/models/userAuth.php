<?


class userAuth  {

    private $DB_users =  '' ;

    private $member_area = 'members.php';
    private $login_page = 'login.php';
    private $logout_page = 'main.html';


    private $username;
    private $password;

    private   $DBO;
    private   $DBH;

    /**
     * @return bool
     * @desc
     */
    public function __construct() {
        //you'll need to access database via Singleton here
        $this->DBO = Database::getInstance();
        $this->DBH = $this->DBO->getPDOConnection();
    }


    /*
     * Get the user access level
     */
    public function getUserPage($accessLevel)
    {
        switch ($accessLevel)
        {
            case 'bronze':


                break;

            case 'silver':


                break;

            case 'gold':

                break;

            default:

                break;

        }

    }

    /**
     * @return string
     * @desc Login handling
     */
    public function login() {

        //User is already logged in if SESSION variables are good. 
        if ($this->validSessionExists() == true):
            $this->redirect($this->member_area);
        endif;

        //First time users don't get an error message....
        if ($_SERVER['REQUEST_METHOD'] == 'GET') return;

        //Check login form for well formedness.....if bad, send error message
        if ($this->formHasValidCharacters() == false):
            return "Invalid characters in form fields! Only letters,numbers, 3-15 chars in length.";
        endif;

        // verify if form's data coresponds to database's data
        if ($this->userIsInDatabase() == false):
            return 'Invalid  username/password. ';
        else :
            //We're in!
            //Don't let people who's accounts are frozen in.
            //Redirect authenticated users to the correct landing page
            // ex: admin goes to admin, gold goes to help desk etc....
            $this->writeSession();
            $this->redirect($this->member_area);
        endif;
    }

    /**
     * @return void
     * @desc Validate if user is logged in
     */
    public function loggedin() {

        //Users who are not logged in are redirected out
        if ($this->validSessionExists() == false):
            $this->redirect($this->login_page);
        endif;

        //Access Control List checking goes here..
        //Does user have sufficient permissions to access page?
        //Ex. Can a bronze level access the Admin page?
    }

    /**
     * @return void
     * @desc The user will be logged out.
     */
    public function logout() {
        $_SESSION = array();
        session_destroy();
        header("Location: ". 'main.php');
    }

    /**
     * @return bool
     * @desc Verify if user has got a session and if the user's IP corresonds to the IP in the session.
     */
    public function validSessionExists() {
        if (!isset($_SESSION['username'])):
            return false;
        else:
            return true;
        endif;
    }

    /**
     * @return void
     * @desc Verify if login form fields were filled out correctly
     */
    public function formHasValidCharacters() {

        //check form values for strange characters and length (3-12 characters).
        //If both values have values at this point, then basic requirements met
        if ( empty($_POST['username']) == false):
            $this->username = $_POST['username'];
            return true;
        else:
            return false;
        endif;
    }

    /**
     * @return bool
     * @desc Verify username and password with MySQL database.
     */
    public function userIsInDatabase() {

        //use PDO to verify username and password from database table
        If ($this->username == 'letmein')  {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @return void
     * @param string $page
     * @desc Redirect the browser to the value in $page.
     */
    public function redirect($page) {
        header(ROOT . "/public/".$page . "php");
        exit();
    }

    /**
     * @return void
     * @desc Write username, email and IP into the session.
     */
    public function writeSession() {
        $_SESSION['username'] 	= $this->username;
    }

    /**
     * @return string
     * @desc Username getter, not necessary
     */
    public function getUsername() {
        return $_SESSION['username'];
    }



}

?>