<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClickUp Admin - Gestión de Inventario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        /* --- Barra Superior Naranja --- */
        .top-navbar {
            background-color: #f27c22;
            height: 60px;
            width: 100%;
            display: flex;
            align-items: center;
            padding: 0 30px;
            box-sizing: border-box;
            z-index: 10;
        }

        .top-navbar img {
            height: 45px;
        }

        /* --- Contenedor de Cuerpo Central --- */
        .admin-container {
            display: flex;
            flex-grow: 1;
            width: 100%;
            height: calc(100vh - 60px);
        }

        /* --- Sidebar Lateral Izquierda (Gris Oscuro) --- */
        .sidebar {
            background-color: #3e3e3e;
            width: 260px;
            min-width: 260px;
            display: flex;
            flex-direction: column;
            padding: 25px 0;
            box-sizing: border-box;
        }

        .sidebar-section-title {
            color: #a3a3a3;
            font-size: 0.85rem;
            font-weight: bold;
            padding: 0 25px;
            margin: 15px 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-item a {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #d1d1d1;
            text-decoration: none;
            padding: 12px 25px;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .sidebar-item a:hover {
            background-color: #4a4a4a;
            color: #ffffff;
        }

        .sidebar-item.active a {
            background-color: #524c46;
            color: #ffffff;
            border-left: 5px solid #f27c22;
            padding-left: 20px;
        }

        .sidebar-item i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* --- Panel de Contenido Principal --- */
        .main-content {
            flex-grow: 1;
            padding: 40px 50px;
            box-sizing: border-box;
            overflow-y: auto;
            background-color: #ffffff;
        }

        /* Cabecera del Panel */
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 35px;
        }

        .title-area h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 8px 0;
            color: #000000;
        }

        .title-area p {
            font-size: 1rem;
            color: #555555;
            margin: 0;
            max-width: 500px;
            line-height: 1.4;
        }

        /* Botón Nuevo Producto */
        .btn-new-product {
            background-color: #ffffff;
            color: #000000;
            border: 1px solid #a3a3a3;
            border-radius: 12px;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
            transition: background-color 0.2s;
        }

        .btn-new-product:hover {
            background-color: #f9f9f9;
            border-color: #000;
        }

        /* --- Fila de Tarjetas Informativas --- */
        .cards-row {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .info-card {
            background: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 16px;
            padding: 20px;
            flex: 1;
            min-width: 160px;
            box-sizing: border-box;
            position: relative;
        }

        .card-header-box {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #000000;
            font-size: 1rem;
            font-weight: bold;
            line-height: 1.2;
            margin-bottom: 15px;
        }

        .card-header-box i {
            font-size: 1.5rem;
        }

        .card-number {
            font-size: 2.2rem;
            font-weight: 800;
            color: #000000;
            margin-bottom: 12px;
        }

        .card-badge {
            display: inline-block;
            background-color: #7c7c7c;
            color: #ffffff;
            font-size: 0.8rem;
            font-weight: bold;
            padding: 5px 12px;
            border-radius: 12px;
        }

        /* --- Sección de Buscador y Filtros --- */
        .filters-container {
            border: 1px solid #cccccc;
            border-radius: 12px;
            padding: 25px;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .search-wrapper {
            position: relative;
            width: 100%;
        }

        .search-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #555555;
            font-size: 1.2rem;
        }

        .search-input {
            width: 100%;
            padding: 12px 12px 12px 45px;
            font-size: 1rem;
            border: 1px solid #b5b5b5;
            border-radius: 8px;
            box-sizing: border-box;
            color: #333;
        }

        .select-filter {
            width: 100%;
            padding: 12px 15px;
            font-size: 1rem;
            color: #444444;
            font-weight: 500;
            border: 1px solid #b5b5b5;
            border-radius: 8px;
            background-color: #ffffff;
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'></polyline></svg>");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 18px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Franja Superior Corporativa -->
    <header class="top-navbar">
        <img src="{{ asset('images/LogoClickUp.png') }}" alt="ClickUp Logo">
    </header>

    <div class="admin-container">
        
        <!-- Sidebar Menú Oscuro -->
        <aside class="sidebar">
            <div class="sidebar-section-title">Principal</div>
            <ul class="sidebar-menu">
                <li class="sidebar-item active">
                    <a href="{{ route('admin.inventario') }}"><i class="fa-solid fa-boxes-stacked"></i> Inventario</a>
                </li>
                <li class="sidebar-item">
                    <a href="#"><i class="fa-solid fa-cart-shopping"></i> Pedidos</a>
                </li>
                <li class="sidebar-item">
                    <a href="#"><i class="fa-solid fa-users"></i> Usuarios</a>
                </li>
            </ul>

            <div class="sidebar-section-title">Reportes</div>
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <a href="#"><i class="fa-solid fa-chart-line"></i> Ventas</a>
                </li>
            </ul>
        </aside>

        <!-- Área de Contenido Central -->
        <main class="main-content">
            
            <div class="content-header">
                <div class="title-area">
                    <h1>Gestión de inventario</h1>
                    <p>Administra el catálogo de productos y controla el stock disponible</p>
                </div>
                <button class="btn-new-product">
                    <i class="fa-solid fa-plus"></i> Nuevo Producto
                </button>
            </div>

            <!-- Fila de Tarjetas de Estado -->
            <div class="cards-row">
                
    <!-- Tarjeta 1: Total Productos -->
    <div class="info-card">
        <div class="card-header-box">
            <i class="fa-solid fa-box-open"></i>
            <div>Total<br>Productos</div>
        </div>
        <div class="card-number">{{ $totalProductos }}</div>
        <div class="card-badge">{{ $totalCategorias }} {{ $totalCategorias === 1 ? 'categoría' : 'categorías' }}</div>
    </div>

    <!-- Tarjeta 2: Stock Normal -->
    <div class="info-card">
        <div class="card-header-box">
            <i class="fa-solid fa-clipboard-check"></i>
            <div>Stock<br>Normal</div>
        </div>
        <div class="card-number">{{ $stockNormal }}</div>
        <div class="card-badge">{{ $porcentajeCatalogo }}% del catálogo</div>
    </div>

    <!-- Tarjeta 3: Stock Bajo -->
    <div class="info-card">
        <div class="card-header-box">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>Stock<br>Bajo</div>
        </div>
        <div class="card-number">{{ $stockBajo }}</div>
        <div class="card-badge" style="background-color: #5c5c5c;">Requieren reposición</div>
    </div>

    <!-- Tarjeta 4: Sin Stock -->
    <div class="info-card">
        <div class="card-header-box">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>Sin<br>Stock</div>
        </div>
        <div class="card-number">{{ $sinStock }}</div>
        <div class="card-badge" style="background-color: #444444;">Desactivadas</div>
    </div>

</div>

            <!-- Caja de Filtros y Buscador de la Imagen -->
            <div class="filters-container">
                <div class="search-wrapper">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" class="search-input" placeholder="Buscar productos por nombre">
                </div>

                <select class="select-filter">
                    <option>Todas las categorías</option>
                </select>

                <select class="select-filter">
                    <option>Todos los estados</option>
                </select>

                <select class="select-filter">
                    <option>Ordenar por: Nombre</option>
                </select>
            </div>

        </main>
    </div>

</body>
</html>