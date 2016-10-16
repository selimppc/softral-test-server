    <!-- Header-->
    <?php include('header.php'); ?>

    <!-- Body Starts From Here-->
    <article class="bg_gray_super_light">
            <!-- Content -->
            <section class="wrap">
                <div class="container-fluid">
                    <!--<div class="col-md-12">
                        <h1 class="heading-1 padding-2-1-prcnt moskLight200 size-35">
                            <span>About Us</span>
                        </h1>
                    </div>-->
                    <div class="col-md-12"><div class="clearfix h_space_20"></div></div>

                    <!-- For Videos-->
                    <div class="col-md-12 ">
                        <div class="row">
                            <!--=== For Left Pan (Room-1)-->
                            <div class="col-md-8 ">
                                <div class="box-shadow-4 bg_white padding-10-10 ">
                                    <!--Left (Room-2)-->
                                    <div class="col-md-3 text-left padding-5-0-0-0-vw">
                                        <h2 class="size-20 tahomabd">Work History</h2>
                                        <!-- <span class="size-20 red_site">&starf;&starf;&starf;&starf;&star;</span><br>-->
                                        <div class="ratings_white">
                                            <div class="block-inline relative ratings_white_parent">
                                                <?php $rate = 3.5; $rate_rise = (100 * $rate)/5 ?>
                                                <div class="ratings_white_rising" style="width: <?php echo $rate_rise; ?>%;">&nbsp;</div>
                                                <div class="ratings_white_stars absolute" style="z-index: 1;">&nbsp;</div>
                                            </div>
                                        </div>

                                        <span class="size-12 block">77 Hours worked </span>
                                        <span class="size-12 block"> 26 Jobs </span>
                                        <span class="size-12 block"> 80% Job Success</span>
                                        <div class="h_space_20">&nbsp;</div>
                                        <h2 class="size-20 tahomabd">Availability</h2>
                                        <span class="size-12 block">Available </span>
                                        <span class="size-12 block">More than 30 hrs/week</span>
                                        <div class="h_space_20">&nbsp;</div>
                                    </div>
                                    <!--Middle (Room-2)-->
                                    <div class="col-md-6 text-center">
                                        <span class="profile_image_1">
                                            <img src="images/albert-einstein.jpg">
                                        </span>
                                        <div>
                                            <h2 class="padding-5-5 size-30">Name Lastname</h2>
                                            <h4 class="size-20">City, Country</h4>
                                            <h5 class="padding-5-5 size-13 bold">UI/UX, Logo, Web and Graphics Designer</h5>
                                            <h6 class="size-12"><i class="fa fa-map-marker red_site">&nbsp;</i> Sister Bay, United States - 4:35am local time - 8 hours behind</h6>
                                        </div>
                                    </div>
                                    <!--right (Room-2)-->
                                    <div class="col-md-3 text-right padding-5-0-0-0-vw">
                                        <div>
                                            <a href="#" class="btn btn-xs">Edit Profile <i class="fa fa-pencil-square"></i></a><br>
                                            <a href="#" class="btn btn-xs">Edit Settings <i class="fa fa-pencil-square"></i></a>
                                        </div>
                                        <div class="tahomabd size-20 padding-5-0-0-0-vw">$13.00 /hr</div>
                                    </div>
                                    <div class="col-md-12 clearfix"><hr></div>
                                    <div class="col-md-12">
                                        <h2 class="heading-6 padding-0-0-10-0 size-25"><span>Overview</span></h2>
                                        <p>Over the last 6 years, I have developed a wide range of website using ASP.NET, ASP Classic, MVC, Web API, Web Services, Android.</p>
                                        <p>Programming Languages : C#, C++, Visual Basic, Java, Micro Basic, JavaScript
                                            Databases : Microsoft SQL Server Oracle, Mysql
                                            OS Platforms : Microsoft Windows, Mac OSX, Linux
                                            Concepts and technologies : .Net 3.5/4.5, OOP, OOD, Wpf, Linq, .Net Extensions
                                            Markup Languages : Xhtml/Html, Xml, Xaml, JSON, CSS
                                            Web Server : IIS 5-6/7 (Internet information Server), ...more</p>
                                    </div>
                                    <div class="col-md-12 clearfix"><hr class="hr1"></div>
                                    <!--=== Work History Starts -->
                                    <div class="col-md-12">
                                        <h2 class="heading-6 padding-0-0-10-0 size-25"><span>Work History and Feedback</span></h2>
                                        <div class="col-md-12 margin_bottom_10 padding-10-10 box-shadow-1 bg_gray_light">
                                            <div class="col-md-3 no-padding bg_white">
                                                <!--<div class="profile_image_2 bg_white">
                                                    <img src="images/software-01.png">
                                                </div>-->
                                                <div class="padding-5-5 bg_red_site white text-center">
                                                    <h5 class="bold padding-5-0-0-0">Employer's ID</h5>
                                                    <ul class="list-normal size-12">
                                                       <li>City : Dhaka</li>
                                                       <li>State : State</li>
                                                       <li>Country : Bangladesh</li>
                                                    </ul>
                                                </div>
                                                <div class="ratings">
                                                    <div class="block-inline relative ratings_black_parent">
                                                        <?php $rate = 1.5; $rate_rise = (100 * $rate)/5 ?>
                                                        <div class="ratings_black_rising" style="width: <?php echo $rate_rise; ?>%;">&nbsp;</div>
                                                        <div class="ratings_black_stars absolute" style="z-index: 1;">&nbsp;</div>
                                                    </div>
                                                    <span class="ratings_black_text pull-right"><?php echo $rate; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <h2 class="size-16 tahomabd padding-0-0-5-0">Project Title</h2>
                                                <h4 class="size-14 moskNormal400 padding-0-0-10-0">Feb 06</h4>
                                                <div class="size-12">
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                                </div>
                                                <a href="#" class="btn btn-danger uppercase size-11 pull-right">Review</a>
                                            </div>
                                        </div>
                                        <div class="col-md-12 margin_bottom_10 padding-10-10 box-shadow-1 bg_gray_light">
                                            <div class="col-md-3 no-padding bg_white">
                                                <!--<div class="profile_image_2 bg_white">
                                                    <img src="images/software-01.png">
                                                </div>-->
                                                <div class="padding-5-5 bg_blue_1 white text-center">
                                                    <h5 class="bold padding-5-0-0-0">Employer's ID</h5>
                                                    <ul class="list-normal size-12">
                                                       <li>City : Dhaka</li>
                                                       <li>State : State</li>
                                                       <li>Country : Bangladesh</li>
                                                    </ul>
                                                </div>
                                                <div class="ratings">
                                                    <div class="block-inline relative ratings_black_parent">
                                                        <?php $rate = 2.5; $rate_rise = (100 * $rate)/5 ?>
                                                        <div class="ratings_black_rising" style="width: <?php echo $rate_rise; ?>%;">&nbsp;</div>
                                                        <div class="ratings_black_stars absolute" style="z-index: 1;">&nbsp;</div>
                                                    </div>
                                                    <span class="ratings_black_text pull-right"><?php echo $rate; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <h2 class="size-16 tahomabd padding-0-0-5-0">Project Title</h2>
                                                <h4 class="size-14 moskNormal400 padding-0-0-10-0">Feb 06</h4>
                                                <div class="size-12">
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                                </div>
                                                <a href="#" class="btn btn-danger uppercase size-11 pull-right">Review</a>
                                            </div>
                                        </div>
                                        <div class="col-md-12 margin_bottom_10 padding-10-10 box-shadow-1 bg_gray_light">
                                            <div class="col-md-3 no-padding bg_white">
                                                <!--<div class="profile_image_2 bg_white">
                                                    <img src="images/software-01.png">
                                                </div>-->
                                                <div class="padding-5-5 bg_white text-center">
                                                    <h5 class="bold padding-5-0-0-0">Employer's ID</h5>
                                                    <ul class="list-normal size-12">
                                                       <li>City : Dhaka</li>
                                                       <li>State : State</li>
                                                       <li>Country : Bangladesh</li>
                                                    </ul>
                                                </div>
                                                <div class="ratings">
                                                    <div class="block-inline relative ratings_black_parent">
                                                        <?php $rate = 3.7; $rate_rise = (100 * $rate)/5 ?>
                                                        <div class="ratings_black_rising" style="width: <?php echo $rate_rise; ?>%;">&nbsp;</div>
                                                        <div class="ratings_black_stars absolute" style="z-index: 1;">&nbsp;</div>
                                                    </div>
                                                    <span class="ratings_black_text pull-right"><?php echo $rate; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <h2 class="size-16 tahomabd padding-0-0-5-0">Project Title</h2>
                                                <h4 class="size-14 moskNormal400 padding-0-0-10-0">Feb 06</h4>
                                                <div class="size-12">
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                                </div>
                                                <a href="#" class="btn btn-danger uppercase size-11 pull-right">Review</a>
                                            </div>
                                        </div>
                                        <!--<div class="col-md-12 margin_bottom_10 padding-10-10 box-shadow-1 bg_gray_light">
                                            <div class="col-md-3 no-padding bg_white">
                                                <div class="profile_image_2 bg_white">
                                                    <img src="images/software-02.png">
                                                </div>
                                                <div class="ratings">
                                                    <div class="block-inline relative ratings_black_parent">
                                                        <?php /*$rate = 2.5; $rate_rise = (100 * $rate)/5 */?>
                                                        <div class="ratings_black_rising" style="width: <?php /*echo $rate_rise; */?>%;">&nbsp;</div>
                                                        <div class="ratings_black_stars absolute" style="z-index: 1;">&nbsp;</div>
                                                    </div>
                                                    <span class="ratings_black_text pull-right"><?php /*echo $rate; */?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <h2 class="size-16 tahomabd padding-0-0-5-0">Project Title</h2>
                                                <h4 class="size-14 moskNormal400 padding-0-0-10-0">Feb 06</h4>
                                                <div class="size-12">
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                                </div>
                                                <a href="#" class="btn btn-danger uppercase size-11 pull-right">Review</a>
                                            </div>
                                        </div>
                                        <div class="col-md-12 margin_bottom_10 padding-10-10 box-shadow-1 bg_gray_light">
                                            <div class="col-md-3 no-padding bg_white">
                                                <div class="profile_image_2 bg_white">
                                                    <img src="images/software-04.png">
                                                </div>
                                                <div class="ratings">
                                                    <span class="size-20 red_site padding-0-10">&starf;&starf;&starf;&starf;&star;</span>
                                                    <span class="block-inline white">3.5</span>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <h2 class="size-16 tahomabd padding-0-0-5-0">Project Title</h2>
                                                <h4 class="size-14 moskNormal400 padding-0-0-10-0">Feb 06</h4>
                                                <div class="size-12">
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                                </div>
                                                <a href="#" class="btn btn-danger uppercase size-11 pull-right">Review</a>
                                            </div>
                                        </div>-->

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- End of left pan (Room-1)-->

                            <!--=== For Right Pan (Room-1)-->
                            <div class="col-md-4 ">
                                <div class="box-shadow-4 bg_white padding-10-10 ">
                                    <h2 class="size-20 tahomabd padding-0-0-10-0 heading-2"><span>Languages</span></h2>
                                    <ul class="list-1 size-13">
                                        <li>English : Fluent</li>
                                        <li>Portuguese : Native or Bilingual</li>
                                        <li>Spanish, Castilian : Conversational</li>
                                    </ul>
                                    <div class="h_space_20"></div>
                                    <h2 class="size-20 tahomabd padding-0-0-10-0 heading-2"><span>Verifications</span></h2>
                                    <p class="size-13">Phone Number : Verified</p>
                                    <div class="h_space_20"></div>
                                    <h2 class="size-20 tahomabd padding-0-0-10-0 heading-2"><span>Groups</span></h2>
                                    <ul class="list-normal">
                                        <li class="margin_bottom_10">
                                            <div class="group">
                                                <div class="group_img"><img src="images/magento.jpg" width="100%"></div>
                                                <div class="group_text">
                                                    <h2 class="size-13 bold">Magento Developer</h2>
                                                    <!--<span class="size-20 red_site">&starf;&starf;&starf;&starf;&star;</span>-->
                                                    <div class="ratings_white">
                                                        <div class="block-inline relative ratings_white_parent">
                                                            <?php $rate = 3.5; $rate_rise = (100 * $rate)/5 ?>
                                                            <div class="ratings_white_rising" style="width: <?php echo $rate_rise; ?>%;">&nbsp;</div>
                                                            <div class="ratings_white_stars absolute" style="z-index: 1;">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </li>
                                        <li class="margin_bottom_10">
                                            <div class="group">
                                                <div class="group_img"><img src="images/wordpress.png" width="100%"></div>
                                                <div class="group_text">
                                                    <h2 class="size-13 bold">Wordpress Developer</h2>
                                                    <!--<span class="size-20 red_site">&starf;&starf;&starf;&star;&star;</span>-->
                                                    <div class="ratings_white">
                                                        <div class="block-inline relative ratings_white_parent">
                                                            <?php $rate = 2.5; $rate_rise = (100 * $rate)/5 ?>
                                                            <div class="ratings_white_rising" style="width: <?php echo $rate_rise; ?>%;">&nbsp;</div>
                                                            <div class="ratings_white_stars absolute" style="z-index: 1;">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </li>
                                        <li class="margin_bottom_10">
                                            <div class="group">
                                                <div class="group_img"><img src="images/joomla.png" width="100%"></div>
                                                <div class="group_text">
                                                    <h2 class="size-13 bold">Joomla Developer</h2>
                                                    <!--<span class="size-20 red_site">&starf;&starf;&star;&star;&star;</span>-->
                                                    <div class="ratings_white">
                                                        <div class="block-inline relative ratings_white_parent">
                                                            <?php $rate = 1.5; $rate_rise = (100 * $rate)/5 ?>
                                                            <div class="ratings_white_rising" style="width: <?php echo $rate_rise; ?>%;">&nbsp;</div>
                                                            <div class="ratings_white_stars absolute" style="z-index: 1;">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </li>
                                        <li class="margin_bottom_10">
                                            <div class="group">
                                                <div class="group_img"><img src="images/mysql.png" width="100%"></div>
                                                <div class="group_text">
                                                    <h2 class="size-13 bold">Mysql Developer</h2>
                                                    <!--<span class="size-20 red_site">&starf;&starf;&starf;&starf;&star;</span>-->
                                                    <div class="ratings_white">
                                                        <div class="block-inline relative ratings_white_parent">
                                                            <?php $rate = 3.5; $rate_rise = (100 * $rate)/5 ?>
                                                            <div class="ratings_white_rising" style="width: <?php echo $rate_rise; ?>%;">&nbsp;</div>
                                                            <div class="ratings_white_stars absolute" style="z-index: 1;">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!--End of right pan (Room-1)-->
                        </div>
                        <div class="h_space_20"></div><!--<div class="h_space_20"></div>-->
                    </div>
                </div>

            </section>
    </article>

    <!-- Bottom Boxes -->
    <?php include("bottom_box.php"); ?>

    <!-- Footer -->
    <?php include('footer.php'); ?>