<?php
include("config.php");


?>

<?php
//$question_id = $_GET['question_id'];


//$sql = $dbh->prepare("SELECT supporter_id FROM tech_question where id= $question_id");
$sql = $dbh->prepare("SELECT id, client_id, question, posted_time FROM tech_question where supporter_id = {$_SESSION['id']} and job_status='New' order by id desc");


$sql->execute();
$rows = array();
while ($r = $sql->fetch(PDO::FETCH_ASSOC)) {
    $rows[] = $r;
}
echo json_encode($rows);
//echo $supporter_id;
?>