{{-- resources/views/livewire/frontend/customer-login.blade.php --}}
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0" style="border-radius:16px; overflow:hidden;">

                {{-- Header --}}
                <div class="p-4 text-white text-center"
                     style="background: linear-gradient(135deg, #1a252f 0%, #2d3e4f 100%);">
                    <i class="fas fa-user-circle fa-3x mb-3"></i>
                    <h4 class="fw-bold mb-1">Customer Login</h4>
                    <small class="text-white-50">Apne account mein login karein</small>
                </div>

                <div class="card-body p-4">

                    {{-- Login Form --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-envelope me-1 text-primary"></i>Email Address
                        </label>
                        <input type="email"
                               wire:model="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="apka@email.com"
                               autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-lock me-1 text-primary"></i>Password
                        </label>
                        <input type="password"
                               wire:model="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="••••••••">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" wire:model="remember"
                                   class="form-check-input" id="remember">
                            <label class="form-check-label small" for="remember">
                                Mujhe yaad rakho
                            </label>
                        </div>
                    </div>

                    <button wire:click="login"
                            wire:loading.attr="disabled"
                            class="btn btn-primary w-100 py-2 fw-semibold">
                        <span wire:loading.remove>
                            <i class="fas fa-sign-in-alt me-2"></i>Login Karein
                        </span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin me-2"></i>Login ho raha hai...
                        </span>
                    </button>

                    <hr class="my-4">

                    <p class="text-center mb-0 small">
                        Account nahi hai?
                        <a href="{{ route('customer.register') }}" wire:navigate class="text-primary fw-semibold">
                            Register Karein
                        </a>
                    </p>
                </div>
            </div>

            {{-- Back to shop --}}
            <div class="text-center mt-3">
                <a href="{{ route('products') }}" wire:navigate class="text-muted small">
                    <i class="fas fa-arrow-left me-1"></i>Shopping continue karein
                </a>
            </div>
        </div>
    </div>
</div>