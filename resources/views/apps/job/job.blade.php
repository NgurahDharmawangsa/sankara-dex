@extends('themes.default')

@section('title', 'Jobs')

@section('style')
    <style>
        .list-training {
            border: 1px solid #eee;
        }

        .btn-delete {
            /* position: absolute; */
            right: 0;
            top: 0;
        }

        .select2.select2-container.select2-container--default {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        @include('components.breadcrumb')

        <div class="card">
            <div class="card-body">
                <div class="mt-4">
                    <h2 class="mb-4">Division {{ auth()->user()->roles[0]->name }}</h2>
                    <div class="d-flex justify-content-between">
                        <h4>Job {{ date('d M Y') }}</h4>
                        <div class="total-working-hour badge bg-primary"></div>
                    </div>
                </div>
                <form id="form-job">
                    <input type="hidden" id="user-id" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="container-form-job"></div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Detail</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody id="task-data"></tbody>
                    </table>
                    <div class="row mb-3 mt-3">
                        <div class="col-md-6">
                            <button type="button" id="btn-new" data-mode="add1"
                                    class="btn btn-outline-primary"><i
                                    class="lni lni-circle-plus"></i> New
                            </button>
                            <button type="submit" id="btn-save"
                                    class="btn btn-primary">
                                @if (auth()->user()->isStaff())
                                    <i class="lni lni-save"></i> Save
                                @else
                                    Save & Next <i class="lni lni-arrow-right"></i>
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('url')
    <input type="hidden" id="save-url" value="{{ route('job.create') }}">
    <input type="hidden" id="subcategory-url" value="{{ route('master.subcategory.all') }}">
@endsection

@section('script')
    @vite(['resources/js/apps/job/user-job.js'])
@endsection
