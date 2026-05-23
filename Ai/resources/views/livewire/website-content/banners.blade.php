<div>
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-ad me-2 text-primary"></i> Banners
        </h4>
        <button wire:click="openCreate" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Banner
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body py-2">
            <div class="d-flex gap-2 flex-wrap">
                <select wire:model.live="filterPosition" class="form-select w-auto">
                    <option value="">All Positions</option>
                    @foreach($positions as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
                <select wire:model.live="filterStatus" class="form-select w-auto">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Banners grouped by Position --}}
    @forelse($banners as $position => $group)
    <div class="mb-5">
        {{-- Position Header --}}
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="badge bg-primary fs-6 px-3 py-2">
                <i class="fas fa-map-marker-alt me-1"></i>
                {{ $positions[$position] ?? $position }}
            </span>
            <span class="text-muted small">{{ $group->count() }} banner(s)</span>
        </div>

        <div class="row g-3">
            @foreach($group as $banner)
            <div class="col-md-6 col-xl-4">
                <div class="card shadow-sm h-100 {{ !$banner->is_active ? 'opacity-60' : '' }}"
                     style="{{ !$banner->is_active ? 'opacity:0.6' : '' }}">

                    {{-- Banner Image --}}
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $banner->image) }}"
                             class="card-img-top"
                             style="height:160px;object-fit:cover"
                             onerror="this.src='https://via.placeholder.com/400x160?text=No+Image'">

                        {{-- Sort Order --}}
                        <span class="position-absolute top-0 start-0 m-2 badge bg-dark bg-opacity-75">
                            # {{ $banner->sort_order }}
                        </span>

                        {{-- Status --}}
                        <span class="position-absolute top-0 end-0 m-2 badge bg-{{ $banner->is_running ? 'success' : ($banner->is_active ? 'warning' : 'danger') }}">
                            {{ $banner->is_running ? 'Running' : ($banner->is_active ? 'Scheduled' : 'Inactive') }}
                        </span>
                    </div>

                    <div class="card-body py-2">
                        @if($banner->title)
                            <h6 class="fw-bold mb-1">{{ $banner->title }}</h6>
                        @endif
                        @if($banner->subtitle)
                            <p class="text-muted small mb-1">{{ Str::limit($banner->subtitle, 60) }}</p>
                        @endif
                        @if($banner->link)
                            <a href="{{ $banner->link }}" target="{{ $banner->open_in_new_tab ? '_blank' : '_self' }}"
                               class="small text-primary text-truncate d-block">
                                <i class="fas fa-link me-1"></i>{{ Str::limit($banner->link, 40) }}
                            </a>
                        @endif

                        {{-- Schedule Info --}}
                        @if($banner->starts_at || $banner->ends_at)
                        <div class="mt-2 small text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $banner->starts_at?->format('d M') ?? '—' }}
                            →
                            {{ $banner->ends_at?->format('d M Y') ?? 'No end' }}
                        </div>
                        @endif
                    </div>

                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                        {{-- Sort --}}
                        <div class="d-flex gap-1">
                            <button wire:click="moveUp({{ $banner->id }})"
                                    class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-arrow-up"></i>
                            </button>
                            <button wire:click="moveDown({{ $banner->id }})"
                                    class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-arrow-down"></i>
                            </button>
                        </div>
                        {{-- Actions --}}
                        <div class="d-flex gap-1">
                            <button wire:click="toggleActive({{ $banner->id }})"
                                    class="btn btn-sm btn-outline-{{ $banner->is_active ? 'warning' : 'success' }}"
                                    title="{{ $banner->is_active ? 'Deactivate' : 'Activate' }}">
                                <i class="fas fa-{{ $banner->is_active ? 'eye-slash' : 'eye' }}"></i>
                            </button>
                            <button wire:click="openEdit({{ $banner->id }})"
                                    class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="confirmDelete({{ $banner->id }})"
                                    class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <div class="text-center py-5 text-muted">
        <i class="fas fa-ad fa-3x mb-3 d-block opacity-25"></i>
        No banners found.
    </div>
    @endforelse

    {{-- ===== CREATE / EDIT MODAL ===== --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-ad me-2"></i>
                        {{ $editingId ? 'Edit Banner' : 'Add New Banner' }}
                    </h5>
                    <button wire:click="$set('showModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">

                        {{-- Position --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Position <span class="text-danger">*</span></label>
                            <select wire:model="position"
                                    class="form-select @error('position') is-invalid @enderror">
                                @foreach($positions as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Sort Order --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Sort Order</label>
                            <input wire:model="sort_order" type="number"
                                   class="form-control" min="0">
                        </div>

                        {{-- Image --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">
                                Banner Image {{ !$editingId ? '*' : '' }}
                            </label>
                            @if($existingImage && !$image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $existingImage) }}"
                                         class="rounded border w-100"
                                         style="height:120px;object-fit:cover">
                                    <div class="form-text">Current image. Upload new to replace.</div>
                                </div>
                            @endif
                            @if($image)
                                <div class="mb-2">
                                    <img src="{{ $image->temporaryUrl() }}"
                                         class="rounded border w-100"
                                         style="height:120px;object-fit:cover">
                                </div>
                            @endif
                            <input wire:model="image" type="file" accept="image/*"
                                   class="form-control @error('image') is-invalid @enderror">
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Title --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Title</label>
                            <input wire:model="title" type="text" class="form-control"
                                   placeholder="e.g. Summer Sale">
                        </div>

                        {{-- Subtitle --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Subtitle</label>
                            <input wire:model="subtitle" type="text" class="form-control"
                                   placeholder="e.g. Up to 50% off">
                        </div>

                        {{-- Link --}}
                        <div class="col-md-8">
                            <label class="form-label fw-medium">Link URL</label>
                            <input wire:model="link" type="text" class="form-control"
                                   placeholder="https://... or /products">
                        </div>

                        {{-- New Tab --}}
                        <div class="col-md-4 d-flex align-items-end">
                            <div class="form-check form-switch mb-2">
                                <input wire:model="open_in_new_tab" type="checkbox"
                                       class="form-check-input" id="newTab" role="switch">
                                <label class="form-check-label" for="newTab">New Tab</label>
                            </div>
                        </div>

                        {{-- Schedule --}}
                        <div class="col-12">
                            <div class="card border-0 bg-light">
                                <div class="card-body py-2">
                                    <h6 class="fw-bold mb-2">
                                        <i class="fas fa-calendar-alt me-2 text-info"></i>
                                        Schedule (Optional)
                                    </h6>
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label small">Start Date</label>
                                            <input wire:model="starts_at" type="date"
                                                   class="form-control @error('starts_at') is-invalid @enderror">
                                            @error('starts_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small">End Date</label>
                                            <input wire:model="ends_at" type="date"
                                                   class="form-control @error('ends_at') is-invalid @enderror">
                                            @error('ends_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Active --}}
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input wire:model="is_active" type="checkbox"
                                       class="form-check-input" id="bannerActive" role="switch">
                                <label class="form-check-label fw-medium" for="bannerActive">
                                    Active
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showModal', false)" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button wire:click="save" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Banner
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== DELETE CONFIRM ===== --}}
    @if($confirmingDeleteId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x mb-3 d-block"></i>
                    <h6>Delete this banner?</h6>
                    <p class="text-muted small mb-0">Image bhi permanently delete ho jayegi.</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button wire:click="$set('confirmingDeleteId', null)" class="btn btn-secondary">Cancel</button>
                    <button wire:click="delete" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>