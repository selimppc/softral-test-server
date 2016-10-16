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

$question_id = $_GET['question_id'];
?>

<div id="wrap">
    <div class="clearfix"></div>

    <div class="container">
        <div class="chat">
            <div class="row content">


                <center>
                    <div class="watermark">
                        <h3><span class="online_green">Congrats <?php echo $first_name . " " . $last_name; ?> </span></h3>
                        
                        <p>You have just talked with our Support Team</p>
                        <p id="question">Problem aaaaaaa</p>
                        <p id="question">Total Timing : 10 hour</p>
                        
                        <p>
                            Problem Solved.
                            <br>
                            <input type="radio" id="client_job_status" name="client_job_status" value="agree"> Agree
                            <input type="radio" id="client_job_status" name="client_job_status" value="disagree"> Disagree
                        </p>
                        
                        <input type="text" id="question_id" value="<?php echo $question_id;?>" class="hide">

                        <button id="client-review" class="btn btn-success">Submit</button>
                    </div>
                </center> 

            </div>

        </div>
    </div>



    <?php //include("footer.php");  ?>
</div>
<!-- CLOSE WRAP -->

<script>
$("#client-review").click(function(){
        
        var question_id = $('#question_id').val();
        var client_job_status = $('#client_job_status').val();
        //$.ajax(base_url + "update-free-review.php?question_id="+question_id+"&client_job_status="+client_job_status, {
        $.ajax(base_url + "update-client-review.php?question_id="+question_id+"&client_job_status="+client_job_status, {
            success: function(data) {
               if(data > 0){
                  //window.location.replace(base_url + "tech-chat.php?question_id="+question_id+"&chat_with="+client_id+"&user_type=free");
                  //window.location.replace(base_url + "thank-you.php?question_id="+question_id+"&user_type=free");
                  window.location.replace(base_url + "thank-you.php");
              }
            },
            error: function() {
               //$('#notification-bar').text('An error occurred');
            }
         });
    });
</script>

</body>
</html>
