<?php

include("chat-config.php");

$friend_request_user_id = $_POST['friend_request_user_id']; // Change the friend_request_user_id name to user_id
$action = $_POST['action'];


//Check whether Friend Request already Sent or not...
if ($action == 'new') {
    //If New Request
    $sql = $dbh->prepare("INSERT INTO chat_friendlist (user_id,friend_id,request_time) VALUES (?,?,NOW())");
}
else if($action == 'cancel'){
    //Cancel_request By sender Itself
    $sql = $dbh->prepare("update chat_friendlist set status = 'cancel_request', cancel_requested_time=NOW() where user_id=? and friend_id=?");
}
else if($action == 'accept'){
    // Friend Request Accpeted by Reciever
    $sql = $dbh->prepare("update chat_friendlist set status = 'accepted', accpeted_time=NOW() where friend_id=? and user_id=?");
}
else if($action == 'reject'){
    // Friend Request Rejected by Reciever
    $sql = $dbh->prepare("update chat_friendlist set status = 'rejected', rejected_time=NOW() where friend_id=? and user_id=? ");
}

echo $sql->execute(array($_SESSION['id'], $friend_request_user_id));
