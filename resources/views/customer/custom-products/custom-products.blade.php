<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products - Disna Bakery</title>

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

        /* Navbar Styles - Bakery Theme (matching customer dashboard) */
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

        /* Page Header - matching hero section style */
        .page-header {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1558961363-fa8fdf82db35?ixlib=rb-4.0.3');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0 60px;
            margin-top: 76px;
            text-align: center;
        }

        .page-header h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 15px;
            animation: fadeInUp 1s;
        }

        .page-header p {
            font-size: 1.2rem;
            animation: fadeInUp 1s 0.2s;
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

        /* Filter Sidebar - matching bakery theme */
        .filter-sidebar {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            position: sticky;
            top: 100px;
            border: 1px solid rgba(212, 163, 115, 0.2);
        }

        .dark .filter-sidebar {
            background: #1f2937;
            color: #f3f4f6;
            border-color: #d4a37340;
        }

        .filter-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 2px solid #d4a373;
            color: #5c3d2e;
        }

        .dark .filter-title {
            color: #fcd34d;
        }

        .category-filter {
            list-style: none;
            padding: 0;
        }

        .category-filter li {
            margin-bottom: 12px;
        }

        .category-filter a {
            color: #666;
            text-decoration: none;
            transition: all 0.3s;
            display: block;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 500;
        }

        .dark .category-filter a {
            color: #d1d5db;
        }

        .category-filter a:hover, .category-filter a.active {
            background: linear-gradient(135deg, #d4a37320 0%, #b5835a20 100%);
            color: #b5835a;
            border-left: 3px solid #d4a373;
        }

        .dark .category-filter a:hover, .dark .category-filter a.active {
            background: #d4a37320;
            color: #fcd34d;
        }

        /* Product Cards - matching customer dashboard product cards */
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
            margin-bottom: 30px;
            height: 100%;
            cursor: pointer;
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

        .product-card .old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9rem;
            margin-left: 8px;
        }

        .rating {
            color: #ffc107;
            margin-bottom: 10px;
            font-size: 0.9rem;
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

        /* Pagination - bakery themed */
        .pagination .page-link {
            color: #b5835a;
            border-radius: 8px;
            margin: 0 3px;
            border: none;
            background: white;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%);
            color: white;
            border-color: #d4a373;
        }

        .pagination .page-link:hover {
            background: #d4a37320;
            color: #b5835a;
        }

        .dark .pagination .page-link {
            background: #1f2937;
            color: #fcd34d;
        }

        .dark .pagination .page-link:hover {
            background: #d4a37320;
            color: #fcd34d;
        }

        /* Footer - matching customer dashboard */
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

        /* Responsive */
        @media (max-width: 768px) {
            .filter-sidebar {
                margin-bottom: 25px;
                position: static;
            }
            .page-header {
                margin-top: 60px;
                padding: 60px 0 40px;
            }
            .page-header h1 {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation - Matching customer dashboard -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Disna Cakes Logo" style="width: 40px; height: 40px;"> Disna Bakery
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
                        <a class="nav-link active" href="{{ route('custom-products.customer') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('custom-cake') }}">Custom Cake</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cart-badge" href="#">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <span class="cart-count">3</span>
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

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Our Fresh Products</h1>
            <p>Handcrafted with love, baked fresh daily</p>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-md-3">
                <div class="filter-sidebar">
                    <div class="filter-title">Search Products</div>
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Search..." style="border-radius: 25px 0 0 25px;">
                        <button class="btn" type="button" style="background: #d4a373; color: white; border-radius: 0 25px 25px 0;"><i class="fas fa-search"></i></button>
                    </div>

                    <div class="filter-title">Categories</div>
                    <ul class="category-filter">
                        <li><a href="#" class="active">All Products (42)</a></li>
                        <li><a href="#">🎂 Cakes (12)</a></li>
                        <li><a href="#">🥐 Pastries (8)</a></li>
                        <li><a href="#">🧁 Cupcakes (10)</a></li>
                        <li><a href="#">🍞 Bread (6)</a></li>
                        <li><a href="#">☕ Drinks (6)</a></li>
                        <li><a href="#">🍪 Cookies (8)</a></li>
                    </ul>

                    <div class="filter-title mt-4">Price Range</div>
                    <div class="price-range">
                        <input type="range" class="form-range" min="0" max="100" step="1" style="accent-color: #d4a373;">
                        <div class="d-flex justify-content-between mt-2">
                            <span>$0</span>
                            <span>$25</span>
                            <span>$50</span>
                            <span>$75</span>
                            <span>$100+</span>
                        </div>
                    </div>

                    <div class="filter-title mt-4">Sort By</div>
                    <select class="form-select" style="border-radius: 25px; border-color: #d4a37340;">
                        <option>Newest First</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Best Selling</option>
                    </select>

                    <button class="btn w-100 mt-4" style="background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%); color: white; border-radius: 25px; padding: 10px;">Apply Filters</button>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-md-9">
                <div class="row">
                    @php
                        $products = [
                            ['name' => 'Chocolate Cake', 'desc' => 'Rich chocolate cake with creamy ganache', 'price' => 25.99, 'old_price' => 35.99, 'rating' => 4.5, 'image' => 'https://images.unsplash.com/photo-1588195538326-c5b1e9f80a1b?w=400'],
                            ['name' => 'Vanilla Cupcake', 'desc' => 'Light vanilla cupcake with buttercream', 'price' => 3.99, 'old_price' => null, 'rating' => 5, 'image' => 'https://images.unsplash.com/photo-1586985289688-ca3cf47d3e6e?w=400'],
                            ['name' => 'Butter Croissant', 'desc' => 'Flaky, buttery French croissant', 'price' => 2.99, 'old_price' => 4.99, 'rating' => 4, 'image' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400'],
                            ['name' => 'Red Velvet Cake', 'desc' => 'Classic red velvet with cream cheese frosting', 'price' => 29.99, 'old_price' => null, 'rating' => 5, 'image' => 'https://images.unsplash.com/photo-1586985289688-ca3cf47d3e6e?w=400'],
                            ['name' => 'Iced Coffee', 'desc' => 'Cold brew with vanilla and cream', 'price' => 4.99, 'old_price' => 6.99, 'rating' => 4.5, 'image' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=400'],
                            ['name' => 'Chocolate Chip Cookie', 'desc' => 'Soft, chewy cookie with dark chocolate', 'price' => 1.99, 'old_price' => null, 'rating' => 4, 'image' => 'https://images.unsplash.com/photo-1588195538326-c5b1e9f80a1b?w=400'],
                            ['name' => 'Fruit Tart', 'desc' => 'Fresh seasonal fruits on creamy custard', 'price' => 5.99, 'old_price' => 7.99, 'rating' => 4.5, 'image' => 'https://images.unsplash.com/photo-1588195538326-c5b1e9f80a1b?w=400'],
                            ['name' => 'Sourdough Bread', 'desc' => 'Artisan sourdough with crispy crust', 'price' => 6.99, 'old_price' => null, 'rating' => 4.5, 'image' => 'https://images.unsplash.com/photo-1586985289688-ca3cf47d3e6e?w=400'],
                            ['name' => 'Carrot Cake', 'desc' => 'Moist carrot cake with walnuts & cream cheese', 'price' => 27.99, 'old_price' => 32.99, 'rating' => 5, 'image' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=400'],
                        ];
                    @endphp
                    @foreach($products as $product)
                    <div class="col-md-4 col-sm-6">
                        <div class="product-card">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                            <div class="info">
                                <div class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($product['rating']))
                                            <i class="fas fa-star"></i>
                                        @elseif($i - 0.5 <= $product['rating'])
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <h5>{{ $product['name'] }}</h5>
                                <p class="text-muted small">{{ $product['desc'] }}</p>
                                <div class="price">
                                    ${{ number_format($product['price'], 2) }}
                                    @if($product['old_price'])
                                        <span class="old-price">${{ number_format($product['old_price'], 2) }}</span>
                                    @endif
                                </div>
                                <form action="#" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_name" value="{{ $product['name'] }}">
                                    <input type="hidden" name="price" value="{{ $product['price'] }}">
                                    <button type="submit" class="btn-add mt-3">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-chevron-left"></i> Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next <i class="fas fa-chevron-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Footer - Matching customer dashboard -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-birthday-cake"></i> Disna Bakery</h5>
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
                    <p><i class="fas fa-envelope"></i> info@disnabakery.com</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Opening Hours</h5>
                    <p>Mon-Fri: 8:00 AM - 8:00 PM<br>
                    Sat-Sun: 9:00 AM - 6:00 PM</p>
                </div>
            </div>
            <hr class="mt-2">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Disna Bakery. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>