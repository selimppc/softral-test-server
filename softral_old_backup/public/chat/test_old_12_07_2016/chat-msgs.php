<?php
include("config.php");




//date_default_timezone_set('America/Chicago');
//date_default_timezone_set('Asia/Kolkata');


//$timezone = "America/Chicago";
//$timezone = "Asia/Kolkata";
$timezone = $_POST['timezone'];


?>

<?php
$chattype = $_POST['chattype'];
$sendto = $_POST['sendto'];
$groupid = $_POST['groupid'];

/**
 * 
 * Recenet Message wil be load in top
 */
/**
 * End of
 * Recenet Message wil be load in top
 */
/*
 * Check Whether Group Chatting or Individual Chatting
 */


if ($chattype == 'individual') {
    // Individual Chatting
//    $sql = $dbh->prepare("SELECT a.id, sender_id, reciever_id, msg, msg_type, posted FROM chat_messages as a 
//                            inner join users as b on a.sender_id = b.id 
//                            where a.sender_id in('" . $_SESSION['id'] . "', '$sendto') 
//                                and a.reciever_id in('" . $_SESSION['id'] . "', '$sendto')");
//    echo "SELECT a.id, a.sender_id, a.reciever_id, a.msg, a.msg_type, a.posted, c.avatar FROM chat_messages as a 
//                            inner join users as b on a.sender_id = b.id 
//                            inner join user_profile as c on b.id = c.user_id 
//                            where a.sender_id in('" . $_SESSION['id'] . "', '$sendto') and a.reciever_id in('" . $_SESSION['id'] . "', '$sendto')";
    //SELECT * FROM ( SELECT a.id, a.sender_id, a.reciever_id, a.msg, a.msg_type, a.posted, c.avatar FROM chat_messages as a inner join users as b on a.sender_id = b.id inner join user_profile as c on b.id = c.user_id where a.sender_id in('100', '146') and a.reciever_id in('100', '146') ORDER BY id DESC LIMIT 3) sub ORDER BY id ASC 
    //Select All conversation...        
//    $sql = $dbh->prepare("SELECT a.id, a.sender_id, a.reciever_id, a.msg, a.msg_type, a.posted, c.avatar FROM chat_messages as a 
//                            inner join users as b on a.sender_id = b.id 
//                            inner join user_profile as c on b.id = c.user_id 
//                            where a.sender_id in('" . $_SESSION['id'] . "', '$sendto') and a.reciever_id in('" . $_SESSION['id'] . "', '$sendto')");
    //Select last 10 meassages only
    $sql = $dbh->prepare("SELECT * FROM (
                            SELECT a.id, a.sender_id, a.reciever_id, a.msg, a.msg_type, a.posted, c.avatar FROM chat_messages as a 
                            inner join users as b on a.sender_id = b.id 
                            inner join user_profile as c on b.id = c.user_id 
                            where a.sender_id in('" . $_SESSION['id'] . "', '$sendto') and a.reciever_id in('" . $_SESSION['id'] . "', '$sendto') 
                            ORDER BY id DESC LIMIT 20) sub ORDER BY id ASC");
    $sql->execute();

    $temp_time = "";
    while ($r = $sql->fetch()) {


        /**
         * Convert time to am and pm
         */
        $time = $r['posted'];
        $datetime = new DateTime($time);
        $datetime->format('Y-m-d H:i:s') . "\n";


        $la_time = new DateTimeZone($timezone);
        $datetime->setTimezone($la_time);

        $short_time = $datetime->format('h:i A');

        /*
         * 
         * End of
         * Convert time to am and pm 
         */


        /**
         * Timing Heading With Day and Date:
         */
        $str = "";

        if (date('Y:m:d', strtotime($temp_time)) != date('Y:m:d', strtotime($time))) {
            $temp_time = $time;

            $str.='<div style="clear:left; width 500px;text-align: center; font-weight: bold; margin: 10px 0px; color:rgb(134,192,229);"> ' . date("l, F j, Y", strtotime($time)) . '</div>';
        }

        /**
         * End of
         * Timing Heading With Day and Date:
         */
        $class = "msg";
        $user_name = ""; //$user_name = "Me :";
        $friend_profile_pic = "";
        $caret_class = "";

        
        $m_id = htmlspecialchars_decode($r['id']);
        $msg = htmlspecialchars_decode($r['msg']);
        $msg_type = htmlspecialchars_decode($r['msg_type']);
        
        


        $final_msg = "";
        if ($r['sender_id'] == $_SESSION['id']) {
            $class .= " me";
            
            if ($msg_type == 'file') {
                
            }else{
                $caret_class = '<i class="triangle-right"></i>';
                $msg .= $caret_class;
            }
            
            
        } else {
            $class .= " friend";



            $avatar = $r['avatar'];
            if (!empty($avatar))
                $friend_profile_pic = '<img width="35px" height="35px" src="data:image/jpeg;base64,' . base64_encode($avatar) . '" style="margin-right:5px; float:left;">';
            else
                $friend_profile_pic = '<img width="35px" height="35px" src="' . $websiteRoot . '/images/man.png" style="margin-right:5px; float:left;">';


            $caret_class = '<i class="triangle-left"></i>';

            //$friend_profile_pic = $friend_profile_pic . $caret_class;
            if ($msg_type == 'file') {
                $friend_profile_pic = $friend_profile_pic;    
            }else{
                $friend_profile_pic = $friend_profile_pic . $caret_class;
            }
            
        }



        
        

        if ($msg_type == 'file') {
            $class .= " file";
            
            $parts = explode('/', $websiteRoot);
            $url = $parts[0] . '//' . $parts[2] . '/' . $parts[3] . '/';




            /**
             * Softral Test folder is not working that's why we are alaways using the softra.com/chat/uplaods folder directly 
             * instead of softra.com/chat/test/uplaods folder
             */
            //$msg = "<a href='{$websiteRoot}/uploads/files/" . $r['msg'] . "' download> <img src='{$websiteRoot}/images/download.png' width='25px' height='25px'></a>";


            /**
             * Check extension of that file
             * If it is an image then display the image
             * Or If it is a file just display the filename having downlaod option..
             */
            $filename = $r['msg'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            if ($ext == 'png' || $ext == 'jpg') {
                //Image
                $msg = "<a href='{$url}uploads/files/" . $filename . "' download>
                            <img style='border-radius:5px 5px 5px 5px;' src='{$url}uploads/files/" . $filename . "' width='150' height='150'>
                       </a>";
            } else {
                //File
                $msg = "<a href='{$url}uploads/files/" . $filename . "' download>
                            <img src='{$url}images/download.png' width='25px' height='25px'> $filename
                        </a>";
            }
            
            
            if ($r['sender_id'] == $_SESSION['id']) {
                $class .= " file-me";
            }
            
            
            //$str .= '<div style="clear:both; float:left; width:100%">';
            
            
//            $str .= '<div class="col-xs-10 col-sm-10 col-md-12">';
//            $str .= $friend_profile_pic;
//            $str .= "<div class='{$class}' title='{$r['posted']}'>";
//            $str .= "<span class='name'><b>{$user_name}</b></span>";
//            $str .= "<span style='word-wrap:break-word' class='msgc'>$msg</span>";
//            $str .= "</div>";
//            $str .= "<input type='hidden' class='mess_id' value='$m_id'>";
//            $str .= "<span class='short_time'>$short_time</span>";
//            $str .= "</div>";
            
            
            
        } else {
            
            
            
                
                
            //$str .= '<div style="clear:both; float:left; width:100%">';
            
//            $str .= '<div class="col-xs-10 col-sm-10 col-md-12">';
//            $str .= $friend_profile_pic;
//            $str .= "<div class='{$class}' title='{$r['posted']}'>";
//            $str .= "<span class='name'><b>{$user_name}</b></span>";
//            $str .= "<span style='word-wrap:break-word' class='msgc'>$msg</span>";
//            $str .= "</div>";
//            $str .= "<input type='hidden' class='mess_id' value='$m_id'>";
//            $str .= "<span class='short_time'>$short_time</span>";
//            $str .= "</div>";
            
        }
        
        $str .= '<div class="col-xs-10 col-sm-10 col-md-12">';
        $str .= $friend_profile_pic;
        $str .= "<div class='{$class}' title='{$r['posted']}'>";
        $str .= "<span class='name'><b>{$user_name}</b></span>";
        $str .= "<span style='word-wrap:break-word' class='msgc'>$msg</span>";
        $str .= "</div>";
        $str .= "<input type='hidden' class='mess_id' value='$m_id'>";
        $str .= "<span class='short_time'>$short_time</span>";
        $str .= "</div>";

        echo $str;
    }
} else {
    // Group Chatting
    $sql = $dbh->prepare("SELECT sender_id, msg, msg_type, posted FROM chat_group_messages as a inner join users as b on a.sender_id = b.id where a.grp_id = $groupid");
    $sql->execute();



    $temp_time = "";
    while ($r = $sql->fetch()) {


        /**
         * Convert time to am and pm
         */
        $time = $r['posted'];
        $datetime = new DateTime($time);
        $datetime->format('Y-m-d H:i:s') . "\n";


        $la_time = new DateTimeZone($timezone);
        $datetime->setTimezone($la_time);

        $short_time = $datetime->format('h:i A');

        /*
         * 
         * End of
         * Convert time to am and pm 
         */


        /**
         * Timing Heading With Day and Date:
         */
        $str = "";

        if (date('Y:m:d', strtotime($temp_time)) != date('Y:m:d', strtotime($time))) {
            $temp_time = $time;

            $str.='<div style="clear:left; width 500px;text-align: center; font-weight: bold; margin: 10px 0px; color:rgb(134,192,229);"> ' . date("l, F j, Y", strtotime($time)) . '</div>';
        }

        /**
         * End of
         * Timing Heading With Day and Date:
         */
        $class = "msg";
        $user_name = ""; //$user_name = "Me :";
        $friend_profile_pic = "";
        $caret_class = "";


        $msg = htmlspecialchars_decode($r['msg']);
        $msg_type = htmlspecialchars_decode($r['msg_type']);

        if ($msg_type == 'file')
            $msg = "<a href='{$websiteRoot}/uploads/files/" . $r['msg'] . "' download> <img src='{$websiteRoot}/images/download.png' width='25px' height='25px'></a>";

        $final_msg = "";


        if ($r['sender_id'] == $_SESSION['id']) {
            $class .= " me";
            $caret_class = '<i class="triangle-right"></i>';
            $msg .= $caret_class;
        } else {
            $class .= " friend";
            $friend_profile_pic = '<img width="35px" height="35px" src="' . $websiteRoot . '/images/man.png" style="margin-right:5px; float:left;">';
            $caret_class = '<i class="triangle-left"></i>';

            $friend_profile_pic = $friend_profile_pic . $caret_class;
        }




        $str .= '<div style="clear:both; float:left; width:100%">';
        $str .= $friend_profile_pic;
        $str .= "<div class='{$class}' title='{$r['posted']}'>";
        $str .= "<span class='name'><b>{$user_name}</b></span>";
        $str .= "<span style='word-wrap:break-word' class='msgc'>$msg</span>";
        $str .= "</div>";
        $str .= "<span class='short_time'>$short_time</span>";
        $str .= "</div>";
        echo $str;
    }
}

if (!isset($_SESSION['id']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    echo "<script>window.location.reload()</script>";
}
?>


<!--Message Edit, Copy and Delete-->

<!--  Contextmenu -->
<ul id="menu" class="jeegoocontext cm_blue">
    <!--<li id="copy-link"><a href="#copy" id="copy-link">Copy Now</a></li>-->
    <li id="copy-link" class="js-emailcopybtn">Copy Now</li>
    <li class="js-emailcopybtn-edit">Edit</li>
    <li>Delete</li>
    <li>Paste</li> 
</ul> 


<script>
    $(".me").on('mousedown', function(e){
        if( e.button == 2 ) {
            console.log("Right Click");
            
            var me = $(this);
            $(".js-emaillink").html($(this).html());
            $("#js-emaillink-edit").val($(me).next().val());
        }
    });
    
    
    $(function(){
        //        $('.context').jeegoocontext('menu');
        $('.me').jeegoocontext('menu');
        /*
        $('.context').jeegoocontext('menu', {
            data: $(this).html()
        });
         */
    });
    
    
    /**
     * Copy
     */
    $(".js-emailcopybtn").click(function(){
        console.log("copy");
        $("#js-emaillink-edit").val("0");
    });
    
    
    
    var copyEmailBtn = document.querySelector('.js-emailcopybtn');  
    if(copyEmailBtn != null){
        
        
        copyEmailBtn.addEventListener('click', function(event) {
            
            
            // Select the email link anchor text  
            var emailLink = document.querySelector('.js-emaillink');  
            var range = document.createRange();  
            range.selectNode(emailLink);  
            window.getSelection().addRange(range);  
    
            try {  
                // Now that we've selected the anchor text, execute the copy command  
                var successful = document.execCommand('copy');  
                var msg = successful ? 'successful' : 'unsuccessful';  
                console.log('Copy email command was ' + msg);  
            } catch(err) {  
                console.log('Oops, unable to copy');  
            }  
    
            // Remove the selections - NOTE: Should use   
            // removeRange(range) when it is supported  
            window.getSelection().removeAllRanges();  
        });
        
        
        /**
         * End of section
         * Copy
         */
        
        
        /**
         * Edit
         */
        var editEmailBtn = document.querySelector('.js-emailcopybtn-edit');  
        if(editEmailBtn != null){
        
        
            editEmailBtn.addEventListener('click', function(event) {
            
                console.log('edited');
            
                // Select the email link anchor text  
                var emailLink = document.querySelector('.js-emaillink');  
                var range = document.createRange();  
                range.selectNode(emailLink);  
                window.getSelection().addRange(range);  
                
                
                //                var range = document.createRange();
                //                range.selectNode(document.getElementById('js-emaillink'));
                //                window.getSelection().addRange(range);
    
                try {  
                    // Now that we've selected the anchor text, execute the copy command  
                    var successful = document.execCommand('copy');  
                    var msg = successful ? 'successful' : 'unsuccessful';  
                    console.log('Edit command was ' + msg);  
                } catch(err) {  
                    console.log('Oops, unable to edit');  
                }  
    
                // Remove the selections - NOTE: Should use   
                // removeRange(range) when it is supported  
                window.getSelection().removeAllRanges();  
            });
    
        }
        
        /**
         * End of Section
         * Edit
         */
    
    }
</script>

<!--//Message Edit, Copy and Delete-->