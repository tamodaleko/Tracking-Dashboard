<x-app-layout>
    @section('title') {{ __('Products') }} @endsection

    <div class="d-flex flex-wrap flex-stack mb-6">
        <!--begin::Title-->
        <h3 class="fw-bold my-2">Available Products</h3>
        <!--end::Title-->
    </div>
    <!--begin::Row-->
    <div class="row mb-6 mb-xl-9">
        @foreach ($products as $product)
            <!--begin::Col-->
            <div class="col-md-12 mb-5">
                <div class="card card-flush flex-row-fluid p-6 pb-5 mw-100">
                    <!--begin::Body-->
                    <div class="card-body text-center">
                        <div class="d-flex flex-stack">
                            <!--begin::Food img-->
                            <img src="{{ $product->image }}" class="w-50px w-xxl-100px rounded rounded-xl" alt="{{ $product->name }}">
                            <!--end::Food img-->
                            <!--begin::Section-->
                            <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                <!--begin::Content-->
                                <div class="me-5 px-10 w-700px text-start">
                                    <!--begin::Title-->
                                    <a href="javascript:void()" class="text-gray-800 fw-bold text-hover-primary fs-2">{{ $product->name }}</a>
                                    <!--end::Title-->
                                    <!--begin::Desc-->
                                    <span class="text-gray-500 fw-semibold fs-5 d-block text-start ps-0">
                                        Šifra: {{ $product->code }}
                                    </span>
                                    <!--end::Desc-->

                                    <span class="badge badge-light-success text-dark px-4 fw-bold fs-7 text-center mt-3">
                                        Dostupno: {{ $product->qty_warehouse }}
                                    </span>
                                    <span class="badge badge-light-danger text-dark px-4 fw-bold fs-7 text-center mt-3">
                                        U pripremi: {{ $product->qty_sending }}
                                    </span>
                                    <span class="badge badge-light-warning text-dark px-4 fw-semibold fs-7 text-center mt-3 py-2">Cena: <span class="fs-2 px-2 fw-bold">RSD {{ number_format($product->price, 2) }}</span></span>
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
    <!--end:Row-->
</x-app-layout>