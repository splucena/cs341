<?php
    
    $customerDetail = $_SESSION['customerDetail'];
    $cart = $_SESSION['shoppingCart'];

    $fullname = $customerDetail['fullname'];
    $address = "$customerDetail[address], $customerDetail[city], $customerDetail[state], $customerDetail[zip]";
    $email = $customerDetail['email'];

    $html = "<h3>Order Confirmation</h3><div class='order-confirmation-container'>";
    $html .= "<div>
                <div>Name: $fullname</div>
                <div>Shipping Address: $address</div>
                <div>Email: $email</div>
              </div>";

    // Loop through orders then display it
    $counter = 1;
    $total = 0;
    $html .= "<h3>Checkout Items</h3>";
    $html .= "<table><thead><tr class='border-bottom'>";
    $html .= "<th>#</th><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th></th>";
    $html .= "</tr></thead>";
    $html .= "<tbody>";
    foreach($cart as $k => $o) {
        $subtotal = (float)$o[3] * (int)$o[4];
        $html .= "<tr class='border-bottom'>";
        $html .= "<td class='center'>$counter.</td>";
        $html .= "<td width='25%'>$o[2]</td>";
        $html .= "<td class='right'>$o[3]</td>";
        $html .= "<td width='5%' class='right'>$o[4]</td>";
        $html .= "<td class='right'>\$$subtotal</td>";
        $html .= "</tr>";
        $counter++;
        $total += $subtotal;        
    }
    $html .= "<tr><td colspan='3'></td><td class='right bold'>Total</td><td class='right bold'>\$$total</td></tr>";
    $html .= "</tbody>";
    $html .= "</table><br>";

    $html .= "</div>";

    echo $html;
?>