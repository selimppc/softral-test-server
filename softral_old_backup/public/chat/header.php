<?php
ob_start();
@session_start();

include 'config.php';

if (!isset($_REQUEST['adminId']) || ($_REQUEST['adminId'] == null)) {
   // header('Location: http://localhost:81/client_projects/softral1/public');
}



include('classes/database.php');
include('classes/main.php');
/* $request = $_SERVER['REQUEST_URI'];
  $request = explode("/",$request); */

$main = new main();
$rootUser = $main->fetchAdminDetails($_REQUEST['adminId']);
$GLOBALS['user_id'] = $rootUser->users_id;
$GLOBALS['user_url'] = $rootUser->url;
$_SESSION['netnoor']['pageRoot'] = $websiteRoot . $_REQUEST['adminId'] . '/';

$globalConfiguration = $main->fetchGlobalConfigurationDetails();
$personalConfiguration = $main->fetchPersonalConfigurationDetails($GLOBALS['user_id']);

//print_r($_SESSION['netnoor']['pageRoot']);
//exit;
//$GLOBALS['user_id'] = 8;
//print_r($_REQUEST);
//exit;
?>
<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en-US"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en-US"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en-US"> <!--<![endif]-->
    <head>
        <!-- Meta Tags -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- Mobile Specifics -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Title -->

        <title>NetNoor Post</title>
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600italic,700,700italic,800italic,800,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

        <link href="<?= $websiteRoot; ?>css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?= $websiteRoot; ?>css/animate.css" rel="stylesheet" type="text/css"/>
        <link href="<?= $websiteRoot; ?>css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?= $websiteRoot; ?>css/wp.css" rel="stylesheet" type="text/css"/>
        <link href="<?= $websiteRoot; ?>css/css-generate.css" rel="stylesheet" type="text/css"/>
        <link href="<?= $websiteRoot; ?>css/fonts.css" rel="stylesheet" type="text/css"/>
        <link href="<?= $websiteRoot; ?>css/chat-chat.css" rel="stylesheet" type="text/css"/>
        <link href="<?= $websiteRoot; ?>css/emoticons.css" rel="stylesheet" type="text/css"/>
        <link href="<?= $websiteRoot; ?>css/fileupload/styles.css" rel="stylesheet" type="text/css"/>
		

        <!--<link href="/css/ucstyle.css" rel="stylesheet" type="text/css"/>-->
        
        
        
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        <script type='text/javascript' src="<?= $websiteRoot; ?>js/jquery-1.11.1.js"></script> <!--jQuery Main Library -->
        
        
        <!--<script type='text/javascript' src="<?= $websiteRoot; ?>js/jquery.js"></script>-->
        <!--<script type='text/javascript' src="<?= $websiteRoot; ?>js/jquery-migrate.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="<?= $websiteRoot; ?>js/jstz-1.0.5.min.js"></script>-->

        <?php
        if ($globalConfiguration != null) {
            ?>
            <style>
                #wrap{
                    <?php
                    if ($globalConfiguration->isSiteBackgroundImageActive == 1) {
                        ?>
                        background-image:url('/admin/upload/<?= $globalConfiguration->siteBackgroundImage ?>') !important;
                        <?php
                    } else {
                        ?>
                        /*background-color:<?= $globalConfiguration->siteBackgroundColor ?> !important;*/
                        <?php
                    }
                    ?>
                }
                <?php
                if ($globalConfiguration->lnkHomeBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkHome{
                        background-color:<?= $globalConfiguration->lnkHomeBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkHomeColor != null) {
                    ?>
                    #header-menu ul.menu #lnkHome a{
                        color:<?= $globalConfiguration->lnkHomeColor ?> !important;
                        border-bottom:1px solid <?= $globalConfiguration->linkHomeColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkCategoriesBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkCategories{
                        background-color:<?= $globalConfiguration->lnkCategoriesBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkCategoriesColor != null) {
                    ?>
                    #header-menu ul.menu #lnkCategories a{
                        color:<?= $globalConfiguration->lnkCategoriesColor ?> !important;
                        border-bottom:1px solid <?= $globalConfiguration->lnkCategoriesColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkRSSFeedsBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkRSSFeeds{
                        background-color:<?= $globalConfiguration->lnkRSSFeedsBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkRSSFeedsColor != null) {
                    ?>
                    #header-menu ul.menu #lnkRSSFeeds a{
                        color:<?= $globalConfiguration->lnkRSSFeedsColor ?> !important;
                        border-bottom:1px solid <?= $globalConfiguration->lnkRSSFeedsColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkLoginBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkLogin{
                        background-color:<?= $globalConfiguration->lnkLoginBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkLoginColor != null) {
                    ?>
                    #header-menu ul.menu #lnkLogin a{
                        color:<?= $globalConfiguration->lnkLoginColor ?> !important;
                        border-bottom:1px solid <?= $globalConfiguration->lnkLoginColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkRegisterBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkRegister{
                        background-color:<?= $globalConfiguration->lnkRegisterBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkRegisterColor != null) {
                    ?>
                    #header-menu ul.menu #lnkRegister a{
                        color:<?= $globalConfiguration->lnkRegisterColor ?> !important;
                        border-bottom:1px solid <?= $globalConfiguration->lnkRegisterColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkAddBlogBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkAddBlog{
                        background-color:<?= $globalConfiguration->lnkAddBlogBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkAddBlogColor != null) {
                    ?>
                    #header-menu ul.menu #lnkAddBlog a{
                        color:<?= $globalConfiguration->lnkAddBlogColor ?> !important;
                        border-bottom:1px solid <?= $globalConfiguration->lnkAddBlogColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkManageBlogBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkManageBlog{
                        background-color:<?= $globalConfiguration->lnkManageBlogBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkManageBlogColor != null) {
                    ?>
                    #header-menu ul.menu #lnkManageBlog a{
                        color:<?= $globalConfiguration->lnkManageBlogColor ?> !important;
                        border-bottom:1px solid <?= $globalConfiguration->lnkManageBlogColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkContactBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkContact{
                        background-color:<?= $globalConfiguration->lnkContactBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkContactColor != null) {
                    ?>
                    #header-menu ul.menu #lnkContact a{
                        color:<?= $globalConfiguration->lnkContactColor ?> !important;
                        border-bottom:1px solid <?= $globalConfiguration->lnkContactColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkLogoutBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkLogout{
                        background-color:<?= $globalConfiguration->lnkLogoutBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->lnkLogoutColor != null) {
                    ?>
                    #header-menu ul.menu #lnkLogout a{
                        color:<?= $globalConfiguration->lnkLogoutColor ?> !important;
                        border-bottom:1px solid <?= $globalConfiguration->lnkLogoutColor ?> !important;
                    }
                    <?php
                }
                if ($globalConfiguration->blogTitleColor != null) {
                    ?>
                    .post-title a,.blog-title a{
                        color:<?= $globalConfiguration->blogTitleColor ?>;
                    }
                    <?php
                }
                if ($globalConfiguration->blogDescriptionColor != null) {
                    ?>
                    .post-content p,.blog-description{
                        color:<?= $globalConfiguration->blogDescriptionColor ?>;
                    }
                    <?php
                }
                if ($globalConfiguration->blogImageHeight != 0) {
                    ?>
                    .featured-image img{
                        height:<?= $globalConfiguration->blogImageHeight ?>px;
                    }
                    <?php
                }
                if ($globalConfiguration->blogImageWidth != 0) {
                    ?>
                    .featured-image img{
                        width:<?= $globalConfiguration->blogImageWidth ?>px;
                    }
                    <?php
                }
                if ($globalConfiguration->footerColor != null) {
                    ?>
                    footer p,footer a,footer li span{
                        color:<?= $globalConfiguration->footerColor ?> !important;
                    }
                    <?php
                }
                ?>

                #header-menu ul.menu li{
                    background-color:<?= $globalConfiguration->linkBackgroundColor ?> !important;
                }
                #header-menu ul.menu li, #header-menu ul.menu li a{
                    color:<?= $globalConfiguration->linkColor ?> !important;
                }
                #header-menu ul.menu li a{
                    border-bottom:1px solid <?= $globalConfiguration->linkColor ?> !important;
                }

            </style>
            <?php
        }
        if ($personalConfiguration != null) {
            ?>
            <style>
                #wrap{
                    <?php
                    if ($personalConfiguration->isSiteBackgroundImageActive == 1) {
                        ?>
                        background-image:url('/admin/upload/<?= $personalConfiguration->siteBackgroundImage ?>') !important;
                        <?php
                    } else {
                        ?>
                        /*background-color:<?= $personalConfiguration->siteBackgroundColor ?> !important;*/
                        <?php
                    }
                    ?>
                }
                <?php
                if ($personalConfiguration->lnkHomeBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkHome{
                        background-color:<?= $personalConfiguration->lnkHomeBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkHomeColor != null) {
                    ?>
                    #header-menu ul.menu #lnkHome a{
                        color:<?= $personalConfiguration->lnkHomeColor ?> !important;
                        border-bottom:1px solid <?= $personalConfiguration->linkHomeColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkCategoriesBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkCategories{
                        background-color:<?= $personalConfiguration->lnkCategoriesBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkCategoriesColor != null) {
                    ?>
                    #header-menu ul.menu #lnkCategories a{
                        color:<?= $personalConfiguration->lnkCategoriesColor ?> !important;
                        border-bottom:1px solid <?= $personalConfiguration->lnkCategoriesColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkRSSFeedsBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkRSSFeeds{
                        background-color:<?= $personalConfiguration->lnkRSSFeedsBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkRSSFeedsColor != null) {
                    ?>
                    #header-menu ul.menu #lnkRSSFeeds a{
                        color:<?= $personalConfiguration->lnkRSSFeedsColor ?> !important;
                        border-bottom:1px solid <?= $personalConfiguration->lnkRSSFeedsColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkLoginBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkLogin{
                        background-color:<?= $personalConfiguration->lnkLoginBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkLoginColor != null) {
                    ?>
                    #header-menu ul.menu #lnkLogin a{
                        color:<?= $personalConfiguration->lnkLoginColor ?> !important;
                        border-bottom:1px solid <?= $personalConfiguration->lnkLoginColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkRegisterBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkRegister{
                        background-color:<?= $personalConfiguration->lnkRegisterBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkRegisterColor != null) {
                    ?>
                    #header-menu ul.menu #lnkRegister a{
                        color:<?= $personalConfiguration->lnkRegisterColor ?> !important;
                        border-bottom:1px solid <?= $personalConfiguration->lnkRegisterColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkAddBlogBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkAddBlog{
                        background-color:<?= $personalConfiguration->lnkAddBlogBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkAddBlogColor != null) {
                    ?>
                    #header-menu ul.menu #lnkAddBlog a{
                        color:<?= $personalConfiguration->lnkAddBlogColor ?> !important;
                        border-bottom:1px solid <?= $personalConfiguration->lnkAddBlogColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkManageBlogBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkManageBlog{
                        background-color:<?= $personalConfiguration->lnkManageBlogBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkManageBlogColor != null) {
                    ?>
                    #header-menu ul.menu #lnkManageBlog a{
                        color:<?= $personalConfiguration->lnkManageBlogColor ?> !important;
                        border-bottom:1px solid <?= $personalConfiguration->lnkManageBlogColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkContactBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkContact{
                        background-color:<?= $personalConfiguration->lnkContactBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkContactColor != null) {
                    ?>
                    #header-menu ul.menu #lnkContact a{
                        color:<?= $personalConfiguration->lnkContactColor ?> !important;
                        border-bottom:1px solid <?= $personalConfiguration->lnkContactColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkLogoutBackgroundColor != null) {
                    ?>
                    #header-menu ul.menu #lnkLogout{
                        background-color:<?= $personalConfiguration->lnkLogoutBackgroundColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->lnkLogoutColor != null) {
                    ?>
                    #header-menu ul.menu #lnkLogout a{
                        color:<?= $personalConfiguration->lnkLogoutColor ?> !important;
                        border-bottom:1px solid <?= $personalConfiguration->lnkLogoutColor ?> !important;
                    }
                    <?php
                }
                if ($personalConfiguration->blogTitleColor != null) {
                    ?>
                    .post-title a,.blog-title a{
                        color:<?= $personalConfiguration->blogTitleColor ?>;
                    }
                    <?php
                }
                if ($personalConfiguration->blogDescriptionColor != null) {
                    ?>
                    .post-content p,.blog-description{
                        color:<?= $personalConfiguration->blogDescriptionColor ?>;
                    }
                    <?php
                }
                if ($personalConfiguration->blogImageHeight != 0) {
                    ?>
                    .featured-image img{
                        height:<?= $personalConfiguration->blogImageHeight ?>px;
                    }
                    <?php
                }
                if ($personalConfiguration->blogImageWidth != 0) {
                    ?>
                    .featured-image img{
                        width:<?= $personalConfiguration->blogImageWidth ?>px;
                    }
                    <?php
                }
                if ($personalConfiguration->footerColor != null) {
                    ?>
                    footer p,footer a,footer li span{
                        color:<?= $personalConfiguration->footerColor ?> !important;
                    }
                    <?php
                }
                ?>

                #header-menu ul.menu li{
                    background-color:<?= $personalConfiguration->linkBackgroundColor ?> !important;
                }
                #header-menu ul.menu li, #header-menu ul.menu li a{
                    color:<?= $personalConfiguration->linkColor ?> !important;
                }
                #header-menu ul.menu li a{
                    border-bottom:1px solid <?= $personalConfiguration->linkColor ?> !important;
                }
            </style>
            <?php
        }
        ?>


        <script>

            
            function setOnlineStatus(){
                var base_url = "<?php echo $websiteRoot ?>";
                $.post(base_url + "chat-change-user-online-status.php",{
                    status: 'on'//status: 'away'
                },function(response){
                    //If response 1 then user online status updated to on successsfully
                });
            }
            
            setInterval(function(){
                // Online status is sending to server after each 5 seconds
                setOnlineStatus();
            },9000);
        </script>


    </head>
    <body>