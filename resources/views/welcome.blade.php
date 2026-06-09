<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disna Cakes - Fresh Baked Goods & Custom Cakes</title>

     <!-- logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">

    <style>
        /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
        @layer theme {
            :root, :host {
                --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                --color-amber-50: #fffbeb;
                --color-amber-100: #fef3c7;
                --color-amber-200: #fde68a;
                --color-amber-300: #fcd34d;
                --color-amber-400: #fbbf24;
                --color-amber-500: #f59e0b;
                --color-amber-600: #d97706;
                --color-amber-700: #b45309;
                --color-amber-800: #92400e;
                --color-amber-900: #78350f;
                --color-orange-50: #fff7ed;
                --color-orange-100: #ffedd5;
                --color-orange-200: #fed7aa;
                --color-orange-300: #fdba74;
                --color-orange-400: #fb923c;
                --color-orange-500: #f97316;
                --color-orange-600: #ea580c;
                --color-orange-700: #c2410c;
                --color-orange-800: #9a3412;
                --color-orange-900: #7c2d12;
                --color-brown-50: #faf7f2;
                --color-brown-100: #f0e9df;
                --color-brown-200: #e2d4c5;
                --color-brown-300: #d0bdab;
                --color-brown-400: #b99e88;
                --color-brown-500: #9e7f66;
                --color-brown-600: #826349;
                --color-brown-700: #664b35;
                --color-brown-800: #4d3624;
                --color-brown-900: #362518;
                --color-cream-50: #fefdfa;
                --color-cream-100: #fef9f0;
                --color-cream-200: #fdf2e1;
                --color-cream-300: #fce8cc;
                --color-cream-400: #faddb5;
                --color-cream-500: #f7ce99;
                --color-cream-600: #f0bc78;
                --color-cream-700: #e5a655;
                --color-red-500: #ef4444;
                --color-green-500: #10b981;
                --color-white: #fff;
                --color-black: #000;
                --spacing: .25rem;
                --text-xs: .75rem;
                --text-sm: .875rem;
                --text-base: 1rem;
                --text-lg: 1.125rem;
                --text-xl: 1.25rem;
                --text-2xl: 1.5rem;
                --text-3xl: 1.875rem;
                --text-4xl: 2.25rem;
                --font-weight-normal: 400;
                --font-weight-medium: 500;
                --font-weight-semibold: 600;
                --font-weight-bold: 700;
                --radius-sm: .25rem;
                --radius-lg: .5rem;
                --radius-xl: .75rem;
                --radius-2xl: 1rem;
                --shadow-sm: 0 1px 3px 0 rgba(0,0,0,0.1);
                --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
                --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
                --ease-in-out: cubic-bezier(0.4, 0, 0.2, 1);
            }
        }

        @layer base {
            *, :after, :before, ::backdrop {
                box-sizing: border-box;
                border: 0 solid;
                margin: 0;
                padding: 0;
            }
            html {
                -webkit-text-size-adjust: 100%;
                tab-size: 4;
                line-height: 1.5;
                font-family: var(--font-sans);
            }
            body {
                line-height: inherit;
                background: linear-gradient(135deg, #fef9f0 0%, #fdf2e1 100%);
                color: #4d3624;
            }
            a {
                color: inherit;
                text-decoration: none;
            }
            img, svg {
                display: block;
                vertical-align: middle;
            }
            button {
                font: inherit;
                cursor: pointer;
            }
        }

        @layer components {
            .btn-primary {
                background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
                color: white;
                padding: 0.5rem 1.5rem;
                border-radius: 9999px;
                font-weight: 600;
                transition: all 0.3s;
                box-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
            }
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 20px rgba(245, 158, 11, 0.4);
            }
            .btn-outline {
                border: 2px solid #f59e0b;
                color: #b45309;
                padding: 0.5rem 1.5rem;
                border-radius: 9999px;
                font-weight: 600;
                transition: all 0.3s;
            }
            .btn-outline:hover {
                background: #f59e0b;
                color: white;
            }
            .card {
                background: white;
                border-radius: 1rem;
                box-shadow: 0 4px 15px rgba(0,0,0,0.08);
                transition: all 0.3s;
                overflow: hidden;
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0,0,0,0.12);
            }
            .bakery-gradient {
                background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
            }
        }

        @layer utilities {
            .absolute { position: absolute; }
            .relative { position: relative; }
            .inset-0 { inset: calc(var(--spacing)*0); }
            .flex { display: flex; }
            .grid { display: grid; }
            .hidden { display: none; }
            .inline-block { display: inline-block; }
            .inline-flex { display: inline-flex; }
            .w-full { width: 100%; }
            .max-w-4xl { max-width: 56rem; }
            .max-w-\[335px\] { max-width: 335px; }
            .min-h-screen { min-height: 100vh; }
            .flex-col { flex-direction: column; }
            .items-center { align-items: center; }
            .justify-center { justify-content: center; }
            .justify-between { justify-content: space-between; }
            .justify-end { justify-content: flex-end; }
            .gap-2 { gap: calc(var(--spacing)*2); }
            .gap-3 { gap: calc(var(--spacing)*3); }
            .gap-4 { gap: calc(var(--spacing)*4); }
            .gap-6 { gap: calc(var(--spacing)*6); }
            .p-4 { padding: calc(var(--spacing)*4); }
            .p-6 { padding: calc(var(--spacing)*6); }
            .p-8 { padding: calc(var(--spacing)*8); }
            .px-4 { padding-inline: calc(var(--spacing)*4); }
            .px-5 { padding-inline: calc(var(--spacing)*5); }
            .px-6 { padding-inline: calc(var(--spacing)*6); }
            .py-1\.5 { padding-block: calc(var(--spacing)*1.5); }
            .py-2 { padding-block: calc(var(--spacing)*2); }
            .py-3 { padding-block: calc(var(--spacing)*3); }
            .py-16 { padding-block: calc(var(--spacing)*16); }
            .mb-1 { margin-bottom: calc(var(--spacing)*1); }
            .mb-2 { margin-bottom: calc(var(--spacing)*2); }
            .mb-4 { margin-bottom: calc(var(--spacing)*4); }
            .mb-6 { margin-bottom: calc(var(--spacing)*6); }
            .mt-2 { margin-top: calc(var(--spacing)*2); }
            .mt-4 { margin-top: calc(var(--spacing)*4); }
            .mt-8 { margin-top: calc(var(--spacing)*8); }
            .mt-12 { margin-top: calc(var(--spacing)*12); }
            .text-center { text-align: center; }
            .text-sm { font-size: var(--text-sm); line-height: 1.25rem; }
            .text-base { font-size: var(--text-base); line-height: 1.5rem; }
            .text-lg { font-size: var(--text-lg); line-height: 1.75rem; }
            .text-xl { font-size: var(--text-xl); line-height: 1.75rem; }
            .text-2xl { font-size: var(--text-2xl); line-height: 2rem; }
            .text-3xl { font-size: var(--text-3xl); line-height: 2.25rem; }
            .text-4xl { font-size: var(--text-4xl); line-height: 2.5rem; }
            .font-medium { font-weight: var(--font-weight-medium); }
            .font-semibold { font-weight: var(--font-weight-semibold); }
            .font-bold { font-weight: var(--font-weight-bold); }
            .text-amber-600 { color: #d97706; }
            .text-amber-700 { color: #b45309; }
            .text-brown-700 { color: #664b35; }
            .text-brown-800 { color: #4d3624; }
            .text-cream-800 { color: #8b7355; }
            .text-white { color: white; }
            .bg-white { background-color: white; }
            .bg-amber-500 { background-color: #f59e0b; }
            .bg-orange-600 { background-color: #ea580c; }
            .bg-cream-100 { background-color: #fef9f0; }
            .rounded-full { border-radius: 9999px; }
            .rounded-lg { border-radius: var(--radius-lg); }
            .rounded-xl { border-radius: var(--radius-xl); }
            .rounded-2xl { border-radius: var(--radius-2xl); }
            .rounded-sm { border-radius: var(--radius-sm); }
            .shadow-lg { box-shadow: var(--shadow-lg); }
            .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
            .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .border { border-style: solid; border-width: 1px; }
            .border-\[\#19140035\] { border-color: #19140035; }
            .border-transparent { border-color: transparent; }
            .border-l { border-left-style: solid; border-left-width: 1px; }
            .border-cream-300 { border-color: #fce8cc; }
            .border-brown-700 { border-color: #664b35; }
            .leading-normal { line-height: var(--leading-normal); }
            .not-has-\[nav\]\:hidden:not(:has(:is(nav))) { display: none; }
            @media (min-width: 768px) {
                .md\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
                .md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
                .md\:flex-row { flex-direction: row; }
                .md\:p-12 { padding: calc(var(--spacing)*12); }
                .md\:text-4xl { font-size: var(--text-4xl); line-height: 2.5rem; }
            }
            @media (min-width: 1024px) {
                .lg\:max-w-4xl { max-width: 56rem; }
                .lg\:flex-row { flex-direction: row; }
                .lg\:text-left { text-align: left; }
                .lg\:p-24 { padding: calc(var(--spacing)*24); }
            }
            @media (hover: hover) {
                .hover\:border-\[\#1915014a\]:hover { border-color: #1915014a; }
                .hover\:border-\[\#19140035\]:hover { border-color: #19140035; }
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Header with Laravel-style auth links -->
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden mx-auto mt-4">
        <nav class="flex items-center justify-between px-6 py-6">
            <div class="flex items-center gap-2">
               <img src="{{ asset('images/logo.png') }}" alt="Bakery Logo" width="32" height="32">
               <span class="font-bold text-xl text-brown-800">Disna Cakes</span>
            </div>
            <div class="flex items-center gap-4 mt-2 sm:mt-0 ml-auto">
                <div class="border-l border-cream-300 h-6"></div>
                <a href="{{ route('login') }}" class="btn-primary text-sm">Login</a>
                <a href="{{ route('register') }}" class="btn-primary text-sm">Register</a>
            </div>
        </nav>
    </header>

    <main class="flex-1">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-br from-amber-50 via-orange-50 to-cream-100">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="cakePattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                            <circle cx="20" cy="20" r="8" fill="#f59e0b" opacity="0.3"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#cakePattern)"/>
                </svg>
            </div>
            <div class="container mx-auto px-4 py-16 lg:py-24 relative">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="flex-1 text-center lg:text-left">
                        <h1 class="text-4xl lg:text-5xl font-bold text-brown-800 mb-4">
                            Freshly Baked <br>
                            <span class="text-amber-600">With Love</span>
                        </h1>
                        <p class="text-lg text-brown-600 mb-8 max-w-lg mx-auto lg:mx-0">
                            Delicious cakes, pastries, and custom-made treats baked fresh daily. 
                            Order online for delivery or pickup!
                        </p>
                        <div class="flex gap-4 justify-center lg:justify-start">
                            <a href="#" class="btn-primary px-6 py-3">Shop Now</a>
                            <a href="#" class="btn-outline px-6 py-3">Customize Cake</a>
                        </div>
                        <div class="flex gap-8 mt-8 justify-center lg:justify-start">
                            <div>
                                <div class="text-2xl font-bold text-amber-600">1000+</div>
                                <div class="text-sm text-brown-500">Happy Customers</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-amber-600">50+</div>
                                <div class="text-sm text-brown-500">Delicious Varieties</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-amber-600">24/7</div>
                                <div class="text-sm text-brown-500">Order Online</div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute -top-4 -left-4 w-24 h-24 bg-amber-200 rounded-full opacity-60"></div>
                            <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-orange-200 rounded-full opacity-60"></div>
                            <img src="https://images.unsplash.com/photo-1578985545062-69928b1c958e?w=500" 
                                 alt="Delicious Cake" 
                                 class="relative rounded-2xl shadow-2xl w-full max-w-md mx-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Categories -->
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-3xl font-bold text-center text-brown-800 mb-2">Shop by Category</h2>
            <p class="text-center text-brown-500 mb-12">Find your favorite baked goods</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="card text-center p-6 cursor-pointer">
                    <div class="w-20 h-20 mx-auto bg-amber-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0c-.454-.303-.977-.454-1.5-.454"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-brown-800">Cakes</h3>
                    <p class="text-sm text-brown-500 mt-1">24 items</p>
                </div>
                <div class="card text-center p-6 cursor-pointer">
                    <div class="w-20 h-20 mx-auto bg-amber-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 20h14"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-brown-800">Pastries</h3>
                    <p class="text-sm text-brown-500 mt-1">18 items</p>
                </div>
                <div class="card text-center p-6 cursor-pointer">
                    <div class="w-20 h-20 mx-auto bg-amber-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M6 14h12m-6-8v4m0 8v-4"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-brown-800">Bread</h3>
                    <p class="text-sm text-brown-500 mt-1">15 items</p>
                </div>
                <div class="card text-center p-6 cursor-pointer">
                    <div class="w-20 h-20 mx-auto bg-amber-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m-3-9h.01M15 9h.01M9 15h.01M15 15h.01"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-brown-800">Cookies</h3>
                    <p class="text-sm text-brown-500 mt-1">20 items</p>
                </div>
            </div>
        </div>

        <!-- Featured Products -->
        <div class="bg-cream-100 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-brown-800 mb-2">Featured Products</h2>
                <p class="text-center text-brown-500 mb-12">Our most popular baked goods</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1578985545062-69928b1c958e?w=400" alt="Chocolate Cake" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-lg text-brown-800">Chocolate Cake</h3>
                                <span class="text-amber-600 font-bold">$25.99</span>
                            </div>
                            <p class="text-brown-600 text-sm mb-4">Rich chocolate cake with creamy chocolate ganache</p>
                            <button class="w-full btn-primary py-2">Add to Cart</button>
                        </div>
                    </div>
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1586985289688-ca3cf47d3e6e?w=400" alt="Vanilla Cupcake" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-lg text-brown-800">Vanilla Cupcake</h3>
                                <span class="text-amber-600 font-bold">$3.99</span>
                            </div>
                            <p class="text-brown-600 text-sm mb-4">Light vanilla cupcake with buttercream frosting</p>
                            <button class="w-full btn-primary py-2">Add to Cart</button>
                        </div>
                    </div>
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400" alt="Croissant" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-lg text-brown-800">Butter Croissant</h3>
                                <span class="text-amber-600 font-bold">$2.99</span>
                            </div>
                            <p class="text-brown-600 text-sm mb-4">Flaky, buttery French croissant baked fresh</p>
                            <button class="w-full btn-primary py-2">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-12">
                    <a href="#" class="btn-outline px-8 py-3 inline-block">View All Products →</a>
                </div>
            </div>
        </div>

        <!-- Custom Cake Banner -->
        <div class="container mx-auto px-4 py-16">
            <div class="bakery-gradient rounded-2xl p-8 md:p-12 text-center text-white relative overflow-hidden">
                <div class="relative z-10">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0c-.454-.303-.977-.454-1.5-.454"></path>
                    </svg>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Design Your Own Cake</h2>
                    <p class="text-lg mb-6 opacity-95">Choose size, flavor, add a message, and upload your design!</p>
                    <a href="#" class="inline-block bg-white text-amber-600 px-8 py-3 rounded-full font-semibold hover:shadow-lg transition-all">
                        Customize Now →
                    </a>
                </div>
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="bg-cream-100 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-brown-800 mb-12">What Our Customers Say</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-6">
                        <div class="flex text-amber-500 mb-4">
                            ★★★★★
                        </div>
                        <p class="text-brown-600 mb-4">"The best bakery in town! Their custom cake for my birthday was absolutely perfect. Highly recommend!"</p>
                        <div class="font-semibold text-brown-800">- Sarah Johnson</div>
                    </div>
                    <div class="card p-6">
                        <div class="flex text-amber-500 mb-4">
                            ★★★★★
                        </div>
                        <p class="text-brown-600 mb-4">"Fresh pastries every morning. The croissants are to die for! Fast delivery too."</p>
                        <div class="font-semibold text-brown-800">- Michael Chen</div>
                    </div>
                    <div class="card p-6">
                        <div class="flex text-amber-500 mb-4">
                            ★★★★★
                        </div>
                        <p class="text-brown-600 mb-4">"Easy online ordering and beautiful cake designs. Will definitely order again!"</p>
                        <div class="font-semibold text-brown-800">- Emily Rodriguez</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-brown-800 text-white py-12 mt-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 4L4 12V28H28V12L16 4Z" fill="#f59e0b" stroke="#fff" stroke-width="1.5"/>
                            <circle cx="16" cy="20" r="4" fill="#fff" stroke="#fff" stroke-width="1"/>
                        </svg>
                        <span class="font-bold text-xl">Sweet Bakery</span>
                    </div>
                    <p class="text-cream-300 text-sm">Fresh baked goods delivered to your doorstep with love.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-cream-300 text-sm">
                        <li><a href="#" class="hover:text-amber-400">About Us</a></li>
                        <li><a href="#" class="hover:text-amber-400">Products</a></li>
                        <li><a href="#" class="hover:text-amber-400">Custom Cake</a></li>
                        <li><a href="#" class="hover:text-amber-400">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-cream-300 text-sm">
                        <li>📍 123 Bakery Street, Food City</li>
                        <li>📞 +1 234 567 8900</li>
                        <li>✉️ info@sweetbakery.com</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Opening Hours</h4>
                    <ul class="space-y-2 text-cream-300 text-sm">
                        <li>Mon-Fri: 8:00 AM - 8:00 PM</li>
                        <li>Sat-Sun: 9:00 AM - 6:00 PM</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-brown-700 mt-8 pt-8 text-center text-cream-300 text-sm">
                <p>&copy; 2024 Sweet Bakery. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>