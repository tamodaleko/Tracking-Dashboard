<!--begin::Modal - Create User-->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header align-self-center">
                <!--begin::Modal title-->
                <h2 class="text-center m-0 d-flex align-items-center">
                    <i class="ki-outline ki-plus-square fs-2 text-dark"></i> <span class="px-2">Add New User</span>
                </h2>
                <!--end::Modal title-->
            </div>
            <!--end::Modal header-->
            <!--begin::Form-->
            <form class="form" action="{{ route('users.store') }}" method="POST">
                @csrf
                <!--begin::Modal body-->
                <div class="modal-body py-5 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7">

                        <div>
                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6 required">First Name</label>
                                    <input type="text" placeholder="First Name" name="first_name" autocomplete="off" class="form-control bg-transparent @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" />

                                    @error('first_name')
                                        <div class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-6 mt-7 mt-md-0">
                                    <label class="form-label fw-bolder text-dark fs-6 required">Last Name</label>
                                    <input type="text" placeholder="Last Name" name="last_name" autocomplete="off" class="form-control bg-transparent @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" />

                                    @error('last_name')
                                        <div class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row">
                                <label class="form-label fw-bolder text-dark fs-6 required">Email</label>
                                <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" value="{{ old('email') }}" />

                                @error('email')
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
                        <span class="fw-bolder fs-5">Save</span>
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
<!--end::Modal - Create User-->
