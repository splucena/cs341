<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $cart = $_SESSION['shoppingCart'];

    $counter = 0;
    foreach($cart as $k => $o) {
        $html = "<form action='shoppingCart.php' method='POST'>";
        $html .= "<ul>";
        $html .= "<li>$o[0]</li>";
        $html .= "<li>$o[2]</li>";
        $html .= "<li>$o[3]</li>";
        $html .= "<li><input type='number' name='quantity' value='$o[4]'>$o[4]</li>";
        $html .= "<input type='submit' name='update' value='Update' class='btn btn-success' id='update-quantity'>";
        $html .= "<input type='hidden' value='$k' name='orderId'>";
        $html .= "<input type='submit' name='delete' value='Delete' class='btn btn-success' id='add-to-cart'>";
        //$html .= "<input type='hidden' name='action' value='remove-from-cart'>";
        $html .= "</ul>";
        $html .= "</form>";
        $counter++;
        echo $html;
    }
?>