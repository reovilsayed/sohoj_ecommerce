<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Account Verified</title>
    <style>
        /* Base Styles */
        :root {
            --primary: #DE991B;
            --primary-dark: #B87D15;
            --secondary: #2C3E50;
            --accent: #E67E22;
            --text: #333333;
            --light-bg: #FDF8F0;
            --border: #EDE5D7;
            --success-bg: #F0F7EB;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: var(--text);
            margin: 0;
            padding: 0;
            background-color: var(--light-bg);
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border);
        }

        /* Header */
        .header {
            text-align: center;
            padding: 40px 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            position: relative;
            overflow: hidden;
        }

        .header::after {
            content: "";
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .logo {
            max-width: 180px;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            position: relative;
            z-index: 2;
        }

        .subheader {
            font-size: 16px;
            opacity: 0.9;
            margin-top: 12px;
            position: relative;
            z-index: 2;
        }

        /* Content */
        .content {
            padding: 30px;
        }

        .verification-badge {
            text-align: center;
            margin: 30px 0;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            background-color: var(--success-bg);
            color: #2E7D32;
            padding: 14px 25px;
            border-radius: 50px;
            font-weight: 600;
            border: 1px dashed #A5D6A7;
            position: relative;
        }

        .badge-icon {
            background-color: var(--primary);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 16px;
        }

        .details-card {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 25px;
            margin: 30px 0;
            border-left: 4px solid var(--primary);
        }

        .detail-row {
            display: flex;
            margin-bottom: 15px;
        }

        .detail-label {
            font-weight: 600;
            width: 140px;
            color: var(--secondary);
            font-size: 14px;
        }

        .detail-value {
            flex: 1;
            font-weight: 500;
        }

        /* Next Steps */
        .next-steps {
            margin: 40px 0 30px;
        }

        .next-steps h3 {
            font-size: 20px;
            color: var(--secondary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border);
        }

        .step {
            display: flex;
            margin-bottom: 25px;
            align-items: flex-start;
        }

        .step-number {
            background-color: var(--primary);
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            font-weight: 700;
            font-size: 14px;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--secondary);
            font-size: 16px;
        }

        .step-desc {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        /* CTA */
        .cta {
            text-align: center;
            margin: 40px 0 30px;
        }

        .btn {
            display: inline-block;
            padding: 15px 35px;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(222, 153, 27, 0.3);
            border: none;
            font-size: 16px;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(222, 153, 27, 0.4);
        }

        /* Footer */
        .footer {
            padding: 25px;
            text-align: center;
            background-color: var(--light-bg);
            color: #666;
            font-size: 14px;
            border-top: 1px solid var(--border);
        }

        .support-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .footer-links {
            margin: 15px 0;
        }

        .footer-link {
            color: var(--primary-dark);
            text-decoration: none;
            margin: 0 10px;
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                margin: 0;
                border-radius: 0;
            }

            .detail-row {
                flex-direction: column;
            }

            .detail-label {
                margin-bottom: 5px;
                width: auto;
            }

            .header {
                padding: 30px 15px;
            }

            .content {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://via.placeholder.com/180x50/DE991B/FFFFFF?text=Marketplace" alt="Marketplace Logo"
                class="logo">
            <h1>Vendor Account Verified!</h1>
            <div class="subheader">Your business account is now fully activated</div>
        </div>

        <div class="content">
            <p>Dear <strong>John Doe</strong>,</p>

            <div class="verification-badge">
                <div class="badge">
                    <div class="badge-icon">✓</div>
                    <span>Verification Successful</span>
                </div>
            </div>

            <p>We're pleased to inform you that your vendor account <strong>"TechGadgets Pro"</strong> has been
                successfully verified. Your shop is now live and visible to our customers.</p>

            <div class="details-card">
                <div class="detail-row">
                    <span class="detail-label">Account Status:</span>
                    <span class="detail-value">Verified Vendor</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Verification Date:</span>
                    <span class="detail-value">August 20, 2023 at 2:45 PM</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Vendor ID:</span>
                    <span class="detail-value">VD2023-78945</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Next Review:</span>
                    <span class="detail-value">August 2024 (Annual)</span>
                </div>
            </div>

            <div class="next-steps">
                <h3>Start Selling on Marketplace</h3>

                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <div class="step-title">Complete Your Shop Profile</div>
                        <p class="step-desc">Add your business logo, banner, and description to establish your brand
                            identity.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <div class="step-title">List Your Products</div>
                        <p class="step-desc">Upload your product catalog with high-quality images and detailed
                            specifications.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <div class="step-title">Set Up Payment Methods</div>
                        <p class="step-desc">Configure how you'll receive payments from customer orders.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <div class="step-title">Review Vendor Policies</div>
                        <p class="step-desc">Familiarize yourself with our marketplace terms and selling guidelines.</p>
                    </div>
                </div>
            </div>

            <div class="cta">
                <a href="#" class="btn">Access Vendor Dashboard</a>
            </div>

            <p style="text-align: center;">Need guidance? Visit our <a href="#"
                    style="color: var(--primary); font-weight: 600;">Vendor Success Center</a> for tutorials and best
                practices.</p>
        </div>

        <div class="footer">
            <div class="footer-links">
                <a href="#" class="footer-link">Help Center</a>
                <a href="#" class="footer-link">Vendor Policies</a>
                <a href="#" class="footer-link">Community Forum</a>
            </div>
            <p>Our vendor support team is available 24/7</p>
            <p>✉️ <a href="mailto:vendors@marketplace.com" class="support-link">vendors@marketplace.com</a> | 📞 +1
                (800) 123-4567</p>
            <p>© 2023 Marketplace. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
