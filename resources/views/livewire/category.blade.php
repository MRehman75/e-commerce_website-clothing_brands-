<div>
    <style>
        /* ============================================================
           GLOBAL RESET & ROOTS
        ============================================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0a0a0a;
            --gold: #C9A227;
            --beige: #F5F1EB;
            --bg-light: #FAFAFA;
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Poppins', sans-serif;
        }

        body {
            font-family: var(--font-body);
            color: #1a1a1a;
            background: #fff;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        .heading-font {
            font-family: var(--font-heading);
            font-weight: 300;
            letter-spacing: 0.04em;
        }

        .gold {
            color: var(--gold);
        }

        .section-sub {
            font-size: 0.6rem;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: #999;
            margin-bottom: 0.5rem;
            font-family: var(--font-body);
            font-weight: 300;
        }

        .section-title {
            font-family: var(--font-heading);
            font-size: clamp(2.6rem, 5vw, 4.2rem);
            font-weight: 300;
            letter-spacing: 0.04em;
            line-height: 1.15;
        }

        /* ============================================================
           SECTION SPACING
        ============================================================ */
        .section-spacer {
            padding: 60px 0 80px;
        }

        /* ============================================================
           BREADCRUMB
        ============================================================ */
        .breadcrumb-custom {
            padding: 20px 0 10px;
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 300;
            letter-spacing: 0.05em;
            color: #999;
        }

        .breadcrumb-custom a {
            color: #999;
            text-decoration: none;
            transition: 0.2s;
        }

        .breadcrumb-custom a:hover {
            color: var(--gold);
        }

        .breadcrumb-custom .separator {
            margin: 0 10px;
            color: #ddd;
        }

        .breadcrumb-custom .current {
            color: var(--primary);
        }

        .search-wrapper {
            position: relative;
        }

        .search-wrapper input {
            border-radius: 999px;
            padding: 1.1rem 1.5rem;
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .filter-chips {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .chip {
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #fff;
            color: #111;
            border-radius: 999px;
            padding: 0.75rem 1.2rem;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .chip.active,
        .chip:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .search-hint {
            font-size: 0.9rem;
            color: #463f3f;
        }

        .search-hint kbd {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.25rem 0.5rem;
            border-radius: 0.35rem;
            border: 1px solid rgba(0, 0, 0, 0.12);
            background: #ac9d59a6;
            font-size: 0.78rem;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            margin: 0 0.15rem;
        }

        .search-card {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.88), rgba(255, 255, 255, 0.82)),
                url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1400&q=80') center/cover no-repeat;
            border: 1px solid rgba(234, 211, 159, 0.35);
            border-radius: 32px;
            box-shadow: 0 28px 90px rgba(0, 0, 0, 0.08);
            padding: 2.25rem 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            min-height: 420px;
        }

        .search-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top left, rgba(255, 255, 255, 0.85), transparent 32%),
                        radial-gradient(circle at bottom right, rgba(255, 255, 255, 0.7), transparent 35%);
            pointer-events: none;
        }

        .search-card .search-title {
            text-align: center;
            margin-bottom: 1.75rem;
            position: relative;
            z-index: 1;
        }

        .search-card .search-title h2 {
            font-size: clamp(1.9rem, 2.7vw, 2.6rem);
            letter-spacing: 0.02em;
            margin-bottom: 0.55rem;
            color: var(--primary);
        }

        .search-card .search-title p {
            margin: 0;
            color: #5f5f5f;
            font-size: 0.98rem;
            line-height: 1.7;
        }

        .search-card .search-wrapper {
            position: relative;
        }

        .search-card .search-wrapper::before {
            content: '\1F50D';
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.05rem;
            color: #b19447;
            pointer-events: none;
        }

        .search-card .form-control {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(198, 170, 111, 0.25);
            border-radius: 999px;
            padding: 1rem 3.5rem 1rem 3.25rem;
            font-size: 1rem;
            box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.06);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .search-card .form-control:focus {
            border-color: rgba(201, 162, 39, 0.9);
            box-shadow: 0 0 0 0.25rem rgba(201, 162, 39, 0.14);
            transform: translateY(-1px);
        }

        .search-card .search-loading {
            position: absolute;
            right: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .search-card .popular-searches,
        .search-card .recent-searches {
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(201, 162, 39, 0.18);
            border-radius: 22px;
            padding: 1rem 1.25rem;
        }

        .search-card .popular-searches h5,
        .search-card .recent-searches h5 {
            margin-bottom: 0.85rem;
            font-size: 0.95rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #7a6d50;
        }

        .search-card .popular-searches .btn,
        .search-card .recent-searches .btn {
            border-radius: 999px;
            padding: 0.65rem 1.05rem;
            font-size: 0.85rem;
            transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
        }

        .search-card .popular-searches .btn:hover,
        .search-card .recent-searches .btn:hover {
            background: rgba(201, 162, 39, 0.12);
            color: var(--primary);
            transform: translateY(-1px);
        }

        .search-card .popular-searches h5,
        .search-card .recent-searches h5 {
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #5a5a5a;
        }

        .search-card .popular-searches .btn,
        .search-card .recent-searches .btn {
            border-radius: 999px;
            padding: 0.6rem 1rem;
            font-size: 0.85rem;
        }

        .categories-hero {
            text-align: center;
            padding: 2rem 0 30px;
        }

        .categories-hero h1 {
            font-size: clamp(3rem, 5vw, 4.8rem);
            margin-bottom: 0.65rem;
            letter-spacing: 0.04em;
        }

        .categories-hero p {
            font-size: 1.05rem;
            color: #6f6f6f;
            max-width: 680px;
            margin: 0 auto;
        }

        .filter-chips {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .chip {
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #fff;
            color: #111;
            border-radius: 999px;
            padding: 0.75rem 1.2rem;
            font-size: 0.9rem;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
        }

        .chip.active,
        .chip:hover {
            background: var(--gold);
            color: #111;
            border-color: var(--gold);
            transform: translateY(-1px);
        }

        .popular-searches .btn-outline-secondary,
        .recent-searches .btn-outline-secondary,
        .recent-searches .btn-outline-primary {
            color: #333;
            border-color: rgba(0, 0, 0, 0.08);
            background: #fff;
        }

        .popular-searches .btn-outline-secondary:hover,
        .recent-searches .btn-outline-secondary:hover,
        .recent-searches .btn-outline-primary:hover {
            background: var(--gold);
            color: #111;
            border-color: var(--gold);
        }

        .result-thumbs {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .search-loading {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .result-thumbs img {
            width: 100%;
            height: 76px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.14);
        }

        .category-card {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            min-height: 340px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.02);
            transition: 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
            display: flex;
            flex-direction: column;
        }

        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        /* ============================================================
           CATEGORIES HERO
        ============================================================ */
        .categories-hero {
            text-align: center;
            padding: 20px 0 40px;
        }

        .categories-hero h1 {
            font-family: var(--font-heading);
            font-size: clamp(2.8rem, 5vw, 4.5rem);
            font-weight: 300;
            letter-spacing: 0.06em;
            margin-bottom: 0.5rem;
        }

        .categories-hero p {
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 300;
            color: #888;
            max-width: 500px;
            margin: 0 auto;
        }

        /* ============================================================
           CATEGORY CARDS - Premium Grid
        ============================================================ */
        .category-card-link {
            display: block;
            color: inherit;
            text-decoration: none;
        }

        .category-card {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            height: 340px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.02);
            transition: 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
        }

        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .category-card:hover img {
            transform: scale(1.06);
        }

        .category-card:hover {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06);
            transform: translateY(-6px);
        }

        .category-card .category-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.1) 50%, transparent 70%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2rem;
            color: #fff;
        }

        .category-card .category-overlay .category-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(6px);
            padding: 0.2rem 1rem;
            border-radius: 40px;
            font-family: var(--font-body);
            font-size: 0.6rem;
            font-weight: 300;
            letter-spacing: 0.08em;
            color: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .category-card .category-overlay h3 {
            font-family: var(--font-heading);
            font-size: 1.8rem;
            font-weight: 300;
            letter-spacing: 0.06em;
            margin-bottom: 0.2rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .category-card .category-overlay .category-count {
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 300;
            opacity: 0.7;
            letter-spacing: 0.05em;
        }

        .category-card .category-overlay .shop-link {
            display: inline-block;
            margin-top: 0.8rem;
            font-family: var(--font-body);
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
            text-decoration: none;
            border-bottom: 1.5px solid var(--gold);
            padding-bottom: 2px;
            transition: 0.3s;
            opacity: 0.8;
        }

        .category-card .category-overlay .shop-link:hover {
            opacity: 1;
            letter-spacing: 0.2em;
        }

        /* Featured Category - Larger */
        .category-card.featured {
            height: 420px;
        }

        .category-card.featured .category-overlay h3 {
            font-size: 2.4rem;
        }

        /* Category Card Variations */
        .category-card .category-overlay .category-icon {
            position: absolute;
            top: 16px;
            left: 16px;
            font-size: 1.8rem;
            color: rgba(255, 255, 255, 0.3);
            opacity: 0.5;
            transition: 0.3s;
        }

        .category-card:hover .category-overlay .category-icon {
            opacity: 1;
            transform: scale(1.05);
        }

        /* ============================================================
           CATEGORY SUB-SECTIONS
        ============================================================ */
        .sub-categories {
            margin-top: 4rem;
        }

        .sub-categories .sub-title {
            font-family: var(--font-heading);
            font-size: 1.6rem;
            font-weight: 300;
            letter-spacing: 0.04em;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .sub-category-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.04);
            transition: 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: var(--primary);
        }

        .sub-category-item:hover {
            border-color: var(--gold);
            transform: translateX(4px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
        }

        .sub-category-item .sub-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(201, 162, 39, 0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: 0.3s;
        }

        .sub-category-item:hover .sub-icon {
            background: rgba(201, 162, 39, 0.12);
        }

        .sub-category-item .sub-icon i {
            color: var(--gold);
            font-size: 1.2rem;
        }

        .sub-category-item .sub-info {
            flex: 1;
        }

        .sub-category-item .sub-info .sub-name {
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 400;
        }

        .sub-category-item .sub-info .sub-count {
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 300;
            color: #999;
        }

        .sub-category-item .sub-arrow {
            color: #ddd;
            transition: 0.3s;
        }

        .sub-category-item:hover .sub-arrow {
            color: var(--gold);
            transform: translateX(4px);
        }

        /* ============================================================
           POPULAR CATEGORIES BANNER
        ============================================================ */
        .popular-banner {
            background: var(--primary);
            border-radius: 20px;
            padding: 4rem 3rem;
            color: #fff;
            text-align: center;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
        }

        .popular-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1483985988355-763728e1935b?w=800&auto=format&fit=crop&q=80') center 30% / cover no-repeat;
            opacity: 0.08;
        }

        .popular-banner * {
            position: relative;
            z-index: 2;
        }

        .popular-banner h2 {
            font-family: var(--font-heading);
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 300;
            letter-spacing: 0.06em;
            margin-bottom: 0.5rem;
        }

        .popular-banner p {
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 300;
            opacity: 0.7;
            max-width: 500px;
            margin: 0 auto 1.5rem;
        }

        .popular-banner .btn-explore {
            padding: 0.7rem 2.5rem;
            background: var(--gold);
            color: #fff;
            border: none;
            border-radius: 40px;
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .popular-banner .btn-explore:hover {
            background: #b8911f;
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(201, 162, 39, 0.2);
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 992px) {
            .category-card {
                height: 280px;
            }

            .category-card.featured {
                height: 340px;
            }

            .category-card.featured .category-overlay h3 {
                font-size: 2rem;
            }

            .popular-banner {
                padding: 3rem 2rem;
            }
        }

        @media (max-width: 768px) {
            .section-spacer {
                padding: 40px 0 60px;
            }

            .category-card {
                height: 240px;
            }

            .category-card.featured {
                height: 300px;
            }

            .category-card .category-overlay h3 {
                font-size: 1.4rem;
            }

            .category-card.featured .category-overlay h3 {
                font-size: 1.8rem;
            }

            .sub-categories .sub-title {
                font-size: 1.3rem;
            }

            .popular-banner {
                padding: 2.5rem 1.5rem;
            }

            .popular-banner h2 {
                font-size: 1.8rem;
            }

            .categories-hero h1 {
                font-size: 2.4rem;
            }
        }

        @media (max-width: 576px) {
            .category-card {
                height: 200px;
            }

            .category-card.featured {
                height: 260px;
            }

            .category-card .category-overlay {
                padding: 1.2rem;
            }

            .category-card .category-overlay h3 {
                font-size: 1.2rem;
            }

            .category-card.featured .category-overlay h3 {
                font-size: 1.5rem;
            }

            .category-card .category-overlay .category-badge {
                font-size: 0.5rem;
                top: 10px;
                right: 10px;
                padding: 0.15rem 0.8rem;
            }

            .category-card .category-overlay .category-icon {
                font-size: 1.2rem;
                top: 10px;
                left: 10px;
            }

            .sub-category-item {
                padding: 0.6rem 1rem;
            }

            .sub-category-item .sub-icon {
                width: 32px;
                height: 32px;
            }

            .sub-category-item .sub-icon i {
                font-size: 1rem;
            }

            .sub-category-item .sub-info .sub-name {
                font-size: 0.75rem;
            }

            .popular-banner {
                padding: 2rem 1.2rem;
                margin-top: 2rem;
            }

            .popular-banner h2 {
                font-size: 1.5rem;
            }

            .popular-banner p {
                font-size: 0.9rem;
            }
        }
    </style>

    <!-- ============================================================
    BREADCRUMB
    ============================================================ -->
    <div class="container">
        <div class="breadcrumb-custom">
            <a href="#">Home</a>
            <span class="separator">/</span>
            <span class="current">Categories</span>
        </div>
    </div>

    <!-- ============================================================
    CATEGORIES PAGE
    ============================================================ -->
    <section class="section-spacer" style="padding-top:10px;">
        <div class="container">
            <div class="categories-hero">
                <h1>Shop by Category</h1>
                <p>Explore our curated collections, each crafted with precision and passion</p>
            </div>

            <div class="search-card">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                    
                        <div class="search-wrapper">
                            <input
                                id="category-search-input"
                                type="text"
                                wire:model.debounce.300ms="search"
                                wire:keydown.enter="submitSearch"
                                wire:keydown.escape="clearSearch"
                                class="form-control form-control-lg"
                                placeholder="Search categories..."
                                autocomplete="off">
                            <div class="search-loading" wire:loading wire:target="selectChip searchCategory submitSearch selectRecentSearch">
                                <div class="spinner-border spinner-border-sm text-dark" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-lg-8">
                        <div class="filter-chips">
                            @foreach(['All', 'Women', 'New Arrivals', 'Sale'] as $chip)
                                <button
                                    type="button"
                                    wire:click="selectChip('{{ $chip }}')"
                                    class="chip {{ $selectedChip === $chip ? 'active' : '' }}">
                                    {{ $chip }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-lg-8">
                        <div class="popular-searches">
                            <h5>Popular searches</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($popularSearches as $popular)
                                    <button
                                        type="button"
                                        wire:click="searchCategory('{{ $popular }}')"
                                        class="btn btn-outline-secondary btn-sm">
                                        {{ $popular }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-3">
                    <div class="col-lg-8 text-center">
                        <p class="search-hint">
                            Press <kbd>/</kbd> or <kbd>Ctrl+K</kbd> to focus the search bar, and <kbd>Esc</kbd> to close it.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5" wire:loading.class="opacity-50" wire:target="selectChip searchCategory submitSearch selectRecentSearch">
                @forelse($categories as $category)
                    <div class="col-md-4">
                        <a href="{{ route('category.show', $category->slug) }}" class="category-card category-card-link">
                            <img src="{{ asset('storage/'.$category->image) }}"
                                 alt="{{ $category->name }}">

                            <div class="category-overlay">
                                <h3>{{ $category->name }}</h3>
                                <span class="category-count">
                                    {{ $category->products_count }} Products
                                </span>
                            </div>

                            @if($category->products->count())
                                <div class="result-thumbs px-3 pt-3 pb-4">
                                    @foreach($category->products as $product)
                                        <img src="{{ asset('storage/'.$product->image) }}"
                                             alt="{{ $product->name }}"
                                             title="{{ $product->name }}">
                                    @endforeach
                                </div>
                            @endif
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <h4>No products found.</h4>
                        <p class="mb-3">Try searching these categories instead:</p>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            @foreach(['Women', 'New Arrivals', 'Sale'] as $suggestion)
                                <button
                                    type="button"
                                    wire:click="searchCategory('{{ $suggestion }}')"
                                    class="btn btn-outline-secondary btn-sm">
                                    {{ $suggestion }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="row mb-5">
                <div class="col-lg-8">
                    @if(!empty($recentSearches))
                        <div class="recent-searches">
                            <h5>Recent searches</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($recentSearches as $term)
                                    <button
                                        type="button"
                                        wire:click="selectRecentSearch('{{ $term }}')"
                                        class="btn btn-outline-primary btn-sm">
                                        {{ $term }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="sub-categories" data-aos="fade-up" data-aos-delay="350">
                <h3 class="sub-title">Explore More</h3>
                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <a href="#" class="sub-category-item">
                            <span class="sub-icon"><i class="fas fa-tshirt"></i></span>
                            <span class="sub-info">
                                <span class="sub-name">Tops</span>
                                <span class="sub-count">12 Products</span>
                            </span>
                            <span class="sub-arrow"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="#" class="sub-category-item">
                            <span class="sub-icon"><i class="fas fa-user-tie"></i></span>
                            <span class="sub-info">
                                <span class="sub-name">Blazers</span>
                                <span class="sub-count">8 Products</span>
                            </span>
                            <span class="sub-arrow"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="#" class="sub-category-item">
                            <span class="sub-icon"><i class="fas fa-socks"></i></span>
                            <span class="sub-info">
                                <span class="sub-name">Knitwear</span>
                                <span class="sub-count">10 Products</span>
                            </span>
                            <span class="sub-arrow"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="#" class="sub-category-item">
                            <span class="sub-icon"><i class="fas fa-tag"></i></span>
                            <span class="sub-info">
                                <span class="sub-name">Sale Items</span>
                                <span class="sub-count">6 Products</span>
                            </span>
                            <span class="sub-arrow"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="#" class="sub-category-item">
                            <span class="sub-icon"><i class="fas fa-pants"></i></span>
                            <span class="sub-info">
                                <span class="sub-name">Trousers</span>
                                <span class="sub-count">9 Products</span>
                            </span>
                            <span class="sub-arrow"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="#" class="sub-category-item">
                            <span class="sub-icon"><i class="fas fa-ring"></i></span>
                            <span class="sub-info">
                                <span class="sub-name">Jewelry</span>
                                <span class="sub-count">14 Products</span>
                            </span>
                            <span class="sub-arrow"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="#" class="sub-category-item">
                            <span class="sub-icon"><i class="fas fa-clock"></i></span>
                            <span class="sub-info">
                                <span class="sub-name">Watches</span>
                                <span class="sub-count">7 Products</span>
                            </span>
                            <span class="sub-arrow"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </div>
                    <div class="col-md-3 col-6">
                        <a href="#" class="sub-category-item">
                            <span class="sub-icon"><i class="fas fa-gift"></i></span>
                            <span class="sub-info">
                                <span class="sub-name">Gift Sets</span>
                                <span class="sub-count">5 Products</span>
                            </span>
                            <span class="sub-arrow"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ============================================================
            POPULAR CATEGORIES BANNER
            ============================================================ -->
            <div class="popular-banner" data-aos="fade-up" data-aos-delay="400">
                <h2>Discover Our Collections</h2>
                <p>From timeless classics to contemporary designs, find your perfect style</p>
                <a href="#" class="btn-explore">Explore All</a>
            </div>

        </div>
    </section>

    <!-- ============================================================
    SCRIPTS
    ============================================================ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700,
            once: true,
            easing: 'ease-out-cubic',
            offset: 30
        });

        // ============================================================
        // CATEGORY CARD CLICK EFFECT
        // ============================================================
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('click', function () {
                // Add subtle click feedback
                this.style.transition = 'transform 0.1s ease';
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // ============================================================
        // SUB-CATEGORY CLICK EFFECT
        // ============================================================
        document.querySelectorAll('.sub-category-item').forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                // Add click feedback
                this.style.transition = 'background 0.2s ease';
                this.style.background = 'rgba(201,162,39,0.04)';
                setTimeout(() => {
                    this.style.background = '';
                }, 300);
            });
        });

        // KEYBOARD SHORTCUTS FOR SEARCH
        // ============================================================
        const searchInput = document.getElementById('category-search-input');

        window.addEventListener('keydown', event => {
            if (!searchInput) return;

            const key = event.key.toLowerCase();
            const isInputFocused = document.activeElement === searchInput;

            if (key === '/' && !event.ctrlKey && !event.metaKey && !event.altKey && !isInputFocused) {
                event.preventDefault();
                searchInput.focus();
            }

            if ((event.ctrlKey || event.metaKey) && key === 'k') {
                event.preventDefault();
                searchInput.focus();
            }

            if (event.key === 'Escape' && isInputFocused) {
                searchInput.blur();
                if (window.Livewire) {
                    window.Livewire.emit('clearSearch');
                }
            }
        });

        document.addEventListener('livewire:update', () => {
            if (window.AOS && typeof window.AOS.refreshHard === 'function') {
                window.AOS.refreshHard();
            } else if (window.AOS && typeof window.AOS.refresh === 'function') {
                window.AOS.refresh();
            }
        });
    </script>
</div>