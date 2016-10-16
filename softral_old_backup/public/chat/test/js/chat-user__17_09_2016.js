/**
 * Select user from My contact list to start aconversation
 * and to see the previous conversation
 */
$(".user").on("click", function(){
        
    $('.user').removeClass('active-user'); // Just remove class from all user
    $(this).addClass("active-user");
        
    var viewportWidth = $(document).width();
    console.log(viewportWidth);
    if (viewportWidth < 480) {
        console.log("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
        $(".chatbox-left-panel").hide();
        $(".chatbox").show();
    }
        
        
    //This is the friend Profile Pic to whome chtting
    var user_prof_pic_url = $(this).find('img').attr('src');
    $("#friend_rquest_user_prof_pic").attr("src", user_prof_pic_url);
        
    $("#friend_rquest_user_name").html(($(this).find(".username").text())); //This is the friend Name to whome chatting with
    $("#friend_request_user_id").val(($(this).find(".userid ").text()));    //This is the friend Id to whome chetting with
        
        
        
        
        
    $(".request").addClass("hide");     //hide all friend Request Messages like.. Accept Request. cancael request
    $("#friend-request").removeClass("hide"); //Display the header section of right side chatboc panel
        
      
        
    $(".msgs").html("<img id='chat-loader' src='"+base_url+"images/ajax-loader.gif'>");
        
    $("#send-box").removeClass("hide"); // Clear the text box from where user can sent a message to his friends
    $("#chattype").val('individual');   //If indiviadaul user is selected to chat
        
        
    $("#sendto").val(($(this).find("label").text()));
    $("#groupid").val("");
        
        
    load_all_messasges();
});
    
    
    
/**
 * End of Section
 * Select user from My contact list to start aconversation
 * and to see the previous conversation
 */


/**
* Set no of Pending request
*/
var no_of_pending_request = "<?php echo $no_of_pending_request ?>";
        
        
        
if(no_of_pending_request > 0){    
    $("#no-of-pending-request").removeClass("hide");
    $("#no-of-pending-request").html(" <img height='20' wdith='20' src='<?php echo $websiteRoot ?>images/Profile_AddFriend-24.png'><sup style='color:red'><?php echo $no_of_pending_request; ?></sup>");
}else{
    $("#no-of-pending-request").html("");
    $("#no-of-pending-request").addClass("hide");
}
    
    

    
    
/**
 * Select a group from my Group list to start aconversation
 * and to see the previous conversation
 */
$(".group").on("click", function(){
        
    //alert("aaaaaaaaaaaa");
        
    var viewportWidth = $(document).width();
    console.log(viewportWidth);
    if (viewportWidth < 480) {
        console.log("Click on gruop when width < 480");
        $(".chatbox-left-panel").hide();
        $(".chatbox").show();
    }else{
        //Display group members name on left side bar
        $(".group").not(this).find('.group_member').css('display','none');
        $(this).find('.group_member').toggle();
    //End of section  Display group members name on left side bar
    }
        
        
        
    //This is the friend Profile Pic to whome chtting
    var user_prof_pic_url = $(this).find('img').attr('src');
    $("#friend_rquest_user_prof_pic").attr("src", user_prof_pic_url);
    $("#friend_rquest_user_prof_pic").attr("title", "Click Here to add or Remove Group Members");
        
        
    var group_name = $(this).find(".groupname").text();
        
        
        
    var text = '<h4 class="online_green">' + group_name + '</h4>';
    text += '<a href="#;" data-grp_name="'+group_name+'" class="showme">Show all members...</a>';
    $("#friend_rquest_user_name").html(text); //This is the friend Name to whome chatting with
    $("#friend_request_user_id").val(($(this).find(".groupid ").text()));    //This is the friend Id to whome chetting with
        
        
    /*
        var base_url = "<?php echo $websiteRoot; ?>";
        
        $.ajax(base_url+'chat-group-members.php?grp_name='+group_name, {
            success: function(data) {
                
                var text = '<h4 class="online_green">' + group_name + '</h4>';
                
                text += data;
                
                text += '<a href="#;" data-grp_name="'+group_name+'" class="showme">Show all members...</a>';
                //text += '<a data-toggle="modal" href="#myModal" id="modellink">Show all members...</a>';
                $("#friend_rquest_user_name").html(text); //This is the friend Name to whome chatting with
                $("#friend_request_user_id").val(($(this).find(".groupid ").text()));    //This is the friend Id to whome chetting with
                
            },
            error: function() {
                //$('#notification-bar').text('An error occurred');
            }
        });
         */
        
        
        
        
        
        
        
        
    $(".request").addClass("hide");     //hide all friend Request Messages like.. Accept Request. cancael request
    $("#friend-request").removeClass("hide"); //Display the header section of right side chatboc panel
        
        
    $(".msgs").html("Loading Conversation.....");// Clear The chatBox Before Loading New..
        
        
        
        
        
    $("#send-box").removeClass("hide"); // Clear the text box from where user can sent a message to his friends
    $("#chattype").val('group');   //If a group name is selected to chat
        
    $("#groupid").val(($(this).find("label").text()));
    $("#sendto").val("");
        
        
        
    //load_new_stuff();
        
        
        
    load_all_messasges();
});    
    
/**
     * End of Section
     * Select a group from my Group list to start aconversation
     * and to see the previous conversation
     */
    
   
    
//TODO@ Check Where I can shift this block.
$(".user, .group").on("click", function(){
    $(".fileinput-button").removeClass("hide");     
});
    
    
    
/**
     * Select user to accept/reject pending friend Request
     */
$(".pending-request").on("click", function(){
    $("#friend-request").removeClass("hide");
    $(".request").addClass("hide");
    $("#reponse-friend-request").removeClass("hide");
    $("#friend_rquest_user_name").html(($(this).find(".username").text()));
    $("#friend_request_user_id").val(($(this).find(".userid ").text())); 
        
        
    //Clear the Messages area
    $(".msgs").html("");
});
    /**
     * End ofo Section
     * Select user to accept/reject pending friend Request
     */

