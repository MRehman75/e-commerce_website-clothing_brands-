<div>
<!-- ============================================================
    HERO SLIDER - Dynamic from Admin
============================================================ -->
<div id="heroCarousel" class="carousel slide hero-slider" data-bs-ride="carousel" data-bs-interval="6000">
    <div class="carousel-inner">
        @php
            $sliders = App\Models\HomeSlider::where('is_active', 1)
                ->orderBy('sort_order')
                ->get();
        @endphp

        @forelse($sliders as $index => $slider)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}"
                 style="
                    background-image: url('{{ asset('storage/' . $slider->image) }}');
                    background-size: 135%;
                    background-repeat: no-repeat;
                    background-position: center;
                    background-color: #f8f9fa;
                    min-height: 600px;
                 ">
                <div class="hero-content fade-right">
                    @if($slider->title)
                        <h1>{{ $slider->title }}</h1>
                    @endif

                    @if($slider->subtitle)
                        <p>{{ $slider->subtitle }}</p>
                    @endif

                    <div>
                        <a href="{{ $slider->button_link ?: route('products') }}" class="btn btn-hero">
                            {{ $slider->button_text ?: 'Shop Now' }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <!-- Fallback Default Slides -->
            <div class="carousel-item active"
                 style="background-image: url('https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=1600&auto=format&fit=crop&q=80'); background-size: cover; background-position: center; min-height: 600px;">
                <div class="hero-content fade-right">
                    <span class="hero-label"><i class="bi bi-stars me-2"></i> Welcome</span>
                    <h1>Elevate Your<br />Everyday Style</h1>
                    <p>Discover timeless fashion crafted for confidence, comfort, and sophistication.</p>
                    <div>
                        <a href="#" class="btn btn-hero">Shop Men</a>
                        <a href="#" class="btn btn-hero btn-hero-outline">Shop Women</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item"
                 style="background-image: url('https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=1600&auto=format&fit=crop&q=80'); background-size: cover; background-position: center; min-height: 600px;">
                <div class="hero-content fade-right">
                    <span class="hero-label"><i class="bi bi-leaf me-2"></i> New Collection</span>
                    <h1>Autumn<br />Essentials</h1>
                    <p>Luxurious trench coats, knitwear and leather accessories.</p>
                    <div>
                        <a href="#" class="btn btn-hero">Explore Collection</a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Previous Button -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>

    <!-- Next Button -->
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

    <!-- Indicators (Dots) -->
    <div class="carousel-indicators">
        @php
            $sliderCount = $sliders->count() > 0 ? $sliders->count() : 2;
        @endphp
        @for($i = 0; $i < $sliderCount; $i++)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                    class="{{ $i == 0 ? 'active' : '' }}"
                    aria-label="Slide {{ $i + 1 }}"></button>
        @endfor
    </div>

    <div class="scroll-indicator">
        <span>Scroll</span>
        <i class="bi bi-chevron-down"></i>
    </div>
</div>

<!-- ============================================================
    CATEGORIES - Dynamic from Database with Animation
============================================================ -->
<section class="welcome-section" style="padding: 80px 0; background: #ffffff;">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span style="font-size: 0.6rem; letter-spacing: 0.25em; text-transform: uppercase; color: #999;">Categories</span>
            <h2 style="font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 600; letter-spacing: -0.01em; font-family: 'Playfair Display', serif;">Shop by Category</h2>
        </div>
        <div class="row g-4">
            @php
                $categories = App\Models\Category::where('status', true)
                    ->orderBy('order')
                    ->take(6)
                    ->get();
            @endphp

            @forelse($categories as $index => $category)
                <div class="col-md-4 col-6 zoom-in" style="transition-delay: {{ $index * 100 }}ms;">
                    <a href="{{ route('products', ['category' => $category->slug ?? $category->id]) }}"
                       class="category-card-hover"
                       style="border-radius: 16px; overflow: hidden; position: relative; height: 280px; cursor: pointer; text-decoration: none; display: block; box-shadow: 0 2px 20px rgba(0,0,0,0.02); transition: 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}"
                                 alt="{{ $category->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;">
                        @else
                            <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?w=600&auto=format&fit=crop"
                                 alt="{{ $category->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;">
                        @endif
                        <div style="position: absolute; inset: 0; background: linear-gradient(0deg, rgba(0,0,0,0.35) 0%, transparent 60%); display: flex; align-items: flex-end; padding: 1.8rem;">
                            <h5 style="color: #fff; font-size: 1.3rem; font-weight: 500; letter-spacing: 0.06em; margin: 0; text-shadow: 0 4px 20px rgba(0,0,0,0.15);">{{ $category->name }}</h5>
                        </div>
                        @php
                            $productCount = $category->products()->count();
                        @endphp
                        @if($productCount > 0)
                            <span style="position: absolute; top: 16px; right: 16px; background: rgba(0,0,0,0.5); color: #fff; font-size: 0.65rem; padding: 0.2rem 0.8rem; border-radius: 20px; backdrop-filter: blur(4px);">
                                {{ $productCount }} Products
                            </span>
                        @endif
                        <div style="position: absolute; top: 16px; left: 16px; background: rgba(201,162,39,0.3); color: #fff; font-size: 1.4rem; padding: 0.2rem 0.8rem; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
                            <i class="fas fa-{{ $category->icon ?? 'tag' }}" style="font-size: 1.2rem;"></i>
                        </div>
                    </a>
                </div>
            @empty
                <!-- Fallback Categories -->
                <div class="col-md-4 col-6 zoom-in" style="transition-delay: 50ms;">
                    <a href="#" style="border-radius: 16px; overflow: hidden; position: relative; height: 280px; cursor: pointer; transition: 0.5s; text-decoration: none; display: block;">
                        <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?w=600&auto=format&fit=crop" alt="Men" style="width: 100%; height: 100%; object-fit: cover;">
                        <div style="position: absolute; inset: 0; background: linear-gradient(0deg, rgba(0,0,0,0.35) 0%, transparent 60%); display: flex; align-items: flex-end; padding: 1.8rem;">
                            <h5 style="color: #fff; font-size: 1.3rem; font-weight: 500; letter-spacing: 0.06em;">Men</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-6 zoom-in" style="transition-delay: 100ms;">
                    <a href="#" style="border-radius: 16px; overflow: hidden; position: relative; height: 280px; cursor: pointer; transition: 0.5s; text-decoration: none; display: block;">
                        <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=600&auto=format&fit=crop" alt="Women" style="width: 100%; height: 100%; object-fit: cover;">
                        <div style="position: absolute; inset: 0; background: linear-gradient(0deg, rgba(0,0,0,0.35) 0%, transparent 60%); display: flex; align-items: flex-end; padding: 1.8rem;">
                            <h5 style="color: #fff; font-size: 1.3rem; font-weight: 500; letter-spacing: 0.06em;">Women</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-6 zoom-in" style="transition-delay: 150ms;">
                    <a href="#" style="border-radius: 16px; overflow: hidden; position: relative; height: 280px; cursor: pointer; transition: 0.5s; text-decoration: none; display: block;">
                        <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=600&auto=format&fit=crop" alt="Jackets" style="width: 100%; height: 100%; object-fit: cover;">
                        <div style="position: absolute; inset: 0; background: linear-gradient(0deg, rgba(0,0,0,0.35) 0%, transparent 60%); display: flex; align-items: flex-end; padding: 1.8rem;">
                            <h5 style="color: #fff; font-size: 1.3rem; font-weight: 500; letter-spacing: 0.06em;">Jackets</h5>
                        </div>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ============================================================
    FEATURED PRODUCTS - Dynamic from Database with Animation
============================================================ -->
<section class="welcome-section" style="padding: 80px 0; background: #fafafa;">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span style="font-size: 0.6rem; letter-spacing: 0.25em; text-transform: uppercase; color: #999;">Essentials</span>
            <h2 style="font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 600; letter-spacing: -0.01em; font-family: 'Playfair Display', serif;">Featured Products</h2>
        </div>
        <div class="row g-4">
            @php
                $featuredProducts = App\Models\Product::where('status', 'active')
                    ->orWhere('status', 1)
                    ->where('featured', true)
                    ->take(4)
                    ->get();

            @endphp

            @forelse($featuredProducts as $index => $product)
                <div class="col-md-3 col-6 fade-up" style="transition-delay: {{ $index * 100 }}ms;">
                    <a href="{{ route('product.show', $product->slug ?? $product->id) }}"
                       class="product-card-hover"
                       style="border-radius: 16px; overflow: hidden; background: #fff; transition: 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94); box-shadow: 0 2px 16px rgba(0,0,0,0.02); height: 100%; text-decoration: none; display: block; color: inherit; border: 1px solid rgba(0,0,0,0.02);">
                        <div style="position: relative; overflow: hidden; aspect-ratio: 1/1.2; background: #f8f8f8;">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="product-image"
                                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;">
                            @else
                                <img src="https://via.placeholder.com/400x500/FAFAFA/999?text=No+Image"
                                     alt="{{ $product->name }}"
                                     class="product-image"
                                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;">
                            @endif

                            <!-- Wishlist Button -->
                            <button class="wishlist-btn"
                                    style="position: absolute; top: 12px; right: 12px; background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); width: 36px; height: 36px; border-radius: 50%; border: none; cursor: pointer; transition: 0.3s ease; opacity: 0; transform: translateX(10px); display: flex; align-items: center; justify-content: center;"
                                    onclick="event.preventDefault(); toggleWishlist(this, {{ $product->id }})">
                                <i class="far fa-heart" style="font-size: 1rem; color: #333;"></i>
                            </button>

                            <!-- Quick Actions -->
                            <div class="quick-actions"
                                 style="position: absolute; bottom: 0; left: 0; right: 0; padding: 0.8rem; background: linear-gradient(0deg, rgba(255,255,255,0.95) 0%, transparent 100%); transform: translateY(100%); transition: 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); display: flex; justify-content: center; gap: 0.6rem; opacity: 0;">
                                <i class="bi bi-eye" style="background: #fff; padding: 0.5rem 0.8rem; border-radius: 60px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); font-size: 0.8rem; color: #333; transition: 0.2s; cursor: pointer;"></i>
                                <i class="bi bi-bag-plus" style="background: #fff; padding: 0.5rem 0.8rem; border-radius: 60px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); font-size: 0.8rem; color: #333; transition: 0.2s; cursor: pointer;"></i>
                            </div>

                            @if($product->compare_price && $product->price < $product->compare_price)
                                @php
                                    $discount = round((($product->compare_price - $product->price) / $product->compare_price) * 100);
                                @endphp
                                <span style="position: absolute; top: 10px; left: 10px; background: #dc3545; color: #fff; font-size: 0.5rem; letter-spacing: 0.1em; padding: 0.2rem 0.8rem; border-radius: 40px; font-weight: 500;">-{{ $discount }}%</span>
                            @elseif($product->badge)
                                <span style="position: absolute; top: 10px; left: 10px; background: #C9A227; color: #fff; font-size: 0.5rem; letter-spacing: 0.1em; padding: 0.2rem 0.8rem; border-radius: 40px; font-weight: 500;">{{ $product->badge }}</span>
                            @endif
                        </div>
                        <div style="padding: 1rem 0.8rem 1.2rem;">
                            <div style="font-family: 'Poppins', sans-serif; font-size: 0.55rem; font-weight: 300; letter-spacing: 0.12em; text-transform: uppercase; color: #bbb; margin-bottom: 0.2rem;">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </div>
                            <h6 style="font-weight: 400; font-size: 0.85rem; margin-bottom: 0.1rem; color: #0a0a0a; font-family: 'Poppins', sans-serif;">{{ $product->name }}</h6>
                            <div>
                                <span style="font-weight: 500; color: #C9A227; font-size: 0.85rem;">${{ number_format($product->price, 2) }}</span>
                                @if($product->compare_price)
                                    <span style="color: #bbb; text-decoration: line-through; font-size: 0.75rem; margin-left: 0.4rem;">${{ number_format($product->compare_price, 2) }}</span>
                                @endif
                            </div>
                            @if($product->rating)
                                <div style="display: flex; align-items: center; gap: 4px; margin-top: 4px;">
                                    <span style="color: #C9A227; font-size: 0.7rem;">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($product->rating))
                                                <i class="fas fa-star"></i>
                                            @elseif($i - 0.5 == round($product->rating))
                                                <i class="fas fa-star-half-alt"></i>
                                            @else
                                                <i class="far fa-star" style="color: #ddd;"></i>
                                            @endif
                                        @endfor
                                    </span>
                                    <span style="font-family: 'Poppins', sans-serif; font-size: 0.65rem; font-weight: 300; color: #bbb;">({{ $product->reviews_count ?? 0 }})</span>
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center fade-up">
                    <p style="color: #999;">No featured products available.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ============================================================
    PROMO with Animation
