<?php

class ProductProduct {
    private $productId;
    private $productName;
    private $categoryId;
    private $supplierId;
    private $active;

    public function __constructor($pId = null, $pName = null, $cId = null, $sId = null, $cActive = True) {
        $this->$productId = $pId;
        $this->$productName = $pName;
        $this->$categoryId = $cId;
        $this->$supplierId = $sId;
        $this->$active = $cActive;
    }

    public function getProductProducts($db) {        
        $sql = "SELECT 
                     pp.product_id as product_id,
                     pp.product_name as product_name,
                     pc.category_name as category_name,
                     ps.supplier_name as supplier_name
                FROM product_product pp
                LEFT JOIN product_category pc ON pp.category_id=pc.category_id
                LEFT JOIN product_supplier ps ON pp.supplier_id=ps.supplier_id";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $product_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $product_products;
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