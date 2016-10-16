<?php
//include("config.php");
//include("include/header.php");



include_once 'config.php';
include_once 'include/header.php';


if (!isset($_SESSION['id'])) {
    header('Location:login.php');
    exit();
}
?>

<?php
$email = $_SESSION['email']; // users table
$first_name = $_SESSION['first_name']; //user_profile table
$last_name = $_SESSION['last_name']; //user_profile table
$avatar = $_SESSION['avatar']; //user_profile table
$id = $_SESSION['id'];  // users table
?>

<div id="wrap">
    <div class="clearfix"></div>


    <!--    <div class="page-content padding-small" id="home-container">
            
        </div>-->
    
    
    <div class="container">
        <?php include 'chat-container.php'; ?> 
    </div>



    <?php //include("footer.php");  ?>
</div>
<!-- CLOSE WRAP -->


<script src="<?= $websiteRoot; ?>js/chat-chat.js"></script><!--Chat-->
<script src="<?= $websiteRoot; ?>js/smiley/emoticons.js"></script> <!--Smiley-->


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
    });
</script>
<!--//JavaScript used to call the fileupload widget to upload files--> 


</body>
</html>