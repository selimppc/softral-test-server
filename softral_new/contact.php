<!-- Header-->
<?php include('header.php'); ?>
<?php
//$arr = array();
//for($i=1000;$i<=1400;$i+200){
//for($i=10;$i<=14;$i+2){
//echo $i.'<br>';
//$arr[] = $i;
//}
//echo count($arr);
?>
<!-- Body Starts From Here-->
<article class="bg_gray_super_light">
    <!-- Slider -->
    <?php //include("_slider.blade.php"); ?>
    <!-- News Ticker -->
    <?php include("_newsticker.php"); ?>

    <!-- Content -->
    <section class="wrap">
        <div class="container-fluid">
            <div class="col-md-12">
                <h1 class="heading-1 padding-2-1-prcnt moskLight200 size-35">
                    <span>Contact Us </span>
                </h1>
            </div>
            <div class="col-md-12"><div class="clearfix h_space_20"></div></div>
            <!-- For Contact Form-->
            <div class="col-md-8 ">
                <div class="col-md-12 padding-3-3-prcnt bg_white box-shadow-4">
                    <form>
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="control-label">First name</label>
                                    <input type="text" class="form-control" placeholder="Enter your Name">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Enter your email">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group ">
                                    <label class="control-label">Last name</label>
                                    <input type="text" class="form-control" placeholder="Enter your lastname">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Contact Number</label>
                                    <input type="password" class="form-control">
                                </div>
                                <!--<div class="form-group">
                                    <label class="control-label">First name</label>
                                    <select class="form-control">
                                        <option>Select Country</option>
                                        <option>Bangladesh</option>
                                        <option>India</option>
                                        <option>Nepal</option>
                                        <option>Bhutan</option>
                                        <option>Myanmar</option>
                                        <option>Pakistan</option>
                                    </select>
                                </div>-->
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">City</label>
                                            <input type="text" class="form-control" placeholder="Enter your City">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">State</label>
                                            <input type="text" class="form-control" placeholder="Enter your State">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Country</label>
                                            <input type="text" class="form-control" placeholder="Enter your Country">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Subject</label>
                                    <input type="text" class="form-control" placeholder="Enter your Subject">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Your Message</label>
                                    <textarea class="form-control" rows="5" placeholder="Type in your Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Captcha code here">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="bordered padding-10-10">captcha image</div>
                                </div>
                            </div>
                            <div class="col-md-12 text-left">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- For Contact form right pan-->
            <div class="col-md-4">
                <div class="col-md-12 padding-3-3-prcnt bg_white box-shadow-4">
                    <h2 class="size-20 red_site">Contacting us:</h2>

                    <ul class=" list-normal padding-10-10">
                        <li class="margin_bottom_3"><i class="fa fa-phone border_width_2 border_solid border_semiblack block-inline border-radius-50-prcnt w-h-25 padding-5-5 size-14">&nbsp;</i>&nbsp;: +1 251-633-0801</li>
                        <li class="margin_bottom_3"><i class="fa fa-envelope border_width_2 border_solid border_semiblack block-inline border-radius-50-prcnt w-h-25 padding-5-5 size-12">&nbsp;</i>&nbsp;: Admin@softral.com</li>
                        <li class="margin_bottom_3"><i class="fa fa-facebook border_width_2 border_solid border_semiblack block-inline border-radius-50-prcnt w-h-25 padding-6-6 size-14">&nbsp;</i>&nbsp;: SOFTRAL2</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clearfix h_space_20"></div>
    </section>
</article>


<!-- Bottom Boxes -->
<?php include("bottom_box.php"); ?>

<!-- Footer -->
<?php include('footer.php'); ?>