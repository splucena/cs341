<?php
    require_once '../library/db_connection.php';
    require_once '../model/Orders.php';
    require_once '../model/Customer.php';
    require_once '../model/Users.php';
    require_once '../model/ProductProduct.php';

    $db = dbConnect();
    $order = new Orders();

    if ($display == 'display') {
        $orders = $order->getOrders($db);
    } elseif ($display == 'populate-form') {
        $orders = $order->getOrders($db);
        $ordersById = $order->getOrderById($db, $orderId);
        $customerId = $ordersById['customer_id'];
        $userId = $ordersById['user_id'];
        $orderStatus = $ordersById['order_status'];
    } else {
        $orders = $order->searchOrder($db, $searchTerm);
    }

    // Generate customer selection
    $customer = new Customer();
    $customers = $customer->getCustomers($db);
    $customerList = "<select name='customer_id' id='customer_list'><option>Choose Customer</option>";
    foreach($customers as $p) {
        
        if (isset($customerId) && $customerId === $p['customer_id']) {
            $customerList .= "<option value='$p[customer_id]' selected>$p[first_name] $p[last_name]</option>";
        } else {
            $customerList .= "<option value='$p[customer_id]'>$p[first_name] $p[last_name]</option>";
        }
    }
    $customerList .= "</select>";

    // Generate user selection
    $user = new Users();
    $users = $user->getUsers($db);
    $userList = "<select name='user_id' id='user_list'><option>Choose User</option>";
    foreach($users as $p) {        
        if (isset($userId) && $userId === $p['user_id']) {
            $userList .= "<option value='$p[user_id]' selected>$p[first_name] $p[last_name]</option>";
        } else {
            $userList .= "<option value='$p[user_id]'>$p[first_name] $p[last_name]</option>";
        }
    }
    $userList .= "</select>";

    // Generate product selection
    $product = new ProductProduct();
    $products = $product->getProductProducts($db);
    $productList = "<option>Choose Product</option>";
    foreach($products as $p) {        
        if (isset($productId) && $productId === $p['product_id']) {
            $productList .= "<option value=$p[product_id] selected>$p[product_name] - \$$p[unit_price]</option>";
        } else {
            $productList .= "<option value=$p[product_id]_$p[unit_price]>$p[product_name] - \$$p[unit_price]</option>";
        }
    }
    //$productList .= "</select></td><td><input type='text' name='product_quantity'></td></tr></table>";

    // Generate status selection
    $statuses = array('draft', 'processing', 'in_transit', 'delivered');
    $statusList = "<select name='order_status' id='order_status_list'>
        <option>Choose User</option>";
    foreach($statuses as $p) {
        
        if (isset($orderStatus) && $orderStatus === $p) {
            $statusList .= "<option value='$p' selected>$p</option>";
        } else {
            $statusList .= "<option value='$p'>$p</option>";
        }
    }
    $statusList .= "</select>";

    // Search user
    $html = "<div><form action='../controller/order_process.action.php' method='GET'>
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
                        <th>Number</th>
                        <th>Status</th>
                        <th>Total Amount</th>
                        <th>Shipping Date</th>
                        <th>Customer Name</th>
                        <th>Processed By</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($orders as $o) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td><a href='../controller/order_process.action.php?action=PopulateForm&id=$o[order_id]'>$o[order_number]</a></td>
                    <td>" . strtoupper($o['order_status']) . "</td>
                    <td>$o[total_amount]</td>
                    <td>$o[shipping_date]</td>
                    <td>$o[c_first_name]</td>
                    <td>$o[u_first_name]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table></div>";
    echo $html;

    //<input type='text' name='customer_name' value='". ( isset($ordersById) ? $ordersById['customer_name'] : '') . "'/>
    //<input type='text' name='user_name' value='". ( isset($ordersById) ? $ordersById['user_name'] : '') . "'/>
    //<input type='text' name='order_status' value='". ( isset($ordersById) ? strtoupper($ordersById['order_status']) : '') . "' />
    //'draft', 'processing', 'in_transit', 'delivered'
    $formOrder = "<div>
        <h1>Order Detail</h1>
        <form method='POST' action='../controller/order_process.action.php'>
            <ul>
                <li>
                    <label for='order_number'>Number</label>
                    <input readonly type='text' name='order_number' value='". ( isset($ordersById) ? $ordersById['order_number'] : '') . "' />
                </li>
                <li>
                    <label for='order_desc'>Description</label>
                    <input readonly type='text' name='order_desc' value='". ( isset($ordersById) ? $ordersById['order_desc'] : '') . "' />
                </li>
                <li>
                    <label for='order_status'>Status</label>
                    $statusList;
                </li>
                <li>
                    <label for='total_amount'>Total Amount</label>
                    <input readonly type='text' name='total_amount' value='". ( isset($ordersById) ? $ordersById['total_amount'] : '') . "' />
                </li>
                <li>
                    <label for='shipping_date'>Shipping Date</label>
                    <input type='date' name='shipping_date' value='". ( isset($ordersById) ? $ordersById['shipping_date'] : '') . "' />
                </li>
                <li>
                    <h1>Order Line</h1>
                    
                </li>
                <li>
                    <div class='row'>
                        <div class='col-50'>
                            <input type='submit' name='action' value='Update'>
                        </div>
                        <div class='col-50'>
                            <input type='submit' name='action' value='Clear'>
                        </div>
                    </div>
                </li>
            </ul>
        </form>
    </div>";
    echo $formOrder;