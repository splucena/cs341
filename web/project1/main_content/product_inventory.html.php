<?php
    require_once '../library/db_connection.php';
    require_once '../model/ProductInventory.php';

    $db = dbConnect();
    $inventory = new ProductInventory();

    if ($display == 'display') {
        $inventories = $inventory->getProductInventories($db);
    } elseif ($display == 'populate-form') {
        $inventories = $inventory->getProductInventories($db);
        $inventoriesById = $inventory->getInventoryById($db, $inventoryId);
    } else {
        $inventories = $inventory->searchInventory($db, $searchTerm);
    }
    
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
    $html .= "</tbody></table></div>";
    echo $html;

    $formInventory = "<div>
        <h1>". ( isset($inventoriesById) ? $inventoriesById['product_name'] : 'Inventory') ." Detail</h1>
        <form method='POST' action='../controller/inventories.action.php'>
            <ul>
                <li>
                    <label for='product_name'>Name</label>
                    <input type='text' name='product_name' value='". ( isset($inventoriesById) ? $inventoriesById['product_name'] : '') . "' />
                </li>
                <li>
                    <label for='total_Stock'>Stock Quantity</label>
                    <input type='text' name='total_stock' value='". ( isset($inventoriesById) ? $inventoriesById['total_stock'] : '') . "' />
                </li>
                <li>
                    <div class='row'>
                        <div class='col-50'>
                            <input type='submit' name='action' value='Create'>
                        </div>
                        <div class='col-50'>
                            <input type='submit' name='action' value='Update'>
                        </div>
                    </div>
                </li>
            </ul>
        </form>
    </div>";
    echo $formInventory;

