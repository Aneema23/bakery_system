<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register | Disna Cakes — Pastel Bakery</title>

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
            --accent-blush-glow: rgba(255, 181, 167, 0.25);
            --border-soft: #FFE0D6;
        }

        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: #ffb5a7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        /* Pastel dream pattern overlay */
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

        /* Main Container — soft, airy pastel card */
        .register-container {
            max-width: 520px;
            width: 100%;
            background: #FFFFFF;
            backdrop-filter: blur(2px);
            border-radius: 38px;
            box-shadow: 0 24px 48px -16px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(255, 181, 167, 0.3);
            overflow: hidden;
            position: relative;
            z-index: 1;
            transition: transform 0.2s ease;
        }

        /* Header — Blush & Vanilla Cream */
        .register-header {
            background: linear-gradient(115deg, #FFF8F3 0%, #FFF2EA 100%);
            padding: 34px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 2px solid rgba(255, 181, 167, 0.25);
        }

        .register-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 181, 167, 0.12) 0%, transparent 70%);
            animation: softFloat 7s infinite ease-in-out;
        }

        @keyframes softFloat {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.08); opacity: 0.7; }
        }

        .register-header h2 {
            font-family: 'Playfair Display', serif;
            color: #6F4E37;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            letter-spacing: -0.2px;
        }

        .register-header p {
            color: #8B6F55;
            font-size: 15px;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        .bakery-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 181, 167, 0.18);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(4px);
            box-shadow: 0 6px 14px -6px rgba(0,0,0,0.05);
        }

        .bakery-icon svg {
            width: 34px;
            height: 34px;
            color: #FFB5A7;
            stroke: #FFB5A7;
            stroke-width: 1.7;
            fill: none;
        }

        /* Form Content */
        .register-content {
            padding: 32px 34px 38px;
            background: #FFFFFF;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #7C6954;
            margin-bottom: 8px;
            letter-spacing: -0.2px;
        }

        .form-group label .required {
            color: #FFB5A7;
            margin-left: 4px;
        }

        /* Input wrapper */
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            background: #FEFAF7;
            border: 1.5px solid #FBE2D8;
            border-radius: 32px;
            font-size: 15px;
            color: #4F3E2E;
            transition: all 0.2s ease;
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

        /* Eye Button — Pastel Elegance */
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

        /* Error Message */
        .error-message {
            font-size: 12px;
            color: #FF9282;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .error-message::before {
            content: '🍥';
            font-size: 11px;
        }

        /* Password Strength Indicator — Mint/Blush */
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

        /* Register Button — Blush gradient */
        .btn-register {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(115deg, #FFB5A7 0%, #FFA191 100%);
            border: none;
            border-radius: 48px;
            font-size: 16px;
            font-weight: 700;
            color: #553E2C;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            margin-top: 16px;
            font-family: 'Instrument Sans', sans-serif;
            box-shadow: 0 6px 16px rgba(255, 181, 167, 0.3);
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 245, 230, 0.5);
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s;
        }

        .btn-register:hover::before {
            width: 320px;
            height: 320px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            background: linear-gradient(115deg, #FFC3B7 0%, #FFAE9E 100%);
            box-shadow: 0 14px 28px -10px rgba(255, 181, 167, 0.55);
        }

        .btn-register:active {
            transform: translateY(1px);
        }

        /* Login Link — Powder Blue style */
        .login-link {
            text-align: center;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1.5px solid #FBE6DE;
        }

        .login-link a {
            color: #85A6B5;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #FEFCFA;
            padding: 6px 18px;
            border-radius: 60px;
        }

        .login-link a:hover {
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

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .register-container {
                max-width: 100%;
                border-radius: 32px;
            }
            .register-content {
                padding: 28px 24px;
            }
            .register-header {
                padding: 28px 20px;
            }
            .form-control {
                padding: 12px 16px;
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

        .register-container {
            animation: fadeSweetUp 0.55s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
        }

        .form-group {
            animation: fadeSweetUp 0.5s ease-out forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.03s; }
        .form-group:nth-child(2) { animation-delay: 0.07s; }
        .form-group:nth-child(3) { animation-delay: 0.1s; }
        .form-group:nth-child(4) { animation-delay: 0.14s; }
        .form-group:nth-child(5) { animation-delay: 0.17s; }
        .form-group:nth-child(6) { animation-delay: 0.21s; }
        .form-group:nth-child(7) { animation-delay: 0.25s; }
        .btn-register { animation: fadeSweetUp 0.5s ease-out 0.3s forwards; opacity: 0; }
        .login-link { animation: fadeSweetUp 0.5s ease-out 0.35s forwards; opacity: 0; }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="bakery-icon">
                <img src="{{ asset('images/logo.png') }}" alt="Disna Bakery Logo" style="width: 42px; height: 42px;">
            </div>
            <h2>Join the Disna Bakery ✨</h2>
            <p>create your account & enjoy pastel treats</p>
        </div>

        <div class="register-content">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <!-- Full Name -->
                <div class="form-group">
                    <label>Full name <span class="required">*</span></label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="e.g., Disna Gajanayake">
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contact Number -->
                <div class="form-group">
                    <label>Contact number <span class="required">*</span></label>
                    <input id="contact_number" class="form-control" type="tel" name="contact_number" value="{{ old('contact_number') }}" required autocomplete="tel" placeholder="+94 77 123 4567">
                    @error('contact_number')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label>Email address <span class="required">*</span></label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="hello@disna.com">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label>Address <span class="required">*</span></label>
                    <input id="address" class="form-control" type="text" name="address" value="{{ old('address') }}" required autocomplete="street-address" placeholder="123 Sweet Street, Cake City">
                    @error('address')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- City -->
                <div class="form-group">
                    <label>City <span class="required">*</span></label>
                    <input id="city" class="form-control" type="text" name="city" value="{{ old('city') }}" required autocomplete="address-level2" placeholder="Colombo / Kandy / Galle">
                    @error('city')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password with strength -->
                <div class="form-group">
                    <label>Create password <span class="required">*</span></label>
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
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label>Confirm password <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="confirm your password">
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

                <button type="submit" class="btn-register">
                    🧁 create sweet account 🧁
                </button>

                <div class="login-link">
                    <a href="{{ route('login') }}">
                        already have an account? sign in →
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

        // Password strength indicator (pastel-friendly)
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');

        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
                if (password.match(/\d/)) strength++;
                if (password.match(/[^a-zA-Z\d]/)) strength++;
                
                const width = (strength / 4) * 100;
                strengthBar.style.width = width + '%';
                
                if (strength <= 1) {
                    strengthBar.style.background = '#FFB0A3';
                } else if (strength <= 2) {
                    strengthBar.style.background = '#FFCFBA';
                } else if (strength <= 3) {
                    strengthBar.style.background = '#C7E9D0';
                } else {
                    strengthBar.style.background = '#8FBC94';
                }
                
                checkPasswordMatch();
            });
        }

        // Password match validation
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const matchMessage = document.getElementById('matchMessage');

        function checkPasswordMatch() {
            const password = passwordInput?.value || '';
            const confirmPassword = confirmPasswordInput?.value || '';
            
            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    matchMessage.innerHTML = '<span class="match-success">✨ passwords match! ✨</span>';
                } else {
                    matchMessage.innerHTML = '<span class="match-error">🍬 passwords do not match</span>';
                }
            } else {
                matchMessage.innerHTML = '';
            }
        }

        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);
        }
    </script>
</body>
</html>