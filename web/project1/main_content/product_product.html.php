<?php
    require_once '../library/db_connection.php';
    require_once '../model/ProductProduct.php';

    $db = dbConnect();
    $product = new ProductProduct();
    
    if ($display == 'display') {
        $products = $product->getProductProducts($db);
    } elseif ($display == 'populate-form') {
        $products = $product->getProductProducts($db);
        $productsById = $product->getProductById($db, $productId);
    } else {
        $products = $product->searchProduct($db, $searchTerm);
    }

    $html = "<div><form action='../controller/product.action.php' method='GET'>
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
                        <th>Category</th>
                        <th>Product</th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($products as $p) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td><a href='../controller/product.action.php?action=PopulateForm&id=$p[product_id]'>$p[product_name]</a></td>
                    <td>$p[category_name]</td>
                    <td>$p[product_name]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table></div>";
    echo $html;

    $formProduct = "<div>
        <h1>". ( isset($productsById) ? $productsById['product_name'] : 'Product') ." Detail</h1>
        <form method='POST' action='../controller/product.action.php'>
            <ul>
                <li>
                    <label for='product_name'>Name</label>
                    <input type='text' name='product_name' value='". ( isset($productsById) ? $productsById['product_name'] : '') . "' />
                </li>
                <li>
                    <label for='cateogry_name'>Category</label>
                    <input type='text' name='category_name' value='". ( isset($productsById) ? $productsById['category_name'] : '') . "' />
                </li>
                <li>
                    <label for='supplier_name'>Supplier</label>
                    <input type='text' name='supplier_name' value='". ( isset($productsById) ? $productsById['supplier_name'] : '') . "' />
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
    echo $formProduct;