<?php
include_once 'config.php';
?>


<!--<i class="back-chat-left-panel glyphicon glyphicon-earphone"></i>-->
<!--<a class="back-chat-left-panel pull-right"> < </a>-->
<div id="friend-request" class=" chat-header friend-header">



    <center id="new-request" class="request ">
        <p id="question">Your query is ..</p>
        <span id="stop-chat"><a class="btn btn-success" href="tech-stop-chat.php?user_type=<?php echo $user_type;?>&question_id=<?php echo $question_id;?>">Stop Job</a></span>
    </center>
    




<!--    <center id="reponse-friend-request" class="request">
        </hr>
        <input id="accept-friend-request" type="button" class="btn btn-success" name="accept-friend-request" value="Accept Request" />
        <input id="reject-friend-request" type="button" class="btn btn-default" name="reject-friend-request" value="Reject Request" />
    </center>-->



</div>

<div class='msgs'>
    <?php //include 'chat-home.php'; ?>
</div>


<form role="form" class="form-horizontal" id="msg_form">
    <div class="input-group hide">
        Question  <input type="text" value="<?php echo $question_id;?>" name="Question" class="form-control" id="Question">
    </div>
    <div class="input-group hide">
        Chatting with  <input type="text" value="<?php echo $chat_with;?>" name="sendto" class="form-control" id="sendto">
    </div>


    <div id="send-box" class="input-group ">
        
        <textarea wrap="hard" placeholder="Enter your message" style="resize:vertical;border: 1px solid #E5E8F1;; " name="msg" class="form-control" id="msg" rows="5" cols="100"></textarea>

        <span style="vertical-align: bottom;" class="input-group-btn">
            <button class="btn btn-success" type="submit">Send</button>
        </span>
    </div>

    <span class="fileinput-button hide">
        <img class="attachment" src="<?php echo $websiteRoot; ?>images/attachment-icon.png" alt="Attached File" width="30" height="30" style="border:none;"/>

        <input id="fileupload" type="file" name="files[]" multiple>
        <label class="error" id="profileimg_status"></label>
    </span>


    <div id="progress" class="progressbar progress-success progress-striped">
        <div class="bar">aaaaaaaaaaaaa</div>
    </div>

    <input id="js-emaillink-edit" name ="edit-box" type="hidden" />

    <br>
    <p id="js-emaillink" class="js-emaillink" style="opacity: 0"></p>


</form>
