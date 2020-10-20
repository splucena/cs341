<?php
    require_once "../../../db/connection.php";
    $db = connectDb();

    if (isset($_POST['scripture_id']) && isset($_POST['topic_name']) ) {
        $topicName = htmlspecialchars($_POST['topic_name']);
        // Create topic
        $topicName = htmlspecialchars($_POST['topic_name']);
        $insertTopic = "INSERT INTO topic (name) VALUES(:name)";
        $stmtTopic = $db->prepare($insertTopic);
        $stmtTopic->bindParam(':name', $topicName, PDO::PARAM_STR);
        $stmtTopic->execute();
        $topicId = $db->lastInsertId('topic_id_seq');
    
        // Create in scriptures_topic table
        $scriptureId = $_POST['scripture_id'];        
        $insertScriptureTopic = "INSERT INTO scriptures_topic (scripture_id, topic_id)
            VALUES(:scripture_id, :topic_id)";
        $insertScriptureTopic = $db->prepare($insertScriptureTopic);
        $insertScriptureTopic->bindParam(':scripture_id', $scriptureId, PDO::PARAM_INT);
        $insertScriptureTopic->bindParam(':topic_id', $topicId, PDO::PARAM_INT);
        $insertScriptureTopic->execute();

        header("Location: insert_scripture.php");
        die();
    } else {
        echo "2";
    }
?>