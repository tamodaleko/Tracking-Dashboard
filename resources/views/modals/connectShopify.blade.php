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
            <div class="px-15">
                <p class="text-center mt-5 fs-4"><span class="fw-bold">Webhook Link:</span> {{ route('webhooks.shopify', auth()->user()->company->id) }}</p>
                <p class="text-center">1) Otvori svoj Shopify portal i pronadji: <i>Settings -> Notifications -> Webhooks</i></p>
                <p class="text-center">2) Kopiraj webhook link i napravi 6 nova webhooka za sledeće evente: <i><b>"Order creation"</b></i>, <i><b>"Order cancellation"</b></i>, <i><b>"Order deletion"</b></i>, <i><b>"Order fulfillment"</b></i>, <i><b>"Order payment"</b></i>, <i><b>"Order update"</b></i></p>
                <p class="text-center">3) Kopiraj webhook ključ sa Shopify portala i nalepi ga ispod zatim ga sačuvaj.</p>
            </div>
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
                            <div class="fv-row">
                                <label class="form-label fw-bolder text-dark fs-6 required">Webhook Secret</label>
                                <input type="text" placeholder="Unesi Webhook Secret" name="sf_webhook_secret" autocomplete="off" class="form-control bg-transparent @error('sf_webhook_secret') is-invalid @enderror" value="{{ old('sf_webhook_secret') }}" />

                                @error('sf_webhook_secret')
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
