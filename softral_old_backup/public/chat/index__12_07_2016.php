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
    header('location:' . $websiteOriginalPath . '/login');
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
if (isset($_GET['invite_id'])):
    $invite_select = $dbh->prepare("select * from user_profile where user_id=" . $_GET['invite_id']);
    $invite_select->execute();
    $invite_select_data = $invite_select->fetchAll();
endif;

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
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Softral
                            <span class="caret"></span></a>
                        <!--                        <ul class="dropdown-menu header_menu_profile">
                                                    <li><a href="<?php echo $websiteOriginalPath; ?>admin/users/profile/self">My Softral</a></li>
                                                    <li><a href="<?php echo $websiteOriginalPath; ?>">Back to Softral</a></li>
                        
                                                    <li><a href="<?php echo $websiteOriginalPath; ?>my-workboard">My Workboard</a></li>	  
                                                </ul>-->


                        <ul class="dropdown-menu header_menu_profile">
                            <li><a href="<?php echo $websiteOriginalPath; ?>admin/users/profile/self">My Profile</a></li>
                            <li><a href="<?php echo $websiteOriginalPath; ?>user/profile/sibbir">View Profile</a></li>
                            <li><a href="<?php echo $websiteOriginalPath; ?>my-proposals">My Proposals</a></li>
                            <li><a href="<?php echo $websiteOriginalPath; ?>my_savejobs">Save Jobs</a></li> 
                            <li><a href="<?php echo $websiteOriginalPath; ?>my_saveusers">Save Users</a></li> 
                            <li><a href="<?php echo $websiteOriginalPath; ?>my_jobs">My Jobs</a></li> 
                            <li><a href="<?php echo $websiteOriginalPath; ?>my_contracts">My Contracts</a></li> 

                            <li><a href="<?php echo $websiteOriginalPath; ?>admin/financial/account">My Financial Accounts</a></li> 

                            <!--<li><a href="http://softral.com/my_ads">My Classifieds</a></li> -->
                            <li><a href="<?php echo $websiteOriginalPath; ?>my-workboard">My Workboard</a></li>	  
                        </ul>


                    </li>

                    | <a href="<?php echo $websiteOriginalPath; ?>user/logout"> Logout</a>
                </span><br><a href="<?php echo $websiteOriginalPath; ?>" style="margin-left: 303px;"><h2>SOFTRAL
<!--                        <span style="
                                                                                                                      width: 23px;
                                                                                                                      font-size: 17px;
                                                                                                                      font-weight: bolder;
                                                                                                                      ">&reg;</span>-->
                    
                    <span style="width: 23px;font-size: 17px;font-weight: bolder;">&trade;</span>
                    </h2></a><br><span>Softral is Software Central where you can hire freelancers and trade software</span><br><br>
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
                                <li><a href="<?php echo $websiteOriginalPath; ?>">Home<span class="sr-only">(current)</span></a></li>
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
                                <li class="active"><a href="<?php echo $websiteOriginalPath; ?>chat/index.php?page=8">Chat</a></li>
                                <li><a href="<?php echo $websiteOriginalPath; ?>all-members">Members</a></li>

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
<?php
if (isset($_GET['invite_id'])):
    $invite_id = $_GET['invite_id'];
    ?>
    <input type='hidden' id='invite_id' value='<?php echo $invite_id; ?>' />
    <script>
        $(function () {
            $("#chatbox-left-panel-search").focus();
            $('#chatbox-left-panel-search').val('<?php echo $invite_select_data[0]['first_name']; ?>');	
            $('#chatbox-left-panel-search').keyup();
        });
    </script>
<?php endif; ?>
<script src="<?= $websiteRoot; ?>js/chat-chat.js"></script><!--Chat-->
<script src="<?= $websiteRoot; ?>js/smiley/emoticons.js"></script> <!--Smiley-->
<!--//Smiley-->

<!-- Copy, Edit and Delete Message  -->
<link href="<?= $websiteRoot; ?>css/skins/cm_blue/style.css" rel="Stylesheet" type="text/css" />
<script type="text/javascript" src="<?= $websiteRoot; ?>js/jquery.jeegoocontext-2.0.0.js"></script>
<!--// Copy, Edit and Delete Message  -->

<script src="<?= $websiteRoot; ?>js/jstz-1.0.5.min.js"></script><!--Client Timezone-->


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
        //var base_url = "<?php echo $websiteRoot; ?>";
        //var url = base_url + "uploads/files.php";
        
        
        //alert(url);
        
        // I am using the main softral.com/chat/uploads/ folder not the softral.com/chat/test/uplaods/
        var url = location.protocol + "//" + document.domain + "/" + location.pathname.split('/')[1] + "/";
        var url = url + "uploads/files.php";
        
        
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
                        //alert(file.error);
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
		
        $(document).on("click","#netnoor-user-<?php if (isset($_GET['invite_id'])):echo $_GET['invite_id'];
endif; ?>", function(){
			
            $(".request").addClass("hide");
            $("#friend-request").removeClass("hide");


            $("#send-box").removeClass("hide");
            $("#chattype").val('individual');
            $("#sendto").val(($(this).find("label").text()));
            $("#groupid").val("");
                
                
            $("#friend_rquest_user_name").html(($(this).find(".username").text()));
            $("#friend_request_user_id").val(($(this).find(".userid ").text()));
                
                
            var friend_staus = $(this).find(".friend-status").text();
            var friend_request_type = $(this).find(".friend-request-type").text();
               
                
            /** Clear Message box*/
            //$(".msgs").html("");
            //$("#msg_form").addClass("hide");
                
            /**
             * End of Section
             * Clear Message box
             */

                
            if(friend_staus == ''){
                /**
                 * All New Netnoor Users or the netnoor user which are I sent request and not accept till now
                 */
                    
                $(".request").addClass('hide');
                $("#new-request").removeClass('hide');
                    
            }else if(friend_staus == 'requested' && friend_request_type == 'sent_request'){
                    
                $(".request").addClass('hide');
                $("#request-sent").removeClass('hide'); // Cancel Request button
            }else if(friend_staus == 'requested' && friend_request_type == 'pending_request'){
                /**
                 * Pending request, All friend request come from netnoor
                 */
                $(".request").addClass("hide");
                    
                $("#reponse-friend-request").removeClass("hide");   // Accpet and Reject Button
            }
            else if(friend_staus == 'cancel_request'){
                /**
                 * All Netnoor user which are I have sent request and cancel the request again
                 */
                console.log(friend_staus);
                $(".request").addClass('hide');
                $("#request-agian").removeClass('hide');
                    
            }else if(friend_staus == 'accepted'){
                /**
                 * When Netnoor accepet my Request
                 * 
                 * Then load the conversation with frined_id
                 * 
                 */
                console.log(friend_staus);
            }else if(friend_staus == 'rejected'){
                /**
                 * When Netnoor user Reject my Request
                 */
                console.log(friend_staus);
            }else{
                $(".request").addClass('hide');
                $("#request-sent").removeClass('hide');
            }
            load_new_stuff();
        });
    });
</script>
<!--//JavaScript used to call the fileupload widget to upload files--> 


</body>
</html>