<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include "../db/connection.php";

                $statement = $db->query('SELECT u.username, n.content FROM note n LEFT JOIN note_user u ON u.id=n.userId');
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>$row[username]</td>
                            <td>$row[content]</td>
                        </tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>