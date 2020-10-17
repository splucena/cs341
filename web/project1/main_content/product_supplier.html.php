<?php
    require_once '../library/db_connection.php';
    require_once '../model/ProductSupplier.php';

    $db = dbConnect();
    $product_category = new ProductSupplier();
    $product_categories = $product_category->getProductSuppliers($db);
    
    $counter = 1;
    $html = "<table>
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
    foreach ($product_categories as $s) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td>$s[supplier_name]</td>
                    <td>$s[supplier_addr]</td>
                    <td>$s[country]</td>
                    <td>$s[phone]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    echo $html;