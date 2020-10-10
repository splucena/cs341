<?php
try {
    $user = 'postgres';
    $password = 's!_bmubgc4BLKPGp';
    $db = new PDO('pgsql:host=localhost;dbname=db_notes;port=5433', $user, $password);
} catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}