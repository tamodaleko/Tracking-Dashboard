<x-app-layout>
    @section('title') {{ __('Dashboard') }} @endsection

    @if (true)
        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-12 p-6">
            <!--begin::Icon-->
            <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
            <!--end::Icon-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-grow-1">
                <!--begin::Content-->
                <div class="fw-semibold">
                    <h4 class="text-gray-900 fw-bold">Tvoj nalog nije povezan!</h4>
                    <div class="fs-6 text-gray-700">Poveži svoj nalog sa Facebook, Shopify i Slanje Paketa platformama - 
                    <a href="{{ route('billing') }}" class="fw-bold">Poveži nalog</a>.</div>
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
                        <span class="fw-bold fs-7 text-gray-500">Total orders</span>
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
                        <span class="fw-bold fs-7 text-gray-500">Total spent</span>
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
                        <span class="fw-bolder fs-2x text-gray-900">{{ $licenses }}</span>
                        <span class="fw-bold fs-7 text-gray-500">Active licenses</span>
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
                    @if (count($latestOrders))
                        <div class="separator separator-dashed"></div>
                        <!--begin::Items-->
                        <div class="">
                            @foreach ($latestOrders as $order)
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center me-5">
                                        <!--begin::Flag-->
                                        <img src="{{ asset('/media/laptop.jpg') }}" class="me-4 w-50px mr-5" alt="Laptop" />
                                        <!--end::Flag-->
                                        @foreach ($order->items as $item)
                                            <!--begin::Content-->
                                            <div class="me-5 px-3">
                                                <!--begin::Title-->
                                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $item->variant->name }}</a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Size: {{ $item->variant->screen }} inches / Color: {{ $item->variant->color }}</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        @endforeach
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Number-->
                                        <span class="badge badge-light-success text-gray-800 fw-bold fs-4 me-3 px-3">${{ number_format($order->total, 2) }}</span>
                                        <!--end::Number-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--end::Separator-->
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
</x-app-layout>