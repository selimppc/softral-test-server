<?php
//include("config.php");
//include("include/header.php");

include_once 'config.php';
include_once 'include/header.php';

 require getcwd() . '/../../../bootstrap/autoload.php';
  $app = require_once getcwd() . '/../../../bootstrap/app.php';
  require_once getcwd() . '/../../../vendor/autoload.php';
  $database = require_once getcwd() . '/../../../config/database.php';

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

  $id = $app['encrypter']->decrypt($_COOKIE[$app['config']['session.cookie']]);
  $test=$app['session']->driver()->setId($id);
  $app['session']->driver()->start();
  
  if(isset(Sentry::getUser()->id)):
			$_SESSION['id'] = Sentry::getUser()->id;
		else:
			header('location:'.$websiteOriginalPath);
			exit;
		endif;
?>

<?php

//$_SESSION['id'] = 42;
//$_SESSION['user-name'] = "Sibbir 42";
$select=$dbh->prepare("select * from user_profile where user_id=".$_SESSION['id']);
$select1=$dbh->prepare("select * from users where id=".$_SESSION['id']." and online_status='on'");
$select->execute();
$select1->execute();
$result = $select->setFetchMode(PDO::FETCH_ASSOC); 
$result1 = $select1->setFetchMode(PDO::FETCH_ASSOC); 
$data=$select->fetchAll();
$data1=$select1->fetchAll();


$_SESSION['first_name']=$data[0]['first_name'];
$_SESSION['last_name']=$data[0]['last_name'];
$_SESSION['email']=$data1[0]['email'];
$_SESSION['avatar']=$data[0]['avatar'];

$email = $_SESSION['email']; // users table
$first_name = $_SESSION['first_name']; //user_profile table
$last_name = $_SESSION['last_name']; //user_profile table
$avatar = $_SESSION['avatar']; //user_profile table
$id = $_SESSION['id'];  // users table
?>

<div id="wrap">
    <div class="clearfix"></div>
    <div class="page-content padding-small" id="home-container">
        <div class="container">
            <div class="chat md-column col-md-12">
                <div class="row">

                </div>
                <div class="row">
                    <div class="chatbox-left-panel col-xs-3">
                        <div class="chat-header chattingwith">

                            <div class="row">
                                <div class="col-md-12">

                                    <?php
                                    if (!empty($avatar))
                                        echo '<img width="35px" height="35px" style="margin-right:5px;" src="data:image/jpeg;base64,' . base64_encode($avatar) . '"/>';
                                    else
                                        echo '<img width="35px" height="35px" style="margin-right:5px;" src="'. $websiteRoot. 'images/man.png">';
                                    ?>
                                    

                                    <?php echo $first_name . " " . $last_name; ?>
                                    <p class="hide">User Type  <input type="text"  value="" name="usertype" class="form-control" id="usertype"></p>
                                    <!--<img width="16px" height="16px" style="margin-right:5px;" src="<?= $websiteRoot ?>images/active.png">--> 

                                    <?php //echo "<br>(" . $id . ")" . $email; ?>
                                    <a href="logout.php">Logout</a>
                                </div>
                            </div>



                            <div class="row">
                                <!--<input id="chatbox-left-panel-search" type="text" name="text-info" value="" placeholder="Search" style="padding: 4px 12px; border: 1px solid #b4b4b4; border-radius:6px; width:100% !important; margin-top: 11px;">-->
<!--                                <input class="col-xs-9" id="chatbox-left-panel-search" type="text" name="text-info" value="" placeholder="Search" style="padding: 4px 12px; border: 1px solid #b4b4b4; border-radius:6px; margin-top: 11px;">
                                <select id="search_from" name="search_from" class="col-xs-3" style="padding: 7px 12px; border: 1px solid #b4b4b4; border-radius:6px; margin-top: 11px;">
                                    <option value="softral_db">Netnoor Directory</option>
                                    <option value="my_contacts">My Contacts</option>
                                </select>-->


                                <div class="col-md-12">
                                    <div class="input-group" id="adv-search" style="margin-top:10px; margin-bottom: 10px">
                                        <input id="chatbox-left-panel-search" type="text" class="form-control" placeholder="Search from Softral Directory" />
                                        <div class="input-group-btn">
                                            <div class="btn-group" role="group">
                                                <div class="dropdown dropdown-lg">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                        <form class="form-horizontal" role="form">
                                                            <div class="form-group">
                                                                <label for="filter">Search in</label>
                                                                <select id="search_from" name="search_from" class="form-control">

                                                                    <option value="softral_db" selected>Softral Directory</option>
                                                                    <option value="my_contacts">My Contacts</option>
                                                                </select>
                                                            </div>
                                                            <!--                                                            <div class="form-group">
                                                                                                                            <label for="contain">Author</label>
                                                                                                                            <input class="form-control" type="text" />
                                                                                                                        </div>-->
                                                            <!--                                                            <div class="form-group">
                                                                                                                            <label for="contain">Contains the words</label>
                                                                                                                            <input class="form-control" type="text" />
                                                                                                                        </div>
                                                                                                                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>-->
                                                        </form>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
<!--                            <p class="chat-header-menu">
                                <span class="home">Home</span> |
                                <span class="recent">Recent</span> |
                                <span class="contacts">Contacts</span>
                                <span class="groups">Groups</span> |
                                <span class="pending-requests">Pending Request<sup id="no-of-pending-request">*</sup></span>
                                <span class="pending-requests" title="Pending Request" id="no-of-pending-request"></span>
                            </p>-->

                            <p class="chat-header-menu">
                                <span style="margin-right:15px" class="home" title="Home"><img height="20" wdith="20" src="<?php echo $websiteRoot; ?>images/home_icon.gif"></span>
                                <!--<span class="recent" title="Recent"><img src="<?php echo $websiteRoot; ?>images/chat-circle-blue-128.png" wdith='25' height='25'></span> |-->
                                <span style="margin-right:15px" class="recent" title="Recent Messages"><img height="20" wdith="20" src="<?php echo $websiteRoot; ?>images/recent_message.png"></span>
                                <span style="margin-right:15px" class="contacts" title="My Contacts"><img height="20" wdith="20" src="<?php echo $websiteRoot; ?>images/my_contacts.png"></span>
                                <!--<span style="margin-right:15px" class="groups" title="My Groups"><img src="<?php echo $websiteRoot; ?>images/grp.png" wdith='25' height='25'></span>-->
                                <!--<span class="pending-requests" title="Pending Request"><img src="<?php echo $websiteRoot; ?>images/add_user.png" wdith='25' height='25'><sup style="color:red" id="no-of-pending-request"></sup></span>-->
                                <span style="margin-right:15px" class="pending-requests" title="Pending Request" id="no-of-pending-request"></span>
                            </p>



                            <!--<div class="col-xs-12" id="all-netnoor-user"></div>-->

                            <div class="all-conversation hide" id="all-netnoor-user"></div>


                        </div>
                        <div class="row"> 
                            <div class="users col-xs-12">
                                <!--<div class="users">-->
                                <?php $usertype = 'recent'; ?>
                                <?php include("chat-users.php"); ?>
                            </div>
                        </div>
                    </div>


                    <div class="chatbox col-xs-9">
                        <?php
                        if (isset($_SESSION['id'])) {
                            include("chat-chatbox.php");
                        } else {
                            //IF user is not logedin 
                            header('Location:' . $websiteRoot);
                            exit();
                        }
                        ?>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <?php //include("footer.php"); ?>
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


</style>


</body>
</html>