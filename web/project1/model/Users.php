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

/*
Baby
Beer, Wine & Spirits
Beverages:  tea, coffee, soda, juice, Kool-Aid, hot chocolate, water, etc.
Bread & Bakery
Breakfast & Cereal
Canned Goods & Soups
Condiments/Spices & Bake
Cookies, Snacks & Candy
Dairy, Eggs & Cheese
Deli & Signature Cafe
Flowers
Frozen Foods
Produce: Fruits & Vegetables
Grains, Pasta & Sides
International Cuisine
Meat & Seafood
Miscellaneous – gift cards/wrap, batteries, etc.
Paper Products – toilet paper, paper towels, tissues, paper plates/cups, etc.
Cleaning Supplies – laundry detergent, dishwashing soap, etc.
Health & Beauty, Personal Care & Pharmacy – pharmacy items, shampoo, toothpaste
Pet Care
Pharmacy
Tobacco
*/