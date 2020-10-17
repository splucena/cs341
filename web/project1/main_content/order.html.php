<?php
    require_once '../library/db_connection.php';
    require_once '../model/Orders.php';

    $db = dbConnect();
    $order = new Orders();
    $orders = $order->getOrders($db);
    
    $counter = 1;
    $html = "<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Number</th>
                        <th>Status</th>
                        <th>Total Amount</th>
                        <th>Shipping Date</th>
                        <th>Customer Name</th>
                        <th>Processor Name</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($orders as $o) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td>$o[order_number]</td>
                    <td>$o[order_status]</td>
                    <td>$o[total_amount]</td>
                    <td>$o[shipping_date]</td>
                    <td>$o[c_first_name]</td>
                    <td>$o[u_first_name]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    echo $html;