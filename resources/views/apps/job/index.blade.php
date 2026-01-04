@extends('themes.default')

@section('title', 'Job List')

@section('style')
    <style>
        .table .employee-image img {
            height: 100% !important;
            width: 100% !important;
            /* object-fit: cover; */
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        @include('components.breadcrumb')

        <div class="tables-wrapper">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="card-style">
                        <h5 class="mb-3">Filter Data Job</h5>
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <label class="form-label">From</label>
                                <input id="date-from" name="date_from" type="date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="form-label">To</label>
                                <input id="date-to" name="date_to" type="date" class="form-control" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Category</label>
                                <select class="form-select project-select2" id="category" name="category">
                                    <option value="">All Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Subcategory</label>
                                <select class="form-select project-select2" id="subcategory" name="subcategory" disabled>
                                    <option value="">All Subcategory</option>                                    
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">User</label>
                                <select class="form-select users-select2" id="user-id" name="user_id">
                                    <option value="">All User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 align-self-end mt-2 mt-md-0">
                                <button type="button" id="btn-filter" class="btn btn-primary"><i class="bx bx-filter"></i> Filter</button>
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
                        <div class="add-job">
                            <a href="javascript:void(0)" class="btn btn-primary" id="btn-add" style="margin-bottom: 10px;"><i class="bx bx-plus"></i> Add Job</a>
                        </div>
                        <div class="table-responsive">
                            <table id="table" class="data-table table stripe nowrap">
                                <thead>
                                <tr>
                                    <th width="20">No</th>
                                    <th>User</th>
                                    <th>Detail</th>
                                    <th>Project</th>
                                    <th>Duration</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
    @include('apps.job.modal')
@endsection

@section('url')
    <input type="hidden" id="save-url" value="{{ route('job.create') }}">
    <input type="hidden" id="table-url" value="{{ route('job.table') }}">
    <input type="hidden" id="update-url" value="{{ route('job.update') }}">
    <input type="hidden" id="delete-url" value="{{ route('job.delete') }}">
    <input type="hidden" id="edit-url" value="{{ route('job.edit', ['id' => ':id']) }}">
    <input type="hidden" id="subcategory-url" value="{{ route('master.subcategory.get.by.category', ['categoryId' => ':id']) }}">
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js" integrity="sha512-/n/dTQBO8lHzqqgAQvy0ukBQ0qLmGzxKhn8xKrz4cn7XJkZzy+fAtzjnOQd5w55h4k1kUC+8oIe6WmrGUYwODA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite(['resources/js/apps/job/job.js'])
@endsection
