<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClickUp - Comida Rápida</title>
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
            --light-grey: #e5e7eb;
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
            gap: 12px;
            text-decoration: none;
            color: var(--dark-grey);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Banner Decorativo */
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

        /* --- Contenedor Principal de Productos --- */
        .main-content {
            position: relative;
            z-index: 2;
            margin-top: 100px;
            padding: 20px 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .category-title {
            font-size: 4.5rem;
            font-weight: 800;
            margin: 20px 0 50px 0;
            text-align: center;
            color: #000;
        }

        /* Panel Central de Productos */
        .products-panel {
            background-color: #dcdcdc; 
            border-radius: 40px;
            width: 100%;
            max-width: 1100px;
            padding: 40px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* --- Fila de Filtros y Carrito --- */
        .filter-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            width: 100%;
            margin-bottom: 40px;
            position: relative;
        }

        .filter-btn {
            border: none;
            padding: 10px 25px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 20px;
            cursor: pointer;
            color: white;
            background-color: #888888; 
        }

        .filter-btn.active {
            background-color: #ffaa00; 
        }

        .cart-icon-btn {
            background-color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: black;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* --- Grilla de Tarjetas --- */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            width: 100%;
        }

        .product-card {
            background-color: white;
            border-radius: 25px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            padding: 20px; 
            box-sizing: border-box;
        }

        .product-image-container {
            width: 100%;
            height: 220px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }

        .product-image {
            max-height: 100%;
            max-width: 100%;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .product-info {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            padding: 0;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            color: #000;
        }

        .product-description {
            font-size: 0.85rem;
            color: #555;
            margin: 0 0 15px 0;
            line-height: 1.4;
            min-height: 60px;
            height: 60px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: black;
            margin-bottom: 15px;
        }

        .btn-add-order {
            background-color: #ffaa00; 
            color: white;
            border: none;
            padding: 12px;
            font-size: 0.95rem;
            font-weight: bold;
            border-radius: 20px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s, transform 0.1s;
            text-align: center;
            margin-top: auto;
        }

        .btn-add-order:hover {
            background-color: #e59900;
        }
        
        .btn-add-order:active {
            transform: scale(0.98);
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
                <li><a href="#">Couriers Corporativos</a></li>
                <li><a href="#">Sobre Nosotros</a></li>
                <li><a href="#">Afilia tu Negocio</a></li>
                <li>
                    @if(session()->has('cliente_id'))
                        <div class="user-welcome-box" style="display: flex; align-items: center; gap: 10px;">
                            <span>Hola, <strong style="color: #000;">{{ session('cliente_nombre') }}</strong></span>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #ef4444; text-decoration: none; font-size: 0.85rem; font-weight: bold;">Salir</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="profile-link">
                            <span style="display: flex; align-items: center; gap: 5px;"><i class="fa-solid fa-user"></i> Mi Perfil</span>
                        </a>
                    @endif
                </li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <!-- CORREGIDO: Título de la categoría -->
        <h1 class="category-title">Comida Rápida</h1>

        <div class="products-panel">
            
            <!-- CORREGIDO: Filtros orientados a comida -->
            <div class="filter-row">
                <button class="filter-btn active">Todos</button>
                <button class="filter-btn">Hamburguesas</button>
                <button class="filter-btn">Pizzas</button>
                <button class="filter-btn">Combos</button>
                
                <div style="display: flex; align-items: center; gap: 12px; margin-left: 15px;">
                    <span id="cart-total-text" style="font-weight: 700; font-size: 1.15rem; color: #222;">S/ 0.00</span>
                    <button class="cart-icon-btn" onclick="window.location.href='{{ route('carrito.detalles') }}'" aria-label="Carrito" style="position: relative;">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span id="cart-count" style="position: absolute; top: -5px; right: -5px; background-color: var(--primary-orange); color: white; border-radius: 50%; width: 20px; height: 20px; font-size: 0.75rem; display: flex; align-items: center; justify-content: center; font-weight: bold; display: none;">0</span>
                    </button>
                </div>
            </div>

            <!-- CORREGIDO: Grilla con platos de comida reales -->
            <div class="products-grid">
                
                <!-- Producto 1 -->
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=400" alt="Hamburguesa Royal" class="product-image"> 
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">Hamburguesa Royal</h2>
                        <p class="product-description">Carne 100% de res a la parrilla, queso cheddar derretido, huevo frito, papas al hilo crujientes y todas las cremas.</p>
                        <div class="product-price">S/ 18.90</div>
                        <button class="btn-add-order" data-name="Hamburguesa Royal" data-price="18.90">Agregar al Pedido</button>
                    </div>
                </div>

                <!-- Producto 2 -->
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=400" alt="Pizza Americana" class="product-image">
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">Pizza Americana</h2>
                        <p class="product-description">Masa artesanal delgada y crujiente, abundante queso mozzarella premium y láminas seleccionadas de jamón inglés.</p>
                        <div class="product-price">S/ 24.90</div>
                        <button class="btn-add-order" data-name="Pizza Americana" data-price="24.90">Agregar al Pedido</button>
                    </div>
                </div>

                <!-- Producto 3 -->
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://images.unsplash.com/photo-1573080496219-bb080dd4f877?q=80&w=400" alt="Papas Fritas ClickUp" class="product-image">
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">Papas Fritas ClickUp</h2>
                        <p class="product-description">Porción grande de papas nativas cortadas a mano, fritas a la perfección, doradas por fuera y suaves por dentro.</p>
                        <div class="product-price">S/ 9.50</div>
                        <button class="btn-add-order" data-name="Papas Fritas ClickUp" data-price="9.50">Agregar al Pedido</button>
                    </div>
                </div>

                <!-- Producto 4 -->
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=400" alt="Salchipapa Extrema" class="product-image">
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">Salchipapa Extrema</h2>
                        <p class="product-description">Cama de papas crujientes con rodajas de frankfurter ahumado, chorizo parrillero y coronado con huevo frito.</p>
                        <div class="product-price">S/ 16.00</div>
                        <button class="btn-add-order" data-name="Salchipapa Extrema" data-price="16.00">Agregar al Pedido</button>
                    </div>
                </div>

                <!-- Producto 5 -->
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?q=80&w=400" alt="Broaster Personal" class="product-image">
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">Broaster Personal</h2>
                        <p class="product-description">Crujiente pieza de pollo broaster dorado con la receta secreta de la casa, servido con papas y ensalada fresca.</p>
                        <div class="product-price">S/ 13.50</div>
                        <button class="btn-add-order" data-name="Broaster Personal" data-price="13.50">Agregar al Pedido</button>
                    </div>
                </div>

                <!-- Producto 6 -->
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://images.unsplash.com/photo-1551024601-bec78aea704b?q=80&w=400" alt="Donas Glaseadas x4" class="product-image">
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">Donas Glaseadas x4</h2>
                        <p class="product-description">Pack de 4 deliciosas donas artesanales cubiertas con un glaseado dulce clásico perfectas para el postre.</p>
                        <div class="product-price">S/ 12.00</div>
                        <button class="btn-add-order" data-name="Donas Glaseadas x4" data-price="12.00">Agregar al Pedido</button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        let carrito = JSON.parse(localStorage.getItem('clickup_cart')) || [];

        actualizarInterfazCarrito();

        document.querySelectorAll('.btn-add-order').forEach(boton => {
            boton.addEventListener('click', function() {
                const nombre = this.getAttribute('data-name');
                const precio = parseFloat(this.getAttribute('data-price'));

                const productoExistente = carrito.find(item => item.nombre === nombre);

                if (productoExistente) {
                    productoExistente.cantidad += 1;
                } else {
                    carrito.push({
                        nombre: nombre,
                        precio: precio,
                        cantidad: 1
                    });
                }

                localStorage.setItem('clickup_cart', JSON.stringify(carrito));

                this.innerText = "¡Agregado! ✓";
                this.style.backgroundColor = "#22c55e"; 
                
                setTimeout(() => {
                    this.innerText = "Agregar al Pedido";
                    this.style.backgroundColor = "#ffaa00"; 
                }, 800);

                actualizarInterfazCarrito();
            });
        });

        function actualizarInterfazCarrito() {
            const contadorBurbuja = document.getElementById('cart-count');
            const textoTotal = document.getElementById('cart-total-text');

            let totalPrecio = 0;
            let totalProductos = 0;

            carrito.forEach(item => {
                totalPrecio += item.precio * item.cantidad;
                totalProductos += item.cantidad;
            });

            textoTotal.innerText = `S/ ${totalPrecio.toFixed(2)}`;

            if (totalProductos > 0) {
                contadorBurbuja.innerText = totalProductos;
                contadorBurbuja.style.display = 'flex';
            } else {
                contadorBurbuja.style.display = 'none';
            }
        }
    </script>
</body>
</html>