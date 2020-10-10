<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="scriptures.action.php" method="GET">
        <label for="book"></label>
        <input type="text" name="book" id="book">
        <input type="submit" value="Search" name="search">
    </form>
    <br>
    <table>
    <?php
        if (isset($result) != null) {
            $html = null;
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $html .= "
                    <tr>
                        <td><a href='scriptures.action.php?name=detail&id=$row[id]' target='_blank'>$row[book] $row[chapter]:$row[verse]</a></td>
                    </tr>        
                    ";
            }
            
            if ($html != null) {
                echo $html;
            } else {
                echo "No results found!";
            }
        }
    ?>
    </table>
</body>
</html>