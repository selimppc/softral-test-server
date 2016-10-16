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

$user_type='free';
if($_SESSION['id'] == 42){
    $user_type='client';
}
?>

<div id="wrap">
    <div class="clearfix"></div>

    <div class="container">
        <?php //include 'chat-container.php'; ?> 
        <?php 
        
        if($user_type == 'client'){
            //Client
            include 'tech-home.php';
        }else{
            //Freelancer
            include 'que-home.php';
        }
        ?> 
    </div>



    <?php //include("footer.php");  ?>
</div>
<!-- CLOSE WRAP -->

</body>
</html>
