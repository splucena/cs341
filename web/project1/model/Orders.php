<?php

class Orders {
    private $orderId;
    private $orderName;
    private $orderDesc;
    private $orderStatus;
    private $totalAmount;
    private $createDate;
    private $shippingDate;
    private $invoiceId;
    private $customerId;
    private $userId;

    public function __constructor($oId = null, $oName = null, $oDesc = null,
                                  $oStatus = null, $tAmount = null, $cDate = null,
                                  $sDate = null, $iId = null, $cId = null,
                                  $uId = null) {
        $this->$orderId = $oId;
        $this->$orderName = $oName;
        $this->$orderDesc = $oDesc;
        $this->$orderStatus = $oStatus;
        $this->$totalAmount = $tAmount;
        $this->$createDate = $cDate;
        $this->$shippingDate = $sDate;
        $this->$invoiceId = $iId;
        $this->$customerId = $cId;
        $this->$userId = $uId;
    }

    public function getOrders($db) {
        
        $sql = "SELECT
                    o.order_id as order_id,
                    o.order_number as order_number,
                    o.order_status as order_status,
                    o.total_amount as total_amount,
                    o.shipping_date as shipping_date,
                    c.first_name as c_first_name,
                    u.first_name as u_first_name
                FROM orders o
                LEFT JOIN customer c ON o.customer_id=c.customer_id
                LEFT JOIN users u ON o.user_id=u.user_id";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $orders;
    } 

    public function searchOrder($db, $searchTerm) {
        $stmt = $db->prepare("SELECT * FROM orders WHERE order_number 
            ILIKE :name");
        $searchTerm = "%$searchTerm%";
        $stmt->bindParam(':name', $searchTerm);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $orders;
    }
    
    public function getOrderById($db, $orderId) {
        $stmt = $db->prepare("SELECT
                o.order_id as order_id, 
                o.order_number as order_number,
                o.order_desc as order_desc,
                o.order_status as order_status,
                o.total_amount as total_amount,
                o.shipping_date as shipping_date,
                c.first_name as customer_name,
                u.first_name as user_name
            FROM orders o 
            LEFT JOIN customer c ON o.customer_id=c.customer_id
            LEFT JOIN users u ON o.user_id=u.user_id
            WHERE o.order_id = :order_id");
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        $orders = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $orders;
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