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
    .form-control:focus{
        text-align: center !important;
    }
    .form-control{
        text-align: center !important;
    }
    @media (min-width: 767px) {
        body {
            height: 100vh !important;
        }
        .card {
            width: 40%;
        }
    }
</style>

<body>
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <div class="row g-0 auth-row h-100">        
        <div class="p-5 d-flex align-items-center justify-content-center vh-100">
            <div class="card shadow" style="border-radius: 10px">
                <div class="card-body p-4">
                    <form method="post" id="form-confirmation" class="digit-group" data-group-name="digits"
                        data-autosubmit="false" autocomplete="off">
                        @csrf
                        <h5 class="card-title">Verification Code</h5>
                        <p class="card-text">We have sent a verification code to your email. Please check your email to
                            get code verification.</p>
                        <div class="text-center">
                            <div class="d-flex justify-content-center mt-4">
                                <input type="text" class="form-control input-digit mx-1" maxlength="1"
                                    oninput="digitValidate(this)" onkeyup="tabChange(1)" id="digit-1"
                                    data-next="digit-2" required />
                                <input type="text" class="form-control input-digit mx-1" maxlength="1"
                                    oninput="digitValidate(this)" onkeyup="tabChange(2)" id="digit-2"
                                    data-next="digit-3" data-previous="digit-1" required />
                                <input type="text" class="form-control input-digit mx-1" maxlength="1"
                                    oninput="digitValidate(this)" onkeyup="tabChange(3)" id="digit-3"
                                    data-next="digit-4" data-previous="digit-2" required />
                                <input type="text" class="form-control input-digit mx-1" maxlength="1"
                                    oninput="digitValidate(this)" onkeyup="tabChange(4)" id="digit-4"
                                    data-next="digit-5" data-previous="digit-3" required />
                                <input type="text" class="form-control input-digit mx-1" maxlength="1"
                                    oninput="digitValidate(this)" onkeyup="tabChange(5)" id="digit-5"
                                    data-next="digit-6" data-previous="digit-4" required />
                                <input type="text" class="form-control input-digit mx-1" maxlength="1"
                                    oninput="digitValidate(this)" onkeyup="tabChange(6)" id="digit-6"
                                    data-next="digit-7" data-previous="digit-5" required />
                            </div>
                            <input type="hidden" name="code" id="code">
                        </div>
                        <p class="text-center mt-4 mb-2">Resend <span id="time"></span></p>

                        <input type="hidden" name="user_id" id="user-id" value="{{ $user_id }}">
                        <input type="hidden" name="verify_source" id="verify-source" value="{{ $verify_source }}">
                        <button class="btn btn-primary d-grid w-100" type="submit"
                            id="btn-submit">Verifikasi</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                            Back to login
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <input type="hidden" id="resend-url"
        value="{{ route('forgot.resend', ['user_id' => $user_id, 'email' => $verify_source]) }}">
    <input type="hidden" id="submit-url"
        value="{{ route('forgot.verification.submit', ['user_id' => $user_id]) }}">

    <script src="{{ asset('assets/js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/yaza-putu/helpers@V2.0.4/libs/libs-core.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/yaza-putu/helpers@V2.0.4/helpers.min.js"></script>
    @vite(['resources/js/apps/auth/forgot-password.js'])
</body>

</html>
