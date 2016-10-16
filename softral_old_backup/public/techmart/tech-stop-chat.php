<?php
include("config.php");





$question_id = $_GET['question_id'];
$user_type= $_GET['user_type'];

//$sendto = $_GET['client_id'];


//$sql = $dbh->prepare("update tech_question set job_start_time = Now(), job_status = 'Active'  where id=?");
$sql = $dbh->prepare("update tech_question set job_finish_time = Now(), job_status = 'Finished'  where id=?");
$sql->execute(array($question_id));
$total = $sql->rowCount();
echo $total;      


if($total>0){
    if($user_type =='free'){
        header("location:tech-free-review.php?question_id=$question_id");
        exit();
        
    }else{
        
        header("location:tech-client-review.php?question_id=$question_id");
        exit();
    }
}

?>