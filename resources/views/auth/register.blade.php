<x-auth-layout>
    @section('title') {{ __('Registruj se') }} @endsection
    
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-100 w-md-400px">
        <!--begin::Wrapper-->
        <div class="d-flex flex-center flex-column flex-column-fluid pb-5">
            <!--begin::Form-->
            <form class="form w-100" method="POST" action="{{ route('register') }}">
                @csrf
                
                <!--begin::Heading-->
                <div class="text-center mb-7">
                    <!--begin::Title-->
                    <h1 class="text-gray-900 fw-bolder">Registruj se</h1>
                    <!--end::Title-->
                </div>
                <!--begin::Heading-->

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" :type="session('type')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" :type="'default'" />

                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="text" placeholder="Unesi ime firme" name="company" autocomplete="off" class="form-control bg-transparent @error('company') is-invalid @enderror" value="{{ old('company') }}" />
                    <!--end::Email-->

                    @error('company')
                        <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--begin::Input group-->

                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="text" placeholder="Unesi ime" name="first_name" autocomplete="off" class="form-control bg-transparent @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" />
                    <!--end::Email-->

                    @error('first_name')
                        <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--begin::Input group-->

                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="text" placeholder="Unesi prezime" name="last_name" autocomplete="off" class="form-control bg-transparent @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" />
                    <!--end::Email-->

                    @error('last_name')
                        <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--begin::Input group-->
                
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="text" placeholder="Unesi email" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                    <!--end::Email-->

                    @error('email')
                        <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--begin::Input group-->
                <div class="fv-row mb-8" data-kt-password-meter="true">
                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input class="form-control bg-transparent @error('password') is-invalid @enderror" type="password" placeholder="Unesi šifru" name="password" autocomplete="off" />
                            
                            @error('password')
                                <div class="error invalid-feedback">{{ $message }}</div>
                            @else
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                    <i class="ki-outline ki-eye-slash fs-2"></i>
                                    <i class="ki-outline ki-eye fs-2 d-none"></i>
                                </span>
                            @enderror
                        </div>
                        <!--end::Input wrapper-->
                        <!--begin::Meter-->
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                        <!--end::Meter-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Hint-->
                    <div class="text-muted">Unesi 8 ili više karaktera sa miksom slova, brojeva i simbola.</div>
                    <!--end::Hint-->
                </div>
                <!--end::Input group=-->
                <!--end::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Repeat Password-->
                    <input placeholder="Ponovo unesi šifru" name="password_confirmation" type="password" autocomplete="off" class="form-control bg-transparent" />
                    <!--end::Repeat Password-->
                </div>
                <!--end::Input group=-->
                <!--begin::Submit button-->
                <div class="d-grid mb-5">
                    <button type="submit" class="btn btn-primary">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">Registruj se</span>
                        <!--end::Indicator label-->
                    </button>
                </div>
                <!--end::Submit button-->
                <!--begin::Sign up-->
                <div class="text-gray-500 text-center fw-semibold fs-6">Već imaš nalog? 
                <a href="{{ route('login') }}" class="link-primary fw-semibold">Uloguj se</a></div>
                <!--end::Sign up-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
</x-auth-layout>
