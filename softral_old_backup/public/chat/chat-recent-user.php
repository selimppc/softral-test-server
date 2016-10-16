<?php
$class_usertype = ($usertype == 'recent' || $usertype == 'home' ? '' : ' hide');

echo "<div id='recent-user' class='all-conversation$class_usertype'>";

echo "<h4 class='online_green'>Recent Message</h4>";



/**
 * New Query build on 24_06_2016
 * 
 * All recent Messages will be retrieve with Friend first name and last name
 * 
 * @author Sibbir Ahmed sibbirahmed.ahmed@gmail.com
 * 
 */

//$sql = $dbh->prepare("SELECT m1.*, 
//                        IF(m1.sender_id={$_SESSION['id']}, m1.reciever_id ,m1.sender_id) as conversation_id, 
//                        IF(m1.sender_id={$_SESSION['id']}, t4.first_name ,t3.first_name) as conversation_first_name, 
//                        IF(m1.sender_id={$_SESSION['id']}, t4.last_name ,t3.last_name) as conversation_last_name, 
//                        IF(m1.sender_id={$_SESSION['id']}, t4.avatar ,t3.avatar ) as conversation_avatar,
//                        IF(m1.sender_id={$_SESSION['id']}, t2.online_status ,t1.online_status ) as conversation_online_status, 
//                        IF(m1.sender_id={$_SESSION['id']}, t2.last_seen ,t1.last_seen ) as conversation_last_seen 
//                        FROM ( SELECT * FROM chat_messages AS c WHERE c.sender_id = '{$_SESSION['id']}' OR c.reciever_id = '{$_SESSION['id']}' ORDER BY c.id DESC ) AS m1 
//                        inner join users as t1 on m1.sender_id = t1.id 
//                        inner join users as t2 on m1.reciever_id = t2.id 
//                        inner join user_profile as t3 on m1.sender_id = t3.user_id 
//                        inner join user_profile as t4 on m1.reciever_id = t4.user_id 
//                        GROUP BY LEAST( m1.sender_id, m1.reciever_id) , GREATEST( m1.sender_id, m1.reciever_id ) 
//                        ORDER BY m1.id DESC
//                        LIMIT 8");


                        
//FROM ( SELECT * FROM chat_messages AS c WHERE c.sender_id = '{$_SESSION['id']}' OR c.reciever_id = '{$_SESSION['id']}' ORDER BY c.id DESC ) AS m1 
//IF(m1.sender_id={$_SESSION['id']}, t2.email ,t1.email) as conversation_email,
$sql = $dbh->prepare("SELECT m1.id as msg_id, m1.sender_id, m1.reciever_id,
                        IF(m1.sender_id={$_SESSION['id']}, m1.reciever_id ,m1.sender_id) as conversation_id, 
                        IF(m1.sender_id={$_SESSION['id']}, t4.first_name ,t3.first_name) as conversation_first_name, 
                        IF(m1.sender_id={$_SESSION['id']}, t4.last_name ,t3.last_name) as conversation_last_name, 
                        IF(m1.sender_id={$_SESSION['id']}, t4.avatar ,t3.avatar ) as conversation_avatar,
                        IF(m1.sender_id={$_SESSION['id']}, t2.online_status ,t1.online_status ) as conversation_online_status, 
                        IF(m1.sender_id={$_SESSION['id']}, t2.last_seen ,t1.last_seen ) as conversation_last_seen,
                        IF(m1.sender_id={$_SESSION['id']}, t2.email ,t1.email ) as email 
                        FROM ( SELECT c.id, c.sender_id, c.reciever_id FROM chat_messages AS c WHERE c.sender_id = '{$_SESSION['id']}' OR c.reciever_id = '{$_SESSION['id']}' ORDER BY c.id DESC ) AS m1 
                        inner join users as t1 on m1.sender_id = t1.id 
                        inner join users as t2 on m1.reciever_id = t2.id 
                        inner join user_profile as t3 on m1.sender_id = t3.user_id 
                        inner join user_profile as t4 on m1.reciever_id = t4.user_id 
                        GROUP BY LEAST( m1.sender_id, m1.reciever_id) , GREATEST( m1.sender_id, m1.reciever_id ) 
                        ORDER BY m1.id DESC
                        LIMIT 8");


$sql->execute();

while ($r = $sql->fetch()) {

    /**
     * Time Calculation
     */
    $date = new DateTime($r['conversation_last_seen']);
    $last_seen = $date->format('Y-m-d H:i:s') . "\n";


    $now = new DateTime();
    $current_time = $now->format('Y-m-d H:i:s') . "\n";


    $difference = $date->diff($now);

    //$diff = $difference->format('%h hours %i minutes %s seconds');
    $hour = $difference->format('%h');
    $min = $difference->format('%i');


    /**
     * End of section
     * Time Calculation
     */
    $online_img = "";
    if ($r['conversation_online_status'] == 'on') {

        if ($hour > 0 || $min > 1) {
            $sql = $dbh->prepare("UPDATE users SET online_status = 'off'  WHERE id={$r['conversation_id']}");
            $sql->execute();
        } else {
            $online_img = "<img width='16px' height='16px' style='float:right; position:relative; top:10px;' src='{$websiteRoot}images/active.png'>";
        }
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
    //$profile_pic <span class='username'>{$r['conversation_first_name']} {$r['conversation_last_name']} {$r['email']}</span> $online_img 
    //echo "<div class='user'>
    echo "<div class='$temp_class'>    
            $profile_pic <span class='username'>{$r['conversation_first_name']} {$r['conversation_last_name']} </span> $online_img
            <label class='userid hide'>{$r['conversation_id']}</label>
            <label class='recent_msg_id hide'>{$r['msg_id']}</label>
        </div>";
}

echo "</div>";

?>