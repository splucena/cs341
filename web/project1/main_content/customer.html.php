<?php
    require_once '../library/db_connection.php';
    require_once '../model/Customer.php';

    $db = dbConnect();
    $customer = new Customer();
    $customers = $customer->getCustomers($db);
    
    $counter = 1;
    $html = "<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Billing Address</th>
                        <th>Country</th>
                        <th>Description</th>
                        <th>Phone</th>
                        <th>Shipping Address</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($customers as $c) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td>$c[first_name]</td>
                    <td>$c[last_name]</td>
                    <td>$c[billing_addr]</td>
                    <td>$c[country]</td>
                    <td>$c[customer_desc]</td>
                    <td>$c[phone]</td>
                    <td>$c[shipping_addr]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    echo $html;