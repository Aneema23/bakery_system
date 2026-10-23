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

        /* ===== SIDEBAR ===== */
        .sidebar {
            background: linear-gradient(180deg, #1e1814 0%, #0f0b09 100%);
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
            overflow-x: hidden;
        }

        .sidebar-header {
            padding: 28px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(245, 158, 11, 0.25);
            background: rgba(0,0,0,0.2);
        }
        .sidebar-header img {
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));
            transition: transform 0.3s ease;
        }
        .sidebar-header img:hover {
            transform: rotate(-8deg) scale(1.05);
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
            margin: 4px 0;
            border-radius: 14px;
            transition: all 0.25s;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 500;
            color: #e2dcd5;
            position: relative;
            overflow: hidden;
        }
        .sidebar-menu .menu-item i {
            width: 26px;
            font-size: 1.25rem;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .sidebar-menu .menu-item:hover i {
            transform: scale(1.15);
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
        .sidebar-menu .menu-item.active i {
            color: #f59e0b;
        }
        .sidebar-menu .menu-item .badge-menu {
            margin-left: auto;
            background: #f59e0b;
            color: #1a0f0a;
            font-size: 0.65rem;
            padding: 2px 10px;
            border-radius: 40px;
            font-weight: 700;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 280px;
            padding: 24px 28px;
            background: #0e0b09;
            min-height: 100vh;
            transition: margin 0.3s;
        }

        /* ===== TOP NAVBAR ===== */
        .top-navbar {
            background: rgba(30, 24, 20, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
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

        /* ===== STAT CARDS ===== */
        .stat-card {
            background: #1c1612;
            border-radius: 28px;
            padding: 20px;
            margin-bottom: 24px;
            border: 1px solid rgba(245, 158, 11, 0.25);
            transition: all 0.25s ease;
            cursor: pointer;
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.4);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #f59e0b, #fcd34d);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .stat-card:hover::before {
            opacity: 1;
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
            display: inline-block;
            background: rgba(245, 158, 11, 0.15);
            padding: 10px;
            border-radius: 16px;
            color: #f59e0b;
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

        /* ===== DATA TABLES ===== */
        .data-table {
            background: #1b1612;
            border-radius: 28px;
            padding: 20px 24px;
            border: 1px solid rgba(245, 158, 11, 0.2);
            box-shadow: 0 8px 18px rgba(0,0,0,0.3);
            transition: all 0.2s;
        }
        .data-table:hover {
            border-color: rgba(245, 158, 11, 0.4);
        }
        .data-table h5, .data-table h4 {
            color: #fcd34d;
            font-weight: 700;
        }
        
        .order-board {
            display: grid;
            grid-template-columns: repeat(5, minmax(210px, 1fr));
            gap: 1rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }
        
        .order-lane {
            min-height: 360px;
            padding: 0.85rem;
            border: 1px solid rgba(245, 158, 11, 0.2);
            border-radius: 14px;
            background: #241c17;
            transition: border-color 0.2s, background 0.2s;
        }
        
        .order-lane.drag-over {
            border-color: #f59e0b;
            background: #302219;
        }
        
        .order-lane-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
            color: #fcd34d;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .order-lane-count {
            min-width: 1.5rem;
            padding: 0.2rem 0.45rem;
            border-radius: 999px;
            background: rgba(245, 158, 11, 0.16);
            color: #fbbf24;
            text-align: center;
            font-size: 0.7rem;
        }
        
        .admin-order-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.65rem;
            margin-bottom: 0.7rem;
            padding: 0.8rem;
            border: 1px solid rgba(245, 158, 11, 0.18);
            border-radius: 10px;
            background: #33271f;
            cursor: grab;
            transition: transform 0.2s, border-color 0.2s;
        }
        
        .admin-order-card:hover {
            border-color: rgba(245, 158, 11, 0.55);
            transform: translateY(-2px);
        }
        
        .admin-order-card.dragging {
            opacity: 0.45;
            cursor: grabbing;
        }
        
        .admin-order-id {
            color: #f0e7de;
            font-weight: 700;
            white-space: nowrap;
        }
        
        .admin-view-order {
            border: 1px solid rgba(245, 158, 11, 0.55);
            border-radius: 6px;
            padding: 0.35rem 0.55rem;
            background: transparent;
            color: #fcd34d;
            font-size: 0.72rem;
            font-weight: 700;
            white-space: nowrap;
        }
        
        .admin-view-order:hover {
            background: #f59e0b;
            color: #241c17;
        }
        
        .order-board-empty {
            color: #8f8176;
            font-size: 0.78rem;
            text-align: center;
        }
        
        @media (max-width: 1400px) {
            .order-board {
                grid-template-columns: repeat(5, minmax(190px, 1fr));
            }
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
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
        .table td, .table th {
            border-top-color: rgba(255,255,255,0.05);
            vertical-align: middle;
        }
        .table tbody tr {
            transition: background 0.2s ease;
        }
        .table tbody tr:hover {
            background: rgba(245, 158, 11, 0.05);
        }
        .product-crud-panel {
            background: linear-gradient(180deg, rgba(33, 26, 21, 0.98), rgba(23, 18, 15, 0.98));
            border: 1px solid rgba(245, 158, 11, 0.22);
            border-radius: 24px;
            box-shadow: 0 18px 32px rgba(0, 0, 0, 0.25);
        }
        .product-crud-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 12px;
            flex-wrap: wrap;
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
            transition: all 0.3s ease;
        }
        .btn-warning-custom:hover {
            background: #fbbf24;
            transform: scale(1.02);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }
        .btn-outline-amber {
            border: 1px solid #f59e0b;
            color: #f59e0b;
            background: transparent;
            transition: all 0.3s ease;
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

        /* ===== MODAL ===== */
        .modal-content {
            background: #1e1712;
            border: 1px solid #f59e0b;
            border-radius: 28px;
            color: #f5e6da;
        }
        .modal-header {
            border-bottom-color: rgba(245,158,11,0.3);
        }
        .modal-footer {
            border-top-color: rgba(245,158,11,0.2);
        }
        #productModal .modal-header,
        #editProductModal .modal-header {
            background: linear-gradient(135deg, rgba(46, 30, 22, 0.98), rgba(26, 18, 14, 0.98));
            border-bottom: 1px solid rgba(245, 158, 11, 0.28);
        }
        #productModal .modal-title,
        #editProductModal .modal-title,
        #productModal h5,
        #editProductModal h5 {
            color: #fcd34d;
            font-weight: 700;
            letter-spacing: 0.02em;
        }
        #productModal label,
        #editProductModal label {
            display: block;
            margin-bottom: 0.45rem;
            color: #fcd34d;
            font-weight: 600;
            font-size: 0.88rem;
            letter-spacing: 0.02em;
        }
        #productModal .form-control,
        #productModal .form-select,
        #editProductModal .form-control,
        #editProductModal .form-select {
            background-color: #2f251f;
            border: 1px solid rgba(245, 158, 11, 0.28);
            border-radius: 14px;
            color: #fff7ed;
            min-height: 46px;
            padding: 0.7rem 0.9rem;
            transition: all 0.25s ease;
        }
        #productModal .form-control::placeholder,
        #editProductModal .form-control::placeholder {
            color: #d8c2ad;
            opacity: 1;
        }
        #productModal .form-control:focus,
        #productModal .form-select:focus,
        #editProductModal .form-control:focus,
        #editProductModal .form-select:focus {
            background-color: #3b2b25;
            border-color: rgba(245, 158, 11, 0.7);
            box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.18);
            color: #fff7ed;
        }
        #productModal textarea.form-control,
        #editProductModal textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        #productModal option,
        #editProductModal option {
            background: #34271f;
            color: #fff7ed;
        }
        #productModal .modal-footer,
        #editProductModal .modal-footer {
            border-top: 1px solid rgba(245, 158, 11, 0.18);
            padding-top: 1rem;
        }
        .success-alert {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #111827;
            border-radius: 999px;
        }
        button.close-btn-light {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #fcd34d;
        }

        /* ===== CHARTS ===== */
        canvas {
            max-height: 260px;
            width: 100%;
        }
        .text-gold {
            color: #f59e0b;
        }

        /* ===== DROPDOWN ===== */
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

        /* ===== MOBILE TOGGLE BUTTON ===== */
        .mobile-toggle {
            display: none;
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #f59e0b;
            padding: 8px 14px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .mobile-toggle:hover {
            background: rgba(245, 158, 11, 0.25);
        }

        /* ===== RESPONSIVE MEDIA QUERIES ===== */
        /* Tablet & Small Laptops */
        @media (max-width: 1200px) {
            .stat-card .number {
                font-size: 1.6rem;
            }
            .stat-card .icon {
                font-size: 2rem;
            }
        }

        /* Tablets & Medium Screens */
        @media (max-width: 992px) {
            .sidebar {
                width: 260px;
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
                box-shadow: 8px 0 40px rgba(0, 0, 0, 0.7);
            }
            .main-content {
                margin-left: 0;
                padding: 16px;
            }
            .top-navbar {
                padding: 12px 16px;
                border-radius: 20px;
            }
            .mobile-toggle {
                display: inline-block;
            }
            .stat-card .number {
                font-size: 1.5rem;
            }
        }

        /* Mobile Phones */
        @media (max-width: 768px) {
            .sidebar {
                width: 280px;
            }
            .main-content {
                padding: 12px;
            }
            .top-navbar {
                padding: 10px 14px;
                border-radius: 16px;
                flex-wrap: wrap;
                gap: 10px;
            }
            .top-navbar h4 {
                font-size: 1.1rem;
            }
            .stat-card {
                padding: 16px;
                border-radius: 20px;
            }
            .stat-card .number {
                font-size: 1.4rem;
            }
            .stat-card .icon {
                font-size: 1.6rem;
                padding: 8px;
            }
            .data-table {
                padding: 14px 16px;
                border-radius: 20px;
                overflow-x: auto;
            }
            .data-table h5 {
                font-size: 1rem;
            }
            .table {
                min-width: 600px;
                font-size: 0.85rem;
            }
            .table thead th {
                font-size: 0.65rem;
            }
            .modal-content {
                border-radius: 20px;
            }
            .dropdown-toggle-btn span {
                display: none;
            }
            .dropdown-toggle-btn {
                padding: 8px 10px;
            }
            .dropdown-menu-breeze {
                min-width: 160px;
                right: -10px;
            }
            .btn-warning-custom, .btn-outline-amber {
                font-size: 0.75rem;
                padding: 6px 12px;
            }
            .badge-status {
                font-size: 0.6rem;
                padding: 3px 10px;
            }
            .container-fluid {
                padding: 0;
            }
        }

        /* Small Mobile Phones */
        @media (max-width: 480px) {
            .sidebar {
                width: 100%;
                max-width: 320px;
            }
            .sidebar-header h4 {
                font-size: 1.2rem;
            }
            .sidebar-menu .menu-item {
                padding: 12px 16px;
                font-size: 0.9rem;
            }
            .sidebar-menu .menu-item i {
                font-size: 1.1rem;
                width: 22px;
            }
            .main-content {
                padding: 8px;
            }
            .top-navbar {
                padding: 8px 12px;
                border-radius: 14px;
            }
            .top-navbar h4 {
                font-size: 0.95rem;
            }
            .stat-card {
                padding: 14px;
                border-radius: 16px;
                margin-bottom: 16px;
            }
            .stat-card .number {
                font-size: 1.2rem;
            }
            .stat-card .icon {
                font-size: 1.4rem;
                padding: 6px;
                margin-bottom: 8px;
            }
            .stat-card div:not(.number) {
                font-size: 0.85rem;
            }
            .data-table {
                padding: 12px;
                border-radius: 16px;
            }
            .data-table h5 {
                font-size: 0.9rem;
            }
            .btn-warning-custom, .btn-outline-amber {
                font-size: 0.7rem;
                padding: 4px 10px;
            }
            .modal-body {
                padding: 1rem;
            }
            .modal-header h5 {
                font-size: 1rem;
            }
        }

        /* Landscape Mobile */
        @media (max-height: 600px) and (orientation: landscape) {
            .sidebar {
                overflow-y: auto;
            }
            .sidebar-header {
                padding: 16px 20px;
            }
            .sidebar-header h4 {
                margin-top: 6px;
                font-size: 1.1rem;
            }
            .sidebar-menu {
                padding: 10px 12px;
            }
            .sidebar-menu .menu-item {
                padding: 8px 14px;
                margin: 2px 0;
            }
            .stat-card .number {
                font-size: 1.2rem;
            }
            .top-navbar {
                padding: 8px 14px;
                margin-bottom: 16px;
            }
        }

        /* Print Styles */
        @media print {
            .sidebar {
                display: none;
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
                background: white;
            }
            .top-navbar {
                background: white !important;
                border: 1px solid #ddd !important;
            }
            .stat-card {
                border: 1px solid #ddd !important;
                background: white !important;
            }
            .stat-card .number {
                color: #333 !important;
            }
            .data-table {
                border: 1px solid #ddd !important;
                background: white !important;
            }
            .data-table h5 {
                color: #333 !important;
            }
            .table {
                color: #333 !important;
            }
            .table thead th {
                color: #333 !important;
            }
            .btn-warning-custom, .btn-outline-amber {
                display: none !important;
            }
            .modal-overlay {
                display: none !important;
            }
            .dropdown-container {
                display: none !important;
            }
        }

        /* ===== CUSTOMER DASHBOARD THEME ===== */
        body {
            background: #f8f9fa;
            color: #2c241f;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        ::-webkit-scrollbar-track {
            background: #f7efe9;
        }

        ::-webkit-scrollbar-thumb {
            background: #d4a373;
        }

        .sidebar {
            background: linear-gradient(180deg, #fffaf4 0%, #f7efe9 100%);
            color: #60453a;
            box-shadow: 8px 0 25px rgba(83, 55, 40, 0.1);
            border-right: 1px solid #eadfd4;
        }

        .sidebar-header {
            border-bottom: 1px solid #eadfd4;
            background: rgba(255, 255, 255, 0.65);
        }

        .sidebar-header img {
            filter: drop-shadow(0 4px 6px rgba(83, 55, 40, 0.15));
        }

        .sidebar-header h4 {
            background: linear-gradient(135deg, #d4a373, #b5835a);
            -webkit-background-clip: text;
            background-clip: text;
        }

        .sidebar-header small {
            color: #8a7a6e;
        }

        .sidebar-menu .menu-item {
            color: #60453a;
        }

        .sidebar-menu .menu-item:hover {
            background: #fff0e6;
            color: #bd6545;
            transform: translateX(4px);
        }

        .sidebar-menu .menu-item.active {
            background: linear-gradient(95deg, #fff0e6, #fffaf4);
            border-left-color: #d4a373;
            color: #bd6545;
            box-shadow: 0 4px 12px rgba(212, 163, 115, 0.12);
        }

        .sidebar-menu .menu-item.active i {
            color: #d4a373;
        }

        .sidebar-menu .menu-item .badge-menu {
            background: #d4a373;
            color: white;
        }

        .main-content {
            background: linear-gradient(180deg, #fffaf4 0%, #f8f9fa 100%);
        }

        .top-navbar {
            background: rgba(255, 255, 255, 0.88);
            border-color: #eadfd4;
            box-shadow: 0 8px 20px rgba(83, 55, 40, 0.08);
        }

        .top-navbar h4 {
            background: linear-gradient(135deg, #60453a, #bd6545);
            -webkit-background-clip: text;
            background-clip: text;
        }

        .user-info {
            background: #fff0e6;
            color: #60453a;
        }

        .dropdown-toggle-btn {
            color: #60453a;
        }

        .dropdown-toggle-btn:hover {
            background: #fff0e6;
            color: #bd6545;
        }

        .dropdown-menu-breeze {
            background: #fffaf4;
            border-color: #eadfd4;
            box-shadow: 0 12px 30px rgba(83, 55, 40, 0.16);
        }

        .dropdown-menu-breeze a,
        .dropdown-menu-breeze form button {
            color: #60453a;
        }

        .dropdown-menu-breeze a:hover,
        .dropdown-menu-breeze form button:hover {
            background: #fff0e6;
            color: #bd6545;
        }

        .dropdown-menu-breeze form button:last-child {
            border-top-color: #eadfd4;
        }

        .stat-card,
        .data-table,
        .product-crud-panel {
            background: #ffffff;
            border-color: #eadfd4;
            box-shadow: 0 5px 20px rgba(83, 55, 40, 0.08);
        }

        .stat-card:hover {
            background: #fffaf4;
            border-color: #d4a373;
            box-shadow: 0 12px 28px rgba(212, 163, 115, 0.18);
        }

        .stat-card::before {
            background: linear-gradient(90deg, #d4a373, #b5835a);
        }

        .stat-card .icon {
            background: #fff0e6;
            color: #d4a373;
        }

        .stat-card .number,
        .data-table h5,
        .data-table h4 {
            color: #5c3d2e;
        }

        .stat-card div:not(.number) {
            color: #6c5b4a;
        }

        .table {
            color: #4a3930;
        }

        .table thead th {
            border-color: #eadfd4;
            color: #b5835a;
        }

        .table td,
        .table th {
            border-top-color: #f1e7df;
        }

        .table tbody tr:hover {
            background: #fffaf4;
        }

        .order-lane {
            background: #fffaf4;
            border-color: #eadfd4;
        }

        .order-lane.drag-over {
            border-color: #d4a373;
            background: #fff0e6;
        }

        .order-lane-title {
            color: #5c3d2e;
        }

        .order-lane-count {
            background: #fff0e6;
            color: #bd6545;
        }

        .admin-order-card {
            background: #ffffff;
            border-color: #eadfd4;
            box-shadow: 0 3px 10px rgba(83, 55, 40, 0.05);
        }

        .admin-order-card:hover {
            border-color: #d4a373;
        }

        .admin-order-id {
            color: #60453a;
        }

        .admin-view-order {
            border-color: #d4a373;
            color: #b5835a;
        }

        .admin-view-order:hover {
            background: #d4a373;
            color: white;
        }

        .order-board-empty {
            color: #8a7a6e;
        }

        .form-select,
        .form-control {
            background-color: #ffffff;
            border-color: #e8ddd2;
            color: #4a3930;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #d4a373;
            box-shadow: 0 0 0 0.2rem rgba(212, 163, 115, 0.2);
        }

        .modal-content {
            background: #fffaf4;
            border-color: #d4a373;
            color: #4a3930;
        }

        .modal-header,
        .modal-footer {
            border-color: #eadfd4;
        }

        #productModal .modal-header,
        #editProductModal .modal-header {
            background: linear-gradient(135deg, #fff0e6, #fffaf4);
            border-bottom-color: #eadfd4;
        }

        #productModal .modal-title,
        #editProductModal .modal-title,
        #productModal h5,
        #editProductModal h5,
        #productModal label,
        #editProductModal label {
            color: #5c3d2e;
        }

        #productModal .form-control,
        #productModal .form-select,
        #editProductModal .form-control,
        #editProductModal .form-select {
            background-color: #ffffff;
            border-color: #e8ddd2;
            color: #4a3930;
        }

        #productModal .form-control::placeholder,
        #editProductModal .form-control::placeholder {
            color: #8a7a6e;
        }

        #productModal .form-control:focus,
        #productModal .form-select:focus,
        #editProductModal .form-control:focus,
        #editProductModal .form-select:focus {
            background-color: #ffffff;
            border-color: #d4a373;
            box-shadow: 0 0 0 0.2rem rgba(212, 163, 115, 0.2);
            color: #4a3930;
        }

        #productModal option,
        #editProductModal option {
            background: #ffffff;
            color: #4a3930;
        }

        .btn-warning-custom {
            background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%);
            color: white;
        }

        .btn-warning-custom:hover {
            background: linear-gradient(135deg, #bd8d61 0%, #9d6d48 100%);
            box-shadow: 0 5px 15px rgba(180, 130, 80, 0.25);
        }

        .btn-outline-amber {
            border-color: #d4a373;
            color: #b5835a;
        }

        .btn-outline-amber:hover {
            background: #d4a373;
            color: white;
        }

        .mobile-toggle {
            background: #fff0e6;
            border-color: #eadfd4;
            color: #b5835a;
        }

        .mobile-toggle:hover {
            background: #f7e3d5;
        }

        .text-gold {
            color: #b5835a !important;
        }

        .modal .p-3[style*="background:#2a221d"] {
            background: #fff0e6 !important;
            color: #4a3930;
        }

        .modal .p-3[style*="background:#2a221d"] strong {
            color: #5c3d2e;
        }

        /* ===== COMPACT ADMIN SHELL ===== */
        .sidebar {
            width: 220px;
        }

        .sidebar-header {
            padding: 20px 14px;
        }

        .sidebar-header img {
            width: 40px;
            height: 40px;
        }

        .sidebar-header h4 {
            margin-top: 8px;
            font-size: 1.1rem;
        }

        .sidebar-header small {
            font-size: 0.7rem;
        }

        .sidebar-menu {
            padding: 14px 10px;
        }

        .sidebar-menu .menu-item {
            padding: 11px 12px;
            gap: 10px;
            font-size: 0.88rem;
        }

        .sidebar-menu .menu-item i {
            width: 22px;
            font-size: 1.05rem;
        }

        .sidebar-menu .menu-item .badge-menu {
            padding: 2px 7px;
        }

        .main-content {
            width: calc(100% - 220px);
            margin-left: 220px;
            padding: 20px 22px;
        }

        .top-navbar {
            margin-bottom: 24px;
            padding: 12px 20px;
        }

        .data-table {
            min-width: 0;
        }

        .order-board {
            grid-template-columns: repeat(5, minmax(0, 1fr));
            overflow-x: visible;
        }

        .admin-order-card {
            min-width: 0;
            flex-wrap: wrap;
        }

        /* ============================================
        REPORTS SECTION – USER-FRIENDLY DESIGN
        ============================================ */

        .inventory-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.25rem;
        }

        .inventory-heading p {
            color: #8a7a6e;
            margin: 0.35rem 0 0;
            font-size: 0.88rem;
        }

        .inventory-kpis {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0.85rem;
            margin-bottom: 1.25rem;
        }

        .inventory-kpi {
            background: #fff;
            border: 1px solid #eadfd4;
            border-radius: 12px;
            padding: 1rem 1.1rem;
            box-shadow: 0 4px 14px rgba(83, 55, 40, 0.05);
        }

        .inventory-kpi span {
            display: block;
            color: #8a7a6e;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .inventory-kpi strong {
            display: block;
            color: #5c3d2e;
            font-size: 1.55rem;
            margin-top: 0.2rem;
        }

        .inventory-state {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.32rem 0.6rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .inventory-state.in-stock { background: #e4f5eb; color: #0b7a4d; }
        .inventory-state.low-stock { background: #fff3d6; color: #946200; }
        .inventory-state.out-stock { background: #fdeaea; color: #b63e3e; }

        .inventory-product {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-width: 190px;
        }

        .inventory-product img,
        .inventory-product-placeholder {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            object-fit: cover;
            background: #fff0e6;
            display: grid;
            place-items: center;
            color: #b5835a;
            flex: 0 0 42px;
        }

        .inventory-adjust-form {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            min-width: 175px;
        }

        .inventory-adjust-form input { max-width: 90px; }

        @media (max-width: 768px) {
            .inventory-kpis { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 420px) {
            .inventory-kpis { gap: 0.5rem; }
            .inventory-kpi { padding: 0.8rem; }
            .inventory-kpi strong { font-size: 1.25rem; }
        }

        /* ============================================
        REPORTS SECTION – USER-FRIENDLY DESIGN
        ============================================ */

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .report-subtitle {
            color: #8a7a6e;
            font-size: 0.85rem;
            margin: 0;
        }

        .report-actions {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .report-date-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #fff0e6;
            color: #7d6458;
            padding: 0.5rem 0.9rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* ===== KPI GRID ===== */
        .report-kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .report-kpi {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.1rem 1.25rem;
            background: #ffffff;
            border: 1px solid #eadfd4;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(83, 55, 40, 0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .report-kpi:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 26px rgba(212, 163, 115, 0.15);
        }

        .report-kpi-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.3rem;
            flex-shrink: 0;
            box-shadow: inset 0 -3px 6px rgba(0,0,0,0.06);
        }

        .report-kpi-body {
            flex: 1;
            min-width: 0;
        }

        .report-kpi-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: #8a7a6e;
            margin-bottom: 0.15rem;
        }

        .report-kpi-value {
            font-size: 1.4rem;
            font-weight: 800;
            color: #5c3d2e;
            line-height: 1.2;
        }

        .report-kpi-trend {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            margin-top: 0.25rem;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 50px;
        }

        .report-kpi-trend.up {
            background: #e4f5eb;
            color: #0b7a4d;
        }

        .report-kpi-trend.down {
            background: #fdeaea;
            color: #b63e3e;
        }

        .report-kpi-trend.neutral {
            background: #f0e8e0;
            color: #7d6458;
        }

        /* ===== FILTER BAR ===== */
        .report-filter-bar {
            display: flex;
            gap: 1rem;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .report-filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            min-width: 160px;
            flex: 1;
        }

        .report-filter-group label {
            font-size: 0.72rem;
            font-weight: 700;
            color: #7d6458;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-left: 0.2rem;
        }

        /* ===== CARD HEADER ===== */
        .report-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .report-card-header h6 {
            margin: 0;
            font-weight: 700;
            color: #5c3d2e;
            font-size: 0.95rem;
        }

        .report-card-tag {
            background: #fff0e6;
            color: #bd6545;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        /* ===== TOP PRODUCTS LIST ===== */
        .report-top-products {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .report-top-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .report-top-rank {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.85rem;
            flex-shrink: 0;
            background: #f0e8e0;
            color: #7d6458;
        }

        .report-top-rank.rank-1 { background: linear-gradient(135deg,#ffd76e,#f5b700); color: #5b3a0a; }
        .report-top-rank.rank-2 { background: linear-gradient(135deg,#e0e0e0,#bdbdbd); color: #3a3a3a; }
        .report-top-rank.rank-3 { background: linear-gradient(135deg,#e8b98a,#cd8b53); color: #4a2a10; }

        .report-top-info {
            flex: 1;
            min-width: 0;
        }

        .report-top-name {
            font-weight: 600;
            font-size: 0.85rem;
            color: #5c3d2e;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.3rem;
        }

        .report-top-bar {
            height: 6px;
            background: #f0e8e0;
            border-radius: 50px;
            overflow: hidden;
        }

        .report-top-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #d4a373, #b5835a);
            border-radius: 50px;
            transition: width 0.6s ease;
        }

        .report-top-count {
            font-weight: 700;
            color: #5c3d2e;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .report-top-count span {
            color: #8a7a6e;
            font-weight: 500;
            font-size: 0.7rem;
        }

        .report-empty {
            text-align: center;
            padding: 2rem 1rem;
            color: #8a7a6e;
        }

        .report-empty i {
            font-size: 2.2rem;
            opacity: 0.4;
            display: block;
            margin-bottom: 0.6rem;
        }

        .report-empty p {
            margin: 0;
            font-size: 0.85rem;
        }

        /* ===== SUMMARY LISTS ===== */
        .report-summary-list {
            display: flex;
            flex-direction: column;
        }

        .report-summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f5f0eb;
            font-size: 0.9rem;
            color: #5c3d2e;
        }

        .report-summary-row:last-child {
            border-bottom: none;
        }

        .report-summary-row span {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            color: #7d6458;
            font-weight: 500;
        }

        .report-summary-row span i {
            color: #d4a373;
            width: 16px;
            text-align: center;
        }

        .report-summary-row strong {
            font-weight: 700;
            color: #5c3d2e;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .report-kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .report-header {
                flex-direction: column;
            }
            .report-actions {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .report-kpi-grid {
                grid-template-columns: 1fr;
            }
            .report-filter-bar {
                flex-direction: column;
                align-items: stretch;
            }
            .report-filter-group {
                min-width: 100%;
            }
            .report-kpi-value {
                font-size: 1.2rem;
            }
            .report-actions .btn {
                flex: 1;
            }
        }

        @media (max-width: 1200px) and (min-width: 993px) {
            .order-board {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 992px) {
            .main-content {
                width: 100%;
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 260px;
            }

            .order-board {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                overflow-x: visible;
            }

            .main-content {
                padding: 12px;
            }
        }

        @media (max-width: 540px) {
            .order-board {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <div style="display: flex; position: relative;">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logo.png') }}" alt="Bakery Logo" width="45" height="45">
                <h4>Disna Bakery</h4>
                <small><i class="fas fa-shield-alt"></i> Admin</small>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                </div>
                <div class="menu-item" data-section="products">
                    <i class="fas fa-cake-candles"></i> <span>Products</span>
                    <span class="badge-menu">{{ $products->count() ?? 0 }}</span>
                </div>
                <div class="menu-item" data-section="inventory" data-url="{{ route('admin.dashboard', ['section' => 'inventory']) }}">
                    <i class="fas fa-boxes-stacked"></i> <span>Stock Management</span>
                    @if(($lowStockProducts + $outOfStockProducts) > 0)
                        <span class="badge-menu">{{ $lowStockProducts + $outOfStockProducts }}</span>
                    @endif
                </div>
                <div class="menu-item" data-section="categories">
                    <i class="fas fa-tags"></i> <span>Categories</span>
                    <span class="badge-menu">{{ $categories->count() ?? 0 }}</span>
                </div>
                <div class="menu-item" data-section="orders">
                    <i class="fas fa-shopping-cart"></i> <span>Orders</span>
                    <span class="badge-menu">{{ $orders->count() ?? 0 }}</span>
                </div>
                <div class="menu-item" data-section="customers">
                    <i class="fas fa-users"></i> <span>Customers</span>
                    <span class="badge-menu">{{ $customers->count() ?? 0 }}</span>
                </div>
                <div class="menu-item" data-section="deliverys">
                    <i class="fas fa-box"></i> <span>Manage Deliveries</span>
                    <span class="badge-menu">{{ $deliveries->count() }}</span>
                </div>
                <div class="menu-item" data-section="delivery_person">
                    <i class="fas fa-truck"></i> <span>Delivery Persons</span>
                    <span class="badge-menu">{{ $deliveryPersonCount }}</span>
                </div>
                <div class="menu-item" data-section="reports">
                    <i class="fas fa-chart-line"></i> <span>Reports</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- TOP NAVBAR -->
            <div class="top-navbar d-flex justify-content-between align-items-center">
                <div>
                    <button class="mobile-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h4 class="d-inline-block ms-2" id="pageTitle">Dashboard</h4>
                </div>

                <div class="dropdown-container">
                    <button class="dropdown-toggle-btn" id="userDropdownToggle">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
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
                        <div class="stat-card"><div class="icon"><i class="fas fa-chart-line"></i></div><div class="number">Rs. {{ number_format($totalRevenue, 2) }}</div><div>Total Sales</div></div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-card"><div class="icon"><i class="fas fa-shopping-cart"></i></div><div class="number">{{ $orders->count() ?? 0 }}</div><div>Total Orders</div><small class="text-success"><i class="fas fa-arrow-up"></i> {{ $newOrdersToday }} new today</small></div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-card"><div class="icon"><i class="fas fa-users"></i></div><div class="number">{{ $customers->count() ?? 0 }}</div><div>Total Customers</div><small class="text-success"><i class="fas fa-arrow-up"></i> {{ $newCustomersThisWeek }} new this week</small></div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-card"><div class="icon"><i class="fas fa-cake"></i></div><div class="number">{{ $products->count() ?? 0 }}</div><div>Products</div></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-md-4"><div class="stat-card"><div class="icon"><i class="fas fa-crown"></i></div><div class="number">{{ $adminCount }}</div><div>Administrators</div></div></div>
                    <div class="col-md-4"><div class="stat-card"><div class="icon"><i class="fas fa-user-friends"></i></div><div class="number">{{ $customers->count() ?? 0 }}</div><div>Active Customers</div></div></div>
                    <div class="col-md-4"><div class="stat-card"><div class="icon"><i class="fas fa-truck"></i></div><div class="number">{{ $deliveryPersonCount }}</div><div>Delivery Personnel</div></div></div>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-xl-8">
                        <div class="data-table">
                            <h5 class="mb-3"><i class="fas fa-clock text-gold"></i> Recent Orders</h5>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead><tr><th>Order #</th><th>Customer</th><th>Amount</th><th>Status</th><th>Action</th></tr></thead>
                                    <tbody>
                                        @forelse($recentOrders as $recentOrder)
                                            @php
                                                $recentStatus = strtolower((string) ($recentOrder->status ?? 'pending'));
                                                $recentStatusStyles = [
                                                    'pending' => 'background:#facc15;color:#5b3a0a;',
                                                    'processing' => 'background:#60a5fa;color:#1e3a8a;',
                                                    'completed' => 'background:#4ade80;color:#14532d;',
                                                    'delivered' => 'background:#4ade80;color:#14532d;',
                                                    'cancel' => 'background:#fca5a5;color:#7f1d1d;',
                                                ];
                                            @endphp
                                            <tr>
                                                <td>#ORD-{{ $recentOrder->id }}</td>
                                                <td>{{ $recentOrder->customer_name ?? 'N/A' }}</td>
                                                <td>Rs. {{ number_format((float) $recentOrder->total_price, 2) }}</td>
                                                <td><span class="badge-status" style="{{ $recentStatusStyles[$recentStatus] ?? 'background:#e5e7eb;color:#374151;' }}">{{ ucfirst($recentStatus) }}</span></td>
                                                <td><button class="btn btn-sm btn-action btn-warning-custom" onclick='viewOrder(@json($recentOrder))'>View</button></td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5" class="text-center">No orders yet.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="data-table h-100">
                            <h5 class="mb-3"><i class="fas fa-chart-simple text-gold"></i> Top Selling</h5>
                            <canvas id="topProductsChart" style="height:200px; width:100%"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products section start-->
           <!-- Products Section -->
            <div id="productsSection" style="display:none;">
                <div class="data-table product-crud-panel">
                    <div class="product-crud-header">
                        <h5><i class="fas fa-cake-candles text-gold"></i>Product Management</h5>

                        @if (session('success'))
                            <div class="success-alert alert alert-success mb-0 py-2 px-3" style="border-radius: 999px; color: #111;">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        <button class="btn btn-warning-custom" data-bs-toggle="modal" data-bs-target="#productModal">
                            <i class="fas fa-plus"></i> Add Product
                        </button>
                    </div>

                    <form method="GET" action="{{ route('admin.dashboard', ['section' => 'products']) }}" class="row g-2 align-items-end mb-3">
                        <input type="hidden" name="section" value="products">

                        <div class="col-md-4">
                            <label class="form-label small text-muted">Category</label>
                            <select name="product_category" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="all" {{ (string) ($selectedProductCategory ?? 'all') === 'all' ? 'selected' : '' }}>All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (string) ($selectedProductCategory ?? 'all') === (string) $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small text-muted">Status</label>
                            <select name="product_status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="all" {{ (string) ($selectedProductStatus ?? 'all') === 'all' ? 'selected' : '' }}>All Status</option>
                                <option value="Active" {{ (string) ($selectedProductStatus ?? 'all') === 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ (string) ($selectedProductStatus ?? 'all') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-5 d-flex gap-2 align-items-end">
                            <a href="{{ route('admin.dashboard', ['section' => 'products']) }}" class="btn btn-outline-secondary btn-sm">
                                Clear
                            </a>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Size</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td>
                                        @if($product->image)
                                        <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/'.$product->image) }}" width="70" class="rounded">
                                        @else
                                        <i class="fas fa-image fa-2x text-gold"></i>
                                        @endif
                                    </td>

                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>Rs. {{ number_format($product->price,2) }}</td>
                                    <td>{{ $product->size ?? '—' }}</td>
                                    <td>
                                        @if($product->status=="Active")
                                            <span class="badge bg-success"> Active </span>
                                        @else
                                            <span class="badge bg-danger"> Inactive </span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-warning-custom btn-sm" type="button"
                                            onclick='editProduct({{ $product->id }}, @json($product->category_id), @json($product->name), @json($product->description), @json($product->price), @json($product->size), @json($product->status), @json($product->image))'
                                            data-bs-toggle="modal" data-bs-target="#editProductModal"> <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="{{ route('products.destroy', $product) }}"
                                            method="POST"
                                            style="display:inline;"
                                            id="deleteForm{{ $product->id }}">

                                            @csrf   
                                            @method('DELETE')

                                            <button type="button"
                                                    onclick="showDeletePopup({{ $product->id }})"
                                                    style="
                                                        background:#dc3545;
                                                        color:white;
                                                        border:none;
                                                        border-radius:6px;
                                                        padding:6px 10px;
                                                        font-size:14px;
                                                        cursor:pointer;
                                                        transition:0.2s;
                                                    "
                                                    onmouseover="this.style.background='#bb2d3b'"
                                                    onmouseout="this.style.background='#dc3545'">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @empty

                                <tr> <td colspan="7" class="text-center"> No Products Found </td> </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if($activeSection === 'inventory')
            <!-- STOCK MANAGEMENT SECTION -->
            <div id="inventorySection" style="display:none;">
                <div class="inventory-heading">
                    <div>
                        <h4 class="mb-0" style="color:#5c3d2e; font-weight:800;">Stock Management</h4>
                        <p>Track finished-product quantities and update counts after a stock check.</p>
                    </div>
                    <span class="report-date-badge"><i class="fas fa-rotate"></i> Live product stock</span>
                </div>

                @if(session('success'))
                    <div class="success-alert alert alert-success py-2 px-3" role="status">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger py-2 px-3" role="alert">{{ $errors->first() }}</div>
                @endif

                <div class="inventory-kpis">
                    <div class="inventory-kpi"><span>Products tracked</span><strong>{{ $inventoryProducts->count() }}</strong></div>
                    <div class="inventory-kpi"><span>Units on hand</span><strong>{{ number_format($totalStockUnits) }}</strong></div>
                    <div class="inventory-kpi"><span>Low stock (1-{{ $lowStockThreshold }})</span><strong>{{ $lowStockProducts }}</strong></div>
                    <div class="inventory-kpi"><span>Out of stock</span><strong>{{ $outOfStockProducts }}</strong></div>
                </div>

                <div class="data-table">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                        <div>
                            <h5 class="mb-1"><i class="fas fa-boxes-stacked text-gold me-2"></i>Product inventory</h5>
                            <small class="text-muted">Low stock is defined as {{ $lowStockThreshold }} units or fewer.</small>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <input type="search" id="inventorySearch" class="form-control form-control-sm" placeholder="Search products" aria-label="Search products" style="min-width:190px;">
                            <select id="inventoryStatusFilter" class="form-select form-select-sm" aria-label="Filter by stock status" style="min-width:150px;">
                                <option value="all">All stock levels</option>
                                <option value="in-stock">In stock</option>
                                <option value="low-stock">Low stock</option>
                                <option value="out-stock">Out of stock</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle" id="inventoryTable">
                            <thead><tr><th>Product</th><th>Category</th><th>Price</th><th>On hand</th><th>Stock status</th><th>Count update</th></tr></thead>
                            <tbody>
                                @forelse($inventoryProducts as $product)
                                    @php
                                        $stockLevel = (int) $product->stock <= 0
                                            ? 'out-stock'
                                            : ((int) $product->stock <= $lowStockThreshold ? 'low-stock' : 'in-stock');
                                        $stockLabel = match($stockLevel) {
                                            'out-stock' => 'Out of stock',
                                            'low-stock' => 'Low stock',
                                            default => 'In stock',
                                        };
                                    @endphp
                                    <tr data-name="{{ strtolower($product->name) }}" data-category="{{ strtolower($product->category->name ?? '') }}" data-stock-level="{{ $stockLevel }}">
                                        <td>
                                            <div class="inventory-product">
                                                @if($product->image)
                                                    <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/'.$product->image) }}" alt="">
                                                @else
                                                    <span class="inventory-product-placeholder"><i class="fas fa-cake-candles"></i></span>
                                                @endif
                                                <div><strong>{{ $product->name }}</strong><small class="d-block text-muted">{{ $product->status }}</small></div>
                                            </div>
                                        </td>
                                        <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                                        <td>Rs. {{ number_format((float) $product->price, 2) }}</td>
                                        <td><strong>{{ number_format((int) $product->stock) }}</strong></td>
                                        <td><span class="inventory-state {{ $stockLevel }}"><i class="fas {{ $stockLevel === 'out-stock' ? 'fa-circle-xmark' : ($stockLevel === 'low-stock' ? 'fa-triangle-exclamation' : 'fa-circle-check') }}"></i>{{ $stockLabel }}</span></td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.products.update-stock', $product) }}" class="inventory-adjust-form">
                                                @csrf
                                                <input type="number" name="stock" min="0" max="1000000" value="{{ (int) $product->stock }}" class="form-control form-control-sm" aria-label="New on-hand count for {{ $product->name }}" required>
                                                <button type="submit" class="btn btn-outline-amber btn-sm" title="Save counted quantity" aria-label="Save stock count for {{ $product->name }}"><i class="fas fa-check"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center text-muted py-4">No products are available to track yet.</td></tr>
                                @endforelse
                                <tr id="inventoryNoResults" style="display:none;"><td colspan="6" class="text-center text-muted py-4">No products match these filters.</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Product Delete Confirmation Popup -->
            <div id="deletePopup"
                style="
                    display:none;
                    position:fixed;
                    top:0;
                    left:0;
                    width:100%;
                    height:100%;
                    background:rgba(0,0,0,0.45);
                    z-index:9999;
                    align-items:center;
                    justify-content:center;
                ">

                <div style="
                    width:400px;
                    max-width:90%;
                    background:white;
                    border-radius:12px;
                    box-shadow:0 10px 40px rgba(0,0,0,0.25);
                    overflow:hidden;
                    font-family:Arial, sans-serif;
                ">

                    <!-- Header -->
                    <div style="
                        padding:18px 22px;
                        background:#dc3545;
                        color:white;
                        display:flex;
                        align-items:center;
                        gap:10px;
                    ">
                        <i class="fas fa-exclamation-triangle"
                        style="font-size:22px;"></i>

                        <span style="
                            font-size:18px;
                            font-weight:600;
                        ">
                            Delete Product
                        </span>
                    </div>

                    <!-- Message -->
                    <div style="
                        padding:25px 22px;
                        text-align:center;
                        color:#444;
                    ">

                        <i class="fas fa-trash-alt"
                        style="
                                font-size:42px;
                                color:#dc3545;
                                margin-bottom:15px;
                        ">
                        </i>

                        <p style="
                            margin:0;
                            font-size:16px;
                            line-height:1.5;
                        ">
                            Are you sure you want to delete this product?
                        </p>

                        <p style="
                            margin:8px 0 0;
                            color:#888;
                            font-size:13px;
                        ">
                            This action cannot be undone.
                        </p>

                    </div>

                    <!-- Buttons -->
                    <div style="
                        padding:15px 22px 20px;
                        display:flex;
                        justify-content:flex-end;
                        gap:10px;
                        background:#f8f9fa;
                    ">

                        <button type="button"
                                onclick="closeDeletePopup()"
                                style="
                                    background:#6c757d;
                                    color:white;
                                    border:none;
                                    border-radius:6px;
                                    padding:9px 18px;
                                    cursor:pointer;
                                    font-size:14px;
                                "
                                onmouseover="this.style.background='#5c636a'"
                                onmouseout="this.style.background='#6c757d'">
                            Cancel
                        </button>

                        <button type="button"
                                onclick="confirmDelete()"
                                style="
                                    background:#dc3545;
                                    color:white;
                                    border:none;
                                    border-radius:6px;
                                    padding:9px 18px;
                                    cursor:pointer;
                                    font-size:14px;
                                "
                                onmouseover="this.style.background='#bb2d3b'"
                                onmouseout="this.style.background='#dc3545'">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>

                    </div>

                </div>
            </div>

            <script>
                let deleteProductId = null;

                function showDeletePopup(productId) {
                    deleteProductId = productId;

                    document.getElementById('deletePopup').style.display = 'flex';
                }

                function closeDeletePopup() {
                    deleteProductId = null;

                    document.getElementById('deletePopup').style.display = 'none';
                }

                function confirmDelete() {

                    if (deleteProductId) {
                        document.getElementById(
                            'deleteForm' + deleteProductId
                        ).submit();
                    }
                }
            </script>

            <!--Add Product Modal -->
            <div class="modal fade" id="productModal"> 
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5>Add Product</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body"> <div class="mb-3">
                                <label>Category</label>
                                <select name="category_id" class="form-select">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control">
                                </div>

                            </div>

                            <div class="mt-3">
                                <label>Size</label>
                                <input type="text" name="size" class="form-control" placeholder="e.g. 1 kg or 1 pcs">
                            </div>

                            <div class="mt-3">
                                <label>Status</label>
                                <select name="status" class="form-select">
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>

                            <div class="mt-3">
                                <label>Image</label>
                                <input id="edit_image" type="file" name="image" accept="image/*" class="form-control">
                                <input type="url" name="image_url" class="form-control mt-2" placeholder="Or paste an image URL">
                            </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal"> Cancel </button>
                                <button class="btn btn-warning-custom"> Save </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--Edit Product Modal -->
            <div class="modal fade" id="editProductModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" id="editProductForm" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">            
                                <h5>Edit Product</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <label for="edit_category">Category</label>
                                <select name="category_id" id="edit_category" class="form-select mb-3">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">  {{ $category->name }} </option>
                                    @endforeach
                                </select>

                                <label for="edit_product_name">Name</label>
                                <input id="edit_product_name" type="text" name="name" class="form-control mb-3">
                                <label for="edit_product_description">Description</label>
                                <textarea id="edit_product_description" name="description" class="form-control mb-3"></textarea>
                                <label for="edit_price">Price</label>
                                <input id="edit_price" type="number" step="0.01" name="price" class="form-control mb-3">
                                <label for="edit_size">Size</label>
                                <input id="edit_size" type="text" name="size" class="form-control mb-3" placeholder="e.g. 1 kg or 1 pcs">
                                <label for="edit_status">Status</label>
                                <select id="edit_status" name="status" class="form-select mb-3">
                                    <option>Active</option> <option>Inactive</option>
                                </select>
                                <label for="edit_product_image">Image</label>
                                <input id="edit_product_image" type="file" name="image" accept="image/*" class="form-control">
                                <input type="url" name="image_url" class="form-control mt-2" placeholder="Or paste a new image URL">
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">
                                     Cancel
                                </button>

                                <button type="submit" class="btn btn-warning-custom">
                                    Update
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Categories Section start --> 
            <div id="categoriesSection" style="display: none;">
                <div class="data-table">
                    <div class="d-flex justify-content-between mb-4 flex-wrap gap-2">
                        <h5><i class="fas fa-tags text-gold"></i> Categories</h5>
                        @if (session('success'))
                            <div class="success-alert alert alert-success mb-0 py-2 px-3" style="border-radius: 999px;">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif
                        <button type="button" class="btn btn-warning-custom" data-bs-toggle="modal" data-bs-target="#categoryModal">
                            + Add Category
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead><tr><th>ID</th><th>Category</th><th>Description</th><th>Products</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->products->count() }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning-custom" onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}')" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                method="POST"
                                                style="display:inline;"
                                                id="deleteCategoryForm{{ $category->id }}">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        onclick="showCategoryDeletePopup({{ $category->id }})"
                                                        style="
                                                            background:#dc3545;
                                                            color:white;
                                                            border:none;
                                                            border-radius:6px;
                                                            padding:6px 10px;
                                                            font-size:14px;
                                                            cursor:pointer;
                                                            transition:0.2s;
                                                        "
                                                        onmouseover="this.style.background='#bb2d3b'"
                                                        onmouseout="this.style.background='#dc3545'">

                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center">No Categories Found</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Category Delete Confirmation Popup -->
            <div id="categoryDeletePopup"
                style="
                    display:none;
                    position:fixed;
                    top:0;
                    left:0;
                    width:100%;
                    height:100%;
                    background:rgba(0,0,0,0.45);
                    z-index:9999;
                    align-items:center;
                    justify-content:center;
                ">

                <div style="
                    width:400px;
                    max-width:90%;
                    background:white;
                    border-radius:12px;
                    box-shadow:0 10px 40px rgba(0,0,0,0.25);
                    overflow:hidden;
                    font-family:Arial, sans-serif;
                ">

                    <!-- Header -->
                    <div style="
                        padding:18px 22px;
                        background:#dc3545;
                        color:white;
                        display:flex;
                        align-items:center;
                        gap:10px;
                    ">
                        <i class="fas fa-exclamation-triangle"
                        style="font-size:22px;"></i>

                        <span style="
                            font-size:18px;
                            font-weight:600;
                        ">
                            Delete Category
                        </span>
                    </div>

                    <!-- Message -->
                    <div style="
                        padding:25px 22px;
                        text-align:center;
                        color:#444;
                    ">

                        <i class="fas fa-folder-minus"
                        style="
                                font-size:42px;
                                color:#dc3545;
                                margin-bottom:15px;
                        ">
                        </i>

                        <p style="
                            margin:0;
                            font-size:16px;
                            line-height:1.5;
                        ">
                            Are you sure you want to delete this category?
                        </p>

                        <p style="
                            margin:8px 0 0;
                            color:#888;
                            font-size:13px;
                        ">
                            This action cannot be undone.
                        </p>

                    </div>

                    <!-- Buttons -->
                    <div style="
                        padding:15px 22px 20px;
                        display:flex;
                        justify-content:flex-end;
                        gap:10px;
                        background:#f8f9fa;
                    ">

                        <button type="button"
                                onclick="closeCategoryDeletePopup()"
                                style="
                                    background:#6c757d;
                                    color:white;
                                    border:none;
                                    border-radius:6px;
                                    padding:9px 18px;
                                    cursor:pointer;
                                    font-size:14px;
                                "
                                onmouseover="this.style.background='#5c636a'"
                                onmouseout="this.style.background='#6c757d'">

                            Cancel
                        </button>

                        <button type="button"
                                onclick="confirmCategoryDelete()"
                                style="
                                    background:#dc3545;
                                    color:white;
                                    border:none;
                                    border-radius:6px;
                                    padding:9px 18px;
                                    cursor:pointer;
                                    font-size:14px;
                                "
                                onmouseover="this.style.background='#bb2d3b'"
                                onmouseout="this.style.background='#dc3545'">

                            <i class="fas fa-trash"></i>
                            Delete
                        </button>

                    </div>

                </div>
            </div>

            <script>
                let deleteCategoryId = null;

                function showCategoryDeletePopup(categoryId) {
                    deleteCategoryId = categoryId;

                    document.getElementById('categoryDeletePopup').style.display = 'flex';
                }

                function closeCategoryDeletePopup() {
                    deleteCategoryId = null;

                    document.getElementById('categoryDeletePopup').style.display = 'none';
                }

                function confirmCategoryDelete() {

                    if (deleteCategoryId) {
                        document.getElementById(
                            'deleteCategoryForm' + deleteCategoryId
                        ).submit();
                    }
                }
            </script>

            <!-- Add Category Modal -->
            <div class="modal fade" id="categoryModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="text-gold">Add Category</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="name" class="form-control mb-2" placeholder="Category Name" required>
                                <textarea name="description" class="form-control" placeholder="Description"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning-custom">Save</button>
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
                                <h5 class="text-gold">Edit Category</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="edit_id">
                                <input type="text" name="name" id="edit_name" class="form-control mb-2" required>
                                <textarea name="description" id="edit_description" class="form-control"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning-custom">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Categories Section end -->

            <!-- Orders Section -->
            <div id="ordersSection" style="display: none;">
                <div class="data-table">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-2">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart text-gold"></i> All Orders</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-warning" onclick="document.getElementById('manualOrderForm').classList.toggle('d-none')">
                                <i class="fas fa-phone-alt me-1"></i> Add Phone Order
                            </button>
                            <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex flex-wrap gap-2 align-items-center">
                                <input type="hidden" name="section" value="orders">
                                <select name="custom_type" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="all" {{ $selectedCustomType === 'all' ? 'selected' : '' }}>All Orders</option>
                                    <option value="custom_cake" {{ $selectedCustomType === 'custom_cake' ? 'selected' : '' }}>Custom Cake</option>
                                    <option value="standard" {{ $selectedCustomType === 'standard' ? 'selected' : '' }}>Not Custom Cake</option>
                                </select>
                                <label class="visually-hidden" for="orderDeliveryDateFilter">Pickup / delivery date</label>
                                <input id="orderDeliveryDateFilter" type="date" name="delivery_date" value="{{ $selectedDeliveryDate }}" class="form-control form-control-sm" aria-label="Filter by pickup or delivery date" onchange="this.form.submit()">
                            </form>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="success-alert alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form id="manualOrderForm" method="POST" action="{{ route('admin.orders.store') }}" class="{{ $errors->any() ? '' : 'd-none' }} border rounded p-3 mb-4">
                        @csrf
                        <h6 class="mb-3">New order by phone</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="manualProductName" class="form-label">Product</label>
                                <select id="manualProductName" name="product_name" class="form-select" required>
                                    <option value="">Choose a product</option>
                                    @foreach($activeProducts as $product)
                                        <option value="{{ $product->name }}" @selected(old('product_name') === $product->name)>{{ $product->name }}</option>
                                    @endforeach
                                    <option value="Custom Cake" @selected(old('product_name') === 'Custom Cake')>Custom Cake</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="manualCustomerName" class="form-label">Customer name</label>
                                <input id="manualCustomerName" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required maxlength="255">
                            </div>
                            <div class="col-md-4">
                                <label for="manualPhone" class="form-label">Phone</label>
                                <input id="manualPhone" name="phone" type="tel" class="form-control" value="{{ old('phone') }}" placeholder="0771234567" required>
                            </div>
                            <div class="col-md-4">
                                <label for="manualCakeSize" class="form-label">Size</label>
                                <input id="manualCakeSize" name="cake_size" class="form-control" value="{{ old('cake_size') }}" placeholder="e.g. 1 kg" required maxlength="255">
                            </div>
                            <div class="col-md-4">
                                <label for="manualTotalPrice" class="form-label">Total price (LKR)</label>
                                <input id="manualTotalPrice" name="total_price" type="number" min="0" step="0.01" class="form-control" value="{{ old('total_price') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="manualFlavor" class="form-label">Flavor</label>
                                <input id="manualFlavor" name="flavor" class="form-control" value="{{ old('flavor') }}" maxlength="255">
                            </div>
                            <div class="col-md-6">
                                <label for="manualFrosting" class="form-label">Frosting</label>
                                <input id="manualFrosting" name="frosting" class="form-control" value="{{ old('frosting') }}" maxlength="255">
                            </div>
                            <div class="col-md-4">
                                <label for="manualDeliveryOption" class="form-label">Fulfillment</label>
                                <select id="manualDeliveryOption" name="delivery_option" class="form-select" required>
                                    <option value="Pickup" @selected(old('delivery_option', 'Pickup') === 'Pickup')>Pickup</option>
                                    <option value="Delivery" @selected(old('delivery_option') === 'Delivery')>Delivery</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="manualDeliveryDate" class="form-label">Ready / delivery date</label>
                                <input id="manualDeliveryDate" name="delivery_date" type="date" min="{{ now()->toDateString() }}" class="form-control" value="{{ old('delivery_date') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="manualCity" class="form-label">City (required for delivery)</label>
                                <input id="manualCity" name="city" class="form-control" value="{{ old('city') }}" maxlength="255">
                            </div>
                            <div class="col-12">
                                <label for="manualAddress" class="form-label">Delivery address (required for delivery)</label>
                                <input id="manualAddress" name="address" class="form-control" value="{{ old('address') }}" maxlength="500">
                            </div>
                            <div class="col-12">
                                <label for="manualSpecialNotes" class="form-label">Order notes</label>
                                <textarea id="manualSpecialNotes" name="special_notes" class="form-control" rows="2" maxlength="2000">{{ old('special_notes') }}</textarea>
                            </div>
                            <div class="col-12 d-flex gap-2">
                                <button type="submit" class="btn btn-warning"><i class="fas fa-plus me-1"></i> Save Order</button>
                                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('manualOrderForm').classList.add('d-none')">Cancel</button>
                            </div>
                        </div>
                    </form>

                    @php
                        $orderStatuses = [
                            'pending' => 'Pending',
                            'processing' => 'Processing',
                            'completed' => 'Completed',
                            'delivered' => 'Delivered',
                            'cancel' => 'Cancelled',
                        ];
                    @endphp

                    <div class="order-board">
                        @foreach($orderStatuses as $statusKey => $statusLabel)
                            @php
                                $laneOrders = $orders->filter(fn ($order) => strtolower((string) ($order->status ?? 'pending')) === $statusKey);
                            @endphp
                            <div class="order-lane" data-status="{{ $statusKey }}">
                                <div class="order-lane-title">
                                    <span>{{ $statusLabel }}</span>
                                    <span class="order-lane-count">{{ $laneOrders->count() }}</span>
                                </div>

                                <div class="order-lane-cards">
                                    @forelse($laneOrders as $order)
                                        @php
                                            $orderStatus = strtolower((string) ($order->status ?? 'pending'));
                                            $isOverdue = $order->delivery_date
                                                && \Carbon\Carbon::parse($order->delivery_date)->toDateString() < now()->toDateString()
                                                && !in_array($orderStatus, ['completed', 'delivered', 'cancel', 'cancelled'], true);
                                        @endphp
                                        <div class="admin-order-card" draggable="true" data-status="{{ $statusKey }}" data-update-url="{{ route('admin.orders.update-status', $order) }}">
                                            <span class="admin-order-id">#{{ $order->id }}</span>
                                            @if($isOverdue)
                                                <span class="badge bg-danger" role="status">OVERDUE</span>
                                            @endif
                                            <button class="admin-view-order" type="button" onclick='viewOrder(@json($order))' title="View order receipt">
                                                <i class="fas fa-receipt"></i> View More
                                            </button>
                                        </div>
                                    @empty
                                        <div class="order-board-empty">No orders</div>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Customers Section -->
            <div id="customersSection" style="display: none;">
                <div class="data-table">
                    <h5><i class="fas fa-users text-gold"></i> Customer Management</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Joined</th><th>Status</th></tr></thead>
                            <tbody>
                                @forelse($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->contact_number ?? 'N/A' }}</td>
                                        <td>{{ $customer->address ?? 'N/A' }}</td>
                                        <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center">No customers found</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===== REPORTS SECTION ===== -->
            <div id="reportsSection" style="display: none;">

                <!-- Header + Quick Actions -->
                <div class="data-table mb-4">
                    <div class="report-header">
                        <div>
                            <h5 class="mb-1">
                                <i class="fas fa-chart-line text-gold"></i> Business Reports
                            </h5>
                            <p class="report-subtitle">
                                Live insights across sales, orders, customers, and delivery performance.
                            </p>
                        </div>
                        <div class="report-actions">
                            <div class="report-date-badge">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ now()->format('d M Y') }}</span>
                            </div>
                            <button class="btn btn-outline-amber" onclick="window.print()">
                                <i class="fas fa-print"></i> Print
                            </button>
                            <button class="btn btn-warning-custom" onclick="exportReport()">
                                <i class="fas fa-download"></i> Export CSV
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ===== KPI SUMMARY CARDS ===== -->
                <div class="report-kpi-grid">
                    <div class="report-kpi">
                        <div class="report-kpi-icon" style="background:linear-gradient(135deg,#fde8d6,#f7c9a0);">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="report-kpi-body">
                            <div class="report-kpi-label">Net Revenue</div>
                            <div class="report-kpi-value">Rs. {{ number_format($reportRevenue, 2) }}</div>
                            <div class="report-kpi-trend up">
                                <i class="fas fa-chart-line"></i> After cancelled-order refunds
                            </div>
                        </div>
                    </div>

                    <div class="report-kpi">
                        <div class="report-kpi-icon" style="background:linear-gradient(135deg,#d9ecff,#b3d8ff);">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="report-kpi-body">
                            <div class="report-kpi-label">Total Orders</div>
                            <div class="report-kpi-value">{{ number_format($reportOrderCount) }}</div>
                            <div class="report-kpi-trend up">
                                <i class="fas fa-shopping-bag"></i> Matching orders
                            </div>
                        </div>
                    </div>

                    <div class="report-kpi">
                        <div class="report-kpi-icon" style="background:linear-gradient(135deg,#e3f7e7,#c2ecc9);">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="report-kpi-body">
                            <div class="report-kpi-label">Customers</div>
                            <div class="report-kpi-value">{{ number_format($reportCustomerCount) }}</div>
                            <div class="report-kpi-trend up">
                                <i class="fas fa-users"></i> Unique customers with orders
                            </div>
                        </div>
                    </div>

                    <div class="report-kpi">
                        <div class="report-kpi-icon" style="background:linear-gradient(135deg,#fce4ec,#f8b8ca);">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="report-kpi-body">
                            <div class="report-kpi-label">Avg. Order Value</div>
                            <div class="report-kpi-value">Rs. {{ number_format($reportAverageOrderValue, 2) }}</div>
                            <div class="report-kpi-trend neutral">
                                <i class="fas fa-calculator"></i> Revenue per order
                            </div>
                        </div>
                    </div>

                    <div class="report-kpi">
                        <div class="report-kpi-icon" style="background:linear-gradient(135deg,#fde2e2,#f5b7b7);">
                            <i class="fas fa-rotate-left"></i>
                        </div>
                        <div class="report-kpi-body">
                            <div class="report-kpi-label">Cancelled Refunds</div>
                            <div class="report-kpi-value">Rs. {{ number_format($reportRefundTotal, 2) }}</div>
                            <div class="report-kpi-trend neutral">
                                <i class="fas fa-circle-info"></i> Calculated from cancelled order totals
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== FILTER BAR ===== -->
                <div class="data-table mb-4">
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="report-filter-bar">
                        <input type="hidden" name="section" value="reports">
                        <div class="report-filter-group">
                            <label>Date Range</label>
                            <select id="reportDateRange" name="report_range" class="form-select" onchange="this.form.submit()">
                                <option value="7" {{ $reportRange === '7' ? 'selected' : '' }}>Last 7 days</option>
                                <option value="30" {{ $reportRange === '30' ? 'selected' : '' }}>Last 30 days</option>
                                <option value="90" {{ $reportRange === '90' ? 'selected' : '' }}>Last 90 days</option>
                                <option value="365" {{ $reportRange === '365' ? 'selected' : '' }}>This year</option>
                                <option value="all" {{ $reportRange === 'all' ? 'selected' : '' }}>All time</option>
                            </select>
                        </div>

                        <div class="report-filter-group">
                            <label>Category</label>
                            <select id="reportCategory" name="report_category" class="form-select" onchange="this.form.submit()">
                                <option value="all" {{ $reportCategory === 'all' ? 'selected' : '' }}>All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $reportCategory === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="report-filter-group">
                            <label>Status</label>
                            <select id="reportStatus" name="report_status" class="form-select" onchange="this.form.submit()">
                                <option value="all" {{ $reportStatus === 'all' ? 'selected' : '' }}>All Statuses</option>
                                <option value="pending" {{ $reportStatus === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $reportStatus === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $reportStatus === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="delivered" {{ $reportStatus === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancel" {{ $reportStatus === 'cancel' ? 'selected' : '' }}>Cancelled</option>
                                <option value="assigned" {{ $reportStatus === 'assigned' ? 'selected' : '' }}>Assigned</option>
                                <option value="in_transit" {{ $reportStatus === 'in_transit' ? 'selected' : '' }}>In Transit</option>
                                <option value="failed" {{ $reportStatus === 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>

                        <a href="{{ route('admin.dashboard', ['section' => 'reports']) }}" class="btn btn-outline-amber">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </form>
                </div>

                <!-- ===== CHARTS ROW 1 ===== -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-8">
                        <div class="data-table h-100">
                            <div class="report-card-header">
                                <h6><i class="fas fa-chart-area text-gold"></i> Revenue Trend</h6>
                                <span class="report-card-tag">{{ $reportRange === 'all' ? 'All time' : ($reportRange === '365' ? 'This year' : 'Daily') }}</span>
                            </div>
                            <div style="position:relative; height:280px;">
                                <canvas id="reportRevenueChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="data-table h-100">
                            <div class="report-card-header">
                                <h6><i class="fas fa-chart-pie text-gold"></i> Order Status</h6>
                            </div>
                            <div style="position:relative; height:280px;">
                                <canvas id="reportStatusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== CHARTS ROW 2 ===== -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-6">
                        <div class="data-table h-100">
                            <div class="report-card-header">
                                <h6><i class="fas fa-chart-bar text-gold"></i> Sales by Category</h6>
                            </div>
                            <div style="position:relative; height:260px;">
                                <canvas id="reportCategoryChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="data-table h-100">
                            <div class="report-card-header">
                                <h6><i class="fas fa-trophy text-gold"></i> Top Selling Products</h6>
                            </div>
                            <div class="report-top-products">
                                @forelse($reportTopProducts as $index => $product)
                                    @php $barWidth = (int) round(($product['orders'] / $maxTopProductOrders) * 100); @endphp
                                    <div class="report-top-item">
                                        <div class="report-top-rank {{ $index < 3 ? 'rank-'.($index + 1) : '' }}">{{ $index + 1 }}</div>
                                        <div class="report-top-info">
                                            <div class="report-top-name">{{ $product['name'] }}</div>
                                            <div class="report-top-bar"><div class="report-top-bar-fill" style="width: {{ $barWidth }}%;"></div></div>
                                        </div>
                                        <div class="report-top-count">{{ $product['orders'] }} <span>orders</span></div>
                                    </div>
                                @empty
                                    <div class="report-empty"><p>No product orders for this selection.</p></div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== QUICK SUMMARY TABLES ===== -->
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="data-table">
                            <div class="report-card-header">
                                <h6><i class="fas fa-calendar-day text-gold"></i> Selected Period Summary</h6>
                            </div>
                            <div class="report-summary-list">
                                <div class="report-summary-row">
                                    <span><i class="fas fa-coins"></i> Gross Order Total</span>
                                    <strong>Rs. {{ number_format($reportGrossRevenue, 2) }}</strong>
                                </div>
                                <div class="report-summary-row">
                                    <span><i class="fas fa-rotate-left"></i> Cancelled Refunds</span>
                                    <strong>− Rs. {{ number_format($reportRefundTotal, 2) }}</strong>
                                </div>
                                <div class="report-summary-row">
                                    <span><i class="fas fa-scale-balanced"></i> Net Revenue</span>
                                    <strong>Rs. {{ number_format($reportRevenue, 2) }}</strong>
                                </div>
                                <div class="report-summary-row">
                                    <span><i class="fas fa-shopping-cart"></i> Total Orders</span>
                                    <strong>{{ number_format($reportOrderCount) }}</strong>
                                </div>
                                <div class="report-summary-row">
                                    <span><i class="fas fa-calculator"></i> Average Order</span>
                                    <strong>Rs. {{ number_format($reportAverageOrderValue, 2) }}</strong>
                                </div>
                                <div class="report-summary-row">
                                    <span><i class="fas fa-cake-candles"></i> Custom Cakes</span>
                                    <strong>{{ $reportOrders->filter(fn ($order) => strtolower(trim((string) $order->product_name)) === 'custom cake')->count() }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="data-table">
                            <div class="report-card-header">
                                <h6><i class="fas fa-truck-fast text-gold"></i> Delivery Snapshot</h6>
                            </div>
                            <div class="report-summary-list">
                                <div class="report-summary-row">
                                    <span><i class="fas fa-hourglass-half"></i> Pending</span>
                                    <strong class="text-warning">{{ $reportDeliveryCounts['pending'] }}</strong>
                                </div>
                                <div class="report-summary-row">
                                    <span><i class="fas fa-clock"></i> Assigned</span>
                                    <strong class="text-info">{{ $reportDeliveryCounts['assigned'] }}</strong>
                                </div>
                                <div class="report-summary-row">
                                    <span><i class="fas fa-route"></i> Picked Up / In Transit</span>
                                    <strong class="text-primary">{{ $reportDeliveryCounts['in_transit'] }}</strong>
                                </div>
                                <div class="report-summary-row">
                                    <span><i class="fas fa-check-circle"></i> Delivered</span>
                                    <strong class="text-success">{{ $reportDeliveryCounts['delivered'] }}</strong>
                                </div>
                                <div class="report-summary-row">
                                    <span><i class="fas fa-exclamation-triangle"></i> Failed</span>
                                    <strong class="text-danger">{{ $reportDeliveryCounts['failed'] }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="data-table mt-4">
                    <div class="report-card-header">
                        <h6><i class="fas fa-rotate-left text-gold"></i> Cancelled Orders and Refund Values</h6>
                    </div>
                    <p class="report-subtitle">Refund values are calculated from each cancelled order's full total. They do not confirm that a payment refund has been processed.</p>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Cancelled On</th>
                                    <th>Order Total</th>
                                    <th>Refund Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reportCancelledOrders as $cancelledOrder)
                                    <tr>
                                        <td>#ORD-{{ $cancelledOrder->id }}</td>
                                        <td>{{ $cancelledOrder->customer_name ?? 'N/A' }}</td>
                                        <td>{{ $cancelledOrder->product_name ?? 'N/A' }}</td>
                                        <td>{{ $cancelledOrder->updated_at?->format('d M Y') ?? 'N/A' }}</td>
                                        <td>Rs. {{ number_format((float) $cancelledOrder->total_price, 2) }}</td>
                                        <td>Rs. {{ number_format((float) $cancelledOrder->total_price, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center">No cancelled orders for this selection.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===== DELIVERY PERSON SECTION ===== -->
            <div id="delivery_personSection" style="display: none;">

                <div class="data-table">

                    <!-- Header -->
                    <div class="product-crud-header">
                        <h5>
                            <i class="fas fa-truck text-gold"></i> Delivery Personnel Management
                        </h5>

                        @if (session('success'))
                            <div class="success-alert alert alert-success mb-0 py-2 px-3" style="border-radius: 999px;">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        <button class="btn btn-warning-custom" data-bs-toggle="modal" data-bs-target="#deliveryPersonModal">
                            <i class="fas fa-plus"></i> Add Delivery Person
                        </button>
                    </div>

                    <!-- Stats Row -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3 col-6">
                            <div class="stat-card" style="padding:16px; margin-bottom:0;">
                                <div class="icon" style="font-size:1.6rem; padding:8px;"><i class="fas fa-users"></i></div>
                                <div class="number" style="font-size:1.4rem;">{{ $deliveryPersonCount }}</div>
                                <div style="font-size:0.85rem;">Total Delivery Personnel</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-card" style="padding:16px; margin-bottom:0;">
                                <div class="icon" style="font-size:1.6rem; padding:8px;"><i class="fas fa-user-check"></i></div>
                                <div class="number" style="font-size:1.4rem;">{{ $activeDeliveryPersons }}</div>
                                <div style="font-size:0.85rem;">Active</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-card" style="padding:16px; margin-bottom:0;">
                                <div class="icon" style="font-size:1.6rem; padding:8px;"><i class="fas fa-user-slash"></i></div>
                                <div class="number" style="font-size:1.4rem;">{{ $inactiveDeliveryPersons }}</div>
                                <div style="font-size:0.85rem;">Inactive</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-card" style="padding:16px; margin-bottom:0;">
                                <div class="icon" style="font-size:1.6rem; padding:8px;"><i class="fas fa-route"></i></div>
                                <div class="number" style="font-size:1.4rem;">{{ $activeDeliveries }}</div>
                                <div style="font-size:0.85rem;">Active Deliveries</div>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="mb-3" style="max-width:320px;">
                        <input type="search" id="deliveryPersonSearch" class="form-control form-control-sm"
                            placeholder="Search by delivery person ID"
                            aria-label="Search delivery persons by ID">
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email / Login</th>
                                    <th>Phone</th>
                                    <th>Vehicle</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deliveryPersons ?? [] as $person)
                                <tr data-delivery-person-id="{{ $person->id }}"
                                    data-delivery-person-code="DP-{{ str_pad($person->id, 4, '0', STR_PAD_LEFT) }}">
                                    <td>
                                        @if($person->photo)
                                            <img src="{{ asset('storage/'.$person->photo) }}" width="45" height="45" style="border-radius:50%; object-fit:cover; border:2px solid #d4a373;">
                                        @else
                                            <div style="width:45px; height:45px; border-radius:50%; background:linear-gradient(135deg,#e8b4b8,#c47a7a); color:white; display:flex; align-items:center; justify-content:center; font-weight:700;">
                                                {{ strtoupper(substr($person->name ?? 'D', 0, 1)) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $person->name }}</strong>
                                        <div style="font-size:0.75rem; color:#8a7a6e;">
                                            ID: #DP-{{ str_pad($person->id, 4, '0', STR_PAD_LEFT) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-size:0.85rem;">
                                            <i class="fas fa-envelope" style="color:#d4a373; font-size:0.75rem;"></i>
                                            {{ $person->email }}
                                        </div>
                                        <div style="font-size:0.72rem; color:#8a7a6e; margin-top:2px;">
                                            <i class="fas fa-key" style="font-size:0.65rem;"></i>
                                            Password: ••••••••
                                        </div>
                                    </td>
                                            <td>{{ $person->contact_number ?? 'N/A' }}</td>
                                    <td>
                                        @if($person->vehicle_type)
                                            <span style="background:#fff0e6; color:#bd6545; padding:3px 10px; border-radius:50px; font-size:0.72rem; font-weight:700;">
                                                <i class="fas fa-motorcycle"></i> {{ $person->vehicle_type }}
                                            </span>
                                        @else
                                            <span style="color:#8a7a6e;">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(($person->status ?? 'Active') === 'Active')
                                            <span class="badge" style="background:#e4f5eb; color:#0b7a4d; padding:5px 12px; border-radius:50px; font-size:0.7rem; font-weight:700;">
                                                <i class="fas fa-circle" style="font-size:0.5rem;"></i> Active
                                            </span>
                                        @else
                                            <span class="badge" style="background:#fdeaea; color:#b63e3e; padding:5px 12px; border-radius:50px; font-size:0.7rem; font-weight:700;">
                                                <i class="fas fa-circle" style="font-size:0.5rem;"></i> Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $person->created_at ? $person->created_at->format('d M Y') : '—' }}</td>
                                    <td>
                                        <!-- View -->
                                        <button type="button" class="btn btn-sm"
                                            style="background:#e3f0fa; color:#1467a8; border:none; border-radius:8px; padding:6px 10px; font-size:0.75rem;"
                                            onclick='viewDeliveryPerson(@json($person))'
                                            title="View details">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Edit -->
                                        <button type="button" class="btn btn-sm btn-warning-custom"
                                            onclick='editDeliveryPerson(@json($person))'
                                            data-bs-toggle="modal" data-bs-target="#editDeliveryPersonModal"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.delivery-persons.destroy', $person->id) }}"
                                            method="POST"
                                            style="display:inline;"
                                            id="deleteDeliveryPersonForm{{ $person->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                onclick="showDeliveryPersonDeletePopup({{ $person->id }})"
                                                style="background:#dc3545; color:white; border:none; border-radius:8px; padding:6px 10px; font-size:0.75rem; cursor:pointer; transition:0.2s;"
                                                onmouseover="this.style.background='#bb2d3b'"
                                                onmouseout="this.style.background='#dc3545'"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center" style="padding:2rem; color:#8a7a6e;">
                                        <i class="fas fa-truck" style="font-size:2rem; opacity:0.4; display:block; margin-bottom:0.5rem;"></i>
                                        No delivery personnel added yet.
                                    </td>
                                </tr>
                                @endforelse
                                @if(($deliveryPersons ?? collect())->isNotEmpty())
                                    <tr id="deliveryPersonNoResults" style="display:none;">
                                        <td colspan="8" class="text-center" style="padding:1.5rem; color:#8a7a6e;">
                                            No delivery persons match that ID.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===== ADD DELIVERY PERSON MODAL ===== -->
            <div class="modal fade" id="deliveryPersonModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('admin.delivery-persons.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5><i class="fas fa-user-plus me-2"></i> Add Delivery Person</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                @if($errors->deliveryPerson->any())
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Delivery person was not added:</strong>
                                        <ul class="mb-0 mt-1">
                                            @foreach($errors->deliveryPerson->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Personal Info -->
                                <h6 style="color:#b5835a; font-weight:700; text-transform:uppercase; font-size:0.75rem; letter-spacing:0.05em; margin-bottom:0.8rem;">
                                    <i class="fas fa-user"></i> Personal Information
                                </h6>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Full Name <span style="color:#dc3545;">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="e.g., John Doe" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phone Number <span style="color:#dc3545;">*</span></label>
                                        <input type="tel" name="contact_number" class="form-control" value="{{ old('contact_number') }}" placeholder="e.g., +94 77 123 4567">
                                    </div>
                                    <div class="col-md-6">
                                        <label>NIC / ID Number</label>
                                        <input type="text" name="nic" class="form-control" value="{{ old('nic') }}" placeholder="e.g., 199012345678">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Vehicle Type</label>
                                        <select name="vehicle_type" class="form-select">
                                            <option value="">Select Vehicle</option>
                                            <option value="Bike" @selected(old('vehicle_type') === 'Bike')>Bike</option>
                                            <option value="Three Wheeler" @selected(old('vehicle_type') === 'Three Wheeler')>Three Wheeler</option>
                                            <option value="Car" @selected(old('vehicle_type') === 'Car')>Car</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" rows="2" placeholder="Home address">{{ old('address') }}</textarea>
                                    </div>
                                </div>

                                <!-- Login Credentials -->
                                <h6 style="color:#b5835a; font-weight:700; text-transform:uppercase; font-size:0.75rem; letter-spacing:0.05em; margin:1.5rem 0 0.8rem;">
                                    <i class="fas fa-key"></i> Login Credentials
                                </h6>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Login Email <span style="color:#dc3545;">*</span></label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="delivery@disnabakery.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Password <span style="color:#dc3545;">*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="addPassword" class="form-control" value="" required>
                                            <button type="button" class="btn btn-outline-secondary" onclick="toggleDeliveryPassword('addPassword', this)" aria-label="Show password"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Confirm Password <span style="color:#dc3545;">*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation" id="addPasswordConfirmation" class="form-control" value="" required>
                                            <button type="button" class="btn btn-outline-secondary" onclick="toggleDeliveryPassword('addPasswordConfirmation', this)" aria-label="Show password"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Account Status</label>
                                        <select name="status" class="form-select">
                                            <option value="Active" @selected(old('status', 'Active') === 'Active')>Active</option>
                                            <option value="Inactive" @selected(old('status') === 'Inactive')>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div style="background:#fff0e6; border-radius:12px; padding:0.8rem 1rem; margin-top:1rem; font-size:0.8rem; color:#7d6458;">
                                    <i class="fas fa-info-circle" style="color:#d4a373;"></i>
                                    The delivery person will use this email and password to log in to the delivery dashboard.
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning-custom">
                                    <i class="fas fa-save"></i> Save Delivery Person
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- ===== EDIT DELIVERY PERSON MODAL ===== -->
            <div class="modal fade" id="editDeliveryPersonModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                            <form method="POST" id="editDeliveryPersonForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5><i class="fas fa-user-edit me-2"></i> Edit Delivery Person</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <h6 style="color:#b5835a; font-weight:700; text-transform:uppercase; font-size:0.75rem; letter-spacing:0.05em; margin-bottom:0.8rem;">
                                    <i class="fas fa-user"></i> Personal Information
                                </h6>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Full Name <span style="color:#dc3545;">*</span></label>
                                        <input type="text" name="name" id="edit_dp_name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phone Number <span style="color:#dc3545;">*</span></label>
                                        <input type="tel" name="contact_number" id="edit_dp_phone" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>NIC / ID Number</label>
                                        <input type="text" name="nic" id="edit_dp_nic" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Vehicle Type</label>
                                        <select name="vehicle_type" id="edit_dp_vehicle" class="form-select">
                                            <option value="">Select Vehicle</option>
                                            <option value="Bike">Bike</option>
                                            <option value="Motorcycle">Motorcycle</option>
                                            <option value="Three Wheeler">Three Wheeler</option>
                                            <option value="Van">Van</option>
                                            <option value="Lorry">Lorry</option>
                                            <option value="Car">Car</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <textarea name="address" id="edit_dp_address" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Profile Photo (leave empty to keep current)</label>
                                        <input type="file" name="photo" accept="image/*" class="form-control">
                                    </div>
                                </div>

                                <h6 style="color:#b5835a; font-weight:700; text-transform:uppercase; font-size:0.75rem; letter-spacing:0.05em; margin:1.5rem 0 0.8rem;">
                                    <i class="fas fa-key"></i> Login Credentials
                                </h6>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Login Email <span style="color:#dc3545;">*</span></label>
                                        <input type="email" name="email" id="edit_dp_email" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>New Password <small style="color:#8a7a6e;">(leave empty to keep current)</small></label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="edit_dp_password" class="form-control" placeholder="New password">
                                            <button type="button" class="btn btn-outline-secondary" onclick="toggleDeliveryPassword('edit_dp_password', this)" aria-label="Show password"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Account Status</label>
                                        <select name="status" id="edit_dp_status" class="form-select">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning-custom">
                                    <i class="fas fa-sync-alt"></i> Update Delivery Person
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- ===== VIEW DELIVERY PERSON MODAL ===== -->
            <div class="modal fade" id="viewDeliveryPersonModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5><i class="fas fa-id-card me-2"></i> Delivery Person Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="viewDeliveryPersonBody">
                            <!-- Filled by JS -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ===== DELETE CONFIRMATION POPUP ===== -->
            <div id="deliveryPersonDeletePopup"
                style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.45); z-index:9999; align-items:center; justify-content:center;">

                <div style="width:400px; max-width:90%; background:white; border-radius:16px; box-shadow:0 10px 40px rgba(0,0,0,0.25); overflow:hidden;">

                    <div style="padding:18px 22px; background:linear-gradient(135deg,#c47a7a,#a85d5d); color:white; display:flex; align-items:center; gap:10px;">
                        <i class="fas fa-exclamation-triangle" style="font-size:22px;"></i>
                        <span style="font-size:18px; font-weight:600;">Delete Delivery Person</span>
                    </div>

                    <div style="padding:25px 22px; text-align:center; color:#444;">
                        <i class="fas fa-user-slash" style="font-size:42px; color:#c47a7a; margin-bottom:15px;"></i>
                        <p style="margin:0; font-size:16px; line-height:1.5;">
                            Are you sure you want to delete this delivery person?
                        </p>
                        <p style="margin:8px 0 0; color:#888; font-size:13px;">
                            This action cannot be undone and their login access will be revoked.
                        </p>
                    </div>

                    <div style="padding:15px 22px 20px; display:flex; justify-content:flex-end; gap:10px; background:#f8f9fa;">
                        <button type="button" onclick="closeDeliveryPersonDeletePopup()"
                            style="background:#6c757d; color:white; border:none; border-radius:8px; padding:9px 18px; cursor:pointer; font-size:14px;"
                            onmouseover="this.style.background='#5c636a'"
                            onmouseout="this.style.background='#6c757d'">
                            Cancel
                        </button>
                        <button type="button" onclick="confirmDeliveryPersonDelete()"
                            style="background:#c47a7a; color:white; border:none; border-radius:8px; padding:9px 18px; cursor:pointer; font-size:14px;"
                            onmouseover="this.style.background='#a85d5d'"
                            onmouseout="this.style.background='#c47a7a'">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>

            <script>
                // ===== DELETE =====
                let deleteDeliveryPersonId = null;

                function showDeliveryPersonDeletePopup(id) {
                    deleteDeliveryPersonId = id;
                    document.getElementById('deliveryPersonDeletePopup').style.display = 'flex';
                }

                function closeDeliveryPersonDeletePopup() {
                    deleteDeliveryPersonId = null;
                    document.getElementById('deliveryPersonDeletePopup').style.display = 'none';
                }

                function confirmDeliveryPersonDelete() {
                    if (deleteDeliveryPersonId) {
                        document.getElementById('deleteDeliveryPersonForm' + deleteDeliveryPersonId).submit();
                    }
                }

                // ===== EDIT =====
                function editDeliveryPerson(person) {
                    document.getElementById('edit_dp_name').value = person.name || '';
                    document.getElementById('edit_dp_phone').value = person.contact_number || '';
                    document.getElementById('edit_dp_nic').value = person.nic || '';
                    document.getElementById('edit_dp_vehicle').value = person.vehicle_type || '';
                    document.getElementById('edit_dp_address').value = person.address || '';
                    document.getElementById('edit_dp_email').value = person.email || '';
                    document.getElementById('edit_dp_password').value = '';
                    document.getElementById('edit_dp_status').value = person.status || 'Active';
                    document.getElementById('editDeliveryPersonForm').action = "/admin/delivery-persons/" + person.id;
                }

                function toggleDeliveryPassword(inputId, button) {
                    const input = document.getElementById(inputId);
                    const visible = input.type === 'text';
                    input.type = visible ? 'password' : 'text';
                    button.innerHTML = visible ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                    button.setAttribute('aria-label', visible ? 'Show password' : 'Hide password');
                }

                // ===== VIEW =====
                function viewDeliveryPerson(person) {
                    const modal = new bootstrap.Modal(document.getElementById('viewDeliveryPersonModal'));
                    const body = document.getElementById('viewDeliveryPersonBody');

                    const statusColor = (person.status === 'Active')
                        ? 'background:#e4f5eb; color:#0b7a4d;'
                        : 'background:#fdeaea; color:#b63e3e;';

                    body.innerHTML = `
                        <div style="text-align:center; margin-bottom:1.2rem;">
                            ${person.photo
                                ? `<img src="/storage/${person.photo}" style="width:80px; height:80px; border-radius:50%; object-fit:cover; border:3px solid #d4a373;">`
                                : `<div style="width:80px; height:80px; border-radius:50%; background:linear-gradient(135deg,#e8b4b8,#c47a7a); color:white; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1.8rem; margin:0 auto;">
                                    ${(person.name || 'D').charAt(0).toUpperCase()}
                                </div>`
                            }
                            <h5 style="margin-top:0.8rem; color:#5c3d2e;">${person.name}</h5>
                            <span style="padding:4px 12px; border-radius:50px; font-size:0.72rem; font-weight:700; ${statusColor}">
                                ${person.status || 'Active'}
                            </span>
                        </div>

                        <div style="border-top:1px solid #eadfd4; padding-top:0.8rem;">
                            <div style="display:flex; padding:0.5rem 0; border-bottom:1px solid #f5f0eb;">
                                <span style="width:120px; font-weight:600; color:#7d6458; font-size:0.85rem;">ID</span>
                                <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">#DP-${String(person.id).padStart(4,'0')}</span>
                            </div>
                            <div style="display:flex; padding:0.5rem 0; border-bottom:1px solid #f5f0eb;">
                                <span style="width:120px; font-weight:600; color:#7d6458; font-size:0.85rem;">Email</span>
                                <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${person.email || 'N/A'}</span>
                            </div>
                            <div style="display:flex; padding:0.5rem 0; border-bottom:1px solid #f5f0eb;">
                                <span style="width:120px; font-weight:600; color:#7d6458; font-size:0.85rem;">Phone</span>
                                <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${person.contact_number || 'N/A'}</span>
                            </div>
                            <div style="display:flex; padding:0.5rem 0; border-bottom:1px solid #f5f0eb;">
                                <span style="width:120px; font-weight:600; color:#7d6458; font-size:0.85rem;">NIC</span>
                                <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${person.nic || 'N/A'}</span>
                            </div>
                            <div style="display:flex; padding:0.5rem 0; border-bottom:1px solid #f5f0eb;">
                                <span style="width:120px; font-weight:600; color:#7d6458; font-size:0.85rem;">Vehicle</span>
                                <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${person.vehicle_type || 'N/A'}</span>
                            </div>
                            <div style="display:flex; padding:0.5rem 0; border-bottom:1px solid #f5f0eb;">
                                <span style="width:120px; font-weight:600; color:#7d6458; font-size:0.85rem;">Address</span>
                                <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${person.address || 'N/A'}</span>
                            </div>
                            <div style="display:flex; padding:0.5rem 0;">
                                <span style="width:120px; font-weight:600; color:#7d6458; font-size:0.85rem;">Joined</span>
                                <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${person.created_at ? new Date(person.created_at).toLocaleDateString() : 'N/A'}</span>
                            </div>
                        </div>
                    `;

                    modal.show();
                }
            </script>

            <!-- ===== DELIVERY MANAGEMENT SECTION ===== -->
            <div id="deliverysSection" style="display: none;">

                @if (session('success'))
                    <div class="success-alert alert alert-success mb-4 py-2 px-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ===== TOP STAT CARDS ===== -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-boxes"></i></div>
                            <div class="number">{{ $assignedDeliveries }}</div>
                            <div>Assigned Deliveries</div>
                            <small style="color:#b5835a;"><i class="fas fa-clock"></i> Awaiting pickup</small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-route"></i></div>
                            <div class="number">{{ $inTransitDeliveries }}</div>
                            <div>In Transit</div>
                            <small style="color:#1467a8;"><i class="fas fa-motorcycle"></i> On the way</small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-check-circle"></i></div>
                            <div class="number">{{ $deliveredDeliveries }}</div>
                            <div>Delivered</div>
                            <small style="color:#0b7a4d;"><i class="fas fa-arrow-up"></i> This month</small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-card">
                            <div class="icon"><i class="fas fa-user-slash"></i></div>
                            <div class="number">{{ $failedDeliveries }}</div>
                            <div>Failed</div>
                            <small style="color:#b63e3e;"><i class="fas fa-exclamation-triangle"></i> Needs review</small>
                        </div>
                    </div>
                </div>

                <!-- ===== FILTERS ===== -->
                <div class="data-table mb-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <h5 class="mb-0"><i class="fas fa-filter text-gold"></i> Filter Deliveries</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <select id="deliveryStatusFilter" class="form-select" style="min-width:160px;" onchange="filterDeliveries()">
                                <option value="all">All</option>
                                <option value="pending">Pending</option>
                                <option value="assigned">Assigned</option>
                                <option value="in_transit">In Transit</option>
                                <option value="completed">Completed</option>
                                <option value="delivered">Delivered</option>
                                <option value="failed">Failed</option>
                            </select>
                            <select id="deliveryPersonFilter" class="form-select" style="min-width:180px;" onchange="filterDeliveries()">
                                <option value="all">All Personnel</option>
                                @foreach($deliveryPersons ?? [] as $person)
                                    <option value="{{ $person->id }}">{{ $person->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-warning-custom" onclick="resetDeliveryFilters()">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ===== ASSIGNED DELIVERIES TABLE ===== -->
                <div class="data-table mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h5 class="mb-0"><i class="fas fa-list text-gold"></i> All Deliveries</h5>
                        <button class="btn btn-warning-custom" onclick="openBulkAssignModal()">
                            <i class="fas fa-user-plus"></i> Bulk Assign
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Address</th>
                                    <th>Delivery Person</th>
                                    <th>Delivery Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="deliveriesTableBody">
                                @forelse($deliveries ?? [] as $delivery)
                                @php
                                    $deliveryStatus = strtolower(trim((string) $delivery->status));
                                    $canAssignDelivery = in_array($deliveryStatus, ['pending', 'completed'], true);
                                @endphp
                                <tr class="delivery-row"
                                    data-status="{{ $deliveryStatus }}"
                                    data-person="{{ $delivery->delivery_person_id }}">
                                    <td>
                                        <strong>{{ $delivery->id }}</strong>
                                    </td>
                                    <td>
                                        <div style="font-weight:600;">{{ $delivery->customer_name }}</div>
                                        <div style="font-size:0.75rem; color:#8a7a6e;">
                                            <i class="fas fa-phone" style="font-size:0.65rem;"></i>
                                            {{ $delivery->customer_phone ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-size:0.85rem; max-width:220px;">
                                            {{ Str::limit($delivery->address ?? 'N/A', 45) }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($delivery->delivery_person_id)
                                            <div style="display:flex; align-items:center; gap:0.5rem;">
                                                <div style="width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#e8b4b8,#c47a7a); color:white; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.75rem;">
                                                    {{ strtoupper(substr($delivery->deliveryPerson->name ?? 'D', 0, 1)) }}
                                                </div>
                                                <span style="font-weight:600; font-size:0.85rem;">
                                                    {{ $delivery->deliveryPerson->name ?? 'N/A' }}
                                                </span>
                                            </div>
                                        @elseif($canAssignDelivery)
                                            <button class="btn btn-sm"
                                                style="background:#fff4d6; color:#a26900; border:1px dashed #f59e0b; border-radius:8px; font-size:0.75rem; font-weight:600;"
                                                onclick="openAssignModal({{ $delivery->id }})">
                                                <i class="fas fa-user-plus"></i> Assign Now
                                            </button>
                                        @else
                                            <span class="text-muted small">Assignment unavailable</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="font-size:0.85rem;">
                                            {{ $delivery->delivery_date ? \Carbon\Carbon::parse($delivery->delivery_date)->format('d M Y') : 'N/A' }}
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending'    => ['bg' => '#fff4d6', 'color' => '#a26900', 'label' => 'Pending'],
                                                'assigned'   => ['bg' => '#e3f0fa', 'color' => '#1467a8', 'label' => 'Assigned'],
                                                'in_transit' => ['bg' => '#ede9fe', 'color' => '#6d28d9', 'label' => 'In Transit'],
                                                'completed'  => ['bg' => '#e4f5eb', 'color' => '#0b7a4d', 'label' => 'Completed'],
                                                'delivered'  => ['bg' => '#e4f5eb', 'color' => '#0b7a4d', 'label' => 'Delivered'],
                                                'failed'     => ['bg' => '#fdeaea', 'color' => '#b63e3e', 'label' => 'Failed'],
                                            ];
                                            $sc = $statusColors[$deliveryStatus] ?? $statusColors['pending'];
                                        @endphp
                                        <span style="background:{{ $sc['bg'] }}; color:{{ $sc['color'] }}; padding:4px 12px; border-radius:50px; font-size:0.7rem; font-weight:700;">
                                            {{ $sc['label'] }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($delivery->delivery_person_id)
                                            <button type="button" class="btn btn-sm"
                                                style="background:#e3f0fa; color:#1467a8; border:none; border-radius:8px; padding:6px 10px; font-size:0.75rem;"
                                                onclick='viewDeliveryDetail(@json($delivery))'
                                                title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if($canAssignDelivery)
                                                <button type="button" class="btn btn-sm btn-warning-custom"
                                                    onclick="openReassignModal({{ $delivery->id }})"
                                                    title="Reassign">
                                                    <i class="fas fa-exchange-alt"></i>
                                                </button>
                                            @else
                                                <span class="text-muted small">Assignment unavailable</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center" style="padding:2.5rem; color:#8a7a6e;">
                                        <i class="fas fa-truck" style="font-size:2.5rem; opacity:0.4; display:block; margin-bottom:0.8rem;"></i>
                                        No deliveries found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ===== ANALYTICS CHARTS ===== -->
                <div class="row g-4">
                    <!-- Delivery Status Distribution -->
                    <div class="col-lg-4 col-md-12">
                        <div class="data-table h-100">
                            <h5 class="mb-3"><i class="fas fa-chart-pie text-gold"></i> Status Distribution</h5>
                            <div style="position:relative; height:220px;">
                                <canvas id="deliveryStatusChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Deliveries Per Person -->
                    <div class="col-lg-4 col-md-12">
                        <div class="data-table h-100">
                            <h5 class="mb-3"><i class="fas fa-chart-bar text-gold"></i> Deliveries Per Person</h5>
                            <div style="position:relative; height:220px;">
                                <canvas id="deliveriesPerPersonChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Weekly Delivery Trend -->
                    <div class="col-lg-4 col-md-12">
                        <div class="data-table h-100">
                            <h5 class="mb-3"><i class="fas fa-chart-line text-gold"></i> Weekly Trend</h5>
                            <div style="position:relative; height:220px;">
                                <canvas id="weeklyDeliveryTrendChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== PERFORMANCE TABLE ===== -->
                <div class="data-table mt-4">
                    <h5 class="mb-3"><i class="fas fa-trophy text-gold"></i> Delivery Person Performance</h5>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Delivery Person</th>
                                    <th>Vehicle</th>
                                    <th>Assigned</th>
                                    <th>Delivered</th>
                                    <th>Failed</th>
                                    <th>Success Rate</th>
                                    <th>Avg. Delivery Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deliveryPersons ?? [] as $person)
                                @php
                                    $assigned = $deliveries->where('delivery_person_id', $person->id)->count();
                                    $delivered = $deliveries
                                        ->where('delivery_person_id', $person->id)
                                        ->filter(fn ($delivery) => in_array(strtolower(trim((string) $delivery->status)), ['completed', 'delivered'], true))
                                        ->count();
                                    $failed = $deliveries->where('delivery_person_id', $person->id)->where('status', 'failed')->count();
                                    $rate = $assigned > 0 ? round(($delivered / $assigned) * 100) : 0;
                                @endphp
                                <tr>
                                    <td>
                                        <div style="display:flex; align-items:center; gap:0.6rem;">
                                            <div style="width:38px; height:38px; border-radius:50%; background:linear-gradient(135deg,#e8b4b8,#c47a7a); color:white; display:flex; align-items:center; justify-content:center; font-weight:700;">
                                                {{ strtoupper(substr($person->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div style="font-weight:600;">{{ $person->name }}</div>
                                                <div style="font-size:0.72rem; color:#8a7a6e;">#DP-{{ str_pad($person->id, 4, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="background:#fff0e6; color:#bd6545; padding:3px 10px; border-radius:50px; font-size:0.72rem; font-weight:700;">
                                            <i class="fas fa-motorcycle"></i> {{ $person->vehicle_type ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td><strong>{{ $assigned }}</strong></td>
                                    <td><strong style="color:#0b7a4d;">{{ $delivered }}</strong></td>
                                    <td><strong style="color:#b63e3e;">{{ $failed }}</strong></td>
                                    <td>
                                        <div style="display:flex; align-items:center; gap:0.5rem;">
                                            <div style="flex:1; max-width:100px; height:6px; background:#f0e8e0; border-radius:50px; overflow:hidden;">
                                                <div style="width:{{ $rate }}%; height:100%; background:linear-gradient(90deg,#d4a373,#b5835a);"></div>
                                            </div>
                                            <span style="font-weight:700; font-size:0.85rem;">{{ $rate }}%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="color:#8a7a6e; font-size:0.85rem;">
                                            {{ rand(20, 45) }} mins
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center" style="color:#8a7a6e; padding:1.5rem;">No performance data yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


            <!-- ===== ASSIGN DELIVERY MODAL ===== -->
            <div class="modal fade" id="assignDeliveryModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form method="POST" id="assignDeliveryForm">
                            @csrf
                            <div class="modal-header">
                                <h5><i class="fas fa-user-plus me-2"></i> Assign Delivery Person</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div style="background:#fff0e6; border-radius:14px; padding:1rem; margin-bottom:1.2rem;">
                                    <div style="font-size:0.72rem; color:#8a7a6e; text-transform:uppercase; font-weight:700;">Assigning to Order</div>
                                    <div id="assignOrderId" style="font-size:1.2rem; font-weight:700; color:#5c3d2e;"></div>
                                </div>

                                <label>Select Delivery Person <span style="color:#dc3545;">*</span></label>
                                <select name="delivery_person_id" class="form-select" required>
                                    <option value="">— Choose a delivery person —</option>
                                    @foreach($deliveryPersons ?? [] as $person)
                                        <option value="{{ $person->id }}">
                                            {{ $person->name }} ({{ $person->vehicle_type ?? 'No vehicle' }})
                                        </option>
                                    @endforeach
                                </select>

                                <label style="margin-top:1rem;">Priority Level</label>
                                <select name="priority" class="form-select">
                                    <option value="normal">Normal</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>

                                <label style="margin-top:1rem;">Delivery Notes</label>
                                <textarea name="notes" class="form-control" rows="2" placeholder="Any special instructions for the delivery person..."></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning-custom">
                                    <i class="fas fa-check"></i> Assign Delivery
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- ===== REASSIGN / EDIT DELIVERY MODAL ===== -->
            <div class="modal fade" id="reassignDeliveryModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form method="POST" id="reassignDeliveryForm">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5><i class="fas fa-exchange-alt me-2"></i> Reassign Delivery</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div style="background:#fff0e6; border-radius:14px; padding:1rem; margin-bottom:1.2rem;">
                                    <div style="font-size:0.72rem; color:#8a7a6e; text-transform:uppercase; font-weight:700;">Reassigning Order</div>
                                    <div id="reassignOrderId" style="font-size:1.2rem; font-weight:700; color:#5c3d2e;"></div>
                                </div>

                                <label>Change Delivery Person <span style="color:#dc3545;">*</span></label>
                                <select name="delivery_person_id" id="reassignPersonSelect" class="form-select" required>
                                    <option value="">— Choose a delivery person —</option>
                                    @foreach($deliveryPersons ?? [] as $person)
                                        <option value="{{ $person->id }}">
                                            {{ $person->name }} ({{ $person->vehicle_type ?? 'No vehicle' }})
                                        </option>
                                    @endforeach
                                </select>

                                <label style="margin-top:1rem;">Reason for Reassignment</label>
                                <textarea name="reassign_reason" class="form-control" rows="2" placeholder="e.g., Original delivery person unavailable"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning-custom">
                                    <i class="fas fa-sync-alt"></i> Update Assignment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- ===== BULK ASSIGN MODAL ===== -->
            <div class="modal fade" id="bulkAssignModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form method="POST" action="#">
                            @csrf
                            <div class="modal-header">
                                <h5><i class="fas fa-layer-group me-2"></i> Bulk Assign Deliveries</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div style="background:#fff0e6; border-radius:14px; padding:0.9rem 1rem; margin-bottom:1.2rem; font-size:0.85rem; color:#7d6458;">
                                    <i class="fas fa-info-circle" style="color:#d4a373;"></i>
                                    Select multiple unassigned orders below and assign them all to a single delivery person.
                                </div>

                                <label>Select Delivery Person <span style="color:#dc3545;">*</span></label>
                                <select name="delivery_person_id" class="form-select mb-3" required>
                                    <option value="">— Choose a delivery person —</option>
                                    @foreach($deliveryPersons ?? [] as $person)
                                        <option value="{{ $person->id }}">
                                            {{ $person->name }} ({{ $person->vehicle_type ?? 'No vehicle' }})
                                        </option>
                                    @endforeach
                                </select>

                                <label>Select Orders</label>
                                <div style="max-height:280px; overflow-y:auto; border:1px solid #eadfd4; border-radius:14px; padding:0.8rem;">
                                    
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning-custom">
                                    <i class="fas fa-check-double"></i> Assign Selected
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- ===== VIEW DELIVERY DETAIL MODAL ===== -->
            <div class="modal fade" id="viewDeliveryDetailModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5><i class="fas fa-info-circle me-2"></i> Delivery Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="viewDeliveryDetailBody">
                            <!-- Filled by JS -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // ===== OPEN ASSIGN MODAL =====
                function openAssignModal(deliveryId, orderId) {
                    document.getElementById('assignOrderId').textContent = '#ORD-' + (orderId || deliveryId);
                    document.getElementById('assignDeliveryForm').action = '/admin/orders/' + deliveryId + '/assign-delivery';
                    new bootstrap.Modal(document.getElementById('assignDeliveryModal')).show();
                }

                // ===== OPEN REASSIGN MODAL =====
                function openReassignModal(deliveryId, currentPersonId, currentStatus, orderId) {
                    document.getElementById('reassignOrderId').textContent = '#ORD-' + (orderId || deliveryId);
                    if (currentPersonId) document.getElementById('reassignPersonSelect').value = currentPersonId;
                    document.getElementById('reassignDeliveryForm').action = '/admin/orders/' + deliveryId + '/reassign-delivery';
                    new bootstrap.Modal(document.getElementById('reassignDeliveryModal')).show();
                }

                // ===== OPEN BULK ASSIGN MODAL =====
                function openBulkAssignModal() {
                    new bootstrap.Modal(document.getElementById('bulkAssignModal')).show();
                }

                // ===== FILTER DELIVERIES =====
                function filterDeliveries() {
                    const statusFilter = document.getElementById('deliveryStatusFilter').value;
                    const personFilter = document.getElementById('deliveryPersonFilter').value;
                    document.querySelectorAll('.delivery-row').forEach(row => {
                        const matchStatus = (statusFilter === 'all') || (row.dataset.status === statusFilter);
                        const matchPerson = (personFilter === 'all') || (row.dataset.person === personFilter);
                        row.style.display = (matchStatus && matchPerson) ? '' : 'none';
                    });
                }

                function resetDeliveryFilters() {
                    document.getElementById('deliveryStatusFilter').value = 'all';
                    document.getElementById('deliveryPersonFilter').value = 'all';
                    filterDeliveries();
                }

                // ===== VIEW DELIVERY DETAIL =====
                function viewDeliveryDetail(delivery) {
                    const modal = new bootstrap.Modal(document.getElementById('viewDeliveryDetailModal'));
                    const body = document.getElementById('viewDeliveryDetailBody');

                    const statusColor = {
                        'pending': 'background:#fff4d6; color:#a26900;',
                        'assigned': 'background:#e3f0fa; color:#1467a8;',
                        'in_transit': 'background:#ede9fe; color:#6d28d9;',
                        'delivered': 'background:#e4f5eb; color:#0b7a4d;',
                        'failed': 'background:#fdeaea; color:#b63e3e;'
                    }[delivery.status] || 'background:#eee; color:#666;';

                    body.innerHTML = `
                        <div style="background:linear-gradient(135deg,#fff0e6,#fffaf4); border-radius:16px; padding:1.2rem; margin-bottom:1.2rem; text-align:center;">
                            <div style="font-size:0.72rem; color:#8a7a6e; text-transform:uppercase; font-weight:700;">Order</div>
                            <div style="font-size:1.6rem; font-weight:800; color:#5c3d2e;">${delivery.id}</div>
                            <span style="padding:4px 14px; border-radius:50px; font-size:0.72rem; font-weight:700; ${statusColor} margin-top:0.5rem; display:inline-block;">
                                ${delivery.status || 'Pending'}
                            </span>
                        </div>

                        <div style="display:flex; padding:0.6rem 0; border-bottom:1px solid #f5f0eb;">
                            <span style="width:130px; font-weight:600; color:#7d6458; font-size:0.85rem;">Customer</span>
                            <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${delivery.customer_name || 'N/A'}</span>
                        </div>
                        <div style="display:flex; padding:0.6rem 0; border-bottom:1px solid #f5f0eb;">
                            <span style="width:130px; font-weight:600; color:#7d6458; font-size:0.85rem;">Phone</span>
                            <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${delivery.customer_phone || 'N/A'}</span>
                        </div>
                        <div style="display:flex; padding:0.6rem 0; border-bottom:1px solid #f5f0eb;">
                            <span style="width:130px; font-weight:600; color:#7d6458; font-size:0.85rem;">Address</span>
                            <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${delivery.address || 'N/A'}</span>
                        </div>
                        <div style="display:flex; padding:0.6rem 0; border-bottom:1px solid #f5f0eb;">
                            <span style="width:130px; font-weight:600; color:#7d6458; font-size:0.85rem;">Delivery Person</span>
                            <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${delivery.delivery_person_name || 'N/A'}</span>
                        </div>
                        <div style="display:flex; padding:0.6rem 0; border-bottom:1px solid #f5f0eb;">
                            <span style="width:130px; font-weight:600; color:#7d6458; font-size:0.85rem;">Delivery Date</span>
                            <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${delivery.delivery_date || 'N/A'}</span>
                        </div>
                        <div style="display:flex; padding:0.6rem 0;">
                            <span style="width:130px; font-weight:600; color:#7d6458; font-size:0.85rem;">Notes</span>
                            <span style="font-weight:500; color:#2c241f; font-size:0.9rem;">${delivery.notes || 'None'}</span>
                        </div>
                    `;

                    modal.show();
                }

                // ===== CHARTS =====
                document.addEventListener('DOMContentLoaded', function () {

                    // --- Status Distribution Doughnut ---
                    const statusCtx = document.getElementById('deliveryStatusChart')?.getContext('2d');
                    if (statusCtx) {
                        new Chart(statusCtx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Pending', 'Assigned', 'Picked Up / In Transit', 'Delivered', 'Failed'],
                                datasets: [{
                                    data: @json($deliveryStatusCounts->values()),
                                    backgroundColor: ['#facc15', '#60a5fa', '#a5b4fc', '#4ade80', '#fb7185'],
                                    borderColor: '#fff',
                                    borderWidth: 3,
                                    hoverOffset: 8
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: { color: '#7d6458', font: { size: 11, weight: 600 }, padding: 12, usePointStyle: true }
                                    }
                                },
                                cutout: '65%'
                            }
                        });
                    }

                    // --- Deliveries Per Person Bar ---
                    const personCtx = document.getElementById('deliveriesPerPersonChart')?.getContext('2d');
                    if (personCtx) {
                        new Chart(personCtx, {
                            type: 'bar',
                            data: {
                                labels: {!! json_encode(($deliveryPersons ?? collect())->pluck('name')->take(6)) !!},
                                datasets: [{
                                    label: 'Deliveries',
                                    data: {!! json_encode(($deliveryPersons ?? collect())->take(6)->map(fn($p) => $deliveries->where('delivery_person_id', $p->id)->count())) !!},
                                    backgroundColor: ['#e8b4b8', '#d4918f', '#c47a7a', '#b5835a', '#a86a5a', '#8a5a4a'],
                                    borderRadius: 8,
                                    barThickness: 26
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { display: false } },
                                scales: {
                                    y: { beginAtZero: true, ticks: { color: '#8a7a6e', font: { size: 10 } }, grid: { color: '#f5f0eb' } },
                                    x: { ticks: { color: '#8a7a6e', font: { size: 10 } }, grid: { display: false } }
                                }
                            }
                        });
                    }

                    // --- Weekly Delivery Trend Line ---
                    const trendCtx = document.getElementById('weeklyDeliveryTrendChart')?.getContext('2d');
                    if (trendCtx) {
                        new Chart(trendCtx, {
                            type: 'line',
                            data: {
                                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                                datasets: [{
                                    label: 'Deliveries',
                                    data: [8, 12, 10, 15, 18, 22, 16],
                                    borderColor: '#c47a7a',
                                    backgroundColor: 'rgba(196, 122, 122, 0.12)',
                                    fill: true,
                                    tension: 0.4,
                                    pointBackgroundColor: '#c47a7a',
                                    pointBorderColor: '#fff',
                                    pointBorderWidth: 2,
                                    pointRadius: 5
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { display: false } },
                                scales: {
                                    y: { beginAtZero: true, ticks: { color: '#8a7a6e', font: { size: 10 } }, grid: { color: '#f5f0eb' } },
                                    x: { ticks: { color: '#8a7a6e', font: { size: 10 } }, grid: { display: false } }
                                }
                            }
                        });
                    }
                });
            </script>
            </div>

                <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-gold" id="orderDetailsModalLabel">Order Details</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="orderDetailsBody"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
    </div> 
        


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ===== DROPDOWN TOGGLE =====
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdownMenu = document.getElementById('userDropdownMenu');
        const dropdownChevron = userDropdownToggle?.querySelector('.fa-chevron-down');

        if (userDropdownToggle) {
            userDropdownToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdownMenu.classList.toggle('show');
                if (dropdownChevron) {
                    dropdownChevron.style.transform = userDropdownMenu.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0deg)';
                }
            });
        }

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown-container')) {
                userDropdownMenu?.classList.remove('show');
                if (dropdownChevron) {
                    dropdownChevron.style.transform = 'rotate(0deg)';
                }
            }
        });

        // ===== SIDEBAR TOGGLE =====
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.querySelector('.mobile-toggle');
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(e.target) && !toggleBtn?.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });

        // ===== SECTION NAVIGATION =====
        function showSection(sectionId) {
            const sections = ['dashboardSection','productsSection','inventorySection','categoriesSection','ordersSection','customersSection','reportsSection','delivery_personSection','deliverysSection'];
            sections.forEach(sec => {
                const el = document.getElementById(sec);
                if (el) el.style.display = 'none';
            });
            const target = document.getElementById(sectionId + 'Section');
            if (target) target.style.display = 'block';
            
            let title = sectionId.replace('-',' ').replace(/(^\w|\s\w)/g, m => m.toUpperCase());
            document.getElementById('pageTitle').innerText = title;
            
            document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('active'));
            const activeItem = document.querySelector(`.menu-item[data-section="${sectionId}"]`);
            if (activeItem) activeItem.classList.add('active');

            // Close sidebar on mobile after navigation
            if (window.innerWidth <= 992) {
                document.getElementById('sidebar').classList.remove('active');
            }
        }

        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', (e) => {
                const section = item.getAttribute('data-section');
                if (section === 'inventory' && !document.getElementById('inventorySection')) {
                    window.location.assign(item.dataset.url);
                    return;
                }
                if (section) showSection(section);
            });
        });

        // ===== CHARTS =====
        let topChart, salesChart;
        window.addEventListener('load', () => {
            const topCtx = document.getElementById('topProductsChart')?.getContext('2d');
            if(topCtx) {
                topChart = new Chart(topCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($topSellingProducts->pluck('name')->values()) !!},
                        datasets: [{
                            label: 'Sold',
                            data: {!! json_encode($topSellingProducts->pluck('orders')->values()) !!},
                            backgroundColor: ['#f59e0b', '#fbbf24', '#fcd34d', '#f59e0b'],
                            borderRadius: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: { labels: { color: '#cfc6bc' } }
                        },
                        scales: {
                            y: { ticks: { color: '#cfc6bc' } },
                            x: { ticks: { color: '#cfc6bc' } }
                        }
                    }
                });
            }
            const salesCtx = document.getElementById('salesChart')?.getContext('2d');
            if(salesCtx) {
                salesChart = new Chart(salesCtx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                        datasets: [{
                            label: 'Revenue $',
                            data: [3200, 4500, 3800, 5200, 4800, 6234],
                            borderColor: '#f59e0b',
                            backgroundColor: 'rgba(245,158,11,0.1)',
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: { labels: { color: '#cfc6bc' } }
                        },
                        scales: {
                            y: { ticks: { color: '#cfc6bc' } },
                            x: { ticks: { color: '#cfc6bc' } }
                        }
                    }
                });
            }
        });

        // ===== HELPER FUNCTIONS =====
        window.showProductModal = () => new bootstrap.Modal(document.getElementById('productModal')).show();
        window.showCategoryModal = () => new bootstrap.Modal(document.getElementById('categoryModal')).show();
        window.approveCustomCake = () => alert('✨ Custom cake order approved! Customer will be notified.');
        window.updateOrderStatus = (select, routeUrl) => {
            if (select && select.form) {
                select.form.submit();
            }
        };

        // ===== ORDER STATUS BOARD =====
        let draggedOrderCard = null;

        document.querySelectorAll('.admin-order-card').forEach((card) => {
            if (['delivered', 'cancel'].includes(card.dataset.status)) {
                card.draggable = false;
                card.style.cursor = 'default';
                return;
            }

            card.addEventListener('dragstart', () => {
                draggedOrderCard = card;
                card.classList.add('dragging');
            });

            card.addEventListener('dragend', () => {
                card.classList.remove('dragging');
                draggedOrderCard = null;
                document.querySelectorAll('.order-lane').forEach((lane) => lane.classList.remove('drag-over'));
            });
        });

        document.querySelectorAll('.order-lane').forEach((lane) => {
            lane.addEventListener('dragover', (event) => {
                event.preventDefault();
                lane.classList.add('drag-over');
            });

            lane.addEventListener('dragleave', (event) => {
                if (!lane.contains(event.relatedTarget)) {
                    lane.classList.remove('drag-over');
                }
            });

            lane.addEventListener('drop', async (event) => {
                event.preventDefault();
                lane.classList.remove('drag-over');

                if (!draggedOrderCard || ['delivered', 'cancel'].includes(draggedOrderCard.dataset.status) || draggedOrderCard.dataset.status === lane.dataset.status) {
                    return;
                }

                const previousLane = draggedOrderCard.closest('.order-lane');
                const previousStatus = draggedOrderCard.dataset.status;
                const targetCards = lane.querySelector('.order-lane-cards');
                const emptyState = targetCards.querySelector('.order-board-empty');
                emptyState?.remove();
                targetCards.appendChild(draggedOrderCard);
                draggedOrderCard.dataset.status = lane.dataset.status;
                updateOrderLaneCounts();

                try {
                    const response = await fetch(draggedOrderCard.dataset.updateUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ status: lane.dataset.status }),
                    });

                    if (!response.ok) {
                        throw new Error('Status update failed');
                    }
                } catch (error) {
                    const originalCards = previousLane.querySelector('.order-lane-cards');
                    originalCards.appendChild(draggedOrderCard);
                    draggedOrderCard.dataset.status = previousStatus;
                    updateOrderLaneCounts();
                    alert('Unable to update the order status. Please try again.');
                }
            });
        });

        function updateOrderLaneCounts() {
            document.querySelectorAll('.order-lane').forEach((lane) => {
                const cards = lane.querySelectorAll('.admin-order-card');
                lane.querySelector('.order-lane-count').textContent = cards.length;
                const emptyState = lane.querySelector('.order-board-empty');
                if (cards.length === 0 && !emptyState) {
                    lane.querySelector('.order-lane-cards').innerHTML = '<div class="order-board-empty">No orders</div>';
                } else if (cards.length > 0) {
                    emptyState?.remove();
                }
            });
        }

        window.viewOrder = (order) => {
            const detailModal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
            const modalBody = document.getElementById('orderDetailsBody');
            const displayValue = (value) => value ?? 'N/A';
            const safeStatus = (value) => (value ? String(value).charAt(0).toUpperCase() + String(value).slice(1) : 'Pending');
            const isLocked = ['delivered', 'cancel'].includes(String(order.status || '').toLowerCase());
            const storageBase = "{{ asset('storage') }}";
            const designImage = order.design_image ? `${storageBase}/${order.design_image}` : '';
            const designMarkup = designImage
                ? `<div class="col-12"><div class="p-3 rounded" style="background:#2a221d;"><strong>Design Image</strong><br><img src="${designImage}" alt="Custom cake design" class="img-fluid rounded mt-2" style="max-height:260px; object-fit:cover; border:1px solid rgba(245,158,11,0.5);"></div></div>`
                : `<div class="col-12"><div class="p-3 rounded" style="background:#2a221d;"><strong>Design Image</strong><br><span class="text-muted">No custom cake design uploaded.</span></div></div>`;
            const isCustomCake = String(order.product_name || '').trim().toLowerCase() === 'custom cake';

            modalBody.innerHTML = `
                <div class="row g-3">
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Order #</strong><br>#${order.id}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Status</strong><br><span class="badge-status bg-warning text-dark">${safeStatus(order.status)}</span></div></div>
                    <div class="col-md-12">
                        <form method="POST" action="{{ url('/admin/orders') }}/${order.id}/update-status" class="d-flex align-items-end gap-2">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="flex-grow-1">
                                <label for="receiptStatus" class="form-label mb-1">Change Status</label>
                                <select name="status" id="receiptStatus" class="form-select" ${isLocked ? 'disabled' : ''}>
                                    <option value="pending" ${String(order.status).toLowerCase() === 'pending' ? 'selected' : ''}>Pending</option>
                                    <option value="processing" ${String(order.status).toLowerCase() === 'processing' ? 'selected' : ''}>Processing</option>
                                    <option value="completed" ${String(order.status).toLowerCase() === 'completed' ? 'selected' : ''}>Completed</option>
                                    <option value="delivered" ${String(order.status).toLowerCase() === 'delivered' ? 'selected' : ''}>Delivered</option>
                                    <option value="cancel" ${String(order.status).toLowerCase() === 'cancel' ? 'selected' : ''}>Cancelled</option>
                                </select>
                            </div>
                            ${isCustomCake ? `<div class="flex-grow-1"><label for="receiptTotalPrice" class="form-label mb-1">Custom Cake Total Price</label><input type="number" min="0" step="0.01" name="total_price" id="receiptTotalPrice" class="form-control" value="${Number(order.total_price || 0).toFixed(2)}" ${isLocked ? 'disabled' : ''}></div>` : ''}
                            ${isLocked ? '<span class="text-muted small">This order is locked.</span>' : '<button type="submit" class="btn btn-warning-custom">Update Order</button>'}
                        </form>
                    </div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Customer</strong><br>${displayValue(order.customer_name)}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Phone</strong><br>${displayValue(order.phone)}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Product</strong><br>${displayValue(order.product_name)}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Delivery</strong><br>${displayValue(order.delivery_option)}</div></div>
                    ${designMarkup}
                    <div class="col-md-12"><div class="p-3 rounded" style="background:#2a221d;"><strong>Address</strong><br>${displayValue(order.address)}, ${displayValue(order.city)}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Cake Size</strong><br>${displayValue(order.cake_size)}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Flavor & Frosting</strong><br>${displayValue(order.flavor)} / ${displayValue(order.frosting)}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Delivery Date</strong><br>${displayValue(order.delivery_date)}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Total</strong><br>Rs. ${Number(order.total_price || 0).toFixed(2)}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Advance</strong><br>${order.advance_amount ? `Rs. ${Number(order.advance_amount).toFixed(2)}` : 'N/A'}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Online Transaction</strong><br>${displayValue(order.transaction_id)}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Payment Method</strong><br>${displayValue(order.payment_method)}</div></div>
                    <div class="col-md-6"><div class="p-3 rounded" style="background:#2a221d;"><strong>Card</strong><br>${order.card_type ? `${displayValue(order.card_type)} ending ${displayValue(order.card_last_four)}` : 'N/A'}</div></div>
                    <div class="col-md-12"><div class="p-3 rounded" style="background:#2a221d;"><strong>Message</strong><br>${displayValue(order.cake_message)}</div></div>
                    <div class="col-md-12"><div class="p-3 rounded" style="background:#2a221d;"><strong>Notes</strong><br>${displayValue(order.special_notes)}</div></div>
                </div>
            `;
            detailModal.show();
        };

        // Edit category function
        function editCategory(id, name, description) {
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description;
            document.getElementById('editCategoryForm').action = "/categories/" + id;
        }

        // Edit product function
        function editProduct(id, category, name, description, price, size, status, image) {
            document.getElementById('edit_category').value = category;
            document.getElementById('edit_product_name').value = name;
            document.getElementById('edit_product_description').value = description;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_size').value = size || '';
            document.getElementById('edit_status').value = status;

            document.getElementById('editProductForm').action = "/products/" + id;
        }

        // Auto-hide success alert
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.success-alert').forEach(function (alert) {
                setTimeout(function () {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    setTimeout(function () { alert.remove(); }, 500);
                }, 5000);
            });

            // Show the intended section when redirected from CRUD actions or filter submissions
            @if(session('activeSection') === 'categories')
                showSection('categories');
            @elseif(session('activeSection') === 'products')
                showSection('products');
            @elseif(session('activeSection') === 'inventory' || request('section') === 'inventory')
                showSection('inventory');
            @elseif(session('activeSection') === 'orders' || request('section') === 'orders')
                showSection('orders');
            @elseif(session('activeSection') === 'delivery_person' || request('section') === 'delivery_person')
                showSection('delivery_person');
            @elseif(session('activeSection') === 'deliverys' || request('section') === 'deliverys')
                showSection('deliverys');
            @elseif(session('activeSection') === 'reports' || request('section') === 'reports')
                showSection('reports');
            @elseif(session('activeSection') === 'dashboard' || request('section') === 'dashboard')
                showSection('dashboard');
            @endif

            @if($errors->deliveryPerson->any())
                bootstrap.Modal.getOrCreateInstance(document.getElementById('deliveryPersonModal')).show();
            @endif

            const inventorySearch = document.getElementById('inventorySearch');
            const inventoryStatusFilter = document.getElementById('inventoryStatusFilter');
            const inventoryRows = Array.from(document.querySelectorAll('#inventoryTable tbody tr[data-stock-level]'));
            const inventoryNoResults = document.getElementById('inventoryNoResults');
            const filterInventory = () => {
                const search = (inventorySearch?.value || '').trim().toLowerCase();
                const status = inventoryStatusFilter?.value || 'all';
                let visibleCount = 0;

                inventoryRows.forEach(row => {
                    const matchesSearch = row.dataset.name.includes(search) || row.dataset.category.includes(search);
                    const matchesStatus = status === 'all' || row.dataset.stockLevel === status;
                    row.style.display = matchesSearch && matchesStatus ? '' : 'none';
                    if (matchesSearch && matchesStatus) visibleCount++;
                });

                if (inventoryNoResults) inventoryNoResults.style.display = inventoryRows.length && visibleCount === 0 ? '' : 'none';
            };
            inventorySearch?.addEventListener('input', filterInventory);
            inventoryStatusFilter?.addEventListener('change', filterInventory);

            const deliveryPersonSearch = document.getElementById('deliveryPersonSearch');
            const deliveryPersonRows = Array.from(document.querySelectorAll('#delivery_personSection tbody tr[data-delivery-person-id]'));
            const deliveryPersonNoResults = document.getElementById('deliveryPersonNoResults');
            deliveryPersonSearch?.addEventListener('input', () => {
                const search = deliveryPersonSearch.value.trim().toLowerCase().replace(/[^a-z0-9]/g, '');
                let visibleCount = 0;

                deliveryPersonRows.forEach(row => {
                    const id = row.dataset.deliveryPersonId || '';
                    const code = (row.dataset.deliveryPersonCode || '').toLowerCase().replace(/[^a-z0-9]/g, '');
                    const matches = id.includes(search) || code.includes(search);
                    row.style.display = matches ? '' : 'none';
                    if (matches) visibleCount++;
                });

                if (deliveryPersonNoResults) {
                    deliveryPersonNoResults.style.display = deliveryPersonRows.length > 0 && visibleCount === 0 ? '' : 'none';
                }
            });
        });

        // ===== REPORTS SECTION CHARTS =====
        let reportRevenueChart, reportStatusChart, reportCategoryChart;

        function initReportCharts() {
            /* --- Revenue Trend --- */
            const revenueCtx = document.getElementById('reportRevenueChart')?.getContext('2d');
            if (revenueCtx && !reportRevenueChart) {
                reportRevenueChart = new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: @json($reportRevenueLabels),
                        datasets: [{
                            label: 'Revenue (Rs.)',
                            data: @json($reportRevenueValues),
                            borderColor: '#d4a373',
                            backgroundColor: 'rgba(212, 163, 115, 0.15)',
                            fill: true,
                            tension: 0.4,
                            borderWidth: 2.5,
                            pointBackgroundColor: '#b5835a',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#5c3d2e',
                                padding: 12,
                                titleFont: { size: 13, weight: 700 },
                                bodyFont: { size: 12 },
                                cornerRadius: 8,
                                callbacks: {
                                    label: (ctx) => 'Rs. ' + ctx.parsed.y.toLocaleString()
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#8a7a6e',
                                    font: { size: 10 },
                                    callback: (v) => 'Rs.' + (v / 1000) + 'k'
                                },
                                grid: { color: '#f5f0eb' }
                            },
                            x: {
                                ticks: { color: '#8a7a6e', font: { size: 10 } },
                                grid: { display: false }
                            }
                        }
                    }
                });
            }

            /* --- Order Status Doughnut --- */
            const statusCtx = document.getElementById('reportStatusChart')?.getContext('2d');
            if (statusCtx && !reportStatusChart) {
                reportStatusChart = new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: @json(collect($reportStatuses)->map(fn ($status) => ucfirst(str_replace('_', ' ', $status)))->values()),
                        datasets: [{
                            data: @json($reportStatusValues),
                            backgroundColor: ['#facc15','#60a5fa','#4ade80','#34d399','#fca5a5','#93c5fd','#a5b4fc','#fb7185'],
                            borderColor: '#fff',
                            borderWidth: 3,
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '65%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: '#7d6458',
                                    font: { size: 11, weight: 600 },
                                    padding: 12,
                                    usePointStyle: true,
                                    pointStyle: 'circle'
                                }
                            }
                        }
                    }
                });
            }

            /* --- Sales by Category --- */
            const catCtx = document.getElementById('reportCategoryChart')?.getContext('2d');
            if (catCtx && !reportCategoryChart) {
                reportCategoryChart = new Chart(catCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($reportCategorySales->pluck('name')->values()),
                        datasets: [{
                            label: 'Revenue (Rs.)',
                            data: @json($reportCategorySales->pluck('revenue')->values()),
                            backgroundColor: [
                                '#d4a373','#e0b48a','#c79968','#b5835a','#a06b48'
                            ],
                            borderRadius: 8,
                            barThickness: 32
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { color: '#8a7a6e', font: { size: 10 } },
                                grid: { color: '#f5f0eb' }
                            },
                            x: {
                                ticks: { color: '#8a7a6e', font: { size: 10 } },
                                grid: { display: false }
                            }
                        }
                    }
                });
            }
        }

        function exportReport() {
            const rows = [
                ['Order ID', 'Customer', 'Product', 'Order Total (Rs.)', 'Refund Value (Rs.)', 'Net Revenue (Rs.)', 'Status', 'Date'],
                ...@json($reportExportRows).map((order) => [
                    order.order_id,
                    order.customer || '',
                    order.product || '',
                    order.total || 0,
                    order.refund || 0,
                    order.net_total || 0,
                    order.status || '',
                    order.date || ''
                ])
            ];
            rows.push(['', '', 'Gross Order Total', @json($reportGrossRevenue), 0, @json($reportGrossRevenue), '', '']);
            rows.push(['', '', 'Cancelled Refunds', @json($reportRefundTotal), @json($reportRefundTotal), 0, '', '']);
            rows.push(['', '', 'Net Revenue', @json($reportRevenue), 0, @json($reportRevenue), '', '']);
            const csv = rows.map(row => row.map(value => `"${String(value).replaceAll('"', '""')}"`).join(',')).join('\n');
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'disna-bakery-report.csv';
            a.click();
            URL.revokeObjectURL(url);
        }

        // Re-init charts when reports section becomes visible
        const _originalShowSection = window.showSection;
        window.showSection = function (sectionId) {
            _originalShowSection(sectionId);
            if (sectionId === 'deliverys') {
                setTimeout(() => {
                    ['deliveryStatusChart', 'deliveriesPerPersonChart', 'weeklyDeliveryTrendChart'].forEach(id => {
                        Chart.getChart(id)?.resize();
                    });
                }, 50);
            }
            if (sectionId === 'reports') {
                setTimeout(initReportCharts, 50);
            }
        };

        // Init on load if reports is already visible
        window.addEventListener('load', () => {
            if (document.getElementById('reportsSection')?.style.display !== 'none') {
                setTimeout(initReportCharts, 100);
            }
        });
    </script>
</body>
</html>