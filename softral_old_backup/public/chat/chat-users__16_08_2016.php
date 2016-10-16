<?php
include_once("config.php");


//date_default_timezone_set('UTC');
//date_default_timezone_set("America/Chicago");
//$timezone = new DateTimeZone('America/Chicago');
//date_default_timezone_set("Asia/Kolkata");
//$timezone = new DateTimeZone('Asia/Kolkata');



if (!isset($usertype))
    $usertype = (!empty($_GET['usertype']) ? $_GET['usertype'] : 'home');


/**
 * Recent Messages Section
 * ---------------------------------------------------------------------------------------
 */
$class_usertype = ($usertype == 'recent' || $usertype == 'home' ? '' : ' hide');

echo "<div id='recent-user' class='all-conversation$class_usertype'>";


echo "<h4 class='online_green'>Recent Message</h4>";


/**
 * Query Which display the Email Name
 * 
 * Commenting by Sibibr Ahmed on 24_06_2016
 * Because Query retrive the records only by friends email id not hiis first name and last name
 */
//$sql = $dbh->prepare("SELECT m1.*,
//                        IF(m1.sender_id={$_SESSION['id']}, m1.reciever_id ,m1.sender_id) as conversation_id,
//                        IF(m1.sender_id={$_SESSION['id']}, t2.email ,t1.email) as conversation_name,
//                        IF(m1.sender_id={$_SESSION['id']}, t2.online_status ,t1.online_status ) as conversation_online_status,
//                        IF(m1.sender_id={$_SESSION['id']}, t2.last_seen ,t1.last_seen ) as conversation_last_seen
//                        FROM ( SELECT * FROM chat_messages AS c WHERE c.sender_id = '{$_SESSION['id']}' OR c.reciever_id = '{$_SESSION['id']}' ORDER BY c.id DESC ) AS m1 
//                        inner join users as t1 on m1.sender_id = t1.id 
//                        inner join users as t2 on m1.reciever_id = t2.id 
//                        GROUP BY LEAST( m1.sender_id, m1.reciever_id) , GREATEST( m1.sender_id, m1.reciever_id ) 
//                        ORDER BY m1.id DESC");


/**
 * New Query build on 24_06_2016
 * 
 * All recent Messages will be retrieve with Friend first name and last name
 * 
 * @author Sibbir Ahmed sibbirahmed.ahmed@gmail.com
 * 
 */
$sql = $dbh->prepare("SELECT m1.*, 
                        IF(m1.sender_id={$_SESSION['id']}, m1.reciever_id ,m1.sender_id) as conversation_id, 
                        IF(m1.sender_id={$_SESSION['id']}, t2.email ,t1.email) as conversation_email,
                        IF(m1.sender_id={$_SESSION['id']}, t4.first_name ,t3.first_name) as conversation_first_name, 
                        IF(m1.sender_id={$_SESSION['id']}, t4.last_name ,t3.last_name) as conversation_last_name, 
                        IF(m1.sender_id={$_SESSION['id']}, t4.avatar ,t3.avatar ) as conversation_avatar,
                        IF(m1.sender_id={$_SESSION['id']}, t2.online_status ,t1.online_status ) as conversation_online_status, 
                        IF(m1.sender_id={$_SESSION['id']}, t2.last_seen ,t1.last_seen ) as conversation_last_seen FROM ( SELECT * FROM chat_messages AS c WHERE c.sender_id = '{$_SESSION['id']}' OR c.reciever_id = '{$_SESSION['id']}' ORDER BY c.id DESC ) AS m1 
                        inner join users as t1 on m1.sender_id = t1.id 
                        inner join users as t2 on m1.reciever_id = t2.id 
                        inner join user_profile as t3 on m1.sender_id = t3.user_id 
                        inner join user_profile as t4 on m1.reciever_id = t4.user_id 
                        GROUP BY LEAST( m1.sender_id, m1.reciever_id) , GREATEST( m1.sender_id, m1.reciever_id ) 
                        ORDER BY m1.id DESC");


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
    if ($r['conversation_online_status'] == 'away') {

        if ($hour > 0 || $min > 1) {
            $sql = $dbh->prepare("UPDATE users SET online_status = 'off'  WHERE id={$r['conversation_id']}");
            $sql->execute();
        } else {
            $online_img = "<img width='16px' height='16px' style='float:right; position:relative; top:10px;' src='{$websiteRoot}images/away.png'>";
        }
    }

    $profile_pic = "";
    $avatar = $r['conversation_avatar'];
    if (!empty($avatar))
        $profile_pic = '<img class="thumb-prof-pic" width="35px" height="35px" style="margin-right:5px;" src="data:image/jpeg;base64,' . base64_encode($avatar) . '"/>';
    else {
        // TODO@ Check Gender for default Profile Picture
        $profile_pic = "<img class='thumb-prof-pic' width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";
    }




//$profile_pic <span class='username'>{$r['conversation_first_name']} {$r['conversation_last_name']}</span>$hour $min ( $last_seen, $current_time ) $online_img 
    echo "<div class='user'>
        
        $profile_pic <span class='username'>{$r['conversation_first_name']} {$r['conversation_last_name']}</span> $online_img 
        
        <label class='userid hide'>{$r['conversation_id']}</label>
    </div>";
}

