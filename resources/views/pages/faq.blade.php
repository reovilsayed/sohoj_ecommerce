@extends('layouts.app')
@section('content')
<x-app.header/>
<!-- FAQ Hero Section -->
<div class="faq-hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="faq-hero-title">{{ $faqs->title }}</h1>
                <p class="faq-hero-subtitle text-dark">{{ $faqs->excerpt }}</p>
                {{-- <div class="faq-search-box mt-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="faqSearch" placeholder="Search for answers...">
                        <button class="btn searchBtn btn-primary h-auto" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<!-- FAQ Content Section -->
<div class="faq-content-section">
    <div class="container">
        {!! $faqs->body !!}
    </div>
</div>


<!-- FAQ Custom Styles -->
<style>
/* FAQ Hero Section */
.faq-hero-section {
    color: white;
    padding: 100px 0 80px;
    position: relative;
    overflow: hidden;
}

.faq-hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23pattern)"/></svg>');
}

.faq-hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    position: relative;
    z-index: 2;
}

.faq-search-box {
    max-width: 500px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.faq-search-box .form-control {
    border-radius: 50px 0 0 50px;
    border: none;
    padding: 15px 25px;
    font-size: 1.1rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.faq-search-box .searchBtn {
    border-radius: 0 50px 50px 0;
    padding: 2px 25px;
    background: #ff6b6b;
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

/* FAQ Content Section */
.faq-content-section {
    padding: 80px 0;
    background: #f8f9fa;
}

/* FAQ Categories */
.faq-categories {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    position: sticky;
    top: 100px;
}

.faq-category-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
}

.faq-category-list .list-group-item {
    border: none;
    border-radius: 10px;
    margin-bottom: 8px;
    transition: all 0.3s ease;
    padding: 15px 20px;
}

.faq-category-list .list-group-item:hover,
.faq-category-list .list-group-item.active {
    background: var(--accent-color);
    color: white;
    transform: translateX(5px);
}

/* FAQ Accordion */
.faq-accordion-wrapper {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}

.faq-item {
    border: none;
    margin-bottom: 20px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.faq-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.faq-item .accordion-header {
    border-radius: 15px;
}

.faq-item .accordion-button {
    background: white;
    border: none;
    padding: 25px 30px;
    font-weight: 600;
    font-size: 1.1rem;
    color: #333;
    border-radius: 15px;
    box-shadow: none;
}

.faq-item .accordion-button:not(.collapsed) {
    background: var(--accent-color);
    color: white;
    box-shadow: none;
}

.faq-item .accordion-button::after {
    background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23333'><path fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/></svg>");
    width: 1.5rem;
    height: 1.5rem;
}

.faq-item .accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='white'><path fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/></svg>");
}

.faq-question-icon {
    color: var(--accent-color);
    font-size: 1.2rem;
}

.faq-item .accordion-button:not(.collapsed) .faq-question-icon {
    color: white;
}

.faq-item .accordion-body {
    padding: 30px;
    border-top: 1px solid #f0f0f0;
}

.faq-answer {
    line-height: 1.8;
    color: #555;
    font-size: 1.05rem;
}

.faq-helpful {
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
}

/* Contact Support Section */
.faq-contact-section {
    /* background: linear-gradient(135deg, #f7faff 0%, #e8f2ff 100%); */
    position: relative;
    overflow: hidden;
}

.faq-contact-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 200%;
    background: radial-gradient(circle, rgba(102,126,234,0.05) 0%, transparent 70%);
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(-20px, -20px) rotate(2deg); }
}

/* Hero Contact Header */
.contact-hero {
    margin-bottom: 4rem;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    animation: pulse-badge 2s infinite;
}

