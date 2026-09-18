<x-layouts.app>
    <div>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>VELENZA · Contact</title>

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
           CONTACT HERO - Cinematic Banner
        ============================================================ */
                .contact-hero {
                    height: 60vh;
                    min-height: 400px;
                    position: relative;
                    overflow: hidden;
                    background: var(--primary);
                }

                .contact-hero .hero-bg {
                    position: absolute;
                    inset: 0;
                    background: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1600&auto=format&fit=crop&q=80') center 30% / cover no-repeat;
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

                .contact-hero .hero-overlay {
                    position: absolute;
                    inset: 0;
                    background: linear-gradient(135deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.2) 60%);
                }

                .contact-hero .hero-content {
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

                .contact-hero .hero-content .hero-label {
                    font-family: var(--font-body);
                    font-size: 0.7rem;
                    letter-spacing: 0.35em;
                    text-transform: uppercase;
                    color: var(--gold);
                    margin-bottom: 1rem;
                    opacity: 0.8;
                }

                .contact-hero .hero-content h1 {
                    font-family: var(--font-heading);
                    font-size: clamp(2.8rem, 7vw, 5rem);
                    font-weight: 300;
                    letter-spacing: 0.06em;
                    line-height: 1.05;
                    animation: fadeUp 1.2s ease 0.5s forwards;
                    opacity: 0;
                    transform: translateY(30px);
                }

                .contact-hero .hero-content .hero-sub {
                    font-family: var(--font-body);
                    font-size: 1.05rem;
                    font-weight: 300;
                    max-width: 500px;
                    opacity: 0.7;
                    margin-top: 1rem;
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
                }

                .scroll-indicator i {
                    font-size: 1rem;
                }

                @keyframes floatDown {
                    0% {
                        transform: translateX(-50%) translateY(0);
                        opacity: 0.3;
                    }

                    50% {
                        transform: translateX(-50%) translateY(8px);
                        opacity: 0.8;
                    }

                    100% {
                        transform: translateX(-50%) translateY(0);
                        opacity: 0.3;
                    }
                }

                @media (max-width: 768px) {
                    .contact-hero {
                        height: 50vh;
                        min-height: 350px;
                    }

                    .contact-hero .hero-content h1 {
                        font-size: 2.4rem;
                    }

                    .contact-hero .hero-content .hero-sub {
                        font-size: 0.9rem;
                    }
                }

                /* ============================================================
           SECTION SPACING
        ============================================================ */
                .section-spacer {
                    padding: 100px 0;
                }

                .section-spacer-sm {
                    padding: 60px 0;
                }

                /* ============================================================
           CONTACT INFO CARDS - Premium
        ============================================================ */
                .contact-info-section {
                    background: #fff;
                }

                .contact-info-card {
                    background: #fff;
                    border: 1px solid rgba(0, 0, 0, 0.04);
                    border-radius: 20px;
                    padding: 2.5rem 1.5rem;
                    text-align: center;
                    height: 100%;
                    transition: 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                    position: relative;
                    overflow: hidden;
                }

                .contact-info-card::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 3px;
                    background: var(--gold);
                    transform: scaleX(0);
                    transform-origin: center;
                    transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                }

                .contact-info-card:hover::before {
                    transform: scaleX(1);
                }

                .contact-info-card:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.04);
                    border-color: rgba(201, 162, 39, 0.1);
                }

                .contact-info-card .icon-wrapper {
                    width: 64px;
                    height: 64px;
                    border-radius: 50%;
                    background: rgba(201, 162, 39, 0.06);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 1rem;
                    transition: 0.3s;
                }

                .contact-info-card:hover .icon-wrapper {
                    background: rgba(201, 162, 39, 0.12);
                    transform: scale(1.05);
                }

                .contact-info-card .icon-wrapper i {
                    font-size: 1.8rem;
                    color: var(--gold);
                }

                .contact-info-card h5 {
                    font-family: var(--font-body);
                    font-weight: 500;
                    font-size: 1rem;
                    letter-spacing: 0.05em;
                    color: var(--primary);
                    margin-bottom: 0.2rem;
                }

                .contact-info-card .info-detail {
                    font-family: var(--font-body);
                    font-size: 0.95rem;
                    font-weight: 300;
                    color: #666;
                    margin: 0;
                }

                .contact-info-card .info-detail a {
                    color: #666;
                    text-decoration: none;
                    transition: 0.2s;
                }

                .contact-info-card .info-detail a:hover {
                    color: var(--gold);
                }

                .contact-info-card .info-label {
                    font-family: var(--font-body);
                    font-size: 0.65rem;
                    font-weight: 300;
                    letter-spacing: 0.12em;
                    text-transform: uppercase;
                    color: #bbb;
                    margin-top: 0.3rem;
                }

                /* ============================================================
           CONTACT FORM - Premium Design
        ============================================================ */
                .contact-form-section {
                    background: var(--beige);
                }

                .contact-form-wrapper {
                    background: #fff;
                    border-radius: 24px;
                    padding: 3.5rem;
                    box-shadow: 0 4px 40px rgba(0, 0, 0, 0.02);
                }

                .contact-form-wrapper .form-header {
                    margin-bottom: 2rem;
                }

                .contact-form-wrapper .form-header .form-label-text {
                    font-family: var(--font-heading);
                    font-size: 2rem;
                    font-weight: 300;
                    letter-spacing: 0.04em;
                    margin-bottom: 0.3rem;
                }

                .contact-form-wrapper .form-header p {
                    font-family: var(--font-body);
                    font-size: 0.95rem;
                    font-weight: 300;
                    color: #888;
                }

                .contact-form-wrapper .form-control {
                    border: 1px solid #e5e5e5;
                    border-radius: 12px;
                    padding: 0.9rem 1.2rem;
                    font-family: var(--font-body);
                    font-size: 0.9rem;
                    transition: 0.3s;
                    background: var(--bg-light);
                }

                .contact-form-wrapper .form-control:focus {
                    border-color: var(--gold);
                    box-shadow: 0 0 0 4px rgba(201, 162, 39, 0.06);
                    background: #fff;
                }

                .contact-form-wrapper .form-control::placeholder {
                    color: #bbb;
                    font-weight: 300;
                }

                .contact-form-wrapper .form-label {
                    font-family: var(--font-body);
                    font-size: 0.75rem;
                    font-weight: 500;
                    letter-spacing: 0.05em;
                    color: #333;
                }

                .contact-form-wrapper textarea.form-control {
                    resize: vertical;
                    min-height: 120px;
                }

                .btn-submit {
                    background: var(--primary);
                    color: #fff;
                    border: none;
                    padding: 0.9rem 3rem;
                    border-radius: 60px;
                    font-family: var(--font-body);
                    font-size: 0.75rem;
                    font-weight: 500;
                    letter-spacing: 0.15em;
                    text-transform: uppercase;
                    transition: 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                    cursor: pointer;
                    width: 100%;
                }

                .btn-submit:hover {
                    background: var(--gold);
                    transform: translateY(-3px);
                    box-shadow: 0 12px 40px rgba(201, 162, 39, 0.15);
                }

                .btn-submit i {
                    margin-right: 8px;
                }

                /* ============================================================
           MAP / STUDIO SECTION
        ============================================================ */
                .studio-section {
                    background: #fff;
                }

                .studio-card {
                    border-radius: 20px;
                    overflow: hidden;
                    background: var(--bg-light);
                    padding: 2.5rem;
                    height: 90%;
                    border: 1px solid rgba(0, 0, 0, 0.03);
                    transition: 0.3s;
                }

                .studio-card:hover {
                    border-color: rgba(201, 162, 39, 0.1);
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.02);
                }

                .studio-card .studio-icon {
                    font-size: 2rem;
                    color: var(--gold);
                    margin-bottom: 1rem;
                }

                .studio-card h5 {
                    font-family: var(--font-body);
                    font-weight: 500;
                    font-size: 1rem;
                    letter-spacing: 0.05em;
                    margin-bottom: 0.3rem;
                }

                .studio-card p {
                    font-family: var(--font-body);
                    font-size: 0.9rem;
                    font-weight: 300;
                    color: #888;
                    margin: 0;
                    line-height: 1.7;
                }

                .studio-card .studio-hours {
                    font-family: var(--font-body);
                    font-size: 0.8rem;
                    font-weight: 300;
                    color: #999;
                    margin-top: 0.5rem;
                    padding-top: 0.5rem;
                    border-top: 1px solid rgba(0, 0, 0, 0.04);
                }

                .studio-card .studio-hours span {
                    color: var(--gold);
                }

                /* ============================================================
           SOCIAL CONNECT - LEFT ALIGNED
        ============================================================ */
                .social-connect-section {
                    background: #fff;
                    padding: 80px 0;
                }

                .social-connect-content {
                    max-width: 600px;
                }

                .social-connect-content .section-sub {
                    margin-bottom: 0.5rem;
                }

                .social-connect-content .section-title {
                    font-size: clamp(2rem, 3.5vw, 3rem);
                    font-weight: 300;
                    letter-spacing: 0.04em;
                    margin-bottom: 0.5rem;
                }

                .social-connect-content .social-description {
                    font-family: var(--font-body);
                    font-size: 0.95rem;
                    font-weight: 300;
                    color: #888;
                    max-width: 460px;
                    margin-bottom: 1.5rem;
                    line-height: 1.7;
                }

                .social-connect-content .social-icons-wrapper {
                    display: flex;
                    gap: 12px;
                    flex-wrap: wrap;
                }

                .social-connect-content .social-icon-circle {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 56px;
                    height: 56px;
                    border-radius: 50%;
                    border: 1px solid rgba(0, 0, 0, 0.04);
                    color: #333;
                    font-size: 1.4rem;
                    transition: 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                    text-decoration: none;
                }

                .social-connect-content .social-icon-circle:hover {
                    background: var(--gold);
                    color: #fff;
                    border-color: var(--gold);
                    transform: translateY(-4px);
                    box-shadow: 0 8px 24px rgba(201, 162, 39, 0.15);
                }

                /* Gold divider line */
                .gold-divider {
                    width: 60px;
                    height: 2px;
                    background: var(--gold);
                    margin-bottom: 1.5rem;
                    opacity: 0.3;
                }

                /* ============================================================
           RESPONSIVE
        ============================================================ */
                @media (max-width: 992px) {
                    .contact-form-wrapper {
                        padding: 2rem;
                    }

                    .social-connect-content {
                        max-width: 100%;
                        text-align: center;
                    }

                    .social-connect-content .social-icons-wrapper {
                        justify-content: center;
                    }

                    .gold-divider {
                        margin-left: auto;
                        margin-right: auto;
                    }

                    .social-connect-content .social-description {
                        margin-left: auto;
                        margin-right: auto;
                    }
                }

                @media (max-width: 768px) {
                    .section-spacer {
                        padding: 60px 0;
                    }

                    .contact-form-wrapper {
                        padding: 1.5rem;
                    }

                    .contact-form-wrapper .form-header .form-label-text {
                        font-size: 1.6rem;
                    }

                    .studio-card {
                        padding: 1.8rem;
                    }

                    .contact-info-card {
                        padding: 1.8rem 1.2rem;
                    }

                    .social-connect-section {
                        padding: 50px 0;
                    }

                    .social-connect-content .social-icon-circle {
                        width: 48px;
                        height: 48px;
                        font-size: 1.2rem;
                    }
                }

                @media (max-width: 576px) {
                    .contact-hero .hero-content h1 {
                        font-size: 2rem;
                    }

                    .btn-submit {
                        padding: 0.8rem 2rem;
                        font-size: 0.7rem;
                    }

                    .social-connect-content .section-title {
                        font-size: 1.8rem;
                    }

                    .social-connect-content .social-icon-circle {
                        width: 44px;
                        height: 44px;
                        font-size: 1.1rem;
                    }
                }
            </style>
        </head>

        <body>

            <!-- ============================================================
    CONTACT HERO - Cinematic Banner
    ============================================================ -->
            <section class="contact-hero">
                <div class="hero-bg"></div>
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <span class="hero-label">✦ Get in Touch</span>
                    <h1>Let's Connect</h1>
                    <p class="hero-sub">We'd love to hear from you — reach out and let's create something beautiful together.
                    </p>
                </div>
                <div class="scroll-indicator">
                    <span>Scroll</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
            </section>

            <!-- ============================================================
    CONTACT INFO - Premium Cards
    ============================================================ -->
            <section class="section-spacer-sm contact-info-section">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="50">
                            <div class="contact-info-card">
                                <div class="icon-wrapper">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h5>Email</h5>
                                <p class="info-detail"><a href="mailto:studio@velenza.com">studio@velenza.com</a></p>
                                <span class="info-label">We respond within 24 hours</span>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="contact-info-card">
                                <div class="icon-wrapper">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <h5>Phone</h5>
                                <p class="info-detail"><a href="tel:+923001234567">+92 300 1234567</a></p>
                                <span class="info-label">Mon–Fri, 10am – 7pm</span>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="150">
                            <div class="contact-info-card">
                                <div class="icon-wrapper">
                                    <i class="fas fa-location-dot"></i>
                                </div>
                                <h5>Studio</h5>
                                <p class="info-detail">Lahore, Pakistan</p>
                                <span class="info-label">Visit us by appointment</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================
    CONTACT FORM + STUDIO INFO (2-column layout)
    ============================================================ -->
            <section class="section-spacer contact-form-section">
                <div class="container">
                    <div class="row g-4">
                        <!-- Form Column -->
                        <div class="col-lg-7" data-aos="fade-right" data-aos-duration="800">
                            <div class="contact-form-wrapper">
                                <div class="form-header">
                                    <h2 class="form-label-text">Send a Message</h2>
                                    <p>We'll get back to you as soon as possible.</p>
                                </div>
                                <form>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" placeholder="Your name" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" placeholder="you@example.com" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Subject</label>
                                            <input type="text" class="form-control" placeholder="How can we help?" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control" rows="5" placeholder="Tell us more..."></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn-submit">
                                                <i class="fas fa-paper-plane"></i> Send Message
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Studio Info Column -->
                        <div class="col-lg-5" data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">
                            <div class="studio-card">
                                <div class="studio-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <h5>VELENZA Atelier</h5>
                                <p>
                                    Our studio is a space where creativity meets craftsmanship.
                                    We welcome visitors by appointment to experience our collections
                                    in an intimate, personalized setting.
                                </p>
                                <div class="studio-hours">
                                    <span>✦</span> Studio Hours: Mon–Fri, 10am – 7pm<br />
                                    <span>✦</span> Saturday: 11am – 5pm<br />
                                    <span>✦</span> Sunday: Closed
                                </div>
                                <div style="margin-top:1.2rem;">
                                    <a href="#"
                                        style="font-family:var(--font-body);font-size:0.8rem;font-weight:500;letter-spacing:0.08em;text-transform:uppercase;color:var(--gold);text-decoration:none;border-bottom:1px solid var(--gold);padding-bottom:2px;">
                                        Book an Appointment →
                                    </a>
                                </div>
                            </div>

                            <!-- Quick Connect -->
                            <div class="studio-card" style="margin-top:1.2rem;">
                                <div class="studio-icon">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <h5>Quick Support</h5>
                                <p>
                                    Need immediate assistance? Reach us via WhatsApp for
                                    real-time support.
                                </p>
                                <div style="margin-top:0.8rem;">
                                    <a href="#"
                                        style="font-family:var(--font-body);font-size:0.85rem;font-weight:500;color:var(--primary);text-decoration:none;background:rgba(37,211,102,0.08);padding:0.4rem 1.2rem;border-radius:40px;display:inline-block;transition:0.3s;">
                                        <i class="fab fa-whatsapp" style="color:#25D366;margin-right:6px;"></i> Chat Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================
    SOCIAL CONNECT - LEFT ALIGNED (Full Width)
    ============================================================ -->
            <section class="social-connect-section">
                <div class="container">
                    <div class="social-connect-content" data-aos="fade-right" data-aos-duration="800">
                        <span class="section-sub">Connect With Us</span>
                        <h2 class="section-title">Follow the Journey</h2>
                        <div class="gold-divider"></div>
                        <p class="social-description">
                            Stay inspired — follow us for behind-the-scenes, new collections, and style stories.
                        </p>
                        <div class="social-icons-wrapper">
                            <a href="#" class="social-icon-circle"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon-circle"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon-circle"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#" class="social-icon-circle"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="social-icon-circle"><i class="fab fa-tiktok"></i></a>
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
                    offset: 40
                });
            </script>
        </body>

        </html>
    </div>
</x-layouts.app>