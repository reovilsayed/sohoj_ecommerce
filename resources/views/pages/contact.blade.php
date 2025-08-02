@extends('layouts.app')
@section('content')
<x-app.header/>

<!-- Contact Hero Section -->
<div class="contact-hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="contact-hero-title">Contact Us</h1>
                <p class="contact-hero-subtitle text-dark">We're here to help! Get in touch with our team for any questions, support, or feedback about our multi-vendor marketplace.</p>
                <div class="contact-badges mt-4">
                    <span class="badge bg-success me-2"><i class="fas fa-clock me-1"></i>24/7 Support</span>
                    <span class="badge bg-primary me-2"><i class="fas fa-reply me-1"></i>Quick Response</span>
                    <span class="badge bg-info"><i class="fas fa-globe me-1"></i>Global Support</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Content Section -->
<div class="contact-content-section">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-8 mb-5">
                <div class="contact-form-wrapper">
                    <div class="section-header mb-4">
                        <h2><i class="fas fa-envelope me-3"></i>Send us a Message</h2>
                        <p class="text-muted">Fill out the form below and we'll get back to you as soon as possible.</p>
                    </div>
                    
                    <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                            <select class="form-select" id="subject" name="subject" required>
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="support">Technical Support</option>
                                <option value="vendor">Vendor Related</option>
                                <option value="order">Order Issue</option>
                                <option value="payment">Payment Issue</option>
                                <option value="shipping">Shipping & Delivery</option>
                                <option value="refund">Refund Request</option>
                                <option value="partnership">Partnership Opportunity</option>
                                <option value="feedback">Feedback & Suggestions</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="order_number" class="form-label">Order Number (if applicable)</label>
                            <input type="text" class="form-control" id="order_number" name="order_number" placeholder="e.g., #ORD-12345">
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="6" placeholder="Please describe your inquiry in detail..." required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="privacy_agree" name="privacy_agree" required>
                                <label class="form-check-label" for="privacy_agree">
                                    I agree to the <a href="{{ route('privacy.policy') }}" target="_blank">Privacy Policy</a> and consent to the processing of my personal data. <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-paper-plane me-2"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Contact Information Sidebar -->
            <div class="col-lg-4">
                <div class="contact-info-sidebar">
                    <!-- Contact Methods -->
                    <div class="contact-info-card mb-4">
                        <h4><i class="fas fa-phone me-2"></i>Phone Support</h4>
                        <div class="contact-method">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h6>Customer Service</h6>
                                <p class="mb-1">+1 (555) 123-4567</p>
                                <small class="text-muted">Mon-Fri: 9AM-6PM EST</small>
                            </div>
                        </div>
                        <div class="contact-method">
                            <div class="contact-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="contact-details">
                                <h6>Technical Support</h6>
                                <p class="mb-1">+1 (555) 123-4568</p>
                                <small class="text-muted">24/7 Available</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Email Support -->
                    <div class="contact-info-card mb-4">
                        <h4><i class="fas fa-envelope me-2"></i>Email Support</h4>
                        <div class="email-list">
                            <div class="email-item">
                                <strong>General Inquiries:</strong><br>
                                <a href="mailto:info@sohojecommerce.com">info@sohojecommerce.com</a>
                            </div>
                            <div class="email-item">
                                <strong>Customer Support:</strong><br>
                                <a href="mailto:support@sohojecommerce.com">support@sohojecommerce.com</a>
                            </div>
                            <div class="email-item">
                                <strong>Vendor Support:</strong><br>
                                <a href="mailto:vendors@sohojecommerce.com">vendors@sohojecommerce.com</a>
                            </div>
                            <div class="email-item">
                                <strong>Partnership:</strong><br>
                                <a href="mailto:partnerships@sohojecommerce.com">partnerships@sohojecommerce.com</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Office Address -->
                    <div class="contact-info-card mb-4">
                        <h4><i class="fas fa-map-marker-alt me-2"></i>Visit Our Office</h4>
                        <div class="address-info">
                            <p class="mb-2">
                                <strong>Sohoj Ecommerce Headquarters</strong><br>
                                123 Commerce Street<br>
                                Business District<br>
                                City, State 12345<br>
                                United States
                            </p>
                            <div class="office-hours">
                                <h6>Office Hours:</h6>
                                <p class="mb-1">Monday - Friday: 9:00 AM - 6:00 PM</p>
                                <p class="mb-1">Saturday: 10:00 AM - 4:00 PM</p>
                                <p class="mb-0">Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="contact-info-card">
                        <h4><i class="fas fa-share-alt me-2"></i>Follow Us</h4>
                        <div class="social-links">
                            <a href="{{ Settings::setting('social_fb_link') }}" class="social-link facebook">
                                <i class="fab fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="{{ Settings::setting('social_twitter_link') }}" class="social-link twitter">
                                <i class="fab fa-twitter"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="{{ Settings::setting('social_inst_link') }}" class="social-link instagram">
                                <i class="fab fa-instagram"></i>
                                <span>Instagram</span>
                            </a>
                            <a href="{{ Settings::setting('social_linkedin') }}" class="social-link linkedin">
                                <i class="fab fa-linkedin-in"></i>
                                <span>LinkedIn</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- FAQ Quick Links -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="faq-quick-links">
                    <div class="section-header text-center mb-4">
                        <h3>Need Quick Answers?</h3>
                        <p class="text-muted">Check out our frequently asked questions for instant help</p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('faqs') }}#ordering" class="faq-quick-link">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Ordering & Payment</span>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('faqs') }}#shipping" class="faq-quick-link">
                                <i class="fas fa-truck"></i>
                                <span>Shipping & Delivery</span>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('faqs') }}#returns" class="faq-quick-link">
                                <i class="fas fa-undo"></i>
                                <span>Returns & Exchanges</span>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('faqs') }}#general" class="faq-quick-link">
                                <i class="fas fa-question-circle"></i>
                                <span>General Information</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Response Time Information -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="response-time-info">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4><i class="fas fa-clock me-2"></i>Response Times</h4>
                            <p class="mb-0">We strive to respond to all inquiries promptly. Here are our typical response times:</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="response-stats">
                                <div class="stat-item">
                                    <span class="stat-number">< 2 hours</span>
                                    <span class="stat-label">Urgent Issues</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">< 24 hours</span>
                                    <span class="stat-label">General Inquiries</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Custom Styles -->
