function setOnlineStatus(){
    $.post(base_url + "chat-change-user-online-status.php",{
        status: 'on'//status: 'away'
    },function(response){
        //If response 1 then user online status updated to on successsfully
    });
}
setInterval(function(){
    setOnlineStatus();
},120000); //1min 30 sec