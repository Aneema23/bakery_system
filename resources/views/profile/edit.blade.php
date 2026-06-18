<x-app-layout>
    <x-slot name="header">
        <div class="pastel-header-wrapper">
            <h2 class="pastel-header-title">
                {{ __('My Profile') }}
            </h2>
            <p class="pastel-header-subtitle">{{ __('Manage your account settings and preferences') }}</p>
        </div>
    </x-slot>

    <div class="pastel-profile-container">
        <div class="pastel-profile-grid">
            <!-- Profile Information Card -->
            <div class="pastel-card">
                <div class="pastel-card-content">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="pastel-card">
                <div class="pastel-card-content">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="pastel-card pastel-card-delete">
                <div class="pastel-card-content">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Pastel Color Palette */
        :root {
            --blush: #FFB5A7;
            --blush-dark: #FF9A8B;
            --blush-light: #FFE4DC;
            --mint: #C7E9D0;
            --mint-light: #E8F5EC;
            --powder-blue: #B5E2FA;
            --powder-blue-light: #E5F4FC;
            --vanilla: #FFF5E6;
            --canvas: #FAFAFA;
            --cream-bg: #FFF9F5;
            --text-warm: #6F4E37;
            --text-soft: #7C6954;
            --text-light: #A48E78;
            --border-soft: #FCE4DA;
            --card-white: #FFFFFF;
            --shadow-pastel: 0 12px 28px -12px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(255, 181, 167, 0.12);
            --shadow-hover: 0 18px 32px -14px rgba(255, 181, 167, 0.2), 0 0 0 1px rgba(255, 181, 167, 0.2);
        }

        /* ========== HEADER STYLES ========== */
        .pastel-header-wrapper {
            background: linear-gradient(115deg, #6F4E37 0%, #8B6F55 100%);
            padding: 1.8rem 2rem;
            border-radius: 32px;
            margin-bottom: 0.5rem;
            box-shadow: var(--shadow-pastel);
        }

        .pastel-header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.85rem;
            font-weight: 700;
            color: #FFFFFF;
            letter-spacing: -0.3px;
            margin-bottom: 0.3rem;
        }

        .pastel-header-subtitle {
            font-size: 0.9rem;
            color: #FEFAF7;
            font-weight: 500;
            opacity: 0.9;
        }

        /* Main Container */
        .pastel-profile-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        .pastel-profile-grid {
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
        }

        /* Cards */
        .pastel-card {
            background: var(--card-white);
            border-radius: 32px;
            box-shadow: var(--shadow-pastel);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .pastel-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-3px);
        }

        .pastel-card-content {
            padding: 1.8rem;
        }

        /* Card Delete Account - subtle accent */
        .pastel-card-delete {
            border-left: 4px solid var(--blush);
        }

        /* Form Styles inside cards */
        .pastel-card .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-soft);
            margin-bottom: 0.5rem;
            display: block;
        }

        .pastel-card .form-control {
            width: 100%;
            padding: 0.85rem 1.2rem;
            background: var(--cream-bg);
            border: 1.5px solid var(--border-soft);
            border-radius: 48px;
            font-size: 0.95rem;
            color: #4F3E2E;
            transition: all 0.2s ease;
            outline: none;
        }

        .pastel-card .form-control:focus {
            border-color: var(--blush);
            box-shadow: 0 0 0 4px rgba(255, 181, 167, 0.2);
            background: var(--card-white);
        }

        .pastel-card .btn-save,
        .pastel-card .btn-update-password {
            background: linear-gradient(115deg, var(--blush) 0%, #FFA191 100%);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 60px;
            font-size: 0.9rem;
            font-weight: 700;
            color: #553E2C;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(255, 181, 167, 0.3);
        }

        .pastel-card .btn-save:hover,
        .pastel-card .btn-update-password:hover {
            transform: translateY(-2px);
            background: linear-gradient(115deg, #FFC2B6 0%, #FFAE9E 100%);
            box-shadow: 0 8px 20px rgba(255, 181, 167, 0.4);
        }

        .pastel-card .btn-delete {
            background: rgba(255, 138, 122, 0.1);
            border: 1.5px solid rgba(255, 138, 122, 0.4);
            color: #D97A6A;
            padding: 0.7rem 1.6rem;
            border-radius: 60px;
            font-weight: 700;
            transition: all 0.25s ease;
        }

        .pastel-card .btn-delete:hover {
            background: rgba(255, 138, 122, 0.2);
            border-color: #FF8A7A;
            transform: translateY(-2px);
        }

        /* Password Strength */
        .pastel-card .strength-bar-bg {
            height: 5px;
            background: #F5EDE6;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .pastel-card .strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.25s ease;
            border-radius: 20px;
        }

        .pastel-card .requirement {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #FEFAF7;
            padding: 0.25rem 0.8rem;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        .pastel-card .requirement.valid {
            background: #F0F7F0;
            color: #8FBC94;
        }

        .pastel-card .save-confirmation {
            background: #F0F7F0;
            color: #8FBC94;
            padding: 0.5rem 1.2rem;
            border-radius: 60px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Modal Styles */
        .pastel-card .delete-modal-content {
            background: var(--card-white);
            border-radius: 32px;
            padding: 2rem;
        }

        .pastel-card .modal-icon {
            width: 64px;
            height: 64px;
            background: rgba(255, 138, 122, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .pastel-card .btn-confirm-delete {
            background: linear-gradient(115deg, #FF8A7A 0%, #FF6B58 100%);
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 60px;
            color: white;
            font-weight: 700;
        }

        .pastel-card .btn-cancel {
            background: #FEFAF7;
            border: 1.5px solid var(--border-soft);
            padding: 0.6rem 1.5rem;
            border-radius: 60px;
            color: var(--text-soft);
            font-weight: 600;
        }

        .pastel-card .btn-cancel:hover {
            background: #FFF3EF;
            border-color: var(--blush);
            color: var(--blush);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .pastel-header-wrapper {
                padding: 1.2rem 1.2rem;
                border-radius: 28px;
                margin: 0 1rem 1rem 1rem;
            }

            .pastel-header-title {
                font-size: 1.5rem;
            }

            .pastel-profile-container {
                padding: 1rem;
            }

            .pastel-card {
                border-radius: 28px;
            }
            
            .pastel-card-content {
                padding: 1.2rem;
            }
        }

        /* Animation for cards */
        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pastel-card {
            animation: cardFadeIn 0.5s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
        }

        .pastel-card:nth-child(1) { animation-delay: 0.05s; }
        .pastel-card:nth-child(2) { animation-delay: 0.1s; }
        .pastel-card:nth-child(3) { animation-delay: 0.15s; }
    </style>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
</x-app-layout>