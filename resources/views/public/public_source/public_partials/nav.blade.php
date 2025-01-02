<!-- Navbar Start -->
<div class="container-fluid position-relative nav-bar p-0">
    <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
        <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5"
            style="border-radius:0px 0px 30px 30px !important;">
            <a href="{{ route('public.index') }}" class="navbar-brand">
                <h1 class="m-0 text-primary"><span class="text-dark">Journey</span>JO</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="{{ route('public.index') }}" class="nav-item nav-link @yield('home_active')">Home</a>
                    <a href="{{ route('public.tours') }}" class="nav-item nav-link @yield('tours_active')">Tours</a>
                    <a href="{{ route('public.custom_tour') }}" class="nav-item nav-link @yield('custom_tour_active')">Custom
                        Tours</a>
                    <a href="{{ route('public.about') }}" class="nav-item nav-link @yield('about_active')">About Us</a>
                    <a href="{{ route('contact.index') }}" class="nav-item nav-link @yield('contact_active')">Contact</a>
                    <li class="nav-item dropdown pe-3"
                        style="justify-content: center; display: flex; align-items: center;">
                        @if (auth('public_user')->check())
                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                                data-bs-toggle="dropdown">
                                <img src="{{ asset('assets/img/profile_images/' . auth('public_user')->user()->user_image) }}"
                                    alt="Profile" class="rounded-circle me-2" width="25" height="25">
                                <span class="d-none d-md-block dropdown-toggle ps-2">
                                    {{ auth('public_user')->user()->name }}
                                </span>
                            </a><!-- End Profile Image Icon -->

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                <li class="dropdown-header">
                                    <h6>{{ auth('public_user')->user()->name }}</h6>
                                    <span></span>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('user.profile') }}">
                                        <i class="bi bi-person"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('user.logout') }}"
                                        class="d-flex align-items-center dropdown-item p-0">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-link text-decoration-none w-100 text-start text-body">
                                            <i class="bi bi-box-arrow-right"></i>
                                            <span>Log Out</span>
                                        </button>
                                    </form>
                                </li>
                            </ul><!-- End Profile Dropdown Items -->
                        @else
                            <a href="{{ route('user.login') }}"
                                class="nav-link btn btn-primary rounded-pill text-white px-3 py-2 mr -2"
                                style="font-size: 16px; text-align: center; text-decoration: none; margin-inline: 10px;">
                                <i class="fas fa-sign-in-alt me-2 pr-1"></i>Login
                            </a>
                            <a href="{{ route('user.register') }}"
                                class="nav-link btn btn-primary rounded-pill text-white px-3 py-2 me-2"
                                style="font-size: 16px; text-align: center; text-decoration: none;">
                                <i class="fas fa-user-plus me-2 pr-1"></i>Register
                            </a>
                        @endif
                    </li><!-- End Profile Nav -->


                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
