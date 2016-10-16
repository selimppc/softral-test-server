<?php
include("config.php");

//$sql = $dbh->prepare("SELECT a.id, a.user_id, a.friend_id, a.status, 
//                                IF(a.user_id={$_SESSION['id']}, c.id, b.id) as conversation_id, 
//                                IF(a.user_id={$_SESSION['id']}, c.email, b.email) as conversation_name,
//                                IF(a.user_id={$_SESSION['id']}, e.first_name, d.first_name) as conversation_first_name,
//                                IF(a.user_id={$_SESSION['id']}, e.last_name, d.last_name) as conversation_last_name,
//                                IF(a.user_id={$_SESSION['id']}, e.avatar, d.avatar) as conversation_avatar,
//                                IF(a.user_id={$_SESSION['id']}, c.online_status, b.online_status) as online_status FROM chat_friendlist a 
//                                inner join users b on a.user_id = b.id 
//                                inner join users c on a.friend_id = c.id 
//                                inner join user_profile as d on a.user_id = d.user_id 
//                                inner join user_profile as e on a.friend_id = e.user_id
//                                where (a.user_id = {$_SESSION['id']} or a.friend_id={$_SESSION['id']}) and a.status='accepted'");

//select * from myTable where Login_time > date_sub(now(), interval 3 minute) ;
//
//$sql = $dbh->prepare("SELECT a.id, a.user_id, a.friend_id, a.status, 
//                                e.first_name as conversation_first_name,
//                                e.last_name as conversation_last_name,
//                                e.avatar as conversation_avatar,
//                                c.online_status as online_status FROM chat_friendlist a 
//                                inner join users c on a.friend_id = c.id 
//                                inner join user_profile as e on a.friend_id = e.user_id
//                                where a.user_id = {$_SESSION['id']} and a.status='accepted'");


//where a.accpeted_time > date_sub(now(), interval 3 minute) and (a.user_id = {$_SESSION['id']} or a.friend_id={$_SESSION['id']}) and a.status='accepted'");
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
                                where a.accpeted_time > date_sub(now(), interval 15 SECOND) and (a.user_id = {$_SESSION['id']} or a.friend_id={$_SESSION['id']}) and a.status='accepted'");
                                
                                
$sql->execute();
while ($r = $sql->fetch()) {
    $online_img = "";
    if ($r['online_status'] == 'on') {
        $online_img = "<img width='16px' height='16px' style='float:right; position:relative; top:10px;' src='{$websiteRoot}images/active.png'>";
    }



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

    
    
  
    
    
    //echo "<div class='$temp_class'>
    echo "<div class='user'>
            $profile_pic <span class='username'>{$r['conversation_first_name']} {$r['conversation_last_name']}</span> $online_img 
            <label class='userid hide'>{$r['friend_id']}</label>
        </div>";
}


?>
