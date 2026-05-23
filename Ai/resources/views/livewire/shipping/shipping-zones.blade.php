<div>
    <div class="flex items-center justify-between mb-4">
        <input wire:model.live.debounce.300ms="search" type="text"
               placeholder="Search zones..."
               class="form-control w-64" />
        <button wire:click="openCreate" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Zone
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
                        <th>Region</th>
                        <th>Countries</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($zones as $zone)
                    <tr>
                        <td>{{ $zone->id }}</td>
                        <td>{{ $zone->name }}</td>
                        <td>{{ $zone->region ?? '—' }}</td>
                        <td>
                            @if($zone->countries)
                                <span class="badge bg-secondary">{{ implode(', ', $zone->countries) }}</span>
                            @else — @endif
                        </td>
                        <td>
                            <button wire:click="toggleActive({{ $zone->id }})"
                                    class="badge border-0 {{ $zone->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $zone->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td>
                            <button wire:click="openEdit({{ $zone->id }})" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="confirmDelete({{ $zone->id }})" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No zones found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $zones->links() }}</div>

    {{-- Create/Edit Modal --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5)">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editingId ? 'Edit' : 'Add' }} Shipping Zone</h5>
                    <button wire:click="$set('showModal', false)" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Region</label>
                        <input wire:model="region" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Countries (comma separated, e.g. PK,IN,BD)</label>
                        <input type="text" class="form-control"
       wire:model="countriesString"
       placeholder="PK, IN, BD">
                    </div>
                    <div class="form-check">
                        <input wire:model="is_active" type="checkbox" class="form-check-input" id="zoneActive">
                        <label class="form-check-label" for="zoneActive">Active</label>
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

    {{-- Delete Confirm Modal --}}
    @if($confirmingDeleteId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5)">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fs-2 mb-2 d-block"></i>
                    <p>Are you sure you want to delete this zone?</p>
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