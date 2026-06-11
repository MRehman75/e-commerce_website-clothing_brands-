{{-- resources/views/livewire/frontend/cart-page.blade.php --}}
<div class="container py-5">
    <h2 class="mb-4"><i class="fas fa-shopping-cart me-2"></i>Shopping Cart</h2>

    @if(empty($cart))
        {{-- Empty Cart --}}
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
            <h4 class="text-muted">Aapka cart khali hai!</h4>
            <p class="text-muted">Kuch products add karein</p>
            <a href="{{ route('products') }}" wire:navigate class="btn btn-primary mt-3">
                <i class="fas fa-shopping-bag me-2"></i>Shopping Karein
            </a>
        </div>
    @else
        <div class="row g-4">
            {{-- Cart Items --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $productId => $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                @if($item['image'])
                                                <img src="{{ asset('storage/' . $item['image']) }}"
                                                     alt="{{ $item['name'] }}"
                                                     style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                                @else
                                                <div class="bg-light d-flex align-items-center justify-content-center"
                                                     style="width:60px;height:60px;border-radius:8px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                                @endif
                                                <div>
                                                    <strong>{{ $item['name'] }}</strong>
                                                    @if($item['sku'])
                                                    <br><small class="text-muted">SKU: {{ $item['sku'] }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <strong>PKR {{ number_format($item['price'], 0) }}</strong>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <button wire:click="updateQuantity({{ $productId }}, {{ $item['quantity'] - 1 }})"
                                                        class="btn btn-sm btn-outline-secondary"
                                                        style="width:30px;height:30px;padding:0;">
                                                    <i class="fas fa-minus" style="font-size:10px;"></i>
                                                </button>
                                                <span class="fw-bold" style="min-width:30px;text-align:center;">
                                                    {{ $item['quantity'] }}
                                                </span>
                                                <button wire:click="updateQuantity({{ $productId }}, {{ $item['quantity'] + 1 }})"
                                                        class="btn btn-sm btn-outline-secondary"
                                                        style="width:30px;height:30px;padding:0;">
                                                    <i class="fas fa-plus" style="font-size:10px;"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <strong class="text-primary">PKR {{ number_format($item['total'], 0) }}</strong>
                                        </td>
                                        <td class="text-center">
                                            <button wire:click="removeItem({{ $productId }})"
                                                    wire:confirm="Yeh item remove karein?"
                                                    class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('products') }}" wire:navigate class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Shopping Continue Karein
                    </a>
                    <button wire:click="clearCart"
                            wire:confirm="Pura cart clear karein?"
                            class="btn btn-outline-danger">
                        <i class="fas fa-trash me-2"></i>Cart Clear Karein
                    </button>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <strong>PKR {{ number_format($this->subtotal, 0) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <strong>PKR {{ number_format($this->shipping, 0) }}</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold fs-5">Total</span>
                            <strong class="text-primary fs-5">PKR {{ number_format($this->total, 0) }}</strong>
                        </div>
                        <a href="{{ route('checkout') }}" wire:navigate
                           class="btn btn-primary w-100 py-2">
                            <i class="fas fa-lock me-2"></i>Checkout Karein
                        </a>
                    </div>
                </div>

                {{-- Free Shipping Notice --}}
                @if($this->subtotal < 2000)
                <div class="alert alert-info mt-3 small">
                    <i class="fas fa-truck me-2"></i>
                    PKR {{ number_format(2000 - $this->subtotal, 0) }} aur shopping karein — Free Shipping milegi!
                </div>
                @else
                <div class="alert alert-success mt-3 small">
                    <i class="fas fa-check-circle me-2"></i>
                    Aapko Free Shipping mil rahi hai!
                </div>
                @endif
            </div>
        </div>
    @endif
</div>