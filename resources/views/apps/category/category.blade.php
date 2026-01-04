@extends('themes.default')

@section('title', 'Category')

@section('style')

@endsection

@section('content')
    <div class="container-fluid">
        @include('components.breadcrumb')

        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style">
                        <button type="button" class="btn btn-primary mb-3" id="btn-add"><i class="bx bx-plus"></i> Add Category</button>
                        <table id="table" class="data-table table stripe nowrap">
                            <thead>
                                <tr>
                                    <th class="d-none"></th>
                                    <th width="20">No</th>
                                    <th>Name</th>
                                    <th>Active</th>
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
    @include('apps.category.modal')
@endsection

@section('url')
    <input type="hidden" id="table-url" value="{{ route('master.category.table') }}">
    <input type="hidden" id="change-status-url" value="{{ route('master.category.change.status', ['id' => ':id']) }}">
    <input type="hidden" id="create-url" value="{{ route('master.category.create') }}">
    <input type="hidden" id="update-url" value="{{ route('master.category.update') }}">
    <input type="hidden" id="delete-url" value="{{ route('master.category.delete') }}">
    <input type="hidden" id="edit-url" value="{{ route('master.category.edit', ['id' => ':id']) }}">    
@endsection

@section('script')
    @vite(['resources/js/apps/category/category.js'])
@endsection
