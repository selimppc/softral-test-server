<?php
include("config.php");
include("include/header.php");
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
    <!--    <div class="page-content padding-small" id="home-container">
            
        </div>-->


    <div class="container">
        <!--<div class="chat md-column col-md-12">-->
        <div class="chat">

            <div class="row content">
                <!--<div class="chatbox-left-panel col-xs-3">-->
                <div class="chatbox-left-panel col-xs-5 col-md-3 col-sm-4 col-lg-3">
                    <!--                        <div class="chat-header chattingwith">
                                                <a href='<?= $websiteRoot ?>chat.php'>Home</a>
                                                <a href='<?= $websiteRoot ?>index.php'>Home</a>
                                            </div>
                                            <div class="users col-xs-12">
                    <?php
                    echo "<h4 class='online_green'>Group Name</h4>";
                    $sql = $dbh->prepare("SELECT grp_name FROM chat_usergroup where created_by = '" . $_SESSION['id'] . "'");
                    $sql->execute();

                    while ($r = $sql->fetch()) {

                        $profile_pic = "<img width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/grp.png'>";
                        $add_user_pic = "<img width='20px' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/add_user_group-icon.gif'>";

                        echo "<div class='grp_name'>    
                                            <a href='{$websiteRoot}chat-add-user.php?grp_name={$r['grp_name']}'>$profile_pic {$r['grp_name']} </a>
                                         </div>";
                    }
                    ?>
                    
                                            </div>-->



                    <div class="chat-header chattingwith">

                        <div class="row">
                            <div class="col-md-12">

                                <?php
                                if (!empty($avatar))
                                    echo '<img width="35px" height="35px" style="margin-right:5px;" src="data:image/jpeg;base64,' . base64_encode($avatar) . '"/>';
                                else
                                    echo '<img width="35px" height="35px" style="margin-right:5px;" src="' . $websiteRoot . 'images/man.png">';
                                ?>


                                <?php echo $first_name . " " . $last_name; ?>
                                <p class="hide">User Type  <input type="text"  value="" name="usertype" class="form-control" id="usertype"></p>

                                <?php //echo "<br>(" . $id . ")" . $email; ?>
                                <a href="logout.php">Logout</a>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group" id="adv-search" style="margin-top:10px; margin-bottom: 10px">
                                    <input id="chatbox-left-panel-search" type="text" class="form-control" placeholder="Search Group" />
                                    <div class="input-group-btn">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <p class="chat-header-menu">
                            <span style="margin-right:15px" class="home" title="Home">
                                <a href="<?= $websiteRoot ?>index.php"><img height="20" wdith="20" src="<?php echo $websiteRoot; ?>images/home_icon.gif"></a>
                            </span>
                        </p>


                        <!--<div class="all-conversation hide" id="all-netnoor-user"></div>-->


                    </div>

                    <div class="row"> 
                        <div class="users col-xs-12">
                            <div id="all-groups">
                                <?php
                                echo "<h4 class='online_green'>Group Name</h4>";
                                $sql = $dbh->prepare("SELECT grp_name FROM chat_usergroup where created_by = '" . $_SESSION['id'] . "'");
                                $sql->execute();

                                while ($r = $sql->fetch()) {

                                    $profile_pic = "<img width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/grp.png'>";
                                    $add_user_pic = "<img width='20px' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/add_user_group-icon.gif'>";

                                    echo "<div class='grp_name'>    
                                            <a href='{$websiteRoot}chat-add-user.php?grp_name={$r['grp_name']}'>$profile_pic {$r['grp_name']} </a>
                                         </div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>


                <!--<div class="chatbox col-xs-8">-->
                <div class="chatbox col-xs-7 col-sm-8 col-md-9 col-lg-9">

                    <div id="friend-request" class="chat-header friend-header">
                        <h4 class='online_green'>Create a new group</h4>
                    </div>

                    <div class='msgs'>
                        <br><br>
                        <?php
                        if (isset($_POST['grp_name'])) {

                            /**
                             * If User submited the create new group information
                             */
                            $grp_name = htmlspecialchars($_POST['grp_name']);

                            $sql = $dbh->prepare("SELECT grp_name FROM chat_usergroup WHERE grp_name=?");
                            $sql->execute(array($grp_name));
                            if ($sql->rowCount() != 0) {
                                //If Group name already exist
                                $ermsg = "<h2 class='error'>Group Name Exist
                                        </h2><a href='chat-new-group.php'>Try another Name</a>";
                                echo $ermsg;
                            } else {

                                $user = array();
                                $user[] = $_SESSION['id'];
                                $user = serialize($user);


                                $sql = $dbh->prepare("INSERT INTO chat_usergroup (created_by,grp_name, users) VALUES (?,?,?)");
                                $sql->execute(array($_SESSION['id'], $grp_name, $user));

                                header("Location:chat-add-user.php?grp_name=$grp_name");
                                exit();
                            }

                            /**
                             * End of section
                             * If User submited the create new group information
                             */
                        } else {
                            //echo "not submitted";
                            ?>

                            <p>You must provide a group name for group chatting. This name will be visible to all other users in this group.</p>
                            <form role="form" class="form-horizontal" action="chat-new-group.php" method="POST">
                                <div class="input-group">
                                    <input type="text" value="" name="grp_name" placeholder="Group Name" class="form-control" id="grp_name">
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="submit">Create</button>
                                    </span>
                                </div>

                            </form>
                        <?php } ?>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
<!-- CLOSE WRAP -->