<?php

class Scriptures {

    private $book;
    private $chapter;
    private $verse;
    private $content;

    function __construct($book = "", $chapter = "", $verse = "", $content = "") {
        $this->book = $book;
        $this->chapter = $chapter;
        $this->verse = $verse;
        $this->content = $content;
    }

    public function query($db, $sql, $parameters = []) {
        $query = $db->prepare($sql);
        $query->execute($parameters);
        //var_dump($query, $parameters);
        return $query;
    }

    public function findByField($db, $table, $field, $value) {
        $query = "SELECT * FROM $table WHERE $field ILIKE :value";
        //var_dump($query);
        $parameters = ['value' => "%$value%"];
        $query = $this->query($db, $query, $parameters);

        return $query;
    }

    public function findById($db, $table, $field, $value) {
        $query = "SELECT * FROM $table WHERE $field = :value";
 
        $parameters = ['value' => $value];
        $query = $this->query($db, $query, $parameters);

        return $query;
    }

}