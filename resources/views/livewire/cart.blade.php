<div>

    <!-- Breadcrumb -->
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <a href="{{ route('products') }}">Products</a>
            <span class="separator">/</span>
            <span class="current">Shopping Cart</span>
        </div>
    </div>

    <!-- Cart Page -->
    <section class="section-spacer" style="padding-top:10px;">
        <div class="container">

            <!-- Cart Header -->
            <div class="cart-header">
                <h1>Shopping Cart</h1>
                <p>Review your items before checkout</p>
            </div>

            <!-- Messages -->
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- ============================================================
            CHECK IF CART HAS ITEMS
            ============================================================ -->
            @if(count($cartItems) > 0)
                <div class="row g-4">

                    <!-- Cart Table -->
                    <div class="col-lg-8">
                        <div class="cart-table-wrap">
                            <div class="table-responsive">
                                <table class="cart-table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $item)
                                            <tr wire:key="cart-{{ $item['id'] }}">
                                                <td>
                                                    <div class="product-cell">
                                                        <div class="product-image">
                                                            @if(!empty($item['image']))
                                                                <img src="{{ asset('storage/' . $item['image']) }}" 
                                                                     alt="{{ $item['name'] }}" />
                                                            @else
                                                                <div class="bg-light d-flex align-items-center justify-content-center" style="width:80px;height:80px;">
                                                                    <i class="fas fa-image text-muted"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="product-info">
                                                            <div class="product-name">{{ $item['name'] }}</div>
                                                            @if(!empty($item['size']) || !empty($item['color']))
                                                                <div class="product-variant">
                                                                    @if(!empty($item['size'])) Size: {{ $item['size'] }} @endif
                                                                    @if(!empty($item['size']) && !empty($item['color'])) | @endif
                                                                    @if(!empty($item['color'])) Color: {{ $item['color'] }} @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="price-cell">${{ number_format($item['price'], 2) }}</td>
                                                <td>
                                                    <div class="quantity-selector">
                                                        <button wire:click="updateQuantity('{{ $item['id'] }}', {{ $item['quantity'] - 1 }})" 
                                                                wire:loading.attr="disabled"
                                                                @if($item['quantity'] <= 1) disabled @endif>
                                                            −
                                                        </button>
                                                        <span class="qty-value">{{ $item['quantity'] }}</span>
                                                        <button wire:click="updateQuantity('{{ $item['id'] }}', {{ $item['quantity'] + 1 }})"
                                                                wire:loading.attr="disabled"
                                                                @if(isset($item['stock']) && $item['quantity'] >= $item['stock']) disabled @endif>
                                                            +
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="subtotal-cell">${{ number_format($item['subtotal'], 2) }}</td>
                                                <td>
                                                    <button class="btn-remove" wire:click="removeFromCart('{{ $item['id'] }}')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Cart Actions -->
                        <div class="cart-actions">
                            <a href="{{ route('products') }}" class="btn-continue">
                                <i class="fas fa-arrow-left"></i> Continue Shopping
                            </a>
                            <button class="btn-update" wire:click="clearCart" onclick="return confirm('Clear cart?')">
                                <i class="fas fa-trash-alt"></i> Clear Cart
                            </button>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="order-summary">
                            <h3 class="summary-title">Order Summary</h3>

                            <div class="summary-row">
                                <span class="label">Subtotal ({{ count($cartItems) }} items)</span>
                                <span class="value">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="label">Shipping</span>
                                <span class="value gold">
                                    @if($shipping == 0) FREE @else ${{ number_format($shipping, 2) }} @endif
                                </span>
                            </div>
                            <div class="summary-row">
                                <span class="label">Tax (10%)</span>
                                <span class="value">${{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="label">Discount</span>
                                <span class="value gold">-${{ number_format($discount, 2) }}</span>
                            </div>

                            <div class="summary-total">
                                <span class="total-label">Total</span>
                                <span class="total-value">${{ number_format($grandTotal, 2) }}</span>
                            </div>

                            @if($subtotal < 100)
                                <div class="alert alert-info small mt-3">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Add ${{ number_format(100 - $subtotal, 2) }} more for free shipping!
                                </div>
                            @endif

                            <!-- Promo Code -->
                            <div class="promo-code">
                                <div class="promo-input-group">
                                    <input type="text" id="couponCode" placeholder="Enter promo code" />
                                    <button class="btn-apply" wire:click="applyCoupon(document.getElementById('couponCode').value)">
                                        Apply
                                    </button>
                                </div>
                            </div>

                            <button class="btn-checkout" onclick="window.location.href='{{ route('checkout') }}'">
                                Proceed to Checkout
                            </button>

                            <div class="secure-badge">
                                <i class="fas fa-lock"></i> Secure checkout · 100% protected
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <!-- EMPTY CART -->
                <div class="empty-cart">
                    <div class="empty-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <h3>Your Cart is Empty</h3>
                    <p>Looks like you haven't added anything to your cart yet. Explore our collection and find something you love.</p>
                    <a href="{{ route('products') }}" class="btn-shop">Start Shopping</a>
                </div>
            @endif

        </div>
    </section>

    <!-- ============================================================
    STYLES
    ============================================================ -->
    <style>
        /* Cart Styles */
        .breadcrumb-custom {
            padding: 20px 0 10px;
            font-size: 0.7rem;
            font-weight: 300;
            letter-spacing: 0.05em;
            color: #999;
        }
        .breadcrumb-custom a {
            color: #999;
            text-decoration: none;
        }
        .breadcrumb-custom a:hover {
            color: #C9A227;
        }
        .breadcrumb-custom .separator {
            margin: 0 10px;
            color: #ddd;
        }
        .breadcrumb-custom .current {
            color: #0a0a0a;
        }

        .section-spacer {
            padding: 60px 0 80px;
        }

        .cart-header {
            text-align: center;
            padding: 20px 0 40px;
        }
        .cart-header h1 {
            font-size: clamp(2.8rem, 5vw, 4rem);
            font-weight: 300;
            letter-spacing: 0.06em;
            margin-bottom: 0.3rem;
        }
        .cart-header p {
            font-size: 1rem;
            font-weight: 300;
            color: #888;
        }

        .cart-table-wrap {
            background: #fff;
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-table thead th {
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #999;
            padding: 1rem 1.2rem;
            border-bottom: 1px solid rgba(0,0,0,0.04);
            text-align: left;
        }
        .cart-table tbody td {
            padding: 1.2rem;
            border-bottom: 1px solid rgba(0,0,0,0.04);
            vertical-align: middle;
        }
        .cart-table tbody tr:last-child td {
            border-bottom: none;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .product-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
            background: #FAFAFA;
        }
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .product-name {
            font-size: 0.9rem;
            font-weight: 400;
            color: #0a0a0a;
        }
        .product-variant {
            font-size: 0.75rem;
            font-weight: 300;
            color: #999;
        }

        .price-cell {
            font-size: 0.95rem;
            font-weight: 400;
            color: #0a0a0a;
        }
        .subtotal-cell {
            font-size: 0.95rem;
            font-weight: 500;
            color: #C9A227;
        }

        .quantity-selector {
            display: inline-flex;
            align-items: center;
            border: 1px solid #e5e5e5;
            border-radius: 40px;
            overflow: hidden;
        }
        .quantity-selector button {
            width: 32px;
            height: 32px;
            border: none;
            background: transparent;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.2s;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .quantity-selector button:hover:not(:disabled) {
            background: #FAFAFA;
        }
        .quantity-selector button:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
        .qty-value {
            min-width: 36px;
            text-align: center;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .btn-remove {
            background: none;
            border: none;
            color: #ccc;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.2s;
            padding: 4px 8px;
        }
        .btn-remove:hover {
            color: #e74c3c;
        }

        .cart-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            padding: 1.5rem 0;
        }
        .btn-continue {
            font-size: 0.7rem;
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #666;
            text-decoration: none;
            padding: 0.5rem 1.5rem;
            border: 1px solid #e5e5e5;
            border-radius: 40px;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-continue:hover {
            border-color: #C9A227;
            color: #C9A227;
        }
        .btn-update {
            font-size: 0.7rem;
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #666;
            padding: 0.5rem 1.5rem;
            border: 1px solid #e5e5e5;
            border-radius: 40px;
            background: transparent;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-update:hover {
            border-color: #e74c3c;
            color: #e74c3c;
        }

        .order-summary {
            background: #FAFAFA;
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid rgba(0,0,0,0.04);
            position: sticky;
            top: 20px;
        }
        .order-summary .summary-title {
            font-size: 1.6rem;
            font-weight: 300;
            letter-spacing: 0.04em;
            margin-bottom: 1.5rem;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.6rem 0;
            font-size: 0.9rem;
            font-weight: 300;
            color: #666;
            border-bottom: 1px solid rgba(0,0,0,0.04);
        }
        .summary-row .label {
            color: #999;
        }
        .summary-row .value {
            color: #0a0a0a;
        }
        .summary-row .value.gold {
            color: #C9A227;
        }
        .summary-total {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0 0.5rem;
            border-top: 2px solid #0a0a0a;
            margin-top: 0.5rem;
        }
        .summary-total .total-label {
            font-size: 1rem;
            font-weight: 500;
            color: #0a0a0a;
        }
        .summary-total .total-value {
            font-size: 1.8rem;
            font-weight: 400;
            color: #C9A227;
        }

        .promo-code {
            margin-top: 1.5rem;
        }
        .promo-input-group {
            display: flex;
            gap: 8px;
        }
        .promo-input-group input {
            flex: 1;
            padding: 0.6rem 1rem;
            border: 1px solid #e5e5e5;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 300;
            background: #fff;
            transition: 0.3s;
        }
        .promo-input-group input:focus {
            border-color: #C9A227;
            outline: none;
        }
        .btn-apply {
            padding: 0.6rem 1.5rem;
            background: #0a0a0a;
            color: #fff;
            border: none;
            border-radius: 40px;
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            white-space: nowrap;
        }
        .btn-apply:hover {
            background: #C9A227;
        }

        .btn-checkout {
            width: 100%;
            padding: 0.9rem;
            background: #C9A227;
            color: #fff;
            border: none;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 1.2rem;
        }
        .btn-checkout:hover {
            background: #b8911f;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(201,162,39,0.2);
        }

        .secure-badge {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.65rem;
            font-weight: 300;
            color: #999;
        }
        .secure-badge i {
            color: #C9A227;
            margin-right: 4px;
        }

        .empty-cart {
            text-align: center;
            padding: 80px 20px;
        }
        .empty-cart .empty-icon {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 1.5rem;
        }
        .empty-cart h3 {
            font-size: 2rem;
            font-weight: 300;
            letter-spacing: 0.04em;
            margin-bottom: 0.5rem;
        }
        .empty-cart p {
            font-size: 1rem;
            font-weight: 300;
            color: #888;
            max-width: 400px;
            margin: 0 auto 2rem;
        }
        .empty-cart .btn-shop {
            padding: 0.8rem 2.5rem;
            background: #0a0a0a;
            color: #fff;
            border: none;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .empty-cart .btn-shop:hover {
            background: #C9A227;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(201,162,39,0.2);
        }

        @media (max-width: 768px) {
            .cart-table thead {
                display: none;
            }
            .cart-table tbody td {
                display: block;
                padding: 0.8rem 1rem;
                border-bottom: none;
                text-align: right;
            }
            .cart-table tbody td::before {
                content: attr(data-label);
                float: left;
                font-weight: 500;
                color: #999;
                font-size: 0.7rem;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }
            .cart-table tbody tr {
                display: block;
                border-bottom: 1px solid rgba(0,0,0,0.04);
            }
            .cart-table tbody tr:last-child {
                border-bottom: none;
            }
            .product-cell {
                justify-content: flex-end;
            }
            .product-cell .product-info {
                text-align: right;
            }
            .quantity-selector {
                float: right;
            }
            .btn-remove {
                float: right;
            }
            .order-summary {
                margin-top: 2rem;
                position: static;
            }
            .cart-actions {
                flex-direction: column;
                align-items: stretch;
            }
            .btn-continue, .btn-update {
                text-align: center;
                justify-content: center;
            }
        }
    </style>
</div>