<?php

class ProductCategory {
    private $categoryId;
    private $categoryName;
    private $categoryDesc;
    private $active;

    public function __constructor($cId = null, $cName = null, $cDesc = null, $cActive = True) {
        $this->$categoryId = $cId;
        $this->$categoryName = $cName;
        $this->$categoryDesc = $cDesc;
        $this->$active = $cActive;
    }

    public function getProductCategories($db) {
        
        $sql = "SELECT * FROM product_category";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $product_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $product_categories;
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