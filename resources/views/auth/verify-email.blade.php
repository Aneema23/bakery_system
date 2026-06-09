<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Email - Disna Bakery</title>
                
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
        .verify-container {
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
        .verify-header {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
            padding: 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .verify-header::before {
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

        .verify-header h2 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .verify-header p {
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
            animation: envelopeBounce 1s ease-in-out infinite;
        }

        @keyframes envelopeBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .bakery-icon svg {
            width: 32px;
            height: 32px;
            color: white;
        }

        /* Form Content */
        .verify-content {
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

        /* Success Alert */
        .success-alert {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .success-icon {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            color: #10b981;
        }

        .success-text {
            font-size: 14px;
            color: #10b981;
            line-height: 1.5;
            flex: 1;
        }

        /* Email Display */
        .email-display {
            background: rgba(45, 35, 30, 0.6);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .email-label {
            font-size: 13px;
            color: #fcd34d;
        }

        .email-address {
            font-size: 14px;
            font-weight: 600;
            color: #fef3c7;
            background: rgba(245, 158, 11, 0.2);
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* Button Group */
        .button-group {
            display: flex;
            gap: 16px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        /* Buttons */
        .btn-resend {
            flex: 1;
            padding: 14px 24px;
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
            border: none;
            border-radius: 12px;
            font-size: 15px;
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

        .btn-resend::before {
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

        .btn-resend:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-resend:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.4);
        }

        .btn-resend:active {
            transform: translateY(0);
        }

        .btn-resend.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-resend.loading .btn-text {
            display: none;
        }

        .btn-resend.loading .loading-spinner {
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

        .btn-logout {
            flex: 1;
            padding: 14px 24px;
            background: rgba(45, 35, 30, 0.8);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            color: #fcd34d;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: #ef4444;
            color: #fca5a5;
            transform: translateY(-2px);
        }

        /* Tips Section */
        .tips-section {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid rgba(245, 158, 11, 0.2);
        }

        .tips-title {
            font-size: 13px;
            font-weight: 600;
            color: #fcd34d;
            margin-bottom: 12px;
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
            color: #b99e88;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tips-list li::before {
            content: '🍰';
            font-size: 12px;
        }

        /* Countdown Timer */
        .resend-timer {
            text-align: center;
            margin-top: 16px;
            font-size: 12px;
            color: #b99e88;
        }

        .timer-text {
            color: #f59e0b;
            font-weight: 600;
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
            .verify-container {
                max-width: 100%;
            }
            .verify-content {
                padding: 24px;
            }
            .verify-header {
                padding: 24px;
            }
            .button-group {
                flex-direction: column;
            }
            .email-display {
                flex-direction: column;
                text-align: center;
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

        .verify-container {
            animation: fadeInUp 0.6s ease-out;
        }

        .info-message {
            animation: fadeInUp 0.6s ease-out 0.05s both;
        }

        .email-display {
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .button-group {
            animation: fadeInUp 0.6s ease-out 0.15s both;
        }

        .tips-section {
            animation: fadeInUp 0.6s ease-out 0.2s both;
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
            <h2>Verify Your Email</h2>
            <p>Almost there! Let's confirm your email address</p>
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
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
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
                        A new verification link has been sent to the email address you provided during registration.
                    </div>
                </div>
            @endif

            <!-- Email Display (Optional - shows user's email if available) -->
            @if(Auth::check())
                <div class="email-display">
                    <span class="email-label">Verification email sent to:</span>
                    <span class="email-address">{{ Auth::user()->email }}</span>
                </div>
            @endif

            <!-- Button Group -->
            <div class="button-group">
                <form method="POST" action="{{ route('verification.send') }}" id="resendForm">
                    @csrf
                    <button type="submit" class="btn-resend" id="resendButton">
                        <span class="btn-text">Resend Verification Email</span>
                        <span class="loading-spinner"></span>
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>

            <!-- Tips Section -->
            <div class="tips-section">
                <div class="tips-title">
                    <span>💡</span> Didn't receive the email?
                </div>
                <ul class="tips-list">
                    <li>Check your spam or junk mail folder</li>
                    <li>Make sure you entered the correct email address</li>
                    <li>Add noreply@sweetbakery.com to your contacts</li>
                    <li>Wait a few minutes and try resending</li>
                </ul>
            </div>

            <!-- Resend Timer (Optional) -->
            <div class="resend-timer" id="resendTimer" style="display: none;">
                You can resend in <span class="timer-text" id="timerSeconds">60</span> seconds
            </div>
        </div>
        <div class="decor-line"></div>
    </div>

    <script>
        // Form submission with loading state for resend button
        const resendForm = document.getElementById('resendForm');
        const resendButton = document.getElementById('resendButton');
        
        if (resendForm) {
            resendForm.addEventListener('submit', function(e) {
                // Show loading state
                if (resendButton) {
                    resendButton.classList.add('loading');
                }
                
                // Optional: Start cooldown timer
                startResendCooldown();
            });
        }
        
        // Resend cooldown timer (prevents spam)
        let cooldownActive = false;
        let timerInterval = null;
        
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
                    resendButton.style.opacity = '0.5';
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
                    }
                    cooldownActive = false;
                }
            }, 1000);
        }
        
        // Remove loading state if there's an error (optional)
        // This would require checking for validation errors
        
        // Logout confirmation (optional)
        const logoutForm = document.getElementById('logoutForm');
        if (logoutForm) {
            logoutForm.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to log out?')) {
                    e.preventDefault();
                }
            });
        }
        
        // Auto-focus nothing - page is informational
        
        // Animate envelope on page load
        setTimeout(() => {
            const envelope = document.querySelector('.bakery-icon');
            if (envelope) {
                envelope.style.animation = 'envelopeBounce 1s ease-in-out';
            }
        }, 500);
    </script>
</body>
</html>