<?php
    // Create or access Session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!is_writable(session_save_path())) {
        echo 'Session path "'.session_save_path().'" is not writable for PHP!'; 
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }

    function checkString($stringValue) {
        $valString = filter_var($stringValue, FILTER_SANITIZE_STRING);
        return $valString;
    }

    function checkFloat($floatValue) {
        // sanitize float
        $valFloat = filter_var($floatValue, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        return $valFloat;
    }

    function checkInt($intValue) {
        // sanitize integer
        $valInt = filter_var($intValue, FILTER_SANITIZE_NUMBER_INT);
        return $valInt;
    }

    //var_dump($action);
    //exit;
    if (isset($_POST['delete'])) {
        $action = 'remove-from-cart';
    } elseif (isset($_POST['update'])) {
        $action = 'update-quantity';
    } elseif (isset($_POST['addToCart'])) {
        $action = 'add-to-cart';
    } elseif (isset($_POST['viewCart'])) {
        $action = 'view-cart';
    }

    switch($action) {
        case 'add-to-cart': 
            $filename = checkString(filter_input(INPUT_POST, 'filename'));
            $title = checkString(filter_input(INPUT_POST, 'title'));
            $price = checkFloat(filter_input(INPUT_POST, 'price'));
            $quantity = checkInt(filter_input(INPUT_POST, 'quantity'));

            $productId = substr($filename, 0, -4);
            $order = array($productId, $filename, $title, $price, $quantity);

            // Add order to shopping card
            $_SESSION['shoppingCart'][] = $order;
            header('location: index.php');
            break;

        case 'update-quantity':
            $quantity = checkInt(filter_input(INPUT_POST, 'quantity'));
            $orderId = checkInt(filter_input(INPUT_POST, 'orderId'));

            //var_dump($quantity);
            //var_dump($_SESSION);
            //var_dump($orderId);
            //exit;
            // Update quantity based on order key
            $_SESSION['shoppingCart'][(int)$orderId][4] = (int)$quantity;
            header('location: cart.html.php');
            break;

        case 'remove-from-cart':
            $orderId = checkInt(filter_input(INPUT_POST, 'orderId'));
            
            // Delete order based on order key
            unset($_SESSION['shoppingCart'][(int)$orderId]);
            header('location: cart.html.php');
            break;

        case 'view-cart':
            header('location: cart.html.php');
            break;

        default:
            include 'index.php';
            break;
    }
?>