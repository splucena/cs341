<?php

session_start();
//$_SESSION['loggedin'] = TRUE;

require_once '../library/db_connection.php';
require_once '../model/ProductInventory.php';

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
        include('../view/product_inventory_detail.php');

        break;
    case 'PopulateForm':
        $display = 'populate-form';
        $inventoryId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        include('../view/product_inventory_detail.php');
        break;

    case 'Create':
        $productId = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
        $totalStock = filter_input(INPUT_POST, 'total_stock', FILTER_SANITIZE_STRING);

        $inventory = new ProductInventory(null, $productId, $totalStock);
        $inventory->insertInventory($db);

        include('../view/product_inventory_detail.php');
        break;

    case 'Update':
        $inventoryId = filter_input(INPUT_POST, 'inventory_id', FILTER_SANITIZE_NUMBER_INT);
        $totalStock = filter_input(INPUT_POST, 'total_stock', FILTER_SANITIZE_STRING);

        $inventory = new ProductInventory($inventoryId, null, $totalStock);
        $inventory->updateInventory($db);

        include('../view/product_inventory_detail.php');
        break;
    default:
        include('../view/product_inventory_detail.php');
}

