<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['loggedin'])) {
    $title = "SRP Online Store: User";
    $content_title = "User Management";

    if (isset($display) && $display == "search") {
        $display = "search";
    } elseif (isset($display) && $display == "populate-form") {
        $display = "populate-form";
    } else {
        $display = "display";
    }

    ob_start();
    include __DIR__. '/../main_content/user.html.php';
    $main_content = ob_get_clean();
    
    include __DIR__ . '/../template/template.php';

} else {
    include __DIR__ . '/../view/index.php';
}
