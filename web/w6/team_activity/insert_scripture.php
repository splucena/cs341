<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    main {
        display: grid;
        grid-template-columns: 70% 28%;
        column-gap: 20px;
        padding: 20px;
    }

    table {
        border-collapse: collapse;
    }

    table th,
    table td {
        text-align: left;
        border-bottom: 1px solid gray;
        padding: 5px;
    }

    ul li {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .scripture-form-entry form ul {
        margin: 0;
        padding: 0;
    }

    .scripture-form-entry form ul li {
        display: grid;
        grid-template-columns: 1fr;
        padding: 5px;
    }

    .scripture-form-entry form ul li label {
        padding-bottom: 5px;
    }

    input[type=text],
    input[type=submit],
    textarea {
        padding: 8px;
    }

    

    </style>
</head>

<body>
    <main>

        <div class="scripture_list">
            <?php

        require_once "../../../db/connection.php";
        $db = connectDb();
  

        $queryScriptureTopic = "SELECT 
                CONCAT(s.book, ' ', s.chapter, ':', s.verse) as book, 
                s.content as content, 
                t.name as topic_name,
                s.id as scripture_id
            FROM scriptures_topic st 
            LEFT JOIN scriptures s ON s.id=st.scripture_id 
            LEFT JOIN topic t ON st.topic_id=t.id";

        $stmtScriptureTopic = $db->prepare($queryScriptureTopic);
        $stmtScriptureTopic->execute();
        $resultScriptureTopic = $stmtScriptureTopic->fetchAll(PDO::FETCH_ASSOC);

        $count = $stmtScriptureTopic->rowCount();

        $htmlScriptureTopic = "<table>
            <thead>
                <tr>
                    <th>Scripture</th>
                    <th>Content</th>
                    <th>Topic</th>
                </tr>
            </thead>
            <tbody>";
        if ($stmtScriptureTopic->rowCount() > 0) {
            foreach($resultScriptureTopic as $rST) {
                $htmlScriptureTopic .= "<tr><td>$rST[book]</td>
                    <td>$rST[content]</td>
                    <td>$rST[topic_name]</td></tr>";
            }
            $htmlScriptureTopic .= "</tbody></table>";

            echo "<h1>Scriptures</h1>";
            echo $htmlScriptureTopic;

        } else {
            echo "Table is empty!";
        }

       
    ?>
        </div>
        <div class="scripture-form-entry">
            <h1>Add Entry</h1>
            <form action="insert_scripture_topic.php" method="post">
                <ul>
                    <li>
                        <label for="book">Book</label>
                        <input type="text" name="book">
                    </li>
                    <li>
                        <label for="chapter">Chapter</label>
                        <input type="text" name="chapter">
                    </li>
                    <li>
                        <label for="verse">Verse</label>
                        <input type="text" name="verse">
                    </li>
                    <li>
                        <label for="content">Content</label>
                        <textarea name="content" rows="10"></textarea>
                    </li>
                    <li><label>Topics</label></li>
                        <?php
                         $queryTopic = "SELECT id, name FROM topic"; 
                         $stmt = $db->prepare($queryTopic);
                         $stmt->execute();
                         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
                            if (isset($result)) {
                                $checkbox = null;
                                foreach($result as $r) {
                                    $checkbox .= "
                                        <li><div>
                                            <input type='checkbox' name='" . preg_replace('/\s+/', '', strtolower($r['name'])) . "_" . $r['id'] . "' value='$r[id]'>
                                            <label for='" . preg_replace('/\s+/', '', strtolower($r['name'])) . "_" . $r['id'] . "'>$r[name]</label></div>
                                        </li>";
                                }
                                $checkbox .= "
                                    <li><div>
                                        <input type='checkbox' name='add_topic' value='add_topic'>
                                        <input type='text' name='topic_name' >
                                        </div>
                                    </li>";
                                echo $checkbox;
                            } else {
                                echo "Error!";
                                die();
                            }
                        ?>
                    <li>
                        <input type="submit" value="Create">
                    </li>
                </ul>
            </form>
        </div>
    </main>
</body>
</html>