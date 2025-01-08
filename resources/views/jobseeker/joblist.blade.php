<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Find Jobs </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('jobassets/img/favicon.ico') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('jobassets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jobassets/css/price_rangs.css') }}">
    <link rel="stylesheet" href="{{ asset('jobassets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('jobassets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('jobassets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset("jobassets/css/magnific-popup.css") }}">
    <link rel="stylesheet" href="{{ asset('jobassets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jobassets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('jobassets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('jobassets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('jobassets/css/style.css') }}">
</head>

<body>

    <style>
        .single-job-items {
            padding: 10px 10px;
        }

    </style>

    <header>
        <!-- Header Start -->
        <div class="header-area header-transparrent">
            <div class="headder-top header-sticky">
                <div class="">
                    <div class="align-items-center d-flex" style="justify-content: space-evenly;">
                        <div class="" style="margin-left:111px">
                            <!-- Logo -->
                            <div class="logo">
                                <a href=""><img src="{{ asset('jobassets/img/logo/logo.png') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="">
                            <!-- Main-menu -->
                            <div class="main-menu">
                                <nav class="d-none d-lg-block">
                                    <ul id="navigation">
                                        @if(Auth::id())
                                        @if(Auth::user()->role== "admin" || Auth::user()->role=="employer")
                                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                        @endif
                                        @endif
                                        <li><a href="{{ route("home") }}">Home</a></li>
                                        <li><a href="{{ route("findjobs") }}">Find a Jobs </a></li>
                                        @if(Auth::id())
                                        <li><a href="{{ route('joblist',["id"=>Auth::user()->id]) }}">Your job list</a></li>
                                        @endif
                                        </li>
                                        <li><a href="">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- Header-btn -->
                        <div class="">
                            @if(!(Auth::id()))
                            <a href="{{ route("register") }}" class="btn head-btn1">Register</a>
                            <a href="{{ route("login") }}" class="btn head-btn2">Login</a>
                            @endif
                            @if(Auth::id())
                            <a href="{{ route("auth_logout") }}" class="btn head-btn2">Logout</a>
                            @endif
                        </div>
                        <a href="#" class="btn head-btn2">Post a Job</a>
                        @if(Auth::id())
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="" style="width:20%; margin-right:20px">
                                <img src={{ asset('assets/images/users/avatar-2.jpg') }} class="img-fluid rounded-circle" alt="">
                            </div>
                            <div class="text-start">
                                <span class="fw-medium user-name-text">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>

        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset('jobassets/img/hero/about.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Get your job</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            <div class="container" style="margin-right:0px">
                <div class="row">

                    <!-- Right content -->
                    <div class="col-xl-9 col-lg-9 col-md-8">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="container">
                                <!-- Count of Job list Start -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="count-job mb-35">
                                        </div>
                                    </div>
                                </div>
                                <!-- Count of Job list End -->
                                <!-- single-job-content -->

                                <div>
                                    <div class="text-center">
                                        <h3>YOUR JOB LIST</h3>
                                        <hr>
                                    </div>
                                    <div>
                                        @if($jobs->isEmpty())
                                        <div>
                                            <p>No Jobs Found</p>
                                        </div>
                                        @else
                                        @foreach ($jobs as $row )
                                        <div class="single-job-items mb-30">
                                            <div class="job-items">
                                                {{-- <div class="company-img">
                                            <a href="#"><img src="{{ asset('jobassets/img/icon/job-list1.png') }}" alt=""></a>
                                            </div> --}}
                                            <div class="job-tittle job-tittle2">
                                                <h4>{{ $row->title }}</h4>
                                                <ul>
                                                    <li>{{ $row->posted_by }}</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>{{ $row->location }}</li>
                                                    <li>{{ $row->salary_range }}{{ "K" }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="items-link items-link2 f-right">
                                            <p class="border border-warning rounded text-center ">{{ $row->status }}</p>
                                            <span>Posted - {{ $row->formatted_date }}</span>
                                        </div>
                                    </div>
                                    <hr>
                                    @endforeach
                                    @endif
                                </div>
                            </div>

                    </div>
                    </section>
                    <!-- Featured_job_end -->
                </div>
            </div>
        </div>
        </div>
        <!-- Job List Area End -->

    </main>
    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-bg footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <div class="footer-tittle">
                                    <h4>About Us</h4>
                                    <div class="footer-pera">
                                        <p>Heaven frucvitful doesn't cover lesser dvsays appear creeping seasons so behold.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Contact Info</h4>
                                <ul>
                                    <li>
                                        <p>Address :Your address goes
                                            here, your demo address.</p>
                                    </li>
                                    <li><a href="#">Phone : +8880 44338899</a></li>
                                    <li><a href="#">Email : info@colorlib.com</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Important Link</h4>
                                <ul>
                                    <li><a href="#"> View Project</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Testimonial</a></li>
                                    <li><a href="#">Proparties</a></li>
                                    <li><a href="#">Support</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Newsletter</h4>
                                <div class="footer-pera footer-pera2">
                                    <p>Heaven fruitful doesn't over lesser in days. Appear creeping.</p>
                                </div>
                                <!-- Form -->
                                <div class="footer-form">
                                    <div id="mc_embed_signup">
                                        <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative mail_part">
                                            <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address" class="placeholder hide-on-focus" onfocus="this.placeholder = ''" onblur="this.placeholder = ' Email Address '">
                                            <div class="form-icon">
                                                <button type="submit" name="submit" id="newsletter-submit" class="email_icon newsletter-submit button-contactForm"><img src="{{ asset('jobassets/img/icon/form.png') }}" alt=""></button>
                                            </div>
                                            <div class="mt-10 info"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="row footer-wejed justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <!-- logo -->
                        <div class="footer-logo mb-20">
                            <a href="index.html"><img src="{{ asset('jobassets/img/logo/logo2_footer.png') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="footer-tittle-bottom">
                            <span>5000+</span>
                            <p>Talented Hunter</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="footer-tittle-bottom">
                            <span>451</span>
                            <p>Talented Hunter</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <!-- Footer Bottom Tittle -->
                        <div class="footer-tittle-bottom">
                            <span>568</span>
                            <p>Talented Hunter</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area footer-bg">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-xl-10 col-lg-10 ">
                            <div class="footer-copy-right">
                                <p>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());

                                    </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2">
                            <div class="footer-social f-right">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-globe"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="{{ asset('./jobassets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('./jobassets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('./jobassets/js/popper.min.js') }}"></script>
    <script src="{{ asset('./jobassets/js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('./jobassets/js/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Range -->
    <script src="{{ asset('./jobassets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('./jobassets/js/slick.min.js') }}"></script>
    <script src="{{ asset('./jobassets/js/price_rangs.js') }}"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src={{ asset('jobassets/js/wow.min.js') }}></script>
    <script src={{ asset('jobassets/js/animated.headline.js') }}></script>
    <script src={{ asset('jobassets/js/jquery.magnific-popup.js') }}></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src={{ asset('jobassets/js/jquery.scrollUp.min.js') }}></script>
    <script src={{ asset('jobassets/js/jquery.nice-select.min.js') }}></script>
    <script src={{ asset('jobassets/js/jquery.sticky.js') }}></script>

    <!-- contact js -->
    <script src={{ asset('jobassets/js/contact.js') }}></script>
    <script src={{ asset('jobassets/js/jquery.form.js') }}></script>
    <script src={{ asset('jobassets/js/jquery.validate.min.js') }}></script>
    <script src={{ asset('jobassets/js/mail-script.js') }}></script>
    <script src={{ asset('jobassets/js/jquery.ajaxchimp.min.js') }}></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src={{ asset('jobassets/js/plugins.js') }}></script>
    <script src={{ asset("jobassets/js/main.js") }}></script>

</body>
</html>