============================================================ -->
<section class="welcome-section" style="padding: 50px 0;">
    <div class="container">
        <div style="background: url('https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=1200&auto=format&fit=crop&q=80') center 40% / cover no-repeat; padding: 80px 0; position: relative; border-radius: 20px; text-align: center; color: #fff;"
             class="zoom-in">
            <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.15) 70%); border-radius: 20px;"></div>
            <div style="position: relative; z-index: 2;">
                <span style="font-size: 0.6rem; letter-spacing: 0.25em; text-transform: uppercase; color: #C9A227;">Mid Season</span>
                <h2 style="font-size: 3.5rem; font-weight: 700; font-family: 'Playfair Display', serif;">Up to 50% Off</h2>
                <div style="font-size: 2.4rem; font-weight: 300; letter-spacing: 0.1em; color: #C9A227; margin-top: 0.5rem;">03 : 14 : 28</div>
                <p style="margin-top: 0.5rem; opacity: 0.75; font-family: 'Poppins', sans-serif; font-weight: 300;">Luxury essentials — for a limited time.</p>
                <a href="#" style="display: inline-block; background: #fff; color: #111; border: none; padding: 0.7rem 2.4rem; border-radius: 60px; font-weight: 500; font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; text-decoration: none; margin-top: 0.5rem; transition: 0.3s;">Shop Sale</a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
    WHY VELENZA with Animation
