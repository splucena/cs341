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

    public function __construct($cId = null, $fn = null, $ln = null, 
                                  $bAddr = null, $country = null,  $cDesc = null, 
                                  $phone = null, $sAddr = null, $cActive = True) {
        $this->customerId = $cId;
        $this->firstName = $fn;
        $this->lastName = $ln;
        $this->billingAddr = $bAddr;
        $this->country = $country;
        $this->customerDesc = $cDesc;
        $this->shippingAddr = $sAddr;
        $this->phone = $phone;
        $this->active = $cActive;
    }

    public function getCustomers($db) {
        
        $sql = "SELECT * FROM customer WHERE active=True";
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

    public function insertCustomer($db) {
        $sql = "INSERT INTO customer
            (first_name, last_name, billing_addr, country, customer_desc, phone, shipping_addr)
            VALUES(:first_name, :last_name, :billing_addr, :country, :customer_desc, :phone, :shipping_addr)"; 

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':first_name', $this->firstName, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $this->lastName, PDO::PARAM_STR);
        $stmt->bindValue(':billing_addr', $this->billingAddr, PDO::PARAM_STR);
        $stmt->bindValue(':country', $this->country, PDO::PARAM_STR);
        $stmt->bindValue(':customer_desc', $this->customerDesc, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $stmt->bindValue(':shipping_addr', $this->shippingAddr, PDO::PARAM_STR);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowChanged;
    }

    public function updateCustomer($db) {
        $sql = "UPDATE customer
            SET first_name = :first_name, last_name = :last_name, 
            billing_addr = :billing_addr, country = :country, 
            customer_desc = :customer_desc, phone = :phone, 
            shipping_addr = :shipping_addr WHERE customer_id = :customer_id"; 

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':first_name', $this->firstName, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $this->lastName, PDO::PARAM_STR);
        $stmt->bindValue(':billing_addr', $this->billingAddr, PDO::PARAM_STR);
        $stmt->bindValue(':country', $this->country, PDO::PARAM_STR);
        $stmt->bindValue(':customer_desc', $this->customerDesc, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $stmt->bindValue(':shipping_addr', $this->shippingAddr, PDO::PARAM_STR);
        $stmt->bindValue(':customer_id', $this->customerId, PDO::PARAM_INT);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowChanged;
    }

    public function deactivateCustomer($db) {
        $sql = "UPDATE customer SET active = False WHERE customer_id = :customer_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':customer_id', $this->customerId, PDO::PARAM_INT);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowChanged;
    }
}