<?php

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
        $inventoryId = filter_input(INPUT_GET, 'id');

        include('../view/product_inventory_detail.php');
        break;

    case 'Create':
        $productId = htmlspecialchars($_POST['product_id']);
        $totalStock = htmlspecialchars($_POST['total_stock']);

        $inventory = new ProductInventory(null, $productId, $totalStock);
        $inventory->insertInventory($db);

        include('../view/product_inventory_detail.php');
        break;

    case 'Update':
        $inventoryId = htmlspecialchars($_POST['inventory_id']);
        $totalStock = htmlspecialchars($_POST['total_stock']);

        $inventory = new ProductInventory($inventoryId, null, $totalStock);
        $inventory->updateInventory($db);

        include('../view/product_inventory_detail.php');
        break;
    default:
        include('../view/product_inventory_detail.php');
}

