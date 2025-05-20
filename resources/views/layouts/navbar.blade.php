<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">

    @php
        $isAdmin = Auth::user()->role == 'admin';
    @endphp
    <!--begin::Navbar-->
    <div class="d-flex align-items-stretch gap-x-2" id="kt_header_nav">
        <!-- Menu Wrapper -->
        <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
            data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
            data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
            data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">

            <!-- Menu -->
            <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700
        menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                id="kt_header_menu" data-kt-menu="true">

                <!-- Dashboard -->
                <div data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                    <a class="menu-link py-3 text-gray-600" href="{{ route('dashboard.index') }}">
                        <span class="menu-title {{ request()->routeIs('dashboard.index') ? 'text-gray-400' : '' }}">
                            Dashboard
                        </span>
                    </a>
                </div>

                <!-- User -->

                @if ($isAdmin)
                    <div data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                        <a class="menu-link py-3 text-gray-600" href="{{ route('dashboard.user.index') }}">
                            <span
                                class="menu-title {{ request()->routeIs('dashboard.user.index') ? 'text-gray-400' : '' }}">
                                User
                            </span>
                        </a>
                    </div>

                    <!-- Dataset -->
                    <div data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                        <a class="menu-link py-3 text-gray-600" href="{{ route('dashboard.dataset.index') }}">
                            <span
                                class="menu-title {{ request()->routeIs('dashboard.dataset.index') ? 'text-gray-400' : '' }}">
                                Data Uji
                            </span>
                        </a>
                    </div>

                    <!-- Uji Model -->
                    <div data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                        <a class="menu-link py-3 text-gray-600" href="{{ route('dashboard.uji_model.index') }}">
                            <span
                                class="menu-title {{ request()->routeIs('dashboard.uji_model.index') ? 'text-gray-400' : '' }}">
                                History Uji Model
                            </span>
                        </a>
                    </div>
                @endif

                <div data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                    <a class="menu-link py-3 text-gray-600" href="{{ route('dashboard.analysis.index') }}">
                        <span
                            class="menu-title {{ request()->routeIs('dashboard.analysis.index') ? 'text-gray-400' : '' }}">
                            Klasifikasi Text Sitasi
                        </span>
                    </a>
                </div>
                <div data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                    <a class="menu-link py-3 text-gray-600" href="{{ route('dashboard.journal.index') }}">
                        <span
                            class="menu-title {{ request()->routeIs('dashboard.journal.index') ? 'text-gray-400' : '' }}">
                            Analisa Journal
                        </span>
                    </a>
                </div>
                <div data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                    <a class="menu-link py-3 text-gray-600" href="{{ route('dashboard.scopus.search') }}">
                        <span
                            class="menu-title {{ request()->routeIs('dashboard.scopus.search') ? 'text-gray-400' : '' }}">
                            Cari Referensi Scopus
                        </span>
                    </a>
                </div>
                <div data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                    <a class="menu-link py-3 text-gray-600" href="{{ route('dashboard.scopus.library.index') }}">
                        <span
                            class="menu-title {{ request()->routeIs('dashboard.scopus.library.index') ? 'text-gray-400' : '' }}">
                            Daftar Di simpan
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!--end::Navbar-->
    <!--begin::Topbar-->
    <div class="d-flex align-items-stretch flex-shrink-0">
        <!--begin::Toolbar wrapper-->
        <div class="topbar d-flex align-items-stretch flex-shrink-0">
            <!--begin::User-->
            <div class="d-flex align-items-center me-n3 ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                <!--begin::Menu wrapper-->
                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                    data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <img class="h-30px w-30px rounded"
                        src="
                        @if (auth()->user()->is_google_account == true) {{ auth()->user()->image }}
                                    @else
                                        {{ asset('/') }}assets/media/avatars/150-25.jpg @endif
                        "
                        alt="" />
                </div>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                    data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo"
                                    src="
                                    @if (auth()->user()->is_google_account == true) {{ auth()->user()->image }}
                                    @else
                                        {{ asset('/') }}assets/media/avatars/150-25.jpg @endif
                                    " />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bolder d-flex align-items-center fs-5">
                                    {{ auth()->user()->name }}
                                    <span
                                        class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">{{ auth()->user()->role }}</span>
                                </div>
                                <a href="#" class="fw-bold text-muted text-hover-primary fs-7"
                                    style="max-width: 100px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ auth()->user()->email }}
                                </a>

                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="separator my-2"></div>
                    <div class="menu-item px-5 my-1">
                        <a href="{{ route('dashboard.profile', ['id' => 1]) }}" class="menu-link px-5">Account
                            Settings</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <form action="{{ route('auth.signout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger mx-4">Sign
                                Out</button>
                        </form>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                </div>
                <!--end::Menu-->
                <!--end::Menu wrapper-->
            </div>
            <!--end::User -->
            <!--begin::Aside mobile toggle-->
            <!--end::Aside mobile toggle-->
        </div>
        <!--end::Toolbar wrapper-->
    </div>
    <!--end::Topbar-->
</div>
