<section class="pastel-delete-section">
    <header class="delete-header">
        <h2 class="delete-title">
            {{ __('Delete Account') }}
        </h2>

        <p class="delete-subtitle">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-delete"
    >
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 6h18"></path>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            <line x1="10" y1="11" x2="10" y2="17"></line>
            <line x1="14" y1="11" x2="14" y2="17"></line>
        </svg>
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="delete-modal-content">
            @csrf
            @method('delete')

            <div class="modal-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>

            <h2 class="modal-title">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="modal-description">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="modal-form-group">
                <x-input-label for="delete_account_password" value="{{ __('Password') }}" class="modal-label" />
                <div class="password-input-wrapper">
                    <x-text-input
                        id="delete_account_password"
                        name="password"
                        type="password"
                        class="modal-input"
                        placeholder="{{ __('Enter your password to confirm') }}"
                    />
                    <button type="button" class="modal-eye-btn" onclick="toggleDeletePasswordVisibility()">
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
                <x-input-error :messages="$errors->userDeletion->get('password')" class="modal-error" />
            </div>

            <div class="modal-actions">
                <button type="button" x-on:click="$dispatch('close')" class="btn-cancel">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="btn-confirm-delete">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 6h18"></path>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
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
        --delete-red: #FF8A7A;
        --delete-dark: #C76A5C;
    }

    .pastel-delete-section {
        max-width: 680px;
        margin: 0 auto;
        background: var(--card-white);
        border-radius: 32px;
        box-shadow: var(--shadow-pastel);
        padding: 2rem 2rem 2.2rem;
        transition: all 0.25s ease;
    }

    .pastel-delete-section:hover {
        box-shadow: var(--hover-shadow);
    }

    .delete-header {
        margin-bottom: 1.75rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #FCE8E0;
    }

    .delete-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.65rem;
        font-weight: 700;
        color: var(--text-warm);
        letter-spacing: -0.3px;
        margin-bottom: 0.5rem;
    }

    .delete-subtitle {
        font-size: 0.875rem;
        color: #9B8570;
        font-weight: 500;
        line-height: 1.5;
    }

    /* Delete Button */
    .btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        background: rgba(255, 138, 122, 0.1);
        border: 1.5px solid rgba(255, 138, 122, 0.4);
        padding: 0.7rem 1.6rem;
        border-radius: 60px;
        font-size: 0.9rem;
        font-weight: 700;
        color: #D97A6A;
        cursor: pointer;
        transition: all 0.25s ease;
        font-family: 'Instrument Sans', sans-serif;
    }

    .btn-delete:hover {
        background: rgba(255, 138, 122, 0.2);
        border-color: var(--delete-red);
        transform: translateY(-2px);
        color: #C76A5C;
    }

    .btn-delete:active {
        transform: translateY(1px);
    }

    /* Modal Content Override - Pastel Style */
    .delete-modal-content {
        background: var(--card-white);
        border-radius: 32px;
        padding: 2rem;
        max-width: 460px;
        margin: 0 auto;
        text-align: center;
    }

    .modal-icon {
        width: 64px;
        height: 64px;
        background: rgba(255, 138, 122, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
    }

    .modal-icon svg {
        color: var(--delete-red);
        stroke: var(--delete-red);
    }

    .modal-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-warm);
        margin-bottom: 0.75rem;
    }

    .modal-description {
        font-size: 0.85rem;
        color: #9B8570;
        line-height: 1.5;
        margin-bottom: 1.5rem;
    }

    .modal-form-group {
        margin-bottom: 1.8rem;
        text-align: left;
    }

    .modal-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-soft);
        margin-bottom: 0.5rem;
        display: block;
    }

    .password-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .modal-input {
        width: 100%;
        padding: 0.8rem 1rem;
        background: var(--cream-bg);
        border: 1.5px solid #FCE4DA;
        border-radius: 48px;
        font-size: 0.9rem;
        color: #4F3E2E;
        transition: all 0.2s ease;
        outline: none;
        font-family: 'Instrument Sans', sans-serif;
    }

    .password-input-wrapper .modal-input {
        padding-right: 3rem;
    }

    .modal-input:focus {
        border-color: var(--blush);
        box-shadow: 0 0 0 3px rgba(255, 181, 167, 0.2);
        background: var(--card-white);
    }

    .modal-eye-btn {
        position: absolute;
        right: 14px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #BFA992;
        transition: all 0.2s;
    }

    .modal-eye-btn:hover {
        color: var(--blush);
    }

    .modal-eye-btn .eye-slash {
        display: none;
    }

    .modal-eye-btn.showing .eye-open {
        display: none;
    }

    .modal-eye-btn.showing .eye-slash {
        display: block;
    }

    .modal-error {
        font-size: 0.7rem;
        color: #FF9282;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 5px;
        padding-left: 0.5rem;
    }

    .modal-error::before {
        content: '🍰';
        font-size: 0.65rem;
    }

    .modal-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 0.5rem;
    }

    .btn-cancel {
        padding: 0.6rem 1.5rem;
        background: #FEFAF7;
        border: 1.5px solid #FCE4DA;
        border-radius: 60px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #8B735E;
        cursor: pointer;
        transition: all 0.2s;
        font-family: 'Instrument Sans', sans-serif;
    }

    .btn-cancel:hover {
        background: #FFF3EF;
        border-color: var(--blush);
        color: var(--blush);
    }

    .btn-confirm-delete {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.5rem;
        background: linear-gradient(115deg, #FF8A7A 0%, #FF6B58 100%);
        border: none;
        border-radius: 60px;
        font-size: 0.85rem;
        font-weight: 700;
        color: white;
        cursor: pointer;
        transition: all 0.25s ease;
        font-family: 'Instrument Sans', sans-serif;
        box-shadow: 0 4px 12px rgba(255, 107, 88, 0.3);
    }

    .btn-confirm-delete:hover {
        transform: translateY(-2px);
        background: linear-gradient(115deg, #FF9A8A 0%, #FF7A68 100%);
        box-shadow: 0 6px 16px rgba(255, 107, 88, 0.4);
    }

    .btn-confirm-delete:active {
        transform: translateY(1px);
    }

    /* Responsive */
    @media (max-width: 640px) {
        .pastel-delete-section {
            padding: 1.5rem;
            border-radius: 28px;
        }
        
        .delete-title {
            font-size: 1.4rem;
        }
        
        .modal-title {
            font-size: 1.3rem;
        }
        
        .modal-actions {
            flex-direction: column;
        }
        
        .btn-cancel, .btn-confirm-delete {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">

<script>
    function toggleDeletePasswordVisibility() {
        const passwordField = document.getElementById('delete_account_password');
        const button = document.querySelector('#delete_account_password')?.closest('.password-input-wrapper')?.querySelector('.modal-eye-btn');
        
        if (passwordField && button) {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                button.classList.add('showing');
            } else {
                passwordField.type = 'password';
                button.classList.remove('showing');
            }
        }
    }
</script>