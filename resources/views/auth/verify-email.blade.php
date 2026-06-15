<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Email | Disna Cakes — Sweet Confirmation</title>
                
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
        .verify-container {
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
        .verify-header {
            background: linear-gradient(115deg, #FFF8F3 0%, #FFF2EA 100%);
            padding: 36px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 2px solid rgba(255, 181, 167, 0.2);
        }

        .verify-header::before {
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

        .verify-header h2 {
            font-family: 'Playfair Display', serif;
            color: #6F4E37;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            letter-spacing: -0.3px;
        }

        .verify-header p {
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
            animation: envelopeFloat 2s ease-in-out infinite;
        }

        @keyframes envelopeFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
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
        .verify-content {
            padding: 36px 34px 42px;
            background: #FFFFFF;
        }

        /* Info Message — Minty fresh */
        .info-message {
            background: #FEFAF7;
            border-left: 5px solid #C7E9D0;
            border-radius: 28px;
            padding: 18px 20px;
            margin-bottom: 28px;
            display: flex;
            gap: 14px;
        }

        .info-icon {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            color: #B5E2FA;
        }

        .info-text {
            font-size: 14px;
            color: #7E6954;
            line-height: 1.5;
            font-weight: 500;
        }

        /* Success Alert */
        .success-alert {
            background: #EFF9F2;
            border-left: 4px solid #C7E9D0;
            border-radius: 24px;
            padding: 16px 20px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideSweet 0.5s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }

        @keyframes slideSweet {
            from {
                opacity: 0;
                transform: translateX(-16px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .success-icon {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            color: #8FBC94;
        }

        .success-text {
            font-size: 14px;
            color: #5A7C62;
            line-height: 1.5;
            flex: 1;
            font-weight: 500;
        }

        /* Email Display */
        .email-display {
            background: #FEFAF7;
            border-radius: 40px;
            padding: 14px 20px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            border: 1px solid #FCE4DA;
        }

        .email-label {
            font-size: 13px;
            font-weight: 500;
            color: #8B735E;
        }

        .email-address {
            font-size: 14px;
            font-weight: 600;
            color: #6F4E37;
            background: rgba(255, 181, 167, 0.12);
            padding: 6px 16px;
            border-radius: 40px;
            letter-spacing: -0.2px;
        }

        /* Button Group */
        .button-group {
            display: flex;
            gap: 16px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        /* Resend Button — Blush Gradient */
        .btn-resend {
            flex: 1;
            padding: 14px 24px;
            background: linear-gradient(115deg, #FFB5A7 0%, #FFA191 100%);
            border: none;
            border-radius: 60px;
            font-size: 15px;
            font-weight: 700;
            color: #553E2C;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 6px 14px rgba(255, 181, 167, 0.25);
        }

        .btn-resend::before {
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

        .btn-resend:hover::before {
            width: 320px;
            height: 320px;
        }

        .btn-resend:hover {
            transform: translateY(-2px);
            background: linear-gradient(115deg, #FFC2B6 0%, #FFAE9E 100%);
            box-shadow: 0 12px 24px -8px rgba(255, 181, 167, 0.45);
        }

        .btn-resend:active {
            transform: translateY(1px);
        }

        .btn-resend.loading {
            opacity: 0.8;
            cursor: not-allowed;
        }

        .btn-resend.loading .btn-text {
            display: none;
        }

        .btn-resend.loading .loading-spinner {
            display: inline-block;
        }

        /* Logout Button — Pastel outline */
        .btn-logout {
            flex: 1;
            padding: 14px 24px;
            background: #FEFAF7;
            border: 1.5px solid #FCE4DA;
            border-radius: 60px;
            font-size: 15px;
            font-weight: 600;
            color: #8B735E;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-logout:hover {
            background: #FFF3EF;
            border-color: #FFB5A7;
            color: #FF9A8B;
            transform: translateY(-2px);
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

        /* Tips Section */
        .tips-section {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1.5px solid #FCE4DA;
        }

        .tips-title {
            font-size: 13px;
            font-weight: 700;
            color: #7C6954;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tips-list {
            list-style: none;
            padding: 0;
        }

        .tips-list li {
            font-size: 12px;
            color: #A48E78;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .tips-list li::before {
            content: '🍰';
            font-size: 13px;
        }

        /* Countdown Timer */
        .resend-timer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            font-weight: 500;
            color: #A48E78;
        }

        .timer-text {
            color: #FFB5A7;
            font-weight: 700;
            background: rgba(255, 181, 167, 0.12);
            padding: 2px 10px;
            border-radius: 30px;
            display: inline-block;
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
            .verify-container {
                max-width: 100%;
                border-radius: 32px;
            }
            .verify-content {
                padding: 28px 24px;
            }
            .verify-header {
                padding: 28px 20px;
            }
            .button-group {
                flex-direction: column;
            }
            .email-display {
                flex-direction: column;
                text-align: center;
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

        .verify-container {
            animation: fadeSweetUp 0.55s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
        }

        .info-message {
            animation: fadeSweetUp 0.5s ease-out 0.03s both;
        }

        .email-display {
            animation: fadeSweetUp 0.5s ease-out 0.08s both;
        }

        .button-group {
            animation: fadeSweetUp 0.5s ease-out 0.13s both;
        }

        .tips-section {
            animation: fadeSweetUp 0.5s ease-out 0.18s both;
        }
    </style>
</head>
<body>
    <div class="verify-container">
        <div class="verify-header">
            <div class="bakery-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h2>confirm your sweetness 🧁</h2>
            <p>one last step to unlock full access</p>
        </div>

        <div class="verify-content">
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
                    Thanks for joining our bakery! Please verify your email address using the link we just sent. Didn't receive it? We'll happily send a fresh one.
                </div>
            </div>

            <!-- Success Alert (when verification link is sent) -->
            @if (session('status') == 'verification-link-sent')
                <div class="success-alert">
                    <div class="success-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div class="success-text">
                        ✨ A fresh verification link has been sent to your email — check your inbox!
                    </div>
                </div>
            @endif

            <!-- Email Display -->
            @if(Auth::check())
                <div class="email-display">
                    <span class="email-label">Verification sent to:</span>
                    <span class="email-address">{{ Auth::user()->email }}</span>
                </div>
            @endif

            <!-- Button Group -->
            <div class="button-group">
                <form method="POST" action="{{ route('verification.send') }}" id="resendForm">
                    @csrf
                    <button type="submit" class="btn-resend" id="resendButton">
                        <span class="btn-text">✉️ resend verification</span>
                        <span class="loading-spinner"></span>
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        log out
                    </button>
                </form>
            </div>

            <!-- Tips Section -->
            <div class="tips-section">
                <div class="tips-title">
                    <span>💡</span> didn't receive the magic link?
                </div>
                <ul class="tips-list">
                    <li>Peek into your spam or junk folder (sometimes emails hide there)</li>
                    <li>Double-check that you entered the correct email address</li>
                    <li>Add hello@disnacakes.com to your contacts for faster delivery</li>
                    <li>Wait a moment and try resending — our oven is warm!</li>
                </ul>
            </div>

            <!-- Resend Timer -->
            <div class="resend-timer" id="resendTimer" style="display: none;">
                you can resend in <span class="timer-text" id="timerSeconds">60</span> seconds
            </div>
        </div>
        <div class="decor-line"></div>
    </div>

    <script>
        // Resend form with loading state & cooldown
        const resendForm = document.getElementById('resendForm');
        const resendButton = document.getElementById('resendButton');
        let cooldownActive = false;
        let timerInterval = null;
        
        if (resendForm) {
            resendForm.addEventListener('submit', function(e) {
                if (cooldownActive) {
                    e.preventDefault();
                    return;
                }
                
                if (resendButton) {
                    resendButton.classList.add('loading');
                }
                startResendCooldown();
            });
        }
        
        function startResendCooldown() {
            if (cooldownActive) return;
            
            cooldownActive = true;
            let seconds = 60;
            const timerDiv = document.getElementById('resendTimer');
            const timerSpan = document.getElementById('timerSeconds');
            
            if (timerDiv) {
                timerDiv.style.display = 'block';
                if (resendButton) {
                    resendButton.disabled = true;
                    resendButton.style.opacity = '0.7';
                    resendButton.style.cursor = 'not-allowed';
                }
            }
            
            if (timerInterval) {
                clearInterval(timerInterval);
            }
            
            timerInterval = setInterval(function() {
                seconds--;
                
                if (timerSpan) {
                    timerSpan.textContent = seconds;
                }
                
                if (seconds <= 0) {
                    clearInterval(timerInterval);
                    if (timerDiv) {
                        timerDiv.style.display = 'none';
                    }
                    if (resendButton) {
                        resendButton.disabled = false;
                        resendButton.style.opacity = '1';
                        resendButton.style.cursor = 'pointer';
                        // remove loading class if any leftover
                        resendButton.classList.remove('loading');
                    }
                    cooldownActive = false;
                }
            }, 1000);
        }
        
        // Logout gentle confirmation
        const logoutForm = document.getElementById('logoutForm');
        if (logoutForm) {
            logoutForm.addEventListener('submit', function(e) {
                if (!confirm('Log out from your bakery account? 🍪')) {
                    e.preventDefault();
                }
            });
        }
        
        // Small animation reset for envelope
        setTimeout(() => {
            const envelope = document.querySelector('.bakery-icon');
            if (envelope) {
                envelope.style.animation = 'envelopeFloat 2s ease-in-out infinite';
            }
        }, 100);
    </script>
</body>
</html>