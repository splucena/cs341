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
        $password = 's!_bmubgc4BLKPGp';
        $db = new PDO('pgsql:host=localhost;dbname=d37erhhggeh672;port=5433', $user, $password);
        return $db;
    } catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }*/

    try {
        //$user = 'wzhaimlcbzqxqx';
        //$password = '3576d697b7cc2f959b57e89969b67c472da84fef00441f01213c1dfd45d41d66';
        //$db = new PDO('pgsql:host=ec2-54-224-175-142.compute-1.amazonaws.com;dbname=d37erhhggeh672;port=5432', $user, $password);
        $pdo = parse_url(getenv("DATABASE_URL"));

        $db = new PDO("pgsql:" . sprintf(
            "host=%s;port=%s;user=%s;password=%s;dbname=%s",
            $pdo["host"],
            $pdo["port"],
            $pdo["user"],
            $pdo["pass"],
            ltrim($pdo["path"], "/")
        ));
        return $db;
    } catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }

    /*try {
        //$dbUrl = getenv('DATABASE_URL');
        //$dbOpts = parse_url($dbUrl);

        $dbHost = 'ec2-54-224-175-142.compute-1.amazonaws.com';//$dbOpts["host"];
        $dbPort = 5432;//$dbOpts["port"];
        $dbUser = 'wzhaimlcbzqxqx';//$dbOpts["user"];
        $dbPassword = '3576d697b7cc2f959b57e89969b67c472da84fef00441f01213c1dfd45d41d66';//$dbOpts["pass"];
        $dbName = 'd37erhhggeh672';//ltrim($dbOpts["path"], '/');

        $db =  new PDO("pgsql:host=$dbHost;port=$dbPort,dbname=$dbName", $dbUser, $dbPassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    } catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }*/
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