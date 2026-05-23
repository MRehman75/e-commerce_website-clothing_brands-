<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-chart-line me-2 text-primary"></i> SEO Settings
        </h4>
        <button wire:click="save" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Save Settings
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-3">

        {{-- Pages Sidebar --}}
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-file-alt me-1"></i> Pages
                </div>
                <div class="list-group list-group-flush">
                    @foreach($pages as $key => $label)
                    <button wire:click="loadPage('{{ $key }}')"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
                                   {{ $activePage === $key ? 'active' : '' }}">
                        {{ $label }}
                        @if($activePage === $key)
                            <i class="fas fa-chevron-right"></i>
                        @endif
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- SEO Form --}}
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-search me-1"></i>
                    SEO — {{ $pages[$activePage] }}
                </div>
                <div class="card-body">
                    <div class="row g-3">

                        {{-- Meta Title --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">Meta Title</label>
                            <input wire:model="meta_title" type="text"
                                   class="form-control"
                                   placeholder="Page title for search engines...">
                            <div class="form-text">Recommended: 50-60 characters</div>
                        </div>

                        {{-- Meta Description --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">Meta Description</label>
                            <textarea wire:model="meta_description"
                                      class="form-control" rows="2"
                                      placeholder="Short description for search engines..."></textarea>
                            <div class="form-text">Recommended: 150-160 characters</div>
                        </div>

                        {{-- Meta Keywords --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">Meta Keywords</label>
                            <input wire:model="meta_keywords" type="text"
                                   class="form-control"
                                   placeholder="keyword1, keyword2, keyword3...">
                        </div>

                        <div class="col-12"><hr class="my-1"></div>

                        {{-- OG Title --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                <i class="fab fa-facebook me-1 text-primary"></i>
                                OG Title
                            </label>
                            <input wire:model="og_title" type="text"
                                   class="form-control"
                                   placeholder="Facebook/Social title...">
                        </div>

                        {{-- OG Description --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">OG Description</label>
                            <input wire:model="og_description" type="text"
                                   class="form-control"
                                   placeholder="Facebook/Social description...">
                        </div>

                        {{-- OG Image --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">OG Image (Social Share Image)</label>
                            @if($existingOgImage && !$og_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $existingOgImage) }}"
                                         class="rounded border"
                                         style="height:80px;object-fit:cover">
                                </div>
                            @endif
                            @if($og_image)
                                <div class="mb-2">
                                    <img src="{{ $og_image->temporaryUrl() }}"
                                         class="rounded border"
                                         style="height:80px;object-fit:cover">
                                </div>
                            @endif
                            <input wire:model="og_image" type="file"
                                   accept="image/*" class="form-control">
                            <div class="form-text">Recommended: 1200x630px</div>
                        </div>

                        {{-- Canonical URL --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">Canonical URL</label>
                            <input wire:model="canonical_url" type="text"
                                   class="form-control"
                                   placeholder="https://yoursite.com/page">
                        </div>

                        {{-- Robots --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">Robots</label>
                            <div class="d-flex gap-4">
                                <div class="form-check form-switch">
                                    <input wire:model="no_index" type="checkbox"
                                           class="form-check-input" role="switch">
                                    <label class="form-check-label">No Index</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input wire:model="no_follow" type="checkbox"
                                           class="form-check-input" role="switch">
                                    <label class="form-check-label">No Follow</label>
                                </div>
                            </div>
                        </div>

                        {{-- Custom Scripts --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">Custom Scripts</label>
                            <textarea wire:model="custom_scripts"
                                      class="form-control font-monospace" rows="4"
                                      placeholder="<!-- Google Analytics, FB Pixel etc -->"></textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>