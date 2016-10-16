<?php
include("config.php");
include("include/header.php");
?>

<div id="wrap">

    
    <div class="clearfix"></div>
    <div class="page-content padding-small" id="home-container">
        <div class="container">
            <div class="chat md-column col-md-12">

                <div class="row">
                    <div class="chatbox-left-panel col-xs-3">
                        <div class="chat-header chattingwith">
                            <!--<a href='<?= $websiteRoot ?>chat.php'>Home</a>-->
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

                        </div>
                    </div>


                    <div class="chatbox col-xs-8">

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
    
</div>
<!-- CLOSE WRAP -->