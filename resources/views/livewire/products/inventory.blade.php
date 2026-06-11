<div>
   <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #005c97 0%, #363795 100%);">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0 text-white"><i class="fas fa-warehouse me-2"></i>Inventory</h4>
            <small class="text-white-50">Manage your stock</small>
        </div>
        <i class="fas fa-boxes fa-2x text-white-50"></i>
    </div>
</div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Summary Cards --}}
   <div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #1d976c 0%, #93f9b9 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">In Stock</h6>
                    <h3 class="mb-0 fw-bold">{{ number_format($inStock) }}</h3>
                </div>
                <i class="fas fa-check-circle fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Low Stock (≤10)</h6>
                    <h3 class="mb-0 fw-bold">{{ number_format($lowStock) }}</h3>
                </div>
                <i class="fas fa-exclamation-triangle fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #c94b4b 0%, #4b134f 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Out of Stock</h6>
                    <h3 class="mb-0 fw-bold">{{ number_format($outOfStock) }}</h3>
                </div>
                <i class="fas fa-times-circle fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
</div>

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <input wire:model.live.debounce.300ms="search" type="text"
                           class="form-control" placeholder="Search by name or SKU...">
                </div>
               <div class="col-md-3">
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-tags me-1"></i>
            {{ $filterCategory ? $categories->find($filterCategory)?->name : 'All Categories' }}
        </button>
        <ul class="dropdown-menu w-100">
            <li><a class="dropdown-item" wire:click="$set('filterCategory', '')"><i class="fas fa-list me-2 text-secondary"></i>All Categories</a></li>
            @foreach($categories as $cat)
            <li><a class="dropdown-item" wire:click="$set('filterCategory', '{{ $cat->id }}')"><i class="fas fa-tag me-2 text-primary"></i>{{ $cat->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<div class="col-md-3">
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-boxes me-1"></i>
            @if($filterStock == 'in') In Stock
            @elseif($filterStock == 'low') Low Stock
            @elseif($filterStock == 'out') Out of Stock
            @else All Stock Levels
            @endif
        </button>
        <ul class="dropdown-menu w-100">
            <li><a class="dropdown-item" wire:click="$set('filterStock', '')"><i class="fas fa-list me-2 text-secondary"></i>All Stock Levels</a></li>
            <li><a class="dropdown-item text-success" wire:click="$set('filterStock', 'in')"><i class="fas fa-check-circle me-2"></i>In Stock (&gt;10)</a></li>
            <li><a class="dropdown-item text-warning" wire:click="$set('filterStock', 'low')"><i class="fas fa-exclamation-triangle me-2"></i>Low Stock (1–10)</a></li>
            <li><a class="dropdown-item text-danger" wire:click="$set('filterStock', 'out')"><i class="fas fa-times-circle me-2"></i>Out of Stock</a></li>
        </ul>
    </div>
</div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         width="40" height="40"
                                         class="rounded border object-fit-cover">
                                @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                                         style="width:40px;height:40px">
                                        <i class="fas fa-image text-muted small"></i>
                                    </div>
                                @endif
                                <span class="fw-semibold">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td><code class="text-muted small">{{ $product->sku ?? '—' }}</code></td>
                        <td>{{ $product->category?->name ?? '—' }}</td>
                        <td>Rs. {{ number_format($product->price, 2) }}</td>
                        <td>
                            <span class="badge fs-6 {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>
                            @if($product->stock === 0)
                                <span class="badge bg-danger">Out of Stock</span>
                            @elseif($product->stock <= 10)
                                <span class="badge bg-warning">Low Stock</span>
                            @else
                                <span class="badge bg-success">In Stock</span>
                            @endif
                        </td>
                        <td>
                            <button wire:click="openStockEdit({{ $product->id }})"
                                    class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit me-1"></i> Update Stock
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-warehouse fs-2 d-block mb-2"></i>No products found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">{{ $products->links() }}</div>
    </div>

    {{-- Stock Edit Modal --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5)">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Stock</h5>
                    <button wire:click="$set('showModal', false)" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label fw-semibold">New Stock Quantity</label>
                    <input wire:model="editStock" type="number" min="0"
                           class="form-control @error('editStock') is-invalid @enderror">
                    @error('editStock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showModal', false)" class="btn btn-secondary">Cancel</button>
                    <button wire:click="updateStock" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>