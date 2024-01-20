<x-app-layout>
    @section('title') {{ __('Dashboard') }} @endsection

    @if (!$company->isSetUp())
        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-12 p-6">
            <!--begin::Icon-->
            <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
            <!--end::Icon-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-grow-1">
                <!--begin::Content-->
                <div class="fw-semibold">
                    <h4 class="text-gray-900 fw-bold">Tvoj nalog nije povezan!</h4>
                    <div class="fs-6 text-gray-700">Poveži svoj nalog sa Slanje Paketa, Facebook i Shopify platformama, kako bi praćenje statistike bilo tačno.</div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
            <!--begin::Col-->
            <div class="col-md-4 mb-xl-10">
                <a href="javascript:void()" @if (!$company->isSetUp('slanje_paketa')) data-bs-toggle="modal" data-bs-target="#connectSlanjePaketaModal" @endif class="card @if (!$company->isSetUp('slanje_paketa')) hover-elevate-up parent-hover @else opacity-50 @endif shadow-sm">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <span class="svg-icon fs-1">
                            <img src="https://softver.slanjepaketa.rs/assets/img/slanje-paketa-logo.png" class="h-40px mx-1">
                        </span>

                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold d-flex align-items-center">
                            Poveži Slanje Paketa
                        </span>
                    </div>
                </a>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4 mb-xl-10">
                <a href="javascript:void()" @if (!$company->isSetUp('facebook')) data-bs-toggle="modal" data-bs-target="#connectFacebookModal" @endif class="card @if (!$company->isSetUp('facebook')) hover-elevate-up parent-hover @else opacity-50 @endif shadow-sm">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <span class="svg-icon fs-1">
                            <img src="https://www.edigitalagency.com.au/wp-content/uploads/Facebook-logo-blue-circle-large-transparent-png.png" class="h-40px mx-1">
                        </span>

                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold d-flex align-items-center">
                            Poveži Facebook
                        </span>
                    </div>
                </a>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4 mb-xl-10">
                <a href="javascript:void()" @if (!$company->isSetUp('shopify')) data-bs-toggle="modal" data-bs-target="#connectShopifyModal" @endif class="card @if (!$company->isSetUp('shopify')) hover-elevate-up parent-hover @else opacity-50 @endif shadow-sm">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <span class="svg-icon fs-1">
                            <img src="https://assets.stickpng.com/images/58482ec0cef1014c0b5e4a70.png" class="h-40px mx-1">
                        </span>

                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold d-flex align-items-center">
                            Poveži Shopify
                        </span>
                    </div>
                </a>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    @elseif ($company->products()->where('buying_price', 0)->count())
        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-12 p-6">
            <!--begin::Icon-->
            <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
            <!--end::Icon-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-grow-1">
                <!--begin::Content-->
                <div class="fw-semibold">
                    <h4 class="text-gray-900 fw-bold">Kupovne cene nedostaju!</h4>
                    <div class="fs-6 text-gray-700">Neki proizvodi nemaju kupovne cene. Dodaj cene da bi praćenje bilo tačno - 
                    <a href="{{ route('products.index') }}" class="fw-bold">Izmeni cene</a>.</div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
    @endif

    <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
    <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" data-kt-daterangepicker-range="today" class="btn btn-sm bg-light-primary border border-primary d-flex align-items-center justify-content-center px-4 w-250px mb-10">
        <!--begin::Display range-->
        <div class="text-dark fw-bold">Učitavanje datuma...</div>
        <!--end::Display range-->
        <i class="ki-outline ki-calendar-8 fs-1 ms-2 me-0 text-dark"></i>
    </div>
    <!--end::Daterangepicker-->

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
        <!--begin::Col-->
        <div class="col-md-4 mb-xl-10">
            <!--begin::Card widget 28-->
            <div class="card card-flush">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Card title-->
                    <div class="card-title flex-stack flex-row-fluid justify-content-center">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45px">
                            <span class="symbol-label bg-light-info">
                                <i class="ki-outline ki-price-tag fs-2x text-gray-800"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card title-->
                <!--begin::Card body-->
                <div class="card-body d-flex text-center justify-content-center pt-5">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column">
                        <span class="fw-bolder fs-2x text-gray-900">{{ $orders }}</span>
                        <span class="fw-bold fs-7 text-gray-500">Broj porudžbina</span>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 28-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 mb-xl-10">
            <!--begin::Card widget 28-->
            <div class="card card-flush">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Card title-->
                    <div class="card-title flex-stack flex-row-fluid justify-content-center">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45px">
                            <span class="symbol-label bg-light-info">
                                <i class="ki-outline ki-dollar fs-2x text-gray-800"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card title-->
                <!--begin::Card body-->
                <div class="card-body d-flex text-center justify-content-center pt-5">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column">
                        <span class="fw-bolder fs-2x text-gray-900">${{ number_format($spent, 2) }}</span>
                        <span class="fw-bold fs-7 text-gray-500">Trošak</span>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 28-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 mb-xl-10">
            <!--begin::Card widget 28-->
            <div class="card card-flush">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Card title-->
                    <div class="card-title flex-stack flex-row-fluid justify-content-center">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45px">
                            <span class="symbol-label bg-light-info">
                                <i class="ki-outline ki-shield fs-2x text-gray-800"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card title-->
                <!--begin::Card body-->
                <div class="card-body d-flex text-center justify-content-center pt-5">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column">
                        <span class="fw-bolder fs-2x text-gray-900">${{ number_format($spent, 2) }}</span>
                        <span class="fw-bold fs-7 text-gray-500">Profit</span>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 28-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <div class="row">
        <!--begin::Col-->
        <div class="col-md-12 mb-10">
            <!--begin::Chart widget 11-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">Delivery Stats</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Users from all channels</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <ul class="nav" id="kt_chart_widget_11_tabs">
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1" data-bs-toggle="tab" id="kt_charts_widget_11_tab_1" href="#kt_chart_widget_11_tab_content_1">2020</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1" data-bs-toggle="tab" id="kt_charts_widget_11_tab_2" href="#kt_chart_widget_11_tab_content_2">2021</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 active" data-bs-toggle="tab" id="kt_charts_widget_11_tab_3" href="#kt_chart_widget_11_tab_content_3">Month</a>
                            </li>
                        </ul>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pb-0 pt-4">
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade" id="kt_chart_widget_11_tab_content_1" role="tabpanel">
                            <!--begin::Statistics-->
                            <div class="mb-2">
                                <!--begin::Statistics-->
                                <span class="fs-2hx fw-bold d-block text-gray-800 me-2 mb-2 lh-1 ls-n2">1,349</span>
                                <!--end::Statistics-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-500">Avarage cost per iteraction</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_11_chart_1" class="ms-n5 me-n3 min-h-auto w-100" style="height: 300px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Tab pane-->
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade" id="kt_chart_widget_11_tab_content_2" role="tabpanel">
                            <!--begin::Statistics-->
                            <div class="mb-2">
                                <!--begin::Statistics-->
                                <span class="fs-2hx fw-bold d-block text-gray-800 me-2 mb-2 lh-1 ls-n2">3,492</span>
                                <!--end::Statistics-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-500">Avarage cost per iteraction</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_11_chart_2" class="ms-n5 me-n3 min-h-auto" style="height: 300px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Tab pane-->
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade active show" id="kt_chart_widget_11_tab_content_3" role="tabpanel">
                            <!--begin::Statistics-->
                            <div class="mb-2">
                                <!--begin::Statistics-->
                                <span class="fs-2hx fw-bold d-block text-gray-800 me-2 mb-2 lh-1 ls-n2">4,796</span>
                                <!--end::Statistics-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-500">Deliveries in 30 Days</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_11_chart_3" class="ms-n5 me-n3 min-h-auto" style="height: 300px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 11-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xl-6 mb-xl-10">
            <!--begin::List widget 17-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Popular Products</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">8k social visitors</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-light">Add Product</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0">
                    <!--begin::Content-->
                    <div class="d-flex flex-stack my-5">
                        <span class="text-gray-500 fs-7 fw-bold">ITEM</span>
                        <span class="text-gray-500 fw-bold fs-7">ITEM PRICE</span>
                    </div>
                    <!--end::Content-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center me-3">
                            <!--begin::Icon-->
                            <img src="assets/media/stock/ecommerce/14.png" class="me-4 w-50px" alt="" />
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="flex-grow-1">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Fjallraven</a>
                                <span class="text-gray-500 fw-semibold d-block fs-7">Item: #XDG-6437</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Value-->
                        <span class="text-gray-800 fw-bold fs-6">$ 72.00</span>
                        <!--end::Value-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-4"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center me-3">
                            <!--begin::Icon-->
                            <img src="assets/media/stock/ecommerce/13.png" class="me-4 w-50px" alt="" />
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="flex-grow-1">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Nike AirMax</a>
                                <span class="text-gray-500 fw-semibold d-block fs-7">Item: #XDG-1836</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Value-->
                        <span class="text-gray-800 fw-bold fs-6">$ 45.00</span>
                        <!--end::Value-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-4"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center me-3">
                            <!--begin::Icon-->
                            <img src="assets/media/stock/ecommerce/41.png" class="me-4 w-50px" alt="" />
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="flex-grow-1">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Bose QC 35</a>
                                <span class="text-gray-500 fw-semibold d-block fs-7">Item: #XDG-6254</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Value-->
                        <span class="text-gray-800 fw-bold fs-6">$ 168.00</span>
                        <!--end::Value-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-4"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center me-3">
                            <!--begin::Icon-->
                            <img src="assets/media/stock/ecommerce/53.png" class="me-4 w-50px" alt="" />
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="flex-grow-1">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Greeny</a>
                                <span class="text-gray-500 fw-semibold d-block fs-7">Item: #XDG-1746</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Value-->
                        <span class="text-gray-800 fw-bold fs-6">$ 14.50</span>
                        <!--end::Value-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-4"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center me-3">
                            <!--begin::Icon-->
                            <img src="assets/media/stock/ecommerce/71.png" class="me-4 w-50px" alt="" />
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="flex-grow-1">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Apple Watches</a>
                                <span class="text-gray-500 fw-semibold d-block fs-7">Item: #XDG-6245</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Value-->
                        <span class="text-gray-800 fw-bold fs-6">$ 362.00</span>
                        <!--end::Value-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-4"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center me-3">
                            <!--begin::Icon-->
                            <img src="assets/media/stock/ecommerce/194.png" class="me-4 w-50px" alt="" />
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="flex-grow-1">
                                <a href="apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Friendly Robot</a>
                                <span class="text-gray-500 fw-semibold d-block fs-7">Item: #XDG-2347</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Value-->
                        <span class="text-gray-800 fw-bold fs-6">$ 48.00</span>
                        <!--end::Value-->
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List widget 17-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6 mb-xl-10">
            <!--begin::List widget 16-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Delivery Tracking</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">56 deliveries in progress</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-sm btn-light" data-bs-toggle='tooltip' data-bs-dismiss='click' data-bs-custom-class="tooltip-inverse" title="Delivery App is coming soon">View All</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-4 px-0">
                    <!--begin::Nav-->
                    <ul class="nav nav-pills nav-pills-custom item position-relative mx-9 mb-9">
                        <!--begin::Item-->
                        <li class="nav-item col-4 mx-0 p-0">
                            <!--begin::Link-->
                            <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#kt_list_widget_16_tab_1">
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">New</span>
                                <!--end::Subtitle-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                                <!--end::Bullet-->
                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item col-4 mx-0 px-0">
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#kt_list_widget_16_tab_2">
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Preparing</span>
                                <!--end::Subtitle-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                                <!--end::Bullet-->
                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="nav-item col-4 mx-0 px-0">
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#kt_list_widget_16_tab_3">
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Shipping</span>
                                <!--end::Subtitle-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                                <!--end::Bullet-->
                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->
                        <!--begin::Bullet-->
                        <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
                        <!--end::Bullet-->
                    </ul>
                    <!--end::Nav-->
                    <!--begin::Tab Content-->
                    <div class="tab-content px-9 hover-scroll-overlay-y pe-7 me-3 mb-2" style="height: 454px">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_list_widget_16_tab_1">
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Brooklyn Simmons</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">6391 Elgin St. Celina, Delaware 10299</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Ralph Edwards</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">2464 Royal Ln. Mesa, New Jersey 45463</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron Williamson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">3891 Ranchview Dr. Richardson, California 62639</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin Watson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">8502 Preston Rd. Inglewood, Maine 98380</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Albert Flores</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">3517 W. Gray St. Utica, Pennsylvania 57867</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Jessie Clarcson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">Total 2,356 Items in the Stock</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron Williamson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">3891 Ranchview Dr. Richardson, California 62639</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin Watson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">8502 Preston Rd. Inglewood, Maine 98380</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Brooklyn Simmons</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">6391 Elgin St. Celina, Delaware 10299</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Ralph Edwards</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">2464 Royal Ln. Mesa, New Jersey 45463</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="kt_list_widget_16_tab_2">
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron Williamson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">3891 Ranchview Dr. Richardson, California 62639</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin Watson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">8502 Preston Rd. Inglewood, Maine 98380</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Brooklyn Simmons</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">6391 Elgin St. Celina, Delaware 10299</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Ralph Edwards</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">2464 Royal Ln. Mesa, New Jersey 45463</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron Williamson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">3891 Ranchview Dr. Richardson, California 62639</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin Watson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">8502 Preston Rd. Inglewood, Maine 98380</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Albert Flores</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">3517 W. Gray St. Utica, Pennsylvania 57867</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Jessie Clarcson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">Total 2,356 Items in the Stock</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Albert Flores</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">3517 W. Gray St. Utica, Pennsylvania 57867</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Jessie Clarcson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">Total 2,356 Items in the Stock</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="kt_list_widget_16_tab_3">
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Albert Flores</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">3517 W. Gray St. Utica, Pennsylvania 57867</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Jessie Clarcson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">Total 2,356 Items in the Stock</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Brooklyn Simmons</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">6391 Elgin St. Celina, Delaware 10299</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Ralph Edwards</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">2464 Royal Ln. Mesa, New Jersey 45463</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Brooklyn Simmons</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">6391 Elgin St. Celina, Delaware 10299</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Ralph Edwards</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">2464 Royal Ln. Mesa, New Jersey 45463</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron Williamson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">3891 Ranchview Dr. Richardson, California 62639</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin Watson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">8502 Preston Rd. Inglewood, Maine 98380</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-5 mb-4"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="m-0">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-border-dashed">
                                    <!--begin::Timeline item-->
                                    <div class="timeline-item pb-5">
                                        <!--begin::Timeline line-->
                                        <div class="timeline-line"></div>
                                        <!--end::Timeline line-->
                                        <!--begin::Timeline icon-->
                                        <div class="timeline-icon">
                                            <i class="ki-outline ki-cd fs-2 text-success"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-success text-uppercase">Sender</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Cameron Williamson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">3891 Ranchview Dr. Richardson, California 62639</span>
                                            <!--end::Title-->
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
                                            <i class="ki-outline ki-geolocation fs-2 text-info"></i>
                                        </div>
                                        <!--end::Timeline icon-->
                                        <!--begin::Timeline content-->
                                        <div class="timeline-content m-0">
                                            <!--begin::Label-->
                                            <span class="fs-8 fw-bolder text-info text-uppercase">Receiver</span>
                                            <!--begin::Label-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-6 text-gray-800 fw-bold d-block text-hover-primary">Kristin Watson</a>
                                            <!--end::Title-->
                                            <!--begin::Title-->
                                            <span class="fw-semibold text-gray-500">8502 Preston Rd. Inglewood, Maine 98380</span>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Timeline content-->
                                    </div>
                                    <!--end::Timeline item-->
                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Tap pane-->
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::List widget 16-->
        </div>
        <!--end::Col-->
    </div>
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-xl-12">
            <!--begin::List widget 23-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Kampanje</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Statistika tvojih Facebook kampanja.</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar"></div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5">
                    @if (count($company->campaigns))
                        <div class="separator separator-dashed"></div>
                        <!--begin::Items-->
                        <div>
                            @foreach ($company->campaigns as $campaign)
                                <?php $stats = $campaign->getStats(); ?>
                                <!--begin::Col-->
                                <div class="col-md-12 mb-5">
                                    <div class="card card-flush flex-row-fluid p-6 pb-5 mw-100">
                                        <!--begin::Body-->
                                        <div class="card-body text-center py-3">
                                            <div class="d-flex flex-stack">
                                                <!--begin::Food img-->
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6c/Facebook_Logo_2023.png" class="w-30px w-xxl-50px rounded rounded-xl" alt="{{ $campaign->name }}">
                                                <!--end::Food img-->
                                                <!--begin::Section-->
                                                <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                                    <!--begin::Content-->
                                                    <div class="me-5 px-10 w-700px text-start">
                                                        <!--begin::Title-->
                                                        <a href="https://adsmanager.facebook.com/adsmanager/manage/adsets?act={{ $company->fb_ad_account_id }}&selected_campaign_ids={{ $campaign->facebook_id }}" target="_blank" class="text-gray-800 fw-bold text-hover-primary fs-2">{{ $campaign->name }}</a>
                                                        <!--end::Title-->
                                                        <!--begin::Desc-->
                                                        <span class="text-gray-500 fw-semibold fs-5 d-block text-start ps-0">
                                                            Facebook ID: {{ $campaign->facebook_id }}
                                                        </span>
                                                        <!--end::Desc-->

                                                        <span class="badge badge-light-dark text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                            Porudžbine: {{ 12 }}
                                                        </span>
                                                        <span class="badge badge-light-primary text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                            Zarada: 12,000.00 din
                                                        </span>
                                                        <span class="badge badge-light-warning text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                            Proizvodi: -1,000 din
                                                        </span>
                                                        <span class="badge badge-light-warning text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                            Reklame: -1,000 din
                                                        </span>
                                                        <span class="badge badge-light-warning text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                            Slanje: -1,000 din
                                                        </span>
                                                        <span class="badge badge-light-warning text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                            Dostava: -1,000 din
                                                        </span>
                                                        <div class="mt-5">
                                                            <span class="badge badge-light-warning text-dark px-4 fw-semibold fs-7 text-center mt-3 py-2">
                                                                <span>Trošak:</span> 
                                                                <span class="fs-5 px-2 fw-bold">
                                                                    8,000.00 din
                                                                </span>
                                                            </span>
                                                            <span class="badge badge-light-success text-dark px-4 fw-semibold fs-7 text-center mt-3 py-2">
                                                                <span>Profit:</span> 
                                                                <span class="fs-5 px-2 fw-bold">
                                                                    12,000.00 din
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Section-->
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                </div>
                                <!--end::Col-->
                            @endforeach
                        </div>
                        <!--end::Items-->
                    @else
                        <div class="notice d-flex bg-light-info rounded border-info border border-dashed p-6">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-information fs-2x text-info me-4"></i>
                            <!--end::Icon-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1">
                                <!--begin::Content-->
                                <div class="fw-semibold">
                                    <h4 class="text-gray-900 m-0">Trenutno nemaš aktivnih kampanja.</h4>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    @endif
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::List widget 23-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    @push('modals')
        @include('modals.connectSlanjePaketa')
        @include('modals.connectFacebook')
        @include('modals.connectShopify')
    @endpush
</x-app-layout>