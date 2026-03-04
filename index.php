<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/system/php/routing/Page.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Floristería Delirios - Arreglos Florales con Entrega a Domicilio</title>
    <meta content="Floristería Delirios: arreglos florales, bouquets, cajas florales y fruteros con entrega a domicilio. Diseños únicos para cumpleaños, aniversarios, amor y condolencias." name="description">
    <meta content="floristería, arreglos florales, bouquets, cajas de rosas, fruteros, girasoles, jarrones, entrega a domicilio, flores" name="keywords">

    <!-- SEO avanzado -->
    <meta name="author" content="Floristería Delirios">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://floristeriadelirios.com/">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://floristeriadelirios.com/">
    <meta property="og:title" content="Floristería Delirios - Arreglos Florales con Entrega a Domicilio">
    <meta property="og:description" content="Diseños florales únicos para cada ocasión especial. Bouquets, cajas, arreglos en base, fruteros y más. Entregas oportunas y confiables.">
    <meta property="og:locale" content="es_CO">
    <meta property="og:site_name" content="Floristería Delirios">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Floristería Delirios - Arreglos Florales con Entrega a Domicilio">
    <meta name="twitter:description" content="Flores frescas, diseños únicos y entregas confiables para cada ocasión especial.">

    <!-- Schema.org -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Florist",
            "name": "Floristería Delirios",
            "url": "https://floristeriadelirios.com",
            "description": "Floristería online dedicada a diseñar y entregar arreglos florales para cumpleaños, aniversarios, momentos románticos y condolencias.",
            "openingHours": "Mo-Sa 07:30-17:00",
            "contactPoint": {
                "@type": "ContactPoint",
                "contactType": "customer service",
                "availableLanguage": "Spanish"
            }
        }
    </script>

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Delirios Custom Styles -->
    <link href="assets/css/landpage/delirios.css" rel="stylesheet">
    <link href="assets/css/landpage/footer.css" rel="stylesheet">
    <link href="assets/css/landpage/header.css" rel="stylesheet">
    <link href="assets/css/landpage/backToTopButton.css" rel="stylesheet">
</head>

<body>

<!-- ======= Top Bar ======= -->
<div id="top-bar">
    <a href="https://wa.me/573204663245" target="_blank" rel="noopener"><i class="bx bxl-whatsapp"></i>320 466 3245</a>
    <a href="mailto:info@deliriosfloristeria.com"><i class="bx bx-envelope"></i>info@deliriosfloristeria.com</a>
    <span><i class="bx bx-time-five"></i>Lunes a Sábado: 7:30 AM – 5:00 PM</span>
</div>

