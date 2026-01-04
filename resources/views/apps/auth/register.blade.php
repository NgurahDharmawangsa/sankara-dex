<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/yaza-putu/helpers@V2.0.4/libs/libs-core.min.css">
    @vite('resources/css/app.css')
  </head>
  <body>
    <div id="preloader">
      <div class="spinner"></div>
    </div>

    <div class="row g-0 auth-row">
        <div class="col-lg-8">
            <div class="auth-cover-wrapper bg-primary-100">
                <div class="auth-cover">
                    <div class="title text-center">
                        <h1 class="text-primary mb-10">Get Started</h1>
                        <p class="text-medium">
                            Fill the form below to registration your account.
                        </p>
                    </div>
                    <div class="cover-image">
                        <img src="assets/images/auth/signin-image.svg" alt="" />
                    </div>
                    <div class="shape-image">
                        <img src="assets/images/auth/shape.svg" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
        <div class="col-lg-4">
            <div class="signin-wrapper">
                <div class="form-wrapper">
                    <h6 class="mb-15">Register</h6>
                    <p class="text-sm mb-25">
                        Fill the form below to registration your account.
                    </p>
                    <form id="form-register">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Name</label>
                                    <input type="name" id="name" name="name" placeholder="Name" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email" placeholder="Email" />
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" placeholder="Password" />
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button class="main-btn primary-btn btn-hover w-100 text-center" type="submit" id="btn-register">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </form>
                    <div class="singin-option pt-20">
                        <p class="text-sm text-medium text-dark text-center">
                            Do you have any account?
                            <a href="{{ route('login') }}">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <input type="hidden" id="register-url" value="{{ route('register.submit') }}">

    <script src="{{ asset('assets/js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/yaza-putu/helpers@V2.0.4/libs/libs-core.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/yaza-putu/helpers@V2.0.4/helpers.min.js"></script>
    @vite(['resources/js/apps/auth/login.js'])
  </body>
</html>
