<?php
    require_once '../library/db_connection.php';
    require_once '../model/ProductInventory.php';

    $db = dbConnect();
    $product_inventory = new ProductInventory();
    $product_inventories = $product_inventory->getProductInventories($db);
    
    $counter = 1;
    $html = "<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ProductName</th>
                        <th>Stock Quantity</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($product_inventories as $s) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td>$s[product_name]</td>
                    <td>$s[total_stock]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    echo $html;