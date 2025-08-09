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
                                <div
                                    style="width: 38px; height: 38px; background: var(--accent-color); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.3rem; box-shadow:0 2px 8px rgba(var(--accent-color-rgb), 0.13);">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span class="mt-2 small text-secondary">Step 1</span>
                            </div>
                            <!-- Progress Bar -->
                            <div
                                style="height: 4px; width: 60px; background: linear-gradient(90deg, var(--accent-color) 60%, var(--accent-color) 100%); border-radius: 2px;">
                            </div>
                            <!-- Step 2 -->
                            <div class="d-flex flex-column align-items-center">
                                <div
                                    style="width: 38px; height: 38px; background: var(--accent-color); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.3rem; box-shadow:0 2px 8px rgba(var(--accent-color-rgb), 0.13);">
                                    2
                                </div>
                                <span class="mt-2 small fw-bold" style="color: var(--accent-color);">Step 2</span>
                            </div>
                        </div>
                        <div class="mt-2 text-center">
                            <span class="fw-bold text-dark" style="font-size: 1.1rem;">Vendor Verification</span>
                        </div>
                    </div>
                    <div class="card shadow-lg border-0"
                        style="border-left: 8px solid var(--accent-color); border-radius: 2rem;">
                        <div class="card-body p-4 p-md-5">
                            <div class="mb-4">
                                <div class="alert text-white text-center mb-0"
                                    style="background: var(--accent-color); border-radius: 1rem;">
                                    <span>Shop membership fee-$24.95/month <br>Start selling for free with our 30 days trial
                                        period</span>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('vendor.second.step.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <h4 class="fw-bold text-dark mb-2 d-flex align-items-center" style="letter-spacing: 1px;">
                                    <i class="fas fa-user me-2" style="color: var(--accent-color);"></i> Personal Info
                                </h4>
                                <div
                                    style="width: 60px; height: 4px; background: var(--accent-color); border-radius: 2px; margin-bottom: 0.5rem;">
                                </div>
                                <div class="mb-3 text-secondary small" style="margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-info-circle me-1"></i> Please provide your personal details for
                                    verification.
                                </div>
                                <div class="shadow-sm mb-4"
                                    style="background:#fafdff; border-left:4px solid var(--accent-color); padding:32px 24px 24px 24px; border-radius: 0;">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">Phone<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1" style="border-radius:0;"><i
                                                        class="fas fa-user" style="color: var(--accent-color);"></i></span>
                                                <input id="phone" type="text" placeholder="Enter your phone number"
                                                    class="form-control bg-white border-1 px-4 py-2 @error('phone') is-invalid @enderror"
                                                    name="phone" value="{{ old('phone') ?? '' }}" required
                                                    autocomplete="phone" autofocus
                                                    style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('phone')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="birth_date" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">Date Of Birth<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1" style="border-radius:0;"><i
                                                        class="fas fa-calendar-alt"
                                                        style="color: var(--accent-color);"></i></span>
                                                <input id="birth_date" type="date" max="2003-05-29"
                                                    placeholder="Date Of Birth"
                                                    class="form-control bg-white border-1 px-4 py-2 @error('dob') is-invalid @enderror"
                                                    name="dob" value="{{ old('dob') ?? '' }}" required
                                                    autocomplete="birth_date" autofocus
                                                    style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('dob')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="tax_no" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">Employer identification
                                                number (EIN) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1" style="border-radius:0;"><i
                                                        class="fas fa-id-card"
                                                        style="color: var(--accent-color);"></i></span>
                                                <input id="tax_no" type="text"
                                                    placeholder="Enter your EIN or leave blank if you don't have one"
                                                    class="form-control bg-white border-1 px-4 py-2 @error('tax_no') is-invalid @enderror"
                                                    name="tax_no" value="{{ old('tax_no') ?? '' }}" autocomplete="tax_no"
                                                    autofocus style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('tax_no')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="govt_id_front" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">ID Front side <span
                                                    class="text-danger">*</span></label>
                                            <label for="govt_id_front"
                                                class="w-100 d-flex flex-column align-items-center justify-content-center mb-2"
                                                style="border:2px dashed var(--accent-color); border-radius:0; padding:28px 0; cursor:pointer; background:#fafdff; transition:box-shadow 0.2s;"
                                                onmouseover="this.style.boxShadow='0 0 0 2px rgba(var(--accent-color-rgb), 0.13)'"
                                                onmouseout="this.style.boxShadow='none'">
                                                <i class="fas fa-id-badge mb-2"
                                                    style="font-size:2rem;color: var(--accent-color);"></i>
                                                <span class="fw-bold text-secondary">Click or drag file to upload (JPEG or
                                                    PNG)</span>
                                                <input id="govt_id_front" type="file"
                                                    class="d-none @error('govt_id_front') is-invalid @enderror"
                                                    name="govt_id_front"
                                                    onchange="document.getElementById('govt_id_front_name').textContent = this.files[0]?.name || 'No file chosen'">
                                            </label>
                                            <span id="govt_id_front_name"
                                                class="ms-2 align-self-center text-secondary small">No file chosen</span>
                                            @error('govt_id_front')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="govt_id_back" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">ID Back side <span
                                                    class="text-danger">*</span></label>
                                            <label for="govt_id_back"
                                                class="w-100 d-flex flex-column align-items-center justify-content-center mb-2"
                                                style="border:2px dashed var(--accent-color); border-radius:0; padding:28px 0; cursor:pointer; background:#fafdff; transition:box-shadow 0.2s;"
                                                onmouseover="this.style.boxShadow='0 0 0 2px rgba(var(--accent-color-rgb), 0.13)'"
                                                onmouseout="this.style.boxShadow='none'">
                                                <i class="fas fa-id-badge mb-2"
                                                    style="font-size:2rem;color: var(--accent-color);"></i>
                                                <span class="fw-bold text-secondary">Click or drag file to upload</span>
                                                <input id="govt_id_back" type="file"
                                                    class="d-none @error('govt_id_back') is-invalid @enderror"
                                                    name="govt_id_back"
                                                    onchange="document.getElementById('govt_id_back_name').textContent = this.files[0]?.name || 'No file chosen'">
                                            </label>
                                            <span id="govt_id_back_name"
                                                class="ms-2 align-self-center text-secondary small">No file chosen</span>
                                            @error('govt_id_back')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark mb-2 d-flex align-items-center" style="letter-spacing: 1px;">
                                    <i class="fas fa-university me-2" style="color: var(--accent-color);"></i> Bank Info
                                </h4>
                                <div
                                    style="width: 60px; height: 4px; background: var(--accent-color); border-radius: 2px; margin-bottom: 0.5rem;">
                                </div>
                                <div class="mb-3 text-secondary small" style="margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-info-circle me-1"></i> This information is used to send your sales
                                    earnings securely.
                                </div>
                                <div class="shadow-sm mb-4"
                                    style="background:#fafdff; border-left:4px solid var(--accent-color); padding:32px 24px 24px 24px; border-radius: 0;">
                                    <div class="row g-4">
                                        <div class="col-md-12">
                                            <label for="paypal_email" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">Paypal Email<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1"
                                                    style="border-radius:0;"><i class="fas fa-envelope"
                                                        style="color: var(--accent-color);"></i></span>
                                                <input id="paypal_email" type="text"
                                                    placeholder="Enter your Paypal email address"
                                                    class="form-control bg-white border-1 px-4 py-2 @error('paypal_email') is-invalid @enderror"
                                                    name="paypal_email" value="{{ old('paypal_email') ?? '' }}" required
                                                    autocomplete="paypal_email" autofocus
                                                    style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('paypal_email')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paypal_email_confirmation" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">Confirm Paypal
                                                Email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1"
                                                    style="border-radius:0;"><i class="fas fa-envelope-open"
                                                        style="color: var(--accent-color);"></i></span>
                                                <input id="paypal_email_confirmation" type="text"
                                                    placeholder="Re-enter your Paypal email address"
                                                    class="form-control bg-white border-1 px-4 py-2 @error('paypal_email_confirmation') is-invalid @enderror"
                                                    name="paypal_email_confirmation"
                                                    value="{{ old('paypal_email_confirmation') ?? '' }}" required
                                                    autocomplete="paypal_email_confirmation" autofocus
                                                    style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('paypal_email_confirmation')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark mb-2 d-flex align-items-center" style="letter-spacing: 1px;">
                                    <i class="fas fa-store-alt me-2" style="color: var(--accent-color);"></i> Shop Address
                                </h4>
                                <div
                                    style="width: 60px; height: 4px; background: var(--accent-color); border-radius: 2px; margin-bottom: 0.5rem;">
                                </div>
                                <div class="mb-3 text-secondary small" style="margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-info-circle me-1"></i> Please provide your shop’s address for
                                    verification and payments.
                                </div>
                                <div class="shadow-sm mb-4"
                                    style="background:#fafdff; border-left:4px solid var(--accent-color); padding:32px 24px 24px 24px; border-radius: 0;">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label for="country" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">
                                                Country<span class="text-danger">*</span>
                                            </label>
                                            <select
                                                class="bg-light form-select form-control mx-0 border @error('country') is-invalid @enderror"
                                                name="country" id="country" required>
                                                <option value="">Choose Country</option>
                                                <option value="nigeria">Nigeria</option>
                                                <option value="kenya">Kenya</option>
                                                <option value="south_africa">South Africa</option>
                                                <option value="egypt">Egypt</option>
                                                <option value="ghana">Ghana</option>
                                                <option value="ethiopia">Ethiopia</option>
                                                <option value="morocco">Morocco</option>
                                                <option value="uganda">Uganda</option>
                                            </select>
                                            @error('country')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="state" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">
                                                State<span class="text-danger">*</span>
                                            </label>
                                            <select
                                                class="bg-light form-select form-control mx-0 border @error('state') is-invalid @enderror"
                                                name="state" id="state" required>
                                                <option value="">Select State</option>
                                            </select>
                                            @error('state')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="city" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">City<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1"
                                                    style="border-radius:0;"><i class="fas fa-map-marker-alt"
                                                        style="color: var(--accent-color);"></i></span>
                                                <input type="text"
                                                    class="form-control bg-white border-1 px-4 py-2 @error('city') is-invalid @enderror"
                                                    value="{{ auth()->user()->shop ? auth()->user()->shop->city : ' ' }}"
                                                    name="city" id="city" required
                                                    style="box-shadow:none; border-radius:0;"
                                                    placeholder="Enter your city">
                                            </div>
                                            @error('city')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="post_code" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">Zip</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1"
                                                    style="border-radius:0;"><i class="fas fa-map-pin"
                                                        style="color: var(--accent-color);"></i></span>
                                                <input type="text" placeholder="Enter your postal/zip code"
                                                    class="form-control bg-white border-1 px-4 py-2 @error('post_code') is-invalid @enderror"
                                                    value="{{ auth()->user()->shop ? auth()->user()->shop->post_code : ' ' }}"
                                                    name="post_code" id="post_code" required
                                                    style="box-shadow:none; border-radius:0;">
                                            </div>
                                            @error('post_code')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="address" class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">Street address<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-1"
                                                    style="border-radius:0;"><i class="fas fa-home"
                                                        style="color: var(--accent-color);"></i></span>
                                                <textarea id="address" placeholder="Enter your shop's street address"
                                                    class="form-control bg-white border-1 px-4 py-2 @error('address') is-invalid @enderror" name="address" required
                                                    style="box-shadow:none; border-radius:0; min-height: 48px;">{{ old('address') ?? '' }}</textarea>
                                            </div>
                                            @error('address')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark mb-2 d-flex align-items-center" style="letter-spacing: 1px;">
                                    <i class="fas fa-credit-card me-2" style="color: var(--accent-color);"></i>
                                    Credit/Debit Card
                                </h4>
                                <div
                                    style="width: 60px; height: 4px; background: var(--accent-color); border-radius: 2px; margin-bottom: 0.5rem;">
                                </div>
                                <div class="mb-3 text-secondary small" style="margin-bottom: 1.5rem !important;">
                                    <i class="fas fa-info-circle me-1"></i> Provide a valid card for your monthly
                                    subscription. Your payment is secure.
                                </div>
                                <div class="shadow-sm mb-4"
                                    style="background:#fafdff; border-left:4px solid var(--accent-color); padding:32px 24px 24px 24px; border-radius: 0;">
                                    <input id="card-holder-name" type="hidden" value="{{ auth()->user()->name }}">
                                    <input name="payment_method" id="card-payment-method" type="hidden">
                                    <div class="form-group mb-3">
                                        <label for="card_info" class="form-label fw-bold"
                                            style="font-size: 1rem; color: var(--accent-color);">Card Details<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-1" style="border-radius:0;"><i
                                                    class="fas fa-credit-card"
                                                    style="color: var(--accent-color);"></i></span>
                                            <div id="card-element" class="form-control bg-white border-1 px-4 py-2"
                                                style="box-shadow:none; border-radius:0;"></div>
                                        </div>
                                    </div>
                                    <p class="mb-2">This card will be used for your monthly payment every month.</p>
                                    <p class="text-primary">Each and every merchant must consent to having autopay enabled.
                                        At any moment, you are free to deactivate your shop or cancel your membership.</p>
                                    <div class="d-flex align-items-center mb-3" style="height: 40px;">
                                        <input type="checkbox" required
                                            class="form-check-input me-2 @error('ismonthly_charge') is-invalid @enderror"
                                            id="ismonthly_charge" style="width: 25px;" value="1"
                                            name="ismonthly_charge">
                                        <label for="ismonthly_charge" class="form-label mb-0 fw-bold"
                                            style="color: var(--accent-color);">Auto pay</label>
                                        @error('ismonthly_charge')
                                            <span class="invalid-feedback ms-2"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <button id="card-button" type="button" class="btn mb-2 fw-bold shadow"
                                        style="background-color:#FF0000;color:white; transition:transform 0.2s; font-size:1.1rem;"
                                        onmouseover="this.style.transform='translateY(-2px) scale(1.03)'"
                                        onmouseout="this.style.transform='scale(1)'"
                                        data-secret="{{ $intent->client_secret }}">
                                        <i class="fas fa-lock me-2"></i> Verify
                                    </button>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold"
                                        style="font-size: 1rem; color: var(--accent-color);">
                                        Signature <span class="text-danger">*</span>
                                    </label>
                                    <div id="signature-pad"
                                        style="border:2px dashed var(--accent-color); border-radius:0; background:#fafdff; padding:16px; width:100%; min-height:180px; position:relative;">
                                        <canvas id="signature-canvas" style="width:100%; height:150px;"></canvas>
                                        <button type="button" id="clear-signature"
                                            class="btn btn-sm btn-secondary position-absolute end-0 bottom-0 m-2">Clear</button>
                                    </div>
                                    <input type="hidden" name="signature" id="signature-input" required>
                                    @error('signature')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const canvas = document.getElementById('signature-canvas');
                                        const input = document.getElementById('signature-input');
                                        const clearBtn = document.getElementById('clear-signature');
                                        let drawing = false;
                                        let ctx = canvas.getContext('2d');

                                        function resizeCanvas() {
                                            canvas.width = canvas.offsetWidth;
                                            canvas.height = 150;
                                        }
                                        resizeCanvas();

                                        function getPosition(e) {
                                            const rect = canvas.getBoundingClientRect();
                                            if (e.touches) {
                                                return {
                                                    x: e.touches[0].clientX - rect.left,
                                                    y: e.touches[0].clientY - rect.top
                                                };
                                            }
                                            return {
                                                x: e.clientX - rect.left,
                                                y: e.clientY - rect.top
                                            };
                                        }

                                        function startDraw(e) {
                                            drawing = true;
                                            const pos = getPosition(e);
                                            ctx.beginPath();
                                            ctx.moveTo(pos.x, pos.y);
                                        }

                                        function draw(e) {
                                            if (!drawing) return;
                                            const pos = getPosition(e);
                                            ctx.lineTo(pos.x, pos.y);
                                            ctx.strokeStyle = "#FF0000";
                                            ctx.lineWidth = 2;
                                            ctx.stroke();
                                        }

                                        function endDraw() {
                                            drawing = false;
                                            input.value = canvas.toDataURL('image/png');
                                        }

                                        canvas.addEventListener('mousedown', startDraw);
                                        canvas.addEventListener('mousemove', draw);
                                        canvas.addEventListener('mouseup', endDraw);
                                        canvas.addEventListener('mouseleave', endDraw);

                                        canvas.addEventListener('touchstart', startDraw);
                                        canvas.addEventListener('touchmove', function(e) {
                                            draw(e);
                                            e.preventDefault();
                                        });
                                        canvas.addEventListener('touchend', endDraw);

                                        clearBtn.addEventListener('click', function() {
                                            ctx.clearRect(0, 0, canvas.width, canvas.height);
                                            input.value = '';
                                        });

                                        window.addEventListener('resize', resizeCanvas);
                                    });
                                </script>

                                <!-- Checkbox -->
                                <div class="d-flex align-items-center mb-3">
                                    <input type="checkbox" required
                                        class="form-check-input me-2 @error('terms') is-invalid @enderror"
                                        id="termsCheckbox" style="width: 25px;" value="1" name="terms">

                                    <label for="termsCheckbox" class="form-label mb-0 text-uppercase fw-bold"
                                        style="font-size: 0.85rem; color: var(--accent-color); cursor: pointer;">
                                        I have read and agree to the
                                        <span class="text-primary">Terms &amp; Conditions</span>
                                    </label>

                                    @error('terms')
                                        <span class="invalid-feedback ms-2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" id="submit" disabled class="btn fw-bold shadow"
                                        style="background-color:#FF0000;color:white; transition:transform 0.2s; font-size:1.1rem;"
                                        onmouseover="this.style.transform='translateY(-2px) scale(1.03)'"
                                        onmouseout="this.style.transform='scale(1)'">
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

    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-fullscreen-xxl-down modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms & Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Settings::setting('admin_terms_conditions') !!}

                </div>
                <div class="modal-footer">
                    <button type="button" id="agreeBtn" class="btn btn-primary" data-bs-dismiss="modal">I
                        Agree</button>
                </div>
            </div>
        </div>
    </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stateData = {
                nigeria: [
                    "Abia", "Adamawa", "Akwa Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno",
                    "Cross River", "Delta", "Ebonyi", "Edo", "Ekiti", "Enugu", "Gombe", "Imo", "Jigawa",
                    "Kaduna", "Kano", "Katsina", "Kebbi", "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger",
                    "Ogun", "Ondo", "Osun", "Oyo", "Plateau", "Rivers", "Sokoto", "Taraba", "Yobe",
                    "Zamfara",
                    "FCT (Abuja)"
                ],
                kenya: [
                    "Baringo", "Bomet", "Bungoma", "Busia", "Elgeyo-Marakwet", "Embu", "Garissa",
                    "Homa Bay", "Isiolo", "Kajiado", "Kakamega", "Kericho", "Kiambu", "Kilifi",
                    "Kirinyaga", "Kisii", "Kisumu", "Kitui", "Kwale", "Laikipia", "Lamu",
                    "Machakos", "Makueni", "Mandera", "Marsabit", "Meru", "Migori", "Mombasa",
                    "Murang'a", "Nairobi", "Nakuru", "Nandi", "Narok", "Nyamira", "Nyandarua",
                    "Nyeri", "Samburu", "Siaya", "Taita-Taveta", "Tana River", "Tharaka-Nithi",
                    "Trans Nzoia", "Turkana", "Uasin Gishu", "Vihiga", "Wajir", "West Pokot"
                ],
                south_africa: [
                    "Eastern Cape", "Free State", "Gauteng", "KwaZulu-Natal",
                    "Limpopo", "Mpumalanga", "North West", "Northern Cape", "Western Cape"
                ],
                egypt: [
                    "Cairo", "Giza", "Alexandria", "Aswan", "Asyut", "Beheira", "Beni Suef",
                    "Dakahlia", "Damietta", "Faiyum", "Gharbia", "Ismailia", "Kafr El Sheikh",
                    "Luxor", "Matrouh", "Minya", "Monufia", "New Valley", "North Sinai",
                    "Port Said", "Qalyubia", "Qena", "Red Sea", "Sharqia", "Sohag", "South Sinai", "Suez"
                ],
                ghana: [
                    "Ashanti", "Brong-Ahafo", "Central", "Eastern", "Greater Accra",
                    "Northern", "Upper East", "Upper West", "Volta", "Western", "Bono", "Ahafo", "Oti",
                    "North East", "Savannah", "Western North"
                ],
                ethiopia: [
                    "Addis Ababa", "Afar", "Amhara", "Benishangul-Gumuz", "Dire Dawa",
                    "Gambela", "Harari", "Oromia", "Sidama", "Somali", "South West", "Southern Nations"
                ],
                morocco: [
                    "Casablanca-Settat", "Fès-Meknès", "Rabat-Salé-Kénitra", "Marrakesh-Safi",
                    "Tangier-Tetouan-Al Hoceima", "Souss-Massa", "Oriental", "Béni Mellal-Khénifra",
                    "Drâa-Tafilalet", "Guelmim-Oued Noun", "Laâyoune-Sakia El Hamra", "Dakhla-Oued Ed-Dahab"
                ],
                uganda: [
                    "Central", "Eastern", "Northern", "Western", "Kampala", "Karamoja",
                    "Acholi", "Lango", "Buganda", "Bukedi", "Bunyoro", "Busoga", "Teso", "West Nile"
                ]
            };

            const countrySelect = document.getElementById('country');
            const stateSelect = document.getElementById('state');

            countrySelect.addEventListener('change', function() {
                const selectedCountry = this.value;

                stateSelect.innerHTML = '<option value="">Select State</option>';

                if (!selectedCountry || !stateData[selectedCountry]) {
                    stateSelect.disabled = true;
                    return;
                }

                stateData[selectedCountry].forEach(function(state) {
                    const option = document.createElement('option');
                    option.value = state;
                    option.textContent = state;
                    stateSelect.appendChild(option);
                });

                stateSelect.disabled = false;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const termsCheckbox = document.getElementById('termsCheckbox');
            const termsLink = document.querySelector('[data-bs-target="#termsModal"]');
            const agreeBtn = document.getElementById('agreeBtn');

            // Prevent checkbox from being checked directly
            termsCheckbox.addEventListener('click', function(e) {
                e.preventDefault();
                const modal = new bootstrap.Modal(document.getElementById('termsModal'));
                modal.show();
            });

            // Check the box when user agrees in modal
            agreeBtn.addEventListener('click', function() {
                termsCheckbox.checked = true;
                // Trigger change event in case any listeners are watching
                const event = new Event('change');
                termsCheckbox.dispatchEvent(event);
            });

            // Uncheck if user clicks the terms link again (optional)
            termsLink.addEventListener('click', function() {
                if (!termsCheckbox.checked) return;
                termsCheckbox.checked = false;
            });
        });
    </script>
@endsection
