<div>
    <!-- Breadcrumb -->
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <a href="{{ route('products') }}">Products</a>
            <span class="separator">/</span>
            <a href="{{ route('cart') }}">Cart</a>
            <span class="separator">/</span>
            <a href="{{ route('checkout') }}">Checkout</a>
            <span class="separator">/</span>
            <span class="current">Confirmation</span>
        </div>
    </div>

    <!-- Thank You Page -->
    <section class="section-spacer" style="padding-top:10px;">
        <div class="container">

            <!-- Checkout Steps -->
            <div class="checkout-steps">
                <div class="step completed">
                    <div class="step-number"><i class="fas fa-check"></i></div>
                    <span class="step-label">Cart</span>
                </div>
                <div class="step-connector completed"></div>
                <div class="step completed">
                    <div class="step-number"><i class="fas fa-check"></i></div>
                    <span class="step-label">Checkout</span>
                </div>
                <div class="step-connector completed"></div>
                <div class="step active">
                    <div class="step-number">3</div>
                    <span class="step-label">Confirmation</span>
                </div>
            </div>

            <!-- Thank You Hero -->
            <div class="thankyou-hero">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h1>Thank You!</h1>
                <p class="order-number">Order #<span>{{ $order->order_number }}</span></p>
                <p class="thankyou-message">
                    Your order has been placed successfully. We've sent a confirmation
                    email to <strong>{{ $order->customer_email }}</strong> with all the details.
                </p>
            </div>

            <!-- Order Details -->
            <div class="row g-4">

                <!-- Order Summary Column -->
                <div class="col-lg-7">
                    <div class="order-details-card">
                        <h3 class="detail-title">Order Summary</h3>

                        <!-- Order Items -->
<div class="order-items">
    @foreach($orderItems as $item)
        @php
            $product = \App\Models\Product::find($item->product_id);
        @endphp
        <div class="order-item">
            <div class="item-image">
                @if($product && $product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $item->product_name }}" />
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="width:100%;height:100%;">
                        <i class="fas fa-image text-muted"></i>
                    </div>
                @endif
            </div>
            <div class="item-details">
                <div class="item-name">{{ $item->product_name }}</div>
                <div class="item-variant">
                    @if($item->size)
                        <span class="badge bg-secondary">Size: {{ $item->size }}</span>
                    @endif
                    @if($item->color)
                        <span class="badge" style="background:{{ $item->color }}; color:{{ $item->color == '#000000' ? '#fff' : '#000' }};">
                            Color: {{ $item->color }}
                        </span>
                    @endif
                    <span style="margin-left:8px;">Qty: {{ $item->quantity }}</span>
                </div>
            </div>
            <div class="item-price">${{ number_format($item->total, 2) }}</div>
        </div>
    @endforeach
