<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos - ClickUp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            color: black;
        }

        :root {
            --primary-orange: #f97316;
            --dark-grey: #333;
        }

        /* --- Header / Navbar --- */
        .header {
            background-color: white;
            width: 100%;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 50px;
            box-sizing: border-box;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
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

        /* Perfil Dropdown */
        .user-dropdown-container { position: relative; display: inline-block; }
        .user-welcome-box {
            display: flex; align-items: center; gap: 12px;
            background: rgba(249, 115, 22, 0.1); padding: 8px 18px;
            border-radius: 20px; border: 1px solid rgba(249, 115, 22, 0.2);
            cursor: pointer;
        }
        .user-welcome-text { font-size: 0.95rem; color: var(--dark-grey); font-weight: 500; }
        .user-welcome-text i { color: var(--primary-orange); }
        .welcome-arrow { font-size: 0.75rem; color: var(--dark-grey); transition: transform 0.2s; }
        
        .profile-dropdown-menu {
            position: absolute; top: 115%; right: 0; background-color: #ffffff;
            min-width: 170px; border-radius: 14px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid #eeeeee; padding: 6px 0; display: none; z-index: 1000;
        }
        .profile-dropdown-menu.show { display: block; }
        .dropdown-custom-item {
            display: flex; align-items: center; gap: 12px; padding: 10px 16px;
            color: #333333; text-decoration: none; font-size: 0.9rem; font-weight: 500; width: 100%; border: none; background: none; text-align: left; cursor: pointer; box-sizing: border-box;
        }
        .dropdown-custom-item:hover { background-color: #f5f5f5; }
        .dropdown-custom-divider { border: 0; border-top: 1px solid #eeeeee; margin: 6px 0; }
        .dropdown-custom-item.logout-color { color: #ef4444; }
        .dropdown-custom-item.logout-color i { color: #ef4444; }

        /* --- Contenedor de Pedidos --- */
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .title-section {
            margin-bottom: 30px;
        }

        .title-section h1 {
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 10px 0;
            color: var(--dark-grey);
        }

        /* --- ESTADO SIN PEDIDOS --- */
        .empty-orders {
            background-color: white;
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid #edf2f7;
        }

        .empty-orders i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 20px;
        }

        .empty-orders h2 {
            font-size: 1.4rem;
            margin: 0 0 10px 0;
            color: #475569;
        }

        .empty-orders p {
            color: #94a3b8;
            margin: 0 0 25px 0;
            font-size: 1rem;
        }

        .btn-browse {
            display: inline-block;
            background-color: var(--primary-orange);
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 25px;
            transition: background-color 0.2s;
        }

        .btn-browse:hover {
            background-color: #e86300;
        }

        /* --- LISTADO DE PEDIDOS (TABLA) --- */
        .orders-card {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid #edf2f7;
            overflow: hidden;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .orders-table th {
            background-color: #f8fafc;
            padding: 16px 24px;
            font-size: 0.85rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            border-bottom: 1px solid #edf2f7;
        }

        .orders-table td {
            padding: 20px 24px;
            font-size: 0.95rem;
            color: #334155;
            border-bottom: 1px solid #edf2f7;
            vertical-align: middle;
        }

        .orders-table tr:last-child td {
            border-bottom: none;
        }

        .order-id {
            font-weight: 700;
            color: var(--primary-orange);
        }

        /* Etiquetas de estados */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-badge.entregado { background-color: #dcfce7; color: #15803d; }
        .status-badge.pendiente { background-color: #fef9c3; color: #a16207; }
        .status-badge.cancelado { background-color: #fee2e2; color: #b91c1c; }

        .btn-detail {
            background: none;
            border: 1px solid #cbd5e1;
            padding: 6px 14px;
            border-radius: 15px;
            color: #475569;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .btn-detail:hover {
            background-color: #f1f5f9;
            color: black;
            border-color: #94a3b8;
        }
    </style>
</head>
<body>

    <header class="header">
        <a href="/" class="logo">
            <img src="{{ asset('images/LogoClickUp.png') }}" alt="Logo ClickUp" class="logo-real">
        </a>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Couriers Corporativos</a></li>
                <li><a href="#">Sobre Nosotros</a></li>
                <li><a href="#">Afilia tu Negocio</a></li>
                <li>
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
                </li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="title-section">
            <h1>Mis Pedidos</h1>
            <p>Historial de tus órdenes hechas en la plataforma.</p>
        </div>

        {{-- LÓGICA DE BLADE: Si la colección de pedidos está vacía --}}
        @if(empty($pedidos) || count($pedidos) == 0)
            <div class="empty-orders">
                <i class="fa-solid fa-box-open"></i>
                <h2>Aún no has realizado ningún pedido</h2>
                <p>¿Qué te parece si buscas algo rico o necesitas que te llevemos algo?</p>
                <a href="/" class="btn-browse">Explorar Tiendas</a>
            </div>
        @else
            <div class="orders-card">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                        <tr>
                            <td class="order-id">#{{ $pedido->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y h:i A') }}</td>
                            <td>S/ {{ number_format($pedido->total, 2) }}</td>
                            <td>
                                {{-- Clases dinámicas dependiendo del estado --}}
                                <span class="status-badge {{ strtolower($pedido->estado) }}">
                                    {{ $pedido->estado }}
                                </span>
                            </td>
                            <td>
    <a href="{{ route('pedidos.show', $pedido->id) }}" style="text-decoration: none;">
        <button class="btn-detail">Ver Detalle</button>
    </a>
</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trigger = document.getElementById('dropdownTrigger');
            const menu = document.getElementById('dropdownMenu');
            const arrow = trigger.querySelector('.welcome-arrow');

            trigger.addEventListener('click', function(event) {
                event.stopPropagation();
                const isOpen = menu.classList.contains('show');
                
                if (isOpen) {
                    menu.classList.remove('show');
                    arrow.style.transform = 'rotate(0deg)';
                } else {
                    menu.classList.add('show');
                    arrow.style.transform = 'rotate(180deg)';
                }
            });

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