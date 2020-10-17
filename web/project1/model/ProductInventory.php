<?php

class ProductInventory {
    private $inventoryId;
    private $productId;
    private $totalStock;

    public function __constructor($iId = null, $pId = null, $totalStocck = null) {
        $this->$inventoryId = $iId;
        $this->$productId = $pId;
        $this->$totalStock = $totalStock;
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
        $product_inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $product_inventories;
    }    
}