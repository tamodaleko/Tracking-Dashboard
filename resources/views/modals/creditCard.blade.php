<!--begin::Modal - Credit Card-->
<div class="modal fade" id="creditCardModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header align-self-center">
                <!--begin::Modal title-->
                <h2 class="text-center m-0">Add Credit Card</h2>
                <!--end::Modal title-->
            </div>
            <!--end::Modal header-->
            <!--begin::Form-->
            <form id="credit-card-form" class="form" action="{{ route('payments.creditCard') }}" method="POST">
                @csrf
                <!--begin::Modal body-->
                <div class="modal-body py-5 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7">
                        <!--begin::Notice-->
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-12 p-6">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
                            <!--end::Icon-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1">
                                <!--begin::Content-->
                                <div class="fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">Please note!</h4>
                                    <div class="fs-6 text-gray-700">We won't charge you when you add your credit card.</div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->

                        <input type="hidden" name="token" id="token">

                        <div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 mt-10">
                                <label class="form-label fw-bolder text-dark fs-6 required">Card Number</label>
                                <div id="card-number" class="form-control form-control-lg form-control-solid"></div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row fv-row mb-7">
                                <!--begin::Col-->
                                <div class="col-xl-6">
                                    <label class="form-label fw-bolder text-dark fs-6 required">Expiration Date</label>
                                    <div id="card-expiry" class="form-control form-control-lg form-control-solid"></div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-6 mt-7 mt-md-0">
                                    <label class="form-label fw-bolder text-dark fs-6 required">CVC</label>
                                    <div id="card-cvc" class="form-control form-control-lg form-control-solid"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
                    <!--end::Scroll-->

                    <div id="card-errors" class="alert alert-danger text-black fw-bolder mt-3 mb-0 text-center" style="display: none;"></div>
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center px-15">
                    <!--begin::Button-->
                    <button type="submit" id="submit-button" class="btn btn-lg btn-dark w-100 fs-4 py-5">
                        <span class="fw-bolder fs-3">Save</span>
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
<!--end::Modal - Credit Card-->

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    
    <script type="text/javascript">
        const cardButton = document.getElementById('submit-button');
        const displayError = document.getElementById('card-errors');

        cardButton.disabled = true;
        cardButton.style = 'opacity: 0.5';
        
        $(document).ready(function() {
            $.ajax({
                method: 'POST',
                url: "/payments/setup",
                data: {
                    '_token': "{{ csrf_token() }}"
                }
            })
            .done(function(data) {
                if (!data.client_secret) {
                    paymentError('Payment form initialization failed. Please refresh the page.');
                    return false;
                }

                document.getElementById('submit-button')
                    .setAttribute('data-secret', data.client_secret);

                initializeStripe();
            });
        });

        function paymentError(message) {
            displayError.style = 'display: block';
            displayError.textContent = message;

            cardButton.disabled = false;
            cardButton.style = 'opacity: 1';
            cardButton.innerHTML = '<span class="fw-bolder fs-3">Save</span>';
        }
    </script>
    <script>
        function initializeStripe() {
            const stripe = Stripe('{{ config("services.stripe.publishable_key") }}');

            const style = {
                base: {
                    color: '#5e6278',
                    fontSize: '15px',
                    fontWeight: '500',
                    fontFamily: 'Poppins, Helvetica, sans-serif',
                    '::placeholder': {
                        color: '#a1a5b7',
                    }
                },
                invalid: {
                    color: '#e5424d',
                    ':focus': {
                        color: '#303238'
                    }
                }
            };

            const elements = stripe.elements({
                fonts: [
                    {
                        cssSrc: 'https://fonts.googleapis.com/css?family=Poppins:500',
                    },
                ],
                locale: window.__exampleLocale,
            });

            const cardNumber = elements.create('cardNumber', {style: style});
            cardNumber.mount('#card-number');

            const cardExpiry = elements.create('cardExpiry', {style: style});
            cardExpiry.mount('#card-expiry');

            const cardCvc = elements.create('cardCvc', {style: style});
            cardCvc.mount('#card-cvc');

            const clientSecret = cardButton.dataset.secret;

            cardCvc.on('ready', function(event) {
                cardButton.disabled = false;
                cardButton.style = 'opacity: 1';
            });

            cardButton.addEventListener('click', async (e) => {
                e.preventDefault();
                
                cardButton.disabled = true;
                cardButton.style = 'opacity: 0.5';
                cardButton.innerHTML = '<span class="fw-bolder fs-3">Processing...</span>';

                const { setupIntent, error } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardNumber
                        }
                    }
                );

                if (error) {
                    paymentError(error.message);
                    return false;
                }

                document.getElementById('token')
                    .setAttribute('value', setupIntent.payment_method);
                document.getElementById('credit-card-form').submit();
            });
        }
    </script>
@endpush
