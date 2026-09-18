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
            <span class="current">Checkout</span>
        </div>
    </div>

    <!-- Checkout Page -->
    <section class="section-spacer" style="padding-top:10px;">
        <div class="container">

            <!-- Checkout Header -->
            <div class="text-center mb-4">
                <h1 style="font-family:var(--font-heading);font-size:clamp(2.8rem,5vw,4rem);font-weight:300;letter-spacing:0.06em;">
                    Checkout
                </h1>
                <p style="font-family:var(--font-body);font-size:1rem;font-weight:300;color:#888;">Complete your order with confidence</p>
            </div>

            <!-- Checkout Steps -->
            <div class="checkout-steps">
                <div class="step completed">
                    <div class="step-number"><i class="fas fa-check"></i></div>
                    <span class="step-label">Cart</span>
                </div>
                <div class="step-connector completed"></div>
                <div class="step active">
                    <div class="step-number">2</div>
                    <span class="step-label">Checkout</span>
                </div>
                <div class="step-connector"></div>
                <div class="step">
                    <div class="step-number">3</div>
                    <span class="step-label">Confirmation</span>
                </div>
            </div>

            <!-- Checkout Content -->
            <div class="row g-4">

                <!-- Checkout Form -->
                <div class="col-lg-7">
                    <div class="checkout-form-wrap" id="checkoutForm">

                        <!-- Shipping Information -->
                        <div class="mb-4">
                            <h3 class="form-section-title">Shipping Information</h3>
                            <p class="form-section-sub">Enter your delivery details</p>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name <span class="required">*</span></label>
                                    <input type="text"
                                           wire:model="first_name"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           placeholder="Enter first name" />
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name <span class="required">*</span></label>
                                    <input type="text"
                                           wire:model="last_name"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           placeholder="Enter last name" />
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email Address</label>
                                    <input type="email"
                                           wire:model="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Enter email address (optional)" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                <label class="form-label">Phone Number <span class="required">*</span></label>
                                     <input type="tel"
                                      wire:model="phone"
                                         wire:input="this.phone = this.phone.replace(/[^0-9]/g, '')"
                                             maxlength="11"
                                          class="form-control @error('phone') is-invalid @enderror"
                                          placeholder="03000000000" />
                                        @error('phone')
                                       <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                    <small class="text-muted">must be 11 digits (e.g.03000000000)</small>
                                    </div>
                                <div class="col-12">
                                    <label class="form-label">Street Address <span class="required">*</span></label>
                                    <input type="text"
                                           wire:model="address"
                                           class="form-control @error('address') is-invalid @enderror"
                                           placeholder="Enter street address" />
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <select wire:model="city" class="form-control @error('city') is-invalid @enderror" autocomplete="off">
    <option value="">-- Select City --</option>
    @foreach($cities as $cityOption)
        <option value="{{ $cityOption }}" {{ $city == $cityOption ? 'selected' : '' }}>
            {{ $cityOption }}
        </option>
    @endforeach
