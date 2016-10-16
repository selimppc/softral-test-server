<?php

include("config.php");
$recent_friendlist_id = $_POST['recent_friendlist_id'];


                        
$sql = $dbh->prepare("SELECT a.id, a.user_id, a.status, b.email, c.first_name, c.last_name FROM chat_friendlist a 
                        inner join users b on a.user_id = b.id 
                        inner join user_profile c on a.user_id = c.user_id 
                        where a.id>$recent_friendlist_id and a.friend_id = {$_SESSION['id']} and a.status='requested'
                        ORDER BY a.id DESC
                        ");
                        


$sql->execute();

$no_of_pending_request = 0;
while ($r = $sql->fetch()) {
    
    
    
    $online_img = "";

    $profile_pic = "";
    // TODO@ Check Gender for default Profile Picture
    $profile_pic = "<img class='thumb-prof-pic' width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";


    echo "<div class='pending-request'>
                $profile_pic <span class='username'>{$r['first_name']} {$r['last_name']}</span> 
                <label class='userid hide'>{$r['user_id']}</label>
                <label class='recent_friendlist_id hide'>{$r['id']}</label>
          </div>";


    //$no_of_pending_request++;
}


//echo $no_of_pending_request;

?>
