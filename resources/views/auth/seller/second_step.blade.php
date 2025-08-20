@extends('layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
@endsection
@section('content')
    <x-app.header />
    <section class="ec-page-content section-space-p" style="background: #f4fbfd; min-height: 100vh; padding: 48px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-9">
                    <!-- Step Indicator -->
                    <div class="d-flex flex-column align-items-center mb-4 step-indicator">
                        <div class="d-flex align-items-center justify-content-center mb-2" style="gap: 24px;">
                            <!-- Step 1 -->
                            <div class="d-flex flex-column align-items-center">
                                <div
                                    style="width: 42px; height: 42px; background: var(--accent-color); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.1rem; box-shadow:0 3px 12px rgba(var(--accent-color-rgb), 0.25); transition: all 0.3s ease;">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span class="mt-2 small text-secondary fw-medium fw-bold"
                                    style="color: var(--accent-color) !important;;">Step 1</span>
                                <span class="small text-muted"
                                    style="font-size: 0.75rem; color: var(--accent-color) !important;;">Basic Info</span>
                            </div>

                            <!-- Progress Bar 1-2 -->
                            <div class="d-flex flex-column align-items-center">
                                <div
                                    style="height: 4px; width: 50px; background: linear-gradient(90deg, var(--accent-color) 100%, var(--accent-color) 100%); border-radius: 2px;">
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="d-flex flex-column align-items-center" style="cursor: pointer;">
                                <div id="step2-circle"
                                    style="width: 42px; height: 42px; background: var(--accent-color); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2rem; box-shadow:0 3px 12px rgba(var(--accent-color-rgb), 0.25); animation: pulse 2s infinite;">
                                    2
                                </div>
                                <span class="mt-2 small fw-bold" style="color: var(--accent-color);">Step 2</span>
                                <span class="small fw-medium" style="color: var(--accent-color); font-size: 0.75rem;">Terms
                                    & Conditions</span>
                            </div>

                            <!-- Progress Bar 2-3 -->
                            <div class="d-flex flex-column align-items-center">
                                <div
                                    style="height: 4px; width: 50px; background: linear-gradient(90deg, #e5e7eb 100%, #e5e7eb 100%); border-radius: 2px;">
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="d-flex flex-column align-items-center" style="cursor: pointer;">
                                <div id="step3-circle"
                                    style="width: 42px; height: 42px; background: #e5e7eb; color: #9ca3af; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2rem; box-shadow:0 3px 12px rgba(0,0,0, 0.1); transition: all 0.3s ease;">
                                    3
                                </div>
                                <span class="mt-2 small text-secondary fw-medium">Step 3</span>
                                <span class="small text-muted" style="font-size: 0.75rem;">Vendor Verification</span>
                            </div>
                        </div>

                        <div class="mt-3 text-center">
                            <span id="section-title" class="fw-bold text-dark" style="font-size: 1.2rem;">Terms &
                                Conditions</span>
                            <div class="mt-1">
                                <span id="section-description" class="text-muted small">Please read and accept our terms and
                                    conditions</span>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg border-0" style="border-left: 8px solid var(--accent-color);">
                        <div class="card-body p-4 p-md-5">
                            <div class="mb-4">
                                <div class="alert text-white text-center mb-0"
                                    style="background: var(--accent-color); border-radius: 1rem;">
                                    <span>Shop membership fee-$24.95/month <br>Start selling for free with our 30 days trial
                                        period</span>
                                </div>
                            </div>

                            <!-- Terms & Conditions Section -->
                            <div id="terms-section" style="display: block;">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="fw-bold text-dark mb-0 d-flex align-items-center"
                                        style="letter-spacing: 1px;">
                                        <i class="fas fa-file-contract me-2" style="color: var(--accent-color);"></i>
                                        Terms & Conditions
                                    </h4>
                                    {{-- <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                            onclick="navigateToVerification()">
                                            <i class="fas fa-arrow-right me-1"></i> Next
                                        </button>
                                    </div> --}}
                                </div>
                                <div
                                    style="width: 80px; height: 4px; background: var(--accent-color); border-radius: 2px; margin-bottom: 1.5rem;">
                                </div>

                                <form id="signature-form" action="#" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="shadow-sm"
                                        style="background:#fafdff; border-left:4px solid var(--accent-color); padding:32px 24px; border-radius: 0; max-height: 500px; overflow-y: auto;">
                                        <div class="terms-content">
                                            {!! Settings::setting('admin_terms_conditions') !!}
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label fw-bold"
                                                style="font-size: 1rem; color: var(--accent-color);">
                                                Signature <span class="text-danger">*</span>
                                            </label>
                                            <div id="signature-pad"
                                                style="border:2px dashed var(--accent-color); border-radius:0; background:#fafdff; padding:16px; width:100%; min-height:180px; position:relative;">
                                                <canvas id="signature-canvas" width="800" height="150"
                                                    style="width:100%; height:150px; border: 1px solid #ccc;"></canvas>
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
                                                console.log('Starting signature pad initialization...');

                                                const canvas = document.getElementById('signature-canvas');
                                                const input = document.getElementById('signature-input');
                                                const clearBtn = document.getElementById('clear-signature');

                                                if (!canvas) {
                                                    console.error('Canvas not found!');
                                                    return;
                                                }

                                                const ctx = canvas.getContext('2d');
                                                let isDrawing = false;
                                                let lastX = 0;
                                                let lastY = 0;

                                                // Set up canvas properties
                                                ctx.strokeStyle = '#FF0000';
                                                ctx.lineWidth = 2;
                                                ctx.lineCap = 'round';
                                                ctx.lineJoin = 'round';

                                                console.log('Canvas setup complete');

                                                function getMousePos(e) {
                                                    const rect = canvas.getBoundingClientRect();
                                                    const scaleX = canvas.width / rect.width;
                                                    const scaleY = canvas.height / rect.height;

                                                    return {
                                                        x: (e.clientX - rect.left) * scaleX,
                                                        y: (e.clientY - rect.top) * scaleY
                                                    };
                                                }

                                                function getTouchPos(e) {
                                                    const rect = canvas.getBoundingClientRect();
                                                    const scaleX = canvas.width / rect.width;
                                                    const scaleY = canvas.height / rect.height;

                                                    return {
                                                        x: (e.touches[0].clientX - rect.left) * scaleX,
                                                        y: (e.touches[0].clientY - rect.top) * scaleY
                                                    };
                                                }

                                                function startDrawing(e) {
                                                    isDrawing = true;
                                                    const pos = e.type.includes('touch') ? getTouchPos(e) : getMousePos(e);
                                                    lastX = pos.x;
                                                    lastY = pos.y;
                                                    console.log('Started drawing at:', pos);
                                                }

                                                function draw(e) {
                                                    if (!isDrawing) return;

                                                    e.preventDefault();
                                                    const pos = e.type.includes('touch') ? getTouchPos(e) : getMousePos(e);

                                                    ctx.beginPath();
                                                    ctx.moveTo(lastX, lastY);
                                                    ctx.lineTo(pos.x, pos.y);
                                                    ctx.stroke();

                                                    lastX = pos.x;
                                                    lastY = pos.y;
                                                }

                                                function stopDrawing() {
                                                    if (isDrawing) {
                                                        isDrawing = false;
                                                        // Save the signature
                                                        input.value = canvas.toDataURL('image/png');
                                                        console.log('Signature saved');
                                                    }
                                                }

                                                // Mouse events
                                                canvas.addEventListener('mousedown', startDrawing);
                                                canvas.addEventListener('mousemove', draw);
                                                canvas.addEventListener('mouseup', stopDrawing);
                                                canvas.addEventListener('mouseout', stopDrawing);

                                                // Touch events
                                                canvas.addEventListener('touchstart', function(e) {
                                                    e.preventDefault();
                                                    startDrawing(e);
                                                });

                                                canvas.addEventListener('touchmove', function(e) {
                                                    e.preventDefault();
                                                    draw(e);
                                                });

                                                canvas.addEventListener('touchend', function(e) {
                                                    e.preventDefault();
                                                    stopDrawing();
                                                });

                                                // Clear button
                                                clearBtn.addEventListener('click', function() {
                                                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                                                    input.value = '';
                                                    console.log('Canvas cleared');
                                                });

                                                console.log('Signature pad fully initialized!');
                                            });
                                        </script>

                                        <script>
                                            // Handle form submission - Store signature and proceed to next step
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const signatureForm = document.getElementById('signature-form');
                                                const continueBtn = document.getElementById('continueBtn');

                                                if (signatureForm) {
                                                    signatureForm.addEventListener('submit', function(e) {
                                                        e.preventDefault();

                                                        // Check if signature is provided
                                                        const signatureInput = document.getElementById('signature-input');
                                                        if (!signatureInput.value) {
                                                            if (typeof toastr !== 'undefined') {
                                                                toastr.error('Please provide your signature before continuing.');
                                                            } else {
                                                                alert('Please provide your signature before continuing.');
                                                            }
                                                            return;
                                                        }

                                                        // Show loading state
                                                        const originalText = continueBtn.innerHTML;
                                                        continueBtn.disabled = true;
                                                        continueBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';

                                                        // Store signature in localStorage for later submission
                                                        localStorage.setItem('vendor_signature', signatureInput.value);

                                                        // Show success message
                                                        if (typeof toastr !== 'undefined') {
                                                            toastr.success('Signature saved! Proceeding to verification...');
                                                        }

                                                        // Reset button
                                                        continueBtn.innerHTML = originalText;

                                                        // Proceed to verification step
                                                        setTimeout(() => {
                                                            showSection('verification');
                                                        }, 800);
                                                    });
                                                }
                                            });
                                        </script>

                                        <div class="d-flex align-items-center mb-3">
                                            <input type="checkbox" required
                                                class="form-check-input me-2 @error('terms') is-invalid @enderror"
                                                id="TermsConditions" style="width: 25px;">

                                            <label for="TermsConditions" class="form-label mb-0 text-uppercase fw-bold"
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
                                    </div>

                                    <div class="mt-4 d-flex justify-content-end">
                                        <button type="submit" id="continueBtn" class="btn fw-bold shadow" disabled
                                            style="background-color: #6c757d; color: white; cursor: not-allowed;">
                                            <i class="fas fa-arrow-right me-2"></i> Continue to Verification
                                        </button>
                                    </div>
                                </form>

                            </div>
                            {{-- @dd(session()->get('')) --}}
                            <!-- Vendor Verification Section -->
                            <div id="verification-section" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="fw-bold text-dark mb-0 d-flex align-items-center"
                                        style="letter-spacing: 1px;">
                                        <i class="fas fa-shield-alt me-2" style="color: var(--accent-color);"></i>
                                        Vendor Verification
                                    </h4>
                                    <div class="d-flex gap-2">

                                    </div>
                                </div>
                                <div
                                    style="width: 80px; height: 4px; background: var(--accent-color); border-radius: 2px; margin-bottom: 1.5rem;">
                                </div>

                                <form method="POST" action="{{ route('vendor.second.step.store') }}"
                                    enctype="multipart/form-data" id="verification-form">
                                    @csrf

                                    <!-- Hidden field for signature -->
                                    <input type="hidden" name="signature" id="verification-signature-input">

                                    <h4 class="fw-bold text-dark mb-2 d-flex align-items-center"
                                        style="letter-spacing: 1px;">
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
                                                    <span class="input-group-text bg-white border-1"
                                                        style="border-radius:0;"><i class="fas fa-user"
                                                            style="color: var(--accent-color);"></i></span>
                                                    <input id="phone" type="text"
                                                        placeholder="Enter your phone number"
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
                                                    <span class="input-group-text bg-white border-1"
                                                        style="border-radius:0;"><i class="fas fa-calendar-alt"
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
                                                    style="font-size: 1rem; color: var(--accent-color);">Employer
                                                    identification
                                                    number (EIN) <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-white border-1"
                                                        style="border-radius:0;"><i class="fas fa-id-card"
                                                            style="color: var(--accent-color);"></i></span>
                                                    <input id="tax_no" type="text"
                                                        placeholder="Enter your EIN or leave blank if you don't have one"
                                                        class="form-control bg-white border-1 px-4 py-2 @error('tax_no') is-invalid @enderror"
                                                        name="tax_no" value="{{ old('tax_no') ?? '' }}"
                                                        autocomplete="tax_no" autofocus
                                                        style="box-shadow:none; border-radius:0;">
                                                </div>
                                                @error('tax_no')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="govt_id_front" class="form-label fw-bold"
                                                    style="font-size: 1rem; color: var(--accent-color);">ID Front side
                                                    <span class="text-danger">*</span></label>
                                                <label for="govt_id_front"
                                                    class="w-100 d-flex flex-column align-items-center justify-content-center mb-2"
                                                    style="border:2px dashed var(--accent-color); border-radius:0; padding:28px 0; cursor:pointer; background:#fafdff; transition:box-shadow 0.2s;"
                                                    onmouseover="this.style.boxShadow='0 0 0 2px rgba(var(--accent-color-rgb), 0.13)'"
                                                    onmouseout="this.style.boxShadow='none'">
                                                    <i class="fas fa-id-badge mb-2"
                                                        style="font-size:2rem;color: var(--accent-color);"></i>
                                                    <span class="fw-bold text-secondary">Click or drag file to upload (JPEG
                                                        or
                                                        PNG)</span>
                                                    <input id="govt_id_front" type="file"
                                                        class="d-none @error('govt_id_front') is-invalid @enderror"
                                                        name="govt_id_front"
                                                        onchange="document.getElementById('govt_id_front_name').textContent = this.files[0]?.name || 'No file chosen'">
                                                </label>
                                                <span id="govt_id_front_name"
                                                    class="ms-2 align-self-center text-secondary small">No file
                                                    chosen</span>
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
                                                    <span class="fw-bold text-secondary">Click or drag file to
                                                        upload</span>
                                                    <input id="govt_id_back" type="file"
                                                        class="d-none @error('govt_id_back') is-invalid @enderror"
                                                        name="govt_id_back"
                                                        onchange="document.getElementById('govt_id_back_name').textContent = this.files[0]?.name || 'No file chosen'">
                                                </label>
                                                <span id="govt_id_back_name"
                                                    class="ms-2 align-self-center text-secondary small">No file
                                                    chosen</span>
                                                @error('govt_id_back')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold text-dark mb-2 d-flex align-items-center"
                                        style="letter-spacing: 1px;">
                                        <i class="fas fa-university me-2" style="color: var(--accent-color);"></i> Bank
                                        Info
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
                                                        name="paypal_email" value="{{ old('paypal_email') ?? '' }}"
                                                        required autocomplete="paypal_email" autofocus
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
                                    <h4 class="fw-bold text-dark mb-2 d-flex align-items-center"
                                        style="letter-spacing: 1px;">
                                        <i class="fas fa-store-alt me-2" style="color: var(--accent-color);"></i> Shop
                                        Address
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
                                                    <option value="">Loading countries...</option>
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
                                                    style="font-size: 1rem; color: var(--accent-color);">Street
                                                    address<span class="text-danger">*</span></label>
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
                                    {{-- <h4 class="fw-bold text-dark mb-2 d-flex align-items-center"
                                        style="letter-spacing: 1px;">
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
                                                <span class="input-group-text bg-white border-1"
                                                    style="border-radius:0;"><i class="fas fa-credit-card"
                                                        style="color: var(--accent-color);"></i></span>
                                                <div id="card-element" class="form-control bg-white border-1 px-4 py-2"
                                                    style="box-shadow:none; border-radius:0;"></div>
                                            </div>
                                        </div>
                                        <p class="mb-2">This card will be used for your monthly payment every month.</p>
                                        <p class="text-primary">Each and every merchant must consent to having autopay
                                            enabled.
                                            At any moment, you are free to deactivate your shop or cancel your membership.
                                        </p>
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
                                            style="background-color:#FF0000 !important;color:white; transition:transform 0.2s; font-size:1.1rem;"
                                            onmouseover="this.style.transform='translateY(-2px) scale(1.03)'"
                                            onmouseout="this.style.transform='scale(1)'"
                                            data-secret="{{ $intent->client_secret }}">
                                            <i class="fas fa-lock me-2"></i> Verify
                                        </button>
                                    </div> --}}

                                    <!-- Checkbox -->
                                    {{-- <div class="d-flex align-items-center mb-3">
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
                                    </div> --}}

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <button type="submit" id="submit" class="btn fw-bold shadow"
                                                style="background-color:#FF0000;color:white; transition:transform 0.2s; font-size:1.1rem;"
                                                onmouseover="this.style.transform='translateY(-2px) scale(1.03)'"
                                                onmouseout="this.style.transform='scale(1)'">
                                                Submit
                                            </button>
                                        </div>

                                        {{-- <div class="">
                                            <button type="button" class="btn btn-sm"
                                                style="background: var(--accent-color); color: #ffffff;"
                                                onclick="showSection('terms')">
                                                <i class="fas fa-file-contract me-1"></i> View Terms
                                            </button>
                                        </div> --}}
                                    </div>
                                </form>
                            </div> <!-- End Verification Section -->
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

    <!-- Custom Step Indicator Styles -->
    <style>
        /* Select2 dropdown custom style */
        .select2-container--default .select2-selection--single {
            height: 45px;
            border-radius: 0px;
            border: 1px solid #ced4da;
            padding: 8px 12px;
            background-color: #f8f9fa;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 15px;
            color: #495057;
            line-height: 28px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 9px;
            right: 10px;
        }

        .select2-container--default .select2-results__option--highlighted {
            background-color: #0d6efd;
            color: #fff;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 3px 12px rgba(var(--accent-color-rgb), 0.25);
                transform: scale(1);
            }

            50% {
                box-shadow: 0 3px 20px rgba(var(--accent-color-rgb), 0.4);
                transform: scale(1.05);
            }

            100% {
                box-shadow: 0 3px 12px rgba(var(--accent-color-rgb), 0.25);
                transform: scale(1);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .step-indicator {
            animation: slideIn 0.6s ease-out;
        }

        /* Signature pad styles */
        #signature-canvas {
            cursor: crosshair;
            touch-action: none;
            display: block;
            border: none;
            outline: none;
        }

        #signature-pad {
            position: relative;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        #signature-pad:hover {
            border-color: var(--accent-color) !important;
            box-shadow: 0 0 0 2px rgba(var(--accent-color-rgb), 0.1);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .step-indicator .d-flex[style*="gap: 24px"] {
                gap: 16px !important;
            }

            .step-indicator div[style*="width: 42px"] {
                width: 36px !important;
                height: 36px !important;
                font-size: 1rem !important;
            }

            .step-indicator div[style*="width: 50px"] {
                width: 35px !important;
            }
        }

        @media (max-width: 576px) {
            .step-indicator .d-flex[style*="gap: 24px"] {
                gap: 12px !important;
            }

            .step-indicator div[style*="width: 42px"] {
                width: 32px !important;
                height: 32px !important;
                font-size: 0.9rem !important;
            }

            .step-indicator div[style*="width: 50px"] {
                width: 25px !important;
            }
        }
    </style>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://kit.fontawesome.com/4ad8d6e5b7.js" crossorigin="anonymous"></script>

    <script>
        var verified = false;
        const stripe = Stripe("{{ Settings::setting('stripe_key') }}");

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

    {{-- <script>
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
    </script> --}}

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $(document).ready(function() {
                $('#country').select2({
                    placeholder: "Select a country",
                    allowClear: true,
                    width: '100%'
                });

                $('#state').select2({
                    placeholder: "Select a state",
                    allowClear: true,
                    width: '100%'
                });
            });

            // Load countries
            $.get("https://countriesnow.space/api/v0.1/countries/positions", function(res) {
                $('#country').empty().append('<option value="">Select Country</option>');
                res.data.forEach(function(country) {
                    $('#country').append(new Option(country.name, country.name));
                });
            });

            // Load states when country changes
            $('#country').on('change', function() {
                const selectedCountry = $(this).val();
                $('#state').empty().append('<option value="">Loading...</option>').trigger('change');
                $('#state').prop('disabled', true);

                if (!selectedCountry) {
                    $('#state').empty().append('<option value="">Select Country First</option>');
                    return;
                }

                $.ajax({
                    url: "https://countriesnow.space/api/v0.1/countries/states",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        country: selectedCountry
                    }),
                    success: function(res) {
                        $('#state').empty().append('<option value="">Select State</option>');
                        if (res.data && res.data.states.length > 0) {
                            res.data.states.forEach(function(st) {
                                $('#state').append(new Option(st.name, st.name));
                            });
                            $('#state').prop('disabled', false);
                        } else {
                            $('#state').append('<option value="">No states found</option>');
                        }
                    }
                });
            });
        });
    </script>

    <!-- Section Navigation Script -->
    <!-- Section Navigation Script -->
    <script>
        let currentSection = 'verification'; // Default section

        function showSection(section) {
            // Hide all sections
            document.getElementById('terms-section').style.display = 'none';
            document.getElementById('verification-section').style.display = 'none';

            // Update step indicators
            const step2Circle = document.getElementById('step2-circle');
            const step3Circle = document.getElementById('step3-circle');
            const sectionTitle = document.getElementById('section-title');
            const sectionDescription = document.getElementById('section-description');

            if (section === 'terms') {
                // Show terms section
                document.getElementById('terms-section').style.display = 'block';
                currentSection = 'terms';

                // Update step 2 to active
                step2Circle.style.background = 'var(--accent-color)';
                step2Circle.style.color = '#fff';
                step2Circle.style.animation = 'pulse 2s infinite';

                // Update step 3 to inactive
                step3Circle.style.background = '#e5e7eb';
                step3Circle.style.color = '#9ca3af';
                step3Circle.style.animation = 'none';

                // Update title and description
                sectionTitle.textContent = 'Terms & Conditions';
                sectionDescription.textContent = 'Please read and accept our terms and conditions';

            } else if (section === 'verification') {
                document.getElementById('verification-section').style.display = 'block';
                currentSection = 'verification';

                // Populate signature from localStorage
                const storedSignature = localStorage.getItem('vendor_signature');
                if (storedSignature) {
                    const verificationSignatureInput = document.getElementById('verification-signature-input');
                    if (verificationSignatureInput) {
                        verificationSignatureInput.value = storedSignature;
                    }
                }

                // Update step 3 to active
                step3Circle.style.background = 'var(--accent-color)';
                step3Circle.style.color = '#fff';
                step3Circle.style.animation = 'pulse 2s infinite';

                // Update step 2 to completed
                step2Circle.style.background = 'var(--accent-color)';
                step2Circle.style.color = '#fff';
                step2Circle.style.animation = 'none';
                step2Circle.innerHTML = '<i class="fas fa-check"></i>';

                // Update title and description
                sectionTitle.textContent = 'Vendor Verification';
                sectionDescription.textContent = 'Complete your seller verification to start selling';
            }
        }

        // Function to handle terms checkbox and enable/disable continue button
        function handleTermsCheckbox() {
            const termsCheckbox = document.getElementById('TermsConditions');
            const continueBtn = document.getElementById('continueBtn');

            if (termsCheckbox.checked) {
                continueBtn.disabled = false;
                continueBtn.style.backgroundColor = 'var(--accent-color)';
                continueBtn.style.cursor = 'pointer';
            } else {
                continueBtn.disabled = true;
                continueBtn.style.backgroundColor = '#6c757d';
                continueBtn.style.cursor = 'not-allowed';
            }
        }

        // Function to proceed to verification only if terms are accepted
        function proceedToVerification() {
            const termsCheckbox = document.getElementById('TermsConditions');

            if (!termsCheckbox.checked) {
                alert('Please accept the Terms & Conditions before proceeding.');
                return false;
            }

            showSection('verification');
        }

        // Function to navigate to terms section (always allowed)
        function navigateToTerms() {
            showSection('terms');
        }

        // Function to navigate to verification with validation
        function navigateToVerification() {
            const termsCheckbox = document.getElementById('TermsConditions');

            if (!termsCheckbox.checked) {
                alert('Please accept the Terms & Conditions before proceeding to verification.');
                return false;
            }

            showSection('verification');
        }

        // Initialize with terms section visible
        document.addEventListener('DOMContentLoaded', function() {
            showSection('terms');

            // Add event listener to terms checkbox
            const termsCheckbox = document.getElementById('TermsConditions');
            if (termsCheckbox) {
                termsCheckbox.addEventListener('change', handleTermsCheckbox);
                // Initialize button state
                handleTermsCheckbox();
            }
        });
    </script>
@endsection
