<nav x-data="{ open: false }" class="pastel-nav">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Custom Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="pastel-logo">
                        <div class="pastel-logo-icon">
                            <img src="{{ asset('images/logo.png') }}" alt="Disna Cakes Logo" style="width: 36px; height: 36px; object-fit: contain;">
                        </div>
                        <span class="pastel-logo-text">Disna Cakes</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="pastel-nav-link">
                        🧁 {{ __('My Bakery') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="pastel-user-btn">
                            <div class="pastel-user-avatar">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="pastel-user-name">{{ Auth::user()->name }}</span>
                            <svg class="pastel-dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="pastel-dropdown-content">
                            <x-dropdown-link :href="route('profile.edit')" class="pastel-dropdown-item">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ __('My Profile') }}
                            </x-dropdown-link>

                            <div class="pastel-dropdown-divider"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="pastel-dropdown-item"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu Button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="pastel-mobile-menu-btn">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden pastel-mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="pastel-mobile-nav-link">
                🧁 {{ __('Dashboard ') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 pastel-mobile-border">
            <div class="px-4">
                <div class="pastel-mobile-user-name">{{ Auth::user()->name }}</div>
                <div class="pastel-mobile-user-email">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="pastel-mobile-nav-link">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ __('My Profile') }}
                    </span>
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="pastel-mobile-nav-link"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            {{ __('Log Out') }}
                        </span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* ========== PASTEL NAVIGATION STYLES ========== */
    :root {
        --pastel-blush: #FFB5A7;
        --pastel-blush-dark: #FF9A8B;
        --pastel-mint: #C7E9D0;
        --pastel-blue: #B5E2FA;
        --pastel-warm: #6F4E37;
        --pastel-soft: #7C6954;
        --pastel-light: #A48E78;
        --pastel-bg: #FFF9F5;
        --pastel-border: #FCE4DA;
        --pastel-card: #FFFFFF;
        --pastel-dark-bg: #2B2B2B;
        --pastel-dark-text: #FEFAF7;
    }

    /* Navigation Container */
    .pastel-nav {
        background: linear-gradient(115deg, #FFFFFF 0%, #FEFAF7 100%);
        border-bottom: 2px solid var(--pastel-border);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.02);
    }

    /* Logo Styles */
    .pastel-logo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .pastel-logo:hover {
        transform: scale(1.02);
    }

    .pastel-logo-icon {
        width: 44px;
        height: 44px;
        background: rgba(255, 181, 167, 0.15);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        overflow: hidden;
    }

    .pastel-logo-icon img {
        width: 32px;
        height: 32px;
        object-fit: contain;
    }

    .pastel-logo:hover .pastel-logo-icon {
        background: rgba(255, 181, 167, 0.25);
        transform: scale(1.05);
    }

    .pastel-logo-text {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.4rem;
        color: var(--pastel-warm);
        letter-spacing: -0.3px;
    }

    .pastel-logo:hover .pastel-logo-text {
        color: var(--pastel-blush);
    }

    /* Navigation Link */
    .pastel-nav-link {
        padding: 0.5rem 1.2rem;
        color: var(--pastel-soft);
        font-weight: 500;
        font-size: 0.95rem;
        text-decoration: none;
        border-radius: 40px;
        transition: all 0.2s ease;
    }

    .pastel-nav-link:hover {
        background: rgba(255, 181, 167, 0.12);
        color: var(--pastel-blush);
    }

    /* Active state for nav link */
    .pastel-nav-link[aria-current="page"],
    .pastel-nav-link.active {
        background: rgba(255, 181, 167, 0.2);
        color: var(--pastel-blush);
        font-weight: 600;
    }

    /* User Dropdown Button */
    .pastel-user-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.45rem 1rem 0.45rem 0.9rem;
        background: var(--pastel-bg);
        border: 1.5px solid var(--pastel-border);
        border-radius: 60px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-weight: 500;
        color: var(--pastel-warm);
    }

    .pastel-user-btn:hover {
        background: #FFF3EF;
        border-color: var(--pastel-blush);
        transform: translateY(-1px);
    }

    .pastel-user-avatar {
        width: 34px;
        height: 34px;
        background: linear-gradient(135deg, var(--pastel-blush) 0%, var(--pastel-blush-dark) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .pastel-user-name {
        font-size: 0.9rem;
        font-weight: 500;
    }

    .pastel-dropdown-arrow {
        width: 1rem;
        height: 1rem;
        fill: currentColor;
    }

    /* Dropdown Menu */
    .pastel-dropdown-content {
        background: var(--pastel-card);
        border-radius: 24px;
        box-shadow: 0 12px 28px -8px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 181, 167, 0.15);
        padding: 0.5rem;
        min-width: 200px;
    }

    .pastel-dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        padding: 0.7rem 1rem;
        color: var(--pastel-soft);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        border-radius: 40px;
        transition: all 0.2s ease;
        background: transparent;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .pastel-dropdown-item:hover {
        background: rgba(255, 181, 167, 0.1);
        color: var(--pastel-blush);
    }

    .pastel-dropdown-divider {
        height: 1px;
        background: var(--pastel-border);
        margin: 0.4rem 0;
    }

    /* Mobile Menu Button */
    .pastel-mobile-menu-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem;
        border-radius: 40px;
        background: transparent;
        border: none;
        cursor: pointer;
        color: var(--pastel-warm);
        transition: all 0.2s;
    }

    .pastel-mobile-menu-btn:hover {
        background: rgba(255, 181, 167, 0.1);
        color: var(--pastel-blush);
    }

    /* Mobile Menu */
    .pastel-mobile-menu {
        background: var(--pastel-card);
        border-top: 1px solid var(--pastel-border);
    }

    .pastel-mobile-nav-link {
        display: block;
        padding: 0.75rem 1.25rem;
        color: var(--pastel-soft);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s;
        margin: 0.25rem 0.5rem;
        border-radius: 40px;
    }

    .pastel-mobile-nav-link:hover {
        background: rgba(255, 181, 167, 0.1);
        color: var(--pastel-blush);
    }

    .pastel-mobile-border {
        border-top: 1px solid var(--pastel-border);
    }

    .pastel-mobile-user-name {
        font-weight: 600;
        font-size: 1rem;
        color: var(--pastel-warm);
    }

    .pastel-mobile-user-email {
        font-size: 0.8rem;
        color: var(--pastel-light);
        margin-top: 0.2rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 640px) {
        .pastel-logo-text {
            font-size: 1.1rem;
        }
        
        .pastel-logo-icon {
            width: 36px;
            height: 36px;
        }
        
        .pastel-logo-icon img {
            width: 28px;
            height: 28px;
        }
    }
</style>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">