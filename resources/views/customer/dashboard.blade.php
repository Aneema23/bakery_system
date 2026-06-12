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
    <!-- Navigation - Laravel Compatible -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-birthday-cake"></i> Disna Bakery
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
                        <a class="nav-link" href="{{ route('products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('custom-cake') }}">Custom Cake</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cart-badge" href="#">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <span class="cart-count">{}</span>
                        </a>
                    </li>
                    
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-box"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-magic"></i> My Custom Cakes</a></li>
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

    <!-- Customer Dashboard Section (only visible when authenticated) -->
    @auth
    <div class="container mt-5 pt-4">
        <div class="row">
            <div class="col-12">
                <!-- Welcome Section -->
                <div class="welcome-card bg-white dark:bg-gray-800 rounded-3 shadow-sm p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h3 class="mb-1 text-dark">Welcome back, {{ Auth::user()->name }}! 🧁</h3>
                            <p class="text-muted mb-0">Your sweet journey continues here</p>
                        </div>
                        <div class="mt-2 mt-sm-0">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-map-marker-alt"></i> {{ Auth::user()->city ?? 'Add city' }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <small class="text-muted"><i class="fas fa-envelope"></i> Email</small>
                            <p class="mb-0 fw-semibold">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted"><i class="fas fa-phone"></i> Contact</small>
                            <p class="mb-0 fw-semibold">{{ Auth::user()->contact_number ?? 'Not provided' }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted"><i class="fas fa-home"></i> Address</small>
                            <p class="mb-0 fw-semibold">{{ Auth::user()->address ?? 'Not provided' }}</p>
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
                            <a href="#" class="text-decoration-none">
                                <div class="border rounded-3 p-3 hover-shadow transition">
                                    <i class="fas fa-cake-candles fa-2x text-warning mb-2"></i>
                                    <h6 class="mb-0 fw-bold">Browse Products</h6>
                                    <small class="text-muted">Explore our fresh bakery menu</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="text-decoration-none">
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
            <a href="#" class="btn btn-light btn-lg">Shop Now</a>
            <a href="#" class="btn btn-outline-light btn-lg">Customize Your Cake</a>
        </div>
    </section>

    <!-- Featured Categories -->
    <div class="container mt-5">
        <h2 class="section-title">Shop by Category</h2>
        <div class="row">
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#" class="text-decoration-none">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1586985289688-ca3cf47d3e6e?w=400" alt="Cakes">
                        <div class="info">
                            <h4>Cakes</h4>
                            <p class="text-muted small">24 items</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#" class="text-decoration-none">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400" alt="Pastries">
                        <div class="info">
                            <h4>Pastries</h4>
                            <p class="text-muted small">18 items</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#" class="text-decoration-none">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1587393855524-087f83d95bc9?w=300" alt="Cupcakes">
                        <div class="info">
                            <h4>Cupcakes</h4>
                            <p class="text-muted small">32 items</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#" class="text-decoration-none">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=300" alt="Bread">
                        <div class="info">
                            <h4>Bread</h4>
                            <p class="text-muted small">15 items</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#" class="text-decoration-none">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=300" alt="Drinks">
                        <div class="info">
                            <h4>Drinks</h4>
                            <p class="text-muted small">12 items</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#" class="text-decoration-none">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1588195538326-c5b1e9f80a1b?w=300" alt="Cookies">
                        <div class="info">
                            <h4>Cookies</h4>
                            <p class="text-muted small">20 items</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="container mt-5">
        <h2 class="section-title">Featured Products</h2>
        <div class="row">
            @php
                $featuredProducts = [
                    ['name' => 'Chocolate Cake', 'desc' => 'Rich chocolate cake with creamy frosting', 'price' => 25.99, 'image' => 'https://images.unsplash.com/photo-1588195538326-c5b1e9f80a1b?w=300'],
                    ['name' => 'Vanilla Cupcake', 'desc' => 'Light vanilla cupcake with buttercream', 'price' => 3.99, 'image' => 'https://images.unsplash.com/photo-1586985289688-ca3cf47d3e6e?w=400'],
                    ['name' => 'Butter Croissant', 'desc' => 'Flaky, buttery French croissant', 'price' => 2.99, 'image' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400'],
                    ['name' => 'Red Velvet Cake', 'desc' => 'Classic red velvet with cream cheese', 'price' => 29.99, 'image' => 'https://images.unsplash.com/photo-1588195538326-c5b1e9f80a1b?w=300'],
                ];
            @endphp
            @foreach($featuredProducts as $product)
            <div class="col-md-3 col-sm-6">
                <div class="product-card">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                    <div class="info">
                        <h5>{{ $product['name'] }}</h5>
                        <p class="text-muted small">{{ $product['desc'] }}</p>
                        <div class="price">${{ number_format($product['price'], 2) }}</div>
                        <form action="#" method="POST">
                            @csrf
                            <input type="hidden" name="product_name" value="{{ $product['name'] }}">
                            <input type="hidden" name="price" value="{{ $product['price'] }}">
                            <button type="submit" class="btn-add mt-2">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Custom Cake Banner -->
    <div class="container">
        <div class="custom-cake-banner">
            <h2>🎂 Design Your Own Cake</h2>
            <p>Choose size, flavor, add a message, and upload your design!</p>
            <a href="#" class="btn-customize">Customize Now →</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-birthday-cake"></i> Sweet Bakery</h5>
                    <p>Fresh baked goods delivered to your doorstep with love.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Products</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Custom Cake</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Bakery Street, Food City</p>
                    <p><i class="fas fa-phone"></i> +1 234 567 8900</p>
                    <p><i class="fas fa-envelope"></i> info@sweetbakery.com</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Opening Hours</h5>
                    <p>Mon-Fri: 8:00 AM - 8:00 PM<br>
                    Sat-Sun: 9:00 AM - 6:00 PM</p>
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