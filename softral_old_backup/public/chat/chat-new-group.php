<?php
include("config.php");
include("include/header.php");

require getcwd() . '/../../bootstrap/autoload.php';
$app = require_once getcwd() . '/../../bootstrap/app.php';
require_once getcwd() . '/../../vendor/autoload.php';
$database = require_once getcwd() . '/../../config/database.php';

use App\Http\Requests;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Http\Models\UserDetails;
use App\Http\Models\Appraisals;
use App\Http\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Cookie\Queue;
use Illuminate\Session\Middleware;

$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

$response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
);
?>

<?php
if (isset(Sentry::getUser()->id)):
    $_SESSION['id'] = Sentry::getUser()->id;
else:
    header('location:' . $websiteOriginalPath);
    exit;
endif;
$select = $dbh->prepare("select * from user_profile where user_id=" . $_SESSION['id']);
$select1 = $dbh->prepare("select * from users where id=" . $_SESSION['id'] . " and online_status='on'");
//$selectData_profile=mysql_fetch_assoc($select);
$select->execute();
$select1->execute();

$result = $select->setFetchMode(PDO::FETCH_ASSOC);
$result1 = $select1->setFetchMode(PDO::FETCH_ASSOC);

$data = $select->fetchAll();
$data1 = $select1->fetchAll();

//if (empty($data1)):
//    header('location:' . $websiteOriginalPath);
//    exit;
//endif;


$_SESSION['first_name'] = $data[0]['first_name'];
$_SESSION['last_name'] = $data[0]['last_name'];
$_SESSION['email'] = $data1[0]['email'];
$_SESSION['avatar'] = $data[0]['avatar'];

$email = $_SESSION['email']; // users table
$first_name = $_SESSION['first_name']; //user_profile table
$last_name = $_SESSION['last_name']; //user_profile table
$avatar = $_SESSION['avatar']; //user_profile table
$id = $_SESSION['id'];  // users table
//$_SESSION['user-name'] = $data[0]['first_name'].' '.$data[0]['last_name'];
?>




