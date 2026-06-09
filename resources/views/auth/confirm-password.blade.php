<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Confirm Password - Disna Bakery</title>
          
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
        .confirm-container {
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
        .confirm-header {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
            padding: 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .confirm-header::before {
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

        .confirm-header h2 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .confirm-header p {
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
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .bakery-icon svg {
            width: 32px;
            height: 32px;
            color: white;
        }

        /* Form Content */
        .confirm-content {
            padding: 32px;
        }

        /* Security Alert */
        .security-alert {
            background: rgba(239, 68, 68, 0.1);
            border-left: 3px solid #ef4444;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            display: flex;
            gap: 12px;
        }

        .security-icon {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            color: #ef4444;
        }

        .security-text {
            font-size: 14px;
            color: #fca5a5;
            line-height: 1.5;
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

        /* Password Field with Eye Icon */
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
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

        .password-wrapper .form-control {
            padding-right: 45px;
        }

        .form-control:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
            background: rgba(45, 35, 30, 1);
        }

        .form-control::placeholder {
            color: rgba(254, 243, 199, 0.4);
        }

        /* Eye Button */
        .eye-btn {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fcd34d;
            transition: all 0.3s;
            width: 24px;
            height: 24px;
        }

        .eye-btn:hover {
            color: #f59e0b;
            transform: scale(1.1);
        }

        .eye-btn svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        .eye-btn .eye-slash {
            display: none;
        }

        .eye-btn.showing .eye-open {
            display: none;
        }

        .eye-btn.showing .eye-slash {
            display: block;
        }

        /* Caps Lock Indicator */
        .caps-warning {
            font-size: 11px;
            color: #f59e0b;
            margin-top: 6px;
            display: none;
            align-items: center;
            gap: 4px;
        }

        .caps-warning.show {
            display: flex;
        }

        .caps-warning::before {
            content: '⇪';
            font-size: 12px;
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
        .btn-confirm {
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

        .btn-confirm::before {
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

        .btn-confirm:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.4);
        }

        .btn-confirm:active {
            transform: translateY(0);
        }

        .btn-confirm.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-confirm.loading .btn-text {
            display: none;
        }

        .btn-confirm.loading .loading-spinner {
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
        .confirm-footer {
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

        /* Responsive */
        @media (max-width: 640px) {
            .confirm-container {
                max-width: 100%;
            }
            .confirm-content {
                padding: 24px;
            }
            .confirm-header {
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

        .confirm-container {
            animation: fadeInUp 0.6s ease-out;
        }

        .security-alert {
            animation: fadeInUp 0.6s ease-out 0.05s both;
        }

        .form-group {
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .btn-confirm {
            animation: fadeInUp 0.6s ease-out 0.15s both;
        }

        .confirm-footer {
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }
    </style>
</head>
<body>
    <div class="confirm-container">
        <div class="confirm-header">
            <div class="bakery-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2>Confirm Password</h2>
            <p>Security verification required</p>
        </div>

        <div class="confirm-content">
            <!-- Security Alert -->
            <div class="security-alert">
                <div class="security-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </div>
                <div class="security-text">
                    This is a secure area of the application. Please confirm your password before continuing.
                </div>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" id="confirmForm">
                @csrf

                <!-- Password -->
                <div class="form-group">
                    <label>Your Password <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password to continue">
                        <button type="button" class="eye-btn" onclick="togglePassword('password')">
                            <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg class="eye-slash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                    <div id="capsWarning" class="caps-warning">
                        Caps Lock is on
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-confirm" id="confirmButton">
                    <span class="btn-text">Confirm & Continue</span>
                    <span class="loading-spinner"></span>
                </button>

                <div class="confirm-footer">
                    <a class="back-link" href="{{ route('login') }}">
                        ← Back to Login
                    </a>
                </div>
            </form>
        </div>
        <div class="decor-line"></div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const button = field.closest('.password-wrapper').querySelector('.eye-btn');
            
            if (field.type === 'password') {
                field.type = 'text';
                button.classList.add('showing');
            } else {
                field.type = 'password';
                button.classList.remove('showing');
            }
        }

        // Caps Lock detection
        const passwordField = document.getElementById('password');
        const capsWarning = document.getElementById('capsWarning');

        if (passwordField) {
            passwordField.addEventListener('keyup', function(e) {
                if (e.getModifierState && e.getModifierState('CapsLock')) {
                    capsWarning.classList.add('show');
                } else {
                    capsWarning.classList.remove('show');
                }
            });

            passwordField.addEventListener('keydown', function(e) {
                if (e.getModifierState && e.getModifierState('CapsLock')) {
                    capsWarning.classList.add('show');
                } else {
                    capsWarning.classList.remove('show');
                }
            });
        }

        // Form submission with loading state
        const form = document.getElementById('confirmForm');
        const confirmButton = document.getElementById('confirmButton');

        if (form) {
            form.addEventListener('submit', function() {
                confirmButton.classList.add('loading');
            });
        }

        // Auto-focus on password field
        if (passwordField) {
            passwordField.focus();
        }

        // Enter key submission
        if (passwordField) {
            passwordField.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    form.submit();
                }
            });
        }
    </script>
</body>
</html>