============================================================ -->
<section class="welcome-section" style="padding: 80px 0; background: #F5F1EB;">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span style="font-size: 0.6rem; letter-spacing: 0.25em; text-transform: uppercase; color: #999;">Heritage</span>
            <h2 style="font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 600; letter-spacing: -0.01em; font-family: 'Playfair Display', serif;">Why VELENZA</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-6 flip-up" style="transition-delay: 50ms;">
                <div style="background: #fff; border: 1px solid #f0f0f0; border-radius: 20px; padding: 2rem 1rem; text-align: center; height: 100%; transition: 0.4s;">
                    <i class="bi bi-gem" style="font-size: 2.2rem; color: #C9A227;"></i>
                    <h6 style="margin-top: 0.8rem; font-weight: 500; font-size: 0.9rem; font-family: 'Poppins', sans-serif;">Premium Quality</h6>
                </div>
            </div>
            <div class="col-md-3 col-6 flip-up" style="transition-delay: 100ms;">
                <div style="background: #fff; border: 1px solid #f0f0f0; border-radius: 20px; padding: 2rem 1rem; text-align: center; height: 100%; transition: 0.4s;">
                    <i class="bi bi-truck" style="font-size: 2.2rem; color: #C9A227;"></i>
                    <h6 style="margin-top: 0.8rem; font-weight: 500; font-size: 0.9rem; font-family: 'Poppins', sans-serif;">Free Shipping</h6>
                </div>
            </div>
            <div class="col-md-3 col-6 flip-up" style="transition-delay: 150ms;">
                <div style="background: #fff; border: 1px solid #f0f0f0; border-radius: 20px; padding: 2rem 1rem; text-align: center; height: 100%; transition: 0.4s;">
                    <i class="bi bi-arrow-return-left" style="font-size: 2.2rem; color: #C9A227;"></i>
                    <h6 style="margin-top: 0.8rem; font-weight: 500; font-size: 0.9rem; font-family: 'Poppins', sans-serif;">Easy Returns</h6>
                </div>
            </div>
            <div class="col-md-3 col-6 flip-up" style="transition-delay: 200ms;">
                <div style="background: #fff; border: 1px solid #f0f0f0; border-radius: 20px; padding: 2rem 1rem; text-align: center; height: 100%; transition: 0.4s;">
                    <i class="bi bi-shield-lock" style="font-size: 2.2rem; color: #C9A227;"></i>
                    <h6 style="margin-top: 0.8rem; font-weight: 500; font-size: 0.9rem; font-family: 'Poppins', sans-serif;">Secure Payment</h6>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
    TESTIMONIALS with Animation
