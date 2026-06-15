<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password | Disna Cakes — Sweet Reset</title>
             
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

        /* Main Container — soft pastel card */
        .reset-container {
            max-width: 520px;
            width: 100%;
            background: #FFFFFF;
            backdrop-filter: blur(1px);
            border-radius: 42px;
            box-shadow: 0 24px 48px -18px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 181, 167, 0.3);
            overflow: hidden;
            position: relative;
            z-index: 1;
            transition: transform 0.2s ease;
        }

        /* Header — Blush & Vanilla cream */
        .reset-header {
            background: linear-gradient(115deg, #FFF8F3 0%, #FFF2EA 100%);
            padding: 36px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 2px solid rgba(255, 181, 167, 0.2);
        }

        .reset-header::before {
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

        .reset-header h2 {
            font-family: 'Playfair Display', serif;
            color: #6F4E37;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            letter-spacing: -0.3px;
        }

        .reset-header p {
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
            animation: sweetRotate 0.55s cubic-bezier(0.2, 0.9, 0.4, 1.2);
        }

        @keyframes sweetRotate {
            from {
                transform: rotate(-160deg);
                opacity: 0;
            }
            to {
                transform: rotate(0deg);
                opacity: 1;
            }
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
        .reset-content {
            padding: 36px 34px 42px;
            background: #FFFFFF;
        }

        /* Info Message — Minty fresh */
        .info-message {
            background: #FEFAF7;
            border-left: 5px solid #C7E9D0;
            border-radius: 28px;
            padding: 14px 20px;
            margin-bottom: 32px;
            font-size: 13px;
            color: #7E6954;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .info-message::before {
            content: '🍭';
            font-size: 18px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 26px;
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

        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
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

        .password-wrapper .form-control {
            padding-right: 52px;
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

        /* Eye Button — pastel elegance */
        .eye-btn {
            position: absolute;
            right: 18px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #BFA992;
            transition: all 0.2s;
            width: 28px;
            height: 28px;
        }

        .eye-btn:hover {
            color: #FFB5A7;
            transform: scale(1.05);
        }

        .eye-btn svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
            stroke-width: 1.8;
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

        /* Password Strength Indicator — pastel */
        .password-strength {
            margin-top: 10px;
            height: 5px;
            background: #F5EDE6;
            border-radius: 20px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.25s ease, background 0.2s;
            border-radius: 20px;
        }

        .strength-text {
            font-size: 11px;
            margin-top: 8px;
            display: flex;
            justify-content: flex-end;
            font-weight: 500;
        }

        /* Password Match Indicator */
        .match-indicator {
            margin-top: 8px;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .match-success {
            color: #8FBC94;
        }

        .match-error {
            color: #FFB0A3;
        }

        /* Caps Lock Indicator */
        .caps-warning {
            font-size: 11px;
            color: #AABFAA;
            margin-top: 8px;
            display: none;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            padding-left: 8px;
        }

        .caps-warning.show {
            display: flex;
        }

        .caps-warning::before {
            content: '⇪';
            font-size: 12px;
            color: #C7E9D0;
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
            margin-top: 10px;
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

        /* Password Requirements — pastel chips */
        .password-requirements {
            margin-top: 14px;
            font-size: 11px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 4px 0;
        }

        .requirement {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #FEFAF7;
            padding: 4px 10px;
            border-radius: 40px;
            font-weight: 500;
            transition: all 0.15s;
        }

        .requirement.valid {
            color: #8FBC94;
            background: #F0F7F0;
        }

        .requirement.invalid {
            color: #BFA992;
            background: #FEFAF7;
        }

        /* Footer Links */
        .reset-footer {
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

        /* Responsive */
        @media (max-width: 640px) {
            .reset-container {
                max-width: 100%;
                border-radius: 32px;
            }
            .reset-content {
                padding: 28px 24px;
            }
            .reset-header {
                padding: 28px 20px;
            }
            .form-control {
                padding: 12px 18px;
            }
            .password-requirements {
                gap: 8px;
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

        .reset-container {
            animation: fadeSweetUp 0.55s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
        }

        .info-message {
            animation: fadeSweetUp 0.5s ease-out 0.03s both;
        }

        .form-group {
            animation: fadeSweetUp 0.5s ease-out forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.08s; }
        .form-group:nth-child(2) { animation-delay: 0.14s; }
        .form-group:nth-child(3) { animation-delay: 0.2s; }

        .btn-reset {
            animation: fadeSweetUp 0.5s ease-out 0.26s both;
        }

        .reset-footer {
            animation: fadeSweetUp 0.5s ease-out 0.32s both;
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
            <h2>Fresh Password ✨</h2>
            <p>create a sweet & secure key</p>
        </div>

        <div class="reset-content">
            <!-- Info Message -->
            <div class="info-message">
                choose a strong password you haven't used before — like your favorite frosting
            </div>

            <form method="POST" action="{{ route('password.store') }}" id="resetForm">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <label>Email address <span class="required">*</span></label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" placeholder="hello@disna.com">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="form-group">
                    <label>New password <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="••••••••">
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
                        Caps Lock is active
                    </div>
                    
                    <!-- Password Requirements -->
                    <div class="password-requirements" id="passwordRequirements">
                        <span class="requirement" id="reqLength">❌ 8+ characters</span>
                        <span class="requirement" id="reqUpper">❌ Uppercase</span>
                        <span class="requirement" id="reqLower">❌ Lowercase</span>
                        <span class="requirement" id="reqNumber">❌ Number</span>
                        <span class="requirement" id="reqSpecial">❌ Special char</span>
                    </div>
                    
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label>Confirm new password <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="confirm your sweet secret">
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
                    <span class="btn-text">🧁 reset & bake new password 🧁 </span>
                    <span class="loading-spinner"></span>
                </button>

                <div class="reset-footer">
                    <a class="back-link" href="{{ route('login') }}">
                        ← back to login
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

        // Password validation and strength meter (pastel edition)
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
            let validCount = 0;
            
            const hasLength = password.length >= 8;
            const hasUpper = /[A-Z]/.test(password);
            const hasLower = /[a-z]/.test(password);
            const hasNumber = /\d/.test(password);
            const hasSpecial = /[^A-Za-z0-9]/.test(password);
            
            // Update requirement indicators
            function updateReq(el, isValid, validText, invalidText) {
                if (isValid) {
                    el.textContent = '✓ ' + validText;
                    el.classList.add('valid');
                    el.classList.remove('invalid');
                } else {
                    el.textContent = '❌ ' + invalidText;
                    el.classList.add('invalid');
                    el.classList.remove('valid');
                }
            }
            
            updateReq(reqLength, hasLength, '8+ characters', '8+ characters');
            updateReq(reqUpper, hasUpper, 'Uppercase', 'Uppercase');
            updateReq(reqLower, hasLower, 'Lowercase', 'Lowercase');
            updateReq(reqNumber, hasNumber, 'Number', 'Number');
            updateReq(reqSpecial, hasSpecial, 'Special char', 'Special char');
            
            if (hasLength) validCount++;
            if (hasUpper) validCount++;
            if (hasLower) validCount++;
            if (hasNumber) validCount++;
            if (hasSpecial) validCount++;
            
            let strength = 0;
            if (validCount <= 2) strength = 1;
            else if (validCount <= 3) strength = 2;
            else if (validCount <= 4) strength = 3;
            else strength = 4;
            
            const width = (strength / 4) * 100;
            strengthBar.style.width = width + '%';
            
            if (password.length === 0) {
                strengthText.textContent = '';
            } else if (strength <= 1) {
                strengthBar.style.background = '#FFB0A3';
                strengthText.textContent = 'weak frosting';
                strengthText.style.color = '#FFB0A3';
            } else if (strength <= 2) {
                strengthBar.style.background = '#FFCFBA';
                strengthText.textContent = 'getting sweeter';
                strengthText.style.color = '#C7A18B';
            } else if (strength <= 3) {
                strengthBar.style.background = '#C7E9D0';
                strengthText.textContent = 'almost there!';
                strengthText.style.color = '#7B9C7A';
            } else {
                strengthBar.style.background = '#8FBC94';
                strengthText.textContent = 'strong as honeycomb!';
                strengthText.style.color = '#5F8262';
            }
            
            checkPasswordMatch();
        }
        
        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirmPassword = confirmInput.value;
            
            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    matchMessage.innerHTML = '<span class="match-success">✨ passwords match! ✨</span>';
                } else {
                    matchMessage.innerHTML = '<span class="match-error">🍬 passwords don\'t match</span>';
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
            
            passwordInput.addEventListener('input', checkPasswordStrength);
        }
        
        if (confirmInput) {
            confirmInput.addEventListener('input', checkPasswordMatch);
        }

        // Form submission loading state
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