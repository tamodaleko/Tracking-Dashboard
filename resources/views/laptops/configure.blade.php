<x-app-layout>
    @section('title') {{ __('Configure Laptop') }} @endsection

    <!--begin::Form-->
    <form class="form d-flex flex-column flex-lg-row" method="POST" action="{{ route('laptops.order', $laptop->id) }}">
        @csrf
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10 me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
            <!--begin::Order details-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Configuration</h2>
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
                            <label class="fs-6 fw-semibold mb-2 required">Choose display size</label>
                            <!--End::Label-->
                            <!--begin::Row-->
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Option-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                                        <!--begin::Radio-->
                                        <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                            <input class="form-check-input" type="radio" name="screen" value="13.5" checked="checked" />
                                        </span>
                                        <!--end::Radio-->
                                        <!--begin::Info-->
                                        <span class="ms-5">
                                            <span class="fs-4 fw-bold text-gray-800 d-block">13.5 inches<br/><span class="fw-semibold text-gray-600 fs-6">Starting at <span class="text-success fw-bold">$1799.99</span></span></span>
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
                                            <input class="form-check-input" type="radio" name="screen" value="15" />
                                        </span>
                                        <!--end::Radio-->
                                        <!--begin::Info-->
                                        <span class="ms-5">
                                            <span class="fs-4 fw-bold text-gray-800 d-block">15 inches<br/><span class="fw-semibold text-gray-600 fs-6">Starting at <span class="text-success fw-bold">$1899.99</span></span></span>
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
                        <div class="fv-row w-100 flex-md-root">
                            <!--begin::Label-->
                            <label class="required form-label">Choose color</label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <select class="form-select mb-2 @error('color') is-invalid @enderror" name="color" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="color-options">
                                <option value="Platinum">Platinum</option>
                                <option value="Black">Black</option>
                                <option value="Sandstone">Sandstone</option>
                                <option value="Sage">Sage</option>
                            </select>
                            <!--end::Select2-->
                            @error('color')
                                <div class="error invalid-feedback m-0">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <div class="fv-row w-100 d-flex align-items-center justify-content-center">
                            <div class="row row-cols-3">
                                <div class="col">
                                    <img id="laptop-image-1" src="{{ asset('/media/laptops/Platinum/1.png') }}" class="w-100 shadow-sm rounded" />
                                </div>
                                <div class="col">
                                    <img id="laptop-image-2" src="{{ asset('/media/laptops/Platinum/2.png') }}" class="w-100 shadow-sm rounded" />
                                </div>
                                <div class="col">
                                    <img id="laptop-image-3" src="{{ asset('/media/laptops/Platinum/3.png') }}" class="w-100 shadow-sm rounded" />
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row rounded-3 p-7 border border-dashed border-gray-300">
                            <div class="d-flex flex-stack">
                                <!--begin::Label-->
                                <div class="me-5 fw-semibold">
                                    <label class="fs-4">Warranty</label>
                                    <div class="fs-7 text-muted">Include additional warranty</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" checked="checked" name="warranty">
                                </label>
                                <!--end::Switch-->
                            </div>

                            <div id="warranty-years">
                                <!--begin::Label-->
                                <label class="required form-label mt-5 fs-6">How many years?</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select mb-2" name="warranty_years" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="warranty-years-select">
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                <!--end::Select2-->
                            </div>

                            <label id="warranty-protection" class="form-check form-check-custom form-check-solid mt-5">
                                <input class="form-check-input" type="checkbox" checked="checked" value="1" name="warranty_protection">
                                <span class="form-check-label text-gray-600">Include accidental damage protection? <span class="text-success fw-bold fs-4">+$170</span></span>
                            </label>
                        </div>
                    </div>
                </div>
                <!--end::Card header-->
            </div>
            <!--end::Order details-->
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
            <!--begin::Shipping address-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Shipping Address</h2>
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
            <!--end::Shipping address-->
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
                            <span class="badge badge-light-info fs-7">{{ $laptop->name }}</span>
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
                            <div class="fw-bold text-success d-flex align-items-center fs-1">$<span id="total-cost">{{ 1799.99 + 79.00 + 170.00 }}</span></div>
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
            var screen = 1799.99;
            var warranty = 79.00;
            var warranty_protection = 170;

            var colors = $('#color-options');
            
            $('input[type=radio][name=screen]').on('change', function() {
                colors.empty().trigger('change');
                
                switch ($(this).val()) {
                    case '13.5':
                        screen = 1799.99;
                        var colorOptions = [{ text: 'Platinum' }, { text: 'Black' }, { text: 'Sandstone' }, { text: 'Sage' }];
                        break;
                    case '15':
                        screen = 1899.99;
                        var colorOptions = [{ text: 'Platinum' }, { text: 'Black' }];
                        break;
                }

                $.each(colorOptions, function (i, row) {
                    var option = new Option(row.text, row.id, false, false);
                    colors.append(option).trigger('change');
                });

                changeImages('Platinum');
                setTotalCost();
            });

            $('input[type=checkbox][name=warranty]').on('change', function() {
                if (this.checked) {
                    $('#warranty-years').removeClass('d-none');
                    $('#warranty-protection').removeClass('d-none');

                    warranty = 79.00;
                    warranty_protection = 170;

                    $('input[type=number][name=warranty_years]').val(2);
                    $('input[type=checkbox][name=warranty_protection]').prop('checked', true);
                } else {
                    $('#warranty-years').addClass('d-none');
                    $('#warranty-protection').addClass('d-none');

                    warranty = 0;
                    warranty_protection = 0;
                }

                setTotalCost();
            });

            $('#warranty-years-select').on('select2:select', function (e) {
                switch ($(this).val()) {
                    case '2':
                        warranty = 79.00;
                        break;
                    case '3':
                        warranty = 129.00;
                        break;
                    case '4':
                        warranty = 179.00;
                        break;
                }
                
                setTotalCost();
            });

            $('input[type=checkbox][name=warranty_protection]').on('change', function() {
                if (this.checked) {
                    warranty_protection = 170;
                } else {
                    warranty_protection = 0;
                }
                
                setTotalCost();
            });

            $('#color-options').on('select2:select', function (e) {
                changeImages($(this).val());
            });

            function changeImages(color) {
                $('#laptop-image-1').attr('src', '/media/laptops/' + color + '/1.png');
                $('#laptop-image-2').attr('src', '/media/laptops/' + color + '/2.png');
                $('#laptop-image-3').attr('src', '/media/laptops/' + color + '/3.png');
            }

            function setTotalCost() {
                $('#total-cost').text(screen + warranty + warranty_protection);
            }
        </script>
    @endpush
</x-app-layout>