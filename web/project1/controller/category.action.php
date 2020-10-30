<?php

session_start();
//$_SESSION['loggedin'] = TRUE;

require_once '../model/ProductCategory.php';
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
        include('../view/product_category_detail.php');

        break;
    case 'PopulateForm':
        $display = 'populate-form';
        $categoryId = filter_input(INPUT_GET, 'id');

        include('../view/product_category_detail.php');
        break;
    case 'Create':
            $categoryName = htmlspecialchars($_POST['category_name']);
            $categoryDesc = htmlspecialchars($_POST['category_desc']);

            $category = new ProductCategory(null, $categoryName, $categoryDesc);
            $category->insertCategory($db);
            include('../view/product_category_detail.php');
            break;        
    case 'Update':
        $categoryId = (int)htmlspecialchars($_POST['category_id']);
        $categoryName = htmlspecialchars($_POST['category_name']);
        $categoryDesc = htmlspecialchars($_POST['category_desc']);

        $category = new ProductCategory($categoryId, $categoryName, $categoryDesc);
        $category->updateCategory($db);
        include('../view/product_category_detail.php');
        break;

    case 'Deactivate':
            $categoryId = (int)htmlspecialchars($_POST['category_id']);
    
            $category = new ProductCategory($categoryId);
            $category->deactivateCategory($db);
            include('../view/product_category_detail.php');
            break;

    default:
        include('../view/product_category_detail.php');
}