echo "</div>";


/**
 * End of
 * Recent Messages Section
 */
/**
 * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
/**
 * My Contacts Section
 * --------------------------------------------------------------------------------------------------------------
 */
$class_usertype = ($usertype == 'contacts' ? '' : ' hide');

echo "<div id='all-user' class='all-conversation{$class_usertype}'>";
echo "<h4 class='online_green'>My Contacts</h4>";



/**
 * Query Which display the Email Name
 * 
 * Commenting by Sibibr Ahmed on 24_06_2016
 * Because Query retrive the records only by friends email id not hiis first name and last name
 */
//$sql = $dbh->prepare("SELECT a.id, a.user_id, a.friend_id, a.status, 
//            IF(a.user_id={$_SESSION['id']}, c.id, b.id) as conversation_id,
//            IF(a.user_id={$_SESSION['id']}, c.email, b.email) as name,
//            IF(a.user_id={$_SESSION['id']}, c.online_status, b.online_status) as online_status
//            FROM chat_friendlist a 
//            inner join users b on a.user_id = b.id 
//            inner join users c on a.friend_id = c.id 
//            where (user_id = {$_SESSION['id']} or friend_id={$_SESSION['id']}) and a.status='accepted'");




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
//                                where (a.user_id = {$_SESSION['id']} or a.friend_id={$_SESSION['id']}) and a.status='accepted'";
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

    if ($r['online_status'] == 'away') {
        $online_img = "<img width='16px' height='16px' style='float:right; position:relative; top:10px;' src='{$websiteRoot}images/away.png'>";
    }



    $profile_pic = "";
    $avatar = $r['conversation_avatar'];
    if (!empty($avatar))
        $profile_pic = '<img class="thumb-prof-pic" width="35px" height="35px" style="margin-right:5px;" src="data:image/jpeg;base64,' . base64_encode($avatar) . '"/>';
    else {
        // TODO@ Check Gender for default Profile Picture
        $profile_pic = "<img class='thumb-prof-pic' width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";
    }

    echo "<div class='user'>
            $profile_pic <span class='username'>{$r['conversation_first_name']} {$r['conversation_last_name']}</span> $online_img 
            <label class='userid hide'>{$r['conversation_id']}</label>
        </div>";
}
echo "</div>";



/**
 * End of
 * My Contacts Section
 */
/**
 * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
/**
 * Groups Name
 * ------------------------------------------------------------------------------------------------
 */
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

/**
 * End of
 * Groups Name
 */
/**
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
/**
 * Pending Friend Request
 */
$class_usertype = ($usertype == 'pendind_request' ? '' : ' hide');

echo "<div id='all-pending-requests' class='all-conversation{$class_usertype}'>";
echo "<h4 class='online_green'>Pending Request</h4>";

/**
 * Query Which display the Email Name of All pending Request
 * 
 * Commenting by Sibibr Ahmed on 24_06_2016
 * Because Query retrive the records only by friends email id not hiis first name and last name
 */
//$sql = $dbh->prepare("SELECT a.id, a.user_id, a.status, b.email FROM chat_friendlist a inner join users b on a.user_id = b.id where friend_id = {$_SESSION['id']} and a.status='requested'");




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
                        where a.friend_id = {$_SESSION['id']} and a.status='requested'");
$sql->execute();


