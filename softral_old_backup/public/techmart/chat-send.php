<?php

include("config.php");
//if (!isset($_SESSION['user']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//    die("<script>window.location.reload()</script>");
//}
if (isset($_SESSION['id']) && isset($_POST['msg'])) {



    $question_id = htmlspecialchars($_POST['Question']);
    $sendto = htmlspecialchars($_POST['sendto']);
    //$groupid = htmlspecialchars($_POST['groupid']);
    $msg = htmlspecialchars($_POST['msg']);
    $edit = htmlspecialchars($_POST['edit']);


    // Individual Chatting
        if ($msg != "") {

            
            if ($edit == 0) {
                /**
                 * New Message
                 */
                $sql = $dbh->prepare("INSERT INTO tech_messages (tech_q_id, sender_id,reciever_id,msg,posted) VALUES (?, ?, ?, ?, NOW())");
                $sql->execute(array($question_id, $_SESSION['id'], $sendto, $msg));
                
                //$sql = $dbh->prepare("INSERT INTO chat_messages (sender_id,reciever_id,msg,posted) VALUES (?,?,?,NOW())");
                //$sql->execute(array($_SESSION['id'], $sendto, $msg));
            }else{
                /**
                 * Edit Message
                 */
                $sql = $dbh->prepare("update chat_messages set msg = ? where id=?");
                $sql->execute(array($msg, $edit));
            }
            
            
        }
}
?>