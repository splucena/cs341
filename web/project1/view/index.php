<?php

$title = "SRP Online Store: Home";
$home_title = "";
$currentDate = date("d.m.Y");

$indexPage = True;
$home_container = "home-container home";
$home_image = True;

ob_start();
include __DIR__. '/../main_content/index.html.php';
$main_content = ob_get_clean();

include __DIR__ . '/../template/template.php';