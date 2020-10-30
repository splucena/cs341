<?php

session_start();
//$_SESSION['loggedin'] = TRUE;

require_once '../library/db_connection.php';
require_once '../model/ProductProduct.php';

$db = dbConnect();

// Check for method used is POST
$action = filter_input(INPUT_POST, 'action');

// HTTP method is GET
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch($action) {
    case 'Search':
        $display = 'search';
        $searchTerm = filter_input(INPUT_GET, 'input-search', FILTER_SANITIZE_STRING);
        include('../view/product_product_detail.php');

        break;
    case 'PopulateForm':
        $display = 'populate-form';
        $productId = filter_input(INPUT_GET, 'id');

        include('../view/product_product_detail.php');
        break;

    case 'Create':
        $productName = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING);
        $supplierId = filter_input(INPUT_POST, 'supplier_id', FILTER_SANITIZE_STRING);
        $unitPrice = filter_input(INPUT_POST, 'unit_price', FILTER_SANITIZE_STRING);

        $product = new ProductProduct(null, $productName, $categoryId, 
                                      $supplierId, $unitPrice);
        $product->insertProduct($db);

        include('../view/product_product_detail.php');
        break;

    case 'Update':
        $productId = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
        $productName = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING);
        $supplierId = filter_input(INPUT_POST, 'supplier_id', FILTER_SANITIZE_STRING);
        $unitPrice = filter_input(INPUT_POST, 'unit_price', FILTER_SANITIZE_STRING);

        $product = new ProductProduct($productId, $productName, $categoryId, 
                                      $supplierId, $unitPrice);
        $product->updateProduct($db);

        include('../view/product_product_detail.php');
        break;

    case 'Deactivate':
        $productId = (int)filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);

        $product = new ProductProduct($productId);
        $product->deactivateProduct($db);
        include('../view/product_product_detail.php');
        break;    
    default:
        include('../view/product_product_detail.php');
}

