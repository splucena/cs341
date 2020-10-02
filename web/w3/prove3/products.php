<?php
    $JSON = file_get_contents("products.json");
    $products =json_decode($JSON, TRUE);
    
    foreach ($products as $p) {
        $html = "<div class='card'>";
        $html .= "<div><img src='static/img/$p[filename]' all='$p[title]'></div>";
        $html .= "<div class='product-description'>";
        $html .= "<p class='upper no-top-bottom-margin-padding'>$p[type]</>";
        $html .= "<h2 class='upper no-top-margin-padding'>$p[title]</h2>";
        $html .= "<p class='price'>\$$p[price]</p>";
        $html .= "<p class='justify'>$p[description]</p>";
        $html .= "<button>Add to Cart</button>";
        $html .= "</div>";
        $html .= "</div>";

        echo $html;
    }
    