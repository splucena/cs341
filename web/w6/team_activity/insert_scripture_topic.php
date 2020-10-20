<?php

    require_once "../../../db/connection.php";
    $db = connectDb();

    $book = htmlspecialchars($_POST['book']);
    $chapter = htmlspecialchars($_POST['chapter']);
    $verse = htmlspecialchars($_POST['verse']);
    $content = htmlspecialchars($_POST['content']);

    
    //$sacrifice_2 = $_POST['sacrifice_2'];
    //$charity_3 = $_POST['charity_3'];

    $topics = array();

    $queryTopic = "SELECT id, name FROM topic"; 
    $stmtTopic = $db->prepare($queryTopic);
    $stmtTopic->execute();
    $resultTopics = $stmtTopic->fetchAll(PDO::FETCH_ASSOC);

    if ($stmtTopic->rowCount() > 0) {
        foreach($resultTopics as $topic) {
            $topicNameId = preg_replace('/\s+/', '', strtolower($topic['name'])) . "_" . $topic['id'];
            if (isset($_POST[$topicNameId])) {
                array_push($topics, htmlspecialchars($_POST[$topicNameId]));
            }            
        }
    } else {
        echo "Topic is empty!";
        die();
    }
    /*if (isset($_POST['faith_1'])) {
        $faith_1 = htmlspecialchars($_POST['faith_1']);
        array_push($topics, $faith_1);    
    }

    if (isset($_POST['sacrifice_2'])) {
        $sacrifice_1 = htmlspecialchars($_POST['sacrifice_2']);
        array_push($topics, $sacrifice_1);    
    }

    if (isset($_POST['charity_3'])) {
        $charity_1 = htmlspecialchars($_POST['charity_3']);
        array_push($topics, $charity_1);    
    }*/

    function createScriptureTopic($db, $scriptureId, $topicId) {
        $insertScriptureTopic = "INSERT INTO scriptures_topic (scripture_id, topic_id)
            VALUES(:scripture_id, :topic_id)";
        $insertScriptureTopic = $db->prepare($insertScriptureTopic);
        $insertScriptureTopic->bindParam(':scripture_id', $scriptureId, PDO::PARAM_INT);
        $insertScriptureTopic->bindParam(':topic_id', $topicId, PDO::PARAM_INT);
        $insertScriptureTopic->execute();
    }

    // Create scripture
    $insertScripture = "INSERT INTO scriptures (book, chapter, verse, content)
        VALUES(:book, :chapter, :verse, :content)";
    $stmtScripture = $db->prepare($insertScripture);
    $stmtScripture->bindParam(':book', $book, PDO::PARAM_STR);
    $stmtScripture->bindParam(':chapter', $chapter, PDO::PARAM_STR);
    $stmtScripture->bindParam(':verse', $verse, PDO::PARAM_STR);
    $stmtScripture->bindParam(':content', $content, PDO::PARAM_STR);
    $stmtScripture->execute();
    $scriptureId = $db->lastInsertId('scriptures_id_seq');

    // Link newly created scripture to topic
    if (count($topics) > 0) {
        foreach($topics as $topicId) {
            createScriptureTopic($db, $scriptureId, $topicId);
        }
    } else {
        echo "No topic selected!";
    }

    if (isset($_POST['add_topic'])) {
        $topicName = htmlspecialchars($_POST['topic_name']);
        // Create topic
        $topicName = htmlspecialchars($_POST['topic_name']);
        $insertTopic = "INSERT INTO topic (name) VALUES(:name)";
        $stmtTopic = $db->prepare($insertTopic);
        $stmtTopic->bindParam(':name', $topicName, PDO::PARAM_STR);
        $stmtTopic->execute();
        $topicId = $db->lastInsertId('topic_id_seq');
        createScriptureTopic($db, $scriptureId, $topicId);   
    }
    
    header("Location: insert_scripture.php");
    die();
?>