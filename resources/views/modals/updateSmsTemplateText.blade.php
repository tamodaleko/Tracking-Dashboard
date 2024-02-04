<!--begin::Modal - Update SMS Template Text-->
<div class="modal fade" id="updateSmsTemplateTextModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header align-self-center">
                <!--begin::Modal title-->
                <h2 class="text-center m-0 d-flex align-items-center">
                    <span>Izmeni tekst SMS poruke</span>
                </h2>
                <!--end::Modal title-->
            </div>
            <div class="text-center mx-10 mt-5 mb-3">
                <span class="fw-bold fs-5">Tip poruke:</span> <span class="text-gray-600 fw-bold fs-4" id="template-type"></span>
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
                                <label class="form-label fw-bolder text-dark fs-6 required">Tekst</label>
                                
                                <textarea id="template-text" class="form-control bg-transparent" rows="4" name="text" placeholder="Unesite tekst SMS poruke"></textarea>

                                @error('text')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <span class="text-dark fw-bold">Tagovi:</span> <button type="button" class="tag badge badge-light-dark fw-bolder me-auto px-3 py-3" data-tag="[[Ime]]">Ime kupca</button>
                                <button type="button" class="tag badge badge-light-dark fw-bolder me-auto px-3 py-3" data-tag="[[Prezime]]">Prezime kupca</button>
                                <button type="button" class="tag badge badge-light-dark fw-bolder me-auto px-3 py-3" data-tag="[[ImeFirme]]">Ime firme</button>
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
<!--end::Modal - Update SMS Template Text-->

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.tag').click(function() {
                var tag = $(this).data('tag');
                var cursorPos = $('#template-text').prop('selectionStart');
                var value = $('#template-text').val();
                var textBefore = value.substring(0,  cursorPos);
                var textAfter  = value.substring(cursorPos, value.length);
                $('#template-text').val(textBefore + tag + textAfter);
                document.querySelector("textarea").focus();
            });
        });
    </script>
@endpush
