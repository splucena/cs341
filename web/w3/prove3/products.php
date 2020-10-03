<?php
    $JSON = file_get_contents("products.json");
    $products =json_decode($JSON, TRUE);
    
    foreach ($products as $p) {
        $html = "<form action='shoppingCart.php' method='POST'>";
        $html .= "<div class='card'>";
        $html .= "<div><img src='static/img/$p[filename]' all='$p[title]'><input type='hidden' name='filename' value='$p[filename]'></div>";
        $html .= "<div class='product-description'>";
        $html .= "<p class='upper no-top-bottom-margin-padding'><small>$p[type]</small></p>";
        $html .= "<h2 class='upper no-top-margin-padding'>$p[title]</h2><input type='hidden' name='title' value='$p[title]'>";
        $html .= "<p class='price'>\$$p[price]</p><input type='hidden' name='price' value='$p[price]'>";
        $html .= "<p class='justify'>$p[description]</p>";
        $html .= "<div class='card-footer'>";
        $html .= "<div class='card-footer-quantity'>";
        $html .= "<div>";
        $html .= "<label for='quantity'>Quantity<label>";
        $html .= "</div>";
        $html .= "<div>";
        $html .= "<input type='number' name='quantity' value='quantity'>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "<div class='card-footer-buttons'>";
        $html .= "<input type='submit' value='Add to Cart' name='addToCart' id='add-to-cart'>";
        $html .= "<input type='submit' value='View Cart' name='viewCart' class='btn btn-success' id='view-cart'>";
        $html .= "</div>";
        //$html .= "<input type='hidden' name='action' value='add-to-cart'>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</form>";

        echo $html;
    }
    