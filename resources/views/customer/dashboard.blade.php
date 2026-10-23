<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disna Bakery - Fresh Baked Goods & Custom Cakes</title>

     <!-- logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        /* Override Bootstrap dark mode for Laravel compatibility */
        .dark body {
            background: #111827;
        }

        /* Navbar Styles - Bakery Theme */
        .navbar {
            background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%);
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: white !important;
        }

        .navbar-brand i {
            margin-right: 10px;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s;
        }

        .nav-link:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .navbar .dropdown-menu {
            z-index: 1100;
            min-width: 220px;
            margin-top: 0.6rem;
            padding: 0.5rem;
            background: #fffaf4;
            border: 1px solid #eadfd4;
            border-radius: 12px;
            box-shadow: 0 14px 30px rgba(51, 35, 31, 0.2);
        }

        .navbar .dropdown-item {
            padding: 0.65rem 0.75rem;
            color: #60453a;
            border-radius: 8px;
        }

        .navbar .dropdown-item:hover,
        .navbar .dropdown-item:focus {
            background: #fff0e6;
            color: #bd6545;
        }

        .navbar .dropdown-divider {
            border-color: #eadfd4;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1558961363-fa8fdf82db35?ixlib=rb-4.0.3');
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            margin-top: 76px;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 20px;
            animation: fadeInUp 1s;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 30px;
            animation: fadeInUp 1s 0.2s;
        }

        .hero .btn {
            margin: 10px;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            animation: fadeInUp 1s 0.4s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Featured Categories */
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            font-size: 2.5rem;
            font-weight: bold;
            color: #5c3d2e;
        }

        .dark .section-title {
            color: #fcd34d;
        }

        .category-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
            margin-bottom: 30px;
            cursor: pointer;
        }

        .dark .category-card {
            background: #1f2937;
            color: #f3f4f6;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .category-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .category-card .info {
            padding: 20px;
            text-align: center;
        }

        .category-card h4 {
            margin-bottom: 10px;
            color: #5c3d2e;
        }

        .dark .category-card h4 {
            color: #fcd34d;
        }

        /* Featured Products */
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
            margin-bottom: 30px;
            height: 100%;
        }

        .dark .product-card {
            background: #1f2937;
            color: #f3f4f6;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .product-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .product-card .info {
            padding: 20px;
        }

        .product-card .price {
            font-size: 1.5rem;
            color: #d4a373;
            font-weight: bold;
        }

        .dark .product-card .price {
            color: #f59e0b;
        }

        .btn-add {
            background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            width: 100%;
            color: white;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-add:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(180, 130, 80, 0.4);
        }

        /* Custom Cake Banner */
        .custom-cake-banner {
            background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%);
            border-radius: 20px;
            padding: 50px;
            margin: 50px 0;
            color: white;
            text-align: center;
        }

        .custom-cake-banner h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .btn-customize {
            background: white;
            color: #b5835a;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: bold;
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-customize:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: #b5835a;
        }

        /* Footer */
        footer {
            background: #2c241f;
            color: white;
            padding: 50px 0 20px;
            margin-top: 50px;
        }

        .dark footer {
            background: #1a1410;
        }

        footer h5 {
            margin-bottom: 20px;
            color: #fcd34d;
        }

        footer .social-links a {
            color: white;
            font-size: 1.5rem;
            margin-right: 15px;
            transition: all 0.3s;
            display: inline-block;
        }

        footer .social-links a:hover {
            color: #d4a373;
            transform: translateY(-3px);
        }

        footer a.text-white {
            transition: all 0.3s;
        }

        footer a.text-white:hover {
            color: #d4a373 !important;
        }

        .cart-badge {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -12px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 11px;
            font-weight: bold;
        }

        /* User Dashboard Card Styles */
        .welcome-card {
            background: linear-gradient(135deg, #d4a37320 0%, #b5835a20 100%);
            border-left: 4px solid #d4a373;
        }

        .stat-card {
            transition: all 0.3s;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .hero {
                margin-top: 60px;
                height: 400px;
            }
            .hero h1 {
                font-size: 2rem;
            }
            .hero p {
                font-size: 1rem;
            }
            .section-title {
                font-size: 1.8rem;
            }
            .custom-cake-banner {
                padding: 30px;
            }
            .custom-cake-banner h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation  -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Disna Bakery" width="40"> Disna Bakery
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('custom-products.customer') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('custom-cake') }}">Custom Cake</a>
                    </li>
                    
                     @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('customer.orders') }}"><i class="fas fa-box"></i> My Orders</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-cog"></i> Profile Settings
                                    </a>
                                </li>
                        
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="background: none; border: none; width: 100%; text-align: left;">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Customer Dashboard Section -->
    @auth
    <div class="container mt-5 pt-4">
        <div class="row">
            <div class="col-12">
                <!-- Welcome Section -->
                <div class="welcome-card bg-white dark:bg-gray-800 rounded-3 shadow-sm p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h3 class="mb-1 text-dark">Welcome back, {{ Auth::user()->name }}! </h3>
                            <p class="text-muted mb-0">Your sweet journey continues here</p>
                        </div>
                        <div class="mt-2 mt-sm-0">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-map-marker-alt"></i> {{ Auth::user()->city ?? 'Add city' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="stat-card bg-white dark:bg-gray-800 rounded-3 p-4 shadow-sm text-center">
                            <div class="icon mb-2">
                                <i class="fas fa-shopping-bag fa-2x text-warning"></i>
                            </div>
                            <h3 class="mb-1 fw-bold">{{ $totalOrders ?? 0 }}</h3>
                            <p class="text-muted mb-0">Total Orders</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card bg-white dark:bg-gray-800 rounded-3 p-4 shadow-sm text-center">
                            <div class="icon mb-2">
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            </div>
                            <h3 class="mb-1 fw-bold">{{ $completedOrders ?? 0 }}</h3>
                            <p class="text-muted mb-0">Completed Orders</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card bg-white dark:bg-gray-800 rounded-3 p-4 shadow-sm text-center">
                            <div class="icon mb-2">
                                <i class="fas fa-clock fa-2x text-warning"></i>
                            </div>
                            <h3 class="mb-1 fw-bold">{{ $pendingOrders ?? 0 }}</h3>
                            <p class="text-muted mb-0">Pending Orders</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-gray-800 rounded-3 shadow-sm p-4 mb-5">
                    <h5 class="mb-3 fw-bold"><i class="fas fa-bolt text-warning"></i> Quick Actions</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('custom-products.customer') }}" class="text-decoration-none">
                                <div class="border rounded-3 p-3 hover-shadow transition">
                                    <i class="fas fa-cake-candles fa-2x text-warning mb-2"></i>
                                    <h6 class="mb-0 fw-bold">Browse Products</h6>
                                    <small class="text-muted">Explore our fresh bakery menu</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('customer.orders') }}" class="text-decoration-none">
                                <div class="border rounded-3 p-3 hover-shadow transition">
                                    <i class="fas fa-truck fa-2x text-info mb-2"></i>
                                    <h6 class="mb-0 fw-bold">My Orders</h6>
                                    <small class="text-muted">Track your order status</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Welcome to Sweet Bakery</h1>
            <p>Fresh, delicious baked goods made with love and passion</p>
            <a href="{{ route('custom-products.customer') }}" class="btn btn-light btn-lg">Shop Now</a>
            <a href="{{ route('custom-cake') }}" class="btn btn-outline-light btn-lg">Customize Your Cake</a>
        </div>
    </section>

    <!-- Featured Categories -->
    <div style="max-width: 1140px; margin: 3rem auto 0; padding: 0 1.5rem;">

        <!-- Section Title -->
        <h2 style="font-family: Georgia, 'Times New Roman', serif; font-size: 2.2rem; font-weight: 700; color: #2c241f; text-align: center; margin-bottom: 2.5rem; position: relative; display: inline-block; width: 100%;">
            <span style="background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%); display: inline-block; padding: 0 1.5rem; border-radius: 50px; color: white; line-height: 1.4;">Shop by Category</span>
        </h2>

        <!-- Category Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1.8rem;">

            <!-- 1. Birthday Cakes -->
            <div onclick="window.location.href='{{ route('custom-products.customer') }}?category=birthday-cakes'" 
                style="background: #ffffff; border-radius: 20px; padding: 1.5rem 1rem; text-align: center; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(83, 55, 40, 0.08); border: 1px solid #eadfd4;"
                onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(83, 55, 40, 0.15)'; this.style.borderColor='#d4a373';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(83, 55, 40, 0.08)'; this.style.borderColor='#eadfd4';">
                <div style="width: 90px; height: 90px; border-radius: 50%; margin: 0 auto 1rem; overflow: hidden; border: 3px solid #d4a373; box-shadow: 0 4px 12px rgba(212, 163, 115, 0.25);">
                    <img src="https://plus.unsplash.com/premium_photo-1663839412026-51a44cfadfb8?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                        alt="Birthday Cakes" 
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 style="font-size: 1.05rem; font-weight: 700; color: #2c241f; margin: 0; letter-spacing: 0.02em;">Birthday Cakes</h3>
                <span style="font-size: 0.75rem; color: #8a7a6e; font-weight: 500; display: inline-block; margin-top: 4px;">Celebrate in style</span>
            </div>

            <!-- 2. CupCakes -->
            <div onclick="window.location.href='{{ route('custom-products.customer') }}?category=cupcakes'" 
                style="background: #ffffff; border-radius: 20px; padding: 1.5rem 1rem; text-align: center; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(83, 55, 40, 0.08); border: 1px solid #eadfd4;"
                onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(83, 55, 40, 0.15)'; this.style.borderColor='#d4a373';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(83, 55, 40, 0.08)'; this.style.borderColor='#eadfd4';">
                <div style="width: 90px; height: 90px; border-radius: 50%; margin: 0 auto 1rem; overflow: hidden; border: 3px solid #d4a373; box-shadow: 0 4px 12px rgba(212, 163, 115, 0.25);">
                    <img src="https://images.unsplash.com/photo-1566864399117-22c449669089?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                        alt="Cupcakes" 
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 style="font-size: 1.05rem; font-weight: 700; color: #2c241f; margin: 0; letter-spacing: 0.02em;">CupCakes</h3>
                <span style="font-size: 0.75rem; color: #8a7a6e; font-weight: 500; display: inline-block; margin-top: 4px;">Perfect little treats</span>
            </div>

            <!-- 3. Cakes -->
            <div onclick="window.location.href='{{ route('custom-products.customer') }}?category=cakes'" 
                style="background: #ffffff; border-radius: 20px; padding: 1.5rem 1rem; text-align: center; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(83, 55, 40, 0.08); border: 1px solid #eadfd4;"
                onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(83, 55, 40, 0.15)'; this.style.borderColor='#d4a373';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(83, 55, 40, 0.08)'; this.style.borderColor='#eadfd4';">
                <div style="width: 90px; height: 90px; border-radius: 50%; margin: 0 auto 1rem; overflow: hidden; border: 3px solid #d4a373; box-shadow: 0 4px 12px rgba(212, 163, 115, 0.25);">
                    <img src="https://plus.unsplash.com/premium_photo-1669245220400-6c04752ec08a?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                        alt="Cakes" 
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 style="font-size: 1.05rem; font-weight: 700; color: #2c241f; margin: 0; letter-spacing: 0.02em;">Cakes</h3>
                <span style="font-size: 0.75rem; color: #8a7a6e; font-weight: 500; display: inline-block; margin-top: 4px;">Classic favorites</span>
            </div>

            <!-- 4. Cookies -->
            <div onclick="window.location.href='{{ route('custom-products.customer') }}?category=cookies'" 
                style="background: #ffffff; border-radius: 20px; padding: 1.5rem 1rem; text-align: center; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(83, 55, 40, 0.08); border: 1px solid #eadfd4;"
                onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(83, 55, 40, 0.15)'; this.style.borderColor='#d4a373';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(83, 55, 40, 0.08)'; this.style.borderColor='#eadfd4';">
                <div style="width: 90px; height: 90px; border-radius: 50%; margin: 0 auto 1rem; overflow: hidden; border: 3px solid #d4a373; box-shadow: 0 4px 12px rgba(212, 163, 115, 0.25);">
                    <img src="https://images.unsplash.com/photo-1590080874088-eec64895b423?q=80&w=894&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                        alt="Cookies" 
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 style="font-size: 1.05rem; font-weight: 700; color: #2c241f; margin: 0; letter-spacing: 0.02em;">Cookies</h3>
                <span style="font-size: 0.75rem; color: #8a7a6e; font-weight: 500; display: inline-block; margin-top: 4px;">Crunchy & delicious</span>
            </div>

            <!-- 5. Specials -->
            <div onclick="window.location.href='{{ route('custom-products.customer') }}?category=specials'" 
                style="background: #ffffff; border-radius: 20px; padding: 1.5rem 1rem; text-align: center; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(83, 55, 40, 0.08); border: 1px solid #eadfd4;"
                onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(83, 55, 40, 0.15)'; this.style.borderColor='#d4a373';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(83, 55, 40, 0.08)'; this.style.borderColor='#eadfd4';">
                <div style="width: 90px; height: 90px; border-radius: 50%; margin: 0 auto 1rem; overflow: hidden; border: 3px solid #d4a373; box-shadow: 0 4px 12px rgba(212, 163, 115, 0.25);">
                    <img src="https://images.unsplash.com/photo-1629389861081-43cc4f172b0c?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                        alt="Specials" 
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 style="font-size: 1.05rem; font-weight: 700; color: #2c241f; margin: 0; letter-spacing: 0.02em;">Specials</h3>
                <span style="font-size: 0.75rem; color: #8a7a6e; font-weight: 500; display: inline-block; margin-top: 4px;">Seasonal delights</span>
            </div>

        </div>
    </div>

    <!-- Featured Products -->
    <div style="max-width: 1140px; margin: 3.5rem auto 0; padding: 0 1.5rem;">

        <!-- Section Title -->
        <h2 style="font-family: Georgia, 'Times New Roman', serif; font-size: 2.2rem; font-weight: 700; color: #2c241f; text-align: center; margin-bottom: 2.8rem; position: relative;">
            <span style="background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%); display: inline-block; padding: 0 1.8rem; border-radius: 50px; color: white; line-height: 1.4;">Featured Products</span>
        </h2>

        <!-- Products Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">

            <!-- Product 1: Strawberry Cream Cake -->
            <div style="background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 20px rgba(83, 55, 40, 0.08); border: 1px solid #eadfd4; transition: all 0.3s ease;"
                onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 50px rgba(83, 55, 40, 0.15)'; this.style.borderColor='#d4a373';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(83, 55, 40, 0.08)'; this.style.borderColor='#eadfd4';">
                
                <div style="position: relative; overflow: hidden;">
                    <img src="https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=500&auto=format" 
                        alt="Strawberry Cream Cake" 
                        style="width:100%; height:240px; object-fit:cover; transition: transform 0.5s ease;"
                        onmouseover="this.style.transform='scale(1.05)'"
                        onmouseout="this.style.transform='scale(1)'">
                    <!-- Badge -->
                    <span style="position: absolute; top: 12px; left: 12px; background: linear-gradient(135deg, #d4a373, #b5835a); color: white; font-size: 0.7rem; font-weight: 700; padding: 0.3rem 0.8rem; border-radius: 50px; letter-spacing: 0.04em; text-transform: uppercase;">Best Seller</span>
                </div>

                <div style="padding: 1.5rem 1.5rem 1.8rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                        <h3 style="font-size: 1.2rem; font-weight: 700; color: #2c241f; margin: 0;">Strawberry Cream Cake</h3>
                        <span style="font-size: 0.8rem; color: #8a7a6e; background: #f7efe9; padding: 0.2rem 0.7rem; border-radius: 50px; font-weight: 600;">⭐ 4.9</span>
                    </div>
                    <p style="color: #6C5B4A; font-size: 0.85rem; line-height: 1.6; margin: 0.5rem 0 1.2rem; min-height: 60px;">Soft vanilla sponge layered with fresh strawberries and whipped cream</p>
                    <button onclick="window.location.href='{{ route('custom-products.customer') }}?category=cakes'" 
                            style="width:100%; padding: 0.8rem; border: none; border-radius: 50px; background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%); color: white; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 0.6rem; box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(212, 163, 115, 0.45)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(212, 163, 115, 0.3)';">
                        <i class="fas fa-eye"></i> View Product
                    </button>
                </div>
            </div>

            <!-- Product 2: Chocolate Cake -->
            <div style="background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 20px rgba(83, 55, 40, 0.08); border: 1px solid #eadfd4; transition: all 0.3s ease;"
                onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 50px rgba(83, 55, 40, 0.15)'; this.style.borderColor='#d4a373';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(83, 55, 40, 0.08)'; this.style.borderColor='#eadfd4';">
                
                <div style="position: relative; overflow: hidden;">
                    <img src="https://images.unsplash.com/photo-1621868402792-a5c9fa6866a3?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                        alt="Chocolate Cake" 
                        style="width:100%; height:240px; object-fit:cover; transition: transform 0.5s ease;"
                        onmouseover="this.style.transform='scale(1.05)'"
                        onmouseout="this.style.transform='scale(1)'">
                    <span style="position: absolute; top: 12px; left: 12px; background: #2c241f; color: white; font-size: 0.7rem; font-weight: 700; padding: 0.3rem 0.8rem; border-radius: 50px; letter-spacing: 0.04em; text-transform: uppercase;">Popular</span>
                </div>

                <div style="padding: 1.5rem 1.5rem 1.8rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                        <h3 style="font-size: 1.2rem; font-weight: 700; color: #2c241f; margin: 0;">Chocolate Cake</h3>
                        <span style="font-size: 0.8rem; color: #8a7a6e; background: #f7efe9; padding: 0.2rem 0.7rem; border-radius: 50px; font-weight: 600;">⭐ 4.8</span>
                    </div>
                    <p style="color: #6C5B4A; font-size: 0.85rem; line-height: 1.6; margin: 0.5rem 0 1.2rem; min-height: 60px;">Rich chocolate layered with smooth chocolate ganache and topped with decadent chocolate shavings</p>
                    <button onclick="window.location.href='{{ route('custom-products.customer') }}?category=cakes'" 
                            style="width:100%; padding: 0.8rem; border: none; border-radius: 50px; background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%); color: white; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 0.6rem; box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(212, 163, 115, 0.45)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(212, 163, 115, 0.3)';">
                        <i class="fas fa-eye"></i> View Product
                    </button>
                </div>
            </div>

            <!-- Product 3: Blueberry Cake -->
            <div style="background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 20px rgba(83, 55, 40, 0.08); border: 1px solid #eadfd4; transition: all 0.3s ease;"
                onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 20px 50px rgba(83, 55, 40, 0.15)'; this.style.borderColor='#d4a373';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(83, 55, 40, 0.08)'; this.style.borderColor='#eadfd4';">
                
                <div style="position: relative; overflow: hidden;">
                    <img src="https://images.unsplash.com/photo-1741812553483-7b15e74aeb07?q=80&w=880&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                        alt="Blueberry Cake" 
                        style="width:100%; height:240px; object-fit:cover; transition: transform 0.5s ease;"
                        onmouseover="this.style.transform='scale(1.05)'"
                        onmouseout="this.style.transform='scale(1)'">
                    <span style="position: absolute; top: 12px; left: 12px; background: #2f7d72; color: white; font-size: 0.7rem; font-weight: 700; padding: 0.3rem 0.8rem; border-radius: 50px; letter-spacing: 0.04em; text-transform: uppercase;">New</span>
                </div>

                <div style="padding: 1.5rem 1.5rem 1.8rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                        <h3 style="font-size: 1.2rem; font-weight: 700; color: #2c241f; margin: 0;">Blueberry Cake</h3>
                        <span style="font-size: 0.8rem; color: #8a7a6e; background: #f7efe9; padding: 0.2rem 0.7rem; border-radius: 50px; font-weight: 600;">⭐ 4.7</span>
                    </div>
                    <p style="color: #6C5B4A; font-size: 0.85rem; line-height: 1.6; margin: 0.5rem 0 1.2rem; min-height: 60px;">Light vanilla sponge filled with sweet blueberry compote and smooth cream, topped with fresh berries</p>
                    <button onclick="window.location.href='{{ route('custom-products.customer') }}?category=cakes'" 
                            style="width:100%; padding: 0.8rem; border: none; border-radius: 50px; background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%); color: white; font-weight: 700; font-size: 0.95rem; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 0.6rem; box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(212, 163, 115, 0.45)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(212, 163, 115, 0.3)';">
                        <i class="fas fa-eye"></i> View Product
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Custom Cake Banner -->
    <div class="container">
        <div class="custom-cake-banner">
            <h2>🎂 Design Your Own Cake</h2>
            <p>Choose size, flavor, add a message, and upload your design!</p>
            <a href="{{ route('custom-cake') }}" class="btn-customize">Customize Now →</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-birthday-cake"></i> Sweet Bakery</h5>
                    <p>Fresh baked goods delivered to your doorstep with love.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="{{ route('custom-products.customer') }}" class="text-white text-decoration-none">Products</a></li>
                        <li><a href="{{ route('custom-cake') }}" class="text-white text-decoration-none">Custom Cake</a></li>

                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-map-marker-alt"></i> 39/A Pitipana North, Uduwana, Homagama</p>
                    <p><i class="fas fa-phone"></i> 075 593 7147</p>
                    <p><i class="fas fa-envelope"></i> aspncake@gmail.com</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Opening Hours</h5>
                    <p>Mon-Fri: 9:00 AM - 6:00 PM<br>
                    Sat-Sun: 10:00 AM - 5:00 PM</p>
                </div>
            </div>
            <hr class="mt-2">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Sweet Bakery. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        .hover-shadow {
            transition: all 0.3s ease;
        }
        .hover-shadow:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #d4a373 !important;
        }
        .transition {
            transition: all 0.3s ease;
        }
        .dark .stat-card {
            background: #1f2937;
        }
        .dark .welcome-card {
            background: #1f2937;
            color: #f3f4f6;
        }
        .dark .welcome-card .text-dark {
            color: #fcd34d !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>