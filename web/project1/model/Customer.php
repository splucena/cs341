<?php

class Customer {
    private $customerId;
    private $firstName;
    private $lastName;
    private $billingAddr;
    private $country;
    private $customerDesc;
    private $phone;
    private $shippingAddr;
    private $active;

    public function __constructor($cId = null, $fn = null, $ln = null, 
                                  $bAddr = null, $country = null,  $cDesc = null, 
                                  $phone = null, $sAddr = null, $cActive = True) {
        $this->$customerId = $cId;
        $this->$firstName = $fn;
        $this->$lastName = $ln;
        $this->$billingAddr = $bAddr;
        $this->$country = $country;
        $this->$customerDesc = $cDesc;
        $this->$shippingAddr = $sAddr;
        $this->$phone = $phone;
        $this->$active = $cActive;
    }

    public function getCustomers($db) {
        
        $sql = "SELECT * FROM customer";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $customers;
    }
    
    public function searchCustomer($db, $searchTerm) {
        $stmt = $db->prepare("SELECT * FROM customer WHERE last_name 
            ILIKE :name");
        $searchTerm = "%$searchTerm%";
        $stmt->bindParam(':name', $searchTerm);
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $customers;
    }
    
    public function getCustomerById($db, $customerId) {
        $stmt = $db->prepare("SELECT * FROM customer WHERE customer_id = :customer_id");
        $stmt->bindParam(':customer_id', $customerId);
        $stmt->execute();
        $customers = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $customers;
    }
}