<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - Disna Bakery</title>
             
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
        .reset-container {
            max-width: 500px;
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
        .reset-header {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
            padding: 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .reset-header::before {
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

        .reset-header h2 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .reset-header p {
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
            animation: rotate 0.5s ease-out;
        }

        @keyframes rotate {
            from {
                transform: rotate(-180deg);
                opacity: 0;
            }
            to {
                transform: rotate(0deg);
                opacity: 1;
            }
        }

        .bakery-icon svg {
            width: 32px;
            height: 32px;
            color: white;
        }

        /* Form Content */
        .reset-content {
            padding: 32px;
        }

        /* Info Message */
        .info-message {
            background: rgba(245, 158, 11, 0.1);
            border-left: 3px solid #f59e0b;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #fcd34d;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-message::before {
            content: '🔐';
            font-size: 16px;
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

        /* Password Strength Indicator */
        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s, background 0.3s;
            border-radius: 2px;
        }

        .strength-text {
            font-size: 11px;
            margin-top: 6px;
            display: flex;
            justify-content: flex-end;
        }

        /* Password Match Indicator */
        .match-indicator {
            margin-top: 8px;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .match-success {
            color: #10b981;
        }

        .match-error {
            color: #ef4444;
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
        .reset-footer {
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

        /* Password Requirements */
        .password-requirements {
            margin-top: 12px;
            font-size: 11px;
            color: #9ca3af;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .requirement.valid {
            color: #10b981;
        }

        .requirement.invalid {
            color: #6b7280;
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
            .reset-container {
                max-width: 100%;
            }
            .reset-content {
                padding: 24px;
            }
            .reset-header {
                padding: 24px;
            }
            .password-requirements {
                flex-direction: column;
                gap: 6px;
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

        .reset-container {
            animation: fadeInUp 0.6s ease-out;
        }

        .info-message {
            animation: fadeInUp 0.6s ease-out 0.05s both;
        }

        .form-group {
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.15s; }
        .form-group:nth-child(3) { animation-delay: 0.2s; }

        .btn-reset {
            animation: fadeInUp 0.6s ease-out 0.25s both;
        }

        .reset-footer {
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-header">
            <div class="bakery-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7.5a4.5 4.5 0 1 0 0 9m-6-9a4.5 4.5 0 1 0 0 9m9-4.5c0 2.5-2 4.5-4.5 4.5m-9-9c0 2.5 2 4.5 4.5 4.5m9-9c-2.5 0-4.5 2-4.5 4.5"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12v3m0 0-2-2m2 2 2-2"></path>
                </svg>
            </div>
            <h2>Reset Password</h2>
            <p>Create a new secure password</p>
        </div>

        <div class="reset-content">
            <!-- Info Message -->
            <div class="info-message">
                Please create a strong password that you haven't used before
            </div>

            <form method="POST" action="{{ route('password.store') }}" id="resetForm">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <label>Email Address <span class="required">*</span></label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" placeholder="your@email.com">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="form-group">
                    <label>New Password <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Create a strong password">
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
                    <div class="password-strength">
                        <div class="strength-bar" id="strengthBar"></div>
                    </div>
                    <div class="strength-text" id="strengthText"></div>
                    <div id="capsWarning" class="caps-warning">
                        Caps Lock is on
                    </div>
                    
                    <!-- Password Requirements -->
                    <div class="password-requirements" id="passwordRequirements">
                        <span class="requirement" id="reqLength">❌ At least 8 characters</span>
                        <span class="requirement" id="reqUpper">❌ Uppercase letter</span>
                        <span class="requirement" id="reqLower">❌ Lowercase letter</span>
                        <span class="requirement" id="reqNumber">❌ Number</span>
                        <span class="requirement" id="reqSpecial">❌ Special character</span>
                    </div>
                    
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label>Confirm New Password <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your new password">
                        <button type="button" class="eye-btn" onclick="togglePassword('password_confirmation')">
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
                    <div id="matchMessage" class="match-indicator"></div>
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-reset" id="resetButton">
                    <span class="btn-text">Reset Password</span>
                    <span class="loading-spinner"></span>
                </button>

                <div class="reset-footer">
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

        // Password validation and strength meter
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');
        const matchMessage = document.getElementById('matchMessage');
        const capsWarning = document.getElementById('capsWarning');

        // Requirements elements
        const reqLength = document.getElementById('reqLength');
        const reqUpper = document.getElementById('reqUpper');
        const reqLower = document.getElementById('reqLower');
        const reqNumber = document.getElementById('reqNumber');
        const reqSpecial = document.getElementById('reqSpecial');

        function checkPasswordStrength() {
            const password = passwordInput.value;
            let strength = 0;
            let validCount = 0;
            
            // Check requirements
            const hasLength = password.length >= 8;
            const hasUpper = /[A-Z]/.test(password);
            const hasLower = /[a-z]/.test(password);
            const hasNumber = /\d/.test(password);
            const hasSpecial = /[^A-Za-z0-9]/.test(password);
            
            // Update requirement indicators
            updateRequirement(reqLength, hasLength, '✓ At least 8 characters', '❌ At least 8 characters');
            updateRequirement(reqUpper, hasUpper, '✓ Uppercase letter', '❌ Uppercase letter');
            updateRequirement(reqLower, hasLower, '✓ Lowercase letter', '❌ Lowercase letter');
            updateRequirement(reqNumber, hasNumber, '✓ Number', '❌ Number');
            updateRequirement(reqSpecial, hasSpecial, '✓ Special character', '❌ Special character');
            
            // Count valid requirements
            if (hasLength) validCount++;
            if (hasUpper) validCount++;
            if (hasLower) validCount++;
            if (hasNumber) validCount++;
            if (hasSpecial) validCount++;
            
            // Calculate strength (0-4)
            if (validCount <= 2) strength = 1;
            else if (validCount <= 3) strength = 2;
            else if (validCount <= 4) strength = 3;
            else strength = 4;
            
            // Update strength bar
            const width = (strength / 4) * 100;
            strengthBar.style.width = width + '%';
            
            // Update strength text
            if (password.length === 0) {
                strengthText.textContent = '';
            } else if (strength <= 1) {
                strengthBar.style.background = '#ef4444';
                strengthText.textContent = 'Weak password';
                strengthText.style.color = '#ef4444';
            } else if (strength <= 2) {
                strengthBar.style.background = '#f59e0b';
                strengthText.textContent = 'Fair password';
                strengthText.style.color = '#f59e0b';
            } else if (strength <= 3) {
                strengthBar.style.background = '#fbbf24';
                strengthText.textContent = 'Good password';
                strengthText.style.color = '#fbbf24';
            } else {
                strengthBar.style.background = '#10b981';
                strengthText.textContent = 'Strong password!';
                strengthText.style.color = '#10b981';
            }
            
            // Check password match
            checkPasswordMatch();
        }
        
        function updateRequirement(element, isValid, validText, invalidText) {
            if (isValid) {
                element.textContent = validText;
                element.classList.add('valid');
                element.classList.remove('invalid');
            } else {
                element.textContent = invalidText;
                element.classList.add('invalid');
                element.classList.remove('valid');
            }
        }

        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirmPassword = confirmInput.value;
            
            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    matchMessage.innerHTML = '<span class="match-success">✓ Passwords match</span>';
                } else {
                    matchMessage.innerHTML = '<span class="match-error">✗ Passwords do not match</span>';
                }
            } else {
                matchMessage.innerHTML = '';
            }
        }

        // Caps Lock detection
        if (passwordInput) {
            passwordInput.addEventListener('keyup', function(e) {
                if (e.getModifierState && e.getModifierState('CapsLock')) {
                    capsWarning.classList.add('show');
                } else {
                    capsWarning.classList.remove('show');
                }
            });
        }

        // Event listeners
        if (passwordInput) {
            passwordInput.addEventListener('input', checkPasswordStrength);
        }
        
        if (confirmInput) {
            confirmInput.addEventListener('input', checkPasswordMatch);
        }

        // Form submission with loading state
        const form = document.getElementById('resetForm');
        const resetButton = document.getElementById('resetButton');

        if (form) {
            form.addEventListener('submit', function() {
                resetButton.classList.add('loading');
            });
        }
    </script>
</body>
</html>