<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-{{ $productId ? 'edit' : 'plus' }} me-2 text-primary"></i>
            {{ $productId ? 'Edit Product' : 'Add New Product' }}
        </h4>
        <a href="{{ route('admin.products.all') }}" wire:navigate class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        {{-- Left Column --}}
        <div class="col-lg-8">

            {{-- Basic Info --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">Basic Information</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Product Name *</label>
                        <input wire:model.live="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Enter product name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Slug *</label>
                            <input wire:model="slug" type="text"
                                   class="form-control @error('slug') is-invalid @enderror">
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SKU</label>
                            <div class="input-group">
                                <input wire:model="sku" type="text"
                                       class="form-control"
                                       placeholder="e.g. PROD-001">
                                <button type="button" wire:click="regenerateSku"
                                        class="btn btn-outline-secondary" title="Regenerate">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                            <div class="form-text">Auto-generated from name. Manually edit kar sakte ho.</div>
                        </div>
                    </div>

                    {{-- CKEditor Description --}}
                    <div class="mt-3">
                        <label class="form-label fw-semibold">Description</label>
                        <div wire:ignore>
                            <textarea id="product-ckeditor"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pricing --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">Pricing</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Price (Rs.) *</label>
                            <input wire:model="price" type="number" step="0.01" min="0"
                                   class="form-control @error('price') is-invalid @enderror">
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Compare Price (Rs.)</label>
                            <input wire:model="compare_price" type="number" step="0.01" min="0"
                                   class="form-control @error('compare_price') is-invalid @enderror"
                                   placeholder="Original price for strikethrough">
                            @error('compare_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Media --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">Media</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Main Image</label>
                        @if($existingImage)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $existingImage) }}"
                                     height="100" class="rounded border">
                            </div>
                        @endif
                        @if($image)
                            <div class="mb-2">
                                <img src="{{ $image->temporaryUrl() }}" height="100" class="rounded border">
                            </div>
                        @endif
                        <input wire:model="image" type="file" class="form-control" accept="image/*">
                        @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="form-label fw-semibold">Gallery Images</label>
                        @if(!empty($existingGallery))
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                @foreach($existingGallery as $i => $img)
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $img) }}"
                                             width="80" height="80"
                                             class="rounded border object-fit-cover">
                                        <button wire:click="removeGalleryImage({{ $i }})"
                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 p-0"
                                                style="width:18px;height:18px;font-size:10px;line-height:1">
                                            &times;
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <input wire:model="gallery" type="file" class="form-control" accept="image/*" multiple>
                    </div>
                </div>
            </div>

            {{-- Sizes --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">Sizes</div>
                <div class="card-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-5">
                            <input wire:model="sizeName" type="text" class="form-control" placeholder="Size (e.g. S, M, L)">
                        </div>
                        <div class="col-md-4">
                            <input wire:model="sizeStock" type="number" class="form-control" placeholder="Stock" min="0">
                        </div>
                        <div class="col-md-3">
                            <button wire:click="addSize" class="btn btn-primary w-100">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </div>
                    </div>

                    @if(count($sizes) > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Stock</th>
                                        <th style="width:50px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sizes as $index => $size)
                                        <tr>
                                            <td>{{ $size['size_name'] }}</td>
                                            <td>{{ $size['stock'] ?? 0 }}</td>
                                            <td>
                                                <button wire:click="removeSize({{ $index }})" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted small">No sizes added yet.</p>
                    @endif
                </div>
            </div>

            {{-- Colors --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">Colors</div>
                <div class="card-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <input wire:model="colorName" type="text" class="form-control" placeholder="Color (e.g. Black)">
                        </div>
                        <div class="col-md-3">
                            <input wire:model="colorCode" type="color" class="form-control" style="padding:2px; height:38px;">
                        </div>
                        <div class="col-md-3">
                            <input wire:model="colorStock" type="number" class="form-control" placeholder="Stock" min="0">
                        </div>
                        <div class="col-md-2">
                            <button wire:click="addColor" class="btn btn-primary w-100">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    @if(count($colors) > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Color</th>
                                        <th>Code</th>
                                        <th>Stock</th>
                                        <th style="width:50px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($colors as $index => $color)
                                        <tr>
                                            <td>
                                                <span class="badge" style="background:{{ $color['color_code'] }}; color:{{ $color['color_code'] == '#000000' ? '#fff' : '#000' }}; width:30px; height:20px; display:inline-block; border-radius:4px; margin-right:8px;"></span>
                                                {{ $color['color_name'] }}
                                            </td>
                                            <td>{{ $color['color_code'] }}</td>
                                            <td>{{ $color['stock'] ?? 0 }}</td>
                                            <td>
                                                <button wire:click="removeColor({{ $index }})" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted small">No colors added yet.</p>
                    @endif
                </div>
            </div>

            {{-- SEO --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">SEO</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">SEO Title</label>
                        <input wire:model="seo_title" type="text" class="form-control"
                               placeholder="SEO meta title">
                    </div>
                    <div>
                        <label class="form-label fw-semibold">SEO Description</label>
                        <textarea wire:model="seo_description" rows="3"
                                  class="form-control" placeholder="SEO meta description..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="col-lg-4">

            {{-- Status --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">Status</div>
                <div class="card-body">
                    <select wire:model="status" class="form-select mb-3">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="draft">Draft</option>
                    </select>
                    <div class="form-check">
                        <input wire:model="featured" type="checkbox"
                               class="form-check-input" id="featuredCheck">
                        <label class="form-check-label" for="featuredCheck">
                            <i class="fas fa-star text-warning me-1"></i> Featured Product
                        </label>
                    </div>
                </div>
            </div>

            {{-- Stock --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">Inventory</div>
                <div class="card-body">
                    <label class="form-label fw-semibold">Stock Quantity *</label>
                    <input wire:model="stock" type="number" min="0"
                           class="form-control @error('stock') is-invalid @enderror">
                    @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Category & Brand --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">Organization</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category</label>
                        <select wire:model="category_id" class="form-select">
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label fw-semibold">Brand</label>
                        <select wire:model="brand_id" class="form-select">
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Save Button --}}
            <div class="d-grid">
                <button wire:click="save" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i>
                    {{ $productId ? 'Update Product' : 'Create Product' }}
                </button>
            </div>
        </div>
    </div>

    {{-- ===== CKEditor 4 - FREE VERSION ===== --}}
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        function initProductCKEditor() {
            if (typeof CKEDITOR === 'undefined') {
                setTimeout(initProductCKEditor, 300);
                return;
            }

            const el = document.getElementById('product-ckeditor');
            if (!el) return;

            if (CKEDITOR.instances['product-ckeditor']) {
                CKEDITOR.instances['product-ckeditor'].destroy(true);
            }

            CKEDITOR.replace('product-ckeditor', {
                height: 300,
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

            CKEDITOR.instances['product-ckeditor'].on('instanceReady', function () {
                const content = @json($description ?? '');
                if (content) {
                    CKEDITOR.instances['product-ckeditor'].setData(content);
                }
            });

            CKEDITOR.instances['product-ckeditor'].on('change', function () {
                @this.set('description', CKEDITOR.instances['product-ckeditor'].getData());
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(initProductCKEditor, 500);
        });

        document.addEventListener('livewire:initialized', function () {
            setTimeout(initProductCKEditor, 500);
        });
    </script>
</div>