@extends('themes.default')

@section('title', 'Job History')

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
                            <div class="col-md-3">
                                <select class="form-select select2" id="subcategory_id">
                                    <option value="">All Project</option>
                                    @foreach($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->category->name }} - {{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="dates" name="dates" class="form-control daterangepick">
                            </div>
                            <div class="col-md-3">
                                <button type="button" id="btn-filter" class="btn btn-primary"><i class="bx bx-filter"></i> Filter</button>
                                {{-- <button type="button" id="btn-export" class="btn btn-secondary"><i class="bx bxs-file-export"></i> Export</button> --}}
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style">
                        <table id="table" class="data-table table stripe nowrap">
                            <div id="total-duration" class="mb-3 badge bg-primary">

                            </div>
                            <thead>
                            <tr>
                                <th width="20">No</th>
                                <th >Project</th>
                                <th>Detail</th>
                                <th width="20">Duration (Menit)</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
    <input type="hidden" id="table-url" value="{{ route('history.datatable') }}">
    <input type="hidden"  id="working-hours-url" value="{{ route('history.jam.kerja') }}">
@endsection

@section('script')
    @vite(['resources/js/apps/job-history/job-history.js'])
@endsection
