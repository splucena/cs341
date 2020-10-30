<?php

session_start();
//$_SESSION['loggedin'] = TRUE;

require_once '../model/ProductSupplier.php';
require_once '../library/db_connection.php';

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
        include('../view/product_supplier_detail.php');

        break;
    case 'PopulateForm':
        $display = 'populate-form';
        $supplierId = filter_input(INPUT_GET, 'id');

        include('../view/product_supplier_detail.php');
        break;
    
    case 'Create':
        $supplierName = filter_input(INPUT_POST, 'supplier_name', FILTER_SANITIZE_STRING);
        $supplierAddr = filter_input(INPUT_POST, 'supplier_addr', FILTER_SANITIZE_STRING);
        $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

        $supplier = new ProductSupplier(null, $supplierName, $supplierAddr, $country, $phone);
        $supplier->insertSupplier($db);
        include('../view/product_supplier_detail.php');
        break;

    case 'Update':
        $supplierId = (int)filter_input(INPUT_POST, 'supplier_id', FILTER_SANITIZE_NUMBER_INT);
        $supplierName = filter_input(INPUT_POST, 'supplier_name', FILTER_SANITIZE_STRING);
        $supplierAddr = filter_input(INPUT_POST, 'supplier_addr', FILTER_SANITIZE_STRING);
        $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

        $supplier = new ProductSupplier($supplierId, $supplierName, $supplierAddr, $country, $phone);
        $supplier->updateSupplier($db);
        include('../view/product_supplier_detail.php');
        break;

    case 'Deactivate':
        $supplierId = (int)filter_input(INPUT_POST, 'supplier_id', FILTER_SANITIZE_NUMBER_INT);

        $supplier = new ProductSupplier($supplierId);
        $supplier->deactivateSupplier($db);
        include('../view/product_supplier_detail.php');
        break;
    
    default:
        include('../view/product_supplier_detail.php');
}

