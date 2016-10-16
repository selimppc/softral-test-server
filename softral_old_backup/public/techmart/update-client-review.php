<?php
include("config.php");


$question_id = $_GET['question_id'];
$client_job_status = $_GET['client_job_status'];


$sql = $dbh->prepare("update tech_question set client_job_status = '$client_job_status'  where id=?");
$sql->execute(array($question_id));
$total = $sql->rowCount();
                

echo $total;

?>