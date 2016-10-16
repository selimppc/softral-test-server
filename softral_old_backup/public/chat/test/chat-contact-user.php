<?php
$class_usertype = ($usertype == 'contacts' ? '' : ' hide');

echo "<div id='all-user' class='all-conversation{$class_usertype}'>";
echo "<h4 class='online_green'>My Contacts</h4>";




/**
 * New Query build on 24_06_2016
 * 
 * All My Contacts will be retrieve by first name and last name
 * 
 * @author Sibbir Ahmed sibbirahmed.ahmed@gmail.com
 * 
 * 
 */
//echo "SELECT a.id, a.user_id, a.friend_id, a.status, 
//                                e.first_name as conversation_first_name,
//                                e.last_name as conversation_last_name,
//                                e.avatar as conversation_avatar,
//                                c.online_status as online_status FROM chat_friendlist a 
//                                inner join users c on a.friend_id = c.id 
//                                inner join user_profile as e on a.friend_id = e.user_id
//                                where a.user_id = {$_SESSION['id']} and a.status='accepted'";



                                
$sql = $dbh->prepare("SELECT a.id, a.user_id, a.friend_id, a.status, 
                                IF(a.user_id={$_SESSION['id']}, c.id, b.id) as conversation_id, 
                                IF(a.user_id={$_SESSION['id']}, c.email, b.email) as conversation_name,
                                IF(a.user_id={$_SESSION['id']}, e.first_name, d.first_name) as conversation_first_name,
                                IF(a.user_id={$_SESSION['id']}, e.last_name, d.last_name) as conversation_last_name,
                                IF(a.user_id={$_SESSION['id']}, e.avatar, d.avatar) as conversation_avatar,
                                IF(a.user_id={$_SESSION['id']}, c.online_status, b.online_status) as online_status FROM chat_friendlist a 
                                inner join users b on a.user_id = b.id 
                                inner join users c on a.friend_id = c.id 
                                inner join user_profile as d on a.user_id = d.user_id 
                                inner join user_profile as e on a.friend_id = e.user_id
                                where (a.user_id = {$_SESSION['id']} or a.friend_id={$_SESSION['id']}) and a.status='accepted'");



$sql->execute();
while ($r = $sql->fetch()) {
    $online_img = "";
    if ($r['online_status'] == 'on') {
        $online_img = "<img width='16px' height='16px' style='float:right; position:relative; top:10px;' src='{$websiteRoot}images/active.png'>";
    }

//    if ($r['online_status'] == 'away') {
//        $online_img = "<img width='16px' height='16px' style='float:right; position:relative; top:10px;' src='{$websiteRoot}images/away.png'>";
//    }



    $profile_pic = "";
    $avatar = $r['conversation_avatar'];
    if (!empty($avatar)){
        $profile_pic = '<img class="thumb-prof-pic" width="35px" height="35px" style="margin-right:5px;" src="data:image/jpeg;base64,' . base64_encode($avatar) . '"/>';
        //$profile_pic = "<img class='thumb-prof-pic' width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";
    }
    else {
        // TODO@ Check Gender for default Profile Picture
        $profile_pic = "<img class='thumb-prof-pic' width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";
    }

    
    
    /**
     * To display the selected user in user list left side
     */
    $temp_class= "user";
    if($friend_request_user_id == $r['conversation_id']){
        $temp_class = "user active-user";
    }
    /**
     * To display the selected user in user list left side
     * End Here
     */
    
    
    
    //echo "<div class='user'>
    echo "<div class='$temp_class'>
            $profile_pic <span class='username'>{$r['conversation_first_name']} {$r['conversation_last_name']}</span> $online_img 
            <label class='userid hide'>{$r['conversation_id']}</label>
        </div>";
}
echo "</div>";
?>