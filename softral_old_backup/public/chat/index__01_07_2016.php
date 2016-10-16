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

            <?php include 'chat-container.php'; ?>

        </div>


        <?php include("include/footer.php"); ?>
    </div>








</div>
<!-- CLOSE WRAP -->

<script src="<?= $websiteRoot; ?>js/chat-chat.js"></script><!--Chat-->
<script src="<?= $websiteRoot; ?>js/smiley/emoticons.js"></script> <!--Smiley-->
<!--//Smiley-->

<!-- Copy, Edit and Delete Message  -->
<link href="<?= $websiteRoot; ?>css/skins/cm_blue/style.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript" src="<?= $websiteRoot; ?>js/jquery.jeegoocontext-2.0.0.js"></script>
<!--// Copy, Edit and Delete Message  -->




<!--JavaScript used to call the fileupload widget to upload files--> 
<script src="<?= $websiteRoot; ?>js/fileupload/jquery.ui.widget.js"></script>
<script src="<?= $websiteRoot; ?>js/fileupload/jquery.iframe-transport.js"></script>
<script src="<?= $websiteRoot; ?>js/fileupload/jquery.fileupload.js"></script>
<!--<script src="<?= $websiteRoot; ?>js/fileupload/script.fileupload.js"></script>-->

<script>
    
    // When the server is ready...
    $(function () {
        'use strict';
        // Define the url to send the image data to
        //var url = "uploads/files.php";
        var base_url = "<?php echo $websiteRoot; ?>";
        var url = base_url + "uploads/files.php";
        
        // Call the fileupload widget and set some parameters
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                // Add each uploaded file name to the #files list
                $.each(data.result.files, function (index, file) {
                    // Update Database....
                    // Display Image..
                    
                    var chattype = $("#chattype").val();
                    var sendto = $("#sendto").val();
                    var groupid = $("#groupid").val();
                    //var usertype = $("#usertype").val();
                                        
                    //var dataString = 'name='+file.name+'&chattype='+chattype+'&sendto='+sendto+'&groupid='+groupid+'&usertype='+usertype;
                    var dataString = 'name='+file.name+'&chattype='+chattype+'&sendto='+sendto+'&groupid='+groupid;
                    
                    
                    if(file.error){
                        alert(file.error);
                        $('#progress').hide();
                    }else{
                        $.ajax({
                            type: "POST",
                            url: base_url + 'chat-ajax-process.php',
                            data: dataString,
                            cache: true,
                            success: function(html){
                                if(file.error){
                                    //alert(file.error);
                                    /*
                                alert("aaaaaa");
                                //
                                if(file.error == 'Filetype not allowed'){
                                    bootbox.alert("Filetype not allowed! <br> Only .jpg, .jpeg, .png or .bmp files are allowed", function() {
                                        //Example.show("Hello world callback");
                                    });
                                }
                                else if(file.error == 'File is too big'){
                                    //File is too big
                                    bootbox.alert("File is too big<br> Maximum file size is 2MB", function() {
                                        //Example.show("Hello world callback");
                                    });
                                }
                                else if(file.error == 'The uploaded file exceeds the post_max_size directive in php.ini'){
                                    //File is too big
                                    bootbox.alert("File is too big<br> Maximum file size is 2MB", function() {
                                        //Example.show("Hello world callback");
                                    });
                                }
                                     */
                                }
                                else{
                                    //$("#img-profilepic").attr('src', 'timthumb.php?src=uploads/files/' + file.name);
                                    $('#progress').hide();
                                    //$('#profileimg').val(file.name);
                                    //$('#profileimg_status').text("");
                                }
                            }  
                        });
                    }
                    
                    
                                    
                });
            },
            progressall: function (e, data) {
                // Update the progress bar while files are being uploaded
                $('#progress').show();
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .bar').css('width', progress + '%');
            }
        });
    });
</script>
<!--//JavaScript used to call the fileupload widget to upload files--> 


<style>

    .dropdown.dropdown-lg .dropdown-menu {
        margin-top: -1px;
        padding: 6px 20px;
    }
    .input-group-btn .btn-group {
        display: flex !important;
    }
    .btn-group .btn {
        border-radius: 0;
        margin-left: -1px;
    }
    .btn-group .btn:last-child {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }
    .btn-group .form-horizontal .btn[type="submit"] {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    .form-horizontal .form-group {
        margin-left: 0;
        margin-right: 0;
    }
    .form-group .form-control:last-child {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    /*@media screen and (min-width: 768px) {
        #adv-search {
            width: 500px;
            margin: 0 auto;
        }
        .dropdown.dropdown-lg {
            position: static !important;
        }
        .dropdown.dropdown-lg .dropdown-menu {
            min-width: 500px;
        }
    }*/


    #all-netnoor-user{
        /*display: none;*/
        max-height: 300px;
        overflow-y: scroll;
    }



    .dropdown-menu:before {
        position: absolute;
        top: -7px;
        right: 9px;
        display: inline-block;
        border-right: 7px solid transparent;
        border-bottom: 7px solid #ccc;
        border-left: 7px solid transparent;
        border-bottom-color: rgba(0, 0, 0, 0.2);
        content: '';
    }

    .dropdown-menu:after {
        position: absolute;
        top: -6px;
        right: 10px;
        display: inline-block;
        border-right: 6px solid transparent;
        border-bottom: 6px solid #ffffff;
        border-left: 6px solid transparent;
        content: '';
    }


    /*    .chat-header-menu img:hover{
            width: 35px;
            height: 35px;
        }*/



    /*@media only screen and (max-device-width: 480px) {*/
    /*@media (min-width:281px) and (max-width:481px) {*/ 
    @media (max-width:481px) { 
        .chatbox {
            /*background-color: red;*/
            width: 100%;
        }
        .chatbox-left-panel{
            display: none;
        }
    }

</style>


</body>
</html>