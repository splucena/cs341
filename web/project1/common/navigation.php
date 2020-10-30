<?php

    //$homePath = "/CS341/web/index.php";
    //$homePath = "../../index.php";
    //$homeURL = $homePath;

    //$helloWorldPath = "/CS341/web/hello.html";
    //$helloWorldPath = "../../hello.html";
    //$helloWorldURL = $helloWorldPath;

    //$shoppingCartPath = "/CS341/web/w3/prove3/index.php";
    //$shoppingCartPath = "/w3/prove3/index.php";
    //$shoppingCartURL = $shoppingCartPath;

    //<a href='#'>Assignment 2</a>
    //<a href='#'>Link 3</a>
    
    $html = "<div class='topnav' id='myTopnav'>
                <a href='../view/index.php' class='active'>Home</a>";

    if (isset($_SESSION['loggedin'])) {
        $html .= "<div class='dropdown'>
                <button class='dropbtn'>Order Management 
                    <i class='fa fa-caret-down'></i>
                </button>
                <div class='dropdown-content'>  
                <a href='../view/order_detail.php'>Create Order</a>
                <a href='../view/order_process_detail.php'>Process Order</a>
                    </div>
                </div>
                <div class='dropdown'>
                    <button class='dropbtn'>Product Management 
                        <i class='fa fa-caret-down'></i>
                    </button>
                    <div class='dropdown-content'>
                        <a href='../view/product_product_detail.php'>Product</a>
                        <a href='../view/product_category_detail.php'>Category</a>
                        <a href='../view/product_supplier_detail.php'>Supplier</a>
                        <a href='../view/product_inventory_detail.php'>Inventory</a>
                    </div>
                </div> 
                <a href='../view/customer_detail.php'>Customer Management</a>
                <a href='../view/user_detail.php'>User Management</a>
                <a href='../controller/signin.action.php?action=Logout'>Logout</a>";
    } else {
        $html .= "<a href='../view/order_detail.php'>Create Order</a>";
    }
            
    $html .= "<a href='javascript:void(0);' style='font-size:15px;' class='icon' onclick='toggleMenu()'>&#9776;</a>";
    $html .= "</div>";

    echo $html;
?>
