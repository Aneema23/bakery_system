<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Disna Cakes | Sweet Custom Treats & Macaron Dreams</title>
    <!-- logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons (free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">  
    <style>

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #FAFAFA; /* Pure Canvas background */
            color: #3b2c1f; /* deep warm tone that works with pastels */
            scroll-behavior: smooth;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Pastel Color Palette Override */
        :root {
            --blush: #FFB5A7;       /* Strawberry Cream (primary accent) */
            --mint: #C7E9D0;        /* Soft Mint Green */
            --powder-blue: #B5E2FA; /* Macaron Blue */
            --vanilla: #FFF5E6;     /* Creamy Vanilla (light cream) */
            --canvas: #FAFAFA;
            --dark-accent: #5E4B3A;
            --text-soft: #4a3a2c;
            --card-white: #FFFFFF;
            --shadow-soft: 0 12px 28px -8px rgba(0, 0, 0, 0.06), 0 2px 4px rgba(0, 0, 0, 0.02);
            --hover-lift: 0 20px 30px -12px rgba(0, 0, 0, 0.12);
        }

        /* Typography & Links */
        h1, h2, h3, .logo-text, .brand-name {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.01em;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* custom buttons */
        .btn-primary {
            background: linear-gradient(105deg, #FFB5A7 0%, #FF9A8B 100%);
            color: #4A3424;
            font-weight: 600;
            padding: 0.7rem 1.8rem;
            border-radius: 48px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 10px rgba(255, 181, 167, 0.3);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            background: linear-gradient(105deg, #FFC3B7 0%, #FFAF9F 100%);
            box-shadow: 0 12px 20px -8px rgba(255, 181, 167, 0.5);
        }

        .btn-outline {
            border: 2px solid #FFB5A7;
            background: transparent;
            color: #5E4B3A;
            padding: 0.6rem 1.8rem;
            border-radius: 48px;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline:hover {
            background: rgba(255, 181, 167, 0.12);
            border-color: #FF9A8B;
            transform: translateY(-1px);
        }

        .card {
            background: var(--card-white);
            border-radius: 28px;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-lift);
        }

        /* category cards custom */
        .category-card {
            background: white;
            border-radius: 32px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.25s;
            box-shadow: var(--shadow-soft);
            cursor: pointer;
        }

        .category-card:hover {
            transform: scale(1.02);
            background: #FFFBF7;
            box-shadow: 0 18px 30px -12px rgba(0,0,0,0.08);
        }

        .icon-circle {
            background: #FFF2EC;
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem auto;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .category-card:hover .icon-circle {
            background: #FFE4DC;
        }

        .icon-circle i {
            font-size: 2.2rem;
            color: #FFA294;
        }

        /* gradient hero background */
        .hero-gradient-bg {
            background: linear-gradient(125deg, #FFF9F5 0%, #FEF3EE 40%, #F2FAF4 100%);
            position: relative;
            isolation: isolate;
        }

        /* mint & blue decorative elements */
        .bg-mint-soft {
            background-color: #C7E9D0;
        }
        .bg-powder-blue {
            background-color: #B5E2FA;
        }
        .text-blush {
            color: #FFB5A7;
        }

        footer {
            background-color: #F2E9E0;
            color: #5A4A38;
            border-top: 1px solid #EADDCB;
        }

        .footer-link {
            color: #75624E;
            transition: color 0.2s;
        }
        .footer-link:hover {
            color: #FFB5A7;
        }

        /* stats */
        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #FFB5A7;
            font-family: 'Playfair Display', serif;
        }

        /* responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 1.25rem;
            }
            .stat-number {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>

    <!-- Header with blush / vanilla vibe -->
    <header class="container" style="padding-top: 1rem; padding-bottom: 0.5rem;">
        <nav style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
            <!-- Logo + Brand -->
            <div style="display: flex; align-items: center; gap: 12px;">
                    <img src="{{ asset('images/logo.png') }}" alt="Disna Cakes Logo" style="width: 40px; height: 40px;">
                <span class="logo-text" style="font-weight: 700; font-size: 1.6rem; color: #6F4E37; letter-spacing: -0.3px;">Disna Cakes</span>
            </div>
            <!-- Auth buttons -->
            <div style="display: flex; gap: 1rem; align-items: center;">
                <div style="border-left: 2px solid #FFD9CF; height: 32px;"></div>
                <a href="{{ route('login') }}" style="background: #FFB5A7; color: #3E2C21; font-weight: 600; padding: 0.5rem 1.4rem; border-radius: 40px; font-size: 0.9rem; transition: 0.2s; box-shadow: 0 2px 6px rgba(0,0,0,0.02);"><i class="fas fa-user" style="margin-right: 6px;"></i> Login</a>
                <a href="{{ route('register') }}" style="background: #B5E2FA; color: #3E2C21; font-weight: 600; padding: 0.5rem 1.4rem; border-radius: 40px; font-size: 0.9rem; transition: 0.2s;"><i class="fas fa-user-plus" style="margin-right: 6px;"></i> Register</a>
            </div>
        </nav>
    </header>

    <main>
        <!-- HERO SECTION with new pastel identity -->
        <div class="hero-gradient-bg" style="position: relative; overflow: hidden;">
            <!-- floating macaron shapes -->
            <div style="position: absolute; top: 12%; left: -2%; width: 100px; height: 100px; background: #C7E9D0; border-radius: 80% 20% 70% 30% / 60% 50% 50% 40%; opacity: 0.25; filter: blur(30px); pointer-events: none;"></div>
            <div style="position: absolute; bottom: 0%; right: 0%; width: 180px; height: 180px; background: #FFB5A7; border-radius: 60% 40% 50% 50% / 45% 55% 45% 55%; opacity: 0.2; filter: blur(40px);"></div>
            <div class="container" style="position: relative; z-index: 2; padding-top: 3rem; padding-bottom: 4rem;">
                <div style="display: flex; flex-direction: column; gap: 3rem; align-items: center;">
                    <!-- Left text -->
                    <div style="flex: 1; text-align: center; max-width: 650px;">
                        <h1 style="font-size: clamp(2.4rem, 7vw, 3.6rem); font-weight: 800; color: #594337; margin-bottom: 1rem; line-height: 1.2;">Whipped with Love <br><span style="color: #FFB5A7;">& Dreamy Frosting</span></h1>
                        <p style="font-size: 1.1rem; color: #6B5A4B; max-width: 500px; margin: 0 auto 2rem auto; font-weight: 450;">Modern custom cakes, macaron towers & cupcakes — baked fresh with pastel elegance. Order for delivery or pickup.</p>
                        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-bottom: 2.5rem;">
                            <a href="#" class="btn-primary"><i class="fas fa-shopping-bag"></i> Explore Menu</a>
                            <a href="#" class="btn-outline"><i class="fas fa-palette"></i> Design Your Cake</a>
                        </div>
                        <div style="display: flex; gap: 2rem; justify-content: center; flex-wrap: wrap;">
                            <div><div class="stat-number">850+</div><div style="font-size: 0.85rem; color: #7C6956;">Happy Sweet Tooth</div></div>
                            <div><div class="stat-number">70+</div><div style="font-size: 0.85rem; color: #7C6956;">Flavor Combos</div></div>
                            <div><div class="stat-number">24/7</div><div style="font-size: 0.85rem; color: #7C6956;">Order Online</div></div>
                        </div>
                    </div>
                    <!-- Hero illustration: custom layered cake SVG with pastel macaron vibe -->
                    <div style="flex: 1; display: flex; justify-content: center; width: 100%;">
                        <div style="position: relative; max-width: 420px; width: 100%; margin: 0 auto;">
                            <div style="position: absolute; top: -20px; left: -20px; width: 90px; height: 90px; background: #B5E2FA; border-radius: 50%; opacity: 0.5; z-index: 0;"></div>
                            <div style="position: absolute; bottom: -15px; right: -25px; width: 110px; height: 110px; background: #C7E9D0; border-radius: 60% 40% 50% 50%; opacity: 0.5; z-index: 0;"></div>
                            <svg viewBox="0 0 400 380" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:auto; display:block; border-radius: 2rem; background: rgba(255,245,230,0.7); backdrop-filter: blur(2px); box-shadow: 0 20px 30px -12px rgba(0,0,0,0.1); padding: 0.5rem;">
                                <!-- base plate -->
                                <ellipse cx="200" cy="320" rx="170" ry="30" fill="#FFE9DF" />
                                <!-- bottom tier blush -->
                                <rect x="70" y="210" width="260" height="75" rx="14" fill="#FFC3B7" />
                                <rect x="70" y="210" width="260" height="16" rx="8" fill="#FFD9CF" />
                                <path d="M70 222 Q95 240 120 222 Q145 244 170 222 Q195 238 220 222 Q245 246 270 222 Q295 238 330 222 L330 285 L70 285Z" fill="#FFE2D8" />
                                <!-- middle tier mint -->
                                <rect x="105" y="145" width="190" height="68" rx="12" fill="#C7E9D0" />
                                <rect x="105" y="145" width="190" height="12" rx="6" fill="#E0F3E5" />
                                <path d="M105 158 Q130 172 155 158 Q180 174 205 158 Q230 170 255 158 L295 158 L295 213 L105 213Z" fill="#EEF9F0" />
                                <!-- top tier powder blue -->
                                <rect x="140" y="85" width="120" height="58" rx="10" fill="#B5E2FA" />
                                <rect x="140" y="85" width="120" height="12" rx="6" fill="#D3F0FF" />
                                <!-- cream top -->
                                <path d="M140 96 Q160 112 180 96 Q200 114 220 96 Q240 110 260 96 L260 143 L140 143Z" fill="#FFF9F0" />
                                <!-- swirly frosting -->
                                <circle cx="200" cy="90" r="16" fill="#FFE7DC" />
                                <circle cx="182" cy="98" r="9" fill="#FFFFFF" />
                                <circle cx="218" cy="98" r="9" fill="#FFFFFF" />
                                <!-- berries & macaron details -->
                                <circle cx="170" cy="78" r="8" fill="#F4A261" />
                                <circle cx="230" cy="78" r="8" fill="#E9B5A0" />
                                <circle cx="200" cy="73" r="7" fill="#FFA07A" />
                                <!-- sprinkles color pastel -->
                                <rect x="162" y="108" width="6" height="3" rx="2" fill="#B5E2FA" transform="rotate(25 165 110)"/>
                                <rect x="190" y="112" width="6" height="3" rx="2" fill="#FFB5A7" transform="rotate(-15 193 113)"/>
                                <rect x="215" y="106" width="6" height="3" rx="2" fill="#C7E9D0" transform="rotate(35 218 108)"/>
                                <rect x="240" y="115" width="6" height="3" rx="2" fill="#FADADD" transform="rotate(-20 243 116)"/>
                                <!-- cute candle -->
                                <rect x="196" y="48" width="8" height="28" rx="3" fill="#FFD966" />
                                <path d="M200 42 L206 51 L194 51Z" fill="#FFB347" />
                                <ellipse cx="200" cy="40" rx="4" ry="6" fill="#FFD28F" />
                                <circle cx="200" cy="36" r="2.5" fill="#FFF3BF" />
                                <!-- hearts -->
                                <path d="M148 195 A4 4 0 0 1 156 195 A4 4 0 0 1 164 195 Q164 200 156 204 Q148 200 148 195Z" fill="#FFB5A7" opacity="0.8" transform="scale(0.7) translate(65, 70)" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shop by Category (Pastel twist) -->
        <div class="container" style="padding: 4rem 1.5rem;">
            <h2 style="font-size: 2.2rem; text-align: center; font-weight: 700; color: #4C3E30;">Sweetest selection</h2>
            <p style="text-align: center; color: #8D7862; margin-bottom: 3rem;">Dreamy treats, pastel perfection</p>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 2rem;">
                <div class="category-card"><div class="icon-circle"><i class="fas fa-birthday-cake"></i></div><h3 style="font-weight: 600;">Cakes</h3><p style="color:#8f7a64; font-size:0.8rem;">32 designs</p></div>
                <div class="category-card"><div class="icon-circle"><i class="fas fa-cupcake"></i></div><h3 style="font-weight: 600;">Cupcakes</h3><p style="color:#8f7a64; font-size:0.8rem;">24 flavors</p></div>
                <div class="category-card"><div class="icon-circle"><i class="fas fa-croissant"></i></div><h3 style="font-weight: 600;">Macarons</h3><p style="color:#8f7a64; font-size:0.8rem;">18 pastels</p></div>
                <div class="category-card"><div class="icon-circle"><i class="fas fa-cookie-bite"></i></div><h3 style="font-weight: 600;">Cookies</h3><p style="color:#8f7a64; font-size:0.8rem;">12 kinds</p></div>
            </div>
        </div>

        <!-- Featured Products - modern pastel sweets -->
        <div style="background: #FFF9F5; padding: 4rem 0;">
            <div class="container">
                <h2 style="font-size: 2rem; text-align: center; font-weight: 700; color: #4C3E30;">Featured delights</h2>
                <p style="text-align: center; color:#957F68; margin-bottom: 2.5rem;">Our most-ordered pastel creations</p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
                    <!-- Product 1 -->
                    <div class="card" style="background: white;">
                        <img src="https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=500&auto=format" style="width:100%; height:220px; object-fit:cover;" alt="strawberry cake">
                        <div style="padding: 1.5rem;"><div style="display: flex; justify-content: space-between;"><h3 style="font-weight: 700;">Strawberry Cloud Cake</h3><span style="color:#FFB5A7; font-weight: 800;">$32</span></div><p style="color:#6C5B4A; font-size:0.85rem; margin: 0.5rem 0 1rem;">Layers of vanilla sponge, fresh strawberries & whipped cream</p><button class="btn-primary" style="width:100%; justify-content: center;"><i class="fas fa-cart-plus"></i> Order now</button></div>
                    </div>
                    <!-- Product 2 macaron tower -->
                    <div class="card"><img src="https://images.unsplash.com/photo-1572495641004-2e9c0efc6ae0?w=500&auto=format" style="width:100%; height:220px; object-fit:cover;" alt="macaron set"><div style="padding:1.5rem;"><div style="display: flex; justify-content: space-between;"><h3 style="font-weight: 700;">Macaron Gift Box</h3><span style="color:#FFB5A7; font-weight: 800;">$24</span></div><p style="color:#6C5B4A; font-size:0.85rem; margin:0.5rem 0 1rem;">12 assorted pastel macarons, pistachio, rose, vanilla</p><button class="btn-primary" style="width:100%; justify-content: center;"><i class="fas fa-cart-plus"></i> Order now</button></div></div>
                    <!-- Product 3 pastel cupcake -->
                    <div class="card"><img src="https://images.unsplash.com/photo-1614707267537-b85a3260d2dc?w=500&auto=format" style="width:100%; height:220px; object-fit:cover;" alt="cupcake"><div style="padding:1.5rem;"><div style="display: flex; justify-content: space-between;"><h3 style="font-weight: 700;">Unicorn Cupcake</h3><span style="color:#FFB5A7; font-weight: 800;">$4.5</span></div><p style="color:#6C5B4A; font-size:0.85rem; margin:0.5rem 0 1rem;">Lavender buttercream, edible glitter & sprinkles</p><button class="btn-primary" style="width:100%; justify-content: center;"><i class="fas fa-cart-plus"></i> Order now</button></div></div>
                </div>
                <div style="text-align: center; margin-top: 2.5rem;"><a href="#" class="btn-outline" style="font-weight: 500;">View full menu →</a></div>
            </div>
        </div>

        <!-- Custom Cake Banner | Pastel Dream design -->
        <div class="container" style="margin: 3rem auto 4rem auto;">
            <div style="position: relative; border-radius: 2rem; overflow: hidden; box-shadow: 0 20px 30px -12px rgba(0,0,0,0.12); background: #FFF3EB;">
                <img src="https://images.unsplash.com/photo-1535254973040-9b3922f9e6ec?w=1400&auto=format" style="width:100%; height: auto; object-fit: cover; display: block;" alt="custom cake pastel">
                <div style="position: absolute; inset: 0; background: linear-gradient(95deg, rgba(255,245,235,0.75) 0%, rgba(181,226,250,0.3) 100%);"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; top: 0; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 1rem;">
                    <h2 style="font-size: clamp(1.8rem, 5vw, 2.8rem); color:#FFF; text-shadow: 0 2px 8px rgba(0,0,0,0.2); font-weight: 800;">Dream Cake Studio</h2>
                    <p style="color: white; max-width: 480px; margin: 0.5rem 0 1.5rem; font-weight: 500; text-shadow: 0 1px 4px rgba(0,0,0,0.1);">Choose pastel glaze, edible flowers, and custom shapes</p>
                    <a href="#" style="background: #FFB5A7; color: #412F22; padding: 0.8rem 2rem; border-radius: 60px; font-weight: 700; display: inline-flex; gap: 10px; align-items: center; box-shadow: 0 6px 14px rgba(0,0,0,0.1); transition: 0.2s;"><i class="fas fa-magic"></i> Customize now <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div style="background: #FDF8F4; padding: 4rem 0;">
            <div class="container">
                <h2 style="text-align: center; font-size: 2rem; font-weight: 700; color:#4C3E30;">❤️ Sweet words</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem; margin-top: 2rem;">
                    <div class="card" style="padding: 1.6rem;"><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><p style="margin: 1rem 0; color: #685A48;">“The macaron box was gorgeous! Tastes like Paris in pastel. Highly recommend for gifts.”</p><p style="font-weight: 600;">— Mia L.</p></div>
                    <div class="card" style="padding: 1.6rem;"><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><p style="margin: 1rem 0; color: #685A48;">“My custom birthday cake with blush drip and mint accents was incredible. Thank you Disna!”</p><p style="font-weight: 600;">— Chloe R.</p></div>
                    <div class="card" style="padding: 1.6rem;"><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><p style="margin: 1rem 0; color: #685A48;">“Super fast delivery & cupcakes were so light and airy. My new favorite bakery!”</p><p style="font-weight: 600;">— Daniel K.</p></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer: creamy vanilla & pastel touches -->
    <footer style="padding: 3rem 0 2rem 0; background: #FDF3EA; border-top: 1px solid #F2E2D4;">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px,1fr)); gap: 2rem;">
                <div><div style="display: flex; gap: 0.7rem; align-items: center; margin-bottom: 1rem;"><i class="fas fa-crown" style="color:#FFB5A7; font-size: 1.8rem;"></i><span style="font-weight: 800; font-size: 1.3rem;">Disna Cakes</span></div><p style="color:#7E6954;">Fresh pastel creations, custom orders & same-day treats.</p></div>
                <div><h4 style="font-weight: 600; margin-bottom: 1rem;">Explore</h4><ul style="list-style: none; line-height: 2;"><li><a href="#" class="footer-link">About</a></li><li><a href="#" class="footer-link">Cake Gallery</a></li><li><a href="#" class="footer-link">Custom Order</a></li></ul></div>
                <div><h4 style="font-weight: 600; margin-bottom: 1rem;">Contact</h4><ul style="list-style: none; line-height: 2; color:#7B6651;"><li><i class="fas fa-map-marker-alt" style="width: 20px;"></i> 22 Pastel Lane, Sweetsville</li><li><i class="fas fa-phone-alt"></i> +1 (555) 234-8890</li><li><i class="fas fa-envelope"></i> hello@disnacakes.com</li></ul></div>
                <div><h4 style="font-weight: 600; margin-bottom: 1rem;">Sweet hours</h4><p>Mon-Fri: 9am – 8pm<br>Sat-Sun: 10am – 6pm</p></div>
            </div>
            <div style="text-align: center; margin-top: 3rem; padding-top: 1.5rem; border-top: 1px solid #EBDBCA; color: #A48C72;">© 2025 Disna Cakes — where every bite is a pastel dream.</div>
        </div>
    </footer>

    <!-- small interactive hover for buttons (no extra style clash) -->
</body>
</html>