<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Disna Bakery | Admin Dashboard</title>
       
    <!-- logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Font Awesome 6 (free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap 5 CSS (lightweight, used for grid & modal structure but custom dark) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0f0c0a;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            overflow-x: hidden;
        }

        /* custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #2a241f;
        }
        ::-webkit-scrollbar-thumb {
            background: #f59e0b;
            border-radius: 10px;
        }

        /* sidebar - dark bakery theme */
        .sidebar {
            background: linear-gradient(145deg, #1e1814 0%, #0f0b09 100%);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            color: #f5efe8;
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            z-index: 1050;
            box-shadow: 8px 0 25px rgba(0, 0, 0, 0.5);
            border-right: 1px solid rgba(245, 158, 11, 0.2);
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 28px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(245, 158, 11, 0.25);
            background: rgba(0,0,0,0.2);
        }
        .sidebar-header i {
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));
        }
        .sidebar-header h4 {
            margin-top: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            background: linear-gradient(135deg, #fcd34d, #f59e0b);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .sidebar-header small {
            color: #d4a373;
            font-size: 0.8rem;
        }

        .sidebar-menu {
            padding: 20px 12px;
        }
        .sidebar-menu .menu-item {
            padding: 14px 18px;
            margin: 6px 0;
            border-radius: 14px;
            transition: all 0.25s;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 500;
            color: #e2dcd5;
        }
        .sidebar-menu .menu-item i {
            width: 26px;
            font-size: 1.25rem;
            text-align: center;
        }
        .sidebar-menu .menu-item:hover {
            background: rgba(245, 158, 11, 0.18);
            color: #fcd34d;
            transform: translateX(6px);
        }
        .sidebar-menu .menu-item.active {
            background: linear-gradient(95deg, rgba(245, 158, 11, 0.25), rgba(245, 158, 11, 0.05));
            border-left: 4px solid #f59e0b;
            color: #ffde9c;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        /* main content area */
        .main-content {
            margin-left: 280px;
            padding: 24px 28px;
            background: #0e0b09;
            min-height: 100vh;
            transition: margin 0.3s;
        }

        /* top navbar with glassmorphic effect */
        .top-navbar {
            background: rgba(30, 24, 20, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 14px 26px;
            margin-bottom: 32px;
            border: 1px solid rgba(245, 158, 11, 0.3);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        .top-navbar h4 {
            font-weight: 700;
            background: linear-gradient(135deg, #fff0db, #fcd34d);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .user-info {
            background: #221c17;
            padding: 8px 16px;
            border-radius: 40px;
            font-weight: 500;
        }

        /* STAT CARDS - bakery dark style */
        .stat-card {
            background: #1c1612;
            border-radius: 28px;
            padding: 20px;
            margin-bottom: 24px;
            border: 1px solid rgba(245, 158, 11, 0.25);
            transition: all 0.25s ease;
            cursor: pointer;
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.4);
        }
        .stat-card:hover {
            transform: translateY(-6px);
            border-color: #f59e0b;
            background: #231d18;
            box-shadow: 0 20px 30px -10px rgba(245,158,11,0.2);
        }
        .stat-card .icon {
            font-size: 2.4rem;
            margin-bottom: 12px;
        }
        .stat-card .number {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #fcd34d;
        }
        .stat-card div:not(.number) {
            color: #cfc6bc;
            font-weight: 500;
        }

        /* tables & data cards */
        .data-table {
            background: #1b1612;
            border-radius: 28px;
            padding: 20px 24px;
            border: 1px solid rgba(245, 158, 11, 0.2);
            box-shadow: 0 8px 18px rgba(0,0,0,0.3);
            transition: all 0.2s;
        }
        .data-table h5, .data-table h4 {
            color: #fcd34d;
            font-weight: 700;
        }
        .table {
            color: #f0e7de;
            margin-bottom: 0;
        }
        .table thead th {
            border-bottom-width: 1px;
            border-color: rgba(245, 158, 11, 0.3);
            color: #f59e0b;
            font-weight: 600;
        }
        .table td, .table th {
            border-top-color: rgba(255,255,255,0.05);
            vertical-align: middle;
        }
        .badge-status {
            padding: 5px 14px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            background: rgba(0,0,0,0.4);
        }
        .btn-action {
            border-radius: 30px;
            padding: 5px 12px;
            font-size: 0.75rem;
            transition: all 0.2s;
        }
        .btn-warning-custom {
            background: #f59e0b;
            border: none;
            color: #1f140e;
            font-weight: 600;
        }
        .btn-warning-custom:hover {
            background: #fbbf24;
            transform: scale(1.02);
        }
        .btn-outline-amber {
            border: 1px solid #f59e0b;
            color: #f59e0b;
            background: transparent;
        }
        .btn-outline-amber:hover {
            background: #f59e0b;
            color: #1a0f0a;
        }
        .form-select, .form-control {
            background-color: #2c241f;
            border: 1px solid #4a3a30;
            color: #f5e6da;
            border-radius: 18px;
        }
        .form-select:focus, .form-control:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.3);
        }

        /* responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 260px;
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                padding: 20px 16px;
            }
            .top-navbar {
                padding: 10px 16px;
            }
        }
        @media (max-width: 768px) {
            .stat-card .number {
                font-size: 1.6rem;
            }
            .data-table {
                padding: 16px;
                overflow-x: auto;
            }
            .table {
                min-width: 600px;
            }
        }

        .modal-content {
            background: #1e1712;
            border: 1px solid #f59e0b;
            border-radius: 28px;
        }
        .modal-header {
            border-bottom-color: rgba(245,158,11,0.3);
        }
        .modal-footer {
            border-top-color: rgba(245,158,11,0.2);
        }
        button.close-btn-light {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #fcd34d;
        }

        /* charts canvas */
        canvas {
            max-height: 260px;
            width: 100%;
        }
        .text-gold {
            color: #f59e0b;
        }

        /* Breeze Dropdown Styles */
        .dropdown-container {
            position: relative;
            display: inline-block;
        }
        .dropdown-toggle-btn {
            background: transparent;
            border: none;
            color: #f5efe8;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 12px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            font-size: 0.95rem;
        }
        .dropdown-toggle-btn:hover {
            background: rgba(245, 158, 11, 0.15);
            color: #fcd34d;
        }
        .dropdown-toggle-btn i {
            font-size: 1.3rem;
        }
        .dropdown-menu-breeze {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: #1e1612;
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 16px;
            min-width: 200px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }
        .dropdown-menu-breeze.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown-menu-breeze a,
        .dropdown-menu-breeze form {
            display: block;
        }
        .dropdown-menu-breeze a {
            color: #f0e7de;
            padding: 12px 20px;
            text-decoration: none;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
        }
        .dropdown-menu-breeze a:hover {
            background: rgba(245, 158, 11, 0.15);
            color: #fcd34d;
            padding-left: 24px;
        }
        .dropdown-menu-breeze a:first-child {
            border-radius: 16px 16px 0 0;
        }
        .dropdown-menu-breeze form {
            padding: 0;
        }
        .dropdown-menu-breeze form button {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            color: #f0e7de;
            padding: 12px 20px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
        }
        .dropdown-menu-breeze form button:hover {
            background: rgba(245, 158, 11, 0.15);
            color: #fcd34d;
            padding-left: 24px;
        }
        .dropdown-menu-breeze form button:last-child {
            border-radius: 0 0 16px 16px;
            border-top: 1px solid rgba(245, 158, 11, 0.2);
            color: #ef4444;
        }
        .dropdown-menu-breeze form button:last-child:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
        }
        .dropdown-divider-breeze {
            height: 1px;
            background: rgba(245, 158, 11, 0.2);
            margin: 6px 0;
        }
    </style>
</head>
<body>

<div style="display: flex; position: relative;">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo.png') }}" alt="Bakery Logo" width="40" height="40">
            <h4>Disna Bakery</h4>
            <small><i class="fas fa-shield-alt"></i> Admin Command</small>
        </div>
        <div class="sidebar-menu">
            <div class="menu-item active" data-section="dashboard">
                <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
            </div>
            <div class="menu-item" data-section="products">
                <i class="fas fa-cake-candles"></i> <span>Products</span>
            </div>
            <div class="menu-item" data-section="categories">
                <i class="fas fa-tags"></i> <span>Categories</span>
            </div>
            <div class="menu-item" data-section="orders">
                <i class="fas fa-shopping-cart"></i> <span>Orders</span>
            </div>
            <div class="menu-item" data-section="customers">
                <i class="fas fa-users"></i> <span>Customers</span>
            </div>
            <div class="menu-item" data-section="reports">
                <i class="fas fa-chart-line"></i> <span>Reports</span>
            </div>
            <div class="menu-item" data-section="delivery_person">
                <i class="fas fa-truck"></i> <span>Add Delivery Person</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- TOP NAVBAR - WITH BREEZE DROPDOWN -->
        <div class="top-navbar d-flex justify-content-between align-items-center">
            <div>
                <button class="btn btn-outline-secondary d-md-none" onclick="toggleSidebar()" style="border-color: #f59e0b; color: #f59e0b;">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="d-inline-block ms-2" id="pageTitle">Dashboard</h4>
            </div>

            <div class="dropdown-container">
                <button class="dropdown-toggle-btn" id="userDropdownToggle">
                    <i class="fas fa-user-circle"></i>
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down" style="font-size: 0.75rem; transition: transform 0.2s;"></i>
                </button>
                <div class="dropdown-menu-breeze" id="userDropdownMenu">
                    <a href="{{ route('profile.edit') }}">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                    <div class="dropdown-divider-breeze"></div>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- DASHBOARD SECTION -->
        <div id="dashboardSection">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card"><div class="icon"><i class="fas fa-chart-line"></i></div><div class="number">$15,234</div><div>Total Sales</div><small class="text-success"><i class="fas fa-arrow-up"></i> +12% from last month</small></div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card"><div class="icon"><i class="fas fa-shopping-cart"></i></div><div class="number">234</div><div>Total Orders</div><small class="text-success"><i class="fas fa-arrow-up"></i> +8 new today</small></div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card"><div class="icon"><i class="fas fa-users"></i></div><div class="number">1,234</div><div>Total Customers</div><small class="text-success"><i class="fas fa-arrow-up"></i> +45 this week</small></div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card"><div class="icon"><i class="fas fa-cake"></i></div><div class="number">45</div><div>Products</div><small class="text-warning"><i class="fas fa-exclamation-triangle"></i> 5 low stock</small></div>
                </div>
            </div>
            <div class="row g-4 mt-1">
                <div class="col-md-4"><div class="stat-card"><div class="icon"><i class="fas fa-crown"></i></div><div class="number">2</div><div>Administrators</div></div></div>
                <div class="col-md-4"><div class="stat-card"><div class="icon"><i class="fas fa-user-friends"></i></div><div class="number">1,198</div><div>Customers</div></div></div>
                <div class="col-md-4"><div class="stat-card"><div class="icon"><i class="fas fa-truck"></i></div><div class="number">8</div><div>Delivery Personnel</div></div></div>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-xl-8">
                    <div class="data-table">
                        <h5 class="mb-3"><i class="fas fa-clock text-gold"></i> Recent Orders</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead><tr><th>Order #</th><th>Customer</th><th>Amount</th><th>Status</th><th>Action</th></tr></thead>
                                <tbody>
                                    <tr><td>#ORD-101</td><td>John Doe</td><td>$45.00</td><td><span class="badge-status" style="background:#facc15;color:#5b3a0a;">Pending</span></td><td><button class="btn btn-sm btn-action btn-warning-custom" onclick="viewOrder('ORD-101')">View</button></td></tr>
                                    <tr><td>#ORD-102</td><td>Jane Smith</td><td>$32.50</td><td><span class="badge-status" style="background:#4ade80;color:#14532d;">Delivered</span></td><td><button class="btn btn-sm btn-action btn-warning-custom" onclick="viewOrder('ORD-102')">View</button></td></tr>
                                    <tr><td>#ORD-103</td><td>Mike Johnson</td><td>$78.90</td><td><span class="badge-status" style="background:#60a5fa;color:#1e3a8a;">Processing</span></td><td><button class="btn btn-sm btn-action btn-warning-custom" onclick="viewOrder('ORD-103')">View</button></td></tr>
                                    <tr><td>#ORD-104</td><td>Emily Davis</td><td>$124.30</td><td><span class="badge-status" style="background:#facc15;color:#5b3a0a;">Pending</span></td><td><button class="btn btn-sm btn-action btn-warning-custom" onclick="viewOrder('ORD-104')">View</button></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="data-table h-100">
                        <h5 class="mb-3"><i class="fas fa-chart-simple text-gold"></i> Top Selling Products</h5>
                        <canvas id="topProductsChart" style="height:200px; width:100%"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- products section -->
        <div id="productsSection" style="display: none;">
            <div class="data-table">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-2"><h5><i class="fas fa-cake-candles text-gold"></i> Product Management</h5><button class="btn btn-warning-custom" onclick="showProductModal()"><i class="fas fa-plus"></i> Add Product</button></div>
                <div class="table-responsive"><table class="table"><thead><tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead><tbody>
                    <tr><td><i class="fas fa-image fa-2x text-gold"></i></td><td>Chocolate Fudge Cake</td><td>Cakes</td><td>$28.99</td><td>15</td><td><span class="badge bg-success">Active</span></td><td><button class="btn btn-sm btn-warning-custom"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td></tr>
                    <tr><td><i class="fas fa-image fa-2x text-gold"></i></td><td>Vanilla Dream Cupcake</td><td>Cupcakes</td><td>$3.99</td><td>48</td><td><span class="badge bg-success">Active</span></td><td><button class="btn btn-sm btn-warning-custom"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td></tr>
                    <tr><td><i class="fas fa-image fa-2x text-gold"></i></td><td>Butter Croissant</td><td>Pastries</td><td>$4.50</td><td>22</td><td><span class="badge bg-warning">Low Stock</span></td><td><button class="btn btn-sm btn-warning-custom"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td></tr>
                </tbody></table></div>
            </div>
        </div>

        <!-- categories section -->
        <div id="categoriesSection" style="display: none;">
            <div class="data-table">
                <div class="d-flex justify-content-between mb-4">
                    <h5><i class="fas fa-tags text-gold"></i> Categories</h5>

                    @if (session('success'))
                        <div class="alert alert-success mb-0 py-2 px-3" style="border-radius: 999px;">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif
                    <!-- OPEN MODAL -->
                    <button type="button"
                        class="btn btn-warning-custom"
                        data-bs-toggle="modal"
                        data-bs-target="#categoryModal">
                        + Add Category
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Products</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>0</td>
                                    <td>
                                        <!-- EDIT BUTTON -->
                                        <button class="btn btn-sm btn-warning-custom"
                                            onclick="editCategory(
                                                {{ $category->id }},
                                                '{{ $category->name }}',
                                                '{{ $category->description }}'
                                            )"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- DELETE -->
                                        <form action="{{ route('categories.destroy', $category->id) }}"
                                            method="POST"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No Categories Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Category Modal -->
        <div class="modal fade" id="categoryModal" tabindex="-1">
        <div class="modal-dialog">

            <div class="modal-content">

                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h5>Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="text"
                            name="name"
                            class="form-control mb-2"
                            placeholder="Category Name"
                            required>

                        <textarea name="description"
                            class="form-control"
                            placeholder="Description"></textarea>

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit"
                            class="btn btn-warning-custom">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>

        <!-- Edit Category Modal -->
         <div class="modal fade" id="editCategoryModal" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="POST" id="editCategoryForm">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5>Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" id="edit_id">

                        <input type="text"
                            name="name"
                            id="edit_name"
                            class="form-control mb-2">

                        <textarea name="description"
                            id="edit_description"
                            class="form-control"></textarea>

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit"
                            class="btn btn-warning-custom">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>


        <!-- orders section -->
        <div id="ordersSection" style="display: none;"><div class="data-table"><h5><i class="fas fa-shopping-cart text-gold"></i> All Orders</h5><div class="table-responsive"><table class="table"><thead><tr><th>Order #</th><th>Customer</th><th>Date</th><th>Total</th><th>Status</th><th>Update Status</th></tr></thead><tbody><tr><td>#ORD-101</td><td>John Doe</td><td>2024-11-20</td><td>$45.00</td><td><span class="badge-status bg-warning text-dark">Pending</span></td><td><select class="form-select form-select-sm" style="width:130px;" onchange="updateOrderStatus(this, 'ORD-101')"><option>Pending</option><option>Processing</option><option>Delivered</option></select></td></tr><tr><td>#ORD-102</td><td>Jane Smith</td><td>2024-11-19</td><td>$32.50</td><td><span class="badge-status bg-success">Delivered</span></td><td><select class="form-select form-select-sm" style="width:130px;" onchange="updateOrderStatus(this, 'ORD-102')"><option>Pending</option><option>Processing</option><option selected>Delivered</option></select></td></tr></tbody></table></div></div></div>

        <!-- custom cakes -->
        <div id="customCakesSection" style="display: none;"><div class="data-table"><h5><i class="fas fa-magic text-gold"></i> Custom Cake Orders</h5><div class="table-responsive"><table class="table"><thead><tr><th>Customer</th><th>Size</th><th>Flavor</th><th>Message</th><th>Delivery Date</th><th>Status</th><th>Action</th></tr></thead><tbody><tr><td>Sarah Wilson</td><td>Medium</td><td>Chocolate</td><td>Happy Birthday!</td><td>2024-11-25</td><td><span class="badge-status bg-warning">Pending</span></td><td><button class="btn btn-sm btn-warning-custom" onclick="approveCustomCake()">Approve</button></td></tr><tr><td>Tom Brown</td><td>Large</td><td>Vanilla</td><td>Wedding Cake</td><td>2024-12-01</td><td><span class="badge-status bg-info">Approved</span></td><td><button class="btn btn-sm btn-outline-amber">View</button></td></tr></tbody></table></div></div></div>

        <!-- customers section -->
        <div id="customersSection" style="display: none;">
            <div class="data-table">
                <h5>
                    <i class="fas fa-users text-gold"></i>
                    Customer Management
                </h5>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Joined</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->contact_number ?? 'N/A' }}</td>
                                    <td>{{ $customer->created_at->format('Y-m-d') }}</td>

                                    <td>
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No customers found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- reports section -->
        <div id="reportsSection" style="display: none;"><div class="row g-4"><div class="col-md-6"><div class="data-table"><h5><i class="fas fa-chart-line text-gold"></i> Sales Trend</h5><canvas id="salesChart" style="height:220px"></canvas></div></div><div class="col-md-6"><div class="data-table"><h5>📊 Monthly Summary</h5><table class="table"><tr><td>Total Sales (This Month):</td><td class="text-end fw-bold text-gold">$5,234</td></tr><tr><td>Total Orders:</td><td class="text-end fw-bold">78</td></tr><tr><td>Average Order Value:</td><td class="text-end fw-bold">$67.10</td></tr><tr><td>Custom Cakes:</td><td class="text-end fw-bold">12</td></tr></table></div></div></div></div>
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="productModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-dark border-warning"><h5 class="modal-title text-gold"><i class="fas fa-plus-circle"></i> New Product</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body"><input class="form-control mb-3" placeholder="Product Name"><select class="form-select mb-3"><option>Cakes</option><option>Pastries</option><option>Cupcakes</option></select><input class="form-control mb-3" placeholder="Price"><input class="form-control mb-3" placeholder="Stock"><textarea class="form-control" rows="2" placeholder="Description"></textarea></div><div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-warning-custom" onclick="alert('✅ Product saved!')">Save</button></div></div></div></div>
<div class="modal fade" id="categoryModal"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-dark"><h5 class="text-gold">New Category</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div><div class="modal-body"><input class="form-control mb-3" placeholder="Category Name"><textarea class="form-control" placeholder="Description"></textarea></div><div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button class="btn btn-warning-custom" onclick="alert('Category added')">Create</button></div></div></div></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Dropdown toggle functionality
    const userDropdownToggle = document.getElementById('userDropdownToggle');
    const userDropdownMenu = document.getElementById('userDropdownMenu');
    const dropdownChevron = userDropdownToggle.querySelector('.fa-chevron-down');

    userDropdownToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        userDropdownMenu.classList.toggle('show');
        if (dropdownChevron) {
            dropdownChevron.style.transform = userDropdownMenu.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0deg)';
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.dropdown-container')) {
            userDropdownMenu.classList.remove('show');
            if (dropdownChevron) {
                dropdownChevron.style.transform = 'rotate(0deg)';
            }
        }
    });

    // Close dropdown when clicking menu items
    userDropdownMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            userDropdownMenu.classList.remove('show');
            if (dropdownChevron) {
                dropdownChevron.style.transform = 'rotate(0deg)';
            }
        });
    });

    // charts init
    let topChart, salesChart;
    window.addEventListener('load', () => {
        const topCtx = document.getElementById('topProductsChart')?.getContext('2d');
        if(topCtx) {
            topChart = new Chart(topCtx, {
                type: 'bar', data: { labels: ['Choc Cake', 'Cupcakes', 'Croissant', 'Red Velvet'], datasets: [{ label: 'Sold', data: [45, 78, 52, 38], backgroundColor: '#f59e0b', borderRadius: 10 }] },
                options: { responsive: true, maintainAspectRatio: true }
            });
        }
        const salesCtx = document.getElementById('salesChart')?.getContext('2d');
        if(salesCtx) {
            salesChart = new Chart(salesCtx, {
                type: 'line', data: { labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], datasets: [{ label: 'Revenue $', data: [3200, 4500, 3800, 5200, 4800, 6234], borderColor: '#f59e0b', backgroundColor: 'rgba(245,158,11,0.1)', fill: true, tension: 0.3 }] },
                options: { responsive: true, maintainAspectRatio: true }
            });
        }
    });

    function showSection(sectionId) {
        const sections = ['dashboardSection','productsSection','categoriesSection','ordersSection','customCakesSection','customersSection','reportsSection'];
        sections.forEach(sec => document.getElementById(sec).style.display = 'none');
        if(sectionId === 'logout') { if(confirm('Logout from Bakery admin?')) window.location.href = "{{ route('logout') }}"; return; }
        document.getElementById(sectionId + 'Section').style.display = 'block';
        let title = sectionId.replace('-',' ').replace(/(^\w|\s\w)/g, m => m.toUpperCase());
        document.getElementById('pageTitle').innerText = title;
        document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('active'));
        document.querySelector(`.menu-item[data-section="${sectionId}"]`).classList.add('active');
    }

    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', (e) => {
            const section = item.getAttribute('data-section');
            if(section) showSection(section);
        });
    });

    function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
    document.getElementById('mobileMenuToggle')?.addEventListener('click', toggleSidebar);
    window.showProductModal = () => new bootstrap.Modal(document.getElementById('productModal')).show();
    window.showCategoryModal = () => new bootstrap.Modal(document.getElementById('categoryModal')).show();
    window.approveCustomCake = () => alert('✨ Custom cake order approved! Customer will be notified.');
    window.updateOrderStatus = (select, orderId) => alert(`✅ Order ${orderId} status → ${select.value}`);
    window.viewOrder = (id) => alert(`🔍 View order details: ${id}`);

    // Edit Category Function
    function editCategory(id, name, description) {

        document.getElementById('edit_name').value = name;
        document.getElementById('edit_description').value = description;

        document.getElementById('editCategoryForm').action =
            "/categories/" + id;
    }
</script>
</body>
</html>