<?php
    $title = "SRP Online Store: Order";
    $content_title = "Order Management";

    if (isset($display) && $display == "search") {
        $display = "search";
    } elseif (isset($display) && $display == "populate-form") {
        $display = "populate-form";
    } else {
        $display = "display";
    }

    ob_start();
    include __DIR__. '/../main_content/order.html.php';
    $main_content = ob_get_clean();

    include __DIR__ . '/../template/template.php';