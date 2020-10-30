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

    public function __construct($uId = null, $fn = null, $ln = null, 
                                  $un = null, $passwd = null,  $pos = null, 
                                  $phone = null, $uActive = True) {
        $this->userId = $uId;
        $this->firstName = $fn;
        $this->lastName = $ln;
        $this->username = $un;
        $this->passwd = $passwd;
        $this->position = $pos;
        $this->phone = $phone;
        $this->active = $uActive;
    }

    public function getUsersCount($db) {
        $sql = "SELECT COUNT(user_id) FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rowCount = $stmt->fetch();

        return $rowCount;
    }

    public function getUsers($db) {
        
        $sql = "SELECT * FROM users WHERE active=True";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $users;
    } 

    public function getUsers1($db, $startFrom, $limit) {
        
        $sql = "SELECT * FROM users WHERE active=True 
        ORDER BY user_id ASC LIMIT $limit OFFSET $startFrom";
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

    public function insertUser($db) {

        $sql = "INSERT INTO users (first_name, last_name, username, passwd, position, phone)
            VALUES(:first_name, :last_name, :username, :passwd, :position, :phone)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':first_name', $this->firstName, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $this->lastName, PDO::PARAM_STR);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':passwd', $this->passwd, PDO::PARAM_STR);
        $stmt->bindValue(':position', $this->position, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowChanged;
    }

    public function updateUser($db) {
        
        $sql = "UPDATE users 
            SET first_name = :first_name, 
            last_name = :last_name, 
            username = :username, 
            passwd = :passwd, 
            position = :position, 
            phone = :phone 
            WHERE user_id = :user_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':first_name', $this->firstName, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $this->lastName, PDO::PARAM_STR);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':passwd', $this->passwd, PDO::PARAM_STR);
        $stmt->bindValue(':position', $this->position, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $this->userId, PDO::PARAM_INT);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowChanged;
    }

    public function deactivateUser($db) {
        $sql = "UPDATE users SET active = False WHERE user_id = :user_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $this->userId, PDO::PARAM_INT);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowChanged;
    }

    public function registerUser($db) {
        $sql = "INSERT INTO users (first_name, last_name, username, passwd, position, phone)
            VALUES(:first_name, :last_name, :username, :passwd, :position, :phone)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':first_name', $this->firstName, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $this->lastName, PDO::PARAM_STR);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':passwd', $this->passwd, PDO::PARAM_STR);
        $stmt->bindValue(':position', $this->position, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();
        $stmt->closeCursor();

        //var_dump($rowChanged, $this->firstName, $this->lastName, $this->username, $this->passwd, $this->position, $this->phone);
        //exit;


        return $rowChanged;
    }

    public function signInUser($db) {

        // Get password based on username
        $sqlPassword = "SELECT passwd FROM users WHERE username = :username";
        $stmtPassword = $db->prepare($sqlPassword);
        $stmtPassword->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmtPassword->execute();
        $userData = $stmtPassword->fetch(PDO::FETCH_ASSOC);
        $resCount = count($userData);

        if ($resCount != 1) {
            return False;
        }
                        
        $hashedPassword = password_verify($this->passwd, $userData['passwd']);
        if (!$hashedPassword) {
            return False;
        } 

        return True;
    }
}