@keyframes pulse-badge {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.hero-badge i {
    margin-right: 8px;
    font-size: 1rem;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.hero-description {
    font-size: 1.2rem;
    color: #718096;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
}

/* Support Cards V2 */
.support-card-v2 {
    background: white;
    border-radius: 24px;
    padding: 0;
    box-shadow: 0 20px 60px rgba(0,0,0,0.08);
    border: 1px solid rgba(255,255,255,0.8);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
}

.support-card-v2::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #ff6b6b 100%);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.support-card-v2:hover::before {
    transform: scaleX(1);
}

.support-card-v2:hover {
    transform: translateY(-8px);
    box-shadow: 0 30px 80px rgba(0,0,0,0.15);
}

.card-header-v2 {
    padding: 30px 30px 20px;
    position: relative;
}

.icon-wrapper {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    position: relative;
}

.chat-icon {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
}

.phone-icon {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
}

.icon-wrapper i {
    font-size: 1.8rem;
    color: white;
    z-index: 2;
}

.pulse-ring {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    border: 3px solid rgba(255,255,255,0.4);
    border-radius: 50%;
    animation: pulse-ring 2s infinite;
}

@keyframes pulse-ring {
    0% { transform: translate(-50%, -50%) scale(0.8); opacity: 1; }
    100% { transform: translate(-50%, -50%) scale(1.4); opacity: 0; }
}

.header-content h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 5px;
}

.header-content p {
    color: #718096;
    margin: 0;
    font-size: 1rem;
}

.status-indicator {
    position: absolute;
    top: 30px;
    right: 30px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.status-dot {
    width: 10px;
    height: 10px;
    background: #48bb78;
    border-radius: 50%;
    animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.status-text {
    font-size: 0.85rem;
    color: #48bb78;
    font-weight: 600;
}

.business-hours {
    position: absolute;
    top: 30px;
    right: 30px;
    display: flex;
    align-items: center;
    gap: 5px;
    color: #718096;
    font-size: 0.85rem;
}

.card-body-v2 {
    padding: 0 30px 30px;
}

.feature-highlights {
    margin-bottom: 25px;
}

.highlight-item {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    color: #4a5568;
    font-size: 0.9rem;
}

.highlight-item i {
    color: #667eea;
    font-size: 1rem;
    width: 16px;
}

.phone-number-display {
    text-align: center;
    margin-bottom: 20px;
    padding: 20px;
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    border-radius: 15px;
}

.number-large {
    font-size: 1.8rem;
    font-weight: 800;
    color: #2d3748;
    margin-bottom: 5px;
}

.number-description {
    color: #718096;
    font-size: 0.9rem;
}

.btn-v2 {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    width: 100%;
}

.btn-primary-v2 {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);
}

.btn-success-v2 {
    background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
    color: white;
    box-shadow: 0 8px 25px rgba(66, 153, 225, 0.3);
}

.btn-outline-v2 {
    border: 2px solid #667eea;
    color: #667eea;
    background: transparent;
}

.btn-v2:hover {
    transform: translateY(-2px);
    color: white;
}

.btn-primary-v2:hover {
    box-shadow: 0 12px 35px rgba(72, 187, 120, 0.4);
}

.btn-success-v2:hover {
    box-shadow: 0 12px 35px rgba(66, 153, 225, 0.4);
}

.btn-outline-v2:hover {
    background: #667eea;
    border-color: #667eea;
}

.btn-shine {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-v2:hover .btn-shine {
    left: 100%;
}

/* Secondary Support Cards */
.support-card-v2.email-support,
.support-card-v2.help-center,
.support-card-v2.community-support {
    padding: 30px;
    text-align: center;
}

.icon-wrapper-small {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.icon-wrapper-small i {
    font-size: 1.5rem;
    color: white;
}

.support-card-v2 h4 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 10px;
}

.support-card-v2 p {
    color: #718096;
    margin-bottom: 20px;
    line-height: 1.6;
}

.email-info {
    background: #f7fafc;
    border-radius: 12px;
    padding: 15px;
    margin-bottom: 20px;
}

.email-address {
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 5px;
}

.response-time {
    color: #718096;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.help-resources {
    margin-bottom: 20px;
}

.resource-item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-bottom: 8px;
    color: #4a5568;
    font-size: 0.9rem;
}

.resource-item i {
    color: #667eea;
    width: 16px;
}

.community-stats {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-bottom: 20px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 800;
    color: #2d3748;
}

.stat-label {
    font-size: 0.8rem;
    color: #718096;
}

/* Trust Section */
.trust-section {
    background: white;
    /* border-radius: 24px; */
    padding: 50px 40px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

.trust-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    /* background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #ff6b6b 100%); */
}

.trust-header {
    text-align: center;
    margin-bottom: 40px;
}

.trust-header h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 10px;
}

