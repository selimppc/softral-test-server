function scTop(){
    $(".msgs").animate({
        scrollTop:$(".msgs")[0].scrollHeight
    });
}
function load_new_stuff(){
    localStorage['lpid']=$(".msgs .msg:last").attr("title");
    var chattype = $("#chattype").val();
    
    var sendto = $("#friend_request_user_id").val();
    var groupid = $("#groupid").val();
    var usertype = $("#usertype").val();
    
    if(sendto != '' || groupid != ''){
        $(".msgs").load(base_url + "chat-msgs.php",{ 
            chattype: chattype,
            sendto: sendto,
            groupid: groupid,
            usertype: usertype
        },function(){
            if(localStorage['lpid']!=$(".msgs .msg:last").attr("title")){
                scTop();
            }
        });
    }else{

    }
//    $(".users").load(base_url + "chat-users.php?usertype="+usertype);
}





/**
 * Show all group Members Name from Group Chat
 */

$("#friend_rquest_user_name").on("click", "a.showme", function(){
    var grp_name = $(this).data('grp_name');
    
    $.get('chat-group-members.php?grp_name='+grp_name, function(html){
        $('#myModal .modal-body').html(html);
        $('#myModal').modal('show', {
            backdrop: 'static'
        });    
    });
});


$(".home").on('click', function(){
    $(".msgs").html("Loading Home Page.....");
    $(".chatbox").load(base_url + "chat-chatbox.php");
});

$(".recent").on('click', function(){
    $("#usertype").val('recent');
    $(".all-conversation").addClass("hide");
    $("#recent-user").removeClass("hide");
});
$(".contacts").on('click', function(){
    $("#usertype").val('contacts');
    $(".all-conversation").addClass("hide");
    $("#all-user").removeClass("hide");
});

$(".groups").on('click', function(){
    $("#usertype").val('groups');
    $(".all-conversation").addClass("hide");
    $("#all-groups").removeClass("hide");
});

$(".pending-requests").on('click', function(){
    $("#usertype").val('pendind_request');
    $(".all-conversation").addClass("hide");
    $("#all-pending-requests").removeClass("hide");
});





/** 
 * Accept Friend Request
 */
$("#accept-friend-request").on("click", function(){
    var friend_request_user_id = $("#friend_request_user_id").val();
    var action = 'accept';
    $.post(base_url + "chat-friend-request.php",{
        friend_request_user_id: friend_request_user_id,
        action: action
    },function(response){
        console.log(response);
        $(".netnoor-user-active").find('.friend-status').text("accepted");
        $("#reponse-friend-request").addClass('hide');
    });
});
    
/** 
 * End of Section
 * Send Friend Request
 */
 
 
/**
  * Reject Friend request
  */
$("#reject-friend-request").on("click", function(){
    var friend_request_user_id = $("#friend_request_user_id").val();
    var action = 'reject';
    $.post(base_url + "chat-friend-request.php",{
        friend_request_user_id: friend_request_user_id,
        action: action
    },function(response){
        console.log(response);
        $(".netnoor-user-active").find('.friend-status').text("rejected");
        $("#reponse-friend-request").addClass('hide');
    });
});
/**
   * End of Section Reject Friend request
   */
    
    

/**
 *  Search By username from the left side chat-panel search box
 */
$("#chatbox-left-panel-search").on('keyup', function(){
    t=$(this);
    var search_str = $(t).val();
    var search_from = $("#search_from").val();
    
    if(search_str !=''){
        
        
        $(".users").addClass('hide');
        $(".chat-header-menu").addClass('hide');
        
        
        
        //Query in netnoor if give some user input
        $.post(base_url + "chat-search.php",{
            search_str: search_str,
            search_from: search_from
        },function(response){
            $("#all-netnoor-user").html('');
            $("#all-netnoor-user").html(response);
            $("#all-netnoor-user").removeClass("hide"); //Search Result Panel
            
            
            /**
              * Select user to send Friend Request
              */
            $(".netnoor-user").on("click", function(){
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
            
            /**
              * End of Section
              */
            
            
            $(".my-contact").on("click", function(){
        
                $(".request").addClass("hide");
                $("#friend-request").removeClass("hide");
                $("#send-box").removeClass("hide");
                $("#chattype").val('individual');
                $("#sendto").val(($(this).find("label").text()));
                $("#groupid").val("");
        
                $("#friend_rquest_user_name").html(($(this).find(".username").text()));
                $("#friend_request_user_id").val(($(this).find(".userid ").text()));
        
                load_new_stuff();
            });
        });
    }else{
        $("#all-netnoor-user").addClass("hide"); //Search Result Panel
        //$("#recent-user").removeClass('hide'); // Clean left search panel
        $(".chat-header-menu").removeClass('hide');
        $(".users").removeClass('hide');
        
        //Check before search which one selected.. and that section
        $("#all-netnoor-user").html(""); // Remove the all results getting from Netnoor Search Directory
    }

    
});


/**
 * When Select User from My Contact
 */

/**
 * End of Section
 * When Select User from My Contact
 */





/** 
 * Send Friend Request
 */
$("#send-friend-request").on("click", function(){
    var friend_request_user_id = $("#friend_request_user_id").val();
    var action = 'new';
    $.post(base_url + "chat-friend-request.php",{
        friend_request_user_id: friend_request_user_id,
        action: action
    },function(response){
        $(".netnoor-user").find('.friend-status').text("requsted");
        $("#new-request").addClass('hide');
        $("#success-request").removeClass('hide');
    });
});
    
/** 
  * End of Section
  * Send Friend Request
  */
     
/**
 * Cancel Friend Request
 */
$("#cancel-friend-request").on("click", function(){
    var friend_request_user_id = $("#friend_request_user_id").val();
    var action = 'cancel';
    $.post(base_url + "chat-friend-request.php",{
        friend_request_user_id: friend_request_user_id,
        action: action
    },function(response){
        console.log(response);
        $(".netnoor-user").find('.friend-status').text("cancel_request");
        $("#request-sent").addClass('hide');
    });
});
/**
 * End of Section
 * Cancel Friend Request
 */
 
 
 
 
setInterval(function(){
    //If User sleected for Chatting then only run this function...
    load_new_stuff();
},5000);

setInterval(function(){
    var usertype = $("#usertype").val();
    $(".users").load(base_url + "chat-users.php?usertype="+usertype);
},60000);