<!-- ======= Header ======= -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/system/assets/html/landpage/header-page.php'; ?>

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                <span class="hero-badge"><i class="bi bi-flower1 me-1"></i> Floristería online · Entrega a domicilio</span>
                <h1>Flores que expresan<br><em>lo que sientes</em></h1>
                <h2>Arreglos florales únicos para cumpleaños, aniversarios, momentos románticos y condolencias. Diseñados con amor, entregados a tiempo.</h2>
                <div class="d-flex flex-wrap align-items-center" style="gap:12px;">
                    <a href="#productos" class="btn-delirios btn-primary-del">Ver Catálogo</a>
                    <a href="https://wa.me/573204663245?text=Hola%20Delirios%2C%20quiero%20hacer%20un%20pedido" target="_blank" class="btn-delirios btn-secondary-del"><i class="bx bxl-whatsapp me-1"></i>Pedir por WhatsApp</a>
                </div>
                <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                    <div class="hero-stat">
                        <span class="stat-number">10+</span>
                        <span class="stat-label">Años creando sonrisas</span>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat">
                        <span class="stat-number">5.0k+</span>
                        <span class="stat-label">Clientes felices</span>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Frescura garantizada</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="zoom-in" data-aos-delay="200">
                <div class="hero-illustration">
                    <!-- Ilustración SVG: ramo de flores abstracto -->
                    <svg class="petal-svg" viewBox="0 0 420 420" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Tallo principal -->
                        <path d="M210 380 Q200 300 190 240 Q185 200 210 170" stroke="#4A6741" stroke-width="4" stroke-linecap="round" fill="none"/>
                        <path d="M210 380 Q220 300 225 240 Q230 200 210 170" stroke="#6D9164" stroke-width="3" stroke-linecap="round" fill="none" opacity="0.6"/>
                        <!-- Hojas -->
                        <path d="M195 290 Q170 270 165 245 Q185 255 195 280 Z" fill="#4A6741" opacity="0.7"/>
                        <path d="M220 310 Q248 288 255 263 Q234 275 222 298 Z" fill="#6D9164" opacity="0.7"/>
                        <path d="M192 250 Q165 225 168 198 Q188 212 196 240 Z" fill="#4A6741" opacity="0.5"/>
                        <!-- Rosa central grande -->
                        <circle cx="210" cy="155" r="42" fill="url(#pinkGrad)" opacity="0.9"/>
                        <ellipse cx="196" cy="142" rx="18" ry="22" fill="url(#pinkGrad2)" transform="rotate(-20 196 142)"/>
                        <ellipse cx="226" cy="140" rx="18" ry="22" fill="url(#pinkGrad2)" transform="rotate(20 226 140)"/>
                        <ellipse cx="210" cy="128" rx="16" ry="20" fill="url(#pinkGrad3)"/>
                        <circle cx="210" cy="148" r="14" fill="#E8A0B4"/>
                        <circle cx="210" cy="148" r="8" fill="#D4708A"/>
                        <!-- Girasol izquierda -->
                        <g transform="translate(130, 200)">
                            <circle cx="0" cy="0" r="18" fill="#F0B429"/>
                            <!-- pétalos girasol -->
                            <ellipse cx="0" cy="-26" rx="7" ry="14" fill="#F7CC50" transform="rotate(0)"/>
                            <ellipse cx="0" cy="-26" rx="7" ry="14" fill="#F7CC50" transform="rotate(45)"/>
                            <ellipse cx="0" cy="-26" rx="7" ry="14" fill="#F7CC50" transform="rotate(90)"/>
                            <ellipse cx="0" cy="-26" rx="7" ry="14" fill="#F7CC50" transform="rotate(135)"/>
                            <ellipse cx="0" cy="-26" rx="7" ry="14" fill="#F7CC50" transform="rotate(180)"/>
                            <ellipse cx="0" cy="-26" rx="7" ry="14" fill="#F7CC50" transform="rotate(225)"/>
                            <ellipse cx="0" cy="-26" rx="7" ry="14" fill="#F7CC50" transform="rotate(270)"/>
                            <ellipse cx="0" cy="-26" rx="7" ry="14" fill="#F7CC50" transform="rotate(315)"/>
                            <circle cx="0" cy="0" r="12" fill="#7C5E2A"/>
                            <circle cx="0" cy="0" r="7" fill="#5A3E18"/>
                        </g>
                        <!-- Flor lila derecha -->
                        <g transform="translate(292, 210)">
                            <ellipse cx="0" cy="-22" rx="10" ry="16" fill="url(#lilaGrad)" transform="rotate(0)"/>
                            <ellipse cx="0" cy="-22" rx="10" ry="16" fill="url(#lilaGrad)" transform="rotate(60)"/>
                            <ellipse cx="0" cy="-22" rx="10" ry="16" fill="url(#lilaGrad)" transform="rotate(120)"/>
                            <ellipse cx="0" cy="-22" rx="10" ry="16" fill="url(#lilaGrad)" transform="rotate(180)"/>
                            <ellipse cx="0" cy="-22" rx="10" ry="16" fill="url(#lilaGrad)" transform="rotate(240)"/>
                            <ellipse cx="0" cy="-22" rx="10" ry="16" fill="url(#lilaGrad)" transform="rotate(300)"/>
                            <circle cx="0" cy="0" r="10" fill="#F7E8FF"/>
                            <circle cx="0" cy="0" r="5" fill="#D4A0E8"/>
                        </g>
                        <!-- Pequeños detalles flotantes -->
                        <circle cx="160" cy="130" r="5" fill="var(--lavanda)" opacity="0.4">
                            <animate attributeName="cy" values="130;110;130" dur="4s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.4;0.7;0.4" dur="4s" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="270" cy="140" r="4" fill="#F0B429" opacity="0.5">
                            <animate attributeName="cy" values="140;120;140" dur="3s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.5;0.8;0.5" dur="3s" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="240" cy="95" r="3" fill="#E8A0B4" opacity="0.6">
                            <animate attributeName="cy" values="95;75;95" dur="5s" repeatCount="indefinite"/>
                        </circle>
                        <path d="M50 50 Q70 20 90 50 T130 50" stroke="var(--lavanda)" stroke-width="2" fill="none" opacity="0.2">
                            <animateTransform attributeName="transform" type="translate" from="-20 0" to="20 0" dur="10s" repeatCount="indefinite"/>
                        </path>
                        <!-- Gradientes -->
                        <defs>
                            <radialGradient id="pinkGrad" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#F2B8CC"/>
                                <stop offset="100%" stop-color="#D4708A"/>
                            </radialGradient>
                            <radialGradient id="pinkGrad2" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#F9D0DF"/>
                                <stop offset="100%" stop-color="#E8A0B4"/>
                            </radialGradient>
                            <radialGradient id="pinkGrad3" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#fff"/>
                                <stop offset="100%" stop-color="#F2B8CC"/>
                            </radialGradient>
                            <linearGradient id="lilaGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#C9A8E0"/>
                                <stop offset="100%" stop-color="#A78BB4"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->

