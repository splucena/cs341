<?php

include 'db_connection.php';
include 'scriptures.class.php';

$action = null;

if (isset($_GET['search'])) {
    $action = 'search';
} else {
    $action = 'detail';
}

switch($action) {
    case 'search':
        $book = filter_input(INPUT_GET, 'book');

        $s = new Scriptures();
        $result = $s->findByField($db, 'scriptures', 'book', $book);
        
        include 'search_scriptures.html.php';
        break;

    case 'detail':
        $id = filter_input(INPUT_GET, 'id');
        
        $s = new Scriptures();
        $res = $s->findById($db, 'scriptures', 'id', $id);
        $result = $res->fetch(PDO::FETCH_ASSOC);

        include 'scripture_detail.html.php';
        break;

    default:
        include 'search_scriptures.html.php';
}