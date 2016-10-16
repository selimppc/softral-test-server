<?php

include("config.php");



$sql = $dbh->prepare("SELECT  users FROM chat_usergroup where grp_name = '" . $_GET['grp_name'] . "'");
$sql->execute();
$users = array();
while ($r = $sql->fetch()) {
    $users = unserialize($r['users']);
}


$users = array_filter($users, function($v) { return $v != $_GET['user']; });
$users = serialize($users);


$sql = $dbh->prepare("update chat_usergroup set users=? where grp_name=?");
$result = $sql->execute(array($users, $_GET['grp_name']));
echo $result;

?>