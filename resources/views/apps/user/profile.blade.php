@extends('themes.default')

@section('title', 'Profile')

@section('style')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .bxs-hide {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            cursor: pointer;
        }

        .bxs-show {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            cursor: pointer;
        }

        .avatar-photo {
            width: 100px !important;
            height: 100px !important;
            object-fit: cover;
            border-radius: 10% !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        @include('components.breadcrumb')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img class="avatar-photo" src="{{ auth()->user()->avatar ? route('secure.image', \App\Helpers\Helper::encrypt(auth()->user()->avatar)): asset('assets/images/profile/profile-image.png') }}" alt="">
                            <form id="form-avatar">
                                <div class="d-block">
                                    <label for="uploadProfile" class="btn btn-outline-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class='bx bxs-cloud-upload d-block d-sm-none'></i>
                                        <input type="file" hidden id="uploadProfile"  accept="image/png, image/jpeg, image/jpg" name="image">
                                        <input id="old_image" type="hidden" name="old_image" value="{{ (auth()->user()->avatar == null) ? asset('assets/images/profile/profile-image.png') : auth()->user()->avatar }}">
                                    </label>
                                    <button type="submit" class="btn btn-primary me-2 mb-4">
                                        <span class="d-none d-sm-block">Save</span>
                                        <i class="bx bxs-save d-block d-sm-none"></i>
                                    </button>
                                    <p class="text-muted mb-0">Allowed JPG, JPEG or PNG. Max size of 1MB</p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr class="my-0">
                    <form id="form-profile">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id" value="{{ $result->id }}">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label class="required" for="name">Full Name</label>
                                        <input id="name" type="text" placeholder="Ex: John Lenon" name="name" value="{{ @$result->name }}"/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label class="required" for="email">Email</label>
                                        <input id="email" type="email" placeholder="Ex: johnlenon@mail.com" name="email" value="{{ @$result->email }}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-style-1">
                                        <label for="confirm-password">Password</label>
                                        <div style="position: relative">
                                            <input id="new-password" type="password" name="new_password"/>
                                            <i class='bx bxs-hide' id="togglePassword1"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-style-1">
                                        <label for="confirm-password">Confirm Password</label>
                                        <div style="position: relative">
                                            <input id="confirm-password" type="password" name="confirm_password" />
                                            <i class='bx bxs-hide' id="togglePassword2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="text-end mt-3">
                    <button class="btn btn-primary" id="btn-submit"><i class='bx bxs-save'></i> Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('url')
    <input type="hidden" id="update-url" value="{{ route('profile.update') }}">
    <input type="hidden" id="avatar-url" value="{{ route('profile.avatar') }}">
@endsection

@section('script')
    @vite(['resources/js/apps/users/profile.js'])
@endsection
