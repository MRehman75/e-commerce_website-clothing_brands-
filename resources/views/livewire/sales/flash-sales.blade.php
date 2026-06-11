<div>
   <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #f953c6 0%, #b91d73 100%);">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0 text-white"><i class="fas fa-bolt me-2"></i>Flash Sales</h4>
            <small class="text-white-50">Manage your flash sales</small>
        </div>
        <button class="btn btn-light btn-sm" wire:click="openModal">
            <i class="fas fa-plus me-1"></i> Add Flash Sale
        </button>
    </div>
</div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats -->
   <div class="row g-3 mb-3">
    <div class="col-md-3">
        <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #f953c6 0%, #b91d73 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Total Flash Sales</h6>
                    <h3 class="mb-0 fw-bold">{{ $total }}</h3>
                </div>
                <i class="fas fa-bolt fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #1d976c 0%, #93f9b9 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Active Flash Sales</h6>
                    <h3 class="mb-0 fw-bold">{{ $active }}</h3>
                </div>
                <i class="fas fa-check-circle fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
</div>
    <!-- Search -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Search by title..."
                        wire:model.live="search">
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size: 0.82rem;">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Discount</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($flashSales as $flashSale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $flashSale->title }}</strong><br>
                                    <small class="text-muted">{{ $flashSale->description }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-danger">
                                        {{ $flashSale->discount_percentage }}% OFF
                                    </span>
                                </td>
                                <td>{{ $flashSale->start_time->format('d M Y H:i') }}</td>
                                <td>{{ $flashSale->end_time->format('d M Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-{{ $flashSale->status_color }}">
                                        {{ ucfirst($flashSale->status) }}
                                    </span>
                                </td>
                               <td>
    <div class="btn-group">
        <button wire:click="editFlashSale({{ $flashSale->id }})"
                class="btn btn-sm btn-warning text-white" title="Edit">
            <i class="fas fa-edit"></i>
        </button>
        <button wire:click="toggleStatus({{ $flashSale->id }})"
                class="btn btn-sm btn-info text-white" title="Toggle Status">
            <i class="fas fa-toggle-on"></i>
        </button>
        <button wire:click="deleteFlashSale({{ $flashSale->id }})"
                class="btn btn-sm btn-danger" title="Delete"
                onclick="return confirm('Delete karna chahte ho?')">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-bolt fa-2x mb-2 d-block"></i>
                                    No flash sales found!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $flashSales->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editId ? 'Edit Flash Sale' : 'Add New Flash Sale' }}</h5>
                    <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Title *</label>
                            <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror"
                                wire:model="title" placeholder="e.g. Weekend Flash Sale">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Discount % *</label>
                            <input type="number" class="form-control form-control-sm @error('discount_percentage') is-invalid @enderror"
                                wire:model="discount_percentage" placeholder="e.g. 30">
                            @error('discount_percentage') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Start Time *</label>
                            <input type="datetime-local" class="form-control form-control-sm @error('start_time') is-invalid @enderror"
                                wire:model="start_time">
                            @error('start_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Time *</label>
                            <input type="datetime-local" class="form-control form-control-sm @error('end_time') is-invalid @enderror"
                                wire:model="end_time">
                            @error('end_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select form-select-sm" wire:model="is_active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control form-control-sm" wire:model="description" rows="2"
                                placeholder="Optional description..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="$set('showModal', false)">Cancel</button>
                    <button type="button" class="btn btn-primary btn-sm" wire:click="saveFlashSale">
                        {{ $editId ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>