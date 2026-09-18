<x-layouts.app>
    <div>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>VELENZA · Terms & Conditions</title>

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

                /* ============================================================
                   TERMS HERO - Cinematic Banner
                ============================================================ */
                .terms-hero {
                    height: 50vh;
                    min-height: 350px;
                    position: relative;
                    overflow: hidden;
                    background: var(--primary);
                }

                .terms-hero .hero-bg {
                    position: absolute;
                    inset: 0;
                    background: url('https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=1600&auto=format&fit=crop&q=80') center 30% / cover no-repeat;
                    transform: scale(1.04);
                    animation: heroZoom 25s ease-in-out infinite alternate;
                }

                @keyframes heroZoom {
                    0% {
                        transform: scale(1.04);
                    }

                    100% {
                        transform: scale(1.12);
                    }
                }

                .terms-hero .hero-overlay {
                    position: absolute;
                    inset: 0;
                    background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.25) 60%);
                }

                .terms-hero .hero-content {
                    position: relative;
                    z-index: 10;
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    text-align: center;
                    color: #fff;
                    padding: 0 20px;
                }

                .terms-hero .hero-content .hero-label {
                    font-family: var(--font-body);
                    font-size: 0.7rem;
                    letter-spacing: 0.35em;
                    text-transform: uppercase;
                    color: var(--gold);
                    margin-bottom: 1rem;
                    opacity: 0.8;
                }

                .terms-hero .hero-content h1 {
                    font-family: var(--font-heading);
                    font-size: clamp(2.8rem, 7vw, 5rem);
                    font-weight: 300;
                    letter-spacing: 0.06em;
                    line-height: 1.05;
                    animation: fadeUp 1.2s ease 0.5s forwards;
                    opacity: 0;
                    transform: translateY(30px);
                }

                .terms-hero .hero-content .hero-sub {
                    font-family: var(--font-body);
                    font-size: 1rem;
                    font-weight: 300;
                    max-width: 500px;
                    opacity: 0.6;
                    margin-top: 0.8rem;
                    animation: fadeUp 1.2s ease 0.8s forwards;
                    opacity: 0;
                    transform: translateY(30px);
                }

                @keyframes fadeUp {
                    0% {
                        opacity: 0;
                        transform: translateY(30px);
                    }

                    100% {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                @media (max-width: 768px) {
                    .terms-hero {
                        height: 40vh;
                        min-height: 300px;
                    }

                    .terms-hero .hero-content h1 {
                        font-size: 2.4rem;
                    }

                    .terms-hero .hero-content .hero-sub {
                        font-size: 0.9rem;
                    }
                }

                /* ============================================================
                   SECTION SPACING
                ============================================================ */
                .section-spacer {
                    padding: 80px 0;
                }

                .section-spacer-sm {
                    padding: 40px 0;
                }

                /* ============================================================
                   TERMS CONTENT - Premium Editorial
                ============================================================ */
                .terms-content {
                    max-width: 820px;
                    margin: 0 auto;
                }

                .terms-content .last-updated {
                    font-family: var(--font-body);
                    font-size: 0.75rem;
                    font-weight: 300;
                    color: #999;
                    letter-spacing: 0.05em;
                    margin-bottom: 2rem;
                    padding-bottom: 1.5rem;
                    border-bottom: 1px solid rgba(0, 0, 0, 0.04);
                }

                .terms-content .last-updated span {
                    color: var(--gold);
                }

                .terms-content .terms-block {
                    margin-bottom: 2.5rem;
                }

                .terms-content .terms-block .block-number {
                    font-family: var(--font-heading);
                    font-size: 1.8rem;
                    font-weight: 300;
                    color: var(--gold);
                    opacity: 0.3;
                    display: inline-block;
                    margin-right: 10px;
                    line-height: 1;
                }

                .terms-content .terms-block h3 {
                    font-family: var(--font-heading);
                    font-size: 1.6rem;
                    font-weight: 400;
                    letter-spacing: 0.04em;
                    margin-bottom: 0.8rem;
                    display: inline-block;
                }

                .terms-content .terms-block p {
                    font-family: var(--font-body);
                    font-size: 0.95rem;
                    font-weight: 300;
                    line-height: 1.9;
                    color: #666;
                    margin-bottom: 0.8rem;
                    padding-left: 0;
                }

                .terms-content .terms-block ul {
                    list-style: none;
                    padding-left: 0;
                }

                .terms-content .terms-block ul li {
                    font-family: var(--font-body);
                    font-size: 0.95rem;
                    font-weight: 300;
                    line-height: 1.8;
                    color: #666;
                    padding: 0.3rem 0 0.3rem 2rem;
                    position: relative;
                }

                .terms-content .terms-block ul li::before {
                    content: '✦';
                    position: absolute;
                    left: 0;
                    color: var(--gold);
                    font-size: 0.7rem;
                    opacity: 0.5;
                    top: 0.3rem;
                }

                .terms-content .terms-block .gold-divider {
                    width: 40px;
                    height: 2px;
                    background: var(--gold);
                    margin: 0.8rem 0 1.2rem;
                    opacity: 0.2;
                }

                /* ============================================================
                   BACK TO TOP
                ============================================================ */
                .back-to-top {
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    font-family: var(--font-body);
                    font-size: 0.7rem;
                    font-weight: 500;
                    letter-spacing: 0.12em;
                    text-transform: uppercase;
                    color: var(--primary);
                    text-decoration: none;
                    padding: 0.6rem 1.8rem;
                    border: 1px solid rgba(0, 0, 0, 0.06);
                    border-radius: 40px;
                    transition: 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                }

                .back-to-top:hover {
                    background: var(--primary);
                    color: #fff;
                    border-color: var(--primary);
                    transform: translateY(-3px);
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
                }

                /* ============================================================
                   RESPONSIVE
                ============================================================ */
                @media (max-width: 768px) {
                    .section-spacer {
                        padding: 50px 0;
                    }

                    .terms-content .terms-block h3 {
                        font-size: 1.3rem;
                    }

                    .terms-content .terms-block p {
                        font-size: 0.9rem;
                    }

                    .terms-content .terms-block ul li {
                        font-size: 0.9rem;
                    }

                    .terms-content .terms-block .block-number {
                        font-size: 1.4rem;
                    }
                }

                @media (max-width: 576px) {
                    .terms-hero .hero-content h1 {
                        font-size: 2rem;
                    }

                    .terms-content .terms-block h3 {
                        font-size: 1.1rem;
                    }

                    .terms-content .terms-block ul li {
                        padding-left: 1.5rem;
                        font-size: 0.85rem;
                    }

                    .back-to-top {
                        font-size: 0.65rem;
                        padding: 0.5rem 1.4rem;
                    }
                }
            </style>
        </head>

        <body>

            <!-- ============================================================
            TERMS HERO
            ============================================================ -->
            <section class="terms-hero">
                <div class="hero-bg"></div>
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <span class="hero-label">✦ Legal</span>
                    <h1>Terms & Conditions</h1>
                    <p class="hero-sub">Our commitment to transparency and fairness</p>
                </div>
            </section>

            <!-- ============================================================
            TERMS CONTENT
            ============================================================ -->
            <section class="section-spacer">
                <div class="container">
                    <div class="terms-content" data-aos="fade-up">

                        <!-- Last Updated -->
                        <div class="last-updated">
                            <i class="bi bi-clock" style="margin-right:6px;"></i> Last Updated: <span>September 2026</span>
                        </div>

                        <!-- 1. General Information -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="50">
                            <span class="block-number">01</span>
                            <h3>General Information</h3>
                            <div class="gold-divider"></div>
                            <p>Velenza is an online women’s wear brand specializing in embroidered fashion. All products displayed on our website are subject to availability. We reserve the right to update, modify, or discontinue any product or service without prior notice.</p>
                        </div>

                        <!-- 2. Product Information -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="100">
                            <span class="block-number">02</span>
                            <h3>Product Information</h3>
                            <div class="gold-divider"></div>
                            <p>We strive to display product colors, designs, and details as accurately as possible. Slight variations in color, embroidery, or fabric may occur due to lighting, photography, or screen settings. All product descriptions, prices, and availability are subject to change without notice.</p>
                        </div>

                        <!-- 3. Orders -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="150">
                            <span class="block-number">03</span>
                            <h3>Orders</h3>
                            <div class="gold-divider"></div>
                            <p>Placing an order confirms your agreement to purchase the selected items. We reserve the right to cancel or refuse any order due to:</p>
                            <ul>
                                <li>Stock unavailability</li>
                                <li>Pricing errors</li>
                                <li>Suspicious or fraudulent activity</li>
                            </ul>
                            <p>Order confirmation will be sent via email, SMS, or WhatsApp.</p>
                        </div>

                        <!-- 4. Pricing & Payment -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="200">
                            <span class="block-number">04</span>
                            <h3>Pricing &amp; Payment</h3>
                            <div class="gold-divider"></div>
                            <p>All prices are listed in PKR (Pakistani Rupees) unless stated otherwise. We accept multiple payment methods including:</p>
                            <ul>
                                <li>Cash on Delivery (COD)</li>
                                <li>Bank Transfer</li>
                                <li>Online Payment Gateways</li>
                            </ul>
                            <p>Full payment must be completed before order dispatch (except COD orders).</p>
                        </div>

                        <!-- 5. Shipping & Delivery -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="250">
                            <span class="block-number">05</span>
                            <h3>Shipping &amp; Delivery</h3>
                            <div class="gold-divider"></div>
                            <p>We deliver across Pakistan and selected international locations. Delivery time may vary depending on location and product availability. Standard delivery time: 3–7 working days (may vary during sales or peak seasons). Delays caused by courier services are beyond our control.</p>
                        </div>

                        <!-- 6. Exchange & Return -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="300">
                            <span class="block-number">06</span>
                            <h3>Exchange &amp; Return Policy</h3>
                            <div class="gold-divider"></div>
                            <p>Exchanges are allowed only in case of:</p>
                            <ul>
                                <li>Wrong size delivered</li>
                                <li>Defective or damaged product</li>
                            </ul>
                            <p>Exchange requests must be made within 3 days of receiving the order. Items must be unused, unwashed, and in original packaging. Sale items and customized orders are non‑exchangeable and non‑refundable.</p>
                        </div>

                        <!-- 7. Cancellation -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="350">
                            <span class="block-number">07</span>
                            <h3>Cancellation Policy</h3>
                            <div class="gold-divider"></div>
                            <p>Orders can only be cancelled before dispatch. Once an order is shipped, it cannot be cancelled.</p>
                        </div>

                        <!-- 8. Intellectual Property -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="400">
                            <span class="block-number">08</span>
                            <h3>Intellectual Property</h3>
                            <div class="gold-divider"></div>
                            <p>All content on the Velenza website, including images, designs, logos, and text, is the property of Velenza by Saqib Textile. Unauthorized use, copying, or reproduction is strictly prohibited.</p>
                        </div>

                        <!-- 9. Customer Responsibilities -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="450">
                            <span class="block-number">09</span>
                            <h3>Customer Responsibilities</h3>
                            <div class="gold-divider"></div>
                            <p>Customers must provide accurate shipping and contact information. Velenza is not responsible for delays or losses due to incorrect details provided by the customer.</p>
                        </div>

                        <!-- 10. Privacy Policy -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="500">
                            <span class="block-number">10</span>
                            <h3>Privacy Policy</h3>
                            <div class="gold-divider"></div>
                            <p>We respect your privacy and protect your personal information. Customer data is used only for order processing, delivery, and customer support. We do not sell or share personal information with third parties without consent.</p>
                        </div>

                        <!-- 11. Limitation of Liability -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="550">
                            <span class="block-number">11</span>
                            <h3>Limitation of Liability</h3>
                            <div class="gold-divider"></div>
                            <p>Velenza is not responsible for any indirect, incidental, or consequential damages arising from the use of our products or services. Our liability is limited to the value of the purchased product.</p>
                        </div>

                        <!-- 12. Changes to Terms -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="600">
                            <span class="block-number">12</span>
                            <h3>Changes to Terms</h3>
                            <div class="gold-divider"></div>
                            <p>Velenza reserves the right to update these Terms &amp; Conditions at any time. Continued use of our website means you accept the updated terms.</p>
                        </div>

                        <!-- 13. Contact Us -->
                        <div class="terms-block" data-aos="fade-up" data-aos-delay="650">
                            <span class="block-number">13</span>
                            <h3>Contact Us</h3>
                            <div class="gold-divider"></div>
                            <p>For any queries or support, please contact:</p>
                            <ul>
                                <li><strong>Velenza by Saqib Textile</strong></li>
                                <li><strong>Email:</strong> info@velenza.pk</li>
                                <li><strong>Phone/WhatsApp:</strong> +92-XXX-XXXXXXX</li>
                                <li><strong>Website:</strong> www.velenza.pk</li>
                            </ul>
                            <p style="margin-top:1rem; font-family:var(--font-heading); font-size:1.2rem; color:var(--gold);">PERFECTLY YOURS</p>
                        </div>

                        <!-- Back to Top -->
                        <div class="text-center mt-5" data-aos="fade-up">
                            <a href="#" class="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'}); return false;">
                                <i class="fas fa-arrow-up"></i> Back to Top
                            </a>
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
                    easing: 'ease-out-cubic',
                    offset: 30
                });
            </script>
        </body>

        </html>
    </div>
</x-layouts.app>