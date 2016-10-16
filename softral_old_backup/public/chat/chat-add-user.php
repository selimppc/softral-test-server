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
                        <div class="chat-header chattingwith">
                            <!--<a href='<?= $websiteRoot ?>index.php'>Home</a>-->
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



                        </div>

                        <div class="row"> 
                            <div class="users col-xs-12">
                                <div id="all-groups">
                                    <?php
                                    $add_user_pic = "<img width='20px' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/add_user_group-icon.gif'>";
                                    echo "<h4 class='online_green'>Group Name 
                                    <a href='{$websiteRoot}chat-new-group.php'>$add_user_pic</a>
                                  </h4>";
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


                        <!--                    <div class="users col-xs-12">
                        <?php
                        $add_user_pic = "<img width='20px' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/add_user_group-icon.gif'>";
                        echo "<h4 class='online_green'>Group Name 
                                    <a href='{$websiteRoot}home/chat-new-group'>$add_user_pic</a>
                                  </h4>";
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
                    </div>

                    <div class="chatbox col-xs-9" style="height:auto;">

                        <div id="friend-request" class="chat-header friend-header">
                            <img id="friend_rquest_user_prof_pic" width="35px" height="35px" style="margin-right:5px;" src="<?php echo $websiteRoot; ?>images/grp.png" />
                            <p>
                                <span id="friend_rquest_user_name"> <?= $_GET['grp_name'] ?></span>
                                <input type="text" name="friend_request_user_id" id="friend_request_user_id" class="hide" value="">
                            </p>
                            <div id="reponse-friend-request" class="request">
                                </hr>
                                <h4 class='online_green'>The group members are the following</h4>
                                <?php
                                $sql = $dbh->prepare("SELECT  users FROM chat_usergroup where grp_name = '" . $_GET['grp_name'] . "'");
                                $sql->execute();
                                while ($r = $sql->fetch()) {
                                    $users = unserialize($r['users']);
                                }


                                foreach ($users as $user) {
                                    $delete_user_icon = "<img width='20px' title='Delete this user' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/delete-user.png'>";
                                    $sql = $dbh->prepare("SELECT first_name, last_name FROM user_profile where user_id = $user");
                                    $sql->execute();
                                    while ($r = $sql->fetch()) {
                                        echo "<span class='grp_member'> {$r['first_name']} {$r['last_name']} $delete_user_icon</span>";
                                    }
                                }
                                echo "<h4 class='online_green'>Add Members from the following list</h4>";
                                ?>


                            </div>
                        </div>

                        <div class='msgs'>


                            <?php
                            //$sql = $dbh->prepare("SELECT user_id, first_name, last_name, avatar FROM user_profile where user_id not in('" . $_SESSION['id'] . "')");
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
                            ?>
                            <table border="1" cellpadding="10" style="background-color: #FFF;">
                                <tr class="even_row">

                                    <?php
                                    $count_column = 1;
                                    $count_row = 1;

                                    while ($r = $sql->fetch()) {

                                        if (!in_array($r['user_id'], $users)) {
                                            //$profile_pic = "<img width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";
                                            //$avatar = $r['avatar'];
                                            $avatar = $r['conversation_avatar'];
                                            if (!empty($avatar))
                                                $profile_pic = '<img width="35px" height="35px" style="margin-right:5px;" src="data:image/jpeg;base64,' . base64_encode($avatar) . '"/>';
                                            else {
                                                // TODO@ Check Gender for default Profile Picture
                                                $profile_pic = "<img width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";
                                            }


                                            $add_user_icon = "<img width='20px' title='Add this user' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/add-user-icon.png'>";
                                            //$str = "<div>$profile_pic {$r['first_name']} {$r['last_name']}
                                            $str = "<div>$profile_pic {$r['conversation_first_name']} {$r['conversation_last_name']}
                                                        <span class='addusergroup'>
                                                            <input type='text' class='grp_name hide' name='grp_name' value='{$_GET['grp_name']}'>
                                                            <input type='user' class='user hide' name='user' value='{$r['user_id']}'>                                                        
                                                            $add_user_icon
                                                        </span>
                                                </div>";
                                            //$str .=  "<div class='grp_name'>{$r['grp_name']} </div>";


                                            if ($count_column % 2 == 0) {

                                                $class_row = "";
                                                if ($count_row % 2 == 0) {
                                                    $class_row = "even_row";
                                                }
                                                ?><td><?php echo $str ?></td></tr><tr class="<?= $class_row ?>"><?php
                                    $count_row++;
                                } else {
                                                ?><td><?php echo $str ?></td><?php
                                }

                                $count_column++;
                            }
                        }
                                    ?>

                            </table>

                        </div>
                    </div>

                </div>

            </div>

        </div>


        <?php include("include/footer.php"); ?>
    </div>








</div>
<!-- CLOSE WRAP -->


<script src="//code.jquery.com/jquery-latest.js"></script>
<script>
    $(".addusergroup").on("click", function(){
        var grp_name = ($(this).find(".grp_name").val());
        var user = ($(this).find(".user").val());
        var baseurl = "<?php echo $websiteRoot ?>";
        $.ajax({
            type: "GET",
            url: baseurl + "chat-save-new-user.php",
            data: {grp_name:grp_name, user:user},
            cache: false,
            success: function(data){
                location.reload();
            }
        });
    });
</script>


<style>
    .even_row{
        background-color: #f6f6f6;
    }

    table, th, td {
        border: 1px solid #e1f2fe;
    }
    table { 
        border-spacing: 10px;
        border-collapse: separate;
    }
</style>
