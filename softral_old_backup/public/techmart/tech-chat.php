<?php

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


//$supporter_id = $_GET['supporter_id'];
$user_type= $_GET['user_type'];
$chat_with= $_GET['chat_with'];
$question_id = $_GET['question_id'];


?>

<div id="wrap">
    <div class="clearfix"></div>

    <div class="container">
        <?php include 'chat-container.php'; ?> 
    </div>



    <?php //include("footer.php");  ?>
</div>
<!-- CLOSE WRAP -->

<script src="<?= $websiteRoot; ?>js/chat-chat.js"></script>
<script src="<?= $websiteRoot; ?>js/smiley/emoticons.js"></script> <!--Smiley-->

<script src="<?= $websiteRoot; ?>js/chat-send-message.js"></script>
<script src="<?= $websiteRoot; ?>js/jstz-1.0.5.min.js"></script><!--Client Timezone-->
<script>
$(document).ready(function(){
 
        var chat_with = "<?php echo $chat_with?>";
        var question_id = "<?php echo $question_id; ?>";

        var timezone = jstz.determine();
        $(".msgs").load(base_url + "tech-msg.php",{ 
            chat_with: chat_with,
            question_id: question_id,
             timezone: timezone.name()
        },function(){
            if(localStorage['lpid']!=$(".msgs .msg:last").attr("title")){
                scTop();
            }
        });
        
        
        
        $.ajax(base_url + "tech-load-question.php?question_id=" + question_id, {
              success: function(response) {
                 var json = $.parseJSON(response);
                 //console.log(json);
                 //console.log(json[0].id);
                 
                 $('#question').html('Question: ' + json[0].question);
                 //$('#question_id').val(json[0].id);
                 //$('#client_id').val(json[0].client_id);
                 //$('#start-chat').html('<button class="btn btn-success">Start converstion</button>');
                 //clearInterval(interval); 
              },
              error: function() {
                 //$('#notification-bar').text('An error occurred');
              }
           });
        
        
        
        
});


setInterval(function(){
    //If User sleected for Chatting then only run this function...
    load_new_messasges();
//},5000);
//},1500);    // Changed on 30/08/2016  so that the new maagesses shown on chat box faster
},1500);


function load_new_messasges(){
    console.log('chat-chat.js load_new_messages()');
    localStorage['lpid']=$(".msgs .msg:last").attr("title");
    //console.log(localStorage['lpid']);
    
    var timezone = jstz.determine();
    //alert(timezone.name());
    
    var last_message = $(".msgs .msg:last").attr("title");
    
    //console.log(last_message);
    
    var Question = $("#Question").val();
    
    var sendto = $("#sendto").val();
    //var groupid = $("#groupid").val();
    //var usertype = $("#usertype").val();

    //var user_prof_pic_url = $("#friend_rquest_user_prof_pic").attr('src');
    
    if(last_message != null){
        
        /**
         * IF conversation blank and at that time friend sents some message then the new message will not display.. beacause last_message is null
         */
    
        if(sendto != '' || groupid != ''){
        
            $.post(base_url + "chat-new-msgs.php",{ 
                Question: Question,
                sendto: sendto,
                //user_prof_pic_url: user_prof_pic_url,
                //groupid: groupid,
                //usertype: usertype,
                last_message: last_message,
                timezone: timezone.name()
            },function(data) {
                //$(".msgs").html(data);
                
                if($.inArray(localStorage['lpid'], arr) < 0) {
                    $(".msgs").append(data);
                    
                    
                    /**
                       * Remove the duplicate Message in chatbox
                       */
                    var seen = {};
                    $('div.msgs input.mess_id').each(function() {
                        //var txt = $(this).text();
                        var txt = $(this).val();
                        if (seen[txt])
                            $(this).parent().remove();
                        else
                            seen[txt] = true;
                    });


                /**
                 * Remove the duplicate Message in chatbox
                 * End Section
                 */
                    
                } else {
                    return false;
                }
                
            
                if(localStorage['lpid']!=$(".msgs .msg:last").attr("title")){
                    arr.push(localStorage['lpid']);
                    scTop();
                }
            });
        }
    }else{
    /**
         * IF conversation blank and at that time friend sents some message then 
         * the new message will display here
         */
        
        
    //load_all_messasges();
        
        
    }
}



var stop_job = setInterval(function(){
        //chek_new_job_assign();
        chek_stop_job();
    },1000);
    
    //function chek_new_job_assign(){
    function chek_stop_job(){
//        $.ajax(base_url + "tech-new-job-assign.php", {
//              success: function(response) {
////                 console.log(response);
////                 var json = $.parseJSON(response);
////                 console.log(json);
////                 console.log(json[0].id);
////                 
////                 $('#question').html('Question: ' + json[0].question);
////                 $('#question_id').val(json[0].id);
////                 $('#client_id').val(json[0].client_id);
////                 $('#start-chat').html('<button class="btn btn-success">Start converstion</button>');
////                 clearInterval(interval); 
//              },
//              error: function() {
//                 //$('#notification-bar').text('An error occurred');
//              }
//           });
           var user_type = "<?php echo $user_type;?>";
           var question_id = "<?php echo $question_id;?>";
           
            $.ajax(base_url + "tech-stop-job.php?question_id="+question_id, {
            success: function(supporter_id) {
               if(supporter_id > 0){
                  clearInterval(stop_job);
                  if( user_type=='free'){
                        //header("location:tech-free-review.php?question_id="+question_id);
                        //exit();

                        window.location.replace(base_url + "tech-free-review.php?question_id="+question_id);
                    }else{

                        window.location.replace(base_url + "tech-client-review.php?question_id="+question_id);
                       
                    }
                  //window.location.replace(base_url + "tech-chat.php?question_id="+question_id+"&chat_with="+supporter_id+"&user_type=client");
                  //window.location.replace(base_url + "tech-stop-chat.php?question_id=<?php echo $question_id; ?>&user_type=<?php echo $user_type; ?>");
                  //window.location.replace(base_url + "thank-you.php");
              }
            },
            error: function() {

            }
         });
    }
    
    
</script>


</body>
</html>
