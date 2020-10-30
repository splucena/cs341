<?php
    
    /*if ($display == 'display') {
        $users = $user->getUsers($db);
    } elseif ($display == 'populate-form') {
        $users = $user->getUsers($db);
        $usersById = $user->getUserById($db, $userId);
    } else {
        $users = $user->searchUser($db, $searchTerm);
    }*/

    $formLogin = "<div>
        
        <h2>" . ( isset($message) ? $message : '' ) . "</h2>
        <form method='POST' action='../controller/signin.action.php'>
            <ul>
                <li>
                    <label for='username'>Username</label>
                    <input type='text' name='username' value='' />
                </li>
                <li>
                    <label for='passwd'>Password</label>
                    <input type='password' name='passwd' value='' />
                </li>
                <li>
                    <div class='row'>
                        <div class='col-50'>
                            <input type='submit' name='action' value='Sign in'>
                        </div>
                        <div class='col-50'>
                            <input type='submit' name='action' value='Cancel'>
                        </div>
                    </div>
                </li>
            </ul>
        </form>
    </div>";
    echo $formLogin;