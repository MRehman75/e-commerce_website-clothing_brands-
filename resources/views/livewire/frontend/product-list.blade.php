<div>

    {{-- ═══════════════════════════════════
         POPUP BANNER MODAL
    ═══════════════════════════════════ --}}
    @if(isset($popupBanner) && $popupBanner)
    <div class="modal fade" id="popupBannerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <a href="{{ $popupBanner->link ?? '#' }}"
                       {{ $popupBanner->open_in_new_tab ? 'target=_blank' : '' }}>
                        <img src="{{ asset('storage/' . $popupBanner->image) }}"
                             class="w-100 rounded-bottom" alt="{{ $popupBanner->title }}">
                    </a>
                    @if($popupBanner->title || $popupBanner->subtitle)
                    <div class="p-3 text-center">
                        @if($popupBanner->title)
                        <h5 class="fw-bold">{{ $popupBanner->title }}</h5>
                        @endif
                        @if($popupBanner->subtitle)
                        <p class="text-muted mb-0">{{ $popupBanner->subtitle }}</p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ═══════════════════════════════════
         HOMEPAGE TOP BANNER
    ═══════════════════════════════════ --}}
    @if(isset($homepageTopBanner) && $homepageTopBanner)
    <a href="{{ $homepageTopBanner->link ?? '#' }}"
       {{ $homepageTopBanner->open_in_new_tab ? 'target=_blank' : '' }}>
        <img src="{{ asset('storage/' . $homepageTopBanner->image) }}"
             class="w-100" style="max-height:100px;object-fit:cover;"
             alt="{{ $homepageTopBanner->title }}">
    </a>
    @endif

    {{-- ═══════════════════════════════════
         HOME SLIDER
    ═══════════════════════════════════ --}}
    @if($sliders->count() > 0)
    <div id="homeSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            @foreach($sliders as $index => $slider)
            <button type="button" data-bs-target="#homeSlider" data-bs-slide-to="{{ $index }}"
                class="{{ $index === 0 ? 'active' : '' }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($sliders as $index => $slider)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100"
                    style="height: 450px; object-fit: cover;" alt="{{ $slider->title }}">
                <div class="carousel-caption d-none d-md-block">
                    @if($slider->title)
                    <span class="badge bg-{{ $slider->badge_color ?? 'primary' }} mb-2">{{ $slider->title }}</span>
                    @endif
                    @if($slider->subtitle)
                    <h3>{{ $slider->subtitle }}</h3>
                    @endif
                    @if($slider->button_text && $slider->button_link)
                    <a href="{{ $slider->button_link }}" class="btn btn-light mt-2">
                        {{ $slider->button_text }} &rarr;
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#homeSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    @endif

    {{-- ═══════════════════════════════════
         PRODUCTS SECTION
    ═══════════════════════════════════ --}}
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-shopping-bag me-2"></i>Products</h2>
            <span class="text-muted">{{ $products->total() }} products mile</span>
        </div>
        <div class="row g-4">

            {{-- ── Filters Sidebar ── --}}
            <div class="col-lg-3">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white">
                        <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Filters</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Search</label>
                            <div class="input-group">
                                <input type="text" wire:model.live.debounce.300ms="search"
                                       class="form-control" placeholder="Product dhundho...">
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
                        <button wire:click="$set('search', ''); $set('category', ''); $set('brand', '')"
                                class="btn btn-outline-secondary w-100">
                            <i class="fas fa-redo me-2"></i>Reset Filters
                        </button>
                    </div>
                </div>

                {{-- ── SIDEBAR BANNER ── --}}
                @if(isset($sidebarBanner) && $sidebarBanner)
                <div class="mt-3">
                    <a href="{{ $sidebarBanner->link ?? '#' }}"
                       {{ $sidebarBanner->open_in_new_tab ? 'target=_blank' : '' }}>
                        <img src="{{ asset('storage/' . $sidebarBanner->image) }}"
                             alt="{{ $sidebarBanner->title }}"
                             class="img-fluid rounded shadow-sm w-100">
                    </a>
                    @if($sidebarBanner->title)
                    <p class="text-center fw-bold mt-2 mb-0">{{ $sidebarBanner->title }}</p>
                    @endif
                    @if($sidebarBanner->subtitle)
                    <p class="text-center text-muted small">{{ $sidebarBanner->subtitle }}</p>
                    @endif
                </div>
                @endif

            </div>


            {{-- ── Products Grid ── --}}
            <div class="col-lg-9">
                  {{-- ── CATEGORY TOP BANNER ── --}}
