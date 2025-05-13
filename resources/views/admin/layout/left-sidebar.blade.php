<aside class="app-sidebar" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="index.html" class="header-logo text-3xl">
            <h2 class="text-center text-white">Admin</h2>
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar " id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>

            <ul class="main-menu">


                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('dashboard') }}"
                        class="side-menu__item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        <i class="ri-home-8-line side-menu__icon side-menu__icon"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <!-- End::slide -->


                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('course.list') }}"
                        class="side-menu__item @if (Request::routeIs('course.*')) active @endif">
                        <i class="ri-book-open-line side-menu__icon"></i>
                        <span class="side-menu__label">Course</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('student.list') }}"
                        class="side-menu__item @if (Request::routeIs('student.*')) active @endif">
                        <i class="ti ti-address-book side-menu__icon"></i>
                        <span class="side-menu__label">Student</span>
                    </a>
                </li>

                <!-- End::slide -->
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
