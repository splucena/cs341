<?php
try {
    $user = 'postgres';
    $password = '';
    $db = new PDO('pgsql:host=localhost;dbname=db_notes;port=5433', $user, $password);
} catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}