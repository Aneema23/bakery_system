<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Your Cake - Disna Bakery</title>

    <!-- logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      crossorigin=""
    />
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

        /* Page Header */
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

        /* Customization Form */
        .customization-form {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            margin: 40px 0;
        }

        .form-section {
            margin-bottom: 35px;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(212, 163, 115, 0.2);
        }

        .form-section:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-section h3 {
            color: #5c3d2e;
            margin-bottom: 20px;
            font-size: 1.4rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .help-btn {
            background: #d4a37330;
            border: 1px solid #d4a373;
            color: #b5835a;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s;
            margin-left: 5px;
        }

        .help-btn:hover {
            background: #d4a373;
            color: white;
            transform: scale(1.1);
        }

        .help-tooltip {
            display: none;
            background: #2c241f;
            color: white;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.9rem;
            margin-top: 8px;
            max-width: 400px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .help-tooltip.show {
            display: block;
        }

        .help-tooltip i {
            margin-right: 8px;
            color: #fcd34d;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e8ddd2;
            padding: 12px 16px;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #d4a373;
            box-shadow: 0 0 0 4px #d4a37330;
        }

        .form-label {
            font-weight: 600;
            color: #5c3d2e;
        }

        /* Delivery Option Toggle */
        .delivery-option-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .delivery-option-btn {
            flex: 1;
            min-width: 140px;
            padding: 1rem 1.5rem;
            border: 2px solid #e8ddd2;
            border-radius: 16px;
            background: white;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            color: #5c3d2e;
        }

        .delivery-option-btn:hover {
            border-color: #d4a373;
            background: #fffaf5;
            transform: translateY(-2px);
        }

        .delivery-option-btn.active {
            border-color: #d4a373;
            background: linear-gradient(135deg, #d4a37320 0%, #b5835a20 100%);
            box-shadow: 0 4px 15px rgba(212, 163, 115, 0.2);
        }

        .delivery-option-btn i {
            font-size: 2rem;
            display: block;
            margin-bottom: 8px;
            color: #d4a373;
        }

        .delivery-option-btn .option-label {
            display: block;
            font-size: 0.9rem;
        }

        .delivery-option-btn .option-sub {
            display: block;
            font-size: 0.75rem;
            color: #8a7a6e;
            font-weight: 400;
            margin-top: 4px;
        }

        .delivery-address-section {
            transition: all 0.3s ease;
            overflow: hidden;
            max-height: 2000px;
            opacity: 1;
        }

        .delivery-address-section.hidden {
            max-height: 0;
            opacity: 0;
            margin: 0;
            padding: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .pickup-info {
            background: #f8f4f0;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid #eadfd4;
            margin-top: 1rem;
        }

        .pickup-info i {
            font-size: 2.5rem;
            color: #d4a373;
            margin-bottom: 10px;
        }

        .pickup-info h5 {
            color: #5c3d2e;
            margin-bottom: 5px;
        }

        .pickup-info p {
            color: #7d6458;
            margin-bottom: 0;
        }

        .image-upload {
            border: 2px dashed #d4a373;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #fffaf5;
        }

        .image-upload:hover {
            background: #fff0e0;
            border-color: #b5835a;
        }

        .image-upload i {
            font-size: 2.5rem;
            color: #d4a373;
            margin-bottom: 10px;
        }

        .uploaded-preview {
            margin-top: 15px;
            display: none;
        }

        .uploaded-preview img {
            max-width: 100%;
            border-radius: 10px;
            max-height: 150px;
        }

        /* Preview Panel */
        .preview-panel {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            position: sticky;
            top: 100px;
            margin-top: 40px;
            text-align: center;
        }

        .cake-preview {
            background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%);
            border-radius: 20px;
            padding: 40px 20px;
            color: white;
            margin-bottom: 25px;
        }

        .cake-preview i {
            font-size: 4rem;
            margin-bottom: 15px;
        }

        .preview-details {
            text-align: left;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 12px;
            margin: 20px 0;
        }

        .preview-details p {
            margin-bottom: 10px;
            padding: 5px 0;
            border-bottom: 1px dashed #ddd;
        }

        .preview-details p:last-child {
            border-bottom: none;
        }

        .btn-preview {
            background: transparent;
            border: 2px solid #d4a373;
            color: #b5835a;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .btn-preview:hover {
            background: #d4a373;
            color: white;
        }

        .btn-submit {
            background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%);
            border: none;
            padding: 14px 30px;
            border-radius: 50px;
            color: white;
            font-weight: bold;
            transition: all 0.3s;
            width: 100%;
            font-size: 1.1rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(180, 130, 80, 0.4);
        }

        footer {
            background: #2c241f;
            color: white;
            padding: 50px 0 20px;
            margin-top: 50px;
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

        @media (max-width: 768px) {
            .page-header {
                margin-top: 60px;
                padding: 60px 0 40px;
            }
            .page-header h1 {
                font-size: 2rem;
            }
            .customization-form {
                padding: 25px;
            }
            .preview-panel {
                position: static;
                margin-bottom: 30px;
            }
            .delivery-option-group {
                flex-direction: column;
            }
            .delivery-option-btn {
                min-width: unset;
            }
        }

        /* ============================================
        Online Payment Form Styling
        ============================================ */

        /* Container for the payment section */
        .payment-section {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 1.75rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            max-width: 720px;
            margin: 1.5rem auto;
        }

        /* Heading */
        .payment-section h3 {
            font-size: 1.35rem;
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .payment-section h3 i {
            color: #0d6efd;
            font-size: 1.25rem;
        }

        /* Helper text under heading */
        .payment-section > .text-muted {
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
            display: block;
        }

        /* Labels */
        .payment-section .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            color: #495057;
            margin-bottom: 0.35rem;
        }

        /* Inputs & selects */
        .payment-section .form-control,
        .payment-section .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 0.6rem 0.85rem;
            font-size: 0.95rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .payment-section .form-control:focus,
        .payment-section .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }

        /* Invalid state */
        .payment-section .form-control:invalid:not(:placeholder-shown),
        .payment-section .form-select:invalid:not(:placeholder-shown) {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.12);
        }

        /* Card payment fields wrapper */
        #customCardPaymentFields {
            display: flex;
            flex-wrap: wrap;
            margin-top: 0.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border: 1px dashed #dee2e6;
            border-radius: 10px;
            transition: opacity 0.25s ease;
        }

        #customCardPaymentFields small.text-muted {
            width: 100%;
            margin-top: 0.5rem;
            font-size: 0.8rem;
            display: block;
        }

        /* Bank transfer details box */
        #customBankPaymentDetails {
            border-radius: 10px;
            border-left: 4px solid #0d6efd;
            background: #f0f6ff;
            padding: 1rem 1.15rem;
            font-size: 0.9rem;
            color: #333;
        }

        #customBankPaymentDetails strong {
            color: #212529;
        }

        #customBankPaymentDetails i.fa-university {
            color: #0d6efd;
            margin-right: 0.3rem;
        }

        #customBankPaymentDetails div {
            margin-bottom: 0.2rem;
        }

        #customBankPaymentDetails small {
            font-size: 0.82rem;
        }

        /* Payment method select emphasis */
        #customPaymentMethod {
            font-weight: 500;
            background-color: #fff;
            cursor: pointer;
        }

        /* Submit spacing if wrapped in a form */
        .payment-section form {
            margin: 0;
        }

        /* Responsive tweaks */
        @media (max-width: 576px) {
            .payment-section {
                padding: 1.25rem;
                border-radius: 10px;
            }

            .payment-section h3 {
                font-size: 1.15rem;
            }

            #customCardPaymentFields {
                padding: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation - Matching customer dashboard -->
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
                        <a class="nav-link active" href="{{ route('custom-cake') }}">Custom Cake</a>
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

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-magic"></i> Design Your Dream Cake</h1>
            <p>Create a personalized cake exactly the way you want it</p>
        </div>
    </div>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success mt-4" role="alert" data-auto-dismiss>
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-4" role="alert" data-auto-dismiss>
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <form class="customization-form" action="{{ route('custom-cake.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_name" value="Custom Cake">
                    <input type="hidden" name="total_price" value="0">
                    <input type="hidden" name="advance_amount" value="1500">
                    <input type="hidden" name="status" value="pending">
                    <input type="hidden" name="card_payment_confirmed" id="customCardPaymentConfirmed" value="0">


                    <!-- Size Selection - Text input -->
                    <div class="form-section">
                        <h3>
                            <i class="fas fa-ruler-combined"></i> Size
                            <span class="help-btn" onclick="toggleHelp('sizeHelp')">
                                <i class="fas fa-question"></i>
                            </span>
                        </h3>
                        <div id="sizeHelp" class="help-tooltip">
                            <i class="fas fa-lightbulb"></i> 
                            Enter the size you'd like. For example: 6 inches, 8 inches, 1kg, serves 8-10, etc. Our bakery team will confirm the best options.
                        </div>
                        <input type="text" class="form-control" id="cakeSize" name="cake_size" placeholder="e.g., 6 inches, 1kg, serves 8-10" required oninput="updatePreview()">
                    </div>

                    <!-- Flavor Selection - Text input -->
                    <div class="form-section">
                        <h3>
                            <i class="fas fa-ice-cream"></i> Flavor
                            <span class="help-btn" onclick="toggleHelp('flavorHelp')">
                                <i class="fas fa-question"></i>
                            </span>
                        </h3>
                        <div id="flavorHelp" class="help-tooltip">
                            <i class="fas fa-lightbulb"></i> 
                            Tell us your preferred flavor. Popular choices: Chocolate, Vanilla, Strawberry, Red Velvet, Lemon, Carrot, or any custom flavor!
                        </div>
                        <input type="text" class="form-control" id="cakeFlavor" name="flavor" placeholder="e.g., Chocolate, Vanilla, Red Velvet, or custom" required oninput="updatePreview()">
                    </div>

                    <!-- Frosting Selection - Text input -->
                    <div class="form-section">
                        <h3>
                            <i class="fas fa-fill-drip"></i> Frosting Type
                            <span class="help-btn" onclick="toggleHelp('frostingHelp')">
                                <i class="fas fa-question"></i>
                            </span>
                        </h3>
                        <div id="frostingHelp" class="help-tooltip">
                            <i class="fas fa-lightbulb"></i> 
                            Choose your frosting: Buttercream (classic, sweet), Cream Cheese (tangy, rich), Ganache (chocolate, glossy), Whipped Cream (light, fluffy), or any other preference.
                        </div>
                        <input type="text" class="form-control" id="cakeFrosting" name="frosting" placeholder="e.g., Buttercream, Cream Cheese, Ganache" required oninput="updatePreview()">
                    </div>

                    <!-- Custom Message -->
                    <div class="form-section">
                        <h3><i class="fas fa-font"></i> Cake Message</h3>
                        <textarea class="form-control" id="cakeMessage" name="cake_message" rows="2" placeholder="Write your message here... (e.g., 'Happy Birthday John!')" oninput="updatePreview()"></textarea>
                        <small class="text-muted">Leave empty if no message needed</small>
                    </div>

                    <!-- Upload Design -->
                    <div class="form-section">
                        <h3><i class="fas fa-image"></i> Design Inspiration / Reference</h3>
                        <div class="image-upload" onclick="document.getElementById('designImage').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click to upload your design reference</p>
                            <small>PNG, JPG up to 2MB</small>
                            <input type="file" id="designImage" name="design_image" accept="image/*" style="display: none;" onchange="handleImageUpload()">
                        </div>
                        <div class="uploaded-preview" id="uploadPreview">
                            <img id="previewImg" src="">
                            <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeImage()">Remove</button>
                        </div>
                    </div>

                    <!-- ===== NEW: Delivery Option ===== -->
                    <div class="form-section">
                        <h3>
                            <i class="fas fa-truck"></i> Delivery Option
                            <span class="help-btn" onclick="toggleHelp('deliveryHelp')">
                                <i class="fas fa-question"></i>
                            </span>
                        </h3>
                        <div id="deliveryHelp" class="help-tooltip">
                            <i class="fas fa-lightbulb"></i> 
                            Choose whether you want your cake delivered to your address or prefer to pick it up from our bakery.
                        </div>

                        <div class="delivery-option-group">
                            <div class="delivery-option-btn active" data-option="delivery" onclick="selectDeliveryOption('delivery')">
                                <i class="fas fa-truck"></i>
                                <span class="option-label">Delivery</span>
                                <span class="option-sub">We'll bring it to you</span>
                            </div>
                            <div class="delivery-option-btn" data-option="pickup" onclick="selectDeliveryOption('pickup')">
                                <i class="fas fa-store"></i>
                                <span class="option-label">Pickup</span>
                                <span class="option-sub">Collect from our bakery</span>
                            </div>
                        </div>

                        <!-- Hidden input to store delivery option -->
                        <input type="hidden" id="deliveryOptionHidden" name="delivery_option" value="delivery">

                        <!-- Delivery Address Section (visible when Delivery is selected) -->
                        <div id="deliveryAddressSection" class="delivery-address-section">
                            <div style="margin-top: 1.5rem;">
                                <h5 style="color: #5c3d2e; font-size: 1rem; margin-bottom: 1rem;">
                                    <i class="fas fa-map-pin"></i> Delivery Address
                                </h5>
                                @auth
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="deliveryName" name="customer_name" value="{{ Auth::user()->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="deliveryPhone" name="phone" value="{{ Auth::user()->contact_number ?? '' }}" required>
                                    </div>
                                    <!-- Delivery Address -->
                                    <div id="deliverySection" style="grid-column:1/-1;">

                                        <div style="display:flex; flex-direction:column; gap:0.3rem;">

                                            <label
                                                for="address"
                                                style="font-size:0.8rem; font-weight:600; text-transform:uppercase; letter-spacing:0.03em; color:#6b5b4e;"
                                            >
                                                Delivery Address
                                            </label>

                                            <textarea
                                                name="address"
                                                id="address"
                                                rows="3"
                                                placeholder="Enter your complete delivery address"
                                                oninput="validateDeliveryAddressArea(); updatePreview()"
                                                style="width:100%; padding:0.7rem 1rem; border:1.5px solid #e5dbd1; border-radius:18px; font-size:0.95rem; font-family:inherit; background:#fcfaf8; color:#2c241e; outline:none; resize:vertical;"
                                            ></textarea>
                                            <div id="addressAreaWarning" class="alert alert-warning mt-2 mb-0" style="display:none;"></div>

                                        </div>

                                    </div>

                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="longitude" id="longitude">
                                    <input type="hidden" name="city" id="city">

                                    <!-- Delivery Map -->
                                    <div id="deliveryMapContainer" style="grid-column: 1 / -1;">
                                        <label
                                            style="
                                                font-size:0.8rem;
                                                font-weight:600;
                                                text-transform:uppercase;
                                                letter-spacing:0.03em;
                                                color:#6b5b4e;
                                            "
                                        >
                                            Select Your Delivery Location
                                        </label>

                                        <div
                                            id="deliveryMap"
                                            style="
                                                height:400px;
                                                width:100%;
                                                border-radius:18px;
                                                border:1px solid #e5dbd1;
                                                margin-top:8px;
                                            "
                                        ></div>

                                        <small class="text-muted">
                                            Click on the map to select your delivery location.
                                        </small>

                                        <label for="deliveryAreaSelect" class="form-label mt-3">Or choose your delivery area</label>
                                        <select id="deliveryAreaSelect" class="form-select" onchange="selectDeliveryArea(this.value)">
                                            <option value="">Select a delivery area</option>
                                            <option value="Homagama">Homagama</option>
                                            <option value="Kottawa">Kottawa</option>
                                            <option value="Maharagama">Maharagama</option>
                                            <option value="Godagama">Godagama</option>
                                        </select>
                                    </div>

                                    <div
                                        id="deliveryMessage"
                                        style="grid-column:1 / -1;"
                                    ></div>

                                    <!-- Delivery Validation Message -->
                                    <div
                                        id="deliveryMessage"
                                        style="grid-column:1/-1;"
                                    ></div>



                                <script
                                    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                                    crossorigin=""
                                ></script>

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
                                            document.getElementById('deliveryAreaSelect').value = selectedCity;


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
                                            document.getElementById('deliveryAreaSelect').value = '';


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

                                        updatePreview();
                                        validateDeliveryAddressArea();

                                    }

                                    function validateDeliveryAddressArea() {
                                        const address = document.getElementById('address')?.value || '';
                                        const selectedArea = document.getElementById('city')?.value || '';
                                        const warning = document.getElementById('addressAreaWarning');

                                        if (!warning) {
                                            return true;
                                        }

                                        const areaNames = [
                                            'Homagama',
                                            'Kottawa',
                                            'Maharagama',
                                            'Godagama',
                                            'Colombo',
                                            'Dehiwala',
                                            'Nugegoda',
                                            'Piliyandala',
                                            'Malabe',
                                            'Athurugiriya',
                                            'Padukka'
                                        ];
                                        const mentionedArea = areaNames.find((area) => {
                                            return new RegExp(`\\b${area}\\b`, 'i').test(address);
                                        });

                                        if (mentionedArea && selectedArea && mentionedArea.toLowerCase() !== selectedArea.toLowerCase()) {
                                            warning.innerHTML = `<i class="fas fa-exclamation-triangle"></i> This address mentions <strong>${mentionedArea}</strong>, but the selected delivery area is <strong>${selectedArea}</strong>. Please correct one of them.`;
                                            warning.style.display = 'block';
                                            return false;
                                        }

                                        warning.style.display = 'none';
                                        warning.textContent = '';
                                        return true;
                                    }

                                    function selectDeliveryArea(areaName) {
                                        if (!areaName || !deliveryAreas[areaName]) {
                                            return;
                                        }

                                        const area = deliveryAreas[areaName];
                                        deliveryMap.setView([area.lat, area.lng], 14);
                                        selectDeliveryLocation(area.lat, area.lng);
                                        validateDeliveryAddressArea();
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

                                        const hiddenInput =
                                            document.getElementById('deliveryOptionHidden');

                                        const addressSection =
                                            document.getElementById('deliveryAddressSection');

                                        const mapContainer =
                                            document.getElementById('deliveryMapContainer');


                                        // Save option
                                        hiddenInput.value =
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


                                            document.getElementById('latitude').value = '';

                                            document.getElementById('longitude').value = '';

                                            document.getElementById('city').value = '';
                                            document.getElementById('deliveryAreaSelect').value = '';

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
                                                                'deliveryOptionHidden'
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

                                                        }

                                                    }
                                                );

                                            }


                                            // Make Delivery active initially
                                            selectDeliveryOption('delivery');

                                        }
                                    );

                                </script>

                                @else
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="deliveryName" name="customer_name" placeholder="Enter your full name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="deliveryPhone" name="phone" placeholder="Enter your phone number" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Street Address</label>
                                        <textarea class="form-control" id="deliveryAddress" name="address" rows="2" placeholder="Enter your street address" required></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" id="deliveryCity" name="city" placeholder="City" required>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>

                        <!-- Pickup Info Section (visible when Pickup is selected) -->
                        <div id="pickupInfoSection" class="pickup-info" style="display: none;">
                            <i class="fas fa-store-alt"></i>
                            <h5>Pickup from Our Bakery</h5>
                            <p><strong>Disna Bakery</strong><br>
                            39/A Pitipana North, Uduwana, Homagama<br>
                            <i class="fas fa-phone"></i> 075 593 7147</p>
                            <p style="font-size: 0.85rem; color: #8a7a6e; margin-top: 8px;">
                                <i class="fas fa-clock"></i> Pickup available during store hours<br>
                                Mon-Fri: 8:00 AM - 8:00 PM | Sat-Sun: 9:00 AM - 6:00 PM
                            </p>
                            <input type="hidden" id="pickupAddressHidden" name="address" value="Pickup from bakery" disabled>
                            <input type="hidden" id="pickupCityHidden" name="city" value="Bakery Location" disabled>
                        </div>
                    </div>

                    <!-- Delivery Date - At least two days ahead -->
                    <div class="form-section">
                        <h3><i class="fas fa-calendar-alt"></i> Preferred Delivery / Pickup Date</h3>
                        <input type="date" class="form-control" id="deliveryDate" name="delivery_date" min="{{ now()->addDays(2)->toDateString() }}" required onchange="updatePreview()">
                        <small class="text-muted">Choose a date at least 2 days from today. Each date has a limit of 3 orders.</small>
                    </div>

                    <div class="form-section">
                        <h3><i class="fas fa-notes-medical"></i> Special Instructions</h3>
                        <textarea class="form-control" id="specialNotes" name="special_notes" rows="2" placeholder="Any allergies, color preferences, dietary restrictions, or special instructions..."></textarea>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i>
                        Every custom-cake order requires a <strong>Rs.1500 advance payment</strong>.
                        Our staff will contact you within 24 hours to confirm your order details.
                    </div>

                    <div class="form-section">
                        <h3><i class="fas fa-credit-card"></i> Online Payment</h3>
                        <p class="text-muted">Pay the Rs.1500 advance by card or direct bank transfer. A payment reference is required for bank transfers.</p>
                        <label class="form-label" for="customPaymentMethod">Payment Method</label>
                        <select class="form-select mb-3" id="customPaymentMethod" name="payment_method" required onchange="toggleCustomPaymentFields()">
                            <option value="Card">Card Payment</option>
                            <option value="Bank Transfer">Direct Bank Transfer</option>
                        </select>
                        <div id="customTransactionReferenceFields" class="mb-3">
                            <input type="text" class="form-control" name="transaction_id" maxlength="100" placeholder="Payment reference / transfer reference">
                        </div>

                        <div id="customCardPaymentFields" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Card Type</label>
                                <select class="form-select" name="card_type">
                                    <option value="">Select card</option>
                                    <option value="Visa">Visa</option>
                                    <option value="Mastercard">Mastercard</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Card Number</label>
                                <input type="text" class="form-control" name="card_number" inputmode="numeric" autocomplete="cc-number" maxlength="19" pattern="[0-9 ]{13,19}" placeholder="xxxx xxxx xxxx xxxx">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">CVV</label>
                                <i class="fas fa-circle-info cvv-help"
                                    tabindex="0"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="The 3-digit code on the back of your card">
                                </i>
                                <input type="password" class="form-control" name="cvv" inputmode="numeric" autocomplete="cc-csc" maxlength="4" pattern="[0-9]{3,4}" placeholder="xxx">
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2 fw-bold">
                                    <span>Amount to pay now (advance)</span>
                                    <span>Rs. 1,500</span>
                                </div>
                                <button type="button" id="customPayNowButton" class="btn btn-success w-100" onclick="confirmCustomCardPayment()">
                                    <i class="fas fa-lock"></i> Pay Now
                                </button>
                                <div id="customPaymentSuccess" class="alert alert-success mt-2 mb-0" style="display:none;">
                                    <i class="fas fa-check-circle"></i> Payment successful. You can now submit your custom-cake order.
                                </div>
                            </div>
                        </div>

                        <div id="customBankPaymentDetails" class="alert alert-secondary mt-3" style="display:none;">
                            <strong><i class="fas fa-university"></i> Direct bank transfer details</strong>
                            <div class="mt-2">Bank: <strong>Commercial Bank</strong></div>
                            <div>Account name: <strong>DS Gajanayake   </strong></div>
                            <div>Account number: <strong>3456789546</strong></div>
                            <div>Branch: <strong>Kottawa</strong></div>
                            <small class="d-block mt-2">Transfer the advance and enter the bank transfer reference above.</small>
                        </div>

                        <script>
                            function toggleCustomPaymentFields() {
                                const isCard = document.getElementById('customPaymentMethod').value === 'Card';
                                const cardFields = document.getElementById('customCardPaymentFields');
                                const bankDetails = document.getElementById('customBankPaymentDetails');
                                const referenceFields = document.getElementById('customTransactionReferenceFields');
                                cardFields.style.display = isCard ? 'flex' : 'none';
                                bankDetails.style.display = isCard ? 'none' : 'block';
                                referenceFields.style.display = isCard ? 'none' : 'block';
                                referenceFields.querySelector('input').required = !isCard;
                                cardFields.querySelectorAll('input, select').forEach((field) => {
                                    field.required = isCard;
                                });
                                document.getElementById('customCardPaymentConfirmed').value = '0';
                                document.getElementById('customPaymentSuccess').style.display = 'none';
                                document.getElementById('customPayNowButton').disabled = false;
                                document.getElementById('customPayNowButton').innerHTML = '<i class="fas fa-lock"></i> Pay Now';
                            }

                            function confirmCustomCardPayment() {
                                const cardFields = document.getElementById('customCardPaymentFields');
                                const requiredFields = cardFields.querySelectorAll('input[required], select[required]');
                                if ([...requiredFields].some((field) => !field.checkValidity())) {
                                    requiredFields.forEach((field) => field.reportValidity());
                                    return;
                                }

                                document.getElementById('customCardPaymentConfirmed').value = '1';
                                document.getElementById('customPaymentSuccess').style.display = 'block';
                                document.getElementById('customPayNowButton').innerHTML = '<i class="fas fa-check"></i> Payment Completed';
                                document.getElementById('customPayNowButton').disabled = true;
                            }
                            toggleCustomPaymentFields();
                        </script>
                    </div>

                    <button type="submit" class="btn-submit" onclick="return submitCustomOrder(event)">
                        <i class="fas fa-check-circle"></i> Submit Custom Order
                    </button>
                </form>
            </div>

            <!-- Preview Panel -->
            <div class="col-lg-4">
                <div class="preview-panel">
                    <div class="cake-preview" id="cakePreviewVisual">
                        <i class="fas fa-birthday-cake"></i>
                        <h4>Your Custom Cake</h4>
                        <div id="cakeMessagePreview" style="font-style: italic; margin-top: 10px;"></div>
                    </div>
                    <div class="preview-details">
                        <p><strong><i class="fas fa-ruler-combined"></i> Size:</strong> <span id="previewSize">Not set</span></p>
                        <p><strong><i class="fas fa-ice-cream"></i> Flavor:</strong> <span id="previewFlavor">Not set</span></p>
                        <p><strong><i class="fas fa-fill-drip"></i> Frosting:</strong> <span id="previewFrosting">Not set</span></p>
                        <p><strong><i class="fas fa-font"></i> Message:</strong> <span id="previewMessage">Not added</span></p>
                        <p><strong><i class="fas fa-truck"></i> Option:</strong> <span id="previewDeliveryOption">Delivery</span></p>
                        <p><strong><i class="fas fa-map-marker-alt"></i> Address:</strong> <span id="previewAddress">Select a delivery location</span></p>
                        <p><strong><i class="fas fa-calendar-alt"></i> Date:</strong> <span id="previewDate">Not set</span></p>
                    </div>
                    <button class="btn-preview" onclick="showFullPreview()">
                        <i class="fas fa-eye"></i> View Complete Design
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-birthday-cake"></i> Disna Bakery</h5>
                    <p>Fresh baked goods delivered to your doorstep with love.</p>
                    <div class="social-links">
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-pinterest"></i>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('customer.dashboard') }}" class="text-white text-decoration-none">About Us</a></li>
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
                <p>&copy; {{ date('Y') }} Disna Bakery. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle help tooltips
        function toggleHelp(id) {
            const tooltip = document.getElementById(id);
            if (tooltip) {
                tooltip.classList.toggle('show');
            }
        }

        // Close tooltips when clicking elsewhere
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.help-btn') && !e.target.closest('.help-tooltip')) {
                document.querySelectorAll('.help-tooltip').forEach(t => t.classList.remove('show'));
            }
        });

        // ===== NEW: Delivery Option Selection =====
        function selectDeliveryOption(option) {
            // Update active state on buttons
            document.querySelectorAll('.delivery-option-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`.delivery-option-btn[data-option="${option}"]`).classList.add('active');

            // Update hidden input
            document.getElementById('deliveryOptionHidden').value = option;

            // Show/hide address section
            const addressSection = document.getElementById('deliveryAddressSection');
            const pickupSection = document.getElementById('pickupInfoSection');
            const mapContainer = document.getElementById('deliveryMapContainer');
            const addressField = document.getElementById('address');
            const pickupAddress = document.getElementById('pickupAddressHidden');
            const pickupCity = document.getElementById('pickupCityHidden');

            if (option === 'delivery') {
                addressSection.classList.remove('hidden');
                addressSection.style.display = 'block';
                pickupSection.style.display = 'none';
                mapContainer.style.display = 'block';
                addressField.required = true;
                pickupAddress.disabled = true;
                pickupCity.disabled = true;
                // Make address fields required
                document.querySelectorAll('#deliveryAddressSection input, #deliveryAddressSection textarea').forEach(el => {
                    el.required = true;
                });
            } else {
                addressSection.classList.add('hidden');
                addressSection.style.display = 'none';
                pickupSection.style.display = 'block';
                mapContainer.style.display = 'none';
                addressField.required = false;
                pickupAddress.disabled = false;
                pickupCity.disabled = false;
                document.getElementById('latitude').value = '';
                document.getElementById('longitude').value = '';
                document.getElementById('city').value = '';
                // Make address fields not required
                document.querySelectorAll('#deliveryAddressSection input, #deliveryAddressSection textarea').forEach(el => {
                    el.required = false;
                });
            }

            updatePreview();

            if (option === 'delivery' && deliveryMap) {
                setTimeout(() => deliveryMap.invalidateSize(), 200);
            }
        }

        // Image Upload Preview
        function handleImageUpload() {
            const input = document.getElementById('designImage');
            if(input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('previewImg').src = event.target.result;
                    document.getElementById('uploadPreview').style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            document.getElementById('designImage').value = '';
            document.getElementById('uploadPreview').style.display = 'none';
            document.getElementById('previewImg').src = '';
        }

        // Update Preview Panel
        function updatePreview() {
            const size = document.getElementById('cakeSize')?.value || 'Not set';
            const flavor = document.getElementById('cakeFlavor')?.value || 'Not set';
            const frosting = document.getElementById('cakeFrosting')?.value || 'Not set';
            const message = document.getElementById('cakeMessage')?.value || '';
            const deliveryOption = document.getElementById('deliveryOptionHidden')?.value || 'delivery';
            const deliveryDate = document.getElementById('deliveryDate')?.value;
            const address = deliveryOption === 'delivery'
                ? document.getElementById('address')?.value.trim()
                : 'Pickup from bakery';
            const city = deliveryOption === 'delivery'
                ? document.getElementById('city')?.value.trim()
                : 'Bakery Location';

            document.getElementById('previewSize').innerText = size;
            document.getElementById('previewFlavor').innerText = flavor;
            document.getElementById('previewFrosting').innerText = frosting;
            document.getElementById('previewDeliveryOption').innerText = deliveryOption === 'delivery' ? 'Delivery' : 'Pickup';
            const previewAddress = document.getElementById('previewAddress');
            if (previewAddress) {
                previewAddress.innerText = deliveryOption === 'delivery'
                    ? (address && city ? `${address}, ${city}` : 'Select a delivery location')
                    : 'Disna Bakery, Kottawa';
            }

            if(message.trim()) {
                document.getElementById('previewMessage').innerHTML = `"${message.substring(0, 40)}${message.length > 40 ? '...' : ''}"`;
                document.getElementById('cakeMessagePreview').innerHTML = `<i class="fas fa-quote-left"></i> ${message.substring(0, 40)}${message.length > 40 ? '...' : ''}`;
            } else {
                document.getElementById('previewMessage').innerHTML = 'Not added';
                document.getElementById('cakeMessagePreview').innerHTML = '';
            }

            if(deliveryDate) {
                document.getElementById('previewDate').innerHTML = new Date(deliveryDate).toLocaleDateString('en-US', {
                    weekday: 'short',
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            } else {
                document.getElementById('previewDate').innerHTML = 'Not set';
            }
        }

        // Full Preview Modal
        function showFullPreview() {
            const size = document.getElementById('cakeSize')?.value || 'Not specified';
            const flavor = document.getElementById('cakeFlavor')?.value || 'Not specified';
            const frosting = document.getElementById('cakeFrosting')?.value || 'Not specified';
            const message = document.getElementById('cakeMessage')?.value || 'No message';
            const deliveryOption = document.getElementById('deliveryOptionHidden')?.value || 'delivery';
            const deliveryDate = document.getElementById('deliveryDate')?.value || 'Not set';
            const previewImg = document.getElementById('previewImg')?.src;

            let addressInfo = 'Pickup from bakery';
            if (deliveryOption === 'delivery') {
                const addr = document.getElementById('address')?.value || 'Not provided';
                const city = document.getElementById('city')?.value || '';
                addressInfo = `${addr}, ${city}`;
            }

            const specialNotes = document.getElementById('specialNotes')?.value || 'None';

            let previewHtml = `
                <div style="background: white; border-radius: 20px; padding: 25px; max-width: 500px; margin: 0 auto;">
                    <div style="background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%); border-radius: 15px; padding: 30px; text-align: center; color: white;">
                        <i class="fas fa-birthday-cake" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">Your Custom Cake Design</h4>
                        ${previewImg && previewImg !== '#' ? `<img src="${previewImg}" style="max-width: 150px; border-radius: 10px; margin-top: 10px;">` : ''}
                        ${message !== 'No message' ? `<div class="mt-3" style="font-style: italic;">"${message}"</div>` : ''}
                    </div>
                    <div style="padding: 20px;">
                        <table style="width: 100%;">
                            <tr><td style="padding: 5px;"><strong>Size:</strong></td><td>${size}</td></tr>
                            <tr><td style="padding: 5px;"><strong>Flavor:</strong></td><td>${flavor}</td></tr>
                            <tr><td style="padding: 5px;"><strong>Frosting:</strong></td><td>${frosting}</td></tr>
                            <tr><td style="padding: 5px;"><strong>Delivery Option:</strong></td><td>${deliveryOption === 'delivery' ? '🚚 Delivery' : '🏪 Pickup'}</td></tr>
                            <tr><td style="padding: 5px;"><strong>Date:</strong></td><td>${deliveryDate !== 'Not set' ? new Date(deliveryDate).toLocaleDateString('en-US', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' }) : 'Not set'}</td></tr>
                            <tr><td style="padding: 5px;"><strong>Address:</strong></td><td>${addressInfo}</td></tr>
                            <tr><td style="padding: 5px;"><strong>Special Notes:</strong></td><td>${specialNotes}</td></tr>
                        </table>
                    </div>
                </div>
            `;

            const modalHtml = `
                <div id="previewModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; display: flex; align-items: center; justify-content: center; overflow-y: auto; padding: 20px;">
                    <div style="position: relative; max-width: 800px; width: 95%; max-height: 85vh; overflow-y: auto;">
                        ${previewHtml}
                        <button onclick="closeModal()" 
                            style="
                                position: absolute;
                                top: 10px;
                                right: 10px;
                                background: #fff;
                                border: none;
                                border-radius: 50%;
                                width: 40px;
                                height: 40px;
                                font-size: 24px;
                                cursor: pointer;
                                box-shadow: 0 2px 8px rgba(0,0,0,0.2);
                                z-index: 10000;">
                                &times;
                        </button>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', modalHtml);
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('previewModal');
            if(modal) modal.remove();
            document.body.style.overflow = '';
        }

        // Submit Order
        function submitCustomOrder(event) {
            const size = document.getElementById('cakeSize')?.value.trim();
            const flavor = document.getElementById('cakeFlavor')?.value.trim();
            const frosting = document.getElementById('cakeFrosting')?.value.trim();
            const deliveryOption = document.getElementById('deliveryOptionHidden')?.value || 'delivery';
            const deliveryDate = document.getElementById('deliveryDate')?.value;
            const paymentMethod = document.getElementById('customPaymentMethod')?.value;

            if (paymentMethod === 'Card' && document.getElementById('customCardPaymentConfirmed')?.value !== '1') {
                alert('Please click Pay Now after entering your card details.');
                event.preventDefault();
                return false;
            }

            if(!size) {
                alert('Please enter the cake size you prefer.');
                document.getElementById('cakeSize')?.focus();
                event.preventDefault();
                return false;
            }

            if(!flavor) {
                alert('Please enter the cake flavor you prefer.');
                document.getElementById('cakeFlavor')?.focus();
                event.preventDefault();
                return false;
            }

            if(!frosting) {
                alert('Please enter the frosting type you prefer.');
                document.getElementById('cakeFrosting')?.focus();
                event.preventDefault();
                return false;
            }

            if(deliveryOption === 'delivery') {
                const name = document.getElementById('deliveryName')?.value.trim();
                const phone = document.getElementById('deliveryPhone')?.value.trim();
                const address = document.getElementById('address')?.value.trim();
                const city = document.getElementById('city')?.value.trim();

                if(!name || !phone) {
                    alert('Please enter your name and phone number for delivery.');
                    event.preventDefault();
                    return false;
                }

                if(!address) {
                    alert('Please enter your delivery street address.');
                    document.getElementById('address')?.focus();
                    event.preventDefault();
                    return false;
                }

                if (!validateDeliveryAddressArea()) {
                    alert('The typed address does not match the selected delivery area.');
                    event.preventDefault();
                    return false;
                }

                const latitude = document.getElementById('latitude')?.value;
                const longitude = document.getElementById('longitude')?.value;

                if(!latitude || !longitude || !city) {
                    alert('Please select your delivery location on the map. This confirms that your address is inside our delivery area.');
                    event.preventDefault();
                    return false;
                }

                const selectedCity = findDeliveryArea(Number(latitude), Number(longitude));

                if (!selectedCity || selectedCity !== city) {
                    alert('This location is outside our delivery area. Please select a location inside Homagama, Kottawa, Maharagama, or Godagama.');
                    event.preventDefault();
                    return false;
                }
            }

            if(!deliveryDate) {
                alert('Please select a preferred date.');
                document.getElementById('deliveryDate')?.focus();
                event.preventDefault();
                return false;
            }

            return true;
        }

        // Initialize preview and set default delivery date to today
        document.addEventListener('DOMContentLoaded', function() {
            // Set default delivery date to today
            const dateInput = document.getElementById('deliveryDate');
            if(dateInput && !dateInput.value) {
                dateInput.value = dateInput.min;
            }
            updatePreview();
        });
    </script>
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