<?php
include("config.php");



$question_id = $_GET['question_id'];




$supporter_id = 0;
$sql = $dbh->prepare("SELECT count(id) as row FROM tech_question where id = $question_id and job_status = 'Finished'");
$sql->execute();
if($sql->rowCount() >0){
    while ($r = $sql->fetch()) {
        $supporter_id = $r['row'];
    }
   
}     
echo $supporter_id;
  

?>