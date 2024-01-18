<x-app-layout>
    @section('title') {{ __('Orders') }} @endsection

    <!--begin::Row-->
    <div class="row mb-6 mb-xl-9">
        <!--begin::Col-->
        <div class="col-md-12">
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Your Orders</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">All of your laptop & license orders.</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5">
                    @if (count($orders))
                        <div class="separator separator-dashed"></div>
                        <!--begin::Items-->
                        <div class="">
                            @foreach ($orders as $order)
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
                                    <h4 class="text-gray-900 m-0">You don't have any orders yet.</h4>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    @endif
                </div>
                <!--end: Card Body-->
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end:Row-->
</x-app-layout>