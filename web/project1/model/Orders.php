<?php

class Orders {
    private $orderId;
    private $orderName;
    private $orderDesc;
    private $orderStatus;
    private $totalAmount;
    private $createDate;
    private $shippingDate;
    private $customerId;
    private $userId;

    public function __construct($oId = null, $oName = null, $oDesc = null,
                                  $oStatus = null, $tAmount = null, $cDate = null,
                                  $sDate = null, $cId = null,
                                  $uId = null) {
        $this->orderId = $oId;
        $this->orderName = $oName;
        $this->orderDesc = $oDesc;
        $this->orderStatus = $oStatus;
        $this->totalAmount = $tAmount;
        $this->createDate = $cDate;
        $this->shippingDate = $sDate;
        $this->customerId = $cId;
        $this->userId = $uId;
    }

    public function getOrders($db) {
        
        $sql = "SELECT
                    c.customer_id as customer_id,
                    u.user_id as user_id,
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
                c.customer_id as customer_id,
                u.user_id as user_id,
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

    public function insertOrder($db, $orderLines) {

        // Insert into orders
        $sqlOrders = "INSERT INTO 
                    orders (order_name, order_number, order_desc, order_status, 
                        total_amount, create_date, shipping_date,
                        customer_id, user_id)
                    VALUES(:order_name, :order_number, :order_desc, :order_status,
                        :total_amount, :create_date, :shipping_date,
                        :customer_id, :user_id)";

        $stmtOrders = $db->prepare($sqlOrders);
        $stmtOrders->bindValue(':order_name', $this->orderName, PDO::PARAM_STR);
        $stmtOrders->bindValue(':order_number', $this->orderName, PDO::PARAM_STR);
        $stmtOrders->bindValue(':order_desc', $this->orderDesc, PDO::PARAM_STR);
        $stmtOrders->bindValue(':order_status', $this->orderStatus, PDO::PARAM_STR);
        $stmtOrders->bindValue(':total_amount', $this->totalAmount, PDO::PARAM_STR);
        $stmtOrders->bindValue(':create_date', $this->createDate, PDO::PARAM_STR);
        $stmtOrders->bindValue(':shipping_date', $this->shippingDate, PDO::PARAM_STR);
        //$stmtOrders->bindValue(':invoice_id', $this->invoiceId, PDO::PARAM_INT);
        $stmtOrders->bindValue(':customer_id', $this->customerId, PDO::PARAM_INT);
        $stmtOrders->bindValue(':user_id', $this->userId, PDO::PARAM_INT);
        $stmtOrders->execute();
        $lastOrderId = $db->lastInsertId('orders_order_id_seq');

        // Insert order lines
        foreach($orderLines as $o) {
            //var_dump($o);
            $sqlOrderLine = "INSERT INTO order_item_line
                (order_id, product_id, unit_price, quantity, discount) 
                VALUES(:order_id, :product_id, :unit_price, :quantity, 0)";

            $stmtOrderLine = $db->prepare($sqlOrderLine);
            $stmtOrderLine->bindValue(':order_id', $lastOrderId, PDO::PARAM_INT);
            $stmtOrderLine->bindValue(':product_id', $o['product_id'], PDO::PARAM_INT);
            $stmtOrderLine->bindValue(':unit_price', $o['unit_price'], PDO::PARAM_STR);
            $stmtOrderLine->bindValue('quantity', $o['quantity'], PDO::PARAM_INT);
            $stmtOrderLine->execute();
        }        
        $rowChanged = $stmtOrders->rowCount();

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