.trust-header p {
    color: #718096;
    font-size: 1.1rem;
}

.trust-indicators {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.trust-item {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 20px;
    background: #f7fafc;
    border-radius: 15px;
    transition: all 0.3s ease;
}

.trust-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.trust-icon {
    width: 50px;
    height: 50px;
    background: var(--accent-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.trust-icon i {
    color: white;
    font-size: 1.2rem;
}

.trust-content h5 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 5px;
}

.trust-content p {
    color: #718096;
    margin: 0;
    font-size: 0.9rem;
}

.faq-contact-buttons .btn {
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.faq-contact-buttons .btn-primary {
    background: #ff6b6b;
    border: none;
}

.faq-contact-buttons .btn-outline-primary {
    border-color: white;
    color: white;
}

.faq-contact-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    .faq-hero-title {
        font-size: 2.5rem;
    }
    
    .faq-hero-subtitle {
        font-size: 1rem;
    }
    
    .support-main-title {
        font-size: 2.2rem;
    }
    
    .support-subtitle {
        font-size: 1.1rem;
    }
    
    .support-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .support-card {
        padding: 30px 20px;
    }
    
    .card-icon {
        width: 60px;
        height: 60px;
    }
    
    .card-icon i {
        font-size: 1.5rem;
    }
    
    .support-card h4 {
        font-size: 1.3rem;
    }
    
    .btn-modern {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    .faq-accordion-wrapper {
        padding: 20px;
    }
    
    .faq-categories {
        padding: 20px;
        position: static;
    }
    
    .feature-badge {
        padding: 15px 10px;
    }
    
    .feature-badge i {
        font-size: 1.5rem;
    }
    
    .feature-badge span {
        font-size: 0.8rem;
    }
    
    .faq-contact-section {
        padding: 60px 0;
    }
}

/* Search Functionality */
.faq-item.hidden {
    display: none;
}

.no-results-message {
    background: white;
    border-radius: 15px;
    padding: 60px 40px;
    text-align: center;
}
</style>

<!-- FAQ JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('faqSearch');
    const faqItems = document.querySelectorAll('.faq-item');
    const noResults = document.getElementById('noResults');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let hasResults = false;
        
        faqItems.forEach(function(item) {
            const question = item.querySelector('.faq-question-text').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm) || searchTerm === '') {
                item.style.display = 'block';
                item.classList.remove('hidden');
                hasResults = true;
            } else {
                item.style.display = 'none';
                item.classList.add('hidden');
            }
        });
        
        noResults.style.display = hasResults || searchTerm === '' ? 'none' : 'block';
    });
    
    // Category filtering
    const categoryLinks = document.querySelectorAll('.faq-category-list a');
    
    categoryLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Update active category
            categoryLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            const category = this.dataset.category;
            
            faqItems.forEach(function(item) {
                const itemCategory = item.dataset.category;
                
                if (category === 'general' || itemCategory === category) {
                    item.style.display = 'block';
                    item.classList.remove('hidden');
                } else {
                    item.style.display = 'none';
                    item.classList.add('hidden');
                }
            });
            
            // Clear search
            searchInput.value = '';
            noResults.style.display = 'none';
        });
    });
});

// Helpful feedback function
function markHelpful(faqId, isHelpful) {
    // You can implement AJAX call here to save feedback
    const button = event.target.closest('button');
    const allButtons = button.parentNode.querySelectorAll('button');
    
    allButtons.forEach(btn => btn.classList.remove('btn-success', 'btn-danger'));
    
    if (isHelpful) {
        button.classList.add('btn-success');
        button.classList.remove('btn-outline-success');
    } else {
        button.classList.add('btn-danger');
        button.classList.remove('btn-outline-danger');
    }
    
    // Optional: Show thank you message
    setTimeout(() => {
        const feedback = button.parentNode;
        feedback.innerHTML = '<span class="text-success"><i class="fas fa-check me-1"></i>Thank you for your feedback!</span>';
    }, 500);
}
</script>
@endsection