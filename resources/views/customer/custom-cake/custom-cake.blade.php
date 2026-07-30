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

        .dark .customization-form {
            background: #1f2937;
            color: #f3f4f6;
        }

        .form-section {
            margin-bottom: 35px;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(212, 163, 115, 0.2);
        }

        .form-section h3 {
            color: #5c3d2e;
            margin-bottom: 20px;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .dark .form-section h3 {
            color: #fcd34d;
        }

        .size-option, .flavor-option {
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            margin-bottom: 15px;
            background: white;
        }

        .dark .size-option, .dark .flavor-option {
            background: #374151;
            border-color: #4b5563;
            color: #f3f4f6;
        }

        .size-option:hover, .flavor-option:hover {
            border-color: #d4a373;
            background: #fff8f0;
        }

        .dark .size-option:hover, .dark .flavor-option:hover {
            background: #d4a37320;
            border-color: #fcd34d;
        }

        .size-option.selected, .flavor-option.selected {
            border-color: #d4a373;
            background: linear-gradient(135deg, #d4a37320 0%, #b5835a20 100%);
            box-shadow: 0 5px 15px rgba(212, 163, 115, 0.2);
        }

        .size-option i, .flavor-option i {
            font-size: 2rem;
            color: #d4a373;
            margin-bottom: 10px;
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

        .dark .preview-panel {
            background: #1f2937;
            color: #f3f4f6;
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

        .dark .preview-details {
            background: #374151;
        }

        .preview-details p {
            margin-bottom: 10px;
            padding: 5px 0;
            border-bottom: 1px dashed #ddd;
        }

        .dark .preview-details p {
            border-bottom-color: #4b5563;
        }

        .price-preview {
            font-size: 2rem;
            font-weight: bold;
            color: #d4a373;
            margin: 15px 0;
        }

        .dark .price-preview {
            color: #fcd34d;
        }

        .btn-preview, .btn-submit {
            background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%);
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            color: white;
            font-weight: bold;
            transition: all 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .btn-preview:hover, .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(180, 130, 80, 0.4);
        }

        .btn-outline-preview {
            background: transparent;
            border: 2px solid #d4a373;
            color: #b5835a;
        }

        .dark .btn-outline-preview {
            color: #fcd34d;
            border-color: #fcd34d;
        }

        .btn-outline-preview:hover {
            background: #d4a373;
            color: white;
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

        .dark .image-upload {
            background: #374151;
            border-color: #fcd34d;
        }

        .image-upload:hover {
            background: #fff0e0;
            border-color: #b5835a;
        }

        .dark .image-upload:hover {
            background: #d4a37320;
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
        }
    </style>
</head>
<body>
    <!-- Navigation - Matching customer dashboard -->
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
                        <a class="nav-link" href="{{ route('custom-products.customer') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('custom-cake') }}">Custom Cake</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cart-badge" href="#">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <span class="cart-count">0</span>
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
            <h1><i class="fas fa-magic"></i> Design Your Dream Cake</h1>
            <p>Create a personalized cake exactly the way you want it</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <form class="customization-form" action="{{ route('custom-cake.store') }}" method="POST" enctype="multipart/form-data">

                  @csrf
                    <!-- Size Selection -->
                    <div class="form-section">
                        <h3><i class="fas fa-ruler-combined"></i> Select Size</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="size-option selected" data-size="Small" data-price="25" data-serves="4-6 people" onclick="selectSize(this)">
                                    <i class="fas fa-birthday-cake"></i>
                                    <h5>Small</h5>
                                    <p>Serves 4-6</p>
                                    <strong>Rs.2000</strong>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="size-option" data-size="Medium" data-price="45" data-serves="8-10 people" onclick="selectSize(this)">
                                    <i class="fas fa-birthday-cake"></i>
                                    <h5>Medium</h5>
                                    <p>Serves 8-10</p>
                                    <strong>Rs.3000</strong>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="size-option" data-size="Large" data-price="65" data-serves="12-15 people" onclick="selectSize(this)">
                                    <i class="fas fa-birthday-cake"></i>
                                    <h5>Large</h5>
                                    <p>Serves 12-15</p>
                                    <strong>Rs.6000</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Flavor Selection -->
                    <div class="form-section">
                        <h3><i class="fas fa-ice-cream"></i> Choose Flavor</h3>
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="flavor-option selected" data-flavor="Chocolate" onclick="selectFlavor(this)">
                                    <i class="fas fa-chocolate-bar"></i>
                                    <h6>Chocolate</h6>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="flavor-option" data-flavor="Vanilla" onclick="selectFlavor(this)">
                                    <i class="fas fa-ice-cream"></i>
                                    <h6>Vanilla</h6>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="flavor-option" data-flavor="Strawberry" onclick="selectFlavor(this)">
                                    <i class="fas fa-strawberry"></i>
                                    <h6>Strawberry</h6>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="flavor-option" data-flavor="Red Velvet" onclick="selectFlavor(this)">
                                    <i class="fas fa-heart"></i>
                                    <h6>Red Velvet</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Frosting Selection -->
                    <div class="form-section">
                        <h3><i class="fas fa-fill-drip"></i> Frosting Type</h3>
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="flavor-option selected" data-frosting="Buttercream" onclick="selectFrosting(this)">
                                    <i class="fas fa-cloud"></i>
                                    <h6>Buttercream</h6>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="flavor-option" data-frosting="Cream Cheese" onclick="selectFrosting(this)">
                                    <i class="fas fa-cheese"></i>
                                    <h6>Cream Cheese</h6>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="flavor-option" data-frosting="Ganache" onclick="selectFrosting(this)">
                                    <i class="fas fa-chocolate-bar"></i>
                                    <h6>Ganache</h6>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="flavor-option" data-frosting="Whipped Cream" onclick="selectFrosting(this)">
                                    <i class="fas fa-whiskey-glass"></i>
                                    <h6>Whipped Cream</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Custom Message -->
                    <div class="form-section">
                        <h3><i class="fas fa-font"></i> Cake Message</h3>
                        <textarea class="form-control" id="cakeMessage" rows="2" placeholder="Write your message here... (e.g., 'Happy Birthday John!', 'Congratulations!')"></textarea>
                        <small class="text-muted">Leave empty if no message needed</small>
                    </div>

                    <!-- Upload Design -->
                    <div class="form-section">
                        <h3><i class="fas fa-image"></i> Design Inspiration / Reference</h3>
                        <div class="image-upload" onclick="document.getElementById('designImage').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click to upload your design reference</p>
                            <small>PNG, JPG up to 2MB</small>
                            <input type="file" id="designImage" accept="image/*" style="display: none;">
                        </div>
                        <div class="uploaded-preview" id="uploadPreview">
                            <img id="previewImg" src="">
                            <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeImage()">Remove</button>
                        </div>
                    </div>

                    <!-- Delivery Address -->
                    <div class="form-section">
                        <h3><i class="fas fa-map-marker-alt"></i> Delivery Address</h3>
                        @auth
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="deliveryName" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="deliveryPhone" value="{{ Auth::user()->contact_number ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Street Address</label>
                                <textarea class="form-control" id="deliveryAddress" rows="2" required>{{ Auth::user()->address ?? '' }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" id="deliveryCity" value="{{ Auth::user()->city ?? '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="deliveryPostal" placeholder="e.g., 12345">
                                </div>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="deliveryName" placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="deliveryPhone" placeholder="Enter your phone number" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Street Address</label>
                                <textarea class="form-control" id="deliveryAddress" rows="2" placeholder="Enter your street address" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" id="deliveryCity" placeholder="City" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="deliveryPostal" placeholder="Postal code">
                                </div>
                            </div>
                        @endauth
                    </div>

                    <!-- Delivery Date & Notes -->
                    <div class="form-section">
                        <h3><i class="fas fa-calendar-alt"></i> Preferred Delivery Date</h3>
                        <input type="date" class="form-control" id="deliveryDate" min="{{ date('Y-m-d', strtotime('+2 days')) }}" required>
                        <small class="text-muted">Please allow at least 2 days for custom cake preparation</small>
                    </div>

                    <div class="form-section">
                        <h3><i class="fas fa-notes-medical"></i> Special Instructions</h3>
                        <textarea class="form-control" id="specialNotes" rows="2" placeholder="Any allergies, color preferences, dietary restrictions, or special instructions..."></textarea>
                    </div>

                    <button type="button" class="btn-submit" onclick="submitCustomOrder()">
                        <i class="fas fa-check-circle"></i> Submit Custom Order
                    </button>
                </form>
            </div>

            <!-- Cake Preview Panel -->
            <div class="col-lg-4">
                <div class="preview-panel">
                    <div class="cake-preview" id="cakePreviewVisual">
                        <i class="fas fa-birthday-cake"></i>
                        <h4>Your Custom Cake</h4>
                        <div id="cakeMessagePreview" style="font-style: italic; margin-top: 10px;"></div>
                    </div>
                    <div class="preview-details">
                        <p><strong><i class="fas fa-ruler-combined"></i> Size:</strong> <span id="previewSize">Small</span> <span id="previewServes">(Serves 4-6)</span></p>
                        <p><strong><i class="fas fa-ice-cream"></i> Flavor:</strong> <span id="previewFlavor">Chocolate</span></p>
                        <p><strong><i class="fas fa-fill-drip"></i> Frosting:</strong> <span id="previewFrosting">Buttercream</span></p>
                        <p><strong><i class="fas fa-font"></i> Message:</strong> <span id="previewMessage">Not added</span></p>
                        <p><strong><i class="fas fa-calendar-alt"></i> Delivery:</strong> <span id="previewDate">Not set</span></p>
                    </div>
                    <div class="price-preview">
                        Total: Rs.<span id="previewPrice">2000</span>.00
                    </div>
                    <button class="btn-preview btn-outline-preview" onclick="showFullPreview()">
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
    <script>
        // Store current selections
        let currentSelection = {
            size: 'Small',
            price: 25,
            serves: 'Serves 4-6',
            flavor: 'Chocolate',
            frosting: 'Buttercream',
            message: '',
            imageData: null
        };

        // Size Selection
        function selectSize(element) {
            document.querySelectorAll('.size-option').forEach(opt => opt.classList.remove('selected'));
            element.classList.add('selected');
            
            currentSelection.size = element.getAttribute('data-size');
            currentSelection.price = parseInt(element.getAttribute('data-price'));
            currentSelection.serves = element.getAttribute('data-serves');
            
            updatePreview();
        }

        // Flavor Selection
        function selectFlavor(element) {
            document.querySelectorAll('.flavor-option').forEach(opt => opt.classList.remove('selected'));
            element.classList.add('selected');
            
            currentSelection.flavor = element.getAttribute('data-flavor');
            updatePreview();
        }

        // Frosting Selection
        function selectFrosting(element) {
            document.querySelectorAll('.flavor-option').forEach(opt => opt.classList.remove('selected'));
            element.classList.add('selected');
            
            currentSelection.frosting = element.getAttribute('data-frosting');
            updatePreview();
        }

        // Update Preview Panel
        function updatePreview() {
            document.getElementById('previewSize').innerText = currentSelection.size;
            document.getElementById('previewServes').innerHTML = `(Serves ${currentSelection.serves.split(' ')[0]})`;
            document.getElementById('previewFlavor').innerText = currentSelection.flavor;
            document.getElementById('previewFrosting').innerText = currentSelection.frosting;
            document.getElementById('previewPrice').innerText = currentSelection.price;
            
            const message = document.getElementById('cakeMessage').value;
            if(message.trim()) {
                document.getElementById('previewMessage').innerHTML = `"${message.substring(0, 30)}"`;
                document.getElementById('cakeMessagePreview').innerHTML = `<i class="fas fa-quote-left"></i> ${message.substring(0, 40)}`;
            } else {
                document.getElementById('previewMessage').innerHTML = 'Not added';
                document.getElementById('cakeMessagePreview').innerHTML = '';
            }
            
            const deliveryDate = document.getElementById('deliveryDate').value;
            if(deliveryDate) {
                document.getElementById('previewDate').innerHTML = new Date(deliveryDate).toLocaleDateString();
            } else {
                document.getElementById('previewDate').innerHTML = 'Not set';
            }
        }

        // Image Upload Preview
        document.getElementById('designImage').addEventListener('change', function(e) {
            if(e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('previewImg').src = event.target.result;
                    document.getElementById('uploadPreview').style.display = 'block';
                    currentSelection.imageData = event.target.result;
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        function removeImage() {
            document.getElementById('designImage').value = '';
            document.getElementById('uploadPreview').style.display = 'none';
            document.getElementById('previewImg').src = '';
            currentSelection.imageData = null;
        }

        // Real-time message update
        document.getElementById('cakeMessage').addEventListener('input', updatePreview);
        document.getElementById('deliveryDate').addEventListener('change', updatePreview);

        // Full Preview Modal
        function showFullPreview() {
            const message = document.getElementById('cakeMessage').value || 'No message';
            const address = document.getElementById('deliveryAddress')?.value || 'Not provided';
            const city = document.getElementById('deliveryCity')?.value || '';
            const specialNotes = document.getElementById('specialNotes')?.value || 'None';
            
            let previewHtml = `
                <div style="background: white; border-radius: 20px; padding: 25px; max-width: 500px; margin: 0 auto;">
                    <div style="background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%); border-radius: 15px; padding: 30px; text-align: center; color: white;">
                        <i class="fas fa-birthday-cake" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">Your Custom Cake Design</h4>
                        ${currentSelection.imageData ? `<img src="${currentSelection.imageData}" style="max-width: 150px; border-radius: 10px; margin-top: 10px;">` : ''}
                        ${message !== 'No message' ? `<div class="mt-3" style="font-style: italic;">"${message}"</div>` : ''}
                    </div>
                    <div style="padding: 20px;">
                        <table style="width: 100%;">
                            <tr><td style="padding: 5px;"><strong>Size:</strong></td><td>${currentSelection.size}</td></tr>
                            <tr><td style="padding: 5px;"><strong>Flavor:</strong></td><td>${currentSelection.flavor}</td></tr>
                            <tr><td style="padding: 5px;"><strong>Frosting:</strong></td><td>${currentSelection.frosting}</td></tr>
                            <tr><td style="padding: 5px;"><strong>Delivery Address:</strong></td><td>${address}, ${city}</td></tr>
                            <tr><td style="padding: 5px;"><strong>Special Notes:</strong></td><td>${specialNotes}</td></tr>
                            <tr><td style="padding: 5px;"><strong>Total Price:</strong></td><td style="color: #d4a373; font-weight: bold;">$${currentSelection.price}.00</td></tr>
                        </table>
                    </div>
                </div>
            `;
            
            const modalHtml = `
                <div id="previewModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; display: flex; align-items: center; justify-content: center; overflow-y: auto;">
                    <div style="position: relative; max-width: 800px; width: 95%; max-height: 85vh ; overflow-y: auto;">
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
        function submitCustomOrder() {
            // Validate required fields
            const name = document.getElementById('deliveryName')?.value;
            const phone = document.getElementById('deliveryPhone')?.value;
            const address = document.getElementById('deliveryAddress')?.value;
            const city = document.getElementById('deliveryCity')?.value;
            const deliveryDate = document.getElementById('deliveryDate')?.value;
            
            if(!name || !phone || !address || !city) {
                alert('Please fill in all delivery address fields.');
                return;
            }
            
            if(!deliveryDate) {
                alert('Please select a preferred delivery date.');
                return;
            }
            
            const orderDetails = {
                size: currentSelection.size,
                flavor: currentSelection.flavor,
                frosting: currentSelection.frosting,
                message: document.getElementById('cakeMessage').value,
                specialNotes: document.getElementById('specialNotes').value,
                deliveryName: name,
                deliveryPhone: phone,
                deliveryAddress: address,
                deliveryCity: city,
                deliveryPostal: document.getElementById('deliveryPostal')?.value,
                deliveryDate: deliveryDate,
                totalPrice: currentSelection.price,
                hasDesignImage: !!currentSelection.imageData
            };
            
            console.log('Order Submitted:', orderDetails);
            
            alert(`🎉 Thank you for your custom cake order!\n\nOrder Summary:\n• ${currentSelection.size} ${currentSelection.flavor} Cake\n• Frosting: ${currentSelection.frosting}\n• Delivery Date: ${new Date(deliveryDate).toLocaleDateString()}\n• Total: $${currentSelection.price}.00\n\nWe will contact you within 24 hours to confirm your order details.`);
            
            // Reset form if needed
            // window.location.href = '/'; // Uncomment to redirect
        }

        // Initialize preview on load
        document.addEventListener('DOMContentLoaded', function() {
            updatePreview();
            
            // Set default delivery date (3 days from now)
            const defaultDate = new Date();
            defaultDate.setDate(defaultDate.getDate() + 3);
            const dateInput = document.getElementById('deliveryDate');
            if(dateInput && !dateInput.value) {
                dateInput.value = defaultDate.toISOString().split('T')[0];
                updatePreview();
            }
        });
    </script>
</body>
</html>