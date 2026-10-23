<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Dashboard - Disna Bakery</title>
    <!-- logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    
    <!-- Leaflet CSS for Maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f5f0eb;
            color: #2c241f;
            min-height: 100vh;
        }

        /* ===== DASHBOARD ===== */
        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        /* ===== TOP BAR ===== */
        .top-bar {
            background: white;
            border-radius: 20px;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
            border: 1px solid #eadfd4;
        }

        .top-bar .brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .top-bar .brand span {
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #2c241f;
        }

        .top-bar .brand i {
            font-size: 1.8rem;
            color: #d4918f;
        }

        .top-bar .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .top-bar .user-info .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e8b4b8, #c47a7a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .top-bar .user-info .name {
            font-weight: 600;
        }

        .top-bar .user-info .role {
            font-size: 0.75rem;
            color: #8a7a6e;
        }

        /* ===== STATS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 18px;
            padding: 1.2rem 1.5rem;
            border: 1px solid #eadfd4;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            text-align: center;
        }

        .stat-card .number {
            font-size: 2rem;
            font-weight: 800;
            color: #2c241f;
        }

        .stat-card .label {
            font-size: 0.75rem;
            color: #8a7a6e;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .stat-card .icon {
            font-size: 1.5rem;
            color: #d4918f;
            margin-bottom: 0.3rem;
        }

        /* ===== ORDER LIST ===== */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-bottom: 1rem;
        }

        .section-header h3 {
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 1.4rem;
            color: #2c241f;
        }

        .filter-tabs {
            display: flex;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 0.4rem 1rem;
            border-radius: 50px;
            border: 1.5px solid #eadfd4;
            background: white;
            color: #5c3d2e;
            font-weight: 600;
            font-size: 0.78rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-tab.active,
        .filter-tab:hover {
            background: linear-gradient(135deg, #d4918f, #c47a7a);
            color: white;
            border-color: #d4918f;
        }

        /* ===== ORDER CARD ===== */
        .order-card {
            background: white;
            border-radius: 18px;
            padding: 1.2rem 1.5rem;
            border: 1px solid #eadfd4;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .order-card:hover {
            border-color: #d4918f;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
        }

        .order-card .order-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-bottom: 0.8rem;
        }

        .order-card .order-id {
            font-weight: 700;
            color: #2c241f;
            font-size: 1rem;
        }

        .order-card .order-id i {
            color: #d4918f;
            margin-right: 0.3rem;
        }

        .order-status-badge {
            padding: 0.3rem 0.9rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: capitalize;
        }

        .order-status-badge.pending {
            background: #fff4d6;
            color: #a26900;
        }

        .order-status-badge.assigned {
            background: #e3f0fa;
            color: #1467a8;
        }

        .order-status-badge.picked {
            background: #e4f5eb;
            color: #0b7a4d;
        }

        .order-status-badge.delivered {
            background: #d4edda;
            color: #0b5e3a;
        }

        .order-status-badge.cancelled {
            background: #fdeaea;
            color: #b63e3e;
        }

        .order-card .order-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 0.6rem 1.2rem;
            padding: 0.6rem 0 0.8rem;
            border-top: 1px solid #f0e8e0;
        }

        .order-card .detail-item .label {
            font-size: 0.68rem;
            text-transform: uppercase;
            color: #8a7a6e;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .order-card .detail-item .value {
            font-weight: 600;
            font-size: 0.92rem;
            color: #2c241f;
        }

        .order-card .detail-item .value .address-line {
            display: block;
            font-weight: 400;
            font-size: 0.82rem;
            color: #6C5B4A;
        }

        /* ===== MAP ===== */
        .map-container {
            margin-top: 0.5rem;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid #eadfd4;
            height: 200px;
            width: 100%;
        }

        .map-container #map {
            height: 100%;
            width: 100%;
        }

        /* ===== STATUS UPDATE ===== */
        .status-update {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
            margin-top: 0.8rem;
            padding-top: 0.8rem;
            border-top: 1px solid #f0e8e0;
        }

        .status-update select {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            border: 2px solid #eadfd4;
            background: white;
            font-weight: 600;
            font-size: 0.85rem;
            color: #2c241f;
            outline: none;
            cursor: pointer;
            transition: all 0.3s;
            flex: 1;
            min-width: 150px;
        }

        .status-update select:focus {
            border-color: #d4918f;
        }

        .status-update select:disabled {
            background: #f5f0eb;
            color: #8a7a6e;
            cursor: not-allowed;
        }

        .status-update .update-btn {
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 50px;
            background: linear-gradient(135deg, #d4918f, #c47a7a);
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .status-update .update-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(196, 122, 122, 0.3);
        }

        .status-update .update-btn:disabled {
            background: #b8aaa0;
            cursor: not-allowed;
        }

        .status-closed-note {
            color: #8a7a6e;
            font-size: 0.8rem;
        }

        /* ===== VIEW DETAILS BUTTON ===== */
        .view-details-btn {
            background: transparent;
            border: 1.5px solid #d4918f;
            color: #c47a7a;
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.78rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .view-details-btn:hover {
            background: #d4918f;
            color: white;
        }

        /* ===== DETAILS MODAL ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 999;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            backdrop-filter: blur(4px);
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 28px;
            max-width: 520px;
            width: 100%;
            padding: 2rem;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-content .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid #f0e8e0;
        }

        .modal-content .modal-header h4 {
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 1.3rem;
            color: #2c241f;
        }

        .modal-content .modal-header .close-modal {
            background: #f5f0eb;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s;
            color: #5c3d2e;
        }

        .modal-content .modal-header .close-modal:hover {
            background: #fdeaea;
            color: #b63e3e;
        }

        .modal-content .detail-row {
            display: flex;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f5f0eb;
        }

        .modal-content .detail-row .label {
            width: 110px;
            font-weight: 600;
            color: #7d6458;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .modal-content .detail-row .value {
            font-weight: 500;
            color: #2c241f;
            font-size: 0.92rem;
            word-break: break-word;
        }

        .modal-content .map-container {
            margin-top: 0.8rem;
            height: 180px;
        }

        /* ===== RESPONSIVE - MOBILE FIRST ===== */
        @media (max-width: 768px) {
            .dashboard {
                padding: 0.6rem;
            }

            .top-bar {
                padding: 0.8rem 1rem;
            }

            .top-bar .brand span {
                font-size: 1rem;
            }

            .top-bar .user-info .name {
                font-size: 0.85rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.6rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-card .number {
                font-size: 1.5rem;
            }

            .order-card {
                padding: 1rem;
            }

            .order-card .order-details {
                grid-template-columns: 1fr 1fr;
                gap: 0.4rem 0.8rem;
            }

            .order-card .order-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .status-update {
                flex-direction: column;
                align-items: stretch;
            }

            .status-update select {
                min-width: unset;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-tabs {
                width: 100%;
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 0.3rem;
                -webkit-overflow-scrolling: touch;
            }

            .filter-tab {
                flex-shrink: 0;
                font-size: 0.7rem;
                padding: 0.3rem 0.8rem;
            }

            .modal-content {
                padding: 1.5rem;
                margin: 0.5rem;
            }

            .modal-content .detail-row {
                flex-direction: column;
                padding: 0.6rem 0;
            }

            .modal-content .detail-row .label {
                width: 100%;
                font-size: 0.75rem;
                margin-bottom: 0.1rem;
            }

            .map-container {
                height: 160px;
            }
        }

        @media (max-width: 480px) {
            .top-bar .brand span {
                font-size: 0.9rem;
            }

            .top-bar .user-info .name {
                font-size: 0.8rem;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 0.5rem;
            }

            .stat-card .number {
                font-size: 1.2rem;
            }

            .stat-card .label {
                font-size: 0.6rem;
            }

            .order-card .order-details {
                grid-template-columns: 1fr;
            }

            .order-card .detail-item .value {
                font-size: 0.85rem;
            }

            .modal-content {
                padding: 1.2rem;
                border-radius: 20px;
            }
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f5f0eb;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #d4918f;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #c47a7a;
        }

        /* ===== TOAST ===== */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #2c241f;
            color: white;
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            animation: modalSlideIn 0.3s ease;
            max-width: 90%;
            text-align: center;
            transition: opacity 0.3s;
        }

        .toast-notification.hidden {
            opacity: 0;
        }
    </style>
</head>
<body>

    <!-- ============================================ -->
    <!-- ===== DASHBOARD ===== -->
    <!-- ============================================ -->
    <div class="dashboard">

        <!-- TOP BAR -->
        <div class="top-bar">
            <div class="brand">
                <img src="{{ asset('images/logo.png') }}" alt="Disna Cakes Logo" style="width: 40px; height: 40px;">
                <span>Disna Bakery</span>
                <span style="font-size:0.7rem; background:#f5f0eb; padding:0.2rem 0.7rem; border-radius:50px; color:#8a7a6e; font-weight:600;">Delivery</span>
            </div>
            <div class="user-info">
                @auth
                    <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <div>
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="role">Delivery Person</div>
                    </div>
                    <a href="{{ route('profile.edit') }}" title="Profile settings" style="color:#c47a7a;">
                        <i class="fas fa-user-cog"></i>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" title="Log out" style="border:0; background:transparent; color:#c47a7a; cursor:pointer;">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="color:#c47a7a;">Login</a>
                    @endauth
            </div>
        </div>

        <!-- STATS -->
        @if(session('success') || session('error'))
            <div class="toast-notification" style="position:static; transform:none; margin-bottom:1rem; background:{{ session('error') ? '#b63e3e' : '#0b7a4d' }};">
                {{ session('success') ?? session('error') }}
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <div class="icon"><i class="fas fa-tasks"></i></div>
                <div class="number" id="totalOrders">0</div>
                <div class="label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="icon"><i class="fas fa-clock"></i></div>
                <div class="number" id="pendingOrders">0</div>
                <div class="label">Pending</div>
            </div>
            <div class="stat-card">
                <div class="icon"><i class="fas fa-check-circle"></i></div>
                <div class="number" id="deliveredOrders">0</div>
                <div class="label">Delivered</div>
            </div>
            <div class="stat-card">
                <div class="icon"><i class="fas fa-route"></i></div>
                <div class="number" id="assignedOrders">0</div>
                <div class="label">Assigned</div>
            </div>
        </div>

        <!-- ORDER LIST -->
        <div class="section-header">
            <h3><i class="fas fa-list" style="color:#d4918f;"></i> Assigned Orders</h3>
            <div class="filter-tabs">
                <button class="filter-tab active" data-filter="all" onclick="filterOrders('all')">All</button>
                <button class="filter-tab" data-filter="pending" onclick="filterOrders('pending')">Pending</button>
                <button class="filter-tab" data-filter="assigned" onclick="filterOrders('assigned')">Assigned</button>
                <button class="filter-tab" data-filter="picked" onclick="filterOrders('picked')">Picked</button>
                <button class="filter-tab" data-filter="delivered" onclick="filterOrders('delivered')">Delivered</button>
            </div>
        </div>

        <!-- ORDERS CONTAINER -->
        <div id="ordersContainer">
            <!-- Orders will be rendered here by JavaScript -->
        </div>

    </div>

    <!-- ============================================ -->
    <!-- ===== DETAILS MODAL ===== -->
    <!-- ============================================ -->
    <div class="modal-overlay" id="detailsModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fas fa-info-circle" style="color:#d4918f;"></i> Order Details</h4>
                <button class="close-modal" onclick="closeModal()">&times;</button>
            </div>
            <div id="modalBody">
                <!-- Filled by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Leaflet JS for Maps -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // =============================================
        // ===== DATABASE ORDER DATA =====
        // =============================================
        const databaseOrders = @json($dashboardOrders);

        // =============================================
        // ===== STATE =====
        // =============================================
        let orders = [];
        let currentFilter = 'all';
        let mapInstances = {};

        // =============================================
        // ===== INIT =====
        // =============================================
        function initializeDashboard() {
            orders = JSON.parse(JSON.stringify(databaseOrders));
            renderOrders();
            updateStats();
        }

        // =============================================
        // ===== RENDER ORDERS =====
        // =============================================
        function renderOrders() {
            const container = document.getElementById('ordersContainer');
            const filtered = getFilteredOrders();

            if (filtered.length === 0) {
                container.innerHTML = `
                    <div style="background:white; border-radius:18px; padding:2.5rem; text-align:center; border:1px solid #eadfd4;">
                        <i class="fas fa-box-open" style="font-size:2.5rem; color:#d4918f; opacity:0.5;"></i>
                        <h4 style="color:#5c3d2e; margin-top:0.8rem;">No orders found</h4>
                        <p style="color:#8a7a6e; font-size:0.9rem;">All caught up! Check back later for new deliveries.</p>
                    </div>
                `;
                return;
            }

            let html = '';
            filtered.forEach(order => {
                const statusClass = order.status.toLowerCase();
                const isClosed = ['delivered', 'failed'].includes(order.status);
                html += `
                    <div class="order-card" id="order-${order.id}">
                        <div class="order-top">
                            <div class="order-id">
                                <i class="fas fa-receipt"></i> Order #${order.id}
                                <span style="font-weight:400; color:#8a7a6e; font-size:0.75rem; margin-left:0.5rem;">
                                    ${order.deliveryDate}
                                </span>
                            </div>
                            <div style="display:flex; gap:0.5rem; flex-wrap:wrap; align-items:center;">
                                <span class="order-status-badge ${statusClass}">
                                    <i class="fas ${getStatusIcon(order.status)}"></i> ${order.status}
                                </span>
                                <button class="view-details-btn" onclick="viewDetails(${order.id})">
                                    <i class="fas fa-eye"></i> Details
                                </button>
                            </div>
                        </div>

                        <div class="order-details">
                            <div class="detail-item">
                                <div class="label">Customer</div>
                                <div class="value">${order.customer}</div>
                            </div>
                            <div class="detail-item">
                                <div class="label">Phone</div>
                                <div class="value">${order.phone}</div>
                            </div>
                            <div class="detail-item" style="grid-column:1/-1;">
                                <div class="label">Address</div>
                                <div class="value">
                                    ${order.address}
                                    <span class="address-line">
                                        <i class="fas fa-map-marker-alt" style="color:#d4918f;"></i> 
                                        ${order.locationLabel || `${order.lat}, ${order.lng}`}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Mini Map -->
                        <div class="map-container" id="miniMap-${order.id}"></div>

                        <!-- Status Update -->
                        <div class="status-update">
                            <select id="statusSelect-${order.id}" ${isClosed ? 'disabled' : ''}>
                                <option value="delivered">Mark as Delivered</option>
                            </select>
                            <button class="update-btn" onclick="updateStatus(${order.id})" ${isClosed ? 'disabled' : ''}>
                                <i class="fas fa-sync-alt"></i> Update
                            </button>
                            ${isClosed ? '<span class="status-closed-note">Delivery closed</span>' : ''}
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;

            // Initialize maps after render
            setTimeout(() => {
                filtered.forEach(order => {
                    if (Number.isFinite(Number(order.lat)) && Number.isFinite(Number(order.lng))) {
                        initMiniMap(order.id, order.lat, order.lng);
                    }
                });
            }, 100);
        }

        // =============================================
        // ===== MINI MAP =====
        // =============================================
        function initMiniMap(orderId, lat, lng) {
            const containerId = `miniMap-${orderId}`;
            const container = document.getElementById(containerId);
            if (!container || !Number.isFinite(Number(lat)) || !Number.isFinite(Number(lng))) return;

            // Check if map already exists
            if (mapInstances[orderId]) {
                mapInstances[orderId].invalidateSize();
                return;
            }

            try {
                const map = L.map(containerId, {
                    zoomControl: false,
                    attributionControl: false,
                    dragging: false,
                    touchZoom: false,
                    scrollWheelZoom: false,
                    doubleClickZoom: false
                }).setView([lat, lng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: ''
                }).addTo(map);

                L.marker([lat, lng], {
                    icon: L.divIcon({
                        html: '<div style="background:#c47a7a; width:16px; height:16px; border-radius:50%; border:3px solid white; box-shadow:0 2px 8px rgba(0,0,0,0.3);"></div>',
                        className: '',
                        iconSize: [16, 16],
                        iconAnchor: [8, 8]
                    })
                }).addTo(map);

                mapInstances[orderId] = map;

                // Refresh map after a moment
                setTimeout(() => {
                    map.invalidateSize();
                }, 200);
            } catch (e) {
                console.warn('Map error for order', orderId, e);
            }
        }

        // =============================================
        // ===== FILTER ORDERS =====
        // =============================================
        function getFilteredOrders() {
            if (currentFilter === 'all') return orders;
            return orders.filter(o => o.status.toLowerCase() === currentFilter);
        }

        function filterOrders(filter) {
            currentFilter = filter;
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.toggle('active', tab.dataset.filter === filter);
            });
            renderOrders();
        }

        // =============================================
        // ===== UPDATE STATUS =====
        // =============================================
        async function updateStatus(orderId) {
            const select = document.getElementById(`statusSelect-${orderId}`);
            const newStatus = select.value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            try {
                const response = await fetch(`{{ url('/delivery/orders') }}/${orderId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ status: newStatus }),
                });

                if (!response.ok) throw new Error('Status update failed');
                window.location.reload();
            } catch (error) {
                showToast('Unable to update this delivery. Please try again.');
            }
        }

        // =============================================
        // ===== VIEW DETAILS MODAL =====
        // =============================================
        function viewDetails(orderId) {
            const order = orders.find(o => o.id === orderId);
            if (!order) return;

            const modal = document.getElementById('detailsModal');
            const body = document.getElementById('modalBody');

            body.innerHTML = `
                <div class="detail-row">
                    <span class="label">Order ID</span>
                    <span class="value">#${order.id}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Customer</span>
                    <span class="value">${order.customer}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Phone</span>
                    <span class="value">${order.phone}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Address</span>
                    <span class="value">${order.address}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Size</span>
                    <span class="value">${order.size}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Flavor</span>
                    <span class="value">${order.flavor}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Frosting</span>
                    <span class="value">${order.frosting}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Message</span>
                    <span class="value">${order.message || 'No message'}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Status</span>
                    <span class="value"><span class="order-status-badge ${order.status.toLowerCase()}">${order.status}</span></span>
                </div>
                <div class="detail-row">
                    <span class="label">Notes</span>
                    <span class="value">${order.notes || 'No notes'}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Delivery Date</span>
                    <span class="value">${order.deliveryDate}</span>
                </div>
                <div class="map-container" id="modalMap" style="height:200px; margin-top:0.8rem;"></div>
            `;

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Initialize map in modal
            setTimeout(() => {
                const mapContainer = document.getElementById('modalMap');
                if (mapContainer) {
                    const map = L.map('modalMap', {
                        zoomControl: true,
                        attributionControl: true,
                        dragging: true,
                        touchZoom: true
                    }).setView([order.lat, order.lng], 16);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap'
                    }).addTo(map);

                    L.marker([order.lat, order.lng], {
                        icon: L.divIcon({
                            html: `<div style="background:#c47a7a; width:20px; height:20px; border-radius:50%; border:3px solid white; box-shadow:0 2px 10px rgba(0,0,0,0.4);"></div>`,
                            className: '',
                            iconSize: [20, 20],
                            iconAnchor: [10, 10]
                        })
                    }).addTo(map)
                    .bindPopup(`<strong>${order.customer}</strong><br>${order.address}`)
                    .openPopup();

                    setTimeout(() => { map.invalidateSize(); }, 200);
                }
            }, 300);
        }

        function closeModal() {
            document.getElementById('detailsModal').classList.remove('active');
            document.body.style.overflow = '';
            // Clean up modal map
            const modalMap = document.getElementById('modalMap');
            if (modalMap) {
                modalMap.innerHTML = '';
            }
        }

        // Close modal on overlay click
        document.getElementById('detailsModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // =============================================
        // ===== UPDATE STATS =====
        // =============================================
        function updateStats() {
            const total = orders.length;
            const pending = orders.filter(o => o.status === 'pending').length;
            const assigned = orders.filter(o => o.status === 'assigned').length;
            const delivered = orders.filter(o => o.status === 'delivered').length;

            document.getElementById('totalOrders').textContent = total;
            document.getElementById('pendingOrders').textContent = pending + assigned;
            document.getElementById('assignedOrders').textContent = assigned;
            document.getElementById('deliveredOrders').textContent = delivered;
        }

        // =============================================
        // ===== UTILITY =====
        // =============================================
        function getStatusIcon(status) {
            const icons = {
                'pending': 'fa-clock',
                'assigned': 'fa-user-check',
                'picked': 'fa-box',
                'delivered': 'fa-check-circle',
                'cancelled': 'fa-ban'
            };
            return icons[status.toLowerCase()] || 'fa-circle';
        }

        function showToast(message) {
            // Remove existing toast
            const existing = document.querySelector('.toast-notification');
            if (existing) existing.remove();

            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('hidden');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Initialize dashboard on load
        document.addEventListener('DOMContentLoaded', initializeDashboard);

        // Initialize map resize on window resize
        window.addEventListener('resize', function() {
            Object.values(mapInstances).forEach(map => {
                try { map.invalidateSize(); } catch(e) {}
            });
        });
    </script>

</body>
</html>