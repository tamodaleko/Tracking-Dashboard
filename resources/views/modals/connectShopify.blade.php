<!--begin::Modal - Connect Shopify-->
<div class="modal fade" id="connectShopifyModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header align-self-center">
                <!--begin::Modal title-->
                <h2 class="text-center m-0 d-flex align-items-center">
                    <span>Poveži nalog (Shopify)</span>
                </h2>
                <!--end::Modal title-->
            </div>
            <!--end::Modal header-->
            <!--begin::Form-->
            <form class="form" action="{{ route('companies.update.keys') }}" method="POST">
                @csrf
                @method('PATCH')

                <input type="hidden" name="provider" value="shopify">
                
                <!--begin::Modal body-->
                <div class="modal-body py-5 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7">
                        <div>
                            <div class="fv-row mb-5">
                                <label class="form-label fw-bolder text-dark fs-6 required">Access Token</label>
                                <input type="text" placeholder="Unesi Access Token" name="sf_access_token" autocomplete="off" class="form-control bg-transparent @error('sf_access_token') is-invalid @enderror" value="{{ old('sf_access_token') }}" />

                                @error('sf_access_token')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="fv-row">
                                <label class="form-label fw-bolder text-dark fs-6 required">Store ID</label>
                                <input type="text" placeholder="Unesi Store ID" name="sf_store_id" autocomplete="off" class="form-control bg-transparent @error('sf_store_id') is-invalid @enderror" value="{{ old('sf_store_id') }}" />

                                @error('sf_store_id')
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
                        <span class="fw-bolder fs-5">Poveži</span>
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
<!--end::Modal - Connect Shopify-->