<style>
/* Contact Hero Section */
.contact-hero-section {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 100px 0 80px;
    position: relative;
    overflow: hidden;
}

.contact-hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23pattern)"/></svg>');
}

.contact-hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    position: relative;
    z-index: 2;
}

.contact-hero-subtitle {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
    opacity: 0.9;
}

.contact-badges {
    position: relative;
    z-index: 2;
}

.contact-badges .badge {
    font-size: 0.9rem;
    padding: 8px 16px;
    border-radius: 20px;
}

/* Contact Content Section */
.contact-content-section {
    padding: 80px 0;
    background: #f8f9fa;
}

/* Contact Form */
.contact-form-wrapper {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}

.section-header h2 {
    color: #2d3748;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.contact-form .form-label {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 8px;
}

.contact-form .form-control,
.contact-form .form-select {
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.contact-form .form-control:focus,
.contact-form .form-select:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.contact-form textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.contact-form .btn-primary {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    border-radius: 50px;
    padding: 12px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.contact-form .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
}

/* Contact Info Sidebar */
.contact-info-sidebar {
    position: sticky;
    top: 100px;
}

.contact-info-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.contact-info-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.contact-info-card h4 {
    color: #2d3748;
    font-weight: 700;
    margin-bottom: 20px;
    font-size: 1.3rem;
}

.contact-method {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
}

.contact-method:last-child {
    margin-bottom: 0;
}

.contact-method .contact-icon {
    width: 50px;
    height: 50px;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.contact-method .contact-icon i {
    color: white;
    font-size: 1.2rem;
}

.contact-method .contact-details h6 {
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 5px;
}

.contact-method .contact-details p {
    color: #4a5568;
    margin: 0;
    font-weight: 500;
}

/* Email List */
.email-list {
    space-y: 15px;
}

.email-item {
    margin-bottom: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.email-item:last-child {
    margin-bottom: 0;
}

.email-item strong {
    color: #2d3748;
    display: block;
    margin-bottom: 5px;
}

.email-item a {
    color: #28a745;
    text-decoration: none;
    font-weight: 500;
}

.email-item a:hover {
    text-decoration: underline;
}

/* Address Info */
.address-info p {
    color: #4a5568;
    line-height: 1.6;
}

.office-hours h6 {
    color: #2d3748;
    font-weight: 600;
    margin-top: 15px;
    margin-bottom: 10px;
}

.office-hours p {
    color: #4a5568;
    font-size: 0.95rem;
}

/* Social Links */
.social-links {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.social-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    background: #f8f9fa;
    border-radius: 8px;
    text-decoration: none;
    color: #4a5568;
    transition: all 0.3s ease;
}

.social-link:hover {
    color: white;
    transform: translateX(5px);
}

.social-link.facebook:hover { background: #3b5998; }
.social-link.twitter:hover { background: #1da1f2; }
.social-link.instagram:hover { background: #e4405f; }
.social-link.linkedin:hover { background: #0077b5; }

.social-link i {
    font-size: 1.2rem;
    width: 20px;
    text-align: center;
}

/* FAQ Quick Links */
.faq-quick-links {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.faq-quick-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 25px 15px;
    background: #f8f9fa;
    border-radius: 12px;
    text-decoration: none;
    color: #4a5568;
    transition: all 0.3s ease;
    height: 100%;
}

.faq-quick-link:hover {
    background: #28a745;
    color: white;
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
}

.faq-quick-link i {
    font-size: 2rem;
    margin-bottom: 10px;
}

.faq-quick-link span {
    font-weight: 600;
    font-size: 0.95rem;
}

/* Response Time Info */
.response-time-info {
    background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
    border-radius: 15px;
    padding: 30px;
    border-left: 5px solid #28a745;
}

.response-time-info h4 {
    color: #2d3748;
    font-weight: 700;
    margin-bottom: 10px;
}

.response-stats {
    display: flex;
    gap: 30px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 800;
    color: #28a745;
}

.stat-label {
    font-size: 0.85rem;
    color: #6c757d;
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-hero-title {
        font-size: 2.5rem;
    }
    
    .contact-hero-subtitle {
        font-size: 1rem;
    }
    
    .contact-form-wrapper {
        padding: 25px;
    }
    
    .contact-info-sidebar {
        position: static;
        margin-top: 30px;
    }
    
    .contact-info-card {
        padding: 20px;
    }
    
    .contact-method {
        flex-direction: column;
        text-align: center;
    }
    
    .response-stats {
        flex-direction: column;
        gap: 15px;
        margin-top: 20px;
    }
    
    .faq-quick-links {
        padding: 25px;
    }
    
    .response-time-info {
        padding: 20px;
    }
}

/* Form Validation Styles */
.form-control.is-invalid,
.form-select.is-invalid {
    border-color: #dc3545;
}

.form-control.is-valid,
.form-select.is-valid {
    border-color: #28a745;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
}

.valid-feedback {
    color: #28a745;
    font-size: 0.875rem;
    margin-top: 5px;
}
</style>

<!-- Contact JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const contactForm = document.querySelector('.contact-form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            const requiredFields = contactForm.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                    field.classList.add('is-valid');
                }
            });
            
            // Email validation
            const emailField = contactForm.querySelector('#email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (emailField.value && !emailRegex.test(emailField.value)) {
                emailField.classList.add('is-invalid');
                isValid = false;
            }
            
            if (isValid) {
                // Show success message (you can replace this with actual form submission)
                alert('Thank you for your message! We will get back to you soon.');
                contactForm.reset();
                
                // Remove validation classes
                contactForm.querySelectorAll('.is-valid, .is-invalid').forEach(field => {
                    field.classList.remove('is-valid', 'is-invalid');
                });
            }
        });
        
        // Real-time validation
        const inputs = contactForm.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                } else if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });
    }
    
    // Smooth scrolling for FAQ links
    const faqLinks = document.querySelectorAll('.faq-quick-link');
    faqLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Let the default behavior handle the navigation to FAQ page
        });
    });
});
</script>
@endsection