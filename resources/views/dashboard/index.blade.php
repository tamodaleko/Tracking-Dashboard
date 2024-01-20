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
    <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" data-kt-daterangepicker-range="today" class="btn btn-sm bg-light-info border border-info border-dotted d-flex align-items-center justify-content-center px-4 w-250px mb-10">
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
                                                        <div>
                                                            <span class="text-gray-500 fw-semibold fs-5 d-block text-start ps-0">
                                                                Facebook ID: {{ $campaign->facebook_id }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="text-gray-500 fw-semibold fs-5 d-block text-start ps-0">
                                                                Proizvod: <span class="text-danger">Proizvod nije dodat!</span> <button class="btn btn-sm btn-dark d-flex flex-center fw-bold py-0 px-3 mx-2" data-bs-toggle="modal" data-bs-target="#updateProductPriceModal">
                                                                    <span>Dodaj proizvod</span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                        <!--end::Desc-->

                                                        <span class="badge badge-light-dark text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                            Porudžbine: {{ 12 }}
                                                        </span>
                                                        <span class="badge badge-light-primary text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                            Zarada: 12,000.00 din
                                                        </span>
                                                        <div>
                                                            <span class="badge badge-light-warning text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                                Proizvodi: -1,000 din
                                                            </span>
                                                            <span class="badge badge-light-warning text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                                Reklame: -{{ number_format($stats->spend_rsd ?? 0, 2) }} din
                                                            </span>
                                                            <span class="badge badge-light-warning text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                                Slanje: -1,000 din
                                                            </span>
                                                            <span class="badge badge-light-warning text-dark px-4 fw-bold fs-7 text-center mt-3">
                                                                Dostava: -1,000 din
                                                            </span>
                                                        </div>
                                                        <div class="mt-5">
                                                            <span class="badge badge-light-danger text-dark px-4 fw-bold fs-7 text-center mt-3 py-2">
                                                                <span>Trošak:</span> 
                                                                <span class="fs-5 px-2 fw-bold">
                                                                    8,000.00 din
                                                                </span>
                                                            </span>
                                                            <span class="badge badge-light-success text-dark px-4 fw-bold fs-7 text-center mt-3 py-2">
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