<div id="wrap" style='background: rgb(2, 62, 115);'>
    <div class="main">
        <div class="container">

            <!-- Login -->
            <!-- Login finished -->

            <div class="logo">
                <span class="pull-right" style="padding: 6px 27px 3px 4px;">Hello, <?php echo $data[0]['first_name']; ?> |  	 <li class="dropdown" style="display:inline">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu header_menu_profile">
                            <li><a href="<?php echo $websiteOriginalPath; ?>admin/users/profile/self">My Profile</a></li>
                            <li><a href="<?php echo $websiteOriginalPath; ?>">Back to Softral</a></li>

                            <li><a href="<?php echo $websiteOriginalPath; ?>my-workboard">My Workboard</a></li>	  
                        </ul>
                    </li>

                    | <a href="<?php echo $websiteOriginalPath; ?>user/logout"> Logout</a>
                </span><br><a href="<?php echo $websiteOriginalPath; ?>" style="margin-left: 303px;"><h2>SOFTRAL<span style="
                                                                                                                      width: 23px;
                                                                                                                      font-size: 17px;
                                                                                                                      font-weight: bolder;
                                                                                                                      ">&reg;</span></h2></a><br><span>Softral is Software Central where you can hire freelancers and trade software</span><br><br>
            </div>
            <div class="content">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="<?php echo $websiteOriginalPath; ?>">Home<span class="sr-only">(current)</span></a></li>
                                <li><a style="margin:0px 5px 0px 0px" href="<?php echo $websiteOriginalPath; ?>pages/about-us">About Us</a></li>
                                 <!--<li><a style='margin:0px 0px 0px -20px' href="<?php echo $websiteOriginalPath; ?>shome">Freelancer Area</a></li>-->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">				 								Jobs<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">

                                        <li><a href="<?php echo $websiteOriginalPath; ?>add-job">Post a Job</a></li>
                                        <li><a href="<?php echo $websiteOriginalPath; ?>shome">Search for Job</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo $websiteOriginalPath; ?>chat/index.php?page=8">Chat</a></li>
                                <li><a href="<?php echo $websiteOriginalPath; ?>my_runningjobs">My Softral</a></li>

                                <li class="dropdown" style="display:inline"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Pages
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu header_menu_profile">
                                        <li> <a href="<?php echo $websiteOriginalPath; ?>pages/help">Escrow Contracts</a></li>
                                        <li> <a href="<?php echo $websiteOriginalPath; ?>pages/privacy-policy">Privacy Policy</a></li>
                                        <li> <a href="<?php echo $websiteOriginalPath; ?>pages/plans-fees-1">Plans &amp; Fees</a></li>

                                        <li> <a href="<?php echo $websiteOriginalPath; ?>chat/index.php?page=8">Chat</a></li>
                                    </ul></li>



                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>
    </div>


    <!--    <div class="page-content padding-small" id="home-container">
            <div class="container">
               
            </div>
    
        </div>-->


    <div class="container">
        <div class="gallary">

            <?php //include 'chat-container.php'; ?>

            <div class="chat">

                <div class="row content">
                    <!--<div class="chatbox-left-panel col-xs-3">-->
                    <div class="chatbox-left-panel col-xs-5 col-md-3 col-sm-4 col-lg-3">
                        <!--                        <div class="chat-header chattingwith">
                                                    <a href='<?= $websiteRoot ?>chat.php'>Home</a>
                                                    <a href='<?= $websiteRoot ?>index.php'>Home</a>
                                                </div>
                                                <div class="users col-xs-12">
                        <?php
                        echo "<h4 class='online_green'>Group Name</h4>";
                        $sql = $dbh->prepare("SELECT grp_name FROM chat_usergroup where created_by = '" . $_SESSION['id'] . "'");
                        $sql->execute();

                        while ($r = $sql->fetch()) {

                            $profile_pic = "<img width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/grp.png'>";
                            $add_user_pic = "<img width='20px' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/add_user_group-icon.gif'>";

                            echo "<div class='grp_name'>    
                                            <a href='{$websiteRoot}chat-add-user.php?grp_name={$r['grp_name']}'>$profile_pic {$r['grp_name']} </a>
                                         </div>";
                        }
                        ?>
                        
                                                </div>-->



                        <div class="chat-header chattingwith">

                            <div class="row">
                                <div class="col-md-12">

                                    <?php
                                    if (!empty($avatar))
                                        echo '<img width="35px" height="35px" style="margin-right:5px;" src="data:image/jpeg;base64,' . base64_encode($avatar) . '"/>';
                                    else
                                        echo '<img width="35px" height="35px" style="margin-right:5px;" src="' . $websiteRoot . 'images/man.png">';
                                    ?>


                                    <?php echo $first_name . " " . $last_name; ?>
                                    <p class="hide">User Type  <input type="text"  value="" name="usertype" class="form-control" id="usertype"></p>

                                    <?php //echo "<br>(" . $id . ")" . $email; ?>
                                    <a href="logout.php">Logout</a>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group" id="adv-search" style="margin-top:10px; margin-bottom: 10px">
                                        <input id="chatbox-left-panel-search" type="text" class="form-control" placeholder="Search Group" />
                                        <div class="input-group-btn">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <p class="chat-header-menu">
                                <span style="margin-right:15px" class="home" title="Home">
                                    <a href="<?= $websiteRoot ?>index.php"><img height="20" wdith="20" src="<?php echo $websiteRoot; ?>images/home_icon.gif"></a>
                                </span>
                            </p>


                            <!--<div class="all-conversation hide" id="all-netnoor-user"></div>-->


                        </div>

                        <div class="row"> 
                            <div class="users col-xs-12">
                                <div id="all-groups">
                                    <?php
                                    echo "<h4 class='online_green'>Group Name</h4>";
                                    $sql = $dbh->prepare("SELECT grp_name FROM chat_usergroup where created_by = '" . $_SESSION['id'] . "'");
                                    $sql->execute();

                                    while ($r = $sql->fetch()) {

                                        $profile_pic = "<img width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/grp.png'>";
                                        $add_user_pic = "<img width='20px' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/add_user_group-icon.gif'>";

                                        echo "<div class='grp_name'>    
                                            <a href='{$websiteRoot}chat-add-user.php?grp_name={$r['grp_name']}'>$profile_pic {$r['grp_name']} </a>
                                         </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!--<div class="chatbox col-xs-8">-->
                    <div class="chatbox col-xs-7 col-sm-8 col-md-9 col-lg-9">

                        <div id="friend-request" class="chat-header friend-header">
                            <h4 class='online_green'>Create a new group</h4>
                        </div>

                        <div class='msgs'>
                            <br><br>
                            <?php
                            if (isset($_POST['grp_name'])) {

                                /**
                                 * If User submited the create new group information
                                 */
                                $grp_name = htmlspecialchars($_POST['grp_name']);

                                $sql = $dbh->prepare("SELECT grp_name FROM chat_usergroup WHERE grp_name=?");
                                $sql->execute(array($grp_name));
                                if ($sql->rowCount() != 0) {
                                    //If Group name already exist
                                    $ermsg = "<h2 class='error'>Group Name Exist
                                        </h2><a href='chat-new-group.php'>Try another Name</a>";
                                    echo $ermsg;
                                } else {

                                    $user = array();
                                    $user[] = $_SESSION['id'];
                                    $user = serialize($user);


                                    $sql = $dbh->prepare("INSERT INTO chat_usergroup (created_by,grp_name, users) VALUES (?,?,?)");
                                    $sql->execute(array($_SESSION['id'], $grp_name, $user));

                                    header("Location:chat-add-user.php?grp_name=$grp_name");
                                    exit();
                                }

                                /**
                                 * End of section
                                 * If User submited the create new group information
                                 */
                            } else {
                                //echo "not submitted";
                                ?>

                                <p>You must provide a group name for group chatting. This name will be visible to all other users in this group.</p>
                                <form role="form" class="form-horizontal" action="chat-new-group.php" method="POST">
                                    <div class="input-group">
                                        <input type="text" value="" name="grp_name" placeholder="Group Name" class="form-control" id="grp_name">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" type="submit">Create</button>
                                        </span>
                                    </div>

                                </form>
                            <?php } ?>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        <?php include("include/footer.php"); ?>
    </div>








</div>
<!-- CLOSE WRAP -->