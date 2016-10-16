<?php
include("config.php");





$question_id = $_GET['question_id'];



//Check Que who is Active now
    $sql = $dbh->prepare("SELECT supporter_id FROM tech_que where status = 'Active' limit 1 ");
    $sql->execute();
    $supporter_id = 0;
    while ($r = $sql->fetch(PDO::FETCH_ASSOC)) {
        $supporter_id = $r['supporter_id'];
    }
    

    
    $sql = $dbh->prepare("update tech_question set supporter_id = $supporter_id where id=$question_id");
    //$sql->execute(array($supporter_id, $question_id));
    $sql->execute();
    echo $sql->rowCount();
    
    
    /*

$supporter_id = 0;
$sql = $dbh->prepare("SELECT supporter_id FROM tech_question where id = $question_id and job_status = 'Active'");
$sql->execute();
if($sql->rowCount() >0){
    while ($r = $sql->fetch()) {
        $supporter_id = $r['supporter_id'];
    }
   
}
echo $supporter_id;
     *
     */

?>