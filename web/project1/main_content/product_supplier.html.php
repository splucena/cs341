<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['loggedin'])) {
    require_once '../library/db_connection.php';
    require_once '../model/ProductSupplier.php';

    $db = dbConnect();
    $supplier = new ProductSupplier();
    //$suppliers = $supplier->getProductSuppliers($db);

    $limit = 10;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $startFrom = ($page - 1) * $limit;    
    
    if ($display == 'display') {
        $suppliers = $supplier->getProductSuppliers1($db, $startFrom, $limit);
    } elseif ($display == 'populate-form') {
        $suppliers = $supplier->getProductSuppliers1($db, $startFrom, $limit);
        $suppliersById = $supplier->getSupplierById($db, $supplierId);
    } else {
        $suppliers = $supplier->searchSupplier($db, $searchTerm);
    }

    $html = "<div><form action='../controller/supplier.action.php' method='GET'>
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
                        <th>Name</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($suppliers as $s) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td><a href='../controller/supplier.action.php?action=PopulateForm&id=$s[supplier_id]'>$s[supplier_name]</a></td>
                    <td>$s[supplier_addr]</td>
                    <td>$s[country]</td>
                    <td>$s[phone]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    //echo $html;
    
    $totalRecords = $supplier->getSupplierCount($db)[0];

    $totalPages = ceil($totalRecords / $limit);

    if ($totalPages > 1) {
        echo $html;
        $pagLink = "<div class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            $pagLink .= "<span><a class='a-button' href='../view/product_supplier_detail.php?page=".$i."'>".$i."</a></span>";
        }
        echo $pagLink . "</div></div>";
    } else {
        $html .= "</div>";
        echo $html;
    }

    $formSupplier = "<div>
        <h1>". ( isset($suppliersById) ? $suppliersById['supplier_name'] : 'Supplier') ." Detail</h1>
        <form method='POST' action='../controller/supplier.action.php'>
            <ul>
                <li>
                    <label for='supplier_name'>Name</label>
                    <input type='text' name='supplier_name' value='". ( isset($suppliersById) ? $suppliersById['supplier_name'] : '') . "' />
                </li>
                <li>
                    <label for='supplier_addr'>Address</label>
                    <input type='text' name='supplier_addr' value='". ( isset($suppliersById) ? $suppliersById['supplier_addr'] : '') . "' />
                </li>
                <li>
                    <label for='suppliername'>Country</label>
                    <input type='text' name='country' value='". ( isset($suppliersById) ? $suppliersById['country'] : '') . "' />
                </li>
                <li>
                    <label for='phone'>Phone</label>
                    <input type='text' name='phone' value='". ( isset($suppliersById) ? $suppliersById['phone'] : '') . "'/>
                </li>
                <li>
                    <div class='row'>
                    <input type='hidden' name='supplier_id' value='". ( isset($suppliersById) ? $suppliersById['supplier_id'] : '') . "'/>
                        <div class='col-25'>
                            <input type='submit' name='action' value='Create'>
                        </div>
                        <div class='col-25'>
                            <input type='submit' name='action' value='Update'>
                        </div>
                        <div class='col-25'>
                            <input type='submit' name='action' value='Deactivate'>
                        </div>
                        <div class='col-25'>
                            <input type='submit' name='action' value='Clear'>
                        </div>
                    </div>
                </li>
            </ul>
        </form>
    </div>";
    echo $formSupplier;
} else {
    include __DIR__ . '/../view/index.php';
}