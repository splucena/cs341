<?php
    require_once '../library/db_connection.php';
    require_once '../model/Invoice.php';

    $db = dbConnect();
    $invoice = new Invoice();
    $invoices = $invoice->getInvoices($db);
    
    $counter = 1;
    $html = "<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order Number</th>
                        <th>Date</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($invoices as $i) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td>$u[order_number]</td>
                    <td>$u[invoice_date]</td>
                    <td>$u[invoice_total]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    echo $html;