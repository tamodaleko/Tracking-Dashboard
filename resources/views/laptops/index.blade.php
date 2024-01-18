<x-app-layout>
    @section('title') {{ __('Laptops') }} @endsection

    <div class="d-flex flex-wrap flex-stack mb-6">
        <!--begin::Title-->
        <h3 class="fw-bold my-2">Available Laptops</h3>
        <!--end::Title-->
    </div>
    <!--begin::Row-->
    <div class="row mb-6 mb-xl-9">
        @foreach ($laptops as $laptop)
            <!--begin::Col-->
            <div class="col-md-12">
                <div class="card card-flush flex-row-fluid p-6 pb-5 mw-100">
                    <!--begin::Body-->
                    <div class="card-body text-center">
                        <div class="d-flex flex-stack">
                            <!--begin::Food img-->
                            <img src="{{ asset('/media/laptop.jpg') }}" class="w-80px w-xxl-150px" alt="Laptop">
                            <!--end::Food img-->
                            <!--begin::Section-->
                            <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                <!--begin::Content-->
                                <div class="me-5 px-10 w-500px text-start">
                                    <!--begin::Title-->
                                    <a href="{{ route('laptops.configure', $laptop->id) }}" class="text-gray-800 fw-bold text-hover-primary fs-2">{{ $laptop->name }}</a>
                                    <!--end::Title-->
                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">{{ $laptop->description }}</span>
                                    <!--end::Desc-->

                                    <span class="badge badge-light-success text-dark px-4 fw-bold fs-7 text-center mt-3">{{ number_format($laptop->variants()->where('available', true)->sum('stock')) }} in stock</span>
                                    <span class="badge badge-light-danger text-dark px-4 fw-bold fs-7 text-center mt-3">special price ends 12/31</span>
                                    <span class="badge badge-light-warning text-dark px-4 fw-semibold fs-7 text-center mt-3 py-2">Starting at only <span class="fs-2 px-2 fw-bold">${{ $laptop->variants()->min('price') }}</span></span>
                                </div>
                                <!--end::Content-->
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Label-->
                                    <div class="m-0">
                                        <!--begin::Link-->
                                        <a href="{{ route('laptops.configure', $laptop->id) }}" class="btn btn-lg btn-light-dark text-dark hover-scale text-hover-white fw-bold d-flex align-items-center" href="">
                                            <i class="ki-duotone ki-gear fs-2 text-dark"><span class="path1"></span><span class="path2"></span></i>
                                            Configure
                                        </a>
                                        <!--end::Link-->
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
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
    <!--end:Row-->
</x-app-layout>