<?php
include("config.php");
include("include/header.php");
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    

    $sql = $dbh->prepare("select a.id, a.email, b.first_name, b.last_name, b.avatar from users as a inner join user_profile as b on a.id = b.user_id where email = '$email'");
    $sql->execute();
    
   
    $check_user = 0;
    $msg = "";
    
    while ($row = $sql->fetch()) {
        $_SESSION['email'] = $row['email'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['avatar'] = $row['avatar'];
        $_SESSION['id'] = $row['id'];
        $check_user++;
        
        /*
        if(!empty($row['avatar']))
            echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['avatar'] ).'"/>';
        else
            echo "aaaaaaaaaaaa";
         * 
         */
    }

    
    
    
    if ($check_user > 0) {
         header('Location: index.php');
         exit(1);
        
        
    } else {
        $msg = "<h2 class='error'>Authenication Error</h2>";
    }
}
?>


<div id="wrap">
    <div class="clearfix"></div>
    <div class="page-content padding-small" id="home-container">
        <div class="container">
            <div class="chat md-column col-md-12">
                <div class="row">

                </div>
                <div class="row">
                    <div class="chatbox-left-panel col-xs-3">

                    </div>


                    <div class="chatbox col-xs-9">
                        <?php
                         if(isset($msg)) echo $msg;
                         
                        include("include/login.php");
                        ?>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <?php //include("footer.php");  ?>
</div>
<!-- CLOSE WRAP -->



</body>
</html>