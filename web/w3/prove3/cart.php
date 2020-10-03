<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //unset($_SESSION['shoppingCart']);
    $cart = $_SESSION['shoppingCart'];
    
    $counter = 1;
    $total = 0;
    $html = "<h3>Checkout Items</h3>";
    $html .= "<table><thead><tr>";
    $html .= "<th>#</th><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th colspan='2'></th>";
    $html .= "</tr></thead>";
    $html .= "<tbody>";
    foreach($cart as $k => $o) {
        $subtotal = (float)$o[3] * (int)$o[4];
        $html .= "<form action='shoppingCart.php' method='POST'>";
        $html .= "<tr>";
        $html .= "<td>$counter</td>";
        $html .= "<td width='25%'>$o[2]</td>";
        $html .= "<td class='right'>$o[3]</td>";
        $html .= "<td width='5%'><input type='number' name='quantity' value='$o[4]'></td>";
        $html .= "<td class='right'>\$$subtotal</td>";
        $html .= "<td><input type='hidden' value='$k' name='orderId'><button type='submit' name='update' id='update-quantity'><i class='fas fa-edit'></i></button></td>";
        $html .= "<td><button type='submit' name='delete' id='add-to-cart'><i class='fa fa-trash'></i></button></td>";
        $html .= "</tr>";
        $html .= "</form>";
        $counter++;
        $total += $subtotal;        
    }
    $html .= "<tr><td colspan='3'></td><td>Total</td><td class='right'>$total</td><td colspan='4'></td></tr>";
    $html .= "</tbody>";
    $html .= "</table>";
    echo $html;
    
?>