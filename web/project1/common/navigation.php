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
                <a href='' class='active'>Home</a>
                <a href='#about'>Order Management</a>
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
                <a href='#about'>Customer Management</a>
                <a href='#about'>User Management</a>
                <a href='javascript:void(0);' style='font-size:15px;' class='icon' onclick='toggleMenu()'>&#9776;</a>
            </div>";

    echo $html;
?>