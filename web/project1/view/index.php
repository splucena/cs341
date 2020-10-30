<?php
    $title = "SRP Online Store: Home";
    $content_title = "";

    $indexPage = True;
    $home_container = "home-container";

    ob_start();
    include __DIR__. '/../main_content/index.html.php';
    $main_content = ob_get_clean();

    include __DIR__ . '/../template/template.php';