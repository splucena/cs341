<?php

    //$homePath = "/CS341/web/index.php";
    $homePath = "../../index.php";
    $homeURL = $homePath;

    //$helloWorldPath = "/CS341/web/hello.html";
    $helloWorldPath = "../../hello.html";
    $helloWorldURL = $helloWorldPath;

    //$shoppingCartPath = "/CS341/web/w3/prove3/index.php";
    $shoppingCartPath = "/w3/prove3/index.php";
    $shoppingCartURL = $shoppingCartPath;

    //<a href='#'>Assignment 2</a>
    //<a href='#'>Link 3</a>
    
    $html = "<div class='topnav' id='myTopnav'>
                <a href='$homeURL' class='active'>Home</a>
                <div class='dropdown'>
                <button class='dropbtn'>Projects 
                    <i class='fa fa-caret-down'></i>
                </button>
                <div class='dropdown-content'>
                    <a href='$helloWorldURL'>Hello world!</a>
                    <a href='$shoppingCartURL'>Shopping Cart</a>
                </div>
                </div> 
                <a href='#about'>About</a>
                <a href='javascript:void(0);' style='font-size:15px;' class='icon' onclick='toggleMenu()'>&#9776;</a>
            </div>";

    echo $html;
?>