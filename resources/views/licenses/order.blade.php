<x-app-layout>
    @section('title') {{ __('Order License') }} @endsection

    <!--begin::Form-->
    <form class="form d-flex flex-column flex-lg-row" method="POST" action="{{ route('licenses.process', $license->id) }}">
        @csrf
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10 me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
            <!--begin::Order details-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Provision Details</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="d-flex flex-column gap-5">
                        <!--begin::Separator-->
                        <div class="separator"></div>
                        <!--end::Separator-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-5">
                            <!--begin::Label-->
                            <label class="fs-4 fw-semibold mb-3">Do you have an existing Microsoft account?</label>
                            <!--End::Label-->
                            <!--begin::Row-->
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Option-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                                        <!--begin::Radio-->
                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                            <input class="form-check-input" type="radio" name="microsoft_account" value="1" checked="checked" />
                                        </span>
                                        <!--end::Radio-->
                                        <!--begin::Info-->
                                        <span class="ms-5">
                                            <span class="fs-4 fw-bold text-gray-800 d-block">I have a Microsoft account</span>
                                        </span>
                                        <!--end::Info-->
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Option-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                        <!--begin::Radio-->
                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                            <input class="form-check-input" type="radio" name="microsoft_account" value="0" />
                                        </span>
                                        <!--end::Radio-->
                                        <!--begin::Info-->
                                        <span class="ms-5">
                                            <span class="fs-4 fw-bold text-gray-800 d-block">I don't have a Microsoft account</span>
                                        </span>
                                        <!--end::Info-->
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div id="microsoft-tenant" class="fv-row w-100 flex-md-root">
                            <!--begin::Label-->
                            <label class="required form-label">What's your tenant ID?</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="Enter your Microsoft tenant ID" value="{{ old('city') }}" />
                            <!--end::Input-->
                            @error('color')
                                <div class="error invalid-feedback m-0">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div id="microsoft-domain" class="fv-row w-100 flex-md-root d-none">
                            <!--begin::Label-->
                            <label class="required form-label">What's your desired .onmicrosoft.com domain?</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="Enter your desired domain" value="{{ old('city') }}" />
                            <!--end::Input-->
                            @error('color')
                                <div class="error invalid-feedback m-0">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row w-100 flex-md-root">
                            <!--begin::Label-->
                            <label class="required form-label">What's your website URL?</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="Enter your website url" value="{{ old('city') }}" />
                            <!--end::Input-->
                            @error('color')
                                <div class="error invalid-feedback m-0">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row w-100 flex-md-root">
                            <!--begin::Label-->
                            <label class="required form-label">How many licenses do you need?</label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <select class="form-select mb-2" name="warranty_years" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="warranty-years-select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <!--end::Select2-->
                            @error('color')
                                <div class="error invalid-feedback m-0">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                    </div>
                </div>
                <!--end::Card header-->
            </div>
            <!--end::Order details-->
            <!--begin::Billing address-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Billing Address</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="d-flex flex-column gap-5 gap-md-7">
                        <!--begin::Separator-->
                        <div class="separator"></div>
                        <!--end::Separator-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column flex-md-row gap-5">
                            <div class="fv-row flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label">Address Line 1</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control @error('address1') is-invalid @enderror" name="address1" placeholder="Address Line 1" value="{{ old('address1') }}" />
                                <!--end::Input-->
                                @error('address1')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex-row-fluid">
                                <!--begin::Label-->
                                <label class="form-label">Address Line 2</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control @error('address2') is-invalid @enderror" name="address2" placeholder="Address Line 2" value="{{ old('address2') }}" />
                                <!--end::Input-->
                                @error('address2')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column flex-md-row gap-5">
                            <div class="flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label">City</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="City" value="{{ old('city') }}" />
                                <!--end::Input-->
                                @error('city')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="fv-row flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label">State</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="form-select @error('state') is-invalid @enderror" data-placeholder="Select an option" name="state" data-control="select2" data-hide-search="true">
                                    <option></option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                                <!--end::Input-->
                                @error('state')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="fv-row flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label">Zip</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" placeholder="Zip" value="{{ old('zip') }}" />
                                <!--end::Input-->
                                @error('zip')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="required form-label">Country</label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Select an option" name="country">
                                <option value="US" data-kt-select2-country="{{ asset('/media/flags/united-states.svg') }}">United States</option>
                            </select>
                            <!--end::Select2-->
                        </div>
                        <!--end::Input group-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Billing address-->
            <!--begin::Payment details-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2 class="fw-bold">Payment Method</h2>
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <a href="{{ route('billing') }}" class="btn btn-light-dark">New Method</a>
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Options-->
                    <div>
                        <!--begin::Separator-->
                        <div class="separator"></div>
                        <!--end::Separator-->

                        @if (count($paymentMethods))
                            @foreach ($paymentMethods as $paymentMethod)
                                <!--begin::Option-->
                                <div class="py-1">
                                    <!--begin::Header-->
                                    <div class="py-3 d-flex flex-stack flex-wrap">
                                        <!--begin::Toggle-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Logo-->
                                            @if ($paymentMethod->card->brand === 'visa')
                                                <img src="{{ asset('/media/svg/card-logos/visa.svg') }}" class="w-40px me-3">
                                            @elseif ($paymentMethod->card->brand === 'mastercard')
                                                <img src="{{ asset('/media/svg/card-logos/mastercard.svg') }}" class="w-40px me-3">
                                            @elseif ($paymentMethod->card->brand === 'amex')
                                                <img src="{{ asset('/media/svg/card-logos/american-express.svg') }}" class="w-40px me-3">
                                            @else
                                                <img src="{{ asset('/media/svg/card-logos/visa.svg') }}" class="w-40px me-3">
                                            @endif
                                            <!--end::Logo-->
                                            <!--begin::Summary-->
                                            <div class="me-3">
                                                <div class="d-flex align-items-center fw-bold">{{ ucwords($paymentMethod->card->brand) }}
                                                <div class="badge badge-light-dark ms-3">**** {{ $paymentMethod->card->last4 }}</div></div>
                                                <div class="text-muted">Expires {{ $paymentMethod->card->exp_month . ' / ' . $paymentMethod->card->exp_year }}</div>
                                            </div>
                                            <!--end::Summary-->
                                        </div>
                                        <!--end::Toggle-->
                                        <!--begin::Input-->
                                        <div class="d-flex my-3 ms-9">
                                            <!--begin::Radio-->
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="radio" name="payment_method" checked="checked" value="{{ $paymentMethod->id }}">
                                            </label>
                                            <!--end::Radio-->
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Header-->
                                </div>
                                <!--end::Option-->
                                <div class="separator separator-dashed"></div>
                            @endforeach
                        @else
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 align-items-center">
                                <!--begin::Icon-->
                                <i class="ki-outline ki-information fs-2x text-warning me-4"></i>
                                <!--end::Icon-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-semibold">
                                        <h4 class="text-gray-900 m-0">Add your payment method before placing an order.</h4>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                        @endif
                    </div>
                    <!--end::Options-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Payment details-->
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <button type="submit" class="btn btn-success">
                    <span class="indicator-label">Order Now</span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->
        <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
            <!--begin::Card-->
            <div class="card card-flush pt-3 mb-0" data-kt-sticky="true" data-kt-sticky-name="subscription-summary" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto" data-kt-sticky-top="100px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95" style="">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Order Summary</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 fs-6">
                    <!--begin::Section-->
                    <div class="mb-5">
                        <!--begin::Title-->
                        <h5 class="mb-3">Customer details</h5>
                        <!--end::Title-->
                        <!--begin::Details-->
                        <div class="d-flex align-items-center mb-1">
                            <!--begin::Name-->
                            <a href="javascript:void()" class="fw-bold text-gray-800 text-hover-primary me-2">{{ auth()->user()->name }}</a>
                            <!--end::Name-->
                            <!--begin::Status-->
                            <span class="badge badge-light-success">Active</span>
                            <!--end::Status-->
                        </div>
                        <!--end::Details-->
                        <!--begin::Email-->
                        <a href="#" class="fw-semibold text-gray-600 text-hover-primary">{{ auth()->user()->email }}</a>
                        <!--end::Email-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Seperator-->
                    <div class="separator separator-dashed mb-5"></div>
                    <!--end::Seperator-->
                    <!--begin::Section-->
                    <div class="mb-5">
                        <!--begin::Title-->
                        <h5 class="mb-3">Product details</h5>
                        <!--end::Title-->
                        <!--begin::Details-->
                        <div class="mb-0">
                            <!--begin::Plan-->
                            <span class="badge badge-light-info fs-7">{{ $license->name }}</span>
                            <!--end::Plan-->
                        </div>
                        <!--end::Details-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Seperator-->
                    <div class="separator separator-dashed mb-5"></div>
                    <!--end::Seperator-->
                    <!--begin::Section-->
                    <div class="mb-10">
                        <!--begin::Title-->
                        <h5 class="mb-3">Total Cost</h5>
                        <!--end::Title-->
                        <!--begin::Details-->
                        <div class="mb-0">
                            <div class="fw-bold text-success fs-1">${{ number_format($license->price) }} <span class="text-dark fs-4">/ month</span></div>
                        </div>
                        <!--end::Details-->
                    </div>
                    <!--end::Section-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    </form>
    <!--end::Form-->
    @push('scripts')
        <script>
            $('input[type=radio][name=microsoft_account]').on('change', function() {
                switch ($(this).val()) {
                    case '1':
                        $('#microsoft-tenant').removeClass('d-none');
                        $('#microsoft-domain').addClass('d-none');
                        break;
                    case '0':
                        $('#microsoft-tenant').addClass('d-none');
                        $('#microsoft-domain').removeClass('d-none');
                        break;
                }
            });

            $('#color-options').on('select2:select', function (e) {
                changeImages($(this).val());
            });

            function setTotalCost() {
                $('#total-cost').text(screen + warranty + warranty_protection);
            }
        </script>
    @endpush
</x-app-layout>