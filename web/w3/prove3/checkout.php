<?php

    $html = "<form action='checkoutOrders.php' method='POST'>";
    $html .= "<div>";
    $html .= "<h3>Billing Address</h3>";
    $html .= "<label for='fname'><i class='fa fa-user'></i> Full Name</label>";
    $html .= "<input type='text' id='fname' name='firstname' placeholder='John M. Doe'>";
    $html .= "<label for='email'><i class='fa fa-envelope'></i> Email</label>";
    $html .= "<input type='text' id='email' name='email' placeholder='john@example.com'>";
    $html .= "<label for='adr'><i class='fas fa-address-card'></i> Address</label>";
    $html .= "<input type='text' id='adr' name='address' placeholder='542 W. 15th Street'>";
    $html .= "<label for='city'><i class='fas fa-university'></i> City</label>";
    $html .= "<input type='text' id='city' name='city' placeholder='New York'>";
    $html .= "<div class='row'>";
    $html .= "<div class='col-50'>";
    $html .= "<label for='state'>State</label>";
    $html .= "<input type='text' id='state' name='state' placeholder='NY'>";
    $html .= "</div>";
    $html .= "<div class='col-50'>";
    $html .= "<label for='zip'>Zip</label>";
    $html .= "<input type='text' id='zip' name='zip' placeholder='10001'>";
    $html .= "</div>";
    $html .= "</div>";
    $html .= "<input type='submit' value='Checkout' class='btn btn-success'>";
    $html .= "<input type='hidden' name='action' value='checkout'>";
    $html .= "</form>";

    echo $html;
?>