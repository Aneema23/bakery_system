<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Disna Bakery | Pastel Treats</title>
    
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
            --text-soft: #5E4B3A;
            --text-warm: #6B5A4B;
            --accent-glow: rgba(255, 181, 167, 0.3);
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

        /* Soft pastel abstract pattern overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" opacity="0.08"><path fill="%23FFB5A7" d="M40,30 L50,20 L60,30 L50,40 Z M110,80 L120,70 L130,80 L120,90 Z M160,130 L170,120 L180,130 L170,140 Z M20,150 L30,140 L40,150 L30,160 Z"/><circle cx="90" cy="50" r="8" fill="%23C7E9D0"/><circle cx="150" cy="80" r="6" fill="%23B5E2FA"/><circle cx="40" cy="120" r="7" fill="%23FFB5A7"/><path d="M140 40 Q150 30 160 40" stroke="%23C7E9D0" stroke-width="3" fill="none"/><circle cx="70" cy="160" r="5" fill="%23B5E2FA"/></svg>');
            background-repeat: repeat;
            pointer-events: none;
        }

        /* Main Container — Pastel Dream */
        .login-container {
            max-width: 450px;
            width: 100%;
            background: #FFFFFF;
            backdrop-filter: blur(2px);
            border-radius: 36px;
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(255, 181, 167, 0.25);
            overflow: hidden;
            position: relative;
            z-index: 1;
            transition: transform 0.2s ease;
        }

        /* Header — Blush & Vanilla */
        .login-header {
            background: linear-gradient(125deg, #FFF5EE 0%, #FFF0E8 40%, #FEF7F2 100%);
            padding: 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 2px solid rgba(255, 181, 167, 0.3);
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 181, 167, 0.15) 0%, transparent 70%);
            animation: softPulse 6s ease-in-out infinite;
        }

        @keyframes softPulse {
            0%, 100% { transform: scale(1); opacity: 0.4; }
            50% { transform: scale(1.08); opacity: 0.6; }
        }

        .login-header h2 {
            font-family: 'Playfair Display', serif;
            color: #6F4E37;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            letter-spacing: -0.3px;
        }

        .login-header p {
            color: #8B6F55;
            font-size: 15px;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        .bakery-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 181, 167, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(4px);
            box-shadow: 0 6px 12px -8px rgba(0,0,0,0.05);
        }

        .bakery-icon svg {
            width: 34px;
            height: 34px;
            color: #FFB5A7;
            stroke: #FFB5A7;
            stroke-width: 1.8;
            fill: none;
        }

        /* Form Content */
        .login-content {
            padding: 32px;
            background: #FFFFFF;
        }

        /* Session Status Alert — Mint touch */
        .session-status {
            background: #EFF9F2;
            border-left: 4px solid #C7E9D0;
            border-radius: 20px;
            padding: 12px 16px;
            margin-bottom: 28px;
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
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #7C6954;
            margin-bottom: 8px;
        }

        .form-group label .required {
            color: #FFB5A7;
            margin-left: 4px;
        }

        /* Password Wrapper */
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            background: #FEFAF7;
            border: 1px solid #FFE0D6;
            border-radius: 28px;
            font-size: 15px;
            color: #4F3E2E;
            transition: all 0.25s;
            outline: none;
            font-family: 'Instrument Sans', sans-serif;
        }

        .password-wrapper .form-control {
            padding-right: 48px;
        }

        .form-control:focus {
            border-color: #FFB5A7;
            box-shadow: 0 0 0 4px rgba(255, 181, 167, 0.2);
            background: #FFFFFF;
        }

        .form-control::placeholder {
            color: #D1C0AE;
        }

        /* Eye Button — Pastel style */
        .eye-btn {
            position: absolute;
            right: 16px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #B8A28C;
            transition: all 0.2s;
            width: 26px;
            height: 26px;
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
            color: #FF8A7A;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
        }

        .error-message::before {
            content: '🍰';
            font-size: 11px;
        }

        /* Remember Me Checkbox — Mint & Blush */
        .checkbox-wrapper {
            margin: 22px 0 20px;
        }

        .checkbox-label {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-label input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .custom-checkbox {
            width: 20px;
            height: 20px;
            background: #FEFAF7;
            border: 1.5px solid #FFD9CF;
            border-radius: 8px;
            display: inline-block;
            position: relative;
            transition: all 0.2s;
            margin-right: 12px;
        }

        .checkbox-label input:checked ~ .custom-checkbox {
            background: #C7E9D0;
            border-color: #B5D8BE;
        }

        .checkbox-label input:checked ~ .custom-checkbox::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #4E6B55;
            font-size: 12px;
            font-weight: bold;
        }

        .checkbox-label:hover .custom-checkbox {
            border-color: #FFB5A7;
        }

        .checkbox-text {
            font-size: 14px;
            font-weight: 500;
            color: #7C6954;
        }

        /* Button — Blush gradient */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(115deg, #FFB5A7 0%, #FF9E8E 100%);
            border: none;
            border-radius: 44px;
            font-size: 16px;
            font-weight: 700;
            color: #553E2C;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            margin-top: 12px;
            font-family: 'Instrument Sans', sans-serif;
            box-shadow: 0 6px 14px rgba(255, 181, 167, 0.25);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 245, 0.4);
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s;
        }

        .btn-login:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            background: linear-gradient(115deg, #FFC2B6 0%, #FFAE9E 100%);
            box-shadow: 0 14px 24px -8px rgba(255, 181, 167, 0.5);
        }

        .btn-login:active {
            transform: translateY(1px);
        }

        /* Footer Links — Powder Blue & Mint */
        .login-footer {
            text-align: center;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1.5px solid #FCE8E0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
        }

        .forgot-link, .register-link {
            color: #85A6B5;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #FEFCF9;
            padding: 6px 12px;
            border-radius: 60px;
        }

        .forgot-link:hover, .register-link:hover {
            color: #FFB5A7;
            gap: 10px;
            background: #FFF6F2;
        }

        /* Decorative line with pastel gradient */
        .decor-line {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #FFB5A7, #C7E9D0, #B5E2FA, #FFF5E6, #FFB5A7);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0% { background-position: 0% 0%; }
            100% { background-position: 200% 0%; }
        }

        /* Responsive */
        @media (max-width: 640px) {
            .login-container {
                max-width: 100%;
                border-radius: 28px;
            }
            .login-content {
                padding: 24px;
            }
            .login-header {
                padding: 28px 20px;
            }
            .login-footer {
                flex-direction: column;
                gap: 12px;
            }
        }

        /* Fade-in animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            animation: fadeInUp 0.55s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
        }

        .form-group {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.05s; }
        .form-group:nth-child(2) { animation-delay: 0.1s; }
        .checkbox-wrapper { animation: fadeInUp 0.5s ease-out 0.15s forwards; opacity: 0; }
        .btn-login { animation: fadeInUp 0.5s ease-out 0.2s forwards; opacity: 0; }
        .login-footer { animation: fadeInUp 0.5s ease-out 0.25s forwards; opacity: 0; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="bakery-icon">
                <img src="{{ asset('images/logo.png') }}" alt="Disna Bakery Logo" style="width: 42px; height: 42px;">
            </div>
            <h2>Sweet Return </h2>
            <p>Sign in to Your Disna Bakery Account</p>
        </div>

        <div class="login-content">
            <!-- Session Status -->
            @if (session('status'))
                <div class="session-status">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label>Email address <span class="required">*</span></label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="hello@disna.com">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password + Eye -->
                <div class="form-group">
                    <label>Password <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
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
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me with pastel checkbox -->
                <div class="checkbox-wrapper">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" id="remember_me">
                        <span class="custom-checkbox"></span>
                        <span class="checkbox-text">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    🧁 Sign in 🧁
                </button>

                <div class="login-footer">
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            forgot password? →
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a class="register-link" href="{{ route('register') }}">
                            new here? create account ✨
                        </a>
                    @endif
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

        // Optional: subtle demo
        console.log('🍰 Welcome to Disna Cakes — pastel login ready');
    </script>
</body>
</html>