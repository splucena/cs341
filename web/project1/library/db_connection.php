<?php
//echo (getenv('ENVIRONMENT'));

/*$db = parse_url(getenv("DATABASE_URL"));
$db["path"] = ltrim($db["path"], "/");

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s;sslmode=require;",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    $db["path"]
));*/

function dbConnect() {
// Local database connection
    /*try {
        $user = 'postgres';
        $password = '';
        $db = new PDO('pgsql:host=localhost;dbname=d37erhhggeh672;port=5433', $user, $password);
        return $db;
    } catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }*/

    try {
        $dbUrl = getenv('DATABASE_URL');
        $dbOpts = parse_url($dbUrl);

        $dbHost = $dbOpts["host"];
        $dbPort = $dbOpts["port"];
        $dbUser = $dbOpts["user"];
        $dbPassword = $dbOpts["pass"];
        $dbName = ltrim($dbOpts["path"], '/');

        $db =  new PDO("pgsql:host=$dbHost;port=$dbPort,dbname=$dbName", $dbUser, $dbPassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    } catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

dbConnect();

// heroku database connection
/*try {
    $dbUrl = getenv('DATABASE_URL');
    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"], '/');

    $db =  new PDO("pgsql:host=$dbHost;port=$dbPort,dbname=$dbName", $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}*/