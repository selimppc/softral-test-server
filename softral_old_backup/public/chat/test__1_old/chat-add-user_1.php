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
                            <a href='<?= $websiteRoot ?>index.php'>Home</a>
                        </div>
                        <div class="users col-xs-12">
                            <?php
                            $add_user_pic = "<img width='20px' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/add_user_group-icon.gif'>";
                            echo "<h4 class='online_green'>Group Name 
                                    <a href='{$websiteRoot}home/chat-new-group'>$add_user_pic</a>
                                  </h4>";
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

                    <div class="chatbox col-xs-9" style="height:auto;">

                        <div id="friend-request" class="chat-header friend-header">
                            <img id="friend_rquest_user_prof_pic" width="35px" height="35px" style="margin-right:5px;" src="<?php echo $websiteRoot; ?>images/grp.png" />
                            <p>
                                <span id="friend_rquest_user_name"> <?= $_GET['grp_name'] ?></span>
                                <input type="text" name="friend_request_user_id" id="friend_request_user_id" class="hide" value="">
                            </p>
                            <div id="reponse-friend-request" class="request">
                                </hr>
                                <h4 class='online_green'>The group members are the following</h4>
                                <?php
                                $sql = $dbh->prepare("SELECT  users FROM chat_usergroup where grp_name = '" . $_GET['grp_name'] . "'");
                                $sql->execute();
                                while ($r = $sql->fetch()) {
                                    $users = unserialize($r['users']);
                                }


                                foreach ($users as $user) {
                                    $delete_user_icon = "<img width='20px' title='Delete this user' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/delete-user.png'>";
                                    $sql = $dbh->prepare("SELECT first_name, last_name FROM user_profile where user_id = $user");
                                    $sql->execute();
                                    while ($r = $sql->fetch()) {
                                        echo "<span class='grp_member'> {$r['first_name']} {$r['last_name']} $delete_user_icon</span>";
                                    }
                                }
                                echo "<h4 class='online_green'>Add Members from the following list</h4>";
                                ?>


                            </div>
                        </div>

                        <div class='msgs'>
                            <?php
                            $sql = $dbh->prepare("SELECT user_id, first_name, last_name, avatar FROM user_profile where user_id not in('" . $_SESSION['id'] . "')");
                            $sql->execute();
                            ?>
                            <table border="1" cellpadding="10" style="background-color: #FFF;">
                                <tr class="even_row">

                                    <?php
                                    $count_column = 1;
                                    $count_row = 1;

                                    while ($r = $sql->fetch()) {

                                        if (!in_array($r['user_id'], $users)) {
                                            //$profile_pic = "<img width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";

                                            $avatar = $r['avatar'];
                                            if (!empty($avatar))
                                                $profile_pic = '<img width="35px" height="35px" style="margin-right:5px;" src="data:image/jpeg;base64,' . base64_encode($avatar) . '"/>';
                                            else {
                                                // TODO@ Check Gender for default Profile Picture
                                                $profile_pic = "<img width='35px' height='35px' style='margin-right:5px;' src='{$websiteRoot}images/man.png'>";
                                            }


                                            $add_user_icon = "<img width='20px' title='Add this user' height='20px' style='margin-right:5px;' src='{$websiteRoot}images/add-user-icon.png'>";
                                            $str = "<div>$profile_pic {$r['first_name']} {$r['last_name']}
                                                        <span class='addusergroup'>
                                                            <input type='text' class='grp_name hide' name='grp_name' value='{$_GET['grp_name']}'>
                                                            <input type='user' class='user hide' name='user' value='{$r['user_id']}'>                                                        
                                                            $add_user_icon
                                                        </span>
                                                </div>";
                                            //$str .=  "<div class='grp_name'>{$r['grp_name']} </div>";


                                            if ($count_column % 2 == 0) {

                                                $class_row = "";
                                                if ($count_row % 2 == 0) {
                                                    $class_row = "even_row";
                                                }
                                                ?><td><?php echo $str ?></td></tr><tr class="<?= $class_row ?>"><?php
                                    $count_row++;
                                } else {
                                                ?><td><?php echo $str ?></td><?php
                                    }

                                    $count_column++;
                                }
                            }
                                    ?>

                            </table>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>


</div>
<!-- CLOSE WRAP -->


<script src="//code.jquery.com/jquery-latest.js"></script>
<script>
    $(".addusergroup").on("click", function(){
        var grp_name = ($(this).find(".grp_name").val());
        var user = ($(this).find(".user").val());
        var baseurl = "<?php echo $websiteRoot ?>";
        $.ajax({
            type: "GET",
            url: baseurl + "chat-save-new-user.php",
            data: {grp_name:grp_name, user:user},
            cache: false,
            success: function(data){
                location.reload();
            }
        });
    });
</script>


<style>
    .even_row{
        background-color: #f6f6f6;
    }

    table, th, td {
        border: 1px solid #e1f2fe;
    }
    table { 
        border-spacing: 10px;
        border-collapse: separate;
    }
</style>
