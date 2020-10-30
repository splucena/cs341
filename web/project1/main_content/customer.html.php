<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['loggedin'])) {
    require_once '../library/db_connection.php';
    require_once '../model/Customer.php';

    $db = dbConnect();
    $customer = new Customer();

    $limit = 10;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $startFrom = ($page - 1) * $limit;
    
    if ($display == 'display') {
        $customers = $customer->getCustomers($db, $startFrom, $limit);
    } elseif ($display == 'populate-form') {
        $customers = $customer->getCustomers($db, $startFrom, $limit);
        $customersById = $customer->getCustomerById($db, $userId);
    } else {
        $customers = $customer->searchCustomer($db, $searchTerm);
    }

    // Search user
    $html = "<div><form action='../controller/customer.action.php' method='GET'>
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
                        <th>Phone</th>
                        <th>Shipping Address</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($customers as $c) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td><a href='../controller/customer.action.php?action=PopulateForm&id=$c[customer_id]'>$c[last_name], $c[first_name]</a></td>
                    <td>$c[phone]</td>
                    <td>$c[shipping_addr]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    //echo $html;

    $totalRecords = $customer->getCustomerCount($db)[0];

    $totalPages = ceil($totalRecords / $limit);
    if ($totalPages > 1) {
        echo $html;
        $pagLink = "<div class='pagination'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            $pagLink .= "<span><a class='a-button' href='../view/customer_detail.php?page=".$i."'>".$i."</a></span>";
        }
        echo $pagLink . "</div></div>";
    } else {
        $html .= "</div>";
        echo $html;  
    }

    $formCustomer = "<div>
        <h1>Customer Detail</h1>
        <form method='POST' action='../controller/customer.action.php'>
            <ul>
                <li>
                    <label for='fn'>First Name</label>
                    <input type='text' name='fn' value='". ( isset($customersById) ? $customersById['first_name'] : '') . "' />
                </li>
                <li>
                    <label for='ln'>Last Name</label>
                    <input type='text' name='ln' value='". ( isset($customersById) ? $customersById['last_name'] : '') . "' />
                </li>
                <li>
                    <label for='desc'>Description</label>
                    <input type='text' name='desc' value='". ( isset($customersById) ? $customersById['customer_desc'] : '') . "' />
                </li>
                <li>
                    <label for='billing-addr'>Biling Address</label>
                    <input type='text' name='billing-addr' value='". ( isset($customersById) ? $customersById['billing_addr'] : '') . "' />
                </li>
                <li>
                    <label for='shipping-addr'>Shipping Address</label>
                    <input type='text' name='shipping-addr' value='". ( isset($customersById) ? $customersById['shipping_addr'] : '') . "'/>
                </li>
                <li>
                    <label for='country'>Country</label>
                    <input type='text' name='country' value='". ( isset($customersById) ? $customersById['country'] : '') . "' />
                </li>
                <li>
                    <label for='phone'>Phone</label>
                    <input type='text' name='phone' value='". ( isset($customersById) ? $customersById['phone'] : '') . "'/>
                </li>
                <li>
                    <div class='row'>
                        <input type='hidden' name='customer_id' value='" . ( isset($customersById) ? $customersById['customer_id'] : '') . "' >
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
    echo $formCustomer;
} else {
    include __DIR__ . '/../view/index.php';
}
