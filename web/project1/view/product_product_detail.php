<?php
    $title = "SRP Online Store: Product";
    $content_title = "Product";

    ob_start();
    include __DIR__. '/../main_content/product_product.html.php';
    $main_content = ob_get_clean();

    include __DIR__ . '/../template/template.php';