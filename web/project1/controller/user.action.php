<?php

//
require_once '../model/Users.php';
require_once '../library/db_connection.php';

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
    case 'Search':
        $display = 'search';
        //$searchTerm = filter_input(INPUT_GET, 'input-search', FILTER_SANITIZE_STRING);
        $searchTerm = htmlspecialchars($_GET['input-search']);
        include('../view/user_detail.php');

        break;
    case 'PopulateForm':
        $display = 'populate-form';
        $userId = htmlspecialchars($_GET['id']);

        include('../view/user_detail.php');
        break;
    case 'Create':
        $firstName = htmlspecialchars($_POST['fn']);
        $lastName = htmlspecialchars($_POST['ln']);
        $username = htmlspecialchars($_POST['username']);
        $passwd = htmlspecialchars($_POST['passwd']);
        $position = htmlspecialchars($_POST['position']);
        $phone = htmlspecialchars($_POST['phone']);

        $user = new Users(null, $firstName, $lastName, $username, 
        $passwd, $position, $phone);
        $user->insertUser($db);

        include('../view/user_detail.php');
        break;
    case 'Update':

        $userId = (int)htmlspecialchars($_POST['user_id']);
        $firstName = htmlspecialchars($_POST['fn']);
        $lastName = htmlspecialchars($_POST['ln']);
        $username = htmlspecialchars($_POST['username']);
        $passwd = htmlspecialchars($_POST['passwd']);
        $position = htmlspecialchars($_POST['position']);
        $phone = htmlspecialchars($_POST['phone']);

        $user = new Users($userId, $firstName, $lastName, $username, 
        $passwd, $position, $phone);
        $user->updateUser($db);
        include('../view/user_detail.php');
        break;

    case 'Deactivate':
        $userId = (int)htmlspecialchars($_POST['user_id']);

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

