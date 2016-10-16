<?php
include_once 'config.php';
?>


<!--<i class="back-chat-left-panel glyphicon glyphicon-earphone"></i>-->
<!--<a class="back-chat-left-panel pull-right"> < </a>-->
<div id="friend-request" class="hide chat-header friend-header">
    
    
    <img id="friend_rquest_user_prof_pic" width="35px" height="35px" style="margin-right:5px;" src="<?php echo $websiteRoot; ?>images/man.png" />

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
        <textarea wrap="hard" style="resize:vertical;border: none;" name="msg" class="form-control" id="msg" rows="5" cols="100"></textarea>

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


<script>
    
    
    $("textarea[name=msg]").keypress(function(e){
        if (e.keyCode == 13 && !e.shiftKey)
        {        
            e.preventDefault();
            //now call the code to submit your form
            //alert("just enter was pressed");
            $('#msg_form').trigger('submit');
            return;
        }

        if (e.keyCode == 13 && e.shiftKey)
        {       
            //this is the shift+enter right now it does go to a new line
            //alert("shift+enter was pressed");        
        }    
    });

    $(document).ready(function(){
        scTop();
        $("#msg_form").on("submit",function(){
            t=$(this);
            val=$(this).find("input[type=text]").val();
    
            //var msg = $(t).find("input[name=msg]").val();
            var msg = $(t).find("textarea[name=msg]").val();
            msg = msg.replace(/\n\r?/g, '<br />');
        
            var definition = {
                "smile":{
                    "title":"Smile",
                    "codes":[":)",":=)",":-)"]
                },
                "sad-smile":{
                    "title":"Sad Smile",
                    "codes":[":(",":=(",":-("]
                },
                "big-smile":{
                    "title":"Big Smile",
                    "codes":[":D",":=D",":-D",":d",":=d",":-d"]
                },
                "cool":{
                    "title":"Cool",
                    "codes":["8)","8=)","8-)","B)","B=)","B-)","(cool)"]
                },
                "wink":{
                    "title":"Wink",
                    "codes":[":o",":=o",":-o",":O",":=O",":-O"]
                },
                "crying":{
                    "title":"Crying",
                    "codes":[";(",";-(",";=("]
                },
                "sweating":{
                    "title":"Sweating",
                    "codes":["(sweat)","(:|"]
                },
                "speechless":{
                    "title":"Speechless",
                    "codes":[":|",":=|",":-|"]
                },
                "kiss":{
                    "title":"Kiss",
                    "codes":[":*",":=*",":-*"]
                },
                "tongue-out":{
                    "title":"Tongue Out",
                    "codes":[":P",":=P",":-P",":p",":=p",":-p"]
                },
                "blush":{
                    "title":"Blush",
                    "codes":["(blush)",":$",":-$",":=$",":\">"]
                },
                "wondering":{
                    "title":"Wondering",
                    "codes":[":^)"]
                },
                "sleepy":{
                    "title":"Sleepy",
                    "codes":["|-)","I-)","I=)","(snooze)"]
                },
                "dull":{
                    "title":"Dull",
                    "codes":["|(","|-(","|=("]
                },
                "in-love":{
                    "title":"In love",
                    "codes":["(inlove)"]
                },
                "evil-grin":{
                    "title":"Evil grin",
                    "codes":["]:)",">:)","(grin)"]
                },
                "talking":{
                    "title":"Talking",
                    "codes":["(talk)"]
                },
                "yawn":{
                    "title":"Yawn",
                    "codes":["(yawn)","|-()"]
                },
                "puke":{
                    "title":"Puke",
                    "codes":["(puke)",":&",":-&",":=&"]
                },
                "doh!":{
                    "title":"Doh!",
                    "codes":["(doh)"]
                },
                "angry":{
                    "title":"Angry",
                    "codes":[":@",":-@",":=@","x(","x-(","x=(","X(","X-(","X=("]
                },
                "it-wasnt-me":{
                    "title":"It wasn't me",
                    "codes":["(wasntme)"]
                },
                "party":{
                    "title":"Party!!!",
                    "codes":["(party)"]
                },
                "worried":{
                    "title":"Worried",
                    "codes":[":S",":-S",":=S",":s",":-s",":=s"]
                },
                "mmm":{
                    "title":"Mmm...",
                    "codes":["(mm)"]
                },
                "nerd":{
                    "title":"Nerd",
                    "codes":["8-|","B-|","8|","B|","8=|","B=|","(nerd)"]
                },
                "lips-sealed":{
                    "title":"Lips Sealed",
                    "codes":[":x",":-x",":X",":-X",":#",":-#",":=x",":=X",":=#"]
                },
                "hi":{
                    "title":"Hi",
                    "codes":["(hi)"]
                },
                "call":{
                    "title":"Call",
                    "codes":["(call)"]
                },
                "devil":{
                    "title":"Devil",
                    "codes":["(devil)"]
                },
                "angel":{
                    "title":"Angel",
                    "codes":["(angel)"]
                },
                "envy":{
                    "title":"Envy",
                    "codes":["(envy)"]
                },
                "wait":{
                    "title":"Wait",
                    "codes":["(wait)"]
                },
                "bear":{
                    "title":"Bear",
                    "codes":["(bear)","(hug)"]
                },
                "make-up":{
                    "title":"Make-up",
                    "codes":["(makeup)","(kate)"]
                },
                "covered-laugh":{
                    "title":"Covered Laugh",
                    "codes":["(giggle)","(chuckle)"]
                },
                "clapping-hands":{
                    "title":"Clapping Hands",
                    "codes":["(clap)"]
                },
                "thinking":{
                    "title":"Thinking",
                    "codes":["(think)",":?",":-?",":=?"]
                },
                "bow":{
                    "title":"Bow",
                    "codes":["(bow)"]
                },
                "rofl":{
                    "title":"Rolling on the floor laughing",
                    "codes":["(rofl)"]
                },
                "whew":{
                    "title":"Whew",
                    "codes":["(whew)"]
                },
                "happy":{
                    "title":"Happy",
                    "codes":["(happy)"]
                },
                "smirking":{
                    "title":"Smirking",
                    "codes":["(smirk)"]
                },
                "nodding":{
                    "title":"Nodding",
                    "codes":["(nod)"]
                },
                "shaking":{
                    "title":"Shaking",
                    "codes":["(shake)"]
                },
                "punch":{
                    "title":"Punch",
                    "codes":["(punch)"]
                },
                "emo":{
                    "title":"Emo",
                    "codes":["(emo)"]
                },
                "yes":{
                    "title":"Yes",
                    "codes":["(y)","(Y)","(ok)"]
                },
                "no":{
                    "title":"No",
                    "codes":["(n)","(N)"]
                },
                "handshake":{
                    "title":"Shaking Hands",
                    "codes":["(handshake)"]
                },
                "skype":{
                    "title":"Skype",
                    "codes":["(skype)","(ss)"]
                },
                "heart":{
                    "title":"Heart",
                    "codes":["(h)","<3","(H)","(l)","(L)"]
                },
                "broken-heart":{
                    "title":"Broken heart",
                    "codes":["(u)","(U)"]
                },
                "mail":{
                    "title":"Mail",
                    "codes":["(e)","(m)"]
                },
                "flower":{
                    "title":"Flower",
                    "codes":["(f)","(F)"]
                },
                "rain":{
                    "title":"Rain",
                    "codes":["(rain)","(london)","(st)"]
                },
                "sun":{
                    "title":"Sun",
                    "codes":["(sun)"]
                },
                "time":{
                    "title":"Time",
                    "codes":["(o)","(O)","(time)"]
                },
                "music":{
                    "title":"Music",
                    "codes":["(music)"]
                },
                "movie":{
                    "title":"Movie",
                    "codes":["(~)","(film)","(movie)"]
                },
                "phone":{
                    "title":"Phone",
                    "codes":["(mp)","(ph)"]
                },
                "coffee":{
                    "title":"Coffee",
                    "codes":["(coffee)"]
                },
                "pizza":{
                    "title":"Pizza",
                    "codes":["(pizza)","(pi)"]
                },
                "cash":{
                    "title":"Cash",
                    "codes":["(cash)","(mo)","($)"]
                },
                "muscle":{
                    "title":"Muscle",
                    "codes":["(muscle)","(flex)"]
                },
                "cake":{
                    "title":"Cake",
                    "codes":["(^)","(cake)"]
                },
                "beer":{
                    "title":"Beer",
                    "codes":["(beer)"]
                },
                "drink":{
                    "title":"Drink",
                    "codes":["(d)","(D)"]
                },
                "dance":{
                    "title":"Dance",
                    "codes":["(dance)","\o/","\:D/","\:d/"]
                },
                "ninja":{
                    "title":"Ninja",
                    "codes":["(ninja)"]
                },
                "star":{
                    "title":"Star",
                    "codes":["(*)"]
                },
                "mooning":{
                    "title":"Mooning",
                    "codes":["(mooning)"]
                },
                "finger":{
                    "title":"Finger",
                    "codes":["(finger)"]
                },
                "bandit":{
                    "title":"Bandit",
                    "codes":["(bandit)"]
                },
                "drunk":{
                    "title":"Drunk",
                    "codes":["(drunk)"]
                },
                "smoking":{
                    "title":"Smoking",
                    "codes":["(smoking)","(smoke)","(ci)"]
                },
                "toivo":{
                    "title":"Toivo",
                    "codes":["(toivo)"]
                },
                "rock":{
                    "title":"Rock",
                    "codes":["(rock)"]
                },
                "headbang":{
                    "title":"Headbang",
                    "codes":["(headbang)","(banghead)"]
                },
                "bug":{
                    "title":"Bug",
                    "codes":["(bug)"]
                },
                "fubar":{
                    "title":"Fubar",
                    "codes":["(fubar)"]
                },
                "poolparty":{
                    "title":"Poolparty",
                    "codes":["(poolparty)"]
                },
                "swearing":{
                    "title":"Swearing",
                    "codes":["(swear)"]
                },
                "tmi":{
                    "title":"TMI",
                    "codes":["(tmi)"]
                },
                "heidy":{
                    "title":"Heidy",
                    "codes":["(heidy)"]
                },
                "myspace":{
                    "title":"MySpace",
                    "codes":["(MySpace)"]
                },
                "malthe":{
                    "title":"Malthe",
                    "codes":["(malthe)"]
                },
                "tauri":{
                    "title":"Tauri",
                    "codes":["(tauri)"]
                },
                "priidu":{
                    "title":"Priidu",
                    "codes":["(priidu)"]
                }
            };
            $.emoticons.define(definition);
       
            var textWithEmoticons = $.emoticons.replace(msg);
            msg = textWithEmoticons;
        
    
            if(val!=""){
                t.after("<span id='send_status'>Sending.....</span>");
                
                //alert("We will fix this sending message");
            
                $.post(base_url + "chat-send.php",{//$.post("http://www.netnoor.com/chat-send.php",
                    chattype: $(t).find("input[name=chattype]").val(),
                    sendto: $(t).find("input[name=sendto]").val(),
                    groupid: $(t).find("input[name=groupid]").val(),
                    msg: msg,//msg: $(t).find("input[name=msg]").val()
                    edit: $(t).find("input[name=edit-box]").val()
                },function(){
                    //load_new_stuff();
                    //alert("1");
                    load_new_messasges();
                    
                    //alert("Done");
                    //t.after("<span id='send_status'>Message Sent.....</span>");
                    
                    $("#send_status").remove();
                    //t[0].reset();
                    //$(t).find("input[name=msg]").val("");
                    $(t).find("textarea[name=msg]").val("")
                });
            }
            return false;
        });
    });
    
    $(".attachment").on("click", function(){
        //console.log("aaaaaaaaaaaaa");
        $( "#fileupload" ).trigger( "click" );
    })
    
    
    //$(".view-group-member").on("click", function(){
    //    $("#friend_rquest_user_name").on("click", ".view-group-member", function(){
    //        console.log("ggggggggggg");
    //    });
    
    
    /**
     * When Click on view group Member link it will show all group members name in that group
     * in a dialog box.
     */
    //    $("#view-group-member").on("click", function(){
    //        console.log("aaaaaaaaaaa");
    //        //e.preventDefault();
    //    });



    

    //$(document).ready(function(){
        
    //        $("#modellink").on("click", function(e) {
    //            console.log("bbbbbbbb");
    //            var url = "modalbox.php";
    //            $('.modal-container').load(url,function(result){
    //                $('#myModal').modal({show:true});
    //            });
    //        });
    //});

   
   
   function load_new_messasges(){
       //alert("2");
    localStorage['lpid']=$(".msgs .msg:last").attr("title");
    //alert($(".msgs .msg:last").attr("title"));
    console.log('load_new_messages');
    
    var timezone = jstz.determine();
    //alert(timezone.name());
    
    var last_message = $(".msgs .msg:last").attr("title");
    
    console.log(last_message);
    
    if(last_message != null){
        /**
         * IF conversation blank and at that time friend sents some message then the new message will not display.. beacause last_message is null
         */
        //alert("aaaaaaaa");
        var chattype = $("#chattype").val();
    
        var sendto = $("#friend_request_user_id").val();
        var groupid = $("#groupid").val();
        var usertype = $("#usertype").val();
    
    
    
        if(sendto != '' || groupid != ''){
        
            $.post(base_url + "chat-new-msgs.php",{ 
                chattype: chattype,
                sendto: sendto,
                groupid: groupid,
                usertype: usertype,
                last_message: last_message,
                timezone: timezone.name()
            },function(data) {
                //$(".msgs").html(data);
                //append($title)
                $(".msgs").append(data);
                //alert("3");
                if(localStorage['lpid']!=$(".msgs .msg:last").attr("title")){
                    scTop();
                }
//                scTop();
            });
        }
    }
}

function scTop(){
        //alert("scTop on chat-chat-box.php");
        console.log($(".msgs")[0].scrollHeight);
        $(".msgs").animate({
            scrollTop:$(".msgs")[0].scrollHeight
        });
    }
    
</script>

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


<script>
    $('.back-chat-left-panel').on("click", function(){
        $(".chatbox-left-panel").show();
            $(".chatbox").hide();
    })
    </script>