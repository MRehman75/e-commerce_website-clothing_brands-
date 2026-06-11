<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-shopping-bag me-2"></i>Products</h2>
        <span class="text-muted">{{ $products->total() }} products mile</span>
    </div>
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Filters</h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Search</label>
                        <div class="input-group">
                            <input type="text" wire:model.live.debounce.300ms="search" class="form-control" placeholder="Product dhundho...">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Category</label>
                        <select wire:model.live="category" class="form-select">
                            <option value="">Sab Categories</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Brand</label>
                        <select wire:model.live="brand" class="form-select">
                            <option value="">Sab Brands</option>
                            @foreach($brands as $b)
                            <option value="{{ $b->slug }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Sort By</label>
                        <select wire:model.live="sortBy" class="form-select mb-2">
                            <option value="created_at">Newest</option>
                            <option value="price">Price</option>
                            <option value="name">Name</option>
                        </select>
                        <select wire:model.live="sortOrder" class="form-select">
                            <option value="asc">Low to High</option>
                            <option value="desc">High to Low</option>
                        </select>
                    </div>
                    <button wire:click="$set('search', ''); $set('category', ''); $set('brand', '')" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-redo me-2"></i>Reset Filters
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            @if($products->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted">Koi product nahi mila!</h4>
                    <p class="text-muted">Filter change karein ya search clear karein</p>
                </div>
            @else
            <div class="row g-3">
                @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <div class="position-relative overflow-hidden" style="height:220px;">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-100 h-100" style="object-fit:cover;">
                            @else
                            <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                            @endif
                            @if($product->featured)
                            <span class="badge bg-warning position-absolute top-0 start-0 m-2">
                                <i class="fas fa-star me-1"></i>Featured
                            </span>
                            @endif
                            @if($product->stock < 1)
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background:rgba(0,0,0,0.5);">
                                <span class="badge bg-danger fs-6">Out of Stock</span>
                            </div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            @if($product->category)
                            <small class="text-muted mb-1">{{ $product->category->name }}</small>
                            @endif
                            <h6 class="card-title fw-bold mb-1">{{ $product->name }}</h6>
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="text-primary fw-bold fs-5">PKR {{ number_format($product->price, 0) }}</span>
                                @if($product->compare_price && $product->compare_price > $product->price)
                                <span class="text-muted text-decoration-line-through small">PKR {{ number_format($product->compare_price, 0) }}</span>
                                <span class="badge bg-danger small">{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}% OFF</span>
                                @endif
                            </div>
                            <small class="text-muted mb-2">Stock: {{ $product->stock > 0 ? $product->stock . ' available' : 'Out of Stock' }}</small>
                            <button wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled" wire:target="addToCart({{ $product->id }})" @disabled($product->stock < 1) class="btn btn-primary mt-auto w-100">
                                <span wire:loading.remove wire:target="addToCart({{ $product->id }})"><i class="fas fa-cart-plus me-2"></i>Cart Mein Add Karein</span>
                                <span wire:loading wire:target="addToCart({{ $product->id }})"><i class="fas fa-spinner fa-spin me-2"></i>Adding...</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">{{ $products->links() }}</div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('notify', (event) => {
            const toast = document.getElementById('liveToast');
            const toastMsg = document.getElementById('toastMsg');
            if(toastMsg) toastMsg.textContent = event.message;
            if(toast) new bootstrap.Toast(toast, {delay:3000}).show();
        });
        Livewire.on('cartUpdated', (event) => {
            const badge = document.getElementById('cart-count');
            if (badge) badge.textContent = event.count;
        });
    });
</script>
@endpush