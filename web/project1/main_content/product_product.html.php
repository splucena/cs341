<?php
    require_once '../library/db_connection.php';
    require_once '../model/ProductProduct.php';

    $db = dbConnect();
    $product_product = new ProductProduct();
    $product_products = $product_product->getProductProducts($db);
    
    $counter = 1;
    $html = "<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Supplier</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($product_products as $p) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td>$p[product_name]</td>
                    <td>$p[category_name]</td>
                    <td>$p[supplier_name]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    echo $html;