============================================================ -->
<section class="welcome-section" style="padding: 80px 0; background: #ffffff;">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span style="font-size: 0.6rem; letter-spacing: 0.25em; text-transform: uppercase; color: #999;">Testimonials</span>
            <h2 style="font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 600; letter-spacing: -0.01em; font-family: 'Playfair Display', serif;">What Our Clients Say</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4 fade-right" style="transition-delay: 50ms;">
                <div style="background: #fff; border-radius: 20px; padding: 1.8rem; box-shadow: 0 4px 28px rgba(0,0,0,0.01); border: 1px solid #f2f2f2; height: 100%;">
                    <div style="font-size: 2.8rem; line-height: 0.6; color: #C9A227; opacity: 0.2;">“</div>
                    <div style="color: #C9A227; font-size: 0.8rem;"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    <p style="margin-top: 0.5rem; font-family: 'Poppins', sans-serif; font-weight: 300; color: #666; line-height: 1.7;">“The craftsmanship is unmatched. VELENZA redefines luxury.”</p>
                    <h6 style="margin-top: 0.5rem; font-family: 'Poppins', sans-serif; font-weight: 500;">— Ayesha K.</h6>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay: 100ms;">
                <div style="background: #fff; border-radius: 20px; padding: 1.8rem; box-shadow: 0 4px 28px rgba(0,0,0,0.01); border: 1px solid #f2f2f2; height: 100%;">
                    <div style="font-size: 2.8rem; line-height: 0.6; color: #C9A227; opacity: 0.2;">“</div>
                    <div style="color: #C9A227; font-size: 0.8rem;"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    <p style="margin-top: 0.5rem; font-family: 'Poppins', sans-serif; font-weight: 300; color: #666; line-height: 1.7;">“Effortlessly elegant. My new favorite brand.”</p>
                    <h6 style="margin-top: 0.5rem; font-family: 'Poppins', sans-serif; font-weight: 500;">— Bilal R.</h6>
                </div>
            </div>
            <div class="col-md-4 fade-left" style="transition-delay: 150ms;">
                <div style="background: #fff; border-radius: 20px; padding: 1.8rem; box-shadow: 0 4px 28px rgba(0,0,0,0.01); border: 1px solid #f2f2f2; height: 100%;">
                    <div style="font-size: 2.8rem; line-height: 0.6; color: #C9A227; opacity: 0.2;">“</div>
                    <div style="color: #C9A227; font-size: 0.8rem;"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div>
                    <p style="margin-top: 0.5rem; font-family: 'Poppins', sans-serif; font-weight: 300; color: #666; line-height: 1.7;">“Luxury redefined. The tailoring is impeccable.”</p>
                    <h6 style="margin-top: 0.5rem; font-family: 'Poppins', sans-serif; font-weight: 500;">— Zara M.</h6>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
    NEWSLETTER with Animation
