<?php

class ProductSupplier {
    private $supplierId;
    private $supplierName;
    private $supplierAddr;
    private $country;
    private $phone;
    private $active;

    public function __construct($sId = null, $sName = null, $sAddr = null, $country = null, $phone = null, $sActive = True) {
        $this->supplierId = $sId;
        $this->supplierName = $sName;
        $this->supplierAddr = $sAddr;
        $this->country = $country;
        $this->phone = $phone;
        $this->active = $sActive;
    }

    public function getSupplierCount($db) {
        $sql = "SELECT COUNT(supplier_id) FROM product_supplier";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rowCount = $stmt->fetch();

        return $rowCount;
    }

    public function getProductSuppliers1($db, $startFrom, $limit) {
        
        $sql = "SELECT * FROM product_supplier WHERE active=True
            ORDER BY supplier_id ASC LIMIT $limit OFFSET $startFrom";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $product_suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $product_suppliers;
    } 

    public function getProductSuppliers($db) {
        
        $sql = "SELECT * FROM product_supplier WHERE active=True";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $product_suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $product_suppliers;
    } 
    
    public function searchSupplier($db, $searchTerm) {
        $stmt = $db->prepare("SELECT * FROM product_supplier WHERE supplier_name 
            ILIKE :name");
        $searchTerm = "%$searchTerm%";
        $stmt->bindParam(':name', $searchTerm);
        $stmt->execute();
        $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $suppliers;
    }
    
    public function getSupplierById($db, $supplierId) {
        $stmt = $db->prepare("SELECT * FROM product_supplier WHERE supplier_id = :supplier_id");
        $stmt->bindParam(':supplier_id', $supplierId);
        $stmt->execute();
        $suppliers = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $suppliers;
    }

    public function insertSupplier($db) {
        $sql = "INSERT INTO product_supplier (supplier_name, supplier_addr, country, phone)
            VALUES(:name, :addr, :country, :phone)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $this->supplierName, PDO::PARAM_STR);
        $stmt->bindValue(':addr', $this->supplierAddr, PDO::PARAM_STR);
        $stmt->bindValue(':country', $this->country, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();

        return $rowChanged;
    }

    public function updateSupplier($db) {
        $sql = "UPDATE product_supplier 
            SET supplier_name = :name, supplier_addr = :addr,
                country = :country, phone = :phone
            WHERE supplier_id = :id";

        var_dump($this->supplierId, $this->supplierAddr);

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $this->supplierName, PDO::PARAM_STR);
        $stmt->bindValue(':addr', $this->supplierAddr, PDO::PARAM_STR);
        $stmt->bindValue(':country', $this->country, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->supplierId, PDO::PARAM_INT);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();

        return $rowChanged;
    }
    
    public function deactivateSupplier($db) {
        $sql = "UPDATE product_supplier SET active = False WHERE supplier_id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $this->supplierId, PDO::PARAM_INT);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowChanged;
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