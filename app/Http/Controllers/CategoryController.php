<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function comidaRapida()
    {
        return view('categoria.comida');
    }

    public function detallesCompra()
    {
        return view('categoria.detalles'); 
    }

    /**
     * Procesa la redirección al QR estático de Yape/Plin.
     */
    public function procesarQr(Request $request)
    {
        // 1. Validar que el monto y el método de pago vengan desde el carrito
        $request->validate([
            'monto_total' => 'required|numeric|min:1',
            'metodo' => 'required'
        ]);

        $monto = floatval($request->input('monto_total'));
        
        // Guardamos el JSON crudo del carrito para reenviarlo a la vista del formulario final
        $raw_carrito = $request->input('items_json');

        // Decodificar los productos enviados en formato JSON desde el frontend
        $items = json_decode($raw_carrito, true);
        if (!is_array($items)) {
            $items = [];
        }

        // 2. Si el usuario eligió pagar con QR, cargamos la vista local directamente
        if ($request->input('metodo') === 'qr') {
            return view('categoria.finalizar_qr', [
                'monto' => $monto,
                'items' => $items,
                'raw_carrito' => $raw_carrito
            ]);
        }

        return redirect()->back()->with('error', 'Método de pago no implementado.');
    }
    
    public function libreria()
    {
        return view('categoria.libreria');
    }

    public function supermercado()
    {
        return view('categoria.supermercado');
    }

    public function licores()
    {
        return view('categoria.licores');
    }

    public function farmacias() 
    {
        return view('categoria.farmacias');
    }
}