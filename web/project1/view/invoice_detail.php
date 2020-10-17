<?php
    $title = "SRP Online Store: Invoice";
    $content_title = "Invoice";

    ob_start();
    include __DIR__. '/../main_content/invoice.html.php';
    $main_content = ob_get_clean();

    include __DIR__ . '/../template/template.php';