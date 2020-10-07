<?php
//echo (getenv('ENVIRONMENT'));

$db = parse_url(getenv("DATABASE_URL"));
$db["path"] = ltrim($db["path"], "/");

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s;sslmode=require;",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    $db["path"]
));