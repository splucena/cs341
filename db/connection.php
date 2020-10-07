<?php
//echo (getenv('ENVIRONMENT'));

$db = parse_url(getenv("DATABASE_URL"));
$db["path"] = ltrim($db["path"], "/");

//var_dump($db);
//exit;

/*$dsn = "pgsql:" 
    . "host=ec2-54-224-175-142.compute-1.amazonaws.com;"
    . "dbname=d37erhhggeh672;"
    . "user=wzhaimlcbzqxqx;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=3576d697b7cc2f959b57e89969b67c472da84fef00441f01213c1dfd45d41d66";
$pdo = new PDO($dsn);
*/

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s;sslmode=require;",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    $db["path"]
));