<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['loggedin'])) {
    require_once '../library/db_connection.php';
    require_once '../model/ProductProduct.php';
    require_once '../model/ProductCategory.php';
    require_once '../model/ProductSupplier.php';

    $db = dbConnect();
    $product = new ProductProduct();

    $limit = 10;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $startFrom = ($page - 1) * $limit;
    
    if ($display == 'display') {
        $products = $product->getProductProducts1($db, $startFrom, $limit);
    } elseif ($display == 'populate-form') {
        $products = $product->getProductProducts1($db, $startFrom, $limit);
        $productsById = $product->getProductById($db, $productId);
        $supplierId = $productsById['supplier_id'];
        $categoryId = $productsById['category_id'];
    } else {
        $products = $product->searchProduct($db, $searchTerm);
    }

    // Generate supplier selection
    $supplier = new ProductSupplier();
    $suppliers = $supplier->getProductSuppliers($db);
    $supplierList = "<select name='supplier_id' id='supplier_list'>
        <option>Choose Supplier</option>";
    foreach($suppliers as $p) {
        
        if (isset($supplierId) && $supplierId === $p['supplier_id']) {
            $supplierList .= "<option value='$p[supplier_id]' selected>$p[supplier_name]</option>";
        } else {
            $supplierList .= "<option value='$p[supplier_id]'>$p[supplier_name]</option>";
        }
    }
    $supplierList .= "</select>";

    // Generate category selection
    $category = new ProductCategory();
    $categories = $category->getProductCategories1($db);
    $categoryList = "<select name='category_id' id='category_list'>
        <option>Choose Category</option>";
    foreach($categories as $p) {
        
        if (isset($categoryId) && $categoryId === $p['category_id']) {
            $categoryList .= "<option value='$p[category_id]' selected>$p[category_name]</option>";
        } else {
            $categoryList .= "<option value='$p[category_id]'>$p[category_name]</option>";
        }
    }
    $categoryList .= "</select>";

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
                        <th>Unit Price</th>
                        <th>Category</th>
                        <th>Supplier</th>
                    </tr>
                </thead>
                <tbody>";

    foreach ($products as $p) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td><a href='../controller/product.action.php?action=PopulateForm&id=$p[product_id]'>$p[product_name]</a></td>
                    <td>$p[unit_price]</td>
                    <td>$p[category_name]</td>
                    <td>$p[supplier_name]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    //echo $html;

    $totalRecords = $product->getProductCount($db)[0];

    $totalPages = ceil($totalRecords / $limit);

    if ($totalPages > 1) {
        echo $html;
        $pagLink = "<div class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            $pagLink .= "<span><a class='a-button' href='../view/product_product_detail.php?page=".$i."'>".$i."</a></span>";
        }
        echo $pagLink . "</div></div>";
    } else {
        $html .= "</div>";
        echo $html;
    }

    //<input type='text' name='supplier_name' value='". ( isset($productsById) ? $productsById['supplier_name'] : '') . "' />
    //<input type='text' name='category_name' value='". ( isset($productsById) ? $productsById['category_name'] : '') . "' />
    $formProduct = "<div>
        <h1>". ( isset($productsById) ? $productsById['product_name'] : 'Product') ." Detail</h1>
        <form method='POST' action='../controller/product.action.php'>
            <ul>
                <li>
                    <label for='product_name'>Name</label>
                    <input type='text' name='product_name' value='". ( isset($productsById) ? $productsById['product_name'] : '') . "' />
                </li>
                <li>
                    <label for='unit_price'>Unit Price</label>
                    <input type='text' name='unit_price' value='". ( isset($productsById) ? $productsById['unit_price'] : '') ."'>
                </li>
                <li>
                    <label for='cateogry_name'>Category</label>
                    $categoryList
                </li>
                <li>
                    <label for='supplier_name'>Supplier</label>
                    $supplierList
                </li>
                <li>
                    <div class='row'>
                        <input name='product_id' type='hidden' value='". ( isset($productsById) ? $productsById['product_id'] : '') ."'>
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
    echo $formProduct;

} else {
    include __DIR__ . '/../view/index.php';
}
