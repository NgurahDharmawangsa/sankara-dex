<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/yaza-putu/helpers@V2.0.4/libs/libs-core.min.css">
    @vite('resources/css/app.css')
</head>

<style>
    @media (min-width: 767px) {
        body{
            height: 100vh !important;
        }
    }
</style>

<body>
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <div class="row g-0 auth-row h-100">
        <div class="col-lg-6 ">
            <div class="auth-cover-wrapper bg-primary-100">
                <div class="auth-cover">
                    <div class="title text-center">
                        <h1 class="text-primary mb-10">Password assistance</h1>
                        <p class="text-medium para-width-500 mx-auto">
                            Enter your username or email to recover your password. You
                            will receive an email with instructions. If you are having
                            problems recovering your password <a href="#0">contact</a>
                        </p>
                    </div>
                    <div class="cover-image">
                        <img src="assets/images/auth/reset-password.svg" alt="" />
                    </div>
                    <div class="shape-image">
                        <img src="assets/images/auth/shape.svg" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
        <div class="p-5 col-lg-6 d-flex align-items-center justify-content-center">
            <div class="reset-password-wrapper">
                <div class="form-wrapper">
                    <h6 class="mb-15">Password assistance</h6>
                    <p class="text-sm mb-25">
                        Enter your username or email to recover your password
                    </p>
                    <form id="form-forgot" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email" placeholder="Email" />
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button type="submit" id="btn-forgot" class="main-btn primary-btn btn-hover w-100 text-center">
                                        Continue
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </form>
                    <div class="d-flex justify-content-between flex-wrap pt-40">
                        <a href="{{ route('login') }}" class="hover-underline"> Sign in </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <input type="hidden" id="forgot-url" value="{{ route('forgot.submit') }}">

    <script src="{{ asset('assets/js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/yaza-putu/helpers@V2.0.4/libs/libs-core.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/yaza-putu/helpers@V2.0.4/helpers.min.js"></script>
    @vite(['resources/js/apps/auth/login.js'])
</body>

</html>
