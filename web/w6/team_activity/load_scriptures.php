<?php
    require_once "../../../db/connection.php";
    $db = connectDb();

    $sCount = $_POST['sNewCount'];

    $sql = "SELECT * FROM scriptures LIMIT $sCount";
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