============================================================ -->
<section class="welcome-section" style="padding: 50px 0;">
    <div class="container">
        <div style="background: url('https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=800&auto=format&fit=crop&q=80') center/cover no-repeat; border-radius: 20px; padding: 60px 30px; position: relative; text-align: center;"
             class="fade-up">
            <div style="position: absolute; inset: 0; background: rgba(255,255,255,0.8); backdrop-filter: blur(4px); border-radius: 20px;"></div>
            <div style="position: relative; z-index: 2;">
                <h2 style="font-size: 2.5rem; font-weight: 600; font-family: 'Playfair Display', serif;">Join the VELENZA Community</h2>
                <p style="color: #6c757d; font-family: 'Poppins', sans-serif; font-weight: 300;">Be the first to receive exclusive drops and edits.</p>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-6">
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <input class="form-control" placeholder="Email address" style="border-radius: 60px; padding: 0.7rem 1.4rem; border: 1px solid #ddd; font-family: 'Poppins', sans-serif; font-size: 0.9rem; transition: 0.3s;">
                            <button style="background: #C9A227; border: none; padding: 0.7rem 2rem; border-radius: 60px; font-weight: 500; color: #fff; font-size: 0.8rem; letter-spacing: 0.08em; transition: 0.3s; font-family: 'Poppins', sans-serif;">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
    STYLES
