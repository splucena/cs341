<?php
    require_once '../library/db_connection.php';
    require_once '../model/Users.php';

    $db = dbConnect();
    $user = new Users();
    

    if ($display == 'display') {
        $users = $user->getUsers($db);
    } else {
        $users = $user->searchUser($db, $searchTerm);
    }

    // Search user
    $searchUser = "<form action='../controller/user.action.php' method='GET'>
                <div>
                    <table>
                        <tr>
                            <td><input type='text' name='input-search' /></td>
                            <td><input type='submit' name='action' value='Search' /></td>
                        </tr>
                    </table>
                </div></form>";
    echo $searchUser;

    // Display users
    $counter = 1;
    $userTable = "<table>
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
        $userTable .= "<tr>
                    <td>$counter</td>
                    <td>$u[first_name]</td>
                    <td>$u[last_name]</td>
                    <td><a href=''>$u[username]</a></td>
                    <td>$u[position]</td>
                    <td>$u[phone]</td>
                    </tr>";
        $counter += 1;
    }
    $userTable .= "</tbody></table>";
    echo $userTable;