<?php
include("config.php");

$sql = $dbh->prepare("SELECT  users FROM chat_usergroup where grp_name = '" . $_GET['grp_name'] . "'");
$sql->execute();
while ($r = $sql->fetch()) {
    $users = unserialize($r['users']);
}

$str = "";
foreach ($users as $user) {
    $delete_user_icon = "<img width='20px' height='20px' title='Delete this user' style='margin-right:5px;' src='{$websiteRoot}images/delete-user.png'>";
    $sql = $dbh->prepare("SELECT first_name, last_name FROM user_profile where user_id = $user");
    $sql->execute();
    while ($r = $sql->fetch()) {
        //$str .= "<span class='grp_member'> {$r['first_name']} {$r['last_name']} $delete_user_icon</span>";
        $str .= "<span class='grp_member'> {$r['first_name']} {$r['last_name']} </span>";
    }
}


echo $str;

?>