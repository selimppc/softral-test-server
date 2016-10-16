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
  * To get the selected user in user list left side before refresh the list
  */
if (!isset($friend_request_user_id))
    $friend_request_user_id = (!empty($_GET['friend_request_user_id']) ? $_GET['friend_request_user_id'] : 0);
/**
  * To get the selected user in user list left side before refresh the list
  * End Here
  */
   

/**
 * Recent Messages Section
 * ---------------------------------------------------------------------------------------
 */

include_once 'recent-user.php';

/**
 * End of
 * Recent Messages Section
 */




/**
 * My Contacts Section
 * --------------------------------------------------------------------------------------------------------------
 */

include_once 'contact-user.php';



/**
 * End of
 * My Contacts Section
 */




/**
 * Groups Name
 * ------------------------------------------------------------------------------------------------
 */

//include_once 'group-name.php';
/**
 * End of
 * Groups Name
 */


/**
 * Pending Friend Request
 */
//include_once 'pending-user.php';
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

$sql = $dbh->prepare("UPDATE users SET online_status = 'on', last_seen = '$last_seen' WHERE id={$_SESSION['id']}");
$sql->execute();
?>






<!--<script src="<?= $websiteRoot; ?>js/jstz-1.0.5.min.js"></script>Client Timezone-->
<script src="<?= $websiteRoot; ?>js/chat-user.js"></script>