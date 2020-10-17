<?php

// Check for method used is POST
$action = filter_input(INPUT_POST, 'action');

// HTTP method is GET
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action) {
    case 'Search':
        $display = 'search';
        $searchTerm = filter_input(INPUT_GET, 'input-search', FILTER_SANITIZE_STRING);
        include('../view/customer_detail.php');

        break;
    case 'PopulateForm':
        $display = 'populate-form';
        $userId = filter_input(INPUT_GET, 'id');

        include('../view/customer_detail.php');
        break;
    default:
        include('../view/customer_detail.php');
}

