<?php
include("config.php");



$question_id = $_GET['question_id'];




$supporter_id = 0;
$sql = $dbh->prepare("SELECT supporter_id FROM tech_question where id = $question_id and job_status = 'Active'");
$sql->execute();
if($sql->rowCount() >0){
    while ($r = $sql->fetch()) {
        $supporter_id = $r['supporter_id'];
    }
   
}     
echo $supporter_id;
  

?>