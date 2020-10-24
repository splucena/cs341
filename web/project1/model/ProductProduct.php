<?php

class ProductProduct {
    private $productId;
    private $productName;
    private $categoryId;
    private $supplierId;
    private $active;
    private $unitPrice;

    public function __construct($pId = null, $pName = null, $cId = null, 
        $sId = null, $unitPrice = null, $cActive = True) {
        
        $this->productId = $pId;
        $this->productName = $pName;
        $this->categoryId = $cId;
        $this->supplierId = $sId;
        $this->active = $cActive;
        $this->unitPrice = $unitPrice;
    }

    public function getProductProducts($db) {        
        $sql = "SELECT 
                     pp.product_id as product_id,
                     pp.product_name as product_name,
                     pc.category_name as category_name,
                     ps.supplier_name as supplier_name,
                     pc.category_id as category_id,
                     ps.supplier_id as supplier_id,
                     pp.unit_price as unit_price
                FROM product_product pp
                LEFT JOIN product_category pc ON pp.category_id=pc.category_id
                LEFT JOIN product_supplier ps ON pp.supplier_id=ps.supplier_id
                WHERE pp.active = True";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $product_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $product_products;
    }
    
    public function searchProduct($db, $searchTerm) {
        $stmt = $db->prepare("SELECT
                    pp.product_id as product_id, 
                    pp.product_name as product_name,
                    pc.category_name as category_name,
                    ps.supplier_name as supplier_name,
                    pp.unit_price as unit_price  
                FROM product_product pp
                LEFT JOIN product_category pc ON pp.category_id=pc.category_id
                LEFT JOIN product_supplier ps ON pp.supplier_id=ps.supplier_id 
                WHERE pp.product_name ILIKE :name");
        $searchTerm = "%$searchTerm%";
        $stmt->bindParam(':name', $searchTerm);
        $stmt->execute();
        $inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $inventories;
    }
    
    public function getProductById($db, $productId) {
        $stmt = $db->prepare("SELECT 
                pp.product_id as product_id,
                pp.product_name as product_name,
                pc.category_name as category_name,
                ps.supplier_name as supplier_name,
                pc.category_id as category_id,
                ps.supplier_id as supplier_id,
                pp.unit_price as unit_price  
            FROM product_product pp
            LEFT JOIN product_category pc ON pp.category_id=pc.category_id
            LEFT JOIN product_supplier ps ON pp.supplier_id=ps.supplier_id 
            WHERE pp.product_id = :product_id");
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        $products = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $products;
    }

    public function insertProduct($db) {
        $sql = "INSERT INTO product_product
            (product_name, category_id, supplier_id, unit_price) 
            VALUES(:name, :category_id, :supplier_id, :unit_price)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $this->productName, PDO::PARAM_STR);
        $stmt->bindValue(':category_id', $this->categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':supplier_id', $this->supplierId, PDO::PARAM_INT);
        $stmt->bindValue(':unit_price', $this->unitPrice, PDO::PARAM_STR);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();        
        $stmt->closeCursor();

        return $rowChanged;
    }

    public function updateProduct($db) {
        $sql = "UPDATE product_product 
            SET product_name = :name, category_id = :category_id, 
            supplier_id = :supplier_id, unit_price = :unit_price
            WHERE product_id = :product_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $this->productName, PDO::PARAM_STR);
        $stmt->bindValue(':category_id', $this->categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':supplier_id', $this->supplierId, PDO::PARAM_INT);
        $stmt->bindvalue(':product_id', $this->productId, PDO::PARAM_INT);
        $stmt->bindValue(':unit_price', $this->unitPrice, PDO::PARAM_STR);
        $stmt->execute();
        $rowChanged = $stmt->rowCount();        
        $stmt->closeCursor();

        return $rowChanged;
    }

    public function deactivateProduct($db) {
        $sql = "UPDATE product_product SET active = False WHERE product_id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $this->productId, PDO::PARAM_INT);
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