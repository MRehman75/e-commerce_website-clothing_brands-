<div>
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded"
     style="background: linear-gradient(135deg, #4776e6 0%, #8e54e9 100%);">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-white bg-opacity-25 p-2 rounded-circle">
            <i class="fas fa-file-alt fa-2x text-white"></i>
        </div>
        <div>
            <h4 class="mb-0 text-white fw-bold">Pages Content</h4>
            <small class="text-white-50">Manage your website pages</small>
        </div>
    </div>
    <button wire:click="openCreate"
            class="btn btn-sm fw-bold shadow"
            style="background:white; color:#4776e6;">
        <i class="fas fa-plus me-1"></i> Add Page
    </button>
</div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body py-2">
            <div class="row g-2 align-items-center">
                <div class="col-md-5">
                    <input wire:model.live.debounce.300ms="search"
                           type="text" class="form-control"
                           placeholder="Search by title or slug...">
                </div>
               <div class="col-md-3">
    <select wire:model.live="filterType" class="form-select">
        <option value="">📋 All Pages</option>
        <option value="fixed">📌 Fixed Pages</option>
        <option value="dynamic">⚡ Dynamic Pages</option>
    </select>
</div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Last Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                    <tr>
                        <td>{{ $page->id }}</td>
                        <td>
                            <div class="fw-semibold">{{ $page->title }}</div>
                            @if($page->meta_title)
                                <small class="text-muted">{{ Str::limit($page->meta_title, 50) }}</small>
                            @endif
                        </td>
                        <td>
                            <code class="text-primary small">/{{ $page->slug }}</code>
                        </td>
                        <td>
                            @if($page->is_fixed)
                                <span class="badge bg-info">
                                    <i class="fas fa-lock me-1"></i> Fixed
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="fas fa-edit me-1"></i> Dynamic
                                </span>
                            @endif
                        </td>
                        <td>
                            <button wire:click="toggleActive({{ $page->id }})"
                                    class="badge border-0 bg-{{ $page->is_active ? 'success' : 'danger' }}">
                                {{ $page->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td class="text-muted small">
                            {{ $page->updated_at->format('d M Y') }}
                        </td>
                        <td>
                            <button wire:click="openEdit({{ $page->id }})"
                                    class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            @if(!$page->is_fixed)
                                <button wire:click="confirmDelete({{ $page->id }})"
                                        class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @else
                                <button class="btn btn-sm btn-outline-secondary" disabled title="Fixed pages cannot be deleted">
                                    <i class="fas fa-lock"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-file-alt fa-2x d-block mb-2 opacity-25"></i>
                            No pages found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ===== CREATE / EDIT MODAL ===== --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-file-alt me-2"></i>
                        {{ $editingId ? 'Edit Page' : 'Add New Page' }}
                        @if($isFixedPage)
                            <span class="badge bg-info ms-2 fs-6">Fixed</span>
                        @endif
                    </h5>
                    <button wire:click="$set('showModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">

                        {{-- Title --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Title <span class="text-danger">*</span></label>
                            <input wire:model.live="title" type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="e.g. About Us"
                                   {{ $isFixedPage ? 'readonly' : '' }}>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Slug <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text text-muted">/</span>
                                <input wire:model="slug" type="text"
                                       class="form-control @error('slug') is-invalid @enderror"
                                       placeholder="about-us"
                                       {{ $isFixedPage ? 'readonly' : '' }}>
                            </div>
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- CKEditor --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">CKEditor</label>
                            <div wire:ignore>
                                <textarea id="pages-ckeditor"></textarea>
                            </div>
                        </div>

                        {{-- SEO --}}
                        <div class="col-12">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-search me-2 text-success"></i> SEO Settings
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Meta Title</label>
                                            <input wire:model="meta_title" type="text"
                                                   class="form-control"
                                                   placeholder="SEO title (60 chars recommended)">
                                            <div class="form-text">{{ strlen($meta_title) }}/60</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Meta Description</label>
                                            <textarea wire:model="meta_description"
                                                      class="form-control" rows="2"
                                                      placeholder="SEO description (160 chars recommended)"></textarea>
                                            <div class="form-text">{{ strlen($meta_description) }}/160</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input wire:model="is_active" type="checkbox"
                                       class="form-check-input" id="pageActive" role="switch">
                                <label class="form-check-label fw-medium" for="pageActive">
                                    Active — page frontend par visible hogi
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
                        <i class="fas fa-save me-1"></i> Save Page
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
                    <h6>Delete this page?</h6>
                    <p class="text-muted small mb-0">Ye page permanently delete ho jayegi.</p>
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

    {{-- ===== CKEditor 4 - FREE VERSION ===== --}}
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        function initPagesCKEditor(content = '') {
            if (typeof CKEDITOR === 'undefined') {
                setTimeout(() => initPagesCKEditor(content), 300);
                return;
            }

            const el = document.getElementById('pages-ckeditor');
            if (!el) return;

            if (CKEDITOR.instances['pages-ckeditor']) {
                CKEDITOR.instances['pages-ckeditor'].destroy(true);
            }

            CKEDITOR.replace('pages-ckeditor', {
                height: 400,
                versionCheck: false,
                toolbarGroups: [
                    { name: 'document',    groups: ['mode', 'document', 'doctools'] },
                    { name: 'clipboard',   groups: ['clipboard', 'undo'] },
                    { name: 'editing',     groups: ['find', 'selection', 'spellchecker'] },
                    '/',
                    { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                    { name: 'paragraph',   groups: ['list', 'indent', 'blocks', 'align', 'bidi'] },
                    { name: 'links' },
                    { name: 'insert' },
                    '/',
                    { name: 'styles' },
                    { name: 'colors' },
                    { name: 'tools' },
                ],
            });

            CKEDITOR.instances['pages-ckeditor'].on('instanceReady', function () {
                if (content) {
                    CKEDITOR.instances['pages-ckeditor'].setData(content);
                }
            });

            CKEDITOR.instances['pages-ckeditor'].on('change', function () {
                @this.set('content', CKEDITOR.instances['pages-ckeditor'].getData());
            });
        }

        document.addEventListener('livewire:initialized', function () {
            Livewire.on('modalOpened', function (data) {
                const content = data && data.content ? data.content : '';
                setTimeout(() => initPagesCKEditor(content), 300);
            });
        });
    </script>
</div>