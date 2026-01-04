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
    <style>
        .auth-row {
            background: url("{{ asset('assets/images/auth/bg-auth.svg') }}");
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <div class="row g-0 auth-row">
        <div class="col-lg-8">
            <div class="auth-cover-wrapper">
                <div class="auth-cover">
                    <div class="title text-center">
                        <h1 class="text-dark mb-10"> <svg height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 392.663 392.663" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <polygon style="fill:#56ACE0;" points="167.758,310.432 147.588,350.901 244.945,350.901 224.776,310.432 "></polygon> <path style="fill:#FFFFFF;" d="M360.986,41.762H31.547c-5.301,0-9.632,4.331-9.632,9.632v227.556c0,5.301,4.331,9.632,9.632,9.632 h329.568c5.301,0,9.632-4.331,9.632-9.632V51.394C370.747,46.093,366.416,41.762,360.986,41.762z"></path> <path style="fill:#194F82;" d="M360.986,19.911H31.547C14.158,19.911,0,34.069,0,51.459v227.556 c0,17.39,14.158,31.547,31.547,31.547h111.903l-23.208,46.416c-3.62,7.24,1.616,15.774,9.762,15.774h132.655 c8.145,0,13.382-8.469,9.762-15.774l-23.208-46.416h111.903c17.39,0,31.547-14.158,31.547-31.547V51.459 C392.533,34.069,378.376,19.911,360.986,19.911z M370.747,279.014c0,5.301-4.331,9.632-9.632,9.632H31.547 c-5.301,0-9.632-4.331-9.632-9.632V51.459c0-5.301,4.331-9.632,9.632-9.632h329.568c5.301,0,9.632,4.331,9.632,9.632V279.014z M147.588,350.901l20.17-40.404h57.018l20.17,40.404H147.588z"></path> <path style="fill:#FFC10D;" d="M338.036,63.547H54.562c-6.012,0-10.925,4.848-10.925,10.925v1.422h25.277 c6.012,0,10.925,4.848,10.925,10.925c0,6.077-4.848,10.925-10.925,10.925H43.636v18.941h1.616c6.012,0,10.925,4.848,10.925,10.925 c0,6.012-4.848,10.925-10.796,10.925h-1.681v117.592c0,6.012,4.848,10.925,10.925,10.925h283.539 c6.012,0,10.925-4.848,10.925-10.925V74.473C349.026,68.461,344.048,63.547,338.036,63.547z"></path> <circle style="fill:#FFFFFF;" cx="188.38" cy="164.978" r="27.927"></circle> <g> <path style="fill:#194F82;" d="M230.529,191.03c4.719-7.564,7.434-16.485,7.434-26.053c0-27.345-22.174-49.519-49.519-49.519 s-49.519,22.174-49.519,49.519c0,27.345,22.174,49.519,49.519,49.519c9.891,0,19.071-2.909,26.828-7.952l41.051,41.051 c4.267,4.267,11.119,4.267,15.451,0c4.267-4.202,4.267-11.055,0-15.386L230.529,191.03z M188.38,192.84 c-15.386,0-27.927-12.412-27.927-27.927c0-15.386,12.541-27.927,27.927-27.927s27.927,12.541,27.927,27.927 C216.307,180.364,203.766,192.84,188.38,192.84z"></path> <path style="fill:#194F82;" d="M74.667,136.598h27.604v43.636c0,11.766-7.758,13.576-10.667,13.576 c-6.077,0-11.96-3.038-17.519-9.051l-10.796,14.933c8.339,8.598,18.101,12.929,29.285,12.929c8.986,0,30.578-3.297,30.578-33.164 V118.82h-48.42v17.778H74.667z"></path> <path style="fill:#194F82;" d="M335.386,186.053c-0.259-19.523-19.006-22.497-19.006-22.497s13.77-3.232,13.77-20.17 c0-26.893-32.905-24.63-32.905-24.63h-36.331v93.22h40.792C337.002,213.01,335.386,186.053,335.386,186.053z M281.665,136.339 h0.065h9.956c6.723,0.323,17.131-0.84,16.937,10.214c0,5.43-1.228,9.891-17.067,9.891h-9.891L281.665,136.339L281.665,136.339z M295.952,194.327h-14.287v-21.463h12.283c8.275,0.388,20.105-0.453,19.846,10.602C313.859,187.733,313.277,194.65,295.952,194.327 z"></path> </g> </g></svg> MINI DEX</h1>
                        <p class="text-small text-dark">
                         Make great achievement, report your job now!
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
        <div class="col-lg-4">
            <div class="signin-wrapper">
                <div class="form-wrapper">
                    <h6 class="mb-15">LOGIN</h6>
                    <p class="text-sm mb-25">
                        Fill your email and password to login.
                    </p>
                    <form id="form-login">
                        <div class="row">
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
                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="form-check checkbox-style mb-30">
                                    <input class="form-check-input" type="checkbox" name="remember" value="1"
                                        id="remember-me" />
                                    <label class="form-check-label" for="remember-me">
                                        Remember me</label>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-xxl-6 col-lg-12 col-md-6">

                                <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                    <a href="{{ route('forgot') }}" class="hover-underline">
                                        Forgot Password?
                                    </a>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button class="main-btn primary-btn btn-hover w-100 text-center" type="submit"
                                        id="btn-login">
                                        Sign In
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </form>
                    {{-- <div class="singin-option pt-20">
                        <p class="text-sm text-medium text-dark text-center">
                            Don't have any account yet?
                            <a href="{{ route('register') }}">Register student</a>
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <input type="hidden" id="login-url" value="{{ route('login.submit') }}">

    <script src="{{ asset('assets/js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/yaza-putu/helpers@V2.0.4/libs/libs-core.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/yaza-putu/helpers@V2.0.4/helpers.min.js"></script>
    @vite(['resources/js/apps/auth/login.js'])
</body>

</html>