</div>

                        <!-- Order Totals -->
                        <div style="margin-top:1.2rem;padding-top:1rem;border-top:1px solid rgba(0,0,0,0.04);">
                            <div class="detail-row">
                                <span class="label">Subtotal ({{ $orderItems->count() }} items)</span>
                                <span class="value">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Shipping</span>
                                <span class="value gold">@if($shipping == 0) FREE @else ${{ number_format($shipping, 2) }} @endif</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Tax (10%)</span>
                                <span class="value">${{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="detail-row" style="border-bottom:2px solid var(--primary);padding-bottom:0.8rem;margin-bottom:0.2rem;">
                                <span class="label" style="font-weight:500;color:var(--primary);">Total</span>
                                <span class="value gold" style="font-size:1.2rem;font-weight:500;">${{ number_format($grandTotal, 2) }}</span>
                            </div>
                            <div style="text-align:right;font-family:var(--font-body);font-size:0.65rem;font-weight:300;color:#999;padding-top:0.3rem;">
                                <i class="fas fa-check-circle" style="color:#27ae60;"></i> 
                                @if($order->payment_method == 'cash_on_delivery')
                                    Cash on Delivery
                                @else
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping & Payment Column -->
                <div class="col-lg-5">
                    <div class="order-details-card">
                        <h3 class="detail-title">Shipping Details</h3>

                        <div class="shipping-info-grid">
                            <div class="info-block">
                                <span class="info-label">Shipping Address</span>
                                <span class="info-value">
                                    {{ $order->customer_name }}<br />
                                    {{ $order->shipping_address }}
                                </span>
                            </div>
                            <div class="info-block">
                                <span class="info-label">Contact</span>
                                <span class="info-value">
                                    {{ $order->customer_phone }}<br />
                                    {{ $order->customer_email }}
                                </span>
                            </div>
                        </div>

                        <div style="margin-top:1.2rem;padding-top:1rem;border-top:1px solid rgba(0,0,0,0.04);">
                            <div class="detail-row">
                                <span class="label">Payment Method</span>
                                <span class="value">
                                    @if($order->payment_method == 'cash_on_delivery')
                                        Cash on Delivery
                                    @else
                                        {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                                    @endif
                                </span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Shipping Method</span>
                                <span class="value">Standard Delivery (3-5 days)</span>
                            </div>
                            <div class="detail-row">
                                <span class="label">Order Date</span>
                                <span class="value">{{ $order->created_at->format('F d, Y') }}</span>
                            </div>
                            <div class="detail-row" style="border-bottom:2px solid #27ae60;padding-bottom:0.8rem;">
                                <span class="label" style="color:#27ae60;font-weight:500;">Order Status</span>
                                <span class="value" style="color:#27ae60;font-weight:500;">
                                    <i class="fas fa-check-circle"></i> {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Estimated Delivery -->
                        <div style="margin-top:1rem;padding:1rem;background:rgba(39,174,96,0.04);border-radius:12px;border:1px solid rgba(39,174,96,0.08);">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <i class="fas fa-truck" style="font-size:1.4rem;color:#27ae60;"></i>
                                <div>
                                    <div style="font-family:var(--font-body);font-size:0.75rem;font-weight:500;color:#27ae60;">
                                        Estimated Delivery
                                    </div>
                                    <div style="font-family:var(--font-body);font-size:0.9rem;font-weight:400;color:var(--primary);">
                                        {{ $estimatedDelivery }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('customer.orders.show', $order->id) }}" class="btn-primary-custom">
                    <i class="fas fa-receipt"></i> View Order
                </a>
                <a href="{{ route('products') }}" class="btn-secondary-custom">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
                <a href="#" onclick="window.print(); return false;" class="btn-secondary-custom">
                    <i class="fas fa-print"></i> Print Receipt
                </a>
            </div>

            <!-- Features Bar -->
            <div class="features-bar">
                <div class="feature-item">
                    <i class="fas fa-truck"></i>
                    <span class="feature-label">Free Shipping</span>
                    <span class="feature-desc">On all domestic orders</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-undo-alt"></i>
                    <span class="feature-label">Easy Returns</span>
                    <span class="feature-desc">14 days return policy</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-headset"></i>
                    <span class="feature-label">Support</span>
                    <span class="feature-desc">24/7 customer service</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-shield-alt"></i>
                    <span class="feature-label">Secure</span>
                    <span class="feature-desc">100% encrypted payment</span>
                </div>
            </div>

        </div>
    </section>

    <!-- ============================================================
    STYLES
    ============================================================ -->
    <style>
        /* ============================================================
           GLOBAL RESET & ROOTS
        ============================================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0a0a0a;
            --gold: #C9A227;
            --beige: #F5F1EB;
            --bg-light: #FAFAFA;
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Poppins', sans-serif;
        }

        body {
            font-family: var(--font-body);
            color: #1a1a1a;
            background: #fff;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .gold {
            color: var(--gold);
        }

        /* ============================================================
           BREADCRUMB
        ============================================================ */
        .breadcrumb-custom {
            padding: 20px 0 10px;
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 300;
            letter-spacing: 0.05em;
            color: #999;
        }

        .breadcrumb-custom a {
            color: #999;
            text-decoration: none;
            transition: 0.2s;
        }

        .breadcrumb-custom a:hover {
            color: var(--gold);
        }

        .breadcrumb-custom .separator {
            margin: 0 10px;
            color: #ddd;
        }

        .breadcrumb-custom .current {
            color: var(--primary);
        }

        /* ============================================================
           SECTION SPACING
        ============================================================ */
        .section-spacer {
            padding: 60px 0 80px;
        }

        /* ============================================================
           CHECKOUT STEPS
        ============================================================ */
        .checkout-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .checkout-steps .step {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.5rem 1.5rem;
            position: relative;
        }

        .checkout-steps .step .step-number {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-body);
            font-size: 0.8rem;
            font-weight: 500;
            color: #999;
            transition: 0.3s;
        }

        .checkout-steps .step .step-label {
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #999;
            transition: 0.3s;
        }

        .checkout-steps .step.active .step-number {
            border-color: var(--gold);
            background: var(--gold);
            color: #fff;
        }

        .checkout-steps .step.active .step-label {
            color: var(--primary);
        }

        .checkout-steps .step.completed .step-number {
            border-color: #27ae60;
            background: #27ae60;
            color: #fff;
        }

        .checkout-steps .step.completed .step-label {
            color: #27ae60;
        }

        .checkout-steps .step-connector {
            width: 40px;
            height: 2px;
            background: #e5e5e5;
            flex-shrink: 0;
        }

        .checkout-steps .step-connector.completed {
            background: #27ae60;
        }

        .checkout-steps .step-connector.active {
            background: var(--gold);
        }

        @media (max-width: 768px) {
            .checkout-steps .step .step-label {
                display: none;
            }

            .checkout-steps .step {
                padding: 0.5rem 0.8rem;
            }

            .checkout-steps .step-connector {
                width: 20px;
            }
        }

        /* ============================================================
           THANK YOU HERO
        ============================================================ */
        .thankyou-hero {
            text-align: center;
            padding: 20px 0 40px;
        }

        .thankyou-hero .success-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(39, 174, 96, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: successPulse 2s ease-in-out infinite;
        }

        .thankyou-hero .success-icon i {
            font-size: 3.5rem;
            color: #27ae60;
        }

        @keyframes successPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .thankyou-hero h1 {
            font-family: var(--font-heading);
            font-size: clamp(2.8rem, 5vw, 4.5rem);
            font-weight: 300;
            letter-spacing: 0.06em;
            margin-bottom: 0.5rem;
        }

        .thankyou-hero .order-number {
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 300;
            color: #888;
            margin-bottom: 0.5rem;
        }

        .thankyou-hero .order-number span {
            color: var(--gold);
            font-weight: 500;
        }

        .thankyou-hero .thankyou-message {
            font-family: var(--font-body);
            font-size: 1.05rem;
            font-weight: 300;
            color: #666;
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* ============================================================
           ORDER DETAILS CARD
        ============================================================ */
        .order-details-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.04);
            padding: 2rem;
            margin-top: 1rem;
        }

        .order-details-card .detail-title {
            font-family: var(--font-heading);
            font-size: 1.3rem;
            font-weight: 300;
            letter-spacing: 0.04em;
            margin-bottom: 1.2rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .order-details-card .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 300;
            color: #666;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        }

        .order-details-card .detail-row:last-child {
            border-bottom: none;
        }

        .order-details-card .detail-row .label {
            color: #999;
        }

        .order-details-card .detail-row .value {
            color: var(--primary);
        }

        .order-details-card .detail-row .value.gold {
            color: var(--gold);
        }

        /* ============================================================
           ORDER ITEMS
        ============================================================ */
        .order-items {
            margin-top: 1rem;
        }

        .order-items .order-item {
            display: flex;
            gap: 16px;
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .order-items .order-item:last-child {
            border-bottom: none;
        }

        .order-items .order-item .item-image {
            width: 64px;
            height: 64px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
            background: var(--bg-light);
        }

        .order-items .order-item .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .order-items .order-item .item-details {
            flex: 1;
        }

        .order-items .order-item .item-details .item-name {
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 400;
            color: var(--primary);
        }

        .order-items .order-item .item-details .item-variant {
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 300;
            color: #999;
        }

        .order-items .order-item .item-price {
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 400;
            color: var(--gold);
            white-space: nowrap;
        }

        /* ============================================================
           SHIPPING INFO
        ============================================================ */
        .shipping-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 0.5rem;
        }

        .shipping-info-grid .info-block .info-label {
            font-family: var(--font-body);
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #999;
            display: block;
            margin-bottom: 0.2rem;
        }

        .shipping-info-grid .info-block .info-value {
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--primary);
        }

        /* ============================================================
           ACTION BUTTONS
        ============================================================ */
        .action-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .action-buttons .btn-primary-custom {
            padding: 0.8rem 2.5rem;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 40px;
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .action-buttons .btn-primary-custom:hover {
            background: var(--gold);
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(201, 162, 39, 0.2);
        }

        .action-buttons .btn-secondary-custom {
            padding: 0.8rem 2.5rem;
            background: transparent;
            color: #666;
            border: 1px solid #e5e5e5;
            border-radius: 40px;
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 400;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .action-buttons .btn-secondary-custom:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        /* ============================================================
           FEATURES BAR
        ============================================================ */
        .features-bar {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(0, 0, 0, 0.04);
        }

        .features-bar .feature-item {
            text-align: center;
        }

        .features-bar .feature-item i {
            font-size: 1.8rem;
            color: var(--gold);
            margin-bottom: 0.5rem;
            display: block;
        }

        .features-bar .feature-item .feature-label {
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #666;
        }

        .features-bar .feature-item .feature-desc {
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 300;
            color: #999;
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 992px) {
            .shipping-info-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .features-bar {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .section-spacer {
                padding: 40px 0 60px;
            }

            .order-details-card {
                padding: 1.2rem;
            }

            .order-details-card .detail-title {
                font-size: 1.1rem;
            }

            .order-items .order-item .item-image {
                width: 50px;
                height: 50px;
            }

            .features-bar {
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .action-buttons .btn-primary-custom,
            .action-buttons .btn-secondary-custom {
                width: 100%;
                justify-content: center;
            }

            .thankyou-hero .success-icon {
                width: 80px;
                height: 80px;
            }

            .thankyou-hero .success-icon i {
                font-size: 2.8rem;
            }
        }

        @media (max-width: 576px) {
            .thankyou-hero h1 {
                font-size: 2rem;
            }

            .checkout-steps .step .step-number {
                width: 30px;
                height: 30px;
                font-size: 0.7rem;
            }

            .checkout-steps .step-connector {
                width: 12px;
            }

            .features-bar {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .features-bar .feature-item i {
                font-size: 1.4rem;
            }

            .features-bar .feature-item .feature-label {
                font-size: 0.6rem;
            }

            .order-details-card .detail-row {
                font-size: 0.8rem;
            }
        }

        /* Print Styles */
        @media print {
            .breadcrumb-custom,
            .checkout-steps,
            .action-buttons,
            .features-bar {
                display: none !important;
            }
            .section-spacer {
                padding: 20px 0 !important;
            }
            .order-details-card {
                border: 1px solid #ddd !important;
                box-shadow: none !important;
            }
            .thankyou-hero .success-icon {
                animation: none !important;
            }
            body {
                background: #fff !important;
            }
            .container {
                max-width: 100% !important;
            }
        }
    </style>
    <!-- ============================================================
CONFETTI ANIMATION
============================================================ -->
<script>
    // Confetti Animation
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            createConfetti();
        }, 500);
    });

    function createConfetti() {
        const colors = ['#C9A227', '#111111', '#F5F1EB', '#27ae60', '#e74c3c', '#3498db'];
        
        for (let i = 0; i < 60; i++) {
            const confetti = document.createElement('div');
            const size = Math.random() * 8 + 4;
            const isCircle = Math.random() > 0.5;
            
            confetti.style.cssText = `
                position: fixed;
                width: ${size}px;
                height: ${isCircle ? size : size * 0.4}px;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                border-radius: ${isCircle ? '50%' : '2px'};
                left: ${Math.random() * 100}vw;
                top: -20px;
                opacity: 0.8;
                pointer-events: none;
                z-index: 9999;
                animation: confettiFall ${Math.random() * 3 + 2}s linear forwards;
                animation-delay: ${Math.random() * 1.5}s;
                transform: rotate(${Math.random() * 360}deg);
            `;
            document.body.appendChild(confetti);

            setTimeout(() => {
                confetti.remove();
            }, 6000);
        }
    }

    // Add confetti keyframes dynamically
    if (!document.getElementById('confetti-styles')) {
        const style = document.createElement('style');
        style.id = 'confetti-styles';
        style.textContent = `
            @keyframes confettiFall {
                0% { 
                    transform: translateY(0) rotate(0deg) scale(1); 
                    opacity: 0.8; 
                }
                100% { 
                    transform: translateY(105vh) rotate(720deg) scale(0.3); 
                    opacity: 0; 
                }
            }
        `;
        document.head.appendChild(style);
    }
</script>
</div>