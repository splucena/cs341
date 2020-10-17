<?php
    $title = "SRP Online Store: Product Category";
    $content_title = "Product Category";

    ob_start();
    include __DIR__. '/../main_content/product_category.html.php';
    $main_content = ob_get_clean();

    include __DIR__ . '/../template/template.php';