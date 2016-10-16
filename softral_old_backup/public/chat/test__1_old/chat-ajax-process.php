<?php

include("config.php");



if (isset($_SESSION['id']) && isset($_POST['name'])) {

    $chattype = htmlspecialchars($_POST['chattype']);
    $sendto = htmlspecialchars($_POST['sendto']);
    $groupid = htmlspecialchars($_POST['groupid']);
    $msg = htmlspecialchars($_POST['name']);

   

    if ($chattype == 'individual') {
        // Individual Chatting
        if ($msg != "") {
            $sql = $dbh->prepare("INSERT INTO chat_messages (sender_id,reciever_id,msg,msg_type, posted) VALUES (?,?,?,'file',NOW())");
            echo $sql->execute(array($_SESSION['id'], $sendto, $msg));
        }
    } else {
        // Group Chatting
        if ($msg != "") {
            $sql = $dbh->prepare("INSERT INTO chat_group_messages (grp_id,sender_id,msg,msg_type,posted) VALUES (?,?,?,'file',NOW())");
            echo $sql->execute(array($groupid, $_SESSION['id'], $msg));
        }
    }
}

?>