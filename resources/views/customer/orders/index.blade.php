<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>My Orders</title>
    <!-- logo -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --cream: #fffaf4;
            --paper: #fffdf9;
            --ink: #33231f;
            --cocoa: #60453a;
            --apricot: #e58d62;
            --apricot-dark: #bd6545;
            --line: #eadfd4;
            --teal: #2f7d72;
            --soft: #f7efe9;
            --shadow: 0 18px 45px rgba(83,55,40,0.08);
        }

        body {
            background: linear-gradient(180deg, #fffaf4 0%, #fff4ee 100%);
            color: var(--ink);
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, #d4a373 0%, #b5835a 100%);
            border-bottom: 3px solid var(--apricot);
            box-shadow: 0 8px 24px rgba(51,35,31,0.18);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        .page-wrap {
            max-width: 1200px;
            margin: 120px auto 60px;
            padding: 0 20px;
        }

        .top-card {
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 20px;
            box-shadow: var(--shadow);
            padding: 1.5rem 1.75rem;
            margin-bottom: 1.5rem;
        }

        .order-update-alert {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.1rem;
            margin-bottom: 0.75rem;
            background: #eaf6f3;
            border: 1px solid #b8ddd5;
            border-left: 5px solid var(--teal);
            border-radius: 12px;
            color: var(--ink);
        }

        .order-update-message {
            color: inherit;
            text-decoration: none;
        }

        .order-update-message:hover {
            color: var(--teal);
        }

        .dismiss-update {
            flex: 0 0 auto;
            padding: 0.35rem 0.55rem;
            color: var(--cocoa);
            background: transparent;
            border: 0;
            border-radius: 6px;
        }

        .dismiss-update:hover {
            color: #9c352d;
            background: rgba(156, 53, 45, 0.08);
        }

        .page-title {
            margin: 0;
            font-family: Georgia, 'Times New Roman', serif;
            color: var(--ink);
            font-size: clamp(2rem, 3vw, 3rem);
        }

        .order-card {
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: var(--shadow);
            padding: 1.1rem 1.5rem;
            margin-bottom: 1rem;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 0;
        }

        .order-id {
            font-weight: 700;
            color: var(--teal);
        }

        .order-status {
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: capitalize;
            background: #fff1dd;
            color: #9d6801;
        }

        .order-status.pending {
            background: #fff4d6;
            color: #a26900;
        }

        .order-status.processing {
            background: #e8f4ff;
            color: #1467a8;
        }

        .order-status.completed,
        .order-status.delivered {
            background: #eaf9ef;
            color: #0b7a4d;
        }

        .order-status.cancel {
            background: #fdeaea;
            color: #b63e3e;
        }

        .view-order-btn {
            background: var(--teal);
            border: none;
            border-radius: 999px;
            color: white;
            padding: 0.55rem 1rem;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .view-order-btn:hover {
            background: #225f58;
            transform: translateY(-1px);
        }

        .receipt-modal {
            position: fixed;
            inset: 0;
            background: rgba(35, 24, 21, 0.58);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            z-index: 1900;
        }

        .receipt-modal.show {
            display: flex;
        }

        .receipt {
            background: var(--paper);
            width: min(620px, 100%);
            max-height: min(760px, 92vh);
            overflow-y: auto;
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: 0 24px 70px rgba(60, 35, 24, 0.25);
            animation: popupIn 0.2s ease;
        }

        .receipt-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.5rem;
            border-bottom: 1px dashed var(--line);
        }

        .receipt-brand {
            color: var(--cocoa);
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .receipt-meta {
            color: #7d6458;
            font-size: 0.8rem;
            line-height: 1.7;
        }

        .receipt-close {
            background: transparent;
            border: none;
            color: #7d6458;
            font-size: 1.25rem;
            cursor: pointer;
        }

        .receipt-body {
            padding: 1.5rem;
        }

        .receipt-section {
            border-bottom: 1px solid var(--line);
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .receipt-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.35rem 0;
            color: #715d53;
        }

        .receipt-row strong {
            color: var(--ink);
            text-align: right;
        }

        .receipt-total {
            color: var(--teal) !important;
            font-size: 1.15rem;
        }

        .receipt-cancel {
            margin-top: 1rem;
            width: 100%;
        }

        .cancel-order-btn {
            background: #fff0ed;
            border: 1px solid #f1c4b9;
            color: #a54d3e;
            border-radius: 999px;
            padding: 0.55rem 1rem;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .cancel-order-btn:hover {
            background: #fdd8d0;
        }

        .confirm-modal {
            position: fixed;
            inset: 0;
            background: rgba(35, 24, 21, 0.48);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            z-index: 2000;
        }

        .confirm-modal.show {
            display: flex;
        }

        .confirm-modal-card {
            background: white;
            width: min(420px, 100%);
            border-radius: 20px;
            box-shadow: 0 24px 60px rgba(60, 35, 24, 0.18);
            border: 1px solid #f1e4db;
            padding: 1.5rem;
            animation: popupIn 0.2s ease;
        }

        @keyframes popupIn {
            from { transform: translateY(10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .confirm-modal-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: #fff1ee;
            color: #c15a4a;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.8rem;
            font-size: 1.5rem;
        }

        .confirm-modal h4 {
            margin: 0 0 0.5rem;
            font-weight: 800;
            color: var(--ink);
        }

        .confirm-modal p {
            margin: 0;
            color: #715d53;
            line-height: 1.6;
        }

        .confirm-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.8rem;
            margin-top: 1.3rem;
        }

        .confirm-btn,
        .cancel-btn {
            border: none;
            border-radius: 999px;
            padding: 0.7rem 1.1rem;
            font-weight: 700;
            cursor: pointer;
        }

        .cancel-btn {
            background: #f5efe9;
            color: var(--cocoa);
        }

        .confirm-btn {
            background: #d96c5a;
            color: white;
        }

        .order-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }

        .info-box {
            background: var(--soft);
            border-radius: 12px;
            padding: 0.9rem 1rem;
            border: 1px solid #f0e2d8;
        }

        .info-label {
            display: block;
            color: #7d6458;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.32rem;
        }

        .info-value {
            font-weight: 700;
            color: var(--ink);
            word-break: break-word;
        }

        .empty-box {
            background: var(--paper);
            border: 1px dashed var(--line);
            border-radius: 18px;
            padding: 2rem;
            box-shadow: var(--shadow);
            text-align: center;
        }

        .btn-primary-custom {
            background: var(--teal);
            border: none;
            padding: 0.7rem 1rem;
            border-radius: 999px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            background: #225f58;
            color: white;
        }

        /* ---------- Alerts ---------- */
        .alert {
            border-radius: 999px;
            border: none;
            font-weight: 600;
            padding: 0.8rem 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .alert-success {
            background: #e4f5eb;
            color: #0b7a4d;
        }

        .alert-danger {
            background: #fdeaea;
            color: #b63e3e;
        }

         /* ---------- Filter Buttons ---------- */
        .status-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .filter-btn {
            background: #fff;
            border: 2px solid var(--line);
            color: var(--cocoa);
            border-radius: 999px;
            padding: 0.5rem 1.2rem;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .filter-btn i {
            font-size: 0.75rem;
            opacity: 0.7;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: var(--apricot);
            color: white;
            border-color: var(--apricot);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 163, 115, 0.35);
        }

        .filter-btn.active i,
        .filter-btn:hover i {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .page-wrap {
                margin-top: 90px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('customer.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Disna Bakery" width="40" style="border-radius:10px;"> Disna Bakery
            </a>
            <div class="ms-auto">
                <a href="{{ route('custom-products.customer') }}" class="btn btn-light btn-sm rounded-pill">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
            </div>
        </div>
    </nav>

    <div class="page-wrap">
        <!-- Page Header -->
        <div class="top-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <p class="mb-1 text-uppercase text-muted" style="letter-spacing:0.12em; font-size:0.72rem; font-weight:700;">Customer Portal</p>
                <h1 class="page-title">My Orders</h1>
            </div>
            <a href="{{ route('custom-products.customer') }}" class="btn-primary-custom">
                <i class="fas fa-bag-shopping"></i> Shop More
            </a>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="alert alert-success rounded-pill border-0 mb-3" role="alert" data-auto-dismiss>
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger rounded-pill border-0 mb-3" role="alert" data-auto-dismiss>
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif

        @if($notifications->isNotEmpty())
            <section aria-label="New order updates" class="mb-4">
                @foreach($notifications as $notification)
                    <div class="order-update-alert" role="alert">
                        <a class="order-update-message" href="{{ route('customer.orders', ['status' => 'all', 'notification' => $notification->id]) }}">
                            <strong><i class="fas fa-bell me-2"></i>New order update</strong>
                            <span class="d-block">{{ $notification->data['message'] ?? 'Your order status was updated.' }}</span>
                            <small class="text-muted">Order #{{ $notification->data['order_id'] ?? '' }} · {{ $notification->created_at->diffForHumans() }} · View full order</small>
                        </span>
                        </a>
                        <form method="POST" action="{{ route('customer.notifications.dismiss', $notification->id) }}">
                            @csrf
                            <button type="submit" class="dismiss-update" aria-label="Dismiss order update" title="Dismiss">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </section>
        @endif

        <!-- Filter Bar -->
        <div class="top-card">
            <div class="status-filter">
                <a href="{{ route('customer.orders', ['status' => 'all']) }}" class="filter-btn {{ $selectedStatus === 'all' ? 'active' : '' }}">
                    <i class="fas fa-list"></i> All
                </a>
                <a href="{{ route('customer.orders', ['status' => 'pending']) }}" class="filter-btn {{ $selectedStatus === 'pending' ? 'active' : '' }}">
                    <i class="fas fa-clock"></i> Pending
                </a>
                <a href="{{ route('customer.orders', ['status' => 'processing']) }}" class="filter-btn {{ $selectedStatus === 'processing' ? 'active' : '' }}">
                    <i class="fas fa-spinner"></i> Processing
                </a>
                <a href="{{ route('customer.orders', ['status' => 'completed']) }}" class="filter-btn {{ $selectedStatus === 'completed' ? 'active' : '' }}">
                    <i class="fas fa-check-circle"></i> Completed
                </a>
                <a href="{{ route('customer.orders', ['status' => 'cancel']) }}" class="filter-btn {{ $selectedStatus === 'cancel' ? 'active' : '' }}">
                    <i class="fas fa-ban"></i> Cancelled
                </a>
            </div>
        </div>

        @if($orders->isEmpty())
            <div class="empty-box">
                <i class="fas fa-box-open fa-2x mb-3" style="color:#d7a88c;"></i>
                <h4 class="mb-2">No orders yet</h4>
                <p class="text-muted mb-3">Your recent bakery orders will appear here.</p>
                <a href="{{ route('custom-products.customer') }}" class="btn-primary-custom">Place Your First Order</a>
            </div>
        @else
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">Order #{{ $order->id }}</div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="order-status {{ strtolower($order->status ?? 'pending') }}">
                                {{ ucfirst($order->status ?? 'pending') }}
                            </span>
                            <button type="button" class="view-order-btn" data-receipt="receipt-{{ $order->id }}">
                                <i class="fas fa-receipt me-1"></i> View More
                            </button>
                        </div>
                    </div>
                </div>

                <div class="receipt-modal" id="receipt-{{ $order->id }}" aria-hidden="true">
                    <div class="receipt" role="dialog" aria-modal="true" aria-labelledby="receipt-title-{{ $order->id }}">
                        <div class="receipt-header">
                            <div>
                                <div class="receipt-brand" id="receipt-title-{{ $order->id }}">Disna Bakery</div>
                                <div class="receipt-meta">Order #{{ $order->id }}<br>{{ $order->created_at?->format('d M Y, h:i A') }}</div>
                            </div>
                            <button type="button" class="receipt-close" aria-label="Close receipt"><i class="fas fa-times"></i></button>
                        </div>

                        <div class="receipt-body">
                            <div class="receipt-section">
                                <div class="receipt-row"><span>Status</span><strong><span class="order-status {{ strtolower($order->status ?? 'pending') }}">{{ ucfirst($order->status ?? 'pending') }}</span></strong></div>
                                <div class="receipt-row"><span>Customer</span><strong>{{ $order->customer_name ?: 'N/A' }}</strong></div>
                                <div class="receipt-row"><span>Phone</span><strong>{{ $order->phone ?: 'N/A' }}</strong></div>
                            </div>

                            <div class="receipt-section">
                                <div class="receipt-row"><span>Product</span><strong>{{ $order->product_name ?: $order->flavor }}</strong></div>
                                <div class="receipt-row"><span>Size</span><strong>{{ $order->cake_size ?: 'N/A' }}</strong></div>
                                <div class="receipt-row"><span>Flavor</span><strong>{{ $order->flavor ?: 'N/A' }}</strong></div>
                                <div class="receipt-row"><span>Frosting</span><strong>{{ $order->frosting ?: 'N/A' }}</strong></div>
                            </div>

                            <div class="receipt-section">
                                <div class="receipt-row"><span>Delivery option</span><strong>{{ $order->delivery_option ?: 'Not specified' }}</strong></div>
                                <div class="receipt-row"><span>Delivery date</span><strong>{{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') : 'Not set' }}</strong></div>
                                <div class="receipt-row"><span>Address</span><strong>{{ $order->address ?: 'N/A' }}, {{ $order->city ?: 'N/A' }}</strong></div>
                            </div>

                            <div class="receipt-section">
                                <div class="receipt-row"><span>Cake message</span><strong>{{ $order->cake_message ?: 'No message' }}</strong></div>
                                <div class="receipt-row"><span>Special notes</span><strong>{{ $order->special_notes ?: 'No notes' }}</strong></div>
                                <div class="receipt-row"><span>Online transaction</span><strong>{{ $order->transaction_id ?: 'Not provided' }}</strong></div>
                                <div class="receipt-row"><span>Payment method</span><strong>{{ $order->payment_method ?: 'Not specified' }}</strong></div>
                                <div class="receipt-row"><span>Card</span><strong>{{ $order->card_type && $order->card_last_four ? $order->card_type . ' ending ' . $order->card_last_four : 'Not provided' }}</strong></div>
                                @if($order->advance_amount)
                                    <div class="receipt-row"><span>Advance paid</span><strong>Rs. {{ number_format($order->advance_amount, 2) }}</strong></div>
                                @endif
                            </div>

                            <div class="receipt-row"><span class="fw-bold">Total</span><strong class="receipt-total">Rs. {{ number_format($order->total_price, 2) }}</strong></div>

                            @if(strtolower($order->status ?? '') === 'pending')
                                <button type="button" class="cancel-order-btn receipt-cancel" data-action="{{ route('customer.orders.cancel', $order) }}">
                                    <i class="fas fa-ban"></i> Cancel Order
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <script>
        document.querySelectorAll('.view-order-btn').forEach((button) => {
            button.addEventListener('click', function () {
                const receipt = document.getElementById(this.dataset.receipt);
                receipt.classList.add('show');
                receipt.setAttribute('aria-hidden', 'false');
            });
        });

        const openOrderId = @json($openOrderId);
        if (openOrderId) {
            document.querySelector(`[data-receipt="receipt-${openOrderId}"]`)?.click();
        }

        document.querySelectorAll('.receipt-modal').forEach((modal) => {
            const closeButton = modal.querySelector('.receipt-close');
            const closeReceipt = () => {
                modal.classList.remove('show');
                modal.setAttribute('aria-hidden', 'true');
            };

            closeButton.addEventListener('click', closeReceipt);
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeReceipt();
                }
            });
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.receipt-modal.show').forEach((modal) => {
                    modal.classList.remove('show');
                    modal.setAttribute('aria-hidden', 'true');
                });
            }
        });
    </script>

    <div class="confirm-modal" id="cancelOrderModal" aria-hidden="true">
        <div class="confirm-modal-card" role="dialog" aria-modal="true" aria-labelledby="cancelOrderTitle">
            <div class="confirm-modal-icon">
                <i class="fas fa-triangle-exclamation"></i>
            </div>
            <h4 id="cancelOrderTitle">Cancel this order?</h4>
            <p>This action will mark the order as cancelled. You can still browse the menu and place a new order anytime.</p>

            <div class="confirm-modal-actions">
                <button type="button" class="cancel-btn" id="closeCancelModal">Back</button>
                <form id="cancelOrderForm" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="confirm-btn">Yes, Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const cancelModal = document.getElementById('cancelOrderModal');
        const cancelOrderForm = document.getElementById('cancelOrderForm');
        const closeCancelModalBtn = document.getElementById('closeCancelModal');

        document.querySelectorAll('.cancel-order-btn').forEach((button) => {
            button.addEventListener('click', function () {
                cancelOrderForm.action = this.dataset.action;
                cancelModal.classList.add('show');
                cancelModal.setAttribute('aria-hidden', 'false');
            });
        });

        function closeCancelModal() {
            cancelModal.classList.remove('show');
            cancelModal.setAttribute('aria-hidden', 'true');
        }

        closeCancelModalBtn.addEventListener('click', closeCancelModal);

        cancelModal.addEventListener('click', function (event) {
            if (event.target === cancelModal) {
                closeCancelModal();
            }
        });

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
