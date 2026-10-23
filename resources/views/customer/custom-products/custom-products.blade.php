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

    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      crossorigin=""
    />

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
        width:520px;
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

      .cart-quantity {
        display:inline-flex;
        align-items:center;
        gap:0.35rem;
        margin-left:0.25rem;
        padding:0.15rem;
        border:1px solid #eadfd4;
        border-radius:999px;
        background:#fffaf4;
      }

      .cart-quantity button {
        width:24px;
        height:24px;
        border:0;
        border-radius:50%;
        background:#f5ede5;
        color:#60453a;
        cursor:pointer;
        line-height:1;
      }

      .cart-quantity button:hover {
        background:#ffb5a7;
      }

      .cart-quantity-value {
        min-width:1.25rem;
        text-align:center;
        font-weight:700;
        color:#4a3424;
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

      .product-search-row {
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:1.5rem;
        margin:0 auto 2.5rem;
        padding:1.25rem 1.5rem;
        background:linear-gradient(115deg,#fffdf9 0%,#fff6ed 100%);
        border:1px solid var(--line);
        border-radius:16px;
        box-shadow:0 8px 24px rgba(83,55,40,0.06);
      }

      .product-search-copy { min-width:0; }

      .product-search-kicker {
        display:block;
        margin-bottom:0.3rem;
        color:var(--teal);
        font-size:0.68rem;
        font-weight:800;
        letter-spacing:0.14em;
        text-transform:uppercase;
      }

      .product-search-title {
        margin:0;
        color:var(--ink);
        font-family:Georgia,'Times New Roman',serif;
        font-size:1.3rem;
        font-weight:700;
      }

      .product-search-description {
        margin:0.2rem 0 0;
        color:#866f61;
        font-size:0.86rem;
      }

      .product-search {
        display:flex;
        flex:0 1 34rem;
        min-width:0;
        min-height:54px;
        align-items:center;
        gap:0.75rem;
        padding:0.4rem 1rem 0.4rem 0.45rem;
        background:white;
        border:1px solid #e6d5c8;
        border-radius:12px;
        box-shadow:0 4px 12px rgba(83,55,40,0.05);
        transition:border-color 0.18s ease, box-shadow 0.18s ease;
      }

      .product-search:hover { border-color:#d4a18b; }

      .product-search:focus-within {
        border-color:var(--teal);
        box-shadow:0 0 0 3px rgba(47,125,114,0.13),0 6px 16px rgba(83,55,40,0.08);
      }

      .product-search > i {
        display:grid;
        flex:0 0 40px;
        width:40px;
        height:40px;
        place-items:center;
        border-radius:9px;
        background:#e5f2ef;
        color:var(--teal);
        font-size:0.9rem;
      }

      .product-search input {
        width:100%;
        min-width:0;
        padding:0;
        border:0;
        outline:0;
        background:transparent;
        color:var(--ink);
        font:inherit;
        font-size:0.95rem;
      }

      .product-search input::placeholder { color:#9a887c; }
      .product-search input::-webkit-search-cancel-button { cursor:pointer; }

      .product-search-empty {
        padding:1.5rem;
        text-align:center;
        color:#7c6954;
        background:white;
        border:1px solid var(--line);
        border-radius:14px;
      }

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
        .product-search-row { align-items:stretch; flex-direction:column; gap:1rem; }
        .product-search { flex:1 1 auto; width:100%; }
      }

      @media (max-width:480px) {
        .product-search-row { margin-bottom:2rem; padding:1rem; }
        .product-search-title { font-size:1.15rem; }
      }
  </style>
</head>

<body>
    <!-- Navigation  -->
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
                                <li><a class="dropdown-item" href="{{ route('customer.orders') }}"><i class="fas fa-box"></i> My Orders</a></li>
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

      .product-search {
        display:flex; flex:0 1 34rem; align-items:center; gap:0.8rem;
        width:100%; max-width:34rem; min-height:58px; padding:0.45rem 1.2rem 0.45rem 0.5rem;
        background:#fffdfb; border:1.5px solid #e8c5b8; border-radius:999px;
        color:#fff; box-shadow:0 5px 16px rgba(83,55,40,0.08);
        transition:border-color 0.18s ease, box-shadow 0.18s ease, transform 0.18s ease;
      }
      .product-search:hover { border-color:#c47a66; box-shadow:0 7px 20px rgba(83,55,40,0.11); }
      .product-search:focus-within {
        background:white; border-color:#b86b58; transform:translateY(-1px);
        box-shadow:0 0 0 4px rgba(184,107,88,0.14), 0 8px 22px rgba(83,55,40,0.12);
      }
      .product-search > i {
        display:grid; flex:0 0 42px; width:42px; height:42px; place-items:center;
        border-radius:50%; background:linear-gradient(140deg,#d98d78,#b96552);
        color:white; font-size:0.95rem;
      }
      .product-search input {
        width:100%; min-width:0; padding:0; border:0; outline:0; background:transparent;
        color:#4A3424; font:inherit; font-size:1rem;
      }
      .product-search input::placeholder { color:#958276; }
      .product-search-row {
        display:flex; justify-content:center; margin:0 0 1.75rem;
      }
      .product-search-empty {
        padding:1.5rem; text-align:center; color:#7C6954; background:white;
        border:1px solid #eadfd4; border-radius:14px;
      }

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
        background:white; width:520px; max-width:95vw; height:100vh;
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
      .cart-quantity { display:inline-flex; align-items:center; gap:0.35rem; margin-left:0.25rem; padding:0.15rem; border:1px solid #eadfd4; border-radius:999px; background:#fffaf4; }
      .cart-quantity button { width:24px; height:24px; border:0; border-radius:50%; background:#f5ede5; color:#60453a; cursor:pointer; line-height:1; }
      .cart-quantity button:hover { background:#ffb5a7; }
      .cart-quantity-value { min-width:1.25rem; text-align:center; font-weight:700; color:#4a3424; }
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

      /* checkout popup */
      .checkout-modal-overlay {
        position:fixed; inset:0; background:rgba(26,16,13,0.52); backdrop-filter:blur(4px);
        z-index:2200; display:none; align-items:center; justify-content:center; padding:1.25rem;
        opacity:0; visibility:hidden; pointer-events:none; transition:opacity 0.25s ease, visibility 0.25s ease;
      }
      .checkout-modal-overlay.open {
        display:flex; opacity:1; visibility:visible; pointer-events:auto;
      }
      .checkout-modal {
        width:min(640px, 100%); max-height:92vh; overflow-y:auto;
        background:#fffdfb; border-radius:24px; box-shadow:0 32px 80px rgba(48,30,19,0.22);
        padding:1.5rem; border:1px solid #f0e5dd; animation:slideUp 0.35s ease;
        transform:translateY(12px); transition:transform 0.25s ease;
      }
      .checkout-modal-overlay.open .checkout-modal { transform:translateY(0); }
      .checkout-form-grid {
        display:grid; grid-template-columns:repeat(2, minmax(0, 1fr)); gap:1rem;
        margin-top:1rem;
      }
      .checkout-form-field { display:flex; flex-direction:column; gap:0.4rem; }
      .checkout-form-field.full { grid-column:1 / -1; }
      .checkout-form-field label {
        font-size:0.8rem; font-weight:700; color:#6d5242; letter-spacing:0.02em;
      }
      .checkout-form-field input,
      .checkout-form-field textarea,
      .checkout-form-field select {
        width:100%; border:1px solid #e6d7cc; border-radius:12px; padding:0.78rem 0.9rem;
        background:#fff; color:#32241f; font-size:0.95rem; outline:none;
      }
      .checkout-form-field input:focus,
      .checkout-form-field textarea:focus,
      .checkout-form-field select:focus {
        border-color:#e58d62; box-shadow:0 0 0 3px rgba(229,141,98,0.12);
      }
      .checkout-form-field textarea { min-height:92px; resize:vertical; }
      .checkout-submit {
        width:100%; margin-top:1.15rem; border:none; border-radius:999px; padding:0.9rem 1.2rem;
        background:linear-gradient(135deg, #2f7d72, #1d5d55); color:white; font-weight:700; cursor:pointer;
        transition:0.2s ease;
      }
      .checkout-submit:hover { transform:translateY(-1px); box-shadow:0 14px 28px rgba(47,125,114,0.22); }

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
        .product-search-row { justify-content:stretch; }
        .product-search { max-width:none; }
      }
    </style>


    <main>
    <div class="container" style="padding:2rem 1.5rem 3rem;">
      @if (session('success'))
        <div class="alert alert-success" role="alert" data-auto-dismiss data-order-success style="margin-bottom:1.5rem; border-radius:14px;">
          <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger" role="alert" data-auto-dismiss style="margin-bottom:1.5rem; border-radius:14px;">
          <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
        </div>
      @endif

        <!-- header -->
        <div class="menu-hero">
        <span class="menu-kicker"><i class="fas fa-crown"></i> Our menu</span>
        <h1 class="menu-title">Sweet <span>Creations</span></h1>
        <p class="menu-subtitle">Handcrafted cakes, cupcakes, cookies, and celebration bakes made for memorable moments.</p>
        </div>

        <!-- toolbar: filters + cart -->
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

        <section class="product-search-row" aria-labelledby="productSearchTitle">
          <div class="product-search-copy">
            <span class="product-search-kicker">A little something sweet</span>
            <h2 class="product-search-title" id="productSearchTitle">Find your favorite</h2>
            <p class="product-search-description" id="productSearchDescription">Search our freshly baked treats by name or category.</p>
          </div>
          <label class="product-search" for="productSearchInput">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input id="productSearchInput" type="search" placeholder="Try “chocolate cake” or “cookies”" aria-label="Search cakes, cupcakes, and cookies" aria-describedby="productSearchDescription">
          </label>
        </section>

        <!-- MENU CONTAINER -->
        <div id="menuContainer">
           <div class="product-search-empty" id="productSearchEmpty" hidden>No products match your search.</div>
         @foreach($categories as $category)
          <div class="menu-category" data-category="{{ \Illuminate\Support\Str::slug($category->name) }}">
            <div class="menu-category-title"><h2>{{ $category->name }}</h2><div class="line"></div></div>
            <div class="menu-grid">
              @foreach($category->products as $product)
                <div class="menu-item"
                    data-category="{{ \Illuminate\Support\Str::slug($category->name) }}"
                  data-product-id="{{ $product->id }}"
                  data-stock="{{ max(0, (int) $product->stock) }}"
                    data-name="{{ $product->name }}"
                    data-price="{{ $product->price }}"
                    data-img="{{ $product->image }}"
                    data-desc="{{ $product->description }}"
                    data-tag="{{ $product->size ?? '1 pc' }}"
                    data-rating="{{ $product->rating ?? '4.8' }}"

                  >
                  <!-- Product Image with Out of Stock Overlay -->
                  <div style="position: relative; overflow: hidden;">
                      <img
                          src="{{ $product->image ? $product->image : asset('images/default-product.jpg') }}"
                          class="menu-item-image"
                          alt="{{ $product->name }}"
                          style="
                              width: 100%;
                              display: block;
                                @if($product->status === 'Inactive' || (int) $product->stock <= 0)
                                  filter: grayscale(85%) brightness(0.85);
                              @endif
                          "
                      />

                      <!-- OUT OF STOCK Overlay -->
                      @if($product->status === 'Inactive' || (int) $product->stock <= 0)
                          <div style="
                              position: absolute;
                              top: 0;
                              left: 0;
                              width: 100%;
                              height: 100%;
                              background: linear-gradient(180deg, rgba(44, 36, 31, 0.15) 0%, rgba(44, 36, 31, 0.75) 100%);
                              display: flex;
                              align-items: center;
                              justify-content: center;
                              z-index: 5;
                              pointer-events: none;
                          ">
                              <span style="
                                  background: linear-gradient(135deg, #c47a7a 0%, #a85d5d 100%);
                                  color: white;
                                  padding: 10px 26px;
                                  border-radius: 50px;
                                  font-size: 12px;
                                  font-weight: 700;
                                  letter-spacing: 2px;
                                  text-transform: uppercase;
                                  box-shadow: 0 8px 25px rgba(168, 93, 93, 0.5);
                                  border: 2px solid rgba(255, 255, 255, 0.3);
                                  display: inline-flex;
                                  align-items: center;
                                  gap: 8px;
                                  transform: rotate(-3deg);
                                  white-space: nowrap;
                              ">
                                  <i class="fas fa-ban" style="font-size: 13px;"></i>
                                  Out of Stock
                              </span>
                          </div>
                      @endif
                  </div>

                    <div class="menu-item-content">

                        <div class="menu-item-header">
                            <h3>{{ $product->name }}</h3>

                            <span class="menu-item-price">
                                Rs.{{ $product->price }}
                            </span>
                        </div>

                        <p class="menu-item-description">
                            {{ $product->description }}
                        </p>

                        <div class="menu-item-footer">

                            <span class="menu-item-tag">
                                {{ $product->size ?? '1 pc' }}
                            </span>

                            @if($product->status === 'Inactive' || (int) $product->stock <= 0)

                                <!-- Disabled cart button -->
                                <button
                                    type="button"
                                    class="menu-item-cart"
                                    disabled
                                    style="
                                        opacity: 0.4;
                                        cursor: not-allowed;
                                        background: #999;
                                    "
                                    aria-label="Out of stock"
                                    title="This product is currently out of stock"
                                >
                                    <i class="fas fa-cart-plus" aria-hidden="true"></i>
                                </button>

                            @else

                                <!-- Normal cart button -->
                                <button
                                    type="button"
                                    class="menu-item-cart"
                                    onclick="quickView(this)"
                                    data-product-id="{{ $product->id }}"
                                    aria-label="Order {{ $product->name }}"
                                    title="Order this product"
                                >
                                    <i class="fas fa-cart-plus" aria-hidden="true"></i>
                                </button>

                            @endif

                        </div>
                    </div>
                </div>

            @endforeach
            </div>
          </div>
         @endforeach
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
            <div class="size-selector" id="sizeSelector"></div>
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

          <!-- CART ITEMS VIEW -->
          <div id="cartItemsView">
              <div class="cart-items" id="cartItems">
              <div class="empty-cart">Your cart is empty</div>
              </div>
              <div class="cart-total"><span>Total</span><span id="cartTotal">Rs.0</span></div>
              <div class="cart-actions">
              <button class="btn-clear" onclick="clearCart()">Clear</button>
              <button class="btn-checkout" onclick="showCheckoutForm()">Checkout</button>
              </div>
          </div>

          <!-- CHECKOUT FORM VIEW -->
          <div id="checkoutFormView" style="display:none;">
              <button class="cart-close" style="position:absolute; top:1rem; right:1rem; background:white; border:1px solid #eee;" onclick="hideCheckoutForm()"><i class="fas fa-arrow-left"></i> Back</button>
              <h3 style="margin-top:0; color:var(--ink);"><i class="fas fa-credit-card"></i> Checkout</h3>

              <!-- Form -->
              <form id="checkoutForm" method="POST" action="{{ route('custom-products.order') }}" style="margin-top:1.2rem;">
                @csrf
                <input type="hidden" name="total_price" id="checkoutTotalPrice" value="0">
                <input type="hidden" name="product_name" id="checkoutProductName" value="">
                <input type="hidden" name="cart_items" id="checkoutCartItems" value="">
                <input type="hidden" name="cake_size" id="checkoutCakeSize" value="">
                <input type="hidden" name="flavor" id="checkoutFlavor" value="">
                <input type="hidden" name="frosting" id="checkoutFrosting" value="">
                <input type="hidden" name="card_payment_confirmed" id="cartCardPaymentConfirmed" value="0">


                <!-- Grid -->
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem 1.2rem;">

                  <!-- Customer Name (full width) -->
                  <div style="grid-column:1/-1; display:flex; flex-direction:column; gap:0.3rem;">
                    <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.03em; color:#6b5b4e; margin-left:0.2rem;">Customer Name</label>
                    <input type="text" name="customer_name" value="{{ auth()->user()?->name ?? '' }}" required style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; font-size:0.95rem; font-family:inherit; background:#fcfaf8; transition:0.2s; color:#2c241e; outline:none; box-shadow:inset 0 2px 4px rgba(0,0,0,0.01);">
                  </div>

                  <!-- Phone -->
                  <div style="display:flex; flex-direction:column; gap:0.3rem;">
                    <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.03em; color:#6b5b4e; margin-left:0.2rem;">Phone</label>
                    <input type="text" name="phone" value="{{ auth()->user()?->contact_number ?? '' }}" required style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; font-size:0.95rem; font-family:inherit; background:#fcfaf8; transition:0.2s; color:#2c241e; outline:none; box-shadow:inset 0 2px 4px rgba(0,0,0,0.01);">
                  </div>

                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

                <script>
                  let deliveryMap = null;
                  let deliveryMarker = null;


                  // ==========================================
                  // DELIVERY AREAS
                  // ==========================================

                  const deliveryAreas = {

                      Homagama: {
                          lat: 6.8449,
                          lng: 80.0024,
                          radius: 5000
                      },

                      Kottawa: {
                          lat: 6.7733,
                          lng: 79.9553,
                          radius: 5000
                      },

                      Maharagama: {
                          lat: 6.8480,
                          lng: 79.9265,
                          radius: 5000
                      },

                      Godagama: {
                          lat: 6.8369,
                          lng: 80.0328,
                          radius: 4000
                      }

                  };


                  // ==========================================
                  // INITIALIZE MAP
                  // ==========================================

                  function initializeDeliveryMap() {

                      const mapElement = document.getElementById('deliveryMap');

                      if (!mapElement) {
                          console.error('Delivery map element not found.');
                          return;
                      }

                      if (typeof L === 'undefined') {
                          console.error('Leaflet JS was not loaded.');
                          return;
                      }

                      deliveryMap = L.map('deliveryMap').setView(
                          [6.82, 79.97],
                          12
                      );


                      // OpenStreetMap
                      L.tileLayer(
                          'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                          {
                              maxZoom: 19,

                              attribution:
                                  '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> contributors'
                          }
                      ).addTo(deliveryMap);


                      // ==========================================
                      // DRAW DELIVERY AREAS
                      // ==========================================

                      Object.keys(deliveryAreas).forEach(function(city) {

                          const area = deliveryAreas[city];

                          L.circle(
                              [area.lat, area.lng],
                              {
                                  radius: area.radius,
                                  color: '#198754',
                                  fillColor: '#198754',
                                  fillOpacity: 0.15
                              }
                          )
                          .addTo(deliveryMap)
                          .bindPopup(
                              '<b>' + city + '</b><br>Delivery Area'
                          );

                      });


                      // ==========================================
                      // MAP CLICK
                      // ==========================================

                      deliveryMap.on('click', function(event) {

                          selectDeliveryLocation(
                              event.latlng.lat,
                              event.latlng.lng
                          );

                      });

                  }


                  // ==========================================
                  // SELECT DELIVERY LOCATION
                  // ==========================================

                  function selectDeliveryLocation(latitude, longitude) {

                      // Remove old marker
                      if (deliveryMarker) {

                          deliveryMap.removeLayer(
                              deliveryMarker
                          );

                      }


                      // Create new marker
                      deliveryMarker = L.marker([
                          latitude,
                          longitude
                      ])
                      .addTo(deliveryMap);


                      // Save coordinates
                      document.getElementById('latitude').value = latitude;
                      document.getElementById('longitude').value = longitude;


                      // Find delivery area
                      const selectedCity = findDeliveryArea(
                          latitude,
                          longitude
                      );


                      if (selectedCity) {

                          // Set city
                          document.getElementById('city').value =
                              selectedCity;
                          document.getElementById('cartDeliveryAreaSelect').value = selectedCity;


                          // Show popup
                          deliveryMarker
                              .bindPopup(
                                  '<b>✓ Delivery Available</b><br>' +
                                  selectedCity
                              )
                              .openPopup();


                          // Show message
                          showDeliveryMessage(
                              '✓ Delivery is available in ' +
                              selectedCity +
                              '.',
                              'success'
                          );

                      } else {

                          // Clear city
                          document.getElementById('city').value = '';
                          document.getElementById('cartDeliveryAreaSelect').value = '';


                          // Show popup
                          deliveryMarker
                              .bindPopup(
                                  '<b>✗ Delivery Not Available</b><br>' +
                                  'This location is outside our delivery areas.'
                              )
                              .openPopup();


                          // Show message
                          showDeliveryMessage(
                              '✗ Sorry, delivery is available only in Homagama, Kottawa, Maharagama, and Godagama.',
                              'danger'
                          );

                      }

                          validateCartDeliveryAddressArea();

                  }


                  function selectCartDeliveryArea(areaName) {
                    if (!areaName || !deliveryAreas[areaName]) {
                      return;
                    }

                    const area = deliveryAreas[areaName];
                    deliveryMap.setView([area.lat, area.lng], 14);
                    selectDeliveryLocation(area.lat, area.lng);
                  }

                  function validateCartDeliveryAddressArea() {
                    const address = document.getElementById('address')?.value || '';
                    const selectedArea = document.getElementById('city')?.value || '';
                    const warning = document.getElementById('cartAddressAreaWarning');
                    const areaNames = [
                      'Homagama', 'Kottawa', 'Maharagama', 'Godagama',
                      'Colombo', 'Dehiwala', 'Nugegoda', 'Piliyandala',
                      'Malabe', 'Athurugiriya', 'Padukka'
                    ];
                    const mentionedArea = areaNames.find((area) => {
                      return new RegExp(`\\b${area}\\b`, 'i').test(address);
                    });

                    if (mentionedArea && selectedArea && mentionedArea.toLowerCase() !== selectedArea.toLowerCase()) {
                      warning.innerHTML = `<i class="fas fa-exclamation-triangle"></i> This address mentions <strong>${mentionedArea}</strong>, but the selected delivery area is <strong>${selectedArea}</strong>.`;
                      warning.style.display = 'block';
                      return false;
                    }

                    warning.style.display = 'none';
                    warning.textContent = '';
                    return true;
                  }

                  // ==========================================
                  // FIND DELIVERY AREA
                  // ==========================================

                  function findDeliveryArea(latitude, longitude) {

                      for (const city in deliveryAreas) {

                          const area = deliveryAreas[city];

                          const distance = calculateDistance(
                              latitude,
                              longitude,
                              area.lat,
                              area.lng
                          );

                          if (distance <= area.radius) {

                              return city;

                          }

                      }

                      return null;
                  }


                  // ==========================================
                  // CALCULATE DISTANCE
                  // ==========================================

                  function calculateDistance(
                      lat1,
                      lon1,
                      lat2,
                      lon2
                  ) {

                      const earthRadius = 6371000;

                      const lat1Radians =
                          lat1 * Math.PI / 180;

                      const lat2Radians =
                          lat2 * Math.PI / 180;

                      const deltaLat =
                          (lat2 - lat1) * Math.PI / 180;

                      const deltaLon =
                          (lon2 - lon1) * Math.PI / 180;

                      const a =
                          Math.sin(deltaLat / 2) *
                          Math.sin(deltaLat / 2) +

                          Math.cos(lat1Radians) *
                          Math.cos(lat2Radians) *

                          Math.sin(deltaLon / 2) *
                          Math.sin(deltaLon / 2);

                      const c =
                          2 *
                          Math.atan2(
                              Math.sqrt(a),
                              Math.sqrt(1 - a)
                          );

                      return earthRadius * c;
                  }


                  // ==========================================
                  // SHOW DELIVERY MESSAGE
                  // ==========================================

                  function showDeliveryMessage(message, type) {

                      const messageBox =
                          document.getElementById('deliveryMessage');

                      messageBox.innerHTML = `
                          <div class="alert alert-${type} mt-2">
                              ${message}
                          </div>
                      `;
                  }


                  // ==========================================
                  // DELIVERY / PICKUP BUTTON
                  // ==========================================

                  function selectDeliveryOption(option) {

                      const deliverySelect =
                        document.getElementById('delivery_option');

                      const addressSection =
                          document.getElementById('deliveryAddressSection');

                      const pickupSection =
                        document.getElementById('pickupAddressSection');

                      const mapContainer =
                          document.getElementById('deliveryMapContainer');


                      // Save option
                      deliverySelect.value =
                          option === 'delivery'
                              ? 'Delivery'
                              : 'Pickup';


                      // Update buttons
                      document
                          .querySelectorAll('.delivery-option-btn')
                          .forEach(function(button) {

                              button.classList.remove('active');

                          });


                      const selectedButton =
                          document.querySelector(
                              '.delivery-option-btn[data-option="' +
                              option +
                              '"]'
                          );

                      if (selectedButton) {

                          selectedButton.classList.add('active');

                      }


                      // DELIVERY
                      if (option === 'delivery') {

                          addressSection.style.display = 'block';

                          mapContainer.style.display = 'block';
                          pickupSection.style.display = 'none';
                          document.getElementById('address').required = true;


                          // Make map visible correctly
                          setTimeout(function() {

                              if (deliveryMap) {

                                  deliveryMap.invalidateSize();

                              }

                          }, 200);

                      }


                      // PICKUP
                      else {

                          addressSection.style.display = 'none';

                          mapContainer.style.display = 'none';
                          pickupSection.style.display = 'block';
                          document.getElementById('address').required = false;


                          document.getElementById('latitude').value = '';

                          document.getElementById('longitude').value = '';

                          document.getElementById('city').value = '';
                          document.getElementById('cartDeliveryAreaSelect').value = '';
                          document.getElementById('cartAddressAreaWarning').style.display = 'none';

                          document.getElementById(
                              'deliveryMessage'
                          ).innerHTML = '';

                      }

                  }


                  // ==========================================
                  // FORM VALIDATION
                  // ==========================================

                  document.addEventListener(
                      'DOMContentLoaded',
                      function() {

                          initializeDeliveryMap();


                          const checkoutForm =
                              document.getElementById('checkoutForm');


                          if (checkoutForm) {

                              checkoutForm.addEventListener(
                                  'submit',
                                  function(event) {

                                      const option =
                                          document.getElementById(
                                            'delivery_option'
                                          ).value;


                                      if (option === 'Delivery') {

                                          const latitude =
                                              document.getElementById(
                                                  'latitude'
                                              ).value;

                                          const longitude =
                                              document.getElementById(
                                                  'longitude'
                                              ).value;

                                          const city =
                                              document.getElementById(
                                                  'city'
                                              ).value;


                                          if (
                                              !latitude ||
                                              !longitude ||
                                              !city
                                          ) {

                                              event.preventDefault();


                                              showDeliveryMessage(
                                                  'Please select a valid delivery location on the map.',
                                                  'danger'
                                              );

                                              return;

                                          }

                                              if (!validateCartDeliveryAddressArea()) {
                                                event.preventDefault();
                                                showDeliveryMessage(
                                                  'The typed address does not match the selected delivery area.',
                                                  'danger'
                                                );
                                                return;
                                              }

                                      }

                                  }
                              );

                          }


                          const deliverySelect = document.getElementById('delivery_option');
                          deliverySelect.addEventListener('change', function() {
                            selectDeliveryOption(this.value.toLowerCase());
                          });

                          selectDeliveryOption(deliverySelect.value.toLowerCase());

                      }
                  );

                </script>

                  <!-- Delivery Date -->
                  <div style="display:flex; flex-direction:column; gap:0.3rem;">
                    <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.03em; color:#6b5b4e; margin-left:0.2rem;">Delivery Date</label>
                    <input type="date" name="delivery_date" required min="{{ now()->addDays(2)->toDateString() }}" style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; font-size:0.95rem; font-family:inherit; background:#fcfaf8; color:#2c241e; outline:none;">
                    <small style="display:block; margin-top:0.4rem; color:#6c5b4a;">Choose a date at least 2 days from today. Each date has a limit of 3 orders.</small>
                  </div>

                  <!-- Delivery Option -->
                  <div style="display:flex; flex-direction:column; gap:0.3rem;">
                    <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.03em; color:#6b5b4e; margin-left:0.2rem;">Delivery Option</label>
                    <select name="delivery_option" id="delivery_option" class="form-select" style="width:100%; padding:0.7rem 2.8rem 0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; font-size:0.95rem; font-family:inherit; background:#fcfaf8 url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2214%22 height=%2214%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%23847262%22 stroke-width=%222%22><polyline points=%226 9 12 15 18 9%2２/></svg>') no-repeat right 1rem center; background-size:14px; transition:0.2s; color:#2c241e; outline:none; box-shadow:inset 0 2px 4px rgba(0,0,0,0.01); cursor:pointer; appearance:none;">
                      <option value="Pickup">Pickup from bakery</option>
                      <option value="Delivery">Home delivery</option>
                    </select>
                  </div>

                  <div id="pickupAddressSection" style="grid-column:1/-1; display:none; padding:1rem; border:1px solid #eadfd4; border-radius:16px; background:#fffaf4; color:#60453a;">
                    <strong><i class="fas fa-store"></i> Bakery Pickup</strong>
                    <div class="mt-2">Disna Bakery, <br> 39/A Pitipana North, Uduwana, Homagama</div>
                    <div class="mt-2">075 593 7147</div>
                    <small class="text-muted">Your order will be ready for collection at the selected date.</small>
                  </div>

                  <!-- Delivery Address -->
                  <div id="deliveryAddressSection" style="grid-column:1/-1; display:none;">
                    <div style="display:flex; flex-direction:column; gap:0.3rem;">
                      <label for="address" style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.03em; color:#6b5b4e;">Delivery Address</label>
                      <textarea name="address" id="address" rows="3" placeholder="Enter your delivery address"
                        oninput="validateCartDeliveryAddressArea()"
                        style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; font-size:0.95rem; font-family:inherit; background:#fcfaf8; color:#2c241e; outline:none; resize:vertical;"></textarea>
                      <div id="cartAddressAreaWarning" class="alert alert-warning mt-2 mb-0" style="display:none;"></div>
                    </div>
                  </div>

                  <input type="hidden" name="latitude" id="latitude">
                  <input type="hidden" name="longitude" id="longitude">
                  <input type="hidden" name="city" id="city">

                  <!-- Delivery Map -->
                  <div id="deliveryMapContainer" style="grid-column:1/-1; display:none;">
                    <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.03em; color:#6b5b4e;">Select Your Delivery Location</label>
                    <div id="deliveryMap" style="height:400px; width:100%; border-radius:18px; border:1px solid #e5dbd1; margin-top:8px;"></div>
                    <small class="text-muted">Click on the map to select your delivery location.</small>
                    <label for="cartDeliveryAreaSelect" class="form-label mt-3">Or choose your delivery area</label>
                    <select id="cartDeliveryAreaSelect" class="form-select" onchange="selectCartDeliveryArea(this.value)">
                      <option value="">Select a delivery area</option>
                      <option value="Homagama">Homagama</option>
                      <option value="Kottawa">Kottawa</option>
                      <option value="Maharagama">Maharagama</option>
                      <option value="Godagama">Godagama</option>
                    </select>
                  </div>

                  <div id="deliveryMessage" style="grid-column:1/-1;"></div>

                  <!-- Delivery Validation Message -->
                  <div id="deliveryMessage" style="grid-column:1/-1;"></div>

                  <!-- Message on Cake -->
                  <div style="display:flex; flex-direction:column; gap:0.3rem;">
                    <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.03em; color:#6b5b4e; margin-left:0.2rem;">Message on Cake</label>
                    <input type="text" name="cake_message" placeholder="Happy Birthday!" style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; font-size:0.95rem; font-family:inherit; background:#fcfaf8; transition:0.2s; color:#2c241e; outline:none; box-shadow:inset 0 2px 4px rgba(0,0,0,0.01);">
                  </div>

                  <!-- Special Notes (full) -->
                  <div style="grid-column:1/-1; display:flex; flex-direction:column; gap:0.3rem;">
                    <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.03em; color:#6b5b4e; margin-left:0.2rem;">Special Notes</label>
                    <textarea name="special_notes" placeholder="Extra notes for bakery staff" style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:22px; font-size:0.95rem; font-family:inherit; background:#fcfaf8; transition:0.2s; color:#2c241e; outline:none; box-shadow:inset 0 2px 4px rgba(0,0,0,0.01); resize:vertical; min-height:75px;"></textarea>
                  </div>
                </div>

                <div style="grid-column:1/-1; padding:0.8rem 1rem; border:1px solid #eadfd4; border-radius:14px; background:#fffaf4; color:#60453a; font-size:0.9rem;">
                  <i class="fas fa-credit-card"></i> Pay by card or direct bank transfer. A payment reference is required for bank transfers.
                </div>

                <div style="grid-column:1/-1; display:flex; flex-direction:column; gap:0.3rem;">
                  <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; color:#6b5b4e;">Payment Method</label>
                  <select id="cartPaymentMethod" name="payment_method" required onchange="toggleCartPaymentFields()" style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; background:#fcfaf8; color:#2c241e;">
                    <option value="Card">Card Payment</option>
                    <option value="Bank Transfer">Direct Bank Transfer</option>
                  </select>
                  <div id="cartTransactionReferenceFields" style="display:flex; flex-direction:column; gap:0.3rem;">
                    <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.03em; color:#6b5b4e; margin-left:0.2rem;">Transaction Reference</label>
                    <input type="text" name="transaction_id" maxlength="100" placeholder="Payment reference / transfer reference" style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; font-size:0.95rem; font-family:inherit; background:#fcfaf8; color:#2c241e; outline:none;">
                  </div>
                </div>

                <div id="cartCardPaymentFields" style="grid-column:1/-1; display:grid; grid-template-columns:1fr 1.5fr 1fr; gap:1rem;">
                  <div style="display:flex; flex-direction:column; gap:0.3rem;">
                    <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; color:#6b5b4e;">Card Type</label>
                    <select name="card_type" style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; background:#fcfaf8; color:#2c241e;">
                      <option value="">Select card</option>
                      <option value="Visa">Visa</option>
                      <option value="Mastercard">Mastercard</option>
                    </select>
                  </div>
                  <div style="display:flex; flex-direction:column; gap:0.3rem;">
                    <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; color:#6b5b4e;">Card Number</label>
                    <input type="text" name="card_number" inputmode="numeric" autocomplete="cc-number" maxlength="19" pattern="[0-9 ]{13,19}" placeholder="1234 5678 9012 3456" style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; background:#fcfaf8; color:#2c241e;">
                  </div>
                  <div style="display:flex; flex-direction:column; gap:0.3rem;">
                    <label style="font-size:0.8rem; font-weight:600; text-transform:uppercase; color:#6b5b4e;">CVV</label>
                    <input type="password" name="cvv" inputmode="numeric" autocomplete="cc-csc" maxlength="4" pattern="[0-9]{3,4}" placeholder="123" style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; background:#fcfaf8; color:#2c241e;">
                  </div>
                  <div style="grid-column:1/-1;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.6rem; font-weight:700; color:#2c241e;">
                      <span>Amount to pay</span>
                      <span id="cartCardPaymentAmount">Rs. 0</span>
                    </div>
                    <button type="button" id="cartPayNowButton" onclick="confirmCartCardPayment()" style="width:100%; padding:0.7rem 1rem; border:0; border-radius:18px; background:#198754; color:white; font-weight:700; cursor:pointer;">
                      <i class="fas fa-lock"></i> Pay Now
                    </button>
                    <div id="cartPaymentSuccess" style="display:none; margin-top:0.6rem; padding:0.65rem 0.8rem; border-radius:12px; background:#d1e7dd; color:#0f5132; font-size:0.9rem;">
                      <i class="fas fa-check-circle"></i> Payment successful. You can now place your order.
                    </div>
                  </div>
                </div>

                <div id="cartBankPaymentDetails" style="grid-column:1/-1; display:none; margin-top:0.75rem; padding:0.9rem 1rem; border:1px solid #eadfd4; border-radius:14px; background:#f1f3f5; color:#60453a;">
                  <strong><i class="fas fa-university"></i> Direct bank transfer details</strong>
                  <div class="mt-2">Bank: <strong>Commercial Bank</strong></div>
                  <div>Account name: <strong>DS Gajanayake</strong></div>
                  <div>Account number: <strong>3456789546</strong></div>
                  <div>Branch: <strong>Kottawa</strong></div>
                  <small class="d-block mt-2">Transfer the order amount and enter the bank transfer reference above.</small>
                </div>

                <script>
                  function toggleCartPaymentFields() {
                    const isCard = document.getElementById('cartPaymentMethod').value === 'Card';
                    const cardFields = document.getElementById('cartCardPaymentFields');
                    const bankDetails = document.getElementById('cartBankPaymentDetails');
                    const referenceFields = document.getElementById('cartTransactionReferenceFields');
                    cardFields.style.display = isCard ? 'grid' : 'none';
                    bankDetails.style.display = isCard ? 'none' : 'block';
                    referenceFields.style.display = isCard ? 'none' : 'flex';
                    referenceFields.querySelector('input').required = !isCard;
                    cardFields.querySelectorAll('input, select').forEach((field) => {
                      field.required = isCard;
                    });
                    document.getElementById('cartCardPaymentConfirmed').value = '0';
                    document.getElementById('cartPaymentSuccess').style.display = 'none';
                  }

                  function confirmCartCardPayment() {
                    const cardFields = document.getElementById('cartCardPaymentFields');
                    const requiredFields = cardFields.querySelectorAll('input[required], select[required]');
                    if ([...requiredFields].some((field) => !field.checkValidity())) {
                      requiredFields.forEach((field) => field.reportValidity());
                      return;
                    }

                    document.getElementById('cartCardPaymentConfirmed').value = '1';
                    document.getElementById('cartPaymentSuccess').style.display = 'block';
                    document.getElementById('cartPayNowButton').innerHTML = '<i class="fas fa-check"></i> Payment Completed';
                    document.getElementById('cartPayNowButton').disabled = true;
                  }
                  toggleCartPaymentFields();
                </script>

                <!-- Submit Button -->
                <button class="checkout-submit" type="submit" style="width:100%; margin-top:1.8rem; padding:0.9rem 1.5rem; border:none; border-radius:60px; background:linear-gradient(105deg, #e6cdbb, #dbb8a2); color:#352b24; font-weight:700; font-size:1.1rem; letter-spacing:0.3px; cursor:pointer; transition:all 0.25s ease; display:flex; align-items:center; justify-content:center; gap:0.8rem; box-shadow:0 8px 18px -6px rgba(180,140,120,0.3); border:1px solid rgba(255,235,215,0.5);">
                  <i class="fas fa-shopping-bag" style="font-size:1.1rem; opacity:0.8;"></i> Place Order
                </button>
              </form>
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
      window.userId = @json(auth()->id() ?? 'guest');

      // ----- DATA -----
      let cart = [];
      let currentProduct = null;
      const cartKey = `bakery_cart_${window.userId}`;
      const legacyCartKey = 'bakery_cart';

      if (localStorage.getItem(legacyCartKey) && !localStorage.getItem(cartKey)) {
          localStorage.setItem(cartKey, localStorage.getItem(legacyCartKey));
          localStorage.removeItem(legacyCartKey);
      }

      function loadCartFromStorage() {
          try {
              const stored = JSON.parse(localStorage.getItem(cartKey) || '[]');
            const productCards = Array.from(document.querySelectorAll('.menu-item[data-product-id]'));
            cart = Array.isArray(stored) ? stored.map(item => {
              const productCard = productCards.find(card => card.dataset.name === item.name);
              return {
                ...item,
                productId: Number(item.productId || productCard?.dataset.productId) || null,
                stock: Number(productCard?.dataset.stock ?? item.stock ?? 0)
              };
            }) : [];
          } catch (error) {
              cart = [];
          }
      }

      function saveCartToStorage() {
          localStorage.setItem(cartKey, JSON.stringify(cart));
      }

        // ----- PRODUCT FILTER + SEARCH -----
        let activeProductFilter = 'all';
        const productSearchInput = document.getElementById('productSearchInput');
        const productSearchEmpty = document.getElementById('productSearchEmpty');

        function applyProductFilters() {
          const searchTerm = productSearchInput.value.trim().toLowerCase();
          let visibleCount = 0;

          document.querySelectorAll('.menu-item').forEach(item => {
            const matchesCategory = activeProductFilter === 'all' || item.dataset.category === activeProductFilter;
            const searchableText = `${item.dataset.name || ''} ${item.dataset.desc || ''} ${item.dataset.category || ''}`.toLowerCase();
            const matchesSearch = searchableText.includes(searchTerm);
            const isVisible = matchesCategory && matchesSearch;
            item.style.display = isVisible ? 'flex' : 'none';
            if (isVisible) visibleCount += 1;
          });

          document.querySelectorAll('.menu-category').forEach(category => {
            const hasVisibleProducts = Array.from(category.querySelectorAll('.menu-item'))
              .some(item => item.style.display !== 'none');
            category.style.display = hasVisibleProducts ? 'block' : 'none';
          });

          productSearchEmpty.hidden = visibleCount > 0;
        }

      document.querySelectorAll('.filter-btn').forEach(btn => {
          btn.addEventListener('click', function() {
          document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
          this.classList.add('active');
          activeProductFilter = this.dataset.filter;
          applyProductFilters();
          });
      });

        productSearchInput.addEventListener('input', applyProductFilters);

        // ----- QUICK VIEW (modal) -----
        const sizeOptions = {
          kg: [
            { size: '250g', multiplier: 0.25 },
            { size: '500g', multiplier: 0.5 },
            { size: '1kg', multiplier: 1 },
            { size: '2kg', multiplier: 2 },
            { size: '3kg', multiplier: 3 }
          ],
          pcs: [
            { size: '1 pc', multiplier: 0.25 },
            { size: '2 pcs', multiplier: 0.5 },
            { size: '4 pcs', multiplier: 1 },
            { size: '8 pcs', multiplier: 2 },
            { size: '12 pcs', multiplier: 3 }
          ]
        };

        function renderSizeOptions(isPiece, selectedSize) {
          const options = isPiece ? sizeOptions.pcs : sizeOptions.kg;
          document.getElementById('sizeSelector').innerHTML = options.map(option => `
            <button type="button" data-size="${option.size}" data-multiplier="${option.multiplier}" class="${option.size === selectedSize ? 'active' : ''}">${option.size}</button>
          `).join('');
        }

      function quickView(el) {
          const item = el.closest('.menu-item');
          const name = item.dataset.name;
          const price = parseInt(item.dataset.price);
          const img = item.dataset.img;
          const desc = item.dataset.desc;
          const tag = item.dataset.tag;
          const rating = item.dataset.rating || '4.8';
          const productId = Number(el.dataset.productId);
          const stock = Number(item.dataset.stock || 0);
          const category = item.dataset.category || '';
          const isPiece = /^cupcakes?$/.test(category) || category === 'cookies' || /cake[-\s]?pop.*box/i.test(`${category} ${name}`);
          const defaultSize = isPiece ? '4 pcs' : '1kg';
          currentProduct = { id: productId, stock, name, price, img, desc, tag, rating, basePrice: price, isPiece, selectedSize: defaultSize, selectedPrice: price, multiplier: 1 };
          document.getElementById('modalImage').src = img;
          document.getElementById('modalTitle').textContent = name;
          document.getElementById('modalPrice').textContent = 'Rs.' + price;
          document.getElementById('modalDescription').textContent = desc;
          document.getElementById('modalBadge').textContent = isPiece ? 'Pack of 4' : tag;
          document.getElementById('modalTagDisplay').textContent = isPiece ? 'Pack of 4' : tag;
          document.getElementById('modalRating').textContent = rating;
          document.getElementById('modalSizeDisplay').textContent = defaultSize;
          renderSizeOptions(isPiece, defaultSize);
          document.getElementById('modalOverlay').classList.add('active');
          document.body.style.overflow = 'hidden';
      }

      function closeModal() {
          document.getElementById('modalOverlay').classList.remove('active');
          document.body.style.overflow = '';
      }
      function closeModalOutside(e) { if (e.target === document.getElementById('modalOverlay')) closeModal(); }

        document.getElementById('sizeSelector').addEventListener('click', function(event) {
          const button = event.target.closest('button');
          if (!button) return;
          document.querySelectorAll('#sizeSelector button').forEach(b => b.classList.remove('active'));
          button.classList.add('active');
          const mult = parseFloat(button.dataset.multiplier);
          if (currentProduct) {
              const newPrice = Math.round(currentProduct.basePrice * mult);
              document.getElementById('modalPrice').textContent = 'Rs.' + newPrice;
            document.getElementById('modalSizeDisplay').textContent = button.dataset.size;
            currentProduct.selectedSize = button.dataset.size;
              currentProduct.selectedPrice = newPrice;
              currentProduct.multiplier = mult;
          }
      });

      function addFromModal() {
          if (!currentProduct) return;
          const size = currentProduct.selectedSize || (currentProduct.isPiece ? '4 pcs' : '1kg');
          const price = currentProduct.selectedPrice || currentProduct.basePrice;
          const name = currentProduct.name;
          const img = currentProduct.img;
          const existing = cart.find(item => item.productId === currentProduct.id && item.size === size);
          const totalQuantity = cart
            .filter(item => item.productId === currentProduct.id)
            .reduce((total, item) => total + (Number(item.qty) || 0), 0);

          if (totalQuantity >= currentProduct.stock) {
            showToast('Only ' + currentProduct.stock + ' available in stock');
            return;
          }

          if (existing) {
          existing.qty += 1;
          } else {
          cart.push({ productId: currentProduct.id, stock: currentProduct.stock, name, price, size, img, qty: 1, multiplier: currentProduct.multiplier || 1, isPiece: currentProduct.isPiece });
          }
          updateCartUI();
          showToast('Added ' + name + ' (' + size + ')');
          closeModal();
      }

      function toggleCart() {
          document.getElementById('cartOverlay').classList.toggle('open');
      }
      document.getElementById('cartToggle').addEventListener('click', toggleCart);
      document.getElementById('navbarCartToggle').addEventListener('click', toggleCart);

      function updateCartUI() {
          saveCartToStorage();
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
            item.qty = Math.max(1, Number(item.qty) || 1);
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
                <span class="cart-quantity" aria-label="Quantity for ${item.name}">
                      <button type="button" onclick="changeQuantity(${idx}, -1)" aria-label="Decrease quantity">-</button>
                  <span class="cart-quantity-value">${item.qty}</span>
                  <button type="button" onclick="changeQuantity(${idx}, 1)" aria-label="Increase quantity">+</button>
                </span>
                    <select onchange="changeSize(${idx}, this.value)">
                      ${(item.isPiece ? sizeOptions.pcs : sizeOptions.kg).map(option => `<option value="${option.size}" ${item.size===option.size?'selected':''}>${option.size}</option>`).join('')}
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

        function changeQuantity(idx, change) {
          const item = cart[idx];
          if (!item) return;

          const newQuantity = Math.max(1, (Number(item.qty) || 1) + change);
          const totalOtherQuantity = cart
              .filter((cartItem, cartIndex) => cartItem.productId === item.productId && cartIndex !== idx)
              .reduce((total, cartItem) => total + (Number(cartItem.qty) || 0), 0);
          if (change > 0 && totalOtherQuantity + newQuantity > Number(item.stock || 0)) {
              showToast('Only ' + item.stock + ' available in stock');
              return;
          }
          item.qty = newQuantity;
          updateCartUI();
        }

      function changeSize(idx, newSize) {
          const item = cart[idx];
          const selectedOption = (item.isPiece ? sizeOptions.pcs : sizeOptions.kg).find(option => option.size === newSize);
          const mult = selectedOption?.multiplier || 1;
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

      function showCheckoutForm() {
          if (cart.length === 0) { showToast('Cart is empty'); return; }
          const total = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
          document.getElementById('checkoutTotalPrice').value = total;
          document.getElementById('cartCardPaymentAmount').textContent = 'Rs. ' + total.toLocaleString('en-US');
          document.getElementById('checkoutProductName').value = cart.map(item => `${item.name} x${item.qty}`).join(', ');
            document.getElementById('checkoutCartItems').value = JSON.stringify(cart.map(item => ({
              product_id: item.productId,
              quantity: item.qty
            })));
          document.getElementById('checkoutCakeSize').value = cart.map(item => item.size).join(', ');
          document.getElementById('checkoutFlavor').value = cart[0]?.name || 'Bakery Item';
          document.getElementById('checkoutFrosting').value = cart[0]?.size || 'Classic';
          document.getElementById('cartItemsView').style.display = 'none';
          document.getElementById('checkoutFormView').style.display = 'block';
      }

      function hideCheckoutForm() {
          document.getElementById('checkoutFormView').style.display = 'none';
          document.getElementById('cartItemsView').style.display = 'block';
      }

      const checkoutForm = document.getElementById('checkoutForm');
      if (checkoutForm) {
          checkoutForm.addEventListener('submit', function(e) {
            if (document.getElementById('cartPaymentMethod').value === 'Card' && document.getElementById('cartCardPaymentConfirmed').value !== '1') {
              e.preventDefault();
              showToast('Please click Pay Now after entering your card details');
              return;
            }
          });
      }

      let toastTimer;
      function showToast(msg) {
          const t = document.getElementById('toastMessage');
          document.getElementById('toastText').textContent = msg;
          t.classList.add('show');
          clearTimeout(toastTimer);
          toastTimer = setTimeout(() => { t.classList.remove('show'); }, 3000);
      }
      function hideToast() { document.getElementById('toastMessage').classList.remove('show'); }

      document.addEventListener('DOMContentLoaded', function() {
        loadCartFromStorage();
        if (document.querySelector('[data-order-success]')) {
            localStorage.removeItem(cartKey);
            cart = [];
        }
        updateCartUI();
        renderSizeOptions(false, '1kg');
      });

      document.getElementById('cartOverlay').addEventListener('click', function(e) {
          if (e.target === this) toggleCart();
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.querySelectorAll('[data-auto-dismiss]').forEach((alert) => {
        window.setTimeout(() => {
          alert.style.transition = 'opacity 300ms ease';
          alert.style.opacity = '0';
          window.setTimeout(() => alert.remove(), 300);
        }, 5000);
      });
    </script>
</body>
</html>