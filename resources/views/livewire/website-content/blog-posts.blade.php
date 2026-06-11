<div>
    {{-- Header --}}
   <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded"
     style="background: linear-gradient(135deg, #f953c6 0%, #b91d73 100%);">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-white bg-opacity-25 p-2 rounded-circle">
            <i class="fas fa-blog fa-2x text-white"></i>
        </div>
        <div>
            <h4 class="mb-0 text-white fw-bold">Blog Posts</h4>
            <small class="text-white-50">Manage your blog posts</small>
        </div>
    </div>
    <button wire:click="openCreate"
            class="btn btn-sm fw-bold shadow"
            style="background:white; color:#b91d73;">
        <i class="fas fa-plus me-1"></i> Add Post
    </button>
</div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filters --}}
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="row g-2">
                <div class="col-md-6">
                    <input wire:model.live="search" type="text"
                           class="form-control form-control-sm"
                           placeholder="Search posts...">
                </div>
               <div class="col-md-3">
    <select wire:model.live="filterStatus" class="form-select form-select-sm">
        <option value="">🔵 All Status</option>
        <option value="draft">📝 Draft</option>
        <option value="published">✅ Published</option>
        <option value="scheduled">🕐 Scheduled</option>
    </select>
</div>
            </div>
        </div>
    </div>

    {{-- Posts Table --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover table-compact mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td>
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                     style="width:50px;height:40px;object-fit:cover"
                                     class="rounded">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width:50px;height:40px">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-medium">{{ Str::limit($post->title, 40) }}</div>
                            <small class="text-muted">{{ Str::limit($post->excerpt, 50) }}</small>
                        </td>
                        <td>
                            <button wire:click="toggleStatus({{ $post->id }})"
                                    class="badge bg-{{ $post->status === 'published' ? 'success' : ($post->status === 'scheduled' ? 'warning' : 'secondary') }} border-0">
                                {{ ucfirst($post->status) }}
                            </button>
                        </td>
                        <td>
                            <button wire:click="toggleFeatured({{ $post->id }})"
                                    class="btn btn-sm btn-{{ $post->is_featured ? 'warning' : 'outline-secondary' }}">
                                <i class="fas fa-star"></i>
                            </button>
                        </td>
                        <td>
                            <small>{{ $post->created_at->format('d M Y') }}</small>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button wire:click="openEdit({{ $post->id }})"
                                        class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="confirmDelete({{ $post->id }})"
                                        class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fas fa-blog fa-2x mb-2 d-block opacity-25"></i>
                            No posts yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $posts->links() }}
        </div>
    </div>

    {{-- CREATE/EDIT MODAL --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-blog me-2"></i>
                        {{ $editingId ? 'Edit Post' : 'Add New Post' }}
                    </h5>
                    <button wire:click="$set('showModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">

                        {{-- Title --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">Title *</label>
                            <input wire:model="title" type="text" class="form-control
                                   @error('title') is-invalid @enderror"
                                   placeholder="Post title...">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Featured Image --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Featured Image</label>
                            @if($existingImage && !$featured_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $existingImage) }}"
                                         class="rounded border"
                                         style="height:80px;object-fit:cover;width:100%">
                                </div>
                            @endif
                            @if($featured_image)
                                <div class="mb-2">
                                    <img src="{{ $featured_image->temporaryUrl() }}"
                                         class="rounded border"
                                         style="height:80px;object-fit:cover;width:100%">
                                </div>
                            @endif
                            <input wire:model="featured_image" type="file"
                                   accept="image/*" class="form-control">
                        </div>

                        {{-- Status --}}
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Status</label>
                            <select wire:model="status" class="form-select">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="scheduled">Scheduled</option>
                            </select>
                        </div>

                        {{-- Published At --}}
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Publish Date</label>
                            <input wire:model="published_at" type="date" class="form-control">
                        </div>

                        {{-- Excerpt --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">Excerpt</label>
                            <textarea wire:model="excerpt" class="form-control" rows="2"
                                      placeholder="Short description..."></textarea>
                        </div>

                        {{-- CKEditor Content --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">CKEditor</label>
                            <div wire:ignore>
                                <textarea id="blog-ckeditor"></textarea>
                            </div>
                        </div>

                        {{-- Switches --}}
                        <div class="col-md-6 d-flex gap-4">
                            <div class="form-check form-switch">
                                <input wire:model="is_featured" type="checkbox"
                                       class="form-check-input" role="switch">
                                <label class="form-check-label">Featured</label>
                            </div>
                            <div class="form-check form-switch">
                                <input wire:model="allow_comments" type="checkbox"
                                       class="form-check-input" role="switch">
                                <label class="form-check-label">Allow Comments</label>
                            </div>
                        </div>

                        {{-- SEO --}}
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-chart-line me-1"></i> SEO Settings
                                    </h6>
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <input wire:model="meta_title" type="text"
                                                   class="form-control form-control-sm"
                                                   placeholder="Meta Title">
                                        </div>
                                        <div class="col-12">
                                            <textarea wire:model="meta_description"
                                                      class="form-control form-control-sm" rows="2"
                                                      placeholder="Meta Description"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <input wire:model="meta_keywords" type="text"
                                                   class="form-control form-control-sm"
                                                   placeholder="Meta Keywords (comma separated)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showModal', false)" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button wire:click="save" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Post
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- DELETE CONFIRM --}}
    @if($confirmingDeleteId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x mb-3 d-block"></i>
                    <h6>Delete this post?</h6>
                    <p class="text-muted small">Yeh post permanently delete ho jayegi.</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button wire:click="$set('confirmingDeleteId', null)"
                            class="btn btn-secondary">Cancel</button>
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
        function initBlogCKEditor(content = '') {
            if (typeof CKEDITOR === 'undefined') {
                setTimeout(() => initBlogCKEditor(content), 300);
                return;
            }

            const el = document.getElementById('blog-ckeditor');
            if (!el) return;

            // Purana instance destroy karo
            if (CKEDITOR.instances['blog-ckeditor']) {
                CKEDITOR.instances['blog-ckeditor'].destroy(true);
            }

            CKEDITOR.replace('blog-ckeditor', {
                height: 400,
                versionCheck: false, // warning band
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

            // Content set karo
            CKEDITOR.instances['blog-ckeditor'].on('instanceReady', function () {
                if (content) {
                    CKEDITOR.instances['blog-ckeditor'].setData(content);
                }
            });

            // Livewire ko update karo
            CKEDITOR.instances['blog-ckeditor'].on('change', function () {
                @this.set('content', CKEDITOR.instances['blog-ckeditor'].getData());
            });
        }

        document.addEventListener('livewire:initialized', function () {
            Livewire.on('blogModalOpened', function (data) {
                const content = data && data.content ? data.content : '';
                setTimeout(() => initBlogCKEditor(content), 300);
            });
        });
    </script>
</div>