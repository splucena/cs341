<?php
    require_once '../library/db_connection.php';
    require_once '../model/Orders.php';

    $db = dbConnect();
    $order = new Orders();

    if ($display == 'display') {
        $orders = $order->getOrders($db);
    } elseif ($display == 'populate-form') {
        $orders = $order->getOrders($db);
        $ordersById = $order->getOrderById($db, $orderId);
    } else {
        $orders = $order->searchOrder($db, $searchTerm);
    }

    // Search user
    $html = "<div><form action='../controller/order.action.php' method='GET'>
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
                    <td><a href='../controller/order.action.php?action=PopulateForm&id=$o[order_id]'>$o[order_number]</a></td>
                    <td>$o[order_status]</td>
                    <td>$o[total_amount]</td>
                    <td>$o[shipping_date]</td>
                    <td>$o[c_first_name]</td>
                    <td>$o[u_first_name]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table></div>";
    echo $html;

    $formOrder = "<div>
        <h1>Order Detail</h1>
        <form method='POST' action='../controller/order.action.php'>
            <ul>
                <li>
                    <label for='order_number'>Number</label>
                    <input type='text' name='order_number' value='". ( isset($ordersById) ? $ordersById['order_number'] : '') . "' />
                </li>
                <li>
                    <label for='order_desc'>Description</label>
                    <input type='text' name='order_desc' value='". ( isset($ordersById) ? $ordersById['order_desc'] : '') . "' />
                </li>
                <li>
                    <label for='order_status'>Status</label>
                    <input type='text' name='order_status' value='". ( isset($ordersById) ? $ordersById['order_status'] : '') . "' />
                </li>
                <li>
                    <label for='total_amount'>Total Amount</label>
                    <input type='text' name='total_amount' value='". ( isset($ordersById) ? $ordersById['total_amount'] : '') . "' />
                </li>
                <li>
                    <label for='shipping_date'>Shipping Date</label>
                    <input type='text' name='shipping_date' value='". ( isset($ordersById) ? $ordersById['shipping_date'] : '') . "' />
                </li>
                <li>
                    <label for='customer_name'>Customer Name</label>
                    <input type='text' name='customer_name' value='". ( isset($ordersById) ? $ordersById['customer_name'] : '') . "'/>
                </li>
                <li>
                    <label for='user_name'>Processed By</label>
                    <input type='text' name='user_name' value='". ( isset($ordersById) ? $ordersById['user_name'] : '') . "'/>
                </li>
                <li>
                    <div class='row'>
                        <div class='col-50'>
                            <input type='submit' name='action' value='Create'>
                        </div>
                        <div class='col-50'>
                            <input type='submit' name='action' value='Update'>
                        </div>
                    </div>
                </li>
            </ul>
        </form>
    </div>";
    echo $formOrder;