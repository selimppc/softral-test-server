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



?>

<div id="wrap">
    <div class="clearfix"></div>

    <div class="container">
        <div class="chat">
            <div class="row content">


                <center>
                    <div class="watermark">
                        <h3><span class="online_green">Thank you <?php echo $first_name . " " . $last_name; ?> </span></h3>
                        
                        <p>You have just finished one job</p>
                        <p id="question">Problem aaaaaaa</p>
                        <p id="question">Total Timing : 10 hour</p>
                        
                        
                        
                        
                         <a href="index.php" class="btn btn-success">Home</a>
                    </div>
                </center> 

            </div>

        </div>

    </div>



    <?php //include("footer.php");  ?>
</div>
<!-- CLOSE WRAP -->



</body>
</html>