<!-- ======= Horario Banner ======= -->
<div class="horario-banner">
    <i class="bi bi-clock-history me-1"></i> <strong>Pedidos con entrega el mismo día</strong> · Lunes a Sábado de 7:30 AM a 5:00 PM · ¡Sorprende hoy mismo!
</div>

<main id="main">

    <!-- ======= Categorías ======= -->
    <section id="categorias">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <h2>Nuestras Categorías</h2>
                <div class="separator mx-auto"></div>
                <p class="mt-3">Encuentra el arreglo perfecto para cada ocasión</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <a href="/categoria/bouquets" class="text-decoration-none">
                        <div class="cat-card">
                            <div class="cat-icon" style="background: rgba(167, 139, 180, 0.1); color: var(--lavanda-dark);"><i class="bx bx-leaf"></i></div>
                            <h4>Bouquets y Ramilletes</h4>
                            <p>Rosas, girasoles y más. Desde $79.900</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <a href="/categoria/arreglos-en-base" class="text-decoration-none">
                        <div class="cat-card">
                            <div class="cat-icon" style="background: rgba(74, 103, 65, 0.1); color: var(--verde);"><i class="bx bx-gift"></i></div>
                            <h4>Arreglos en Base</h4>
                            <p>Composiciones rústicas. Desde $139.900</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <a href="/categoria/cajas-florales" class="text-decoration-none">
                        <div class="cat-card">
                            <div class="cat-icon" style="background: rgba(220, 53, 69, 0.1); color: #dc3545;"><i class="bx bx-package"></i></div>
                            <h4>Cajas Florales</h4>
                            <p>Corazones y redondas. Desde $89.900</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <a href="/categoria/fruteros" class="text-decoration-none">
                        <div class="cat-card">
                            <div class="cat-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;"><i class="bx bx-food-menu"></i></div>
                            <h4>Arreglos con Frutas</h4>
                            <p>Flores y frescura. Desde $174.900</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <a href="/categoria/jarrones" class="text-decoration-none">
                        <div class="cat-card">
                            <div class="cat-icon" style="background: rgba(13, 202, 240, 0.1); color: #0dcaf0;"><i class="bx bx-vial"></i></div>
                            <h4>Jarrones Elegantes</h4>
                            <p>Cristal y elegancia. Desde $86.900</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <a href="/categoria/girasoles" class="text-decoration-none">
                        <div class="cat-card">
                            <div class="cat-icon" style="background: rgba(240, 180, 41, 0.1); color: #F0B429;"><i class="bx bxs-sun"></i></div>
                            <h4>Girasoles Radiantes</h4>
                            <p>Alegría en casa. Desde $184.900</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <a href="/categoria/funebres" class="text-decoration-none">
                        <div class="cat-card">
                            <div class="cat-icon" style="background: rgba(107, 107, 107, 0.1); color: #6B6B6B;"><i class="bx bx-dove"></i></div>
                            <h4>Tributos Florales</h4>
                            <p>Respeto y dignidad. Desde $154.900</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <a href="/categoria/adicionales" class="text-decoration-none">
                        <div class="cat-card">
                            <div class="cat-icon" style="background: rgba(167, 139, 180, 0.1); color: var(--lavanda-dark);"><i class="bx bx-plus-circle"></i></div>
                            <h4>Detalles Extras</h4>
                            <p>Chocolates y globos. Desde $20.900</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section><!-- End Categorías -->

    <!-- ======= Ocasiones Section ======= -->
    <section id="ocasiones">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <h2>Celebraciones más Destacadas</h2>
                <div class="separator mx-auto"></div>
                <p class="mt-3">El regalo perfecto para cada momento especial</p>
            </div>
            <div class="text-center">
                <a href="/celebracion/cumpleanos" class="occasion-pill"><i class="bx bx-cake"></i>Cumpleaños</a>
                <a href="/celebracion/aniversario" class="occasion-pill"><i class="bx bx-heart"></i>Aniversario</a>
                <a href="/celebracion/dia-de-la-madre" class="occasion-pill"><i class="bi bi-heart-fill"></i> Día de la Madre</a>
                <a href="/celebracion/dia-de-la-mujer" class="occasion-pill"><i class="bi bi-flower1"></i> Día de la Mujer</a>
                <a href="/celebracion/san-valentin" class="occasion-pill"><i class="bi bi-heart-pulse"></i> San Valentín</a>
                <a href="/celebracion/amor-y-amistad" class="occasion-pill"><i class="bx bx-user-plus"></i>Amor y Amistad</a>
                <a href="/celebracion/nacimiento" class="occasion-pill"><i class="bi bi-brightness-high"></i> Nacimiento</a>
                <a href="/celebracion/grado" class="occasion-pill"><i class="bi bi-mortarboard"></i> Para su Grado</a>
                <a href="/celebracion/quince-anos" class="occasion-pill"><i class="bi bi-star"></i> 15 Años</a>
                <a href="/ocasion/condolencias" class="occasion-pill"><i class="bi bi-peace"></i> Condolencias</a>
                <a href="/ocasion/para-hombre" class="occasion-pill"><i class="bx bx-male"></i>Para Hombres</a>
                <a href="/ocasion/lo-siento" class="occasion-pill"><i class="bi bi-chat-heart"></i> Lo Siento</a>
            </div>
        </div>
    </section><!-- End Ocasiones -->

    <!-- ======= Productos Destacados ======= -->
    <section id="productos">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <h2>Productos Destacados</h2>
                <div class="separator mx-auto"></div>
                <p class="mt-3">Una selección de nuestros arreglos más solicitados</p>
            </div>
            <div class="row g-4">
                <!-- Producto 1 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="product-card">
                        <div class="product-img">
                            <i class="bi bi-flower1" style="color: #d63384;"></i>
                            <span class="product-badge">Popular</span>
                        </div>
                        <div class="product-body">
                            <h5>Bouquet de Rosas Encanto</h5>
                            <p>Rosas frescas en papel coreano · 12, 18, 24 o 36 rosas</p>
                            <div class="product-price">Desde $114.900 <span>COP</span></div>
                            <a href="https://wa.me/573204663245?text=Hola%2C%20quiero%20el%20Bouquet%20de%20Rosas%20Encanto" target="_blank" class="btn-pedido">
                                <i class="bx bxl-whatsapp"></i> Pedir
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Producto 2 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-card">
                        <div class="product-img">
                            <i class="bi bi-sun" style="color: #ffc107;"></i>
                            <span class="product-badge">Favorito</span>
                        </div>
                        <div class="product-body">
                            <h5>Arreglo de Girasoles y Globo</h5>
                            <p>13 girasoles · base de bambú · globo metalizado incluido</p>
                            <div class="product-price">$204.900 <span>COP</span></div>
                            <a href="https://wa.me/573204663245?text=Hola%2C%20quiero%20el%20Arreglo%20de%20Girasoles%20y%20Globo" target="_blank" class="btn-pedido">
                                <i class="bx bxl-whatsapp"></i> Pedir
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Producto 3 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="product-card">
                        <div class="product-img">
                            <i class="bi bi-gift" style="color: #0dcaf0;"></i>
                            <span class="product-badge">Especial</span>
                        </div>
                        <div class="product-body">
                            <h5>Caja Corazón Luminoso</h5>
                            <p>12 rosas rojas · 12 Ferrero Rocher · follajes frescos</p>
                            <div class="product-price">$214.900 <span>COP</span></div>
                            <a href="https://wa.me/573204663245?text=Hola%2C%20quiero%20la%20Caja%20Coraz%C3%B3n%20Luminoso" target="_blank" class="btn-pedido">
                                <i class="bx bxl-whatsapp"></i> Pedir
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Producto 4 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="product-card">
                        <div class="product-img">
                            <i class="bi bi-basket" style="color: #198754;"></i>
                        </div>
                        <div class="product-body">
                            <h5>Arreglo con Frutas Banquete</h5>
                            <p>Rosas, gerberas, lirios · frutas tropicales · vino + chocolates</p>
                            <div class="product-price">$324.900 <span>COP</span></div>
                            <a href="https://wa.me/573204663245?text=Hola%2C%20quiero%20el%20Arreglo%20con%20Frutas%20Banquete" target="_blank" class="btn-pedido">
                                <i class="bx bxl-whatsapp"></i> Pedir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="/catalogo" class="btn-delirios btn-primary-del">Ver Catálogo Completo</a>
            </div>
        </div>
    </section><!-- End Productos -->

    <!-- ======= Atributos / Diferenciales ======= -->
    <section id="atributos">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <h2>¿Por qué elegir Delirios?</h2>
                <div class="separator"></div>
                <p class="mt-3">5 años creando momentos inolvidables</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="attr-card">
                        <div class="attr-icon"><i class="bx bx-heart"></i></div>
                        <h4>Alto Valor Emocional</h4>
                        <p>Cada diseño está pensado para transmitir sentimientos únicos y crear recuerdos que perduran.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="attr-card">
                        <div class="attr-icon"><i class="bx bx-rocket"></i></div>
                        <h4>Entrega el Mismo Día</h4>
                        <p>Entregas confiables y oportunas. Sorprende con flores frescas hoy mismo, directo a la puerta.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="attr-card">
                        <div class="attr-icon"><i class="bx bx-star"></i></div>
                        <h4>Variedad en un Solo Lugar</h4>
                        <p>Flores, chocolates, vinos, globos y peluches. Todo lo que necesitas para el regalo perfecto.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="attr-card">
                        <div class="attr-icon"><i class="bx bx-user-check"></i></div>
                        <h4>Atención Personalizada</h4>
                        <p>Te acompañamos en cada paso. Atención cercana y personalizada para que tu regalo sea único.</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Atributos -->

    <!-- ======= Cómo Funciona ======= -->
    <section id="como-funciona">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <h2>¿Cómo hacer tu pedido?</h2>
                <div class="separator mx-auto"></div>
                <p class="mt-3">Fácil, rápido y con entrega a domicilio</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="step-card">
                        <span class="step-number">01</span>
                        <div class="step-icon"><i class="bx bx-search-alt"></i></div>
                        <h5>Elige tu arreglo</h5>
                        <p>Explora nuestro catálogo y selecciona el diseño ideal para la ocasión.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-card">
                        <span class="step-number">02</span>
                        <div class="step-icon"><i class="bx bxl-whatsapp"></i></div>
                        <h5>Contáctanos</h5>
                        <p>Escríbenos por WhatsApp o completa el formulario con los detalles de tu pedido.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-card">
                        <span class="step-number">03</span>
                        <div class="step-icon"><i class="bx bx-credit-card"></i></div>
                        <h5>Confirma y paga</h5>
                        <p>Recibe confirmación de tu pedido y realiza el pago de forma segura.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="step-card">
                        <span class="step-number">04</span>
                        <div class="step-icon"><i class="bx bx-happy-heart-eyes"></i></div>
                        <h5>¡Recibe y sorprende!</h5>
                        <p>Tu arreglo llega fresco, puntual y listo para regalar. ¡Garantizado!</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Cómo Funciona -->

    <!-- ======= Testimonios ======= -->
    <section id="testimonios">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <h2>Lo que dicen nuestros clientes</h2>
                <div class="separator mx-auto"></div>
            </div>
                <div class="row g-4 testimonials-slider swiper">
                    <div class="swiper-wrapper">
                        <div class="col-lg-4 col-md-6 swiper-slide" data-aos="fade-up" data-aos-delay="100">
                            <div class="testimonial-card">
                                <div class="stars">★★★★★</div>
                                <p>"El arreglo llegó puntual y estaba hermoso. Mi mamá no podía creer la calidad de las flores. ¡Totalmente recomendado!"</p>
                                <span class="name">— María C.</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 swiper-slide" data-aos="fade-up" data-aos-delay="200">
                            <div class="testimonial-card">
                                <div class="stars">★★★★★</div>
                                <p>"Pedí una caja de rosas para el aniversario y fue un éxito total. El servicio es excelente y el diseño, único."</p>
                                <span class="name">— Carlos M.</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 swiper-slide" data-aos="fade-up" data-aos-delay="300">
                            <div class="testimonial-card">
                                <div class="stars">★★★★★</div>
                                <p>"El arreglo con frutas que pedí fue espectacular. Las flores frescas y la presentación, impecable. ¡Repetiré sin dudarlo!"</p>
                                <span class="name">— Ana L.</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination mt-4"></div>
                </div>
        </div>
    </section><!-- End Testimonios -->

    <!-- ======= Contacto ======= -->
    <section id="contacto">
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center mb-5">
                <h2>Contáctanos</h2>
                <div class="separator mx-auto"></div>
                <p class="mt-3">Estamos listos para crear el arreglo perfecto para ti</p>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="contact-info">
                        <div class="contact-info-item">
                            <i class="bx bxl-whatsapp"></i>
                            <div>
                                <h4>WhatsApp</h4>
                                <p><a href="https://wa.me/573204663245" target="_blank" style="color: var(--lavanda-dark); text-decoration:none;">320 466 3245</a></p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <i class="bx bx-envelope"></i>
                            <div>
                                <h4>Correo</h4>
                                <p><a href="mailto:info@deliriosfloristeria.com" style="color: var(--lavanda-dark); text-decoration:none;">info@deliriosfloristeria.com</a></p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <i class="bx bx-time-five"></i>
                            <div>
                                <h4>Horario de atención</h4>
                                <p>Lunes a Sábados<br>7:30 AM – 5:00 PM</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <i class="bx bx-check-shield"></i>
                            <div>
                                <h4>Entrega</h4>
                                <p>A domicilio dentro del municipio<br>Costo de envío: $10.000</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Tu nombre" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="correo">Correo Electrónico</label>
                                <input type="email" class="form-control" name="correo" id="correo" placeholder="tu@email.com" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="celular">Celular / WhatsApp</label>
                            <input type="tel" class="form-control" name="celular" id="celular" placeholder="300 000 0000" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje">Mensaje</label>
                            <textarea class="form-control" name="mensaje" id="mensaje" rows="5" placeholder="Cuéntanos qué necesitas: tipo de arreglo, ocasión, fecha de entrega..." required></textarea>
                        </div>
                        <button type="button" class="btn-enviar" onclick="this.form?.submit()">
                            <i class="bx bx-send me-2"></i> Enviar Mensaje
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Contacto -->

</main>

<!-- ======= Footer ======= -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/system/assets/html/landpage/footer-page.php'; ?>

<!-- ======= Back to top ======= -->
<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- ======= WhatsApp Flotante ======= -->
<a href="https://wa.me/573204663245?text=Hola%20Delirios%2C%20quiero%20hacer%20un%20pedido"
   class="whatsapp-float"
   target="_blank"
   rel="noopener"
   aria-label="Chatear por WhatsApp">
    <i class="bx bxl-whatsapp"></i>
</a>

<!-- Vendor JS -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="assets/js/main.js"></script>
<script src="/system/assets/vendor/swal/sweetalert.min.js"></script>
<?= $response ?? '' ?>

<script>
    // AOS init
    AOS.init({ duration: 700, easing: 'ease-in-out', once: true });

    // Testimonials slider
    new Swiper('.testimonials-slider', {
        speed: 600,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        slidesPerView: 'auto',
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 20 },
            768: { slidesPerView: 2, spaceBetween: 20 },
            1200: { slidesPerView: 3, spaceBetween: 30 }
        }
    });
</script>

</body>
</html>
