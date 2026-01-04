<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
                <div class="header-left d-flex align-items-center">
                    <div class="menu-toggle-btn mr-15">
                        <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                            <i class="lni lni-chevron-left me-2"></i> Menu
                        </button>
                    </div>
                    {{--
                    <div class="header-search d-none d-md-flex">
                        <form action="#">
                            <input type="text" placeholder="Search..." />
                            <button><i class="lni lni-search-alt"></i></button>
                        </form>
                    </div>
                    --}}
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
                <div class="header-right">
                    <div class="profile-box ml-15">
                        <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-info">
                                <div class="info">
                                    <div class="image">
                                        <img style="height: 100%; object-fit: cover;"
                                            src="{{ auth()->user()->avatar ? route('secure.image', \App\Helpers\Helper::encrypt(auth()->user()->avatar)) : asset('assets/images/profile/profile-image.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="text-start">
                                        <h6 class="fw-500">{{ auth()->user()->name }}</h6>
                                        <p>{{ auth()->user()->roles[0]->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                            <li>
                                <div class="author-info flex items-center !p-1">
                                    <div class="image">
                                        <img src="{{ auth()->user()->avatar ? route('secure.image', \App\Helpers\Helper::encrypt(auth()->user()->avatar)) : asset('assets/images/profile/profile-image.png') }}"
                                            alt="image">
                                    </div>
                                    <div class="content">
                                        <h4 class="text-sm">{{ auth()->user()->name }}</h4>
                                        <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                                            href="#">{{ auth()->user()->email }}</a>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                 <a href="{{ route('profile.index') }}">
                                    <i class="lni lni-user"></i> View Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"> <i class="lni lni-exit"></i> Sign Out </a>
                            </li>
                        </ul>
                    </div>
                    <!-- profile end -->
                </div>
            </div>
        </div>
    </div>
</header>
