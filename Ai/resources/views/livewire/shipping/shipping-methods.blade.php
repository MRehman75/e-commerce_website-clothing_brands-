<div>
    <div class="flex items-center justify-between mb-4 gap-2 d-flex flex-wrap">
        <div class="d-flex gap-2">
            <input wire:model.live.debounce.300ms="search" type="text"
                   placeholder="Search methods..." class="form-control w-auto" />
            <select wire:model.live="filterZone" class="form-select w-auto">
                <option value="">All Zones</option>
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                @endforeach
            </select>
        </div>
        <button wire:click="openCreate" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Method
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Zone</th>
                        <th>Carrier</th>
                        <th>Rate Type</th>
                        <th>Rate</th>
                        <th>Delivery</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($methods as $method)
                    <tr>
                        <td>{{ $method->id }}</td>
                        <td>{{ $method->name }}</td>
                        <td><span class="badge bg-info">{{ $method->shippingZone?->name ?? '—' }}</span></td>
                        <td>{{ $method->carrier ?? '—' }}</td>
                        <td><span class="badge bg-secondary">{{ $method->rate_type }}</span></td>
                        <td>Rs. {{ number_format($method->rate, 2) }}</td>
                        <td>{{ $method->getEstimatedDelivery() }}</td>
                        <td>
                            <button wire:click="toggleActive({{ $method->id }})"
                                    class="badge border-0 {{ $method->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $method->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td>
                            <button wire:click="openEdit({{ $method->id }})" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="confirmDelete({{ $method->id }})" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">No methods found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $methods->links() }}</div>

    {{-- Create/Edit Modal --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5)">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editingId ? 'Edit' : 'Add' }} Shipping Method</h5>
                    <button wire:click="$set('showModal', false)" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Shipping Zone *</label>
                            <select wire:model="shipping_zone_id" class="form-select @error('shipping_zone_id') is-invalid @enderror">
                                <option value="">Select Zone</option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                            @error('shipping_zone_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Method Name *</label>
                            <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Carrier</label>
                            <input wire:model="carrier" type="text" class="form-control" placeholder="TCS, Leopards, DHL...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rate Type *</label>
                            <select wire:model="rate_type" class="form-select">
                                <option value="flat">Flat</option>
                                <option value="weight_based">Weight Based</option>
                                <option value="price_based">Price Based</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rate (Rs.) *</label>
                            <input wire:model="rate" type="number" step="0.01" class="form-control @error('rate') is-invalid @enderror">
                            @error('rate') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Free Shipping Above (Rs.)</label>
                            <input wire:model="min_order_amount" type="number" step="0.01" class="form-control" placeholder="Leave empty to disable">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estimated Days (Min)</label>
                            <input wire:model="estimated_days_min" type="number" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estimated Days (Max)</label>
                            <input wire:model="estimated_days_max" type="number" class="form-control">
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input wire:model="is_active" type="checkbox" class="form-check-input" id="methodActive">
                                <label class="form-check-label" for="methodActive">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showModal', false)" class="btn btn-secondary">Cancel</button>
                    <button wire:click="save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Delete Confirm --}}
    @if($confirmingDeleteId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5)">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fs-2 mb-2 d-block"></i>
                    <p>Delete this shipping method?</p>
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