@extends('layouts.app')
@section('content')
    <x-app.header />
    <section class="ec-page-content section-space-p" style="background: #f4fbfd; min-height: 100vh; padding: 48px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-9">
                    <!-- Step Indicator -->
                    <div class="d-flex flex-column align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center mb-2" style="gap: 32px;">
                            <!-- Step 1 -->
                            <div class="d-flex flex-column align-items-center">
                                <div style="width: 38px; height: 38px; background: var(--accent-color); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.3rem; box-shadow:0 2px 8px rgba(var(--accent-color-rgb), 0.13);">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span class="mt-2 small text-secondary">Step 1</span>
                            </div>
                            <!-- Progress Bar -->
                            <div style="height: 4px; width: 60px; background: linear-gradient(90deg, var(--accent-color) 60%, var(--accent-color) 100%); border-radius: 2px;"></div>
                            <!-- Step 2 -->
                            <div class="d-flex flex-column align-items-center">
                                <div style="width: 38px; height: 38px; background: var(--accent-color); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.3rem; box-shadow:0 2px 8px rgba(var(--accent-color-rgb), 0.13);">
                                    2
                                </div>
                                <span class="mt-2 small fw-bold" style="color: var(--accent-color);">Step 2</span>
                            </div>
                        </div>
                        <div class="mt-2 text-center">
                            <span class="fw-bold text-dark" style="font-size: 1.1rem;">Vendor Verification</span>
                        </div>
                    </div>
                    <div class="card shadow-lg border-0" style="border-left: 8px solid var(--accent-color); border-radius: 2rem;">
                        <div class="card-body p-4 p-md-5">
                            <div class="mb-4">
                                <div class="alert text-white text-center mb-0" style="background: var(--accent-color); border-radius: 1rem;">
                                    <span>Shop membership fee-$24.95/month <br>Start selling for free with our 30 days trial period</span>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('vendor.second.step.store') }}" enctype="multipart/form-data">
                                @csrf
                                <h4 class="fw-bold text-dark mb-2 d-flex align-items-center" style="letter-spacing: 1px;">
                                    <i class="fas fa-user me-2" style="color: var(--accent-color);"></i> Personal Info
                                </h4>
                                <div style="width: 60px; height: 4px; background: var(--accent-color); border-radius: 2px; margin-bottom: 0.5rem;"></div>
                                <div class="mb-3 text-secondary small" style="margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-info-circle me-1"></i> Please provide your personal details for verification.
                                </div>
                                <div class="shadow-sm mb-4" style="background:#fafdff; border-left:4px solid var(--accent-color); padding:32px 24px 24px 24px; border-radius: 0;">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">Phone<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1" style="border-radius:0;"><i class="fas fa-user" style="color: var(--accent-color);"></i></span>
                                                <input id="phone" type="text" placeholder="Enter your phone number" class="form-control bg-white border-1 px-4 py-2 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? '' }}" required autocomplete="phone" autofocus style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="birth_date" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">Date Of Birth<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1" style="border-radius:0;"><i class="fas fa-calendar-alt" style="color: var(--accent-color);"></i></span>
                                                <input id="birth_date" type="date" max="2003-05-29" placeholder="Date Of Birth" class="form-control bg-white border-1 px-4 py-2 @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') ?? '' }}" required autocomplete="birth_date" autofocus style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('dob')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="tax_no" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">Employer identification number (EIN) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1" style="border-radius:0;"><i class="fas fa-id-card" style="color: var(--accent-color);"></i></span>
                                                <input id="tax_no" type="text" placeholder="Enter your EIN or leave blank if you don't have one" class="form-control bg-white border-1 px-4 py-2 @error('tax_no') is-invalid @enderror" name="tax_no" value="{{ old('tax_no') ?? '' }}" autocomplete="tax_no" autofocus style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('tax_no')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="govt_id_front" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">ID Front side <span class="text-danger">*</span></label>
                                            <label for="govt_id_front" class="w-100 d-flex flex-column align-items-center justify-content-center mb-2" style="border:2px dashed var(--accent-color); border-radius:0; padding:28px 0; cursor:pointer; background:#fafdff; transition:box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 0 0 2px rgba(var(--accent-color-rgb), 0.13)'" onmouseout="this.style.boxShadow='none'">
                                                <i class="fas fa-id-badge mb-2" style="font-size:2rem;color: var(--accent-color);"></i>
                                                <span class="fw-bold text-secondary">Click or drag file to upload (JPEG or PNG)</span>
                                                <input id="govt_id_front" type="file" class="d-none @error('govt_id_front') is-invalid @enderror" name="govt_id_front" onchange="document.getElementById('govt_id_front_name').textContent = this.files[0]?.name || 'No file chosen'">
                                            </label>
                                            <span id="govt_id_front_name" class="ms-2 align-self-center text-secondary small">No file chosen</span>
                                            @error('govt_id_front')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="govt_id_back" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">ID Back side <span class="text-danger">*</span></label>
                                            <label for="govt_id_back" class="w-100 d-flex flex-column align-items-center justify-content-center mb-2" style="border:2px dashed var(--accent-color); border-radius:0; padding:28px 0; cursor:pointer; background:#fafdff; transition:box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 0 0 2px rgba(var(--accent-color-rgb), 0.13)'" onmouseout="this.style.boxShadow='none'">
                                                <i class="fas fa-id-badge mb-2" style="font-size:2rem;color: var(--accent-color);"></i>
                                                <span class="fw-bold text-secondary">Click or drag file to upload</span>
                                                <input id="govt_id_back" type="file" class="d-none @error('govt_id_back') is-invalid @enderror" name="govt_id_back" onchange="document.getElementById('govt_id_back_name').textContent = this.files[0]?.name || 'No file chosen'">
                                            </label>
                                            <span id="govt_id_back_name" class="ms-2 align-self-center text-secondary small">No file chosen</span>
                                            @error('govt_id_back')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark mb-2 d-flex align-items-center" style="letter-spacing: 1px;">
                                    <i class="fas fa-university me-2" style="color: var(--accent-color);"></i> Bank Info
                                </h4>
                                <div style="width: 60px; height: 4px; background: var(--accent-color); border-radius: 2px; margin-bottom: 0.5rem;"></div>
                                <div class="mb-3 text-secondary small" style="margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-info-circle me-1"></i> This information is used to send your sales earnings securely.
                                </div>
                                <div class="shadow-sm mb-4" style="background:#fafdff; border-left:4px solid var(--accent-color); padding:32px 24px 24px 24px; border-radius: 0;">
                                    <div class="row g-4">
                                        <div class="col-md-12">
                                            <label for="paypal_email" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">Paypal Email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1" style="border-radius:0;"><i class="fas fa-envelope" style="color: var(--accent-color);"></i></span>
                                                <input id="paypal_email" type="text" placeholder="Enter your Paypal email address" class="form-control bg-white border-1 px-4 py-2 @error('paypal_email') is-invalid @enderror" name="paypal_email" value="{{ old('paypal_email') ?? '' }}" required autocomplete="paypal_email" autofocus style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('paypal_email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paypal_email_confirmation" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">Confirm Paypal Email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1" style="border-radius:0;"><i class="fas fa-envelope-open" style="color: var(--accent-color);"></i></span>
                                                <input id="paypal_email_confirmation" type="text" placeholder="Re-enter your Paypal email address" class="form-control bg-white border-1 px-4 py-2 @error('paypal_email_confirmation') is-invalid @enderror" name="paypal_email_confirmation" value="{{ old('paypal_email_confirmation') ?? '' }}" required autocomplete="paypal_email_confirmation" autofocus style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('paypal_email_confirmation')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark mb-2 d-flex align-items-center" style="letter-spacing: 1px;">
                                    <i class="fas fa-store-alt me-2" style="color: var(--accent-color);"></i> Shop Address
                                </h4>
                                <div style="width: 60px; height: 4px; background: var(--accent-color); border-radius: 2px; margin-bottom: 0.5rem;"></div>
                                <div class="mb-3 text-secondary small" style="margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-info-circle me-1"></i> Please provide your shop’s address for verification and payments.
                                </div>
                                <div class="shadow-sm mb-4" style="background:#fafdff; border-left:4px solid var(--accent-color); padding:32px 24px 24px 24px; border-radius: 0;">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">Country<span class="text-danger">*</span></label>
                                            <x-country />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">State<span class="text-danger">*</span></label>
                                            <x-state />
                                            @error('state')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="city" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">City<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1" style="border-radius:0;"><i class="fas fa-map-marker-alt" style="color: var(--accent-color);"></i></span>
                                                <input type="text" class="form-control bg-white border-1 px-4 py-2 @error('city') is-invalid @enderror" value="{{ auth()->user()->shop ? auth()->user()->shop->city : ' ' }}" name="city" id="city" required style="box-shadow:none; border-radius:0;" placeholder="Enter your city">
                                            </div>
                                            @error('city')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="post_code" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">Zip</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1" style="border-radius:0;"><i class="fas fa-map-pin" style="color: var(--accent-color);"></i></span>
                                                <input type="text" placeholder="Enter your postal/zip code" class="form-control bg-white border-1 px-4 py-2 @error('post_code') is-invalid @enderror" value="{{ auth()->user()->shop ? auth()->user()->shop->post_code : ' ' }}" name="post_code" id="post_code" required style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('post_code')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="address" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">Street address<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1" style="border-radius:0;"><i class="fas fa-home" style="color: var(--accent-color);"></i></span>
                                                <textarea id="address" placeholder="Enter your shop's street address" class="form-control bg-white border-1 px-4 py-2 @error('address') is-invalid @enderror" name="address" required style="box-shadow:none; border-radius:0; min-height: 48px;">{{ old('address') ?? '' }}</textarea>
                                            </div>
                                            @error('address')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark mb-2 d-flex align-items-center" style="letter-spacing: 1px;">
                                    <i class="fas fa-credit-card me-2" style="color: var(--accent-color);"></i> Credit/Debit Card
                                </h4>
                                <div style="width: 60px; height: 4px; background: var(--accent-color); border-radius: 2px; margin-bottom: 0.5rem;"></div>
                                <div class="mb-3 text-secondary small" style="margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-info-circle me-1"></i> Provide a valid card for your monthly subscription. Your payment is secure.
                                </div>
                                <div class="shadow-sm mb-4" style="background:#fafdff; border-left:4px solid var(--accent-color); padding:32px 24px 24px 24px; border-radius: 0;">
                                    <input id="card-holder-name" type="hidden" value="{{ auth()->user()->name }}">
                                    <input name="payment_method" id="card-payment-method" type="hidden">
                                    <div class="form-group mb-3">
                                        <label for="card_info" class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">Card Details<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-1" style="border-radius:0;"><i class="fas fa-credit-card" style="color: var(--accent-color);"></i></span>
                                            <div id="card-element" class="form-control bg-white border-1 px-4 py-2" style="box-shadow:none; border-radius:0;"></div>
                                        </div>
                                    </div>
                                    <p class="mb-2">This card will be used for your monthly payment every month.</p>
                                    <p class="text-primary">Each and every merchant must consent to having autopay enabled. At any moment, you are free to deactivate your shop or cancel your membership.</p>
                                    <div class="d-flex align-items-center mb-3" style="height: 40px;">
                                        <input type="checkbox" required class="form-check-input me-2 @error('ismonthly_charge') is-invalid @enderror" id="ismonthly_charge" style="width: 25px;" value="1" name="ismonthly_charge">
                                        <label for="ismonthly_charge" class="form-label mb-0 fw-bold" style="color: var(--accent-color);">Auto pay</label>
                                        @error('ismonthly_charge')<span class="invalid-feedback ms-2" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                    <button id="card-button" type="button" class="btn mb-2 fw-bold shadow" style="background-color:#FF0000;color:white; transition:transform 0.2s; font-size:1.1rem;" onmouseover="this.style.transform='translateY(-2px) scale(1.03)'" onmouseout="this.style.transform='scale(1)'" data-secret="{{ $intent->client_secret }}">
                                        <i class="fas fa-lock me-2"></i> Verify
                                    </button>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <input type="checkbox" required class="form-check-input me-2 @error('terms') is-invalid @enderror" id="terms" style="width: 25px;" value="1" name="terms">
                                    <label for="terms" class="form-label mb-0 text-uppercase fw-bold" style="font-size: 0.85rem; color: var(--accent-color);">I have read and agree to the <span class="text-primary">Terms &amp; Conditions</span></label>
                                    @error('terms')<span class="invalid-feedback ms-2" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                                <div class="d-grid">
                                    <button type="submit" id="submit" disabled class="btn fw-bold shadow" style="background-color:#FF0000;color:white; transition:transform 0.2s; font-size:1.1rem;" onmouseover="this.style.transform='translateY(-2px) scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://kit.fontawesome.com/4ad8d6e5b7.js" crossorigin="anonymous"></script>

    <script>
        var verified = false;
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            console.log('clicked')
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            );

            if (error) {
                console.log(error);
               
                toastr.error(error.message)
            } else {
                document.getElementById('card-button').style.display = "none";
                document.getElementById('submit').disabled = false;
                document.getElementById('card-payment-method').value = setupIntent.payment_method;
                toastr.info('Payment method is verified')
            }
        });
    </script>
@endsection
