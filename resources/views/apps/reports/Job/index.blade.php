@extends('themes.default')

@section('title', 'Report')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">
        @include('components.breadcrumb')

        <div class="tables-wrapper">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="card-style">
                        <h5 class="mb-3">Filter Data</h5>
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <label class="form-label">From</label>
                                <input id="date-from" name="date_from" type="date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-3 col-12 mb-3 mb-lg-0">
                                <label class="form-label">To</label>
                                <input id="date-to" name="date_to" type="date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-3 align-self-end">
                                <button type="button" id="btn-export" class="btn btn-primary"><i class="bx bxs-file-export"></i> Export</button>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection

@section('url')
    <input type="hidden" id="export-url" value="{{ route('report.job.export') }}">
@endsection

@section('script')
    @vite(['resources/js/apps/report/job-report.js'])
@endsection
