<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $title ?? config('app.name') }}</title>
    <x-meta-head></x-meta-head>
</head>

<body class='bg-white'>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 sticky-top">
                    <a class="navbar-brand d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none" href="#">
                        <img src="{{ asset('storage/for_site/heart.png') }}" alt="" srcset="" width="64px" height="64px">
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{route('activities')}}" class="nav-link font-weight-bold text-light align-middle px-0">
                                <i class="fs-4 fas fa-house-user"></i> <span class="ms-1 d-none d-sm-inline">Activities</span>
                            </a>
                        </li>

                        @auth('admin')
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold text-light align-middle px-0" href="{{route('users')}}">
                                <i class="fs-4 fas fa-building-user"></i><span class="ms-1 d-none d-sm-inline">Users</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link font-weight-bold text-light align-middle px-0" href="{{route('admins')}}">
                                <i class="fs-4 fas fa-newspaper"></i><span class="ms-1 d-none d-sm-inline">Admins</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold text-light align-middle px-0 pre-run" data-caption="Are You Sure You Want To logout?"
                                data-classname="run-get-request" data-bc="admin_logout"
                                href="{{route('admin.logout')}}">
                                <i class="fas fa-sign-out-alt"></i><span class="ms-1 d-none d-sm-inline">Log Out</span></a>
                            </a>
                        </li>
                        @endauth

                        @auth('web')
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold text-light align-middle px-0 pre-run" data-caption="Are You Sure You Want To logout?"
                                data-classname="logout-form" data-bc="admin_logout"
                                href="{{route('logout')}}">
                                <i class="fas fa-sign-out-alt"></i><span class="ms-1 d-none d-sm-inline">Log Out</span></a>
                            </a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>

            <div class="col">
                <nav class="nav navbar navbar-expand nav-fill justify-content-center home-color sticky-top fixed-top"
                    role="navigation">

                    <div class="d-flex justify-content-center w-75">
                        <div
                            class="text-center text-truncate text-light fw-bold fs-1 fst-italic font-monospace shadow-sm">
                            {{ config('app.name') }}
                        </div>
                    </div>
                </nav>

                {{ $slot }}

            </div>

        </div>
    </div>
    @stack('scripts')
</body>

</html>