</select>
                                <div class="col-md-4">
                                    <label class="form-label">Province <span class="required">*</span></label>
                                    <select wire:model="state" class="form-control @error('state') is-invalid @enderror">
                                        <option value="">Select Province</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province }}">{{ $province }}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Postal Code <span class="required">*</span></label>
                                    <input type="text"
                                           wire:model="postal_code"
                                           class="form-control @error('postal_code') is-invalid @enderror"
                                           placeholder="Enter postal code" />
                                    @error('postal_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="mb-4">
                            <h3 class="form-section-title">Payment Information</h3>
                            <p class="form-section-sub">Choose your preferred payment method</p>

                            <!-- Payment Methods - Only Cash on Delivery -->
                            <div class="payment-methods">
                                <div class="payment-option active" style="flex:1; min-width:100%;">
                                    <i class="fas fa-money-bill-wave" style="font-size:2rem;"></i>
                                    <span class="payment-label" style="font-size:0.9rem; font-weight:500; color:#0a0a0a;">Cash on Delivery</span>
                                    <p style="font-size:0.7rem; color:#6c757d; margin-top:4px; margin-bottom:0;">
                                        Pay when you receive your order
                                    </p>
                                </div>
                            </div>

                            <!-- Payment Note -->
                            <div class="mt-3 text-muted small">
                                <i class="fas fa-info-circle me-1"></i>
                                You will pay in cash upon delivery of your order.
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="col-lg-5">
                    <div class="checkout-summary">
                        <h3 class="summary-title">Your Order</h3>

                        <!-- Order Items -->
                        @foreach($cartItems as $item)
                            <div class="summary-item">
                                <div class="item-image">
                                    @if(!empty($item['image']))
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" />
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="width:100%;height:100%;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="item-details">
                                    <div class="item-name">{{ $item['name'] }}</div>
                                    <div class="item-variant">
                                        @if(!empty($item['size'])) Size: {{ $item['size'] }} @endif
                                        @if(!empty($item['size']) && !empty($item['color'])) | @endif
                                        @if(!empty($item['color'])) Color: {{ $item['color'] }} @endif
                                        <span style="margin-left:4px;">× {{ $item['quantity'] }}</span>
                                    </div>
                                </div>
                                <div class="item-price">${{ number_format($item['subtotal'], 2) }}</div>
                            </div>
                        @endforeach

                        <!-- Totals -->
                        <div class="summary-totals">
                            <div class="total-row">
                                <span class="label">Subtotal ({{ count($cartItems) }} items)</span>
                                <span class="value">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="total-row">
                                <span class="label">Shipping</span>
                                <span class="value gold">@if($shipping == 0) FREE @else ${{ number_format($shipping, 2) }} @endif</span>
                            </div>
                            <div class="total-row">
                                <span class="label">Tax (10%)</span>
                                <span class="value">${{ number_format($tax, 2) }}</span>
                            </div>

                            <div class="grand-total">
                                <span class="total-label">Total</span>
                                <span class="total-value">${{ number_format($grandTotal, 2) }}</span>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <button class="btn-place-order" wire:click="openConfirmModal" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="fas fa-lock me-2"></i> Place Order
                            </span>
                            <span wire:loading>
                                <i class="fas fa-spinner fa-spin me-2"></i> Processing...
                            </span>
                        </button>

                        <div style="text-align:center;margin-top:1rem;font-family:var(--font-body);font-size:0.65rem;font-weight:300;color:#999;">
                            <i class="fas fa-shield-alt" style="color:var(--gold);margin-right:4px;"></i>
                            Your information is secure and encrypted
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================
CONFIRMATION MODAL
============================================================ -->
@if($showConfirmModal)
    <div class="modal-overlay" wire:click.self="closeConfirmModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirm Your Order</h3>
                <button class="modal-close" wire:click="closeConfirmModal">×</button>
            </div>
            <div class="modal-body">
                <div class="modal-summary">
                    <div class="modal-summary-row">
                        <span>Items:</span>
                        <span>{{ count($cartItems) }}</span>
                    </div>
                    
                    <!-- ✅ Order Items with Size & Color -->
                    @foreach($cartItems as $item)
                        <div class="modal-summary-row" style="font-size:0.85rem; padding-left:20px; border-bottom:none; padding-top:2px; padding-bottom:2px;">
                            <span>
                                {{ $item['name'] }}
                                @if(!empty($item['size']))
                                    <span class="badge bg-secondary" style="font-size:0.6rem;">{{ $item['size'] }}</span>
                                @endif
                                @if(!empty($item['color']))
                                    <span class="badge" style="font-size:0.6rem; background:{{ $item['color'] }}; color:{{ $item['color'] == '#000000' ? '#fff' : '#000' }};">
                                        {{ $item['color'] }}
                                    </span>
                                @endif
                                <span style="color:#999; font-size:0.75rem;">× {{ $item['quantity'] }}</span>
                            </span>
                            <span>${{ number_format($item['subtotal'], 2) }}</span>
                        </div>
                    @endforeach
                    
                    <div class="modal-summary-row">
                        <span>Subtotal:</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="modal-summary-row">
                        <span>Shipping:</span>
                        <span>@if($shipping == 0) FREE @else ${{ number_format($shipping, 2) }} @endif</span>
                    </div>
                    <div class="modal-summary-row">
                        <span>Tax:</span>
                        <span>${{ number_format($tax, 2) }}</span>
                    </div>
                    <div class="modal-summary-row total">
                        <span>Total:</span>
                        <span class="total-amount">${{ number_format($grandTotal, 2) }}</span>
                    </div>
                </div>

                <div class="modal-address">
                    <h5>Shipping To:</h5>
                    <p>{{ $first_name }} {{ $last_name }}<br>
                    {{ $address }}<br>
                    {{ $city }}, {{ $state }} - {{ $postal_code }}<br>
                    {{ $email }} | {{ $phone }}</p>
                </div>

                <p class="modal-message">Are you sure you want to place this order?</p>
            </div>
            <div class="modal-footer">
                <button class="btn-modal-cancel" wire:click="closeConfirmModal">Cancel</button>
                <button class="btn-modal-confirm" wire:click="confirmOrder" wire:loading.attr="disabled">
                    <span wire:loading.remove>Confirm Order</span>
                    <span wire:loading><i class="fas fa-spinner fa-spin"></i> Processing...</span>
                </button>
            </div>
        </div>
    </div>
@endif
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

        body.modal-open {
            overflow: hidden !important;
        }

        .gold {
            color: var(--gold);
        }

        /* ============================================================
           SHAKE ANIMATION
        ============================================================ */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
            20%, 40%, 60%, 80% { transform: translateX(8px); }
        }

        .shake {
            animation: shake 0.6s ease-in-out;
            border-color: #dc3545 !important;
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
           CHECKOUT FORM
        ============================================================ */
        .checkout-form-wrap {
            background: #fff;
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.04);
            padding: 2.5rem;
        }

        .checkout-form-wrap .form-section-title {
            font-family: var(--font-heading);
            font-size: 1.4rem;
            font-weight: 300;
            letter-spacing: 0.04em;
            margin-bottom: 0.3rem;
        }

        .checkout-form-wrap .form-section-sub {
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 300;
            color: #999;
            margin-bottom: 1.5rem;
        }

        .checkout-form-wrap .form-control {
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 0.8rem 1.2rem;
            font-family: var(--font-body);
            font-size: 0.9rem;
            transition: 0.3s;
            background: var(--bg-light);
        }

        .checkout-form-wrap .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(201, 162, 39, 0.06);
            background: #fff;
        }

        .checkout-form-wrap .form-control::placeholder {
            color: #bbb;
            font-weight: 300;
        }

        .checkout-form-wrap .form-label {
            font-family: var(--font-body);
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            color: #333;
        }

        .checkout-form-wrap .form-label .required {
            color: #e74c3c;
            margin-left: 2px;
        }

        .checkout-form-wrap .form-control.is-invalid {
            border-color: #dc3545;
        }

        .checkout-form-wrap .invalid-feedback {
            font-size: 0.75rem;
            color: #dc3545;
        }

        .checkout-form-wrap select.form-control {
            appearance: auto;
        }

        /* ============================================================
           PAYMENT METHODS
        ============================================================ */
        .payment-methods {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 0.5rem;
        }

        .payment-methods .payment-option {
            flex: 1;
            min-width: 120px;
            padding: 1.5rem 1rem;
            border: 2px solid #e5e5e5;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
            background: #fff;
        }

        .payment-methods .payment-option:hover {
            border-color: #ddd;
        }

        .payment-methods .payment-option.active {
            border-color: var(--gold);
            background: rgba(201, 162, 39, 0.04);
        }

        .payment-methods .payment-option i {
            font-size: 1.6rem;
            display: block;
            margin-bottom: 4px;
            color: #666;
        }

        .payment-methods .payment-option.active i {
            color: var(--gold);
        }

        .payment-methods .payment-option .payment-label {
            font-family: var(--font-body);
            font-size: 0.65rem;
            font-weight: 400;
            color: #666;
        }

        .payment-methods .payment-option.active .payment-label {
            color: var(--primary);
        }

        /* ============================================================
           ORDER SUMMARY (Checkout Sidebar)
        ============================================================ */
        .checkout-summary {
            background: var(--bg-light);
            border-radius: 16px;
            padding: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 20px;
        }

        .checkout-summary .summary-title {
            font-family: var(--font-heading);
            font-size: 1.4rem;
            font-weight: 300;
            letter-spacing: 0.04em;
            margin-bottom: 1.2rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .checkout-summary .summary-item {
            display: flex;
            gap: 12px;
            padding: 0.6rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        }

        .checkout-summary .summary-item:last-child {
            border-bottom: none;
        }

        .checkout-summary .summary-item .item-image {
            width: 56px;
            height: 56px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            background: #fff;
        }

        .checkout-summary .summary-item .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .checkout-summary .summary-item .item-details {
            flex: 1;
        }

        .checkout-summary .summary-item .item-details .item-name {
            font-family: var(--font-body);
            font-size: 0.8rem;
            font-weight: 400;
            color: var(--primary);
        }

        .checkout-summary .summary-item .item-details .item-variant {
            font-family: var(--font-body);
            font-size: 0.65rem;
            font-weight: 300;
            color: #999;
        }

        .checkout-summary .summary-item .item-price {
            font-family: var(--font-body);
            font-size: 0.8rem;
            font-weight: 400;
            color: var(--gold);
            white-space: nowrap;
        }

        .checkout-summary .summary-totals {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.04);
        }

        .checkout-summary .summary-totals .total-row {
            display: flex;
            justify-content: space-between;
            padding: 0.4rem 0;
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 300;
            color: #666;
        }

        .checkout-summary .summary-totals .total-row .label {
            color: #999;
        }

        .checkout-summary .summary-totals .total-row .value {
            color: var(--primary);
        }

        .checkout-summary .summary-totals .total-row .value.gold {
            color: var(--gold);
        }

        .checkout-summary .summary-totals .grand-total {
            display: flex;
            justify-content: space-between;
            padding: 0.8rem 0 0.4rem;
            border-top: 2px solid var(--primary);
            margin-top: 0.4rem;
        }

        .checkout-summary .summary-totals .grand-total .total-label {
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 500;
            color: var(--primary);
        }

        .checkout-summary .summary-totals .grand-total .total-value {
            font-family: var(--font-heading);
            font-size: 1.6rem;
            font-weight: 400;
            color: var(--gold);
        }

        /* ============================================================
           PLACE ORDER BUTTON
        ============================================================ */
        .btn-place-order {
            width: 100%;
            padding: 1rem;
            background: var(--gold);
            color: #fff;
            border: none;
            border-radius: 40px;
            font-family: var(--font-body);
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            margin-top: 1.5rem;
        }

        .btn-place-order:hover:not(:disabled) {
            background: #b8911f;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(201, 162, 39, 0.2);
        }

        .btn-place-order:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* ============================================================
           CONFIRMATION MODAL
        ============================================================ */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-content {
            background: #fff;
            border-radius: 20px;
            max-width: 520px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 80px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 28px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }

        .modal-header h3 {
            font-family: var(--font-heading);
            font-weight: 600;
            color: var(--primary);
            margin: 0;
            font-size: 1.4rem;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.8rem;
            color: #999;
            cursor: pointer;
            padding: 0 4px;
            transition: 0.2s;
            line-height: 1;
        }

        .modal-close:hover {
            color: #333;
        }

        .modal-body {
            padding: 24px 28px 16px;
        }

        .modal-summary {
            background: var(--bg-light);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 16px;
        }

        .modal-summary-row {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            font-size: 0.9rem;
            color: #666;
        }

        .modal-summary-row.total {
            border-top: 2px solid var(--gold);
            padding-top: 10px;
            margin-top: 4px;
            font-weight: 600;
            color: var(--primary);
        }

        .modal-summary-row.total .total-amount {
            color: var(--gold);
            font-size: 1.2rem;
        }

        .modal-address {
            padding: 12px 16px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 16px;
            border-left: 3px solid var(--gold);
        }

        .modal-address h5 {
            font-size: 0.75rem;
            color: #999;
            margin: 0 0 4px 0;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .modal-address p {
            margin: 0;
            font-size: 0.85rem;
            color: #333;
            line-height: 1.6;
        }

        .modal-message {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0 0 4px 0;
        }

        .modal-footer {
            padding: 16px 28px 24px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-modal-cancel {
            padding: 10px 24px;
            border: 1px solid #dee2e6;
            border-radius: 30px;
            background: #fff;
            color: #666;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-modal-cancel:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
        }

        .btn-modal-confirm {
            padding: 10px 28px;
            border: none;
            border-radius: 30px;
            background: var(--gold);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-modal-confirm:hover:not(:disabled) {
            background: #b8911f;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(201, 162, 39, 0.3);
        }

        .btn-modal-confirm:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 992px) {
            .checkout-form-wrap {
                padding: 1.8rem;
            }

            .checkout-summary {
                margin-top: 2rem;
                position: static;
            }
        }

        @media (max-width: 768px) {
            .section-spacer {
                padding: 40px 0 60px;
            }

            .checkout-form-wrap {
                padding: 1.2rem;
            }

            .checkout-form-wrap .form-section-title {
                font-size: 1.2rem;
            }

            .payment-methods .payment-option {
                min-width: 80px;
                padding: 0.8rem;
            }

            .checkout-summary .summary-totals .grand-total .total-value {
                font-size: 1.4rem;
            }

            .modal-content {
                max-width: 100%;
                margin: 16px;
                border-radius: 16px;
            }

            .modal-header,
            .modal-body,
            .modal-footer {
                padding-left: 20px;
                padding-right: 20px;
            }

            .modal-footer {
                flex-direction: column;
            }

            .btn-modal-cancel,
            .btn-modal-confirm {
                width: 100%;
                justify-content: center;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .checkout-steps .step .step-number {
                width: 30px;
                height: 30px;
                font-size: 0.7rem;
            }

            .checkout-steps .step-connector {
                width: 12px;
            }

            .payment-methods .payment-option i {
                font-size: 1.2rem;
            }

            .payment-methods .payment-option .payment-label {
                font-size: 0.55rem;
            }

            .btn-place-order {
                font-size: 0.7rem;
                padding: 0.8rem;
            }

            .modal-header h3 {
                font-size: 1.2rem;
            }
        }
    </style>
</div>