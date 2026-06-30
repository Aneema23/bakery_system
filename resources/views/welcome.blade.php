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
            background-color: #FAFAFA;
            color: #3b2c1f;
            scroll-behavior: smooth;
            padding-top: 80px; /* Prevents content from hiding behind fixed header */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Pastel Color Palette Override */
        :root {
            --blush: #FFB5A7;
            --mint: #C7E9D0;
            --powder-blue: #B5E2FA;
            --vanilla: #FFF5E6;
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

        /* ===== FIXED HEADER ===== */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(242, 226, 212, 0.5);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        header.scrolled {
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.98);
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
            text-decoration: none;
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
            text-decoration: none;
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
            overflow: hidden;
        }

        .category-card:hover .icon-circle {
            background: #facbbd;
        }

        /* category images */
        .category-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }
        
        .category-card:hover .category-img {
            transform: scale(1.05);
        }

        /* gradient hero background */
        .hero-gradient-bg {
            background: linear-gradient(125deg, #FFF9F5 0%, #FEF3EE 40%, #F2FAF4 100%);
            position: relative;
            isolation: isolate;
            margin-top: 1rem; /* Adds space below fixed header */
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
            text-decoration: none;
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
            body {
                padding-top: 70px;
            }

            .container {
                padding: 0 1.25rem;
            }
            .stat-number {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding-top: 65px;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <nav style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <!-- Logo + Brand -->
                <div style="display: flex; align-items: center; gap: 12px;">
                    <img src="{{ asset('images/logo.png') }}" alt="Disna Cakes Logo" style="width: 40px; height: 40px;">
                    <span class="logo-text" style="font-weight: 700; font-size: 1.6rem; color: #6F4E37; letter-spacing: -0.3px;">Disna Cakes</span>
                </div>
                <!-- Auth buttons -->
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <div style="border-left: 2px solid #FFD9CF; height: 32px;"></div>
                    <a href="{{ route('login') }}" style="background: #FFB5A7; color: #3E2C21; font-weight: 600; padding: 0.5rem 1.4rem; border-radius: 40px; font-size: 0.9rem; transition: 0.2s; box-shadow: 0 2px 6px rgba(0,0,0,0.02); text-decoration: none; display: inline-flex; align-items: center; gap: 6px;"><i class="fas fa-user"></i> Login</a>
                    <a href="{{ route('register') }}" style="background: #B5E2FA; color: #3E2C21; font-weight: 600; padding: 0.5rem 1.4rem; border-radius: 40px; font-size: 0.9rem; transition: 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;"><i class="fas fa-user-plus"></i> Register</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <!-- HERO SECTION - Moved down with margin-top -->
        <div class="hero-gradient-bg" style="position: relative; overflow: hidden; margin-top: 0.5rem;">
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
                            <a href="{{ route('menu') }}" class="btn-primary"><i class="fas fa-shopping-bag"></i> Explore Menu</a>
                            <a href="{{ route('custom-cake') }}" class="btn-outline"><i class="fas fa-palette"></i> Design Your Cake</a>
                        </div>
                        <div style="display: flex; gap: 2rem; justify-content: center; flex-wrap: wrap;">
                            <div><div class="stat-number">850+</div><div style="font-size: 0.85rem; color: #7C6956;">Happy Sweet Tooth</div></div>
                            <div><div class="stat-number">70+</div><div style="font-size: 0.85rem; color: #7C6956;">Flavor Combos</div></div>
                            <div><div class="stat-number">24/7</div><div style="font-size: 0.85rem; color: #7C6956;">Order Online</div></div>
                        </div>
                    </div>
                    <!-- Hero illustration -->
                    <div style="flex: 1; display: flex; justify-content: center; width: 100%;">
                        <div style="position: relative; max-width: 420px; width: 100%; margin: 0 auto;">
                            <div style="position: absolute; top: -20px; left: -20px; width: 90px; height: 90px; background: #B5E2FA; border-radius: 50%; opacity: 0.5; z-index: 0;"></div>
                            <div style="position: absolute; bottom: -15px; right: -25px; width: 110px; height: 110px; background: #C7E9D0; border-radius: 60% 40% 50% 50%; opacity: 0.5; z-index: 0;"></div>
                            <img src="https://images.unsplash.com/photo-1685956801990-57ef97b17d45?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Delicious Cake" 
                                style="width:100%; height:auto; display:block; border-radius: 2rem; background: rgba(255,245,230,0.7); backdrop-filter: blur(2px); box-shadow: 0 20px 30px -12px rgba(0,0,0,0.1); padding: 0.5rem; object-fit: cover; aspect-ratio: 400/380;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shop by Category -->
        <div class="container" style="padding: 4rem 1.5rem;">
            <h2 style="font-size: 2.2rem; text-align: center; font-weight: 700; color: #4C3E30;">Sweetest selection</h2>
            <p style="text-align: center; color: #8D7862; margin-bottom: 3rem;">Dreamy treats, pastel perfection</p>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 2rem;">
                <div class="category-card"  onclick="window.location.href='{{ route('menu') }}#cakes-section'"><div class="icon-circle"><img src="https://images.unsplash.com/photo-1640506054499-2b040ca19023?w=200&h=200&fit=crop&auto=format" alt="Cakes" class="category-img"></div>
                    <h3 style="font-weight: 600;">Birthday Cakes</h3><p style="color:#8f7a64; font-size:0.8rem;">32 designs</p>
                </div>
                <div class="category-card"  onclick="window.location.href='{{ route('menu') }}#cupcakes-section'"><div class="icon-circle"><img src="https://images.unsplash.com/photo-1566864399117-22c449669089?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cakes" class="category-img"></div>
                    <h3 style="font-weight: 600;">CupCakes</h3><p style="color:#8f7a64; font-size:0.8rem;">10 designs</p>
                </div>
                <div class="category-card"  onclick="window.location.href='{{ route('menu') }}#cakes-section'"><div class="icon-circle"><img src="https://plus.unsplash.com/premium_photo-1669245220400-6c04752ec08a?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cakes" class="category-img"></div>
                    <h3 style="font-weight: 600;">Cakes</h3><p style="color:#8f7a64; font-size:0.8rem;">32 designs</p>
                </div>
                <div class="category-card" onclick="window.location.href='{{ route('menu') }}#cakes-section'"><div class="icon-circle"><img src="https://images.unsplash.com/photo-1590080874088-eec64895b423?q=80&w=894&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cakes" class="category-img"></div>
                    <h3 style="font-weight: 600;">Cookies</h3><p style="color:#8f7a64; font-size:0.8rem;">2 designs</p>
                </div>
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
                        <div style="padding: 1.5rem;"><div style="display: flex; justify-content: space-between;"><h3 style="font-weight: 700;">Strawberry Cloud Cake</h3></div><p style="color:#6C5B4A; font-size:0.85rem; margin: 0.5rem 0 1rem;">Soft vanilla sponge layered with fresh strawberries and whipped cream</p>
                        <button class="btn-primary" style="width:100%; justify-content: center;" onclick="window.location.href='{{ route('menu') }}#cakes-section'"><i class="fas fa-cake"></i> View</button></div>
                    </div>
                    <!-- Product 2 -->
                    <div class="card" style="background: white;">
                        <img src="https://images.unsplash.com/photo-1621868402792-a5c9fa6866a3?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" style="width:100%; height:220px; object-fit:cover;" alt="chocolate cake">
                        <div style="padding: 1.5rem;"><div style="display: flex; justify-content: space-between;"><h3 style="font-weight: 700;">Chocolate Cake</h3></div><p style="color:#6C5B4A; font-size:0.85rem; margin: 0.5rem 0 1rem;">Rich chocolate layered with smooth chocolate ganache and topped with decadent chocolate shavings</p>
                        <button class="btn-primary" style="width:100%; justify-content: center;" onclick="window.location.href='{{ route('menu') }}#cakes-section'"><i class="fas fa-cake"></i> View</button></div>
                    </div>
                    <!-- Product 3 -->
                    <div class="card" style="background: white;">
                        <img src="https://images.unsplash.com/photo-1741812553483-7b15e74aeb07?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" style="width:100%; height:220px; object-fit:cover;" alt="blueberry cake">
                        <div style="padding: 1.5rem;"><div style="display: flex; justify-content: space-between;"><h3 style="font-weight: 700;">Blueberry Cake</h3></div><p style="color:#6C5B4A; font-size:0.85rem; margin: 0.5rem 0 1rem;">Light vanilla sponge filled with sweet blueberry compote and smooth cream, topped with fresh berries</p>
                        <button class="btn-primary" style="width:100%; justify-content: center;" onclick="window.location.href='{{ route('menu') }}#cakes-section'"><i class="fas fa-cake"></i> View</button></div>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 2.5rem;"><a href="{{ route('menu') }}" class="btn-outline" style="font-weight: 500;">View full menu →</a></div>
            </div>
        </div>

        <!-- Custom Cake Banner | Pastel Dream design -->
        <div class="container" style="margin: 3rem auto 4rem auto;">
            <div style="position: relative; border-radius: 2rem; overflow: hidden; box-shadow: 0 20px 30px -12px rgba(0,0,0,0.12); background: #FFF3EB;">
                <img src="https://images.unsplash.com/photo-1621618625640-c8acf9330149?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" style="width:100%; height: auto; object-fit: cover; display: block;" alt="custom cake pastel">
                <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.15), rgba(0,0,0,0.3));"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; top: 0; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 1rem;">
                    <h2 style="font-size: clamp(1.8rem, 5vw, 2.8rem); color:#FFF; text-shadow: 0 2px 8px rgba(0,0,0,0.2); font-weight: 800;">Dream Cake Studio</h2>
                    <p style="color: white; max-width: 480px; margin: 0.5rem 0 1.5rem; font-weight: 500; text-shadow: 0 1px 4px rgba(0,0,0,0.1);">Choose pastel glaze, edible flowers, and custom shapes</p>
                    <a href="{{ route('custom-cake') }}" style="background: #FFB5A7; color: #412F22; padding: 0.8rem 2rem; border-radius: 60px; font-weight: 700; display: inline-flex; gap: 10px; align-items: center; box-shadow: 0 6px 14px rgba(0,0,0,0.1); transition: 0.2s; text-decoration: none;"><i class="fas fa-magic"></i> Customize now <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div style="background: #FDF8F4; padding: 4rem 0;">
            <div class="container">
                <h2 style="text-align: center; font-size: 2rem; font-weight: 700; color:#4C3E30;">❤️ Sweet words</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem; margin-top: 2rem;">
                    <div class="card" style="padding: 1.6rem;"><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><p style="margin: 1rem 0; color: #685A48;">"The macaron box was gorgeous! Tastes like Paris in pastel. Highly recommend for gifts."</p><p style="font-weight: 600;">— Mia L.</p></div>
                    <div class="card" style="padding: 1.6rem;"><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><p style="margin: 1rem 0; color: #685A48;">"My custom birthday cake with blush drip and mint accents was incredible. Thank you Disna!"</p><p style="font-weight: 600;">— Chloe R.</p></div>
                    <div class="card" style="padding: 1.6rem;"><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><i class="fas fa-star" style="color: #FFB5A7;"></i><p style="margin: 1rem 0; color: #685A48;">"Super fast delivery & cupcakes were so light and airy. My new favorite bakery!"</p><p style="font-weight: 600;">— Daniel K.</p></div>
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

    <script>
        // Add shadow effect on scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>

</body>
</html>