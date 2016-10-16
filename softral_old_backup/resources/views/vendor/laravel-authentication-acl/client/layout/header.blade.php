<header>
    <section style="margin-bottom:-20px;">
        <section class="wrap">
            <div class="container-fluid">
                <div class="col-md-3">
                    <div class="h_left">
                        <!--<div class="logo text-center">Softral<sub>TM</sub></div>-->
                        <div class="logo text-center">
                            <a href="{{ URL::to('/')}}"><img src="{{asset('assets/images/logo-1.png')}}" class="img-responsive"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 text-center">
                    <div class="h_right">
                        <div class="src_form">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail3">Search Text</label>
                                    <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Search">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputPassword3">Category</label>
                                    <select class="form-control">
                                        <option>Type one</option>
                                        <option>Type Two</option>
                                        <option>Type Three</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default sbmt"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="clr">&nbsp;</div>

        <!--=== Navigation Bar ===-->
        <div class="h_full bg_black">
            <section class="wrap">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid bg_black">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav size-13">
                                <li class="active"><a href="#">Home</a></li>
                                <li class=""><a href="#">About Us</a></li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Jobs<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Post a Job</a></li>
                                        <li><a href="#">Search for Job</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Tech Mart</a></li>
                                <li><a href="#">Chat</a></li>
                                <li><a href="#">Members</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Contact Us</a></li>

                            </ul>
                            <ul class="nav navbar-nav navbar-right size-13">
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">My Softral<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">My Profile</a></li>
                                        <li><a href="#">My Setting</a></li>
                                        <li><a href="#">My Proposals</a></li>
                                        <li><a href="#">Save Jobs</a></li>
                                        <li><a href="#">Working Jobs</a></li>
                                        <li><a href="#">Save Users</a></li>
                                        <li><a href="#">My Jobs</a></li>
                                        <li><a href="#">Escrow Contacts</a></li>
                                        <li><a href="#">User Agreements</a></li>
                                        <li><a href="#">My Financial Accounts</a></li>
                                        <li><a href="#">My Workboard</a></li>
                                        <li><a href="#">Customer Service</a></li>
                                    </ul>
                                </li>
                                <!--<li><a href="#"><span class=""></span> My Softral</a></li>-->
                                <li><a href="#" class="sign" data-toggle="modal" data-target="#loginModal">Login</a></li>
                                <li><a href="#" class="sign_1" data-toggle="modal" data-target="#signupModal">Sign Up</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </nav>
            </section>
        </div>
    </section>
</header>


<!--=== Modal Login Start =======================-->
<div class="modal fade bs-example-modal-sm" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content padding-3-3-prcnt bg_trans_white_90" style="margin-top: 35%;">
            <div class="modal-header no-border text-center uppercase">

                <div class="text-center"><img src="{{asset('assets/images/logo-1.png')}}" width="170"></div>
            </div>
            <div class="modal-body moskNormal400">
                <form>

                    <div class="form-group">
                        <input type="text" class=" form-control width_full padding-10-7 black inpt_border " style="background: #ffffff !important; margin-bottom: 3px;" id="user_name" placeholder="username" autofocus="autofocus">

                        <input type="password" class="form-control width_full padding-10-7 black inpt_border " id="user_password" placeholder="password">
                    </div>
                    <div class="form-group">
                        <div class="checkbox pull-left">
                            <label><input type="checkbox" id="remember" name="remember" class="black" checked >Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-danger padding-10-10 btn-block">Login</button>
                        <p class="text-center no-margin margin_top_15 size-12"><a href="#">Having trouble logging in?</a><br>Not a member? <a href="#">Join now</a></p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!--=== Modal Signup Start (Step-1)=======================-->
