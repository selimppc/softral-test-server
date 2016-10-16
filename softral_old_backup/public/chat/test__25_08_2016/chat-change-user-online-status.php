<?php

include("config.php");



$status = $_POST['status'];

//$timezone = new DateTimeZone('Asia/Kolkata');
//$timezone = new DateTimeZone('America/Chicago');


$now = new DateTime();
$now->setTimezone($timezone);
$last_seen = $now->format('Y-m-d H:i:s') . "\n";



//$sql = $dbh->prepare("UPDATE tbl_users SET online_status = '$status', last_seen = '$last_seen' WHERE id={$_SESSION['id']}");
$sql = $dbh->prepare("UPDATE users SET online_status = '$status', last_seen = '$last_seen' WHERE id={$_SESSION['id']}");
echo $sql->execute();



//$sql = $dbh->prepare("UPDATE tbl_users SET online_status = 'away' WHERE id={$_SESSION['id']}");
//echo $sql->execute();


?>
