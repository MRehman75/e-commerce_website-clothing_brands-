<div>
    {{-- Header --}}
   <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0 text-white"><i class="fas fa-box-open me-2"></i>All Products</h4>
            <small class="text-white-50">Manage your products</small>
        </div>
        <a href="{{ route('admin.products.create') }}" wire:navigate class="btn btn-light btn-sm">
            <i class="fas fa-plus me-1"></i> Add Product
        </a>
    </div>
</div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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
               <div class="col-md-2">
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-trademark me-1"></i>
            {{ $filterBrand ? $brands->find($filterBrand)?->name : 'All Brands' }}
        </button>
        <ul class="dropdown-menu w-100">
            <li><a class="dropdown-item" wire:click="$set('filterBrand', '')"><i class="fas fa-list me-2 text-secondary"></i>All Brands</a></li>
            @foreach($brands as $brand)
            <li><a class="dropdown-item" wire:click="$set('filterBrand', '{{ $brand->id }}')"><i class="fas fa-trademark me-2 text-primary"></i>{{ $brand->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<div class="col-md-2">
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-filter me-1"></i>
            {{ $filterStatus ? ucfirst($filterStatus) : 'All Status' }}
        </button>
        <ul class="dropdown-menu w-100">
            <li><a class="dropdown-item" wire:click="$set('filterStatus', '')"><i class="fas fa-list me-2 text-secondary"></i>All Status</a></li>
            <li><a class="dropdown-item text-success" wire:click="$set('filterStatus', 'active')"><i class="fas fa-check-circle me-2"></i>Active</a></li>
            <li><a class="dropdown-item text-warning" wire:click="$set('filterStatus', 'inactive')"><i class="fas fa-pause-circle me-2"></i>Inactive</a></li>
            <li><a class="dropdown-item text-secondary" wire:click="$set('filterStatus', 'draft')"><i class="fas fa-file me-2"></i>Draft</a></li>
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     width="45" height="45"
                                     class="rounded border object-fit-cover"
                                     onerror="this.src='https://via.placeholder.com/45'">
                            @else
                                <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                                     style="width:45px;height:45px">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $product->name }}</div>
                        </td>
                        <td><code class="text-muted small">{{ $product->sku ?? '—' }}</code></td>
                        <td>{{ $product->category?->name ?? '—' }}</td>
                        <td>{{ $product->brand?->name ?? '—' }}</td>
                        <td>
                            <div class="fw-semibold">Rs. {{ number_format($product->price, 2) }}</div>
                            @if($product->compare_price)
                                <small class="text-muted text-decoration-line-through">Rs. {{ number_format($product->compare_price, 2) }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>
                            <button wire:click="toggleStatus({{ $product->id }})"
                                    class="badge border-0 bg-{{ $product->status === 'active' ? 'success' : ($product->status === 'draft' ? 'warning' : 'danger') }}">
                                {{ ucfirst($product->status) }}
                            </button>
                        </td>
                        <td>
                            <button wire:click="toggleFeatured({{ $product->id }})" class="btn btn-sm border-0 p-0">
                                <i class="fas fa-star {{ $product->featured ? 'text-warning' : 'text-muted' }} fs-5"></i>
                            </button>
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" wire:navigate
                               class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button wire:click="confirmDelete({{ $product->id }})" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-5">
                            <i class="fas fa-box-open fs-2 d-block mb-2"></i>No products found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">{{ $products->links() }}</div>
    </div>

    {{-- Delete Confirm Modal --}}
    @if($confirmingDeleteId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5)">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fs-2 mb-2 d-block"></i>
                    <p>Delete this product?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button wire:click="$set('confirmingDeleteId', null)" class="btn btn-secondary">Cancel</button>
                    <button wire:click="delete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>