<div class="modal fade bs-example-modal-md" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bg_trans_white_90" style="margin-top: 5%;">

            <div class="modal-body moskNormal400">
                <div class="col-md-12 no-padding">
                    <div class="col-md-6 text-left"><img src="{{asset('assets/images/logo-1.png')}}" width="170"></div>
                    <div class="col-md-6 text-right lowercase">Already have an account? <button type="submit" class="sign" data-dismiss="modal" data-toggle="modal"  data-target="#loginModal">Login</button></div>
                </div>
                <div class="col-md-12"><div class="border_bottom">&nbsp;</div></div>
                <div class="col-md-12 text-center" style="padding: 2% 0 2% 0 !important;">
                    <h1 class="size-18 line-h-26 tahomabd">Welcome!<br> First, tell us what you're looking for.</h1>
                    <div class="text-center">
                        <img src="{{asset('assets/images/signup-pointer-image.png')}}" class="text-center">
                    </div>
                </div>
                <div class="col-md-12">


                    <div class="col-md-5 col-sm-5 col-lg-5 text-center">
                        <div class="type_box_circle pull-right" data-dismiss="modal" data-toggle="modal"  data-target="#sellerModal">
                            <div class="white type_box_inner">
                                <div class="text-center"><img src="{{asset('assets/images/freelancer-1.png')}}" width="45"></div>
                                <h2 class="size-26">Freelancer</h2>
                                <p class="size-12">Find Freelance projects and grow your business</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-lg-2 text-center relative">
                        <svg height="200" width="100%" >
                            <line x1="50%" y1="0" x2="50%" y2="100%" style="stroke:rgb(80,80,80);stroke-width:1" />
                            <line x1="45%" y1="20%" x2="45%" y2="80%" style="stroke:rgb(80,80,80);stroke-width:1" />
                            <line x1="55%" y1="20%" x2="55%" y2="80%" style="stroke:rgb(80,80,80);stroke-width:1" />
                        </svg>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5 text-center">
                        <div class="type_box_circle pull-left" data-dismiss="modal" data-toggle="modal"  data-target="#buyerModal">
                            <div class="white type_box_inner">
                                <div class="text-center"><img src="{{asset('assets/images/employer-1.png')}}" width="45"></div>
                                <h2 class="size-26">Employer</h2>
                                <p class="size-12">Find, Collaborate with, and pay an expert</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer no-border">

            </div>
        </div>
    </div>
</div>
<!--===== Modal Freelancer Form start ( Step-2.1)==================-->
<div class="modal fade bs-example-modal-lg" id="sellerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content padding-3-3-prcnt bg_green_super_light margin_top_10_prcnt">

            <div class="modal-body moskNormal400">
                <div class="col-md-12 padding-0-0-5-0">

                    <div class="text-center size-25 green_blackish">&blk14; Create a <strong>Freelancer</strong> Account</div>
                </div>
                <div class="col-md-12"><div class="">&nbsp;</div></div>

                <div class="col-md-12">
                    <form>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="First name" class="form-control green_light_border">
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="Email" class="form-control green_light_border">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="username" class="form-control green_light_border">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Last name" class="form-control green_light_border">
                            </div>
                            <div class="form-group">
                                <select class="form-control green_light_border">
                                    <option>Bangladesh</option>
                                    <option>India</option>
                                    <option>Nepal</option>
                                    <option>Bhutan</option>
                                    <option>Myanmar</option>
                                    <option>Pakistan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="password" class="form-control green_light_border">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label class="green_blackish">
                                    <input type="checkbox" checked > Yes, I understand and agree to the Softral Terms of Service.
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#signupModal">&lAarr; Back</button>
                            <button type="submit" class="btn btn-success">&check; Create</button>
                        </div>
                    </form>
                </div>
                <!--</div>-->
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer no-border">&nbsp;</div>
        </div>
    </div>
</div>

<!--===== Modal Employer Form start (step-2.2)==================-->
<div class="modal fade bs-example-modal-lg" id="buyerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content padding-3-3-prcnt bg_white margin_top_10_prcnt">

            <div class="modal-body moskNormal400">
                <div class="col-md-12 padding-0-0-5-0">
                    <
                    <div class="text-center size-25">&blk14; Create a <strong>Employer</strong> Account</div>
                </div>
                <div class="col-md-12"><div class="">&nbsp;</div></div>

                <div class="col-md-12">
                    <form>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="First name" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="username" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Last name" class="form-control">
                            </div>
                            <div class="form-group">
                                <select class="form-control">
                                    <option>Bangladesh</option>
                                    <option>India</option>
                                    <option>Nepal</option>
                                    <option>Bhutan</option>
                                    <option>Myanmar</option>
                                    <option>Pakistan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked > Yes, I understand and agree to the Softral Terms of Service.
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#signupModal">&lAarr; Back</button>
                            <button type="submit" class="btn btn-danger">&check; Create</button>
                        </div>
                    </form>
                </div>
                <!--</div>-->
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer no-border">&nbsp;</div>
        </div>
    </div>
</div>

<!--=== Modal Js ===-->
<script>
    $('#loginModal').on('shown.bs.modal', function () {
        $('#user_name').focus();
    })
    $('#signupModal').on('shown.bs.modal', function () {
        $('#user_name').focus();
    })

</script>
