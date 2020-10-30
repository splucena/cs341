<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['loggedin'])) {
    $title = "SRP Online Store: Order";
    $content_title = "Process Order";

    if (isset($display) && $display == "search") {
        $display = "search";
    } elseif (isset($display) && $display == "populate-form") {
        $display = "populate-form";
    } else {
        $display = "display";
    }

    ob_start();
    include __DIR__. '/../main_content/order_process.html.php';
    $main_content = ob_get_clean();
    include __DIR__ . '/../template/template.php';

} else {
    include __DIR__ . '/../view/index.php';
}

