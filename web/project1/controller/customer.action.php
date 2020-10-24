<?php

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
        $userId = filter_input(INPUT_GET, 'id');

        include('../view/customer_detail.php');
        break;

    case 'Create':
        $firstName = htmlspecialchars($_POST['fn']);
        $lastName = htmlspecialchars($_POST['ln']);
        $desc = htmlspecialchars($_POST['desc']);
        $billingAddr = htmlspecialchars($_POST['billing-addr']);
        $shippingAddr = htmlspecialchars($_POST['shipping-addr']);
        $country = htmlspecialchars($_POST['country']);
        $phone = htmlspecialchars($_POST['phone']);

        $customer = new Customer(null, $firstName, $lastName, 
                                 $billingAddr, $country, 
                                 $desc, $phone, $billingAddr);

        //var_dump($firstName, $lastName, $desc, $billingAddr, $shippingAddr, $country, $phone);
        //exit;

        $customer->insertCustomer($db);

        include('../view/customer_detail.php');
        break;

    case 'Update':
        $customerId = (int)htmlspecialchars($_POST['customer_id']);
        $firstName = htmlspecialchars($_POST['fn']);
        $lastName = htmlspecialchars($_POST['ln']);
        $desc = htmlspecialchars($_POST['desc']);
        $billingAddr = htmlspecialchars($_POST['billing-addr']);
        $shippingAddr = htmlspecialchars($_POST['shipping-addr']);
        $country = htmlspecialchars($_POST['country']);
        $phone = htmlspecialchars($_POST['phone']);

        $customer = new Customer($customerId, $firstName, $lastName, 
                                    $billingAddr, $country, 
                                    $desc, $phone, $billingAddr);

        //var_dump($customerId);
        //exit;

        $customer->updateCustomer($db);

        include('../view/customer_detail.php');
        break;

    case 'Deactivate':
        $customerId = (int)htmlspecialchars($_POST['customer_id']);

        $customer = new Customer($customerId);
        $customer->deactivateCustomer($db);

        include('../view/customer_detail.php');
        break;

    default:
        include('../view/customer_detail.php');
}

