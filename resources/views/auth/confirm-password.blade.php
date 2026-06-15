<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Confirm Access | Disna Cakes — Pastel Security</title>
          
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
            background: #FAFAFA;
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
        .confirm-container {
            max-width: 480px;
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
        .confirm-header {
            background: linear-gradient(115deg, #FFF8F3 0%, #FFF2EA 100%);
            padding: 36px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 2px solid rgba(255, 181, 167, 0.2);
        }

        .confirm-header::before {
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

        .confirm-header h2 {
            font-family: 'Playfair Display', serif;
            color: #6F4E37;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            letter-spacing: -0.3px;
        }

        .confirm-header p {
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
            animation: softShake 0.6s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        @keyframes softShake {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-4px); }
            40% { transform: translateX(4px); }
            60% { transform: translateX(-2px); }
            80% { transform: translateX(2px); }
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
        .confirm-content {
            padding: 36px 34px 42px;
            background: #FFFFFF;
        }

        /* Security Alert — pastel mint & blush */
        .security-alert {
            background: #FEFAF7;
            border-left: 5px solid #C7E9D0;
            border-radius: 28px;
            padding: 18px 20px;
            margin-bottom: 32px;
            display: flex;
            gap: 14px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }

        .security-icon {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            color: #B5E2FA;
        }

        .security-text {
            font-size: 14px;
            color: #7E6954;
            line-height: 1.5;
            font-weight: 500;
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

        /* Caps Lock Indicator — pastel hint */
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
        .btn-confirm {
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

        .btn-confirm::before {
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

        .btn-confirm:hover::before {
            width: 320px;
            height: 320px;
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
            background: linear-gradient(115deg, #FFC2B6 0%, #FFAE9E 100%);
            box-shadow: 0 14px 28px -8px rgba(255, 181, 167, 0.5);
        }

        .btn-confirm:active {
            transform: translateY(1px);
        }

        .btn-confirm.loading {
            opacity: 0.8;
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
        .confirm-footer {
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
            background: #FFB5A7;
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
            .confirm-container {
                max-width: 100%;
                border-radius: 32px;
            }
            .confirm-content {
                padding: 28px 24px;
            }
            .confirm-header {
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

        .confirm-container {
            animation: fadeSweetUp 0.55s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
        }

        .security-alert {
            animation: fadeSweetUp 0.5s ease-out 0.03s both;
        }

        .form-group {
            animation: fadeSweetUp 0.5s ease-out 0.1s both;
        }

        .btn-confirm {
            animation: fadeSweetUp 0.5s ease-out 0.16s both;
        }

        .confirm-footer {
            animation: fadeSweetUp 0.5s ease-out 0.22s both;
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
            <h2>One Last Check 🔐</h2>
            <p>please confirm it's really you</p>
        </div>

        <div class="confirm-content">
            <!-- Security Alert with pastel tones -->
            <div class="security-alert">
                <div class="security-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </div>
                <div class="security-text">
                    This is a protected zone. Please re-enter your password to access your account & sweet treats.
                </div>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" id="confirmForm">
                @csrf

                <!-- Password -->
                <div class="form-group">
                    <label>your password <span class="required">*</span></label>
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
                    <div id="capsWarning" class="caps-warning">
                        Caps Lock is active
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-confirm" id="confirmButton">
                    <span class="btn-text">✨ confirm & continue ✨</span>
                    <span class="loading-spinner"></span>
                </button>

                <div class="confirm-footer">
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

        // Caps Lock detection with pastel hint
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

        // Form submission loading state
        const form = document.getElementById('confirmForm');
        const confirmButton = document.getElementById('confirmButton');

        if (form) {
            form.addEventListener('submit', function() {
                if (confirmButton) confirmButton.classList.add('loading');
            });
        }

        // Auto-focus on password field for better UX
        if (passwordField) {
            passwordField.focus();
        }

        // Enter key quick submit
        if (passwordField) {
            passwordField.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    if (form) form.submit();
                }
            });
        }
    </script>
</body>
</html>