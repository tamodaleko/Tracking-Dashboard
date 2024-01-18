<!--begin::Modal - Update Product Price-->
<div class="modal fade" id="updateProductPriceModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header align-self-center">
                <!--begin::Modal title-->
                <h2 class="text-center m-0 d-flex align-items-center">
                    <span>Izmeni kupovnu cenu</span>
                </h2>
                <!--end::Modal title-->
            </div>
            <div class="text-center mx-10 mt-5 mb-3">
                <span class="fw-bold fs-5">Proizvod:</span> <span class="text-gray-600 fw-bold fs-6" id="product-name"></span>
            </div>
            <!--end::Modal header-->
            <!--begin::Form-->
            <form class="form" action="" method="POST">
                @csrf
                @method('PATCH')
                
                <!--begin::Modal body-->
                <div class="modal-body py-5 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7">
                        <div>
                            <!--begin::Input group-->
                            <div class="fv-row">
                                <label class="form-label fw-bolder text-dark fs-6 required">Kupovna cena</label>
                                <input type="number" placeholder="Ukucaj cenu" name="buying_price" autocomplete="off" class="form-control bg-transparent @error('buying_price') is-invalid @enderror" value="{{ old('buying_price') }}" />

                                @error('buying_price')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center px-15">
                    <!--begin::Button-->
                    <button type="submit" class="btn btn-lg btn-dark w-100 py-4">
                        <span class="fw-bolder fs-5">Sačuvaj</span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Update Product Price-->
