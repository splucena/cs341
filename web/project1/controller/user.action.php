<?php

session_start();
//$_SESSION['loggedin'] = TRUE;

require_once '../model/Users.php';
require_once '../library/db_connection.php';

// Check for method used is POST
$action = filter_input(INPUT_POST, 'action');
$db = dbConnect();

// HTTP method is GET
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action) {
    case 'Search':
        $display = 'search';
        //$searchTerm = filter_input(INPUT_GET, 'input-search', FILTER_SANITIZE_STRING);
        //$searchTerm = htmlspecialchars($_GET['input-search']);
        $searchTerm = filter_input(INPUT_GET, 'input-search', FILTER_SANITIZE_STRING);
        include('../view/user_detail.php');

        break;
    case 'PopulateForm':
        $display = 'populate-form';
        $userId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        include('../view/user_detail.php');
        break;
    case 'Create':

        $firstName = filter_input(INPUT_POST, 'fn', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'ln', FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $passwd = filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING);
        $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

        $user = new Users(null, $firstName, $lastName, $username, 
        $passwd, $position, $phone);
        $user->insertUser($db);

        include('../view/user_detail.php');
        break;
    case 'Update':

        $userId = (int)filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
        $firstName = filter_input(INPUT_POST, 'fn', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'ln', FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $passwd = filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING);
        $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

        $user = new Users($userId, $firstName, $lastName, $username, 
        $passwd, $position, $phone);
        $user->updateUser($db);
        include('../view/user_detail.php');
        break;

    case 'Deactivate':
        $userId = (int)filter_input(INPUT_POST , 'user_id', FILTER_SANITIZE_NUMBER_INT);

        $user = new Users($userId);
        $user->deactivateUser($db);
        include('../view/user_detail.php');
        break;
    
    case 'Clear':
        include('../view/user_detail.php');
        break;

    default:
        include('../view/user_detail.php');
        break;
}

