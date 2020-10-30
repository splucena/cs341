<?php

session_start();
//$_SESSION['loggedin'] = TRUE; 
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

    case 'Sign up':
        $firstName = filter_input(INPUT_POST, 'fn', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'ln', FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $passwd = filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING);
        $confirmpPasswd = filter_input(INPUT_POST, 'confirm_passwd', FILTER_SANITIZE_STRING);

        $message = null;

        $hashedPassword = password_hash($passwd, PASSWORD_DEFAULT);
        $register = new Users(null, $firstName, $lastName, $username, $hashedPassword, null, null);

        $outcome = $register->registerUser($db);

        if ($outcome === 1) {
            $message = "Thank you for registering $firstName $lastName!";
        } else {
            $message = "Sorry $firstName, but your registration failed. Please try again.";
        }

        include('../view/signup_detail.php');
        break;
    
    case 'Cancel':
        include('../view/index.php');
        break;

    default:
        include('../view/signup_detail.php');
        break;
}

