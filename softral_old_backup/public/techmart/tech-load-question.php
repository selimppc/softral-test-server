<?php
include("config.php");


$question_id = $_GET['question_id'];



$sql = $dbh->prepare("SELECT id, question  FROM tech_question where id= $question_id");


$sql->execute();
$rows = array();
while ($r = $sql->fetch(PDO::FETCH_ASSOC)) {
    $rows[] = $r;
}
echo json_encode($rows);

?>