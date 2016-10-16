<?php
$class_usertype = ($usertype == 'pendind_request' ? '' : ' hide');

echo "<div id='all-pending-requests' class='all-conversation{$class_usertype}'>";
echo "<h4 class='online_green'>Pending Request</h4>";


/**
 * New Query build on 24_06_2016
 * 
 * All Pending Request will be retrieve by first name and last name
 * 
 * @author Sibbir Ahmed sibbirahmed.ahmed@gmail.com
 * 
 * 
 */
$sql = $dbh->prepare("SELECT a.id, a.user_id, a.status, b.email, c.first_name, c.last_name FROM chat_friendlist a 
                        inner join users b on a.user_id = b.id 
                        inner join user_profile c on a.user_id = c.user_id 
                        where a.friend_id = {$_SESSION['id']} and a.status='requested'
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


    $no_of_pending_request++;
}
echo "</div>";
?>


<script>
    /**
     * Set no of Pending request
     */
    var no_of_pending_request = "<?php echo $no_of_pending_request ?>";
    
    
    if(no_of_pending_request > 0){    
        $("#no-of-pending-request").removeClass("hide");
        $("#no-of-pending-request").html(" <img height='20' wdith='20' src='<?php echo $websiteRoot ?>images/Profile_AddFriend-24.png'><sup style='color:red'><?php echo $no_of_pending_request; ?></sup>");
    }else{
        $("#no-of-pending-request").html("");
        $("#no-of-pending-request").addClass("hide");
    }
</script>