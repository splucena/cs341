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

    function checkEmail($clientEmail) {
        $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
        return $valEmail;
    }

    //var_dump($action);
    //exit;
    if (isset($_POST['checkout'])) {
        $action = 'checkout';
    } elseif (isset($_POST['continueShopping'])) {
        $action = 'continue-shopping';
    } else {
        $action = 'shop-again';
    }

    switch($action) {
        case 'checkout': 
            $fullname = checkString(filter_input(INPUT_POST, 'fullname'));
            $email = checkEmail(filter_input(INPUT_POST, 'email'));
            $address = checkString(filter_input(INPUT_POST, 'address'));
            $city = checkString(filter_input(INPUT_POST, 'city'));
            $state = checkString(filter_input(INPUT_POST, 'state'));
            $zip = checkString(filter_input(INPUT_POST, 'zip'));

            $customerDetail = array('fullname' => $fullname, 'email' => $email, 'address' => $address, 'city' => $city, 'state' => $state, 'zip' => $zip);
            //var_dump($customerDetail);
            //exit;

            // Add customer detail to session
            $_SESSION['customerDetail'] = $customerDetail;
            header('location: confirmation.html.php');
            break;

        case 'continue-shopping':

            header('location: cart.html.php');
            break;

        case 'shop-again':

            header('location: index.php');
            break;

        default:
            include 'index.php';
            break;
    }
?>