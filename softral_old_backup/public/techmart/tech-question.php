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
                <div id="friend-request" class="chat-header friend-header">

                    <center><span class="online_green"><h3>Welcome <?php echo $first_name . " " . $last_name; ?></h3> </span></center>
                    
                    <!--<input type="text" id="supporter_id" value="">-->
                </div>
            </div>
            <div class="row content">

                <center class="hide" id="wait-tech-team"><img src="<?= $websiteRoot; ?>images/ajax-loader.gif">Please Wait. While our Tech Support Team will reach to you </center>
                
                <div class='msgs'>
                    
                    <?php include 'include/tech-question.php';  ?> 
                    
                    
                </div>
                

            </div>

        </div>


    </div>


</div>
<!-- CLOSE WRAP -->

<script src="<?= $websiteRoot; ?>js/tech-ask-question.js"></script>


</body>
</html>
