<?php

session_start();
//$_SESSION['loggedin'] = TRUE;

require_once '../library/db_connection.php';
require_once '../model/Customer.php';

$db = dbConnect();

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
        $userId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        include('../view/customer_detail.php');
        break;

    case 'Create':
        $firstName = filter_input(INPUT_POST, 'fn', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'ln', FILTER_SANITIZE_STRING);
        $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
        $billingAddr = filter_input(INPUT_POST, 'billing-addr', FILTER_SANITIZE_STRING);
        $shippingAddr = filter_input(INPUT_POST, 'shipping-addr', FILTER_SANITIZE_STRING);
        $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

        $customer = new Customer(null, $firstName, $lastName, 
                                 $billingAddr, $country, 
                                 $desc, $phone, $billingAddr);

        //var_dump($firstName, $lastName, $desc, $billingAddr, $shippingAddr, $country, $phone);
        //exit;

        $customer->insertCustomer($db);

        include('../view/customer_detail.php');
        break;

    case 'Update':
        $customerId = (int)filter_input(INPUT_POST, 'customer_id', FILTER_SANITIZE_NUMBER_INT);
        $firstName = filter_input(INPUT_POST, 'fn', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'ln', FILTER_SANITIZE_STRING);
        $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
        $billingAddr = filter_input(INPUT_POST, 'billing-addr', FILTER_SANITIZE_STRING);
        $shippingAddr = filter_input(INPUT_POST, 'shipping-addr', FILTER_SANITIZE_STRING);
        $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

        $customer = new Customer($customerId, $firstName, $lastName, 
                                    $billingAddr, $country, 
                                    $desc, $phone, $billingAddr);

        //var_dump($customerId);
        //exit;

        $customer->updateCustomer($db);

        include('../view/customer_detail.php');
        break;

    case 'Deactivate':
        $customerId = (int)filter_input(INPUT_POST, 'customer_id', FILTER_SANITIZE_NUMBER_INT);

        $customer = new Customer($customerId);
        $customer->deactivateCustomer($db);

        include('../view/customer_detail.php');
        break;

    default:
        include('../view/customer_detail.php');
}

