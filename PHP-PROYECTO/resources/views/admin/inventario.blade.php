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
            background-color: #fcfcfc;
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

        /* --- Sidebar Lateral Izquierda --- */
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

        /* --- Alertas --- */
        .alert-success {
            background-color: #e6f4ea;
            color: #137333;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
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

        .card-header-box i { font-size: 1.5rem; }
        .card-number { font-size: 2.2rem; font-weight: 800; color: #000000; margin-bottom: 12px; }
        .card-badge { display: inline-block; background-color: #7c7c7c; color: #ffffff; font-size: 0.8rem; font-weight: bold; padding: 5px 12px; border-radius: 12px; }

        /* --- Sección de Buscador y Filtros --- */
        .filters-container {
            border: 1px solid #cccccc;
            border-radius: 12px;
            padding: 20px;
            background-color: #ffffff;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }

        .search-wrapper { position: relative; }
        .search-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #555555; font-size: 1.2rem; }
        .search-input { width: 100%; padding: 12px 12px 12px 45px; font-size: 1rem; border: 1px solid #b5b5b5; border-radius: 8px; box-sizing: border-box; }
        .select-filter { width: 100%; padding: 12px 15px; font-size: 1rem; color: #444444; border: 1px solid #b5b5b5; border-radius: 8px; background-color: #ffffff; }

        /* --- Tabla de Productos --- */
        .table-container {
            border: 1px solid #cccccc;
            border-radius: 12px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .data-table th {
            background-color: #f9f9f9;
            padding: 15px 20px;
            font-weight: bold;
            color: #333;
            border-bottom: 1px solid #cccccc;
        }

        .data-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #eeeeee;
            color: #555;
            vertical-align: middle;
        }

        .product-img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .badge-stock {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .bg-success { background-color: #e6f4ea; color: #137333; }
        .bg-warning { background-color: #fef7e0; color: #b06000; }
        .bg-danger { background-color: #fce8e6; color: #c5221f; }

        /* --- ESTILOS DEL MODAL (VENTANA EMERGENTE) --- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .modal-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }
        .modal-content {
            background: #ffffff;
            width: 100%;
            max-width: 550px;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            position: relative;
            box-sizing: border-box;
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .modal-header h2 { margin: 0; font-size: 1.6rem; color: #000; }
        .btn-close-modal { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #666; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: bold; color: #333; }
        .form-control { width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 8px; box-sizing: border-box; font-size: 1rem; }
        .modal-footer { display: flex; justify-content: flex-end; gap: 10px; margin-top: 25px; }
        .btn-cancel { background: #e0e0e0; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .btn-save { background: #f27c22; color: #fff; border: none; padding: 10px 25px; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .btn-save:hover { background: #d96916; }
    </style>
</head>
<body>

    <header class="top-navbar">
        <img src="{{ asset('images/LogoClickUp.png') }}" alt="ClickUp Logo">
    </header>

    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-section-title">Principal</div>
            <ul class="sidebar-menu">
                <li class="sidebar-item active">
                    <a href="{{ route('admin.inventario') }}"><i class="fa-solid fa-boxes-stacked"></i> Inventario</a>
                </li>
                <li class="sidebar-item">
    <a href="{{ route('admin.pedidos.index') }}"><i class="fa-solid fa-cart-shopping"></i> Pedidos</a>
</li>
                <li class="sidebar-item">
    <a href="{{ route('admin.usuarios.index') }}"><i class="fa-solid fa-users"></i> Usuarios</a>
</li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="content-header">
                <div class="title-area">
                    <h1>Gestión de inventario</h1>
                    <p>Administra el catálogo de productos y controla el stock disponible</p>
                </div>
                <button class="btn-new-product" id="openModalBtn">
                    <i class="fa-solid fa-plus"></i> Nuevo Producto
                </button>
            </div>

            @if (session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <div class="cards-row">
                <div class="info-card">
                    <div class="card-header-box">
                        <i class="fa-solid fa-box-open"></i>
                        <div>Total<br>Productos</div>
                    </div>
                    <div class="card-number">{{ $totalProductos }}</div>
                    <div class="card-badge">{{ $totalCategorias }} {{ $totalCategorias === 1 ? 'categoría' : 'categorías' }}</div>
                </div>

                <div class="info-card">
                    <div class="card-header-box">
                        <i class="fa-solid fa-clipboard-check"></i>
                        <div>Stock<br>Normal</div>
                    </div>
                    <div class="card-number">{{ $stockNormal }}</div>
                    <div class="card-badge">{{ $porcentajeCatalogo }}% del catálogo</div>
                </div>

                <div class="info-card">
                    <div class="card-header-box">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div>Stock<br>Bajo</div>
                    </div>
                    <div class="card-number">{{ $stockBajo }}</div>
                    <div class="card-badge" style="background-color: #5c5c5c;">Requieren reposición</div>
                </div>

                <div class="info-card">
                    <div class="card-header-box">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div>Sin<br>Stock</div>
                    </div>
                    <div class="card-number">{{ $sinStock }}</div>
                    <div class="card-badge" style="background-color: #444444;">Desactivadas</div>
                </div>
            </div>

            <div class="filters-container">
                <div class="search-wrapper">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" class="search-input" placeholder="Buscar productos por nombre">
                </div>
                <select class="select-filter"><option>Todas las categorías</option></select>
                <select class="select-filter"><option>Todos los estados</option></select>
                <select class="select-filter"><option>Ordenar por: Nombre</option></select>
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre del Producto</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                            <tr>
                                <td>
                                    @if($producto->imagen)
                                        <img src="{{ asset($producto->imagen) }}" class="product-img" alt="{{ $producto->nombre }}">
                                    @else
                                        <img src="{{ asset('images/default-product.png') }}" class="product-img" alt="Por defecto">
                                    @endif
                                </td>
                                <td><strong>{{ $producto->nombre }}</strong><br><small style="color:#888;">{{ Str::limit($producto->descripcion, 40) }}</small></td>
                                <td>{{ $producto->categoria->nombre ?? 'Sin Categoría' }}</td>
                                <td>S/. {{ number_format($producto->precio, 2) }}</td>
                                <td>{{ $producto->stock }} u.</td>
                                <td>
                                    @if($producto->stock > 5)
                                        <span class="badge-stock bg-success">Normal</span>
                                    @endif
                                    @if($producto->stock <= 5 && $producto->stock > 0)
                                        <span class="badge-stock bg-warning">Bajo Stock</span>
                                    @endif
                                    @if($producto->stock <= 0)
                                        <span class="badge-stock bg-danger">Sin Stock</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 30px; color: #a3a3a3;">
                                    <i class="fa-solid fa-folder-open" style="font-size: 2rem; margin-bottom: 10px; display:block;"></i>
                                    No hay productos registrados en el inventario.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <div class="modal-overlay" id="productModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Añadir Nuevo Producto</h2>
                <button class="btn-close-modal" id="closeModalX">&times;</button>
            </div>
            
            <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre del Producto</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej. Cien años de soledad" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="2" placeholder="Breve descripción..."></textarea>
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-control" required>
                        <option value="">Selecciona una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label for="precio">Precio (S/.)</label>
                        <input type="number" step="0.01" min="0" name="precio" id="precio" class="form-control" placeholder="0.00" required>
                    </div>
                    <div style="flex: 1;">
                        <label for="stock">Stock Inicial</label>
                        <input type="number" min="0" name="stock" id="stock" class="form-control" placeholder="0" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen del Producto</label>
                    <input type="file" name="imagen" id="imagen" class="form-control">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="closeModalBtn">Cancelar</button>
                    <button type="submit" class="btn-save">Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('productModal');
        const openBtn = document.getElementById('openModalBtn');
        const closeX = document.getElementById('closeModalX');
        const closeBtn = document.getElementById('closeModalBtn');

        openBtn.addEventListener('click', () => modal.classList.add('open'));
        closeX.addEventListener('click', () => modal.classList.remove('open'));
        closeBtn.addEventListener('click', () => modal.classList.remove('open'));

        // Cierra el modal si se hace clic afuera del recuadro blanco
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('open');
            }
        });
    </script>
</body>
</html>