<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products - Disna Bakery</title>

    <!-- logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
    body {
      font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background:#f8f9fa;
      color:var(--text);
      padding-top:90px;
    }

    .container {
      max-width:1280px;
      margin:0 auto;
      padding:0 1.5rem;
    }

    .navbar {
      background:linear-gradient(135deg,#d4a373 0%,#b5835a 100%);
      box-shadow:0 2px 15px rgba(0,0,0,0.1);
    }

    .navbar-brand,
    .nav-link {
      color:white !important;
    }

    .navbar-brand {
      font-size:1.8rem;
      font-weight:700;
    }

    .navbar-brand img {
      margin-right:0.5rem;
    }

    .nav-link {
      font-weight:500;
      transition:transform 0.2s, opacity 0.2s;
    }

    .nav-link:hover {
      transform:translateY(-2px);
      opacity:0.9;
    }

    .navbar-cart-toggle {
      background:rgba(255,255,255,0.16);
      border:1px solid rgba(255,255,255,0.35);
      border-radius:999px;
      padding:0.45rem 0.85rem;
      display:inline-flex;
      align-items:center;
      gap:0.45rem;
    }

    .navbar-cart-count {
      background:#ef4444;
      color:white;
      border-radius:50%;
      min-width:20px;
      padding:2px 6px;
      font-size:11px;
      font-weight:700;
      text-align:center;
    }

    .navbar .dropdown-menu {
      z-index:1100;
      min-width:220px;
      margin-top:0.6rem;
      padding:0.5rem;
      background:#fffaf4;
      border:1px solid #eadfd4;
      border-radius:12px;
      box-shadow:0 14px 30px rgba(51,35,31,0.2);
    }

    .navbar .dropdown-item {
      padding:0.65rem 0.75rem;
      color:#60453a;
      border-radius:8px;
    }

    .navbar .dropdown-item:hover,
    .navbar .dropdown-item:focus {
      background:#fff0e6;
      color:#bd6545;
    }

    .navbar .dropdown-divider { border-color:#eadfd4; }

    .toolbar {
      display:flex;
      flex-wrap:wrap;
      align-items:center;
      justify-content:space-between;
      gap:1rem;
      margin-bottom:2rem;
    }

    .filter-section {
      display:flex;
      gap:0.6rem;
      flex-wrap:wrap;
    }

    .filter-btn {
      padding:0.4rem 1.2rem;
      border-radius:40px;
      border:2px solid #FFE8E0;
      background:white;
      color:var(--muted);
      font-weight:500;
      cursor:pointer;
      transition:0.2s;
      font-size:0.85rem;
    }

    .filter-btn:hover {
      border-color:var(--blush);
      background:var(--cream);
    }

    .filter-btn.active {
      background:var(--blush);
      border-color:var(--blush);
      color:#4A3424;
    }

    .cart-toggle {
      background:white;
      border:2px solid var(--blush);
      padding:0.4rem 1.2rem;
      border-radius:40px;
      font-weight:600;
      color:#4A3424;
      display:flex;
      align-items:center;
      gap:8px;
      cursor:pointer;
      transition:0.2s;
      font-size:0.9rem;
    }

    .cart-toggle:hover {
      background:var(--cream);
    }

    .cart-badge {
      background:var(--blush);
      color:#4A3424;
      border-radius:30px;
      padding:0.1rem 0.6rem;
      font-size:0.75rem;
      font-weight:700;
    }

    .menu-category {
      margin-bottom:3rem;
    }

    .menu-category-title {
      display:flex;
      align-items:center;
      gap:1rem;
      margin-bottom:1.8rem;
    }

    .menu-category-title h2 {
      font-size:1.8rem;
      color:var(--text);
      margin:0;
    }

    .menu-category-title .line {
      flex:1;
      height:2px;
      background:linear-gradient(90deg,var(--blush),transparent);
    }

    .menu-grid {
      display:grid;
      grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
      gap:1.8rem;
    }

    .menu-item {
      background:white;
      border-radius:20px;
      overflow:hidden;
      box-shadow:var(--shadow-soft);
      transition:all 0.3s;
      display:flex;
      flex-direction:column;
    }

    .menu-item:hover {
      transform:translateY(-5px);
      box-shadow:var(--hover-lift);
    }

    .menu-item-image {
      width:100%;
      height:180px;
      object-fit:cover;
      transition:0.3s;
    }

    .menu-item:hover .menu-item-image {
      transform:scale(1.02);
    }

    .menu-item-content {
      padding:1.2rem;
      flex:1;
      display:flex;
      flex-direction:column;
    }

    .menu-item-header {
      display:flex;
      justify-content:space-between;
      align-items:flex-start;
    }

    .menu-item-header h3 {
      font-size:1rem;
      font-weight:700;
      color:var(--text);
      margin:0;
    }

    .menu-item-price {
      font-weight:700;
      color:var(--blush);
      font-size:1.1rem;
      white-space:nowrap;
      margin-left:0.5rem;
    }

    .menu-item-description {
      color:var(--muted);
      font-size:0.85rem;
      line-height:1.5;
      margin:0.4rem 0 0.8rem;
      flex:1;
    }

    .menu-item-footer {
      display:flex;
      justify-content:space-between;
      align-items:center;
      padding-top:0.8rem;
      border-top:1px solid #F5EDE5;
    }

    .menu-item-tag {
      background:#FFF0EA;
      color:#FF8A7A;
      padding:0.2rem 0.8rem;
      border-radius:20px;
      font-size:0.7rem;
      font-weight:600;
    }

    .menu-item-cart {
      background:var(--cream);
      border:none;
      color:var(--blush);
      width:36px;
      height:36px;
      border-radius:50%;
      cursor:pointer;
      transition:0.3s;
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:1.1rem;
      box-shadow:0 3px 8px rgba(255,181,167,0.18);
    }

    .menu-item-cart:hover {
      background:var(--blush);
      color:white;
      transform:scale(1.1);
      box-shadow:0 6px 14px rgba(255,181,167,0.35);
    }

    .menu-item-cart:focus-visible {
      outline:3px solid rgba(255,154,139,0.45);
      outline-offset:3px;
    }

    .cart-overlay {
      position:fixed;
      inset:0;
      background:rgba(0,0,0,0.4);
      backdrop-filter:blur(4px);
      z-index:1500;
      display:none;
      justify-content:flex-end;
      animation:fadeIn 0.3s;
    }

    .cart-overlay.open {
      display:flex;
    }

    .cart-panel {
      background:white;
      width:400px;
      max-width:95vw;
      height:100vh;
      padding:1.5rem;
      overflow-y:auto;
      display:flex;
      flex-direction:column;
      box-shadow:-8px 0 30px rgba(0,0,0,0.1);
      animation:slideRight 0.3s ease;
    }

    @keyframes slideRight {
      from { transform:translateX(60px); opacity:0; }
      to { transform:translateX(0); opacity:1; }
    }

    @keyframes fadeIn {
      from { opacity:0; }
      to { opacity:1; }
    }

    .cart-header {
      display:flex;
      justify-content:space-between;
      align-items:center;
      border-bottom:1px solid #eee;
      padding-bottom:1rem;
    }

    .cart-header h2 {
      font-size:1.4rem;
      margin:0;
    }

    .cart-close {
      background:none;
      border:none;
      font-size:1.6rem;
      cursor:pointer;
      color:#7C6954;
    }

    .cart-items {
      flex:1;
      margin:1rem 0;
    }

    .cart-item {
      display:flex;
      gap:0.8rem;
      padding:0.8rem 0;
      border-bottom:1px solid #f3ece6;
      align-items:center;
    }

    .cart-item img {
      width:60px;
      height:60px;
      object-fit:cover;
      border-radius:12px;
    }

    .cart-item-info {
      flex:1;
    }

    .cart-item-info h4 {
      font-size:0.95rem;
      margin:0 0 0.25rem;
    }

    .cart-item-info .size-price {
      font-size:0.8rem;
      color:var(--muted);
      display:flex;
      gap:0.5rem;
      flex-wrap:wrap;
      align-items:center;
    }

    .cart-item-info select {
      padding:0.2rem 0.4rem;
      border-radius:20px;
      border:1px solid #ddd;
      font-size:0.75rem;
      background:white;
    }

    .cart-item-remove {
      background:none;
      border:none;
      color:#c9b3a2;
      cursor:pointer;
      font-size:1.1rem;
    }

    .cart-total {
      border-top:2px solid var(--blush);
      padding-top:1rem;
      display:flex;
      justify-content:space-between;
      font-weight:700;
      font-size:1.2rem;
    }

    .cart-actions {
      display:flex;
      gap:0.8rem;
      margin-top:1rem;
    }

    .cart-actions button {
      flex:1;
      padding:0.7rem;
      border-radius:40px;
      border:none;
      font-weight:600;
      cursor:pointer;
      transition:0.2s;
    }

    .btn-checkout {
      background:var(--blush);
      color:#4A3424;
    }

    .btn-checkout:hover {
      background:var(--blush-strong);
    }

    .btn-clear {
      background:#f5ede5;
      color:#5E4B3A;
    }

    .btn-clear:hover {
      background:#e8dbd0;
    }

    .empty-cart {
      text-align:center;
      color:#b5a08c;
      padding:2rem 0;
    }

    .size-selector {
      display:flex;
      gap:0.5rem;
      flex-wrap:wrap;
      margin:0.6rem 0 0.8rem;
    }

    .size-selector button {
      background:#f5ede5;
      border:2px solid transparent;
      padding:0.3rem 1rem;
      border-radius:30px;
      font-weight:500;
      font-size:0.8rem;
      cursor:pointer;
      transition:0.2s;
    }

    .size-selector button.active {
      background:var(--blush);
      border-color:var(--blush-strong);
      color:#4A3424;
    }

    .size-selector button:hover {
      background:#ffe8e0;
    }

    .toast-message {
      position:fixed;
      bottom:2rem;
      left:50%;
      transform:translateX(-50%) translateY(100px);
      background:#4C3E30;
      color:white;
      padding:0.8rem 2rem;
      border-radius:16px;
      z-index:3000;
      opacity:0;
      transition:0.5s cubic-bezier(0.2,0.8,0.4,1);
      display:flex;
      align-items:center;
      gap:12px;
      font-size:0.9rem;
    }

    .toast-message.show {
      opacity:1;
      transform:translateX(-50%) translateY(0);
    }

    .toast-close {
      background:none;
      border:none;
      color:rgba(255,255,255,0.6);
      cursor:pointer;
      font-size:1.2rem;
    }

    .modal-overlay {
      display:none;
      position:fixed;
      inset:0;
      background:rgba(0,0,0,0.6);
      backdrop-filter:blur(10px);
      z-index:2000;
      justify-content:center;
      align-items:center;
      padding:1.5rem;
    }

    .modal-overlay.active {
      display:flex;
    }

    .modal-content {
      background:white;
      border-radius:28px;
      max-width:520px;
      width:100%;
      overflow:hidden;
      box-shadow:0 40px 80px rgba(0,0,0,0.3);
      animation:slideUp 0.4s cubic-bezier(0.2,0.8,0.4,1);
      max-height:95vh;
      overflow-y:auto;
      position:relative;
    }

    @keyframes slideUp {
      from { opacity:0; transform:translateY(40px); }
      to { opacity:1; transform:translateY(0); }
    }

    .modal-close {
      position:absolute;
      top:0.8rem;
      right:0.8rem;
      background:rgba(255,255,255,0.95);
      border:none;
      width:40px;
      height:40px;
      border-radius:50%;
      font-size:1.2rem;
      cursor:pointer;
      z-index:10;
      color:#4C3E30;
      display:flex;
      align-items:center;
      justify-content:center;
      box-shadow:0 2px 12px rgba(0,0,0,0.12);
    }

    .modal-close:hover {
      background:var(--blush);
      color:white;
      transform:rotate(90deg);
    }

    .modal-image-wrapper {
      position:relative;
      width:100%;
      height:280px;
      background:#f5ede5;
      overflow:hidden;
    }

    .modal-image {
      width:100%;
      height:100%;
      object-fit:cover;
    }

    .modal-badge {
      position:absolute;
      top:1rem;
      left:1rem;
      background:rgba(255,255,255,0.95);
      padding:0.2rem 1.2rem;
      border-radius:40px;
      font-size:0.75rem;
      font-weight:600;
      color:#FF8A7A;
    }

    .modal-body {
      padding:1.8rem;
    }

    .modal-body-top {
      display:flex;
      justify-content:space-between;
      align-items:flex-start;
    }

    .modal-body h2 {
      font-size:1.4rem;
      margin:0;
    }

    .modal-price {
      color:var(--blush);
      font-size:1.3rem;
      font-weight:700;
      background:var(--cream);
      padding:0.1rem 1rem;
      border-radius:40px;
    }

    .modal-description {
      color:var(--muted);
      line-height:1.6;
      font-size:0.9rem;
      margin:0.6rem 0;
    }

    .modal-details {
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:0.6rem;
      background:#FBF8F6;
      padding:0.8rem;
      border-radius:16px;
      margin:0.8rem 0;
    }

    .modal-detail-item {
      display:flex;
      align-items:center;
      gap:0.4rem;
      font-size:0.8rem;
      color:#5E4B3A;
    }

    .modal-order-btn {
      width:100%;
      padding:0.8rem;
      background:linear-gradient(105deg,var(--blush),var(--blush-strong));
      border:none;
      border-radius:48px;
      color:#4A3424;
      font-weight:700;
      font-size:1rem;
      cursor:pointer;
      transition:0.3s;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:8px;
    }

    .modal-order-btn:hover {
      transform:translateY(-2px);
      box-shadow:0 8px 24px rgba(255,181,167,0.4);
    }

    @media (max-width:768px) {
      body { padding-top:70px; }
      .menu-grid { grid-template-columns:1fr; }
      .cart-panel { width:100%; max-width:100%; }
      .modal-image-wrapper { height:200px; }
    }

    @media (max-width:480px) {
      .toolbar { flex-direction:column; align-items:stretch; }
      .filter-section { justify-content:center; }
    }

    :root {
      --ink:#33231f;
      --cocoa:#60453a;
      --cream:#fffaf4;
      --paper:#fffdf9;
      --apricot:#e58d62;
      --apricot-dark:#bd6545;
      --teal:#2f7d72;
      --line:#eadfd4;
      --shadow:0 18px 45px rgba(83,55,40,0.10);
    }

    * { box-sizing:border-box; }

    body {
      background-color:var(--cream);
      background-image:linear-gradient(rgba(255,250,244,0.9),rgba(255,250,244,0.9)),repeating-linear-gradient(135deg,transparent 0 12px,rgba(229,141,98,0.045) 12px 13px);
      color:var(--ink);
    }

    .navbar {
      background:linear-gradient(135deg, #d4a373 0%, #b5835a 100%);
      border-bottom:3px solid var(--apricot);
      box-shadow:0 8px 24px rgba(51,35,31,0.18);
    }

    .navbar-brand { letter-spacing:0.02em; }
    .navbar-brand img { border-radius:12px; }

    main > .container {
      padding-top:2.5rem !important;
      padding-bottom:4rem !important;
    }

    .menu-hero {
      position:relative;
      max-width:760px;
      margin:0 auto 2.75rem;
      padding:2.25rem 1.5rem 2rem;
      text-align:center;
    }

    .menu-hero::after {
      content:"";
      position:absolute;
      left:50%;
      bottom:0;
      width:72px;
      height:4px;
      border-radius:4px;
      background:var(--teal);
      transform:translateX(-50%);
    }

    .menu-kicker {
      display:inline-flex;
      align-items:center;
      gap:0.5rem;
      color:var(--teal);
      font-size:0.74rem;
      font-weight:800;
      letter-spacing:0.18em;
      text-transform:uppercase;
    }

    .menu-kicker i { color:var(--apricot); }

    .menu-title {
      margin:0.65rem 0 0.5rem;
      color:var(--ink) !important;
      font-family:Georgia,'Times New Roman',serif;
      font-size:clamp(2.5rem,5vw,4.6rem) !important;
      line-height:0.98;
      letter-spacing:-0.04em;
    }

    .menu-title span { color:var(--apricot) !important; }

    .menu-subtitle {
      max-width:460px;
      margin:0 auto;
      color:#866f61 !important;
      font-size:1rem;
      line-height:1.7;
    }

    .toolbar {
      align-items:flex-end;
      margin-bottom:2.75rem;
      padding:1rem;
      background:rgba(255,253,249,0.82);
      border:1px solid var(--line);
      border-radius:16px;
      box-shadow:0 8px 24px rgba(83,55,40,0.05);
    }

    .filter-section { gap:0.5rem; }

    .filter-btn {
      border:1px solid var(--line);
      border-radius:10px;
      padding:0.55rem 0.9rem;
      background:var(--paper);
      color:var(--cocoa);
      font-size:0.8rem;
      font-weight:700;
    }

    .filter-btn:hover { border-color:var(--apricot); background:#fff0e6; }

    .filter-btn.active {
      background:var(--teal);
      border-color:var(--teal);
      color:white;
      box-shadow:0 5px 12px rgba(47,125,114,0.2);
    }

    .cart-toggle {
      border:0;
      border-radius:10px;
      padding:0.65rem 1rem;
      background:var(--apricot);
      color:white;
      box-shadow:0 6px 14px rgba(189,101,69,0.24);
    }

    .cart-toggle:hover { background:var(--apricot-dark); color:white; }
    .cart-badge { background:white; color:var(--apricot-dark); }

    .menu-category { margin-bottom:3.75rem; }

    .menu-category-title { gap:0.9rem; margin-bottom:1.25rem; }

    .menu-category-title h2 {
      color:var(--cocoa);
      font-family:Georgia,'Times New Roman',serif;
      font-size:1.65rem;
      letter-spacing:-0.02em;
    }

    .menu-category-title .line { background:linear-gradient(90deg,var(--apricot),transparent); }

    .menu-grid { grid-template-columns:repeat(auto-fill,minmax(250px,1fr)); gap:1.25rem; }

    .menu-item {
      border:1px solid var(--line);
      border-radius:14px;
      background:var(--paper);
      box-shadow:var(--shadow);
    }

    .menu-item:hover { transform:translateY(-7px); box-shadow:0 24px 50px rgba(83,55,40,0.16); }

    .menu-item-image { height:205px; }

    .menu-item-content { padding:1.15rem 1.2rem 1.2rem; }

    .menu-item-header h3 { color:var(--ink); font-family:Georgia,'Times New Roman',serif; font-size:1.1rem; }
    .menu-item-price { color:var(--apricot-dark); font-size:1rem; }
    .menu-item-description { color:#866f61; line-height:1.6; }
    .menu-item-footer { border-color:var(--line); }
    .menu-item-tag { background:#e5f2ef; color:var(--teal); border-radius:7px; }

    .menu-item-cart { background:#fff0e6; color:var(--apricot-dark); border-radius:10px; }
    .menu-item-cart:hover { background:var(--apricot); color:white; }

    .cart-panel, .modal-content { background:var(--paper); }
    .cart-header { border-color:var(--line); }
    .cart-header h2, .modal-body h2 { color:var(--ink); font-family:Georgia,'Times New Roman',serif; }
    .cart-total { border-color:var(--apricot); }
    .btn-checkout, .modal-order-btn { background:var(--teal); color:white; }
    .btn-checkout:hover, .modal-order-btn:hover { background:#24665d; }

    @media (max-width:768px) {
      main > .container { padding-top:1rem !important; }
      .menu-hero { padding-top:1.25rem; margin-bottom:1.75rem; }
      .toolbar { align-items:stretch; }
      .cart-toggle { align-self:stretch; justify-content:center; }
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
                        <button type="button" class="nav-link navbar-cart-toggle" id="navbarCartToggle">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <span class="navbar-cart-count" id="navbarCartCount">0</span>
                        </button>
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


  <style media="not all">
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family:'Inter',sans-serif; background:#FAFAFA; color:#3b2c1f; padding-top:80px; }
    :root {
      --blush:#FFB5A7; --mint:#C7E9D0; --powder-blue:#B5E2FA; --vanilla:#FFF5E6;
      --dark-accent:#5E4B3A; --shadow-soft:0 12px 28px -8px rgba(0,0,0,0.06);
      --hover-lift:0 20px 30px -12px rgba(0,0,0,0.12);
    }
    h1,h2,h3,.logo-text { font-family:'Playfair Display',serif; letter-spacing:-0.01em; }
    .container { max-width:1280px; margin:0 auto; padding:0 1.5rem; }

    /* HEADER */
    header {
      background:rgba(255,255,255,0.95); backdrop-filter:blur(10px);
      border-bottom:1px solid #F2E2D4; padding:0.8rem 0;
      position:fixed; top:0; left:0; right:0; z-index:1000;
      box-shadow:0 2px 20px rgba(0,0,0,0.06);
    }
    .header-inner { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:0.8rem; }
    .logo { display:flex; align-items:center; gap:10px; }
    .logo img { width:38px; height:38px; border-radius:30px; }
    .logo span { font-weight:700; font-size:1.5rem; color:#6F4E37; }
    .nav-links { display:flex; gap:1.8rem; align-items:center; }
    .nav-links a { color:#5E4B3A; text-decoration:none; font-weight:500; transition:0.2s; }
    .nav-links a:hover { color:#FFB5A7; }
    .nav-links .active { color:#FFB5A7; font-weight:600; }

    .btn-primary {
      background:linear-gradient(105deg,#FFB5A7,#FF9A8B); color:#4A3424;
      padding:0.6rem 1.8rem; border-radius:48px; font-weight:600;
      border:none; display:inline-flex; align-items:center; gap:8px;
      box-shadow:0 4px 10px rgba(255,181,167,0.3); cursor:pointer;
      transition:all 0.25s; text-decoration:none;
    }
    .btn-primary:hover { transform:translateY(-2px); box-shadow:0 12px 20px -8px rgba(255,181,167,0.5); }

    /* FILTER + CART ROW */
    .toolbar { display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:1rem; margin-bottom:2rem; }
    .filter-section { display:flex; gap:0.6rem; flex-wrap:wrap; }
    .filter-btn {
      padding:0.4rem 1.2rem; border-radius:40px; border:2px solid #FFE8E0;
      background:white; color:#7C6954; font-weight:500; cursor:pointer;
      transition:0.2s; font-size:0.85rem;
    }
    .filter-btn:hover { border-color:#FFB5A7; background:#FFF5F0; }
    .filter-btn.active { background:#FFB5A7; border-color:#FFB5A7; color:#4A3424; }

    .cart-toggle {
      background:white; border:2px solid #FFB5A7; padding:0.4rem 1.2rem;
      border-radius:40px; font-weight:600; color:#4A3424;
      display:flex; align-items:center; gap:8px; cursor:pointer;
      transition:0.2s; font-size:0.9rem;
    }
    .cart-toggle:hover { background:#FFF5F0; }
    .cart-badge {
      background:#FFB5A7; color:#4A3424; border-radius:30px;
      padding:0.1rem 0.6rem; font-size:0.75rem; font-weight:700;
    }

    /* MENU GRID */
    .menu-category { margin-bottom:3rem; }
    .menu-category-title { display:flex; align-items:center; gap:1rem; margin-bottom:1.8rem; }
    .menu-category-title h2 { font-size:1.8rem; color:#4C3E30; }
    .menu-category-title .line { flex:1; height:2px; background:linear-gradient(90deg,#FFB5A7,transparent); }
    .menu-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:1.8rem; }

    .menu-item {
      background:white; border-radius:20px; overflow:hidden;
      box-shadow:var(--shadow-soft); transition:all 0.3s;
      display:flex; flex-direction:column;
    }
    .menu-item:hover { transform:translateY(-5px); box-shadow:var(--hover-lift); }
    .menu-item-image { width:100%; height:180px; object-fit:cover; transition:0.3s; }
    .menu-item:hover .menu-item-image { transform:scale(1.02); }
    .menu-item-content { padding:1.2rem; flex:1; display:flex; flex-direction:column; }
    .menu-item-header { display:flex; justify-content:space-between; align-items:flex-start; }
    .menu-item-header h3 { font-size:1rem; font-weight:700; color:#4C3E30; }
    .menu-item-price { font-weight:700; color:#FFB5A7; font-size:1.1rem; white-space:nowrap; margin-left:0.5rem; }
    .menu-item-description { color:#7C6954; font-size:0.85rem; line-height:1.5; margin:0.4rem 0 0.8rem; flex:1; }
    .menu-item-footer { display:flex; justify-content:space-between; align-items:center; padding-top:0.8rem; border-top:1px solid #F5EDE5; }
    .menu-item-tag { background:#FFF0EA; color:#FF8A7A; padding:0.2rem 0.8rem; border-radius:20px; font-size:0.7rem; font-weight:600; }
    .menu-item-cart {
      background:#FFF5F0; border:none; color:#FFB5A7; width:36px; height:36px;
      border-radius:50%; cursor:pointer; transition:0.3s;
      display:flex; align-items:center; justify-content:center; font-size:1.1rem;
    }
    .menu-item-cart:hover { background:#FFB5A7; color:white; transform:scale(1.1); }

    /* SIDECART (slide-out) */
    .cart-overlay {
      position:fixed; inset:0; background:rgba(0,0,0,0.4); backdrop-filter:blur(4px);
      z-index:1500; display:none; justify-content:flex-end;
      animation:fadeIn 0.3s;
    }
    .cart-overlay.open { display:flex; }
    .cart-panel {
      background:white; width:400px; max-width:95vw; height:100vh;
      padding:1.5rem; overflow-y:auto; display:flex; flex-direction:column;
      box-shadow:-8px 0 30px rgba(0,0,0,0.1); animation:slideRight 0.3s ease;
    }
    @keyframes slideRight { from { transform:translateX(60px); opacity:0; } to { transform:translateX(0); opacity:1; } }
    @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

    .cart-header { display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #eee; padding-bottom:1rem; }
    .cart-header h2 { font-size:1.4rem; }
    .cart-close { background:none; border:none; font-size:1.6rem; cursor:pointer; color:#7C6954; }
    .cart-items { flex:1; margin:1rem 0; }
    .cart-item { display:flex; gap:0.8rem; padding:0.8rem 0; border-bottom:1px solid #f3ece6; align-items:center; }
    .cart-item img { width:60px; height:60px; object-fit:cover; border-radius:12px; }
    .cart-item-info { flex:1; }
    .cart-item-info h4 { font-size:0.95rem; }
    .cart-item-info .size-price { font-size:0.8rem; color:#7C6954; display:flex; gap:0.5rem; flex-wrap:wrap; align-items:center; }
    .cart-item-info select { padding:0.2rem 0.4rem; border-radius:20px; border:1px solid #ddd; font-size:0.75rem; background:white; }
    .cart-item-remove { background:none; border:none; color:#c9b3a2; cursor:pointer; font-size:1.1rem; }
    .cart-total { border-top:2px solid #FFB5A7; padding-top:1rem; display:flex; justify-content:space-between; font-weight:700; font-size:1.2rem; }
    .cart-actions { display:flex; gap:0.8rem; margin-top:1rem; }
    .cart-actions button { flex:1; padding:0.7rem; border-radius:40px; border:none; font-weight:600; cursor:pointer; transition:0.2s; }
    .btn-checkout { background:#FFB5A7; color:#4A3424; }
    .btn-checkout:hover { background:#FF9A8B; }
    .btn-clear { background:#f5ede5; color:#5E4B3A; }
    .btn-clear:hover { background:#e8dbd0; }
    .empty-cart { text-align:center; color:#b5a08c; padding:2rem 0; }

    /* size options in modal */
    .size-selector { display:flex; gap:0.5rem; flex-wrap:wrap; margin:0.6rem 0 0.8rem; }
    .size-selector button {
      background:#f5ede5; border:2px solid transparent; padding:0.3rem 1rem;
      border-radius:30px; font-weight:500; font-size:0.8rem; cursor:pointer;
      transition:0.2s;
    }
    .size-selector button.active { background:#FFB5A7; border-color:#FF9A8B; color:#4A3424; }
    .size-selector button:hover { background:#ffe8e0; }

    /* toast */
    .toast-message {
      position:fixed; bottom:2rem; left:50%; transform:translateX(-50%) translateY(100px);
      background:#4C3E30; color:white; padding:0.8rem 2rem;
      border-radius:16px; z-index:3000; opacity:0; transition:0.5s cubic-bezier(0.2,0.8,0.4,1);
      display:flex; align-items:center; gap:12px; font-size:0.9rem;
    }
    .toast-message.show { opacity:1; transform:translateX(-50%) translateY(0); }
    .toast-close { background:none; border:none; color:rgba(255,255,255,0.6); cursor:pointer; font-size:1.2rem; }

    /* modal (quick view) */
    .modal-overlay {
      display:none; position:fixed; inset:0; background:rgba(0,0,0,0.6); backdrop-filter:blur(10px);
      z-index:2000; justify-content:center; align-items:center; padding:1.5rem;
    }
    .modal-overlay.active { display:flex; }
    .modal-content {
      background:white; border-radius:28px; max-width:520px; width:100%;
      overflow:hidden; box-shadow:0 40px 80px rgba(0,0,0,0.3);
      animation:slideUp 0.4s cubic-bezier(0.2,0.8,0.4,1);
      max-height:95vh; overflow-y:auto;
    }
    @keyframes slideUp { from { opacity:0; transform:translateY(40px); } to { opacity:1; transform:translateY(0); } }
    .modal-close { position:absolute; top:0.8rem; right:0.8rem; background:rgba(255,255,255,0.95); border:none; width:40px; height:40px; border-radius:50%; font-size:1.2rem; cursor:pointer; z-index:10; color:#4C3E30; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 12px rgba(0,0,0,0.12); }
    .modal-close:hover { background:#FFB5A7; color:white; transform:rotate(90deg); }
    .modal-image-wrapper { position:relative; width:100%; height:280px; background:#f5ede5; overflow:hidden; }
    .modal-image { width:100%; height:100%; object-fit:cover; }
    .modal-badge { position:absolute; top:1rem; left:1rem; background:rgba(255,255,255,0.95); padding:0.2rem 1.2rem; border-radius:40px; font-size:0.75rem; font-weight:600; color:#FF8A7A; }
    .modal-body { padding:1.8rem; }
    .modal-body-top { display:flex; justify-content:space-between; align-items:flex-start; }
    .modal-body h2 { font-size:1.4rem; }
    .modal-price { color:#FFB5A7; font-size:1.3rem; font-weight:700; background:#FFF5F0; padding:0.1rem 1rem; border-radius:40px; }
    .modal-description { color:#7C6954; line-height:1.6; font-size:0.9rem; margin:0.6rem 0; }
    .modal-details { display:grid; grid-template-columns:1fr 1fr; gap:0.6rem; background:#FBF8F6; padding:0.8rem; border-radius:16px; margin:0.8rem 0; }
    .modal-detail-item { display:flex; align-items:center; gap:0.4rem; font-size:0.8rem; color:#5E4B3A; }
    .modal-order-btn { width:100%; padding:0.8rem; background:linear-gradient(105deg,#FFB5A7,#FF9A8B); border:none; border-radius:48px; color:#4A3424; font-weight:700; font-size:1rem; cursor:pointer; transition:0.3s; display:flex; align-items:center; justify-content:center; gap:8px; }
    .modal-order-btn:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(255,181,167,0.4); }

    @media (max-width:768px) {
      body { padding-top:70px; }
      .menu-grid { grid-template-columns:1fr; }
      .cart-panel { width:100%; max-width:100%; }
      .modal-image-wrapper { height:200px; }
    }
    @media (max-width:480px) {
      .toolbar { flex-direction:column; align-items:stretch; }
      .filter-section { justify-content:center; }
    }
  </style>


    <main>
    <div class="container" style="padding:2rem 1.5rem 3rem;">
        <!-- header -->
        <div class="menu-hero">
        <span class="menu-kicker"><i class="fas fa-crown"></i> Our menu</span>
        <h1 class="menu-title">Sweet <span>Creations</span></h1>
        <p class="menu-subtitle">Handcrafted cakes, cupcakes, cookies, and celebration bakes made for memorable moments.</p>
        </div>

        <!-- toolbar: filter + cart -->
        <div class="toolbar">
        <div class="filter-section" id="filterSection">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="cakes">🎂 Cakes</button>
            <button class="filter-btn" data-filter="cupcakes">🧁 Cupcakes</button>
            <button class="filter-btn" data-filter="birthday-cakes">🌈 Birthday</button>
            <button class="filter-btn" data-filter="cookies">🍪 Cookies</button>
            <button class="filter-btn" data-filter="specials">✨ Specials</button>
        </div>
        <button class="cart-toggle" id="cartToggle"><i class="fas fa-shopping-bag"></i> Cart <span class="cart-badge" id="cartCount">0</span></button>
        </div>

        <!-- MENU CONTAINER -->
        <div id="menuContainer">
        <!-- CAKES -->
        <div class="menu-category" data-category="cakes">
            <div class="menu-category-title"><h2>🎂 Cakes</h2><div class="line"></div></div>
            <div class="menu-grid">
            <div class="menu-item" data-category="cakes" data-name="Chocolate Cake" data-price="3500" data-img="https://images.unsplash.com/photo-1621868402792-a5c9fa6866a3?w=400&auto=format" data-desc="Moist chocolate sponge with rich ganache" data-tag="1 kg" data-rating="4.9">
                <img src="https://images.unsplash.com/photo-1621868402792-a5c9fa6866a3?w=400&auto=format" class="menu-item-image" />
                <div class="menu-item-content">
                <div class="menu-item-header"><h3>Chocolate Cake</h3><span class="menu-item-price">Rs.3500</span></div>
                <p class="menu-item-description">Moist chocolate sponge layered with rich chocolate ganache</p>
                <div class="menu-item-footer"><span class="menu-item-tag">1 kg</span><button type="button" class="menu-item-cart" onclick="quickView(this)" aria-label="Order Chocolate Cake" title="Order this product"><i class="fas fa-cart-plus" aria-hidden="true"></i></button></div>
                </div>
            </div>
            <div class="menu-item" data-category="cakes" data-name="Vanilla Butter Cake" data-price="3000" data-img="https://images.unsplash.com/photo-1609577737938-fb2139fa4c78?w=400&auto=format" data-desc="Soft vanilla sponge with creamy buttercream" data-tag="1 kg" data-rating="4.8">
                <img src="https://images.unsplash.com/photo-1609577737938-fb2139fa4c78?w=400&auto=format" class="menu-item-image" />
                <div class="menu-item-content">
                <div class="menu-item-header"><h3>Vanilla Butter Cake</h3><span class="menu-item-price">Rs.3000</span></div>
                <p class="menu-item-description">Soft vanilla sponge with creamy buttercream</p>
                <div class="menu-item-footer"><span class="menu-item-tag">1 kg</span><button type="button" class="menu-item-cart" onclick="quickView(this)" aria-label="Order Vanilla Butter Cake" title="Order this product"><i class="fas fa-cart-plus" aria-hidden="true"></i></button></div>
                </div>
            </div>
            <div class="menu-item" data-category="cakes" data-name="Red Velvet Cake" data-price="5000" data-img="https://images.pexels.com/photos/30131920/pexels-photo-30131920.jpeg?w=400&auto=format" data-desc="Red velvet with cream cheese frosting" data-tag="1 kg" data-rating="4.9">
                <img src="https://images.pexels.com/photos/30131920/pexels-photo-30131920.jpeg?w=400&auto=format" class="menu-item-image" />
                <div class="menu-item-content">
                <div class="menu-item-header"><h3>Red Velvet Cake</h3><span class="menu-item-price">Rs.5000</span></div>
                <p class="menu-item-description">Red velvet with cream cheese frosting</p>
                <div class="menu-item-footer"><span class="menu-item-tag">1 kg</span><button type="button" class="menu-item-cart" onclick="quickView(this)" aria-label="Order Red Velvet Cake" title="Order this product"><i class="fas fa-cart-plus" aria-hidden="true"></i></button></div>
                </div>
            </div>
            <div class="menu-item" data-category="cakes" data-name="Strawberry Cream Cake" data-price="5500" data-img="https://images.unsplash.com/photo-1589119908995-c6837fa14848?w=400&auto=format" data-desc="Fresh strawberries & whipped cream" data-tag="1 kg" data-rating="4.9">
                <img src="https://images.unsplash.com/photo-1589119908995-c6837fa14848?w=400&auto=format" class="menu-item-image" />
                <div class="menu-item-content">
                <div class="menu-item-header"><h3>Strawberry Cream Cake</h3><span class="menu-item-price">Rs.5500</span></div>
                <p class="menu-item-description">Fresh strawberries & whipped cream</p>
                <div class="menu-item-footer"><span class="menu-item-tag">1 kg</span><button type="button" class="menu-item-cart" onclick="quickView(this)" aria-label="Order Strawberry Cream Cake" title="Order this product"><i class="fas fa-cart-plus" aria-hidden="true"></i></button></div>
                </div>
            </div>
            </div>
        </div>
        <!-- CUPCAKES -->
        <div class="menu-category" data-category="cupcakes">
            <div class="menu-category-title"><h2>🧁 Cupcakes</h2><div class="line"></div></div>
            <div class="menu-grid">
            <div class="menu-item" data-category="cupcakes" data-name="Vanilla Cupcake" data-price="350" data-img="https://plus.unsplash.com/premium_photo-1663840297386-8a3e38271ac6?w=400&auto=format" data-desc="Lavender buttercream & rainbow sprinkles" data-tag="4 pcs" data-rating="4.7">
                <img src="https://plus.unsplash.com/premium_photo-1663840297386-8a3e38271ac6?w=400&auto=format" class="menu-item-image" />
                <div class="menu-item-content">
                <div class="menu-item-header"><h3>Vanilla Cupcake</h3><span class="menu-item-price">Rs.350</span></div>
                <p class="menu-item-description">Lavender buttercream & rainbow sprinkles</p>
                <div class="menu-item-footer"><span class="menu-item-tag">4 pcs</span><button type="button" class="menu-item-cart" onclick="quickView(this)" aria-label="Order Vanilla Cupcake" title="Order this product"><i class="fas fa-cart-plus" aria-hidden="true"></i></button></div>
                </div>
            </div>
            <div class="menu-item" data-category="cupcakes" data-name="Red Velvet Cupcake" data-price="450" data-img="https://images.unsplash.com/photo-1610851467358-e2a4a5804335?w=400&auto=format" data-desc="Cream cheese frosting" data-tag="4 pcs" data-rating="4.8">
                <img src="https://images.unsplash.com/photo-1610851467358-e2a4a5804335?w=400&auto=format" class="menu-item-image" />
                <div class="menu-item-content">
                <div class="menu-item-header"><h3>Red Velvet Cupcake</h3><span class="menu-item-price">Rs.450</span></div>
                <p class="menu-item-description">Cream cheese frosting</p>
                <div class="menu-item-footer"><span class="menu-item-tag">4 pcs</span><button type="button" class="menu-item-cart" onclick="quickView(this)" aria-label="Order Red Velvet Cupcake" title="Order this product"><i class="fas fa-cart-plus" aria-hidden="true"></i></button></div>
                </div>
            </div>
            <div class="menu-item" data-category="cupcakes" data-name="Chocolate Cupcake" data-price="400" data-img="https://images.unsplash.com/photo-1649793950107-610f06f3660c?w=400&auto=format" data-desc="Marshmallow frosting" data-tag="4 pcs" data-rating="4.6">
                <img src="https://images.unsplash.com/photo-1649793950107-610f06f3660c?w=400&auto=format" class="menu-item-image" />
                <div class="menu-item-content">
                <div class="menu-item-header"><h3>Chocolate Cupcake</h3><span class="menu-item-price">Rs.400</span></div>
                <p class="menu-item-description">Marshmallow frosting</p>
                <div class="menu-item-footer"><span class="menu-item-tag">4 pcs</span><button type="button" class="menu-item-cart" onclick="quickView(this)" aria-label="Order Chocolate Cupcake" title="Order this product"><i class="fas fa-cart-plus" aria-hidden="true"></i></button></div>
                </div>
            </div>
            </div>
        </div>
        <!-- BIRTHDAY -->
        <div class="menu-category" data-category="birthday-cakes">
            <div class="menu-category-title"><h2>🌈 Birthday Cakes</h2><div class="line"></div></div>
            <div class="menu-grid">
            <div class="menu-item" data-category="birthday-cakes" data-name="Rainbow Cake" data-price="7500" data-img="https://images.unsplash.com/photo-1622576890453-8e50b6f7d5b0?w=400&auto=format" data-desc="Colorful layers with vanilla buttercream" data-tag="2 kg" data-rating="4.9">
                <img src="https://images.unsplash.com/photo-1622576890453-8e50b6f7d5b0?w=400&auto=format" class="menu-item-image" />
                <div class="menu-item-content">
                <div class="menu-item-header"><h3>Rainbow Cake</h3><span class="menu-item-price">Rs.7500</span></div>
                <p class="menu-item-description">Colorful layers with vanilla buttercream</p>
                <div class="menu-item-footer"><span class="menu-item-tag">2 kg</span><button type="button" class="menu-item-cart" onclick="quickView(this)" aria-label="Order Rainbow Cake" title="Order this product"><i class="fas fa-cart-plus" aria-hidden="true"></i></button></div>
                </div>
            </div>
            <div class="menu-item" data-category="birthday-cakes" data-name="Princess Cake" data-price="9500" data-img="https://images.unsplash.com/photo-1517398823963-c2dc6fc3e837?w=400&auto=format" data-desc="Elegant princess design" data-tag="2 kg" data-rating="4.9">
                <img src="https://images.unsplash.com/photo-1517398823963-c2dc6fc3e837?w=400&auto=format" class="menu-item-image" />
                <div class="menu-item-content">
                <div class="menu-item-header"><h3>Princess Cake</h3><span class="menu-item-price">Rs.9500</span></div>
                <p class="menu-item-description">Elegant princess design</p>
                <div class="menu-item-footer"><span class="menu-item-tag">2 kg</span><button type="button" class="menu-item-cart" onclick="quickView(this)" aria-label="Order Princess Cake" title="Order this product"><i class="fas fa-cart-plus" aria-hidden="true"></i></button></div>
                </div>
            </div>
            </div>
        </div>
        <!-- COOKIES -->
        <div class="menu-category" data-category="cookies">
            <div class="menu-category-title"><h2>🍪 Cookies</h2><div class="line"></div></div>
            <div class="menu-grid">
            <div class="menu-item" data-category="cookies" data-name="Chocolate Chip Cookies" data-price="1200" data-img="https://images.unsplash.com/photo-1499636136210-6f4ee915583e?w=400&auto=format" data-desc="Soft baked with premium chips" data-tag="10 pcs" data-rating="4.7">
                <img src="https://images.unsplash.com/photo-1499636136210-6f4ee915583e?w=400&auto=format" class="menu-item-image" />
                <div class="menu-item-content">
                <div class="menu-item-header"><h3>Chocolate Chip Cookies</h3><span class="menu-item-price">Rs.1200</span></div>
                <p class="menu-item-description">Soft baked with premium chips</p>
                <div class="menu-item-footer"><span class="menu-item-tag">10 pcs</span><button type="button" class="menu-item-cart" onclick="quickView(this)" aria-label="Order Chocolate Chip Cookies" title="Order this product"><i class="fas fa-cart-plus" aria-hidden="true"></i></button></div>
                </div>
            </div>
            </div>
        </div>
        <!-- SPECIALS -->
        <div class="menu-category" data-category="specials">
            <div class="menu-category-title"><h2>✨ Specials</h2><div class="line"></div></div>
            <div class="menu-grid">
            <div class="menu-item" data-category="specials" data-name="Wedding Cake" data-price="10000" data-img="https://images.unsplash.com/photo-1535254973040-607b474cb50d?w=400&auto=format" data-desc="Elegant multi-tier custom cake" data-tag="3 kg" data-rating="5.0">
                <img src="https://images.unsplash.com/photo-1535254973040-607b474cb50d?w=400&auto=format" class="menu-item-image" />
                <div class="menu-item-content">
                <div class="menu-item-header"><h3>Wedding Cake</h3><span class="menu-item-price">From Rs.10,000</span></div>
                <p class="menu-item-description">Elegant multi-tier custom cake</p>
                <div class="menu-item-footer"><span class="menu-item-tag">3 kg</span><button type="button" class="menu-item-cart" onclick="quickView(this)" aria-label="Order Wedding Cake" title="Order this product"><i class="fas fa-cart-plus" aria-hidden="true"></i></button></div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </main>

    <!-- QUICK VIEW MODAL -->
    <div class="modal-overlay" id="modalOverlay" onclick="closeModalOutside(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        <div class="modal-image-wrapper">
        <img src="" alt="product" class="modal-image" id="modalImage" />
        <span class="modal-badge" id="modalBadge">Best Seller</span>
        </div>
        <div class="modal-body">
        <div class="modal-body-top">
            <h2 id="modalTitle">Product</h2>
            <span class="modal-price" id="modalPrice">Rs.0</span>
        </div>
        <p class="modal-description" id="modalDescription">Description</p>
        <div class="size-selector" id="sizeSelector">
            <button data-size="250g" data-multiplier="0.25">250g</button>
            <button data-size="500g" data-multiplier="0.5">500g</button>
            <button data-size="1kg" data-multiplier="1" class="active">1kg</button>
            <button data-size="2kg" data-multiplier="2">2kg</button>
            <button data-size="3kg" data-multiplier="3">3kg</button>
        </div>
        <div class="modal-details">
            <div class="modal-detail-item"><i class="fas fa-tag"></i> <span id="modalTagDisplay">Tag</span></div>
            <div class="modal-detail-item"><i class="fas fa-star"></i> <span id="modalRating">4.9</span></div>
            <div class="modal-detail-item"><i class="fas fa-clock"></i> Ready in 24h</div>
            <div class="modal-detail-item"><i class="fas fa-box"></i> <span id="modalSizeDisplay">1kg</span></div>
        </div>
        <button class="modal-order-btn" onclick="addFromModal()"><i class="fas fa-shopping-bag"></i> Add to Cart</button>
        </div>
    </div>
    </div>

    <!-- CART SIDEPANEL -->
    <div class="cart-overlay" id="cartOverlay">
    <div class="cart-panel">
        <div class="cart-header">
        <h2><i class="fas fa-shopping-bag"></i> Your Cart</h2>
        <button class="cart-close" onclick="toggleCart()"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-items" id="cartItems">
        <div class="empty-cart">Your cart is empty</div>
        </div>
        <div class="cart-total"><span>Total</span><span id="cartTotal">Rs.0</span></div>
        <div class="cart-actions">
        <button class="btn-clear" onclick="clearCart()">Clear</button>
        <button class="btn-checkout" onclick="checkout()">Checkout</button>
        </div>
    </div>
    </div>

    <!-- TOAST -->
    <div class="toast-message" id="toastMessage">
    <i class="fas fa-exclamation-circle"></i>
    <span id="toastText">Added to cart</span>
    <button class="toast-close" onclick="hideToast()"><i class="fas fa-times"></i></button>
    </div>

    <script>
    // ----- DATA -----
    let cart = [];
    let currentProduct = null;

    // ----- FILTER -----
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        document.querySelectorAll('.menu-item').forEach(item => {
            if (filter === 'all' || item.dataset.category === filter) {
            item.style.display = 'flex';
            } else {
            item.style.display = 'none';
            }
        });
        document.querySelectorAll('.menu-category').forEach(cat => {
            const visible = Array.from(cat.querySelectorAll('.menu-item')).some(it => it.style.display !== 'none');
            cat.style.display = visible ? 'block' : 'none';
        });
        });
    });

    // ----- QUICK VIEW (modal) -----
    function quickView(el) {
        const item = el.closest('.menu-item');
        const name = item.dataset.name;
        const price = parseInt(item.dataset.price);
        const img = item.dataset.img;
        const desc = item.dataset.desc;
        const tag = item.dataset.tag;
        const rating = item.dataset.rating || '4.8';
        currentProduct = { name, price, img, desc, tag, rating, basePrice: price };
        document.getElementById('modalImage').src = img;
        document.getElementById('modalTitle').textContent = name;
        document.getElementById('modalPrice').textContent = 'Rs.' + price;
        document.getElementById('modalDescription').textContent = desc;
        document.getElementById('modalBadge').textContent = tag;
        document.getElementById('modalTagDisplay').textContent = tag;
        document.getElementById('modalRating').textContent = rating;
        document.getElementById('modalSizeDisplay').textContent = '1kg';
        // reset size buttons
        document.querySelectorAll('#sizeSelector button').forEach(b => b.classList.remove('active'));
        document.querySelector('#sizeSelector button[data-size="1kg"]').classList.add('active');
        document.getElementById('modalOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('modalOverlay').classList.remove('active');
        document.body.style.overflow = '';
    }
    function closeModalOutside(e) { if (e.target === document.getElementById('modalOverlay')) closeModal(); }

    // size selector in modal
    document.querySelectorAll('#sizeSelector button').forEach(btn => {
        btn.addEventListener('click', function() {
        document.querySelectorAll('#sizeSelector button').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const mult = parseFloat(this.dataset.multiplier);
        if (currentProduct) {
            const newPrice = Math.round(currentProduct.basePrice * mult);
            document.getElementById('modalPrice').textContent = 'Rs.' + newPrice;
            document.getElementById('modalSizeDisplay').textContent = this.dataset.size;
            currentProduct.selectedSize = this.dataset.size;
            currentProduct.selectedPrice = newPrice;
            currentProduct.multiplier = mult;
        }
        });
    });

    // add from modal
    function addFromModal() {
        if (!currentProduct) return;
        const size = currentProduct.selectedSize || '1kg';
        const price = currentProduct.selectedPrice || currentProduct.basePrice;
        const name = currentProduct.name;
        const img = currentProduct.img;
        const existing = cart.find(item => item.name === name && item.size === size);
        if (existing) {
        existing.qty += 1;
        } else {
        cart.push({ name, price, size, img, qty: 1, multiplier: currentProduct.multiplier || 1 });
        }
        updateCartUI();
        showToast('Added ' + name + ' (' + size + ')');
        closeModal();
    }

    // ----- CART UI -----
    function toggleCart() {
        document.getElementById('cartOverlay').classList.toggle('open');
    }
    document.getElementById('cartToggle').addEventListener('click', toggleCart);
    document.getElementById('navbarCartToggle').addEventListener('click', toggleCart);

    function updateCartUI() {
        const container = document.getElementById('cartItems');
        const totalSpan = document.getElementById('cartTotal');
        const countSpan = document.getElementById('cartCount');
        const navbarCountSpan = document.getElementById('navbarCartCount');
        if (cart.length === 0) {
        container.innerHTML = '<div class="empty-cart">Your cart is empty</div>';
        totalSpan.textContent = 'Rs.0';
        countSpan.textContent = '0';
        navbarCountSpan.textContent = '0';
        return;
        }
        let html = '';
        let total = 0;
        let count = 0;
        cart.forEach((item, idx) => {
        total += item.price * item.qty;
        count += item.qty;
        html += `
            <div class="cart-item">
            <img src="${item.img}" alt="${item.name}" />
            <div class="cart-item-info">
                <h4>${item.name}</h4>
                <div class="size-price">
                <span>${item.size}</span>
                <span>Rs.${item.price} × ${item.qty}</span>
                <select onchange="changeSize(${idx}, this.value)">
                    <option value="250g" ${item.size==='250g'?'selected':''}>250g</option>
                    <option value="500g" ${item.size==='500g'?'selected':''}>500g</option>
                    <option value="1kg" ${item.size==='1kg'?'selected':''}>1kg</option>
                    <option value="2kg" ${item.size==='2kg'?'selected':''}>2kg</option>
                    <option value="3kg" ${item.size==='3kg'?'selected':''}>3kg</option>
                </select>
                </div>
            </div>
            <button class="cart-item-remove" onclick="removeItem(${idx})"><i class="fas fa-trash-alt"></i></button>
            </div>
        `;
        });
        container.innerHTML = html;
        totalSpan.textContent = 'Rs.' + total;
        countSpan.textContent = count;
        navbarCountSpan.textContent = count;
    }

    function removeItem(idx) {
        cart.splice(idx, 1);
        updateCartUI();
        if (cart.length === 0) toggleCart();
    }

    function changeSize(idx, newSize) {
        const item = cart[idx];
        const mult = { '250g':0.25, '500g':0.5, '1kg':1, '2kg':2, '3kg':3 }[newSize] || 1;
        // use stored base price (or derive from current price / multiplier)
        const base = item.price / (item.multiplier || 1);
        item.price = Math.round(base * mult);
        item.size = newSize;
        item.multiplier = mult;
        updateCartUI();
    }

    function clearCart() {
        cart = [];
        updateCartUI();
        toggleCart();
        showToast('Cart cleared');
    }

    function checkout() {
        if (cart.length === 0) { showToast('Cart is empty'); return; }
        showToast('Proceeding to checkout...');
        // redirect or simulate
    }

    // ----- TOAST -----
    let toastTimer;
    function showToast(msg) {
        const t = document.getElementById('toastMessage');
        document.getElementById('toastText').textContent = msg;
        t.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => { t.classList.remove('show'); }, 3000);
    }
    function hideToast() { document.getElementById('toastMessage').classList.remove('show'); }

    // ----- INIT -----
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.filter-btn.active')?.click();
        document.querySelector('#sizeSelector button[data-size="1kg"]')?.classList.add('active');
    });

    document.getElementById('cartOverlay').addEventListener('click', function(e) {
        if (e.target === this) toggleCart();
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>