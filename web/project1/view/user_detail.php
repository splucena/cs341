<?php
    $title = "SRP Online Store: User";
    $content_title = "User";

    ob_start();
    include __DIR__. '/../main_content/user.html.php';
    $main_content = ob_get_clean();

    include __DIR__ . '/../template/template.php';