<?php
    require_once '../library/db_connection.php';
    require_once '../model/Users.php';

    $db = dbConnect();
    $user = new Users();
    $users = $user->getUsers($db);
    
    $counter = 1;
    $html = "<table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Position</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>";
    foreach ($users as $u) {
        $html .= "<tr>
                    <td>$counter</td>
                    <td>$u[first_name]</td>
                    <td>$u[last_name]</td>
                    <td>$u[username]</td>
                    <td>$u[position]</td>
                    <td>$u[phone]</td>
                 </tr>";
        $counter += 1;
    }
    $html .= "</tbody></table>";
    echo $html;