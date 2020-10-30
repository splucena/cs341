<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['loggedin'])) {
    $title = "SRP Online Store: Product";
    $content_title = "Product";

    if (isset($display) && $display == "search") {
        $display = "search";
    } elseif (isset($display) && $display == "populate-form") {
        $display = "populate-form";
    } else {
        $display = "display";
    }

    ob_start();
    include __DIR__. '/../main_content/product_product.html.php';
    $main_content = ob_get_clean();
    include __DIR__ . '/../template/template.php';
} else {
    include __DIR__ . '/../view/index.php';
}