$no_of_pending_request = 0;
while ($r = $sql->fetch()) {
    $online_img = "";

    $profile_pic = "";
    // TODO@ Check Gender for default Profile Picture
    $profile_pic = "<img class='thumb-prof-pic' width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";


    echo "<div class='pending-request'>$profile_pic 
                <span class='username'>{$r['first_name']} {$r['last_name']}</span> 
                <label class='userid hide'>{$r['user_id']}</label>
          </div>";


    $no_of_pending_request++;
}
echo "</div>";
/*
 * End of Section
 * Pending Friend Request
 */



/**
 * --------------------------------------------------------------------------------------------
 */
//Send an activation Message to the server

$now = new DateTime();
$now->setTimezone($timezone);
$last_seen = $now->format('Y-m-d H:i:s') . "\n";

//echo $timezone;

$sql = $dbh->prepare("UPDATE users SET online_status = 'on', last_seen = '$last_seen' WHERE id={$_SESSION['id']}");
$sql->execute();
?>






<script src="<?= $websiteRoot; ?>js/jstz-1.0.5.min.js"></script><!--Client Timezone-->

<script>
        
        
    /**
     * Set no of Pending request
     */
    var no_of_pending_request = "<?php echo $no_of_pending_request ?>";
        
        
        
    if(no_of_pending_request > 0){    
        $("#no-of-pending-request").removeClass("hide");
        //$("#no-of-pending-request").html("<?php echo $no_of_pending_request; ?>");
        //$("#no-of-pending-request").html(" <img height='20' wdith='20' src='<?php echo $websiteRoot ?>images/add_user.png'><sup style='color:red'><?php echo $no_of_pending_request; ?></sup>");
        $("#no-of-pending-request").html(" <img height='20' wdith='20' src='<?php echo $websiteRoot ?>images/Profile_AddFriend-24.png'><sup style='color:red'><?php echo $no_of_pending_request; ?></sup>");
    }else{
        $("#no-of-pending-request").html("");
        $("#no-of-pending-request").addClass("hide");
    }
    
    
    
    /**
     * Select user from My contact list to start aconversation
     * and to see the previous conversation
     */
    $(".user").on("click", function(){
        
        var viewportWidth = $(document).width();
        console.log(viewportWidth);
        if (viewportWidth < 480) {
            console.log("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
            $(".chatbox-left-panel").hide();
            $(".chatbox").show();
            //$(".user").addClass("small-user");
            //$(".chatbox-left-panel").addClass("hide");
            //$(".chatbox").css("display","block !important");
            //$(".view").removeClass("view view-portfolio").addClass("gallery-mobile");
        }
        
        
        //alert("aaaaaaaaaaa");
        //This is the friend Profile Pic to whome chtting
        var user_prof_pic_url = $(this).find('img').attr('src');
        $("#friend_rquest_user_prof_pic").attr("src", user_prof_pic_url);
        
        $("#friend_rquest_user_name").html(($(this).find(".username").text())); //This is the friend Name to whome chatting with
        $("#friend_request_user_id").val(($(this).find(".userid ").text()));    //This is the friend Id to whome chetting with
        
        
        $(".request").addClass("hide");     //hide all friend Request Messages like.. Accept Request. cancael request
        $("#friend-request").removeClass("hide"); //Display the header section of right side chatboc panel
        
        
        $(".msgs").html("Loading Conversation.....");// Clear The chatBox Before Loading New..
        
        $("#send-box").removeClass("hide"); // Clear the text box from where user can sent a message to his friends
        $("#chattype").val('individual');   //If indiviadaul user is selected to chat
        
        
        $("#sendto").val(($(this).find("label").text()));
        $("#groupid").val("");
        
        
        
        //load_new_stuff();
        load_all_messasges();
    });
    
    
    
    /**
     * End of Section
     * Select user from My contact list to start aconversation
     * and to see the previous conversation
     */
    
    
    /**
     * Select a group from my Group list to start aconversation
     * and to see the previous conversation
     */
    $(".group").on("click", function(){
        
        //alert("aaaaaaaaaaaa");
        
        var viewportWidth = $(document).width();
        console.log(viewportWidth);
        if (viewportWidth < 480) {
            console.log("Click on gruop when width < 480");
            $(".chatbox-left-panel").hide();
            $(".chatbox").show();
        }else{
            //Display group members name on left side bar
            $(".group").not(this).find('.group_member').css('display','none');
            $(this).find('.group_member').toggle();
            //End of section  Display group members name on left side bar
        }
        
        
        
        //This is the friend Profile Pic to whome chtting
        var user_prof_pic_url = $(this).find('img').attr('src');
        $("#friend_rquest_user_prof_pic").attr("src", user_prof_pic_url);
        $("#friend_rquest_user_prof_pic").attr("title", "Click Here to add or Remove Group Members");
        
        
        var group_name = $(this).find(".groupname").text();
        
        
        
        var text = '<h4 class="online_green">' + group_name + '</h4>';
        text += '<a href="#;" data-grp_name="'+group_name+'" class="showme">Show all members...</a>';
        $("#friend_rquest_user_name").html(text); //This is the friend Name to whome chatting with
        $("#friend_request_user_id").val(($(this).find(".groupid ").text()));    //This is the friend Id to whome chetting with
        
        
        /*
        var base_url = "<?php echo $websiteRoot; ?>";
        
        $.ajax(base_url+'chat-group-members.php?grp_name='+group_name, {
            success: function(data) {
                
                var text = '<h4 class="online_green">' + group_name + '</h4>';
                
                text += data;
                
                text += '<a href="#;" data-grp_name="'+group_name+'" class="showme">Show all members...</a>';
                //text += '<a data-toggle="modal" href="#myModal" id="modellink">Show all members...</a>';
                $("#friend_rquest_user_name").html(text); //This is the friend Name to whome chatting with
                $("#friend_request_user_id").val(($(this).find(".groupid ").text()));    //This is the friend Id to whome chetting with
                
            },
            error: function() {
                //$('#notification-bar').text('An error occurred');
            }
        });
         */
        
        
        
        
        
        
        
        
        $(".request").addClass("hide");     //hide all friend Request Messages like.. Accept Request. cancael request
        $("#friend-request").removeClass("hide"); //Display the header section of right side chatboc panel
        
        
        $(".msgs").html("Loading Conversation.....");// Clear The chatBox Before Loading New..
        
        
        
        
        
        $("#send-box").removeClass("hide"); // Clear the text box from where user can sent a message to his friends
        $("#chattype").val('group');   //If a group name is selected to chat
        
        $("#groupid").val(($(this).find("label").text()));
        $("#sendto").val("");
        
        
        
        //load_new_stuff();
        
        
        
        load_all_messasges();
    });    
    
    /**
     * End of Section
     * Select a group from my Group list to start aconversation
     * and to see the previous conversation
     */
    
   
    
    //TODO@ Check Where I can shift this block.
    $(".user, .group").on("click", function(){
        $(".fileinput-button").removeClass("hide");     
    });
    
    
    
    /**
     * Select user to accept/reject pending friend Request
     */
    $(".pending-request").on("click", function(){
        $("#friend-request").removeClass("hide");
        $(".request").addClass("hide");
        $("#reponse-friend-request").removeClass("hide");
        $("#friend_rquest_user_name").html(($(this).find(".username").text()));
        $("#friend_request_user_id").val(($(this).find(".userid ").text())); 
        
        
        //Clear the Messages area
        $(".msgs").html("");
    });
    /**
     * End ofo Section
     * Select user to accept/reject pending friend Request
     */
    
    
    
    function load_all_messasges(){
        //alert("Hello Jessica 3333");
        //alert($(".msgs .msg:last").attr("title"));
        //localStorage['lpid']=$(".msgs .msg:last").attr("title");
        console.log('load_all_messages');
        //console.log($(".msgs .msg:last").attr("title"));
    
    
        var timezone = jstz.determine();
    
        var chattype = $("#chattype").val();
    
        var sendto = $("#friend_request_user_id").val();
        var groupid = $("#groupid").val();
        var usertype = $("#usertype").val();
        
        //alert("Hello Netnoor");
    
        if(sendto != '' || groupid != ''){
            //alert("One");
            $(".msgs").load(base_url + "chat-msgs.php",{ 
                chattype: chattype,
                sendto: sendto,
                groupid: groupid,
                usertype: usertype,
                timezone: timezone.name()
            },function(){
                //alert("Two");
                //                if(localStorage['lpid']!=$(".msgs .msg:last").attr("title")){
                //                    alert("Three");
                //                    scTop();
                //                }
                
                scTop();
            });
        }
    }
    
    function scTop(){
        //alert("scTop");
        console.log($(".msgs")[0].scrollHeight);
        $(".msgs").animate({
            scrollTop:$(".msgs")[0].scrollHeight
        });
    }

</script>