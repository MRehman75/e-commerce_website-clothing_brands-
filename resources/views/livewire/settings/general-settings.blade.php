<div>
    {{-- ── Header ── --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-cogs me-2 text-primary"></i> General Settings
        </h4>
        <button wire:click="save" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Save Settings
        </button>
    </div>

    {{-- ── Flash Messages ── --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ── Tabs ── --}}
    <ul class="nav nav-tabs mb-4">
        @foreach([
            'site'        => ['icon' => 'fa-globe',        'label' => 'Site Info'],
            'seo'         => ['icon' => 'fa-search',       'label' => 'SEO'],
            'currency'    => ['icon' => 'fa-dollar-sign',  'label' => 'Currency & Language'],
            'mail'        => ['icon' => 'fa-envelope',     'label' => 'Email / SMTP'],
            'social'      => ['icon' => 'fa-share-alt',    'label' => 'Social Links'],
            'maintenance' => ['icon' => 'fa-tools',        'label' => 'Maintenance'],
        ] as $tab => $info)
        <li class="nav-item">
            <button wire:click="$set('activeTab', '{{ $tab }}')"
                    class="nav-link {{ $activeTab === $tab ? 'active' : '' }}">
                <i class="fas {{ $info['icon'] }} me-1"></i> {{ $info['label'] }}
            </button>
        </li>
        @endforeach
    </ul>

    {{-- TAB: SITE INFO --}}
    @if($activeTab === 'site')
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fas fa-globe me-2 text-primary"></i> Site Information
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium">Site Logo</label>
                    @if($existingLogo && !$site_logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $existingLogo) }}"
                                 style="height:60px;object-fit:contain" class="border rounded p-1">
                        </div>
                    @endif
                    @if($site_logo && is_object($site_logo))
                        <div class="mb-2">
                            <img src="{{ $site_logo->temporaryUrl() }}"
                                 style="height:60px;object-fit:contain" class="border rounded p-1">
                        </div>
                    @endif
                    <input wire:model="site_logo" type="file" accept="image/*" class="form-control">
                    @error('site_logo') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Favicon</label>
                    @if($existingFavicon && !$site_favicon)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $existingFavicon) }}"
                                 style="height:32px;object-fit:contain" class="border rounded p-1">
                        </div>
                    @endif
                    @if($site_favicon && is_object($site_favicon))
                        <div class="mb-2">
                            <img src="{{ $site_favicon->temporaryUrl() }}"
                                 style="height:32px;object-fit:contain" class="border rounded p-1">
                        </div>
                    @endif
                    <input wire:model="site_favicon" type="file" accept="image/*" class="form-control">
                    <div class="form-text">Recommended: 32×32px PNG/ICO</div>
                    @error('site_favicon') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Site Name</label>
                    <input wire:model="site_name" type="text" class="form-control @error('site_name') is-invalid @enderror"
                           placeholder="My Awesome Store">
                    @error('site_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Tagline</label>
                    <input wire:model="site_tagline" type="text" class="form-control"
                           placeholder="Your best shopping destination">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Contact Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input wire:model="site_email" type="email"
                               class="form-control @error('site_email') is-invalid @enderror"
                               placeholder="info@mystore.com">
                        @error('site_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Contact Phone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input wire:model="site_phone" type="text" class="form-control"
                               placeholder="+92 300 1234567">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <input wire:model="site_address" type="text" class="form-control"
                               placeholder="123 Main St, Lahore, Pakistan">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- TAB: SEO --}}
    @if($activeTab === 'seo')
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fas fa-search me-2 text-primary"></i> SEO Settings
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium">Meta Title</label>
                    <input wire:model="meta_title" type="text" class="form-control"
                           placeholder="My Store – Best Deals Online">
                    <div class="form-text">Recommended: 50–60 characters</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Google Analytics ID</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fab fa-google"></i></span>
                        <input wire:model="google_analytics_id" type="text" class="form-control"
                               placeholder="G-XXXXXXXXXX">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">Meta Description</label>
                    <textarea wire:model="meta_description" class="form-control" rows="3"
                              placeholder="Short description of your store for search engines..."></textarea>
                    <div class="form-text">Recommended: 150–160 characters</div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">Meta Keywords</label>
                    <input wire:model="meta_keywords" type="text" class="form-control"
                           placeholder="shoes, online shopping, Pakistan, ecommerce">
                    <div class="form-text">Comma-separated keywords</div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">OG Image (Social Share Image)</label>
                    @if($existingOgImage && !$og_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $existingOgImage) }}"
                                 style="height:80px;object-fit:contain" class="border rounded p-1">
                        </div>
                    @endif
                    @if($og_image && is_object($og_image))
                        <div class="mb-2">
                            <img src="{{ $og_image->temporaryUrl() }}"
                                 style="height:80px;object-fit:contain" class="border rounded p-1">
                        </div>
                    @endif
                    <input wire:model="og_image" type="file" accept="image/*" class="form-control">
                    <div class="form-text">Recommended: 1200×630px</div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">
                        Header Scripts <small class="text-muted fw-normal">(injected inside &lt;head&gt;)</small>
                    </label>
                    <textarea wire:model="header_scripts" class="form-control font-monospace" rows="4"
                              placeholder="<!-- Google Tag Manager, etc. -->"></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">
                        Footer Scripts <small class="text-muted fw-normal">(injected before &lt;/body&gt;)</small>
                    </label>
                    <textarea wire:model="footer_scripts" class="form-control font-monospace" rows="4"
                              placeholder="<!-- Chat widgets, analytics, etc. -->"></textarea>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- TAB: CURRENCY & LANGUAGE --}}
    @if($activeTab === 'currency')
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fas fa-dollar-sign me-2 text-primary"></i> Currency & Language
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-medium">Currency Code</label>
                    <select wire:model="currency_code" class="form-select">
                        <option value="USD">USD – US Dollar</option>
                        <option value="PKR">PKR – Pakistani Rupee</option>
                        <option value="EUR">EUR – Euro</option>
                        <option value="GBP">GBP – British Pound</option>
                        <option value="SAR">SAR – Saudi Riyal</option>
                        <option value="AED">AED – UAE Dirham</option>
                        <option value="INR">INR – Indian Rupee</option>
                        <option value="BDT">BDT – Bangladeshi Taka</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium">Currency Symbol</label>
                    <input wire:model="currency_symbol" type="text" class="form-control" placeholder="$">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium">Symbol Position</label>
                    <select wire:model="currency_position" class="form-select">
                        <option value="before">Before amount ($100)</option>
                        <option value="after">After amount (100$)</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium">Language</label>
                    <select wire:model="language" class="form-select">
                        <option value="en">English</option>
                        <option value="ur">Urdu</option>
                        <option value="ar">Arabic</option>
                        <option value="fr">French</option>
                        <option value="de">German</option>
                        <option value="hi">Hindi</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium">Timezone</label>
                    <select wire:model="timezone" class="form-select">
                        @foreach(\DateTimeZone::listIdentifiers() as $tz)
                            <option value="{{ $tz }}" {{ $timezone === $tz ? 'selected' : '' }}>{{ $tz }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium">Date Format</label>
                    <select wire:model="date_format" class="form-select">
                        <option value="d M Y">23 May 2025</option>
                        <option value="d/m/Y">23/05/2025</option>
                        <option value="m/d/Y">05/23/2025</option>
                        <option value="Y-m-d">2025-05-23</option>
                        <option value="d-m-Y">23-05-2025</option>
                        <option value="D, d M Y">Thu, 23 May 2025</option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="alert alert-info mb-0">
                        <strong>Preview:</strong>
                        Currency: <strong>{{ $currency_position === 'before' ? $currency_symbol . '1,250' : '1,250' . $currency_symbol }}</strong>
                        &nbsp;|&nbsp;
                        Date: <strong>{{ now()->setTimezone($timezone ?? 'UTC')->format($date_format ?? 'd M Y') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- TAB: EMAIL / SMTP --}}
    @if($activeTab === 'mail')
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fas fa-envelope me-2 text-primary"></i> Email / SMTP Settings
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-medium">Mail Driver</label>
                    <select wire:model="mail_driver" class="form-select">
                        <option value="smtp">SMTP</option>
                        <option value="sendmail">Sendmail</option>
                        <option value="log">Log (Testing)</option>
                        <option value="array">Array (Testing)</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium">SMTP Host</label>
                    <input wire:model="mail_host" type="text" class="form-control" placeholder="smtp.gmail.com">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium">SMTP Port</label>
                    <input wire:model="mail_port" type="number" class="form-control" placeholder="587">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input wire:model="mail_username" type="text" class="form-control" placeholder="your@gmail.com">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input wire:model="mail_password"
                               type="{{ $showMailPassword ? 'text' : 'password' }}"
                               class="form-control"
                               placeholder="Leave blank to keep existing">
                        <button type="button" class="btn btn-outline-secondary"
                                wire:click="$toggle('showMailPassword')">
                            <i class="fas fa-{{ $showMailPassword ? 'eye-slash' : 'eye' }}"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium">Encryption</label>
                    <select wire:model="mail_encryption" class="form-select">
                        <option value="tls">TLS</option>
                        <option value="ssl">SSL</option>
                        <option value="none">None</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium">From Address</label>
                    <input wire:model="mail_from_address" type="email" class="form-control"
                           placeholder="noreply@mystore.com">
                    @error('mail_from_address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-medium">From Name</label>
                    <input wire:model="mail_from_name" type="text" class="form-control" placeholder="My Store">
                </div>
                <div class="col-12">
                    <div class="card bg-light border-0">
                        <div class="card-body py-3">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-paper-plane me-2 text-primary"></i> Send Test Email
                            </h6>
                            <div class="row g-2 align-items-end">
                                <div class="col-md-6">
                                    <label class="form-label">Test Email Address</label>
                                    <input wire:model="testMailTo" type="email" class="form-control"
                                           placeholder="test@example.com">
                                    @error('testMailTo') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-3">
                                    <button wire:click="sendTestMail" class="btn btn-outline-primary w-100">
                                        <i class="fas fa-paper-plane me-1"></i> Send Test
                                    </button>
                                </div>
                            </div>
                            @if($testMailSent)
                                <div class="alert alert-success mt-3 mb-0 py-2">
                                    <i class="fas fa-check me-1"></i> Test email sent successfully!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- TAB: SOCIAL LINKS --}}
    @if($activeTab === 'social')
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fas fa-share-alt me-2 text-primary"></i> Social Links
        </div>
        <div class="card-body">
            <div class="row g-3">
                @foreach([
                    'facebook'  => ['icon' => 'fa-facebook',  'color' => '#1877f2', 'label' => 'Facebook',       'ph' => 'https://facebook.com/yourpage'],
                    'instagram' => ['icon' => 'fa-instagram', 'color' => '#e4405f', 'label' => 'Instagram',      'ph' => 'https://instagram.com/yourhandle'],
                    'twitter'   => ['icon' => 'fa-twitter',   'color' => '#1da1f2', 'label' => 'Twitter / X',    'ph' => 'https://twitter.com/yourhandle'],
                    'youtube'   => ['icon' => 'fa-youtube',   'color' => '#ff0000', 'label' => 'YouTube',        'ph' => 'https://youtube.com/yourchannel'],
                    'tiktok'    => ['icon' => 'fa-tiktok',    'color' => '#010101', 'label' => 'TikTok',         'ph' => 'https://tiktok.com/@yourhandle'],
                    'linkedin'  => ['icon' => 'fa-linkedin',  'color' => '#0a66c2', 'label' => 'LinkedIn',       'ph' => 'https://linkedin.com/company/yourco'],
                    'whatsapp'  => ['icon' => 'fa-whatsapp',  'color' => '#25d366', 'label' => 'WhatsApp Number','ph' => '+923001234567'],
                ] as $field => $info)
                <div class="col-md-6">
                    <label class="form-label fw-medium">{{ $info['label'] }}</label>
                    <div class="input-group">
                        <span class="input-group-text"
                              style="background:{{ $info['color'] }};color:white;width:42px;justify-content:center">
                            <i class="fab {{ $info['icon'] }}"></i>
                        </span>
                        <input wire:model="{{ $field }}" type="text"
                               class="form-control @error($field) is-invalid @enderror"
                               placeholder="{{ $info['ph'] }}">
                        @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- TAB: MAINTENANCE --}}
    @if($activeTab === 'maintenance')
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="fas fa-tools me-2 text-primary"></i> Maintenance Mode
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card border-0 {{ $maintenance_mode ? 'bg-danger bg-opacity-10 border border-danger' : 'bg-success bg-opacity-10 border border-success' }}">
                        <div class="card-body d-flex align-items-center gap-3 py-3">
                            <div class="form-check form-switch mb-0">
                                <input wire:model.live="maintenance_mode" type="checkbox"
                                       class="form-check-input" role="switch"
                                       id="maintenanceToggle" style="width:3rem;height:1.5rem">
                            </div>
                            <div>
                                <div class="fw-bold {{ $maintenance_mode ? 'text-danger' : 'text-success' }}">
                                    @if($maintenance_mode)
                                        <i class="fas fa-exclamation-triangle me-1"></i> Maintenance Mode is ON
                                    @else
                                        <i class="fas fa-check-circle me-1"></i> Site is Live
                                    @endif
                                </div>
                                <small class="text-muted">
                                    {{ $maintenance_mode ? 'Visitors will see the maintenance page.' : 'Your site is accessible to everyone.' }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CKEditor Maintenance Message --}}
                <div class="col-12">
                    <label class="form-label fw-medium">Maintenance Message</label>
                    <div wire:ignore>
                        <textarea id="maintenance-ckeditor"></textarea>
                    </div>
                    <div class="form-text">Displayed to visitors during maintenance.</div>
                </div>

                <div class="col-12">
                    <label class="form-label fw-medium">
                        Allowed IPs <small class="text-muted fw-normal">(can access site during maintenance)</small>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                        <input wire:model="maintenance_allowed_ips" type="text" class="form-control"
                               placeholder="192.168.1.1, 203.0.113.0">
                    </div>
                    <div class="form-text">Comma-separated IP addresses. Your IP: <strong>{{ request()->ip() }}</strong></div>
                </div>

                @if($maintenance_mode)
                <div class="col-12">
                    <div class="alert alert-warning mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> Maintenance mode is currently active.
                        Make sure your IP is in the allowed list before saving.
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    {{-- ===== CKEditor 4 - FREE VERSION ===== --}}
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        function initMaintenanceCKEditor() {
            if (typeof CKEDITOR === 'undefined') {
                setTimeout(initMaintenanceCKEditor, 300);
                return;
            }

            const el = document.getElementById('maintenance-ckeditor');
            if (!el) return;

            if (CKEDITOR.instances['maintenance-ckeditor']) {
                CKEDITOR.instances['maintenance-ckeditor'].destroy(true);
            }

            CKEDITOR.replace('maintenance-ckeditor', {
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

            CKEDITOR.instances['maintenance-ckeditor'].on('instanceReady', function () {
                const content = @json($maintenance_message ?? '');
                if (content) {
                    CKEDITOR.instances['maintenance-ckeditor'].setData(content);
                }
            });

            CKEDITOR.instances['maintenance-ckeditor'].on('change', function () {
                @this.set('maintenance_message', CKEDITOR.instances['maintenance-ckeditor'].getData());
            });
        }

        // Tab switch hone par CKEditor init karo
        document.addEventListener('livewire:initialized', function () {
            Livewire.hook('morph.updated', function ({ component }) {
                setTimeout(function () {
                    if (document.getElementById('maintenance-ckeditor') &&
                        !CKEDITOR.instances['maintenance-ckeditor']) {
                        initMaintenanceCKEditor();
                    }
                }, 300);
            });
        });

        // Page load par bhi check karo
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(initMaintenanceCKEditor, 500);
        });
    </script>
</div>