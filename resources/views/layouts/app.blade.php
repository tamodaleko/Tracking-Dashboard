
<!DOCTYPE html>
<html lang="en">
    <!--begin::Head-->
    <head>
        <title>{{ config('app.name') }} | @yield('title')</title>
        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="shortcut icon" href="{{ asset('/media/logos/favicon.png?v=1') }}" />
        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Vendor Stylesheets(used for this page only)-->
        <link href="{{ asset('/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
        <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
        <!--begin::Theme mode setup on page load-->
        <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
        <!--end::Theme mode setup on page load-->
        <!--begin::App-->
        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <!--begin::Page-->
            <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
                <!--begin::Header-->
                <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate-="true" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    <!--begin::Header container-->
                    <div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
                        <!--begin::Header wrapper-->
                        <div class="app-header-wrapper d-flex flex-grow-1 align-items-stretch justify-content-between" id="kt_app_header_wrapper">
                            <!--begin::Logo wrapper-->
                            <div class="app-header-logo d-flex flex-shrink-0 align-items-center justify-content-between justify-content-lg-center">
                                <!--begin::Logo wrapper-->
                                <button class="btn btn-icon btn-color-gray-600 btn-active-color-primary ms-n3 me-2 d-flex d-lg-none" id="kt_app_sidebar_toggle">
                                    <i class="ki-outline ki-abstract-14 fs-2"></i>
                                </button>
                                <!--end::Logo wrapper-->
                                <!--begin::Logo image-->
                                <a href="/">
                                    <img alt="{{ config('app.name') }}" src="{{ asset('/media/logos/logo.webp?v=1') }}" class="h-20px h-lg-30px theme-light-show" />
                                </a>
                                <!--end::Logo image-->
                            </div>
                            <!--end::Logo wrapper-->
                            <!--begin::Menu wrapper-->
                            <div id="kt_app_header_menu_wrapper" class="d-flex align-items-center w-100">
                                <!--begin::Header menu-->
                                <div class="app-header-menu app-header-mobile-drawer align-items-start align-items-lg-center w-100" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_menu_wrapper'}">
                                    <!--begin::Menu-->
                                    <div class="menu menu-active-bg menu-state-primary menu-title-gray-700 menu-arrow-gray-500 menu-bullet-gray-500 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="#kt_header_menu" data-kt-menu="true">
                                        <!--begin:Menu item-->
                                        <div class="menu-item @if (Route::currentRouteName() === 'dashboard.index') here @endif me-0 me-lg-2">
                                            <!--begin:Menu link-->
                                            <a href="{{ route('dashboard.index') }}" class="menu-link">
                                                <span class="menu-title">Početna</span>
                                                <span class="menu-arrow d-lg-none"></span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        @if (auth()->user()->admin)
                                            <!--begin:Menu item-->
                                            <div class="menu-item @if (Route::currentRouteName() === 'users.index') here @endif me-0 me-lg-2">
                                                <!--begin:Menu link-->
                                                <a href="{{ route('users.index') }}" class="menu-link">
                                                    <span class="menu-title">Korisnici</span>
                                                    <span class="menu-arrow d-lg-none"></span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        @endif
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Header menu-->
                            </div>
                            <!--end::Menu wrapper-->
                            <!--begin::Navbar-->
                            <div class="app-navbar flex-shrink-0">
                                <!--begin::User menu-->
                                <div class="app-navbar-item ms-3 ms-lg-5" id="kt_header_user_menu_toggle">
                                    <!--begin::Menu wrapper-->
                                    <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                        <img class="symbol symbol-circle symbol-35px symbol-md-40px" src="{{ asset('/media/avatars/blank.png') }}" alt="user" />
                                    </div>
                                    <!--begin::User account menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3 justify-content-center">
                                                <!--begin::Username-->
                                                <div class="d-flex flex-column align-items-center justify-content-center">
                                                    <div class="fw-bold d-flex align-items-center fs-5">{{ auth()->user()->name }}</div>
                                                    <a href="javascript:void()" class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                                </div>
                                                <!--end::Username-->
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5 mx-auto">
                                            <form class="menu-item px-5" method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a 
                                                    href="{{ route('logout') }}"
                                                    onclick="
                                                        event.preventDefault();
                                                        this.closest('form').submit();
                                                    "
                                                    class="menu-link px-5"
                                                >
                                                    Odjavi se
                                                </a>
                                            </form>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::User account menu-->
                                    <!--end::Menu wrapper-->
                                </div>
                                <!--end::User menu-->
                                <!--begin::Header menu toggle-->
                                <div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
                                    <div class="btn btn-icon btn-custom btn-active-color-primary btn-color-gray-700 w-35px h-35px w-md-40px h-md-40px" id="kt_app_header_menu_toggle">
                                        <i class="ki-outline ki-text-align-left fs-1"></i>
                                    </div>
                                </div>
                                <!--end::Header menu toggle-->
                            </div>
                            <!--end::Navbar-->
                        </div>
                        <!--end::Header wrapper-->
                    </div>
                    <!--end::Header container-->
                </div>
                <!--end::Header-->
                <!--begin::Wrapper-->
                <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                    <!--begin::Wrapper container-->
                    <div class="app-container container-xxl d-flex flex-row-fluid">
                        <!--begin::Sidebar-->
                        <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="275px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_toggle">
                            <!--begin::Sidebar nav-->
                            <div class="app-sidebar-wrapper py-8 py-lg-10" id="kt_app_sidebar_wrapper">
                                <!--begin::Nav wrapper-->
                                <div id="kt_app_sidebar_nav_wrapper" class="d-flex flex-column px-8 px-lg-10 hover-scroll-y" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="{default: false, lg: '#kt_app_header'}" data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_wrapper" data-kt-scroll-offset="{default: '10px', lg: '40px'}">
                                    <!--begin::Stats-->
                                    <div class="d-flex mb-8 mb-lg-10">
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 text-center">
                                            <!--begin::Date-->
                                            <span class="fs-7 text-gray-500 fw-bold">Firma</span>
                                            <!--end::Date-->
                                            <!--begin::Label-->
                                            <div class="fs-3 fw-bold text-info">{{ auth()->user()->company->name }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                    </div>
                                    <!--end::Stats-->
                                    <!--begin::Links-->
                                    <div class="mb-0">
                                        <!--begin::Title-->
                                        <h3 class="text-gray-800 fw-bold mb-5">Navigacija</h3>
                                        <!--end::Title-->
                                        <!--begin::Row-->
                                        <div class="row g-5" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Link-->
                                                <a href="{{ route('products.index') }}" class="@if (Route::currentRouteName() === 'products.index') btn-light-primary @endif btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                                    <!--begin::Icon-->
                                                    <span class="mb-2">
                                                        <i class="ki-outline ki-laptop fs-1"></i>
                                                    </span>
                                                    <!--end::Icon-->
                                                    <!--begin::Label-->
                                                    <span class="fs-7 fw-bold">Proizvodi</span>
                                                    <!--end::Label-->
                                                </a>
                                                <!--end::Link-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-6">
                                                <!--begin::Link-->
                                                <a href="{{ route('licenses.index') }}" class="@if (Route::currentRouteName() === 'licenses.index') btn-light-primary @endif btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                                                    <!--begin::Icon-->
                                                    <span class="mb-2">
                                                        <i class="ki-outline ki-shield fs-1"></i>
                                                    </span>
                                                    <!--end::Icon-->
                                                    <!--begin::Label-->
                                                    <span class="fs-7 fw-bold">Porudžbine</span>
                                                    <!--end::Label-->
                                                </a>
                                                <!--end::Link-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Links-->
                                </div>
                                <!--end::Nav wrapper-->
                            </div>
                            <!--end::Sidebar nav-->
                        </div>
                        <!--end::Sidebar-->
                        <!--begin::Main-->
                        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                            <!--begin::Content wrapper-->
                            <div class="d-flex flex-column flex-column-fluid">
                                <!--begin::Toolbar-->
                                <div id="kt_app_toolbar" class="app-toolbar d-flex pb-3 pb-lg-5">
                                    <!--begin::Toolbar container-->
                                    <div class="d-flex flex-stack flex-row-fluid">
                                        <!--begin::Toolbar container-->
                                        <div class="d-flex flex-column flex-row-fluid">
                                            <!--begin::Toolbar wrapper-->
                                            <!--begin::Page title-->
                                            <div class="page-title d-flex align-items-center me-3">
                                                <!--begin::Title-->
                                                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-lg-2x gap-2">
                                                    <span>
                                                    <span class="fw-light">Dobrodošao nazad</span>, {{ auth()->user()->first_name }}!</span>
                                                    <!--begin::Description-->
                                                    <span class="page-desc text-gray-600 fs-base fw-semibold">Prijavljen si kao član firme: {{ auth()->user()->company->name }}.</span>
                                                    <!--end::Description-->
                                                </h1>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Page title-->
                                        </div>
                                        <!--end::Toolbar container-->
                                    </div>
                                    <!--end::Toolbar container-->
                                </div>
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" :type="'default'" />
                                
                                <!--end::Toolbar-->
                                @if (session()->has('success'))
                                    <!--begin::Alert-->
                                    <div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row p-5 mb-10 align-items-center">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-shield-tick fs-2tx text-success me-4 mb-5 mb-sm-0">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        <!--end::Icon-->

                                        <!--begin::Wrapper-->
                                        <div class="d-flex pe-0 pe-sm-10">
                                            <!--begin::Title-->
                                            <h4 class="fw-bold m-0">{!! session('success') !!}</h4>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Wrapper-->

                                        <!--begin::Close-->
                                        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                            <i class="ki-duotone ki-cross fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
                                        </button>
                                        <!--end::Close-->
                                    </div>
                                    <!--end::Alert-->
                                    <?php session()->forget('success'); ?>
                                @endif

                                @if (session()->has('error'))
                                    <!--begin::Alert-->
                                    <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10 align-items-center">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-shield-cross fs-2tx text-danger me-4 mb-5 mb-sm-0">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        <!--end::Icon-->

                                        <!--begin::Wrapper-->
                                        <div class="d-flex pe-0 pe-sm-10">
                                            <!--begin::Title-->
                                            <h4 class="fw-bold m-0">{!! session('error') !!}</h4>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Wrapper-->

                                        <!--begin::Close-->
                                        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                            <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i>
                                        </button>
                                        <!--end::Close-->
                                    </div>
                                    <!--end::Alert-->
                                    <?php session()->forget('error'); ?>
                                @endif
                                <!--begin::Content-->
                                <div id="kt_app_content" class="app-content flex-column-fluid pt-2">
                                    {{ $slot }}
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Content wrapper-->
                            <!--begin::Footer-->
                            <div id="kt_app_footer" class="app-footer d-flex flex-column flex-md-row align-items-center flex-center flex-md-stack py-2 py-lg-4">
                                <!--begin::Copyright-->
                                <div class="text-gray-900 order-2 order-md-1">
                                    <span class="text-muted fw-semibold me-1">{{ date('Y') }}&copy;</span>
                                    <a href="" target="_blank" class="text-gray-800 text-hover-primary">Spherical | Workspace Console</a>
                                </div>
                                <!--end::Copyright-->
                            </div>
                            <!--end::Footer-->
                        </div>
                        <!--end:::Main-->
                    </div>
                    <!--end::Wrapper container-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::App-->
        <!--begin::Drawers-->
        <!--begin::Activities drawer-->
        <div id="kt_activities" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'lg': '900px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close">
            <div class="card shadow-none border-0 rounded-0">
                <!--begin::Header-->
                <div class="card-header" id="kt_activities_header">
                    <h3 class="card-title fw-bold text-gray-900">Activity Logs</h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="kt_activities_close">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </button>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body position-relative" id="kt_activities_body">
                    <!--begin::Content-->
                    <div id="kt_activities_scroll" class="position-relative scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_activities_body" data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer" data-kt-scroll-offset="5px">
                        <!--begin::Timeline items-->
                        <div class="timeline timeline-border-dashed">
                            <!--begin::Timeline item-->
                            <div class="timeline-item">
                                <!--begin::Timeline line-->
                                <div class="timeline-line"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon">
                                    <i class="ki-outline ki-message-text-2 fs-2 text-gray-500"></i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content mb-10 mt-n1">
                                    <!--begin::Timeline heading-->
                                    <div class="pe-3 mb-5">
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-semibold mb-2">There are 2 new tasks for you in “AirPlus Mobile App” project:</div>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <!--begin::Info-->
                                            <div class="text-muted me-2 fs-7">Added at 4:23 PM by</div>
                                            <!--end::Info-->
                                            <!--begin::User-->
                                            <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Nina Nilson">
                                                <img src="assets/media/avatars/300-14.jpg" alt="img" />
                                            </div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Timeline heading-->
                                    <!--begin::Timeline details-->
                                    <div class="overflow-auto pb-5">
                                        <!--begin::Record-->
                                        <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                            <!--begin::Title-->
                                            <a href="apps/projects/project.html" class="fs-5 text-gray-900 text-hover-primary fw-semibold w-375px min-w-200px">Meeting with customer</a>
                                            <!--end::Title-->
                                            <!--begin::Label-->
                                            <div class="min-w-175px pe-2">
                                                <span class="badge badge-light text-muted">Application Design</span>
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Users-->
                                            <div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px pe-2">
                                                <!--begin::User-->
                                                <div class="symbol symbol-circle symbol-25px">
                                                    <img src="assets/media/avatars/300-2.jpg" alt="img" />
                                                </div>
                                                <!--end::User-->
                                                <!--begin::User-->
                                                <div class="symbol symbol-circle symbol-25px">
                                                    <img src="assets/media/avatars/300-14.jpg" alt="img" />
                                                </div>
                                                <!--end::User-->
                                                <!--begin::User-->
                                                <div class="symbol symbol-circle symbol-25px">
                                                    <div class="symbol-label fs-8 fw-semibold bg-primary text-inverse-primary">A</div>
                                                </div>
                                                <!--end::User-->
                                            </div>
                                            <!--end::Users-->
                                            <!--begin::Progress-->
                                            <div class="min-w-125px pe-2">
                                                <span class="badge badge-light-primary">In Progress</span>
                                            </div>
                                            <!--end::Progress-->
                                            <!--begin::Action-->
                                            <a href="apps/projects/project.html" class="btn btn-sm btn-light btn-active-light-primary">View</a>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Record-->
                                        <!--begin::Record-->
                                        <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-0">
                                            <!--begin::Title-->
                                            <a href="apps/projects/project.html" class="fs-5 text-gray-900 text-hover-primary fw-semibold w-375px min-w-200px">Project Delivery Preparation</a>
                                            <!--end::Title-->
                                            <!--begin::Label-->
                                            <div class="min-w-175px">
                                                <span class="badge badge-light text-muted">CRM System Development</span>
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Users-->
                                            <div class="symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px">
                                                <!--begin::User-->
                                                <div class="symbol symbol-circle symbol-25px">
                                                    <img src="assets/media/avatars/300-20.jpg" alt="img" />
                                                </div>
                                                <!--end::User-->
                                                <!--begin::User-->
                                                <div class="symbol symbol-circle symbol-25px">
                                                    <div class="symbol-label fs-8 fw-semibold bg-success text-inverse-primary">B</div>
                                                </div>
                                                <!--end::User-->
                                            </div>
                                            <!--end::Users-->
                                            <!--begin::Progress-->
                                            <div class="min-w-125px">
                                                <span class="badge badge-light-success">Completed</span>
                                            </div>
                                            <!--end::Progress-->
                                            <!--begin::Action-->
                                            <a href="apps/projects/project.html" class="btn btn-sm btn-light btn-active-light-primary">View</a>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Record-->
                                    </div>
                                    <!--end::Timeline details-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item">
                                <!--begin::Timeline line-->
                                <div class="timeline-line"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon me-4">
                                    <i class="ki-outline ki-flag fs-2 text-gray-500"></i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content mb-10 mt-n2">
                                    <!--begin::Timeline heading-->
                                    <div class="overflow-auto pe-3">
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-semibold mb-2">Invitation for crafting engaging designs that speak human workshop</div>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <!--begin::Info-->
                                            <div class="text-muted me-2 fs-7">Sent at 4:23 PM by</div>
                                            <!--end::Info-->
                                            <!--begin::User-->
                                            <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Alan Nilson">
                                                <img src="assets/media/avatars/300-1.jpg" alt="img" />
                                            </div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Timeline heading-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item">
                                <!--begin::Timeline line-->
                                <div class="timeline-line"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon">
                                    <i class="ki-outline ki-disconnect fs-2 text-gray-500"></i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content mb-10 mt-n1">
                                    <!--begin::Timeline heading-->
                                    <div class="mb-5 pe-3">
                                        <!--begin::Title-->
                                        <a href="#" class="fs-5 fw-semibold text-gray-800 text-hover-primary mb-2">3 New Incoming Project Files:</a>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <!--begin::Info-->
                                            <div class="text-muted me-2 fs-7">Sent at 10:30 PM by</div>
                                            <!--end::Info-->
                                            <!--begin::User-->
                                            <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Jan Hummer">
                                                <img src="assets/media/avatars/300-23.jpg" alt="img" />
                                            </div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Timeline heading-->
                                    <!--begin::Timeline details-->
                                    <div class="overflow-auto pb-5">
                                        <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-5">
                                            <!--begin::Item-->
                                            <div class="d-flex flex-aligns-center pe-10 pe-lg-20">
                                                <!--begin::Icon-->
                                                <img alt="" class="w-30px me-3" src="assets/media/svg/files/pdf.svg" />
                                                <!--end::Icon-->
                                                <!--begin::Info-->
                                                <div class="ms-1 fw-semibold">
                                                    <!--begin::Desc-->
                                                    <a href="apps/projects/project.html" class="fs-6 text-hover-primary fw-bold">Finance KPI App Guidelines</a>
                                                    <!--end::Desc-->
                                                    <!--begin::Number-->
                                                    <div class="text-gray-500">1.9mb</div>
                                                    <!--end::Number-->
                                                </div>
                                                <!--begin::Info-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="d-flex flex-aligns-center pe-10 pe-lg-20">
                                                <!--begin::Icon-->
                                                <img alt="apps/projects/project.html" class="w-30px me-3" src="assets/media/svg/files/doc.svg" />
                                                <!--end::Icon-->
                                                <!--begin::Info-->
                                                <div class="ms-1 fw-semibold">
                                                    <!--begin::Desc-->
                                                    <a href="#" class="fs-6 text-hover-primary fw-bold">Client UAT Testing Results</a>
                                                    <!--end::Desc-->
                                                    <!--begin::Number-->
                                                    <div class="text-gray-500">18kb</div>
                                                    <!--end::Number-->
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="d-flex flex-aligns-center">
                                                <!--begin::Icon-->
                                                <img alt="apps/projects/project.html" class="w-30px me-3" src="assets/media/svg/files/css.svg" />
                                                <!--end::Icon-->
                                                <!--begin::Info-->
                                                <div class="ms-1 fw-semibold">
                                                    <!--begin::Desc-->
                                                    <a href="#" class="fs-6 text-hover-primary fw-bold">Finance Reports</a>
                                                    <!--end::Desc-->
                                                    <!--begin::Number-->
                                                    <div class="text-gray-500">20mb</div>
                                                    <!--end::Number-->
                                                </div>
                                                <!--end::Icon-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                    </div>
                                    <!--end::Timeline details-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item">
                                <!--begin::Timeline line-->
                                <div class="timeline-line"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon">
                                    <i class="ki-outline ki-abstract-26 fs-2 text-gray-500"></i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content mb-10 mt-n1">
                                    <!--begin::Timeline heading-->
                                    <div class="pe-3 mb-5">
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-semibold mb-2">Task 
                                        <a href="#" class="text-primary fw-bold me-1">#45890</a>merged with 
                                        <a href="#" class="text-primary fw-bold me-1">#45890</a>in “Ads Pro Admin Dashboard project:</div>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <!--begin::Info-->
                                            <div class="text-muted me-2 fs-7">Initiated at 4:23 PM by</div>
                                            <!--end::Info-->
                                            <!--begin::User-->
                                            <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Nina Nilson">
                                                <img src="assets/media/avatars/300-14.jpg" alt="img" />
                                            </div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Timeline heading-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item">
                                <!--begin::Timeline line-->
                                <div class="timeline-line"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon">
                                    <i class="ki-outline ki-pencil fs-2 text-gray-500"></i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content mb-10 mt-n1">
                                    <!--begin::Timeline heading-->
                                    <div class="pe-3 mb-5">
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-semibold mb-2">3 new application design concepts added:</div>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <!--begin::Info-->
                                            <div class="text-muted me-2 fs-7">Created at 4:23 PM by</div>
                                            <!--end::Info-->
                                            <!--begin::User-->
                                            <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Marcus Dotson">
                                                <img src="assets/media/avatars/300-2.jpg" alt="img" />
                                            </div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Timeline heading-->
                                    <!--begin::Timeline details-->
                                    <div class="overflow-auto pb-5">
                                        <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-700px p-7">
                                            <!--begin::Item-->
                                            <div class="overlay me-10">
                                                <!--begin::Image-->
                                                <div class="overlay-wrapper">
                                                    <img alt="img" class="rounded w-150px" src="assets/media/stock/600x400/img-29.jpg" />
                                                </div>
                                                <!--end::Image-->
                                                <!--begin::Link-->
                                                <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                                                    <a href="#" class="btn btn-sm btn-primary btn-shadow">Explore</a>
                                                </div>
                                                <!--end::Link-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="overlay me-10">
                                                <!--begin::Image-->
                                                <div class="overlay-wrapper">
                                                    <img alt="img" class="rounded w-150px" src="assets/media/stock/600x400/img-31.jpg" />
                                                </div>
                                                <!--end::Image-->
                                                <!--begin::Link-->
                                                <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                                                    <a href="#" class="btn btn-sm btn-primary btn-shadow">Explore</a>
                                                </div>
                                                <!--end::Link-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="overlay">
                                                <!--begin::Image-->
                                                <div class="overlay-wrapper">
                                                    <img alt="img" class="rounded w-150px" src="assets/media/stock/600x400/img-40.jpg" />
                                                </div>
                                                <!--end::Image-->
                                                <!--begin::Link-->
                                                <div class="overlay-layer bg-dark bg-opacity-10 rounded">
                                                    <a href="#" class="btn btn-sm btn-primary btn-shadow">Explore</a>
                                                </div>
                                                <!--end::Link-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                    </div>
                                    <!--end::Timeline details-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item">
                                <!--begin::Timeline line-->
                                <div class="timeline-line"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon">
                                    <i class="ki-outline ki-sms fs-2 text-gray-500"></i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content mb-10 mt-n1">
                                    <!--begin::Timeline heading-->
                                    <div class="pe-3 mb-5">
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-semibold mb-2">New case 
                                        <a href="#" class="text-primary fw-bold me-1">#67890</a>is assigned to you in Multi-platform Database Design project</div>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="overflow-auto pb-5">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                <!--begin::Info-->
                                                <div class="text-muted me-2 fs-7">Added at 4:23 PM by</div>
                                                <!--end::Info-->
                                                <!--begin::User-->
                                                <a href="#" class="text-primary fw-bold me-1">Alice Tan</a>
                                                <!--end::User-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Timeline heading-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item">
                                <!--begin::Timeline line-->
                                <div class="timeline-line"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon">
                                    <i class="ki-outline ki-pencil fs-2 text-gray-500"></i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content mb-10 mt-n1">
                                    <!--begin::Timeline heading-->
                                    <div class="pe-3 mb-5">
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-semibold mb-2">You have received a new order:</div>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <!--begin::Info-->
                                            <div class="text-muted me-2 fs-7">Placed at 5:05 AM by</div>
                                            <!--end::Info-->
                                            <!--begin::User-->
                                            <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Robert Rich">
                                                <img src="assets/media/avatars/300-4.jpg" alt="img" />
                                            </div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Timeline heading-->
                                    <!--begin::Timeline details-->
                                    <div class="overflow-auto pb-5">
                                        <!--begin::Notice-->
                                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed min-w-lg-600px flex-shrink-0 p-6">
                                            <!--begin::Icon-->
                                            <i class="ki-outline ki-devices-2 fs-2tx text-primary me-4"></i>
                                            <!--end::Icon-->
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                                <!--begin::Content-->
                                                <div class="mb-3 mb-md-0 fw-semibold">
                                                    <h4 class="text-gray-900 fw-bold">Database Backup Process Completed!</h4>
                                                    <div class="fs-6 text-gray-700 pe-7">Login into Admin Dashboard to make sure the data integrity is OK</div>
                                                </div>
                                                <!--end::Content-->
                                                <!--begin::Action-->
                                                <a href="#" class="btn btn-primary px-6 align-self-center text-nowrap">Proceed</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Notice-->
                                    </div>
                                    <!--end::Timeline details-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item">
                                <!--begin::Timeline line-->
                                <div class="timeline-line"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon">
                                    <i class="ki-outline ki-basket fs-2 text-gray-500"></i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content mt-n1">
                                    <!--begin::Timeline heading-->
                                    <div class="pe-3 mb-5">
                                        <!--begin::Title-->
                                        <div class="fs-5 fw-semibold mb-2">New order 
                                        <a href="#" class="text-primary fw-bold me-1">#67890</a>is placed for Workshow Planning & Budget Estimation</div>
                                        <!--end::Title-->
                                        <!--begin::Description-->
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <!--begin::Info-->
                                            <div class="text-muted me-2 fs-7">Placed at 4:23 PM by</div>
                                            <!--end::Info-->
                                            <!--begin::User-->
                                            <a href="#" class="text-primary fw-bold me-1">Jimmy Bold</a>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Timeline heading-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline items-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer py-5 text-center" id="kt_activities_footer">
                    <a href="pages/user-profile/activity.html" class="btn btn-bg-body text-primary">View All Activities 
                    <i class="ki-outline ki-arrow-right fs-3 text-primary"></i></a>
                </div>
                <!--end::Footer-->
            </div>
        </div>
        <!--end::Activities drawer-->
        <!--begin::Chat drawer-->
        <div id="kt_drawer_chat" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="chat" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_chat_toggle" data-kt-drawer-close="#kt_drawer_chat_close">
            <!--begin::Messenger-->
            <div class="card w-100 border-0 rounded-0" id="kt_drawer_chat_messenger">
                <!--begin::Card header-->
                <div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
                    <!--begin::Title-->
                    <div class="card-title">
                        <!--begin::User-->
                        <div class="d-flex justify-content-center flex-column me-3">
                            <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">Brian Cox</a>
                            <!--begin::Info-->
                            <div class="mb-0 lh-1">
                                <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                                <span class="fs-7 fw-semibold text-muted">Active</span>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <div class="me-0">
                            <button class="btn btn-sm btn-icon btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-outline ki-dots-square fs-2"></i>
                            </button>
                            <!--begin::Menu 3-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                                <!--begin::Heading-->
                                <div class="menu-item px-3">
                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Contacts</div>
                                </div>
                                <!--end::Heading-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">Add Contact</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link flex-stack px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">Invite Contacts 
                                    <span class="ms-2" data-bs-toggle="tooltip" title="Specify a contact email to send an invitation">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span></a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                    <a href="#" class="menu-link px-3">
                                        <span class="menu-title">Groups</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <!--begin::Menu sub-->
                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Create Group</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Invite Members</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Settings</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu sub-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-1">
                                    <a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="Coming soon">Settings</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu 3-->
                        </div>
                        <!--end::Menu-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary" id="kt_drawer_chat_close">
                            <i class="ki-outline ki-cross-square fs-2"></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body" id="kt_drawer_chat_messenger_body">
                    <!--begin::Messages-->
                    <div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px">
                        <!--begin::Message(in)-->
                        <div class="d-flex justify-content-start mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-start">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="assets/media/avatars/300-25.jpg" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-3">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                                        <span class="text-muted fs-7 mb-1">2 mins</span>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">How likely are you to recommend our company to your friends and family ?</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Message(in)-->
                        <!--begin::Message(out)-->
                        <div class="d-flex justify-content-end mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-end">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                                    <div class="me-3">
                                        <span class="text-muted fs-7 mb-1">5 mins</span>
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="assets/media/avatars/300-1.jpg" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end" data-kt-element="message-text">Hey there, we’re just writing to let you know that you’ve been subscribed to a repository on GitHub.</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Message(out)-->
                        <!--begin::Message(in)-->
                        <div class="d-flex justify-content-start mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-start">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="assets/media/avatars/300-25.jpg" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-3">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                                        <span class="text-muted fs-7 mb-1">1 Hour</span>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">Ok, Understood!</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Message(in)-->
                        <!--begin::Message(out)-->
                        <div class="d-flex justify-content-end mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-end">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                                    <div class="me-3">
                                        <span class="text-muted fs-7 mb-1">2 Hours</span>
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="assets/media/avatars/300-1.jpg" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end" data-kt-element="message-text">You’ll receive notifications for all issues, pull requests!</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Message(out)-->
                        <!--begin::Message(in)-->
                        <div class="d-flex justify-content-start mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-start">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="assets/media/avatars/300-25.jpg" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-3">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                                        <span class="text-muted fs-7 mb-1">3 Hours</span>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">You can unwatch this repository immediately by clicking here: 
                                <a href="https://keenthemes.com">Keenthemes.com</a></div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Message(in)-->
                        <!--begin::Message(out)-->
                        <div class="d-flex justify-content-end mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-end">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                                    <div class="me-3">
                                        <span class="text-muted fs-7 mb-1">4 Hours</span>
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="assets/media/avatars/300-1.jpg" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end" data-kt-element="message-text">Most purchased Business courses during this sale!</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Message(out)-->
                        <!--begin::Message(in)-->
                        <div class="d-flex justify-content-start mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-start">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="assets/media/avatars/300-25.jpg" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-3">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                                        <span class="text-muted fs-7 mb-1">5 Hours</span>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">Company BBQ to celebrate the last quater achievements and goals. Food and drinks provided</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Message(in)-->
                        <!--begin::Message(template for out)-->
                        <div class="d-flex justify-content-end mb-10 d-none" data-kt-element="template-out">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-end">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                                    <div class="me-3">
                                        <span class="text-muted fs-7 mb-1">Just now</span>
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="assets/media/avatars/300-1.jpg" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end" data-kt-element="message-text"></div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Message(template for out)-->
                        <!--begin::Message(template for in)-->
                        <div class="d-flex justify-content-start mb-10 d-none" data-kt-element="template-in">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column align-items-start">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="assets/media/avatars/300-25.jpg" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-3">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">Brian Cox</a>
                                        <span class="text-muted fs-7 mb-1">Just now</span>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">Right before vacation season we have the next Big Deal for you.</div>
                                <!--end::Text-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Message(template for in)-->
                    </div>
                    <!--end::Messages-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer pt-4" id="kt_drawer_chat_messenger_footer">
                    <!--begin::Input-->
                    <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input" placeholder="Type a message"></textarea>
                    <!--end::Input-->
                    <!--begin:Toolbar-->
                    <div class="d-flex flex-stack">
                        <!--begin::Actions-->
                        <div class="d-flex align-items-center me-2">
                            <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Coming soon">
                                <i class="ki-outline ki-paper-clip fs-3"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Coming soon">
                                <i class="ki-outline ki-cloud-add fs-3"></i>
                            </button>
                        </div>
                        <!--end::Actions-->
                        <!--begin::Send-->
                        <button class="btn btn-primary" type="button" data-kt-element="send">Send</button>
                        <!--end::Send-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Messenger-->
        </div>
        <!--end::Chat drawer-->
        <!--begin::Chat drawer-->
        <div id="kt_shopping_cart" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="cart" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_shopping_cart_toggle" data-kt-drawer-close="#kt_drawer_shopping_cart_close">
            <!--begin::Messenger-->
            <div class="card card-flush w-100 rounded-0">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Title-->
                    <h3 class="card-title text-gray-900 fw-bold">Shopping Cart</h3>
                    <!--end::Title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_shopping_cart_close">
                            <i class="ki-outline ki-cross fs-2"></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body hover-scroll-overlay-y h-400px pt-5">
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column me-3">
                            <!--begin::Section-->
                            <div class="mb-3">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">Iblender</a>
                                <span class="text-gray-500 fw-semibold d-block">The best kitchen gadget in 2022</span>
                            </div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-gray-800 fs-5">$ 350</span>
                                <span class="text-muted mx-2">for</span>
                                <span class="fw-bold text-gray-800 fs-5 me-3">5</span>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                    <i class="ki-outline ki-minus fs-4"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                    <i class="ki-outline ki-plus fs-4"></i>
                                </a>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Pic-->
                        <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                            <img src="assets/media/stock/600x400/img-1.jpg" alt="" />
                        </div>
                        <!--end::Pic-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column me-3">
                            <!--begin::Section-->
                            <div class="mb-3">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">SmartCleaner</a>
                                <span class="text-gray-500 fw-semibold d-block">Smart tool for cooking</span>
                            </div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-gray-800 fs-5">$ 650</span>
                                <span class="text-muted mx-2">for</span>
                                <span class="fw-bold text-gray-800 fs-5 me-3">4</span>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                    <i class="ki-outline ki-minus fs-4"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                    <i class="ki-outline ki-plus fs-4"></i>
                                </a>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Pic-->
                        <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                            <img src="assets/media/stock/600x400/img-3.jpg" alt="" />
                        </div>
                        <!--end::Pic-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column me-3">
                            <!--begin::Section-->
                            <div class="mb-3">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">CameraMaxr</a>
                                <span class="text-gray-500 fw-semibold d-block">Professional camera for edge</span>
                            </div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-gray-800 fs-5">$ 150</span>
                                <span class="text-muted mx-2">for</span>
                                <span class="fw-bold text-gray-800 fs-5 me-3">3</span>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                    <i class="ki-outline ki-minus fs-4"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                    <i class="ki-outline ki-plus fs-4"></i>
                                </a>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Pic-->
                        <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                            <img src="assets/media/stock/600x400/img-8.jpg" alt="" />
                        </div>
                        <!--end::Pic-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column me-3">
                            <!--begin::Section-->
                            <div class="mb-3">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">$D Printer</a>
                                <span class="text-gray-500 fw-semibold d-block">Manfactoring unique objekts</span>
                            </div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-gray-800 fs-5">$ 1450</span>
                                <span class="text-muted mx-2">for</span>
                                <span class="fw-bold text-gray-800 fs-5 me-3">7</span>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                    <i class="ki-outline ki-minus fs-4"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                    <i class="ki-outline ki-plus fs-4"></i>
                                </a>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Pic-->
                        <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                            <img src="assets/media/stock/600x400/img-26.jpg" alt="" />
                        </div>
                        <!--end::Pic-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column me-3">
                            <!--begin::Section-->
                            <div class="mb-3">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">MotionWire</a>
                                <span class="text-gray-500 fw-semibold d-block">Perfect animation tool</span>
                            </div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-gray-800 fs-5">$ 650</span>
                                <span class="text-muted mx-2">for</span>
                                <span class="fw-bold text-gray-800 fs-5 me-3">7</span>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                    <i class="ki-outline ki-minus fs-4"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                    <i class="ki-outline ki-plus fs-4"></i>
                                </a>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Pic-->
                        <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                            <img src="assets/media/stock/600x400/img-21.jpg" alt="" />
                        </div>
                        <!--end::Pic-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column me-3">
                            <!--begin::Section-->
                            <div class="mb-3">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">Samsung</a>
                                <span class="text-gray-500 fw-semibold d-block">Profile info,Timeline etc</span>
                            </div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-gray-800 fs-5">$ 720</span>
                                <span class="text-muted mx-2">for</span>
                                <span class="fw-bold text-gray-800 fs-5 me-3">6</span>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                    <i class="ki-outline ki-minus fs-4"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                    <i class="ki-outline ki-plus fs-4"></i>
                                </a>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Pic-->
                        <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                            <img src="assets/media/stock/600x400/img-34.jpg" alt="" />
                        </div>
                        <!--end::Pic-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column me-3">
                            <!--begin::Section-->
                            <div class="mb-3">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-4 fw-bold">$D Printer</a>
                                <span class="text-gray-500 fw-semibold d-block">Manfactoring unique objekts</span>
                            </div>
                            <!--end::Section-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-gray-800 fs-5">$ 430</span>
                                <span class="text-muted mx-2">for</span>
                                <span class="fw-bold text-gray-800 fs-5 me-3">8</span>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon-success btn-icon w-25px h-25px me-2">
                                    <i class="ki-outline ki-minus fs-4"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-light-success btn-icon w-25px h-25px">
                                    <i class="ki-outline ki-plus fs-4"></i>
                                </a>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Pic-->
                        <div class="symbol symbol-70px symbol-2by3 flex-shrink-0">
                            <img src="assets/media/stock/600x400/img-27.jpg" alt="" />
                        </div>
                        <!--end::Pic-->
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer">
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <span class="fw-bold text-gray-600">Total</span>
                        <span class="text-gray-800 fw-bolder fs-5">$ 1840.00</span>
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <span class="fw-bold text-gray-600">Sub total</span>
                        <span class="text-primary fw-bolder fs-5">$ 246.35</span>
                    </div>
                    <!--end::Item-->
                    <!--end::Action-->
                    <div class="d-flex justify-content-end mt-9">
                        <a href="#" class="btn btn-primary d-flex justify-content-end">Pleace Order</a>
                    </div>
                    <!--end::Action-->
                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Messenger-->
        </div>
        <!--end::Chat drawer-->
        <!--end::Drawers-->
        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <i class="ki-outline ki-arrow-up"></i>
        </div>
        <!--end::Scrolltop-->
        
        @stack('modals')
        
        <!--begin::Javascript-->
        <script>var hostUrl = "assets/";</script>
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="{{ asset('/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('/js/scripts.bundle.js') }}"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="{{ asset('/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
        <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
        <script src="{{ asset('/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--end::Vendors Javascript-->
        <!--begin::Custom Javascript(used for this page only)-->
        <script src="{{ asset('/js/widgets.bundle.js') }}"></script>
        <script src="{{ asset('/js/custom/widgets.js') }}"></script>
        <script src="{{ asset('/js/custom/apps/chat/chat.js') }}"></script>
        <script src="{{ asset('/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
        <script src="{{ asset('/js/custom/utilities/modals/new-target.js') }}"></script>
        <script src="{{ asset('/js/custom/utilities/modals/users-search.js') }}"></script>
        <!--end::Custom Javascript-->
        <!--end::Javascript-->

        <script>
            $('.confirm').on('click', function (e) {
                e.preventDefault();

                var button = $(this);
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    customClass: {
                        confirmButton: 'bg-dark',
                        cancelButton: 'bg-secondary text-dark'
                    }
                }).then(function(result) {
                    if (result.value) {
                        if (button.hasClass('is-form')) {
                            var form = button.closest('form');
                            form.submit();

                        } else {
                            var link = button.attr('href');
                            window.location = link;
                        }
                    }
                });
            });
        </script>

        @stack('scripts')
    </body>
    <!--end::Body-->
</html>