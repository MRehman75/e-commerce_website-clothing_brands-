{{-- resources/views/livewire/frontend/checkout.blade.php --}}
<div class="container py-5">
    <h2 class="mb-4"><i class="fas fa-lock me-2"></i>Checkout</h2>

    @if(empty($cart))
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
            <h4 class="text-muted">Cart khali hai!</h4>
            <a href="{{ route('products') }}" wire:navigate class="btn btn-primary mt-3">Shopping Karein</a>
        </div>
    @else
    <div class="row g-4">
        {{-- Checkout Form --}}
        <div class="col-lg-7">

            {{-- Customer Info --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Customer Information</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="customer_name"
                                   class="form-control @error('customer_name') is-invalid @enderror"
                                   placeholder="Apna naam daalo">
                            @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" wire:model="customer_email"
                                   class="form-control @error('customer_email') is-invalid @enderror"
                                   placeholder="Email address">
                            @error('customer_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" wire:model="customer_phone"
                                   class="form-control @error('customer_phone') is-invalid @enderror"
                                   placeholder="03xxxxxxxxx">
                            @error('customer_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Shipping Address --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Shipping Address</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Shipping Address <span class="text-danger">*</span></label>
                        <textarea wire:model.live="shipping_address" rows="3"
                                  class="form-control @error('shipping_address') is-invalid @enderror"
                                  placeholder="Ghar ka pura address daalo"></textarea>
                        @error('shipping_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" wire:model.live="same_address"
                               class="form-check-input" id="sameAddress">
                        <label class="form-check-label" for="sameAddress">
                            Billing address same hai
                        </label>
                    </div>

                    @if(!$same_address)
                    <div>
                        <label class="form-label fw-semibold">Billing Address <span class="text-danger">*</span></label>
                        <textarea wire:model="billing_address" rows="3"
                                  class="form-control @error('billing_address') is-invalid @enderror"
                                  placeholder="Billing address daalo"></textarea>
                        @error('billing_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                </div>
            </div>

            {{-- Payment Method --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-warning">
                    <h6 class="mb-0"><i class="fas fa-credit-card me-2"></i>Payment Method</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="payment-option d-flex align-items-center gap-3 p-3 border rounded cursor-pointer {{ $payment_method === 'cod' ? 'border-primary bg-primary bg-opacity-10' : '' }}"
                                   style="cursor:pointer;">
                                <input type="radio" wire:model="payment_method" value="cod" class="form-check-input mt-0">
                                <div>
                                    <i class="fas fa-money-bill-wave fa-2x text-success mb-1 d-block"></i>
                                    <strong>Cash on Delivery</strong>
                                    <small class="text-muted d-block">Ghar pe cash dain</small>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="payment-option d-flex align-items-center gap-3 p-3 border rounded cursor-pointer {{ $payment_method === 'bank_transfer' ? 'border-primary bg-primary bg-opacity-10' : '' }}"
                                   style="cursor:pointer;">
                                <input type="radio" wire:model="payment_method" value="bank_transfer" class="form-check-input mt-0">
                                <div>
                                    <i class="fas fa-university fa-2x text-primary mb-1 d-block"></i>
                                    <strong>Bank Transfer</strong>
                                    <small class="text-muted d-block">Bank account mein transfer</small>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="payment-option d-flex align-items-center gap-3 p-3 border rounded cursor-pointer {{ $payment_method === 'jazzcash' ? 'border-primary bg-primary bg-opacity-10' : '' }}"
                                   style="cursor:pointer;">
                                <input type="radio" wire:model="payment_method" value="jazzcash" class="form-check-input mt-0">
                                <div>
                                    <i class="fas fa-mobile-alt fa-2x text-danger mb-1 d-block"></i>
                                    <strong>JazzCash</strong>
                                    <small class="text-muted d-block">JazzCash se payment</small>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="payment-option d-flex align-items-center gap-3 p-3 border rounded cursor-pointer {{ $payment_method === 'easypaisa' ? 'border-primary bg-primary bg-opacity-10' : '' }}"
                                   style="cursor:pointer;">
                                <input type="radio" wire:model="payment_method" value="easypaisa" class="form-check-input mt-0">
                                <div>
                                    <i class="fas fa-wallet fa-2x text-success mb-1 d-block"></i>
                                    <strong>EasyPaisa</strong>
                                    <small class="text-muted d-block">EasyPaisa se payment</small>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Notes --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <label class="form-label fw-semibold">Order Notes (Optional)</label>
                    <textarea wire:model="notes" rows="2"
                              class="form-control"
                              placeholder="Koi special instruction ho to likho..."></textarea>
                </div>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 sticky-top" style="top:20px;">
                <div class="card-header bg-dark text-white">
                    <h6 class="mb-0"><i class="fas fa-receipt me-2"></i>Order Summary</h6>
                </div>
                <div class="card-body">
                    {{-- Items --}}
                    @foreach($cart as $item)
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            @if($item['image'])
                            <img src="{{ asset('storage/' . $item['image']) }}"
                                 style="width:40px;height:40px;object-fit:cover;border-radius:6px;">
                            @endif
                            <div>
                                <small class="fw-semibold">{{ $item['name'] }}</small>
                                <small class="text-muted d-block">x{{ $item['quantity'] }}</small>
                            </div>
                        </div>
                        <small class="fw-bold">PKR {{ number_format($item['total'], 0) }}</small>
                    </div>
                    @endforeach

                    {{-- Coupon --}}
                    <div class="mb-3">
                        @if(!$appliedCoupon)
                        <div class="input-group">
                            <input type="text" wire:model="coupon_code"
                                   class="form-control form-control-sm"
                                   placeholder="Coupon code daalo">
                            <button wire:click="applyCoupon"
                                    class="btn btn-sm btn-outline-primary">Apply</button>
                        </div>
                        @else
                        <div class="d-flex justify-content-between align-items-center bg-success bg-opacity-10 p-2 rounded">
                            <small class="text-success fw-bold">
                                <i class="fas fa-tag me-1"></i>{{ $appliedCoupon['code'] }}
                            </small>
                            <button wire:click="removeCoupon" class="btn btn-sm btn-outline-danger py-0">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        @endif

                        @if($coupon_message)
                        <small class="text-{{ $coupon_status === 'success' ? 'success' : 'danger' }} d-block mt-1">
                            {{ $coupon_message }}
                        </small>
                        @endif
                    </div>

                    {{-- Pricing --}}
                    <div class="d-flex justify-content-between mb-1">
                        <span>Subtotal</span>
                        <strong>PKR {{ number_format($this->subtotal, 0) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Shipping</span>
                        <strong>PKR {{ number_format($this->shipping, 0) }}</strong>
                    </div>
                    @if($discount > 0)
                    <div class="d-flex justify-content-between mb-1 text-success">
                        <span>Discount</span>
                        <strong>- PKR {{ number_format($discount, 0) }}</strong>
                    </div>
                    @endif
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold fs-5">Total</span>
                        <strong class="text-primary fs-5">PKR {{ number_format($this->total, 0) }}</strong>
                    </div>

                    <button wire:click="placeOrder"
                            wire:loading.attr="disabled"
                            class="btn btn-primary w-100 py-2">
                        <span wire:loading.remove>
                            <i class="fas fa-check-circle me-2"></i>Order Place Karein
                        </span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin me-2"></i>Processing...
                        </span>
                    </button>

                    <small class="text-muted d-block text-center mt-2">
                        <i class="fas fa-lock me-1"></i>Secure Checkout
                    </small>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>