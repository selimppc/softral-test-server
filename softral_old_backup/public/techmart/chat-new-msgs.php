<?php
include("config.php");
//echo $_GET['last_message'];



//date_default_timezone_set('America/Chicago');
//date_default_timezone_set('Asia/Kolkata');
//$timezone = "America/Chicago";
//$timezone = "Asia/Kolkata";
$timezone = $_POST['timezone'];




$question_id = $_POST['Question'];
$sendto = $_POST['sendto'];
//$groupid = $_POST['groupid'];

$last_message = $_POST['last_message'];


//$user_prof_pic_url = $_POST['user_prof_pic_url'];


    $sql = $dbh->prepare("SELECT id, sender_id, reciever_id, msg, msg_type, posted
                                FROM tech_messages
                                where sender_id in('" . $_SESSION['id'] . "', '$sendto')
                                and reciever_id in('" . $_SESSION['id'] . "', '$sendto')
                                and posted > '$last_message'");

    
    
    
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

            //$str.='<div style="clear:left; width 500px;text-align: center; font-weight: bold; margin: 10px 0px; color:rgb(134,192,229);"> ' . date("l, F j, Y", strtotime($time)) . '</div>';
        }

        /**
         * End of
         * Timing Heading With Day and Date:
         */
        $class = "msg";
        $user_name = ""; //$user_name = "Me :";
        $friend_profile_pic = "";
//        $caret_class = "";


        $m_id = htmlspecialchars_decode($r['id']);
        $msg = htmlspecialchars_decode($r['msg']);
        $msg_type = htmlspecialchars_decode($r['msg_type']);




        $final_msg = "";
        if ($r['sender_id'] == $_SESSION['id']) {
            $class .= " me";

            if ($msg_type == 'file') {
                
            } else {
//                $caret_class = '<i class="triangle-right"></i>';
//                $msg .= $caret_class;
            }
        } else {
            $class .= " friend";

            
            
            
            //$friend_profile_pic = '<img class="thumb-prof-pic" width="35px" height="35px" src="'.$user_prof_pic_url.'" style="margin-right:5px; float:left;">';
            $friend_profile_pic = '<img class="thumb-prof-pic" width="35px" height="35px" src="' . $websiteRoot . 'images/man.png" style="margin-right:5px; float:left;">';


//            $avatar = $r['avatar'];
//            if (!empty($avatar))
//                $friend_profile_pic = '<img class="thumb-prof-pic" width="35px" height="35px" src="data:image/jpeg;base64,' . base64_encode($avatar) . '" style="margin-right:5px; float:left;">';
//            else
//                $friend_profile_pic = '<img class="thumb-prof-pic" width="35px" height="35px" src="' . $websiteRoot . '/images/man.png" style="margin-right:5px; float:left;">';


//            $caret_class = '<i class="triangle-left"></i>';

            //$friend_profile_pic = $friend_profile_pic . $caret_class;
            if ($msg_type == 'file') {
                $friend_profile_pic = $friend_profile_pic;
            } else {
//                $friend_profile_pic = $friend_profile_pic . $caret_class;
                $friend_profile_pic = $friend_profile_pic;
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

        } else {



        //$str .= '<div class="col-xs-10 col-sm-10 col-md-12">';
        $str .= '<div class="col-xs-12 col-sm-12 col-md-12">';
        $str .= $friend_profile_pic;
        $str .= "<div class='{$class}' title='{$r['posted']}'>";
        //$str .= "<span class='name'><b>{$user_name}</b></span>";
        $str .= "<span style='word-wrap:break-word' class='msgc'>$msg</span>";
        $str .= "</div>";
        $str .= "<input type='hidden' class='mess_id' value='$m_id'>";
        $str .= "<span class='short_time'>$short_time</span>";
        $str .= "</div>";

        echo $str;
    }
    }

?>

