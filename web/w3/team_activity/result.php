<?php
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $major = htmlspecialchars($_POST['major']);
    $places = $_POST["places"];
    $comments = htmlspecialchars($_POST["comments"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <p>Welcome <?=$name?><p>
        <p>Email: <a href="mailto:<?=$email?>"><?=$email?></a><p>
        <p>Major: <?=$major ?><p>
        Continents: <ul><?php 
                foreach($places as $place) {
                    $place_clean = htmlspecialchars($place);
                    echo "<li>$place_clean</li>";
                }
            ?></ul>
        Comments: <?=$comments?>
    </div>
</body>
</html>