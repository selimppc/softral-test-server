<?php
include("config.php");





?>

<?php
$question_id = $_GET['question_id'];
$sendto = $_GET['client_id'];


$sql = $dbh->prepare("update tech_question set job_start_time = Now(), job_status = 'Active'  where id=?");
$sql->execute(array($question_id));
$total = $sql->rowCount();
                



$sql = $dbh->prepare("INSERT INTO tech_messages (tech_q_id, sender_id,reciever_id,msg,posted) VALUES (?, ?, ?, ?, NOW())");
$sql->execute(array($question_id, $_SESSION['id'], $sendto, "Welcome, This is {$_SESSION['first_name']} {$_SESSION['last_name']}"));


echo $total;

//$supporter_id = 0;
//$sql = $dbh->prepare("SELECT supporter_id FROM tech_question where id = $question_id and job_status = 'Active'");
//$sql->execute();
//if($sql->rowCount() >0){
//    while ($r = $sql->fetch()) {
//        $supporter_id = $r['supporter_id'];
//    }
//   
//}
//echo $supporter_id;

?>