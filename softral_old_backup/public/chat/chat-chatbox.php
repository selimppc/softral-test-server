<?php
include_once 'config.php';
?>


<!--<i class="back-chat-left-panel glyphicon glyphicon-earphone"></i>-->
<!--<a class="back-chat-left-panel pull-right"> < </a>-->
<div id="friend-request" class="hide chat-header friend-header">


    <img class="thumb-prof-pic" id="friend_rquest_user_prof_pic" width="35px" height="35px" style="margin-right:5px;" src="<?php echo $websiteRoot; ?>images/man.png" />

    <p>
        <span id="friend_rquest_user_name"></span>
        <input type="text" name="friend_request_user_id" id="friend_request_user_id" class="hide" value="" />
        <!--English . 11 am. Mobile, Alabama-->
        <i class="back-chat-left-panel glyphicon glyphicon-chevron-left pull-right"></i>
    </p>


    <center id="new-request" class="request hide">
        </hr>
        The person is not your contacts</br>
        <input id="send-friend-request" type="button" class="btn btn-success" name="send-friend-request" value="Send Request" />
    </center>

    <center id="request-agian" class="request hide">
        </hr>
        You have cancel the friend request once. Do you want to sent it again?</br>
        <input id="send-friend-request-again" type="button" class="btn btn-success" name="send-friend-request-again" value="Yes" />
        <input id="dont-send-friend-request-again" type="button" class="btn btn-success" name="dont-send-friend-request-again" value="No" />
    </center>

    <center id="request-sent" class="request hide">
        </hr>
        You have sent friend request already</br>
        <input id="cancel-friend-request" type="button" class="btn btn-default" name="cancel-friend-request" value="Cancel Friend Request" />
    </center>

    <center id="success-request" class="request hide">
        </hr>
        Friend request sent successfully</br>
    </center>


    <center id="reponse-friend-request" class="request hide">
        </hr>
        <input id="accept-friend-request" type="button" class="btn btn-success" name="accept-friend-request" value="Accept Request" />
        <input id="reject-friend-request" type="button" class="btn btn-default" name="reject-friend-request" value="Reject Request" />
    </center>



</div>

<div class='msgs'>
    <?php include 'chat-home.php'; ?>
</div>


<form role="form" class="form-horizontal" id="msg_form">
    <div class="input-group hide">
        Chatting Type  <input type="text" value="" name="chattype" class="form-control" id="chattype">
    </div>
    <div class="input-group hide">
        Chatting with  <input type="text" value="" name="sendto" class="form-control" id="sendto">
    </div>

    <div class="input-group hide">
        Group Chat  <input type="text"  value="" name="groupid" class="form-control" id="groupid">
    </div>

    <div id="send-box" class="input-group hide">
        <!--<input type="text" value="" name="msg" class="form-control" id="msg" autocomplete="off">-->
        <!--<textarea style="resize:vertical;border: none;" name="msg" class="form-control" id="msg" rows="5" cols="100"></textarea>-->
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




<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!--Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">All Members</h4>
            </div>
            <div class="modal-body">
                <p id="all-group-members">Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<a class="btn btn-primary add-memeber" href="chat-add-user.php?grp_name=test">Add Member</a>-->
                <a class="btn btn-primary add-memeber" href="#">Add Member</a>
            </div>
        </div>

    </div>
</div>

<!--<div class="modal-container"></div>-->


<script src="<?= $websiteRoot; ?>js/chat-send-message.js"></script>
<!--<script src="<?= $websiteRoot; ?>js/chat-copy-edit-messgae.js"></script>-->


<script>
    $('.back-chat-left-panel').on("click", function(){
        $(".chatbox-left-panel").show();
        $(".chatbox").hide();
    })
</script>