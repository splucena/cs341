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
        $orderLines = $order->getOrderLines($db, $orderId);
        $orderStatus = $ordersById['order_status'];
    } else {
        $orders = $order->searchOrder($db, $searchTerm);
    }

    // Generate status selection
    $statuses = array('draft', 'processing', 'in_transit', 'delivered');
    $statusList = "<select name='order_status' id='order_status_list'>
        <option>Choose Status</option>";
    foreach($statuses as $p) {
        
        if (isset($orderStatus) && $orderStatus === $p) {
            $statusList .= "<option value='$p' selected>$p</option>";
        } else {
            $statusList .= "<option value='$p'>$p</option>";
        }
    }
    $statusList .= "</select>";

    if (isset($orderLines) && count($orderLines) > 0) {
        $totalOrderAmount = 0;
        $orderLineList = "<table><tr>
                <th>Product</th>
                <th class='right'>Unit Price</th>
                <th class='right'>Quantity</th>
                <th class='right'>Subtotal</th>
            </tr>";
        foreach($orderLines as $o) {
            $orderLineList .= "<tr>
                    <td>$o[product_name]</td>
                    <td class='right'>" . number_format((float)$o['unit_price'], 2, '.', '') . "</td>
                    <td class='right'>$o[quantity]</td>
                    <td class='right'>" . number_format((float)$o['subtotal'], 2, '.', '') . "</td>
                </tr>";
                $totalOrderAmount += (float)$o['subtotal'];
        }
        $orderLineList .= "<tr><td>Total</td><td colspan='3' class='right'>" . number_format((float)$totalOrderAmount, 2, '.', '') ."</td></tr></table>";
    } else {
        $orderLineList = "<p>Empty!</p>";
    }

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
                    <input type='datetime-local' name='shipping_date' value='". ( isset($ordersById) ? $ordersById['shipping_date'] : '') . "' />
                </li>
                <li>
                    <h1>Order Line</h1>
                    $orderLineList
                </li>
                <li>
                    <div class='row'>
                        <input type='hidden' name='order_id' value='" . ( isset($ordersById) ? $ordersById['order_id'] : '') . "'>
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