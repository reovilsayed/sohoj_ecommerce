@extends('layouts.app')

@section('title', 'Store Profile Setup - Afrikartt E-commerce')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .store-profile-container {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 48px 0;
        }

        .profile-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #DE991B, #f4b942, #DE991B);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .step-indicator {
            background: linear-gradient(135deg, #DE991B 0%, #b87d15 100%);
            padding: 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .step-indicator::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: headerShine 4s ease-in-out infinite;
        }

        @keyframes headerShine {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            50% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }

            100% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }
        }

        .steps-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            position: relative;
            z-index: 2;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.3s ease;
        }

        .step-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            transition: all 0.3s ease;
            border: 3px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .step.active .step-circle {
            background: white;
            color: #DE991B;
            border-color: white;
            animation: pulse 2s infinite;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
        }

        .step.completed .step-circle {
            background: #28a745;
            color: white;
            border-color: #28a745;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .step-connector {
            width: 80px;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .step-connector.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: white;
            animation: fillProgress 0.5s ease forwards;
        }

        @keyframes fillProgress {
            from {
                width: 0%;
            }

            to {
                width: 100%;
            }
        }

        .step-title {
            margin-top: 12px;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .step-description {
            font-size: 12px;
            opacity: 0.9;
            text-align: center;
            margin-top: 4px;
            position: relative;
            z-index: 2;
        }

        .form-content {
            padding: 50px;
            background: linear-gradient(to bottom, #ffffff 0%, #fafbfc 100%);
        }

        .step-form {
            display: none;
            animation: fadeInUp 0.6s ease;
        }

        .step-form.active {
            display: block;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-section {
            background: linear-gradient(135deg, #fff9f0 0%, #fef5e7 100%);
            padding: 35px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(135deg, #DE991B 0%, #b87d15 100%);
        }

        .section-title {
            color: #DE991B;
            font-weight: 800;
            font-size: 24px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            padding: 12px 16px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #DE991B;
            transform: translateY(-2px);
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 50px !important;
            display: flex !important;
            justify-content: start !important;
            align-items: center !important;
        }


        .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            margin-left: -1px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            box-shadow: none !important;
            outline: none !important;
        }

        .input-group-text {
            background: linear-gradient(135deg, #DE991B 0%, #b87d15 100%);
            color: white;
            border: none;
            font-weight: 600;
        }

        .file-upload-area {
            border: 3px dashed #DE991B;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            background: linear-gradient(135deg, rgba(222, 153, 27, 0.05) 0%, rgba(222, 153, 27, 0.02) 100%);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .file-upload-area:hover {
            border-color: #b87d15;
            background: linear-gradient(135deg, rgba(222, 153, 27, 0.1) 0%, rgba(222, 153, 27, 0.05) 100%);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(222, 153, 27, 0.2);
        }

        .file-upload-area.dragover {
            border-color: #b87d15;
            background: linear-gradient(135deg, rgba(222, 153, 27, 0.15) 0%, rgba(222, 153, 27, 0.08) 100%);
            transform: scale(1.02);
        }

        .upload-icon {
            font-size: 48px;
            color: #DE991B;
            margin-bottom: 15px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 12px;
            margin-top: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .btn-custom {
            border-radius: 30px;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #DE991B 0%, #b87d15 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(222, 153, 27, 0.4);
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(222, 153, 27, 0.6);
            color: #ffffff;
        }

        .btn-secondary-custom {
            background: #6c757d;
            color: white;
            box-shadow: 0 8px 20px rgba(108, 117, 125, 0.3);
        }

        .btn-secondary-custom:hover {
            background: #5a6268;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(108, 117, 125, 0.5);
        }

        .btn-outline-custom {
            background: transparent;
            color: #DE991B;
            border: 3px solid #DE991B;
        }

        .btn-outline-custom:hover {
            background: #DE991B;
            color: white;
            transform: translateY(-3px);
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
        }

        .progress-overview {
            text-align: center;
            margin-bottom: 30px;
        }

        .progress-bar-custom {
            width: 100%;
            height: 8px;
            background: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
            margin: 15px 0;
        }

        .progress-fill-custom {
            height: 100%;
            background: linear-gradient(90deg, #DE991B, #f4b942);
            border-radius: 10px;
            transition: width 0.5s ease;
            box-shadow: 0 0 15px rgba(222, 153, 27, 0.5);
        }

        .char-counter {
            font-size: 12px;
            color: #6c757d;
            text-align: right;
            margin-top: 5px;
        }

        .char-counter.warning {
            color: #fd7e14;
        }

        .char-counter.danger {
            color: #dc3545;
        }

        /* Enhanced Error Message Styling */
        .error-message {
            display: block;
            width: 100%;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #dc3545;
            font-weight: 500;
            padding: 0.375rem 0.75rem;
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.3);
            border-radius: 0.375rem;
            animation: errorSlideIn 0.3s ease-out;
        }

        @keyframes errorSlideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .input-group .form-control.is-invalid {
            background-position: right calc(0.375em + 0.1875rem + 2.25rem) center;
        }

        .file-upload-area.is-invalid {
            border-color: #dc3545;
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%);
        }

        .validation-success {
            color: #28a745;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-control.is-valid,
        .form-select.is-valid {
            border-color: #28a745;
        }

        /* Select2 Customization */
        .select2-container--default .select2-selection--single {
            height: 100px;
            border: 2px solid #e9ecef;
            background: white;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 46px;
            padding-left: 16px;
            font-size: 16px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 12px;
            right: 16px;
        }

        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #DE991B;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-content {
                padding: 30px 20px;
            }

            .form-section {
                padding: 25px 20px;
            }

            .steps-nav {
                gap: 15px;
            }

            .step-circle {
                width: 50px;
                height: 50px;
                font-size: 16px;
            }

            .step-connector {
                width: 60px;
            }

            .navigation-buttons {
                flex-direction: column;
                gap: 15px;
            }

            .btn-custom {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .step-title {
                font-size: 14px;
            }

            .step-description {
                font-size: 11px;
            }

            .section-title {
                font-size: 20px;
            }
        }
    </style>
@endsection

@section('content')
    <x-app.header />

    <div class="store-profile-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="profile-card">
                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold" style="position: relative; z-index: 2; color: #ffffff;">Store Profile
                                    Setup</h2>
                                <p class="mb-0" style="position: relative; z-index: 2; opacity: 0.9;">Complete your store
                                    profile to start selling</p>
                            </div>

                            <div class="steps-nav">
                                <div class="step active" data-step="1">
                                    <div class="step-circle">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="step-title">Basic Info</div>
                                    <div class="step-description">Store Details</div>
                                </div>

                                <div class="step-connector"></div>

                                <div class="step" data-step="2">
                                    <div class="step-circle">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="step-title">Company</div>
                                    <div class="step-description">Business Info</div>
                                </div>

                                <div class="step-connector"></div>

                                <div class="step" data-step="3">
                                    <div class="step-circle">
                                        <i class="fas fa-images"></i>
                                    </div>
                                    <div class="step-title">Branding</div>
                                    <div class="step-description">Logo & Banner</div>
                                </div>

                                <div class="step-connector"></div>

                                <div class="step" data-step="4">
                                    <div class="step-circle">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="step-title">Location</div>
                                    <div class="step-description">Address Info</div>
                                </div>
                            </div>

                            <div class="progress-overview">
                                <div class="progress-bar-custom">
                                    <div class="progress-fill-custom" id="progressFill" style="width: 25%;"></div>
                                </div>
                                <small style="position: relative; z-index: 2; opacity: 0.9;">Step <span
                                        id="currentStep">1</span> of 4 - <span id="progressText">25%</span> Complete</small>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <div class="form-content">
                            <form id="storeProfileForm" method="POST" action="{{ route('store.profile.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Step 1: Basic Store Information -->
                                <div class="step-form active" id="step1">
                                    <div class="form-section">
                                        <h3 class="section-title">
                                            <i class="fas fa-store"></i>
                                            Basic Store Information
                                        </h3>

                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="form-label">
                                                        Store Name <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-store"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" placeholder="Enter your store name" required
                                                            value="{{ old('name') }}" maxlength="100">
                                                    </div>
                                                    <div class="char-counter">
                                                        <span id="nameCounter">0</span>/100 characters
                                                    </div>
                                                    @error('name')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email" class="form-label">
                                                        Store Email <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-envelope"></i>
                                                        </span>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" placeholder="store@example.com" required
                                                            value="{{ old('email') }}">
                                                    </div>
                                                    @error('email')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label">
                                                        Phone Number <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-phone"></i>
                                                        </span>
                                                        <input type="tel" class="form-control" id="phone"
                                                            name="phone" placeholder="+1 (555) 123-4567" required
                                                            value="{{ old('phone') }}">
                                                    </div>
                                                    @error('phone')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="short_description" class="form-label">
                                                        Short Description <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-quote-left"></i>
                                                        </span>
                                                        <textarea class="form-control" id="short_description" name="short_description" rows="3"
                                                            placeholder="Brief description of your store (max 250 characters)" required maxlength="250">{{ old('short_description') }}</textarea>
                                                    </div>
                                                    <div class="char-counter">
                                                        <span id="shortDescCounter">0</span>/250 characters
                                                    </div>
                                                    @error('short_description')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description" class="form-label">
                                                        Detailed Description <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control" id="description" name="description" rows="6"
                                                        placeholder="Detailed description of your store, products, and services" required maxlength="1000">{{ old('description') }}</textarea>
                                                    <div class="char-counter">
                                                        <span id="descCounter">0</span>/1000 characters
                                                    </div>
                                                    @error('description')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2: Company Information -->
                                <div class="step-form" id="step2">
                                    <div class="form-section">
                                        <h3 class="section-title">
                                            <i class="fas fa-building"></i>
                                            Company Information
                                        </h3>

                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_name" class="form-label">
                                                        Company Name <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-building"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="company_name"
                                                            name="company_name" placeholder="Enter your company name"
                                                            required value="{{ old('company_name') }}" maxlength="150">
                                                    </div>
                                                    <div class="char-counter">
                                                        <span id="companyNameCounter">0</span>/150 characters
                                                    </div>
                                                    @error('company_name')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company_registration" class="form-label">
                                                        Company Registration Number
                                                        <small class="text-muted">(Optional)</small>
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-certificate"></i>
                                                        </span>
                                                        <input type="text" class="form-control"
                                                            id="company_registration" name="company_registration"
                                                            placeholder="Company registration number"
                                                            value="{{ old('company_registration') }}" maxlength="50">
                                                    </div>
                                                    <div class="char-counter">
                                                        <span id="companyRegCounter">0</span>/50 characters
                                                    </div>
                                                    @error('company_registration')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="alert alert-info mt-4" style="border-radius: 15px; border: none;">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-info-circle me-3" style="font-size: 1.5rem;"></i>
                                                <div>
                                                    <strong>Business Information</strong><br>
                                                    <small>Provide accurate company details for verification and legal
                                                        compliance.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3: Branding (Logo & Banner) -->
                                <div class="step-form" id="step3">
                                    <div class="form-section">
                                        <h3 class="section-title">
                                            <i class="fas fa-images"></i>
                                            Store Branding
                                        </h3>

                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Store Logo <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="file-upload-area"
                                                        onclick="document.getElementById('logo').click()">
                                                        <div class="upload-icon">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                        </div>
                                                        <h5 class="fw-bold text-dark">Upload Store Logo</h5>
                                                        <p class="text-muted mb-2">Drag & drop or click to browse</p>
                                                        <small class="text-muted">Recommended: 300x300px, Max: 2MB (JPG,
                                                            PNG)</small>
                                                        <input type="file" id="logo" name="logo"
                                                            accept="image/*" style="display: none;" required>
                                                        <div id="logoPreview" class="mt-3"></div>
                                                    </div>
                                                    @error('logo')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Store Banner <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="file-upload-area"
                                                        onclick="document.getElementById('banner').click()">
                                                        <div class="upload-icon">
                                                            <i class="fas fa-image"></i>
                                                        </div>
                                                        <h5 class="fw-bold text-dark">Upload Store Banner</h5>
                                                        <p class="text-muted mb-2">Drag & drop or click to browse</p>
                                                        <small class="text-muted">Recommended: 1200x400px, Max: 5MB (JPG,
                                                            PNG)</small>
                                                        <input type="file" id="banner" name="banner"
                                                            accept="image/*" style="display: none;" required>
                                                        <div id="bannerPreview" class="mt-3"></div>
                                                    </div>
                                                    @error('banner')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="alert alert-warning mt-4" style="border-radius: 15px; border: none;">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-palette me-3" style="font-size: 1.5rem;"></i>
                                                <div>
                                                    <strong>Branding Guidelines</strong><br>
                                                    <small>Use high-quality images that represent your brand. Logo should be
                                                        square, banner should be landscape orientation.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4: Location Information -->
                                <div class="step-form" id="step4">
                                    <div class="form-section">
                                        <h3 class="section-title">
                                            <i class="fas fa-map-marker-alt"></i>
                                            Store Location
                                        </h3>

                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="country" class="form-label">
                                                        Country <span class="text-danger">*</span>
                                                    </label>
                                                    <select class="form-select" id="country" name="country" required>
                                                        <option value="">Select Country</option>
                                                    </select>
                                                    @error('country')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="state" class="form-label">
                                                        State/Province <span class="text-danger">*</span>
                                                    </label>
                                                    <select class="form-select" id="state" name="state" required>
                                                        <option value="">Select State</option>
                                                    </select>
                                                    @error('state')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="city" class="form-label">
                                                        City <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-city"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="city"
                                                            name="city" placeholder="Enter city name" required
                                                            value="{{ old('city') }}" maxlength="100">
                                                    </div>
                                                    @error('city')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="post_code" class="form-label">
                                                        Postal/ZIP Code <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-mail-bulk"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="post_code"
                                                            name="post_code" placeholder="Enter postal code" required
                                                            value="{{ old('post_code') }}" maxlength="20">
                                                    </div>
                                                    @error('post_code')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="alert alert-success mt-4" style="border-radius: 15px; border: none;">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                                                <div>
                                                    <strong>Almost Done!</strong><br>
                                                    <small>Complete your location information to finish setting up your
                                                        store profile.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="navigation-buttons">
                                    <button type="button" id="prevBtn" class="btn btn-secondary-custom btn-custom"
                                        style="display: none;">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Previous
                                    </button>

                                    <div></div> <!-- Spacer -->

                                    <button type="button" id="nextBtn" class="btn btn-primary-custom btn-custom">
                                        Next
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </button>

                                    <button type="submit" id="submitBtn" class="btn btn-primary-custom btn-custom"
                                        style="display: none;">
                                        <i class="fas fa-check me-2"></i>
                                        Complete Setup
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Override problematic functions to prevent errors
        if (typeof ecAccessCookie === 'undefined') {
            window.ecAccessCookie = function() {
                return '';
            };
        }

        if (typeof ecCreateCookie === 'undefined') {
            window.ecCreateCookie = function() {
                return '';
            };
        }

        // Disable slider functionality if it causes issues
        if (typeof jQuery !== 'undefined') {
            jQuery.fn.slider = function() {
                return this;
            };
        }

        let currentStep = 1;
        const totalSteps = 4;

        // Use jQuery ready instead of DOMContentLoaded to ensure all scripts are loaded
        $(document).ready(function() {
            // Add a small delay to ensure all scripts are properly loaded
            setTimeout(function() {
                initializeStoreProfile();
            }, 100);
        });

        function initializeStoreProfile() {
            try {
                initializeForm();
                loadCountries();
                setupFileUploads();
                setupCharCounters();
                initializeRealtimeValidation();
                updateUI();
            } catch (error) {
                console.warn('Store profile initialization warning:', error);
            }
        }

        function initializeForm() {
            document.getElementById('nextBtn').addEventListener('click', nextStep);
            document.getElementById('prevBtn').addEventListener('click', prevStep);

            // Initialize Select2 with error handling
            try {
                if (typeof $.fn.select2 !== 'undefined') {
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
                }
            } catch (error) {
                console.warn('Select2 initialization failed:', error);
                // Fallback to regular dropdowns
            }
        }

        function nextStep() {
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateUI();
                    animateStepTransition();
                }
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                updateUI();
                animateStepTransition();
            }
        }

        function updateUI() {
            // Update step indicators
            document.querySelectorAll('.step').forEach((step, index) => {
                const stepNumber = index + 1;
                step.classList.remove('active', 'completed');

                if (stepNumber < currentStep) {
                    step.classList.add('completed');
                    step.querySelector('.step-circle').innerHTML = '<i class="fas fa-check"></i>';
                } else if (stepNumber === currentStep) {
                    step.classList.add('active');
                    const icon = step.querySelector('.step-circle i');
                    if (icon) {
                        icon.className = getStepIcon(stepNumber);
                    }
                } else {
                    const icon = step.querySelector('.step-circle i');
                    if (icon) {
                        icon.className = getStepIcon(stepNumber);
                    }
                }
            });

            // Update step connectors
            document.querySelectorAll('.step-connector').forEach((connector, index) => {
                if (index + 1 < currentStep) {
                    connector.classList.add('active');
                } else {
                    connector.classList.remove('active');
                }
            });

            // Update progress bar
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progressFill').style.width = progress + '%';
            document.getElementById('currentStep').textContent = currentStep;
            document.getElementById('progressText').textContent = Math.round(progress) + '%';

            // Show/hide forms
            document.querySelectorAll('.step-form').forEach((form, index) => {
                if (index + 1 === currentStep) {
                    form.classList.add('active');
                } else {
                    form.classList.remove('active');
                }
            });

            // Update navigation buttons
            document.getElementById('prevBtn').style.display = currentStep > 1 ? 'block' : 'none';
            document.getElementById('nextBtn').style.display = currentStep < totalSteps ? 'block' : 'none';
            document.getElementById('submitBtn').style.display = currentStep === totalSteps ? 'block' : 'none';
        }

        function getStepIcon(stepNumber) {
            const icons = [
                'fas fa-store',
                'fas fa-building',
                'fas fa-images',
                'fas fa-map-marker-alt'
            ];
            return icons[stepNumber - 1];
        }

        function animateStepTransition() {
            const activeForm = document.querySelector('.step-form.active');
            if (activeForm) {
                activeForm.style.opacity = '0';
                activeForm.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    activeForm.style.opacity = '1';
                    activeForm.style.transform = 'translateY(0)';
                }, 100);
            }
        }

        function validateStep(step) {
            let isValid = true;
            const stepForm = document.getElementById(`step${step}`);
            const requiredFields = stepForm.querySelectorAll('[required]');

            // Clear all previous errors
            clearAllErrors(stepForm);

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    markFieldAsInvalid(field, 'This field is required');
                    isValid = false;
                } else {
                    markFieldAsValid(field);
                }
            });

            // Additional validation for specific steps
            if (step === 1) {
                isValid = validateStep1() && isValid;
            } else if (step === 3) {
                isValid = validateStep3() && isValid;
            }

            if (!isValid) {
                showNotification('Please fix the errors below before continuing', 'error');
                scrollToFirstError(stepForm);
            }

            return isValid;
        }

        function validateStep1() {
            let isValid = true;

            // Validate email format
            const email = document.getElementById('email');
            if (email.value && !isValidEmail(email.value)) {
                markFieldAsInvalid(email, 'Please enter a valid email address');
                isValid = false;
            } else if (email.value) {
                markFieldAsValid(email);
            }

            // Validate phone format
            const phone = document.getElementById('phone');
            if (phone.value && !isValidPhone(phone.value)) {
                markFieldAsInvalid(phone, 'Please enter a valid phone number (e.g., +1234567890)');
                isValid = false;
            } else if (phone.value) {
                markFieldAsValid(phone);
            }

            // Validate store name length
            const storeName = document.getElementById('name');
            if (storeName.value && storeName.value.length < 3) {
                markFieldAsInvalid(storeName, 'Store name must be at least 3 characters long');
                isValid = false;
            }

            // Validate descriptions
            const shortDesc = document.getElementById('short_description');
            if (shortDesc.value && shortDesc.value.length < 10) {
                markFieldAsInvalid(shortDesc, 'Short description must be at least 10 characters long');
                isValid = false;
            }

            const desc = document.getElementById('description');
            if (desc.value && desc.value.length < 20) {
                markFieldAsInvalid(desc, 'Detailed description must be at least 20 characters long');
                isValid = false;
            }

            return isValid;
        }

        function validateStep3() {
            let isValid = true;

            const logo = document.getElementById('logo');
            const banner = document.getElementById('banner');
            const logoArea = logo.closest('.file-upload-area');
            const bannerArea = banner.closest('.file-upload-area');

            if (!logo.files.length) {
                markFileUploadAsInvalid(logoArea, 'Please upload a store logo');
                isValid = false;
            } else {
                markFileUploadAsValid(logoArea, 'Logo uploaded successfully');
            }

            if (!banner.files.length) {
                markFileUploadAsInvalid(bannerArea, 'Please upload a store banner');
                isValid = false;
            } else {
                markFileUploadAsValid(bannerArea, 'Banner uploaded successfully');
            }

            return isValid;
        }

        function markFieldAsInvalid(field, message) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');

            // Remove existing error message
            removeErrorMessage(field);

            // Add new error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.innerHTML = `<i class="fas fa-exclamation-triangle me-2"></i>${message}`;

            // Insert after the input group or field
            const inputGroup = field.closest('.input-group');
            const insertAfter = inputGroup || field;
            insertAfter.parentNode.insertBefore(errorDiv, insertAfter.nextSibling);
        }

        function markFieldAsValid(field) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');

            // Remove error message
            removeErrorMessage(field);

            // Add success indicator for important fields
            if (['email', 'phone', 'name'].includes(field.id)) {
                const successDiv = document.createElement('div');
                successDiv.className = 'validation-success';
                successDiv.innerHTML = `<i class="fas fa-check-circle"></i>Looks good!`;

                const inputGroup = field.closest('.input-group');
                const insertAfter = inputGroup || field;
                insertAfter.parentNode.insertBefore(successDiv, insertAfter.nextSibling);

                // Remove success message after 3 seconds
                setTimeout(() => {
                    if (successDiv.parentNode) {
                        successDiv.parentNode.removeChild(successDiv);
                    }
                }, 3000);
            }
        }

        function markFileUploadAsInvalid(uploadArea, message) {
            uploadArea.classList.add('is-invalid');
            uploadArea.classList.remove('is-valid');

            // Remove existing error message
            const existingError = uploadArea.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }

            // Add new error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.innerHTML = `<i class="fas fa-exclamation-triangle me-2"></i>${message}`;
            uploadArea.parentNode.appendChild(errorDiv);
        }

        function markFileUploadAsValid(uploadArea, message) {
            uploadArea.classList.remove('is-invalid');
            uploadArea.classList.add('is-valid');

            // Remove error message
            const existingError = uploadArea.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
        }

        function removeErrorMessage(field) {
            const inputGroup = field.closest('.input-group');
            const container = inputGroup ? inputGroup.parentNode : field.parentNode;
            const existingError = container.querySelector('.error-message');
            const existingSuccess = container.querySelector('.validation-success');

            if (existingError) {
                existingError.remove();
            }
            if (existingSuccess) {
                existingSuccess.remove();
            }
        }

        function clearAllErrors(container) {
            container.querySelectorAll('.is-invalid').forEach(field => {
                field.classList.remove('is-invalid');
            });
            container.querySelectorAll('.is-valid').forEach(field => {
                field.classList.remove('is-valid');
            });
            container.querySelectorAll('.error-message').forEach(error => {
                error.remove();
            });
            container.querySelectorAll('.validation-success').forEach(success => {
                success.remove();
            });
        }

        function scrollToFirstError(container) {
            const firstError = container.querySelector('.is-invalid');
            if (firstError) {
                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                // Focus on the field after scrolling
                setTimeout(() => {
                    firstError.focus();
                }, 500);
            }
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function isValidPhone(phone) {
            const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
            return phoneRegex.test(phone.replace(/\s/g, ''));
        }

        function setupFileUploads() {
            setupFileUpload('logo', 'logoPreview', 2 * 1024 * 1024, ['image/jpeg', 'image/png']);
            setupFileUpload('banner', 'bannerPreview', 5 * 1024 * 1024, ['image/jpeg', 'image/png']);
        }

        function setupFileUpload(inputId, previewId, maxSize, allowedTypes) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const uploadArea = input.parentNode;

            input.addEventListener('change', function(e) {
                handleFileSelect(e, preview, maxSize, allowedTypes);
            });

            // Drag and drop functionality
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.classList.add('dragover');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('dragover');

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    input.files = files;
                    handleFileSelect({
                        target: input
                    }, preview, maxSize, allowedTypes);
                }
            });
        }

        function handleFileSelect(event, preview, maxSize, allowedTypes) {
            const file = event.target.files[0];
            if (!file) return;

            // Validate file type
            if (!allowedTypes.includes(file.type)) {
                showNotification('Please select a valid image file (JPG or PNG)', 'error');
                event.target.value = '';
                return;
            }

            // Validate file size
            if (file.size > maxSize) {
                const maxSizeMB = maxSize / (1024 * 1024);
                showNotification(`File size must be less than ${maxSizeMB}MB`, 'error');
                event.target.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" class="image-preview" alt="Preview">
                    <p class="text-success mt-2 mb-0">
                        <i class="fas fa-check-circle me-1"></i>
                        File uploaded successfully
                    </p>
                `;
            };
            reader.readAsDataURL(file);
        }

        function setupCharCounters() {
            const counters = [{
                    input: 'name',
                    counter: 'nameCounter',
                    max: 100
                },
                {
                    input: 'short_description',
                    counter: 'shortDescCounter',
                    max: 250
                },
                {
                    input: 'description',
                    counter: 'descCounter',
                    max: 1000
                },
                {
                    input: 'company_name',
                    counter: 'companyNameCounter',
                    max: 150
                },
                {
                    input: 'company_registration',
                    counter: 'companyRegCounter',
                    max: 50
                }
            ];

            counters.forEach(({
                input,
                counter,
                max
            }) => {
                const inputElement = document.getElementById(input);
                const counterElement = document.getElementById(counter);

                if (inputElement && counterElement) {
                    inputElement.addEventListener('input', function() {
                        const length = this.value.length;
                        counterElement.textContent = length;

                        const counterParent = counterElement.parentNode;
                        counterParent.classList.remove('warning', 'danger');

                        if (length > max * 0.9) {
                            counterParent.classList.add('danger');
                        } else if (length > max * 0.7) {
                            counterParent.classList.add('warning');
                        }
                    });
                }
            });
        }

        function loadCountries() {
            fetch('https://countriesnow.space/api/v0.1/countries/positions')
                .then(response => response.json())
                .then(data => {
                    const countrySelect = document.getElementById('country');
                    countrySelect.innerHTML = '<option value="">Select Country</option>';

                    data.data.forEach(country => {
                        const option = document.createElement('option');
                        option.value = country.name;
                        option.textContent = country.name;
                        countrySelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error loading countries:', error);
                    showNotification('Error loading countries', 'error');
                });

            // Load states when country changes
            document.getElementById('country').addEventListener('change', function() {
                const selectedCountry = this.value;
                const stateSelect = document.getElementById('state');

                if (!selectedCountry) {
                    stateSelect.innerHTML = '<option value="">Select Country First</option>';
                    return;
                }

                stateSelect.innerHTML = '<option value="">Loading...</option>';
                stateSelect.disabled = true;

                fetch('https://countriesnow.space/api/v0.1/countries/states', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            country: selectedCountry
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        stateSelect.innerHTML = '<option value="">Select State</option>';

                        if (data.data && data.data.states.length > 0) {
                            data.data.states.forEach(state => {
                                const option = document.createElement('option');
                                option.value = state.name;
                                option.textContent = state.name;
                                stateSelect.appendChild(option);
                            });
                        } else {
                            stateSelect.innerHTML = '<option value="">No states found</option>';
                        }

                        stateSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error loading states:', error);
                        stateSelect.innerHTML = '<option value="">Error loading states</option>';
                        stateSelect.disabled = false;
                    });
            });
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                background: ${type === 'error' ? '#dc3545' : type === 'success' ? '#28a745' : '#DE991B'};
                color: white;
                border-radius: 8px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                z-index: 1000;
                font-weight: 600;
                max-width: 350px;
                transform: translateX(400px);
                transition: transform 0.3s ease;
            `;

            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas ${type === 'error' ? 'fa-exclamation-triangle' : type === 'success' ? 'fa-check-circle' : 'fa-info-circle'}"></i>
                    ${message}
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            setTimeout(() => {
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 4000);
        }

        function initializeRealtimeValidation() {
            // Real-time email validation
            document.getElementById('email').addEventListener('blur', function() {
                if (this.value) {
                    if (isValidEmail(this.value)) {
                        markFieldAsValid(this);
                    } else {
                        markFieldAsInvalid(this, 'Please enter a valid email address');
                    }
                }
            });

            // Real-time phone validation
            document.getElementById('phone').addEventListener('blur', function() {
                if (this.value) {
                    if (isValidPhone(this.value)) {
                        markFieldAsValid(this);
                    } else {
                        markFieldAsInvalid(this, 'Please enter a valid phone number (e.g., +1234567890)');
                    }
                }
            });

            // Real-time store name validation
            document.getElementById('name').addEventListener('blur', function() {
                if (this.value) {
                    if (this.value.length >= 3) {
                        markFieldAsValid(this);
                    } else {
                        markFieldAsInvalid(this, 'Store name must be at least 3 characters long');
                    }
                }
            });

            // Real-time company name validation
            document.getElementById('company_name').addEventListener('blur', function() {
                if (this.value && this.value.length >= 2) {
                    markFieldAsValid(this);
                }
            });

            // Real-time post code validation
            document.getElementById('post_code').addEventListener('blur', function() {
                if (this.value && this.value.length >= 3) {
                    markFieldAsValid(this);
                }
            });

            // Real-time city validation
            document.getElementById('city').addEventListener('blur', function() {
                if (this.value && this.value.length >= 2) {
                    markFieldAsValid(this);
                }
            });

            // Description validation with character counting
            document.getElementById('short_description').addEventListener('input', function() {
                const length = this.value.length;
                if (length >= 10) {
                    markFieldAsValid(this);
                } else if (length > 0 && length < 10) {
                    markFieldAsInvalid(this, 'Short description must be at least 10 characters long');
                }
            });

            document.getElementById('description').addEventListener('input', function() {
                const length = this.value.length;
                if (length >= 20) {
                    markFieldAsValid(this);
                } else if (length > 0 && length < 20) {
                    markFieldAsInvalid(this, 'Detailed description must be at least 20 characters long');
                }
            });

            // Clear error state when user starts typing in required fields
            document.querySelectorAll('input[required], textarea[required], select[required]').forEach(field => {
                field.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                        removeErrorMessage(this);
                    }
                });

                // Add blur validation for required fields
                field.addEventListener('blur', function() {
                    if (!this.value.trim()) {
                        markFieldAsInvalid(this, 'This field is required');
                    }
                });
            });

            // Country and state validation
            document.getElementById('country').addEventListener('change', function() {
                if (this.value) {
                    markFieldAsValid(this);
                }
            });

            document.getElementById('state').addEventListener('change', function() {
                if (this.value) {
                    markFieldAsValid(this);
                }
            });

            // File upload validation
            document.getElementById('logo').addEventListener('change', function() {
                const uploadArea = this.closest('.file-upload-area');
                if (this.files.length > 0) {
                    markFileUploadAsValid(uploadArea, 'Logo uploaded successfully');
                }
            });

            document.getElementById('banner').addEventListener('change', function() {
                const uploadArea = this.closest('.file-upload-area');
                if (this.files.length > 0) {
                    markFileUploadAsValid(uploadArea, 'Banner uploaded successfully');
                }
            });
        }

        // Form submission with error handling
        $(document).ready(function() {
            $('#storeProfileForm').on('submit', function(e) {
                e.preventDefault();

                try {
                    if (validateStep(currentStep)) {
                        showNotification('Submitting store profile...', 'info');

                        // Add loading state to submit button
                        const submitBtn = document.getElementById('submitBtn');
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
                        submitBtn.disabled = true;

                        // Actually submit the form
                        this.submit();
                    }
                } catch (error) {
                    console.error('Form submission error:', error);
                    showNotification('An error occurred. Please try again.', 'error');
                }
            });
        });
    </script>
@endsection
