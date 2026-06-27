<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     *Recibe los datos del carrito y muestra la pasarela con el QR fijo.
     */
    public function mostrarPantallaQr(Request $request)
    {
        $request->validate([
            'monto_total' => 'required|numeric|min:1'
        ]);

        $monto = floatval($request->input('monto_total'));
        $items = json_decode($request->input('carrito'), true) ?? [];

        return view('categoria.finalizar_qr', [
            'monto' => $monto,
            'items' => $items,
            'raw_carrito' => $request->input('carrito') 
        ]);
    }

    /**
     * Aquí se registra la compra en la Base de Datos.
     */
    public function guardarPedido(Request $request)
    {
        $request->validate([
            'monto_total' => 'required|numeric|min:1'
        ]);

        $monto = floatval($request->input('monto_total'));
        $items = json_decode($request->input('carrito'), true);

        if (empty($items)) {
            return redirect('/')->with('error', 'El carrito está vacío o expiró.');
        }

        $clienteId = session('cliente_id');
        $clienteNombre = session('cliente_nombre', 'Invitado');

        DB::beginTransaction();
        try {
            $pedido = Pedido::create([
                'cliente_id' => $clienteId,
                'cliente_nombre' => $clienteNombre,
                'total' => $monto,
                'estado' => 'Pendiente'
            ]);

            foreach ($items as $item) {
                PedidoDetalle::create([
                    'pedido_id' => $pedido->id,
                    'producto_nombre' => $item['nombre'],
                    'precio' => $item['precio'],
                    'cantidad' => $item['cantidad'],
                ]);
            }

            DB::commit();

            return redirect('/')->with('success', '¡Su pago del Pedido #' . $pedido->id . ' ha sido registrado con éxito!');

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function index()
    {
        // 1. Obtenemos el ID del cliente guardado en la sesión
        $clienteId = session('cliente_id');

        // 2. Buscamos sus pedidos en la base de datos ordenados por los más recientes
        $pedidos = Pedido::where('cliente_id', $clienteId)
                         ->orderBy('id', 'desc')
                         ->get();

        // 3. Retornamos la vista pasándole los pedidos encontrados
        return view('mis-pedidos', compact('pedidos'));
    }

    public function show($id)
{
    // 1. Buscamos el pedido o lanzamos error si no existe
    $pedido = Pedido::findOrFail($id);

    // 2. Verificamos por seguridad que el pedido pertenezca al cliente en sesión
    if ($pedido->cliente_id != session('cliente_id')) {
        return redirect()->route('mis.pedidos')->with('error', 'No tienes permiso para ver este pedido.');
    }

    // 3. Traemos los productos asociados desde la tabla 'pedido_detalles'
    $detalles = DB::table('pedido_detalles')
                  ->where('pedido_id', $id)
                  ->get();

    // 4. Retornamos la nueva vista pasándole los datos
    return view('mis-pedidos-detalle', compact('pedido', 'detalles'));
}
}