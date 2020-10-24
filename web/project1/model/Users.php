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
        $this->$uActive = $active;
    }

    public function getUsers($db) {
        
        $sql = "SELECT * FROM users WHERE active=True";
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

    public function insertUser($db, $firstName, $lastName, $username, 
        $passwd, $position, $phone) {

        $sql = "INSERT INTO users (first_name, last_name, username, passwd, position, phone)
            VALUES(:first_name, :last_name, :username, :passwd, :position, :phone)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':passwd', $passwd, PDO::PARAM_STR);
        $stmt->bindValue(':position', $position, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowChanged;
    }

    public function updateUser($db, $firstName, $lastName, $username, 
            $passwd, $position, $phone, $userId) {
        
        $sql = "UPDATE users 
            SET first_name = :first_name, 
            last_name = :last_name, 
            username = :username, 
            passwd = :passwd, 
            position = :position, 
            phone = :phone 
            WHERE user_id = :user_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':passwd', $passwd, PDO::PARAM_STR);
        $stmt->bindValue(':position', $position, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowChanged;
    }

    public function deactivateUser($db, $userId) {
        $sql = "UPDATE users SET active = False WHERE user_id = :user_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowChanged;
    }
}