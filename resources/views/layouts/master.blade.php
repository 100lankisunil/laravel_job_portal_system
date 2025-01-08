<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Tocly - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href={{ asset('assets/images/favicon.ico') }} />

    <!-- plugin css -->
    <link href={{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }} rel="stylesheet" type="text/css" />

    <!-- Layout Js -->
    <script src={{ asset('assets/js/layout.js') }}></script>
    <!-- Bootstrap Css -->
    <link href={{ asset('assets/css/bootstrap.min.css') }} id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href={{ asset('assets/css/icons.min.css') }} rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href={{ asset('assets/css/app.min.css') }} id="app-style" rel="stylesheet" type="text/css" />

    @yield('page-specific-css')



</head>

<body data-sidebar="colored">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- ========== Header Start ========== -->
        @include("layouts.header")
        <!-- ========== Header end ========== -->


        <!-- ========== Left Sidebar Start ========== -->
        @include("layouts.leftsidebar")
        <!-- ========== Left Sidebar End ========== -->


        <div class="main-content">

            @yield("main-content")
            <!-- End Page-content -->

            <!-- ========== Footer Start ========== -->
            @include("layouts.footer")
            <!-- ========== Footer End ========== -->

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- ========== Right Sidebar Start ========== -->
    @include("layouts.rightsidebar")
    <!-- ========== Right Sidebar End ========== -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src={{ asset('assets/libs/jquery/jquery.min.js') }}></script>
    <script src={{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('assets/libs/metismenu/metisMenu.min.js') }}></script>
    <script src={{ asset('assets/libs/simplebar/simplebar.min.js') }}></script>
    <script src={{ asset('assets/libs/node-waves/waves.min.js') }}></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.0/css/dataTables.dataTables.css" />

    <!-- Vector map-->
    <script src={{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}></script>
    <script src={{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}></script>

    <!-- App js -->
    <script src={{ asset('assets/js/app.js') }}></script>

    @yield('page-specific-scripts')
</body>


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:52:54 GMT -->
</html>
