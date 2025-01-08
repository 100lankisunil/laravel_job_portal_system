<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/tocly/layouts/5.3.1/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Nov 2023 08:53:06 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Layout Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />



</head>

<body>
    <div class="auth-maintenance d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">
                                <div class="text-center mb-4">
                                    <a href="" class="">
                                        <img src={{ asset('assets/images/logo-dark.png') }} alt="" height="22" class="auth-logo logo-dark mx-auto">
                                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="22" class="auth-logo logo-light mx-auto">
                                    </a>

                                </div>

                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            <div class="bg-overlay bg-primary"></div>
                                            <div class="h-100 bg-auth align-items-end">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18">Welcome !</h4>
                                                        <p class="text-muted">Sign in to continue.</p>
                                                    </div>

                                                    <form action="" class="auth-input" id="loginform">
                                                        @csrf
                                                        <div class="mb-2">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="password">Password</label>
                                                            <input type="password" class="form-control" placeholder="Enter password" id="password" name="password">
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                        </div>
                                                        <div class="mt-3">
                                                            <input class="btn btn-primary w-100" type="submit" value="Sign In">
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <p class="mb-0">Don't have an account ? <a href="{{ route('register') }}" class="fw-medium text-primary"> Register </a> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->

                                <div class="mt-5 text-center">
                                    <p class="mb-0">© <script>
                                            document.write(new Date().getFullYear())

                                        </script> Tocly. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>

<script>
    $(document).ready(function() {

        $("#loginform").validate({
            rules: {
                email: {
                    required: true
                    , email: true
                }
                , password: {
                    required: true
                    , minlength: 3
                }
            }
            , messages: {
                email: {
                    required: "Please enter your email"
                    , email: "Please enter a valid email address"
                }
                , password: {
                    required: "Please enter your password"
                }
            }
            , submitHandler: function(form, event) {
                // Prevent default form submission
                event.preventDefault();

                const formData = $(form).serialize(); // Serialize form data

                // Submit the form data via AJAX
                $.ajax({
                    type: "POST"
                    , url: "http://localhost:8000/authentication/login"
                    , data: formData
                    , success: function(response) {
                        console.log(response);
                        if (response.status == true) {
                            Swal.fire({
                                title: "Login Successful"
                                , icon: "success"
                                , draggable: true
                            }).then(() => {
                                window.location.href = response.redirect_url;
                            });
                            $("#loginform")[0].reset();
                        }
                        if (response.status == false) {
                            Swal.fire({
                                icon: "error"
                                , title: "Oops..."
                                , text: "login failed"
                            });
                        }
                    }
                    , error: function(error) {
                        console.log(error); // Log error response
                        alert("An error occurred. Please try again."); // Optional error message
                    }
                });
            }
        });


    });

</script>
