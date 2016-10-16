<div class="chat">
    <div class="row content">


        <center>
            <div class="watermark">
                <h3><span class="online_green">Welcome <?php echo $first_name . " " . $last_name; ?> </span></h3>
                <h1><span class="online_green">Softral Tech Support </span></h1>
                <p><span style="color:#2f4f4f;">Softral is Software Central where you can hire freelancers and trade software</span></p>
                
                <p id="question">You have no job assign now</p>
                <input type="text" id="question_id" value="" class="hide">
                <input type="text" id="client_id" value="" class="hide">
                <span id="start-chat"></span>

            </div>
        </center> 

    </div>

</div>

<script>
    var interval = setInterval(function(){
        chek_new_job_assign();
    },1000);
    
    function chek_new_job_assign(){
        $.ajax(base_url + "tech-new-job-assign.php", {
              success: function(response) {
                 console.log(response);
                 var json = $.parseJSON(response);
                 console.log(json);
                 console.log(json[0].id);
                 
                 $('#question').html('Question: ' + json[0].question);
                 $('#question_id').val(json[0].id);
                 $('#client_id').val(json[0].client_id);
                 $('#start-chat').html('<button class="btn btn-success">Start converstion</button>');
                 clearInterval(interval); 
              },
              error: function() {
                 //$('#notification-bar').text('An error occurred');
              }
           });
    }
    
    $("#start-chat").click(function(){
        
        var question_id = $('#question_id').val();
        var client_id = $('#client_id').val();
        $.ajax(base_url + "tech-start-chat.php?question_id="+question_id+"&client_id="+client_id, {
            success: function(data) {
               if(data > 0){
                  $('#start-chat').addClass("hide");
                  window.location.replace(base_url + "tech-chat.php?question_id="+question_id+"&chat_with="+client_id+"&user_type=free");
                
              }
            },
            error: function() {
               //$('#notification-bar').text('An error occurred');
            }
         });
    });
</script>