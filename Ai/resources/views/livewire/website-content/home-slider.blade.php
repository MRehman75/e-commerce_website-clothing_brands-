<div>
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-images me-2 text-primary"></i> Home Slider
        </h4>
        <button wire:click="openCreate" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Slide
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Sliders Grid --}}
    @if($sliders->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fas fa-images fa-3x mb-3 d-block opacity-25"></i>
            No slides added yet.
        </div>
    @else
    <div class="row g-4">
        @foreach($sliders as $slide)
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100 {{ !$slide->is_active ? 'opacity-50' : '' }}">
                {{-- Slide Image --}}
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $slide->image) }}"
                         class="card-img-top"
                         style="height:180px;object-fit:cover;"
                         onerror="this.src='https://via.placeholder.com/400x180?text=No+Image'">

                    {{-- Order Badge --}}
                    <span class="position-absolute top-0 start-0 m-2 badge bg-dark bg-opacity-75">
                        # {{ $slide->sort_order }}
                    </span>

                    {{-- Active Badge --}}
                    <span class="position-absolute top-0 end-0 m-2 badge bg-{{ $slide->is_active ? 'success' : 'danger' }}">
                        {{ $slide->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <div class="card-body">
                    @if($slide->title)
                        <h6 class="card-title fw-bold mb-1">{{ $slide->title }}</h6>
                    @endif
                    @if($slide->subtitle)
                        <p class="card-text text-muted small mb-2">{{ Str::limit($slide->subtitle, 80) }}</p>
                    @endif
                    @if($slide->button_text)
                  <!--   <a href="{{ $slide->button_link }}" 
   target="_blank" 
   class="badge bg-{{ $slide->badge_color }} text-decoration-none">
    {{ $slide->button_text }}
</a> -->
                        <span class="badge bg-{{ $slide->badge_color }}">
                            {{ $slide->button_text }} → {{ $slide->button_link }}
                        </span> 
                    @endif
                </div>

                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    {{-- Sort Controls --}}
                    <div class="d-flex gap-1">
                        <button wire:click="moveUp({{ $slide->id }})"
                                class="btn btn-sm btn-outline-secondary" title="Move Up">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                        <button wire:click="moveDown({{ $slide->id }})"
                                class="btn btn-sm btn-outline-secondary" title="Move Down">
                            <i class="fas fa-arrow-down"></i>
                        </button>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-1">
                        <button wire:click="toggleActive({{ $slide->id }})"
                                class="btn btn-sm btn-outline-{{ $slide->is_active ? 'warning' : 'success' }}"
                                title="{{ $slide->is_active ? 'Deactivate' : 'Activate' }}">
                            <i class="fas fa-{{ $slide->is_active ? 'eye-slash' : 'eye' }}"></i>
                        </button>
                        <button wire:click="openEdit({{ $slide->id }})"
                                class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button wire:click="confirmDelete({{ $slide->id }})"
                                class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- ===== CREATE / EDIT MODAL ===== --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-images me-2"></i>
                        {{ $editingId ? 'Edit Slide' : 'Add New Slide' }}
                    </h5>
                    <button wire:click="$set('showModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">

                        {{-- Image Upload --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">
                                Slide Image {{ !$editingId ? '*' : '' }}
                                <small class="text-muted">(Recommended: 1920x600px)</small>
                            </label>

                            {{-- Existing Image Preview --}}
                            @if($existingImage && !$image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $existingImage) }}"
                                         class="rounded border"
                                         style="height:100px;object-fit:cover;width:100%">
                                    <div class="form-text">Current image. Upload new to replace.</div>
                                </div>
                            @endif

                            {{-- New Image Preview --}}
                            @if($image)
                                <div class="mb-2">
                                    <img src="{{ $image->temporaryUrl() }}"
                                         class="rounded border"
                                         style="height:100px;object-fit:cover;width:100%">
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

                        {{-- Badge Color --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Badge Color</label>
                            <select wire:model="badge_color" class="form-select">
                                <option value="primary">Blue (Primary)</option>
                                <option value="success">Green (Success)</option>
                                <option value="danger">Red (Danger)</option>
                                <option value="warning">Yellow (Warning)</option>
                                <option value="info">Cyan (Info)</option>
                            </select>
                        </div>

                        {{-- Subtitle --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">Subtitle</label>
                            <input wire:model="subtitle" type="text" class="form-control"
                                   placeholder="e.g. Up to 50% off on all items">
                        </div>

                        {{-- Button Text --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Button Text</label>
                            <input wire:model="button_text" type="text" class="form-control"
                                   placeholder="e.g. Shop Now">
                        </div>

                        {{-- Button Link --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Button Link</label>
                            <input wire:model="button_link" type="text" class="form-control" 
                                   placeholder="e.g. /products or https://...">
                        </div>

                        {{-- Sort Order + Active --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Sort Order</label>
                            <input wire:model="sort_order" type="number" class="form-control" min="0">
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-check form-switch mb-2">
                                <input wire:model="is_active" type="checkbox"
                                       class="form-check-input" id="sliderActive" role="switch">
                                <label class="form-check-label fw-medium" for="sliderActive">
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
                        <i class="fas fa-save me-1"></i> Save Slide
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
                    <h6>Delete this slide?</h6>
                    <p class="text-muted small">Image bhi permanently delete ho jayegi.</p>
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