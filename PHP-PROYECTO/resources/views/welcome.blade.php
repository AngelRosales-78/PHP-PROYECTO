<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClickUp Landing Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Estilos globales y fuentes */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            background-color: white;
            color: black;
        }

        /* Colores primarios */
        :root {
            --primary-orange: #f97316;
            --dark-grey: #333;
        }

        /* Contenedor principal de la página */
        .page-container {
            position: relative;
            width: 100vw;
            min-height: 100vh;
        }

        /* --- Header / Navbar --- */
        .header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 50px;
            box-sizing: border-box;
            z-index: 100; /* Incrementado para evitar que otros elementos pasen por encima */
        }

        /* Logotipo (icono + texto) */
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            font-size: 1.4rem;
            font-weight: bold;
        }

        .logo-text {
            color: var(--primary-orange);
            font-weight: 900;
        }

        /* Enlaces de navegación */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark-grey);
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary-orange);
        }

        /* Enlace de perfil con icono y flecha */
        .profile-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--dark-grey);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .profile-icon {
            width: 20px;
            height: 20px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' fill='%23000'%3E%3Cpath d='M50 0C28.3 0 10.7 17.6 10.7 39.3c0 21.7 39.3 60.7 39.3 60.7s39.3-39 39.3-60.7C89.3 17.6 71.7 0 50 0zm0 61.4C37.8 61.4 28 51.6 28 39.4c0-12.2 9.8-22 22-22s22 9.8 22 22C72 51.6 62.2 61.4 50 61.4z'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
        }

        .dropdown-arrow {
            width: 10px;
            height: 10px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' fill='%23000'%3E%3Cpath d='M50 80L0 0h100z'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            margin-top: 2px;
            transition: transform 0.2s ease;
        }

        /* --- CONTENEDOR DEL DESPLEGABLE (MENU PERFIL) --- */
        .user-dropdown-container {
            position: relative;
            display: inline-block;
        }

        /* Caja contenedora interactiva */
        .user-welcome-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(249, 115, 22, 0.1);
            padding: 8px 18px;
            border-radius: 20px;
            border: 1px solid rgba(249, 115, 22, 0.2);
            cursor: pointer;
            user-select: none;
            transition: background-color 0.2s;
        }

        .user-welcome-box:hover {
            background: rgba(249, 115, 22, 0.18);
        }

        .user-welcome-text {
            font-size: 0.95rem;
            color: var(--dark-grey);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .user-welcome-text i {
            color: var(--primary-orange);
        }

        .user-welcome-text strong {
            color: #000000;
            font-weight: 700;
        }

        /* Flecha pequeña para indicar interactividad */
        .welcome-arrow {
            font-size: 0.75rem;
            color: var(--dark-grey);
            transition: transform 0.2s ease;
        }

        /* Menu flotante oculto por defecto */
        .profile-dropdown-menu {
            position: absolute;
            top: 115%;
            right: 0;
            background-color: #ffffff;
            min-width: 170px;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid #eeeeee;
            padding: 6px 0;
            display: none;
            z-index: 1000;
        }

        /* Clase activa controlada con JS */
        .profile-dropdown-menu.show {
            display: block;
        }

        /* Elementos individuales del menú */
        .dropdown-custom-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            color: #333333;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background-color 0.2s;
            width: 100%;
            border: none;
            background: none;
            text-align: left;
            cursor: pointer;
            box-sizing: border-box;
        }

        .dropdown-custom-item:hover {
            background-color: #f5f5f5;
        }

        .dropdown-custom-item i {
            color: #555555;
            width: 14px;
        }

        .dropdown-custom-divider {
            border: 0;
            border-top: 1px solid #eeeeee;
            margin: 6px 0;
        }

        /* Modificador para el diseño de salida */
        .dropdown-custom-item.logout-color {
            color: #ef4444;
        }

        .dropdown-custom-item.logout-color:hover {
            background-color: #fef2f2;
        }

        .dropdown-custom-item.logout-color i {
            color: #ef4444;
        }

        /* --- Sección Principal (Hero) --- */
        .hero-section {
            display: flex;
            position: relative;
            height: 100vh;
            width: 100%;
        }

        /* Columna de contenido (Izquierda) */
        .content-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 0 50px;
            padding-top: 150px;
            box-sizing: border-box;
            z-index: 10;
            max-width: 45%;
        }

        .main-title {
            font-size: 3.5rem;
            font-weight: 900;
            line-height: 1.1;
            margin: 0;
            margin-bottom: 25px;
            color: black;
        }

        .sub-text {
            font-size: 1.15rem;
            line-height: 1.6;
            margin: 0;
            margin-bottom: 45px;
            color: #777;
        }

        .sub-text .highlight {
            color: var(--primary-orange);
            font-weight: bold;
        }

        /* Botón de llamada a la acción */
        .cta-button {
            display: inline-block;
            background-color: var(--primary-orange);
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
            padding: 18px 45px;
            border-radius: 35px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .cta-button:hover {
            background-color: #e86300;
            transform: translateY(-2px);
        }

        /* Columna derecha para la gran forma orgánica */
        .shape-column {
            flex: 1.5;
            position: relative;
            z-index: 1;
            height: 100%;
            overflow: hidden;
        }

        .orange-shape {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-color: transparent;
            background-image: url("{{ asset('images/Banner.jpg') }}");       
            background-size: cover;
            background-position: -20% center;
            background-repeat: no-repeat;
        }

        .logo-real {
            height: 90px;
            width: auto;
        }

        /* --- Sección de Categorías e Inferior --- */
        .categories-section {
            padding: 80px 20px;
            text-align: center;
            background-color: #ffffff;
            position: relative;
            width: 100%; 
            box-sizing: border-box; 
            overflow: hidden;
        }

        .categories-section h2 {
            font-size: 2rem;
            color: var(--dark-grey);
            margin-bottom: 70px; 
            font-weight: bold;
            position: relative;
            z-index: 2;
        }

        .categories-grid {
            display: flex;
            flex-wrap: wrap; 
            justify-content: center; 
            gap: 30px;
            max-width: 800px;
            margin: 0 auto 50px auto;
            position: relative;
            z-index: 2;
        }

        /* El cuadro de cada categoría */
        .category-card {
            width: 170px;
            height: 170px;
            border-radius: 40px; 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end; 
            padding-bottom: 25px;
            text-decoration: none;
            color: white;
            font-weight: 500;
            font-size: 1.1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            box-sizing: border-box;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .category-card img {
            width: 240px; 
            height: auto;
            position: absolute;
            top: -40px; 
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
        }

        /* Colores exactos de cuadros */
        .bg-orange { background-color: #ff6b00; }
        .bg-yellow { background-color: #ffcd56; }
        .bg-cyan   { background-color: #4bc0c0; }
        .bg-green  { background-color: #63d68a; }
        .bg-pink   { background-color: #eb7c94; }

        .search-btn {
            display: inline-block;
            background-color: var(--primary-orange);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 15px 40px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
            margin-bottom: 80px;
            position: relative;
            z-index: 2;
        }

        .search-btn:hover { background-color: #e86300; }

        .section-title-bottom {
            font-size: 1.8rem;
            color: var(--dark-grey);
            font-weight: bold;
            position: relative;
            z-index: 2;
            margin-bottom: 40px;
        }

        .left-shape {
            position: absolute;
            top: 0;
            left: 0;
            width: 102vw;
            height: 100%;
            background-image: url("{{ asset('images/Vector_3.svg') }}"); 
            background-size: 100% auto; 
            background-position: left top; 
            background-repeat: no-repeat;
            z-index: 0; 
        }

        /* --- Grilla de Características Destacadas --- */
        .features-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
            max-width: 1100px;
            margin: 0 auto 50px auto;
            position: relative;
            z-index: 2;
        }

        .feature-card {
            width: 290px;
            height: 290px;
            border-radius: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 30px;
            box-sizing: border-box;
            text-align: center;
        }

        .feature-card img {
            width: 125px;
            height: auto;
            margin-bottom: 20px;
        }

        .feature-card p {
            margin: 0;
            font-size: 1.1rem;
            color: #000000;
            font-weight: 600;
            line-height: 1.3;
        }

        .feat-orange { background-color: #ffebe1; }
        .feat-green  { background-color: #f0fbe3; }
        .feat-blue   { background-color: #e3f5ff; }

        .more-btn {
            display: inline-block;
            background-color: var(--primary-orange);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05rem;
            padding: 14px 45px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
        }

        .more-btn:hover {
            background-color: #e86300;
        }

        /* --- Sección: FOOTER --- */
        .main-footer {
            background-color: #f97316;
            color: #ffffff;
            padding: 60px 50px 80px 50px;
            width: 100%;
            box-sizing: border-box;
            position: relative;
            z-index: 10;
            text-align: left;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
        }

        .footer-column {
            flex: 1;
            min-width: 200px;
        }

        .brand-column {
            flex: 1.5;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .footer-logo img {
            height: 125px;
            width: auto;
            filter: brightness(0) invert(1);
        }

        .social-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 15px 0;
        }

        .social-links {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .social-icon {
            color: #ffffff;
            text-decoration: none;
            transition: transform 0.2s ease;
        }

        .social-icon svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
        }

        .social-icon:hover {
            transform: translateY(-3px);
        }

        .footer-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 20px 0;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-links a {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: opacity 0.2s ease;
        }

        .footer-links a:hover {
            opacity: 0.8;
        }

        .footer-email {
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                gap: 30px;
            }
            .main-footer {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <header class="header">
            <a href="#" class="logo">
                <img src="{{ asset('images/LogoClickUp.png') }}" alt="Logo ClickUp" class="logo-real">
            </a>
            <nav>
                <ul class="nav-links">
                    <li><a href="#">Couriers Corporativos</a></li>
                    <li><a href="#">Sobre Nosotros</a></li>
                    <li><a href="#">Afilia tu Negocio</a></li>
                    <li>
                        @if(session()->has('cliente_id'))
                            <div class="user-dropdown-container" id="userDropdownContainer">
                                <div class="user-welcome-box" id="dropdownTrigger">
                                    <span class="user-welcome-text">
                                        <i class="fa-solid fa-circle-user"></i> Hola, <strong>{{ session('cliente_nombre') }}</strong>
                                    </span>
                                    <i class="fa-solid fa-chevron-down welcome-arrow"></i>
                                </div>
                                
                                <div class="profile-dropdown-menu" id="dropdownMenu">
                                    <a href="{{ route('mis.pedidos') }}" class="dropdown-custom-item">
                                        <i class="fa-solid fa-basket-shopping"></i> Mis Pedidos
                                    </a>
                                    <div class="dropdown-custom-divider"></div>
                                    
                                    <a href="{{ route('logout') }}" class="dropdown-custom-item logout-color" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="profile-link">
                                <div class="profile-icon" aria-hidden="true"></div>
                                <span>Mi Perfil</span>
                                <div class="dropdown-arrow" aria-hidden="true"></div>
                            </a>
                        @endif
                    </li>
                </ul>
            </nav>
        </header>

        <main class="hero-section">
            <div class="content-column">
                <h1 class="main-title">¿Lo quieres?<br>¡Lo tienes!</h1>
                <p class="sub-text">
                    <span class="highlight">Presentes en 15 ciudades del interior</span> y seguimos creciendo. Elige la app de delivery 100% peruana: ClickUp
                </p>
                <a href="#" class="cta-button">Ordenar Ahora</a>
            </div>
            <div class="shape-column">
                <div class="orange-shape"></div>
            </div>
        </main>

        <section class="categories-section">
            <div class="left-shape"></div>

            <h2>¡Encuentra más de lo que necesitas!</h2>
            
            <div class="categories-grid">
                <a href="{{ route('categoria.comida') }}" class="category-card bg-orange">
                    <img src="{{ asset('images/bembos.png') }}" alt="Comida Rápida">
                    <span>Comida Rapida</span>
                </a>
                
                <a href="{{ route('categoria.supermercado') }}" class="category-card bg-yellow">
                    <img src="{{ asset('images/market.png') }}" alt="SuperMercados">
                    <span>SuperMercados</span>
                </a>
                
                <a href="{{ route('categoria.licores') }}" class="category-card bg-cyan">
                    <img src="{{ asset('images/liqueur.png') }}" alt="Licores">
                    <span>Licores</span>
                </a>
                
                <a href="{{ route('categoria.farmacias') }}" class="category-card bg-green">
                    <img src="{{ asset('images/pharmacy.png') }}" alt="Farmacias">
                    <span>Farmacias</span>
                </a>
                
                <a href="{{ route('categoria.libreria') }}" class="category-card bg-pink">
                    <img src="{{ asset('images/bookshop.png') }}" alt="Libreria">
                    <span>Libreria</span>
                </a>
            </div>

            <a href="#" class="search-btn">Buscar productos</a>

            <h2 class="section-title-bottom">Características destacadas</h2>
            
            <div class="features-grid">
                <div class="feature-card feat-orange">
                    <img src="{{ asset('images/Group2.svg') }}" alt="Manda y pide">
                    <p>Manda y pide lo que quieras, a donde quieras</p>
                </div>
                
                <div class="feature-card feat-green">
                    <img src="{{ asset('images/Group1.svg') }}" alt="Sigue tu pedido">
                    <p>Sigue tu pedido o envio durante todo el camino</p>
                </div>
                
                <div class="feature-card feat-blue">
                    <img src="{{ asset('images/Group3.svg') }}" alt="Recíbelo en tiempo record">
                    <p>Recíbelo en tiempo record</p>
                </div>
            </div>

            <a href="#" class="more-btn">Conoce más</a>
            
        </section>

        <footer class="main-footer">
            <div class="footer-container">
                
                <div class="footer-column brand-column">
                    <div class="footer-logo">
                        <img src="{{ asset('images/LogoClickUp.png') }}" alt="Logo ClickUp">
                    </div>
                    <p class="social-title">Siguenos en las redes</p>
                    <div class="social-links">
                        <a href="#" class="social-icon" aria-label="Facebook">
                            <svg viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c4.56-.93 8-4.96 8-9.8z"/></svg>
                        </a>
                        <a href="#" class="social-icon" aria-label="Instagram">
                            <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="social-icon" aria-label="WhatsApp">
                            <svg viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.503-5.729-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.966a9.9 9.9 0 00-6.978-2.893c-5.441 0-9.865 4.37-9.869 9.8-.001 1.761.467 3.479 1.356 5.013l-.993 3.626 3.73-.974z"/></svg>
                        </a>
                        <a href="#" class="social-icon" aria-label="TikTok">
                            <svg viewBox="0 0 24 24"><path d="M12.525.02c1.31 0 2.59.26 3.77.75v4.56c-.95-.28-1.94-.43-2.94-.43V13c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4c.31 0 .62.04.92.11V4.54c-.31-.03-.61-.04-.92-.04-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8V0h-3.77z"/></svg>
                        </a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3 class="footer-title">Soluciones</h3>
                    <ul class="footer-links">
                        <li><a href="#">Afilia y Maneja tu negocio</a></li>
                        <li><a href="#">Registro de Reportes</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3 class="footer-title">Nosotros</h3>
                    <ul class="footer-links">
                        <li><a href="#">Sobre nosotros</a></li>
                        <li><a href="#">Preguntas frecuentes</a></li>
                        <li><a href="#">Contactanos desde:</a></li>
                        <li><a href="mailto:upclick@gmail.com" class="footer-email">upclick@gmail.com</a></li>
                    </ul>
                </div>

            </div>
        </footer>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trigger = document.getElementById('dropdownTrigger');
            const menu = document.getElementById('dropdownMenu');
            const arrow = trigger.querySelector('.welcome-arrow');

            // 1. Abrir y cerrar el menú haciendo clic en el cuadro de bienvenida
            trigger.addEventListener('click', function(event) {
                event.stopPropagation(); // Previene el evento global de clic
                const isOpen = menu.classList.contains('show');
                
                if (isOpen) {
                    menu.classList.remove('show');
                    arrow.style.transform = 'rotate(0deg)';
                } else {
                    menu.classList.add('show');
                    arrow.style.transform = 'rotate(180deg)';
                }
            });

            // 2. Cerrar de forma segura si se hace clic fuera del área del perfil
            document.addEventListener('click', function(event) {
                const container = document.getElementById('userDropdownContainer');
                if (!container.contains(event.target)) {
                    menu.classList.remove('show');
                    arrow.style.transform = 'rotate(0deg)';
                }
            });
        });
    </script>
</body>
</html>