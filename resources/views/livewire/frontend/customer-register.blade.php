{{-- resources/views/livewire/frontend/customer-register.blade.php --}}
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0" style="border-radius:16px; overflow:hidden;">

                {{-- Header --}}
                <div class="p-4 text-white text-center"
                     style="background: linear-gradient(135deg, #1a252f 0%, #2d3e4f 100%);">
                    <i class="fas fa-user-plus fa-3x mb-3"></i>
                    <h4 class="fw-bold mb-1">Naya Account Banayein</h4>
                    <small class="text-white-50">Free mein register karein</small>
                </div>

                <div class="card-body p-4">

                    {{-- Register Form --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-user me-1 text-primary"></i>Full Name
                        </label>
                        <input type="text"
                               wire:model="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Apna naam daalo"
                               autofocus>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-envelope me-1 text-primary"></i>Email Address
                        </label>
                        <input type="email"
                               wire:model="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="apka@email.com">
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
                               placeholder="Kam az kam 8 characters">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-lock me-1 text-primary"></i>Password Confirm Karein
                        </label>
                        <input type="password"
                               wire:model="password_confirmation"
                               class="form-control"
                               placeholder="Password dobara daalo">
                    </div>

                    <button wire:click="register"
                            wire:loading.attr="disabled"
                            class="btn btn-primary w-100 py-2 fw-semibold">
                        <span wire:loading.remove>
                            <i class="fas fa-user-plus me-2"></i>Register Karein
                        </span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin me-2"></i>Register ho raha hai...
                        </span>
                    </button>

                    <hr class="my-4">

                    <p class="text-center mb-0 small">
                        Pehle se account hai?
                        <a href="{{ route('customer.login') }}" wire:navigate class="text-primary fw-semibold">
                            Login Karein
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