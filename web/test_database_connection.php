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
                <td>Category ID</td>
                <td>Name</td>
                <td>Description</td>
                <td>Active</td>
            </tr>
        </thead>
        <tbody>
            <?php

                include "../db/connection.php";
                $query = "SELECT * FROM product_category";
                $result = $pdo->query($query);
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['category_id'] . "</td>";
                    echo "<td>" . $row['category_name'] . "</td>";
                    echo "<td>" . $row['category_desc'] . "</td>";
                    echo "<td>" . $row['active'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>