<?php
$class_usertype = ($usertype == 'groups' ? '' : ' hide');

echo "<div id='all-groups' class='all-conversation{$class_usertype}'>";

$groups_seetings_icon = "<img width='20px' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/user_group_settings.png'>";
echo "<h4 class='online_green'>Groups 
            <a href='{$websiteRoot}chat-new-group.php'>$groups_seetings_icon</a> 
        </h4>";
?>
<!--<a href='<?= $websiteRoot ?>home/chat-new-group'>Create/Edit Group</a>-->
<?php
$sql = $dbh->prepare("SELECT * from chat_usergroup where users LIKE '%" . $_SESSION['id'] . "%'");
$sql->execute();

while ($r = $sql->fetch()) {

    $profile_pic = "";
    // TODO@ Check Gender for default Profile Picture
    $profile_pic = "<img class='thumb-prof-pic' width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/grp.png'>";


    echo "<div class='group'>
            $profile_pic <span class='groupname'>{$r['grp_name']}</span>
            <label class='groupid hide'>{$r['id']}</label>";

    /**
     * List of all group Members
     */
    $sql1 = $dbh->prepare("SELECT  users FROM chat_usergroup where grp_name = '" . $r['grp_name'] . "'");
    $sql1->execute();
    while ($row = $sql1->fetch()) {
        $members = unserialize($row['users']);
    }

    $str = "";
    foreach ($members as $user) {
        //$delete_user_icon = "<img width='20px' height='20px' title='Delete this user' style='margin-right:5px;' src='{$websiteRoot}images/delete-user.png'>";
        $sql2 = $dbh->prepare("SELECT first_name, last_name FROM user_profile where user_id = $user");
        $sql2->execute();
        while ($member = $sql2->fetch()) {
            $str .= "<div style='padding-left:40px; display:none;' class='group_member'>
                                <img width='9' height='11' src='{$websiteRoot}images/small-row-arrow.png'>
                                <small class='name-group-member'>{$member['first_name']} {$member['last_name']}</small> 
                            </div>";
            //<span class='grp_member'> {$r['first_name']} {$r['last_name']} $delete_user_icon</span>";
        }
    }

    /**
     * End of Section
     * List of all group Members
     */
    echo $str;

    echo "</div>";
}
echo "</div>";

?>