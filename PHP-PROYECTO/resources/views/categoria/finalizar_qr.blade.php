<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClickUp - Finalizar Compra</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            background-color: white;
            color: black;
        }

        :root {
            --primary-orange: #f97316;
            --dark-grey: #333;
        }

        /* --- Header / Navbar Idéntico --- */
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
            z-index: 10;
        }

        .logo-real {
            height: 90px;
            width: auto;
        }

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
        }

        .profile-link {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 600 !important;
        }

        /* Vector Fondo Superior Derecho */
        .banner-bg {
            position: absolute;
            top: 0;
            right: 0;
            width: 45vw;
            height: 55vh;
            background-image: url("{{ asset('images/Banner.jpg') }}");
            background-size: cover;
            background-position: -20% center;
            background-repeat: no-repeat;
            z-index: 1;
        }

        /* --- Contenedor Principal --- */
        .main-content {
            position: relative;
            z-index: 2;
            margin-top: 100px;
            padding: 20px 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .page-title {
            font-size: 4.5rem;
            font-weight: 800;
            margin: 20px 0 10px 0;
            text-align: center;
            color: #000;
        }

        /* Línea gris horizontal idéntica a tus otras interfaces */
        .header-line {
            width: 100%;
            border: none;
            border-top: 2px solid #b5b5b5;
            margin-bottom: 50px;
        }

        /* Panel Gris de Compra */
        .checkout-panel {
            background-color: #dcdcdc;
            border-radius: 40px;
            width: 100%;
            max-width: 900px;
            padding: 50px;
            box-sizing: border-box;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            margin-bottom: 50px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 5px;
            color: #000;
        }

        .item-count {
            font-size: 1rem;
            color: #555;
            margin-bottom: 30px;
        }

        /* --- Lista de Productos --- */
        .products-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 30px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            background-color: transparent;
            border-radius: 15px;
            padding: 10px 0;
            position: relative;
        }

        .item-image {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 15px;
            margin-right: 20px;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-name {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 5px 0;
        }

        .item-qty {
            font-size: 0.9rem;
            color: #555;
        }

        .item-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #000;
            margin-right: 20px;
        }

        /* --- Separador y Totales --- */
        .divider {
            border: none;
            border-top: 2px solid #b5b5b5;
            margin: 30px 0;
        }

        .totals-box {
            display: flex;
            flex-direction: column;
            gap: 15px;
            font-size: 1.1rem;
            margin-bottom: 40px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            color: #333;
        }

        .total-row.final {
            font-weight: 800;
            color: #000;
            font-size: 1.25rem;
        }

        /* --- Contenedor de la sección blanca de Pago --- */
        .payment-box {
            background-color: #ffffff;
            border-radius: 35px;
            padding: 40px;
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        }

        .payment-box h3 {
            font-size: 2rem;
            font-weight: 800;
            margin-top: 0;
            margin-bottom: 30px;
            color: #000;
        }

        .qr-container {
            background-color: #eaeaea;
            border-radius: 25px;
            padding: 25px;
            width: 100%;
            max-width: 320px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .qr-instruction {
            font-size: 0.95rem;
            color: #333;
            margin: 0;
            font-weight: 600;
            line-height: 1.4;
        }

        .qr-image {
            width: 200px;
            height: 200px;
            object-fit: contain;
            background: white;
            padding: 10px;
            border-radius: 15px;
        }

        .amount-badge {
            border: 2px solid #f27c22;
            border-radius: 15px;
            padding: 12px 20px;
            width: 85%;
            font-weight: bold;
            color: #f27c22;
            background-color: #fff;
            box-sizing: border-box;
        }

        .amount-badge span {
            display: block;
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 3px;
        }

        .amount-badge div {
            font-size: 1.5rem;
        }

        .expiry-text {
            font-size: 0.9rem;
            color: #555;
            margin-top: 25px;
            margin-bottom: 5px;
            font-weight: 500;
        }

        /* Botón de envío final naranja idéntico */
        .btn-submit-payment {
            background-color: #f27c22;
            color: white;
            border: none;
            padding: 15px 0;
            font-size: 1.4rem;
            font-weight: bold;
            border-radius: 25px;
            cursor: pointer;
            width: 50%;
            max-width: 400px;
            margin-top: 15px;
            transition: background-color 0.2s;
            text-align: center;
            box-shadow: 0 4px 10px rgba(242, 124, 34, 0.3);
        }

        .btn-submit-payment:hover {
            background-color: #d6640e;
        }
    </style>
</head>
<body>

    <div class="banner-bg"></div>

    <header class="header">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/LogoClickUp.png') }}" alt="Logo ClickUp" class="logo-real">
        </a>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Delivery & Envios</a></li>
                <li><a href="#">Courier Corporativo</a></li>
                <li><a href="#">Sobre Nosotros</a></li>
                <li><a href="#">Afilia tu Negocio</a></li>
                <li><a href="#">Hazte driver</a></li>
                <li>
                    <a href="#" class="profile-link">
                        <i class="fa-solid fa-user"></i> Mi Perfil <i class="fa-solid fa-chevron-down" style="font-size: 0.7rem;"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <h1 class="page-title">Detalles de la compra</h1>
        <hr class="header-line">

        <div class="checkout-panel">
            <h2 class="section-title">Resumen de la compra</h2>
            <div class="item-count">{{ count($items) }} {{ count($items) === 1 ? 'producto' : 'productos' }}</div>

            <div class="products-list">
                @foreach($items as $item)
                    <div class="cart-item">
                        <img src="{{ asset('images/bembos.png') }}" alt="{{ $item['nombre'] }}" class="item-image">
                        <div class="item-details">
                            <h3 class="item-name">{{ $item['nombre'] }}</h3>
                            <span class="item-qty">Cantidad: {{ $item['cantidad'] }}</span>
                        </div>
                        <div class="item-price">S/ {{ number_format($item['precio'] * $item['cantidad'], 2) }}</div>
                    </div>
                @endforeach
            </div>

            <hr class="divider">

            <div class="totals-box">
                <div class="total-row">
                    <span>SubTotal</span>
                    <span>S/ {{ number_format($monto - 5.00, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Envío</span>
                    <span>S/ 5.00</span>
                </div>
                <div class="total-row final">
                    <span>Total Pedido</span>
                    <span>S/ {{ number_format($monto, 2) }}</span>
                </div>
            </div>

            <div class="payment-box">
                <h3>!Estás a punto de finalizar tu compra!</h3>

                <div class="qr-container">
                    <p class="qr-instruction">Escanea el QR y pagalo desde tu billetera digital favorita</p>
                    
                    <img src="{{ asset('images/QR-YAPE.jpg') }}" alt="Código QR Yape" class="qr-image">
                    
                    <div class="amount-badge">
                        <span>Monto exacto a yapear:</span>
                        <div>S/ {{ number_format($monto, 2) }}</div>
                    </div>
                </div>

                <p class="expiry-text">Pagar antes del {{ \Carbon\Carbon::now()->addMinutes(15)->format('l d/m/Y - h:i A') }}</p>

                <form id="form-finalizar-compra" action="{{ route('pedido.guardar') }}" method="POST" style="width: 100%; display: flex; justify-content: center;">
                    @csrf
                    <input type="hidden" name="monto_total" value="{{ $monto }}">
                    <input type="hidden" name="carrito" value="{{ $raw_carrito }}">

                    <button type="submit" class="btn-submit-payment">Pagar</button>
                </form>
            </div>

        </div>
    </main>

    <script>
        // Limpieza controlada del localStorage una vez enviado el formulario final
        document.getElementById('form-finalizar-compra').addEventListener('submit', function() {
            localStorage.removeItem('clickup_cart');
        });
    </script>
</body>
</html>