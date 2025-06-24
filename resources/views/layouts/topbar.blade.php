<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-menu-bt d-flex align-items-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-menu-line"></i></div>
                    <div class="hover-circle"><i class="ri-close-fill"></i></div>
                </div>
                <div class="iq-navbar-logo d-flex justify-content-between ml-3">
                    <a href="index.html" class="header-logo">
                        <img src="{{ asset('images/logo.png') }}" class="img-fluid rounded" alt="">
                        <span>VDUC</span>
                    </a>
                </div>
            </div>
            <ul class="navbar-nav ml-auto navbar-list mt-2">
                <li class="line-height">
                    <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                        <img src="{{ asset('images/user/1.jpg') }}" class="img-fluid rounded mr-3" alt="user">
                        <div class="caption">
                        <h6 class="mb-0 line-height">{{ auth()->user()->full_name }}</h6>
                            <p class="mb-0">{{ auth()->user()->role }}</p>
                        </div>
                    </a>
                    <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 ">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Hello! Administrator</h5>
                                </div>
                                <a href="#" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-file-user-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">My Profile</h6>
                                            <p class="mb-0 font-size-12">View personal profile details.</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-profile-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Edit Profile</h6>
                                            <p class="mb-0 font-size-12">Modify your personal details.</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-account-box-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">Account settings</h6>
                                            <p class="mb-0 font-size-12">Change your account password.</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="d-inline-block w-100 text-center p-3">
                                    <a class="bg-primary iq-sign-btn" href="{{ route('logout') }}" role="button">Sign
                                        out<i class="ri-login-box-line ml-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
