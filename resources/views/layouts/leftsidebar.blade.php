        <div class="vertical-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm-dark.png') }}" alt="logo-sm-dark" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="logo-dark" height="22">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm-light.png') }}" alt="logo-sm-light" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="logo-light" height="22">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <div data-simplebar class="vertical-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="waves-effect">
                                <i class="uim uim-airplay"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('home') }}" class="waves-effect">
                                <i class="uim uim-airplay"></i>
                                <span>Home</span>
                            </a>


                            @if(Auth::user()->role=="employer")
                            <a href="{{ route("job_list") }}" class="waves-effect">
                                <i class="uim uim-airplay"></i>
                                <span>Job List</span>
                            </a>
                            @endif

                            @if(Auth::user()->role=="admin")
                            <a href="{{ route("all_job_list") }}" class="waves-effect">
                                <i class="uim uim-airplay"></i>
                                <span>All Job Lists</span>
                            </a>
                            @endif

                            @if(Auth::user()->role=="admin")
                            <a href="{{ route("all_applications_admin_list") }}" class="waves-effect">
                                <i class="uim uim-airplay"></i>
                                <span>All Applications Lists</span>
                            </a>
                            @endif
                            @if(Auth::user()->role=="employer")
                            <a href="{{ route("all_applications_list",["id"=>Auth::user()->id]) }}" class="waves-effect">
                                <i class="uim uim-airplay"></i>
                                <span>All Applications Lists</span>
                            </a>
                            @endif

                            <a href="{{ route('auth_logout') }}" class="waves-effect">
                                <i class="uim uim-airplay"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>

                </div>
                <!-- Sidebar -->
            </div>


        </div>
