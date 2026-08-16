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
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            border-bottom: 1px solid var(--line);
            padding-bottom: 0.85rem;
            margin-bottom: 1rem;
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

        @media (max-width: 768px) {
            .page-wrap {
                margin-top: 90px;
            }
        }
    </style>
</head>
<body>
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
        <div class="top-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <p class="mb-1 text-uppercase text-muted" style="letter-spacing:0.12em; font-size:0.72rem; font-weight:700;">Customer Portal</p>
                <h1 class="page-title">My Orders</h1>
            </div>
            <a href="{{ route('custom-products.customer') }}" class="btn-primary-custom">
                <i class="fas fa-bag-shopping"></i> Shop More
            </a>
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
                            @if(strtolower($order->status ?? '') === 'pending')
                                <button type="button" class="cancel-order-btn" data-action="{{ route('customer.orders.cancel', $order) }}">
                                    <i class="fas fa-ban"></i> Cancel Order
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="order-grid">
                        <div class="info-box">
                            <span class="info-label">Product</span>
                            <div class="info-value">{{ $order->product_name ?: $order->flavor }}</div>
                        </div>

                        <div class="info-box">
                            <span class="info-label">Size</span>
                            <div class="info-value">{{ $order->cake_size ?: 'N/A' }}</div>
                        </div>

                        <div class="info-box">
                            <span class="info-label">Flavor</span>
                            <div class="info-value">{{ $order->flavor ?: 'N/A' }}</div>
                        </div>

                        <div class="info-box">
                            <span class="info-label">Frosting</span>
                            <div class="info-value">{{ $order->frosting ?: 'N/A' }}</div>
                        </div>

                        <div class="info-box">
                            <span class="info-label">Total Price</span>
                            <div class="info-value">Rs. {{ number_format($order->total_price, 2) }}</div>
                        </div>

                        <div class="info-box">
                            <span class="info-label">Delivery Option</span>
                            <div class="info-value">{{ $order->delivery_option ?: 'Not specified' }}</div>
                        </div>

                        <div class="info-box">
                            <span class="info-label">Delivery Date</span>
                            <div class="info-value">{{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') : 'Not set' }}</div>
                        </div>

                        <div class="info-box">
                            <span class="info-label">Phone</span>
                            <div class="info-value">{{ $order->phone ?: 'N/A' }}</div>
                        </div>

                        <div class="info-box" style="grid-column:1 / -1;">
                            <span class="info-label">Address</span>
                            <div class="info-value">{{ $order->address ?: 'N/A' }}</div>
                        </div>

                        <div class="info-box" style="grid-column:1 / -1;">
                            <span class="info-label">Cake Message</span>
                            <div class="info-value">{{ $order->cake_message ?: 'No message' }}</div>
                        </div>

                        <div class="info-box" style="grid-column:1 / -1;">
                            <span class="info-label">Special Notes</span>
                            <div class="info-value">{{ $order->special_notes ?: 'No notes' }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

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
    </script>
</body>
</html>
