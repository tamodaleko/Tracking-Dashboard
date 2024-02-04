<x-app-layout>
    @section('title') {{ __('SMS Poruke') }} @endsection

    <!--begin::Row-->
    <div class="row mb-6 mb-xl-9">
        <!--begin::Col-->
        <div class="col-md-12">
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">SMS Poruke</span>
                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Lista poslatih SMS poruka.</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5">
                    @if (count($messages))
                        <div class="separator separator-dashed"></div>
                        <!--begin::Items-->
                        <div class="">
                            @foreach ($users as $user)
                                <!--begin::Item-->
                                <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center w-200px">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-40px symbol-circle">
                                            <span class="symbol-label bg-light-primary text-primary fw-semibold">{{ $user->initials }}</span>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Details-->
                                        <div class="ms-6">
                                            <!--begin::Name-->
                                            <a href="javascript:void()" class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">{{ $user->name }} 
                                            <span class="badge badge-light fs-8 fw-semibold ms-2">Zaposleni</span></a>
                                            <!--end::Name-->
                                            <!--begin::Email-->
                                            <div class="fw-semibold text-muted">{{ $user->email }}</div>
                                            <!--end::Email-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Details-->
                                    <div class="text-end px-5">
                                        <span class="badge badge-light-success fs-6 fw-semibold">Aktivan</span>
                                    </div>
                                    <!--begin::Stats-->
                                    <div class="d-flex align-items-center">
                                        <form method="post" action="{{ route('users.destroy', $user->id) }}">
                                            @csrf
                                            @method('delete')
                                            
                                            <a href="javascript:void()" class="btn confirm is-form btn-sm btn-danger btn-active-light-danger"><i class="ki-outline ki-cross-square fs-2"></i> Obriši</a>
                                        </form>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Item-->
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
                                    <h4 class="text-gray-900 m-0">Trenutno nemaš nijednu poslatu SMS poruku.</h4>
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