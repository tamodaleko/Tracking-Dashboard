<x-auth-layout>
    @section('title') {{ __('Uloguj se') }} @endsection
    
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-100 w-md-400px">
        <!--begin::Wrapper-->
        <div class="d-flex flex-center flex-column flex-column-fluid pb-5">
            <!--begin::Form-->
            <form class="form w-100" method="POST" action="{{ route('login') }}">
                @csrf
                
                <!--begin::Heading-->
                <div class="text-center mb-7">
                    <!--begin::Title-->
                    <h1 class="text-gray-900 fw-bolder">Uloguj se</h1>
                    <!--end::Title-->
                </div>
                <!--begin::Heading-->

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" :type="'success'" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" :type="'default'" />
                
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="text" placeholder="Unesi email" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                    <!--end::Email-->

                    @error('email')
                        <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Password-->
                    <input type="password" placeholder="Unesi šifru" name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid @enderror" />
                    <!--end::Password-->

                    @error('password')
                        <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input group=-->
                <!--begin::Submit button-->
                <div class="d-grid mb-5">
                    <button type="submit" class="btn btn-primary">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">Uloguj se</span>
                        <!--end::Indicator label-->
                    </button>
                </div>
                <!--end::Submit button-->
                <!--begin::Sign up-->
                <div class="text-gray-500 text-center fw-semibold fs-6">Nemaš nalog? 
                <a href="{{ route('register') }}" class="link-primary fw-semibold">Registruj se</a></div>
                <!--end::Sign up-->
                <!--begin::Forgot Password-->
                <div class="text-gray-500 text-center fw-semibold fs-6">Zaboravio si šifru? 
                <a href="{{ route('password.request') }}" class="link-primary fw-semibold">Resetuj</a></div>
                <!--end::Forgot Password-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
</x-auth-layout>
