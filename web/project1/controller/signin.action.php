<?php
/*
 * Signin controller 
 */

session_start();


// Include all requirements
require_once '../model/Users.php';
require_once '../library/db_connection.php';
require_once '../library/helper_functions.php';

// Check for method used is POST
$action = filter_input(INPUT_POST, 'action');
$db = dbConnect();

// HTTP method is GET
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

//echo $action;
//exit;

switch($action) {

    case 'Sign in':
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $passwd = filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING);
        
        $message = null;

        $signin = new Users(null, null, null, $username, $passwd, null, null);

        $outcome = $signin->signInUser($db);

        if ($outcome) {
            // Valid user log

            $_SESSION['loggedin'] = TRUE;
            include('../view/order_process_detail.php');
            break;
        } else {
            $message = "Please try again.";
        }

        include('../view/signin_detail.php');
        break;

    case "Logout":
        $_SESSION['loggedin'] = FALSE;
        header('location: /cs341/web/project1/view/index.php');
        die();
        break;
    
    case 'Cancel':
        include('../view/index.php');
        break;

    default:
        include('../view/signin_detail.php');
        break;
}

