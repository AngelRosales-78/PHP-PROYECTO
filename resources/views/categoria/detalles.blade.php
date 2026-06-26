<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ClickUp - Detalles de la compra</title>

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



        /* --- Header / Navbar Identico --- */

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

            margin: 20px 0 50px 0;

            text-align: center;

            color: #000;

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



        .btn-delete {

            background: none;

            border: none;

            color: #ef4444;

            font-size: 1.2rem;

            cursor: pointer;

            transition: transform 0.2s;

        }



        .btn-delete:hover {

            transform: scale(1.15);

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



        /* --- Métodos de Pago --- */

        .payment-methods {

            display: flex;

            flex-direction: column;

            gap: 15px;

        }



        .payment-option {

            background-color: #eaeaea;

            border-radius: 20px;

            padding: 20px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            font-size: 1.3rem;

            font-weight: 600;

            color: #555;

            cursor: pointer;

            transition: all 0.2s ease;

            position: relative;

        }



        .payment-option:hover {

            background-color: #f3f4f6;

        }



        .payment-option.active {

            border: 2px solid var(--primary-orange);

            background-color: #fcf6f0;

            color: #000;

        }



        .checkbox-round {

            width: 25px;

            height: 25px;

            background-color: white;

            border-radius: 50%;

            border: 1px solid #ccc;

            display: flex;

            align-items: center;

            justify-content: center;

        }



        .payment-option.active .checkbox-round {

            border-color: var(--primary-orange);

            background-color: var(--primary-orange);

        }



        .payment-option.active .checkbox-round::after {

            content: '';

            width: 10px;

            height: 10px;

            background-color: white;

            border-radius: 50%;

        }



        /* Botón de Envió de Formulario Directo */

        .btn-pay-forward {

            background-color: #f27c22;

            color: white;

            border: none;

            padding: 15px 0;

            font-size: 1.4rem;

            font-weight: bold;

            border-radius: 25px;

            cursor: pointer;

            width: 50%;

            margin: 40px auto 0 auto;

            display: none; /* Se muestra solo al elegir un método */

            text-align: center;

            text-decoration: none;

            transition: background-color 0.2s;

        }



        .btn-pay-forward:hover {

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

            </ul>

        </nav>

    </header>



    <main class="main-content">

        <h1 class="page-title">Detalles de la compra</h1>



        <div class="checkout-panel">

            <h2 class="section-title">Resumen de la compra</h2>

            <div id="items-count-text" class="item-count">0 productos</div>



            <div id="cart-products-container" class="products-list"></div>



            <hr class="divider">



            <div class="totals-box">

                <div class="total-row">

                    <span>SubTotal</span>

                    <span id="summary-subtotal">S/ 0.00</span>

                </div>

                <div class="total-row">

                    <span>Envío</span>

                    <span id="summary-shipping">S/ 5.00</span>

                </div>

                <div class="total-row final">

                    <span>Total Pedido</span>

                    <span id="summary-total">S/ 0.00</span>

                </div>

            </div>



            <h2 class="section-title" style="margin-bottom: 25px;">Elegir método de pago</h2>

           

            <div class="payment-methods">

                <div class="payment-option" onclick="seleccionarMetodo(this, 'visa')">

                    <span>Visa</span>

                    <div class="checkbox-round"></div>

                </div>

                <div class="payment-option" onclick="seleccionarMetodo(this, 'bbva')">

                    <span>BBVA</span>

                    <div class="checkbox-round"></div>

                </div>

                <div class="payment-option" id="payment-qr-trigger" onclick="seleccionarMetodo(this, 'qr')">

                    <span>Pago con QR (Yape/Plin)</span>

                    <div class="checkbox-round"></div>

                </div>

            </div>



<form id="form-procesar-pago" action="{{ route('pedido.procesarQr') }}" method="POST">

    @csrf

    <input type="hidden" id="input-monto-total" name="monto_total" value="0">

    <input type="hidden" id="input-metodo" name="metodo" value="">

    <input type="hidden" id="input-items-json" name="carrito" value="">



    <button type="submit" id="btn-submit-action" class="btn-pay-forward">Continuar al Pago</button>

</form>



        </div>

    </main>



    <script>

        let carrito = JSON.parse(localStorage.getItem('clickup_cart')) || [];

        const costoEnvio = 5.00;

        let totalGlobalCalculado = 0;

        let metodoSeleccionado = '';



        renderizarDetallesCompra();



        function renderizarDetallesCompra() {

            const contenedor = document.getElementById('cart-products-container');

            const textoContador = document.getElementById('items-count-text');

            const txtSubtotal = document.getElementById('summary-subtotal');

            const txtEnvio = document.getElementById('summary-shipping');

            const txtTotal = document.getElementById('summary-total');



            contenedor.innerHTML = "";



            if (carrito.length === 0) {

                contenedor.innerHTML = "<p style='text-align:center; font-weight:600; color:#666;'>Tu carrito está vacío.</p>";

                textoContador.innerText = "0 productos";

                txtSubtotal.innerText = "S/ 0.00";

                txtEnvio.innerText = "S/ 0.00";

                txtTotal.innerText = "S/ 0.00";

                totalGlobalCalculado = 0;

                document.getElementById('btn-submit-action').style.display = 'none';

                return;

            }



            let subtotal = 0;

            let totalProductos = 0;



            carrito.forEach((item, index) => {

                subtotal += item.precio * item.cantidad;

                totalProductos += item.cantidad;



                const itemHTML = `

                    <div class="cart-item">

                        <img src="{{ asset('images/bembos.png') }}" alt="${item.nombre}" class="item-image">

                        <div class="item-details">

                            <h3 class="item-name">${item.nombre}</h3>

                            <span class="item-qty">Cantidad: ${item.cantidad}</span>

                        </div>

                        <div class="item-price">S/ ${(item.precio * item.cantidad).toFixed(2)}</div>

                        <button class="btn-delete" onclick="eliminarProducto(${index})" aria-label="Eliminar">

                            <i class="fa-solid fa-trash-can"></i>

                        </button>

                    </div>

                `;

                contenedor.innerHTML += itemHTML;

            });



            totalGlobalCalculado = subtotal + costoEnvio;



            textoContador.innerText = `${totalProductos} ${totalProductos === 1 ? 'producto' : 'productos'}`;

            txtSubtotal.innerText = `S/ ${subtotal.toFixed(2)}`;

            txtEnvio.innerText = `S/ ${costoEnvio.toFixed(2)}`;

            txtTotal.innerText = `S/ ${totalGlobalCalculado.toFixed(2)}`;



            // Actualizar los inputs del formulario oculto en tiempo real

            document.getElementById('input-monto-total').value = totalGlobalCalculado.toFixed(2);

            document.getElementById('input-items-json').value = JSON.stringify(carrito);

        }



        window.eliminarProducto = function(index) {

            carrito.splice(index, 1);

            localStorage.setItem('clickup_cart', JSON.stringify(carrito));

            renderizarDetallesCompra();

        }



        window.seleccionarMetodo = function(elemento, metodo) {

            metodoSeleccionado = metodo;

           


            document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('active'));

            elemento.classList.add('active');




            document.getElementById('input-metodo').value = metodo;



            const btnSubmit = document.getElementById('btn-submit-action');

            if (metodo === 'qr') {

                btnSubmit.innerText = "Generar QR de Pago";

                btnSubmit.style.display = 'block';

            } else {

                btnSubmit.innerText = `Pagar con ${metodo.toUpperCase()}`;

                btnSubmit.style.display = 'block';

            }

        }




        document.getElementById('form-procesar-pago').addEventListener('submit', function(e) {


            localStorage.removeItem('clickup_cart');

        });

    </script>

</body>

</html>