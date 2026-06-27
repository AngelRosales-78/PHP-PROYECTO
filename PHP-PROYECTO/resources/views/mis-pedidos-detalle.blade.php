<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Pedido #{{ $pedido->id }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f9f9f9; margin: 40px; }
        .container { max-width: 800px; background: white; padding: 30px; border-radius: 14px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin: 0 auto; }
        .back-link { text-decoration: none; color: #f97316; font-weight: bold; display: inline-block; margin-bottom: 20px; }
        
        /* --- ESTILOS DE LA LÍNEA DE SEGUIMIENTO --- */
        .tracking-wrapper { display: flex; justify-content: space-between; margin: 30px 0; position: relative; }
        .tracking-wrapper::before { content: ''; position: absolute; top: 20px; left: 5%; width: 90%; height: 4px; background: #e0e0e0; z-index: 1; }
        .step { text-align: center; position: relative; z-index: 2; width: 25%; }
        .step .icon { width: 40px; height: 40px; border-radius: 50%; background: #e0e0e0; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; font-size: 1.1rem; }
        .step.active .icon { background: #f97316; box-shadow: 0 0 10px rgba(249,115,22,0.4); }
        .step p { margin: 0; font-size: 0.85rem; font-weight: 600; color: #666; }
        .step.active p { color: #000; font-weight: bold; }

        /* --- TABLA DE PRODUCTOS --- */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #f8f9fa; color: #555; }
        .total-box { text-align: right; margin-top: 20px; font-size: 1.2rem; font-weight: bold; color: #333; }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ route('mis.pedidos') }}" class="back-link"><i class="fa-solid fa-arrow-left"></i> Volver a Mis Pedidos</a>
    
    <h2>Detalle del Pedido #{{ $pedido->id }}</h2>
    <p><strong>Fecha de compra:</strong> {{ \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y h:i A') }}</p>

    <div class="tracking-wrapper">
        <div class="step {{ in_array($pedido->estado, ['Pendiente', 'Procesando', 'En Camino', 'Entregado']) ? 'active' : '' }}">
            <div class="icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
            <p>Recibido</p>
        </div>

        <div class="step {{ in_array($pedido->estado, ['Procesando', 'En Camino', 'Entregado']) ? 'active' : '' }}">
            <div class="icon"><i class="fa-solid fa-kitchen-set"></i></div>
            <p>En Preparación</p>
        </div>

        <div class="step {{ in_array($pedido->estado, ['En Camino', 'Entregado']) ? 'active' : '' }}">
            <div class="icon"><i class="fa-solid fa-motorcycle"></i></div>
            <p>En Camino</p>
        </div>

        <div class="step {{ $pedido->estado == 'Entregado' ? 'active' : '' }}">
            <div class="icon"><i class="fa-solid fa-house-chimney-user"></i></div>
            <p>Entregado</p>
        </div>
    </div>

    <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">

    <h3>Productos en este pedido</h3>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalles as $item)
            <tr>
                <td>{{ $item->producto_nombre }}</td>
                <td>S/. {{ number_format($item->precio, 2) }}</td>
                <td>{{ $item->cantidad }} u.</td>
                <td>S/. {{ number_format($item->precio * $item->cantidad, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        Total Pagado: S/. {{ number_format($pedido->total, 2) }}
    </div>
</div>

</body>
</html>