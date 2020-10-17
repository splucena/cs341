<?php
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
}

dbConnect();
