<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * PASO 1: Recibe los datos del carrito y muestra la pasarela con el QR fijo.
     * NO guarda en la base de datos todavía.
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
     * PASO 2: Se ejecuta RECIÉN cuando el usuario da clic en "Pagar" en la vista del QR.
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

            // CORREGIDO: Redirección limpia hacia el inicio sin usar ->url()
            return redirect('/')->with('success', '¡Su pago del Pedido #' . $pedido->id . ' ha sido registrado con éxito!');

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}