<x-layouts.app>
<div>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VELENZA · Sale</title>

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <style>
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
            font-weight: 600;
            letter-spacing: 0.01em;
        }

        .gold {
            color: var(--gold);
        }

        /* PAGE HEADER */
        .page-header {
            padding: 60px 0 40px;
            text-align: center;
            background: var(--primary);
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .page-header h1 {
            font-family: var(--font-heading);
            font-size: 3.2rem;
            font-weight: 300;
            letter-spacing: 0.08em;
            margin-bottom: 8px;
            color: var(--gold);
        }

        .page-header p {
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.6);
        }

        /* SECTION SPACING */
        .section-spacer {
            padding: 80px 0;
        }

        /* PRODUCT CARDS */
        .product-card {
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            transition: 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.02);
            height: 100%;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 56px rgba(0, 0, 0, 0.04);
        }

        .product-card .img-wrap {
            position: relative;
            overflow: hidden;
            aspect-ratio: 1/1.2;
        }

        .product-card .img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .product-card:hover .img-wrap img {
            transform: scale(1.02);
        }

        .product-card .img-wrap .hover-img {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .product-card:hover .img-wrap .hover-img {
            opacity: 1;
        }

        .product-card .product-info {
            padding: 1rem 0.8rem 1.2rem;
        }

        .product-card .product-info h6 {
            font-weight: 400;
            font-size: 0.85rem;
            margin-bottom: 0.1rem;
        }

        .product-card .product-info .price {
            font-weight: 500;
            color: var(--gold);
            font-size: 0.85rem;
        }

        .product-card .product-info .old-price {
            color: #bbb;
            text-decoration: line-through;
            font-size: 0.75rem;
            margin-left: 0.4rem;
        }

        .badge-sale {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #e74c3c;
            color: #fff;
            font-size: 0.5rem;
            letter-spacing: 0.1em;
            padding: 0.2rem 0.8rem;
            border-radius: 40px;
            font-weight: 600;
            z-index: 5;
        }

        .quick-actions {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 0.8rem;
            background: linear-gradient(0deg, rgba(255, 255, 255, 0.92) 0%, transparent 100%);
            transform: translateY(100%);
            transition: 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            display: flex;
            justify-content: center;
            gap: 0.6rem;
            opacity: 0;
            z-index: 6;
        }

        .product-card:hover .quick-actions {
            transform: translateY(0);
            opacity: 1;
        }

        .quick-actions i {
            background: #fff;
            padding: 0.4rem 0.6rem;
            border-radius: 60px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            font-size: 0.8rem;
            color: #333;
            transition: 0.2s;
            cursor: pointer;
        }

        .quick-actions i:hover {
            background: var(--gold);
            color: #fff;
        }

        @media (max-width: 768px) {
            .section-spacer {
                padding: 50px 0;
            }

            .page-header {
                padding: 40px 0 30px;
            }

            .page-header h1 {
                font-size: 2.4rem;
            }
        }
    </style>
</head>

<body>

    <!-- ============================================================
    PAGE HEADER
    ============================================================ -->
    <div class="page-header">
        <div class="container">
            <h1>Sale</h1>
            <p>Discover exclusive offers on premium fashion</p>
        </div>
    </div>

    <!-- ============================================================
    PRODUCTS GRID
    ============================================================ -->
    <section class="section-spacer" style="background:#fafafa;">
        <div class="container">
            <div class="row g-3 g-md-4">
                <!-- Product 1 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="50">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=400&auto=format&fit=crop"
                                alt="Product hover" />
                            <span class="badge-sale">-30%</span>
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Premium Hoodie</h6>
                            <span class="price">$89</span><span class="old-price">$120</span>
                        </div>
                    </div>
                </div>
                <!-- Product 2 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1554568218-0f1715e72254?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1554568218-0f1715e72254?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <span class="badge-sale">-25%</span>
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Oversized Shirt</h6>
                            <span class="price">$64</span><span class="old-price">$85</span>
                        </div>
                    </div>
                </div>
                <!-- Product 3 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="150">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <span class="badge-sale">-40%</span>
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Classic Blazer</h6>
                            <span class="price">$149</span><span class="old-price">$249</span>
                        </div>
                    </div>
                </div>
                <!-- Product 4 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <span class="badge-sale">-35%</span>
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Slim Fit Jeans</h6>
                            <span class="price">$79</span><span class="old-price">$119</span>
                        </div>
                    </div>
                </div>
                <!-- Product 5 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <span class="badge-sale">-20%</span>
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Leather Belt</h6>
                            <span class="price">$49</span><span class="old-price">$69</span>
                        </div>
                    </div>
                </div>
                <!-- Product 6 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <span class="badge-sale">-30%</span>
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Leather Boots</h6>
                            <span class="price">$189</span><span class="old-price">$269</span>
                        </div>
                    </div>
                </div>
                <!-- Product 7 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="350">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <span class="badge-sale">-50%</span>
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Wool Jacket</h6>
                            <span class="price">$189</span><span class="old-price">$379</span>
                        </div>
                    </div>
                </div>
                <!-- Product 8 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1483985988355-763728e1935b?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <span class="badge-sale">-25%</span>
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Silk Scarf</h6>
                            <span class="price">$39</span><span class="old-price">$59</span>
                        </div>
                    </div>
                </div>
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
            easing: 'ease-out-cubic'
        });
    </script>
</body>

</html>
</div>
</x-layouts.app>
