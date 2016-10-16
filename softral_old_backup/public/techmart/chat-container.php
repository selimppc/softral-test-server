<div class="chat">
    <div class="row content">
        
        <div class="chatbox-left-panel col-xs-5 col-md-3 col-sm-4 col-lg-3">
            <div class="chat-header chattingwith">

                <div class="row">
                    <div class="col-md-12">

                        <?php
                        if (!empty($avatar))
                            echo '<img class="thumb-prof-pic" width="35px" height="35px" style="margin-right:5px;" src="data:image/jpeg;base64,' . base64_encode($avatar) . '"/>';
                        else
                            echo '<img class="thumb-prof-pic" width="35px" height="35px" style="margin-right:5px;" src="' . $websiteRoot . 'images/man.png">';
                        ?>


                        <?php 
                        echo $first_name . " " . $last_name; 
                        ?>
                        <!--<p class="hide">User Type  <input type="text"  value="" name="usertype" class="form-control" id="usertype"></p>-->
                        <a href="logout.php">Logout</a>
                    </div>
                </div>





            </div>
            
        </div>

        <div class="chatbox col-xs-7 col-sm-8 col-md-9 col-lg-9">
            <?php
            if (isset($_SESSION['id'])) {
                include("chat-chatbox.php");
            } else {
                //IF user is not logedin 
                header('Location:' . $websiteRoot);
                exit();
            }
            ?>
        </div>

    </div>

</div>
