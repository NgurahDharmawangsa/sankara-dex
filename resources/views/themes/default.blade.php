<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @include('components.css')
    @yield('style')
    @vite('resources/css/app.css')
</head>

<body>
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    @include('components.sidebar')
    <div class="overlay"></div>
    <main class="main-wrapper">
        @include('components.header')

        <section class="section">
            @yield('content')
        </section>
        {{-- @include('components.bottom-navigation-bar') --}}
        @include('components.footer')
    </main>
    @yield('url')
    @include('components.script')
    @yield('script')
    @vite('resources/js/app.js')
</body>

</html>
