<?php

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
        $supplierName = htmlspecialchars($_POST['supplier_name']);
        $supplierAddr = htmlspecialchars($_POST['supplier_addr']);
        $country = htmlspecialchars($_POST['country']);
        $phone = htmlspecialchars($_POST['phone']);

        $supplier = new ProductSupplier(null, $supplierName, $supplierAddr, $country, $phone);
        $supplier->insertSupplier($db);
        include('../view/product_supplier_detail.php');
        break;

    case 'Update':
        $supplierId = (int)htmlspecialchars($_POST['supplier_id']);
        $supplierName = htmlspecialchars($_POST['supplier_name']);
        $supplierAddr = htmlspecialchars($_POST['supplier_addr']);
        $country = htmlspecialchars($_POST['country']);
        $phone = htmlspecialchars($_POST['phone']);

        $supplier = new ProductSupplier($supplierId, $supplierName, $supplierAddr, $country, $phone);
        $supplier->updateSupplier($db);
        include('../view/product_supplier_detail.php');
        break;

    case 'Deactivate':
        $supplierId = (int)htmlspecialchars($_POST['supplier_id']);

        $supplier = new ProductSupplier($supplierId);
        $supplier->deactivateSupplier($db);
        include('../view/product_supplier_detail.php');
        break;
    
    default:
        include('../view/product_supplier_detail.php');
}

