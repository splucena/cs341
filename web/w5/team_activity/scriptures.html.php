<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Scripture Resources</h1>
    <table>
        <tbody>
            <?php
                include "db_connection.php";
                include "scriptures.class.php";

                $s = new Scriptures();
                $query = "SELECT * FROM scriptures ORDER BY id ASC";
                $r = $s->query($db, $query);

                $html = "";
                while ($row = $r->fetch(PDO::FETCH_ASSOC)) {
                    $html .= "
                        <tr>
                            <td>$row[book] $row[chapter]:$row[verse]</td>
                            <td>$row[content]</td>
                        </tr>        
                        ";
                }

                echo $html;
            ?>
        </tbody>
    </table>
</body>
</html>