<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0"><i class="fas fa-tags me-2 text-primary"></i>Categories</h4>
        <button wire:click="openCreate" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Category
        </button>
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
                   class="form-control" placeholder="Search categories...">
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Parent</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}"
                                     width="40" height="40" class="rounded border object-fit-cover">
                            @else
                                <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                                     style="width:40px;height:40px">
                                    <i class="fas fa-image text-muted small"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $category->name }}</td>
                        <td><code class="text-muted small">{{ $category->slug }}</code></td>
                        <td>{{ $category->parent?->name ?? '—' }}</td>
                        <td>{{ $category->order }}</td>
                        <td>
                            <span class="badge {{ $category->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($category->status) }}
                            </span>
                        </td>
                        <td>
                            <button wire:click="openEdit({{ $category->id }})" class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="confirmDelete({{ $category->id }})" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-tags fs-2 d-block mb-2"></i>No categories found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">{{ $categories->links() }}</div>
    </div>

    {{-- Create/Edit Modal --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5)">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editingId ? 'Edit' : 'Add' }} Category</h5>
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
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Parent Category</label>
                        <select wire:model="parent_id" class="form-select">
                            <option value="">None (Top Level)</option>
                            @foreach($parentCategories as $parent)
                                @if($parent->id !== $editingId)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- CKEditor Description --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">CKEditor</label>
                        <div wire:ignore>
                            <textarea id="category-ckeditor"></textarea>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Order</label>
                            <input wire:model="order" type="number" min="0" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select wire:model="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Image</label>
                        @if($existingImage)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $existingImage) }}"
                                     height="60" class="rounded border">
                            </div>
                        @endif
                        @if($image)
                            <div class="mb-2">
                                <img src="{{ $image->temporaryUrl() }}" height="60" class="rounded border">
                            </div>
                        @endif
                        <input wire:model="image" type="file" class="form-control" accept="image/*">
                        @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
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
                    <p>Delete this category?</p>
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
        function initCategoryCKEditor(content = '') {
            if (typeof CKEDITOR === 'undefined') {
                setTimeout(() => initCategoryCKEditor(content), 300);
                return;
            }

            const el = document.getElementById('category-ckeditor');
            if (!el) return;

            if (CKEDITOR.instances['category-ckeditor']) {
                CKEDITOR.instances['category-ckeditor'].destroy(true);
            }

            CKEDITOR.replace('category-ckeditor', {
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

            CKEDITOR.instances['category-ckeditor'].on('instanceReady', function () {
                if (content) {
                    CKEDITOR.instances['category-ckeditor'].setData(content);
                }
            });

            CKEDITOR.instances['category-ckeditor'].on('change', function () {
                @this.set('description', CKEDITOR.instances['category-ckeditor'].getData());
            });
        }

        document.addEventListener('livewire:initialized', function () {
            Livewire.on('categoryModalOpened', function (data) {
                const content = data && data.content ? data.content : '';
                setTimeout(() => initCategoryCKEditor(content), 300);
            });
        });
    </script>
</div>