@extends('auth.seller.registration.layout', ['current_step' => 3])

@section('registration-content')
    <section class="ec-page-content section-space-p" style="background: #f4fbfd; min-height: 100vh; padding: 48px 0;">
        <div class="container">
            <div class="row justify-content-center">

                <div class="card shadow-lg border-0" style="border-left: 8px solid var(--accent-color);">
                    <div class="card-body p-4 p-md-5">

                        <div class="mt-3 text-center">
                            <span id="section-title" class="fw-bold text-dark" style="font-size: 3rem;">Terms &
                                Conditions</span>
                            <div class="mt-1">
                                <span id="section-description" class="text-muted small">Please read and accept our terms and
                                    conditions</span>
                            </div>
                        </div>


                        <form id="signature-form" action="{{ route('vendor.registration.terms-and-conditions.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="shadow-sm"
                                style="background:#fafdff; border-left:4px solid var(--accent-color); padding:32px 24px; border-radius: 0; overflow-y: auto;">
                                <div class="terms-content">
                                    {!! Settings::setting('admin_terms_conditions') !!}
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold" style="font-size: 1rem; color: var(--accent-color);">
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




                </div>
            </div>
        </div>


    </section>
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
            const termsCheckbox = document.getElementById('TermsConditions');
            const signatureInput = document.getElementById('signature-input');

            // Function to check if form is valid
            function checkFormValidity() {
                const isTermsChecked = termsCheckbox.checked;
                const hasSignature = signatureInput.value.trim() !== '';

                if (isTermsChecked && hasSignature) {
                    continueBtn.disabled = false;
                    continueBtn.classList.remove('btn-disabled');
                    continueBtn.classList.add('btn-enabled');
                    continueBtn.style.backgroundColor = 'var(--accent-color)';
                    continueBtn.style.color = 'white';
                    continueBtn.style.cursor = 'pointer';
                } else {
                    continueBtn.disabled = true;
                    continueBtn.classList.remove('btn-enabled');
                    continueBtn.classList.add('btn-disabled');
                    continueBtn.style.backgroundColor = '#6c757d';
                    continueBtn.style.color = 'white';
                    continueBtn.style.cursor = 'not-allowed';
                }
            }

            // Function to update step indicators
            function updateStepIndicators() {
                // Update Step 2 to completed
                const step2Circle = document.getElementById('step2-circle');
                const progress2to3 = document.getElementById('progress-2-3');
                const step3Circle = document.getElementById('step3-circle');
                const step3Text = document.getElementById('step3-text');
                const step3Desc = document.getElementById('step3-desc');
                const sectionTitle = document.getElementById('section-title');
                const sectionDescription = document.getElementById('section-description');

                // Step 2 transition to completed
                step2Circle.style.animation = 'none';
                step2Circle.innerHTML = '<i class="fas fa-check"></i>';
                step2Circle.classList.add('step-transition');

                // Fill progress bar 2-3
                setTimeout(() => {
                    progress2to3.style.background = 'var(--accent-color)';
                    progress2to3.classList.add('progress-fill');
                }, 300);

                // Activate Step 3
                setTimeout(() => {
                    step3Circle.style.background = 'var(--accent-color)';
                    step3Circle.style.color = '#fff';
                    step3Circle.style.animation = 'pulse 2s infinite';
                    step3Circle.style.boxShadow = '0 3px 12px rgba(var(--accent-color-rgb), 0.25)';

                    step3Text.style.color = 'var(--accent-color)';
                    step3Text.classList.add('fw-bold');
                    step3Desc.style.color = 'var(--accent-color)';

                    // Update section title
                    sectionTitle.textContent = 'Vendor Verification';
                    sectionDescription.textContent = 'Complete your verification to start selling';
                }, 600);
            }

            // Function to show verification section
            function showSection(sectionName) {
                const termsSection = document.getElementById('terms-section');
                const verificationSection = document.getElementById('verification-section');

                if (sectionName === 'verification') {
                    termsSection.style.display = 'none';
                    verificationSection.style.display = 'block';

                    // Update step indicators
                    updateStepIndicators();

                    // Scroll to top smoothly
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            }

            // Event listeners
            termsCheckbox.addEventListener('change', checkFormValidity);

            // Listen for signature changes
            const canvas = document.getElementById('signature-canvas');
            if (canvas) {
                canvas.addEventListener('mouseup', checkFormValidity);
                canvas.addEventListener('touchend', checkFormValidity);
            }

            // Form submission handler
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
                        document.getElementById('signature-form').submit();
                    }, 800);
                });
            }

            // Initial form validation check
            checkFormValidity();
        });
    </script>
@endsection