@if($category && isset($categoryTopBanner) && $categoryTopBanner)
<div class="mb-3">
    <a href="{{ $categoryTopBanner->link ?? '#' }}"
       {{ $categoryTopBanner->open_in_new_tab ? 'target=_blank' : '' }}>
        <img src="{{ asset('storage/' . $categoryTopBanner->image) }}"
             class="w-100 rounded shadow-sm"
             style="max-height:150px;object-fit:cover;"
             alt="{{ $categoryTopBanner->title }}">
    </a>
</div>
@endif

                @if($products->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                        <h4 class="text-muted">Koi product nahi mila!</h4>
                        <p class="text-muted">Filter change karein ya search clear karein</p>
                    </div>
                @else
                <div class="row g-3">
                    @foreach($products as $i => $product)

                    {{-- ── HOMEPAGE MIDDLE BANNER ── --}}
                    @if($i === 3 && isset($homepageMiddleBanner) && $homepageMiddleBanner)
                    <div class="col-12">
                        <a href="{{ $homepageMiddleBanner->link ?? '#' }}"
                           {{ $homepageMiddleBanner->open_in_new_tab ? 'target=_blank' : '' }}>
                            <img src="{{ asset('storage/' . $homepageMiddleBanner->image) }}"
                                 class="w-100 rounded shadow-sm"
                                 style="max-height:150px;object-fit:cover;"
                                 alt="{{ $homepageMiddleBanner->title }}">
                        </a>
                    </div>
                    @endif

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-0 product-card">
                            <div class="position-relative overflow-hidden" style="height:220px;">
                                @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}" class="w-100 h-100" style="object-fit:cover;">
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
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                     style="background:rgba(0,0,0,0.5);">
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
                                    @if($activeFlashSale)
                                        @php $salePrice = $product->price - ($product->price * $activeFlashSale->discount_percentage / 100); @endphp
                                        <span class="text-danger fw-bold fs-5">PKR {{ number_format($salePrice, 0) }}</span>
                                        <span class="text-muted text-decoration-line-through small">PKR {{ number_format($product->price, 0) }}</span>
                                        <span class="badge bg-danger small">⚡ {{ $activeFlashSale->discount_percentage }}% OFF</span>
                                    @elseif($product->compare_price && $product->compare_price > $product->price)
                                        <span class="text-primary fw-bold fs-5">PKR {{ number_format($product->price, 0) }}</span>
                                        <span class="text-muted text-decoration-line-through small">PKR {{ number_format($product->compare_price, 0) }}</span>
                                        <span class="badge bg-danger small">{{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}% OFF</span>
                                    @else
                                        <span class="text-primary fw-bold fs-5">PKR {{ number_format($product->price, 0) }}</span>
                                    @endif
                                </div>
                                <small class="text-muted mb-2">
                                    Stock: {{ $product->stock > 0 ? $product->stock . ' available' : 'Out of Stock' }}
                                </small>
                                <button wire:click="addToCart({{ $product->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="addToCart({{ $product->id }})"
                                        @disabled($product->stock < 1)
                                        class="btn btn-primary mt-auto w-100">
                                    <span wire:loading.remove wire:target="addToCart({{ $product->id }})">
                                        <i class="fas fa-cart-plus me-2"></i>Cart Mein Add Karein
                                    </span>
                                    <span wire:loading wire:target="addToCart({{ $product->id }})">
                                        <i class="fas fa-spinner fa-spin me-2"></i>Adding...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $products->links() }}</div>
                @endif

                {{-- ── HOMEPAGE BOTTOM BANNER ── --}}
                @if(isset($homepageBottomBanner) && $homepageBottomBanner)
                <div class="mt-4">
                    <a href="{{ $homepageBottomBanner->link ?? '#' }}"
                       {{ $homepageBottomBanner->open_in_new_tab ? 'target=_blank' : '' }}>
                        <img src="{{ asset('storage/' . $homepageBottomBanner->image) }}"
                             class="w-100 rounded shadow-sm"
                             style="max-height:150px;object-fit:cover;"
                             alt="{{ $homepageBottomBanner->title }}">
                    </a>
                </div>
                @endif

            </div>
        </div>
    </div>


    {{-- ═══════════════════════════════════
         SCRIPTS
    ═══════════════════════════════════ --}}
    <script>
        // ── Notify & Cart ──
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

        // ── Popup Banner ──
        // ── Popup Banner ──
@if(isset($popupBanner) && $popupBanner)
function showPopup() {
    var el = document.getElementById('popupBannerModal');
    if (el) {
        new bootstrap.Modal(el).show();
    }
}
setTimeout(showPopup, 1500);
@endif
    </script>

</div>