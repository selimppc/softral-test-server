<?php

include("config.php");

if (isset($_SESSION['id']) && isset($_POST['question'])) {


    //$client_id = htmlspecialchars($_POST['client_id']);
    $sub_id = htmlspecialchars($_POST['sub_id']);
    $dep_id = htmlspecialchars($_POST['dep_id']);
    $question = htmlspecialchars($_POST['question']);

    
    /**
    * New Question
    */
    $sql = $dbh->prepare("INSERT INTO tech_question (client_id, subj_id, dept_id, question, posted_time) VALUES (?, ?, ?, ?,  NOW())");
    $sql->execute(array($_SESSION['id'], $sub_id, $dep_id, $question));
    //print_r($dbh->errorInfo());
    
    $last_record = $dbh->lastInsertId();
    
    echo $last_record;
    
    
    
    
//    
    //echo "\nPDOStatement::errorInfo():\n";
    //$arr = $sql->errorInfo();
    //print_r($arr);
}
?>