============================================================ -->
<style>
    /* ============================================================
       ANIMATION CLASSES
    ============================================================ */
    .fade-up {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .fade-right {
        opacity: 0;
        transform: translateX(-40px);
        transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .fade-right.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .fade-left {
        opacity: 0;
        transform: translateX(40px);
        transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .fade-left.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .zoom-in {
        opacity: 0;
        transform: scale(0.85);
        transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .zoom-in.visible {
        opacity: 1;
        transform: scale(1);
    }

    .flip-up {
        opacity: 0;
        transform: perspective(600px) rotateX(15deg) translateY(30px);
        transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .flip-up.visible {
        opacity: 1;
        transform: perspective(600px) rotateX(0) translateY(0);
    }

    /* ============================================================
       HOVER EFFECTS
    ============================================================ */
    .category-card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06) !important;
    }

    .category-card-hover:hover img {
        transform: scale(1.06);
    }

    .product-card-hover:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06) !important;
    }

    .product-card-hover:hover .product-image {
        transform: scale(1.04);
    }

    .product-card-hover:hover .quick-actions {
        transform: translateY(0) !important;
        opacity: 1 !important;
    }

    .product-card-hover:hover .wishlist-btn {
        opacity: 1 !important;
        transform: translateX(0) !important;
    }

    .quick-actions i:hover {
        background: #C9A227 !important;
        color: #fff !important;
    }

    .wishlist-btn:hover i {
        color: #e74c3c !important;
    }

    .btn-hero {
        background: #fff;
        color: #111;
        border: none;
        padding: 0.7rem 2.4rem;
        border-radius: 60px;
        font-weight: 500;
        font-size: 0.7rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        transition: 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: 0 6px 28px rgba(0, 0, 0, 0.06);
        margin-right: 0.8rem;
        text-decoration: none;
        display: inline-block;
        font-family: 'Poppins', sans-serif;
    }

    .btn-hero:hover {
        background: #C9A227;
        color: #fff;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 40px rgba(201, 162, 39, 0.15);
    }

    .btn-hero-outline {
        background: transparent;
        border: 1.5px solid rgba(255, 255, 255, 0.35);
        color: #fff;
        backdrop-filter: blur(4px);
    }

    .btn-hero-outline:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: #fff;
        color: #fff;
    }

    /* ============================================================
       HERO SLIDER
    ============================================================ */
    .hero-slider {
        height: 85vh;
        min-height: 600px;
        position: relative;
        overflow: hidden;
    }

    .hero-slider .carousel-item {
        height: 85vh;
        min-height: 600px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .hero-slider .carousel-item::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.1) 60%);
    }

    .hero-slider .carousel-item .hero-content {
        position: absolute;
        top: 50%;
        left: 8%;
        transform: translateY(-50%);
        z-index: 10;
        color: #fff;
        max-width: 580px;
    }

    .hero-slider .carousel-item .hero-content .hero-label {
        font-size: 0.6rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: #C9A227;
        background: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(4px);
        display: inline-block;
        padding: 0.3rem 1.2rem;
        border-radius: 40px;
        border: 1px solid rgba(255, 255, 255, 0.06);
        margin-bottom: 1.2rem;
    }

    .hero-slider .carousel-item .hero-content h1 {
        font-size: clamp(2.8rem, 8vw, 4.8rem);
        font-weight: 700;
        line-height: 1.05;
        letter-spacing: -0.02em;
        text-shadow: 0 4px 40px rgba(0, 0, 0, 0.15);
        font-family: 'Playfair Display', serif;
    }

    .hero-slider .carousel-item .hero-content p {
        font-size: 1rem;
        font-weight: 300;
        max-width: 420px;
        opacity: 0.85;
        margin: 1.2rem 0 2rem;
        letter-spacing: 0.02em;
        line-height: 1.7;
        font-family: 'Poppins', sans-serif;
    }

    /* ============================================================
       CAROUSEL CONTROLS
    ============================================================ */
    .carousel-control-prev,
    .carousel-control-next {
        width: 60px;
        height: 60px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 1;
        z-index: 10;
        position: absolute;
    }

    .carousel-control-prev {
        left: 20px;
    }

    .carousel-control-next {
        right: 20px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 20px;
        background-size: 50%;
        transition: 0.3s;
        border: 2px solid rgba(255, 255, 255, 0.3);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .carousel-control-prev-icon:hover,
    .carousel-control-next-icon:hover {
        background-color: #C9A227;
        border-color: #C9A227;
        transform: scale(1.1);
    }

    /* ============================================================
       INDICATORS (DOTS)
    ============================================================ */
    .carousel-indicators {
        bottom: 30px;
        z-index: 15;
        margin-bottom: 0;
    }

    .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.6);
        margin: 0 6px;
        background: transparent;
        padding: 0;
        cursor: pointer;
    }

    .carousel-indicators button.active {
        background: #C9A227;
        border-color: #C9A227;
    }

    /* ============================================================
       SCROLL INDICATOR
    ============================================================ */
    .scroll-indicator {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 12;
        color: rgba(255, 255, 255, 0.4);
        font-size: 0.55rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.3rem;
        animation: floatDown 2.4s ease-in-out infinite;
        font-family: 'Poppins', sans-serif;
    }

    .scroll-indicator i {
        font-size: 1rem;
    }

    @keyframes floatDown {
        0% { transform: translateX(-50%) translateY(0); opacity: 0.3; }
        50% { transform: translateX(-50%) translateY(8px); opacity: 0.8; }
        100% { transform: translateX(-50%) translateY(0); opacity: 0.3; }
    }

    /* ============================================================
       WELCOME SECTIONS
    ============================================================ */
    .welcome-section {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* ============================================================
       RESPONSIVE
    ============================================================ */
    @media (max-width: 768px) {
        .hero-slider {
            height: 70vh;
            min-height: 450px;
        }
        .hero-slider .carousel-item {
            height: 70vh;
            min-height: 450px;
        }
        .hero-slider .carousel-item .hero-content {
            left: 5%;
            right: 5%;
            max-width: 100%;
        }
        .hero-slider .carousel-item .hero-content p {
            max-width: 100%;
        }
        .hero-slider .carousel-item .hero-content h1 {
            font-size: 2rem;
        }
        .btn-hero {
            padding: 0.5rem 1.4rem;
            font-size: 0.6rem;
        }
        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
        }
        .carousel-control-prev {
            left: 10px;
        }
        .carousel-control-next {
            right: 10px;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 35px;
            height: 35px;
            padding: 12px;
        }
        .welcome-section {
            padding: 50px 0 !important;
        }
    }

    @media (max-width: 576px) {
        .hero-slider {
            height: 60vh;
            min-height: 380px;
        }
        .hero-slider .carousel-item {
            height: 60vh;
            min-height: 380px;
        }
        .hero-slider .carousel-item .hero-content h1 {
            font-size: 1.8rem;
        }
    }
</style>

<!-- ============================================================
    ANIMATION SCRIPT
============================================================ -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Observer for scroll animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = parseFloat(entry.target.style.transitionDelay) || 0;
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, delay);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observe all animated elements
        document.querySelectorAll('.fade-up, .fade-right, .fade-left, .zoom-in, .flip-up').forEach(el => {
            observer.observe(el);
        });

        // Also trigger for elements already in view on load
        setTimeout(() => {
            document.querySelectorAll('.fade-up, .fade-right, .fade-left, .zoom-in, .flip-up').forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight) {
                    const delay = parseFloat(el.style.transitionDelay) || 0;
                    setTimeout(() => {
                        el.classList.add('visible');
                    }, delay);
                }
            });
        }, 200);
    });
</script>
</div>