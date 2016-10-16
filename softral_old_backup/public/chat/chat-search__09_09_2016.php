<?php
include("config.php");

$search_str = $_POST['search_str'];
$search_from = $_POST['search_from']; //My Frindlist/ From Netnoor Directory


$str = "";
if ($search_from == "softral_db") {
    /**
     * Search from Softral Directory
     */

    
   
    $str .= "<h4 class='online_green'>Results from Softral</h4>";
                
    $sql = $dbh->prepare("SELECT a.user_id, a.first_name, a.last_name,
                            if(a.user_id = b.user_id, b.status, c.status) as request_status,
                            if(a.user_id = b.user_id, 'pending_request', 'sent_request') as requested_type
                            FROM user_profile a 
                            left join chat_friendlist b on a.user_id=b.user_id and b.friend_id={$_SESSION['id']}
                            left join chat_friendlist c on a.user_id=c.friend_id and c.user_id={$_SESSION['id']}
                            left join users d on d.id=a.user_id
                            where (a.first_name LIKE '%$search_str%' OR a.last_name LIKE '%$search_str%') AND d.activated=1 ");
    $sql->execute();
    while ($r = $sql->fetch()) {
        $profile_pic = "";
        //Check Gender
        $profile_pic = "<img width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";
            
        $str .= "<div class='netnoor-user' id='netnoor-user-{$r['user_id']}'>$profile_pic 
                    <span class='username'>{$r['first_name']} {$r['last_name']}</span> 
                    <label class='userid hide'>{$r['user_id']}</label>
                    <label class='friend-status hide'>{$r['request_status']}</label>
                    <label class='friend-request-type hide'>{$r['requested_type']}</label>
                </div>";
    }
} else {
    /**
     * Search from My Contacts List
     */
    
    
    
    $str .= "<h4 class='online_green'>Results from My Contacts</h4>";
    
    

    /**
     * Query Which display the Email Name from My Contacts When Search
     * 
     * Commenting by Sibibr Ahmed on 24_06_2016
     * Because Query retrive the records only by friends email id not hiis first name and last name
     */
                            
//    $sql = $dbh->prepare("SELECT a.id, a.email, a.online_status
//                            FROM users a 
//                            JOIN chat_friendlist b on a.id=b.user_id or a.id=b.friend_id 
//                            where a.email LIKE '%$search_str%' and {$_SESSION['id']} IN (b.user_id,b.friend_id) and b.status='accepted'");
                            
                            
    $sql = $dbh->prepare("SELECT a.id, a.email, a.online_status,
                            if(a.id = b.user_id, c.first_name, d.first_name) as first_name,
                            if(a.id = b.user_id, c.last_name, d.last_name) as last_name
                            FROM users a 
                            JOIN chat_friendlist b on a.id=b.user_id or a.id=b.friend_id 
                            INNER JOIN user_profile c on c.user_id=b.user_id
                            INNER JOIN user_profile d on d.user_id=b.friend_id 
                            where a.email LIKE '%$search_str%' and {$_SESSION['id']} IN (b.user_id,b.friend_id) and b.status='accepted'");
                            
                            
    $sql->execute();
    while ($r = $sql->fetch()) {
        $online_img = "";
        if ($r['online_status'] == 'on') {
            $online_img = "<img width='16px' height='16px' style='margin-right:5px;' src='{$websiteRoot}images/active.png'>";
        }

        if ($r['online_status'] == 'away') {
            $online_img = "<img width='16px' height='16px' style='margin-right:5px;' src='{$websiteRoot}images/away.png'>";
        }

        $profile_pic = "";
        //Check Gender
        $profile_pic = "<img width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";


        $str .= "<div class='my-contact'>$profile_pic
                    <span class='username'>{$r['first_name']} {$r['last_name']} $online_img</span> 
                    <label class='userid hide'>{$r['id']}</label>
                </div>";
    }
}

echo $str;
?>