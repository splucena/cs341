<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['loggedin'])) {
    require_once '../library/db_connection.php';
    require_once '../model/ProductInventory.php';
    require_once '../model/ProductProduct.php';

    $db = dbConnect();
    $inventory = new ProductInventory();
    $product = new ProductProduct();

    $limit = 10;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $startFrom = ($page - 1) * $limit;

    if ($display == 'display') {
        $inventories = $inventory->getProductInventories($db, $startFrom, $limit);
    } elseif ($display == 'populate-form') {
        $inventories = $inventory->getProductInventories($db, $startFrom, $limit);
        $inventoriesById = $inventory->getInventoryById($db, $inventoryId);
        $productId = $inventoriesById['product_id'];

        //var_dump($inventoriesById, $productId);
    } else {
        $inventories = $inventory->searchInventory($db, $searchTerm);
    }

    // Generate product selection
    $products = $product->getProductProducts($db);
    $productList = "<select name='product_id' id='product_list'>
        <option>Choose Product</option>";
    foreach($products as $p) {
        
        if (isset($productId) && $productId === $p['product_id']) {
            $productList .= "<option value='$p[product_id]' selected>$p[product_name]</option>";
        } else {
            $productList .= "<option value='$p[product_id]'>$p[product_name]</option>";
        }
    }
    $productList .= "</select>";
    
    $html = "<div><form action='../controller/inventory.action.php' method='GET'>
                <div>
                    <table>
                        <tr>
                            <td><input type='text' name='input-search' /></td>
                            <td><input type='submit' name='action' value='Search' /></td>
                        </tr>
                    </table>
                </div></form>";

    $counter = 1;
    $html .= "<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ProductName</th>
                        <th>Stock Quantity</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($inventories as $i) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td><a href='../controller/inventory.action.php?action=PopulateForm&id=$i[inventory_id]'>$i[product_name]</a></td>
                    <td>$i[total_stock]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    //echo $html;

    $totalRecords = $inventory->getInventoryCount($db)[0];

    $totalPages = ceil($totalRecords / $limit);

    if ($totalPages > 1) {
        echo $html;
        $pagLink = "<div class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            $pagLink .= "<span><a class='a-button' href='../view/product_inventory_detail.php?page=".$i."'>".$i."</a></span>";
        }
        echo $pagLink . "</div></div>";
    } else {
        $html .= "</div>";
        echo $html;
    }

    //<input type='text' name='product_name' value='". ( isset($inventoriesById) ? $inventoriesById['product_name'] : '') . "' />

    $formInventory = "<div>
        <h1>". ( isset($inventoriesById) ? $inventoriesById['product_name'] : 'Inventory') ." Detail</h1>
        <form method='POST' action='../controller/inventory.action.php'>
            <ul>
                <li>
                    <label for='product_name'>Name</label>
                    $productList
                </li>
                <li>
                    <label for='total_Stock'>Stock Quantity</label>
                    <input type='text' name='total_stock' value='". ( isset($inventoriesById) ? $inventoriesById['total_stock'] : '') . "' />
                </li>
                <li>
                    <div class='row'>
                        <input type='hidden' name='inventory_id' value='" . ( isset($inventoriesById) ? $inventoriesById['inventory_id'] : '') . "'>
                        <div class='col-50'>
                            <input type='submit' name='action' value='Create'>
                        </div>
                        <div class='col-25'>
                            <input type='submit' name='action' value='Update'>
                        </div>
                        <div class='col-25'>
                            <input type='submit' name='action' value='Clear'>
                        </div>
                    </div>
                </li>
            </ul>
        </form>
    </div>";
    echo $formInventory;
} else {
    include __DIR__ . '/../view/index.php';
}

