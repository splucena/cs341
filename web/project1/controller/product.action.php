<?php
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
        $productName = htmlspecialchars($_POST['product_name']);
        $categoryId = htmlspecialchars($_POST['category_id']);
        $supplierId = htmlspecialchars($_POST['supplier_id']);

        $product = new ProductProduct(null, $productName, $categoryId, $supplierId);
        $product->insertProduct($db);

        include('../view/product_product_detail.php');
        break;

    case 'Update':
        $productId = htmlspecialchars($_POST['product_id']);
        $productName = htmlspecialchars($_POST['product_name']);
        $categoryId = htmlspecialchars($_POST['category_id']);
        $supplierId = htmlspecialchars($_POST['supplier_id']);

        $product = new ProductProduct($productId, $productName, $categoryId, $supplierId);
        $product->updateProduct($db);

        include('../view/product_product_detail.php');
        break;

    case 'Deactivate':
        $productId = (int)htmlspecialchars($_POST['product_id']);

        $product = new ProductProduct($productId);
        $product->deactivateProduct($db);
        include('../view/product_product_detail.php');
        break;    
    default:
        include('../view/product_product_detail.php');
}

