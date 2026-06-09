<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Sweet Bakery</title>

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
        .register-container {
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
        .register-header {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
            padding: 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .register-header::before {
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

        .register-header h2 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .register-header p {
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
        }

        .bakery-icon svg {
            width: 32px;
            height: 32px;
            color: white;
        }

        /* Form Content */
        .register-content {
            padding: 32px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 20px;
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
        .btn-register {
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
            margin-top: 8px;
        }

        .btn-register::before {
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

        .btn-register:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(245, 158, 11, 0.2);
        }

        .login-link a {
            color: #fcd34d;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .login-link a:hover {
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

        /* Responsive */
        @media (max-width: 640px) {
            .register-container {
                max-width: 100%;
            }
            .register-content {
                padding: 24px;
            }
            .register-header {
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

        .register-container {
            animation: fadeInUp 0.6s ease-out;
        }

        .form-group {
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .form-group:nth-child(1) { animation-delay: 0.05s; }
        .form-group:nth-child(2) { animation-delay: 0.1s; }
        .form-group:nth-child(3) { animation-delay: 0.15s; }
        .form-group:nth-child(4) { animation-delay: 0.2s; }
        .form-group:nth-child(5) { animation-delay: 0.25s; }
        .form-group:nth-child(6) { animation-delay: 0.3s; }
        .form-group:nth-child(7) { animation-delay: 0.35s; }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="bakery-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0c-.454-.303-.977-.454-1.5-.454"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 20h14"></path>
                </svg>
            </div>
            <h2>Create Account</h2>
            <p>Join Sweet Bakery and enjoy fresh baked goods</p>
        </div>

        <div class="register-content">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <!-- Full Name -->
                <div class="form-group">
                    <label>Full Name <span class="required">*</span></label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Enter your full name">
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contact Number -->
                <div class="form-group">
                    <label>Contact Number <span class="required">*</span></label>
                    <input id="contact_number" class="form-control" type="tel" name="contact_number" value="{{ old('contact_number') }}" required autocomplete="tel" placeholder="+1 234 567 8900">
                    @error('contact_number')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label>Email Address <span class="required">*</span></label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@example.com">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label>Address <span class="required">*</span></label>
                    <input id="address" class="form-control" type="text" name="address" value="{{ old('address') }}" required autocomplete="street-address" placeholder="Street address, building, unit">
                    @error('address')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- City -->
                <div class="form-group">
                    <label>City <span class="required">*</span></label>
                    <input id="city" class="form-control" type="text" name="city" value="{{ old('city') }}" required autocomplete="address-level2" placeholder="City name">
                    @error('city')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password with Eye Icon -->
                <div class="form-group">
                    <label>Password <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Create a password">
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

                <!-- Confirm Password with Eye Icon -->
                <div class="form-group">
                    <label>Confirm Password <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
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
                    Create Account
                </button>

                <div class="login-link">
                    <a href="{{ route('login') }}">
                        Already have an account? Sign in →
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

        // Password strength indicator
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
                    strengthBar.style.background = '#ef4444';
                } else if (strength <= 2) {
                    strengthBar.style.background = '#f59e0b';
                } else if (strength <= 3) {
                    strengthBar.style.background = '#fbbf24';
                } else {
                    strengthBar.style.background = '#10b981';
                }
                
                // Check password match
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
                    matchMessage.innerHTML = '<span class="match-success">✓ Passwords match</span>';
                    matchMessage.style.color = '#10b981';
                } else {
                    matchMessage.innerHTML = '<span class="match-error">✗ Passwords do not match</span>';
                    matchMessage.style.color = '#ef4444';
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