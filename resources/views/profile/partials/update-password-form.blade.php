<section class="pastel-password-section">
    <header class="password-header">
        <h2 class="password-title">
            {{ __('Update Password') }}
        </h2>

        <p class="password-subtitle">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="password-form" id="updatePasswordForm">
        @csrf
        @method('put')

        <div class="form-group">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="form-label" />
            <div class="password-input-wrapper">
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" placeholder="Enter your current password" />
                <button type="button" class="eye-btn" onclick="togglePasswordVisibility('update_password_current_password')">
                    <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <svg class="eye-slash" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="form-error" />
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password" :value="__('New Password')" class="form-label" />
            <div class="password-input-wrapper">
                <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" placeholder="Create a strong password" />
                <button type="button" class="eye-btn" onclick="togglePasswordVisibility('update_password_password')">
                    <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <svg class="eye-slash" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </button>
            </div>
            <!-- Password Strength Indicator -->
            <div class="password-strength-container" id="strengthContainer" style="display: none;">
                <div class="strength-bar-bg">
                    <div class="strength-bar" id="strengthBar"></div>
                </div>
                <div class="strength-text" id="strengthText"></div>
            </div>
            <!-- Password Requirements -->
            <div class="password-requirements" id="passwordRequirements">
                <span class="requirement" id="reqLength">❌ At least 8 characters</span>
                <span class="requirement" id="reqUpper">❌ Uppercase letter</span>
                <span class="requirement" id="reqLower">❌ Lowercase letter</span>
                <span class="requirement" id="reqNumber">❌ Number</span>
                <span class="requirement" id="reqSpecial">❌ Special character</span>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="form-error" />
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm New Password')" class="form-label" />
            <div class="password-input-wrapper">
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" placeholder="Confirm your new password" />
                <button type="button" class="eye-btn" onclick="togglePasswordVisibility('update_password_password_confirmation')">
                    <svg class="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <svg class="eye-slash" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </button>
            </div>
            <div id="matchMessage" class="match-indicator"></div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="form-error" />
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-update-password">{{ __('Update Password') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="save-confirmation"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<style>
    /* Pastel Color Palette */
    :root {
        --blush: #FFB5A7;
        --mint: #C7E9D0;
        --powder-blue: #B5E2FA;
        --vanilla: #FFF5E6;
        --canvas: #FAFAFA;
        --cream-bg: #FFF9F5;
        --text-warm: #6F4E37;
        --text-soft: #7C6954;
        --border-blush: #FFDFD6;
        --card-white: #FFFFFF;
        --shadow-pastel: 0 8px 24px -10px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(255, 181, 167, 0.15);
        --hover-shadow: 0 12px 28px -12px rgba(255, 181, 167, 0.25);
    }

    .pastel-password-section {
        max-width: 680px;
        margin: 0 auto;
        background: var(--card-white);
        border-radius: 32px;
        box-shadow: var(--shadow-pastel);
        padding: 2rem 2rem 2.2rem;
        transition: all 0.25s ease;
    }

    .pastel-password-section:hover {
        box-shadow: var(--hover-shadow);
    }

    .password-header {
        margin-bottom: 1.75rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #FCE8E0;
    }

    .password-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.65rem;
        font-weight: 700;
        color: var(--text-warm);
        letter-spacing: -0.3px;
        margin-bottom: 0.5rem;
    }

    .password-subtitle {
        font-size: 0.875rem;
        color: #9B8570;
        font-weight: 500;
        line-height: 1.4;
    }

    .password-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-soft);
        letter-spacing: -0.2px;
    }

    .password-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .form-control {
        width: 100%;
        padding: 0.85rem 1.2rem;
        background: var(--cream-bg);
        border: 1.5px solid #FCE4DA;
        border-radius: 48px;
        font-size: 0.95rem;
        color: #4F3E2E;
        transition: all 0.2s ease;
        outline: none;
        font-family: 'Instrument Sans', sans-serif;
    }

    .password-input-wrapper .form-control {
        padding-right: 3.2rem;
    }

    .form-control:focus {
        border-color: var(--blush);
        box-shadow: 0 0 0 4px rgba(255, 181, 167, 0.2);
        background: var(--card-white);
    }

    .form-control::placeholder {
        color: #D8C6B4;
        font-weight: 400;
    }

    /* Eye Button */
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
        color: #BFA992;
        transition: all 0.2s;
        width: 28px;
        height: 28px;
    }

    .eye-btn:hover {
        color: var(--blush);
        transform: scale(1.05);
    }

    .eye-btn svg {
        stroke: currentColor;
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
    .password-strength-container {
        margin-top: 0.5rem;
    }

    .strength-bar-bg {
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
        font-size: 0.7rem;
        margin-top: 0.5rem;
        text-align: right;
        font-weight: 500;
    }

    /* Password Requirements */
    .password-requirements {
        margin-top: 0.6rem;
        font-size: 0.7rem;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .requirement {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #FEFAF7;
        padding: 0.25rem 0.7rem;
        border-radius: 40px;
        font-weight: 500;
        transition: all 0.15s;
        font-size: 0.7rem;
    }

    .requirement.valid {
        color: #8FBC94;
        background: #F0F7F0;
    }

    .requirement.invalid {
        color: #BFA992;
        background: #FEFAF7;
    }

    /* Match Indicator */
    .match-indicator {
        margin-top: 0.25rem;
        font-size: 0.7rem;
        font-weight: 500;
        padding-left: 0.5rem;
    }

    .match-success {
        color: #8FBC94;
    }

    .match-error {
        color: #FFB0A3;
    }

    /* Form Error */
    .form-error {
        font-size: 0.75rem;
        color: #FF9282;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
        padding-left: 0.75rem;
    }

    .form-error::before {
        content: '🍰';
        font-size: 0.7rem;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-top: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-update-password {
        background: linear-gradient(115deg, #FFB5A7 0%, #FFA191 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 60px;
        font-size: 0.9rem;
        font-weight: 700;
        color: #553E2C;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(255, 181, 167, 0.3);
        font-family: 'Instrument Sans', sans-serif;
    }

    .btn-update-password:hover {
        transform: translateY(-2px);
        background: linear-gradient(115deg, #FFC2B6 0%, #FFAE9E 100%);
        box-shadow: 0 8px 20px rgba(255, 181, 167, 0.4);
    }

    .btn-update-password:active {
        transform: translateY(1px);
    }

    .save-confirmation {
        font-size: 0.85rem;
        font-weight: 600;
        color: #8FBC94;
        background: #F0F7F0;
        padding: 0.5rem 1.2rem;
        border-radius: 60px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .save-confirmation::before {
        content: '✓';
        font-weight: bold;
        font-size: 0.9rem;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .pastel-password-section {
            padding: 1.5rem;
            border-radius: 28px;
        }
        
        .password-title {
            font-size: 1.4rem;
        }
        
        .form-control {
            padding: 0.7rem 1rem;
        }
        
        .btn-update-password {
            padding: 0.65rem 1.5rem;
        }
        
        .form-actions {
            flex-direction: column;
            align-items: stretch;
        }
        
        .save-confirmation {
            text-align: center;
            justify-content: center;
        }
        
        .password-requirements {
            gap: 6px;
        }
    }

    /* Animation */
    @keyframes fadeSlide {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .save-confirmation {
        animation: fadeSlide 0.25s ease-out;
    }
</style>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">

<script>
    // Toggle password visibility
    function togglePasswordVisibility(fieldId) {
        const field = document.getElementById(fieldId);
        const wrapper = field.closest('.password-input-wrapper');
        const button = wrapper.querySelector('.eye-btn');
        
        if (field.type === 'password') {
            field.type = 'text';
            button.classList.add('showing');
        } else {
            field.type = 'password';
            button.classList.remove('showing');
        }
    }

    // Password strength and validation
    const newPasswordInput = document.getElementById('update_password_password');
    const confirmPasswordInput = document.getElementById('update_password_password_confirmation');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    const strengthContainer = document.getElementById('strengthContainer');
    const matchMessage = document.getElementById('matchMessage');

    // Requirements elements
    const reqLength = document.getElementById('reqLength');
    const reqUpper = document.getElementById('reqUpper');
    const reqLower = document.getElementById('reqLower');
    const reqNumber = document.getElementById('reqNumber');
    const reqSpecial = document.getElementById('reqSpecial');

    function updateRequirement(element, isValid, validText, invalidText) {
        if (isValid) {
            element.textContent = '✓ ' + validText;
            element.classList.add('valid');
            element.classList.remove('invalid');
        } else {
            element.textContent = '❌ ' + invalidText;
            element.classList.add('invalid');
            element.classList.remove('valid');
        }
    }

    function checkPasswordStrength() {
        const password = newPasswordInput.value;
        
        if (password.length === 0) {
            strengthContainer.style.display = 'none';
            return;
        }
        
        strengthContainer.style.display = 'block';
        
        const hasLength = password.length >= 8;
        const hasUpper = /[A-Z]/.test(password);
        const hasLower = /[a-z]/.test(password);
        const hasNumber = /\d/.test(password);
        const hasSpecial = /[^A-Za-z0-9]/.test(password);
        
        updateRequirement(reqLength, hasLength, '8+ characters', '8+ characters');
        updateRequirement(reqUpper, hasUpper, 'Uppercase', 'Uppercase');
        updateRequirement(reqLower, hasLower, 'Lowercase', 'Lowercase');
        updateRequirement(reqNumber, hasNumber, 'Number', 'Number');
        updateRequirement(reqSpecial, hasSpecial, 'Special char', 'Special char');
        
        let validCount = 0;
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
        
        if (strength <= 1) {
            strengthBar.style.background = '#FFB0A3';
            strengthText.textContent = 'weak';
            strengthText.style.color = '#FFB0A3';
        } else if (strength <= 2) {
            strengthBar.style.background = '#FFCFBA';
            strengthText.textContent = 'fair';
            strengthText.style.color = '#C7A18B';
        } else if (strength <= 3) {
            strengthBar.style.background = '#C7E9D0';
            strengthText.textContent = 'good';
            strengthText.style.color = '#7B9C7A';
        } else {
            strengthBar.style.background = '#8FBC94';
            strengthText.textContent = 'strong!';
            strengthText.style.color = '#5F8262';
        }
        
        checkPasswordMatch();
    }

    function checkPasswordMatch() {
        const password = newPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword.length > 0) {
            if (password === confirmPassword) {
                matchMessage.innerHTML = '<span class="match-success">✨ passwords match!</span>';
            } else {
                matchMessage.innerHTML = '<span class="match-error">🍬 passwords don\'t match</span>';
            }
        } else {
            matchMessage.innerHTML = '';
        }
    }

    // Event listeners
    if (newPasswordInput) {
        newPasswordInput.addEventListener('input', checkPasswordStrength);
    }
    
    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    }
</script>