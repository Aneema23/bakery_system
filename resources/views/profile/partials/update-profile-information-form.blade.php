<section class="pastel-profile-section">
    <header class="profile-header">
        <h2 class="profile-title">
            {{ __('Profile Information') }}
        </h2>

        <p class="profile-subtitle">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="profile-form">
        @csrf
        @method('patch')

        <!-- Name update-->
        <div class="form-group">
            <x-input-label for="name" :value="__('Full Name')" class="form-label" />
            <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="Your sweet name" />
            <x-input-error class="form-error" :messages="$errors->get('name')" />
        </div>

        <!-- Email update-->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email Address')" class="form-label" />
            <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" placeholder="hello@disna.com" />
            <x-input-error class="form-error" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="verification-box">
                    <p class="verification-message">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="resend-verify-btn">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="verification-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- address update-->
        <div class="form-group">
            <x-input-label for="address" :value="__('Address')" class="form-label" />
            <x-text-input id="address" name="address" type="text" class="form-control" :value="old('address', $user->address)" autocomplete="street-address" placeholder="123 Sweet Street, Candyland" />
            <x-input-error class="form-error" :messages="$errors->get('address')" />
        </div>

        <!-- contact_number update-->
        <div class="form-group">
            <x-input-label for="contact_number" :value="__('Contact Number')" class="form-label" />
            <x-text-input id="contact_number" name="contact_number" type="text" class="form-control" :value="old('contact_number', $user->contact_number)" autocomplete="tel" placeholder="0711489030" />
            <x-input-error class="form-error" :messages="$errors->get('contact_number')" />
        </div>  

        <!-- city update-->
        <div class="form-group">    
            <x-input-label for="city" :value="__('City')" class="form-label" />
            <x-text-input id="city" name="city" type="text" class="form-control" :value="old('city', $user->city)" autocomplete="address-level2" placeholder="Candyville" />
            <x-input-error class="form-error" :messages="$errors->get('city')" />
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">{{ __('Save Changes') }}</button>

            @if (session('status') === 'profile-updated')
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

    .pastel-profile-section {
        max-width: 680px;
        margin: 0 auto;
        background: var(--card-white);
        border-radius: 32px;
        box-shadow: var(--shadow-pastel);
        padding: 2rem 2rem 2.2rem;
        transition: all 0.25s ease;
    }

    .pastel-profile-section:hover {
        box-shadow: var(--hover-shadow);
    }

    .profile-header {
        margin-bottom: 1.75rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #FCE8E0;
    }

    .profile-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.65rem;
        font-weight: 700;
        color: var(--text-warm);
        letter-spacing: -0.3px;
        margin-bottom: 0.5rem;
    }

    .profile-subtitle {
        font-size: 0.875rem;
        color: #9B8570;
        font-weight: 500;
        line-height: 1.4;
    }

    .profile-form {
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

    .form-label span.required {
        color: var(--blush);
        margin-left: 2px;
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

    .form-control:focus {
        border-color: var(--blush);
        box-shadow: 0 0 0 4px rgba(255, 181, 167, 0.2);
        background: var(--card-white);
    }

    .form-control::placeholder {
        color: #D8C6B4;
        font-weight: 400;
    }

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

    /* Verification Box */
    .verification-box {
        margin-top: 1rem;
        background: #FEFAF7;
        border-left: 4px solid #C7E9D0;
        border-radius: 20px;
        padding: 1rem 1.2rem;
    }

    .verification-message {
        font-size: 0.8rem;
        color: #7E6954;
        font-weight: 500;
        display: flex;
        flex-wrap: wrap;
        align-items: baseline;
        gap: 0.5rem;
    }

    .resend-verify-btn {
        background: none;
        border: none;
        color: #FFB5A7;
        font-weight: 700;
        font-size: 0.8rem;
        cursor: pointer;
        text-decoration: underline;
        text-underline-offset: 3px;
        transition: all 0.2s;
        padding: 0;
    }

    .resend-verify-btn:hover {
        color: #FF9A8B;
        transform: translateX(2px);
    }

    .verification-success {
        margin-top: 0.75rem;
        font-size: 0.75rem;
        color: #8FBC94;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .verification-success::before {
        content: '✨';
        font-size: 0.8rem;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-top: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-save {
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

    .btn-save:hover {
        transform: translateY(-2px);
        background: linear-gradient(115deg, #FFC2B6 0%, #FFAE9E 100%);
        box-shadow: 0 8px 20px rgba(255, 181, 167, 0.4);
    }

    .btn-save:active {
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
        .pastel-profile-section {
            padding: 1.5rem;
            border-radius: 28px;
        }
        
        .profile-title {
            font-size: 1.4rem;
        }
        
        .form-control {
            padding: 0.7rem 1rem;
        }
        
        .btn-save {
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
    }

    /* Animation for saved state */
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

<!-- Optional: Add Playfair Display font for headings -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">