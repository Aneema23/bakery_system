<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password - Disna Bakery</title>
       
    <!-- logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: linear-gradient(135deg, #1a0f0a 0%, #2d1810 50%, #1f120c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        /* Bakery Pattern Overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.05"><path fill="%23f59e0b" d="M20,30 L30,20 L40,30 L30,40 Z M50,50 L60,40 L70,50 L60,60 Z M80,70 L90,60 L100,70 L90,80 Z M10,80 L20,70 L30,80 L20,90 Z"/><circle cx="50" cy="30" r="5" fill="%23f59e0b"/><circle cx="80" cy="50" r="3" fill="%23f59e0b"/><circle cx="25" cy="65" r="4" fill="%23f59e0b"/></svg>');
            background-repeat: repeat;
            pointer-events: none;
        }

        /* Main Container */
        .forgot-container {
            max-width: 450px;
            width: 100%;
            background: rgba(30, 20, 15, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(245, 158, 11, 0.2);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        /* Header */
        .forgot-header {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
            padding: 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .forgot-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.1); opacity: 0.5; }
        }

        .forgot-header h2 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .forgot-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        .bakery-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            position: relative;
            z-index: 1;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .bakery-icon svg {
            width: 32px;
            height: 32px;
            color: white;
        }

        /* Form Content */
        .forgot-content {
            padding: 32px;
        }

        /* Info Message */
        .info-message {
            background: rgba(245, 158, 11, 0.1);
            border-left: 3px solid #f59e0b;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            display: flex;
            gap: 12px;
        }

        .info-icon {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            color: #f59e0b;
        }

        .info-text {
            font-size: 14px;
            color: #fcd34d;
            line-height: 1.5;
        }

        /* Session Status Alert */
        .session-status {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 24px;
            color: #10b981;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .session-status::before {
            content: '✓';
            font-weight: bold;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #fcd34d;
            margin-bottom: 8px;
        }

        .form-group label .required {
            color: #ef4444;
            margin-left: 4px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: rgba(45, 35, 30, 0.8);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 12px;
            font-size: 14px;
            color: #fef3c7;
            transition: all 0.3s;
            outline: none;
        }

        .form-control:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
            background: rgba(45, 35, 30, 1);
        }

        .form-control::placeholder {
            color: rgba(254, 243, 199, 0.4);
        }

        /* Error Message */
        .error-message {
            font-size: 12px;
            color: #ef4444;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .error-message::before {
            content: '⚠';
            font-size: 10px;
        }

        /* Button */
        .btn-reset {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-reset::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-reset:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.4);
        }

        .btn-reset:active {
            transform: translateY(0);
        }

        .btn-reset.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-reset.loading .btn-text {
            display: none;
        }

        .btn-reset.loading .loading-spinner {
            display: inline-block;
        }

        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Footer Links */
        .forgot-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(245, 158, 11, 0.2);
        }

        .back-link {
            color: #fcd34d;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .back-link:hover {
            color: #f59e0b;
            gap: 10px;
        }

        /* Decorative Elements */
        .decor-line {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #f59e0b, #ea580c, #f59e0b);
            animation: slide 2s linear infinite;
        }

        @keyframes slide {
            0% { background-position: -100%; }
            100% { background-position: 200%; }
        }

        /* Email Sent Success Animation */
        .success-animation {
            text-align: center;
            padding: 20px;
        }

        .success-checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: scaleIn 0.5s ease-out;
        }

        .success-checkmark svg {
            width: 40px;
            height: 40px;
            color: white;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-title {
            font-size: 24px;
            font-weight: 700;
            color: #10b981;
            margin-bottom: 8px;
        }

        .success-message {
            color: #fcd34d;
            font-size: 14px;
            margin-bottom: 24px;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .forgot-container {
                max-width: 100%;
            }
            .forgot-content {
                padding: 24px;
            }
            .forgot-header {
                padding: 24px;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .forgot-container {
            animation: fadeInUp 0.6s ease-out;
        }

        .info-message, .session-status {
            animation: fadeInUp 0.6s ease-out 0.05s both;
        }

        .form-group {
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .btn-reset {
            animation: fadeInUp 0.6s ease-out 0.15s both;
        }

        .forgot-footer {
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }
    </style>
</head>
<body>
    <div class="forgot-container" id="forgotContainer">
        <div class="forgot-header">
            <div class="bakery-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7.5a4.5 4.5 0 1 0 0 9m-6-9a4.5 4.5 0 1 0 0 9m9-4.5c0 2.5-2 4.5-4.5 4.5m-9-9c0 2.5 2 4.5 4.5 4.5m9-9c-2.5 0-4.5 2-4.5 4.5"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12v3m0 0-2-2m2 2 2-2"></path>
                </svg>
            </div>
            <h2>Forgot Password?</h2>
            <p>Reset your password easily</p>
        </div>

        <div class="forgot-content" id="forgotContent">
            <!-- Info Message -->
            <div class="info-message">
                <div class="info-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </div>
                <div class="info-text">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </div>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="session-status">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Reset Form -->
            <form method="POST" action="{{ route('password.email') }}" id="resetForm">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label>Email Address <span class="required">*</span></label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your registered email address">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-reset" id="resetButton">
                    <span class="btn-text">Send Reset Link</span>
                    <span class="loading-spinner"></span>
                </button>

                <div class="forgot-footer">
                    <a class="back-link" href="{{ route('login') }}">
                        ← Back to Login
                    </a>
                </div>
            </form>
        </div>

        <!-- Success Message Template (hidden initially) -->
        <div class="forgot-content" id="successContent" style="display: none;">
            <div class="success-animation">
                <div class="success-checkmark">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="success-title">Check Your Email!</div>
                <div class="success-message">
                    We've sent a password reset link to your email address.<br>
                    Please check your inbox and follow the instructions.
                </div>
                <div class="forgot-footer" style="border-top: none; margin-top: 0;">
                    <a class="back-link" href="{{ route('login') }}">
                        ← Back to Login
                    </a>
                </div>
            </div>
        </div>

        <div class="decor-line"></div>
    </div>

    <script>
        // Form submission with loading state
        const form = document.getElementById('resetForm');
        const resetButton = document.getElementById('resetButton');
        const forgotContent = document.getElementById('forgotContent');
        const successContent = document.getElementById('successContent');
        const forgotContainer = document.getElementById('forgotContainer');

        if (form) {
            form.addEventListener('submit', function(e) {
                // Show loading state immediately for better UX
                resetButton.classList.add('loading');
                
                // Don't prevent default - let Laravel handle the actual submission
                // This just shows the loading animation
                
                // If there are validation errors, remove loading state after a delay
                setTimeout(() => {
                    if (document.querySelector('.error-message')) {
                        resetButton.classList.remove('loading');
                    }
                }, 1000);
            });
        }

        // If there's a session status (success message), show success animation
        @if (session('status'))
            setTimeout(() => {
                if (forgotContent && successContent) {
                    forgotContent.style.display = 'none';
                    successContent.style.display = 'block';
                    
                    // Adjust container height smoothly
                    const newHeight = successContent.scrollHeight;
                    forgotContainer.style.transition = 'height 0.3s ease';
                }
            }, 500);
        @endif

        // Email validation helper
        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        // Real-time email validation
        const emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.addEventListener('input', function() {
                const email = this.value;
                const errorDiv = this.parentElement.querySelector('.error-message');
                
                if (email && !isValidEmail(email)) {
                    if (!errorDiv || !errorDiv.textContent.includes('valid email')) {
                        const newError = document.createElement('div');
                        newError.className = 'error-message';
                        newError.textContent = 'Please enter a valid email address';
                        
                        if (errorDiv) {
                            errorDiv.remove();
                        }
                        this.parentElement.appendChild(newError);
                    }
                } else if (errorDiv && errorDiv.textContent.includes('valid email')) {
                    errorDiv.remove();
                }
            });
        }
    </script>
</body>
</html>