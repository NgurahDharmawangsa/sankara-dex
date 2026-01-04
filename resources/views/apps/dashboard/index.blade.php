@extends('themes.default')

@section('title', 'Dashboard')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css'])
@endsection

@section('content')
    <div class="container-fluid">
        @include('components.breadcrumb')
        @can('isStaff')
            <h1>Tampilan Staff</h1>
        @endcan
        @can('isAdmin')
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon orange">
                            <i class="lni lni-user"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total User</h6>
                            <h3 id="all-user" class="text-bold mb-10">0</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon purple">
                            <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total Task</h6>
                            <h3 id="all-job" class="text-bold mb-10">0</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
                <!-- End Col -->
                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon success">
                            <i class="lni lni-dollar"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Total Jam Kerja</h6>
                            <h3 id="all-working-hours" class="text-bold mb-10">0</h3>
                        </div>
                    </div>
                    <!-- End Icon Cart -->
                </div>
            </div>
            <!-- End Row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style">
                        <div class="title d-flex flex-wrap justify-content-between">
                            <div class="left">
                                <h4 class="text-bold">Chart</h4>
                            </div>
                        </div>
                        <!-- End Title -->
                        <div class="chart">
                            <div id="chart-mentions" class="chart-lg"></div>
                        </div>
                        <!-- End Chart -->
                    </div>
                </div>
            </div>
        @endcan

    </div>
@endsection

@section('url')
    <input hidden id="chart-url" value="{{ route('dashboard.chart') }}">
    <input hidden id="all-job-url" value="{{ route('job.all') }}">
    <input hidden id="all-user-url" value="{{ route('user.all') }}">
    <input hidden id="all-working-hours-url" value="{{ route('job.working.hours') }}">
    <input hidden id="role" value="{{ auth()->user()->roles->first()->name }}">
@endsection

@section('script')
    @vite(['resources/js/apps/dashboard/dashboard.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection
