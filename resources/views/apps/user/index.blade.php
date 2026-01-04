@extends('themes.default')

@section('title', 'User')

@section('style')
    <style>
        .table .employee-image img {
            height: 100% !important;
            width: 100% !important;
            /* object-fit: cover; */
        }
    </style
@endsection

@section('content')
    <div class="container-fluid">
        @include('components.breadcrumb')

        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style">
                        <button type="button" class="btn btn-primary mb-3" id="btn-add"><i class="bx bx-plus"></i> Add User</button>
                        <table id="table" class="data-table table stripe nowrap">
                            <thead>
                            <tr>
                                <th class="d-none"></th>
                                <th width="20">No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
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
    @include('apps.user.modal')
@endsection

@section('url')
    <input type="hidden" id="table-url" value="{{ route('user.table') }}">
    <input type="hidden" id="create-url" value="{{ route('user.create') }}">
    <input type="hidden" id="update-url" value="{{ route('user.update') }}">
    <input type="hidden" id="delete-url" value="{{ route('user.delete') }}">
    <input type="hidden" id="edit-url" value="{{ route('user.edit', ['id' => ':id']) }}">
@endsection

@section('script')
    @vite(['resources/js/apps/users/user.js'])
@endsection
