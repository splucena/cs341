<?php

    $html = "<form action='checkoutItems.php' method='POST'>";
    $html .= "<div>";
    $html .= "<h3>Billing Address</h3>";
    $html .= "<label for='fullname'><i class='fa fa-user'></i> Full Name</label>";
    $html .= "<input type='text' id='fullname' name='fullname' placeholder='John M. Doe'>";
    $html .= "<label for='email'><i class='fa fa-envelope'></i> Email</label>";
    $html .= "<input type='text' id='email' name='email' placeholder='johndoe@example.com'>";
    $html .= "<label for='address'><i class='fas fa-address-card'></i> Address</label>";
    $html .= "<input type='text' id='address' name='address' placeholder='123 W. 15th Street'>";
    $html .= "<label for='city'><i class='fas fa-university'></i> City</label>";
    $html .= "<input type='text' id='city' name='city' placeholder='New Jersey'>";
    $html .= "<div class='row'>";
    $html .= "<div class='col-50'>";
    $html .= "<label for='state'>State</label>";
    $html .= "<input type='text' id='state' name='state' placeholder='NJ'>";
    $html .= "</div>";
    $html .= "<div class='col-50'>";
    $html .= "<label for='zip'>Zip</label>";
    $html .= "<input type='text' id='zip' name='zip' placeholder='10001'>";
    $html .= "</div>";
    $html .= "</div>";
    $html .= "<div class='checkout-footer-buttons'>";
    $html .= "<div>";
    $html .= "<input type='submit' name='continueShopping' value='Return to Cart' class='btn btn-success'>";
    $html .= "</div>";
    $html .= "<div>";
    $html .= "<input type='submit' name='checkout' value='Checkout' class='btn btn-success'>";
    $html .= "</div>";
    $html .= "</div>";
    $html .= "</form>";

    echo $html;
?>