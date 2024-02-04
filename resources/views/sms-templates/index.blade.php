<x-app-layout>
    @section('title') {{ __('SMS Konfiguracija') }} @endsection

    <!--begin::Row-->
    <div class="row mb-6 mb-xl-9">
        <!--begin::Col-->
        <div class="col-md-12">
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">SMS Konfiguracija</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Promeni tekst sistemskih SMS poruka.</span>
                    </h3>
                    <!--end::Title-->
                    <div class="card-toolbar">
                        <a href="javascript:void()" class="btn btn-sm btn-primary d-flex flex-center ms-3 px-4 py-3 fw-bold">
                            <i class="ki-outline ki-arrow-right fs-2"></i>
                            <span>Pogledaj poslate poruke</span>
                        </a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5">
                    @if (count($templates))
                        <!--begin::Items-->
                        <div>
                            @foreach ($templates as $template)
                                <!--begin::Col-->
                                <div class="col-md-6 col-lg-4 col-xl-5">
                                    <div class="card card-flush flex-row-fluid p-6 pb-5 mw-100">
                                        <!--begin::Body-->
                                        <div class="card-body text-center">
                                            <!--begin::Info-->
                                            <div class="mb-2">
                                                <!--begin::Title-->
                                                <div class="text-center">
                                                    <span class="fw-bolder text-primary cursor-pointer text-hover-primary fs-3 fs-xl-1">{{ $template->getTypeFormatted() }}</span>
                                                    <span class="text-gray-500 fw-semibold d-block fs-6 mt-n1">{{ $template->description }}</span>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Total-->
                                            <span class="text-dark fw-bold fs-3"><span class="text-gray-700">Tekst:</span> {{ $template->text }}</span>
                                            <!--end::Total-->
                                            <div class="text-center mb-1 mt-5">
                                                <!--begin::Link-->
                                                <button class="btn btn-sm btn-dark fw-bold" data-bs-toggle="modal" data-bs-target="#updateSmsTemplateTextModal" data-action="{{ route('templates.update.text', $template->id) }}" data-type="{{ $template->getTypeFormatted() }}" data-text="{{ $template->text }}">Izmeni</button>
                                                <!--end::Link-->
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
                                    <h4 class="text-gray-900 m-0">Trenutno nemaš dostupnih SMS obrazaca.</h4>
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

    @push('modals')
        @include('modals.updateSmsTemplateText')
    @endpush

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#updateSmsTemplateTextModal').on('shown.bs.modal', function (event) {
                    var action = $(event.relatedTarget).attr('data-action');
                    var type = $(event.relatedTarget).attr('data-type');
                    var text = $(event.relatedTarget).attr('data-text');
                    
                    $(this).find('form').attr('action', action);
                    $(this).find('#template-type').text(type);
                    $(this).find('#template-text').text(text);
                }); 
            });
        </script>
    @endpush
</x-app-layout>