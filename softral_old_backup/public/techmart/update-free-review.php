<?php
include("config.php");


$question_id = $_GET['question_id'];
$supporter_job_status = $_GET['supporter_job_status'];


$sql = $dbh->prepare("update tech_question set supporter_job_status = '$supporter_job_status'  where id=?");
$sql->execute(array($question_id));
$total = $sql->rowCount();
                

echo $total;

?>