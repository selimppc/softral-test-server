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


                        <?php echo $first_name . " " . $last_name; ?>
                        <p class="hide">User Type  <input type="text"  value="" name="usertype" class="form-control" id="usertype"></p>
                        <!--<a href="logout.php">Logout</a>-->
                    </div>
                </div>



                <div class="row">


                    <div class="col-md-12">
                        <div class="input-group" id="adv-search" style="margin-top:10px; margin-bottom: 10px">
                            <input id="chatbox-left-panel-search" type="text" class="form-control" placeholder="Search from Softral Directory" />
                            <span id="searchclear" class="glyphicon glyphicon-remove-circle hide"></span>
                            <div class="input-group-btn">
                                <div class="btn-group" role="group">
                                    <div class="dropdown dropdown-lg">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <label for="filter">Search in</label>
                                                    <select id="search_from" name="search_from" class="form-control">

                                                        <option value="softral_db" selected>Softral Directory</option>
                                                        <option value="my_contacts">My Contacts</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
<!--  <p class="chat-header-menu">
                    <span class="home">Home</span> |
                    <span class="recent">Recent</span> |
                    <span class="contacts">Contacts</span>
                    <span class="groups">Groups</span> |
                    <span class="pending-requests">Pending Request<sup id="no-of-pending-request">*</sup></span>
                    <span class="pending-requests" title="Pending Request" id="no-of-pending-request"></span>
                </p>-->

                <p class="chat-header-menu">
                    <span class="home chat-left-menu" title="Home"><img height="20" wdith="20" src="<?php echo $websiteRoot; ?>images/home24-24.png"></span>
                    <span class="recent chat-left-menu" title="Recent Messages"><img height="20" wdith="20" src="<?php echo $websiteRoot; ?>images/time-24.png"></span>
                    <span class="contacts chat-left-menu" title="My Contacts"><img height="20" wdith="20" src="<?php echo $websiteRoot; ?>images/my_contacts_new.png"></span>
                    <!--<span style="margin-right:15px" class="groups" title="My Groups"><img src="<?php echo $websiteRoot; ?>images/grp.png" wdith='20' height='20'></span>-->
                    <!--<span class="groups chat-left-menu" title="My Groups"><img src="<?php echo $websiteRoot; ?>images/groups-24.png" wdith='20' height='20'></span>-->
                    
                    <span class="pending-requests chat-left-menu hide" title="Pending Request" id="no-of-pending-request">
                        
                        <!--<img height="20" src="http://localhost/softral/images/Profile_AddFriend-24.png" wdith="20"><sup style="color:red">1</sup>-->
                        
                    </span>
                </p>


                <div class="all-conversation hide" id="all-netnoor-user"></div>


            </div>
            <div class="row"> 
                <div class="users col-xs-12">
                    <?php $usertype = 'recent'; ?>
                    <?php include("chat-users.php"); ?>
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
<style>
    .chat-left-menu{
        margin-right: 15px; 
        display: inline-block; 
        /*background-color: #c2cfa7;*/ 
        /*background-color: #c0f0ea;*/

        background-color: #e3f3f3;


        /*background-color: #e3f3f3;*/ 
        /*#d5e7ba;*/ 
        border-radius: 30px; 
        width: 30px; 
        height: 30px; 
        text-align: center; 
        line-height: 27px;
    }
    .chat-left-menu:hover{
        /*background-color: #ecfcd1;*/

        background-color: #ecfcd1; 


        /*background-color: #60cd8a;*/
        /*background-color: #38a562;*/
    }
    .chat-left-menu-active{
        /*background-color: #60cd8a;*/
        /*background-color: #168340;*/
        background-color: #c0f0ea;
    }
    /*38a562*/
    /*#6bd895*/


    #searchclear {
        position: absolute;
        right: 75px;
        top: 0;
        bottom: 0;
        height: 14px;
        margin: auto;
        font-size: 14px;
        cursor: pointer;
        color: #ccc;
        z-index: 3;
    }
</style>