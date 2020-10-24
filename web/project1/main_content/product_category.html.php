<?php
    require_once '../library/db_connection.php';
    require_once '../model/ProductCategory.php';

    $db = dbConnect();
    $category = new ProductCategory();
    
    if ($display == 'display') {
        $categories = $category->getProductCategories($db);
    } elseif ($display == 'populate-form') {
        $categories = $category->getProductCategories($db);
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
    $html .= "</tbody></table></div>";
    echo $html;

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