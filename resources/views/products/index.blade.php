<x-app-layout>
    @section('title') {{ __('Products') }} @endsection

    <div class="d-flex flex-wrap flex-stack mb-6">
        <!--begin::Title-->
        <h3 class="fw-bold my-2">Dostupni proizvodi</h3>
        <!--end::Title-->
    </div>
    <!--begin::Row-->
    <div class="row mb-6 mb-xl-9">
        @if (count($products))
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
                                        <a href="{{ $product->url }}" target="_blank" class="text-gray-800 fw-bold text-hover-primary fs-2">{{ $product->name }}</a>
                                        <!--end::Title-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-5 d-block text-start ps-0">
                                            Šifra: {{ $product->code }}
                                        </span>
                                        <!--end::Desc-->

                                        <span class="badge badge-light-success text-dark px-4 fw-bold fs-7 text-center mt-3">
                                            Dostupno: {{ $product->qty_warehouse }}
                                        </span>
                                        <span class="badge badge-light-warning text-dark px-4 fw-bold fs-7 text-center mt-3">
                                            U pripremi: {{ $product->qty_sending }}
                                        </span>
                                        <div>
                                            <span class="badge badge-light-info text-dark px-4 fw-semibold fs-7 text-center mt-3 py-2">
                                                <span>Kupovna cena:</span> 
                                                @if ($product->buying_price)
                                                    <span class="fs-5 px-2 fw-bold">
                                                        RSD {{ number_format($product->buying_price, 2) }}
                                                    </span>
                                                @endif
                                                
                                                <button class="btn btn-sm btn-dark d-flex flex-center fw-bold py-0 px-3 mx-2" data-bs-toggle="modal" data-bs-target="#updateProductPriceModal" data-action="{{ route('products.update.price', $product->id) }}" data-name="{{ $product->name }}">
                                                    <span>Izmeni cenu</span>
                                                </button>
                                            </span>
                                            <span class="badge badge-light-primary text-dark px-4 fw-semibold fs-7 text-center mt-3 py-2">
                                                Prodajna cena: <span class="fs-5 px-2 fw-bold">RSD {{ number_format($product->selling_price, 2) }}</span>
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
        @else
            <div class="notice d-flex bg-light-info rounded border-info border border-dashed p-6">
                <!--begin::Icon-->
                <i class="ki-outline ki-information fs-2x text-info me-4"></i>
                <!--end::Icon-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-grow-1">
                    <!--begin::Content-->
                    <div class="fw-semibold">
                        <h4 class="text-gray-900 m-0">Trenutno nemaš dostupnih proizvoda.</h4>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
        @endif
    </div>
    <!--end:Row-->

    @push('modals')
        @include('modals.updateProductPrice')
    @endpush

    @push('scripts')
        <script type="text/javascript">
            $('#updateProductPriceModal').on('shown.bs.modal', function (event) {
                var action = $(event.relatedTarget).attr('data-action');
                var name = $(event.relatedTarget).attr('data-name');
                
                $(this).find('form').attr('action', action);
                $(this).find('#product-name').text(name);
            });
        </script>
    @endpush
</x-app-layout>