<x-layouts.app>
    <div>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>VELENZA · About Us</title>

            <!-- Bootstrap 5 & Icons -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

            <!-- Font Awesome 6 -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link
                href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Poppins:wght@200;300;400;500;600;700&display=swap"
                rel="stylesheet" />

            <!-- AOS -->
            <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

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

                .gold-divider {
                    width: 60px;
                    height: 2px;
                    background: var(--gold);
                    margin: 1rem 0 1.5rem;
                    opacity: 0.3;
                }

                /* ============================================================
                   MAIN CONTENT – No Hero, just top heading
                ============================================================ */
                .about-main {
                    max-width: 900px;
                    margin: 0 auto;
                    padding: 60px 20px 40px;
                }

                .about-main .page-heading {
                    font-family: var(--font-heading);
                    font-size: clamp(3rem, 6vw, 4.5rem);
                    font-weight: 300;
                    letter-spacing: 0.04em;
                    margin-bottom: 0.2rem;
                }

                .about-main .page-heading-line {
                    width: 80px;
                    height: 2px;
                    background: var(--gold);
                    margin: 0.5rem 0 2rem;
                    opacity: 0.3;
                }

                .about-main p {
                    font-weight: 300;
                    line-height: 1.9;
                    color: #444;
                    margin-bottom: 1.2rem;
                }

                .about-main h2 {
                    font-family: var(--font-heading);
                    font-size: 1.8rem;
                    font-weight: 300;
                    margin-top: 2rem;
                    margin-bottom: 0.8rem;
                }

                /* Product Grid – Stylish badges */
                .product-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                    gap: 12px;
                    margin: 1.5rem 0;
                }

                .product-grid .product-item {
                    background: var(--bg-light);
                    padding: 0.6rem 1.2rem;
                    border-radius: 30px;
                    font-weight: 300;
                    font-size: 0.9rem;
                    color: #444;
                    text-align: center;
                    transition: 0.3s;
                    border: 1px solid transparent;
                }

                .product-grid .product-item:hover {
                    border-color: var(--gold);
                    color: var(--gold);
                    background: #fff;
                }

                /* ============================================================
                   CEO SECTION – Image + signature on left, text on right
                ============================================================ */
                .ceo-block {
                    margin-top: 60px;
                    padding-top: 40px;
                    border-top: 1px solid rgba(0, 0, 0, 0.04);
                    display: flex;
                    align-items: flex-start;
                    gap: 50px;
                }

                /* Left column: image + signature */
                .ceo-left {
                    flex: 0 0 200px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                }

                .ceo-left .ceo-image {
                    width: 100%;
                    border-radius: 50%;
                    overflow: hidden;
                    border: 3px solid rgba(201, 162, 39, 0.2);
                    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.04);
                    transition: 0.3s;
                    aspect-ratio: 1/1;
                }

                .ceo-left .ceo-image:hover {
                    border-color: var(--gold);
                    transform: scale(1.02);
                }

                .ceo-left .ceo-image img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }

                /* Signature directly below image */
                .ceo-left .ceo-signature {
                    margin-top: 1.2rem;
                }

                .ceo-left .ceo-signature .signature-name {
                    font-family: var(--font-heading);
                    font-size: 1.1rem;
                    font-weight: 400;
                    color: var(--primary);
                    letter-spacing: 0.04em;
                    line-height: 1.3;
                }

                .ceo-left .ceo-signature .signature-title {
                    font-family: var(--font-body);
                    font-size: 0.75rem;
                    font-weight: 300;
                    color: #999;
                    letter-spacing: 0.08em;
                    line-height: 1.4;
                }

                .ceo-left .ceo-signature .gold-line {
                    width: 40px;
                    height: 2px;
                    background: var(--gold);
                    margin: 0.4rem auto 0.6rem;
                    opacity: 0.3;
                }

                /* Right column: message */
                .ceo-right {
                    flex: 1;
                }

                .ceo-right .ceo-label {
                    font-family: var(--font-body);
                    font-size: 0.6rem;
                    letter-spacing: 0.35em;
                    text-transform: uppercase;
                    color: var(--gold);
                    margin-bottom: 0.5rem;
                }

                .ceo-right h2 {
                    font-family: var(--font-heading);
                    font-size: clamp(1.8rem, 2.5vw, 2.6rem);
                    font-weight: 300;
                    letter-spacing: 0.04em;
                    margin-bottom: 0.8rem;
                }

                .ceo-right p {
                    font-weight: 300;
                    line-height: 1.9;
                    color: #555;
                    margin-bottom: 1rem;
                }

                @media (max-width: 768px) {
                    .about-main {
                        padding: 40px 15px;
                    }

                    .ceo-block {
                        flex-direction: column;
                        align-items: center;
                        gap: 30px;
                    }

                    .ceo-left {
                        flex: 0 0 auto;
                        max-width: 180px;
                    }

                    .ceo-right {
                        text-align: center;
                    }

                    .ceo-right .ceo-label {
                        text-align: center;
                    }

                    .product-grid {
                        grid-template-columns: 1fr 1fr;
                    }
                }

                @media (max-width: 576px) {
                    .product-grid {
                        grid-template-columns: 1fr;
                    }

                    .ceo-left {
                        max-width: 150px;
                    }

                    .about-main .page-heading {
                        font-size: 2.8rem;
                    }
                }
            </style>
        </head>

        <body>

            <!-- ============================================================
            MAIN CONTENT – No Hero
            ============================================================ -->
            <div class="about-main" data-aos="fade-up">
                <h1 class="page-heading">About Us</h1>
                <div class="page-heading-line"></div>

                <h2>Velenza by Saqib Textile</h2>

                <p>
                    Velenza by Saqib Textile is a premium Pakistani women's wear brand dedicated to creating elegant embroidered fashion that celebrates beauty, confidence, and timeless style. Inspired by the rich heritage of Pakistani textiles and enhanced with modern design aesthetics, Velenza offers carefully crafted collections for women who appreciate quality, sophistication, and comfort.
                </p>
                <p>
                    Our journey is driven by a passion for fine embroidery, premium fabrics, and exceptional craftsmanship. Every outfit is thoughtfully designed using high-quality materials and meticulous attention to detail, ensuring that each piece reflects elegance and durability.
                </p>
                <p>
                    At Velenza, we believe fashion is more than clothing—it is a reflection of personality and confidence. Our collections are designed to meet the needs of modern women, offering stylish options for everyday wear, festive occasions, office wear, and special celebrations.
                </p>
                <p>
                    As an online-first fashion brand, we are committed to providing a seamless shopping experience through secure ordering, reliable nationwide delivery, responsive customer support, and premium packaging. Customer satisfaction is at the heart of everything we do.
                </p>

                <h2>Our Product Range</h2>
                <div class="product-grid">
                    <span class="product-item">Embroidered Lawn</span>
                    <span class="product-item">Khaddar Collections</span>
                    <span class="product-item">Linen Collections</span>
                    <span class="product-item">Luxury Pret</span>
                    <span class="product-item">Ready-to-Wear Suits</span>
                    <span class="product-item">Semi‑Formal &amp; Party Wear</span>
                    <span class="product-item">Festive &amp; Eid Collections</span>
                    <span class="product-item">Seasonal Fashion</span>
                </div>

                <p>
                    Every Velenza creation undergoes strict quality control to ensure excellence in fabric, embroidery, stitching, finishing, and presentation before reaching our customers.
                </p>
                <p>
                    We are committed to continuous innovation, ethical manufacturing, sustainable business practices, and creating lasting value for our customers, employees, and business partners.
                </p>

                <div class="gold-divider"></div>

                <h2>Our Promise</h2>
                <p>
                    We promise to deliver beautifully crafted embroidered apparel that combines premium quality, contemporary design, affordability, and outstanding customer service.
                </p>

                <!-- ============================================================
                CEO SECTION – Image + signature on left, message on right
                ============================================================ -->
                <div class="ceo-block" data-aos="fade-up" data-aos-delay="100">

                    <!-- LEFT: Image + Signature -->
                    <div class="ceo-left" data-aos="fade-right" data-aos-delay="150">
                        <div class="ceo-image">
                            <img src="{{ asset('images/ceo.png') }}" alt="CEO - Muhammad Mohsin Rana" />
                        </div>
                        <div class="ceo-signature">
                            <div class="gold-line"></div>
                            <div class="signature-name">MUHAMMAD MOHSIN RANA</div>
                            <div class="signature-title">Chief Executive Officer<br />Velenza by Saqib Textile</div>
                        </div>
                    </div>

                    <!-- RIGHT: Message -->
                    <div class="ceo-right" data-aos="fade-left" data-aos-delay="200">
                        <span class="ceo-label">✦ Message from the CEO</span>
                        <h2>Welcome to Velenza by Saqib Textile</h2>
                        <p>
                            At Velenza, we believe that every woman deserves to feel confident, graceful, and beautiful in what she wears. Our journey began with a simple vision—to create premium-quality women's wear that combines timeless elegance, exceptional craftsmanship, and modern fashion.
                        </p>
                        <p>
                            Every Velenza collection is thoughtfully designed using carefully selected fabrics, intricate embroidery, and refined stitching to ensure superior quality and comfort. Our commitment extends beyond creating beautiful outfits; we strive to build lasting trust with our customers through honesty, innovation, and consistent excellence.
                        </p>
                        <p>
                            We understand that fashion is a reflection of personality and culture. Therefore, each design is created to celebrate the beauty, confidence, and individuality of women while preserving the rich traditions of Pakistani craftsmanship.
                        </p>
                        <p>
                            As we continue to grow, our focus remains on delivering outstanding products, embracing innovation, and providing an exceptional shopping experience through our online platforms and valued retail partners.
                        </p>
                        <p>
                            I sincerely thank our customers, business partners, employees, and stakeholders for their trust and support. Together, we will continue to build Velenza into one of Pakistan's most admired women's fashion brands.
                        </p>
                        <p>
                            We warmly invite you to become part of the Velenza family and experience fashion crafted with passion, elegance, and excellence.
                        </p>
                    </div>

                </div>

            </div>

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
                    offset: 40
                });
            </script>
        </body>

        </html>
    </div>
</x-layouts.app>