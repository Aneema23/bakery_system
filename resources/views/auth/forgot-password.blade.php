<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password | Disna Cakes — Sweet Pastry</title>
       
    <!-- logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --blush: #FFB5A7;
            --mint: #C7E9D0;
            --powder-blue: #B5E2FA;
            --vanilla: #FFF5E6;
            --canvas: #FAFAFA;
            --cream-light: #FFF9F5;
            --text-warm: #6F4E37;
            --text-soft: #5E4B3A;
            --accent-glow: rgba(255, 181, 167, 0.2);
            --border-blush: #FFDFD6;
        }

        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: #FFB5A7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        /* Dreamy pastel pattern overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" opacity="0.06"><path fill="%23FFB5A7" d="M40,30 L50,20 L60,30 L50,40 Z M110,80 L120,70 L130,80 L120,90 Z M160,130 L170,120 L180,130 L170,140 Z M20,150 L30,140 L40,150 L30,160 Z"/><circle cx="90" cy="50" r="8" fill="%23C7E9D0"/><circle cx="150" cy="80" r="6" fill="%23B5E2FA"/><circle cx="40" cy="120" r="7" fill="%23FFB5A7"/><path d="M140 40 Q150 30 160 40" stroke="%23C7E9D0" stroke-width="3" fill="none"/><circle cx="70" cy="160" r="5" fill="%23B5E2FA"/></svg>');
            background-repeat: repeat;
            pointer-events: none;
        }

        /* Main Container — pastel confection card */
        .forgot-container {
            max-width: 480px;
            width: 100%;
            background: #FFFFFF;
            backdrop-filter: blur(1px);
            border-radius: 42px;
            box-shadow: 0 24px 48px -18px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 181, 167, 0.3);
            overflow: hidden;
            position: relative;
            z-index: 1;
            transition: all 0.25s ease;
        }

        /* Header — Blush & Vanilla cream */
        .forgot-header {
            background: linear-gradient(115deg, #FFF8F3 0%, #FFF2EA 100%);
            padding: 36px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 2px solid rgba(255, 181, 167, 0.2);
        }

        .forgot-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 181, 167, 0.12) 0%, transparent 70%);
            animation: gentleDrift 6s infinite ease-in-out;
        }

        @keyframes gentleDrift {
            0%, 100% { transform: scale(1); opacity: 0.4; }
            50% { transform: scale(1.08); opacity: 0.65; }
        }

        .forgot-header h2 {
            font-family: 'Playfair Display', serif;
            color: #6F4E37;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            letter-spacing: -0.3px;
        }

        .forgot-header p {
            color: #8B6F55;
            font-size: 15px;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        .bakery-icon {
            width: 72px;
            height: 72px;
            background: rgba(255, 181, 167, 0.18);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(4px);
            box-shadow: 0 8px 18px -8px rgba(0,0,0,0.05);
            animation: softBounce 3s infinite ease;
        }

        @keyframes softBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .bakery-icon svg {
            width: 36px;
            height: 36px;
            color: #FFB5A7;
            stroke: #FFB5A7;
            stroke-width: 1.7;
            fill: none;
        }

        /* Form Content */
        .forgot-content {
            padding: 36px 34px 42px;
            background: #FFFFFF;
        }

        /* Info Message — Mint & Blush */
        .info-message {
            background: #FEFAF7;
            border-left: 5px solid #c7e4e9;
            border-radius: 28px;
            padding: 18px 20px;
            margin-bottom: 28px;
            display: flex;
            gap: 14px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }

        .info-icon {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            color: #75c3ed;
        }

        .info-text {
            font-size: 14px;
            color: #7E6954;
            line-height: 1.5;
            font-weight: 500;
        }

        /* Session Status */
        .session-status {
            background: #EFF9F2;
            border-left: 4px solid #C7E9D0;
            border-radius: 24px;
            padding: 14px 18px;
            margin-bottom: 26px;
            color: #5A7C62;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .session-status::before {
            content: '✨';
            font-weight: bold;
            font-size: 16px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 28px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #7C6954;
            margin-bottom: 10px;
        }

        .form-group label .required {
            color: #FFB5A7;
            margin-left: 4px;
        }

        .form-control {
            width: 100%;
            padding: 14px 20px;
            background: #FEFAF7;
            border: 1.5px solid #FCE4DA;
            border-radius: 44px;
            font-size: 15px;
            color: #4F3E2E;
            transition: all 0.2s;
            outline: none;
            font-family: 'Instrument Sans', sans-serif;
        }

        .form-control:focus {
            border-color: #FFB5A7;
            box-shadow: 0 0 0 4px rgba(255, 181, 167, 0.2);
            background: #FFFFFF;
        }

        .form-control::placeholder {
            color: #D8C6B4;
            font-weight: 400;
        }

        /* Error Message */
        .error-message {
            font-size: 12px;
            color: #FF9282;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            padding-left: 8px;
        }

        .error-message::before {
            content: '🍰';
            font-size: 11px;
        }

        /* Button — Blush Gradient */
        .btn-reset {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(115deg, #FFB5A7 0%, #FFA191 100%);
            border: none;
            border-radius: 60px;
            font-size: 16px;
            font-weight: 700;
            color: #553E2C;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 8px 18px rgba(255, 181, 167, 0.25);
        }

        .btn-reset::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 250, 240, 0.5);
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s;
        }

        .btn-reset:hover::before {
            width: 320px;
            height: 320px;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            background: linear-gradient(115deg, #FFC2B6 0%, #FFAE9E 100%);
            box-shadow: 0 14px 28px -8px rgba(255, 181, 167, 0.5);
        }

        .btn-reset:active {
            transform: translateY(1px);
        }

        .btn-reset.loading {
            opacity: 0.8;
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
            width: 22px;
            height: 22px;
            border: 2px solid rgba(85, 62, 44, 0.2);
            border-radius: 50%;
            border-top-color: #553E2C;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Footer Links */
        .forgot-footer {
            text-align: center;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1.5px solid #FCE4DA;
        }

        .back-link {
            color: #8FAFBC;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #FEFCFA;
            padding: 8px 20px;
            border-radius: 60px;
        }

        .back-link:hover {
            color: #FFB5A7;
            gap: 12px;
            background: #FFF6F2;
        }

        /* Decorative Line */
        .decor-line {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #FFB5A7, #C7E9D0, #B5E2FA, #FFF0E0, #FFB5A7);
            background-size: 200% 100%;
            animation: shimmerMove 3.5s linear infinite;
        }

        @keyframes shimmerMove {
            0% { background-position: 0% 0%; }
            100% { background-position: 200% 0%; }
        }

        /* Success Animation — dreamy pastel */
        .success-animation {
            text-align: center;
            padding: 20px 10px 10px;
        }

        .success-checkmark {
            width: 90px;
            height: 90px;
            margin: 0 auto 22px;
            background: #C7E9D0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: popScale 0.45s cubic-bezier(0.2, 0.9, 0.4, 1.2);
            box-shadow: 0 8px 20px rgba(199, 233, 208, 0.4);
        }

        .success-checkmark svg {
            width: 48px;
            height: 48px;
            color: #4F735A;
            stroke-width: 1.8;
        }

        @keyframes popScale {
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
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            color: #6F4E37;
            margin-bottom: 12px;
        }

        .success-message {
            color: #8B735E;
            font-size: 15px;
            margin-bottom: 28px;
            line-height: 1.45;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .forgot-container {
                max-width: 100%;
                border-radius: 32px;
            }
            .forgot-content {
                padding: 28px 24px;
            }
            .forgot-header {
                padding: 28px 20px;
            }
            .form-control {
                padding: 12px 18px;
            }
        }

        /* Fade-in animation */
        @keyframes fadeSweetUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .forgot-container {
            animation: fadeSweetUp 0.55s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
        }

        .info-message, .session-status {
            animation: fadeSweetUp 0.5s ease-out 0.03s both;
        }

        .form-group {
            animation: fadeSweetUp 0.5s ease-out 0.1s both;
        }

        .btn-reset {
            animation: fadeSweetUp 0.5s ease-out 0.16s both;
        }

        .forgot-footer {
            animation: fadeSweetUp 0.5s ease-out 0.22s both;
        }
    </style>
</head>
<body>
    <div class="forgot-container" id="forgotContainer">
        <div class="forgot-header">
            <div class="bakery-icon">
                <img src="{{ asset('images/logo.png') }}" alt="Disna Bakery Logo" style="width: 42px; height: 42px;">
            </div>
            <h2>sweet reminder ✨</h2>
            <p>we'll help you bake a new password</p>
        </div>

        <div class="forgot-content" id="forgotContent">
            <!-- Info Message with pastel tones -->
            <div class="info-message">
                <div class="info-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </div>
                <div class="info-text">
                    No worries, sweet cravings happen! Just enter your email and we’ll send a magic link to reset your password.
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
                    <label>Email address <span class="required">*</span></label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="hello@disna.com">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-reset" id="resetButton">
                    <span class="btn-text">🧁 send reset link 🧁</span>
                    <span class="loading-spinner"></span>
                </button>

                <div class="forgot-footer">
                    <a class="back-link" href="{{ route('login') }}">
                        ← back to login
                    </a>
                </div>
            </form>
        </div>

        <!-- Success Message Template (hidden initially) -->
        <div class="forgot-content" id="successContent" style="display: none;">
            <div class="success-animation">
                <div class="success-checkmark">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="success-title">magic link sent ✉️</div>
                <div class="success-message">
                    We've whisked a password reset link to your email.<br>
                    Check your inbox and follow the steps to create a new password.
                </div>
                <div class="forgot-footer" style="border-top: none; margin-top: 4px;">
                    <a class="back-link" href="{{ route('login') }}">
                        ← return to login
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
                // Show loading state for better UX (only if form valid)
                if (resetButton) resetButton.classList.add('loading');
                
                // Tiny delay to avoid flicker if validation errors appear
                setTimeout(() => {
                    if (document.querySelector('.error-message')) {
                        if (resetButton) resetButton.classList.remove('loading');
                    }
                }, 600);
            });
        }

        // If there's a session status (success message), show beautiful success card
        @if (session('status'))
            setTimeout(() => {
                if (forgotContent && successContent) {
                    forgotContent.style.display = 'none';
                    successContent.style.display = 'block';
                    // smooth container transition
                    forgotContainer.style.transition = 'height 0.3s ease';
                }
            }, 300);
        @endif

        // Real-time email validation with pastel hint
        const emailInput = document.getElementById('email');
        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        if (emailInput) {
            emailInput.addEventListener('input', function() {
                const email = this.value;
                let errorDiv = this.parentElement.querySelector('.error-message:not(.server-error)');
                
                if (email && !isValidEmail(email)) {
                    if (!errorDiv || !errorDiv.textContent.includes('valid email')) {
                        const newError = document.createElement('div');
                        newError.className = 'error-message';
                        newError.textContent = 'please enter a deliciously valid email';
                        
                        if (errorDiv && errorDiv.textContent.includes('valid email')) {
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