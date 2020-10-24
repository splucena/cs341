<?php

require_once '../library/db_connection.php';
require_once '../model/Orders.php';

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
        include('../view/order_detail.php');

        break;
    case 'PopulateForm':
        $display = 'populate-form';
        $orderId = filter_input(INPUT_GET, 'id');

        include('../view/order_detail.php');
        break;

    case 'Create':
        $orderLineCount = htmlspecialchars($_POST['order_line_count']);
        //var_dump($orderLineCount);
        //exit;
        $orderLines = array();
        if ((int)$orderLineCount > 0) {
            for ($i = 1; $i <= $orderLineCount; $i++) {
                //echo $i;
                $productId = htmlspecialchars($_POST['product_id_' . $i]);
                $productQuantity = htmlspecialchars($_POST['product_quantity_' . $i]);
                array_push($orderLines, array($productId, $productQuantity));
            }
        } else {
            echo 'Empty!';
        }

        $orderId = null;
        $orderName  = htmlspecialchars($_POST['order_number']);;
        $orderDesc  = htmlspecialchars($_POST['order_desc']);;
        $orderStatus  = htmlspecialchars($_POST['order_status']);;
        $totalAmount  = htmlspecialchars($_POST['total_amount']);;
        $createDate = null;
        $shippingDate  = null;//htmlspecialchars($_POST['shipping_date']);;
        $invoiceId = null;
        $customerId  = (int)htmlspecialchars($_POST['customer_id']);;
        $userId  = (int)htmlspecialchars($_POST['user_id']);;

        $order = new Orders(null, $orderName, $orderDesc,
                            $orderStatus, $totalAmount, $createDate,
                            $shippingDate, $invoiceId, $customerId, $userId);
        $order->insertOrder($db);
        
        //var_dump($order);

        include('../view/order_detail.php');
        break;    
    default:
        include('../view/order_detail.php');
}

