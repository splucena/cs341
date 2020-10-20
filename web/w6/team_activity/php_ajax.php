<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../../static/js/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function() {
            var sCount = 2;
            $("button").click(function() {
                sCount = sCount + 2;
                $("#scriptures").load("load_scriptures.php", {
                    sNewCount: sCount
                });
            })
        });
    </script>
</head>
<body>
    <h1>Scriptures</h1>
    <div id="scriptures">
        <?php
            require_once "../../../db/connection.php";

            $db = connectDb();

            $sql = "SELECT * FROM scriptures LIMIT 2";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

            if ($stmt->rowCount() > 0) {
                $html = "<table>
                    <thead>
                        <tr>
                            <th>Scripture</th>
                            <th>Content</th>
                        </tr>
                    </thead>
                    <tbody>";
                    foreach($result as $r) {
                        $html .="
                            <tr>
                                <td>$r[book] $r[chapter]:$r[verse]</td>
                                <td>$r[content]</td>
                            </tr>
                        ";
                    }
                    $html .= "</tbody></table>";
                    echo $html;
            } else {
                echo "Empty!";
                die();
            }
        ?>
    </div>
    <button>Show More...</button>
</body>
</html>