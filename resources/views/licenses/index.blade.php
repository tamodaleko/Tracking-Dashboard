<x-app-layout>
    @section('title') {{ __('Licenses') }} @endsection

    <div class="d-flex flex-wrap flex-stack mb-6">
        <!--begin::Title-->
        <h3 class="fw-bold my-2">Available Licenses</h3>
        <!--end::Title-->
    </div>
    <!--begin::Row-->
    <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
        @foreach ($licenses as $license)
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-5">
                <div class="card card-flush flex-row-fluid p-6 pb-5 mw-100">
                    <!--begin::Body-->
                    <div class="card-body text-center">
                        <!--begin::Food img-->
                        <img src="{{ asset('/media/licenses/' . $license->image) }}" class="rounded-3 mb-4 w-150px" alt="">
                        <!--end::Food img-->
                        <!--begin::Info-->
                        <div class="mb-2">
                            <!--begin::Title-->
                            <div class="text-center">
                                <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{ $license->name }}</span>
                                <span class="text-gray-500 fw-semibold d-block fs-6 mt-n1">1 year commitment</span>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Total-->
                        <span class="text-success text-end fw-bold fs-1">${{ number_format($license->price) }} <span class="text-dark fs-4">/ month</span></span>
                        <!--end::Total-->
                        <div class="text-center mb-1 mt-5">
                            <!--begin::Link-->
                            <a class="btn btn-lg btn-light-success text-dark text-hover-white" href="{{ route('licenses.order', $license->id) }}">Order now</a>
                            <!--end::Link-->
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