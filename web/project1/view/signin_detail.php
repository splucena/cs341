<?php
    $title = "SRP Online Store: Login";
    $home_title = "Sign in";

    $home_container = "home-container";

    ob_start();
    include __DIR__. '/../main_content/signin.html.php';
    $main_content = ob_get_clean();

    include __DIR__ . '/../template/template.php';
    //die();