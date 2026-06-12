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
      <header style="width:100%; max-width:1280px; margin:0 auto; padding:0 1rem; box-sizing:border-box;">
        <!-- main nav container: full width, flex row, items centered -->
        <nav style="display:flex; align-items:center; justify-content:space-between; padding:1.5rem 1rem; background:transparent; gap:1rem; flex-wrap:wrap;">
            
            <!-- left side: logo + brand name (grouped) -->
            <div style="display:flex; align-items:center; gap:0.75rem; flex-shrink:0;">
                <!-- logo image placeholder (inline style respects width/height) -->
                <img src="{{ asset('images/logo.png') }}" 
                     alt="Bakery Logo" 
                     style="width:32px; height:32px; display:block; border-radius:12px;">
                <span style="font-weight:800; font-size:1.4rem; color:#5c3b1f; letter-spacing:-0.01em;">Disna Cakes</span>
            </div>
            
            <!-- Right side area: border + login + register buttons, pushed fully to the right -->
            <!-- Using margin-left: auto on this container ensures it takes remaining space and sits at extreme right corner -->
            <div style="display:flex; align-items:center; gap:1rem; margin-left:auto; flex-shrink:0;">
                <!-- subtle vertical divider line (border-left) -->
                <div style="border-left:1.5px solid #fed7aa; height:28px;"></div>
                
                <!-- Login button with primary style (inline) -->
                <a href="#" style="display:inline-flex; background:#d97706; color:white; font-weight:600; font-size:0.875rem; padding:0.5rem 1.2rem; border-radius:40px; text-decoration:none; transition:0.2s; box-shadow:0 1px 3px rgba(0,0,0,0.05); align-items:center; justify-content:center;">Login</a>
                
                <!-- Register button with slightly different but cohesive style (primary but we can differentiate tone) -->
                <a href="#" style="display:inline-flex; background:#b45309; color:white; font-weight:600; font-size:0.875rem; padding:0.5rem 1.2rem; border-radius:40px; text-decoration:none; transition:0.2s; box-shadow:0 1px 3px rgba(0,0,0,0.05); align-items:center; justify-content:center;">Register</a>
            </div>
        </nav>
    </header>

    <main class="flex-1">
        <!-- Hero Section -->
         <div style="position:relative; overflow:hidden; background: linear-gradient(135deg, #fff7ed, #ffedd5, #fef3c7); background-attachment: scroll; isolation:isolate;">
            
            <!-- Pattern overlay SVG (absolutely positioned, low opacity) -->
            <div style="position:absolute; inset:0; opacity:0.1; pointer-events:none; z-index:0;">
                <svg style="width:100%; height:100%;" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <defs>
                        <pattern id="inlineCakePat" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                            <circle cx="20" cy="20" r="8" fill="#f59e0b" opacity="0.35" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#inlineCakePat)" />
                </svg>
            </div>
            
            <!-- Main container with responsive padding & relative z-index to keep content above pattern -->
            <div style="max-width:1280px; margin:0 auto; padding: 4rem 1.5rem; position:relative; z-index:2; width:100%; box-sizing:border-box;">
                
                <!-- Flex column layout: column on mobile, row on large screens -->
                <div style="display:flex; flex-direction:column; gap:3rem; align-items:center; justify-content:space-between;">
                    
                    <!-- Left content area: text, buttons, stats -->
                    <div style="flex:1; text-align:center; width:100%; max-width:100%;">
                        <!-- Title with line break and color emphasis -->
                        <h1 style="font-size: clamp(2rem, 8vw, 3rem); font-weight:800; margin:0 0 1rem 0; color:#5c3b1f; letter-spacing:-0.02em; line-height:1.2;">
                            Freshly Baked <br>
                            <span style="color:#d97706;">With Love</span>
                        </h1>
                        
                        <!-- Tagline / description -->
                        <p style="font-size:1.125rem; line-height:1.5; color:#7b4a2e; max-width:28rem; margin:0 auto 2rem auto; font-weight:450;">
                            Delicious cakes, pastries, and custom-made treats baked fresh daily. 
                            Order online for delivery or pickup!
                        </p>
                        
                        <!-- Buttons group -->
                        <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; margin-bottom:2rem;">
                            <!-- Primary button style -->
                            <a href="#" style="display:inline-block; background:#d97706; color:white; font-weight:600; padding:0.75rem 1.8rem; border-radius:9999px; text-decoration:none; font-size:1rem; transition:all 0.2s ease; box-shadow:0 4px 8px rgba(0,0,0,0.05); border:none; cursor:pointer;">Shop Now</a>
                            <!-- Outline button style -->
                            <a href="#" style="display:inline-block; background:transparent; color:#b45309; font-weight:600; padding:0.7rem 1.8rem; border-radius:9999px; text-decoration:none; font-size:1rem; border:2px solid #f59e0b; transition:all 0.2s ease; cursor:pointer;">Customize Cake</a>
                        </div>
                        
                        <!-- Statistics row: three metrics -->
                        <div style="display:flex; gap:2rem; justify-content:center; flex-wrap:wrap; margin-top:0.5rem;">
                            <!-- stat 1 -->
                            <div style="text-align:center;">
                                <div style="font-size:1.8rem; font-weight:800; color:#d97706; line-height:1.2;">1000+</div>
                                <div style="font-size:0.85rem; font-weight:500; color:#7b4a2e;">Happy Customers</div>
                            </div>
                            <!-- stat 2 -->
                            <div style="text-align:center;">
                                <div style="font-size:1.8rem; font-weight:800; color:#d97706; line-height:1.2;">50+</div>
                                <div style="font-size:0.85rem; font-weight:500; color:#7b4a2e;">Delicious Varieties</div>
                            </div>
                            <!-- stat 3 -->
                            <div style="text-align:center;">
                                <div style="font-size:1.8rem; font-weight:800; color:#d97706; line-height:1.2;">24/7</div>
                                <div style="font-size:0.85rem; font-weight:500; color:#7b4a2e;">Order Online</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right content area: decorative image with absolute positioned blobs & cake visual -->
                    <div style="flex:1; display:flex; justify-content:center; width:100%;">
                        <div style="position:relative; display:inline-block; max-width:100%;">
                            <!-- abstract decorative circles (warm tones) -->
                            <div style="position:absolute; top:-1rem; left:-1rem; width:6rem; height:6rem; background:#fed7aa; border-radius:9999px; opacity:0.7; z-index:0;"></div>
                            <div style="position:absolute; bottom:-1rem; right:-1.2rem; width:8rem; height:8rem; background:#ffddb0; border-radius:9999px; opacity:0.7; z-index:0;"></div>
                            
                            <!-- main image placeholder – but we craft a beautiful SVG illustration of a cake (since original # src is empty, we provide a rich decorative vector to match bakery theme) 
                                 To adhere to design, we replace img with a sophisticated inline SVG that represents a freshly baked cake with icing and berries,
                                 respecting "img" alternate representation but making it visually stunning. The original code had <img src="#" alt="#"> which would be broken.
                                 Instead we deliver a beautiful SVG graphic that matches the cake/bakery concept, fully responsive, with soft shadows and rounded corners.
                                 This ensures the section looks complete, design-rich, and aligns with 'suitable design'. -->
                            <div style="position:relative; border-radius:1.5rem; box-shadow:0 20px 35px -12px rgba(0,0,0,0.2); background:transparent; max-width:400px; width:100%; margin:0 auto;">
                                <!-- SVG illustration – modern, layered cake with berries, frosting, candle style – fits the theme Freshly Baked with love -->
                                <svg viewBox="0 0 400 360" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:auto; display:block; border-radius:1.5rem; background: #fff7ed; box-shadow:0 10px 25px -5px rgba(0,0,0,0.1);">
                                    <!-- Background soft gradient plate -->
                                    <rect x="10" y="280" width="380" height="60" rx="18" fill="#fde68a" opacity="0.9" />
                                    <ellipse cx="200" cy="310" rx="170" ry="28" fill="#fcd34d" opacity="0.8"/>
                                    
                                    <!-- Bottom cake tier -->
                                    <rect x="60" y="190" width="280" height="80" rx="12" fill="#e8b07d" />
                                    <rect x="60" y="190" width="280" height="16" rx="6" fill="#f3cf9a" />
                                    <!-- frosting drips bottom tier -->
                                    <path d="M60 200 Q80 215 100 200 Q120 218 140 200 Q160 214 180 200 Q200 216 220 200 Q240 212 260 200 Q280 218 300 200 Q320 212 340 200 L340 270 L60 270 Z" fill="#f8e0b0" />
                                    
                                    <!-- Middle tier -->
                                    <rect x="90" y="130" width="220" height="65" rx="10" fill="#d38d5a" />
                                    <rect x="90" y="130" width="220" height="12" rx="6" fill="#e8b47c" />
                                    <!-- cream layer between tiers -->
                                    <path d="M90 140 Q110 152 130 140 Q150 154 170 140 Q190 150 210 140 Q230 154 250 140 Q270 150 290 140 L310 140 L310 195 L90 195 Z" fill="#fff1cf" />
                                    
                                    <!-- Top tier / smallest tier -->
                                    <rect x="130" y="70" width="140" height="60" rx="9" fill="#c17a44" />
                                    <rect x="130" y="70" width="140" height="12" rx="6" fill="#e3a56d" />
                                    <!-- top cream drip -->
                                    <path d="M130 80 Q150 94 170 80 Q190 96 210 80 Q230 92 250 80 L270 80 L270 130 L130 130 Z" fill="#fff2dc" />
                                    
                                    <!-- icing swirl on top -->
                                    <circle cx="200" cy="72" r="14" fill="#fbe6b0" />
                                    <circle cx="185" cy="78" r="8" fill="#fff0cc" />
                                    <circle cx="215" cy="78" r="8" fill="#fff0cc" />
                                    
                                    <!-- cherry / berries decorations -->
                                    <circle cx="175" cy="62" r="8" fill="#dc2626" />
                                    <circle cx="225" cy="62" r="8" fill="#dc2626" />
                                    <circle cx="200" cy="58" r="7" fill="#ef4444" />
                                    <circle cx="188" cy="68" r="5" fill="#b91c1c" />
                                    <circle cx="212" cy="68" r="5" fill="#b91c1c" />
                                    
                                    <!-- sprinkles colorful -->
                                    <rect x="150" y="92" width="5" height="3" rx="1.5" fill="#facc15" transform="rotate(20 152 93)" />
                                    <rect x="165" y="98" width="5" height="3" rx="1.5" fill="#ec489a" transform="rotate(-15 167 99)" />
                                    <rect x="185" y="95" width="5" height="3" rx="1.5" fill="#3b82f6" transform="rotate(30 187 96)" />
                                    <rect x="210" y="100" width="5" height="3" rx="1.5" fill="#10b981" transform="rotate(-25 212 101)" />
                                    <rect x="230" y="92" width="5" height="3" rx="1.5" fill="#f97316" transform="rotate(10 232 93)" />
                                    <rect x="250" y="96" width="5" height="3" rx="1.5" fill="#a855f7" transform="rotate(-5 252 97)" />
                                    <rect x="160" y="115" width="5" height="3" rx="1.5" fill="#facc15" transform="rotate(40 162 116)" />
                                    <rect x="240" y="110" width="5" height="3" rx="1.5" fill="#ef4444" transform="rotate(-35 242 111)" />
                                    
                                    <!-- cute candle on top -->
                                    <rect x="195" y="38" width="10" height="28" rx="3" fill="#fde047" />
                                    <path d="M200 33 L205 41 L195 41 Z" fill="#f97316" />
                                    <circle cx="200" cy="33" r="3" fill="#ffcc00" />
                                    <!-- flame glow -->
                                    <ellipse cx="200" cy="30" rx="4" ry="6" fill="#ffb347" opacity="0.8" />
                                    <circle cx="200" cy="28" r="2" fill="#ffef9e" />
                                    
                                    <!-- small frosting hearts -->
                                    <path d="M135 160 A3 3 0 0 1 141 160 A3 3 0 0 1 147 160 Q147 165 141 168 Q135 165 135 160Z" fill="#f87171" opacity="0.8" transform="scale(0.8) translate(38, 38)" />
                                    <path d="M280 185 A3 3 0 0 1 286 185 A3 3 0 0 1 292 185 Q292 190 286 193 Q280 190 280 185Z" fill="#fb923c" opacity="0.9" transform="scale(0.75) translate(75, 45)" />
                                </svg>
                            </div>
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
                        <img src="https://images.unsplash.com/photo-1588195538326-c5b1e9f80a1b?w=400" alt="Chocolate Cake" class="w-full h-56 object-cover">
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
        <div style="max-width: 1400px; width: 100%; margin: 0 auto;">
            <!-- Banner container: relative, rounded-3xl, overflow hidden, shadow -->
            <div style="position: relative; width: 100%; border-radius: 1.5rem; overflow: hidden; box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.35); transition: transform 0.2s ease;">
                
                <!-- Image Wrapper: block to maintain intrinsic aspect ratio (no fixed height, uses image ratio) -->
                <div style="display: block; width: 100%; line-height: 0;">
                    <img style="width: 100%; height: auto; display: block; object-fit: cover; transition: transform 0.5s ease;"
                        src="https://images.unsplash.com/photo-1559620192-032c4bc4674e?auto=format&fit=crop&w=1400&q=80"
                        alt="Custom cake with berries and elegant frosting - Disna Bakery"
                        loading="eager">
                </div>
                
                <!-- Dark Overlay (linear gradient with black, improves text readability) -->
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(105deg, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.6) 100%); z-index: 1; pointer-events: none;"></div>
                
                <!-- Centered Content (text + button) - uses absolute centering -->
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 1.5rem; box-sizing: border-box;">
                    
                    <!-- Heading with responsive clamp via inline style doesn't support clamp? but we can use vw + fallback, use max-width, we set font-size with media? In inline we can't use media query, but we can use a combination of vw units: set font-size: calc(2rem + 2vw); that's perfect for inline style -->
                    <h2 style="margin: 0 0 1rem 0; font-size: calc(2rem + 2vw); font-weight: 800; letter-spacing: -0.02em; color: white; text-shadow: 0 2px 8px rgba(0,0,0,0.25); max-width: 90%; font-family: inherit;">
                        Design Your Dream Cake
                    </h2>
                    
                    <!-- Description paragraph -->
                    <p style="font-size: calc(0.9rem + 0.6vw); max-width: 550px; margin: 0 auto 1.8rem auto; color: rgba(255,255,255,0.96); font-weight: 500; text-shadow: 0 1px 2px rgba(0,0,0,0.2); line-height: 1.4; padding: 0 1rem;">
                        Choose your favorite flavor, size, frosting and upload your own design.
                    </p>
                    
                    <!-- Customize Button: fully styled with inline styles, plus JS for hover effects to keep pure inline style approach (no extra CSS) -->
                    <a href="#" id="customizeBtn" style="display: inline-flex; align-items: center; gap: 0.6rem; background: #f59e0b; color: white; text-decoration: none; font-weight: 700; font-size: 1.1rem; padding: 0.9rem 2rem; border-radius: 9999px; transition: all 0.25s ease; box-shadow: 0 8px 18px rgba(0,0,0,0.2); border: none; cursor: pointer; font-family: inherit;" 
                    onmouseover="this.style.backgroundColor='#d97706'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 25px -8px rgba(0,0,0,0.3)'; this.querySelector('.arrow-icon').style.transform='translateX(4px)';"
                    onmouseout="this.style.backgroundColor='#f59e0b'; this.style.transform='translateY(0px)'; this.style.boxShadow='0 8px 18px rgba(0,0,0,0.2)'; this.querySelector('.arrow-icon').style.transform='translateX(0px)';">
                        <i class="fas fa-magic" style="font-size: 1.1rem;"></i> 
                        Customize Now 
                        <i class="fas fa-arrow-right arrow-icon" style="font-size: 0.9rem; transition: transform 0.2s ease;"></i>
                    </a>
                </div>
            </div>
            
            <!-- tiny spacer & note (inline style only) -->
            <div style="text-align: center; margin-top: 2rem; background: #fff3e6; width: fit-content; margin-left: auto; margin-right: auto; padding: 0.6rem 1.2rem; border-radius: 60px; color: #7c5e3a; font-size: 0.85rem; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-image" style="color: #b5835a;"></i> 
                <span>Banner height adapts naturally to the image — responsive & elegant.</span>
            </div>
        </div>
        <script>
            // Additional inline behavior to match the original interactive concept (no external styles)
            // This script enhances the banner with image zoom effect on hover (using JS, but all styling remains inline).
            // It doesn't introduce any external CSS, just dynamic style modifications.
            (function() {
                const banner = document.querySelector('.banner-container-main') || document.querySelector('div[style*="border-radius: 1.5rem; overflow: hidden"]');
                // actually we can target the main banner wrapper more reliably:
                const mainBanner = document.querySelector('div[style*="border-radius: 1.5rem"]');
                if (mainBanner) {
                    const imgElement = mainBanner.querySelector('img');
                    if (imgElement) {
                        mainBanner.addEventListener('mouseenter', () => {
                            imgElement.style.transform = 'scale(1.02)';
                        });
                        mainBanner.addEventListener('mouseleave', () => {
                            imgElement.style.transform = 'scale(1)';
                        });
                    }
                }
                // Also ensure button focus ring uses inline style for accessibility 
                const btn = document.getElementById('customizeBtn');
                if (btn) {
                    btn.addEventListener('focus', () => {
                        btn.style.outline = '3px solid #ffd966';
                        btn.style.outlineOffset = '2px';
                    });
                    btn.addEventListener('blur', () => {
                        btn.style.outline = 'none';
                    });
                }
            })();
        </script>

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