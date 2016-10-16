$(document).ready(function(){


    var free_que;
    var start_job;
    
    $("#msg_form").on("submit",function(){
        
        t=$(this);
        val=$(this).find("input[type=text]").val();
    
        var msg = $(t).find("textarea[name=msg]").val();
        msg = msg.replace(/\n\r?/g, '<br />');
        
    
        if(val!=""){
            //t.after("<span id='send_status'>Sending.....</span>");
            
            $.post(base_url + "tech-ask-question.php",{
                client_id: $(t).find("input[name=client_id]").val(),
                sub_id: $(t).find("#subj_id").val(),
                dep_id: $(t).find("#dept_id").val(),
                question: msg
            },function(response){
                if(response > 0){
                    
                    $("#msg_form").addClass("hide");
                    $("#wait-tech-team").removeClass("hide");
                    //Check who is ready to chat with this question id
                    free_que = setInterval(function(){
                        chek_free_que(response);
                    },1000);
                //window.location.replace(base_url + "tech-chat.php");
                }
                //$("#send_status").remove();
                //$(t).find("textarea[name=msg]").val("")
            });
        }
        return false;
    });
    
    
    function chek_free_que(question_id){
    
        console.log("chek_free_que");
    
    
        $.ajax(base_url + "tech-free-que.php?question_id="+question_id, {
            success: function(supporter_id) {
               if(supporter_id > 0){
                  clearInterval(free_que);
                  
                  start_job = setInterval(function(){
                        chek_start_job(question_id);
                  },1000);
                  //window.location.replace(base_url + "tech-chat.php?question_id="+response+"&chat_with="+supporter_id);

              }
            },
            error: function() {

            }
         });

    }
    
    function chek_start_job(question_id){
        console.log("chek_start_job");
    
    
        $.ajax(base_url + "tech-start-job.php?question_id="+question_id, {
            success: function(supporter_id) {
               if(supporter_id > 0){
                  clearInterval(start_job);
                  window.location.replace(base_url + "tech-chat.php?question_id="+question_id+"&chat_with="+supporter_id+"&user_type=client");

              }
            },
            error: function() {

            }
         });
    }
});
    
