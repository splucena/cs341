<?php
    require_once '../library/db_connection.php';
    require_once '../model/ProductCategory.php';

    $db = dbConnect();
    $product_category = new ProductCategory();
    $product_categories = $product_category->getProductCategories($db);
    
    $counter = 1;
    $html = "<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($product_categories as $c) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td>$c[category_name]</td>
                    <td>$c[category_desc]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    echo $html;