<?php
    require_once '../library/db_connection.php';
    require_once '../model/Users.php';

    $db = dbConnect();
    $user = new Users();
    
    if ($display == 'display') {
        $users = $user->getUsers($db);
    } elseif ($display == 'populate-form') {
        $users = $user->getUsers($db);
        $usersById = $user->getUserById($db, $userId);
    } else {
        $users = $user->searchUser($db, $searchTerm);
    }

    // Search user
    $searchUser = "<div><form action='../controller/user.action.php' method='GET'>
                <div>
                    <table>
                        <tr>
                            <td><input type='text' name='input-search' /></td>
                            <td><input type='submit' name='action' value='Search' /></td>
                        </tr>
                    </table>
                </div></form>";
    //echo $searchUser;

    // Display users
    $counter = 1;
    $searchUser .= "<table>
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
        $searchUser .= "<tr>
                    <td>$counter</td>
                    <td>$u[first_name]</td>
                    <td>$u[last_name]</td>
                    <td><a href='../controller/user.action.php?action=PopulateForm&id=$u[user_id]'>$u[username]</a></td>
                    <td>$u[position]</td>
                    <td>$u[phone]</td>
                    </tr>";
        $counter += 1;
    }
    $searchUser .= "</tbody></table></div>";
    echo $searchUser;

    $formUser = "<div>
        <h1>User Detail</h1>
        <form method='POST' action='../controller/user.action.php'>
            <ul>
                <li>
                    <label for='fn'>First Name</label>
                    <input type='text' name='fn' value='". ( isset($usersById) ? $usersById['first_name'] : '') . "' />
                </li>
                <li>
                    <label for='ln'>Last Name</label>
                    <input type='text' name='ln' value='". ( isset($usersById) ? $usersById['last_name'] : '') . "' />
                </li>
                <li>
                    <label for='username'>Username</label>
                    <input type='text' name='username' value='". ( isset($usersById) ? $usersById['username'] : '') . "' />
                </li>
                <li>
                    <label for='passwd'>Password</label>
                    <input type='password' name='passwd' value='". ( isset($usersById) ? $usersById['passwd'] : '') . "' />
                </li>
                <li>
                    <label for='position'>Position</label>
                    <input type='text' name='position' value='". ( isset($usersById) ? $usersById['position'] : '') . "' />
                </li>
                <li>
                    <label for='phone'>Phone</label>
                    <input type='text' name='phone' value='". ( isset($usersById) ? $usersById['phone'] : '') . "'/>
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
    echo $formUser;