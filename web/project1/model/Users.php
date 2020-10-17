<?php

class Users {
    private $userId;
    private $firstName;
    private $lastName;
    private $username;
    private $passwd;
    private $position;
    private $phone;
    private $active;

    public function __constructor($uId = null, $fn = null, $ln = null, 
                                  $un = null, $passwd = null,  $pos = null, 
                                  $phone = null, $uActive = True) {
        $this->$userId = $uId;
        $this->$firstName = $fn;
        $this->$lastName = $ln;
        $this->$username = $un;
        $this->$passwd = $passwd;
        $this->$position = $pos;
        $this->$phone = $phone;
        $this->$phone = $phone;
    }

    public function getUsers($db) {
        
        $sql = "SELECT * FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $users;
    } 

    public function searchUser($db, $searchTerm) {
        $stmt = $db->prepare("SELECT * FROM users WHERE username 
            ILIKE :name");
        $searchTerm = "%$searchTerm%";
        $stmt->bindParam(':name', $searchTerm);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $users;
    }
    
    public function getUserById($db, $userId) {
        $stmt = $db->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $users;
    }
}