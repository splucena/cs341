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

switch($action) {
    case 'Search':
        $display = 'search';
        $searchTerm = filter_input(INPUT_GET, 'input-search', FILTER_SANITIZE_STRING);
        include('../view/user_detail.php');

        break;
    case 'PopulateForm':
        $display = 'populate-form';
        $userId = filter_input(INPUT_GET, 'id');

        include('../view/user_detail.php');
        break;
    case 'Create':
        $firstName = htmlspecialchars($_POST['fn']);
        $lastName = htmlspecialchars($_POST['ln']);
        $username = htmlspecialchars($_POST['username']);
        $passwd = htmlspecialchars($_POST['passwd']);
        $position = htmlspecialchars($_POST['position']);
        $phone = htmlspecialchars($_POST['phone']);

        $user = new Users();
        $user->insertUser($db, $firstName, $lastName, $username, 
            $passwd, $position, $phone);

        include('../view/user_detail.php');
        break;
    case 'Update':

        $userId = htmlspecialchars($_POST['user_id']);
        $firstName = htmlspecialchars($_POST['fn']);
        $lastName = htmlspecialchars($_POST['ln']);
        $username = htmlspecialchars($_POST['username']);
        $passwd = htmlspecialchars($_POST['passwd']);
        $position = htmlspecialchars($_POST['position']);
        $phone = htmlspecialchars($_POST['phone']);

        $user = new Users();
        $user->updateUser($db, $firstName, $lastName, $username, 
            $passwd, $position, $phone, $userId);
        include('../view/user_detail.php');
        break;

    case 'Deactivate':
        $userId = htmlspecialchars($_POST['user_id']);

        $user = new Users();
        $user->deactivateUser($db, $userId);
        include('../view/user_detail.php');
        break;

    default:
        include('../view/user_detail.php');
}

