<?php

class ProductSupplier {
    private $supplierId;
    private $supplierName;
    private $supplierAddr;
    private $country;
    private $phone;
    private $active;

    public function __construct($sId = null, $sName = null, $sAddr = null, $country, $phone, $sActive = True) {
        $this->supplierId = $sId;
        $this->supplierName = $sName;
        $this->supplierAddr = $sAddr;
        $this->country = $country;
        $this->phone = $phone;
        $this->active = $cActive;
    }

    public function getProductSuppliers($db) {
        
        $sql = "SELECT * FROM product_supplier";
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