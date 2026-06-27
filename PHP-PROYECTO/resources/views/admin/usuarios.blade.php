<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClickUp Admin - Usuarios Registrados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0; padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcfcfc;
            display: flex; flex-direction: column;
            height: 100vh; overflow: hidden;
        }
        /* --- Barra Superior Naranja --- */
        .top-navbar {
            background-color: #f27c22; height: 60px; width: 100%;
            display: flex; align-items: center; padding: 0 30px;
            box-sizing: border-box; z-index: 10;
        }
        .top-navbar img { height: 45px; }

        /* --- Contenedor de Cuerpo Central --- */
        .admin-container { display: flex; flex-grow: 1; width: 100%; height: calc(100vh - 60px); }
        
        /* --- Sidebar Lateral Izquierda --- */
        .sidebar { background-color: #3e3e3e; width: 260px; min-width: 260px; display: flex; flex-direction: column; padding: 25px 0; box-sizing: border-box; }
        .sidebar-section-title { color: #a3a3a3; font-size: 0.85rem; font-weight: bold; padding: 0 25px; margin: 15px 0 10px 0; text-transform: uppercase; letter-spacing: 0.5px; }
        .sidebar-menu { list-style: none; padding: 0; margin: 0; }
        .sidebar-item a { display: flex; align-items: center; gap: 15px; color: #d1d1d1; text-decoration: none; padding: 12px 25px; font-size: 1rem; font-weight: 500; transition: all 0.2s; }
        .sidebar-item a:hover { background-color: #4a4a4a; color: #ffffff; }
        .sidebar-item.active a { background-color: #524c46; color: #ffffff; border-left: 5px solid #f27c22; padding-left: 20px; }
        .sidebar-item i { font-size: 1.1rem; width: 20px; text-align: center; }
        
        /* --- Panel de Contenido Principal --- */
        .main-content { flex-grow: 1; padding: 40px 50px; box-sizing: border-box; overflow-y: auto; background-color: #ffffff; }
        .content-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 35px; }
        .title-area h1 { font-size: 2.5rem; font-weight: 800; margin: 0 0 8px 0; color: #000000; }
        .title-area p { font-size: 1rem; color: #555555; margin: 0; }

        /* --- Métrica Rápida --- */
        .counter-badge {
            background-color: #f27c22;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
        }
        
        /* --- Tabla de Usuarios --- */
        .table-container { border: 1px solid #cccccc; border-radius: 12px; overflow: hidden; background-color: #ffffff; margin-top: 20px; }
        .data-table { width: 100%; border-collapse: collapse; text-align: left; }
        .data-table th { background-color: #f9f9f9; padding: 15px 20px; font-weight: bold; color: #333; border-bottom: 1px solid #cccccc; }
        .data-table td { padding: 15px 20px; border-bottom: 1px solid #eeeeee; color: #555; vertical-align: middle; }
        
        .user-avatar {
            width: 40px; height: 40px;
            background-color: #e2e8f0;
            color: #4a5568;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; font-size: 1.1rem;
        }
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
                <li class="sidebar-item">
                    <a href="{{ route('admin.inventario') }}"><i class="fa-solid fa-boxes-stacked"></i> Inventario</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.pedidos.index') }}"><i class="fa-solid fa-cart-shopping"></i> Pedidos</a>
                </li>
                <li class="sidebar-item active">
                    <a href="{{ route('admin.usuarios.index') }}"><i class="fa-solid fa-users"></i> Usuarios</a>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="content-header">
                <div class="title-area">
                    <h1>Usuarios Registrados <span class="counter-badge">{{ $totalUsuarios }} en total</span></h1>
                    <p>Visualiza el listado de clientes que han creado una cuenta en ClickUp</p>
                </div>
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Nombre Completo</th>
                            <th>Correo Electrónico</th>
                            <th>Fecha de Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td><strong>#{{ $usuario->id }}</strong></td>
                                <td>
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($usuario->name ?? $usuario->nombre ?? 'U', 0, 1)) }}
                                    </div>
                                </td>
                                <td><strong>{{ $usuario->name ?? $usuario->nombre }}</strong></td>
                                <td>{{ $usuario->email ?? $usuario->correo }}</td>
                                <td>{{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 40px; color: #a3a3a3;">
                                    <i class="fa-solid fa-users-slash" style="font-size: 2rem; margin-bottom: 10px; display:block;"></i>
                                    No hay usuarios registrados en el sistema todavía.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>
</html>