<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Disna Cakes | Menu</title>
    <!-- logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #FAFAFA;
            color: #3b2c1f;
            padding-top: 80px;
        }

        :root {
            --blush: #FFB5A7;
            --mint: #C7E9D0;
            --powder-blue: #B5E2FA;
            --vanilla: #FFF5E6;
            --dark-accent: #5E4B3A;
            --shadow-soft: 0 12px 28px -8px rgba(0, 0, 0, 0.06);
            --hover-lift: 0 20px 30px -12px rgba(0, 0, 0, 0.12);
        }

        h1, h2, h3, .logo-text {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.01em;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* ===== FIXED HEADER ===== */
        header {
            background: white;
            border-bottom: 1px solid #F2E2D4;
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        header.scrolled {
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.98);
        }

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

        /* Menu Categories */
        .menu-category {
            margin-bottom: 3.5rem;
        }

        .menu-category-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .menu-category-title h2 {
            font-size: 2rem;
            color: #4C3E30;
        }

        .menu-category-title .line {
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, #FFB5A7, transparent);
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .menu-item {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-lift);
        }

        .menu-item-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .menu-item:hover .menu-item-image {
            transform: scale(1.02);
        }

        .menu-item-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .menu-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .menu-item-header h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #4C3E30;
            font-family: 'Inter', sans-serif;
        }

        .menu-item-price {
            font-weight: 700;
            color: #FFB5A7;
            font-size: 1.2rem;
            white-space: nowrap;
            margin-left: 1rem;
        }

        .menu-item-description {
            color: #7C6954;
            font-size: 0.9rem;
            line-height: 1.6;
            margin: 0.5rem 0 1rem;
            flex: 1;
        }

        .menu-item-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid #F5EDE5;
        }

        .menu-item-tag {
            background: #FFF0EA;
            color: #FF8A7A;
            padding: 0.2rem 0.8rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .menu-item-cart {
            background: #FFF5F0;
            border: none;
            color: #FFB5A7;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .menu-item-cart:hover {
            background: #FFB5A7;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(255, 181, 167, 0.4);
        }

        /* Filter Buttons */
        .filter-section {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
            margin-bottom: 2.5rem;
            justify-content: center;
        }

        .filter-btn {
            padding: 0.5rem 1.5rem;
            border-radius: 40px;
            border: 2px solid #FFE8E0;
            background: white;
            color: #7C6954;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .filter-btn:hover {
            border-color: #FFB5A7;
            background: #FFF5F0;
        }

        .filter-btn.active {
            background: #FFB5A7;
            border-color: #FFB5A7;
            color: #4A3424;
        }
        
        /* Footer Styles */
        .footer-link {
            color: #75624E;
            text-decoration: none;
            transition: 0.2s;
        }

        .footer-link:hover {
            color: #FFB5A7;
        }

        /* ===== MODAL / POPUP STYLES ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
            padding: 1.5rem;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 28px;
            max-width: 520px;
            width: 100%;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.4s cubic-bezier(0.2, 0.8, 0.4, 1);
            position: relative;
            max-height: 95vh;
            overflow-y: auto;
        }

        .modal-content::-webkit-scrollbar {
            width: 4px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: #FFB5A7;
            border-radius: 4px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(50px) scale(0.95);
            }
            to { 
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-close {
            position: absolute;
            top: 0.8rem;
            right: 0.8rem;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
            color: #4C3E30;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.12);
        }

        .modal-close:hover {
            background: #FFB5A7;
            color: white;
            transform: rotate(90deg) scale(1.1);
        }

        .modal-image-wrapper {
            position: relative;
            width: 100%;
            height: 320px;
            background: #F5EDE5;
            overflow: hidden;
        }

        .modal-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .modal-image:hover {
            transform: scale(1.02);
        }

        .modal-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            padding: 0.3rem 1.2rem;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #FF8A7A;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .modal-body {
            padding: 2rem 2rem 1.8rem;
        }

        .modal-body-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.8rem;
        }

        .modal-body h2 {
            font-size: 1.5rem;
            color: #4C3E30;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            line-height: 1.2;
        }

        .modal-price {
            color: #FFB5A7;
            font-size: 1.4rem;
            font-weight: 700;
            background: #FFF5F0;
            padding: 0.2rem 1.2rem;
            border-radius: 40px;
            white-space: nowrap;
            margin-left: 0.5rem;
        }

        .modal-rating {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            margin-bottom: 0.8rem;
        }

        .modal-rating i {
            color: #FFB5A7;
            font-size: 0.9rem;
        }

        .modal-rating span {
            color: #8D7862;
            font-size: 0.85rem;
            margin-left: 0.3rem;
        }

        .modal-description {
            color: #7C6954;
            line-height: 1.8;
            margin-bottom: 1.2rem;
            font-size: 0.95rem;
        }

        .modal-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.8rem;
            margin-bottom: 1.5rem;
            background: #FBF8F6;
            padding: 1rem;
            border-radius: 16px;
        }

        .modal-detail-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #5E4B3A;
        }

        .modal-detail-item i {
            color: #FFB5A7;
            width: 20px;
        }

        .modal-tag {
            display: inline-block;
            background: #FFF0EA;
            color: #FF8A7A;
            padding: 0.3rem 1.2rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
        }

        .modal-order-btn {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(105deg, #FFB5A7, #FF9A8B);
            border: none;
            border-radius: 48px;
            color: #4A3424;
            font-weight: 700;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .modal-order-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(255, 181, 167, 0.4);
        }

        .modal-order-btn i {
            font-size: 1.1rem;
        }

        /* ===== LOGIN REQUIRED TOAST ===== */
        .toast-message {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #4C3E30;
            color: white;
            padding: 1rem 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            z-index: 3000;
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.2, 0.8, 0.4, 1);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            max-width: 90%;
        }

        .toast-message.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .toast-message i {
            font-size: 1.3rem;
            color: #FFB5A7;
        }

        .toast-message .toast-close {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            font-size: 1.2rem;
            transition: 0.2s;
            margin-left: 0.5rem;
        }

        .toast-message .toast-close:hover {
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
            
            .menu-grid {
                grid-template-columns: 1fr;
            }
            
            .filter-section {
                gap: 0.5rem;
            }
            
            .filter-btn {
                padding: 0.4rem 1rem;
                font-size: 0.8rem;
            }

            .modal-image-wrapper {
                height: 240px;
            }

            .modal-body {
                padding: 1.5rem;
            }

            .modal-body h2 {
                font-size: 1.3rem;
            }

            .modal-price {
                font-size: 1.2rem;
            }

            .modal-details {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding-top: 65px;
            }
            
            .menu-item-image {
                height: 160px;
            }

            .modal-image-wrapper {
                height: 200px;
            }

            .modal-content {
                border-radius: 20px;
                max-height: 90vh;
            }

            .modal-body {
                padding: 1.2rem;
            }

            .modal-body-top {
                flex-direction: column;
                gap: 0.5rem;
            }

            .modal-price {
                margin-left: 0;
                align-self: flex-start;
            }

            .modal-order-btn {
                font-size: 0.95rem;
                padding: 0.8rem;
            }

            .toast-message {
                font-size: 0.85rem;
                padding: 0.8rem 1.2rem;
                bottom: 1rem;
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <!-- ===== HEADER ===== -->
    <header>
        <div class="container">
            <nav style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <img src="{{ asset('images/logo.png') }}" alt="Disna Cakes" style="width: 40px; height: 40px;">
                    <span class="logo-text" style="font-weight: 700; font-size: 1.6rem; color: #6F4E37;">Disna Cakes</span>
                </div>
                <div style="display: flex; gap: 1.5rem; align-items: center;">
                    <a href="{{ url('/') }}" style="color: #5E4B3A; text-decoration: none; font-weight: 500;">Home</a>
                    <a href="{{ route('menu') }}" style="color: #FFB5A7; text-decoration: none; font-weight: 600;">Menu</a>
                    <a href="{{ route('login') }}" style="color: #5E4B3A; text-decoration: none; font-weight: 500;"><i class="fas fa-user"></i></a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container" style="padding: 3rem 1.5rem 4rem;">

            <!-- Page Header -->
            <div style="text-align: center; margin-bottom: 3rem;">
                <span style="font-size: 0.9rem; letter-spacing: 2px; color: #B5A08C; font-weight: 600;">
                    <i class="fas fa-crown" style="color: #FFB5A7;"></i> OUR MENU
                </span>
                <h1 style="font-size: clamp(2.5rem, 5vw, 3.5rem); color: #4C3E30; margin: 0.5rem 0;">Sweet <span style="color: #FFB5A7;">Creations</span></h1>
                <p style="color: #8D7862; max-width: 500px; margin: 0 auto;">Handcrafted with love, every treat is a pastel dream</p>
            </div>

            <!-- Filter Buttons -->
            <div class="filter-section">
                <button class="filter-btn active" onclick="filterMenu('all')">All</button>
                <button class="filter-btn" onclick="filterMenu('cakes')">🎂 Cakes</button>
                <button class="filter-btn" onclick="filterMenu('cupcakes')">🧁 Cupcakes</button>
                <button class="filter-btn" onclick="filterMenu('birthday-cakes')">🌈 Birthday Cakes</button>
                <button class="filter-btn" onclick="filterMenu('cookies')">🍪 Cookies</button>
                <button class="filter-btn" onclick="filterMenu('specials')">✨ Specials</button>
            </div>

            <!-- Menu Items -->
            <div id="menuContainer">

                <!-- Cakes Section -->
                <div class="menu-category" data-category="cakes">
                    <div class="menu-category-title">
                        <h2>🎂 Cakes</h2>
                        <div class="line"></div>
                    </div>
                    <div class="menu-grid">
                        <!-- Cake Item 1 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.unsplash.com/photo-1621868402792-a5c9fa6866a3?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Chocolate Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Chocolate Cake</h3>
                                    <span class="menu-item-price">Rs.3500</span>
                                </div>
                                <p class="menu-item-description">Moist chocolate sponge layered with rich chocolate ganache and finished with smooth chocolate frosting</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Best Seller</span>
                                    <button class="menu-item-cart" onclick="openModal('Chocolate Cake (I kg)', 3500, 'https://images.unsplash.com/photo-1621868402792-a5c9fa6866a3?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Indulge in our rich Chocolate Cake made with moist chocolate sponge layers, silky chocolate ganache, and premium cocoa. Perfect for birthdays, celebrations, or any chocolate lover.', '⭐ Best Seller', '⭐ 4.9', ' 🍫 Chocolate Ganache', '🎂 Chocolate Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cake Item 2 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.unsplash.com/photo-1609577737938-fb2139fa4c78?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Vanila Butter Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Vanila Butter Cake</h3>
                                    <span class="menu-item-price">Rs.3000</span>
                                </div>
                                <p class="menu-item-description">Soft vanilla sponge filled with creamy vanilla buttercream, finished with a classic smooth frosting.</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Best Seller</span>
                                    <button class="menu-item-cart" onclick="openModal('Vanila Butter Cake (I kg)', 3000 , 'https://images.unsplash.com/photo-1609577737938-fb2139fa4c78?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 
                                    'Our classic Vanilla Butter Cake features soft vanilla sponge layered with creamy buttercream frosting. A timeless choice for birthdays and family celebrations.', '👨‍👩‍👧 Family Favorite', '⭐ 4.8', '🧈 Vanilla Buttercream', '🎂 Chocolate Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cake Item 3 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.pexels.com/photos/30131920/pexels-photo-30131920.jpeg" alt="Red Velvet Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Red Velvet Cake</h3>
                                    <span class="menu-item-price">Rs.5000</span>
                                </div>
                                <p class="menu-item-description">Soft red velvet sponge layered with rich cream cheese frosting and decorated with elegant red velvet crumbs</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Best Seller</span>
                                    <button class="menu-item-cart" onclick="openModal('Red Velvet Cake (I kg)', 5000, 'https://images.pexels.com/photos/30131920/pexels-photo-30131920.jpeg', 'Soft and velvety red sponge layered with rich cream cheese frosting and beautifully decorated with red velvet crumbs. A luxurious 1kg celebration cake.', '❤️ Premium', '⭐ 4.9', '🧀 Cream Cheese Frosting', '🎂 Red Velvet Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cake Item 4 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.unsplash.com/photo-1589119908995-c6837fa14848?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D alt="Stawberry Cream Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Stawberry Cream Cake</h3>
                                    <span class="menu-item-price">Rs.5500</span>
                                </div>
                                <p class="menu-item-description">Light vanilla sponge layered with fresh strawberry filling and whipped cream, topped with juicy strawberries.</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Popular</span>
                                    <button class="menu-item-cart" onclick="openModal('Stawberry Cream Cake (I kg)', 5500, 'https://images.unsplash.com/photo-1589119908995-c6837fa14848?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Fresh strawberries layered with fluffy whipped cream and soft vanilla sponge. This refreshing 1kg cake is perfect for birthdays and special occasions.', '🍓 Seasonal Favorite', '⭐ 4.9', '🍓 Fresh Cream', '🎂 Vanilla Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cake Item 5 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.pexels.com/photos/2147857/pexels-photo-2147857.jpeg" alt="Coffee Mocha Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Coffee Mocha Cake</h3>
                                    <span class="menu-item-price">Rs.5200</span>
                                </div>
                                <p class="menu-item-description">Coffee-infused sponge layered with silky mocha buttercream and finished with a dusting of cocoa powder.</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Popular</span>
                                    <button class="menu-item-cart" onclick="openModal('Coffee Mocha Cake (I kg)', 5200, 'https://images.pexels.com/photos/2147857/pexels-photo-2147857.jpeg', 'Rich coffee-infused sponge layered with smooth mocha buttercream and finished with cocoa powder. A perfect 1kg cake for coffee lovers.', '☕ Coffee Lovers', '⭐ 4.9', '☕ Mocha Buttercream', '🎂 Coffee Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cake Item 6 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.pexels.com/photos/24206908/pexels-photo-24206908.jpeg" alt="Caranel Crunch Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Caranel Crunch Cake</h3>
                                    <span class="menu-item-price">Rs.5800</span>
                                </div>
                                <p class="menu-item-description">Soft vanilla sponge layered with salted caramel cream and crunchy caramel pieces for the perfect sweet crunch.</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Popular</span>
                                    <button class="menu-item-cart" onclick="openModal('Caranel Crunch Cake (I kg)', 5800, 'https://images.pexels.com/photos/24206908/pexels-photo-24206908.jpeg', 'Soft vanilla sponge layered with salted caramel cream and crunchy caramel pieces for the perfect sweet crunch.', '✨ Chef''s Special', '⭐ 4.9', '🍮 Salted Caramel', '🎂 Vanilla Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cake Item 7 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.unsplash.com/photo-1741812553483-7b15e74aeb07?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Blueberry Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Blueberry Cake</h3>
                                    <span class="menu-item-price">Rs.6500</span>
                                </div>
                                <p class="menu-item-description">Fluffy vanilla sponge filled with blueberry compote and fresh cream, topped with premium blueberries.</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Best Seller</span>
                                    <button class="menu-item-cart" onclick="openModal('Blueberry Cake (I kg)', 6500, 'https://images.unsplash.com/photo-1741812553483-7b15e74aeb07?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Fluffy vanilla sponge filled with blueberry compote and fresh cream, topped with premium blueberries.', '🫐 Premium', '⭐ 4.9', '🫐 Blueberry Cream', '🎂 Vanilla Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cake Item 8 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.pexels.com/photos/37934621/pexels-photo-37934621.jpeg" alt="Tiramisu Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Tiramisu Cake</h3>
                                    <span class="menu-item-price">Rs.6800</span>
                                </div>
                                <p class="menu-item-description">Coffee-soaked sponge layered with mascarpone cream and finished with a generous dusting of cocoa powder.</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Custom</span>
                                    <button class="menu-item-cart" onclick="openModal('Tiramisu Cake (I kg)', 6800, 'https://images.pexels.com/photos/37934621/pexels-photo-37934621.jpeg', 'Inspired by the famous Italian dessert, this 1kg cake features coffee-soaked sponge layered with mascarpone cream and finished with cocoa powder.'', '✨ Chef''s Special', '⭐ 5.0', '☕ Mascarpone Cream', '🎂 Coffee Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cake Item 9 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.pexels.com/photos/8802102/pexels-photo-8802102.jpeg" alt="Black Forest Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Black Forest Cake</h3>
                                    <span class="menu-item-price">Rs.5000</span>
                                </div>
                                <p class="menu-item-description">Rich chocolate sponge layered with whipped cream and cherries, finished with chocolate shavings.</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Custom</span>
                                    <button class="menu-item-cart" onclick="openModal('Black Forest Cake (I kg)', 5000, 'https://images.pexels.com/photos/8802102/pexels-photo-8802102.jpeg', 'Classic Black Forest Cake made with moist chocolate sponge, whipped cream, sweet cherries, and chocolate shavings.', '🍒 Classic', '⭐ 4.8', '🍒 Whipped Cream', '🎂 Chocolate Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cake Item 10 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.pexels.com/photos/4110001/pexels-photo-4110001.jpeg" alt="White Forest Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>White Forest Cake</h3>
                                    <span class="menu-item-price">Rs. 5000</span>
                                </div>
                                <p class="menu-item-description">Soft vanilla sponge layered with fresh cream and cherries, decorated with white chocolate curls.</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Custom</span>
                                    <button class="menu-item-cart" onclick="openModal('White Forest Cake (I kg)', 5000, 'https://images.pexels.com/photos/4110001/pexels-photo-4110001.jpeg', 'Delicate vanilla sponge layered with fresh whipped cream, cherries, and white chocolate curls for a light and elegant dessert.', '🤍 New Arrival', '⭐ 4.8', '🤍 Fresh Cream', '🎂 Vanilla Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Cake Item 11 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.unsplash.com/photo-1617305855058-336d24456869?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Lava Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Lava Cake</h3>
                                    <span class="menu-item-price">Rs. 3000</span>
                                </div>
                                <p class="menu-item-description">Rich chocolate cake with a warm molten chocolate center, finished with smooth chocolate ganache.</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Custom</span>
                                    <button class="menu-item-cart" onclick="openModal('Lava Cake (250g - 4pcs)', 3000, 'https://images.unsplash.com/photo-1617305855058-336d24456869?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Rich chocolate cake with a warm molten chocolate center, finished with smooth chocolate ganache.', '🍫 Hot Favorite', '⭐ 4.9', '🍫 Molten Chocolate', '🎂 Chocolate Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cake Item 12 -->
                        <div class="menu-item" data-category="cakes">
                            <img src="https://images.pexels.com/photos/37010324/pexels-photo-37010324.jpeg" alt="Date Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Date Cake</h3>
                                    <span class="menu-item-price">Rs. 2500</span>
                                </div>
                                <p class="menu-item-description">Moist date sponge blended with premium dates and finished with a light caramel glaze</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Custom</span>
                                    <button class="menu-item-cart" onclick="openModal('Date Cake (1 kg)', 2500, 'https://images.pexels.com/photos/37010324/pexels-photo-37010324.jpeg', 'Moist date sponge blended with premium dates and finished with a light caramel glaze', '🌴 Healthy Choice', '⭐ 4.7', '🍯 Dates', '🎂 Date Sponge')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cupcakes Section -->
                <div class="menu-category" data-category="cupcakes">
                    <div class="menu-category-title">
                        <h2>🧁 Cupcakes</h2>
                        <div class="line"></div>
                    </div>
                    <div class="menu-grid">
                        <!-- Cupcake Item 1 -->
                        <div class="menu-item" data-category="cupcakes">
                            <img src="https://plus.unsplash.com/premium_photo-1663840297386-8a3e38271ac6?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Vanilla Cupcake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Vanilla Cupcake</h3>
                                    <span class="menu-item-price">Rs.350</span>
                                </div>
                                <p class="menu-item-description">Lavender buttercream, edible glitter & rainbow sprinkles</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Kid's Fav</span>
                                    <button class="menu-item-cart" onclick="openModal('Vanilla Cupcake', 350, 'https://plus.unsplash.com/premium_photo-1663840297386-8a3e38271ac6?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Lavender buttercream, edible glitter & rainbow sprinkles', 'Kid\'s Fav', '⭐ 4.7', '🌈 Rainbow Sprinkles', '🧁 Vanilla Cupcake')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cupcake Item 2 -->
                        <div class="menu-item" data-category="cupcakes">
                            <img src="https://images.unsplash.com/photo-1610851467358-e2a4a5804335?q=80&w=1099&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Red Velvet Cupcake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Red Velvet Cupcake</h3>
                                    <span class="menu-item-price">Rs.450</span>
                                </div>
                                <p class="menu-item-description">Classic red velvet with cream cheese frosting</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Classic</span>
                                    <button class="menu-item-cart" onclick="openModal('Red Velvet Cupcake', 450, 'https://images.unsplash.com/photo-1610851467358-e2a4a5804335?q=80&w=1099&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Classic red velvet with cream cheese frosting', 'Classic', '⭐ 4.8', '🧀 Cream Cheese', '🧁 Red Velvet')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cupcake Item 3 -->
                        <div class="menu-item" data-category="cupcakes">
                            <img src="https://images.unsplash.com/photo-1649793950107-610f06f3660c?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Chocolate Cupcake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Chocolate Cupcake</h3>
                                    <span class="menu-item-price">Rs.400</span>
                                </div>
                                <p class="menu-item-description">Chocolate cupcake, marshmallow frosting, graham cracker</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Kid's Fav</span>
                                    <button class="menu-item-cart" onclick="openModal('Chocolate Cupcake', 400, 'https://images.unsplash.com/photo-1649793950107-610f06f3660c?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Chocolate cupcake, marshmallow frosting, graham cracker', 'New', '⭐ 4.6', '🔥 Toasted Marshmallow', '🧁 Chocolate Cupcake')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cupcake Item 4 -->
                        <div class="menu-item" data-category="cupcakes">
                            <img src="https://images.unsplash.com/photo-1732966283172-033d29bf02ca?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Lemon Cupcake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Lemon Cupcake</h3>
                                    <span class="menu-item-price">Rs.350</span>
                                </div>
                                <p class="menu-item-description">Lemon cupcake, vanilla frosting, graham cracker</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">New</span>
                                    <button class="menu-item-cart" onclick="openModal('Lemon Cupcake', 350, 'https://images.unsplash.com/photo-1732966283172-033d29bf02ca?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Lemon cupcake, vanilla frosting, graham cracker', 'New', '⭐ 4.6', '🔥 Toasted Marshmallow', '🧁 Lemon Cupcake')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cupcake Item 5 -->
                        <div class="menu-item" data-category="cupcakes">
                            <img src="https://images.unsplash.com/photo-1563778084459-859099e48677?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Strawberry Cupcake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Strawberry Cupcake</h3>
                                    <span class="menu-item-price">Rs.400</span>
                                </div>
                                <p class="menu-item-description">Strawberry cupcake, vanilla frosting, graham cracker</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Kid's Fav</span>
                                    <button class="menu-item-cart" onclick="openModal('Strawberry Cupcake', 400, 'https://images.unsplash.com/photo-1563778084459-859099e48677?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Strawberry cupcake, vanilla frosting, graham cracker', 'Kid's Fav', '⭐ 4.6', '🔥 Toasted Marshmallow', '🧁 Strawberry Cupcake')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cupcake Item 6 -->
                        <div class="menu-item" data-category="cupcakes">
                            <img src="https://images.unsplash.com/photo-1618308386974-892a721e816d?q=80&w=717&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cookies & Cream Cupcake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Cookies & Cream Cupcake</h3>
                                    <span class="menu-item-price">Rs.450</span>
                                </div>
                                <p class="menu-item-description">Cookies & Cream cupcake, vanilla frosting, graham cracker</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Kid's Fav</span>
                                    <button class="menu-item-cart" onclick="openModal('Cookies & Cream Cupcake', 450, 'https://images.unsplash.com/photo-1618308386974-892a721e816d?q=80&w=717&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Cookies & Cream cupcake, vanilla frosting, graham cracker', 'New', '⭐ 4.6', '🔥 Toasted Marshmallow', '🧁 Cookies & Cream Cupcake')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cupcake Item 7 -->
                        <div class="menu-item" data-category="cupcakes">
                            <img src="https://images.unsplash.com/photo-1693464318938-ea7092d5c818?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Salted Caramel Cupcake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Salted Caramel Cupcake</h3>
                                    <span class="menu-item-price">Rs.450</span>
                                </div>
                                <p class="menu-item-description">Salted caramel cupcake, salted caramel frosting, graham cracker</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">New</span>
                                    <button class="menu-item-cart" onclick="openModal('Salted Caramel Cupcake', 450, 'https://images.unsplash.com/photo-1693464318938-ea7092d5c818?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Salted caramel cupcake, salted caramel frosting, graham cracker', 'New', '⭐ 4.6', '🔥 Toasted Marshmallow', '🧁 Salted Caramel Cupcake')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cupcake Item 8 -->
                        <div class="menu-item" data-category="cupcakes">
                            <img src="https://images.unsplash.com/photo-1680580735621-4371027734eb?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Rainbow Sprinkle Cupcake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Rainbow Sprinkle Cupcake</h3>
                                    <span class="menu-item-price">Rs.400</span>
                                </div>
                                <p class="menu-item-description">Rainbow sprinkle cupcake, rainbow sprinkle frosting, graham cracker</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Kid's Fav</span>
                                    <button class="menu-item-cart" onclick="openModal('Rainbow Sprinkle Cupcake', 400, 'https://images.unsplash.com/photo-1680580735621-4371027734eb?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Rainbow sprinkle cupcake, rainbow sprinkle frosting, graham cracker', 'Kid's Fav', '⭐ 4.6', '🔥 Toasted Marshmallow', '🧁 Rainbow Sprinkle Cupcake')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cupcake Item 9 -->
                        <div class="menu-item" data-category="cupcakes">
                            <img src="https://images.unsplash.com/photo-1603532648955-039310d9ed75?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Nutella Cupcake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Nutella Cupcake</h3>
                                    <span class="menu-item-price">Rs.500</span>
                                </div>
                                <p class="menu-item-description">Nutella cupcake, marshmallow frosting, graham cracker</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Classic</span>
                                    <button class="menu-item-cart" onclick="openModal('Nutella Cupcake', 500, 'https://images.unsplash.com/photo-1603532648955-039310d9ed75?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Nutella cupcake, marshmallow frosting, graham cracker', 'Kid's Fav', '⭐ 4.6', '🔥 Toasted Marshmallow', '🧁 Nutella Cupcake')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cupcake Item 10 -->
                        <div class="menu-item" data-category="cupcakes">
                            <img src="https://images.unsplash.com/photo-1606188074044-fcd750f6996a?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Coffee Cupcake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Coffee Cupcake</h3>
                                    <span class="menu-item-price">Rs.400</span>
                                </div>
                                <p class="menu-item-description">Chocolate cupcake, marshmallow frosting, graham cracker</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Classic</span>
                                    <button class="menu-item-cart" onclick="openModal('Coffee Cupcake', 400, 'https://images.unsplash.com/photo-1606188074044-fcd750f6996a?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Chocolate cupcake, marshmallow frosting, graham cracker', 'Classic', '⭐ 4.6', '🔥 Toasted Marshmallow', '🧁 Chocolate Cupcake')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Birthday Cake Section -->
                <div class="menu-category" data-category="birthday-cakes">
                    <div class="menu-category-title">
                        <h2>🌈 Birthday Cake</h2>
                        <div class="line"></div>
                    </div>
                    <div class="menu-grid">
                        <!-- Birthday Cake Item 1 -->
                        <div class="menu-item" data-category="birthday-cakes">
                            <img src="https://images.unsplash.com/photo-1622576890453-8e50b6f7d5b0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Rainbow Birthday Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Rainbow Birthday Cake</h3>
                                    <span class="menu-item-price">Rs.7500</span>
                                </div>
                                <p class="menu-item-description">12 assorted pastel macarons: pistachio, rose, vanilla, chocolate</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Premium</span>
                                    <button class="menu-item-cart" onclick="openModal('Rainbow Birthday Cake', 7500, 'https://images.unsplash.com/photo-1622576890453-8e50b6f7d5b0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '12 assorted pastel macarons: pistachio, rose, vanilla, chocolate', 'Best Seller', '⭐ 4.9', '🎁 Gift Ready', '🌈 6 Flavors')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Birthday Cake Item 2 -->
                        <div class="menu-item" data-category="birthday-cakes">
                            <img src="https://images.unsplash.com/photo-1517398823963-c2dc6fc3e837?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Princess Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Princess Cake</h3>
                                    <span class="menu-item-price">Rs.9500</span>
                                </div>
                                <p class="menu-item-description">36 macarons in 6 flavors, perfect for special occasions</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Premium</span>
                                    <button class="menu-item-cart" onclick="openModal('Princess Cake', 9500, 'https://images.unsplash.com/photo-1517398823963-c2dc6fc3e837?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '36 macarons in 6 flavors, perfect for special occasions', 'Premium', '⭐ 4.9', '🎂 Special Occasion', '🌈 6 Flavors')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Birthday Cake Item 3 -->
                        <div class="menu-item" data-category="birthday-cakes">
                            <img src="https://images.unsplash.com/photo-1637724562261-5777b67c59b2?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Superhero Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Superhero Cake </h3>
                                    <span class="menu-item-price">Rs.9000</span>
                                </div>
                                <p class="menu-item-description">36 macarons in 6 flavors, perfect for special occasions</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Premium</span>
                                    <button class="menu-item-cart" onclick="openModal('Superhero Cake', 9000, 'https://images.unsplash.com/photo-1637724562261-5777b67c59b2?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '36 macarons in 6 flavors, perfect for special occasions', 'Premium', '⭐ 4.9', '🎂 Special Occasion', '🌈 6 Flavors')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Birthday Cake Item 4 -->
                        <div class="menu-item" data-category="birthday-cakes">
                            <img src="https://images.unsplash.com/photo-1697157202877-622683269d7c?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Unicorn Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Unicorn Cake</h3>
                                    <span class="menu-item-price">Rs.10 500</span>
                                </div>
                                <p class="menu-item-description">36 macarons in 6 flavors, perfect for special occasions</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Premium</span>
                                    <button class="menu-item-cart" onclick="openModal('Unicorn Cake', 10500, 'https://images.unsplash.com/photo-1697157202877-622683269d7c?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '36 macarons in 6 flavors, perfect for special occasions', 'Premium', '⭐ 4.9', '🎂 Special Occasion', '🌈 6 Flavors')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Birthday Cake Item 5 -->
                        <div class="menu-item" data-category="birthday-cakes">
                            <img src="https://images.unsplash.com/photo-1671686400734-d9d0a4934f5a?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Frozen Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Frozen Cake</h3>
                                    <span class="menu-item-price">Rs.10 000</span>
                                </div>
                                <p class="menu-item-description">36 macarons in 6 flavors, perfect for special occasions</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Premium</span>
                                    <button class="menu-item-cart" onclick="openModal('Frozen Cake', 10000, 'https://images.unsplash.com/photo-1671686400734-d9d0a4934f5a?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '36 macarons in 6 flavors, perfect for special occasions', 'Premium', '⭐ 4.9', '🎂 Special Occasion', '🌈 6 Flavors')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Birthday Cake Item 6 -->
                        <div class="menu-item" data-category="birthday-cakes">
                            <img src="https://images.unsplash.com/photo-1695275673485-8d3ef4965615?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Dinosour Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Dinosour Cake</h3>
                                    <span class="menu-item-price">Rs.9500</span>
                                </div>
                                <p class="menu-item-description">36 macarons in 6 flavors, perfect for special occasions</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Premium</span>
                                    <button class="menu-item-cart" onclick="openModal('Dinosour Cake', 9500, 'https://images.unsplash.com/photo-1695275673485-8d3ef4965615?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '36 macarons in 6 flavors, perfect for special occasions', 'Premium', '⭐ 4.9', '🎂 Special Occasion', '🌈 6 Flavors')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Birthday Cake Item 7 -->
                        <div class="menu-item" data-category="birthday-cakes">
                            <img src="https://images.pexels.com/photos/4005315/pexels-photo-4005315.jpeg" alt="Sports Theme Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Sports Theme Cake</h3>
                                    <span class="menu-item-price">Rs.8500</span>
                                </div>
                                <p class="menu-item-description">36 macarons in 6 flavors, perfect for special occasions</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Premium</span>
                                    <button class="menu-item-cart" onclick="openModal('Sports Theme Cake', 8500, 'https://images.pexels.com/photos/4005315/pexels-photo-4005315.jpeg', '36 macarons in 6 flavors, perfect for special occasions', 'Premium', '⭐ 4.9', '🎂 Special Occasion', '🌈 6 Flavors')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Birthday Cake Item 8 -->
                        <div class="menu-item" data-category="birthday-cakes">
                            <img src="https://images.unsplash.com/photo-1591519060886-27dd11ad7f5a?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Number Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Number Cake</h3>
                                    <span class="menu-item-price">Rs.8000</span>
                                </div>
                                <p class="menu-item-description">36 macarons in 6 flavors, perfect for special occasions</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Premium</span>
                                    <button class="menu-item-cart" onclick="openModal('Number Cake', 8000, 'https://images.unsplash.com/photo-1591519060886-27dd11ad7f5a?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '36 macarons in 6 flavors, perfect for special occasions', 'Premium', '⭐ 4.9', '🎂 Special Occasion', '🌈 6 Flavors')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Birthday Cake Item 9 -->
                        <div class="menu-item" data-category="birthday-cakes">
                            <img src="https://images.pexels.com/photos/13321665/pexels-photo-13321665.jpeg" alt="Barbie Theme Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Barbie Theme Cake</h3>
                                    <span class="menu-item-price">Rs.11 000</span>
                                </div>
                                <p class="menu-item-description">36 macarons in 6 flavors, perfect for special occasions</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Premium</span>
                                    <button class="menu-item-cart" onclick="openModal('Barbie Theme Cake', 11000, 'https://images.pexels.com/photos/13321665/pexels-photo-13321665.jpeg', '36 macarons in 6 flavors, perfect for special occasions', 'Premium', '⭐ 4.9', '🎂 Special Occasion', '🌈 6 Flavors')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Birthday Cake Item 10 -->
                        <div class="menu-item" data-category="birthday-cakes">
                            <img src="https://images.unsplash.com/photo-1627274273203-84de3a4a49cf?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Macaron Tower" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Photo Printed Cake</h3>
                                    <span class="menu-item-price">Rs.8500</span>
                                </div>
                                <p class="menu-item-description">36 macarons in 6 flavors, perfect for special occasions</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Premium</span>
                                    <button class="menu-item-cart" onclick="openModal('Photo Printed Cake', 8500, 'https://images.unsplash.com/photo-1627274273203-84de3a4a49cf?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '36 macarons in 6 flavors, perfect for special occasions', 'Premium', '⭐ 4.9', '🎂 Special Occasion', '🌈 6 Flavors')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cookies Section -->
                <div class="menu-category" data-category="cookies">
                    <div class="menu-category-title">
                        <h2>🍪 Cookies</h2>
                        <div class="line"></div>
                    </div>
                    <div class="menu-grid">
                        <!-- Cookies Item 1 -->
                        <div class="menu-item" data-category="cookies">
                            <img src="https://images.unsplash.com/photo-1499636136210-6f4ee915583e?w=600&auto=format" alt="Chocolate Chip Cookies" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Chocolate Chip Cookies</h3>
                                    <span class="menu-item-price">Rs.1200</span>
                                </div>
                                <p class="menu-item-description">Classic soft-baked cookies with premium chocolate chips (6 pack)</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Premium</span>
                                    <button class="menu-item-cart" onclick="openModal('Chocolate Chip Cookies', 1200, 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?w=600&auto=format', 'Classic soft-baked cookies with premium chocolate chips (6 pack)', 'Classic', '⭐ 4.7', '🍫 Premium Chips', '🍪 6 Pack')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Cookie Item 2 -->
                        <div class="menu-item" data-category="cookies">
                            <img src="https://images.unsplash.com/photo-1600625649542-f668edc636dc?q=80&w=895&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Butter Cookies" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Butter Cookies</h3>
                                    <span class="menu-item-price">Rs.1000</span>
                                </div>
                                <p class="menu-item-description">White chocolate & macadamia nut cookies (6 pack)</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Classic</span>
                                    <button class="menu-item-cart" onclick="openModal('Butter Cookies', 1000, 'https://images.unsplash.com/photo-1600625649542-f668edc636dc?q=80&w=895&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'White chocolate & macadamia nut cookies (6 pack)', 'Premium', '⭐ 4.8', '🥜 Macadamia Nuts', '🍪 6 Pack')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specials Section -->
                <div class="menu-category" data-category="specials">
                    <div class="menu-category-title">
                        <h2>✨ Specials</h2>
                        <div class="line"></div>
                    </div>
                    <div class="menu-grid">
                        <!-- Specials Item 1 -->
                        <div class="menu-item" data-category="specials">
                            <img src="https://images.unsplash.com/photo-1535254973040-607b474cb50d?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Wedding Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Wedding Cake</h3>
                                    <span class="menu-item-price">From Rs.10 000</span>
                                </div>
                                <p class="menu-item-description">Fully customizable cake with your choice of flavors and design</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Custom</span>
                                    <button class="menu-item-cart" onclick="openModal('Wedding Cake', 'From Rs.10,000', 'https://images.unsplash.com/photo-1535254973040-607b474cb50d?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'Fully customizable cake with your choice of flavors and design', 'Custom', '⭐ 5.0', '🎨 Your Design', '✨ Custom Order')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Specials Item 2 -->
                        <div class="menu-item" data-category="specials">
                            <img src="https://images.unsplash.com/photo-1627935817583-a8d4531ccc62?q=80&w=1089&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Anniversary Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Anniversary Cake</h3>
                                    <span class="menu-item-price">From Rs.3000</span>
                                </div>
                                <p class="menu-item-description">6 cake pops in assorted flavors with pastel coatings</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Custom</span>
                                    <button class="menu-item-cart" onclick="openModal('Anniversary Cake', 'From Rs.3,000', 'https://images.unsplash.com/photo-1627935817583-a8d4531ccc62?q=80&w=1089&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '6 cake pops in assorted flavors with pastel coatings', 'Custom', '⭐ 4.6', '🌈 Assorted Colors', '🍭 6 Pops')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Specials Item 3 -->
                        <div class="menu-item" data-category="specials">
                            <img src="https://images.unsplash.com/photo-1655049117535-541607305230?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Gender Reveal Cake" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Gender Reveal Cake</h3>
                                    <span class="menu-item-price">From Rs.3,000</span>
                                </div>
                                <p class="menu-item-description">6 cake pops in assorted flavors with pastel coatings</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Custom</span>
                                    <button class="menu-item-cart" onclick="openModal('Gender Reveal Cake', 'From Rs.3,000', 'https://images.unsplash.com/photo-1655049117535-541607305230?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '6 cake pops in assorted flavors with pastel coatings', 'Custom', '⭐ 4.6', '🌈 Assorted Colors', '🍭 6 Pops')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Specials Item 4 -->
                        <div class="menu-item" data-category="specials">
                            <img src="https://images.unsplash.com/photo-1755690042574-cd32f542d9f0?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Bento" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Bento Cake</h3>
                                    <span class="menu-item-price">From Rs.1,000</span>
                                </div>
                                <p class="menu-item-description">6 cake pops in assorted flavors with pastel coatings</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Custom</span>
                                    <button class="menu-item-cart" onclick="openModal('Bento', 'From Rs.1,000', 'https://images.unsplash.com/photo-1755690042574-cd32f542d9f0?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '6 cake pops in assorted flavors with pastel coatings', 'Custom', '⭐ 4.6', '🌈 Assorted Colors', '🍭 6 Pops')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Specials Item 5 -->
                        <div class="menu-item" data-category="specials">
                            <img src="https://images.unsplash.com/photo-1586195830864-e4d9688815c8?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cake Pop Box" class="menu-item-image">
                            <div class="menu-item-content">
                                <div class="menu-item-header">
                                    <h3>Cake Pop Box</h3>
                                    <span class="menu-item-price">Rs.2500</span>
                                </div>
                                <p class="menu-item-description">6 cake pops in assorted flavors with pastel coatings</p>
                                <div class="menu-item-footer">
                                    <span class="menu-item-tag">Custom</span>
                                    <button class="menu-item-cart" onclick="openModal('Cake Pop Box', 'Rs.2500', 'https://images.unsplash.com/photo-1586195830864-e4d9688815c8?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '6 cake pops in assorted flavors with pastel coatings', 'Kids Fav', '⭐ 4.6', '🌈 Assorted Colors', '🍭 6 Pops')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
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
    </main>

    <!-- ===== MODAL / POPUP ===== -->
    <div class="modal-overlay" id="modalOverlay" onclick="closeModalOutside(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            
            <div class="modal-image-wrapper">
                <img src="" alt="Product Image" class="modal-image" id="modalImage">
                <span class="modal-badge" id="modalBadge">Best Seller</span>
            </div>
            
            <div class="modal-body">
                <div class="modal-body-top">
                    <h2 id="modalTitle">Product Name</h2>
                    <span class="modal-price" id="modalPrice">Rs.0</span>
                </div>
                
                <div class="modal-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <span id="modalRating">4.9</span>
                </div>
                
                <p class="modal-description" id="modalDescription">Product description</p>
                
                <div class="modal-details">
                    <div class="modal-detail-item">   
                        <span id="modalTagDisplay">Best Seller</span>
                    </div>
                    <div class="modal-detail-item"> 
                        <span id="modalFlavor">Vanilla</span>
                    </div>
                    <div class="modal-detail-item">
                        <span id="modalSize">Standard</span>
                    </div>
                    <div class="modal-detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Ready in 24h</span>
                    </div>
                </div>
                
                <button class="modal-order-btn" onclick="handleOrder()">
                    <i class="fas fa-shopping-bag"></i> Order Now
                </button>
            </div>
        </div>
    </div>

    <!-- ===== TOAST MESSAGE ===== -->
    <div class="toast-message" id="toastMessage">
        <i class="fas fa-exclamation-circle"></i>
        <span id="toastText">Please login to continue</span>
        <button class="toast-close" onclick="hideToast()"><i class="fas fa-times"></i></button>
    </div>

    <script>
        // ===== MODAL FUNCTIONS =====
        let currentProduct = {};

        function openModal(name, price, image, description, tag, rating, detail1, detail2) {
            // Store current product data
            currentProduct = { name, price, image, description, tag };
            
            document.getElementById('modalImage').src = image;
            document.getElementById('modalTitle').textContent = name;
            document.getElementById('modalPrice').textContent = typeof price === 'string' ? price : 'Rs.' + price;
            document.getElementById('modalDescription').textContent = description;
            document.getElementById('modalBadge').textContent = tag;
            document.getElementById('modalRating').textContent = rating;
            document.getElementById('modalTagDisplay').textContent = tag;
            document.getElementById('modalFlavor').textContent = detail1 ;
            document.getElementById('modalSize').textContent = detail2 ;
            
            document.getElementById('modalOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modalOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }

        function closeModalOutside(event) {
            if (event.target === document.getElementById('modalOverlay')) {
                closeModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // ===== ORDER HANDLING =====
        function handleOrder() {
            const isLoggedIn = checkLoginStatus();
            
            if (!isLoggedIn) {
                //showToast('Please login to order this product');
                setTimeout(() => {
                    // Redirect to login page
                    window.location.href = "{{ route('login') }}";
                }, 1500);
                return;
            }
            
            // If logged in, redirect to product page
            window.location.href = "{{ route('products') }}/" + encodeURIComponent(currentProduct.name);
        }

        // ===== LOGIN STATUS CHECK =====
        function checkLoginStatus() {
            return false; // Set to true if user is logged in
        }

        // ===== TOAST MESSAGE =====
        let toastTimeout;

        function showToast(message) {
            const toast = document.getElementById('toastMessage');
            const toastText = document.getElementById('toastText');
            
            toastText.textContent = message;
            toast.classList.add('show');
            
            // Clear any existing timeout
            if (toastTimeout) {
                clearTimeout(toastTimeout);
            }
            
            // Auto hide after 5 seconds
            toastTimeout = setTimeout(() => {
                hideToast();
            }, 5000);
        }

        function hideToast() {
            const toast = document.getElementById('toastMessage');
            toast.classList.remove('show');
            if (toastTimeout) {
                clearTimeout(toastTimeout);
            }
        }

        // ===== FILTER FUNCTIONALITY =====
        function filterMenu(category) {
            const items = document.querySelectorAll('.menu-item');
            const categories = document.querySelectorAll('.menu-category');

            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });

            categories.forEach(cat => {
                const hasVisibleItems = Array.from(cat.querySelectorAll('.menu-item')).some(
                    item => item.style.display !== 'none'
                );
                cat.style.display = hasVisibleItems ? 'block' : 'none';
            });
        }

        // ===== SCROLL HEADER EFFECT =====
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // ===== GO TO SPECIFIC CATEGORY =====
        document.addEventListener('DOMContentLoaded', function () {
            const params = new URLSearchParams(window.location.search);
            const category = params.get('category');

            if (!category) return;

            const categories = document.querySelectorAll('.menu-category');

            categories.forEach(section => {
                if (section.dataset.category === category) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        });
    </script>

</body>
</html>