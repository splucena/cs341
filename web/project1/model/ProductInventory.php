<?php

class ProductInventory {
    private $inventoryId;
    private $productId;
    private $totalStock;

    public function __construct($iId = null, $pId = null, $totalStock = null) {
        $this->inventoryId = $iId;
        $this->productId = $pId;
        $this->totalStock = $totalStock;
    }

    public function getProductInventories($db) {
        
        $sql = "SELECT 
                    pi.inventory_id as inventory_id, 
                    pi.product_id as product_id, 
                    pp.product_name as product_name, 
                    pi.total_stock as total_stock 
                FROM product_inventory pi
                LEFT JOIN product_product pp ON pi.product_id=pp.product_id";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $inventories;
    }

    public function searchInventory($db, $searchTerm) {
        $stmt = $db->prepare("SELECT pi.inventory_id as inventory_id, 
                    pi.product_id as product_id, 
                    pp.product_name as product_name, 
                    pi.total_stock as total_stock  
                FROM product_inventory pi
                LEFT JOIN product_product pp ON pi.product_id=pp.product_id 
                WHERE pp.product_name ILIKE :name");
        $searchTerm = "%$searchTerm%";
        $stmt->bindParam(':name', $searchTerm);
        $stmt->execute();
        $inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $inventories;
    }
    
    public function getInventoryById($db, $inventoryId) {
        $stmt = $db->prepare("SELECT
                    pp.product_id as product_id, 
                    pp.product_name as product_name, 
                    pi.total_stock as total_stock
                FROM product_inventory pi
                LEFT JOIN product_product pp ON pi.product_id=pp.product_id 
                WHERE pi.inventory_id = :inventory_id");
        $stmt->bindParam(':inventory_id', $inventoryId);
        $stmt->execute();
        $inventories = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $inventories;
    }    
}