<div>
  <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #4776e6 0%, #8e54e9 100%);">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0 text-white"><i class="fas fa-trademark me-2"></i>Brands</h4>
            <small class="text-white-50">Manage your brands</small>
        </div>
        <button wire:click="openCreate" class="btn btn-light btn-sm">
            <i class="fas fa-plus me-1"></i> Add Brand
        </button>
    </div>
</div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body py-2">
            <input wire:model.live.debounce.300ms="search" type="text"
                   class="form-control" placeholder="Search brands...">
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($brands as $brand)
                    <tr>
                        <td>
                            @if($brand->logo)
                                <img src="{{ asset('storage/' . $brand->logo) }}"
                                     width="45" height="45" class="rounded border object-fit-contain p-1">
                            @else
                                <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                                     style="width:45px;height:45px">
                                    <i class="fas fa-trademark text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $brand->name }}</td>
                        <td><code class="text-muted small">{{ $brand->slug }}</code></td>
                        <td><span class="badge bg-info">{{ $brand->products_count }}</span></td>
                        <td>
                            <span class="badge {{ $brand->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($brand->status) }}
                            </span>
                        </td>
                        <td>
                            <button wire:click="openEdit({{ $brand->id }})" class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="confirmDelete({{ $brand->id }})" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="fas fa-trademark fs-2 d-block mb-2"></i>No brands found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">{{ $brands->links() }}</div>
    </div>

    {{-- Create/Edit Modal --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5)">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editingId ? 'Edit' : 'Add' }} Brand</h5>
                    <button wire:click="$set('showModal', false)" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name *</label>
                        <input wire:model.live="name" type="text"
                               class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Slug *</label>
                        <input wire:model="slug" type="text"
                               class="form-control @error('slug') is-invalid @enderror">
                        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- CKEditor Description --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">CKEditor</label>
                        <div wire:ignore>
                            <textarea id="brand-ckeditor"></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select wire:model="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Logo</label>
                        @if($existingLogo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $existingLogo) }}"
                                     height="60" class="rounded border p-1">
                            </div>
                        @endif
                        @if($logo)
                            <div class="mb-2">
                                <img src="{{ $logo->temporaryUrl() }}" height="60" class="rounded border">
                            </div>
                        @endif
                        <input wire:model="logo" type="file" class="form-control" accept="image/*">
                        @error('logo') <div class="text-danger small">{{ $message }}</div> @enderror
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
                    <p>Delete this brand?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button wire:click="$set('confirmingDeleteId', null)" class="btn btn-secondary">Cancel</button>
                    <button wire:click="delete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== CKEditor 4 - FREE VERSION ===== --}}
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        function initBrandCKEditor(content = '') {
            if (typeof CKEDITOR === 'undefined') {
                setTimeout(() => initBrandCKEditor(content), 300);
                return;
            }

            const el = document.getElementById('brand-ckeditor');
            if (!el) return;

            if (CKEDITOR.instances['brand-ckeditor']) {
                CKEDITOR.instances['brand-ckeditor'].destroy(true);
            }

            CKEDITOR.replace('brand-ckeditor', {
                height: 200,
                versionCheck: false,
                toolbarGroups: [
                    { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                    { name: 'paragraph',   groups: ['list', 'indent', 'blocks', 'align'] },
                    { name: 'links' },
                    { name: 'styles' },
                    { name: 'colors' },
                ],
            });

            CKEDITOR.instances['brand-ckeditor'].on('instanceReady', function () {
                if (content) {
                    CKEDITOR.instances['brand-ckeditor'].setData(content);
                }
            });

            CKEDITOR.instances['brand-ckeditor'].on('change', function () {
                @this.set('description', CKEDITOR.instances['brand-ckeditor'].getData());
            });
        }

        document.addEventListener('livewire:initialized', function () {
            Livewire.on('brandModalOpened', function (data) {
                const content = data && data.content ? data.content : '';
                setTimeout(() => initBrandCKEditor(content), 300);
            });
        });
    </script>
</div>