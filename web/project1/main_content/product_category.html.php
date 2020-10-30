<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['loggedin'])) {
    require_once '../library/db_connection.php';
    require_once '../model/ProductCategory.php';

    $db = dbConnect();
    $category = new ProductCategory();

    $limit = 10;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $startFrom = ($page - 1) * $limit;
    
    if ($display == 'display') {
        $categories = $category->getProductCategories($db, $startFrom, $limit);
    } elseif ($display == 'populate-form') {
        $categories = $category->getProductCategories($db, $startFrom, $limit);
        $categoriesById = $category->getCategoryById($db, $categoryId);
    } else {
        $categories = $category->searchCategory($db, $searchTerm);
    }

    $html = "<div><form action='../controller/category.action.php' method='GET'>
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
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($categories as $c) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td><a href='../controller/category.action.php?action=PopulateForm&id=$c[category_id]'>$c[category_name]</a></td>
                    <td>$c[category_desc]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    //echo $html;

    $totalRecords = $category->getCategoryCount($db)[0];

    $totalPages = ceil($totalRecords / $limit);

    //echo $totalPages;

    if ($totalPages > 1) {
        echo $html;
        $pagLink = "<div class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            $pagLink .= "<span><a class='a-button' href='../view/product_category_detail.php?page=".$i."'>".$i."</a></span>";
        }
        echo $pagLink . "</div></div>";
    } else {
        $html .= "</div>";
        echo $html;
    }

    $formCategory = "<div>
        <h1>". ( isset($categoriesById) ? $categoriesById['category_name'] : 'Category') . " Detail</h1>
        <form method='POST' action='../controller/category.action.php'>
            <ul>
                <li>
                    <label for='category_name'>Name</label>
                    <input type='text' name='category_name' value='". ( isset($categoriesById) ? $categoriesById['category_name'] : '') . "' />
                </li>
                <li>
                    <label for='category_desc'>Description</label>
                    <input type='text' name='category_desc' value='". ( isset($categoriesById) ? $categoriesById['category_desc'] : '') . "' />
                </li>
                <li>
                    <div class='row'>
                    <input type='hidden' name='category_id' value='". ( isset($categoriesById) ? $categoriesById['category_id'] : '') . "' />
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
    echo $formCategory;
} else {
    include __DIR__ . '/../view/index.php';
}