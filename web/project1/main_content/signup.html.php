<?php
    require_once '../library/db_connection.php';
    require_once '../model/Users.php';

    $formUser = "<div>
        <h2>" . ( isset($message) ? $message : '') . "</h2>
        <form method='POST' action='../controller/signup.action.php'>
            <ul>
                <li>
                    <label for='fn'>First Name</label>
                    <input type='text' name='fn' required />
                </li>
                <li>
                    <label for='ln'>Last Name</label>
                    <input type='text' name='ln' required />
                </li>
                <li>
                    <label for='username'>Username</label>
                    <input type='text' name='username' required />
                </li>
                <li>
                    <label for='passwd'>Password</label><br>
                    <span><small>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</small></span>
                    <input type='password' name='passwd' required pattern='(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$'/>
                </li>
                <li>
                    <label for='confirm_passwd'>Confirm Password</label><br>
                    <span><small>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</small></span>
                    <input type='password' name='confirm_passwd' required pattern='(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$'/>
                </li>
                <li>
                    <div class='row'>
                        <div class='col-50'>
                            <input type='submit' name='action' value='Sign up'>
                        </div>
                        <div class='col-50'>
                            <input type='submit' name='action' value='Cancel'>
                        </div>
                    </div>
                </li>
            </ul>
        </form>
    </div>";
    echo $formUser;