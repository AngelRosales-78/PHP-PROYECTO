<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
// IMPORTANTE: Importamos los modelos para poder hablar con la BD
use App\Models\Categoria; 
use App\Models\Producto;  

class CategoryController extends Controller
{
    public function comidaRapida()
    {
        // 1. Buscamos la categoría por su nombre exacto en la BD
        $categoria = Categoria::where('nombre', 'Comida Rápida')->first();
        // 2. Si existe, traemos sus productos. Si no, enviamos un arreglo vacío
        $productos = $categoria ? $categoria->productos : [];
        // 3. Enviamos los productos a la vista
        return view('categoria.comida', compact('productos'));
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
        $categoria = Categoria::where('nombre', 'Libros')->first();
        $productos = $categoria ? $categoria->productos : [];
        
        return view('categoria.libreria', compact('productos'));
    }

    public function supermercado()
    {
        $categoria = Categoria::where('nombre', 'Supermercado')->first();
        $productos = $categoria ? $categoria->productos : [];

        return view('categoria.supermercado', compact('productos'));
    }

    public function licores()
    {
        $categoria = Categoria::where('nombre', 'Licores')->first();
        $productos = $categoria ? $categoria->productos : [];

        return view('categoria.licores', compact('productos'));
    }

    public function farmacias() 
    {
        $categoria = Categoria::where('nombre', 'Farmacia')->first();
        $productos = $categoria ? $categoria->productos : [];

        return view('categoria.farmacias', compact('productos'));
    }
}